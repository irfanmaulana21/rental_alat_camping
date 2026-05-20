<!DOCTYPE html>
<html>
<head>
    <title>Register Pelanggan</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/pelanggan/login.css'); ?>">
</head>
<body>

<div class="container">

    <div class="card">

        <h2>Register Pelanggan</h2>
        <p>Silakan buat akun terlebih dahulu</p>

        <form id="formRegister">

            <input type="text" id="nama" placeholder="Nama">
            <input type="text" id="alamat" placeholder="Alamat">
            <input type="text" id="no_hp" placeholder="No HP">
            <input type="email" id="email" placeholder="Email">

            <input type="text" id="username" placeholder="Username">
            <input type="password" id="password" placeholder="Password">

            <button type="button" onclick="registerPelanggan('<?= base_url() ?>')">
                Buat Akun
            </button>

            <p style="margin-top: 15px; font-size: 13px;">
    Sudah punya akun?
    <a href="<?= base_url('index.php/pelanggan/login'); ?>">
        Login di sini
    </a>
</p>

        </form>

    </div>

</div>

<!-- JS -->
<script src="<?= base_url('assets/js/pelanggan/register.js'); ?>"></script>

</body>
</html>