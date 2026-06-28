<!DOCTYPE html>
<html lang="id">
<head>
    <title>Sewa Alat Camping</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <link rel="stylesheet" href="<?= base_url('assets/css/pelanggan/home.css?v='.time()); ?>">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
    <div class="nav-inner">
        <div class="logo">
            <span class="logo-text">R<em>C</em>.</span>
            <span class="logo-text">Rental<em>Camping</em></span>
        </div>

        <div class="menu">
            <a href="<?= base_url('index.php/pelanggan/home'); ?>" class="nav-link active">Home</a>
            <a href="<?= base_url('index.php/pelanggan/about'); ?>" class="nav-link">About</a>
            <a href="<?= base_url('index.php/pelanggan/alat'); ?>" class="nav-link">Alat</a>
            <a href="<?= base_url('index.php/pelanggan/pemesanan/riwayat'); ?>" class="nav-link">Pesanan Saya</a>
            <div class="nav-divider"></div>
            <span class="welcome-chip">
                <span class="welcome-dot"></span>
                <?= $this->session->userdata('username'); ?>
            </span>
            <a href="<?= base_url('index.php/pelanggan/logout'); ?>" class="logout-btn">Logout</a>
        </div>

        <button class="hamburger" id="hamburger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- MOBILE MENU -->
<div class="mobile-menu" id="mobileMenu">
    <a href="<?= base_url('index.php/pelanggan/home'); ?>">Home</a>
    <a href="<?= base_url('index.php/pelanggan/alat'); ?>">Alat Camping</a>
    <a href="<?= base_url('index.php/pelanggan/pemesanan/riwayat'); ?>">Pesanan Saya</a>
    <a href="<?= base_url('index.php/pelanggan/logout'); ?>" class="mobile-logout">Logout</a>
</div>

<!-- HERO -->
<section class="hero" style="background-image:url('<?= base_url('assets/image/bener/background.jpeg'); ?>');">
    <div class="hero-overlay"></div>
    <div class="hero-noise"></div>

    <div class="hero-content" data-aos="fade-up" data-aos-duration="1200">
        <div class="hero-badge">Petualangan Terbaik Dimulai Di Sini</div>
        <h1>Sewa Alat Camping<br><em>Mudah, Cepat & Terpercaya</em></h1>
        <p>Dari tenda hingga sleeping bag — semua perlengkapan<br>siap menemani petualanganmu.</p>

        <div class="hero-actions">
            <a href="<?= base_url('index.php/pelanggan/alat'); ?>" class="btn-primary">
                <span>Lihat Alat Camping</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <a href="#features" class="btn-ghost">Pelajari Lebih Lanjut</a>
        </div>
    </div>

    <div class="hero-scroll-hint">
        <div class="scroll-line"></div>
        <span>Scroll</span>
    </div>

    <!-- Floating stats -->
    <div class="hero-stats" data-aos="fade-up" data-aos-delay="400">
       <!-- <div class="stat-pill">
            <strong>200+</strong>
            <span>Alat Tersedia</span>
        </div>
        <div class="stat-pill">
            <strong>500+</strong>
            <span>Pelanggan Puas</span>
        </div>
        <div class="stat-pill">
            <strong>4.9★</strong>
            <span>Rating</span>
        </div>
    </div>-->
</section>

<!-- FEATURES -->
<section class="features-section" id="features">
    <div class="section-label" data-aos="fade-up">Kenapa RC?</div>
    <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">Solusi Camping yang Simpel</h2>

    <div class="features-grid">
        <div class="feature-card" data-aos="fade-up" data-aos-delay="0">
            <div class="feature-icon-wrap" style="background:#E8F5E9;">
                <span>1</span>
            </div>
            <h3>Pemesanan Cepat</h3>
            <p>Pilih alat, tentukan tanggal, dan pesan — hanya dalam beberapa klik tanpa ribet.</p>
        </div>

        <div class="feature-card featured" data-aos="fade-up" data-aos-delay="120">
            <div class="feature-icon-wrap" style="background:rgba(255,255,255,0.15);">
                <span>2</span>
            </div>
            <h3>Perlengkapan Lengkap</h3>
            <p>Tenda, carrier, kompor, sleeping bag, dan puluhan peralatan camping lainnya.</p>
        </div>

        <div class="feature-card" data-aos="fade-up" data-aos-delay="240">
            <div class="feature-icon-wrap" style="background:#FFF3E0;">
                <span>3</span>
            </div>
            <h3>Terawat & Aman</h3>
            <p>Setiap alat dicek kualitasnya sebelum disewa agar perjalananmu aman.</p>
        </div>
    </div>
