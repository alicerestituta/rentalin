<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->library('session');
    }

    public function index()
    {
        if (!empty($this->session->user_id)) {
            if ($this->session->role === 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('user/dashboard');
            }
        } else {
            $this->load->view('v_login');
        }
    }

    public function error_page()
    {
        $this->load->view('errors/html/error_404');
    }

    public function authenticate()
    {
        $username = $this->input->post('signin-username');
        $password = $this->input->post('signin-password');

        $user = $this->m_user->get_user_by_username($username);

        if (!$user) {
            $this->session->set_flashdata('error', 'Username tidak ditemukan');
            redirect('login');
        } else {
            if (($password == $user->password)) {
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('username', $user->username);
                $this->session->set_userdata('role', $user->role);

                if ($user->role === 'admin') {
                    redirect('admin/dashboard');
                } else {
                    redirect('user/dashboard');
                }
            } else {
                $this->session->set_flashdata('error', 'Password salah');
                redirect('login');
            }
        }
    }

    // public function reset_password()
    // {
    //     $email = $this->input->post('email');

    //     if (empty($email)) {
    //         echo json_encode(['success' => false, 'message' => 'Email tidak boleh kosong']);
    //         return;
    //     }

    //     $query = $this->db->get_where('users', ['email' => $email]);

    //     if ($query->num_rows() > 0) {
    //         $user = $query->row();
    //         $password = $user->password;

    //         $this->email->from('no-reply@yourdomain.com', 'Rentalin');
    //         $this->email->to($email);
    //         $this->email->subject('Password Reset');
    //         $this->email->message("Password anda adalah: $password");

    //         if ($this->email->send()) {
    //             echo json_encode(['success' => true, 'message' => 'Password Anda telah dikirim ke email Anda.']);
    //         } else {
    //             echo json_encode(['success' => false, 'message' => 'Gagal mengirim email.']);
    //         }
    //     } else {
    //         echo json_encode(['success' => false, 'message' => 'Email tidak ditemukan.']);
    //     }
    // }

    public function reset_password()
    {
        $email = $this->input->post('email');

        if (empty($email)) {
            echo json_encode(['success' => false, 'message' => 'Email tidak boleh kosong']);
            return;
        }

        $query = $this->db->get_where('users', ['email' => $email]);

        if ($query->num_rows() > 0) {
            $user = $query->row();
            $password = $user->password;
            $username = $user->username;

            $message = "
        <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 20px;
                    }
                    .email-container {
                        width: 100%;
                        max-width: 600px;
                        background-color: #ffffff;
                        margin: 0 auto;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                    }
                    .email-header {
                        text-align: center;
                        font-size: 24px;
                        color: #333;
                        margin-bottom: 20px;
                    }
                    .email-body {
                        font-size: 16px;
                        color: #555;
                        line-height: 1.5;
                    }
                    .email-footer {
                        text-align: center;
                        font-size: 14px;
                        color: #aaa;
                        margin-top: 20px;
                    }
                    .password-box {
                        font-size: 18px;
                        color: #ffffff;
                        background-color: #4CAF50;
                        padding: 15px;
                        border-radius: 5px;
                        text-align: center;
                        margin-top: 20px;
                    }
                </style>
            </head>
           <body>
                <div class='email-container'>
                    <div class='email-header'>
                        <h2>Permintaan Reset Kata Sandi</h2>
                    </div>
                    <div class='email-body'>
                        <p>Halo, $username</p>
                        <p>Kami menerima permintaan untuk mereset kata sandi akun Anda.</p>
                        <p>Jika Anda tidak melakukan permintaan ini, harap abaikan email ini. Jika Anda memang meminta reset, berikut adalah kata sandi Anda:</p>
                        <div class='password-box'>
                            <strong>Kata Sandi Anda: </strong>$password
                        </div>
                    </div>
                    <div class='email-footer'>
                        <p>Jika Anda memerlukan bantuan lebih lanjut, silakan hubungi tim dukungan kami.</p>
                        <p>&copy; 2024 Rentalin. Semua hak dilindungi.</p>
                    </div>
                </div>
            </body>
        </html>";

            $this->email->from('no-reply@yourdomain.com', 'Rentalin');
            $this->email->to($email);
            $this->email->subject('Password Reset');
            $this->email->message($message);
            $this->email->set_mailtype('html'); 

            if ($this->email->send()) {
                echo json_encode(['success' => true, 'message' => 'Password Anda telah dikirim ke email Anda.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal mengirim email.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Email tidak ditemukan.']);
        }
    }



    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
