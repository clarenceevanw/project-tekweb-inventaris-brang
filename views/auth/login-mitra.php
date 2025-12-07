<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap');
</style>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br py-12 px-4 sm:px-6 lg:px-8" style="background: linear-gradient(135deg, #FBEFDF 0%, #f5e5d0 50%, #FBEFDF 100%);">
    <div class="max-w-5xl w-full rounded-2xl shadow-2xl overflow-hidden" style="background: #25343B;">
        <div class="flex flex-col lg:flex-row">
            <!-- Left Side - Branding -->
            <div class="lg:w-1/2 p-12 flex flex-col justify-center" style="background: linear-gradient(135deg, #FBEFDF, #f5e5d0); color: #25343B;">
                <div class="mb-8">
                    <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6" style="background: rgba(37, 52, 59, 0.1);">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                        </svg>
                    </div>
                    <h1 class="text-4xl mb-4">As <span style="font-family: 'Inter', sans-serif; font-weight: 700; font-style: italic;">Partner</span></h1>
                    <p style="color: rgba(37, 52, 59, 0.9);" class="text-lg">Warehouse Inventory Management System</p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold">Provide Supplies</h3>
                            <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Supply items to the warehouse easily</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold">Purchase Items</h3>
                            <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Buy items directly from the warehouse</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="font-semibold">Track History</h3>
                            <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Complete supply and purchase history tracking</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="lg:w-1/2 p-12">
                <div class="max-w-md mx-auto">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold mb-2" style="color: #FBEFDF;">Welcome Back</h2>
                        <p style="color: rgba(251, 239, 223, 0.8);">Sign in to your partner account</p>
                    </div>

                    <?php if (isset($flash['error'])): ?>
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <span><?= $flash['error'] ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($flash['success'])): ?>
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-6">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span><?= $flash['success'] ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form action="/login/mitra" method="POST" class="space-y-6">
                        <div>
                            <label for="username" class="block text-sm font-semibold mb-2" style="color: #FBEFDF;">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5" style="color: rgba(251, 239, 223, 0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input type="text" id="username" name="username" required autofocus 
                                    class="block w-full pl-10 pr-3 py-3 border rounded-lg focus:ring-2 focus:border-transparent transition duration-150 ease-in-out" style="background: rgba(251, 239, 223, 0.1); border-color: rgba(251, 239, 223, 0.3); color: #FBEFDF; --tw-ring-color: #EC4E3D;"
                                    placeholder="Enter username">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold mb-2" style="color: #FBEFDF;">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5" style="color: rgba(251, 239, 223, 0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password" required 
                                    class="block w-full pl-10 pr-3 py-3 border rounded-lg focus:ring-2 focus:border-transparent transition duration-150 ease-in-out" style="background: rgba(251, 239, 223, 0.1); border-color: rgba(251, 239, 223, 0.3); color: #FBEFDF; --tw-ring-color: #EC4E3D;"
                                    placeholder="Enter password">
                            </div>
                        </div>

                        <button type="submit" 
                            class="w-full flex justify-center mb-0 cursor-pointer py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold transition duration-150 ease-in-out transform hover:scale-[1.02]" style="background: #EC4E3D; color: #FBEFDF;" onmouseover="this.style.backgroundColor='#d43d2e'" onmouseout="this.style.backgroundColor='#EC4E3D'">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Sign In to Dashboard
                        </button>

                        <div class="relative flex items-center my-3">
                            <div class="flex-grow border-t" style="border-color: #FBEFDF;"></div>
                            <span class="flex-shrink mx-4 text-sm" style="color: #FBEFDF;">or</span>
                            <div class="flex-grow border-t" style="border-color: #FBEFDF;"></div>
                        </div>

                        <a href="/auth/google/login?role=mitra" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold transition duration-150 ease-in-out transform hover:scale-[1.02]" style="background-color: #5FA59C; color: white; text-decoration: none;" onmouseover="this.style.backgroundColor='#4d8680'" onmouseout="this.style.backgroundColor='#5FA59C'">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-brand-google w-5 h-5 mr-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2a9.96 9.96 0 0 1 6.29 2.226a1 1 0 0 1 .04 1.52l-1.51 1.362a1 1 0 0 1 -1.265 .06a6 6 0 1 0 2.103 6.836l.001 -.004h-3.66a1 1 0 0 1 -.992 -.883l-.007 -.117v-2a1 1 0 0 1 1 -1h6.945a1 1 0 0 1 .994 .89c.04 .367 .061 .737 .061 1.11c0 5.523 -4.477 10 -10 10s-10 -4.477 -10 -10s4.477 -10 10 -10z" /></svg>
                            Login with Google
                        </a>
                    </form>

                    <div class="mt-6 space-y-3">
                        <div class="text-center">
                            <p class="text-sm" style="color: rgba(251, 239, 223, 0.8);">
                                Don't have an account? 
                                <a href="/signup/mitra" class="font-semibold" style="color: #FBEFDF;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Sign up</a>
                            </p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm" style="color: rgba(251, 239, 223, 0.8);">
                                Login as organizer? 
                                <a href="/login/admin" class="font-semibold" style="color: #FBEFDF;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Click here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
