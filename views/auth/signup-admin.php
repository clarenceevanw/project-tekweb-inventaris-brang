<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-white to-purple-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="flex flex-col lg:flex-row min-h-screen">
            <!-- Left Branding -->
            <div class="lg:w-1/2 bg-gradient-to-br from-indigo-600 to-purple-700 p-12 text-white flex flex-col justify-center">
                <div class="mb-8">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold mb-4">Admin Portal</h1>
                    <p class="text-indigo-100 text-lg">Sistem Manajemen Inventaris Barang</p>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-indigo-200 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold">Kelola Inventaris</h3>
                            <p class="text-indigo-100 text-sm">Manajemen barang dan stok secara real-time</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-indigo-200 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold">Monitoring Gudang</h3>
                            <p class="text-indigo-100 text-sm">Pantau aktivitas gudang dengan mudah</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-indigo-200 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold">Laporan Lengkap</h3>
                            <p class="text-indigo-100 text-sm">Analisis data dan laporan komprehensif</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Form -->
            <div class="lg:w-1/2 p-12">
                <div class="max-w-md mx-auto">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Signup Admin</h2>
                        <p class="text-gray-600">Buat akun admin baru</p>
                    </div>

                    <?php
                    // CSRF Token
                    if (!isset($_SESSION)) session_start();
                    if (empty($_SESSION['csrf_token'])) {
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    }
                    ?>
                    <form method="POST" action="/signup/admin" autocomplete="off">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Admin</label>
                            <input type="text" name="nama_admin" pattern="[A-Za-z0-9 ]+" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Username Admin</label>
                            <input type="text" name="username_admin" pattern="[A-Za-z0-9_]+" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Admin</label>
                            <input type="password" name="password_admin" minlength="6" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Gudang</label>
                            <input type="text" name="nama_gudang" pattern="[A-Za-z0-9 ]+" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Gudang</label>
                            <input type="text" name="lokasi_gudang" required
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
                        </div>

                        <button type="submit" class="w-full py-3 px-4 rounded-lg text-white text-sm font-semibold shadow-sm bg-gradient-to-r from-indigo-600 to-purple-600 hover:scale-[1.02] transition">
                            Daftar Admin
                        </button>
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                    </form>

                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">Sudah punya akun? <a href="/login/admin" class="text-indigo-600 font-semibold">Login di sini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>