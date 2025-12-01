<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex items-center gap-2 mb-4 text-sm">
        <span class="text-gray-600">Ruangan</span>
    </div>
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Ruangan</h2>
            <p class="text-sm text-gray-500">Kelola ruangan penyimpanan di gudang.</p>
        </div>
        <div>
            <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition">
                + Tambah Ruangan
            </button>
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

<!-- Modal -->
<div id="modalTambah" class="hidden fixed inset-0 z-50 opacity-0 transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity duration-300" onclick="closeModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md transform transition-all duration-300 ease-out scale-95 opacity-0 relative z-10">
        <h3 class="text-xl font-bold mb-4">Tambah Ruangan</h3>
        <form id="formTambah">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ruangan</label>
                <input type="text" name="nama_ruangan" id="nama_ruangan" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg transition">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                    Simpan
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

<script>
function openModal() {
    const modal = document.getElementById('modalTambah');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        modal.querySelector('.bg-white').classList.remove('scale-95', 'opacity-0');
        modal.querySelector('.bg-white').classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeModal() {
    const modal = document.getElementById('modalTambah');
    modal.classList.add('opacity-0');
    modal.querySelector('.bg-white').classList.remove('scale-100', 'opacity-100');
    modal.querySelector('.bg-white').classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
        $('#formTambah')[0].reset();
    }, 300);
}

$('#formTambah').on('submit', function(e) {
    e.preventDefault();
    
    $.ajax({
        url: '/admin/ruangan/store',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data) {
            if(data.success) {
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
                    location.reload();
                }, 2000);
            } else {
                Swal.fire({icon: 'error', title: 'Error', text: data.message})
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({icon: 'error', title: 'Error', text: 'Something went wrong'})
        }
    });
});

// Event listener untuk tombol ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        if (!document.getElementById('modalTambah').classList.contains('hidden')) {
            closeModal();
        }
    }
});
</script>

<?php $this->endSection(); ?>