</section>

<!-- SECTION 1 – HIKING -->
<section class="content-section" data-aos="fade-up">
    <div class="cs-image-wrap">
        <img src="<?= base_url('assets/image/bener/hiking.jpeg'); ?>" alt="Hiking">
        <div class="cs-image-accent accent-green"></div>
    </div>
    <div class="cs-text" data-aos="fade-left" data-aos-delay="200">
        <span class="tag">Hiking & Trekking</span>
        <h2>Petualangan di Alam Bebas</h2>
        <p>Rasakan pengalaman mendaki dan menjelajah alam yang lebih seru dengan perlengkapan yang tepat dan terpercaya.</p>
        <ul class="check-list">
            <li>Sepatu & sandal gunung</li>
            <li>Trekking pole & carrier</li>
            <li>Raincover & jas hujan</li>
        </ul>
    </div>
</section>

<!-- SECTION 2 – ALAT -->
<section class="content-section reverse" data-aos="fade-up">
    <div class="cs-image-wrap">
        <img src="<?= base_url('assets/image/bener/alat.jpg'); ?>" alt="Alat Camping">
        <div class="cs-image-accent accent-brown"></div>
    </div>
    <div class="cs-text" data-aos="fade-right" data-aos-delay="200">
        <span class="tag">Peralatan</span>
        <h2>Peralatan Lengkap & Siap Pakai</h2>
        <p>Tidak perlu beli — cukup sewa. Tenda dome, sleeping bag, matras, kompor, dan perlengkapan lainnya sudah siap untukmu.</p>
        <ul class="check-list">
            <li>Tenda dome & flysheet</li>
            <li>Sleeping bag & matras</li>
            <li>Kompor & nesting</li>
        </ul>
    </div>
</section>

<!-- SECTION 3 – TESTIMONI-->
<section class="content-section" data-aos="fade-up">
    <div class="cs-image-wrap">
        <img src="<?= base_url('assets/image/bener/testimoni.jpeg'); ?>" alt="Pelanggan Bahagia">
        <div class="cs-image-accent accent-blue"></div>
    </div>
    <div class="cs-text" data-aos="fade-left" data-aos-delay="200">
        <span class="tag">Testimoni</span>
        <h2> Pelanggan Sudah Puas</h2>
        <p>Pelanggan kami kembali lagi karena pengalaman sewa yang mudah, alat yang berkualitas, dan layanan yang ramah.</p>
        <div class="testimonial-quote">
            <p>"RC beneran memudahkan persiapan hiking kami. Rekomen banget!"</p>
            <span>— Irfan Maulana, pendaki </span>
        </div>
    </div>
</section>

<!-- CTA BANNER -->
<section class="cta-banner" data-aos="zoom-in">
    <div class="cta-inner">
        <img src="<?= base_url('assets/image/bener/bener.jpeg'); ?>" alt="CTA" class="cta-bg-img">
        <div class="cta-overlay"></div>
        <div class="cta-content">
            <h2>Siap Memulai Petualangan?</h2>
            <p>Semua perlengkapan camping sudah siap untuk kamu sewa sekarang juga.</p>
            <a href="<?= base_url('index.php/pelanggan/alat'); ?>" class="btn-primary btn-large">
                <span>Sewa Sekarang</span>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <span class="logo-icon"></span>
            <span class="logo-text">Rental<em>Camping</em></span>
        </div>
        <p class="footer-copy">© <?= date('Y'); ?> Sistem Rental Alat Camping</p>
        <div class="footer-links">
            <a href="<?= base_url('index.php/pelanggan/home'); ?>">Home</a>
            <a href="<?= base_url('index.php/pelanggan/about'); ?>">About</a>
            <a href="<?= base_url('index.php/pelanggan/alat'); ?>">Alat</a>
            <a href="<?= base_url('index.php/pelanggan/pemesanan/riwayat'); ?>">Pesanan Saya</a>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="<?= base_url('assets/js/pelanggan/home.js'); ?>"></script>

</body>
</html>