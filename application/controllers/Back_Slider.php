<?php
class Back_Slider extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Slider');
        if($this->session->userdata('status') != "login") redirect(base_url("admin"));
    }

    public function index() {
        $data['all_slider'] = $this->M_Slider->get_all();
        
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/master_data/slider/V_Slider', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function simpan_aksi() {
        $gambar = '';

        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './assets/img/slider/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = 5120; // 5MB
            $config['file_name']     = 'slider-' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $file_data = $this->upload->data();
                $gambar = $file_data['file_name'];
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
                redirect('back_slider');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Gambar wajib diupload!</div>');
            redirect('back_slider');
        }

        $data = [
            'judul_slider' => $this->input->post('judul_slider'),
            'sub_judul'    => $this->input->post('sub_judul'),
            'gambar'       => $gambar,
            'link_button'  => $this->input->post('link_button'),
            'urutan'       => $this->input->post('urutan') ? $this->input->post('urutan') : 1,
            'status'       => $this->input->post('status'),
            'tanggal_update' => date('Y-m-d H:i:s')
        ];

        $this->M_Slider->simpan($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Slider berhasil ditambahkan!</div>');
        redirect('back_slider');
    }

    public function update_aksi() {
        $id = $this->input->post('id_slider');
        $old_gambar = $this->input->post('old_gambar');
        $gambar = $old_gambar;

        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './assets/img/slider/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = 5120; // 5MB
            $config['file_name']     = 'slider-' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                if($old_gambar && file_exists('./assets/img/slider/'.$old_gambar)) {
                    unlink('./assets/img/slider/'.$old_gambar);
                }
                $file_data = $this->upload->data();
                $gambar = $file_data['file_name'];
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
                redirect('back_slider');
            }
        }

        $data = [
            'judul_slider' => $this->input->post('judul_slider'),
            'sub_judul'    => $this->input->post('sub_judul'),
            'gambar'       => $gambar,
            'link_button'  => $this->input->post('link_button'),
            'urutan'       => $this->input->post('urutan') ? $this->input->post('urutan') : 1,
            'status'       => $this->input->post('status'),
            'tanggal_update' => date('Y-m-d H:i:s')
        ];

        $this->M_Slider->update($id, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Slider berhasil diperbarui!</div>');
        redirect('back_slider');
    }

    public function hapus($id) {
        $slider = $this->M_Slider->get_by_id($id);
        if(!empty($slider['gambar']) && file_exists('./assets/img/slider/'.$slider['gambar'])) {
            unlink('./assets/img/slider/'.$slider['gambar']);
        }

        $this->M_Slider->hapus($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Slider berhasil dihapus!</div>');
        redirect('back_slider');
    }
}
