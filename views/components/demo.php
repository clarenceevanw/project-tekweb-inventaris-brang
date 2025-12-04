<!-- DEMO SECTION -->
<section id="demo" class="section demo-section">
    <h1 class="demo-main-title">Explore Our Core Features</h1>
    <!-- <p class="demo-main-subtitle">Sistem inventaris yang terintegrasi dari dashboard hingga mobile</p> -->
    
    <div class="demo-container">
        <!-- Demo Preview 1: Keterangan Kiri, Gambar Kanan -->
        <div class="demo-preview demo-preview-left">
            <div class="demo-header">
                <h3 class="demo-title">Analisis Gudang Real Time</h3>
                <p class="demo-description">Pantau stok, transaksi, dan laporan sekaligus dengan laporan grafik terpadu</p>
            </div>
            <div class="demo-mockup">
                <img src="gambar_demo/demo_tekweb_1.png" alt="Demo Dashboard" class="demo-image">
            </div>
        </div>

        <!-- Demo Preview 2: Gambar Kiri, Keterangan Kanan -->
        <div class="demo-preview demo-preview-right">
            <div class="demo-mockup">
                <img src="gambar_demo/demo_tekweb_2.png" alt="Demo Dashboard" class="demo-image">
            </div>
            <div class="demo-header">
                <h3 class="demo-title">Integrated QR Scan</h3>
                <p class="demo-description">Langsung bisa cek detail barang cukup dari genggaman ponsel</p>
            </div>
        </div>
        
        <!-- Demo Features List -->
        <!-- <div class="demo-features">
            <div class="demo-feature-item">
                <div class="feature-icon">📱</div>
                <div class="feature-text">
                    <h3>Scan QR Code</h3>
                    <p>Scan barang dengan cepat menggunakan QR code</p>
                </div>
            </div>
            <div class="demo-feature-item">
                <div class="feature-icon">📊</div>
                <div class="feature-text">
                    <h3>Dashboard Real-time</h3>
                    <p>Pantau inventaris secara real-time</p>
                </div>
            </div>
            <div class="demo-feature-item">
                <div class="feature-icon">🔄</div>
                <div class="feature-text">
                    <h3>Kelola Transaksi</h3>
                    <p>Catat transaksi masuk dan keluar barang</p>
                </div>
            </div>
        </div> -->

        <!-- CTA Button -->
        <!-- <div class="demo-cta">
            <a href="/demo/interactive" class="btn-demo-interactive">Coba Demo Interaktif →</a>
            <p class="demo-note">Tidak perlu registrasi untuk mencoba</p>
        </div> -->
    </div>
</section>

<style>
    .demo-section {
        padding: 80px 40px;
    }

    .demo-main-title {
        text-align: center;
        font-size: 48px;
        font-weight: bold;
        color: white;
        margin-bottom: 100px;
    }

    .demo-main-subtitle {
        text-align: center;
        font-size: 20px;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 60px;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }

    .demo-subtitle {
        text-align: center;
        font-size: 18px;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 50px;
    }

    .demo-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .demo-preview {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 40px;
        align-items: center;
        margin-bottom: 80px;
    }

    .demo-preview-right {
        grid-template-columns: 2fr 1fr;
    }

    .demo-header {
        text-align: left;
    }

    .demo-title {
        font-size: 44px;
        font-weight: bold;
        color: white;
        margin-bottom: 15px;
    }

    .demo-description {
        font-size: 24px;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
    }

    .demo-mockup {
        position: relative;
    }

    .demo-image {
        width: 100%;
        height: auto;
        display: block;
        background: transparent;
        object-fit: contain;
    }

    .demo-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .demo-mockup:hover .demo-overlay {
        opacity: 1;
    }

    .btn-play {
        background: white;
        color: #7a6bb8;
        border: none;
        padding: 15px 40px;
        border-radius: 50px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-play:hover {
        transform: scale(1.1);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
    }

    .demo-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .demo-feature-item {
        display: flex;
        gap: 20px;
        background: rgba(255, 255, 255, 0.1);
        padding: 25px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .demo-feature-item:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
    }

    .feature-icon {
        font-size: 40px;
        flex-shrink: 0;
    }

    .feature-text h3 {
        font-size: 18px;
        margin-bottom: 8px;
        color: white;
    }

    .feature-text p {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.5;
    }

    .demo-cta {
        text-align: center;
    }

    .btn-demo-interactive {
        display: inline-block;
        background: white;
        color: #7a6bb8;
        padding: 15px 40px;
        border-radius: 50px;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .btn-demo-interactive:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        background: #f0e6ff;
    }

    .demo-note {
        margin-top: 15px;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.7);
    }

    @media (max-width: 768px) {
        .demo-section {
            padding: 60px 20px;
        }

        .demo-main-title {
            font-size: 32px;
        }

        .demo-main-subtitle {
            font-size: 16px;
            margin-bottom: 40px;
        }

        .demo-preview,
        .demo-preview-right {
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 50px;
        }

        .demo-header {
            text-align: center;
        }

        .demo-features {
            grid-template-columns: 1fr;
        }

        .demo-feature-item {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
