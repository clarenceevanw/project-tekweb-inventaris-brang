<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<style>
    .home-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #9b8fd9 0%, #877acc 50%, #7a6bb8 100%);
    }
    html {
        scroll-behavior: smooth;
    }
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 40px;
        background-color: transparent;
    }
    .nav-left {
        display: flex;
        align-items: center;
        gap: 40px;
    }
    .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 24px;
        font-weight: bold;
        color: white;
    }
    .brand img {
        height: 24px;
        width: auto;
    }
    .nav-links {
        display: flex;
        gap: 30px;
    }
    .nav-links a {
        color: white;
        text-decoration: none;
        font-size: 16px;
    }
    .nav-right {
        display: flex;
        gap: 15px;
    }
    .btn {
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .btn-login {
        background-color: transparent;
        color: white;
        border: 2px solid white;
    }
    .btn-login:hover {
        background-color: white;
        color: #877acc;
    }
    .btn-signup {
        background-color: white;
        color: #877acc;
    }
    .btn-signup:hover {
        background-color: #f0e6ff;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
    .footer {
        background-color: rgba(0, 0, 0, 0.2);
        color: white;
        padding: 40px 40px 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        margin-bottom: 30px;
    }
    .footer-section h4 {
        font-size: 18px;
        margin-bottom: 15px;
    }
    .footer-section ul {
        list-style: none;
        padding: 0;
    }
    .footer-section ul li {
        margin-bottom: 8px;
    }
    .footer-section a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 14px;
    }
    .footer-section a:hover {
        color: white;
    }
    .footer-bottom {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 14px;
        color: rgba(255, 255, 255, 0.7);
    }
    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            gap: 20px;
            padding: 20px;
        }
        .nav-left {
            flex-direction: column;
            gap: 15px;
        }
        .nav-links {
            gap: 15px;
        }
    }
</style>

<div class="home-wrapper">
    <nav class="navbar">
        <div class="nav-left">
            <div class="brand">
                <img src="gambar_home/logogudangnavbar.png" alt="Logo">
                Gudang Pintar
            </div>
            <div class="nav-links">
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
        <div class="nav-right">
            <a href="/login" class="btn btn-login">Login</a>
            <a href="/signup" class="btn btn-signup">Create a Free Account</a>
        </div>
    </nav>
    <div class="home-container">
        <img src="gambar_home/homepagefix.png" alt="Homepage">
    </div>

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

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Gudang Pintar</h4>
                <p style="font-size: 14px; color: rgba(255, 255, 255, 0.8);">Solusi manajemen inventaris gudang yang cerdas dan efisien untuk bisnis Anda.</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="/login/admin">Login</a></li>
                    <li><a href="/signup/admin">Sign Up</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Follow Us</h4>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">LinkedIn</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Gudang Pintar. All rights reserved.</p>
        </div>
    </footer>
</div>

<?php $this->endSection(); ?>
