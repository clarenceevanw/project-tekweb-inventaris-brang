<?php $this->extend('layouts/mitra'); ?>

<?php $this->section('header'); ?>
<style>
@page {
    size: landscape;
    margin: 10mm;
}
@media print {
    aside, header, .no-print {
        display: none !important;
    }
    body {
        background: white !important;
        margin: 0 !important;
        color: #000 !important;
    }
    main {
        padding: 0 !important;
        margin: 0 !important;
        background: white !important;
    }
    .container {
        max-width: 100% !important;
        margin: 0 !important;
        padding: 10px !important;
    }
    h1, h2, h3, h4, h5, h6 {
        color: #000 !important;
    }
    h2 {
        font-size: 18px !important;
        margin-bottom: 8px !important;
    }
    h3 {
        font-size: 14px !important;
        margin-bottom: 8px !important;
    }
    .mb-6 {
        margin-bottom: 12px !important;
    }
    .p-6 {
        padding: 12px !important;
    }
    .px-6 {
        padding-left: 8px !important;
        padding-right: 8px !important;
    }
    .py-3, .py-4 {
        padding-top: 6px !important;
        padding-bottom: 6px !important;
    }
    .gap-4 {
        gap: 8px !important;
    }
    table {
        font-size: 11px !important;
        border: 1px solid #000 !important;
    }
    table thead {
        background: #e0e0e0 !important;
    }
    table th, table td {
        color: #000 !important;
        border: 1px solid #ccc !important;
    }
    .bg-theme-light-alt, .bg-theme-light-bright {
        background: white !important;
        border: 1px solid #ccc !important;
    }
    .text-theme-primary, .text-theme-primary-light {
        color: #000 !important;
    }
    .badge-theme-success {
        background: #d4edda !important;
        color: #155724 !important;
        border: 1px solid #c3e6cb !important;
    }
    .badge-theme-warning {
        background: #fff3cd !important;
        color: #856404 !important;
        border: 1px solid #ffeaa7 !important;
    }
    .grid-cols-1.md\:grid-cols-2 {
        grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    }
}
</style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="container mx-auto px-4 py-8 space-y-6">
    <div class="flex items-center gap-2 mb-4 text-sm no-print">
        <a href="/mitra/transaksi" class="text-theme-secondary hover:text-theme-secondary-dark font-medium">Transaksi</a>
        <svg class="w-4 h-4 text-theme-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-theme-primary-light font-medium">Detail</span>
    </div>

    <div>
        <h1 class="text-3xl font-bold text-theme-primary">Detail Transaksi</h1>
        <p class="mt-1 text-theme-primary-light">Informasi lengkap transaksi dan item yang ditransaksikan.</p>
    </div>

    <!-- Info Transaksi -->
    <div class="bg-theme-light-alt rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-bold text-theme-primary mb-4">Informasi Transaksi</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-theme-primary-light">ID Transaksi</p>
                <p class="text-sm font-medium text-theme-primary"><?= $transaksi['id_transaksi'] ?></p>
            </div>
            <div>
                <p class="text-sm text-theme-primary-light">Jenis Transaksi</p>
                <?php if ($transaksi['jenis_transaksi'] == 'supply'): ?>
                    <span class="badge-theme-success">Supply</span>
                <?php else: ?>
                    <span class="badge-theme-warning">Buy</span>
                <?php endif; ?>
            </div>
            <div>
                <p class="text-sm text-theme-primary-light">Tanggal Transaksi</p>
                <p class="text-sm font-medium text-theme-primary"><?= date('d M Y H:i', strtotime($transaksi['tanggal_transaksi'])) ?></p>
            </div>
            <div>
                <p class="text-sm text-theme-primary-light"><?= $transaksi['jenis_transaksi'] == 'buy' ? 'From Gudang' : 'To Gudang' ?></p>
                <p class="text-sm font-medium text-theme-primary"><?= $transaksi['nama_gudang'] ?? '-' ?></p>
            </div>
            <div>
                <p class="text-sm text-theme-primary-light">Admin</p>
                <p class="text-sm font-medium text-theme-primary"><?= $transaksi['nama_admin'] ?? '-' ?></p>
            </div>
            <div>
                <p class="text-sm text-theme-primary-light">Total Harga</p>
                <p class="text-lg font-bold text-theme-primary">Rp <?= number_format($transaksi['harga_transaksi'], 0, ',', '.') ?></p>
            </div>
        </div>
    </div>

    <!-- Detail Items -->
    <div class="bg-theme-light-alt rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4">
            <h3 class="text-xl font-bold text-theme-primary">Item Transaksi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-theme-light-bright rounded-lg overflow-hidden">
                <thead class="bg-theme-primary-light">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Nama Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Kuantitas</th>
                        <?php if($transaksi['jenis_transaksi'] == 'supply'): ?>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Expired Date</th>
                        <?php endif; ?>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Total Harga</th>
                    </tr>
                </thead>
                <tbody class="bg-theme-light-bright divide-y divide-gray-200">
                    <?php if(empty($detailItems)): ?>
                        <tr>
                            <td colspan="<?= $transaksi['jenis_transaksi'] == 'supply' ? 4 : 3 ?>" class="px-6 py-4 text-center text-theme-primary-light">Tidak ada item.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($detailItems as $item): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-theme-primary"><?= $item['nama_barang'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-primary"><?= $item['kuantitas_transaksi'] ?></td>
                            <?php if($transaksi['jenis_transaksi'] == 'supply'): ?>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-primary-light">
                                <?= $item['expired_date'] ? date('d M Y', strtotime($item['expired_date'])) : '-' ?>
                            </td>
                            <?php endif; ?>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-theme-primary">
                                Rp <?= number_format($item['harga_detail_transaksi'], 0, ',', '.') ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 flex gap-3 no-print">
        <a href="/mitra/transaksi" class="btn-theme-light inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
        <button onclick="window.print()" class="btn-theme-secondary inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Print PDF
        </button>
    </div>
</div>

<?php $this->endSection(); ?>
