<?php
$this->load->view('admin/partials/header', [
    'title'  => 'Kelola Transaksi',
    'active' => 'transaksi',
]);
?>

<h2>Kelola Transaksi</h2>

<?php if ($this->session->flashdata('success')): ?>
    <div class="flash-success"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
    <div class="flash-error"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>

<?php if (!empty($transaksi)): ?>
<div class="trx-grid">
    <?php foreach ($transaksi as $t):
        $cls      = strtolower(str_replace(' ', '', $t->status));
        $metode   = isset($t->metode_bayar) ? $t->metode_bayar : '';
        $mcls     = strtolower(str_replace(' ', '', $metode));
        $online   = in_array($metode, ['QRIS', 'Transfer Bank']);
        $menunggu = in_array($t->status, ['Menunggu', 'Menunggu Verifikasi']);
    ?>
    <div class="trx-card">

        <div class="trx-card-head">
            <div>
                <div class="cust"><?= $t->nama ?></div>
                <div class="rid">#<?= $t->id_transaksi ?></div>
            </div>
            <span class="badge <?= $cls ?>"><?= $t->status ?></span>
        </div>

        <div class="trx-row"><span class="k">Alat</span><span class="v"><?= $t->nama_alat ?></span></div>
        <div class="trx-row"><span class="k">Sewa</span><span class="v"><?= date('d-m-Y', strtotime($t->tanggal_sewa)) ?> &rarr; <?= date('d-m-Y', strtotime($t->tanggal_kembali)) ?></span></div>
        <div class="trx-row"><span class="k">Total</span><span class="v"><b>Rp <?= number_format($t->total_harga, 0, ',', '.') ?></b></span></div>
        <div class="trx-row">
            <span class="k">Metode</span>
            <span class="v">
                <?php if (!empty($metode)): ?>
                    <span class="badge <?= $mcls ?>"><?= $metode ?></span>
                    <?php if ($online && !empty($t->bukti_bayar)): ?>
                        <br>
                        <button type="button" class="btn-bukti" onclick="lihatBukti('<?= $t->bukti_bayar ?>')">
                            <i class="ti ti-photo"></i> Lihat Bukti
                        </button>
                    <?php elseif ($metode === 'COD'): ?>
                        <small style="color:#9ca3af;">bayar di tempat</small>
                    <?php elseif ($online): ?>
                        <small style="color:#dc2626;">bukti belum ada</small>
                    <?php endif; ?>
                <?php else: ?>
                    <span style="color:#9ca3af;">&mdash;</span>
                <?php endif; ?>
            </span>
        </div>

        <div class="trx-actions">
            <?php if ($menunggu): ?>
                <a class="edit" href="<?= site_url('admin/transaksi/setujui/'.$t->id_transaksi) ?>">Setujui</a>
                <a class="hapus" onclick="return confirm('Tolak transaksi ini?')"
                   href="<?= site_url('admin/transaksi/tolak/'.$t->id_transaksi) ?>">Tolak</a>
            <?php elseif ($t->status === 'Disetujui'): ?>
                <a class="detail" href="<?= site_url('admin/transaksi/diambil/'.$t->id_transaksi) ?>">Tandai Diambil</a>
            <?php elseif ($t->status === 'Diambil'): ?>
                <button type="button" class="detail"
                    onclick="bukaPengembalian(
                        '<?= $t->id_transaksi ?>',
                        '<?= htmlspecialchars($t->nama, ENT_QUOTES) ?>',
                        '<?= htmlspecialchars($t->nama_alat, ENT_QUOTES) ?>',
                        '<?= date('d-m-Y', strtotime($t->tanggal_kembali)) ?>'
                    )">Proses Pengembalian</button>
            <?php endif; ?>
            <a class="cetak" href="<?= site_url('admin/transaksi/struk/'.$t->id_transaksi) ?>" target="_blank">Cetak Struk</a>
        </div>

    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
    <div class="card" style="text-align:center;color:#6b7280;">Tidak ada transaksi aktif.</div>
<?php endif; ?>

<!-- MODAL BUKTI PEMBAYARAN -->
<div class="modal-overlay" id="modalBukti">
    <div class="modal">
        <div class="modal-head">Bukti Pembayaran</div>
        <div class="modal-body" style="text-align:center;">
            <img id="imgBukti" src="" alt="Bukti pembayaran"
                 style="max-width:100%;max-height:60vh;border-radius:8px;">
            <div class="btn-group">
                <a href="javascript:void(0)" class="btn-back" onclick="tutupBukti()">Tutup</a>
            </div>
        </div>
    </div>
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
                    <option value="Baik">Baik &mdash; stok dikembalikan</option>
                    <option value="Rusak">Rusak &mdash; stok tidak dikembalikan</option>
                    <option value="Hilang">Hilang &mdash; stok tidak dikembalikan</option>
                </select>
                <div class="btn-group">
                    <a href="javascript:void(0)" class="btn-back" onclick="tutupPengembalian()">Batal</a>
                    <button type="submit">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function lihatBukti(file){
    document.getElementById('imgBukti').src = '<?= base_url('assets/image/bukti/') ?>' + file;
    document.getElementById('modalBukti').classList.add('show');
}
function tutupBukti(){ document.getElementById('modalBukti').classList.remove('show'); }

function bukaPengembalian(id, nama, alat, kembali){
    document.getElementById('mPelanggan').textContent = nama;
    document.getElementById('mAlat').textContent      = alat;
    document.getElementById('mKembali').textContent   = kembali;
    document.getElementById('formPengembalian').action =
        '<?= site_url('admin/pengembalian/proses/') ?>' + id;
    document.getElementById('modalPengembalian').classList.add('show');
}
function tutupPengembalian(){ document.getElementById('modalPengembalian').classList.remove('show'); }

document.querySelectorAll('.modal-overlay').forEach(function(ov){
    ov.addEventListener('click', function(e){
        if (e.target === this) this.classList.remove('show');
    });
});
</script>

<?php $this->load->view('admin/partials/footer'); ?>