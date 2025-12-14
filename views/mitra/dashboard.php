<?php $this->extend('layouts/mitra'); ?>

<?php $this->section('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container mx-auto px-4 py-8 space-y-6">
    
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg shadow-lg p-6 text-white">
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <p class="mt-1 text-indigo-100">Selamat datang, <span class="font-semibold"><?= $_SESSION['user']['nama_mitra'] ?></span></p>
    </div>

    <!-- Stats Cards dengan Progress -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Transaksi -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Transaksi</p>
                    <h3 class="text-4xl font-bold mt-2"><?= number_format($total_transaksi) ?></h3>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <span class="text-blue-100">Rata-rata: <?= $rata_rata_per_hari ?>/hari</span>
            </div>
        </div>

        <!-- Total Supply -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-green-100 text-sm font-medium">Total Supply</p>
                    <h3 class="text-4xl font-bold mt-2"><?= number_format($total_supply) ?></h3>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                    </svg>
                </div>
            </div>
            <div class="w-full bg-white bg-opacity-20 rounded-full h-2">
                <div class="bg-white h-2 rounded-full" style="width: <?= $total_transaksi > 0 ? ($total_supply/$total_transaksi*100) : 0 ?>%"></div>
            </div>
        </div>

        <!-- Transaksi Bulan Ini -->
        <?php 
        $perubahan = $transaksi_bulan_lalu > 0 ? (($transaksi_bulan_ini - $transaksi_bulan_lalu) / $transaksi_bulan_lalu * 100) : 0;
        $isNaik = $perubahan >= 0;
        ?>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Bulan Ini</p>
                    <h3 class="text-4xl font-bold mt-2"><?= number_format($transaksi_bulan_ini) ?></h3>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex items-center text-sm">
                <svg class="w-4 h-4 mr-1 <?= $isNaik ? 'text-green-300' : 'text-red-300' ?>" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="<?= $isNaik ? 'M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z' : 'M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z' ?>" clip-rule="evenodd"></path>
                </svg>
                <span class="<?= $isNaik ? 'text-green-300' : 'text-red-300' ?>"><?= abs(round($perubahan, 1)) ?>%</span>
                <span class="text-purple-100 ml-1">vs bulan lalu</span>
            </div>
        </div>

        <!-- Total Buy -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition-transform">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Total Buy</p>
                    <h3 class="text-4xl font-bold mt-2"><?= number_format($total_buy) ?></h3>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="w-full bg-white bg-opacity-20 rounded-full h-2">
                <div class="bg-white h-2 rounded-full" style="width: <?= $total_transaksi > 0 ? ($total_buy/$total_transaksi*100) : 0 ?>%"></div>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-indigo-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Gudang Favorit</p>
                    <h4 class="text-xl font-bold text-gray-900"><?= htmlspecialchars($gudang_favorit) ?></h4>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="bg-pink-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Performa</p>
                    <h4 class="text-xl font-bold <?= $perubahan >= 0 ? 'text-green-600' : 'text-red-600' ?>">
                        <?= $isNaik ? '↑' : '↓' ?> <?= abs(round($perubahan, 1)) ?>% bulan ini
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Line Chart - Trend 7 Hari -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Trend 7 Hari Terakhir</h2>
            <div style="height: 250px;">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        <!-- Bar Chart - Top 5 Barang -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Top 5 Barang</h2>
            <div style="height: 250px;">
                <canvas id="topBarangChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <!-- <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="/mitra/barang/tambah" class="flex flex-col items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="mt-2 text-sm font-medium text-gray-700">Tambah Barang</span>
            </a>
            <a href="/mitra/transaksi/masuk" class="flex flex-col items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                </svg>
                <span class="mt-2 text-sm font-medium text-gray-700">Barang Masuk</span>
            </a>
            <a href="/mitra/transaksi/keluar" class="flex flex-col items-center p-4 bg-orange-50 hover:bg-orange-100 rounded-lg transition">
                <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                </svg>
                <span class="mt-2 text-sm font-medium text-gray-700">Barang Keluar</span>
            </a>
            <a href="/mitra/laporan" class="flex flex-col items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition">
                <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="mt-2 text-sm font-medium text-gray-700">Lihat Laporan</span>
            </a>
        </div>
    </div> -->

    <!-- Recent Activities -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Aktivitas Terbaru</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Barang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (!empty($aktivitas_terbaru)): ?>
                        <?php foreach ($aktivitas_terbaru as $aktivitas): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php 
                                $waktu = strtotime($aktivitas['tanggal_transaksi']);
                                $sekarang = time();
                                $selisih = $sekarang - $waktu;
                                if ($selisih < 60) echo $selisih . ' detik lalu';
                                elseif ($selisih < 3600) echo floor($selisih/60) . ' menit lalu';
                                elseif ($selisih < 86400) echo floor($selisih/3600) . ' jam lalu';
                                else echo floor($selisih/86400) . ' hari lalu';
                                ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($aktivitas['jenis_transaksi'] == 'supply'): ?>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Masuk</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Keluar</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($aktivitas['nama_barang']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <?= $aktivitas['jenis_transaksi'] == 'supply' ? '+' : '-' ?><?= $aktivitas['kuantitas_transaksi'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($aktivitas['nama_admin']) ?> (<?= htmlspecialchars($aktivitas['nama_gudang']) ?>)</td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada aktivitas</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4 text-center">
            <a href="/mitra/transaksi" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">Lihat Semua Aktivitas →</a>
        </div>
    </div>

</div>

<script>
// Prepare data untuk charts
const trendData = <?= json_encode($trend_7_hari) ?>;
const topBarangData = <?= json_encode($top_barang) ?>;

// Process trend data
const dates = [];
const supplyData = [];
const buyData = [];

for (let i = 6; i >= 0; i--) {
    const date = new Date();
    date.setDate(date.getDate() - i);
    const dateStr = date.toISOString().split('T')[0];
    dates.push(date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }));
    
    const supply = trendData.find(d => d.tanggal === dateStr && d.jenis_transaksi === 'supply');
    const buy = trendData.find(d => d.tanggal === dateStr && d.jenis_transaksi === 'buy');
    
    supplyData.push(supply ? parseInt(supply.jumlah) : 0);
    buyData.push(buy ? parseInt(buy.jumlah) : 0);
}

// Line Chart - Trend 7 Hari
const trendCtx = document.getElementById('trendChart').getContext('2d');
new Chart(trendCtx, {
    type: 'line',
    data: {
        labels: dates,
        datasets: [
            {
                label: 'Supply',
                data: supplyData,
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.2)',
                tension: 0.4,
                fill: true,
                borderWidth: 3
            },
            {
                label: 'Buy',
                data: buyData,
                borderColor: 'rgb(249, 115, 22)',
                backgroundColor: 'rgba(249, 115, 22, 0.2)',
                tension: 0.4,
                fill: true,
                borderWidth: 3
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        aspectRatio: 2,
        plugins: {
            legend: {
                position: 'top',
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    precision: 0
                }
            }
        }
    }
});

// Bar Chart - Top 5 Barang
const topBarangCtx = document.getElementById('topBarangChart').getContext('2d');
const barangLabels = topBarangData.map(item => item.nama_barang);
const barangValues = topBarangData.map(item => parseInt(item.total_transaksi));

const colors = [
    'rgba(99, 102, 241, 0.8)',
    'rgba(34, 197, 94, 0.8)',
    'rgba(249, 115, 22, 0.8)',
    'rgba(168, 85, 247, 0.8)',
    'rgba(236, 72, 153, 0.8)'
];

const borderColors = [
    'rgb(99, 102, 241)',
    'rgb(34, 197, 94)',
    'rgb(249, 115, 22)',
    'rgb(168, 85, 247)',
    'rgb(236, 72, 153)'
];

new Chart(topBarangCtx, {
    type: 'bar',
    data: {
        labels: barangLabels,
        datasets: [{
            label: 'Total Transaksi',
            data: barangValues,
            backgroundColor: colors,
            borderColor: borderColors,
            borderWidth: 2,
            borderRadius: 6
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: true,
        aspectRatio: 2,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    precision: 0
                }
            }
        }
    }
});
</script>

<?php $this->endSection();