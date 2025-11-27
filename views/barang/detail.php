<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<div class="card">
    <h1>Detail Barang</h1>
    
    <table>
        <tr>
            <td>Nama Barang</td>
            <td>: <?= $item['nama_barang'] ?></td>
        </tr>
        <tr>
            <td>ID Batch</td>
            <td>: <?= $item['id_detail_transaksi'] ?></td>
        </tr>
        <tr>
            <td>Stok Sisa</td>
            <td>: <strong><?= $item['sisa_kuantitas'] ?></strong></td>
        </tr>
        <tr>
            <td>Expired</td>
            <td>: <?= $item['expired_date'] ?></td>
        </tr>
    </table>
    
    <br>
    <a href="/scan">Scan Lagi</a>
</div>
<?php $this->endSection(); ?>
