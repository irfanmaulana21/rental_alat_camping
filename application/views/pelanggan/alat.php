<!DOCTYPE html>
<html lang="id">
<head>
    <title>Alat Camping</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= base_url('assets/css/pelanggan/alat.css?v='.time()); ?>">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

<!-- BASE URL for JS -->
<input type="hidden" id="baseUrl" value="<?= base_url(); ?>">

<!--NAVBAR-->
<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <a href="<?= site_url('pelanggan/home'); ?>" class="nav-back">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            <span>Kembali</span>
        </a>

        <div class="logo">
            <span class="logo-text">R<em>C</em>.</span>
            <span class="logo-text">Rental<em>Camping</em></span>
        </div>

        <div class="nav-right">
            <span class="item-count-badge" id="itemCountBadge">
                <span id="visibleCount"><?= count($alat); ?></span> alat
            </span>
        </div>
    </div>
</nav>

<!--PAGE HEADER-->
<div class="page-header">
    <div class="page-header-inner">
        <div data-aos="fade-up">
            <p class="page-label">Koleksi Lengkap</p>
            <h1 class="page-title">Pilih Peralatan<br><em>Camping-mu</em></h1>
        </div>

        <!-- SEARCH -->
        <div class="search-wrap" data-aos="fade-up" data-aos-delay="100">
            <div class="search-box">
                <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input type="text" placeholder="Cari alat camping..." id="searchInput" autocomplete="off">
                <button class="search-clear" id="searchClear" aria-label="Hapus pencarian">✕</button>
            </div>
        </div>
    </div>
</div>

<!-- FILTER KATEGORI -->
<div class="filter-bar">
    <div class="filter-inner">
        <?php $activeKategori = $activeKategori ?? 0; ?>

        <a href="<?= base_url('index.php/pelanggan/alat'); ?>"
           class="filter-pill <?= ($activeKategori == 0) ? 'active' : '' ?>">
            <span class="pill-dot"></span> Semua
        </a>

        <?php foreach ($kategori as $k) { ?>
            <a href="<?= base_url('index.php/pelanggan/alat/filter/' . $k->id_kategori); ?>"
               class="filter-pill <?= ($activeKategori == $k->id_kategori) ? 'active' : '' ?>">
                <?= $k->nama_kategori; ?>
            </a>
        <?php } ?>
    </div>
</div>

<!-- MAIN CONTENT -->
<main class="container">

    <!-- GRID ALAT -->
    <div class="grid" id="grid-alat">

        <?php foreach ($alat as $i => $a) { ?>

            <div class="product-card"
                 data-name="<?= strtolower($a->nama_alat); ?>"
                 data-aos="fade-up"
                 data-aos-delay="<?= min($i * 60, 400); ?>">

                <!-- IMAGE -->
                <div class="img-box">
                    <img
                        src="<?= base_url('assets/image/alat/') . $a->gambar; ?>"
                        alt="<?= $a->nama_alat; ?>"
                        loading="lazy"
                    >

                   <?php if($a->status=="Belum Tersedia"){ ?>

    <span class="badge badge-sold">
        Belum Tersedia
    </span>

<?php } elseif($a->status=="Disewa"){ ?>

    <span class="badge badge-sold">
        Disewa
    </span>

<?php } elseif($a->stok > 0){ ?>

    <span class="badge badge-stock">
        <span class="badge-dot"></span>
        Stok <?= $a->stok; ?>
    </span>

<?php } else { ?>

    <span class="badge badge-sold">
        Stok Habis
    </span>

<?php } ?>

                    <div class="img-overlay"></div>
                </div>

                <!-- CARD BODY -->
                <div class="card-body">
                    <h3 class="product-name"><?= $a->nama_alat; ?></h3>

                    <div class="price-row">
                        <div>
                            <p class="price">Rp <?= number_format($a->harga_sewa); ?></p>
                            <span class="per-day">/hari</span>
                        </div>
                        <?php if($a->status=="Tersedia"){ ?>

    <span class="tersedia">
        Tersedia
    </span>

<?php } elseif($a->status=="Disewa"){ ?>

    <span class="disewa">
        Disewa
    </span>

<?php } else { ?>

    <span class="belum">
        Belum Tersedia
    </span>

<?php } ?>
                    </div>

                    <?php if($a->status=="Belum Tersedia"){ ?>

<button class="btn-rent btn-disabled" disabled>
    Belum Tersedia
</button>

<?php } elseif($a->status=="Disewa"){ ?>

<button class="btn-rent btn-disabled" disabled>
    Disewa
</button>

<?php } elseif($a->stok <= 0){ ?>

<button class="btn-rent btn-disabled" disabled>
    Stok Habis
</button>

<?php } else { ?>

<button class="btn-rent">
    <svg width="16" height="16" viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2.5">

    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18M16 10a4 4 0 01-8 0"/>

    </svg>

    Sewa Sekarang
</button>

<?php } ?>

                </div>

            </div>

        <?php } ?>

    </div>

    <!-- NOT FOUND -->
    <div id="notFound" class="not-found" style="display:none;">
        <div class="not-found-inner">
            <span class="not-found-icon">🔍</span>
            <h3>Produk Tidak Ditemukan</h3>
            <p>Coba kata kunci lain atau pilih kategori berbeda.</p>
            <button onclick="document.getElementById('searchInput').value=''; document.getElementById('searchInput').dispatchEvent(new Event('input'));" class="btn-reset">Reset Pencarian</button>
        </div>
    </div>

</main>

<!--FOOTER MINI -->
<footer class="footer-mini">
    <p>© <?= date('Y'); ?> Sistem Rental Alat Camping</p>
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="<?= base_url('assets/js/pelanggan/alat.js'); ?>"></script>

</body>
</html>