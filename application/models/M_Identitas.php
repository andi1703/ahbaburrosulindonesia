<?php
class M_Identitas extends CI_Model {
    
    public function get_all() {
        $this->db->order_by('id_identitas', 'ASC');
        return $this->db->get('identitas')->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where('identitas', ['id_identitas' => $id])->row_array();
    }

    public function simpan_data($data) {
        return $this->db->insert('identitas', $data);
    }

    public function update_data($id, $data) {
        $this->db->where('id_identitas', $id);
        return $this->db->update('identitas', $data);
    }

    public function hapus_data($id) {
        $this->db->where('id_identitas', $id);
        return $this->db->delete('identitas');
    }
}
