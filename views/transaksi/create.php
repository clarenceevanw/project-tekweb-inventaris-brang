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
    color: #111827;
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #374151;
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

<div class="p-6 space-y-6">
    <div class="flex items-center gap-2 mb-4 text-sm">
        <a href="/admin/transaksi" class="text-theme-secondary hover:text-theme-secondary-dark font-medium">Transaksi</a>
        <svg class="w-4 h-4 text-theme-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        <span class="text-theme-primary font-medium">Tambah</span>
    </div>

    <div>
        <h1 class="text-3xl font-bold text-theme-primary">Tambah Transaksi</h1>
        <p class="text-theme-primary mt-1">Buat transaksi supply atau buy baru</p>
    </div>

    <form id="formTransaksi" class="space-y-6">
        <!-- Info Transaksi -->
        <div class="card-theme p-6">
            <h3 class="text-lg font-semibold text-theme-primary mb-4">Informasi Transaksi</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Transaksi</label>
                    <select name="jenis_transaksi" id="jenis_transaksi" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="supply">Supply</option>
                        <option value="buy">Buy</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mitra</label>
                    <select name="id_mitra" id="id_mitra" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                        <option value="">-- Pilih Mitra --</option>
                        <?php foreach($mitra as $m): ?>
                            <option value="<?= $m['id_mitra'] ?>"><?= $m['nama_mitra'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Items -->
        <div class="card-theme p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-theme-primary">Item Barang</h3>
                <button type="button" onclick="addItem()" class="btn-theme-secondary inline-flex items-center justify-center">
                    + Tambah Item
                </button>
            </div>
            <div id="itemsContainer" class="space-y-4">
                <!-- Items will be added here -->
            </div>
        </div>

        <!-- Total -->
        <div class="card-theme p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-theme-primary">Total Harga</h3>
                <p class="text-2xl font-bold text-theme-primary">Rp <span id="totalHarga">0</span></p>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-4">
            <button type="submit" class="btn-theme-primary inline-flex items-center justify-center">
                Simpan Transaksi
            </button>
            <a href="/admin/transaksi" class="btn-theme-accent inline-flex items-center justify-center">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
let itemIndex = 0;
const barangData = <?= json_encode($barang) ?>;
const ruanganData = <?= json_encode($ruangan) ?>;

function addItem() {
    const jenis = $('#jenis_transaksi').val();
    if (!jenis) {
        Swal.fire({icon: 'warning', title: 'Peringatan', text: 'Pilih jenis transaksi terlebih dahulu'});
        return;
    }
    
    const container = document.getElementById('itemsContainer');
    const itemDiv = document.createElement('div');
    itemDiv.className = 'border border-gray-200 rounded-lg p-4 relative bg-theme-light-alt';
    itemDiv.id = `item-${itemIndex}`;
    
    const isBuy = jenis === 'buy';
    const gridCols = isBuy ? 'md:grid-cols-3' : 'md:grid-cols-5';
    
    itemDiv.innerHTML = `
        <button type="button" onclick="removeItem(${itemIndex})" class="absolute top-2 right-2 text-red-600 hover:text-red-800">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="grid grid-cols-1 ${gridCols} gap-4">
            <div>
                <label class="block text-sm font-medium text-theme-primary mb-2">Barang</label>
                <select name="items[${itemIndex}][id_barang]" id="barang_${itemIndex}" required onchange="updateTotal()" class="barang-select w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                    <option value="">-- Pilih Barang --</option>
                    ${barangData.map(b => `<option value="${b.id_barang}">${b.nama_barang}</option>`).join('')}
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-theme-primary mb-2">Kuantitas</label>
                <input type="number" name="items[${itemIndex}][kuantitas]" required min="1" onchange="updateTotal()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
            </div>
            ${!isBuy ? `
            <div>
                <label class="block text-sm font-medium text-theme-primary mb-2">Expired Date (Opsional)</label>
                <input type="date" name="items[${itemIndex}][expired_date]" class="w-full px-3 py-[0.44rem] border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
            </div>` : ''}
            <div>
                <label class="block text-sm font-medium text-theme-primary mb-2">Harga Total</label>
                <input type="number" name="items[${itemIndex}][harga]" required min="0" onchange="updateTotal()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
            </div>
            ${!isBuy ? `
            <div>
                <label class="block text-sm font-medium text-theme-primary mb-2">Ruangan</label>
                <select name="items[${itemIndex}][id_ruangan]" id="ruangan_${itemIndex}" required class="ruangan-select w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--theme-secondary)]">
                    <option value="">-- Pilih Ruangan --</option>
                    ${ruanganData.map(r => `<option value="${r.id_ruangan}">${r.nama_ruangan}</option>`).join('')}
                </select>
            </div>` : ''}
        </div>
    `;
    
    container.appendChild(itemDiv);
    $(`#barang_${itemIndex}`).select2({
        placeholder: '-- Pilih Barang --',
        allowClear: true,
        width: '100%',
        theme: 'default',
        dropdownCssClass: 'select2-custom'
    });
    
    if (!isBuy) {
        $(`#ruangan_${itemIndex}`).select2({
            placeholder: '-- Pilih Ruangan --',
            allowClear: true,
            width: '100%',
            theme: 'default',
            dropdownCssClass: 'select2-custom'
        });
    }
    
    itemIndex++;
}

function removeItem(index) {
    const item = document.getElementById(`item-${index}`);
    item.remove();
    updateTotal();
}

function updateTotal() {
    let total = 0;
    document.querySelectorAll('input[name*="[harga]"]').forEach(input => {
        const value = parseFloat(input.value) || 0;
        total += value;
    });
    document.getElementById('totalHarga').textContent = total.toLocaleString('id-ID');
}

// Initialize Select2 for mitra
$('#id_mitra').select2({
    placeholder: '-- Pilih Mitra --',
    allowClear: true,
    width: '100%',
    theme: 'default',
    dropdownCssClass: 'select2-custom'
});

// Don't add item on load, wait for jenis_transaksi selection

$('#jenis_transaksi').on('change', function() {
    $('#itemsContainer').empty();
    itemIndex = 0;
});

$('#formTransaksi').on('submit', function(e) {
    e.preventDefault();
    
    const items = document.querySelectorAll('#itemsContainer > div');
    if (items.length === 0) {
        Swal.fire({icon: 'warning', title: 'Peringatan', text: 'Tambahkan minimal 1 item barang'});
        return;
    }
    
    Swal.fire({title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => {Swal.showLoading()}});
    
    $.ajax({
        url: '/admin/transaksi/store',
        method: 'POST',
        data: $(this).serialize(),
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
                setTimeout(() => {window.location.href = '/admin/transaksi';}, 1500);
            } else {
                Swal.fire({icon: 'error', title: 'Gagal', text: data.message})
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({icon: 'error', title: 'Error Server', text: 'Something went wrong'})
        }
    });
});
</script>

<?php $this->endSection(); ?>
