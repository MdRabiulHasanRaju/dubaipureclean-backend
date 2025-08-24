<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
    }

    // Register Page
    // public function register() {
    //     if ($this->input->post()) {
    //         $data = [
    //             'username' => $this->input->post('username'),
    //             'email'    => $this->input->post('email'),
    //             'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
    //         ];
    //         $this->Auth_model->insert($data);
    //         redirect('auth/login');
    //     } else {
    //         $this->load->view('register');
    //     }
    // }

    // Login Page
    public function login() {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->Auth_model->get_by_email($email);

            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('username', $user->username);
                redirect('admin');
            } else {
                $data['error'] = "Invalid email or password";
                $this->load->view('admin/pages/auth/login', $data);
            }
        } else {
            $this->load->view('admin/pages/auth/login');
        }
    }


    // Logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/auth_admin/login');
    }
}
