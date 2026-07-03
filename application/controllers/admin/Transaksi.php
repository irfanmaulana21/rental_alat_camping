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

    // KELOLA TRANSAKSI
    public function index()
    {
        $data['transaksi']=$this->Transaksi_model->getAktif();

        $this->load->view('admin/transaksi',$data);
    }

    // HISTORY
    public function history()
    {
        $data['history']=$this->Transaksi_model->getHistory();

        $this->load->view('admin/history_transaksi',$data);
    }

    // CETAK STRUK
    public function struk($id)
    {
        $trx = $this->Transaksi_model->getById($id);
        if(!$trx) show_404();

        $data['trx']    = $trx;
        $data['detail'] = $this->Transaksi_model->getDetail($id);

        $this->load->view('admin/struk', $data);
    }

    // SETUJUI
    public function setujui($id)
    {
        $this->Transaksi_model->setujui($id);

        $this->session->set_flashdata('success', 'Transaksi disetujui.');
        redirect('admin/transaksi');
    }

    // TANDAI DIAMBIL
    public function diambil($id)
    {
        $this->Transaksi_model->tandaiDiambil($id);

        $this->session->set_flashdata('success', 'Barang ditandai sudah diambil.');
        redirect('admin/transaksi');
    }

    // TOLAK
    public function tolak($id)
    {
        $this->Transaksi_model->tolak($id);

        $this->session->set_flashdata('success', 'Transaksi ditolak, stok dikembalikan.');
        redirect('admin/transaksi');
    }

}