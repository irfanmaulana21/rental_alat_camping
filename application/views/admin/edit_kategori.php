<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>

    <link rel="stylesheet"
          href="<?= base_url('assets/css/admin/edit_kategori.css'); ?>">
</head>

<body>

<header>

    <div class="brand">

        <div class="logo">
            RC
        </div>

        <div>
            <h1>Camping Admin</h1>
        </div>

    </div>

    <nav>

        <a href="<?= site_url('admin/dashboard')?>">
            Dashboard
        </a>

        <a class="active">
            Kategori
        </a>

    </nav>

</header>


<div class="container">

    <div class="card">

        <h2>Edit Kategori</h2>

        <p class="sub">
            Ubah nama kategori alat camping
        </p>


        <form
            method="POST"
            action="<?= site_url('admin/kategori/update/'.$kategori->id_kategori) ?>">

            <label>Nama Kategori</label>

            <input
                class="input"
                type="text"
                name="nama_kategori"
                value="<?= $kategori->nama_kategori ?>"
                required>


            <div class="button-group">

                <a
                    href="<?= site_url('admin/kategori')?>"
                    class="btn-back">

                    Batal

                </a>


                <button type="submit">
                    Update
                </button>

            </div>

        </form>

    </div>

</div>


<footer class="footer">

    © <?= date('Y'); ?> Sistem Rental Alat Camping

</footer>

</body>
</html>