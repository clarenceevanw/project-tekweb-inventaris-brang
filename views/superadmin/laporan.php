<?= $this->extend('layouts/superadmin'); ?>

<?= $this->section('content'); ?>
<div class="p-6 space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-theme-primary">Laporan</h1>
            <p class="text-theme-primary-light mt-1">Laporan dan analisis sistem</p>
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
    <div class="card-theme p-6">
        <h3 class="text-lg font-semibold text-theme-primary mb-4">Filter Laporan</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-theme-primary mb-2">Periode</label>
                <select id="periode" class="input-theme w-full">
                    <option value="7">7 Hari Terakhir</option>
                    <option value="30">30 Hari Terakhir</option>
                    <option value="90">3 Bulan Terakhir</option>
                    <option value="365">1 Tahun Terakhir</option>
                    <option value="custom">Custom</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-theme-primary mb-2">Tanggal Mulai</label>
                <input type="date" id="tanggal_mulai" class="input-theme w-full">
            </div>
            <div>
                <label class="block text-sm font-medium text-theme-primary mb-2">Tanggal Akhir</label>
                <input type="date" id="tanggal_akhir" class="input-theme w-full">
            </div>
            <div class="flex items-end">
                <button onclick="filterReport()" class="btn-theme-primary w-full">
                    Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="card-theme p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-theme-primary-light">Total Pendapatan</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1">Rp <?= number_format($total_pendapatan ?? 0, 0, ',', '.') ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-theme p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-theme-primary-light">Transaksi Baru</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $transaksi_baru ?? 0 ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-theme p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-theme-primary-light">Gudang Baru</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $gudang_baru ?? 0 ?></h3>
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
                    <p class="text-sm font-medium text-theme-primary-light">Mitra Baru</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $mitra_baru ?? 0 ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card-theme p-6">
            <h3 class="text-lg font-bold text-theme-primary mb-4">Pendapatan Bulanan</h3>
            <div class="relative h-64 w-full">
                <canvas id="pendapatanChart"></canvas>
            </div>
        </div>

        <div class="card-theme p-6">
            <h3 class="text-lg font-bold text-theme-primary mb-4">Distribusi Gudang per Wilayah</h3>
            <div class="relative h-64 w-full">
                <canvas id="wilayahChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Tables Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Performing Gudang -->
        <div class="card-theme">
            <div class="p-6 border-b border-theme-primary-dark">
                <h3 class="text-lg font-semibold text-theme-primary">Top Performing Gudang</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-theme-light">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-theme-primary-light uppercase tracking-wider">Gudang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-theme-primary-light uppercase tracking-wider">Transaksi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-theme-primary-light uppercase tracking-wider">Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-theme-primary-dark">
                        <?php if (!empty($top_gudang)): ?>
                            <?php foreach ($top_gudang as $gudang): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-theme-primary"><?= $gudang['nama_gudang'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-primary"><?= $gudang['total_transaksi'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-theme-primary">Rp <?= number_format($gudang['total_pendapatan'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-theme-primary-light">Belum ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="card-theme">
            <div class="p-6 border-b border-theme-primary-dark">
                <h3 class="text-lg font-semibold text-theme-primary">Aktivitas Terbaru</h3>
            </div>
            <div class="p-6 space-y-4">
                <?php if (!empty($recent_activities)): ?>
                    <?php foreach ($recent_activities as $activity): ?>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-theme-secondary rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-theme-primary"><?= $activity['title'] ?></p>
                                <p class="text-sm text-theme-primary-light"><?= $activity['description'] ?></p>
                                <p class="text-xs text-theme-primary-light mt-1"><?= $activity['created_at'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-theme-primary-light text-center py-4">Belum ada aktivitas</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    // Chart untuk Pendapatan Bulanan
    const pendapatanCtx = document.getElementById('pendapatanChart').getContext('2d');
    const pendapatanChart = new Chart(pendapatanCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pendapatan (Juta Rupiah)',
                data: <?= json_encode($pendapatan_chart_data ?? [12, 19, 15, 25, 22, 30, 28, 35, 32, 40, 38, 45]) ?>,
                borderColor: 'rgba(59, 130, 246, 1)',
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
                    beginAtZero: true
                }
            }
        }
    });

    // Chart untuk Distribusi Gudang per Wilayah
    const wilayahCtx = document.getElementById('wilayahChart').getContext('2d');
    const wilayahChart = new Chart(wilayahCtx, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($wilayah_labels ?? ['Jakarta', 'Bandung', 'Surabaya', 'Medan', 'Makassar']) ?>,
            datasets: [{
                data: <?= json_encode($wilayah_data ?? [35, 25, 20, 12, 8]) ?>,
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(251, 191, 36, 0.8)',
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(168, 85, 247, 0.8)'
                ],
                borderColor: [
                    'rgba(59, 130, 246, 1)',
                    'rgba(34, 197, 94, 1)',
                    'rgba(251, 191, 36, 1)',
                    'rgba(239, 68, 68, 1)',
                    'rgba(168, 85, 247, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Filter functions
    function filterReport() {
        const periode = document.getElementById('periode').value;
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        const tanggalAkhir = document.getElementById('tanggal_akhir').value;
        
        // Implementasi filter laporan
        console.log('Filter report:', { periode, tanggalMulai, tanggalAkhir });
        
        Toastify({
            text: "Laporan berhasil difilter!",
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            className: "toast-success"
        }).showToast();
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
        
        if (periode !== 'custom') {
            const days = parseInt(periode);
            const startDate = new Date(today.getTime() - (days * 24 * 60 * 60 * 1000));
            
            document.getElementById('tanggal_mulai').value = startDate.toISOString().split('T')[0];
            document.getElementById('tanggal_akhir').value = today.toISOString().split('T')[0];
        }
    });

    // Initialize with default period
    document.getElementById('periode').dispatchEvent(new Event('change'));
</script>
<?= $this->endSection(); ?>