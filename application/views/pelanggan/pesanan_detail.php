<!DOCTYPE html>
<html lang="id">
<head>
    <title>Detail Pesanan — Rental Camping</title>
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
    .nav-inner{max-width:640px;margin:0 auto;padding:18px 24px;display:flex;align-items:center;justify-content:space-between;gap:16px}
    .nav-back{display:inline-flex;align-items:center;gap:8px;text-decoration:none;color:var(--green-dark);font-weight:600;font-size:.95rem;background:var(--green-soft);padding:9px 18px;border-radius:999px;transition:transform .15s,background .15s}
    .nav-back:hover{transform:translateX(-3px);background:#d6ecdf}
    .logo{display:flex;gap:6px;font-family:'Playfair Display',serif;font-weight:900;font-size:1.35rem;color:var(--green-dark)}
    .logo em{color:var(--green)}
    .nav-spacer{width:110px}
    .container{max-width:640px;margin:0 auto;padding:40px 24px 64px}

    .head{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:24px;flex-wrap:wrap}
    .head .kode{font-family:'Playfair Display',serif;font-weight:900;font-size:1.7rem;color:var(--green-dark)}
    .badge{padding:5px 14px;border-radius:999px;font-size:.8rem;font-weight:600}
    .b-amber{background:var(--amber-soft);color:var(--amber)}
    .b-blue{background:var(--blue-soft);color:var(--blue)}
    .b-green{background:var(--green-soft);color:var(--green)}
    .b-red{background:var(--red-soft);color:var(--red)}

    .card{background:var(--white);border:1px solid var(--line);border-radius:22px;padding:24px;margin-bottom:18px;box-shadow:0 18px 40px -32px rgba(21,64,46,.4)}
    .card h2{font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--green-dark);margin-bottom:16px}
    .row{display:flex;justify-content:space-between;font-size:.92rem;margin-bottom:11px;gap:10px}
    .row .lbl{color:var(--muted)}
    .row .val{font-weight:500;text-align:right}
    .total{border-top:1px dashed #cdd8d1;margin-top:6px;padding-top:14px}
    .total .lbl{font-weight:600;color:var(--green-dark)}
    .total .val{font-family:'Playfair Display',serif;font-weight:700;font-size:1.3rem;color:var(--green-dark)}

    .bukti-img{width:100%;border-radius:14px;border:1px solid var(--line);margin-top:6px;display:block}
    .bukti-link{display:inline-block;margin-top:10px;font-size:.85rem;color:var(--green);text-decoration:none}
    .bukti-link:hover{text-decoration:underline}

    .instr{background:var(--green-soft);border-radius:14px;padding:16px 18px;font-size:.9rem;color:#33493d}
    .instr strong{color:var(--green-dark)}

    .btn-back{display:inline-block;margin-top:8px;background:var(--white);border:1.5px solid var(--line);color:var(--green-dark);text-decoration:none;padding:13px 22px;border-radius:13px;font-weight:600;transition:border-color .15s}
    .btn-back:hover{border-color:#bcd9c8}
    @media (prefers-reduced-motion:reduce){*{transition:none!important}}
    </style>
</head>
<body>

<?php
function badgeClass($status) {
    $s = strtolower($status);
    if (strpos($s, 'tolak') !== false || strpos($s, 'batal') !== false) return 'b-red';
    if (strpos($s, 'selesai') !== false || strpos($s, 'setuju') !== false || strpos($s, 'lunas') !== false || strpos($s, 'disewa') !== false) return 'b-green';
    if (strpos($s, 'verifikasi') !== false) return 'b-blue';
    return 'b-amber';
}
?>

<nav class="navbar">
    <div class="nav-inner">
        <a href="<?= base_url('index.php/pelanggan/pemesanan/riwayat'); ?>" class="nav-back">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            <span>Pesanan Saya</span>
        </a>
        <div class="logo"><span>R<em>C</em>.</span><span>Rental<em>Camping</em></span></div>
        <div class="nav-spacer"></div>
    </div>
</nav>

<div class="container">

    <div class="head">
        <span class="kode">#TRX<?= str_pad($trx->id_transaksi, 4, '0', STR_PAD_LEFT); ?></span>
        <span class="badge <?= badgeClass($trx->status); ?>"><?= $trx->status; ?></span>
    </div>

    <!-- ITEM -->
    <div class="card">
        <h2>Alat yang Disewa</h2>
        <?php foreach ($detail as $d): ?>
            <div class="row">
                <span class="lbl"><?= $d->nama_alat; ?> (<?= $d->jumlah; ?> unit)</span>
                <span class="val">Rp <?= number_format($d->subtotal, 0, ',', '.'); ?></span>
            </div>
        <?php endforeach; ?>
        <div class="row"><span class="lbl">Tanggal sewa</span><span class="val"><?= date('d M Y', strtotime($trx->tanggal_sewa)); ?></span></div>
        <div class="row"><span class="lbl">Tanggal kembali</span><span class="val"><?= date('d M Y', strtotime($trx->tanggal_kembali)); ?></span></div>
        <div class="row total"><span class="lbl">Total</span><span class="val">Rp <?= number_format($trx->total_harga, 0, ',', '.'); ?></span></div>
    </div>

    <!-- PEMBAYARAN -->
    <div class="card">
        <h2>Pembayaran</h2>
        <div class="row"><span class="lbl">Metode</span><span class="val"><?= $trx->metode_bayar; ?></span></div>
        <div class="row"><span class="lbl">Status bayar</span><span class="val"><?= $trx->status_pembayaran; ?></span></div>
        <?php if (!empty($trx->tanggal_bayar)): ?>
            <div class="row"><span class="lbl">Tanggal bayar</span><span class="val"><?= date('d M Y', strtotime($trx->tanggal_bayar)); ?></span></div>
        <?php endif; ?>

        <?php if (!empty($trx->bukti_bayar)): ?>
            <div style="margin-top:14px">
                <span class="lbl" style="font-size:.85rem;color:var(--muted)">Bukti pembayaran:</span>
                <img class="bukti-img" src="<?= base_url('assets/image/bukti/') . $trx->bukti_bayar; ?>" alt="Bukti pembayaran">
                <a class="bukti-link" href="<?= base_url('assets/image/bukti/') . $trx->bukti_bayar; ?>" target="_blank">Buka gambar ukuran penuh &rarr;</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- INSTRUKSI -->
    <div class="instr">
        <?php if ($trx->metode_bayar === 'COD'): ?>
            <strong>Bayar di tempat.</strong> Siapkan uang pas Rp <?= number_format($trx->total_harga, 0, ',', '.'); ?> saat mengambil barang.
        <?php elseif (stripos($trx->status, 'verifikasi') !== false): ?>
            <strong>Menunggu verifikasi.</strong> Bukti pembayaranmu sedang dicek admin. Kamu akan dikonfirmasi setelah pembayaran disetujui.
        <?php else: ?>
            Status pesanan: <strong><?= $trx->status; ?></strong>.
        <?php endif; ?>
    </div>

    <a href="<?= base_url('index.php/pelanggan/pemesanan/riwayat'); ?>" class="btn-back">&larr; Kembali ke daftar pesanan</a>

</div>

</body>
</html>