<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<style>
    .home-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #9b8fd9 0%, #877acc 50%, #7a6bb8 100%);
    }
</style>

<div class="home-wrapper">
    <?php include __DIR__ . '/components/hero.php'; ?>
    <div class="w-screen h-screen"></div>
    <?php include __DIR__ . '/components/demo.php'; ?>
    <?php include __DIR__ . '/components/features.php'; ?>
    <?php include __DIR__ . '/components/subscription.php'; ?>
    <?php include __DIR__ . '/components/contact.php'; ?>
</div>

<?php $this->endSection(); ?>