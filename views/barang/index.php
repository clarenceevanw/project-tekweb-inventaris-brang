<?php $this->extend('layouts/main'); ?>
<?php $this->section('content'); ?>
<style>
    .modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }
    .modal-content { background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 300px; text-align: center; }
    .close { float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
</style>

<h2>Daftar Batch Barang (Stok Masuk)</h2>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Barang</th>
            <th>Sisa Stok</th>
            <th>Expired</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataStok as $row): ?>
        <tr>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['sisa_kuantitas'] ?></td>
            <td><?= $row['expired_date'] ?></td>
            <td>
                <button onclick="showQrModal('<?= $row['id_detail_transaksi'] ?>', '<?= $row['nama_barang'] ?>')">
                    Lihat QR Code
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="qrModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3 id="modalTitle">Loading...</h3>
        
        <div id="qrImageContainer"></div>
        
        <p><small id="modalId"></small></p>
        <button onclick="window.print()">Print Label</button>
    </div>
</div>

<script>
    function showQrModal(id, namaBarang) {
        document.getElementById('qrModal').style.display = "block";
        document.getElementById('modalTitle').innerText = namaBarang;
        document.getElementById('modalId').innerText = id;
        
        // Request QR Code on-the-fly ke Controller khusus gambar
        // Atau kalau mau gampang, kita pakai API internal
        // Asumsi kamu punya route /generate-qr?text=...
        let qrUrl = "/generate-qr?text=" + id; 
        
        document.getElementById('qrImageContainer').innerHTML = `<img src="${qrUrl}" alt="QR Code" width="200">`;
    }

    function closeModal() {
        document.getElementById('qrModal').style.display = "none";
    }
</script>

<?php $this->endSection(); ?>