<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="max-w-2xl mx-auto py-8 px-4">
    <nav class="mb-6">
        <a href="<?= '/admin/barang/batch?id=' . $item['id_barang'] ?>" class="inline-flex items-center text-sm text-gray-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Batch
        </a>
    </nav>

    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        
        <div class="p-8 border-b border-gray-100 bg-gray-50/50">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="bg-indigo-100 p-3 rounded-xl flex-shrink-0">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    
                    <div>
                        <p class="text-sm font-medium text-indigo-600 mb-1">Hasil Scan QR</p>
                        <h1 class="text-2xl font-bold text-gray-900 leading-tight">
                            <?= $item['nama_barang'] ?>
                        </h1>
                        <p class="text-gray-500 mt-1 flex items-center gap-2">
                            <span class="bg-gray-100 text-gray-600 py-0.5 px-2 rounded text-xs font-medium uppercase tracking-wide">
                                <?= $item['nama_kategori'] ?>
                            </span>
                        </p>
                    </div>
                </div>

                <?php if($item['sisa_kuantitas'] > 100): ?>
                    <span class="px-3 py-1 rounded-full text-xs font-bold border bg-green-100 text-green-700 border-green-200">
                        Stok Aman
                    </span>
                <?php elseif ($item['sisa_kuantitas'] > 50): ?>
                    <span class="px-3 py-1 rounded-full text-xs font-bold border bg-yellow-100 text-yellow-700 border-yellow-200">
                        Stok Sedang
                    </span>
                <?php else: ?>
                    <span class="px-3 py-1 rounded-full text-xs font-bold border bg-red-100 text-red-700 border-red-200">
                        Stok Menipis
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2 bg-gray-50 rounded-lg p-4 border border-gray-100 text-center hover:border-indigo-200 transition-colors flex flex-col justify-center">
                    <p class="text-md font-medium text-gray-500 uppercase tracking-wider mb-2">ID Batch</p>
                    <div class="flex justify-center w-full">
                        <code class="text-sm font-mono font-semibold text-gray-700 bg-white px-2 py-1 rounded border border-gray-200 break-all w-full">
                            <?= $item['id_detail_transaksi'] ?>
                        </code>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 text-center hover:border-indigo-200 transition-colors flex flex-col justify-center">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Sisa Stok</p>
                    <p class="text-3xl font-bold text-gray-900"><?= number_format($item['sisa_kuantitas']) ?></p>
                    <p class="text-xs text-gray-400 mt-1">Unit / Pcs</p>
                </div>

                <?php 
                    $daysLeft = (strtotime($item['expired_date']) - time()) / (60 * 60 * 24);
                    $isExpired = $daysLeft < 0;
                    $bgClass = $isExpired ? 'bg-red-50 border-red-100' : 'bg-gray-50 border-gray-100';
                    $textClass = $isExpired ? 'text-red-500' : 'text-gray-500';
                ?>
                <div class="<?= $bgClass ?> rounded-lg p-4 border text-center hover:border-indigo-200 transition-colors flex flex-col justify-center">
                    <p class="text-xs font-medium <?= $textClass ?> uppercase tracking-wider mb-1">Kedaluwarsa</p>
                    <p class="text-lg font-bold text-gray-900 mt-1">
                        <?= date('d M Y', strtotime($item['expired_date'])) ?>
                    </p>
                    <?php if($daysLeft < 30): ?>
                        <p class="text-xs font-bold text-red-600 mt-1 bg-red-100 inline-block px-2 rounded-full self-center">
                            <?= $isExpired ? 'Sudah Expired' : round($daysLeft) . ' Hari Lagi' ?>
                        </p>
                    <?php else: ?>
                        <p class="text-xs text-green-600 mt-1">Masih Aman</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <div class="bg-gray-50 px-8 py-5 border-t border-gray-200 flex flex-col sm:flex-row gap-3">
            <a href="/admin/scan" class="flex-1 inline-flex justify-center items-center px-4 py-2.5 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 6h6v6H6V6zm12 0h-6v6h6V6zm-6 12H6v-6h6v6z"></path></svg>
                Scan Barang Lain
            </a>
            
            <a href="/admin/barang" class="flex-1 inline-flex justify-center items-center px-4 py-2.5 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Lihat Daftar Barang
            </a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>