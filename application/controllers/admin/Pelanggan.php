<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('admin/login');
        }

        $this->load->model('Pelanggan_model');
    }

    public function index()
    {
        $data['pelanggan'] = $this->Pelanggan_model->getAll();

        $this->load->view('admin/pelanggan', $data);
    }

    public function delete($id)
    {
        $this->Pelanggan_model->delete($id);

        redirect('admin/pelanggan');
    }
}