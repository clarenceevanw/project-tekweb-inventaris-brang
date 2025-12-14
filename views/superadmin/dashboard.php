<?= $this->extend('layouts/superadmin'); ?>

<?= $this->section('content'); ?>
<div class="p-6 space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-theme-primary">Dashboard Super Admin</h1>
            <p class="text-theme-primary mt-1">Selamat datang, <span class="font-semibold text-theme-secondary"><?= $_SESSION['user']['nama_superadmin'] ?? 'Super Admin' ?></span></p>
            <p class="text-sm text-theme-primary-light">Panel Kontrol Utama</p>
        </div>
        <div class="mt-4 md:mt-0 flex flex-col sm:flex-row gap-2 sm:gap-3">
            <a href="/superadmin/gudang" class="btn-theme-primary inline-flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3 sm:w-4 sm:h-4 mr-2 icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 21v-13l9 -4l9 4v13" />
                    <path d="M13 13h4v8h-10v-6h6" />
                    <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                </svg>
                <span class="hidden sm:inline">Kelola Gudang</span>
                <span class="sm:hidden">Gudang</span>
            </a>
            <a href="/superadmin/admin" class="btn-theme-secondary inline-flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.85" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5 mr-2 size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                <span class="hidden sm:inline">Kelola Admin</span>
                <span class="sm:hidden">Admin</span>
            </a>
            <a href="/superadmin/laporan" class="btn-theme-accent inline-flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 sm:w-5 sm:h-5 mr-2 icon icon-tabler icons-tabler-outline icon-tabler-chart-bar">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    <path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    <path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    <path d="M4 20l14 0" />
                </svg>
                <span class="inline">Laporan</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="card-theme p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-theme-primary-light">Total Gudang</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $total_gudang ?? 0 ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse">
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
                    <p class="text-sm font-medium text-theme-primary-light">Total Admin</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $total_admin ?? 0 ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.85" stroke="currentColor" class="w-6 h-6 size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-theme p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-theme-primary-light">Total Mitra</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $total_mitra ?? 0 ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="card-theme p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-theme-primary-light">Total Transaksi</p>
                    <h3 class="text-2xl font-bold text-theme-primary mt-1"><?= $total_transaksi ?? 0 ?></h3>
                </div>
                <div class="icon-theme p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 icon icon-tabler icons-tabler-outline icon-tabler-cash-register">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M21 15h-2.5c-.398 0 -.779 .158 -1.061 .439c-.281 .281 -.439 .663 -.439 1.061c0 .398 .158 .779 .439 1.061c.281 .281 .663 .439 1.061 .439h1c.398 0 .779 .158 1.061 .439c.281 .281 .439 .663 .439 1.061c0 .398 -.158 .779 -.439 1.061c-.281 .281 -.663 .439 -1.061 .439h-2.5" />
                        <path d="M19 21v1m0 -8v1" />
                        <path d="M13 21h-7c-.53 0 -1.039 -.211 -1.414 -.586c-.375 -.375 -.586 -.884 -.586 -1.414v-10c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h2m12 3.12v-1.12c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2" />
                        <path d="M16 10v-6c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-4c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414v6m8 0h-8m8 0h1m-9 0h-1" />
                        <path d="M8 14v.01" />
                        <path d="M8 17v.01" />
                        <path d="M12 13.99v.01" />
                        <path d="M12 17v.01" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card-theme p-6">
            <h3 class="text-lg font-bold text-theme-primary mb-4">Statistik Gudang per Bulan</h3>
            <div class="relative h-64 w-full">
                <canvas id="gudangChart"></canvas>
            </div>
        </div>

        <div class="card-theme p-6">
            <h3 class="text-lg font-bold text-theme-primary mb-4">Aktivitas Admin</h3>
            <div class="relative h-64 w-full">
                <canvas id="adminChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card-theme p-6">
            <h3 class="text-lg font-bold text-theme-primary mb-4">Gudang Terbaru</h3>
            <div class="space-y-3">
                <?php if (!empty($recent_gudang)): ?>
                    <?php foreach ($recent_gudang as $gudang): ?>
                        <div class="flex items-center justify-between p-3 bg-theme-light rounded-lg">
                            <div>
                                <p class="font-medium text-theme-primary"><?= $gudang['nama_gudang'] ?></p>
                                <p class="text-sm text-theme-primary-light"><?= $gudang['lokasi_gudang'] ?></p>
                            </div>
                            <span class="badge-theme-success"><?= $gudang['status_gudang'] ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-theme-primary-light text-center py-4">Belum ada data gudang</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="card-theme p-6">
            <h3 class="text-lg font-bold text-theme-primary mb-4">Admin Terbaru</h3>
            <div class="space-y-3">
                <?php if (!empty($recent_admin)): ?>
                    <?php foreach ($recent_admin as $admin): ?>
                        <div class="flex items-center justify-between p-3 bg-theme-light rounded-lg">
                            <div>
                                <p class="font-medium text-theme-primary"><?= $admin['nama_admin'] ?></p>
                                <p class="text-sm text-theme-primary-light"><?= $admin['email_admin'] ?></p>
                            </div>
                            <span class="badge-theme-info"><?= $admin['gudang_nama'] ?? 'Belum ditugaskan' ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-theme-primary-light text-center py-4">Belum ada data admin</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    // Chart untuk Statistik Gudang
    const gudangCtx = document.getElementById('gudangChart').getContext('2d');
    const gudangChart = new Chart(gudangCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Gudang Baru',
                data: <?= json_encode($gudang_chart_data ?? [12, 19, 3, 5, 2, 3]) ?>,
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
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

    // Chart untuk Aktivitas Admin
    const adminCtx = document.getElementById('adminChart').getContext('2d');
    const adminChart = new Chart(adminCtx, {
        type: 'doughnut',
        data: {
            labels: ['Admin Aktif', 'Admin Tidak Aktif'],
            datasets: [{
                data: <?= json_encode($admin_chart_data ?? [65, 35]) ?>,
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderColor: [
                    'rgba(34, 197, 94, 1)',
                    'rgba(239, 68, 68, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
<?= $this->endSection(); ?>