<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <div class="flex items-center gap-2 mb-4 text-sm">
                <span class="text-gray-600">Ruangan</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Ruangan</h2>
            <p class="text-sm text-gray-500">Kelola ruangan penyimpanan di gudang.</p>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Ruangan
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if(empty($dataRuangan)): ?>
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada data ruangan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dataRuangan as $row): ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $row['nama_ruangan'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="<?= "/admin/ruangan/barang?id=" . $row['id_ruangan'] ?>"
                                        class="inline-block text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-4 py-2 transition">
                                    Lihat Barang
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
