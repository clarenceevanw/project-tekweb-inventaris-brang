<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<style>
    .home-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #9b8fd9 0%, #877acc 50%, #7a6bb8 100%);
    }

    .home-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        min-height: calc(100vh - 80px);
    }
    .home-container img {
        max-width: 90%;
        height: auto;
    }
    .section {
        padding: 80px 40px;
        color: white;
    }
    .section-title {
        font-size: 36px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 40px;
    }
    .about-content {
        max-width: 1000px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
    .about-card {
        background: linear-gradient(135deg, #f9f1ffff 0%, #e0d4f7 100%);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2), 0 1px 8px rgba(0, 0, 0, 0.1);
        transform: translateZ(0);
        transition: transform 0.3s ease;
        color: #333;
    }
    .about-card:hover {
        transform: translateY(-5px);
    }
    .about-card h3 {
        font-size: 20px;
        margin-bottom: 15px;
    }
    .about-card p {
        line-height: 1.6;
    }
    .contact-content {
        max-width: 600px;
        margin: 0 auto;
        background: linear-gradient(135deg, #f9f1ffff 0%, #e0d4f7 100%);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2), 0 1px 8px rgba(0, 0, 0, 0.1);
        color: #333;
    }
    .contact-item {
        margin-bottom: 25px;
    }
    .contact-item h3 {
        font-size: 18px;
        margin-bottom: 10px;
    }
    .contact-item p {
        font-size: 16px;
        color: #555;
    }
</style>

<div class="home-wrapper">
    <div class="home-container">
        <img src="gambar_home/homepagefix.png" alt="Homepage">
    </div>

    <?php include __DIR__ . '/components/demo.php'; ?>

    <section id="about" class="section">
        <h2 class="section-title">About Us</h2>
        <div class="about-content">
            <div class="about-card">
                <h3>Smart Inventory</h3>
                <p>Kelola inventaris gudang Anda dengan sistem yang cerdas dan efisien. Pantau stok barang secara real-time.</p>
            </div>
            <div class="about-card">
                <h3>Easy Tracking</h3>
                <p>Lacak pergerakan barang dengan mudah menggunakan teknologi QR code dan sistem pencatatan otomatis.</p>
            </div>
            <div class="about-card">
                <h3>Analytics</h3>
                <p>Dapatkan insight mendalam tentang inventaris Anda dengan laporan dan analitik yang komprehensif.</p>
            </div>
            <div class="about-card">
                <h3>Fast & Reliable</h3>
                <p>Sistem yang cepat dan handal untuk mendukung operasional bisnis Anda setiap hari.</p>
            </div>
        </div>
    </section>

    <section id="contact" class="section">
        <h2 class="section-title">Contact Us</h2>
        <div class="contact-content">
            <div class="contact-item">
                <h3>Address</h3>
                <p>Jl. Teknologi No. 123, Jakarta Selatan, Indonesia 12345</p>
            </div>
            <div class="contact-item">
                <h3>Email</h3>
                <p>info@gudangpintar.com</p>
            </div>
            <div class="contact-item">
                <h3>Phone</h3>
                <p>+62 812-3456-7890</p>
            </div>
            <div class="contact-item">
                <h3>Business Hours</h3>
                <p>Monday - Friday: 09:00 - 17:00<br>Saturday: 09:00 - 13:00</p>
            </div>
        </div>
    </section>
</div>

<?php $this->endSection(); ?>
