<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan_model extends CI_Model
{
    // ambil 1 alat
    public function getAlat($id_alat)
    {
        return $this->db->get_where('alat', ['id_alat' => $id_alat])->row();
    }

    // resolve pelanggan (buat fallback cari id dari session)
    public function getPelangganByEmail($email)
    {
        return $this->db->get_where('pelanggan', ['email' => $email])->row();
    }

    public function getPelangganByUsername($username)
    {
        return $this->db->get_where('pelanggan', ['username' => $username])->row();
    }

    // simpan pesanan lengkap (header + detail + pembayaran) dalam 1 transaksi DB
    public function simpanPemesanan($transaksi, $detail, $pembayaran)
    {
        $this->db->trans_start();

        // 1. header transaksi
        $this->db->insert('transaksi', $transaksi);
        $id_transaksi = $this->db->insert_id();

        // 2. detail transaksi
        $detail['id_transaksi'] = $id_transaksi;
        $this->db->insert('detail_transaksi', $detail);

        // 3. pembayaran
        $pembayaran['id_transaksi'] = $id_transaksi;
        $this->db->insert('pembayaran', $pembayaran);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        return $id_transaksi;
    }

    // kurangi stok alat
    public function kurangiStok($id_alat, $jumlah)
    {
        $this->db->set('stok', 'stok - ' . (int) $jumlah, FALSE);
        $this->db->where('id_alat', $id_alat);
        $this->db->update('alat');
    }

    // ambil 1 transaksi (buat halaman sukses & detail pesanan)
    public function getTransaksi($id_transaksi)
    {
        return $this->db
            ->select('transaksi.*, pelanggan.nama, pelanggan.no_hp,
                      pembayaran.metode_bayar, pembayaran.status_pembayaran,
                      pembayaran.bukti_bayar, pembayaran.tanggal_bayar')
            ->from('transaksi')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan', 'left')
            ->join('pembayaran', 'pembayaran.id_transaksi = transaksi.id_transaksi', 'left')
            ->where('transaksi.id_transaksi', $id_transaksi)
            ->get()
            ->row();
    }

    public function getDetailTransaksi($id_transaksi)
    {
        return $this->db
            ->select('detail_transaksi.*, alat.nama_alat, alat.harga_sewa, alat.gambar')
            ->from('detail_transaksi')
            ->join('alat', 'alat.id_alat = detail_transaksi.id_alat', 'left')
            ->where('detail_transaksi.id_transaksi', $id_transaksi)
            ->get()
            ->result();
    }

    // RIWAYAT PESANAN milik 1 pelanggan (buat halaman "Pesanan Saya")
    public function getRiwayatByPelanggan($id_pelanggan)
    {
        return $this->db
            ->select('transaksi.*, alat.nama_alat, alat.gambar,
                      detail_transaksi.jumlah,
                      pembayaran.metode_bayar, pembayaran.status_pembayaran')
            ->from('transaksi')
            ->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi', 'left')
            ->join('alat', 'alat.id_alat = detail_transaksi.id_alat', 'left')
            ->join('pembayaran', 'pembayaran.id_transaksi = transaksi.id_transaksi', 'left')
            ->where('transaksi.id_pelanggan', $id_pelanggan)
            ->order_by('transaksi.id_transaksi', 'DESC')
            ->get()
            ->result();
    }
}