<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="p-6 space-y-6">
    <div class="flex items-center gap-2 mb-4 text-sm">
        <a href="/admin/transaksi" class="text-theme-secondary hover:text-theme-secondary-dark font-medium">Transaksi</a>
        <svg class="w-4 h-4 text-theme-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-theme-primary font-medium">Detail</span>
    </div>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Detail Transaksi</h2>
        <p class="text-sm text-gray-500">Informasi lengkap transaksi dan item yang ditransaksikan.</p>
    </div>

    <!-- Info Transaksi -->
    <div class="bg-theme-light-alt rounded-lg shadow-lg p-6 mb-6">
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
                <p class="text-sm text-theme-primary-light"><?= $transaksi['jenis_transaksi'] == 'supply' ? 'From Mitra' : 'To Mitra' ?></p>
                <p class="text-sm font-medium text-theme-primary"><?= $transaksi['nama_mitra'] ?? '-' ?></p>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Kuantitas</th>
                        <?php if($transaksi['jenis_transaksi'] == 'supply'): ?>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Sisa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Expired Date</th>
                        <?php endif; ?>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Total Harga</th>
                    </tr>
                </thead>
                <tbody class="bg-theme-light-bright divide-y divide-gray-200">
                    <?php if(empty($detailItems)): ?>
                        <tr>
                            <td colspan="<?= $transaksi['jenis_transaksi'] == 'supply' ? 6 : 4 ?>" class="px-6 py-4 text-center text-theme-primary-light">Tidak ada item.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($detailItems as $item): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-theme-primary"><?= $item['nama_barang'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-primary-light"><?= $item['nama_kategori'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-primary"><?= $item['kuantitas_transaksi'] ?></td>
                            <?php if($transaksi['jenis_transaksi'] == 'supply'): ?>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-primary"><?= $item['sisa_kuantitas'] ?></td>
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

    <div class="mt-6">
        <a href="/admin/transaksi" class="btn-theme-light inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>
</div>

<?php $this->endSection(); ?>
