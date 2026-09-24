<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('check_access')) {
    function check_access($role, $id_menu) {
        $ci = get_instance();
        $result = $ci->db->get_where('user_access_menu', [
            'role' => $role,
            'id_menu' => $id_menu
        ]);

        if ($result->num_rows() > 0) {
            return "checked='checked'";
        }
        return "";
    }
}

if (!function_exists('has_access')) {
    function has_access($menu_link) {
        $ci = get_instance();
        $role = $ci->session->userdata('role');
            $role_id = (int) $ci->session->userdata('role_id');
        
        // Super Admin bypass semua akses
        if ($role == 'Super Admin') {
            return true;
        }

        // Kompatibilitas akun administrator lama sebelum role_id diterapkan.
        if (strtolower((string) $role) === 'admin' && in_array($menu_link, ['back_role', 'back_user'], true)) {
            return true;
        }

            if ($role_id) {
                $feature = $ci->db->get_where('features', ['feature_slug' => $menu_link])->row_array();
                if ($feature) {
                    $permission = $ci->db->get_where('role_permissions', [
                        'role_id' => $role_id,
                        'feature_id' => $feature['id']
                    ])->row_array();
                    return !empty($permission['can_read']);
                }
            }

        // Cari id menu berdasarkan menu_link
        $menu = $ci->db->get_where('menus', ['menu_link' => $menu_link])->row_array();
        
        if ($menu) {
            // Cek apakah role ini punya akses ke id_menu tersebut
            $akses = $ci->db->get_where('user_access_menu', [
                'role' => $role,
                'id_menu' => $menu['id']
            ]);
            return $akses->num_rows() > 0;
        }
        
        // Jika menu belum ditambahkan ke SMC, default false (disembunyikan)
        return false;
    }
}
