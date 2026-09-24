<?php
class M_Sosmed extends CI_Model {
    public function get_all() {
        return $this->db->get('sosmed')->result_array();
    }
    public function simpan($data) { 
        return $this->db->insert('sosmed', $data); 
    }
    public function update($id, $data) {
        $this->db->where('id_sosmed', $id);
        return $this->db->update('sosmed', $data);
    }
    public function hapus($id) { 
        $this->db->where('id_sosmed', $id);
        return $this->db->delete('sosmed'); 
    }
}
