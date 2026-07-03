<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pengembalian_model
 *
 * Menangani semua query terkait fitur pengembalian alat camping.
 * Tabel yang dipakai: transaksi, detail_transaksi, alat, pelanggan, pengembalian
 */
class Pengembalian_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Daftar transaksi yang statusnya masih "Disetujui" (sedang disewa, belum dikembalikan)
     * beserta nama pelanggan.
     */
    public function get_transaksi_disewa()
    {
        return $this->db
            ->select('transaksi.*, pelanggan.nama, pelanggan.no_hp')
            ->from('transaksi')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan', 'left')
            ->where('transaksi.status', 'Disetujui')
            ->order_by('transaksi.tanggal_kembali', 'ASC')
            ->get()
            ->result();
    }

    /**
     * Detail satu transaksi (dipakai untuk cek transaksi valid & tampil data pelanggan).
     */
    public function get_transaksi($id_transaksi)
    {
        return $this->db
            ->select('transaksi.*, pelanggan.nama, pelanggan.no_hp, pelanggan.alamat')
            ->from('transaksi')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan', 'left')
            ->where('transaksi.id_transaksi', $id_transaksi)
            ->get()
            ->row();
    }

    /**
     * Daftar alat yang disewa dalam satu transaksi (dari detail_transaksi).
     */
    public function get_detail_alat($id_transaksi)
    {
        return $this->db
            ->select('detail_transaksi.*, alat.nama_alat, alat.merk, alat.harga_sewa')
            ->from('detail_transaksi')
            ->join('alat', 'alat.id_alat = detail_transaksi.id_alat', 'left')
            ->where('detail_transaksi.id_transaksi', $id_transaksi)
            ->get()
            ->result();
    }

    /**
     * Cek apakah transaksi ini sudah pernah diproses pengembaliannya.
     */
    public function is_sudah_dikembalikan($id_transaksi)
    {
        return $this->db
            ->where('id_transaksi', $id_transaksi)
            ->get('pengembalian')
            ->num_rows() > 0;
    }

    /**
     * Proses pengembalian:
     * - insert ke tabel pengembalian
     * - update status transaksi jadi 'Selesai'
     * - kembalikan stok alat & set status alat sesuai kondisi
     *
     * $data = [
     *   'id_transaksi'         => int,
     *   'tanggal_dikembalikan' => 'YYYY-MM-DD',
     *   'denda'                => int,
     *   'kondisi_alat'         => 'Baik'|'Rusak'|'Hilang',
     *   'catatan'              => string
     * ]
     *
     * Return TRUE jika sukses, FALSE jika gagal.
     */
    public function proses_pengembalian($data)
    {
        $this->db->trans_start();

        // 1) Catat pengembalian
        $this->db->insert('pengembalian', [
            'id_transaksi'         => $data['id_transaksi'],
            'tanggal_dikembalikan' => $data['tanggal_dikembalikan'],
            'denda'                => $data['denda'],
            'kondisi_alat'         => $data['kondisi_alat'],
            'catatan'              => $data['catatan'],
        ]);

        // 2) Update status transaksi
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('transaksi', ['status' => 'Selesai']);

        // 3) Kembalikan stok & set status setiap alat yang ada di transaksi ini
        $detail = $this->get_detail_alat($data['id_transaksi']);

        // Kalau kondisi alat "Baik" -> alat kembali "Tersedia"
        // Kalau "Rusak" / "Hilang" -> alat ditandai "Belum Tersedia" (perlu dicek admin dulu)
        $status_alat_baru = ($data['kondisi_alat'] === 'Baik') ? 'Tersedia' : 'Belum Tersedia';

        foreach ($detail as $item) {
            $this->db->set('stok', 'stok + ' . (int) $item->jumlah, FALSE);
            $this->db->set('status', $this->db->escape($status_alat_baru), FALSE);
            $this->db->where('id_alat', $item->id_alat);
            $this->db->update('alat');
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    /**
     * Riwayat pengembalian yang sudah diproses (untuk halaman riwayat/laporan).
     */
    public function get_riwayat()
    {
        return $this->db
            ->select('pengembalian.*, transaksi.tanggal_sewa, transaksi.tanggal_kembali, transaksi.total_harga, pelanggan.nama')
            ->from('pengembalian')
            ->join('transaksi', 'transaksi.id_transaksi = pengembalian.id_transaksi', 'left')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan', 'left')
            ->order_by('pengembalian.id_pengembalian', 'DESC')
            ->get()
            ->result();
    }
}