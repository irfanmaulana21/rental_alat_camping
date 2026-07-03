<?php
/* ---------------------------------------------------------
   views/admin/alat.php
   Controller (Alat::index) diasumsikan mengirim:
     $alat     = daftar alat (join kategori -> ada nama_kategori)
     $kategori = daftar kategori utk dropdown form tambah
   Kalau nama variabel di controller lu beda, tinggal
   sesuaikan bagian foreach ($alat ...) di bawah.
   --------------------------------------------------------- */
$this->load->view('admin/partials/header', [
    'title'  => 'Kelola Alat',
    'active' => 'alat',
]);
?>

<h2>Manajemen Alat</h2>

<?php if ($this->session->flashdata('success')): ?>
    <div class="flash-success"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="flash-error"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div class="flex-row">

    <!-- FORM TAMBAH -->
    <div class="form">
        <h4>Tambah Alat</h4>
        <form method="POST" action="<?= site_url('admin/alat/store') ?>" enctype="multipart/form-data">

            <label>Kategori</label>
            <select class="input" name="id_kategori" required>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
                <?php endforeach; ?>
            </select>

            <label>Nama Alat</label>
            <input class="input" type="text" name="nama_alat" required>

            <label>Merk</label>
            <input class="input" type="text" name="merk" required>

            <div class="row">
                <div>
                    <label>Stok</label>
                    <input class="input" type="number" name="stok" required>
                </div>
                <div>
                    <label>Harga Sewa</label>
                    <input class="input" type="number" name="harga_sewa" required>
                </div>
            </div>

            <label>Deskripsi</label>
            <textarea class="input" name="deskripsi"></textarea>

            <label>Gambar</label>
            <input class="input" type="file" name="gambar">

            <button type="submit">+ Tambah Alat</button>
        </form>
    </div>

    <!-- TABEL -->
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($alat)): ?>
                    <?php $no = 1; foreach ($alat as $a):
                        $s   = strtolower($a->status);
                        $cls = $s == 'tersedia' ? 'tersedia' : ($s == 'disewa' ? 'disewa' : 'belum');
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <?php if (!empty($a->gambar)): ?>
                                <img src="<?= base_url('assets/image/alat/'.$a->gambar) ?>">
                            <?php else: ?>
                                <span style="color:#9ca3af;font-size:12px;">—</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $a->nama_alat ?></td>
                        <td><?= $a->nama_kategori ?></td>
                        <td><?= $a->merk ?></td>
                        <td><?= $a->stok ?></td>
                        <td>Rp <?= number_format($a->harga_sewa, 0, ',', '.') ?></td>
                        <td><span class="badge <?= $cls ?>"><?= $a->status ?></span></td>
                        <td>
                            <a class="edit" href="<?= site_url('admin/alat/edit/'.$a->id_alat) ?>">Edit</a>
                            <a class="hapus" onclick="return confirm('Hapus data?')"
                               href="<?= site_url('admin/alat/delete/'.$a->id_alat) ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" style="text-align:center;padding:22px;color:#6b7280;">
                            Belum ada data alat.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php $this->load->view('admin/partials/footer'); ?>