<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center gap-2 mb-4 text-sm">
            <a href="/admin/ruangan" class="text-indigo-600 hover:text-indigo-800 font-medium">Ruangan</a>
            <span class="text-gray-400">></span>
            <a href="<?= "/admin/ruangan/barang?id=" . $id_ruangan ?>" class="text-indigo-600 hover:text-indigo-800 font-medium">Barang</a>
            <span class="text-gray-400">></span>
            <span class="text-gray-600">Batch</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Ruangan: <?= $ruangan['nama_ruangan'] ?></h2>
        <p class="text-sm text-gray-500">Batch barang: <?= !empty($batches) ? $batches[0]['nama_barang'] : '' ?></p>
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
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada batch di ruangan ini.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($batches as $batch): ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-mono text-gray-900"><?= substr($batch['id_detail_transaksi'], 0, 8) ?>...</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <?= $batch['kuantitas_ruangan'] ?> Units
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $batch['expired_date'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium flex justify-center">
                                <button onclick='openMoveModal(<?= json_encode($batch) ?>)' 
                                        class="cursor-pointer text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none transition ease-in-out duration-150 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 icon icon-tabler icons-tabler-outline icon-tabler-door-exit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M13 12v.01" />
                                        <path d="M3 21h18" />
                                        <path d="M5 21v-16a2 2 0 0 1 2 -2h7.5m2.5 10.5v7.5" />
                                        <path d="M14 7h7m-3 -3l3 3l-3 3" />
                                    </svg>
                                    Pindah Ruangan
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Move Modal -->
<div id="moveModal" class="fixed inset-0 z-50 hidden opacity-0 transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="moveModalOverlay" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity duration-300 opacity-0" onclick="closeMoveModal()"></div>
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out sm:my-8 sm:align-middle sm:max-w-lg w-full scale-95 opacity-0">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Pindah Barang</h3>
                        <div class="mt-2">
                            <form id="moveForm">
                                <input type="hidden" id="id_detail_ruangan" name="id_detail_ruangan">
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Dari Ruangan:</label>
                                    <input type="text" id="ruangan_asal" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-100" readonly>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Ke Ruangan:</label>
                                    <select id="id_ruangan_tujuan" name="id_ruangan_tujuan" class="shadow-sm focus:ring-yellow-500 focus:border-yellow-500 block w-full sm:text-sm border-gray-300 rounded-md border p-2" required>
                                        <option value="">-- Pilih Ruangan Tujuan --</option>
                                        <?php foreach($allRuangan as $r): ?>
                                            <option value="<?= $r['id_ruangan'] ?>"><?= $r['nama_ruangan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kuantitas:</label>
                                    <input type="number" id="kuantitas" name="kuantitas" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                                    <p class="text-xs text-gray-500 mt-1">Maksimal: <span id="max_qty"></span></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="$('#moveForm').submit()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-yellow-600 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Pindah
                </button>
                <button type="button" onclick="closeMoveModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openMoveModal(data) {
    $('#id_detail_ruangan').val(data.id_detail_ruangan);
    $('#ruangan_asal').val('<?= $ruangan['nama_ruangan'] ?>');
    $('#max_qty').text(data.kuantitas_ruangan);
    $('#kuantitas').attr('max', data.kuantitas_ruangan);
    
    const modal = document.getElementById('moveModal');
    const overlay = document.getElementById('moveModalOverlay');
    const content = modal.querySelector('.inline-block');
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        overlay.classList.remove('opacity-0');
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeMoveModal() {
    const modal = document.getElementById('moveModal');
    const overlay = document.getElementById('moveModalOverlay');
    const content = modal.querySelector('.inline-block');
    
    modal.classList.add('opacity-0');
    overlay.classList.add('opacity-0');
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        $('#moveForm')[0].reset();
    }, 300);
}

$(document).ready(function() {
    $('#moveForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '/admin/barang/move',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    closeMoveModal();
                    Toastify({
                        text: response.message,
                        duration: 2000,
                        close: true,
                        gravity: "top", 
                        position: "right", 
                        stopOnFocus: true, 
                        className: "toast-success",
                        style: {
                            background: "#ffffff",
                        }
                    }).showToast();

                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    Swal.fire({icon: 'error', title: 'Gagal', text: response.message})
                }
            },
            error: function() {
                Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong.'})
            }
        });
    });
});

// Event listener untuk tombol ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        if (!document.getElementById('moveModal').classList.contains('hidden')) {
            closeMoveModal();
        }
    }
});
</script>

<?php $this->endSection(); ?>
