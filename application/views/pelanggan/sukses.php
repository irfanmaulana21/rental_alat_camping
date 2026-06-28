<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pesanan Berhasil — Rental Camping</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    :root{
        --green-dark:#15402e;--green:#2f8a5f;--green-soft:#e3f3ea;
        --coral:#e8743b;--coral-dark:#d4602b;--cream:#f6f4ec;
        --ink:#23332b;--muted:#6b7a72;--line:#e6e2d6;--white:#fff;
    }
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'DM Sans',sans-serif;background:var(--cream);color:var(--ink);line-height:1.6}
    em{font-style:normal}
    .wrap{max-width:560px;margin:0 auto;padding:60px 24px}
    .check{width:84px;height:84px;border-radius:50%;background:var(--green-soft);display:flex;align-items:center;justify-content:center;margin:0 auto 22px;color:var(--green);animation:pop .4s ease}
    @keyframes pop{0%{transform:scale(.6);opacity:0}100%{transform:scale(1);opacity:1}}
    h1{font-family:'Playfair Display',serif;font-weight:900;font-size:2rem;color:var(--green-dark);text-align:center;margin-bottom:6px}
    .sub{text-align:center;color:var(--muted);margin-bottom:8px}
    .kode{text-align:center;margin-bottom:30px;font-size:.9rem;color:var(--muted)}
    .kode strong{color:var(--green-dark);font-family:'Playfair Display',serif;font-size:1.1rem}

    .card{background:var(--white);border:1px solid var(--line);border-radius:22px;padding:26px;box-shadow:0 18px 40px -32px rgba(21,64,46,.4);margin-bottom:20px}
    .card h2{font-family:'Playfair Display',serif;font-size:1.15rem;color:var(--green-dark);margin-bottom:16px}
    .row{display:flex;justify-content:space-between;font-size:.92rem;margin-bottom:11px}
    .row .lbl{color:var(--muted)}
    .row .val{font-weight:500;text-align:right}
    .total{border-top:1px dashed #cdd8d1;margin-top:6px;padding-top:14px}
    .total .lbl{font-weight:600;color:var(--green-dark)}
    .total .val{font-family:'Playfair Display',serif;font-weight:700;font-size:1.3rem;color:var(--green-dark)}
    .pill{display:inline-block;padding:3px 12px;border-radius:999px;font-size:.78rem;font-weight:600;background:#fff3e9;color:var(--coral-dark)}

    .instr{background:var(--green-soft);border-radius:14px;padding:16px 18px;font-size:.9rem;color:#33493d;margin-bottom:26px}
    .instr strong{color:var(--green-dark)}

    .actions{display:flex;gap:12px;flex-wrap:wrap}
    .btn{flex:1;min-width:160px;text-align:center;text-decoration:none;padding:14px;border-radius:14px;font-weight:600;font-size:.95rem;transition:transform .15s,background .15s}
    .btn-primary{background:var(--coral);color:#fff}
    .btn-primary:hover{background:var(--coral-dark);transform:translateY(-2px)}
    .btn-ghost{background:var(--white);color:var(--green-dark);border:1.5px solid var(--line)}
    .btn-ghost:hover{border-color:#bcd9c8;transform:translateY(-2px)}
    @media (prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important}}
    </style>
</head>
<body>

<div class="wrap">

    <div class="check">
        <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M20 6L9 17l-5-5"/></svg>
    </div>

    <h1>Pesanan Berhasil!</h1>
    <p class="sub">Pesanan kamu sudah kami terima.</p>
    <p class="kode">No. Pesanan: <strong>#TRX<?= str_pad($trx->id_transaksi, 4, '0', STR_PAD_LEFT); ?></strong></p>

    <!-- RINGKASAN -->
    <div class="card">
        <h2>Ringkasan</h2>

        <?php foreach ($detail as $d): ?>
            <div class="row">
                <span class="lbl"><?= $d->nama_alat; ?> (<?= $d->jumlah; ?> unit)</span>
                <span class="val">Rp <?= number_format($d->subtotal, 0, ',', '.'); ?></span>
            </div>
        <?php endforeach; ?>

        <div class="row"><span class="lbl">Tanggal sewa</span><span class="val"><?= date('d M Y', strtotime($trx->tanggal_sewa)); ?></span></div>
        <div class="row"><span class="lbl">Tanggal kembali</span><span class="val"><?= date('d M Y', strtotime($trx->tanggal_kembali)); ?></span></div>
        <div class="row"><span class="lbl">Metode bayar</span><span class="val"><?= $trx->metode_bayar; ?></span></div>
        <div class="row"><span class="lbl">Status</span><span class="val"><span class="pill"><?= $trx->status; ?></span></span></div>
        <div class="row total"><span class="lbl">Total</span><span class="val">Rp <?= number_format($trx->total_harga, 0, ',', '.'); ?></span></div>
    </div>

    <!-- INSTRUKSI sesuai metode -->
    <div class="instr">
        <?php if ($trx->metode_bayar === 'COD'): ?>
            <strong>Bayar di tempat.</strong> Siapkan uang pas Rp <?= number_format($trx->total_harga, 0, ',', '.'); ?> saat mengambil barang.
        <?php else: ?>
            <strong>Bukti pembayaran sudah diterima.</strong> Pesanan kamu sedang <strong>menunggu verifikasi admin</strong>. Kamu akan dikonfirmasi setelah pembayaran dicek. Terima kasih sudah membayar di awal!
        <?php endif; ?>
    </div>

    <div class="actions">
        <a href="<?= base_url('index.php/pelanggan/alat'); ?>" class="btn btn-ghost">Lihat Alat Lain</a>
        <a href="<?= base_url('index.php/pelanggan/home'); ?>" class="btn btn-primary">Ke Beranda</a>
    </div>

</div>

</body>
</html>