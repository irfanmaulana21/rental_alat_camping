<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Alat</title>
<link rel="stylesheet" href="<?= base_url('assets/css/admin/edit_alat.css'); ?>">
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

        <a href="<?= site_url('admin/alat')?>"
        class="active">
        Alat
        </a>

    </nav>

</header>


<div class="container">

<div class="edit-card">

<h2>Edit Data Alat</h2>

<form method="POST"
action="<?= site_url('admin/alat/update/'.$alat->id_alat) ?>"
enctype="multipart/form-data">


<label>Kategori</label>

<select class="input"
name="id_kategori"
required>

<?php foreach($kategori as $k): ?>

<option value="<?= $k->id_kategori?>"

<?= $alat->id_kategori==$k->id_kategori
?'selected':'' ?>>

<?= $k->nama_kategori?>

</option>

<?php endforeach;?>

</select>



<label>Nama Alat</label>

<input
class="input"
type="text"
name="nama_alat"
value="<?= $alat->nama_alat ?>"
required>



<label>Merk</label>

<input
class="input"
type="text"
name="merk"
value="<?= $alat->merk ?>"
required>



<div class="row">

<div>

<label>Stok</label>

<input
class="input"
type="number"
name="stok"
value="<?= $alat->stok ?>"
required>

</div>


<div>

<label>Harga</label>

<input
class="input"
type="number"
name="harga_sewa"
value="<?= $alat->harga_sewa ?>"
required>

</div>

</div>

<label>Status</label>

<select class="input" name="status" required>

<option value="Tersedia"
<?= $alat->status=='Tersedia'?'selected':'' ?>>
Tersedia
</option>

<option value="Disewa"
<?= $alat->status=='Disewa'?'selected':'' ?>>
Disewa
</option>

<option value="Belum Tersedia"
<?= $alat->status=='Belum Tersedia'?'selected':'' ?>>
Belum Tersedia
</option>

</select>


<label>Deskripsi</label>

<textarea
class="input"
name="deskripsi"><?= $alat->deskripsi ?>
</textarea>



<label>Gambar Saat Ini</label>

<div class="preview-box">

<?php if(!empty($alat->gambar)): ?>

<img src="<?= base_url('assets/image/alat/'.$alat->gambar) ?>">

<?php else: ?>

<p>Tidak ada gambar</p>

<?php endif; ?>

</div>



<label>Ganti Gambar</label>

<input
class="input"
type="file"
name="gambar">


<div class="btn-group">

<a href="<?= site_url('admin/alat')?>"
class="btn-back">

Batal

</a>


<button type="submit">

Update Data

</button>

</div>

</form>

</div>

</div>


<footer class="footer">

© Sistem Rental Camping

</footer>

</body>
</html>