<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<div class="p-6 space-y-6">
    <div class="flex items-center gap-2 mb-4 text-sm">
        <span class="text-gray-600">Barang</span>
    </div>
    <div>
        <h1 class="text-3xl font-bold text-theme-primary">Daftar Barang</h1>
        <p class="text-theme-primary mt-1">Kelola barang dan lihat batch stok</p>
    </div>

    <div class="flex flex-col sm:flex-row gap-3 justify-between items-start sm:items-center">
        <div class="flex-1 w-full flex gap-3">
            <input type="text" id="searchInput" placeholder="Cari nama barang..." 
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
            <button onclick="openFilterModal()" class="btn-theme-secondary inline-flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                </svg>
                Filter
            </button>
        </div>
        <button onclick="openModal()" class="btn-theme-primary inline-flex items-center justify-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span class="hidden sm:inline">Tambah Barang</span>
            <span class="sm:hidden">Tambah</span>
        </button>
    </div>

    <div class="card-theme p-6">
        <div class="overflow-x-auto">
            <table class="table-theme min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Barang
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total Stok
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Foto
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                    <?php if(empty($dataBarang)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data barang.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dataBarang as $row): ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150" data-nama="<?= strtolower($row['nama_barang']) ?>" data-kategori="<?= $row['nama_kategori'] ?>" data-stok="<?= $row['total_stok'] ?? 0 ?>">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $row['nama_barang'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $row['nama_kategori'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full badge-theme-info">
                                    <?= $row['total_stok'] ?? 0 ?> Units
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <button onclick="showImageModal('<?= $row['foto_barang'] ?? '' ?>', '<?= $row['nama_barang'] ?>')" 
                                        class="btn-theme-light inline-flex items-center justify-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    Lihat Foto
                                </button>
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
                                    <a href="<?= "/admin/barang/batch?id=" . $row['id_barang'] ?>"
                                            class="btn-theme-primary inline-flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Lihat Batch
                                    </a>
                                    <button onclick="deleteBarang('<?= $row['id_barang'] ?>', '<?= $row['nama_barang'] ?>')" 
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

<!-- Modal -->
<div id="modalTambah" class="hidden fixed inset-0 z-50 overflow-y-auto opacity-0 transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-80 transition-opacity duration-300" onclick="closeModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out sm:my-8 sm:align-middle sm:max-w-lg w-full scale-95 opacity-0">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Tambah Barang Baru</h3>
                        <div class="mt-2">
                            <form id="formTambah" enctype="multipart/form-data">
                                <!-- Nama Barang -->
                                <div class="mb-4">
                                    <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                                    <input type="text" name="nama_barang" id="nama_barang" required placeholder="Masukkan Nama Barang"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                                </div>

                                <!-- Kategori -->
                                <div class="mb-4">
                                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                    <select name="kategori" id="kategori" class="shadow-sm focus:ring-[var(--theme-secondary)] focus:border-[var(--theme-secondary)] block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach($kategori as $k): ?>
                                            <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Barang</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:bg-gray-50 transition">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 justify-center">
                                                <label for="foto_barang" class="relative cursor-pointer bg-white rounded-md font-medium text-[var(--theme-secondary)] hover:text-[var(--theme-secondary-dark)] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[var(--theme-secondary)]">
                                                    <span>Upload file</span>
                                                    <input id="foto_barang" name="foto_barang" type="file" class="sr-only" accept="image/*">
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                        </div>
                                    </div>
                                    <p id="fileNamePreview" class="text-xs text-green-600 mt-2 hidden"></p>
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
<div id="modalEdit" class="hidden fixed inset-0 z-50 overflow-y-auto opacity-0 transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-black bg-opacity-80 transition-opacity duration-300" onclick="closeEditModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out sm:my-8 sm:align-middle sm:max-w-lg w-full scale-95 opacity-0">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Barang</h3>
                        <div class="mt-2">
                            <form id="formEdit" enctype="multipart/form-data">
                                <input type="hidden" name="id_barang" id="edit_id_barang">
                                
                                <div class="mb-4">
                                    <label for="edit_nama_barang" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                                    <input type="text" name="nama_barang" id="edit_nama_barang" required placeholder="Masukkan Nama Barang"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                                </div>

                                <div class="mb-4">
                                    <label for="edit_kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                    <select name="kategori" id="edit_kategori" class="shadow-sm focus:ring-[var(--theme-secondary)] focus:border-[var(--theme-secondary)] block w-full sm:text-sm border-gray-300 rounded-md border p-2">
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach($kategori as $k): ?>
                                            <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label id="currentPhotoLabel" class="block text-sm font-medium text-gray-700 mb-1">Foto Saat Ini</label>
                                    <div id="currentPhotoPreview" class="mb-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                        <img id="currentPhoto" src="" alt="Foto Barang" class="max-w-full h-32 object-contain mx-auto rounded">
                                    </div>
                                    
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Baru (Opsional)</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:bg-gray-50 transition">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 justify-center">
                                                <label for="edit_foto_barang" class="relative cursor-pointer bg-white rounded-md font-medium text-[var(--theme-secondary)] hover:text-[var(--theme-secondary-dark)] focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-[var(--theme-secondary)]">
                                                    <span>Upload file</span>
                                                    <input id="edit_foto_barang" name="foto_barang" type="file" class="sr-only" accept="image/*">
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                        </div>
                                    </div>
                                    <p id="editFileNamePreview" class="text-xs text-green-600 mt-2 hidden"></p>
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

