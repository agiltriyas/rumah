<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $data['sesdata'] = $this->db->get_where('user', ['email' => $sesdata])->row_array();
        $data['title'] = "My Profile";
        $this->load->view('template/user_header', $data);
        $this->load->view('template/user_sidebar');
        $this->load->view('template/user_top');
        $this->load->view('user/index', $data);
        $this->load->view('template/user_footer');
        # code...
    }

    public function edit()
    {

        $sesdata = $this->session->userdata('email');
        $data['sesdata'] = $this->db->get_where('user', ['email' => $sesdata])->row_array();
        $data['title'] = "My Profile";
        $this->load->view('template/user_header', $data);
        $this->load->view('template/user_sidebar');
        $this->load->view('template/user_top');
        $this->load->view('user/edit');
        $this->load->view('template/user_footer');
        # code...

    }
}
