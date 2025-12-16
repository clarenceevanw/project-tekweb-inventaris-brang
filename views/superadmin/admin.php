<?= $this->extend('layouts/superadmin'); ?>

<?= $this->section('content'); ?>
<div class="p-6 space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-theme-primary">Kelola Admin</h1>
            <p class="text-theme-primary-light mt-1">Manajemen data admin gudang</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button onclick="openAddModal()" class="btn-theme-primary inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Admin
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card-theme p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-theme-primary-light">Total Admin</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $total_admin ?? 0 ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.85" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-theme p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-theme-primary-light">Admin Aktif</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $admin_aktif ?? 0 ?></h3>
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
                    <p class="text-sm font-medium text-theme-primary-light">Belum Ditugaskan</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $admin_belum_ditugaskan ?? 0 ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Admin</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gudang</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($admin_list)): ?>
                        <?php foreach ($admin_list as $index => $admin): ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $index + 1 ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-theme-secondary flex items-center justify-center">
                                                <span class="text-white font-medium"><?= strtoupper(substr($admin['nama_admin'], 0, 1)) ?></span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900"><?= $admin['nama_admin'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500"><?= $admin['email_admin'] ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500"><?= $admin['gudang_nama'] ?? 'Belum ditugaskan' ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php 
                                    $badgeClass = $admin['id_gudang'] ? 'badge-theme-success' : 'badge-theme-warning';
                                    $statusText = $admin['id_gudang'] ? 'Ditugaskan' : 'Belum Ditugaskan';
                                    ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $badgeClass ?>">
                                        <?= $statusText ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex gap-2 justify-center">
                                        <button onclick="editAdmin('<?= $admin['id_admin'] ?>')" class="btn-theme-secondary inline-flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button onclick="deleteAdmin('<?= $admin['id_admin'] ?>')" class="btn-theme-accent inline-flex items-center justify-center">
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
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data admin</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add/Edit Admin -->
<div id="adminModal" class="hidden fixed inset-0 z-50 overflow-y-auto opacity-0 transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-black bg-opacity-80 transition-opacity duration-300" onclick="closeModal()"></div>
        <div class="inline-block bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out max-w-lg w-full scale-95 opacity-0 relative z-10">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">Tambah Admin</h3>
                        <div class="mt-2">
                            <form id="adminForm">
                                <div class="mb-4">
                                    <label for="nama_admin" class="block text-sm font-medium text-gray-700 mb-1">Nama Admin</label>
                                    <input type="text" id="nama_admin" name="nama_admin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required>
                                </div>
                                <div class="mb-4">
                                    <label for="email_admin" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email_admin" name="email_admin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required>
                                </div>
                                <div class="mb-4">
                                    <label for="username_admin" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                    <input type="text" id="username_admin" name="username_admin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required>
                                </div>
                                <div class="mb-4">
                                    <label for="password_admin" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                    <input type="password" id="password_admin" name="password_admin" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]" required>
                                </div>
                                <div class="mb-4">
                                    <label for="gudang_id" class="block text-sm font-medium text-gray-700 mb-1">Gudang</label>
                                    <select id="gudang_id" name="id_gudang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                                        <option value="">Pilih Gudang</option>
                                        <?php if (!empty($gudang_options)): ?>
                                            <?php foreach ($gudang_options as $gudang): ?>
                                                <option value="<?= $gudang['id_gudang'] ?>"><?= $gudang['nama_gudang'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 sm:px-0 sm:flex sm:flex-row-reverse gap-2">
                    <button type="submit" form="adminForm" class="btn-theme-primary w-full sm:w-auto">Simpan</button>
                    <button type="button" onclick="closeModal()" class="btn-theme-secondary w-full sm:w-auto mt-3 sm:mt-0">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    let currentAdminId = null;

    function openAddModal() {
        const modal = document.getElementById('adminModal');
        const form = document.getElementById('adminForm');
        const password = document.getElementById('password_admin');

        document.getElementById('modalTitle').textContent = 'Tambah Admin';
        form.reset();

        password.setAttribute('required', 'required');
        password.placeholder = 'Masukkan password admin';

        const hiddenInput = form.querySelector('input[name="id_admin"]');
        if (hiddenInput) hiddenInput.remove();
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('.inline-block').classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('adminModal');
        modal.classList.add('opacity-0');
        modal.querySelector('.inline-block').classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            $('#adminForm')[0].reset();
        }, 300);
    }

    function closeAssignModal() {
        document.getElementById('assignModal').classList.add('hidden');
    }

    function editAdmin(id) {
        fetch('/superadmin/admin/get?id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const admin = data.data;
                const modal = document.getElementById('adminModal');
                const form = document.getElementById('adminForm');
                const password = document.getElementById('password_admin');
                
                document.getElementById('modalTitle').textContent = 'Edit Admin';
                document.getElementById('nama_admin').value = admin.nama_admin;
                document.getElementById('email_admin').value = admin.email_admin;
                document.getElementById('username_admin').value = admin.username_admin;
                document.getElementById('gudang_id').value = admin.id_gudang || '';

                password.value = '';
                password.removeAttribute('required');
                password.placeholder = 'Kosongkan jika tidak ingin mengubah password';
                
                let hiddenInput = form.querySelector('input[name="id_admin"]');
                if (!hiddenInput) {
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'id_admin';
                    form.appendChild(hiddenInput);
                }
                hiddenInput.value = admin.id_admin;
                
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.querySelector('.inline-block').classList.remove('scale-95', 'opacity-0');
                }, 10);
            }
        });
    }

    function deleteAdmin(id) {
        Swal.fire({
            title: 'Hapus Admin?',
            text: 'Data admin akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({title: 'Menghapus...', allowOutsideClick: false, didOpen: () => {Swal.showLoading()}});
                
                const formData = new FormData();
                formData.append('id', id);
                
                fetch('/superadmin/admin/delete', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
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
                        setTimeout(() => {location.reload();}, 1500);
                    } else {
                        Swal.fire({icon: 'error', title: 'Gagal', text: data.message});
                    }
                })
                .catch(error => {
                    Swal.close();
                    Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong'});
                });
            }
        });
    }

    // Form submit handlers
    document.getElementById('adminForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const isEdit = formData.has('id_admin');
        const url = isEdit ? '/superadmin/admin/update' : '/superadmin/admin/store';
        
        Swal.fire({title: isEdit ? 'Mengupdate...' : 'Menyimpan...', allowOutsideClick: false, didOpen: () => {Swal.showLoading()}});
        
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
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
                setTimeout(() => {location.reload();}, 1500);
            } else {
                Swal.fire({icon: 'error', title: 'Gagal', text: data.message});
            }
        })
        .catch(error => {
            Swal.close();
            Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong'});
        });
    });

    // Check if assignForm exists before adding event listener
    const assignForm = document.getElementById('assignForm');
    if (assignForm) {
        assignForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Assign admin', currentAdminId, 'to gudang');
            closeAssignModal();
            
            Toastify({
                text: "Admin berhasil ditugaskan!",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                className: "toast-success"
            }).showToast();
        });
    }
</script>
<?= $this->endSection(); ?>