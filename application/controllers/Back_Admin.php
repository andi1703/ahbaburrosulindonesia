<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model yang diperlukan
        $this->load->model('M_admin');
    }

    public function index() {
        $data['roles'] = $this->db->order_by('role_name', 'ASC')->get('roles')->result_array();
        $this->load->view('admin/login/V_Login', $data);
    }

    public function login_process() {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $where = array(
            'username' => $user,
            'password' => $pass // Untuk awal, kita gunakan plain text dulu
        );

        $cek = $this->M_admin->cek_login("users", $where)->num_rows();

        if($cek > 0) {
            $user_data = $this->M_admin->cek_login("users", $where)->row_array();
            $data_session = array(
                'nama'   => $user,
                'status' => "login",
                'role'   => $user_data['role'],
                'role_id' => $user_data['role_id'] ?? null,
                'nama_lengkap' => $user_data['full_name'],
            );
            $this->session->set_userdata($data_session);
            redirect(base_url("index.php/admin/dashboard"));
        } else {
            $this->session->set_flashdata('pesan', 'Username atau Password yang Anda masukkan salah!');
            redirect(base_url("index.php/admin"));
        }
    }

    public function dashboard() {
    // 1. Cek Login
    if($this->session->userdata('status') != "login") {
        redirect(base_url("index.php/admin"));
    }

    // 2. Load Layout
    $this->load->view('admin/layout/V_Header');
    $this->load->view('admin/layout/V_Sidebar');
    $this->load->view('admin/admin/V_Admin'); // Isi dashboard Anda
    $this->load->view('admin/layout/V_Footer');
}

    public function manajemen_menu() {
    if($this->session->userdata('status') != "login") {
        redirect(base_url("index.php/admin"));
    }

    $this->load->model('M_Rbac');
    $data['roles'] = $this->M_Rbac->get_roles();
    $data['features'] = $this->M_Rbac->get_features();
    $role_id = (int) $this->input->get('role_id');
    if (!$role_id && !empty($data['roles'])) {
        $role_id = (int) $data['roles'][0]['id'];
    }
    $data['selected_role_id'] = $role_id;
    $data['permissions'] = $role_id ? $this->M_Rbac->get_permissions($role_id) : [];
    
    // Kirim data ke View
    $this->load->view('admin/layout/V_Header');
    $this->load->view('admin/layout/V_Sidebar');
    $this->load->view('admin/menu/V_Menu', $data);
    $this->load->view('admin/layout/V_Footer');
}

public function simpan_hak_akses() {
    if($this->session->userdata('status') != "login") {
        redirect(base_url("index.php/admin"));
    }

    $role_id = (int) $this->input->post('role_id');
    $role = $this->db->get_where('roles', ['id' => $role_id])->row_array();
    if (!$role_id || !$role) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Role tidak valid.</div>');
        redirect(base_url('index.php/admin/manajemen_menu'));
    }

    $this->load->model('M_Rbac');
    $permissions = $this->input->post('permissions');
    $permissions = is_array($permissions) ? $permissions : [];
    $this->M_Rbac->save_permissions($role_id, $permissions);

    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Hak akses untuk <strong>'.html_escape($role['role_name']).'</strong> berhasil disimpan.</div>');
    redirect(base_url('index.php/admin/manajemen_menu?role_id='.$role_id));
}

public function tambah_menu_aksi() {
    // 1. Ambil data dari input form
    $menu_name  = $this->input->post('menu_name');
    $menu_link  = $this->input->post('menu_link');
    $menu_order = $this->input->post('menu_order');
    $is_active  = $this->input->post('is_active');

    // 2. Bungkus dalam array (key harus sama dengan nama kolom di database)
    $data = array(
        'menu_name'  => $menu_name,
        'menu_link'  => $menu_link,
        'menu_order' => $menu_order,
        'is_active'  => $is_active,
        'parent_id'  => 0 // Default 0 jika tidak digunakan
    );

    // 3. Panggil M_crud untuk simpan ke tabel 'menus'
    $this->load->model('M_crud');
    $this->M_crud->input_data('menus', $data);

    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Menu baru berhasil ditambahkan!</div>');

    // 4. Kembali ke halaman manajemen menu
    redirect(base_url('index.php/admin/manajemen_menu'));
}

public function edit_menu_aksi() {
    $id = $this->input->post('id');
    $data = array(
        'menu_name'  => $this->input->post('menu_name'),
        'menu_link'  => $this->input->post('menu_link'),
        'menu_order' => $this->input->post('menu_order'),
        'is_active'  => $this->input->post('is_active')
    );

    $where = array('id' => $id);
    $this->load->model('M_crud');
    $this->M_crud->update_data($where, $data, 'menus');

    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data menu berhasil diupdate!</div>');
    redirect(base_url('index.php/admin/manajemen_menu'));
}

