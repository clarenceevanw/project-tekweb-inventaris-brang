<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="/admin/barang" class="text-indigo-600 hover:text-indigo-800 mb-4 inline-block">&larr; Kembali ke Daftar Barang</a>
        <h2 class="text-2xl font-bold text-gray-800">Batch: <?= $barang['nama_barang'] ?></h2>
        <p class="text-sm text-gray-500">Daftar batch stok masuk untuk barang ini.</p>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
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
                                <button onclick="showQrModal('<?= $batch['id_detail_transaksi'] ?>', '<?= $barang['nama_barang'] ?>')" 
                                        class="cursor-pointer text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition ease-in-out duration-150 flex items-center justify-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                                    </svg>
                                    Lihat QR
                                </button>
                                <a href="<?= "/admin/barang/detail?id=" . $batch['id_detail_transaksi'] ?>"
                                        class="text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition ease-in-out duration-150 flex items-center justify-center">
                                    Lihat Detail
                                </a>
                                <a href="<?= "/admin/barang/batch/ruangan?id=" . $batch['id_detail_transaksi'] ?>"
                                        class="text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition ease-in-out duration-150 flex items-center justify-center gap-1">
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
    body * { visibility: hidden; }
    #qrModal, #qrModal * { visibility: visible; }
    #qrModal { position: absolute; left: 0; top: 0; width: 100%; height: 100%; background: white; }
    .bg-gray-50 button { display: none; }
</style>

<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<script>
    function showQrModal(id, namaBarang) {
        const modal = document.getElementById('qrModal');
        document.getElementById('modalTitle').innerText = namaBarang;
        document.getElementById('modalId').innerText = id;
        document.getElementById('qrImageContainer').innerHTML = '<span class="text-gray-400 text-sm animate-pulse">Loading QR...</span>';
        
        let qrUrl = "/admin/generate-qr?text=" + id; 
        const img = new Image();
        img.src = qrUrl;
        img.alt = "QR Code";
        img.className = "max-w-full h-auto object-contain p-2";
        
        img.onload = function() {
            document.getElementById('qrImageContainer').innerHTML = '';
            document.getElementById('qrImageContainer').appendChild(img);
        };
        
        img.onerror = function() {
            document.getElementById('qrImageContainer').innerHTML = '<span class="text-red-500 text-sm">Gagal memuat QR Code</span>';
        };
        
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('qrModal').classList.add('hidden');
    }
</script>
<?php $this->endSection(); ?>
