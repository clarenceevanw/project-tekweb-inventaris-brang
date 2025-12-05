<?php $this->extend('layouts/admin'); ?>

<?php $this->section('header'); ?>
<style>
.select2-container--default .select2-selection--single {
    height: 40px;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    padding: 0.5rem 0.75rem;
    display: flex;
    align-items: center;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: normal;
    padding: 0;
    padding-top: 1px;
    color: #111827;
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #9ca3af;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px;
    right: 8px;
}

.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #3b82f6;
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.select2-dropdown {
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.select2-container--default .select2-search--dropdown .select2-search__field {
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    padding: 0.5rem 0.75rem;
}

.select2-container--default .select2-search--dropdown .select2-search__field:focus {
    border-color: #3b82f6;
    outline: none;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #3b82f6;
}

.select2-container--default .select2-results__option[aria-selected=true] {
    background-color: #eff6ff;
    color: #1e40af;
}
</style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="container mx-auto px-4 py-8">
    <div class="flex items-center gap-2 mb-4 text-sm">
        <span class="text-gray-600">Transaksi</span>
    </div>
    <div class="mb-6">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Transaksi</h2>
                <p class="text-sm text-gray-500">Riwayat transaksi supply dan buy.</p>
            </div>
            <a href="/admin/transaksi/create" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-3 py-2 sm:px-4 rounded-lg transition text-sm sm:text-base">
                <span class="hidden sm:inline">+ Tambah Transaksi</span>
                <span class="sm:hidden">+ Tambah</span>
            </a>
        </div>
        
        <button onclick="openFilterModal()" class="w-full flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
            </svg>
            Filter
        </button>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID Transaksi
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jenis
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Mitra
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total Harga
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
                    <?php if(empty($dataTransaksi)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data transaksi.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($dataTransaksi as $row): ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150" data-jenis="<?= $row['jenis_transaksi'] ?>" data-tanggal="<?= $row['tanggal_transaksi'] ?>" data-mitra="<?= $row['nama_mitra'] ?? '' ?>">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= substr($row['id_transaksi'], 0, 8) ?>...</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $row['jenis_transaksi'] == 'supply' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= ucfirst($row['jenis_transaksi']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= date('d M Y H:i', strtotime($row['tanggal_transaksi'])) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $row['nama_mitra'] ?? '-' ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                Rp <?= number_format($row['harga_transaksi'], 0, ',', '.') ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="<?= "/admin/transaksi/detail?id=" . $row['id_transaksi'] ?>"
                                        class="inline-flex items-center gap-2 text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-4 py-2 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
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

<!-- Modal Filter -->
<div id="modalFilter" class="hidden fixed inset-0 z-50 overflow-y-auto opacity-0 transition-opacity duration-300">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300" onclick="closeFilterModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 ease-out sm:my-8 sm:align-middle sm:max-w-lg w-full scale-95 opacity-0">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Filter Transaksi</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Transaksi</label>
                        <select id="jenisFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Jenis</option>
                            <option value="supply">Supply</option>
                            <option value="buy">Buy</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Range Tanggal</label>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs text-gray-600 mb-1">Dari Tanggal</label>
                                <input type="date" id="tanggalMin" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-600 mb-1">Sampai Tanggal</label>
                                <input type="date" id="tanggalMax" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mitra</label>
                        <select id="mitraFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Mitra</option>
                            <?php foreach($mitra as $m): ?>
                                <option value="<?= $m['nama_mitra'] ?>"><?= $m['nama_mitra'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                <button onclick="applyFilter()" class="w-full sm:w-auto px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                    Terapkan Filter
                </button>
                <button onclick="resetFilter()" class="w-full sm:w-auto px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition mt-2 sm:mt-0">
                    Reset
                </button>
                <button onclick="closeFilterModal()" class="w-full sm:w-auto px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 rounded-lg transition mt-2 sm:mt-0">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openFilterModal() {
    const modal = $('#modalFilter');
    modal.removeClass('hidden');
    setTimeout(() => {
        modal.removeClass('opacity-0');
        modal.find('.inline-block').removeClass('scale-95 opacity-0');
    }, 10);
    
    if (!$('#mitraFilter').hasClass('select2-hidden-accessible')) {
        $('#mitraFilter').select2({
            placeholder: 'Semua Mitra',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#modalFilter')
        });
    }
}

function closeFilterModal() {
    const modal = $('#modalFilter');
    modal.addClass('opacity-0');
    modal.find('.inline-block').addClass('scale-95 opacity-0');
    setTimeout(() => modal.addClass('hidden'), 300);
}

function applyFilter() {
    const jenis = $('#jenisFilter').val();
    const tanggalMin = $('#tanggalMin').val();
    const tanggalMax = $('#tanggalMax').val();
    const mitra = $('#mitraFilter').val();
    
    if (tanggalMin && tanggalMax && tanggalMax < tanggalMin) {
        Swal.fire({icon: 'error', title: 'Input Tidak Valid', text: 'Tanggal akhir harus lebih besar dari tanggal awal'});
        return;
    }
    
    let visibleCount = 0;
    
    $('#tableBody tr').each(function() {
        const $row = $(this);
        const rowJenis = $row.data('jenis') || '';
        const rowTanggal = $row.data('tanggal') || '';
        const rowMitra = $row.data('mitra') || '';
        
        const matchJenis = !jenis || rowJenis === jenis;
        const matchMitra = !mitra || rowMitra === mitra;
        
        let matchTanggal = true;
        if (tanggalMin || tanggalMax) {
            const tanggalRow = rowTanggal.split(' ')[0];
            if (tanggalMin && tanggalRow < tanggalMin) matchTanggal = false;
            if (tanggalMax && tanggalRow > tanggalMax) matchTanggal = false;
        }
        
        const isVisible = matchJenis && matchTanggal && matchMitra;
        $row.toggle(isVisible);
        if (isVisible) visibleCount++;
    });
    
    $('#noDataRow').remove();
    if (visibleCount === 0) {
        $('#tableBody').append('<tr id="noDataRow"><td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada transaksi yang sesuai.</td></tr>');
    }
    
    closeFilterModal();
}

function resetFilter() {
    $('#jenisFilter').val('');
    $('#tanggalMin').val('');
    $('#tanggalMax').val('');
    $('#mitraFilter').val('').trigger('change');
    $('#noDataRow').remove();
    $('#tableBody tr').show();
}

$(document).on('keydown', function(e) {
    if (e.key === 'Escape' && !$('#modalFilter').hasClass('hidden')) {
        closeFilterModal();
    }
});
</script>

<?php $this->endSection(); ?>
