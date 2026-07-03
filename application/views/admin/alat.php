<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Alat</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/admin/alat.css'); ?>">
</head>

<body>

<header>
    <div class="brand">
        <div class="logo">RC</div>

        <div>
            <h1>Camping Admin</h1>
        </div>
    </div>

    <nav>
        <a href="<?= site_url('admin/dashboard'); ?>">Dashboard</a>
        <a class="active" href="<?= site_url('admin/alat'); ?>">Alat</a>
        <a href="<?= site_url('admin/kategori'); ?>">Kategori</a>
        <a href="<?= site_url('admin/pengembalian'); ?>">Pengembalian</a>
    </nav>
</header>

<div class="container">

    <h2>Manajemen Alat</h2>

    <div class="flex-row">

        <!-- FORM TAMBAH -->
        <div class="form">

            <h4>Tambah Alat</h4>

            <form action="<?= site_url('admin/alat/store'); ?>" method="post" enctype="multipart/form-data">

                <label>Kategori</label>
                <select name="id_kategori" required>
                    <?php foreach ($kategori as $k): ?>
                        <option value="<?= $k->id_kategori; ?>">
                            <?= $k->nama_kategori; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Nama Alat</label>
                <input type="text" name="nama_alat" required>

                <label>Merk</label>
                <input type="text" name="merk" required>

                <label>Stok</label>
                <input type="number" name="stok" required>

                <label>Harga Sewa</label>
                <input type="number" name="harga_sewa" required>

                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="4" required></textarea>

                <label>Gambar</label>
                <input type="file" name="gambar" required>

                <button type="submit">
                    + Tambah Alat
                </button>

            </form>

        </div>

        <!-- TABEL DATA -->
        <div class="flex-1">

            <div class="table">

                <h4>Daftar Alat</h4>

                <table>

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Alat</th>
                            <th>Kategori</th>
                            <th>Merk</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th width="170">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $no = 1; ?>

                        <?php foreach ($alat as $a): ?>

                            <tr>

                                <td><?= $no++; ?></td>

                                <td>
                                    <img
                                        src="<?= base_url('assets/image/alat/' . $a->gambar); ?>"
                                        alt="<?= $a->nama_alat; ?>"
                                        width="70">
                                </td>

                                <td><?= $a->nama_alat; ?></td>

                                <td><?= $a->nama_kategori; ?></td>

                                <td><?= $a->merk; ?></td>

                                <td><?= $a->stok; ?></td>

                                <td>
                                    Rp <?= number_format($a->harga_sewa, 0, ',', '.'); ?>
                                </td>

                                <td><?= $a->status; ?></td>

                                <td>

                                    <a class="edit"
                                       href="<?= site_url('admin/alat/edit/' . $a->id_alat); ?>">
                                        Edit
                                    </a>

                                    <a class="hapus"
                                       href="<?= site_url('admin/alat/delete/' . $a->id_alat); ?>"
                                       onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        Hapus
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<footer class="footer">
    © <?= date('Y'); ?> Sistem Rental Camping
</footer>

</body>
</html>