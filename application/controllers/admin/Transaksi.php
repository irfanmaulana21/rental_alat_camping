<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('login')){
            redirect('admin/login');
        }

        $this->load->model('Transaksi_model');
    }

    // KONFIRMASI SEWA
    public function index()
    {
        $data['transaksi']=$this->Transaksi_model->getMenunggu();

        $this->load->view('admin/transaksi',$data);
    }

    // HISTORY
    public function history()
    {
        $data['history']=$this->Transaksi_model->getHistory();

        $this->load->view('admin/history_transaksi',$data);
    }

    // SETUJUI
    public function setujui($id)
    {
        $this->Transaksi_model->setujui($id);

        redirect('admin/transaksi');
    }

    // TOLAK
    public function tolak($id)
    {
        $this->Transaksi_model->tolak($id);

        redirect('admin/transaksi');
    }

}