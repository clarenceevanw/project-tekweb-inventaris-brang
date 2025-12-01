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
                                <div class="flex gap-2 justify-center">
                                    <button onclick='openEditModal(<?= json_encode($row) ?>)' 
                                            class="inline-flex items-center gap-2 text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-sm px-4 py-2 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        Edit
                                    </button>
                                    <a href="<?= "/admin/ruangan/barang?id=" . $row['id_ruangan'] ?>"
                                            class="inline-flex items-center gap-2 text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-4 py-2 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Lihat Barang
                                    </a>
                                    <button onclick="deleteRuangan('<?= $row['id_ruangan'] ?>', '<?= $row['nama_ruangan'] ?>')" 
                                            class="inline-flex items-center gap-2 text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-4 py-2 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div id="modalTambah" class="hidden fixed inset-0 z-50 overflow-y-auto opacity-0 transition-opacity duration-300">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300" onclick="closeModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out sm:my-8 sm:align-middle sm:max-w-lg w-full scale-95 opacity-0">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Ruangan</h3>
                        <div class="mt-2">
                            <form id="formTambah">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ruangan</label>
                                    <input type="text" name="nama_ruangan" id="nama_ruangan" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="$('#formTambah').submit()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="hidden fixed inset-0 z-50 overflow-y-auto opacity-0 transition-opacity duration-300">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300" onclick="closeEditModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out sm:my-8 sm:align-middle sm:max-w-lg w-full scale-95 opacity-0">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Ruangan</h3>
                        <div class="mt-2">
                            <form id="formEdit">
                                <input type="hidden" name="id_ruangan" id="edit_id_ruangan">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Ruangan</label>
                                    <input type="text" name="nama_ruangan" id="edit_nama_ruangan" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="$('#formEdit').submit()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Update
                    </button>
                    <button type="button" onclick="closeEditModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openModal() {
    const modal = document.getElementById('modalTambah');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        modal.querySelector('.inline-block').classList.remove('scale-95', 'opacity-0');
    }, 10);
}

function closeModal() {
    const modal = document.getElementById('modalTambah');
    modal.classList.add('opacity-0');
    modal.querySelector('.inline-block').classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
        $('#formTambah')[0].reset();
    }, 300);
}

$('#formTambah').on('submit', function(e) {
    e.preventDefault();
    Swal.fire({title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => {Swal.showLoading()}});
    
    $.ajax({
        url: '/admin/ruangan/store',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data) {
            Swal.close();
            if(data.success) {
                closeModal();
                Toastify({
                    text: data.message,
                    duration: 2000,
                    close: true,
                    gravity: "top", 
                    position: "right", 
                    stopOnFocus: true, 
                    className: "toast-success",
                    style: {background: "#ffffff"}
                }).showToast();
                setTimeout(() => {location.reload();}, 1500);
            } else {
                Swal.fire({icon: 'error', title: 'Gagal', text: data.message})
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong'})
        }
    });
});

function openEditModal(data) {
    $('#edit_id_ruangan').val(data.id_ruangan);
    $('#edit_nama_ruangan').val(data.nama_ruangan);
    
    const modal = document.getElementById('modalEdit');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        modal.querySelector('.inline-block').classList.remove('scale-95', 'opacity-0');
    }, 10);
}

function closeEditModal() {
    const modal = document.getElementById('modalEdit');
    modal.classList.add('opacity-0');
    modal.querySelector('.inline-block').classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('hidden');
        $('#formEdit')[0].reset();
    }, 300);
}

$('#formEdit').on('submit', function(e) {
    e.preventDefault();
    Swal.fire({title: 'Mengupdate...', allowOutsideClick: false, didOpen: () => {Swal.showLoading()}});

    $.ajax({
        url: '/admin/ruangan/update',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data) {
            Swal.close();
            if(data.success) {
                closeEditModal();
                Toastify({
                    text: data.message,
                    duration: 2000,
                    close: true,
                    gravity: "top", 
                    position: "right", 
                    stopOnFocus: true, 
                    className: "toast-success",
                    style: {background: "#ffffff"}
                }).showToast();
                setTimeout(() => {location.reload();}, 1500);
            } else {
                Swal.fire({icon: 'error', title: 'Gagal', text: data.message})
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong'})
        }
    });
});

function deleteRuangan(id, namaRuangan) {
    Swal.fire({
        title: 'Hapus Ruangan?',
        html: `Apakah Anda yakin ingin menghapus ruangan <strong>${namaRuangan}</strong>?<br><small class="text-red-600">Data yang dihapus tidak dapat dikembalikan!</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({title: 'Menghapus...', allowOutsideClick: false, didOpen: () => {Swal.showLoading()}});

            $.ajax({
                url: '/admin/ruangan/delete',
                method: 'POST',
                data: { id_ruangan: id },
                dataType: 'json',
                success: function(data) {
                    Swal.close();
                    if(data.success) {
                        Toastify({
                            text: data.message,
                            duration: 2000,
                            close: true,
                            gravity: "top", 
                            position: "right", 
                            stopOnFocus: true, 
                            className: "toast-success",
                            style: {background: "#ffffff"}
                        }).showToast();
                        setTimeout(() => {location.reload();}, 1500);
                    } else {
                        Swal.fire({icon: 'error', title: 'Gagal', text: data.message})
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong'})
                }
            });
        }
    });
}

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        if (!document.getElementById('modalTambah').classList.contains('hidden')) closeModal();
        if (!document.getElementById('modalEdit').classList.contains('hidden')) closeEditModal();
    }
});
</script>

<?php $this->endSection(); ?>
