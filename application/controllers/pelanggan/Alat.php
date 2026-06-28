<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // cek login
        if (!$this->session->userdata('login')) {
            redirect('pelanggan/login');
        }

        $this->load->model('Alat_model');
    }

    // HALAMAN UTAMA
    public function index()
    {
        $data = [
            'alat' => $this->Alat_model->getLimit(6, 0),
            'kategori' => $this->Alat_model->getKategori(),
            'activeKategori' => 0
        ];

        $this->load->view('pelanggan/alat', $data);
    }

    // FILTER KATEGORI
    public function filter($id_kategori = 0)
    {
        if ($id_kategori == 0) {
            $alat = $this->Alat_model->getLimit(6, 0);
        } else {
            $alat = $this->Alat_model->getByKategori($id_kategori);
        }

        $data = [
            'alat' => $alat,
            'kategori' => $this->Alat_model->getKategori(),
            'activeKategori' => $id_kategori
        ];

        $this->load->view('pelanggan/alat', $data);
    }

    // HALAMAN DETAIL ALAT
    public function detail($id = null)
    {
        if ($id === null) {
            show_404();
        }

        $alat = $this->Alat_model->getDetail($id);

        if (!$alat) {
            show_404();
        }

        $data = [
            'alat'     => $alat,
            'kategori' => $this->Alat_model->getKategori()
        ];

        $this->load->view('pelanggan/detail', $data);
    }

    //INFINITE SCROLL
    public function load_more($offset = 0)
    {
        $limit = 6;

        $alat = $this->Alat_model->getLimit($limit, $offset);

        if (empty($alat)) {
            return;
        }

        foreach ($alat as $a) {

            $img = base_url('assets/image/alat/' . $a->gambar);
            $harga = number_format($a->harga_sewa, 0, ',', '.');

            echo '
            <div class="card product-card" data-name="' . strtolower($a->nama_alat) . '">

                <div class="img-box">
                    <img src="' . $img . '" alt="' . $a->nama_alat . '">
                </div>

                <div class="card-body">
                    <h3>' . $a->nama_alat . '</h3>

                    <p class="price">
                        Rp ' . $harga . ' / hari
                    </p>

                    <a href="' . base_url('index.php/pelanggan/alat/detail/' . $a->id_alat) . '" class="btn-rent" style="text-decoration:none">
                        SEWA SEKARANG
                    </a>
                </div>

            </div>';
        }
    }
}