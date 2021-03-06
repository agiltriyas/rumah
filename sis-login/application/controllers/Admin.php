<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        is_logged_in();
    }
    public function index()
    {
        $sesdata = $this->session->userdata('email');
        $data['sesdata'] = $this->db->get_where('user', ['role_id' => 2])->num_rows();
        $data['title'] = "Dashboard";
        $this->load->view('template/user_header', $data);
        $this->load->view('template/user_sidebar', $data);
        $this->load->view('template/user_top');
        $this->load->view('admin/index', $data);
        $this->load->view('template/user_footer');
        # code...

    }

    public function roleAccess()
    {
        $sesdata = $this->session->userdata('email');
        $data['sesdata'] = $this->db->get_where('user', ['email' => $sesdata])->row_array();
        $data['title'] = "Role Access";
        $this->load->view('template/user_header', $data);
        $this->load->view('template/user_sidebar', $data);
        $this->load->view('template/user_top');
        $this->load->view('admin/role-access');
        $this->load->view('template/user_footer');
    }

    public function accessMenu($role_id)
    {
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $sesdata = $this->session->userdata('email');
        $data['sesdata'] = $this->db->get_where('user', ['email' => $sesdata])->row_array();
        $data['title'] = "Role Access";
        $this->load->view('template/user_header', $data);
        $this->load->view('template/user_sidebar', $data);
        $this->load->view('template/user_top');
        $this->load->view('admin/access-menu', $data);
        $this->load->view('template/user_footer');
    }

    public function setMenu()
    {
        $role = $this->input->post('role');
        $menu = $this->input->post('menu');

        $result = $this->db->get_where('user_access_menu', [
            'role_id' => $role,
            'menu_id' => $menu
        ]);

        if ($result->num_rows() == 1) {
            $this->db->delete('user_access_menu', [
                'role_id' => $role,
                'menu_id' => $menu
            ]);
        } else {
            $this->db->insert('user_access_menu', [
                'role_id' => $role,
                'menu_id' => $menu
            ]);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success col-lg-6" role="alert">
        Role menu changed.</div>');
    }
}
