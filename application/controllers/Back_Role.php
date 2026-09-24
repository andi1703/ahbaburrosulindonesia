<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_Role extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "login") redirect('admin');
        if (!has_access('back_role')) redirect('admin/dashboard');
    }

    public function index() {
        $data['roles'] = $this->db->order_by('role_name', 'ASC')->get('roles')->result_array();
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/role/V_Role', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function simpan() {
        $role_name = trim((string) $this->input->post('role_name', TRUE));
        $description = trim((string) $this->input->post('description', TRUE));
        if ($role_name === '') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Nama kategori user wajib diisi.</div>');
            redirect('back_role');
        }
        $this->db->insert('roles', ['role_name' => $role_name, 'description' => $description]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Kategori user berhasil ditambahkan.</div>');
        redirect('back_role');
    }

    public function update() {
        $id = (int) $this->input->post('id');
        $role_name = trim((string) $this->input->post('role_name', TRUE));
        $description = trim((string) $this->input->post('description', TRUE));
        if (!$id || $role_name === '') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Data kategori user tidak valid.</div>');
            redirect('back_role');
        }
        $this->db->where('id', $id)->update('roles', ['role_name' => $role_name, 'description' => $description]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Kategori user berhasil diperbarui.</div>');
        redirect('back_role');
    }

    public function hapus_role($id) {
        $id = (int) $id;
        if ($id) {
            $this->db->where('id', $id)->delete('roles');
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Kategori user berhasil dihapus.</div>');
        redirect('back_role');
    }

    public function kelola($role_name) {
        $data['role'] = urldecode($role_name);
        // Ambil semua menu dari tabel menus (SMC)
        $data['all_menu'] = $this->db->get('menus')->result_array();
        
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/role/V_Akses_Role', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    // Fungsi untuk Bulk Update Akses (AJAX)
    public function save_access() {
        $role = $this->input->post('role');
        $menuIds = $this->input->post('menuIds'); // Bisa kosong jika tidak ada yang dicentang

        // 1. Hapus semua akses lama untuk role ini
        $this->db->where('role', $role)->delete('user_access_menu');

        // 2. Insert akses baru secara bulk (jika ada)
        if (!empty($menuIds)) {
            $data = [];
            foreach ($menuIds as $id_menu) {
                $data[] = [
                    'role' => $role,
                    'id_menu' => $id_menu
                ];
            }
            $this->db->insert_batch('user_access_menu', $data);
        }

        echo json_encode(['status' => 'success', 'message' => 'Berhasil disimpan']);
    }
}
