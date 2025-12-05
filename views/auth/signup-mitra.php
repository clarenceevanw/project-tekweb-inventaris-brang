<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap');
</style>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br py-12 px-4 sm:px-6 lg:px-8" style="background: linear-gradient(135deg, #e8e4f3 0%, #d4cde8 50%, #c5bce0 100%);">
    <div class="max-w-5xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="flex flex-col lg:flex-row">
            <!-- Left Side - Branding -->
            <div class="lg:w-1/2 p-12 text-white flex flex-col justify-center" style="background: linear-gradient(135deg, #877acc, #7a6bb8);">
                <div class="mb-8">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl mb-4">As <span style="font-family: 'Inter', sans-serif; font-weight: 700; font-style: italic;">Partner</span></h1>
                    <p style="color: rgba(255, 255, 255, 0.9);" class="text-lg">Warehouse Inventory Management System</p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 mt-1" style="color: rgba(255, 255, 255, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold">Provide Supplies</h3>
                            <p style="color: rgba(255, 255, 255, 0.9);" class="text-sm">Supply items to the warehouse easily</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 mt-1" style="color: rgba(255, 255, 255, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold">Purchase Items</h3>
                            <p style="color: rgba(255, 255, 255, 0.9);" class="text-sm">Buy items directly from the warehouse</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 mt-1" style="color: rgba(255, 255, 255, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-semibold">Track History</h3>
                            <p style="color: rgba(255, 255, 255, 0.9);" class="text-sm">Complete supply and purchase history tracking</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="lg:w-1/2 p-12">
                <div class="max-w-md mx-auto">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome</h2>
                        <p class="text-gray-600">Create your partner account</p>
                    </div>

                    <?php if (isset($flash['error'])): ?>
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span><?= $flash['error'] ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($flash['success'])): ?>
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-6">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span><?= $flash['success'] ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                    // CSRF Token
                    if (!isset($_SESSION)) session_start();
                    if (empty($_SESSION['csrf_token'])) {
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    }
                    ?>

                    <form action="/signup/mitra" method="POST" class="space-y-6" autocomplete="off">
                        <input type="hidden" name="csrf_token"
                            value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

                        <!-- NAMA MITRA -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Mitra</label>
                            <div class="relative">
                                <!-- ICON -->
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text"
                                    name="nama_mitra"
                                    required
                                    pattern="[A-Za-z0-9 ]+"
                                    maxlength="50"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg 
                focus:ring-2 focus:border-transparent transition duration-150 ease-in-out"
                                    style="--tw-ring-color: #877acc;"
                                    placeholder="Enter partner name">
                            </div>
                        </div>

                        <!-- EMAIL MITRA -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <div class="relative">
                                <!-- ICON -->
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="email"
                                    name="email_mitra"
                                    required
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg 
                focus:ring-2 focus:border-transparent transition duration-150 ease-in-out"
                                    style="--tw-ring-color: #877acc;"
                                    placeholder="Enter partner email">
                            </div>
                        </div>

                        <!-- USERNAME MITRA -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                            <div class="relative">
                                <!-- ICON -->
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text"
                                    name="username_mitra"
                                    required
                                    pattern="[A-Za-z0-9_]+"
                                    maxlength="30"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg 
                focus:ring-2 focus:border-transparent transition duration-150 ease-in-out"
                                    style="--tw-ring-color: #877acc;"
                                    placeholder="Choose partner username">
                            </div>
                        </div>

                        <!-- PASSWORD -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <!-- ICON -->
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input type="password"
                                    name="password_mitra"
                                    required
                                    minlength="6"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg 
                focus:ring-2 focus:border-transparent transition duration-150 ease-in-out"
                                    style="--tw-ring-color: #877acc;"
                                    placeholder="Create partner password">
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm 
        text-sm font-semibold text-white transition duration-150 ease-in-out transform hover:scale-[1.02]"
                            style="background: linear-gradient(135deg, #5a4a94, #4a3a7f);">

                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Create Partner Account
                        </button>
                    </form>

                    <div class="mt-6 space-y-3">
                        <div class="text-center">
                            <p class="text-sm text-gray-600">
                                Login as partner?
                                <a href="/login/mitra" class="font-semibold" style="color: #877acc;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Click here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>