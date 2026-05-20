<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // proteksi login
        if (!$this->session->userdata('login')) {
            redirect('pelanggan/login');
        }
    }

    public function index()
    {
        $this->load->view('pelanggan/home');
    }
}