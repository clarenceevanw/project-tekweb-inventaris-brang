<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="p-6 space-y-6">
    <div class="flex items-center gap-2 text-sm">
        <a href="/admin/barang" class="text-theme-secondary hover:text-theme-secondary-hover font-medium">Barang</a>
        <svg class="w-4 h-4 text-theme-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-theme-primary font-medium">Batch</span>
    </div>
    
    <div>
        <h1 class="text-3xl font-bold text-theme-primary">Batch: <?= $barang['nama_barang'] ?></h1>
        <p class="text-theme-primary mt-1">Daftar batch stok masuk untuk barang ini</p>
    </div>

    <div class="card-theme p-6">
        <div class="overflow-x-auto">
            <table class="table-theme min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID Batch
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sisa Stok
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Expired Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if(empty($batches)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada batch aktif.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($batches as $batch): ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-mono text-gray-900"><?= substr($batch['id_detail_transaksi'], 0, 8) ?>...</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <?= $batch['sisa_kuantitas'] ?> Units
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $batch['expired_date'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium flex justify-center items-center gap-2">
                                <button onclick="showQrModal('<?= $batch['id_detail_transaksi'] ?>', '<?= $barang['nama_barang'] ?>', '<?= $batch['expired_date'] ?>', '<?= $_SESSION['user']['nama_gudang'] ?? 'Gudang' ?>')" 
                                        class="btn-theme-secondary gap-2 cursor-pointer font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition ease-in-out duration-150 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                                    </svg>
                                    Lihat QR
                                </button>
                                <a href="<?= "/admin/barang/detail?id=" . $batch['id_detail_transaksi'] ?>"
                                        class="btn-theme-primary inline-flex items-center gap-2 cursor-pointer font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition ease-in-out duration-150 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                        Lihat Detail
                                </a>
                                <a href="<?= "/admin/barang/batch/ruangan?id=" . $batch['id_detail_transaksi'] ?>"
                                        class="btn-theme-accent gap-2 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition ease-in-out duration-150 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 icon icon-tabler icons-tabler-outline icon-tabler-door">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 12v.01" />
                                        <path d="M3 21h18" />
                                        <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />
                                    </svg>
                                    Lihat Ruangan
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

<div id="qrModal" class="fixed inset-0 z-50 hidden opacity-0 transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="qrModalOverlay" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity duration-300 opacity-0" onclick="closeModal()"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div id="qrModalContent" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-2xl transition-all duration-300 ease-out sm:my-8 sm:w-full sm:max-w-sm border border-gray-100 scale-95 opacity-0">
                <div class="absolute top-0 right-0 pt-4 pr-4 no-print">
                    <button type="button" onclick="closeModal()" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="bg-white px-6 pb-6 pt-6">
                    <!-- Label Header -->
                    <div class="text-center border-b-2 border-gray-800 pb-3 mb-4">
                        <h2 class="text-xl font-bold text-gray-900" id="modalTitle">Loading...</h2>
                    </div>
                    
                    <!-- QR Code Section -->
                    <div class="border-4 border-gray-800 rounded-lg p-4 bg-white">
                        <div id="qrImageContainer" class="flex justify-center items-center h-48 bg-white">
                            <span class="text-gray-400 text-sm">Generating QR...</span>
                        </div>
                    </div>
                    
                    <!-- Batch Info -->
                    <div class="mt-4 space-y-2">
                        <div class="border-t border-gray-300 pt-3">
                            <div class="text-xs text-gray-600 font-semibold mb-1">Batch ID:</div>
                            <div class="font-mono text-xs text-gray-900 break-all bg-gray-50 p-2 rounded" id="modalId">-</div>
                            
                            <div class="mt-2" id="expiredSection" style="display:none;">
                                <div class="text-xs text-gray-600 font-semibold mb-1">Expired Date:</div>
                                <div class="font-mono text-xs text-gray-900 bg-gray-50 p-2 rounded" id="modalExpired">-</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2 no-print">
                    <button type="button" onclick="window.print()" class="btn-theme-primary w-full sm:w-auto">
                        Print Label
                    </button>
                    <button type="button" onclick="closeModal()" class="btn-theme-secondary w-full sm:w-auto mt-3 sm:mt-0">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style media="print">
    @page {
        size: 10cm 15cm;
        margin: 0;
    }
    body * { visibility: hidden; }
    #qrModal, #qrModal * { visibility: visible; }
    #qrModal { 
        position: absolute; 
        left: 0; 
        top: 0; 
        width: 10cm; 
        height: 15cm; 
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #qrModalContent {
        box-shadow: none !important;
        border: 3px solid #000 !important;
        max-width: 9cm !important;
        margin: 0.5cm;
    }
    .no-print { display: none !important; }
    #qrModalOverlay { display: none !important; }
</style>

<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<script>
    function showQrModal(id, namaBarang, expiredDate = null) {
        const modal = document.getElementById('qrModal');
        const overlay = document.getElementById('qrModalOverlay');
        const content = document.getElementById('qrModalContent');
        
        document.getElementById('modalTitle').innerText = namaBarang;
        document.getElementById('modalId').innerText = id;
        
        // Show expired date if available
        if (expiredDate) {
            document.getElementById('modalExpired').innerText = expiredDate;
            document.getElementById('expiredSection').style.display = 'block';
        } else {
            document.getElementById('expiredSection').style.display = 'none';
        }
        
        document.getElementById('qrImageContainer').innerHTML = '<span class="text-gray-400 text-sm animate-pulse">Loading QR...</span>';
        
        let qrUrl = "/admin/generate-qr?text=" + id; 
        const img = new Image();
        img.src = qrUrl;
        img.alt = "QR Code";
        img.className = "max-w-full h-auto object-contain";
        
        img.onload = function() {
            document.getElementById('qrImageContainer').innerHTML = '';
            document.getElementById('qrImageContainer').appendChild(img);
        };
        
        img.onerror = function() {
            document.getElementById('qrImageContainer').innerHTML = '<span class="text-red-500 text-sm">Gagal memuat QR Code</span>';
        };
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            overlay.classList.remove('opacity-0');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('qrModal');
        const overlay = document.getElementById('qrModalOverlay');
        const content = document.getElementById('qrModalContent');
        
        modal.classList.add('opacity-0');
        overlay.classList.add('opacity-0');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    });
</script>
<?php $this->endSection(); ?>
