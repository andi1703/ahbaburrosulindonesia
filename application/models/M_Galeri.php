<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Galeri extends CI_Model {

    public function get_all() {
        $this->db->order_by('id_galeri', 'DESC');
        return $this->db->get('galeri')->result_array();
    }

    public function simpan($data) {
        return $this->db->insert('galeri', $data);
    }

    public function hapus($id) {
        $this->db->where('id_galeri', $id);
        return $this->db->delete('galeri');
    }

    public function get_by_id($id) {
        return $this->db->get_where('galeri', ['id_galeri' => $id])->row_array();
    }
}