<!-- Modal Filter -->
<div id="modalFilter" class="hidden fixed inset-0 z-50 overflow-y-auto opacity-0 transition-opacity duration-300">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-black bg-opacity-80 transition-opacity duration-300" onclick="closeFilterModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out sm:my-8 sm:align-middle sm:max-w-lg w-full scale-95 opacity-0">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Filter Barang</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select id="kategoriFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                            <option value="">Semua Kategori</option>
                            <?php foreach($kategori as $k): ?>
                                <option value="<?= $k['nama_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Range Stok</label>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs text-gray-600 mb-1">Stok Minimum</label>
                                <input type="number" id="stokMin" placeholder="0" min="0" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-600 mb-1">Stok Maximum</label>
                                <input type="number" id="stokMax" placeholder="Tidak terbatas" min="0" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                <button onclick="applyFilter()" class="w-full sm:w-auto px-4 py-2 bg-theme-primary text-white rounded-lg transition">
                    Terapkan Filter
                </button>
                <button onclick="resetFilter()" class="w-full sm:w-auto px-4 py-2 bg-theme-secondary text-white rounded-lg transition mt-2 sm:mt-0">
                    Reset
                </button>
                <button onclick="closeFilterModal()" class="w-full sm:w-auto px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg transition mt-2 sm:mt-0">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Foto -->
<div id="imageModal" class="hidden fixed inset-0 z-50 opacity-0 transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="imageModalOverlay" class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity duration-300 opacity-0" onclick="closeImageModal()"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div id="imageModalContent" class="relative transform overflow-hidden rounded-lg bg-white shadow-2xl transition-all duration-300 ease-out sm:my-8 sm:w-full sm:max-w-2xl scale-95 opacity-0">
                <div class="absolute top-0 right-0 pt-4 pr-4 z-10">
                    <button type="button" onclick="closeImageModal()" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4" id="imageModalTitle">Foto Barang</h3>
                    <div class="flex justify-center items-center bg-gray-50 rounded-lg p-4">
                        <img id="imageModalContent" src="" alt="Foto Barang" class="max-w-full max-h-96 object-contain rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Tampilkan nama file saat user memilih gambar
$('#foto_barang').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    $('#fileNamePreview').text('File terpilih: ' + fileName).removeClass('hidden');
});

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
        $('#fileNamePreview').addClass('hidden');
    }, 300);
}

// Logic AJAX Submit dengan FormData (Untuk File Upload)
$('#formTambah').on('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    Swal.fire({
        title: 'Menyimpan...', 
        allowOutsideClick: false, 
        didOpen: () => {
            Swal.showLoading()
        }});

    $.ajax({
        url: '/admin/barang/store', 
        method: 'POST',
        data: formData,
        processData: false, 
        contentType: false,
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
                    style: {
                        background: "#ffffff",
                    }
                }).showToast();

                setTimeout(() => {
                    location.reload();
                }, 1500);
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

function showImageModal(imagePath, namaBarang) {
    if (!imagePath) {
        Swal.fire({icon: 'warning', title: 'Tidak Ada Foto', text: 'Barang ini belum memiliki foto.'});
        return;
    }
    const modal = document.getElementById('imageModal');
    const overlay = document.getElementById('imageModalOverlay');
    const content = document.getElementById('imageModalContent');
    
    document.getElementById('imageModalTitle').innerText = 'Foto: ' + namaBarang;
    document.querySelector('#imageModalContent img').src = '../uploads/barang/' + imagePath;
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('opacity-0');
        overlay.classList.remove('opacity-0');
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    const overlay = document.getElementById('imageModalOverlay');
    const content = document.getElementById('imageModalContent');
    
    modal.classList.add('opacity-0');
    overlay.classList.add('opacity-0');
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Preview file edit
$('#edit_foto_barang').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    $('#editFileNamePreview').text('File baru terpilih: ' + fileName).removeClass('hidden');
});

