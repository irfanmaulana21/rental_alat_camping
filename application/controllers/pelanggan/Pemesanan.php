<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // cek login
        if (!$this->session->userdata('login')) {
            redirect('pelanggan/login');
        }

        $this->load->model('Pemesanan_model');
    }

    // ====== HELPER ======

    // ambil id pelanggan dari session (coba beberapa kemungkinan key)
    private function idPelanggan()
    {
        $keys = ['id_pelanggan', 'id_user', 'id', 'user_id'];
        foreach ($keys as $k) {
            $v = $this->session->userdata($k);
            if (!empty($v)) return $v;
        }

        // fallback: cari via email / username yang tersimpan di session
        $email = $this->session->userdata('email');
        if ($email) {
            $p = $this->Pemesanan_model->getPelangganByEmail($email);
            if ($p) return $p->id_pelanggan;
        }

        $username = $this->session->userdata('username');
        if ($username) {
            $p = $this->Pemesanan_model->getPelangganByUsername($username);
            if ($p) return $p->id_pelanggan;
        }

        return null;
    }

    // hitung jumlah hari antara 2 tanggal
    private function hitungHari($mulai, $selesai)
    {
        $d1 = new DateTime($mulai);
        $d2 = new DateTime($selesai);
        return (int) $d1->diff($d2)->days;
    }

    // tampilkan ulang halaman checkout dengan pesan error (biar data gak hilang)
    private function reRenderCheckout($alat, $tgl_mulai, $tgl_selesai, $jumlah, $hari, $total, $metode, $error)
    {
        $data = [
            'alat'        => $alat,
            'tgl_mulai'   => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'jumlah'      => $jumlah,
            'hari'        => $hari,
            'total'       => $total,
            'metode'      => $metode,
            'error'       => $error,
        ];
        $this->load->view('pelanggan/checkout', $data);
    }

    // ====== STEP 1: HALAMAN CHECKOUT ======
    public function index()
    {
        $id_alat     = $this->input->post('id_alat');
        $tgl_mulai   = $this->input->post('tgl_mulai');
        $tgl_selesai = $this->input->post('tgl_selesai');
        $jumlah      = (int) $this->input->post('jumlah');

        // diakses langsung tanpa data -> balik ke katalog
        if (!$id_alat || !$tgl_mulai || !$tgl_selesai) {
            redirect('pelanggan/alat');
        }

        $alat = $this->Pemesanan_model->getAlat($id_alat);
        if (!$alat) show_404();

        $hari = $this->hitungHari($tgl_mulai, $tgl_selesai);
        if ($hari < 1)   $hari = 1;
        if ($jumlah < 1) $jumlah = 1;

        $total = $alat->harga_sewa * $hari * $jumlah;

        $data = [
            'alat'        => $alat,
            'tgl_mulai'   => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'jumlah'      => $jumlah,
            'hari'        => $hari,
            'total'       => $total,
            'metode'      => '',    // belum dipilih
            'error'       => null,
        ];

        $this->load->view('pelanggan/checkout', $data);
    }

    // ====== STEP 2: SIMPAN PESANAN ======
    public function proses()
    {
        $id_alat     = $this->input->post('id_alat');
        $tgl_mulai   = $this->input->post('tgl_mulai');
        $tgl_selesai = $this->input->post('tgl_selesai');
        $jumlah      = (int) $this->input->post('jumlah');
        $metode      = $this->input->post('metode_bayar');

        if (!$id_alat || !$tgl_mulai || !$tgl_selesai || !$metode) {
            redirect('pelanggan/alat');
        }

        $id_pelanggan = $this->idPelanggan();
        if (!$id_pelanggan) {
            // session gak nemu id pelanggan -> minta login ulang
            redirect('pelanggan/login');
        }

        $alat = $this->Pemesanan_model->getAlat($id_alat);
        if (!$alat) show_404();

        $hari = $this->hitungHari($tgl_mulai, $tgl_selesai);
        if ($hari < 1) {
            $this->session->set_flashdata('error', 'Tanggal sewa tidak valid.');
            redirect('pelanggan/alat/detail/' . $id_alat);
        }
        if ($jumlah < 1) $jumlah = 1;

        // cek stok cukup
        if ($jumlah > $alat->stok) {
            $this->session->set_flashdata('error', 'Stok tidak mencukupi.');
            redirect('pelanggan/alat/detail/' . $id_alat);
        }

        $total = $alat->harga_sewa * $hari * $jumlah;

        // ====== CEK PEMBAYARAN ======
        $online = in_array($metode, ['Transfer Bank', 'QRIS']);
        $bukti  = null;

        if ($online) {
            // WAJIB upload bukti. Kalau gak ada -> pesanan TIDAK disimpan.
            if (empty($_FILES['bukti_bayar']['name'])) {
                return $this->reRenderCheckout(
                    $alat, $tgl_mulai, $tgl_selesai, $jumlah, $hari, $total, $metode,
                    'Untuk pembayaran online, kamu wajib upload bukti transfer dulu sebelum pesanan diproses.'
                );
            }

            // pastikan folder upload ada
            $uploadDir = FCPATH . 'assets/image/bukti/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $config = [
                'upload_path'   => $uploadDir,
                'allowed_types' => 'jpg|jpeg|png|webp',
                'max_size'      => 4096, // dalam KB = 4MB
                'file_name'     => 'bukti_' . time() . '_' . rand(100, 999),
            ];
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('bukti_bayar')) {
                $err = $this->upload->display_errors('', '');
                return $this->reRenderCheckout(
                    $alat, $tgl_mulai, $tgl_selesai, $jumlah, $hari, $total, $metode, $err
                );
            }

            $bukti = $this->upload->data('file_name');
        }

        // ====== SIMPAN KE DATABASE ======
        $transaksi = [
            'id_pelanggan'    => $id_pelanggan,
            'tanggal_sewa'    => $tgl_mulai,
            'tanggal_kembali' => $tgl_selesai,
            'total_harga'     => $total,
            'status'          => $online ? 'Menunggu Verifikasi' : 'Menunggu',
        ];

        $detail = [
            'id_alat'  => $id_alat,
            'jumlah'   => $jumlah,
            'subtotal' => $total,
        ];

        $pembayaran = [
            'tanggal_bayar'     => $online ? date('Y-m-d') : null,
            'metode_bayar'      => $metode, // 'COD' / 'Transfer Bank' / 'QRIS'
            'bukti_bayar'       => $bukti,
            'status_pembayaran' => $online ? 'Menunggu Verifikasi' : 'Bayar di Tempat',
        ];

        $id_transaksi = $this->Pemesanan_model->simpanPemesanan($transaksi, $detail, $pembayaran);

        if (!$id_transaksi) {
            $this->session->set_flashdata('error', 'Gagal menyimpan pesanan, coba lagi.');
            redirect('pelanggan/alat/detail/' . $id_alat);
        }

        // kurangi stok otomatis. Hapus baris di bawah kalau gak mau stok berkurang.
        $this->Pemesanan_model->kurangiStok($id_alat, $jumlah);

        redirect('pelanggan/pemesanan/sukses/' . $id_transaksi);
    }

    // ====== STEP 3: HALAMAN SUKSES ======
    public function sukses($id_transaksi = null)
    {
        if (!$id_transaksi) redirect('pelanggan/alat');

        $trx = $this->Pemesanan_model->getTransaksi($id_transaksi);
        if (!$trx) show_404();

        // pastikan transaksi ini punya pelanggan yang lagi login
        if ($trx->id_pelanggan != $this->idPelanggan()) {
            show_404();
        }

        $data = [
            'trx'    => $trx,
            'detail' => $this->Pemesanan_model->getDetailTransaksi($id_transaksi),
        ];

        $this->load->view('pelanggan/sukses', $data);
    }

    // ====== PESANAN SAYA (RIWAYAT) ======
    public function riwayat()
    {
        $id_pelanggan = $this->idPelanggan();
        if (!$id_pelanggan) {
            redirect('pelanggan/login');
        }

        $data['list'] = $this->Pemesanan_model->getRiwayatByPelanggan($id_pelanggan);

        $this->load->view('pelanggan/pesanan', $data);
    }

    // ====== DETAIL 1 PESANAN ======
    public function lihat($id_transaksi = null)
    {
        if (!$id_transaksi) redirect('pelanggan/pemesanan/riwayat');

        $trx = $this->Pemesanan_model->getTransaksi($id_transaksi);
        if (!$trx) show_404();

        // pastikan pesanan ini milik pelanggan yang lagi login
        if ($trx->id_pelanggan != $this->idPelanggan()) {
            show_404();
        }

        $data = [
            'trx'    => $trx,
            'detail' => $this->Pemesanan_model->getDetailTransaksi($id_transaksi),
        ];

        $this->load->view('pelanggan/pesanan_detail', $data);
    }
}