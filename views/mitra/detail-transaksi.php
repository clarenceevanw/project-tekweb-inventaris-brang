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
    }
    main {
        padding: 0 !important;
        margin: 0 !important;
    }
    .container {
        max-width: 100% !important;
        margin: 0 !important;
        padding: 10px !important;
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
    }
    .grid-cols-1.md\:grid-cols-2 {
        grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    }
}
</style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex items-center gap-2 mb-4 text-sm no-print">
        <a href="/mitra/transaksi" class="text-blue-600 hover:text-blue-800">Transaksi</a>
        <span class="text-gray-400">></span>
        <span class="text-gray-600">Detail</span>
    </div>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Transaksi</h2>
        <p class="text-sm text-gray-500">Informasi lengkap transaksi dan item yang ditransaksikan.</p>
    </div>

    <!-- Info Transaksi -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Transaksi</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">ID Transaksi</p>
                <p class="text-sm font-medium text-gray-900"><?= $transaksi['id_transaksi'] ?></p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Jenis Transaksi</p>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $transaksi['jenis_transaksi'] == 'supply' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                    <?= ucfirst($transaksi['jenis_transaksi']) ?>
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tanggal Transaksi</p>
                <p class="text-sm font-medium text-gray-900"><?= date('d M Y H:i', strtotime($transaksi['tanggal_transaksi'])) ?></p>
            </div>
            <div>
                <p class="text-sm text-gray-500"><?= $transaksi['jenis_transaksi'] == 'buy' ? 'From Gudang' : 'To Gudang' ?></p>
                <p class="text-sm font-medium text-gray-900"><?= $transaksi['nama_gudang'] ?? '-' ?></p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Admin</p>
                <p class="text-sm font-medium text-gray-900"><?= $transaksi['nama_admin'] ?? '-' ?></p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Harga</p>
                <p class="text-lg font-bold text-gray-900">Rp <?= number_format($transaksi['harga_transaksi'], 0, ',', '.') ?></p>
            </div>
        </div>
    </div>

    <!-- Detail Items -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Item Transaksi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Barang
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kuantitas
                        </th>
                        <?php if($transaksi['jenis_transaksi'] == 'supply'): ?>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Expired Date
                        </th>
                        <?php endif; ?>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total Harga
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if(empty($detailItems)): ?>
                        <tr>
                            <td colspan="<?= $transaksi['jenis_transaksi'] == 'supply' ? 4 : 3 ?>" class="px-6 py-4 text-center text-gray-500">Tidak ada item.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($detailItems as $item): ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $item['nama_barang'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <?= $item['kuantitas_transaksi'] ?>
                            </td>
                            <?php if($transaksi['jenis_transaksi'] == 'supply'): ?>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $item['expired_date'] ? date('d M Y', strtotime($item['expired_date'])) : '-' ?>
                            </td>
                            <?php endif; ?>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
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
        <a href="/mitra/transaksi" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
        <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Print PDF
        </button>
    </div>
</div>

<?php $this->endSection(); ?>
