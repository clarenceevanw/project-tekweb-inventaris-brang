<?php $this->extend('layouts/mitra'); ?>

<?php $this->section('content'); ?>
<div class="container mx-auto px-4 py-8 space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-theme-primary">History Transaksi</h1>
        <p class="mt-1 text-theme-primary-light">Riwayat transaksi Anda</p>
    </div>

    <div class="bg-theme-light-alt rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-theme-light-bright rounded-lg overflow-hidden">
                <thead class="bg-theme-primary-light">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">ID Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Total Harga</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-theme-light uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-theme-light-bright divide-y divide-gray-200">
                    <?php if (empty($dataTransaksi)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-theme-primary-light">Belum ada transaksi</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dataTransaksi as $row): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-theme-primary"><?= substr($row['id_transaksi'], 0, 8) ?>...</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($row['jenis_transaksi'] == 'supply'): ?>
                                    <span class="badge-theme-success">Supply</span>
                                <?php else: ?>
                                    <span class="badge-theme-warning">Buy</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-primary-light">
                                <?= date('d M Y H:i', strtotime($row['tanggal_transaksi'])) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-primary font-medium">
                                Rp <?= number_format($row['harga_transaksi'], 0, ',', '.') ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="<?= "/mitra/transaksi/detail?id=" . $row['id_transaksi'] ?>" class="btn-theme-secondary inline-flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Lihat Detail
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
