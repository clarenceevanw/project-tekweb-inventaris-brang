<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Batch Barang</h2>
            <p class="text-sm text-gray-500">Kelola stok masuk dan cetak label QR Code.</p>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Barang
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sisa Stok
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Expired
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if(empty($dataStok)): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data stok.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dataStok as $row): ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $row['nama_barang'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <?= $row['sisa_kuantitas'] ?> Units
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $row['expired_date'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium flex justify-center gap-3 items-center">
                                <button onclick="showQrModal('<?= $row['id_detail_transaksi'] ?>', '<?= $row['nama_barang'] ?>')" 
                                        class="cursor-pointer text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition ease-in-out duration-150 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 6h6v6H6V6zm12 0h-6v6h6V6zm-6 12H6v-6h6v6z"></path></svg>
                                    Lihat QR
                                </button>
                                <a href="<?= "/admin/barang/detail?id=" . $row['id_detail_transaksi'] ?>"
                                        class="text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition ease-in-out duration-150 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 6h6v6H6V6zm12 0h-6v6h6V6zm-6 12H6v-6h6v6z"></path></svg>
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

<div id="qrModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-sm border border-gray-100">
                
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button type="button" onclick="closeModal()" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start justify-center">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900 text-center" id="modalTitle">Loading...</h3>
                            
                            <div id="qrImageContainer" class="mt-4 flex justify-center items-center h-48 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <span class="text-gray-400 text-sm">Generating QR...</span>
                            </div>
                            
                            <p class="mt-2 text-xs text-center text-gray-500 font-mono bg-gray-100 p-1 rounded" id="modalId">ID: -</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                    <button type="button" onclick="window.print()" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:w-auto transition">
                        Print Label
                    </button>
                    <button type="button" onclick="closeModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<style media="print">
    body * {
        visibility: hidden;
    }
    #qrModal, #qrModal * {
        visibility: visible;
    }
    #qrModal {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: white;
    }
    /* Sembunyikan tombol saat print */
    .bg-gray-50 button {
        display: none;
    }
</style>

<?php $this->endSection(); ?>
<?php $this->section('script'); ?>
<script>
    function showQrModal(id, namaBarang) {
        const modal = document.getElementById('qrModal');
        
        // Update Content
        document.getElementById('modalTitle').innerText = namaBarang;
        document.getElementById('modalId').innerText = id;
        
        // Show Loading state first
        document.getElementById('qrImageContainer').innerHTML = '<span class="text-gray-400 text-sm animate-pulse">Loading QR...</span>';
        
        // Generate Image URL
        let qrUrl = "/admin/generate-qr?text=" + id; 
        
        // Load Image
        const img = new Image();
        img.src = qrUrl;
        img.alt = "QR Code";
        img.className = "max-w-full h-auto object-contain p-2"; // Tailwind classes for image
        
        img.onload = function() {
            document.getElementById('qrImageContainer').innerHTML = '';
            document.getElementById('qrImageContainer').appendChild(img);
        };

        // Show Modal (Remove hidden class)
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('qrModal');
        modal.classList.add('hidden');
        
        // Reset container to clear previous image
        document.getElementById('qrImageContainer').innerHTML = '';
    }

    // Close modal when pressing ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    });
</script>
<?php $this->endSection(); ?>