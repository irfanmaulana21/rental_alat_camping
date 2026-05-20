<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

    public function index()
    {
        // kalau pakai session login
        if (!$this->session->userdata('username')) {
            redirect('pelanggan/login');
        }

        $data['title'] = 'About CampRent';

        $this->load->view('pelanggan/about', $data);
       
        
    }
}