<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="p-6 space-y-6">
    <div class="flex items-center gap-2 text-sm">
        <a href="/admin/ruangan" class="text-theme-secondary hover:text-theme-secondary-hover font-medium">Ruangan</a>
        <svg class="w-4 h-4 text-theme-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-theme-primary font-medium">Barang</span>
    </div>
    
    <div>
        <h1 class="text-3xl font-bold text-theme-primary">Ruangan: <?= $ruangan['nama_ruangan'] ?></h1>
        <p class="text-theme-primary mt-1">Daftar barang yang tersimpan di ruangan ini</p>
    </div>

    <div class="card-theme p-6">
        <div class="overflow-x-auto">
            <table class="table-theme min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Barang
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total Stok
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if(empty($barangList)): ?>
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tidak ada barang di ruangan ini.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($barangList as $item): ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $item['nama_barang'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <?= $item['total_stok'] ?> Units
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="<?= "/admin/ruangan/batch?id_ruangan=" . $ruangan['id_ruangan'] . "&id_barang=" . $item['id_barang'] ?>"
                                        class="inline-flex items-center gap-2 text-white bg-theme-primary font-medium rounded-lg text-sm px-4 py-2 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Lihat Batch
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
