<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->has_userdata('email')) {
            $sesdata['sesdata'] = $this->session->userdata('email');
            $data['title'] = "Profile";
            $this->load->view('template/auth_header', $data);
            $this->load->view('user/adm', $sesdata);
            $this->load->view('template/auth_footer');
            # code...
        } else {
            redirect('auth');
        }
    }
}
