<?php
$this->load->view('admin/partials/header', [
    'title'  => 'Dashboard Admin',
    'active' => 'dashboard',
]);
?>

<div class="card">
    <h3>Selamat Datang</h3>
    <p style="color:#6b7280;margin-top:4px;">Sistem Rental Alat Camping</p>
</div>

<div class="card-grid">

    <div class="card-box">
        <h4>Total Alat</h4>
        <h2><?= $total_alat ?></h2>
    </div>

    <div class="card-box" style="border-left-color:#3b82f6;">
        <h4>Kategori</h4>
        <h2><?= $total_kategori ?></h2>
    </div>

    <div class="card-box" style="border-left-color:#f59e0b;">
        <h4>Alat Tersedia</h4>
        <h2><?= $alat_tersedia ?></h2>
    </div>

</div>

<?php $this->load->view('admin/partials/footer'); ?>