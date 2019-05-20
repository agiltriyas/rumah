<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tools extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim|min_length[3]');


        if ($this->form_validation->run() == false) {
            $sesdata = $this->session->userdata('email');
            $data['sesdata'] = $this->db->get_where('user', ['email' => $sesdata])->row_array();
            $data['title'] = "Menu";
            $this->load->view('template/user_header', $data);
            $this->load->view('template/user_sidebar', $data);
            $this->load->view('template/user_top');
            $this->load->view('tools/menu');
            $this->load->view('template/user_footer');
        } else {
            $postMenu = htmlspecialchars($this->input->post('menu', TRUE));
            $getMenu = $this->db->get_where('user_menu', ['menu' => $postMenu])->row_array();

            if ($getMenu) {
                $this->session->set_flashdata('message', '<div class="alert alert-success col-lg-6" role="alert">
                Menu already set.</div>');
                redirect('Tools');
            } else {

                $data = [
                    "menu" => $postMenu
                ];
                $this->db->insert('user_menu', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success col-lg-4" role="alert">
                Menu added.</div>');
                redirect('Tools');
            }
        }
    }

    public function deleteMenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success col-lg-4" role="alert">
        Menu Deleted.</div>');
        redirect('Tools');
    }

    public function getMenu()
    {
        $id2 = $this->input->post('id');
        $result = $this->db->get_where('user_menu', ['id' => $id2])->row_array();
        echo json_encode($result);
    }
    public function editMenu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim|min_length[3]');

        if ($this->form_validation->run() == TRUE) {
            # code...
            $id = $this->input->post('id');
            $data = [
                'menu' => $this->input->post('menu')
            ];
            $this->db->update('user_menu', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-lg-4" role="alert">
        Menu Updated.</div>');
            redirect('Tools');
        } else {
            $a = form_error('menu');
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            ' . $a . '</div>');
            redirect('Tools');
        }
    }

    public function subMenu()
    {

        $this->form_validation->set_rules('subTitle', 'Title', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('subIcon', 'Icon', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('subUrl', 'Url', 'required|trim|min_length[3]');

        if ($this->form_validation->run() == false) {

            $sesdata = $this->session->userdata('email');
            $data['sesdata'] = $this->db->get_where('user', ['email' => $sesdata])->row_array();
            $data['title'] = "Sub Menu";
            $this->load->view('template/user_header', $data);
            $this->load->view('template/user_sidebar', $data);
            $this->load->view('template/user_top');
            $this->load->view('tools/submenu');
            $this->load->view('template/user_footer');
        } else {
            $menu = (int)$this->input->post('menuId');
            $subTitle = htmlspecialchars($this->input->post('subTitle', TRUE));
            $subIcon = htmlspecialchars($this->input->post('subIcon', TRUE));
            $subUrl = htmlspecialchars($this->input->post('subUrl', TRUE));
            $isAct = htmlspecialchars($this->input->post('isAct', TRUE));
            if ($isAct == "") $isAct = "0";
            $data = [
                'menu_id' => $menu,
                'title' => $subTitle,
                'icon' => $subIcon,
                'url' => $subUrl,
                'is_active' => $isAct
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-lg-4" role="alert">
                Sub Menu added.</div>');
            redirect('Tools/subMenu');
        }
    }

    public function deleteSubMenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success col-lg-4" role="alert">
        Sub Menu Deleted.</div>');
        redirect('Tools/subMenu');
    }

    public function getSubMenu()
    {
        $id = $this->input->post('id');

        $query = "SELECT `user_menu`.`menu`,`user_sub_menu`.*
        FROM `user_sub_menu` JOIN `user_menu`
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        WHERE `user_sub_menu`.`id` = $id
        ";
        $result = $this->db->query($query)->row_array();
        echo json_encode($result);
    }

    public function editSubMenu()
    {
        $this->form_validation->set_rules('subTitle', 'Title', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('subIcon', 'Icon', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('subUrl', 'Url', 'required|trim|min_length[3]');

        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id');
            $menuId = (int)$this->input->post('menuId');
            $subTitle = htmlspecialchars($this->input->post('subTitle', TRUE));
            $subIcon = htmlspecialchars($this->input->post('subIcon', TRUE));
            $subUrl = htmlspecialchars($this->input->post('subUrl', TRUE));
            $isAct = htmlspecialchars($this->input->post('isAct', TRUE));
            if ($isAct == "") $isAct = "0";
            $data = [
                'menu_id' => $menuId,
                'title' => $subTitle,
                'icon' => $subIcon,
                'url' => $subUrl,
                'is_active' => $isAct
            ];
            $this->db->update('user_sub_menu', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success col-lg-6" role="alert">
        Sub Menu Updated.</div>');
            redirect('Tools/subMenu');
        } else { }
    }

    public function accessMenu()
    {
        $sesdata = $this->session->userdata('email');
        $data['sesdata'] = $this->db->get_where('user', ['email' => $sesdata])->row_array();
        $data['title'] = "Access Menu";
        $this->load->view('template/user_header', $data);
        $this->load->view('template/user_sidebar', $data);
        $this->load->view('template/user_top');
        $this->load->view('tools/accessmenu');
        $this->load->view('template/user_footer');

        $menuId = (int)$this->input->post('menuId');
        $roleId = (int)$this->input->post('roleId');


        $data = [
            'menu_id' => $menuId,
            'role_id' => $roleId
        ];

        $this->db->insert('user_access_menu', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success col-lg-6" role="alert">
        Sub Menu Updated.</div>');
        redirect('Tools/subMenu');
    }
}
