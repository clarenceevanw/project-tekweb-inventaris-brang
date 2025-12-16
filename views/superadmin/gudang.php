<?= $this->extend('layouts/superadmin'); ?>

<?= $this->section('content'); ?>
<div class="p-6 space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-theme-primary">Kelola Gudang</h1>
            <p class="text-theme-primary-light mt-1">Manajemen data gudang dan admin</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button onclick="openAddModal()" class="btn-theme-primary inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Gudang
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card-theme p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-theme-primary-light">Total Gudang</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $total_gudang ?? 0 ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21v-13l9 -4l9 4v13" />
                        <path d="M13 13h4v8h-10v-6h6" />
                        <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-theme p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-theme-primary-light">Gudang Aktif</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $gudang_aktif ?? 0 ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-theme p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-theme-primary-light">Gudang Tidak Aktif</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $gudang_tidak_aktif ?? 0 ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card-theme p-6">
        <div class="overflow-x-auto">
            <table class="table-theme min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Gudang</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Berakhir</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($gudang_list)): ?>
                        <?php foreach ($gudang_list as $index => $gudang): ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $index + 1 ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= $gudang['nama_gudang'] ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500"><?= $gudang['lokasi_gudang'] ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500"><?= $gudang['admin_nama'] ?? 'Belum ditugaskan' ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php 
                                    $expired = $gudang['expired_date_gudang'] ?? null;
                                    if ($expired) {
                                        $expiredTime = strtotime($expired);
                                        $now = time();
                                        $sisaHari = floor(($expiredTime - $now) / (60 * 60 * 24));
                                        $textClass = $sisaHari <= 0 ? 'text-red-600' : ($sisaHari <= 7 ? 'text-amber-600' : 'text-gray-900');
                                        echo '<div class="text-sm ' . $textClass . ' font-medium">' . date('d M Y', $expiredTime) . '</div>';
                                        if ($sisaHari > 0) {
                                            echo '<div class="text-xs text-gray-500">(' . $sisaHari . ' hari lagi)</div>';
                                        } else {
                                            echo '<div class="text-xs text-red-500">(Sudah berakhir)</div>';
                                        }
                                    } else {
                                        echo '<div class="text-sm text-gray-400">-</div>';
                                    }
                                    ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php 
                                    $status = $gudang['status_gudang'] ?? 'active';
                                    $badgeClass = 'badge-theme-info';
                                    if ($status == 'active') $badgeClass = 'badge-theme-success';
                                    elseif ($status == 'trial') $badgeClass = 'badge-theme-warning';
                                    elseif ($status == 'expired') $badgeClass = 'badge-theme-danger';
                                    elseif ($status == 'banned') $badgeClass = 'badge-theme-danger';
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $badgeClass ?>">
                                        <?= ucfirst($status) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex gap-2 justify-center">
                                        <button onclick="editGudang('<?= $gudang['id_gudang'] ?>')" class="btn-theme-secondary inline-flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button onclick="deleteGudang('<?= $gudang['id_gudang'] ?>')" class="btn-theme-accent inline-flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data gudang</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add/Edit Gudang -->
<div id="gudangModal" class="hidden fixed inset-0 z-50 overflow-y-auto opacity-0 transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-black bg-opacity-80 transition-opacity duration-300" onclick="closeModal()"></div>
        <div class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out max-w-lg w-full scale-95 opacity-0 relative z-10">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">Tambah Gudang</h3>
                        <div class="mt-2">
                            <form id="gudangForm" class="space-y-4">
                                <div class="mb-4">
                                    <label for="nama_gudang" class="block text-sm font-medium text-gray-700 mb-1">Nama Gudang</label>
                                    <input type="text" id="nama_gudang" name="nama_gudang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required>
                                </div>
                                <div class="mb-4">
                                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <textarea id="alamat" name="alamat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required></textarea>
                                </div>
                                
                                <!-- Pembatas untuk Admin -->
                                <div class="border-t border-gray-300 pt-4 mt-4">
                                    <h4 class="text-sm font-semibold text-gray-900 mb-3">Data Admin Gudang</h4>
                                    <div class="space-y-4">
                                        <div>
                                            <label for="nama_admin" class="block text-sm font-medium text-gray-700 mb-1">Nama Admin</label>
                                            <input type="text" id="nama_admin" name="nama_admin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required>
                                        </div>
                                        <div>
                                            <label for="username_admin" class="block text-sm font-medium text-gray-700 mb-1">Username Admin</label>
                                            <input type="text" id="username_admin" name="username_admin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required>
                                        </div>
                                        <div>
                                            <label for="email_admin" class="block text-sm font-medium text-gray-700 mb-1">Email Admin</label>
                                            <input type="email" id="email_admin" name="email_admin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required>
                                        </div>
                                        <div>
                                            <label for="password_admin" class="block text-sm font-medium text-gray-700 mb-1">Password Admin</label>
                                            <input type="password" id="password_admin" name="password_admin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 sm:px-0 sm:flex sm:flex-row-reverse gap-2">
                    <button type="button" onclick="$('#gudangForm').submit()" class="btn-theme-primary w-full sm:w-auto">Simpan</button>
                    <button type="button" onclick="closeModal()" class="btn-theme-secondary w-full sm:w-auto mt-3 sm:mt-0">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Gudang -->