public function hapus_menu($id) {
    $where = array('id' => $id);
    $this->load->model('M_crud');
    $this->M_crud->hapus_data($where, 'menus');

    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Data menu berhasil dihapus!</div>');
    redirect(base_url('index.php/admin/manajemen_menu'));
}

public function toggle_frontend($id) {
    $menu = $this->db->get_where('menus', ['id' => $id])->row_array();
    if ($menu) {
        $new_val = ($menu['is_frontend'] == 1) ? 0 : 1;
        $this->db->where('id', $id)->update('menus', ['is_frontend' => $new_val]);
        $label = ($new_val == 1) ? 'ditampilkan' : 'disembunyikan';
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Menu <strong>'.$menu['menu_name'].'</strong> berhasil '.$label.' dari navbar depan.</div>');
    }
    redirect(base_url('index.php/admin/manajemen_menu'));
}

// ============================================
// MODUL KATEGORI ARTIKEL
// ============================================

public function master_kategori() {
    if($this->session->userdata('status') != "login") {
        redirect(base_url("index.php/admin"));
    }

    $this->load->model('M_Kategori');
    $data['all_kategori'] = $this->M_Kategori->get_all();
    
    $this->load->view('admin/layout/V_Header');
    $this->load->view('admin/layout/V_Sidebar');
    $this->load->view('admin/master_data/kategori/V_Kategori', $data);
    $this->load->view('admin/layout/V_Footer');
}

public function tambah_kategori_aksi() {
    $data = array(
        'nama_kategori' => $this->input->post('nama_kategori'),
        'slug_kategori' => $this->input->post('slug_kategori')
    );

    $this->load->model('M_crud');
    $this->M_crud->input_data('kategori', $data);

    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Kategori baru berhasil ditambahkan!</div>');
    redirect(base_url('index.php/admin/master_kategori'));
}

public function edit_kategori_aksi() {
    $id = $this->input->post('id_kategori');
    $data = array(
        'nama_kategori' => $this->input->post('nama_kategori'),
        'slug_kategori' => $this->input->post('slug_kategori')
    );

    $where = array('id_kategori' => $id);
    $this->load->model('M_crud');
    $this->M_crud->update_data($where, $data, 'kategori');

    $this->session->set_flashdata('pesan', '<div class="alert alert-success">Kategori berhasil diupdate!</div>');
    redirect(base_url('index.php/admin/master_kategori'));
}

public function hapus_kategori($id) {
    $where = array('id_kategori' => $id);
    $this->load->model('M_crud');
    $this->M_crud->hapus_data($where, 'kategori');

    $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Kategori berhasil dihapus!</div>');
    redirect(base_url('index.php/admin/master_kategori'));
}

public function registrasi_aksi() {
    $username  = $this->input->post('username');
    $full_name = $this->input->post('full_name');
    $password  = $this->input->post('password');
    $confirm   = $this->input->post('confirm_password');
    $role_id   = (int) $this->input->post('role_id');
    $role_data = $this->db->get_where('roles', ['id' => $role_id])->row_array();
    $role      = $role_data ? $role_data['role_name'] : '';

    if (!$role_id || !$role_data) {
        $this->session->set_flashdata('pesan', 'Kategori user tidak valid.');
        redirect(base_url('index.php/admin'));
    }

    // Validasi password cocok
    if ($password !== $confirm) {
        $this->session->set_flashdata('pesan', 'Konfirmasi password tidak cocok!');
        redirect(base_url('index.php/admin'));
    }

    // Cek username sudah dipakai
    $cek = $this->db->get_where('users', ['username' => $username])->num_rows();
    if ($cek > 0) {
        $this->session->set_flashdata('pesan', 'Username <strong>'.$username.'</strong> sudah digunakan. Pilih username lain.');
        redirect(base_url('index.php/admin'));
    }

    // Simpan user baru
    $data = [
        'username'  => $username,
        'full_name' => $full_name,
        'password'  => $password, // Plain text (sesuai sistem yang ada)
        'role'      => $role,
        'role_id'   => $role_id,
        'is_active' => 1,
    ];
    $this->db->insert('users', $data);

    $this->session->set_flashdata('sukses', 'Akun <strong>'.$full_name.'</strong> berhasil didaftarkan! Silakan login.');
    redirect(base_url('index.php/admin'));
}

public function logout() {
    $this->session->sess_destroy();
    redirect(base_url('index.php/admin'));
}
}