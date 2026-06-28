<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pesanan Saya — Rental Camping</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    :root{
        --green-dark:#15402e;--green:#2f8a5f;--green-soft:#e3f3ea;
        --coral:#e8743b;--coral-dark:#d4602b;--cream:#f6f4ec;
        --ink:#23332b;--muted:#6b7a72;--line:#e6e2d6;--white:#fff;
        --amber:#b7791f;--amber-soft:#fdf2dc;
        --blue:#2c6e9b;--blue-soft:#e1eef7;
        --red:#c0392b;--red-soft:#fde6e3;
    }
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'DM Sans',sans-serif;background:var(--cream);color:var(--ink);line-height:1.6}
    em{font-style:normal}
    .navbar{background:rgba(246,244,236,.85);backdrop-filter:blur(10px);border-bottom:1px solid var(--line);position:sticky;top:0;z-index:50}
    .nav-inner{max-width:820px;margin:0 auto;padding:18px 24px;display:flex;align-items:center;justify-content:space-between;gap:16px}
    .nav-back{display:inline-flex;align-items:center;gap:8px;text-decoration:none;color:var(--green-dark);font-weight:600;font-size:.95rem;background:var(--green-soft);padding:9px 18px;border-radius:999px;transition:transform .15s,background .15s}
    .nav-back:hover{transform:translateX(-3px);background:#d6ecdf}
    .logo{display:flex;gap:6px;font-family:'Playfair Display',serif;font-weight:900;font-size:1.35rem;color:var(--green-dark)}
    .logo em{color:var(--green)}
    .nav-spacer{width:110px}
    .container{max-width:820px;margin:0 auto;padding:44px 24px 64px}
    .page-title{font-family:'Playfair Display',serif;font-weight:900;font-size:2.1rem;color:var(--green-dark);margin-bottom:6px}
    .page-sub{color:var(--muted);margin-bottom:30px}

    .order{display:flex;gap:18px;background:var(--white);border:1px solid var(--line);border-radius:20px;padding:18px;margin-bottom:16px;text-decoration:none;color:inherit;transition:transform .15s,box-shadow .15s}
    .order:hover{transform:translateY(-2px);box-shadow:0 18px 40px -30px rgba(21,64,46,.45)}
    .order img{width:88px;height:88px;border-radius:14px;object-fit:cover;flex-shrink:0;background:#eee}
    .order .body{flex:1;min-width:0}
    .order .top{display:flex;justify-content:space-between;align-items:flex-start;gap:10px;margin-bottom:4px}
    .order .nm{font-weight:600;font-size:1.05rem}
    .order .kode{font-size:.78rem;color:var(--muted)}
    .order .meta{font-size:.85rem;color:var(--muted);margin-bottom:8px}
    .order .bot{display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap}
    .order .total{font-family:'Playfair Display',serif;font-weight:700;font-size:1.15rem;color:var(--green-dark)}

    .badge{padding:4px 12px;border-radius:999px;font-size:.76rem;font-weight:600;white-space:nowrap}
    .b-amber{background:var(--amber-soft);color:var(--amber)}
    .b-blue{background:var(--blue-soft);color:var(--blue)}
    .b-green{background:var(--green-soft);color:var(--green)}
    .b-red{background:var(--red-soft);color:var(--red)}

    .empty{text-align:center;padding:60px 20px;color:var(--muted)}
    .empty .ic{font-size:3rem;margin-bottom:12px}
    .empty h3{font-family:'Playfair Display',serif;color:var(--green-dark);margin-bottom:6px}
    .btn-cta{display:inline-block;margin-top:18px;background:var(--coral);color:#fff;text-decoration:none;padding:12px 24px;border-radius:12px;font-weight:600;transition:background .15s}
    .btn-cta:hover{background:var(--coral-dark)}

    .footer-mini{background:var(--green-dark);color:#cfe3d6;text-align:center;padding:22px;font-size:.85rem}
    @media (max-width:560px){.page-title{font-size:1.7rem}.nav-spacer{display:none}.order img{width:70px;height:70px}}
    @media (prefers-reduced-motion:reduce){*{transition:none!important}}
    </style>
</head>
<body>

<?php
// helper kecil: status -> warna badge
function badgeClass($status) {
    $s = strtolower($status);
    if (strpos($s, 'tolak') !== false || strpos($s, 'batal') !== false) return 'b-red';
    if (strpos($s, 'selesai') !== false || strpos($s, 'setuju') !== false || strpos($s, 'lunas') !== false || strpos($s, 'disewa') !== false) return 'b-green';
    if (strpos($s, 'verifikasi') !== false) return 'b-blue';
    return 'b-amber'; // menunggu, dll
}
?>

<nav class="navbar">
    <div class="nav-inner">
        <a href="<?= base_url('index.php/pelanggan/home'); ?>" class="nav-back">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            <span>Kembali</span>
        </a>
        <div class="logo"><span>R<em>C</em>.</span><span>Rental<em>Camping</em></span></div>
        <div class="nav-spacer"></div>
    </div>
</nav>

<div class="container">

    <h1 class="page-title">Pesanan Saya</h1>
    <p class="page-sub">Riwayat semua alat yang pernah kamu sewa.</p>

    <?php if (empty($list)): ?>

        <div class="empty">
            <div class="ic">📋</div>
            <h3>Belum ada pesanan</h3>
            <p>Kamu belum menyewa alat apapun. Yuk mulai sewa!</p>
            <a href="<?= base_url('index.php/pelanggan/alat'); ?>" class="btn-cta">Lihat Alat</a>
        </div>

    <?php else: ?>

        <?php foreach ($list as $row): ?>
            <a href="<?= base_url('index.php/pelanggan/pemesanan/lihat/' . $row->id_transaksi); ?>" class="order">

                <img src="<?= base_url('assets/image/alat/') . $row->gambar; ?>" alt="<?= $row->nama_alat; ?>">

                <div class="body">
                    <div class="top">
                        <div>
                            <div class="nm"><?= $row->nama_alat ?? 'Alat'; ?></div>
                            <div class="kode">#TRX<?= str_pad($row->id_transaksi, 4, '0', STR_PAD_LEFT); ?></div>
                        </div>
                        <span class="badge <?= badgeClass($row->status); ?>"><?= $row->status; ?></span>
                    </div>

                    <div class="meta">
                        <?= date('d M Y', strtotime($row->tanggal_sewa)); ?>
                        &rarr;
                        <?= date('d M Y', strtotime($row->tanggal_kembali)); ?>
                        &nbsp;·&nbsp; <?= $row->metode_bayar; ?>
                    </div>

                    <div class="bot">
                        <span class="total">Rp <?= number_format($row->total_harga, 0, ',', '.'); ?></span>
                        <span style="font-size:.85rem;color:var(--muted)">Lihat detail &rarr;</span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>

    <?php endif; ?>

</div>

<footer class="footer-mini"><p>© <?= date('Y'); ?> Sistem Rental Alat Camping</p></footer>

</body>
</html>