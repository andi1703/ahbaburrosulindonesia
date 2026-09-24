<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Rbac extends CI_Model {
    public function get_roles() {
        return $this->db->order_by('role_name', 'ASC')->get('roles')->result_array();
    }

    public function get_features() {
        return $this->db->order_by('feature_name', 'ASC')->get('features')->result_array();
    }

    public function get_permissions($role_id) {
        $rows = $this->db->get_where('role_permissions', ['role_id' => (int) $role_id])->result_array();
        $permissions = [];
        foreach ($rows as $row) {
            $permissions[(int) $row['feature_id']] = $row;
        }
        return $permissions;
    }

    public function save_permissions($role_id, $permissions) {
        $role_id = (int) $role_id;
        $this->db->trans_start();
        $this->db->where('role_id', $role_id)->delete('role_permissions');

        $rows = [];
        foreach ($permissions as $feature_id => $permission) {
            $rows[] = [
                'role_id' => $role_id,
                'feature_id' => (int) $feature_id,
                'can_read' => !empty($permission['read']) ? 1 : 0,
                'can_create' => !empty($permission['create']) ? 1 : 0,
                'can_update' => !empty($permission['update']) ? 1 : 0,
                'can_delete' => !empty($permission['delete']) ? 1 : 0
            ];
        }

        if ($rows) {
            $this->db->insert_batch('role_permissions', $rows);
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
