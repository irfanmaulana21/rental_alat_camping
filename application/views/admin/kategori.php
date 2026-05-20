<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Kelola Kategori</title>
<link rel="stylesheet" href="<?= base_url('/assets/css/admin/kategori.css'); ?>">
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
        <a href="<?= site_url('admin/alat')?>">Alat</a>

        <a class="active">
            Kategori
        </a>

    </nav>

</header>


<div class="container">

<h2>Manajemen Kategori</h2>


<!-- FLASH -->

<?php if($this->session->flashdata('error')): ?>

<div class="flash-error">

<?= $this->session->flashdata('error'); ?>

</div>

<?php endif;?>


<?php if($this->session->flashdata('success')): ?>

<div class="flash-success">

<?= $this->session->flashdata('success'); ?>

</div>

<?php endif;?>


<div class="flex-row">


<!-- FORM -->

<div class="form">

<h4>Tambah Kategori</h4>

<form
method="POST"
action="<?= site_url('admin/kategori/store')?>">

<label>Nama Kategori</label>

<input
class="input"
type="text"
name="nama_kategori"
placeholder="Masukkan kategori"
required>

<button type="submit">

+ Tambah

</button>

</form>

</div>



<!-- TABLE -->

<div class="flex-1">

<div class="table">

<h4>Daftar Kategori</h4>

<table>

<tr>

<th>No</th>
<th>Nama Kategori</th>
<th>Aksi</th>

</tr>


<?php
$no=1;
foreach($kategori as $k):
?>

<tr>

<td>
<?= $no++ ?>
</td>

<td>

<?= $k->nama_kategori?>

</td>


<td>

<a class="edit"
href="<?= site_url('admin/kategori/edit/'.$k->id_kategori) ?>">

Edit

</a>


<a
class="hapus"
onclick="return confirm('Hapus data?')"

href="<?= site_url('admin/kategori/delete/'.$k->id_kategori) ?>">

Hapus

</a>


</td>

</tr>

<?php endforeach;?>


</table>

</div>

</div>

</div>

</div>


<footer class="footer">

© Sistem Rental Camping

</footer>

</body>
</html>