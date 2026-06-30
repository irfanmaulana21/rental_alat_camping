<!DOCTYPE html>
<html lang="id">
<head>
    <title>Checkout — Rental Camping</title>
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
    .navbar{background:rgba(246,244,236,.85);backdrop-filter:blur(10px);border-bottom:1px solid var(--line);position:sticky;top:0;z-index:50}
    .nav-inner{max-width:780px;margin:0 auto;padding:18px 24px;display:flex;align-items:center;justify-content:space-between;gap:16px}
    .nav-back{display:inline-flex;align-items:center;gap:8px;text-decoration:none;color:var(--green-dark);font-weight:600;font-size:.95rem;background:var(--green-soft);padding:9px 18px;border-radius:999px;transition:transform .15s,background .15s}
    .nav-back:hover{transform:translateX(-3px);background:#d6ecdf}
    .logo{display:flex;gap:6px;font-family:'Playfair Display',serif;font-weight:900;font-size:1.35rem;color:var(--green-dark)}
    .logo em{color:var(--green)}
    .nav-spacer{width:110px}
    .container{max-width:780px;margin:0 auto;padding:44px 24px 64px}
    .page-title{font-family:'Playfair Display',serif;font-weight:900;font-size:2.1rem;color:var(--green-dark);margin-bottom:6px}
    .page-sub{color:var(--muted);margin-bottom:30px}

    .alert-err{background:#fdeccf00;background:#fde8df;border:1px solid #f6d8c8;color:var(--coral-dark);border-radius:14px;padding:14px 18px;margin-bottom:22px;font-size:.9rem;font-weight:500}

    .card{background:var(--white);border:1px solid var(--line);border-radius:22px;padding:26px;margin-bottom:22px;box-shadow:0 18px 40px -32px rgba(21,64,46,.4)}
    .card h2{font-family:'Playfair Display',serif;font-size:1.25rem;color:var(--green-dark);margin-bottom:18px}

    .item-head{display:flex;gap:16px;align-items:center;margin-bottom:18px;padding-bottom:18px;border-bottom:1px solid var(--line)}
    .item-head img{width:74px;height:74px;border-radius:14px;object-fit:cover;flex-shrink:0}
    .item-head .nm{font-weight:600;font-size:1.05rem}
    .item-head .pr{color:var(--muted);font-size:.9rem}
    .sum-row{display:flex;justify-content:space-between;font-size:.92rem;color:#3f5249;margin-bottom:10px}
    .sum-row .lbl{color:var(--muted)}
    .sum-total{border-top:1px dashed #cdd8d1;margin-top:6px;padding-top:14px}
    .sum-total .lbl{font-weight:600;color:var(--green-dark);font-size:1rem}
    .sum-total .val{font-family:'Playfair Display',serif;font-weight:700;font-size:1.5rem;color:var(--green-dark)}

    .pay-opt{display:block;border:1.5px solid var(--line);border-radius:14px;padding:16px 18px;margin-bottom:12px;cursor:pointer;transition:border-color .15s,background .15s}
    .pay-opt:hover{border-color:#bcd9c8}
    .pay-opt input{position:absolute;opacity:0;pointer-events:none}
    .pay-opt .row{display:flex;align-items:center;gap:13px}
    .pay-opt .radio{width:20px;height:20px;border:2px solid #c4cfc8;border-radius:50%;flex-shrink:0;position:relative;transition:border-color .15s}
    .pay-opt .ttl{font-weight:600}
    .pay-opt .desc{font-size:.83rem;color:var(--muted);margin-top:2px}
    .pay-opt.selected{border-color:var(--green);background:var(--green-soft)}
    .pay-opt.selected .radio{border-color:var(--green)}
    .pay-opt.selected .radio::after{content:"";position:absolute;inset:3px;border-radius:50%;background:var(--green)}

    .pay-info{display:none;background:#f4f8f5;border:1px dashed #b9d8c6;border-radius:12px;padding:14px 16px;margin-top:6px;margin-bottom:12px;font-size:.88rem;color:#3f5249}
    .pay-info strong{color:var(--green-dark)}

    .upload-box{display:none;border:1.5px solid var(--line);border-radius:14px;padding:16px 18px;margin-top:4px;background:#fafaf7}
    .upload-box .up-label{display:block;font-size:.88rem;font-weight:600;margin-bottom:9px}
    .upload-box input[type=file]{width:100%;font-size:.88rem;padding:10px;border:1px dashed #c4cfc8;border-radius:10px;background:#fff;cursor:pointer}
    .upload-box .hint{font-size:.78rem;color:var(--muted);margin-top:8px}

    .btn-submit{width:100%;border:none;cursor:pointer;background:var(--coral);color:#fff;font-family:'DM Sans',sans-serif;font-weight:600;font-size:1rem;padding:15px;border-radius:14px;display:flex;align-items:center;justify-content:center;gap:9px;transition:background .15s,transform .15s;margin-top:20px}
    .btn-submit:hover{background:var(--coral-dark);transform:translateY(-2px)}
    .footer-mini{background:var(--green-dark);color:#cfe3d6;text-align:center;padding:22px;font-size:.85rem}
    @media (max-width:560px){.page-title{font-size:1.7rem}.nav-spacer{display:none}}
    @media (prefers-reduced-motion:reduce){*{transition:none!important}}
    </style>
</head>
<body>

<nav class="navbar">
    <div class="nav-inner">
        <a href="<?= base_url('index.php/pelanggan/alat/detail/' . $alat->id_alat); ?>" class="nav-back">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            <span>Kembali</span>
        </a>
        <div class="logo"><span>R<em>C</em>.</span><span>Rental<em>Camping</em></span></div>
        <div class="nav-spacer"></div>
    </div>
</nav>

<div class="container">

    <h1 class="page-title">Konfirmasi Pesanan</h1>
    <p class="page-sub">Cek rincian sewa kamu lalu pilih cara pembayaran.</p>

    <?php if (!empty($error)): ?>
        <div class="alert-err"><?= $error; ?></div>
    <?php endif; ?>

    <form id="formCheckout" method="post" action="<?= base_url('index.php/pelanggan/pemesanan/proses'); ?>" enctype="multipart/form-data">

        <!-- data dibawa dari halaman detail -->
        <input type="hidden" name="id_alat"     value="<?= $alat->id_alat; ?>">
        <input type="hidden" name="tgl_mulai"   value="<?= $tgl_mulai; ?>">
        <input type="hidden" name="tgl_selesai" value="<?= $tgl_selesai; ?>">
        <input type="hidden" name="jumlah"      value="<?= $jumlah; ?>">

        <!-- RINGKASAN -->
        <div class="card">
            <h2>Rincian Sewa</h2>

            <div class="item-head">
                <img src="<?= base_url('assets/image/alat/') . $alat->gambar; ?>" alt="<?= $alat->nama_alat; ?>">
                <div>
                    <div class="nm"><?= $alat->nama_alat; ?></div>
                    <div class="pr">Rp <?= number_format($alat->harga_sewa, 0, ',', '.'); ?> / hari</div>
                </div>
            </div>

            <div class="sum-row"><span class="lbl">Tanggal sewa</span><span><?= date('d M Y', strtotime($tgl_mulai)); ?></span></div>
            <div class="sum-row"><span class="lbl">Tanggal kembali</span><span><?= date('d M Y', strtotime($tgl_selesai)); ?></span></div>
            <div class="sum-row"><span class="lbl">Lama sewa</span><span><?= $hari; ?> hari</span></div>
            <div class="sum-row"><span class="lbl">Jumlah unit</span><span><?= $jumlah; ?> unit</span></div>
            <div class="sum-row sum-total"><span class="lbl">Total</span><span class="val">Rp <?= number_format($total, 0, ',', '.'); ?></span></div>
        </div>

        <!-- METODE BAYAR -->
        <div class="card">
            <h2>Metode Pembayaran</h2>
            <?php $m = $metode ?? ''; ?>

            <label class="pay-opt" data-method="COD">
                <input type="radio" name="metode_bayar" value="COD" required <?= ($m==='COD')?'checked':''; ?>>
                <div class="row">
                    <span class="radio"></span>
                    <div>
                        <div class="ttl">Bayar di Tempat (COD)</div>
                        <div class="desc">Bayar tunai saat mengambil barang.</div>
                    </div>
                </div>
            </label>

            <label class="pay-opt" data-method="Transfer Bank">
                <input type="radio" name="metode_bayar" value="Transfer Bank" <?= ($m==='Transfer Bank')?'checked':''; ?>>
                <div class="row">
                    <span class="radio"></span>
                    <div>
                        <div class="ttl">Transfer Bank</div>
                        <div class="desc">Bayar lunas di awal, upload bukti transfer.</div>
                    </div>
                </div>
            </label>
            <div class="pay-info" id="info-transfer">
                <!-- GANTI dengan rekening asli kalian -->
                Transfer ke: <strong>BCA 1234567890</strong> a.n. Rental Camping, sebesar <strong>Rp <?= number_format($total, 0, ',', '.'); ?></strong>.
            </div>

            <label class="pay-opt" data-method="QRIS">
                <input type="radio"
                    name="metode_bayar"
                    value="QRIS"
                    <?= ($m=='QRIS') ? 'checked' : ''; ?>>

                <div class="row">
                    <span class="radio"></span>

                    <div>
                        <div class="ttl">QRIS</div>
                        <div class="desc">
                            Bayar lunas di awal melalui QRIS.
                        </div>
                    </div>
                </div>
            </label>

            <div class="pay-info" id="info-qris">

                <p style="margin-bottom:15px;">
                    Scan QRIS berikut untuk melakukan pembayaran sebesar
                    <strong>
                        Rp <?= number_format($total,0,',','.'); ?>
                    </strong>
                </p>

                <div style="text-align:center;">

                    <img
                        src="<?= base_url('assets/image/qris/qris.jpeg'); ?>"
                        alt="QRIS"
                        style="
                            width:260px;
                            max-width:100%;
                            background:#fff;
                            border:2px solid #ddd;
                            border-radius:12px;
                            padding:10px;
                            box-shadow:0 8px 20px rgba(0,0,0,.15);
                        ">

                </div>

                <p style="
                    margin-top:15px;
                    color:#666;
                    font-size:14px;
                ">
                    Setelah pembayaran berhasil,
                    silakan upload bukti pembayaran pada kolom di bawah.
                </p>

            </div>

            <!-- UPLOAD BUKTI (muncul cuma kalau bayar online) -->
            <div class="upload-box" id="uploadBox">
                <label class="up-label">Upload Bukti Pembayaran <span style="color:var(--coral-dark)">*</span></label>
                <input type="file" name="bukti_bayar" id="buktiInput" accept="image/*">
                <p class="hint">Format JPG/PNG/WEBP, maksimal 4MB. Wajib untuk pembayaran online — tanpa bukti, pesanan tidak diproses.</p>
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
            Konfirmasi Pesanan
        </button>
    </form>
</div>

<footer class="footer-mini"><p>© <?= date('Y'); ?> Sistem Rental Alat Camping</p></footer>

<script>
(function () {
    var opts = document.querySelectorAll('.pay-opt');
    var infoTransfer = document.getElementById('info-transfer');
    var infoQris = document.getElementById('info-qris');
    var uploadBox = document.getElementById('uploadBox');
    var buktiInput = document.getElementById('buktiInput');

    function refresh() {
        opts.forEach(function (o) {
            var input = o.querySelector('input');
            o.classList.toggle('selected', input.checked);
        });
        var sel = document.querySelector('input[name="metode_bayar"]:checked');
        var v = sel ? sel.value : '';
        var online = (v === 'Transfer Bank' || v === 'QRIS');

        infoTransfer.style.display = (v === 'Transfer Bank') ? 'block' : 'none';
        infoQris.style.display     = (v === 'QRIS') ? 'block' : 'none';

        // tampilkan + wajibkan upload kalau bayar online
        uploadBox.style.display = online ? 'block' : 'none';
        buktiInput.required = online;
    }

    opts.forEach(function (o) {
        o.querySelector('input').addEventListener('change', refresh);
    });
    refresh(); // jalanin di awal (buat kasus pre-selected setelah error)
})();
</script>

</body>
</html>