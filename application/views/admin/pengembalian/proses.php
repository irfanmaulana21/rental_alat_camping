<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Proses Pengembalian'; ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/admin/pengembalian.css'); ?>">
</head>
<body>

<header>

    <div class="brand">
        <div class="logo">RC</div>
        <h2>Camping Admin</h2>
    </div>

    <nav>
        <a href="<?= site_url('admin/dashboard'); ?>">Dashboard</a>
        <a href="<?= site_url('admin/alat'); ?>">Alat</a>
        <a href="<?= site_url('admin/kategori'); ?>">Kategori</a>
        <a href="<?= site_url('admin/pelanggan'); ?>">Pelanggan</a>
        <a href="<?= site_url('admin/transaksi'); ?>">Konfirmasi Sewa</a>
        <a class="active" href="<?= site_url('admin/pengembalian'); ?>">Pengembalian</a>
    </nav>

</header>

<div class="container">

    <h2><?= isset($title) ? htmlspecialchars($title) : 'Proses Pengembalian'; ?></h2>

    <?php if (validation_errors()): ?>
        <div class="notice notice-error"><?= validation_errors(); ?></div>
    <?php endif; ?>

    <div class="card">
        <h4>Detail Transaksi TRX-<?= $transaksi->id_transaksi; ?></h4>
        <p class="info-row"><strong>Pelanggan:</strong> <?= htmlspecialchars($transaksi->nama); ?> (<?= htmlspecialchars($transaksi->no_hp); ?>)</p>
        <p class="info-row"><strong>Tanggal Sewa:</strong> <?= date('d-m-Y', strtotime($transaksi->tanggal_sewa)); ?></p>
        <p class="info-row"><strong>Harus Kembali:</strong> <?= date('d-m-Y', strtotime($transaksi->tanggal_kembali)); ?></p>
        <p class="info-row">
            <strong>Keterlambatan saat ini:</strong>
            <?php if ($hari_telat > 0): ?>
                <span class="badge badge-telat"><?= $hari_telat; ?> hari (estimasi denda Rp <?= number_format($estimasi_denda, 0, ',', '.'); ?>)</span>
            <?php else: ?>
                <span class="badge badge-ontime">Tidak telat</span>
            <?php endif; ?>
        </p>
    </div>

    <div class="card">
        <h4>Alat yang Disewa</h4>
        <table>
            <thead>
                <tr>
                    <th>Nama Alat</th>
                    <th>Merk</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail_alat as $d): ?>
                    <tr>
                        <td><?= htmlspecialchars($d->nama_alat); ?></td>
                        <td><?= htmlspecialchars($d->merk); ?></td>
                        <td><?= $d->jumlah; ?></td>
                        <td>Rp <?= number_format($d->subtotal, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h4>Form Pengembalian</h4>
        <form action="<?= site_url('admin/pengembalian/proses/' . $transaksi->id_transaksi); ?>" method="post">

            <div class="form-group">
                <label for="tanggal_dikembalikan">Tanggal Dikembalikan</label>
                <input type="date" id="tanggal_dikembalikan" name="tanggal_dikembalikan"
                       value="<?= set_value('tanggal_dikembalikan', $tanggal_hari_ini); ?>" required>
            </div>

            <div class="form-group">
                <label for="kondisi_alat">Kondisi Alat</label>
                <select id="kondisi_alat" name="kondisi_alat" required>
                    <option value="Baik" <?= set_select('kondisi_alat', 'Baik', TRUE); ?>>Baik</option>
                    <option value="Rusak" <?= set_select('kondisi_alat', 'Rusak'); ?>>Rusak</option>
                    <option value="Hilang" <?= set_select('kondisi_alat', 'Hilang'); ?>>Hilang</option>
                </select>
                <small>Alat dengan kondisi "Rusak"/"Hilang" akan otomatis ditandai "Belum Tersedia" agar dicek admin dulu sebelum disewakan lagi.</small>
            </div>

            <div class="form-group">
                <label for="denda">Denda (Rp)</label>
                <input type="number" min="0" id="denda" name="denda"
                       value="<?= set_value('denda', $estimasi_denda); ?>" required>
                <small>Estimasi otomatis dari keterlambatan (Rp <?= number_format($denda_per_hari, 0, ',', '.'); ?>/hari). Bisa diubah manual, misalnya untuk denda kerusakan/kehilangan.</small>
            </div>

            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea id="catatan" name="catatan" rows="3"><?= set_value('catatan'); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Pengembalian</button>
            <a href="<?= site_url('admin/pengembalian'); ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>

</div>

<footer>
    © <?= date('Y'); ?> Sistem Rental Camping
</footer>

</body>
</html>
