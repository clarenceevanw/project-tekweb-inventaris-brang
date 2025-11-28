<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>

<div class="max-w-md mx-auto my-12 bg-white p-10 rounded-lg shadow-lg">
    <h2 class="text-center text-3xl font-bold mb-8 text-gray-800">Login Mitra</h2>
    
    <?php if (isset($flash['error'])): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-5 text-center"><?= $flash['error'] ?></div>
    <?php endif; ?>
    
    <?php if (isset($flash['success'])): ?>
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-5 text-center"><?= $flash['success'] ?></div>
    <?php endif; ?>

    <form action="/login/mitra" method="POST">
        <div class="mb-5">
            <label for="username" class="block mb-2 text-gray-600 font-bold">Username</label>
            <input type="text" id="username" name="username" required autofocus class="w-full px-3 py-3 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
        </div>
        
        <div class="mb-5">
            <label for="password" class="block mb-2 text-gray-600 font-bold">Password</label>
            <input type="password" id="password" name="password" required class="w-full px-3 py-3 border border-gray-300 rounded focus:outline-none focus:border-indigo-500">
        </div>
        
        <button type="submit" class="w-full py-3 bg-indigo-500 text-white rounded font-bold hover:bg-indigo-600 transition">Login</button>
    </form>

    <div class="text-center mt-4">
        <a href="/signup/mitra" class="text-indigo-500 hover:underline">Belum punya akun? Daftar di sini</a>
    </div>
</div>

<?php $this->endSection(); ?>
