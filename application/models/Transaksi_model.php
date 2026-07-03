<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    // Transaksi aktif (Menunggu / Menunggu Verifikasi / Disetujui / Diambil)
    public function getAktif()
    {
        return $this->db
            ->select('
                transaksi.*,
                pelanggan.nama,
                GROUP_CONCAT(alat.nama_alat SEPARATOR ", ") as nama_alat,
                MAX(pembayaran.metode_bayar) as metode_bayar,
                MAX(pembayaran.bukti_bayar) as bukti_bayar,
                MAX(pembayaran.status_pembayaran) as status_pembayaran
            ', FALSE)
            ->from('transaksi')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi')
            ->join('alat', 'alat.id_alat = detail_transaksi.id_alat')
            ->join('pembayaran', 'pembayaran.id_transaksi = transaksi.id_transaksi', 'left')
            ->where_in('transaksi.status', ['Menunggu', 'Menunggu Verifikasi', 'Disetujui', 'Diambil'])
            ->group_by('transaksi.id_transaksi')
            ->order_by('transaksi.id_transaksi', 'DESC')
            ->get()
            ->result();
    }

    // History: hanya yang sudah selesai (Dikembalikan / Ditolak)
    public function getHistory()
    {
        return $this->db
            ->select('
                transaksi.*,
                pelanggan.nama,
                alat.nama_alat,
                detail_transaksi.jumlah
            ')
            ->from('transaksi')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi')
            ->join('alat', 'alat.id_alat = detail_transaksi.id_alat')
            ->where_in('transaksi.status', ['Dikembalikan', 'Ditolak'])
            ->order_by('transaksi.id_transaksi', 'DESC')
            ->get()
            ->result();
    }

    // Data 1 transaksi (header) untuk struk
    public function getById($id)
    {
        return $this->db
            ->select('
                transaksi.*,
                pelanggan.nama, pelanggan.no_hp, pelanggan.alamat,
                pembayaran.metode_bayar, pembayaran.status_pembayaran
            ')
            ->from('transaksi')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->join('pembayaran', 'pembayaran.id_transaksi = transaksi.id_transaksi', 'left')
            ->where('transaksi.id_transaksi', $id)
            ->get()
            ->row();
    }

    // Rincian alat dalam 1 transaksi untuk struk
    public function getDetail($id)
    {
        return $this->db
            ->select('detail_transaksi.*, alat.nama_alat, alat.harga_sewa')
            ->from('detail_transaksi')
            ->join('alat', 'alat.id_alat = detail_transaksi.id_alat')
            ->where('detail_transaksi.id_transaksi', $id)
            ->get()
            ->result();
    }

    // Setujui: ubah status saja (stok sudah dipotong saat booking)
    public function setujui($id)
    {
        $this->db->where('id_transaksi', $id)
                 ->update('transaksi', ['status' => 'Disetujui']);

        $this->db->where('id_transaksi', $id)
                 ->where('status_pembayaran', 'Menunggu Verifikasi')
                 ->update('pembayaran', ['status_pembayaran' => 'Terverifikasi']);

        return true;
    }

    // Tandai barang sudah diambil pelanggan
    public function tandaiDiambil($id)
    {
        return $this->db
            ->where('id_transaksi', $id)
            ->update('transaksi', ['status' => 'Diambil']);
    }

    // Tolak: kembalikan stok + set status
    public function tolak($id)
    {
        $this->db->trans_begin();

        $detail = $this->db
            ->select('id_alat, jumlah')
            ->from('detail_transaksi')
            ->where('id_transaksi', $id)
            ->get()
            ->result();

        foreach ($detail as $d) {
            $this->db
                ->set('stok', 'stok + ' . (int) $d->jumlah, FALSE)
                ->set('status', 'Tersedia')
                ->where('id_alat', $d->id_alat)
                ->update('alat');
        }

        $this->db->where('id_transaksi', $id)
                 ->update('transaksi', ['status' => 'Ditolak']);

        $this->db->where('id_transaksi', $id)
                 ->update('pembayaran', ['status_pembayaran' => 'Ditolak']);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return true;
    }
}