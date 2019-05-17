<?php

function is_logged_in()
{
    //instansiasi CI
    $ci = get_instance();

    // dapetin Role ID
    $roleId = $ci->session->userdata('role_id');

    // dapetin menu ID
    $menuSeg = $ci->uri->segment(1);
    $menuId = $ci->db->get_where('user_menu', ['menu' => $menuSeg])->row_array();

    $accMenu = $ci->db->get_where('user_access_menu', [
        'menu_id' => $menuId['id'],
        'role_id' => $roleId
    ]);

    if ($accMenu->num_rows() < 1) {
        # code...
        redirect('auth/blocked');
    }
}
