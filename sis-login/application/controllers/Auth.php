<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->session->has_userdata('email')) {
            # code...
            if ($this->session->userdata('role_id') == 1) {
                # code...
                redirect('admin');
            } else {
                # code...
                redirect('user');
            }
        }

        if ($this->form_validation->run() == false) {

            $data['title'] = "Form Login";
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('template/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');

        $result = $this->db->get_where('user', ['email' => $email])->row_array();

        //cek email dan password
        if ($email == $result['email'] && password_verify($pass, $result['password'])) {
            # code...
            // cek email active
            if ($result['is_active'] == 0) {
                # code...
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account has not been active, activation sent to your email.</div>');
                redirect('auth');
            } else {
                $data = [
                    "email" => $result['email'],
                    'role_id' => $result['role_id']
                ];
                $this->session->set_userdata($data);
                if ($result['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('user');
                }
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email or Password Invalid.</div>');
            redirect('auth');
        }
    }

    public function register()
    {
        if ($this->session->has_userdata('email')) {
            # code...
            if ($this->session->userdata('role_id') == 1) {
                # code...
                redirect('admin');
            } else {
                # code...
                redirect('user');
            }
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email already registered'
        ]);
        $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dosnt match!', 'min_length' => 'Password too sort'
        ]);
        $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Form Register";
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('template/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash(
                    $this->input->post('password2'),
                    PASSWORD_DEFAULT
                ),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            $token = base64_encode(random_bytes(32));

            $data_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $data_token);

            $this->_active($token, 'verify');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your Account has been Created, link activation has sent to your email.</div>');
            redirect('auth');
        }
    }

    private function _active($token, $type)
    {
        $config = [
            'protocol' =>  'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'agilsarana2@gmail.com',
            'smtp_pass' => 'saiyan123',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('Agilsarana2@gmail.com');
        $this->email->to($this->input->post('email'));
        if ($type == "verify") {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . $token . '">Activate</a>');
        } else {
            $this->email->subject('Forgot Password');
            $this->email->message('Click this link to reset your password <a href="' . base_url() . 'auth/verifypass?email=' . $this->input->post('email') . '&token=' . $token . '">Change It</a>');
        }

        if ($this->email->send()) {
            return TRUE;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $result = $this->db->get_where('user_token', [
            'email' => $email,
            'token' => $token
        ])->row_array();
        if ($result) {
            //bisa tambahkan sendiri expired token disini

            $this->db->set('is_active', 1);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->db->delete('user_token', ['email' => $email]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Account has been activated.</div>');
            redirect('auth');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Activation problems!.</div>');
            redirect('auth');
        }
    }

    public function verifypass()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $data['verify'] = $email;
        $result = $this->db->get_where('user_token', [
            'email' => $email,
            'token' => $token
        ])->row_array();
        if ($result) {
            $data['title'] = "Reset Password";
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/changepass', $data);
            $this->load->view('template/auth_footer');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Forgot password problems!.</div>');
            redirect('auth/forgotPass');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Your Account has been Logged Out.</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['title'] = "Forbidden";
        $this->load->view('auth/blocked', $data);
    }

    public function forgotPass()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Reset Password";
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/forgotpass');
            $this->load->view('template/auth_footer');
        } else {
            $email = htmlspecialchars($this->input->post('email', TRUE));
            $result = $this->db->get_where('user', ['email' => $email])->row_array();

            if ($result) {
                if ($email['is_active'] == 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your account yet activated.</div>');
                    redirect('auth/forgotPass');
                } else {
                    $token = base64_encode(random_bytes(32));
                    $data_token = [
                        'email' => $email,
                        'token' => $token,
                        'date_created' => time()
                    ];
                    $this->db->insert('user_token', $data_token);
                    $this->_active($token, 'forgot');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Reset password link has bent sent to your email.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your email is not registered as Account</div>');
                redirect('auth/forgotPass');
            }
        }
    }
    public function chpass()
    {
        $this->form_validation->set_rules('nPass', 'New Password', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('nPass2', 'Confirm Password', 'required|trim|min_length[3]|matches[nPass]');
        $email = $this->input->post('email');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Reset Password";
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/changepass');
            $this->load->view('template/auth_footer');
        } else {
            $nPass = $this->input->post('nPass2');
            $nPass_hash = password_hash($nPass, PASSWORD_DEFAULT);
            $this->db->set('password', $nPass_hash);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has Updated</div>');
            $this->db->delete('user_token', ['email' => $email]);
            redirect('auth');
        }
    }
}
