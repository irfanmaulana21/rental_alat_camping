<?php
$this->load->view('admin/partials/header', [
    'title'  => 'Data Pelanggan',
    'active' => 'pelanggan',
]);
?>

<h2>Data Pelanggan</h2>

<?php if ($this->session->flashdata('success')): ?>
    <div class="flash-success"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="flash-error"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div class="table">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($pelanggan)): ?>
            <?php $no = 1; foreach ($pelanggan as $p): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p->nama; ?></td>
                    <td><?= $p->email; ?></td>
                    <td><?= $p->no_hp; ?></td>
                    <td><?= $p->alamat; ?></td>
                    <td><?= $p->username; ?></td>
                    <td>
                        <a class="hapus"
                           href="<?= site_url('admin/pelanggan/delete/'.$p->id_pelanggan); ?>"
                           onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align:center;padding:22px;color:#6b7280;">
                    Belum ada data pelanggan.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php $this->load->view('admin/partials/footer'); ?>