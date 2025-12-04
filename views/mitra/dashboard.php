<?php $this->extend('layouts/mitra'); ?>

<?php $this->section('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600 mt-1">Selamat datang, <span class="font-semibold text-indigo-600"><?= $_SESSION['user']['nama_mitra'] ?></span></p>
    </div>
</div>
<?php $this->endSection();