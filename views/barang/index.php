<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Barang</h2>
            <p class="text-sm text-gray-500">Kelola barang dan lihat batch stok.</p>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Barang
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
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
                    <?php if(empty($dataBarang)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data barang.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dataBarang as $row): ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $row['nama_barang'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $row['nama_kategori'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <?= $row['total_stok'] ?? 0 ?> Units
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="<?= "/admin/barang/batch?id=" . $row['id_barang'] ?>"
                                        class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-4 py-2 transition">
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