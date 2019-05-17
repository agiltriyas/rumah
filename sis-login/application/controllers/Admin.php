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
        if ($this->session->has_userdata('email')) {
            $sesdata = $this->session->userdata('email');
            $data['sesdata'] = $this->db->get_where('user', ['email' => $sesdata])->row_array();
            $data['title'] = "Dashboard";
            $this->load->view('template/user_header', $data);
            $this->load->view('template/user_sidebar', $data);
            $this->load->view('template/user_top');
            $this->load->view('admin/index', $data);
            $this->load->view('template/user_footer');
            # code...
        } else {
            redirect('auth');
        }
    }
}
