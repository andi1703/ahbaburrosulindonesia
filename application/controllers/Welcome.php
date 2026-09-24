<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        // 1. Load Model
        $this->load->model('Menu_model');
        
        // 2. Ambil data dari database dan simpan ke dalam array $data
        // Pastikan key-nya adalah 'menus' agar bisa dipanggil sebagai $menus di View
        $data['menus'] = $this->Menu_model->get_all_menus();
        
        // 3. Kirim array $data ke view
        // JANGAN LUPA menambahkan $data di sini
        $this->load->view('welcome_message', $data);
    }
}