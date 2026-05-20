<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('Alat_model'); 

        $is_login = $this->session->userdata('login');
        $role     = $this->session->userdata('role');

        if (!$is_login || $role !== 'admin') {
            redirect('auth/login');
            exit;
        }
    }

    public function index()
    {
        $data = [
            'username' => $this->session->userdata('username'),

            //TATISTIK DASHBOARD
            'total_alat' => $this->Alat_model->countAll(),
            'total_kategori' => $this->Alat_model->countKategori(),
            'alat_tersedia' => $this->Alat_model->countTersedia(),
        ];

        $this->load->view('admin/dashboard', $data);
    }

    public function dashboard()
    {
        $data['total_alat'] = $this->Admin_model->countAlat();
        $data['total_kategori'] = $this->Admin_model->countKategori();
        $data['alat_tersedia'] = $this->Admin_model->countTersedia();

        $this->load->view('admin/pages/dashboard_content', $data);
    }

    
}