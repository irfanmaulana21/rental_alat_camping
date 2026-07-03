<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>History Transaksi</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/admin/pelanggan.css'); ?>">
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
        <a class="active" href="<?= site_url('admin/transaksi/history'); ?>">History</a>
        <a href="<?= site_url('admin/pengembalian'); ?>">Pengembalian</a>
    </nav>

</header>

<div class="container">

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

            <?php if(!empty($history)): ?>

                <?php $no=1; ?>

                <?php foreach($history as $h): ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td><?= $h->nama; ?></td>

                    <td><?= $h->nama_alat; ?></td>

                    <td><?= $h->jumlah; ?></td>

                    <td><?= date('d-m-Y',strtotime($h->tanggal_sewa)); ?></td>

                    <td><?= date('d-m-Y',strtotime($h->tanggal_kembali)); ?></td>

                    <td>
                        Rp <?= number_format($h->total_harga,0,',','.'); ?>
                    </td>

                    <td>

                        <?php
                        if($h->status=='Disetujui'){
                            echo '<span style="color:green;font-weight:bold;">Disetujui</span>';
                        }elseif($h->status=='Ditolak'){
                            echo '<span style="color:red;font-weight:bold;">Ditolak</span>';
                        }elseif($h->status=='Selesai'){
                            echo '<span style="color:blue;font-weight:bold;">Selesai</span>';
                        }else{
                            echo $h->status;
                        }
                        ?>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="8" style="text-align:center;">
                        Belum ada history transaksi.
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<footer class="footer">
    © <?= date('Y'); ?> Sistem Rental Camping
</footer>

</body>
</html>