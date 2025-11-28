<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="max-w-xl mx-auto py-10 px-4">
    
    <nav class="mb-4 text-sm text-gray-500 flex items-center gap-2">
        <a href="/admin/scan" class="hover:text-gray-900 transition-colors">&larr; Kembali ke Scanner</a>
    </nav>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        
        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-start">
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Hasil Scan</h3>
                <h1 class="text-xl font-bold text-gray-900 mt-1"><?= $item['nama_barang'] ?></h1>
            </div>
            
            <?php if($item['sisa_kuantitas'] > 10): ?>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    Stok Aman
                </span>
            <?php else: ?>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    Stok Menipis
                </span>
            <?php endif; ?>
        </div>

        <div class="px-6 py-2">
            <dl class="divide-y divide-gray-100">
                
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500">ID Batch</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-mono bg-gray-50 inline-block px-2 py-1 rounded border border-gray-200">
                        <?= $item['id_detail_transaksi'] ?>
                    </dd>
                </div>

                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 self-center">Sisa Stok</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2 flex items-baseline gap-2">
                        <span class="text-2xl font-bold text-gray-900"><?= $item['sisa_kuantitas'] ?></span>
                        <span class="text-sm text-gray-500">Unit</span>
                    </dd>
                </div>

                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 self-center">Kedaluwarsa</dt>
                    <dd class="mt-1 sm:mt-0 sm:col-span-2">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium text-gray-900">
                                <?= date('d F Y', strtotime($item['expired_date'])) ?>
                            </span>
                            
                            <?php 
                                $daysLeft = (strtotime($item['expired_date']) - time()) / (60 * 60 * 24);
                            ?>
                            <?php if($daysLeft < 30): ?>
                                <span class="text-xs text-red-600 bg-red-50 border border-red-100 px-2 py-0.5 rounded">
                                    (<?= $daysLeft < 0 ? 'Expired' : round($daysLeft) . ' hari lagi' ?>)
                                </span>
                            <?php endif; ?>
                        </div>
                    </dd>
                </div>
            </dl>
        </div>

        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex flex-col sm:flex-row gap-3">
            <a href="/admin/scan" class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 6h6v6H6V6zm12 0h-6v6h6V6zm-6 12H6v-6h6v6z"></path></svg>
                Scan Lagi
            </a>
            <a href="/admin/barang" class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Lihat Daftar Barang
            </a>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>