<?php
class Back_Artikel extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('M_Artikel');
        $this->load->model('M_Kategori'); // Untuk dropdown kategori
        if($this->session->userdata('status') != "login") redirect(base_url("admin"));
    }

    public function index() {
        $data['all_artikel'] = $this->M_Artikel->get_artikel_lengkap();
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/artikel/V_Artikel', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function tambah() {
        $data['categories'] = $this->M_Kategori->get_all();
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/artikel/V_Artikel_form', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function simpan_aksi() {
        // 1. Konfigurasi Upload Gambar
        $config['upload_path']   = './assets/img/artikel/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = 'artikel-' . time(); // Nama file unik

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar_cover')) {
            $file_data = $this->upload->data();
            $gambar = $file_data['file_name'];
        } else {
            $gambar = ''; // Jika gagal upload atau tidak ada gambar
        }

        // Ambil id_user, pastikan tidak null (fallback ke 1 jika null agar tidak error)
        $id_user = $this->session->userdata('id_user');
        if (empty($id_user)) {
            $id_user = 1;
        }

        // 2. Siapkan Data untuk Database
        $judul = $this->input->post('judul_artikel');
        $data = [
            'judul_artikel'  => $judul,
            'slug_artikel'   => url_title($judul, 'dash', TRUE), // Auto-Slug
            'ringkasan'      => $this->input->post('ringkasan'),
            'konten'         => $this->input->post('konten'),
            'id_kategori'    => $this->input->post('id_kategori'),
            'id_user'        => $id_user,
            'gambar_cover'   => $gambar,
            'ket_gambar'     => $this->input->post('ket_gambar'),
            'tag_artikel'    => $this->input->post('tag_artikel'),
            'status'         => $this->input->post('status') ? $this->input->post('status') : 'Publish',
            'tanggal_dibuat' => date('Y-m-d H:i:s'),
            'dibaca'         => 0
        ];

        $this->M_Artikel->simpan_data($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Artikel berhasil diterbitkan!</div>');
        redirect('back_artikel');
    }

    public function edit($id) {
        $data['artikel'] = $this->M_Artikel->get_by_id($id);
        $data['categories'] = $this->M_Kategori->get_all();
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/artikel/V_Artikel_form', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function update_aksi() {
        $id_artikel = $this->input->post('id_artikel');
        $judul_artikel = $this->input->post('judul_artikel');
        $slug_artikel = url_title($judul_artikel, 'dash', TRUE);
        $id_kategori = $this->input->post('id_kategori');
        $status = $this->input->post('status') ? $this->input->post('status') : 'Publish';
        $konten = $this->input->post('konten');
        $old_gambar = $this->input->post('old_gambar');

        $gambar_cover = $old_gambar;

        if (!empty($_FILES['gambar_cover']['name'])) {
            $config['upload_path']          = './assets/img/artikel/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;
            $config['file_name']            = 'artikel-' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar_cover')) {
                if($old_gambar && file_exists('./assets/img/artikel/'.$old_gambar)) {
                    unlink('./assets/img/artikel/'.$old_gambar);
                }
                $uploadData = $this->upload->data();
                $gambar_cover = $uploadData['file_name'];
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
                redirect(base_url('index.php/back_artikel/edit/'.$id_artikel));
            }
        }

        $data = array(
            'judul_artikel'  => $judul_artikel,
            'slug_artikel'   => $slug_artikel,
            'ringkasan'      => $this->input->post('ringkasan'),
            'id_kategori'    => $id_kategori,
            'konten'         => $konten,
            'status'         => $status,
            'gambar_cover'   => $gambar_cover,
            'ket_gambar'     => $this->input->post('ket_gambar'),
            'tag_artikel'    => $this->input->post('tag_artikel')
        );

        $this->M_Artikel->update_data($id_artikel, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Artikel berhasil diupdate!</div>');
        redirect(base_url('index.php/back_artikel'));
    }

    public function hapus($id) {
        $artikel = $this->M_Artikel->get_by_id($id);
        if(!empty($artikel['gambar_cover']) && file_exists('./assets/img/artikel/'.$artikel['gambar_cover'])) {
            unlink('./assets/img/artikel/'.$artikel['gambar_cover']);
        }

        $this->M_Artikel->hapus_data($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Artikel berhasil dihapus!</div>');
        redirect('back_artikel');
    }
}
