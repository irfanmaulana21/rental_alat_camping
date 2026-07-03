<?php
$this->load->view('admin/partials/header', [
    'title'  => 'Kelola Kategori',
    'active' => 'kategori',
]);
?>

<h2>Manajemen Kategori</h2>

<?php if ($this->session->flashdata('error')): ?>
    <div class="flash-error"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('success')): ?>
    <div class="flash-success"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<div class="flex-row">

    <!-- FORM TAMBAH -->
    <div class="form">
        <h4>Tambah Kategori</h4>
        <form method="POST" action="<?= site_url('admin/kategori/store') ?>">
            <label>Nama Kategori</label>
            <input class="input" type="text" name="nama_kategori"
                   placeholder="Masukkan kategori" required>
            <button type="submit">+ Tambah</button>
        </form>
    </div>

    <!-- TABEL -->
    <div class="flex-1">
        <div class="table">
            <h4>Daftar Kategori</h4>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($kategori as $k): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $k->nama_kategori ?></td>
                        <td>
                            <a class="edit" href="<?= site_url('admin/kategori/edit/'.$k->id_kategori) ?>">Edit</a>
                            <a class="hapus" onclick="return confirm('Hapus data?')"
                               href="<?= site_url('admin/kategori/delete/'.$k->id_kategori) ?>">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php $this->load->view('admin/partials/footer'); ?>