<div id="editGudangModal" class="hidden fixed inset-0 z-50 overflow-y-auto opacity-0 transition-opacity duration-300">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-black bg-opacity-80 transition-opacity duration-300" onclick="closeEditModal()"></div>
        <div class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out max-w-lg w-full scale-95 opacity-0 relative z-10">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Gudang</h3>
                        <div class="mt-2">
                            <form id="editGudangForm">
                                <input type="hidden" id="edit_id_gudang" name="id_gudang">
                                <div class="mb-4">
                                    <label for="edit_nama_gudang" class="block text-sm font-medium text-gray-700 mb-1">Nama Gudang</label>
                                    <input type="text" id="edit_nama_gudang" name="nama_gudang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required>
                                </div>
                                <div class="mb-4">
                                    <label for="edit_alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <textarea id="edit_alamat" name="alamat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 sm:px-0 sm:flex sm:flex-row-reverse gap-2">
                    <button type="button" onclick="document.getElementById('editGudangForm').dispatchEvent(new Event('submit'))" class="btn-theme-primary w-full sm:w-auto">Update</button>
                    <button type="button" onclick="closeEditModal()" class="btn-theme-secondary w-full sm:w-auto mt-3 sm:mt-0">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    // Data gudang dari PHP
    const gudangData = <?= json_encode($gudang_list ?? []) ?>;

    function openAddModal() {
        const modal = document.getElementById('gudangModal');
        document.getElementById('modalTitle').textContent = 'Tambah Gudang';
        document.getElementById('gudangForm').reset();
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('.inline-block').classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('gudangModal');
        modal.classList.add('opacity-0');
        modal.querySelector('.inline-block').classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            $('#gudangForm')[0].reset();
        }, 300);
    }

    function editGudang(id) {
        const gudang = gudangData.find(g => g.id_gudang === id);
        
        if (gudang) {
            $('#edit_id_gudang').val(gudang.id_gudang);
            $('#edit_nama_gudang').val(gudang.nama_gudang);
            $('#edit_alamat').val(gudang.lokasi_gudang);
            
            const modal = $('#editGudangModal');
            modal.removeClass('hidden');
            setTimeout(() => {
                modal.removeClass('opacity-0');
                modal.find('.inline-block').removeClass('scale-95 opacity-0');
            }, 10);
        } else {
            Swal.fire({icon: 'error', title: 'Gagal', text: 'Data gudang tidak ditemukan'});
        }
    }

    function closeEditModal() {
        const modal = $('#editGudangModal');
        modal.addClass('opacity-0');
        modal.find('.inline-block').addClass('scale-95 opacity-0');
        setTimeout(() => {
            modal.addClass('hidden');
            $('#editGudangForm')[0].reset();
        }, 300);
    }

    $('#editGudangForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        Swal.fire({title: 'Mengupdate...', allowOutsideClick: false, didOpen: () => {Swal.showLoading()}});
        
        $.ajax({
            url: '/superadmin/gudang/update',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                Swal.close();
                if (data.success) {
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
                    setTimeout(() => location.reload(), 1500);
                } else {
                    Swal.fire({icon: 'error', title: 'Gagal', text: data.message});
                }
            },
            error: function(xhr) {
                Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong.'});
                console.error(xhr.responseText);
            }
        });
    });

    function deleteGudang(id) {
        Swal.fire({
            title: 'Hapus Gudang?',
            text: 'Data gudang akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({title: 'Menghapus...', allowOutsideClick: false, didOpen: () => {Swal.showLoading()}});
                
                $.ajax({
                    url: '/superadmin/gudang/delete',
                    method: 'POST',
                    data: {id: id},
                    dataType: 'json',
                    success: function(data) {
                        Swal.close();
                        if (data.success) {
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
                            setTimeout(() => location.reload(), 1500);
                        } else {
                            Swal.fire({icon: 'error', title: 'Gagal', text: data.message});
                        }
                    },
                    error: function() {
                        Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong.'});
                    }
                });
            }
        });
    }

    $('#gudangForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        Swal.fire({title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => {Swal.showLoading()}});
        
        $.ajax({
            url: '/superadmin/gudang/store',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                Swal.close();
                if (data.success) {
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
                    setTimeout(() => location.reload(), 1500);
                } else {
                    Swal.fire({icon: 'error', title: 'Gagal', text: data.message});
                }
            },
            error: function(xhr) {
                Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong.'});
                console.error(xhr.responseText);
            }
        });
    });
</script>
<?= $this->endSection(); ?>