<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian_model extends CI_Model
{
    /**
     * Daftar transaksi yang sedang disewa (status 'Disetujui').
     * GROUP_CONCAT dipakai supaya 1 transaksi = 1 baris,
     * walaupun isinya beberapa alat.
     */
    public function getDisewa()
    {
        return $this->db
            ->select('
                transaksi.*,
                pelanggan.nama,
                GROUP_CONCAT(alat.nama_alat SEPARATOR ", ") as nama_alat
            ', FALSE)
            ->from('transaksi')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi')
            ->join('alat', 'alat.id_alat = detail_transaksi.id_alat')
            ->where('transaksi.status', 'Disetujui')
            ->group_by('transaksi.id_transaksi')
            ->order_by('transaksi.id_transaksi', 'DESC')
            ->get()
            ->result();
    }

    /**
     * Proses pengembalian satu transaksi.
     * - kondisi 'Baik'  : stok tiap alat ditambah balik + status alat -> Tersedia
     * - kondisi lain    : stok TIDAK ditambah (barang rusak/hilang)
     * - status transaksi -> 'Dikembalikan'
     * Dibungkus DB transaction biar semua berhasil atau semua batal.
     */
    public function proses($id_transaksi, $kondisi)
    {
        $this->db->trans_start();

        // ambil semua alat di transaksi ini
        $detail = $this->db
            ->select('id_alat, jumlah')
            ->from('detail_transaksi')
            ->where('id_transaksi', $id_transaksi)
            ->get()
            ->result();

        if ($kondisi === 'Baik') {
            foreach ($detail as $d) {
                $this->db
                    ->set('stok', 'stok + ' . (int) $d->jumlah, FALSE)
                    ->set('status', 'Tersedia')
                    ->where('id_alat', $d->id_alat)
                    ->update('alat');
            }
        }

        $this->db
            ->where('id_transaksi', $id_transaksi)
            ->update('transaksi', ['status' => 'Dikembalikan']);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}