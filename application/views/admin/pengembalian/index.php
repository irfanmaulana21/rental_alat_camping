<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Pengembalian Alat Camping'; ?></title>

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

    <h2><?= isset($title) ? htmlspecialchars($title) : 'Pengembalian Alat Camping'; ?></h2>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="notice notice-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="notice notice-error"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <a href="<?= site_url('admin/pengembalian/riwayat'); ?>" class="btn btn-secondary btn-block">
        Lihat Riwayat Pengembalian
    </a>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>No. HP</th>
                    <th>Tanggal Sewa</th>
                    <th>Harus Kembali</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transaksi_disewa)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($transaksi_disewa as $t): ?>
                        <?php $telat = (strtotime(date('Y-m-d')) > strtotime($t->tanggal_kembali)); ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>TRX-<?= $t->id_transaksi; ?></td>
                            <td><?= htmlspecialchars($t->nama); ?></td>
                            <td><?= htmlspecialchars($t->no_hp); ?></td>
                            <td><?= date('d-m-Y', strtotime($t->tanggal_sewa)); ?></td>
                            <td><?= date('d-m-Y', strtotime($t->tanggal_kembali)); ?></td>
                            <td>Rp <?= number_format($t->total_harga, 0, ',', '.'); ?></td>
                            <td>
                                <?php if ($telat): ?>
                                    <span class="badge badge-telat">Telat</span>
                                <?php else: ?>
                                    <span class="badge badge-ontime">Disewa</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="<?= site_url('admin/pengembalian/proses/' . $t->id_transaksi); ?>">
                                    Proses Pengembalian
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" align="center">Tidak ada alat yang sedang disewa saat ini.</td>
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
