<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex items-center gap-2 mb-4 text-sm">
        <span class="text-gray-600">Gudang</span>
    </div>
    
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
        <div class="flex-1">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Informasi Gudang</h2>
            <p class="text-sm text-gray-500">Detail informasi gudang dan status langganan</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 w-full sm:w-auto">
            <button onclick="editGudang()" class="flex items-center justify-center px-3 sm:px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span class="hidden sm:inline">Edit Gudang</span>
                <span class="sm:hidden">Edit</span>
            </button>
            <a href="/admin/gudang/pembayaran" class="flex items-center justify-center px-3 sm:px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                <span class="hidden sm:inline">Perpanjang Layanan</span>
                <span class="sm:hidden">Perpanjang</span>
            </a>
        </div>
    </div>

    <?php
    $tanggal_berakhir = strtotime($gudang['tanggal_berakhir']);
    $sekarang = time();
    $sisa_hari = floor(($tanggal_berakhir - $sekarang) / (60 * 60 * 24));
    $is_expired = $sisa_hari <= 0;
    $is_warning = $sisa_hari <= 7 && $sisa_hari > 0;
    ?>

    <!-- Alert Status -->
    <?php if ($is_expired): ?>
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <div>
                    <h3 class="text-red-800 font-semibold">Langganan Telah Berakhir</h3>
                    <p class="text-red-700 text-sm">Silakan perpanjang langganan untuk melanjutkan akses gudang.</p>
                </div>
            </div>
        </div>
    <?php elseif ($is_warning): ?>
        <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-yellow-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <div>
                    <h3 class="text-yellow-800 font-semibold">Langganan Akan Segera Berakhir</h3>
                    <p class="text-yellow-700 text-sm">Perpanjang sekarang untuk menghindari gangguan layanan.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Info Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6 lg:p-8 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Nama Gudang -->
            <div class="text-center md:text-left">
                <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-blue-100 rounded-full mb-3 sm:mb-4">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-1 sm:mb-2">Nama Gudang</h3>
                <p id="nama-display" class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 break-words"><?= htmlspecialchars($gudang['nama_gudang']) ?></p>
            </div>

            <!-- Alamat -->
            <div class="text-center md:text-left">
                <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 bg-green-100 rounded-full mb-3 sm:mb-4">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-1 sm:mb-2">Alamat Gudang</h3>
                <p id="alamat-display" class="text-sm sm:text-base lg:text-lg font-semibold text-gray-900 break-words"><?= htmlspecialchars($gudang['alamat']) ?></p>
            </div>

            <!-- Status Langganan -->
            <div class="text-center md:text-left md:col-span-2 lg:col-span-1">
                <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 <?= $is_expired ? 'bg-red-100' : ($is_warning ? 'bg-yellow-100' : 'bg-blue-100') ?> rounded-full mb-3 sm:mb-4">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 <?= $is_expired ? 'text-red-600' : ($is_warning ? 'text-yellow-600' : 'text-blue-600') ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xs sm:text-sm font-medium text-gray-500 mb-1 sm:mb-2">Sisa Waktu Aktif</h3>
                <p class="text-xl sm:text-2xl lg:text-3xl font-bold <?= $is_expired ? 'text-red-600' : ($is_warning ? 'text-yellow-600' : 'text-blue-600') ?>">
                    <?= $is_expired ? 'Expired' : $sisa_hari . ' Hari' ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Detail Langganan -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-4 sm:p-6">
        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-4 sm:mb-6">Detail Langganan</h3>
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 sm:p-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg gap-4">
            <div class="flex items-center">
                <div class="bg-indigo-100 p-2 sm:p-3 rounded-full mr-3 sm:mr-4">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Berakhir Pada</p>
                    <p class="text-base sm:text-lg lg:text-xl font-bold text-gray-900"><?= date('d F Y', strtotime($gudang['tanggal_berakhir'])) ?></p>
                </div>
            </div>
            <div class="w-full sm:w-auto">
                <?php if ($is_expired): ?>
                    <span class="inline-block w-full sm:w-auto text-center px-3 sm:px-4 py-2 bg-red-100 text-red-800 text-xs sm:text-sm font-semibold rounded-full">Expired</span>
                <?php elseif ($is_warning): ?>
                    <span class="inline-block w-full sm:w-auto text-center px-3 sm:px-4 py-2 bg-yellow-100 text-yellow-800 text-xs sm:text-sm font-semibold rounded-full">Segera Berakhir</span>
                <?php else: ?>
                    <span class="inline-block w-full sm:w-auto text-center px-3 sm:px-4 py-2 bg-green-100 text-green-800 text-xs sm:text-sm font-semibold rounded-full">Aktif</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Gudang -->
<div id="editModal" class="hidden fixed inset-0 z-50 overflow-y-auto opacity-0 transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300" onclick="closeModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out sm:my-8 sm:align-middle sm:max-w-lg w-full scale-95 opacity-0">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edit Informasi Gudang</h3>
                        <div class="mt-2">
                            <form id="editForm">
                                <input type="hidden" id="id_gudang" name="id_gudang" value="<?= $gudang['id_gudang'] ?>">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Gudang</label>
                                    <input type="text" id="nama_gudang" name="nama_gudang"" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= htmlspecialchars($gudang['nama_gudang']) ?>">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Gudang</label>
                                    <textarea id="lokasi_gudang" rows="3" name="lokasi_gudang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($gudang['alamat']) ?></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="$('#editForm').submit()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function editGudang() {
    const modal = document.getElementById('editModal');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        modal.querySelector('.inline-block').classList.remove('scale-95', 'opacity-0');
    }, 10);
}

function closeModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('opacity-0');
    modal.querySelector('.inline-block').classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
        $('#editForm')[0].reset();
    }, 300);
}

$('#editForm').on('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    Swal.fire({
        title: 'Mengupdate...', 
        allowOutsideClick: false, 
        didOpen: () => {
            Swal.showLoading()
        }
    });

    $.ajax({
        url: '/admin/gudang/update', 
        method: 'POST',
        data: formData,
        processData: false, 
        contentType: false,
        dataType: 'json',
        success: function(data) {
            Swal.close();
            if(data.success) {
                $('#nama-display').text($('#nama_gudang').val());
                $('#alamat-display').text($('#alamat_gudang').val());
                closeModal();
                Toastify({
                    text: data.message,
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
                    window.location.reload();
                }, 2000);
            } else {
                Swal.fire({icon: 'error', title: 'Gagal', text: data.message})
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong.'})
            console.error(xhr.responseText);
        }
    });
});

// Event listener untuk tombol ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        if (!document.getElementById('editModal').classList.contains('hidden')) {
            closeModal();
        }
    }
});
</script>

</div>

<?php $this->endSection(); ?>
