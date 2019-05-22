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
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]');

        $sesdata = $this->session->userdata('email');
        $data['sesdata'] = $this->db->get_where('user', ['email' => $sesdata])->row_array();
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Edit Profile";
            $this->load->view('template/user_header', $data);
            $this->load->view('template/user_sidebar');
            $this->load->view('template/user_top');
            $this->load->view('user/edit', $data);
            $this->load->view('template/user_footer');
            # code...
        } else {
            $file = $_FILES['picture'];

            if ($file['name']) {
                $config['upload_path'] = './asets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('picture')) {
                    $newImage = $this->upload->data('file_name');
                    $oldImage = $data['sesdata']['image'];
                    $this->db->set('image', $newImage);

                    if ($oldImage != "default.jpg") {
                        unlink(FCPATH . 'asets/img/profile/' . $oldImage);
                    }
                } else {
                    $error = $this->upload->display_errors('<div class="alert alert-danger role="alert">', '</div>');
                    $this->session->set_flashdata('message', $error);
                    redirect('user/edit');
                };
            }

            $email = $this->input->post('email');
            $nama = htmlspecialchars($this->input->post('nama', TRUE));

            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your Account has been updated.</div>');
            redirect('user/edit');
        }
    }

    public function changePass()
    {
        $this->form_validation->set_rules('cPass', 'Current Password', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('nPass', 'New Password', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('nPass2', 'Confirm Password', 'required|trim|min_length[3]|matches[nPass]');


        $sesdata = $this->session->userdata('email');
        $data['sesdata'] = $this->db->get_where('user', ['email' => $sesdata])->row_array();
        $data['title'] = "Change Password";
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/user_header', $data);
            $this->load->view('template/user_sidebar');
            $this->load->view('template/user_top');
            $this->load->view('user/change', $data);
            $this->load->view('template/user_footer');
        } else {
            $cPass = $this->input->post('cPass');
            $nPass = $this->input->post('nPass2');
            $nPass_hash = password_hash($nPass, PASSWORD_DEFAULT);
            if (password_verify($cPass, $data['sesdata']['password'])) {

                if ($cPass == $nPass) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password not be the same</div>');
                    redirect('user/changePass');
                } else {
                    $this->db->set('password', $nPass_hash);
                    $this->db->where('email', $data['sesdata']['email']);
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has changed</div>');
                    redirect('user/changePass');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Current Password Invalid</div>');
                redirect('user/changePass');
            }
        }
    }
}
