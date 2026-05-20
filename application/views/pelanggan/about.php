<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>About Kelompok</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/pelanggan/about.css'); ?>">

    <!-- AOS ANIMATION -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>

<div class="about-container">

    <!-- tombol kembali -->
    <a href="javascript:history.back()" class="back-btn">← Kembali</a>

    <h1 data-aos="fade-down">Tentang Kelompok Kami</h1>

    <p class="subtitle" data-aos="fade-up">
        Berikut adalah anggota kelompok proyek kami
    </p>

    <div class="about-card" data-aos="fade-up">
        <h2>Anggota Kelompok</h2>
        <ul>
            <li>Nama - IRFAN MAULANA</li>
            <li>Nama - KRISNA PRIYA</li>
            <li>Nama - SULTAN YUDISTIRA</li>
            <li>Nama - NAUFAL MUFLIH</li>
        </ul>
    </div>

    <div class="about-card" data-aos="fade-up">
        <h2>Proyek</h2>
        <ul>
            <li>Sistem Rental Alat Camping</li>
            <li>Berbasis CodeIgniter 3</li>
        </ul>
    </div>
    <link rel="stylesheet" href="<?= base_url('assets/css/pelanggan/login.css'); ?>">

</div>

<!-- AOS SCRIPT -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 900,
        once: true
    });
</script>

</body>
</html>