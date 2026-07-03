<?php
/* Struk transaksi — halaman standalone buat dicetak.
   Dikirim dari Transaksi::struk(): $trx (header) + $detail (rincian alat). */
$d1   = new DateTime($trx->tanggal_sewa);
$d2   = new DateTime($trx->tanggal_kembali);
$hari = max(1, (int) $d1->diff($d2)->days);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk #<?= $trx->id_transaksi ?></title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:'DM Sans',system-ui,sans-serif;}
        body{background:#eef1f4;color:#1f2937;padding:24px;}
        .struk{
            max-width:360px;margin:auto;background:#fff;
            padding:24px;border-radius:10px;
        }
        .struk h2{text-align:center;font-size:18px;}
        .struk .sub{text-align:center;font-size:12px;color:#6b7280;margin-bottom:14px;}
        .line{border-top:1px dashed #cbd5e1;margin:12px 0;}
        .meta div,.pay div{display:flex;justify-content:space-between;font-size:12.5px;padding:2px 0;}
        .meta span,.pay span{color:#6b7280;}
        table{width:100%;border-collapse:collapse;font-size:12.5px;margin-top:4px;}
        th{text-align:left;border-bottom:1px solid #e5e9ee;padding:5px 0;color:#6b7280;font-weight:500;}
        td{padding:5px 0;border-bottom:1px solid #f1f4f7;}
        td.r,th.r{text-align:right;}
        .total{display:flex;justify-content:space-between;font-weight:700;font-size:15px;margin-top:10px;}
        .foot{text-align:center;font-size:11.5px;color:#9ca3af;margin-top:16px;}
        .actions{max-width:360px;margin:16px auto 0;display:flex;gap:10px;}
        .actions button,.actions a{
            flex:1;padding:11px;border:none;border-radius:8px;cursor:pointer;
            font-size:13px;font-weight:600;text-align:center;text-decoration:none;
        }
        .actions .print{background:#22c55e;color:#fff;}
        .actions .close{background:#e5e9ee;color:#374151;}
        @media print{
            body{background:#fff;padding:0;}
            .struk{box-shadow:none;border-radius:0;max-width:100%;}
            .no-print{display:none !important;}
        }
    </style>
</head>
<body>

<div class="struk">
    <h2>Rental Camping</h2>
    <div class="sub">Struk Transaksi</div>

    <div class="meta">
        <div><span>No. Transaksi</span><b>#<?= $trx->id_transaksi ?></b></div>
        <div><span>Tanggal cetak</span><b><?= date('d-m-Y') ?></b></div>
        <div><span>Pelanggan</span><b><?= $trx->nama ?></b></div>
        <?php if (!empty($trx->no_hp)): ?>
            <div><span>No. HP</span><b><?= $trx->no_hp ?></b></div>
        <?php endif; ?>
    </div>

    <div class="line"></div>

    <table>
        <tr><th>Alat</th><th class="r">Jml</th><th class="r">Subtotal</th></tr>
        <?php foreach ($detail as $d): ?>
            <tr>
                <td><?= $d->nama_alat ?></td>
                <td class="r"><?= $d->jumlah ?></td>
                <td class="r">Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="meta" style="margin-top:8px;">
        <div><span>Periode sewa</span><b><?= date('d-m-Y', strtotime($trx->tanggal_sewa)) ?> &ndash; <?= date('d-m-Y', strtotime($trx->tanggal_kembali)) ?></b></div>
        <div><span>Lama</span><b><?= $hari ?> hari</b></div>
    </div>

    <div class="total">
        <span>Total</span>
        <span>Rp <?= number_format($trx->total_harga, 0, ',', '.') ?></span>
    </div>

    <div class="line"></div>

    <div class="pay">
        <div><span>Metode bayar</span><b><?= $trx->metode_bayar ?: '-' ?></b></div>
        <div><span>Status bayar</span><b><?= $trx->status_pembayaran ?: '-' ?></b></div>
        <div><span>Status sewa</span><b><?= $trx->status ?></b></div>
    </div>

    <div class="foot">Terima kasih sudah menyewa di Rental Camping</div>
</div>

<div class="actions no-print">
    <button class="print" onclick="window.print()">Cetak</button>
    <a class="close" href="javascript:void(0)" onclick="window.close()">Tutup</a>
</div>

</body>
</html>