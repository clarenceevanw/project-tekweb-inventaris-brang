<?php $this->extend('layouts/main'); ?>

<?php $this->section('header'); ?>
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .card-hover {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .card-hover:hover {
        transform: translateY(-12px) scale(1.02);
    }

    .login-text {
        transition: all 0.3s ease;
    }

    .card-hover:hover .login-text {
        transform: translateX(8px);
        letter-spacing: 0.05em;
    }

    .icon-wrapper {
        transition: all 0.4s ease;
    }

    .card-hover:hover .icon-wrapper {
        transform: rotate(360deg) scale(1.1);
    }

    .feature-item {
        transition: all 0.3s ease;
    }

    .card-hover:hover .feature-item {
        transform: translateX(5px);
    }
</style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div class="min-h-screen w-full flex items-center justify-center bg-white">

    <?php if ($mode === 'login'): ?>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 p-4 sm:p-0">

            <!-- admin -->
            <a href="/login/admin" class="card-hover block active:scale-95">
                <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl p-8 md:p-10 text-white shadow-2xl h-full">

                    <div class="mb-8">
                        <div class="icon-wrapper w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01-.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01-.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                        </div>

                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3">Admin</h2>
                        <div class="login-text inline-flex items-center space-x-2 text-indigo-100 text-md sm:text-lg font-medium">
                            <span>Login sebagai Admin</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-4">

                        <div class="feature-item flex items-start space-x-3">
                            <svg class="w-6 h-6 text-indigo-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-md sm:text-lg">Kelola Inventaris</h3>
                                <p class="text-indigo-100 text-sm">Manajemen barang dan stok secara real-time</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-3">
                            <svg class="w-6 h-6 text-indigo-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-md sm:text-lg">Monitoring Gudang</h3>
                                <p class="text-indigo-100 text-sm">Pantau aktivitas gudang dengan mudah</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-3">
                            <svg class="w-6 h-6 text-indigo-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-md sm:text-lg">Laporan Lengkap</h3>
                                <p class="text-indigo-100 text-sm">Analisis data dan laporan komprehensif</p>
                            </div>
                        </div>

                    </div>

                </div>
            </a>

            <!-- Mitra Card -->
            <a href="/login/mitra" class="card-hover block active:scale-95">
                <div class="bg-gradient-to-br from-blue-600 to-cyan-600 rounded-3xl p-8 md:p-10 text-white shadow-2xl h-full">

                    <div class="mb-8">
                        <div class="icon-wrapper w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                        </div>

                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3">Mitra</h2>
                        <div class="login-text inline-flex items-center space-x-2 text-blue-100 text-md sm:text-lg font-medium">
                            <span>Login sebagai Mitra</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-4">

                        <div class="feature-item flex items-start space-x-3">
                            <svg class="w-6 h-6 text-blue-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-md sm:text-lg">Akses Dashboard</h3>
                                <p class="text-blue-100 text-sm">Pantau barang dan transaksi Anda</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-3">
                            <svg class="w-6 h-6 text-blue-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold text-md sm:text-lg">Laporan Real-time</h3>
                                <p class="text-blue-100 text-sm">Informasi barang dan transaksi terkini</p>
                            </div>
                        </div>

                    </div>

                </div>
            </a>
        </div>

    <?php elseif ($mode == 'signup'): ?>

                   <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 p-4 sm:p-0">

                <!-- admin -->
                <a href="/signup/admin" class="card-hover block active:scale-95">
                    <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl p-8 md:p-10 text-white shadow-2xl h-full">

                        <div class="mb-8">
                            <div class="icon-wrapper w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 sm:w-12 sm:h-12" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01-.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01-.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </div>

                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3">Admin</h2>
                            <div class="login-text inline-flex items-center space-x-2 text-indigo-100 text-md sm:text-lg font-medium">
                                <span>Sign Up sebagai Admin</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </div>
                        </div>

                        <div class="space-y-4">

                            <div class="feature-item flex items-start space-x-3">
                                <svg class="w-6 h-6 text-indigo-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-md sm:text-lg">Kelola Inventaris</h3>
                                    <p class="text-indigo-100 text-sm">Manajemen barang dan stok secara real-time</p>
                                </div>
                            </div>

                            <div class="feature-item flex items-start space-x-3">
                                <svg class="w-6 h-6 text-indigo-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-md sm:text-lg">Monitoring Gudang</h3>
                                    <p class="text-indigo-100 text-sm">Pantau aktivitas gudang dengan mudah</p>
                                </div>
                            </div>

                            <div class="feature-item flex items-start space-x-3">
                                <svg class="w-6 h-6 text-indigo-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-md sm:text-lg">Laporan Lengkap</h3>
                                    <p class="text-indigo-100 text-sm">Analisis data dan laporan komprehensif</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </a>

                <!-- Mitra Card -->
                <a href="/signup/mitra" class="card-hover block active:scale-95">
                    <div class="bg-gradient-to-br from-blue-600 to-cyan-600 rounded-3xl p-8 md:p-10 text-white shadow-2xl h-full">

                        <div class="mb-8">
                            <div class="icon-wrapper w-16 h-16 sm:w-20 sm:h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 sm:w-12 sm:h-12" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                            </div>

                            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3">Mitra</h2>
                            <div class="login-text inline-flex items-center space-x-2 text-blue-100 text-md sm:text-lg font-medium">
                                <span>Sign Up sebagai Mitra</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </div>
                        </div>

                        <div class="space-y-4">

                            <div class="feature-item flex items-start space-x-3">
                                <svg class="w-6 h-6 text-blue-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-md sm:text-lg">Akses Dashboard</h3>
                                    <p class="text-blue-100 text-sm">Pantau barang dan transaksi Anda</p>
                                </div>
                            </div>

                            <div class="feature-item flex items-start space-x-3">
                                <svg class="w-6 h-6 text-blue-200 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-md sm:text-lg">Laporan Real-time</h3>
                                    <p class="text-blue-100 text-sm">Informasi barang dan transaksi terkini</p>
                                </div>
                            </div>

                        </div>

                    </div>
                </a>
            </div>
    <?php endif; ?>

</div>

<?php $this->endSection(); ?>