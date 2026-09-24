<?php
class M_Kategori extends CI_Model {
    public function get_all() {
        return $this->db->get('kategori')->result_array();
    }
}
