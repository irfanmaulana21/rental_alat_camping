<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/admin/login.css'); ?>">
</head>

<body>

<div class="login-wrapper">
    <div class="login-box">

        <h2>Admin Login</h2>
        <p class="subtitle">Sistem Rental Camping</p>

        <div id="alert"></div>

        <div class="input-group">
            <label>Username</label>
            <input type="text" id="username">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" id="password">
        </div>

        <button type="button" onclick="login(baseUrl)">Login</button>

    </div>
</div>

<!-- BASE URL -->
<script>
    const baseUrl = "<?= base_url(); ?>";
</script>

<!-- SWEETALERT CDN -->
<script src="<?= base_url('assets/js/sweetalert2.all.js'); ?>"></script>

<!-- LOGIN JS -->
<script src="<?= base_url('assets/js/admin/login.js'); ?>"></script>

</body>
</html>