<?= $this->extend('layouts/superadmin'); ?>

<?= $this->section('content'); ?>
<div class="p-6 space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-theme-primary">Laporan Subscription</h1>
            <p class="text-theme-primary-light mt-1">Statistik subscription dan aktivitas sistem</p>
        </div>
        <div class="mt-4 md:mt-0 flex gap-3">
            <button onclick="exportReport()" class="btn-theme-secondary inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export PDF
            </button>
            <button onclick="printReport()" class="btn-theme-primary inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-theme-light-alt rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-theme-primary mb-4">Filter Laporan</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-theme-primary mb-2">Periode</label>
                <select id="periode" class="w-full px-4 py-2 rounded-lg border-2 border-theme-primary-light bg-theme-light-bright text-theme-primary focus:outline-none focus:border-theme-secondary transition-colors">
                    <option value="7">7 Hari Terakhir</option>
                    <option value="30" selected>30 Hari Terakhir</option>
                    <option value="90">3 Bulan Terakhir</option>
                    <option value="365">1 Tahun Terakhir</option>
                    <option value="all">Semua Data</option>
                    <option value="custom">Custom</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-theme-primary mb-2">Tanggal Mulai</label>
                <input type="date" id="tanggal_mulai" class="w-full px-4 py-2 rounded-lg border-2 border-theme-primary-light bg-theme-light-bright text-theme-primary focus:outline-none focus:border-theme-secondary transition-colors">
            </div>
            <div>
                <label class="block text-sm font-medium text-theme-primary mb-2">Tanggal Akhir</label>
                <input type="date" id="tanggal_akhir" class="w-full px-4 py-2 rounded-lg border-2 border-theme-primary-light bg-theme-light-bright text-theme-primary focus:outline-none focus:border-theme-secondary transition-colors">
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-theme-light-alt rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-theme-primary-light text-sm font-medium">Subscription Aktif</p>
                    <h3 class="text-4xl font-bold mt-2 text-theme-primary"><?= $total_subscription_aktif ?? 0 ?></h3>
                </div>
                <div class="bg-theme-secondary p-3 rounded-full">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-theme-light-alt rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-theme-primary-light text-sm font-medium">Subscription Periode</p>
                    <h3 id="subscription_filtered" class="text-4xl font-bold mt-2 text-theme-primary">0</h3>
                </div>
                <div class="bg-theme-secondary p-3 rounded-full">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-theme-light-alt rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-theme-primary-light text-sm font-medium">Akan Berakhir (7 Hari)</p>
                    <h3 class="text-4xl font-bold mt-2 text-theme-primary"><?= $akan_berakhir_7_hari ?? 0 ?></h3>
                </div>
                <div class="bg-theme-secondary p-3 rounded-full">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-theme-light-alt rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-theme-primary-light text-sm font-medium">Total Gudang</p>
                    <h3 class="text-4xl font-bold mt-2 text-theme-primary"><?= $total_gudang_terdaftar ?? 0 ?></h3>
                </div>
                <div class="bg-theme-secondary p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-white">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21v-13l9 -4l9 4v13" />
                        <path d="M13 13h4v8h-10v-6h6" />
                        <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-theme-light-alt rounded-lg shadow-lg p-6">
            <h2 id="chart_title" class="text-xl font-bold text-theme-primary mb-4">Tren Subscription (30 Hari)</h2>
            <div class="relative h-64 w-full">
                <canvas id="subscriptionChart"></canvas>
            </div>
        </div>

        <div class="bg-theme-light-alt rounded-lg shadow-lg p-6">
            <h2 id="paket_title" class="text-xl font-bold text-theme-primary mb-4">Paket Populer (30 Hari)</h2>
            <div class="relative h-64 w-full">
                <canvas id="paketChart"></canvas>
            </div>
        </div>

        <div class="bg-theme-light-alt rounded-lg shadow-lg p-6 col-span-2">
            <h2 class="text-xl font-bold text-theme-primary mb-4">Gudang Akan Berakhir (30 Hari)</h2>
            <div class="space-y-2 max-h-64 overflow-y-auto">
                <?php if (!empty($gudang_akan_berakhir)): ?>
                    <?php foreach ($gudang_akan_berakhir as $gudang): ?>
                        <div class="flex items-center justify-between p-2 border-b border-theme-primary-dark">
                            <span class="text-sm text-theme-primary"><?= $gudang['nama_gudang'] ?></span>
                            <span class="text-xs font-semibold <?= $gudang['sisa_hari'] <= 7 ? 'text-red-600' : 'text-yellow-600' ?>">
                                <?= $gudang['sisa_hari'] ?> hari lagi
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-theme-primary-light text-center py-4">Tidak ada gudang yang akan berakhir</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Tables Section -->
    <div class="bg-theme-light-alt rounded-lg shadow-lg p-6">
        <h2 id="table_title" class="text-xl font-bold text-theme-primary mb-4">Subscription (30 Hari)</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-theme-light-bright rounded-lg overflow-hidden">
                <thead class="bg-theme-primary-light">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Gudang</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Paket</th>
                        <th class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-theme-light uppercase">Tanggal</th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs font-medium text-theme-light uppercase">Status</th>
                    </tr>
                </thead>
                <tbody id="subscription_table_body" class="bg-theme-light-bright divide-y divide-gray-200">
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    // Data subscription dari server
    const allSubscriptions = <?= json_encode($all_subscriptions ?? []) ?>;
    let subscriptionChart, paketChart;

    // Inisialisasi charts
    function initCharts() {
        const subscriptionCtx = document.getElementById('subscriptionChart').getContext('2d');
        subscriptionChart = new Chart(subscriptionCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Subscription',
                    data: [],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });

        const paketCtx = document.getElementById('paketChart').getContext('2d');
        paketChart = new Chart(paketCtx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Jumlah Pembelian',
                    data: [],
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.8)',
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(249, 115, 22, 0.8)',
                        'rgba(168, 85, 247, 0.8)',
                        'rgba(236, 72, 153, 0.8)'
                    ],
                    borderColor: [
                        'rgb(99, 102, 241)',
                        'rgb(34, 197, 94)',
                        'rgb(249, 115, 22)',
                        'rgb(168, 85, 247)',
                        'rgb(236, 72, 153)'
                    ],
                    borderWidth: 2,
                    borderRadius: 6
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 2,
                plugins: { legend: { display: false } },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, precision: 0 }
                    }
                }
            }
        });
    }

    // Filter data berdasarkan tanggal
    function filterData(startDate, endDate) {
        return allSubscriptions.filter(sub => {
            const subDate = new Date(sub.tanggal_bayar);
            return subDate >= startDate && subDate <= endDate;
        });
    }

    // Update chart subscription
    function updateSubscriptionChart(filteredData) {
        const dateCount = {};
        filteredData.forEach(sub => {
            const date = sub.tanggal_bayar.split(' ')[0];
            dateCount[date] = (dateCount[date] || 0) + 1;
        });

        const sortedDates = Object.keys(dateCount).sort();
        const labels = sortedDates.map(date => {
            const d = new Date(date);
            return d.getDate() + '/' + (d.getMonth() + 1);
        });
        const data = sortedDates.map(date => dateCount[date]);

        subscriptionChart.data.labels = labels.length > 0 ? labels : ['No Data'];
        subscriptionChart.data.datasets[0].data = data.length > 0 ? data : [0];
        subscriptionChart.update();
    }

    // Update chart paket populer
    function updatePaketChart(filteredData) {
        const paketCount = {};
        filteredData.forEach(sub => {
            paketCount[sub.nama_paket] = (paketCount[sub.nama_paket] || 0) + 1;
        });

        const sorted = Object.entries(paketCount)
            .sort((a, b) => b[1] - a[1])
            .slice(0, 5);

        paketChart.data.labels = sorted.length > 0 ? sorted.map(p => p[0]) : ['No Data'];
        paketChart.data.datasets[0].data = sorted.length > 0 ? sorted.map(p => p[1]) : [0];
        paketChart.update();
    }

    // Update tabel subscription
    function updateTable(filteredData) {
        const tbody = document.getElementById('subscription_table_body');
        const limited = filteredData.slice(0, 10);

        if (limited.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="text-sm">Tidak ada subscription pada periode ini</p>
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = limited.map(sub => {
            const date = new Date(sub.tanggal_bayar);
            const formattedDate = date.getDate() + ' ' + 
                ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'][date.getMonth()] + 
                ' ' + date.getFullYear();
            
            return `
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-4 sm:px-6 py-4 text-sm font-medium text-gray-900">
                        <div class="flex flex-col">
                            <span>${sub.nama_gudang}</span>
                            <span class="md:hidden text-xs text-gray-500 mt-1">${formattedDate}</span>
                        </div>
                    </td>
                    <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">${sub.nama_paket}</td>
                    <td class="hidden md:table-cell px-6 py-4 text-sm text-gray-500">${formattedDate}</td>
                    <td class="px-4 sm:px-6 py-4 text-center">
                        <span class="inline-flex px-2 py-1 text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            ${sub.status_bayar[0].toUpperCase() + sub.status_bayar.slice(1)}
                        </span>
                    </td>
                </tr>
            `;
        }).join('');
    }

    // Apply filter
    function applyFilter() {
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        const tanggalAkhir = document.getElementById('tanggal_akhir').value;
        
        if (!tanggalMulai || !tanggalAkhir) return;
        
        if (new Date(tanggalMulai) > new Date(tanggalAkhir)) return;
        
        const startDate = new Date(tanggalMulai);
        const endDate = new Date(tanggalAkhir);
        endDate.setHours(23, 59, 59, 999);
        
        const filtered = filterData(startDate, endDate);
        
        document.getElementById('subscription_filtered').textContent = filtered.length;
        updateSubscriptionChart(filtered);
        updatePaketChart(filtered);
        updateTable(filtered);
        
        const days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
        const periodText = days === 7 ? '7 Hari' : days === 30 ? '30 Hari' : days === 90 ? '3 Bulan' : days === 365 ? '1 Tahun' : 'Custom';
        document.getElementById('chart_title').textContent = `Tren Subscription (${periodText})`;
        document.getElementById('paket_title').textContent = `Paket Populer (${periodText})`;
        document.getElementById('table_title').textContent = `Subscription (${periodText})`;
    }

    function exportReport() {
        // Implementasi export PDF
        console.log('Export report to PDF');
        
        Toastify({
            text: "Laporan sedang diexport...",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            className: "toast-success"
        }).showToast();
    }

    function printReport() {
        // Implementasi print
        window.print();
    }

    // Handle periode change
    document.getElementById('periode').addEventListener('change', function() {
        const periode = this.value;
        const today = new Date();
        
        if (periode === 'all') {
            if (allSubscriptions.length > 0) {
                const dates = allSubscriptions.map(s => new Date(s.tanggal_bayar));
                const minDate = new Date(Math.min(...dates));
                document.getElementById('tanggal_mulai').value = minDate.toISOString().split('T')[0];
                document.getElementById('tanggal_akhir').value = today.toISOString().split('T')[0];
                applyFilter();
            }
        } else if (periode !== 'custom') {
            const days = parseInt(periode);
            const startDate = new Date(today.getTime() - (days * 24 * 60 * 60 * 1000));
            
            document.getElementById('tanggal_mulai').value = startDate.toISOString().split('T')[0];
            document.getElementById('tanggal_akhir').value = today.toISOString().split('T')[0];
            applyFilter();
        }
    });
    
    // Auto switch ke custom dan filter otomatis saat tanggal diubah manual
    document.getElementById('tanggal_mulai').addEventListener('change', function() {
        const tanggalAkhir = document.getElementById('tanggal_akhir').value;
        if (tanggalAkhir && new Date(this.value) > new Date(tanggalAkhir)) {
            this.value = '';
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: 'Tanggal mulai tidak boleh lebih besar dari tanggal akhir!',
                confirmButtonColor: '#3b82f6'
            });
        } else {
            document.getElementById('periode').value = 'custom';
            if (tanggalAkhir) applyFilter();
        }
    });
    
    document.getElementById('tanggal_akhir').addEventListener('change', function() {
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        if (tanggalMulai && new Date(this.value) < new Date(tanggalMulai)) {
            this.value = '';
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: 'Tanggal akhir tidak boleh lebih kecil dari tanggal mulai!',
                confirmButtonColor: '#3b82f6'
            });
        } else {
            document.getElementById('periode').value = 'custom';
            if (tanggalMulai) applyFilter();
        }
    });

    // Initialize
    initCharts();
    document.getElementById('periode').dispatchEvent(new Event('change'));
</script>
<?= $this->endSection(); ?>