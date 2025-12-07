<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="p-6 space-y-6">
    <div class="flex items-center gap-2 mb-4 text-sm">
        <span class="text-gray-600">Kategori</span>
    </div>
    <div>
        <h1 class="text-3xl font-bold text-theme-primary">Daftar Kategori</h1>
        <p class="text-theme-primary mt-1">Kelola kategori barang di gudang</p>
    </div>

    <div class="flex flex-col sm:flex-row gap-3 justify-between items-start sm:items-center">
        <div class="flex-1 w-full">
            <input type="text" id="searchInput" placeholder="Cari nama kategori..." 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
        </div>
        <button onclick="openModal()" class="btn-theme-primary inline-flex items-center justify-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span class="hidden sm:inline">Tambah Kategori</span>
            <span class="sm:hidden">Tambah</span>
        </button>
    </div>

    <div class="card-theme p-6">
        <div class="overflow-x-auto">
            <table class="table-theme min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Kategori
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                    <?php if(empty($dataKategori)): ?>
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada data kategori.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dataKategori as $row): ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150" data-nama="<?= strtolower($row['nama_kategori']) ?>">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $row['nama_kategori'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex gap-2 justify-center">
                                    <button onclick='openEditModal(<?= json_encode($row) ?>)' 
                                            class="btn-theme-secondary inline-flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        Edit
                                    </button>
                                    <button onclick="deleteKategori('<?= $row['id_kategori'] ?>', '<?= $row['nama_kategori'] ?>')" 
                                            class="btn-theme-accent inline-flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
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
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-black bg-opacity-80 transition-opacity duration-300" onclick="closeModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out sm:my-8 sm:align-middle sm:max-w-lg w-full scale-95 opacity-0">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Kategori</h3>
                        <div class="mt-2">
                            <form id="formTambah">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" id="nama_kategori" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <button type="button" onclick="$('#formTambah').submit()" class="btn-theme-primary w-full sm:w-auto">
                        Simpan
                    </button>
                    <button type="button" onclick="closeModal()" class="btn-theme-secondary w-full sm:w-auto mt-3 sm:mt-0">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="hidden fixed inset-0 z-50 overflow-y-auto opacity-0 transition-opacity duration-300">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-black bg-opacity-80 transition-opacity duration-300" onclick="closeEditModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out sm:my-8 sm:align-middle sm:max-w-lg w-full scale-95 opacity-0">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Kategori</h3>
                        <div class="mt-2">
                            <form id="formEdit">
                                <input type="hidden" name="id_kategori" id="edit_id_kategori">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" id="edit_nama_kategori" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    <button type="button" onclick="$('#formEdit').submit()" class="btn-theme-primary w-full sm:w-auto">
                        Update
                    </button>
                    <button type="button" onclick="closeEditModal()" class="btn-theme-secondary w-full sm:w-auto mt-3 sm:mt-0">
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
        url: '/admin/kategori/store',
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
    $('#edit_id_kategori').val(data.id_kategori);
    $('#edit_nama_kategori').val(data.nama_kategori);
    
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
        url: '/admin/kategori/update',
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

function deleteKategori(id, namaKategori) {
    Swal.fire({
        title: 'Hapus Kategori?',
        html: `Apakah Anda yakin ingin menghapus kategori <strong>${namaKategori}</strong>?<br><small class="text-red-600">Data yang dihapus tidak dapat dikembalikan!</small>`,
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
                url: '/admin/kategori/delete',
                method: 'POST',
                data: { id_kategori: id },
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

function applyFilter() {
    const search = $('#searchInput').val().toLowerCase();
    let visibleCount = 0;
    
    $('#tableBody tr').each(function() {
        const $row = $(this);
        const nama = $row.data('nama') || '';
        const isVisible = !search || nama.includes(search);
        $row.toggle(isVisible);
        if (isVisible) visibleCount++;
    });
    
    $('#noDataRow').remove();
    if (visibleCount === 0) {
        $('#tableBody').append('<tr id="noDataRow"><td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada kategori yang sesuai.</td></tr>');
    }
}

$('#searchInput').on('input', applyFilter);

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        if (!document.getElementById('modalTambah').classList.contains('hidden')) closeModal();
        if (!document.getElementById('modalEdit').classList.contains('hidden')) closeEditModal();
    }
});
</script>

<?php $this->endSection(); ?>
