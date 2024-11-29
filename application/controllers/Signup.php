<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('v_signup');
    }

    public function register()
    {
        $username = $this->input->post('signup-name');
        $email = $this->input->post('signup-email');
        $password = $this->input->post('signup-password');

        // $password = password_hash($this->input->post('signup-password'), PASSWORD_DEFAULT);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => 'user'
        ];

        $this->m_user->insert_user($data);

        $this->session->set_flashdata('success', 'Akun berhasil dibuat! Silakan login.');
        redirect('login');
    }

    public function check_username() {
        $username = $this->input->post('username'); 
    
        $this->load->model('m_user'); 
    
        $is_exist = $this->m_user->is_username_exist($username);
    
        if ($is_exist) {
            echo json_encode(['status' => 'exists']);
        } else {
            echo json_encode(['status' => 'available']);
        }
    }

    public function check_email() {
        $email = $this->input->post('email');
    
        $query = $this->db->get_where('users', ['email' => $email]);
    
        if ($query->num_rows() > 0) {
            echo json_encode(['status' => 'exists']);
        } else {
            echo json_encode(['status' => 'available']);
        }
    }
    
    
    
}
