<?php
class M_Slider extends CI_Model {
    public function get_all() {
        $this->db->order_by('urutan', 'ASC');
        return $this->db->get('slider')->result_array();
    }
    public function get_by_id($id) {
        return $this->db->get_where('slider', ['id_slider' => $id])->row_array();
    }
    public function simpan($data) { 
        return $this->db->insert('slider', $data); 
    }
    public function update($id, $data) {
        $this->db->where('id_slider', $id);
        return $this->db->update('slider', $data);
    }
    public function hapus($id) { 
        $this->db->where('id_slider', $id);
        return $this->db->delete('slider'); 
    }
}
