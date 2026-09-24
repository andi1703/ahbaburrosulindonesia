<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "login") redirect('admin');
        if (!has_access('back_user')) redirect('admin/dashboard');
    }

    public function index() {
        $data['all_user'] = $this->db->order_by('created_at', 'ASC')->get('users')->result_array();
        $data['roles'] = $this->db->order_by('role_name', 'ASC')->get('roles')->result_array();
        $this->load->view('admin/layout/V_Header');
        $this->load->view('admin/layout/V_Sidebar');
        $this->load->view('admin/login/V_User_admin', $data);
        $this->load->view('admin/layout/V_Footer');
    }

    public function update_aksi() {
        $id        = $this->input->post('id_user');
        $full_name = $this->input->post('full_name');
        $username  = $this->input->post('username');
        $password  = $this->input->post('password');
        $confirm   = $this->input->post('confirm_password');
        $role      = $this->input->post('role');
        $role_id   = (int) $this->input->post('role_id');

        // Cek duplikat username (kecuali user itu sendiri)
        $cek = $this->db->where('username', $username)->where('id !=', $id)->get('users')->num_rows();
        if ($cek > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Username <strong>'.$username.'</strong> sudah digunakan pengguna lain.</div>');
            redirect('back_user');
        }

        $data = [
            'full_name' => $full_name,
            'username'  => $username,
            'role'      => $role,
            'role_id'   => $role_id ?: NULL,
        ];

        // Update password hanya jika diisi
        if (!empty($password)) {
            if ($password !== $confirm) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Konfirmasi password tidak cocok!</div>');
                redirect('back_user');
            }
            $data['password'] = $password;
        }

        $this->db->where('id', $id)->update('users', $data);
        $this->session->set_flashdata('sukses', '<div class="alert alert-success">Data user <strong>'.$full_name.'</strong> berhasil diperbarui!</div>');
        redirect('back_user');
    }

    public function hapus($id) {
        // Tidak boleh hapus diri sendiri
        $user = $this->db->get_where('users', ['id' => $id])->row_array();
        if ($user && $user['username'] == $this->session->userdata('nama')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Tidak bisa menghapus akun Anda sendiri!</div>');
            redirect('back_user');
        }

        $this->db->where('id', $id)->delete('users');
        $this->session->set_flashdata('sukses', '<div class="alert alert-success">User berhasil dihapus.</div>');
        redirect('back_user');
    }

    public function toggle_status($id) {
        $user = $this->db->get_where('users', ['id' => (int) $id])->row_array();
        if ($user) {
            $this->db->where('id', (int) $id)->update('users', ['is_active' => empty($user['is_active']) ? 1 : 0]);
        }
        redirect('back_user');
    }

    public function reset_password() {
        $id = (int) $this->input->post('id_user');
        $password = (string) $this->input->post('password');
        $confirm = (string) $this->input->post('confirm_password');
        if (!$id || strlen($password) < 6 || $password !== $confirm) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Password reset tidak valid. Minimal 6 karakter dan harus sama.</div>');
            redirect('back_user');
        }
        $this->db->where('id', $id)->update('users', ['password' => $password]);
        $this->session->set_flashdata('sukses', '<div class="alert alert-success">Password berhasil direset.</div>');
        redirect('back_user');
    }
}
