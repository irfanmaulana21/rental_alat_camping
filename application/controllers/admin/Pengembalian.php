<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('admin/login');
        }

        $this->load->model('Pengembalian_model');
    }

    // Halaman pengembalian sudah digabung ke Kelola Transaksi
    public function index()
    {
        redirect('admin/transaksi');
    }

    // Proses pengembalian (dipanggil dari modal di halaman Kelola Transaksi)
    public function proses($id)
    {
        $kondisi = $this->input->post('kondisi');

        if (!$kondisi) {
            $this->session->set_flashdata('error', 'Kondisi barang wajib dipilih.');
            redirect('admin/transaksi');
        }

        $ok = $this->Pengembalian_model->proses($id, $kondisi);

        if ($ok) {
            $this->session->set_flashdata('success', 'Pengembalian berhasil diproses.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memproses pengembalian.');
        }

        redirect('admin/transaksi');
    }
}