function openEditModal(data) {
    $('#edit_id_barang').val(data.id_barang);
    $('#edit_nama_barang').val(data.nama_barang);
    $('#edit_kategori').val(data.id_kategori);
    
    if (data.foto_barang) {
        $('#currentPhoto').attr('src', '../uploads/barang/' + data.foto_barang);
        $('#currentPhotoPreview').show();
        $('#currentPhotoLabel').show();
    } else {
        $('#currentPhotoPreview').hide();
        $('#currentPhotoLabel').hide();
    }
    
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
        $('#editFileNamePreview').addClass('hidden');
    }, 300);
}

$('#formEdit').on('submit', function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    Swal.fire({
        title: 'Mengupdate...', 
        allowOutsideClick: false, 
        didOpen: () => {
            Swal.showLoading()
        }});

    $.ajax({
        url: '/admin/barang/update', 
        method: 'POST',
        data: formData,
        processData: false, 
        contentType: false,
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
                    style: {
                        background: "#ffffff",
                    }
                }).showToast();

                setTimeout(() => {
                    location.reload();
                }, 1500);
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

function deleteBarang(id, namaBarang) {
    Swal.fire({
        title: 'Hapus Barang?',
        html: `Apakah Anda yakin ingin menghapus barang <strong>${namaBarang}</strong>?<br><small class="text-red-600">Data yang dihapus tidak dapat dikembalikan!</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Menghapus...', 
                allowOutsideClick: false, 
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: '/admin/barang/delete',
                method: 'POST',
                data: { id_barang: id },
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
                            style: {
                                background: "#ffffff",
                            }
                        }).showToast();

                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    } else {
                        Swal.fire({icon: 'error', title: 'Gagal', text: data.message})
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong.'})
                    console.error(xhr.responseText);
                }
            });
        }
    });
}

// Filter Modal
function openFilterModal() {
    const modal = $('#modalFilter');
    modal.removeClass('hidden');
    setTimeout(() => {
        modal.removeClass('opacity-0');
        modal.find('.inline-block').removeClass('scale-95 opacity-0');
    }, 10);
}

function closeFilterModal() {
    const modal = $('#modalFilter');
    modal.addClass('opacity-0');
    modal.find('.inline-block').addClass('scale-95 opacity-0');
    setTimeout(() => modal.addClass('hidden'), 300);
}

function applyFilter() {
    const search = $('#searchInput').val().toLowerCase();
    const kategori = $('#kategoriFilter').val();
    const minInput = $('#stokMin').val();
    const maxInput = $('#stokMax').val();
    const stokMin = minInput ? parseInt(minInput) : 0;
    const stokMax = maxInput ? parseInt(maxInput) : Infinity;
    
    if (minInput && maxInput && stokMax < stokMin) {
        Swal.fire({icon: 'error', title: 'Input Tidak Valid', text: 'Stok Maximum harus lebih besar dari Stok Minimum'});
        return;
    }

    if (stokMin < 0 || stokMax < 0) {
        Swal.fire({icon: 'error', title: 'Input Tidak Valid', text: 'Stok Minimum atau Maximum harus minimal nol'});
        return;
    }
    
    let visibleCount = 0;
    
    $('#tableBody tr').each(function() {
        const $row = $(this);
        const nama = $row.data('nama') || '';
        const kat = $row.data('kategori') || '';
        const stokVal = parseInt($row.data('stok')) || 0;
        
        const matchSearch = !search || nama.includes(search);
        const matchKategori = !kategori || kat === kategori;
        const matchStok = stokVal >= stokMin && stokVal <= stokMax;
        
        const isVisible = matchSearch && matchKategori && matchStok;
        $row.toggle(isVisible);
        if (isVisible) visibleCount++;
    });
    
    $('#noDataRow').remove();
    if (visibleCount === 0) {
        $('#tableBody').append('<tr id="noDataRow"><td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada barang yang sesuai.</td></tr>');
    }
    
    closeFilterModal();
}

$('#searchInput').on('input', applyFilter);

function resetFilter() {
    $('#searchInput').val('');
    $('#kategoriFilter').val('');
    $('#stokMin').val('');
    $('#stokMax').val('');
    $('#noDataRow').remove();
    $('#tableBody tr').show();
}

// Event listener untuk tombol ESC
$(document).on('keydown', function(e) {
    if (e.key === 'Escape') {
        if (!$('#imageModal').hasClass('hidden')) closeImageModal();
        if (!$('#modalTambah').hasClass('hidden')) closeModal();
        if (!$('#modalEdit').hasClass('hidden')) closeEditModal();
        if (!$('#modalFilter').hasClass('hidden')) closeFilterModal();
    }
});
</script>

<?php $this->endSection(); ?>