<?php
class M_admin extends CI_Model {
    // Fungsi login yang sudah ada
    public function cek_login($table, $where) {		
        return $this->db->get_where($table, $where);
    }

    // FUNGSI BARU: Mengambil semua data menu
    public function get_menus() {
        $this->db->order_by('menu_order', 'ASC');
        return $this->db->get('menus')->result_array();
    }
}