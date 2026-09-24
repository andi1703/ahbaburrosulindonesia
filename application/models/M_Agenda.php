<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Agenda extends CI_Model {

    public function get_all() {
        // Urutkan: yang akan datang dulu, lalu selesai
        $this->db->order_by('tanggal', 'ASC');
        $this->db->order_by('jam', 'ASC');
        return $this->db->get('agenda')->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where('agenda', ['id_agenda' => $id])->row_array();
    }

    public function simpan($data) {
        return $this->db->insert('agenda', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_agenda', $id);
        return $this->db->update('agenda', $data);
    }

    public function hapus($id) {
        $this->db->where('id_agenda', $id);
        return $this->db->delete('agenda');
    }
}
