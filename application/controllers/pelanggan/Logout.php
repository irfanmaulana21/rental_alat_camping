<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function index()
    {
        // hapus semua session
        $this->session->sess_destroy();

        // redirect ke login pelanggan
        redirect('pelanggan/login');
    }
}