<?php
/* ---------------------------------------------------------
   partials/header.php
   Panggil dari tiap view admin:
     $this->load->view('admin/partials/header', [
         'title'  => 'Judul Halaman',
         'active' => 'pengembalian'   // key menu yg aktif
     ]);
   --------------------------------------------------------- */
$active = isset($active) ? $active : '';
$title  = isset($title)  ? $title  : 'Admin';

$menu = [
    'dashboard'    => ['Dashboard',        'admin/dashboard',         'ti-layout-dashboard'],
    'kategori'     => ['Kelola Kategori',  'admin/kategori',          'ti-category'],
    'alat'         => ['Kelola Alat',      'admin/alat',              'ti-tent'],
    'pelanggan'    => ['Kelola Pelanggan', 'admin/pelanggan',         'ti-users'],
];
$menu_trx = [
    'transaksi' => ['Kelola Transaksi', 'admin/transaksi',         'ti-clipboard-check'],
    'history'   => ['History',          'admin/transaksi/history', 'ti-history'],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> — Camping Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin/admin.css'); ?>">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <div class="logo">RC</div>
            <span>Camping<br>Admin</span>
        </div>

        <?php foreach ($menu as $key => $m): ?>
            <a href="<?= site_url($m[1]) ?>" class="<?= $active === $key ? 'active' : '' ?>">
                <i class="ti <?= $m[2] ?>"></i><span><?= $m[0] ?></span>
            </a>
        <?php endforeach; ?>

        <div class="menu-title">TRANSAKSI</div>

        <?php foreach ($menu_trx as $key => $m): ?>
            <a href="<?= site_url($m[1]) ?>" class="<?= $active === $key ? 'active' : '' ?>">
                <i class="ti <?= $m[2] ?>"></i><span><?= $m[0] ?></span>
            </a>
        <?php endforeach; ?>

        <a href="javascript:void(0)" class="logout" onclick="logout('<?= base_url() ?>')">
            <i class="ti ti-logout"></i><span>Logout</span>
        </a>

    </aside>

    <!-- MAIN -->
    <div class="main">

        <div class="topbar">
            <h3><?= $title ?></h3>
            <div class="user">
                <i class="ti ti-user"></i>
                <?= $this->session->userdata('username'); ?>
                (<?= $this->session->userdata('role'); ?>)
            </div>
        </div>

        <div class="content">