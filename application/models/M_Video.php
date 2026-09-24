<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Video extends CI_Model {

    public function get_all() {
        $this->db->order_by('tanggal_input', 'DESC');
        return $this->db->get('video')->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where('video', ['id_video' => $id])->row_array();
    }

    public function simpan($data) {
        return $this->db->insert('video', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_video', $id);
        return $this->db->update('video', $data);
    }

    public function hapus($id) {
        $this->db->where('id_video', $id);
        return $this->db->delete('video');
    }
}
