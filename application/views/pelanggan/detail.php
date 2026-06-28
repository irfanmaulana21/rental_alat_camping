<!DOCTYPE html>
<html lang="id">
<head>
    <title><?= $alat->nama_alat; ?> — Rental Camping</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    :root{
        --green-dark:#15402e;
        --green:#2f8a5f;
        --green-soft:#e3f3ea;
        --coral:#e8743b;
        --coral-dark:#d4602b;
        --cream:#f6f4ec;
        --ink:#23332b;
        --muted:#6b7a72;
        --line:#e6e2d6;
        --white:#ffffff;
    }
    *{box-sizing:border-box;margin:0;padding:0}
    body{
        font-family:'DM Sans',sans-serif;
        background:var(--cream);
        color:var(--ink);
        line-height:1.6;
    }
    em{font-style:normal}

    /* NAVBAR */
    .navbar{
        background:rgba(246,244,236,.85);
        backdrop-filter:blur(10px);
        border-bottom:1px solid var(--line);
        position:sticky;top:0;z-index:50;
    }
    .nav-inner{
        max-width:1100px;margin:0 auto;padding:18px 24px;
        display:flex;align-items:center;justify-content:space-between;gap:16px;
    }
    .nav-back{
        display:inline-flex;align-items:center;gap:8px;
        text-decoration:none;color:var(--green-dark);font-weight:600;font-size:.95rem;
        background:var(--green-soft);padding:9px 18px;border-radius:999px;
        transition:transform .15s ease,background .15s ease;
    }
    .nav-back:hover{transform:translateX(-3px);background:#d6ecdf}
    .logo{display:flex;gap:6px;font-family:'Playfair Display',serif;font-weight:900;font-size:1.35rem;color:var(--green-dark)}
    .logo em{color:var(--green)}
    .nav-spacer{width:120px}

    /* LAYOUT */
    .container{max-width:1100px;margin:0 auto;padding:48px 24px 64px}
    .breadcrumb{font-size:.85rem;color:var(--muted);margin-bottom:28px}
    .breadcrumb a{color:var(--green);text-decoration:none}
    .breadcrumb a:hover{text-decoration:underline}

    .detail-grid{
        display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:start;
    }

    /* IMAGE */
    .media{position:relative;border-radius:24px;overflow:hidden;box-shadow:0 24px 60px -28px rgba(21,64,46,.45)}
    .media img{width:100%;height:480px;object-fit:cover;display:block}
    .media .badge{
        position:absolute;top:18px;left:18px;
        padding:8px 16px;border-radius:999px;font-size:.8rem;font-weight:600;
        background:var(--white);display:inline-flex;align-items:center;gap:7px;
    }
    .badge-ok{color:var(--green)}
    .badge-ok .dot{width:8px;height:8px;border-radius:50%;background:var(--green)}
    .badge-no{color:var(--coral-dark)}

    /* INFO */
    .eyebrow{
        text-transform:uppercase;letter-spacing:.12em;font-size:.75rem;font-weight:600;
        color:var(--green);margin-bottom:12px;
    }
    .title{font-family:'Playfair Display',serif;font-weight:900;font-size:2.6rem;line-height:1.1;color:var(--green-dark);margin-bottom:18px}
    .price-block{display:flex;align-items:baseline;gap:8px;margin-bottom:20px}
    .price{font-family:'Playfair Display',serif;font-weight:700;font-size:2rem;color:var(--ink)}
    .per-day{color:var(--muted);font-size:1rem}
    .status-line{display:flex;align-items:center;gap:10px;margin-bottom:24px;font-size:.9rem}
    .pill{padding:5px 14px;border-radius:999px;font-weight:600;font-size:.82rem}
    .pill-ok{background:var(--green-soft);color:var(--green)}
    .pill-no{background:#fde8df;color:var(--coral-dark)}
    .stok-text{color:var(--muted)}
    .desc{color:#4a5852;margin-bottom:0;padding-top:20px;border-top:1px solid var(--line)}

    /* FORM CARD */
    .rent-card{
        background:var(--white);border-radius:24px;padding:28px;margin-top:30px;
        border:1px solid var(--line);box-shadow:0 18px 40px -30px rgba(21,64,46,.4);
    }
    .rent-card h2{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--green-dark);margin-bottom:20px}
    .field{margin-bottom:18px}
    .field label{display:block;font-size:.85rem;font-weight:600;color:var(--ink);margin-bottom:7px}
    .field input{
        width:100%;padding:12px 14px;border:1.5px solid var(--line);border-radius:12px;
        font-family:'DM Sans',sans-serif;font-size:.95rem;color:var(--ink);background:#fafaf7;
        transition:border-color .15s ease;
    }
    .field input:focus{outline:none;border-color:var(--green)}
    .field-row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    .hint{font-size:.78rem;color:var(--muted);margin-top:6px}
    .err{font-size:.8rem;color:var(--coral-dark);margin-top:6px;display:none}

    .summary{
        background:var(--green-soft);border-radius:14px;padding:16px 18px;margin:22px 0;
    }
    .summary-row{display:flex;justify-content:space-between;font-size:.88rem;color:#3f5249;margin-bottom:8px}
    .summary-row:last-child{margin-bottom:0}
    .summary-total{border-top:1px dashed #b9d8c6;padding-top:12px;margin-top:4px}
    .summary-total .label{font-weight:600;color:var(--green-dark)}
    .summary-total .val{font-family:'Playfair Display',serif;font-weight:700;font-size:1.35rem;color:var(--green-dark)}

    .btn-submit{
        width:100%;border:none;cursor:pointer;
        background:var(--coral);color:#fff;font-family:'DM Sans',sans-serif;font-weight:600;font-size:1rem;
        padding:15px;border-radius:14px;display:flex;align-items:center;justify-content:center;gap:9px;
        transition:background .15s ease,transform .15s ease;
    }
    .btn-submit:hover{background:var(--coral-dark);transform:translateY(-2px)}
    .btn-submit:disabled{background:#cfcfc7;cursor:not-allowed;transform:none}

    .unavailable{
        background:#fdf3ee;border:1px solid #f6d8c8;border-radius:16px;padding:22px;margin-top:30px;
        text-align:center;color:var(--coral-dark);
    }
    .unavailable strong{display:block;font-size:1.05rem;margin-bottom:4px}

    /* FOOTER */
    .footer-mini{background:var(--green-dark);color:#cfe3d6;text-align:center;padding:22px;font-size:.85rem;margin-top:40px}

    /* RESPONSIVE */
    @media (max-width:820px){
        .detail-grid{grid-template-columns:1fr;gap:28px}
        .media img{height:320px}
        .title{font-size:2rem}
        .nav-spacer{display:none}
    }
    @media (prefers-reduced-motion:reduce){
        *{transition:none!important}
    }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="nav-inner">
        <a href="<?= base_url('index.php/pelanggan/alat'); ?>" class="nav-back">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
            <span>Kembali</span>
        </a>
        <div class="logo">
            <span>R<em>C</em>.</span><span>Rental<em>Camping</em></span>
        </div>
        <div class="nav-spacer"></div>
    </div>
</nav>

<div class="container">

    <!-- BREADCRUMB -->
    <p class="breadcrumb">
        <a href="<?= base_url('index.php/pelanggan/alat'); ?>">Alat</a> &nbsp;/&nbsp;
        <?= $alat->nama_kategori; ?> &nbsp;/&nbsp;
        <span><?= $alat->nama_alat; ?></span>
    </p>

    <div class="detail-grid">

        <!-- KIRI: GAMBAR -->
        <div class="media">
            <img src="<?= base_url('assets/image/alat/') . $alat->gambar; ?>" alt="<?= $alat->nama_alat; ?>">
            <?php if ($alat->status == "Tersedia" && $alat->stok > 0) { ?>
                <span class="badge badge-ok"><span class="dot"></span> Tersedia</span>
            <?php } else { ?>
                <span class="badge badge-no"><?= ($alat->status == "Disewa") ? 'Disewa' : 'Belum Tersedia'; ?></span>
            <?php } ?>
        </div>

        <!-- KANAN: INFO -->
        <div class="info">
            <p class="eyebrow"><?= $alat->nama_kategori; ?></p>
            <h1 class="title"><?= $alat->nama_alat; ?></h1>

            <div class="price-block">
                <span class="price">Rp <?= number_format($alat->harga_sewa, 0, ',', '.'); ?></span>
                <span class="per-day">/ hari</span>
            </div>

            <div class="status-line">
                <?php if ($alat->status == "Tersedia" && $alat->stok > 0) { ?>
                    <span class="pill pill-ok">Tersedia</span>
                    <span class="stok-text">Stok tersisa: <?= $alat->stok; ?> unit</span>
                <?php } else { ?>
                    <span class="pill pill-no"><?= ($alat->status == "Disewa") ? 'Sedang disewa' : 'Belum tersedia'; ?></span>
                <?php } ?>
            </div>

            <?php if (isset($alat->deskripsi) && trim($alat->deskripsi) !== '') { ?>
                <p class="desc"><?= nl2br($alat->deskripsi); ?></p>
            <?php } else { ?>
                <p class="desc">Peralatan camping berkualitas dan siap sewa. Hubungi kami untuk info lebih lanjut soal kondisi barang.</p>
            <?php } ?>

            <!-- FORM SEWA / STATUS -->
            <?php if ($alat->status == "Tersedia" && $alat->stok > 0) { ?>

                <div class="rent-card">
                    <h2>Atur Penyewaan</h2>

                    <!-- action di-arahin ke controller Pemesanan (tahap berikutnya) -->
                    <form id="formSewa" method="post" action="<?= base_url('index.php/pelanggan/pemesanan'); ?>">

                        <input type="hidden" name="id_alat" value="<?= $alat->id_alat; ?>">
                        <input type="hidden" name="harga_sewa" value="<?= $alat->harga_sewa; ?>">

                        <div class="field-row">
                            <div class="field">
                                <label for="tgl_mulai">Tanggal mulai</label>
                                <input type="date" id="tgl_mulai" name="tgl_mulai" required>
                            </div>
                            <div class="field">
                                <label for="tgl_selesai">Tanggal selesai</label>
                                <input type="date" id="tgl_selesai" name="tgl_selesai" required>
                            </div>
                        </div>
                        <p class="err" id="errTanggal">Tanggal selesai harus setelah tanggal mulai.</p>

                        <div class="field">
                            <label for="jumlah">Jumlah unit</label>
                            <input type="number" id="jumlah" name="jumlah" value="1" min="1" max="<?= $alat->stok; ?>" required>
                            <p class="hint">Maksimal <?= $alat->stok; ?> unit (sesuai stok).</p>
                        </div>

                        <div class="summary">
                            <div class="summary-row">
                                <span>Harga per hari</span>
                                <span>Rp <?= number_format($alat->harga_sewa, 0, ',', '.'); ?></span>
                            </div>
                            <div class="summary-row">
                                <span>Lama sewa</span>
                                <span id="sumHari">— hari</span>
                            </div>
                            <div class="summary-row">
                                <span>Jumlah unit</span>
                                <span id="sumUnit">1 unit</span>
                            </div>
                            <div class="summary-row summary-total">
                                <span class="label">Total</span>
                                <span class="val" id="sumTotal">Rp 0</span>
                            </div>
                        </div>

                        <button type="submit" class="btn-submit" id="btnSewa" disabled>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            Lanjut ke Pemesanan
                        </button>
                    </form>
                </div>

            <?php } else { ?>

                <div class="unavailable">
                    <strong><?= ($alat->status == "Disewa") ? 'Alat sedang disewa' : 'Alat belum tersedia'; ?></strong>
                    Cek alat lain atau kembali lagi nanti ya.
                </div>

            <?php } ?>

        </div>
    </div>
</div>

<footer class="footer-mini">
    <p>© <?= date('Y'); ?> Sistem Rental Alat Camping</p>
</footer>

<script>
(function () {
    var hargaPerHari = <?= (int) $alat->harga_sewa; ?>;
    var stokMax      = <?= (int) $alat->stok; ?>;

    var elMulai   = document.getElementById('tgl_mulai');
    var elSelesai = document.getElementById('tgl_selesai');
    var elJumlah  = document.getElementById('jumlah');
    if (!elMulai) return; // form gak dirender (alat gak tersedia)

    var elHari   = document.getElementById('sumHari');
    var elUnit   = document.getElementById('sumUnit');
    var elTotal  = document.getElementById('sumTotal');
    var elErr    = document.getElementById('errTanggal');
    var btn      = document.getElementById('btnSewa');

    // tanggal minimal = hari ini
    var today = new Date().toISOString().split('T')[0];
    elMulai.min = today;
    elSelesai.min = today;

    function rupiah(n) {
        return 'Rp ' + n.toLocaleString('id-ID');
    }

    function hitung() {
        var mulai   = elMulai.value;
        var selesai = elSelesai.value;
        var jumlah  = parseInt(elJumlah.value, 10) || 0;

        // batasi jumlah ke stok
        if (jumlah > stokMax) { jumlah = stokMax; elJumlah.value = stokMax; }
        if (jumlah < 1)       { jumlah = 1;       elJumlah.value = 1; }

        elUnit.textContent = jumlah + ' unit';

        var valid = false;
        var hari = 0;

        if (mulai && selesai) {
            var d1 = new Date(mulai);
            var d2 = new Date(selesai);
            var diff = Math.round((d2 - d1) / (1000 * 60 * 60 * 24));

            if (diff <= 0) {
                elErr.style.display = 'block';
                elHari.textContent = '— hari';
            } else {
                elErr.style.display = 'none';
                hari = diff;
                valid = true;
                elHari.textContent = hari + ' hari';
            }
        } else {
            elHari.textContent = '— hari';
        }

        var total = valid ? hargaPerHari * hari * jumlah : 0;
        elTotal.textContent = rupiah(total);
        btn.disabled = !valid;
    }

    [elMulai, elSelesai, elJumlah].forEach(function (el) {
        el.addEventListener('input', hitung);
        el.addEventListener('change', hitung);
    });

    hitung();
})();
</script>

</body>
</html>