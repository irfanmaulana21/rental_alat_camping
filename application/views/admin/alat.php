<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Alat Camping</title>

    <link rel="stylesheet"
          href="<?= base_url('assets/css/admin/alat.css?v='.time()); ?>">
</head>

<body>

<header>

    <div class="brand">
        <div class="logo">
            RC
        </div>

        <div>
            <h1>Camping Admin</h1>
        </div>
    </div>

    <nav>
        <a href="<?= site_url('admin/dashboard')?>">Dashboard</a>

        <a href="<?= site_url('admin/kategori')?>">Kategori</a>

        <a class="active">
            Alat
        </a>
    </nav>

</header>


<div class="container">

    <h2>Manajemen Alat Camping</h2>

    <?= validation_errors('<div class="error">','</div>'); ?>

    <div class="flex-row">

        <!-- FORM TAMBAH -->
        <div class="form form-alat">

            <h4>Tambah Data</h4>

            <form
                method="POST"
                action="<?= site_url('admin/alat/store')?>"
                enctype="multipart/form-data">

                <label>Kategori</label>

                <select class="input"
                        name="id_kategori"
                        required>

                    <option value="">
                        Pilih kategori
                    </option>

                    <?php foreach($kategori as $k): ?>

                        <option value="<?= $k->id_kategori ?>">
                            <?= $k->nama_kategori ?>
                        </option>

                    <?php endforeach; ?>

                </select>


                <label>Nama Alat</label>

                <input
                    class="input"
                    type="text"
                    name="nama_alat">


                <label>Merk</label>

                <input
                    class="input"
                    type="text"
                    name="merk">


                <div class="row">

                    <div>

                        <label>Stok</label>

                        <input
                            class="input"
                            type="number"
                            name="stok">

                    </div>

                    <div>

                        <label>Harga</label>

                        <input
                            class="input"
                            type="number"
                            name="harga_sewa">

                    </div>

                </div>


                <label>Status</label>

                <select class="input"
                        name="status">

                    <option value="Tersedia">
                        Tersedia
                    </option>

                    <option value="Disewa">
                        Disewa
                    </option>

                    <option value="Belum Tersedia">
                        Belum Tersedia
                    </option>

                </select>


                <label>Upload Gambar</label>

                <input
                    class="input"
                    type="file"
                    name="gambar">


                <label>Deskripsi</label>

                <textarea
                    class="input"
                    name="deskripsi"></textarea>


                <button type="submit">
                    + Tambah Data
                </button>

            </form>

        </div>


        <!-- TABEL -->
        <div class="flex-1">

            <div class="table">

                <h4>Daftar Alat</h4>

                <table>

                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Merk</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                    $no = 1;
                    foreach($alat as $a):
                    ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td>

                            <?php if($a->gambar): ?>

                                <img src="<?= base_url('assets/image/alat/'.$a->gambar) ?>">

                            <?php endif; ?>

                        </td>


                        <td>

                            <b>
                                <?= $a->nama_alat ?>
                            </b>

                            <br>

                            <small>
                                Rp<?= number_format($a->harga_sewa) ?>
                            </small>

                        </td>


                        <td>
                            <?= $a->merk ?>
                        </td>

                        <td>
                            <?= $a->stok ?>
                        </td>


                        <td>

                            <?php if($a->status=="Tersedia"): ?>

                                <span class="tersedia">
                                    Tersedia
                                </span>

                            <?php elseif($a->status=="Disewa"): ?>

                                <span class="disewa">
                                    Disewa
                                </span>

                            <?php else: ?>

                                <span class="belum">
                                    Belum Tersedia
                                </span>

                            <?php endif; ?>

                        </td>


                        <td>

                            <a
                                class="edit"
                                href="<?= site_url('admin/alat/edit/'.$a->id_alat) ?>">

                                Edit

                            </a>


                            <a
                                class="hapus"
                                onclick="return confirm('hapus data?')"
                                href="<?= site_url('admin/alat/delete/'.$a->id_alat) ?>">

                                Hapus

                            </a>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                </table>

            </div>

        </div>

    </div>

</div>


<footer class="footer">
    © <?= date('Y'); ?> Sistem Rental Alat Camping
</footer>

</body>
</html>