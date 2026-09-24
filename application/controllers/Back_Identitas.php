<?php
class Back_Identitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Identitas');
        if($this->session->userdata('status') != "login") redirect(base_url("admin"));
    }

    public function index() {
        $data['semua_identitas'] = $this->M_Identitas->get_all();
        
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/master_data/identitas/V_Identitas', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function tambah() {
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/master_data/identitas/V_Identitas_form');
        $this->load->view('admin/layout/V_Footer');
    }

    public function simpan_aksi() {
        $logo = '';

        if (!empty($_FILES['logo']['name'])) {
            $config['upload_path']   = './assets/img/logo/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = 'logo-' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo')) {
                $file_data = $this->upload->data();
                $logo = $file_data['file_name'];
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
                redirect('back_identitas/tambah');
            }
        }

        $data = [
            'nama_website'     => $this->input->post('nama_website'),
            'logo'             => $logo,
            'slogan'           => $this->input->post('slogan'),
            'alamat'           => $this->input->post('alamat'),
            'email'            => $this->input->post('email'),
            'whatsapp'         => $this->input->post('whatsapp'),
            'map_url'          => $this->input->post('map_url'),
            'deskripsi_footer' => $this->input->post('deskripsi_footer')
        ];

        $this->M_Identitas->simpan_data($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Cabang / Identitas baru berhasil ditambahkan!</div>');
        redirect('back_identitas');
    }

    public function edit($id) {
        $data['identitas'] = $this->M_Identitas->get_by_id($id);
        
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/master_data/identitas/V_Identitas_form', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function update_aksi() {
        $id = $this->input->post('id_identitas');
        $old_logo = $this->input->post('old_logo');
        $logo = $old_logo;

        // Proses upload logo jika ada
        if (!empty($_FILES['logo']['name'])) {
            $config['upload_path']   = './assets/img/logo/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = 'logo-' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo')) {
                // Hapus logo lama jika ada
                if($old_logo && file_exists('./assets/img/logo/'.$old_logo)) {
                    unlink('./assets/img/logo/'.$old_logo);
                }
                $file_data = $this->upload->data();
                $logo = $file_data['file_name'];
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
                redirect('back_identitas/edit/'.$id);
            }
        }

        $data = [
            'nama_website'     => $this->input->post('nama_website'),
            'logo'             => $logo,
            'slogan'           => $this->input->post('slogan'),
            'alamat'           => $this->input->post('alamat'),
            'email'            => $this->input->post('email'),
            'whatsapp'         => $this->input->post('whatsapp'),
            'map_url'          => $this->input->post('map_url'),
            'deskripsi_footer' => $this->input->post('deskripsi_footer')
        ];

        $this->M_Identitas->update_data($id, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data Cabang / Identitas berhasil diperbarui!</div>');
        redirect('back_identitas');
    }

    public function hapus($id) {
        $identitas = $this->M_Identitas->get_by_id($id);
        if(!empty($identitas['logo']) && file_exists('./assets/img/logo/'.$identitas['logo'])) {
            unlink('./assets/img/logo/'.$identitas['logo']);
        }

        $this->M_Identitas->hapus_data($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Cabang / Identitas berhasil dihapus!</div>');
        redirect('back_identitas');
    }
}
