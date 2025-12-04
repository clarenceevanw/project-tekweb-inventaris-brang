<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-cyan-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="flex flex-col lg:flex-row">

            <!-- Left Side -->
            <div class="lg:w-1/2 bg-gradient-to-br from-blue-600 to-cyan-600 p-12 text-white flex flex-col justify-center">
                <div class="mb-8">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold mb-4">Portal Mitra</h1>
                    <p class="text-blue-100 text-lg">Sistem Manajemen Inventaris Barang</p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-blue-200 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold">Akses Dashboard</h3>
                            <p class="text-blue-100 text-sm">Pantau barang dan transaksi Anda</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-blue-200 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold">Laporan Real-time</h3>
                            <p class="text-blue-100 text-sm">Informasi barang dan transaksi terkini</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Signup Form -->
            <div class="lg:w-1/2 p-12">
                <div class="max-w-md mx-auto">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Mitra</h2>
                        <p class="text-gray-600">Isi form berikut untuk mendaftar</p>
                    </div>

                    <?php
                    // CSRF Token
                    if (!isset($_SESSION)) session_start();
                    if (empty($_SESSION['csrf_token'])) {
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    }
                    ?>
                    <form action="/signup/mitra" method="POST" class="space-y-6" autocomplete="off">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Mitra</label>
                            <div class="relative">
                                <input type="text" name="nama_mitra" required pattern="[A-Za-z0-9 ]+" maxlength="50"
                                    class="block w-full pl-4 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                    placeholder="Masukkan nama mitra">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                            <div class="relative">
                                <input type="text" name="username_mitra" required pattern="[A-Za-z0-9_]+" maxlength="30"
                                    class="block w-full pl-4 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                    placeholder="Masukkan username">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <input type="password" name="password_mitra" required minlength="6"
                                    class="block w-full pl-4 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                    placeholder="Masukkan password">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:scale-[1.02]">
                            Daftar Akun Mitra
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Sudah punya akun?
                            <a href="/login/mitra" class="font-semibold text-blue-600 hover:text-blue-500">Login di sini</a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->endSection(); ?>