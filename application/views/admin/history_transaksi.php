<?php
/* ---------------------------------------------------------
   views/admin/history_transaksi.php
   Controller (Transaksi::history) mengirim $history dari getHistory():
     field: nama, nama_alat, jumlah, tanggal_sewa,
            tanggal_kembali, total_harga, status
   --------------------------------------------------------- */
$this->load->view('admin/partials/header', [
    'title'  => 'History Transaksi',
    'active' => 'history',
]);
?>

<h2>History Transaksi</h2>

<div class="table">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Kembali</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($history)): ?>
            <?php $no = 1; foreach ($history as $h):
                $cls = strtolower(str_replace(' ', '', $h->status));
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $h->nama ?></td>
                    <td><?= $h->nama_alat ?></td>
                    <td><?= $h->jumlah ?></td>
                    <td><?= date('d-m-Y', strtotime($h->tanggal_sewa)) ?></td>
                    <td><?= date('d-m-Y', strtotime($h->tanggal_kembali)) ?></td>
                    <td>Rp <?= number_format($h->total_harga, 0, ',', '.') ?></td>
                    <td><span class="badge <?= $cls ?>"><?= $h->status ?></span></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" style="text-align:center;padding:22px;color:#6b7280;">
                    Belum ada history transaksi.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $this->load->view('admin/partials/footer'); ?>