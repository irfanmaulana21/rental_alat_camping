<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    <link rel="stylesheet"
          href="<?= base_url('assets/css/admin/dashboard.css'); ?>">
</head>

<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h2>Rental Camping</h2>

        <a href="<?= site_url('admin/kategori'); ?>">Kelola Kategori</a>

        <a href="<?= site_url('admin/alat'); ?>">Kelola Alat</a>

        <a href="<?= site_url('admin/pelanggan'); ?>">Kelola Pelanggan</a>

        <div class="menu-title">Transaksi</div>
        <a href="<?= site_url('admin/transaksi') ?>">Konfirmasi Sewa</a>

        <a href="<?= site_url('admin/transaksi/history') ?>">History Transaksi</a>
        
        <a href="#">Pembayaran</a>

        <a href="javascript:void(0)" onclick="logout('<?= base_url() ?>')">
            Logout
        </a>

    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <h3>Dashboard Admin</h3>

            <div class="user">
                <?= $this->session->userdata('username'); ?>
                (<?= $this->session->userdata('role'); ?>)
            </div>
        </div>

        <!-- CONTENT -->
        <div class="content">

            <div class="card">
                <h3>Selamat Datang </h3>
                <p>Sistem Rental Alat Camping</p>
            </div>

            <!-- STATISTIK REAL -->
            <div class="card-grid">

                <div class="card-box">
                    <h4>Total Alat</h4>
                    <h2><?= $total_alat ?></h2>
                </div>

                <div class="card-box">
                    <h4>Kategori</h4>
                    <h2><?= $total_kategori ?></h2>
                </div>

                <div class="card-box">
                    <h4>Alat Tersedia</h4>
                    <h2><?= $alat_tersedia ?></h2>
                </div>

            </div>

        </div>

    </div>

</div>

<script src="<?= base_url('assets/js/admin/login.js'); ?>"></script>

</body>
</html>