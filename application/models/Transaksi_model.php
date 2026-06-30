<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    // Transaksi yang menunggu konfirmasi
    public function getMenunggu()
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
            ->where_in('transaksi.status', ['Menunggu', 'Menunggu Verifikasi'])
            ->order_by('transaksi.id_transaksi', 'DESC')
            ->get()
            ->result();
    }

    // History transaksi
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
            ->where_not_in('transaksi.status', ['Menunggu', 'Menunggu Verifikasi'])
            ->order_by('transaksi.id_transaksi', 'DESC')
            ->get()
            ->result();
    }

    // Setujui transaksi
    public function setujui($id)
    {
        $this->db->where('id_transaksi', $id);
        return $this->db->update('transaksi', [
            'status' => 'Disetujui'
        ]);
    }

    // Tolak transaksi
    public function tolak($id)
    {
        $this->db->where('id_transaksi', $id);
        return $this->db->update('transaksi', [
            'status' => 'Ditolak'
        ]);
    }
}