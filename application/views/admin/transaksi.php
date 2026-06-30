<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Sewa</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/admin/pelanggan.css'); ?>">
</head>
<body>

<header>

    <div class="brand">
        <div class="logo">RC</div>
        <h2>Camping Admin</h2>
    </div>

    <nav>
        <a href="<?= site_url('admin/dashboard')?>">Dashboard</a>
        <a href="<?= site_url('admin/alat')?>">Alat</a>
        <a href="<?= site_url('admin/kategori')?>">Kategori</a>
        <a href="<?= site_url('admin/pelanggan')?>">Pelanggan</a>
        <a class="active" href="<?= site_url('admin/transaksi')?>">Konfirmasi Sewa</a>
        <a href="<?= site_url('admin/transaksi/history')?>">History</a>
    </nav>

</header>

<div class="container">

<h2>Konfirmasi Sewa</h2>

<div class="table">

<table>

<thead>
<tr>
    <th>No</th>
    <th>Pelanggan</th>
    <th>Alat</th>
    <th>Tanggal Sewa</th>
    <th>Tanggal Kembali</th>
    <th>Total</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>

<?php if(!empty($transaksi)): ?>

<?php $no=1; foreach($transaksi as $t): ?>

<tr>

<td><?= $no++ ?></td>

<td><?= $t->nama ?></td>

<td><?= $t->nama_alat ?></td>

<td><?= date('d-m-Y',strtotime($t->tanggal_sewa)) ?></td>

<td><?= date('d-m-Y',strtotime($t->tanggal_kembali)) ?></td>

<td>Rp <?= number_format($t->total_harga,0,',','.') ?></td>

<td><?= $t->status ?></td>

<td>

<a class="edit"
href="<?= site_url('admin/transaksi/setujui/'.$t->id_transaksi) ?>">
Setujui
</a>

<a class="hapus"
onclick="return confirm('Tolak transaksi ini?')"
href="<?= site_url('admin/transaksi/tolak/'.$t->id_transaksi) ?>">
Tolak
</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>
<td colspan="8" align="center">
Belum ada transaksi yang menunggu konfirmasi.
</td>
</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

<footer class="footer">
© <?= date('Y')?> Sistem Rental Camping
</footer>

</body>
</html>