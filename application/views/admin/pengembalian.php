<?php
/* ---------------------------------------------------------
   views/admin/pengembalian.php

   Controller harus mengirim:
     $disewa  = daftar transaksi berstatus 'Disewa'
                (field yg dipakai: id_transaksi, nama, nama_alat,
                 tanggal_sewa, tanggal_kembali)

   Tombol "Proses" mem-POST ke:
     admin/pengembalian/proses/{id_transaksi}
   dengan field: kondisi (Baik|Rusak|Hilang)
   --------------------------------------------------------- */
$this->load->view('admin/partials/header', [
    'title'  => 'Pengembalian Alat',
    'active' => 'pengembalian',
]);
?>

<h2>Pengembalian Alat</h2>

<?php if ($this->session->flashdata('success')): ?>
    <div class="flash-success"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="flash-error"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<div class="table">
    <h4>Alat yang sedang disewa</h4>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Alat</th>
                <th>Tgl Sewa</th>
                <th>Harus Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($disewa)): ?>
            <?php $no = 1; foreach ($disewa as $t):
                $telat = strtotime($t->tanggal_kembali) < strtotime(date('Y-m-d'));
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $t->nama; ?></td>
                <td><?= $t->nama_alat; ?></td>
                <td><?= date('d-m-Y', strtotime($t->tanggal_sewa)); ?></td>
                <td>
                    <?= date('d-m-Y', strtotime($t->tanggal_kembali)); ?>
                    <?php if ($telat): ?>
                        <span class="badge telat">Telat</span>
                    <?php endif; ?>
                </td>
                <td><span class="badge disewa">Disewa</span></td>
                <td>
                    <button type="button" class="detail" style="width:auto;margin:0;"
                        onclick="bukaModal(
                            '<?= $t->id_transaksi; ?>',
                            '<?= htmlspecialchars($t->nama, ENT_QUOTES); ?>',
                            '<?= htmlspecialchars($t->nama_alat, ENT_QUOTES); ?>',
                            '<?= date('d-m-Y', strtotime($t->tanggal_kembali)); ?>'
                        )">
                        Proses
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align:center;padding:22px;color:#6b7280;">
                    Tidak ada alat yang sedang disewa.
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- MODAL PROSES PENGEMBALIAN -->
<div class="modal-overlay" id="modalPengembalian">
    <div class="modal">
        <div class="modal-head">Proses Pengembalian</div>
        <div class="modal-body">

            <div class="modal-info">
                <div><span>Pelanggan</span><b id="mPelanggan">-</b></div>
                <div><span>Alat</span><b id="mAlat">-</b></div>
                <div><span>Harus kembali</span><b id="mKembali">-</b></div>
            </div>

            <form method="POST" id="formPengembalian" action="">
                <label>Kondisi barang saat kembali</label>
                <select name="kondisi" required>
                    <option value="Baik">Baik — stok dikembalikan</option>
                    <option value="Rusak">Rusak — stok tidak dikembalikan</option>
                    <option value="Hilang">Hilang — stok tidak dikembalikan</option>
                </select>

                <div class="btn-group">
                    <a href="javascript:void(0)" class="btn-back" onclick="tutupModal()">Batal</a>
                    <button type="submit">Konfirmasi</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
function bukaModal(id, nama, alat, kembali){
    document.getElementById('mPelanggan').textContent = nama;
    document.getElementById('mAlat').textContent      = alat;
    document.getElementById('mKembali').textContent   = kembali;
    document.getElementById('formPengembalian').action =
        '<?= site_url('admin/pengembalian/proses/') ?>' + id;
    document.getElementById('modalPengembalian').classList.add('show');
}
function tutupModal(){
    document.getElementById('modalPengembalian').classList.remove('show');
}
document.getElementById('modalPengembalian').addEventListener('click', function(e){
    if (e.target === this) tutupModal();
});
</script>

<?php $this->load->view('admin/partials/footer'); ?>