<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-2xl font-bold mb-4">Welcome to the Dashboard</h3>
        <p class="text-gray-700">Selamat datang, <strong><?= $_SESSION['user']['nama_admin'] ?></strong>!</p>
        <p class="text-gray-700">Gudang: <strong><?= $_SESSION['gudang']['nama_gudang'] ?? 'N/A' ?></strong></p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <a href="/barang" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded mr-2">Kelola Barang</a>
        <a href="/logout" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Logout</a>
    </div>
</div>
<?php $this->endSection(); ?>