<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form']);
    }

    protected function user()
    {
        return $this->session->userdata('user');
    }

    protected function require_login($role = null)
    {
        $u = $this->user();
        if (!$u) {
            redirect('login');
        }
        if ($role && $u['role'] !== $role) {
            show_error('Akses ditolak: halaman ini khusus untuk ' . $role . '.', 403);
        }
    }

    protected function view($view, $data = [])
    {
        $data['user']  = $this->user();
        $data['flash'] = [
            'success' => $this->session->flashdata('success'),
            'error'   => $this->session->flashdata('error'),
        ];
        $data['judul']    = $data['judul']    ?? '';
        $data['subjudul'] = $data['subjudul'] ?? '';

        $this->load->view('layout/header', $data);
        $this->load->view($view, $data);
        $this->load->view('layout/footer', $data);
    }
}
