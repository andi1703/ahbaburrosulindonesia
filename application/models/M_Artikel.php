<?php
class M_Artikel extends CI_Model {
    
    public function get_artikel_lengkap() {
        $this->db->select('artikel.*, kategori.nama_kategori');
        $this->db->from('artikel');
        $this->db->join('kategori', 'artikel.id_kategori = kategori.id_kategori', 'left');
        $this->db->order_by('artikel.tanggal_dibuat', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where('artikel', ['id_artikel' => $id])->row_array();
    }

    public function simpan_data($data) {
        return $this->db->insert('artikel', $data);
    }

    public function update_data($id, $data) {
        $this->db->where('id_artikel', $id);
        return $this->db->update('artikel', $data);
    }

    public function hapus_data($id) {
        $this->db->where('id_artikel', $id);
        return $this->db->delete('artikel');
    }
}
