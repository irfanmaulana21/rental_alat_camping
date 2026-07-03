<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Riwayat Pengembalian'; ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/admin/pengembalian.css'); ?>">
</head>
<body>

<header>

    <div class="brand">
        <div class="logo">RC</div>
        <h2>Camping Admin</h2>
    </div>

    <nav>
        <a href="<?= site_url('admin/dashboard'); ?>">Dashboard</a>
        <a href="<?= site_url('admin/alat'); ?>">Alat</a>
        <a href="<?= site_url('admin/kategori'); ?>">Kategori</a>
        <a href="<?= site_url('admin/pelanggan'); ?>">Pelanggan</a>
        <a href="<?= site_url('admin/transaksi'); ?>">Konfirmasi Sewa</a>
        <a class="active" href="<?= site_url('admin/pengembalian'); ?>">Pengembalian</a>
    </nav>

</header>

<div class="container">

    <h2><?= isset($title) ? htmlspecialchars($title) : 'Riwayat Pengembalian'; ?></h2>

    <a href="<?= site_url('admin/pengembalian'); ?>" class="btn btn-secondary btn-block">
        &larr; Kembali ke Daftar Pengembalian
    </a>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>No. Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Sewa</th>
                    <th>Harus Kembali</th>
                    <th>Tanggal Dikembalikan</th>
                    <th>Kondisi Alat</th>
                    <th>Denda</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($riwayat)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($riwayat as $r): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>TRX-<?= $r->id_transaksi; ?></td>
                            <td><?= htmlspecialchars($r->nama); ?></td>
                            <td><?= date('d-m-Y', strtotime($r->tanggal_sewa)); ?></td>
                            <td><?= date('d-m-Y', strtotime($r->tanggal_kembali)); ?></td>
                            <td><?= date('d-m-Y', strtotime($r->tanggal_dikembalikan)); ?></td>
                            <td>
                                <?php
                                    $badge = 'badge-baik';
                                    if ($r->kondisi_alat === 'Rusak') $badge = 'badge-rusak';
                                    if ($r->kondisi_alat === 'Hilang') $badge = 'badge-hilang';
                                ?>
                                <span class="badge <?= $badge; ?>"><?= htmlspecialchars($r->kondisi_alat); ?></span>
                            </td>
                            <td>Rp <?= number_format($r->denda, 0, ',', '.'); ?></td>
                            <td><?= htmlspecialchars($r->catatan); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" align="center">Belum ada riwayat pengembalian.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<footer>
    © <?= date('Y'); ?> Sistem Rental Camping
</footer>

</body>
</html>
