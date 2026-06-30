<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Pelanggan</title>

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
        <a class="active" href="<?= site_url('admin/pelanggan'); ?>">Pelanggan</a>
    </nav>

</header>

<div class="container">

    <h2>Data Pelanggan</h2>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
        <div class="error">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="table">

        <table>

            <thead>

                <tr>
                    <th width="60">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Username</th>
                    <th width="120">Aksi</th>
                </tr>

            </thead>

            <tbody>

                <?php if (!empty($pelanggan)) : ?>

                    <?php $no = 1; ?>

                    <?php foreach ($pelanggan as $p) : ?>

                        <tr>

                            <td><?= $no++; ?></td>

                            <td><?= $p->nama; ?></td>

                            <td><?= $p->email; ?></td>

                            <td><?= $p->no_hp; ?></td>

                            <td><?= $p->alamat; ?></td>

                            <td><?= $p->username; ?></td>

                            <td>

                                <a
                                    class="hapus"
                                    href="<?= site_url('admin/pelanggan/delete/' . $p->id_pelanggan); ?>"
                                    onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">

                                    Hapus

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <tr>

                        <td colspan="7" style="text-align:center; padding:20px;">
                            Belum ada data pelanggan.
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