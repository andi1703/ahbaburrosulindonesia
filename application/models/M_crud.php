<?php
class M_crud extends CI_Model {
    public function get_data($table) {
        return $this->db->get($table);
    }
    
    public function input_data($table, $data) {
        $this->db->insert($table, $data);
    }
    public function update_data($where, $data, $table) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    
    public function hapus_data($where, $table) {
        $this->db->where($where);
        $this->db->delete($table);
    }
}