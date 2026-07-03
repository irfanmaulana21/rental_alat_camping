<?php
$this->load->view('admin/partials/header', [
    'title'  => 'Edit Kategori',
    'active' => 'kategori',
]);
?>

<h2>Edit Kategori</h2>

<div class="form-card">
    <p class="sub">Ubah nama kategori alat camping</p>

    <form method="POST" action="<?= site_url('admin/kategori/update/'.$kategori->id_kategori) ?>">
        <label>Nama Kategori</label>
        <input class="input" type="text" name="nama_kategori"
               value="<?= $kategori->nama_kategori ?>" required>

        <div class="button-group">
            <a href="<?= site_url('admin/kategori') ?>" class="btn-back">Batal</a>
            <button type="submit">Update</button>
        </div>
    </form>
</div>

<?php $this->load->view('admin/partials/footer'); ?>