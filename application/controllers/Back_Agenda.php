<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_Agenda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Agenda');
        if($this->session->userdata('status') != "login") redirect('admin');
    }

    public function index() {
        $data['all_agenda'] = $this->M_Agenda->get_all();
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/master_data/agenda/V_Agenda', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function tambah() {
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/master_data/agenda/V_Agenda_form');
        $this->load->view('admin/layout/V_Footer');
    }

    public function simpan_aksi() {
        // Proses Upload Poster (opsional)
        $poster = '';
        if (!empty($_FILES['poster']['name'])) {
            $config['upload_path']   = './assets/img/poster_agenda/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = 'poster-' . time();
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('poster')) {
                $poster = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
                redirect('back_agenda/tambah');
            }
        }

        $data = [
            'nama_kegiatan'   => $this->input->post('nama_kegiatan'),
            'pengisi_kajian'  => $this->input->post('pengisi_kajian'),
            'tempat'          => $this->input->post('tempat'),
            'Maps'            => $this->input->post('Maps'),
            'tanggal'         => $this->input->post('tanggal'),
            'jam'             => $this->input->post('jam'),
            'keterangan'      => $this->input->post('keterangan'),
            'poster'          => $poster,
            'status_kegiatan' => $this->input->post('status_kegiatan'),
        ];

        $this->M_Agenda->simpan($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Agenda baru berhasil ditambahkan!</div>');
        redirect('back_agenda');
    }

    public function edit($id) {
        $data['agenda'] = $this->M_Agenda->get_by_id($id);
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/master_data/agenda/V_Agenda_form', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function update_aksi() {
        $id         = $this->input->post('id_agenda');
        $old_poster = $this->input->post('old_poster');
        $poster     = $old_poster; // Pakai poster lama jika tidak ada upload baru

        // Proses Upload Poster baru jika ada
        if (!empty($_FILES['poster']['name'])) {
            $config['upload_path']   = './assets/img/poster_agenda/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = 'poster-' . time();
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('poster')) {
                // Hapus poster lama agar tidak jadi file sampah
                if (!empty($old_poster) && file_exists('./assets/img/poster_agenda/'.$old_poster)) {
                    unlink('./assets/img/poster_agenda/'.$old_poster);
                }
                $poster = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
                redirect('back_agenda/edit/'.$id);
            }
        }

        $data = [
            'nama_kegiatan'   => $this->input->post('nama_kegiatan'),
            'pengisi_kajian'  => $this->input->post('pengisi_kajian'),
            'tempat'          => $this->input->post('tempat'),
            'Maps'            => $this->input->post('Maps'),
            'tanggal'         => $this->input->post('tanggal'),
            'jam'             => $this->input->post('jam'),
            'keterangan'      => $this->input->post('keterangan'),
            'poster'          => $poster,
            'status_kegiatan' => $this->input->post('status_kegiatan'),
        ];

        $this->M_Agenda->update($id, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Agenda berhasil diperbarui!</div>');
        redirect('back_agenda');
    }

    public function hapus($id) {
        $agenda = $this->M_Agenda->get_by_id($id);
        // Hapus file poster agar tidak menjadi sampah
        if (!empty($agenda['poster']) && file_exists('./assets/img/poster_agenda/'.$agenda['poster'])) {
            unlink('./assets/img/poster_agenda/'.$agenda['poster']);
        }
        $this->M_Agenda->hapus($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Agenda berhasil dihapus!</div>');
        redirect('back_agenda');
    }
}
