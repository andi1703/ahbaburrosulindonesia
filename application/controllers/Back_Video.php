<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_Video extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Video');
        if($this->session->userdata('status') != "login") redirect('admin');
    }

    public function index() {
        $data['all_video'] = $this->M_Video->get_all();
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/master_data/video/V_Video', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    // Ekstrak ID YouTube dari berbagai format URL
    private function extractYouTubeId($input) {
        $input = trim($input);
        // Format: youtu.be/ID
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $input, $m)) return $m[1];
        // Format: youtube.com/watch?v=ID
        if (preg_match('/[?&]v=([a-zA-Z0-9_-]{11})/', $input, $m)) return $m[1];
        // Format: youtube.com/embed/ID
        if (preg_match('/embed\/([a-zA-Z0-9_-]{11})/', $input, $m)) return $m[1];
        // Sudah berupa ID murni
        return $input;
    }

    public function simpan_aksi() {
        $data = [
            'judul_video'    => $this->input->post('judul_video'),
            'id_youtube'     => $this->extractYouTubeId($this->input->post('id_youtube')),
            'kategori_video' => $this->input->post('kategori_video'),
            'keterangan'     => $this->input->post('keterangan')
        ];

        $this->M_Video->simpan($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Video berhasil ditambahkan!</div>');
        redirect('back_video');
    }

    public function update_aksi() {
        $id = $this->input->post('id_video');
        $data = [
            'judul_video'    => $this->input->post('judul_video'),
            'id_youtube'     => $this->extractYouTubeId($this->input->post('id_youtube')),
            'kategori_video' => $this->input->post('kategori_video'),
            'keterangan'     => $this->input->post('keterangan')
        ];

        $this->M_Video->update($id, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Video berhasil diperbarui!</div>');
        redirect('back_video');
    }

    public function hapus($id) {
        $this->M_Video->hapus($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Video berhasil dihapus!</div>');
        redirect('back_video');
    }
}
