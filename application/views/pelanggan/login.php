<!DOCTYPE html>
<html>
<head>
    <title>Login Pelanggan</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="<?= base_url('assets/css/pelanggan/login.css'); ?>">
</head>
<body>

<div class="container">                                                                                     

    <div class="card">

        <h2>Login Pelanggan</h2>
        <p>Masuk ke akun kamu</p>

        <input type="email" id="email" placeholder="Email">
        <input type="password" id="password" placeholder="Password">

        <button onclick="loginPelanggan('<?= base_url() ?>')">
            Login
        </button>

        <p style="margin-top: 15px; font-size: 13px;">
            Belum punya akun?
            <a href="<?= base_url('index.php/pelanggan/register'); ?>">
                Register
            </a>
        </p>

    </div>

</div>


<script src="<?= base_url('assets/js/pelanggan/login.js'); ?>"></script>

</body>
</html>