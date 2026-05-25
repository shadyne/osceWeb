<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        if ($this->user()) {
            redirect($this->user()['role'] === 'penguji' ? 'penguji' : 'peserta');
        }

        if ($this->input->method() === 'post') {
            $username = trim($this->input->post('username', true));
            $password = (string) $this->input->post('password', true);

            $user = $this->User_model->find_by_username($username);
            if ($user && $user['is_active'] && $this->verify_password($password, $user['password'])) {
                unset($user['password']);
                $this->session->set_userdata('user', $user);
                redirect($user['role'] === 'penguji' ? 'penguji' : 'peserta');
            }

            $this->session->set_flashdata('error', 'Username atau password salah.');
            redirect('login');
        }

        $this->load->view('auth/login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    private function verify_password($plain, $hash)
    {
        return password_verify($plain, $hash);
    }
}
