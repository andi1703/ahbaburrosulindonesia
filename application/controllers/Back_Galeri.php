<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_Galeri extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Galeri');
        if($this->session->userdata('status') != "login") redirect('admin');
    }

    public function index() {
        $data['all_galeri'] = $this->M_Galeri->get_all();
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/master_data/galeri/V_Galeri', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function simpan_aksi() {
        $config['upload_path']   = './assets/img/galeri/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = 'galeri-' . time();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_foto')) {
            $data = [
                'judul_foto' => $this->input->post('judul_foto'),
                'album'      => $this->input->post('album'),
                'file_foto'  => $this->upload->data('file_name')
            ];
            $this->M_Galeri->simpan($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Foto berhasil ditambahkan ke galeri!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
        }
        redirect('back_galeri');
    }

    public function hapus($id) {
        $data = $this->M_Galeri->get_by_id($id);
        if ($data && !empty($data['file_foto']) && file_exists('./assets/img/galeri/' . $data['file_foto'])) {
            unlink('./assets/img/galeri/' . $data['file_foto']);
        }
        $this->M_Galeri->hapus($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Foto galeri berhasil dihapus!</div>');
        redirect('back_galeri');
    }
}
