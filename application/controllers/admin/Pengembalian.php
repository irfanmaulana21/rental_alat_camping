<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller: Pengembalian (Admin)
 *
 * Menangani proses pengembalian alat camping yang sedang disewa:
 * - index()  : daftar transaksi berstatus "Disewa"
 * - proses() : form + simpan pengembalian untuk satu transaksi
 * - riwayat(): daftar semua pengembalian yang sudah diproses
 */
class Pengembalian extends CI_Controller
{
    // Denda keterlambatan per hari (Rupiah)
    const DENDA_PER_HARI = 5000;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengembalian_model');
        $this->load->library('form_validation');
        $this->load->helper(['url', 'form']);

        $is_login = $this->session->userdata('login');
        $role     = $this->session->userdata('role');

        if (!$is_login || $role !== 'admin') {
            redirect('admin/login');
            exit;
        }
    }

    /**
     * Daftar transaksi yang masih berstatus "Disewa" -> siap diproses pengembaliannya.
     */
    public function index()
    {
        $data['title']            = 'Pengembalian Alat Camping';
        $data['transaksi_disewa'] = $this->Pengembalian_model->get_transaksi_disewa();

        $this->load->view('admin/pengembalian/index', $data);
    }

    /**
     * Form proses pengembalian untuk satu transaksi (GET) + simpan (POST).
     */
    public function proses($id_transaksi = null)
    {
        if (empty($id_transaksi)) {
            show_404();
        }

        $transaksi = $this->Pengembalian_model->get_transaksi($id_transaksi);

        if (empty($transaksi)) {
            show_404();
        }

        if ($transaksi->status !== 'Disetujui' || $this->Pengembalian_model->is_sudah_dikembalikan($id_transaksi)) {
            $this->session->set_flashdata('error', 'Transaksi ini sudah diproses pengembaliannya atau belum berstatus Disetujui.');
            redirect('admin/pengembalian');
            return;
        }

        if ($this->input->method() === 'post') {
            $this->_simpan($transaksi);
            return;
        }

        $data['title']            = 'Proses Pengembalian';
        $data['transaksi']        = $transaksi;
        $data['detail_alat']      = $this->Pengembalian_model->get_detail_alat($id_transaksi);
        $data['tanggal_hari_ini'] = date('Y-m-d');
        $data['hari_telat']       = $this->_hitung_hari_telat($transaksi->tanggal_kembali, date('Y-m-d'));
        $data['estimasi_denda']   = $data['hari_telat'] * self::DENDA_PER_HARI;
        $data['denda_per_hari']   = self::DENDA_PER_HARI;

        $this->load->view('admin/pengembalian/proses', $data);
    }

    /**
     * Simpan data pengembalian (dipanggil dari proses() saat method POST).
     */
    private function _simpan($transaksi)
    {
        $this->form_validation->set_rules('tanggal_dikembalikan', 'Tanggal Dikembalikan', 'required');
        $this->form_validation->set_rules('kondisi_alat', 'Kondisi Alat', 'required');
        $this->form_validation->set_rules('denda', 'Denda', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $data['title']            = 'Proses Pengembalian';
            $data['transaksi']        = $transaksi;
            $data['detail_alat']      = $this->Pengembalian_model->get_detail_alat($transaksi->id_transaksi);
            $data['tanggal_hari_ini'] = date('Y-m-d');
            $data['hari_telat']       = $this->_hitung_hari_telat($transaksi->tanggal_kembali, date('Y-m-d'));
            $data['estimasi_denda']   = $data['hari_telat'] * self::DENDA_PER_HARI;
            $data['denda_per_hari']   = self::DENDA_PER_HARI;

            $this->load->view('admin/pengembalian/proses', $data);
            return;
        }

        $payload = [
            'id_transaksi'         => $transaksi->id_transaksi,
            'tanggal_dikembalikan' => $this->input->post('tanggal_dikembalikan', TRUE),
            'denda'                => (int) $this->input->post('denda', TRUE),
            'kondisi_alat'         => $this->input->post('kondisi_alat', TRUE),
            'catatan'              => $this->input->post('catatan', TRUE),
        ];

        $sukses = $this->Pengembalian_model->proses_pengembalian($payload);

        if ($sukses) {
            $this->session->set_flashdata('success', 'Pengembalian alat berhasil diproses.');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memproses pengembalian.');
        }

        redirect('admin/pengembalian');
    }

    /**
     * Riwayat semua pengembalian yang sudah pernah diproses.
     */
    public function riwayat()
    {
        $data['title']   = 'Riwayat Pengembalian';
        $data['riwayat'] = $this->Pengembalian_model->get_riwayat();

        $this->load->view('admin/pengembalian/riwayat', $data);
    }

    /**
     * Hitung selisih hari keterlambatan. 0 kalau belum/tidak telat.
     */
    private function _hitung_hari_telat($tanggal_kembali, $tanggal_dikembalikan)
    {
        $jatuh_tempo  = strtotime($tanggal_kembali);
        $dikembalikan = strtotime($tanggal_dikembalikan);

        $selisih_hari = floor(($dikembalikan - $jatuh_tempo) / 86400);

        return $selisih_hari > 0 ? (int) $selisih_hari : 0;
    }
}