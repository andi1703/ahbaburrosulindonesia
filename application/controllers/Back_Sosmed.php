<?php
class Back_Sosmed extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Sosmed');
        if($this->session->userdata('status') != "login") redirect(base_url("admin"));
    }

    public function index() {
        $data['all_sosmed'] = $this->M_Sosmed->get_all();
        
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/master_data/sosmed/V_Sosmed', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function simpan_aksi() {
        $data = [
            'nama_sosmed' => $this->input->post('nama_sosmed'),
            'url'         => $this->input->post('url'),
            'icon'        => $this->input->post('icon'),
            'status'      => $this->input->post('status')
        ];

        $this->M_Sosmed->simpan($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sosial Media berhasil ditambahkan!</div>');
        redirect('back_sosmed');
    }

    public function update_aksi() {
        $id = $this->input->post('id_sosmed');
        $data = [
            'nama_sosmed' => $this->input->post('nama_sosmed'),
            'url'         => $this->input->post('url'),
            'icon'        => $this->input->post('icon'),
            'status'      => $this->input->post('status')
        ];

        $this->M_Sosmed->update($id, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Sosial Media berhasil diupdate!</div>');
        redirect('back_sosmed');
    }

    public function hapus($id) {
        $this->M_Sosmed->hapus($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Sosial Media berhasil dihapus!</div>');
        redirect('back_sosmed');
    }
}
