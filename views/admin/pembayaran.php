<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center gap-2 mb-4 text-sm">
        <a href="/admin/gudang" class="text-indigo-600 hover:text-indigo-800 font-medium">Gudang</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-gray-600">Perpanjang</span>
    </div>
    
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Perpanjang Langganan</h2>
        <p class="text-sm text-gray-500">Pilih paket untuk memperpanjang masa aktif gudang Anda</p>
    </div>

    <!-- Paket Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <?php foreach($paket_list as $paket): ?>
            <?php if (stripos($paket['nama_paket'], 'trial') === false): ?>
            <div class="bg-white rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                <div class="p-6">
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-2"><?= htmlspecialchars($paket['nama_paket']) ?></h3>
                        <div class="text-3xl font-bold text-indigo-600 mb-1">
                            Rp <?= number_format($paket['harga'], 0, ',', '.') ?>
                        </div>
                        <p class="text-gray-500 text-sm mb-4"><?= $paket['durasi_hari'] ?> hari</p>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Akses penuh sistem inventaris
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Manajemen barang & ruangan
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Laporan & analitik
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            QR Code scanner
                        </div>
                    </div>

                    <form method="POST" action="/subscription/pay" class="w-full">
                        <input type="hidden" name="id_paket" value="<?= $paket['id_paket'] ?>">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Pilih Paket
                        </button>
                    </form>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- Info Section -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h3 class="text-lg font-semibold text-blue-900 mb-2">Informasi Pembayaran</h3>
                <ul class="text-blue-800 space-y-1 text-sm">
                    <li>• Pembayaran menggunakan sistem Midtrans yang aman dan terpercaya</li>
                    <li>• Masa aktif akan diperpanjang sesuai durasi paket yang dipilih</li>
                    <li>• Setelah pembayaran berhasil, akses akan langsung aktif</li>
                    <li>• Untuk bantuan, hubungi tim support kami</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>