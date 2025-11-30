<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="p-6 space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-600 mt-1">Selamat datang, <span class="font-semibold text-indigo-600"><?= $_SESSION['user']['nama_admin'] ?></span></p>
            <p class="text-sm text-gray-500"><?= $_SESSION['gudang']['nama_gudang'] ?? 'N/A' ?></p>
        </div>
        <div class="mt-4 md:mt-0 flex gap-3">
            <a href="/admin/barang" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                Kelola Barang
            </a>
            <a href="/admin/scan" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 6h6v6H6V6zm12 0h-6v6h6V6zm-6 12H6v-6h6v6z"></path></svg>
                Scan QR
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Barang</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1"><?= $total_barang ?></h3>
                </div>
                <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Stok</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1"><?= number_format($total_stok) ?></h3>
                </div>
                <div class="p-3 bg-green-50 rounded-lg text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Transaksi Supply</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1"><?= $total_supply ?></h3>
                </div>
                <div class="p-3 bg-purple-50 rounded-lg text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Transaksi Buy</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1"><?= $total_buy ?></h3>
                </div>
                <div class="p-3 bg-orange-50 rounded-lg text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Transaksi 6 Bulan Terakhir</h3>
            <div class="relative h-64 w-full">
                <canvas id="transaksiChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Top 5 Barang Berdasarkan Stok</h3>
             <div class="relative h-64 w-full">
                <canvas id="barangChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Stok Barang</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach($top_barang as $item): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($item['nama_barang']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= number_format($item['stok']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($item['stok'] > 100): ?>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Stok Aman</span>
                            <?php elseif($item['stok'] > 50): ?>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Stok Sedang</span>
                            <?php else: ?>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Stok Menipis</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        const rawData = <?= json_encode($transaksi_bulanan) ?>;
        const topBarang = <?= json_encode($top_barang) ?>;

        const dataMap = {};
        const allMonths = new Set();

        rawData.forEach(item => {
            allMonths.add(item.bulan);
            if (!dataMap[item.bulan]) dataMap[item.bulan] = { supply: 0, buy: 0 };
            dataMap[item.bulan][item.jenis_transaksi] = parseInt(item.jumlah) || 0;
        });

        const sortedMonths = Array.from(allMonths).sort();
        
        // Format Label Bulan (Singkat)
        const labels = sortedMonths.map(m => {
            const [year, month] = m.split('-');
            const date = new Date(year, month - 1);
            return date.toLocaleDateString('id-ID', { month: 'short', year: '2-digit' });
        });

        const supplyData = sortedMonths.map(m => dataMap[m]?.supply || 0);
        const buyData = sortedMonths.map(m => dataMap[m]?.buy || 0);

        const ctxTransaksi = document.getElementById('transaksiChart').getContext('2d');
        new Chart(ctxTransaksi, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Supply',
                        data: supplyData,
                        borderColor: 'rgb(147, 51, 234)',
                        backgroundColor: 'rgba(147, 51, 234, 0.1)',
                        borderWidth: 2,
                        pointRadius: 3,
                        tension: 0,
                        fill: false
                    },
                    {
                        label: 'Buy',
                        data: buyData,
                        borderColor: 'rgb(249, 115, 22)',
                        backgroundColor: 'rgba(249, 115, 22, 0.1)',
                        borderWidth: 2,
                        pointRadius: 3,
                        tension: 0,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: { position: 'top' },
                },
                scales: {
                    x: { ticks: { maxRotation: 0 } },
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });


        // --- 3. PIE CHART (Top Barang) ---
        const ctxBarang = document.getElementById('barangChart').getContext('2d');
        new Chart(ctxBarang, {
            type: 'pie',
            data: {
                labels: topBarang.map(b => b.nama_barang),
                datasets: [{
                    data: topBarang.map(b => parseInt(b.stok)),
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)', // Blue
                        'rgba(16, 185, 129, 0.8)', // Green
                        'rgba(147, 51, 234, 0.8)', // Purple
                        'rgba(249, 115, 22, 0.8)', // Orange
                        'rgba(239, 68, 68, 0.8)'   // Red
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: true, 
                layout: {
                    padding: 10
                },
                plugins: {
                    legend: {
                        display: true, 
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 15,
                            font: { size: 11 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += new Intl.NumberFormat('id-ID').format(context.raw);
                                return label;
                            }
                        }
                    }
                },
            }
        });
    });
</script>
<?= $this->endSection(); ?>