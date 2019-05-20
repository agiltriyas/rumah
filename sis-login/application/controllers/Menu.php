<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $sesdata = $this->session->userdata('email');
        $data['sesdata'] = $this->db->get_where('user', ['email' => $sesdata])->row_array();
        $data['title'] = "Menu Mgt";
        $this->load->view('template/user_header', $data);
        $this->load->view('template/user_sidebar');
        $this->load->view('template/user_top');
        $this->load->view('user/index', $data);
        $this->load->view('template/user_footer');
    }
}
