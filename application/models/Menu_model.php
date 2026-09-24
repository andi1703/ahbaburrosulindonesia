<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function get_all_menus() {
        $this->db->order_by('menu_order', 'ASC');
        return $this->db->get_where('menus', array('is_active' => 1))->result_array();
    }

}