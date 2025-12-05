<style>
    .feature-card {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        background: linear-gradient(to bottom right, #9d91db, #8276c4);
        box-shadow: 8px 8px 16px rgba(106, 90, 160, 0.3), -8px -8px 16px rgba(180, 170, 230, 0.2), inset 2px 2px 4px rgba(255, 255, 255, 0.1);
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 12px 12px 24px rgba(106, 90, 160, 0.4), -12px -12px 24px rgba(180, 170, 230, 0.3), inset 3px 3px 6px rgba(255, 255, 255, 0.15);
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: linear-gradient(to bottom right, #a89ee0, #8e82ce);
        box-shadow: 4px 4px 8px rgba(106, 90, 160, 0.3), -4px -4px 8px rgba(180, 170, 230, 0.2);
    }

    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 50;
        align-items: center;
        justify-content: center;
        padding: 16px;
        animation: fadeIn 0.3s ease-out;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-overlay.closing {
        animation: fadeOut 0.3s ease-out forwards;
    }

    .modal-content {
        background: rgba(155, 143, 217, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(155, 143, 217, 0.3);
        border-radius: 20px;
        max-width: 500px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 8px 32px rgba(122, 107, 184, 0.2);
        animation: slideUp 0.3s ease-out;
    }

    .modal-overlay.closing .modal-content {
        animation: slideDown 0.3s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideDown {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(30px);
        }
    }

    .learn-more-btn {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        background: linear-gradient(to bottom right, #f9f1ffff, #e0d4f7);
        box-shadow: 4px 4px 8px rgba(106, 90, 160, 0.3), -4px -4px 8px rgba(180, 170, 230, 0.2);
    }

    .learn-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 6px 6px 16px rgba(106, 90, 160, 0.4), -6px -6px 16px rgba(180, 170, 230, 0.3);
    }

    .modal-icon {
        border-radius: 12px;
        margin: 0 auto 24px;
    }
</style>

<section id="features" class="py-16 md:py-24 px-4 md:px-8 text-white">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-4xl md:text-5xl font-black mb-4">Fitur Unggulan</h2>
            <p class="text-lg text-white text-opacity-90 max-w-2xl mx-auto">Jelajahi alat alat yang dirancang untuk organizer dan partner untuk menyederhanakan manajemen inventaris Anda</p>
        </div>

        <!-- Organizer Features -->
        <div class="mb-16">
            <h3 class="text-2xl md:text-3xl font-bold mb-8 flex items-center gap-3">
                <span class="w-2 h-2 bg-white rounded-full"></span>
                Fitur Organizer
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Dashboard -->
                <div class="feature-card rounded-2xl p-6">
                    <div class="feature-icon mb-4"><svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg></div>
                    <h4 class="text-xl font-bold text-white mb-2">Dashboard</h4>
                    <p class="text-white text-opacity-80 text-sm mb-4">Dapatkan gambaran lengkap tentang inventaris Anda sekilas</p>
                    <button class="learn-more-btn px-4 py-2 text-[#9b8fd9] rounded-lg text-sm font-semibold" onclick="openModal('dashboard-organizer')">Pelajari Lebih Lanjut</button>
                </div>

                <!-- Manage Admin -->
                <div class="feature-card rounded-2xl p-6">
                    <div class="feature-icon mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                        </svg></div>
                    <h4 class="text-xl font-bold text-white mb-2">Kelola Admin</h4>
                    <p class="text-white text-opacity-80 text-sm mb-4">Kontrol akses admin dan izin untuk tim Anda</p>
                    <button class="learn-more-btn px-4 py-2 text-[#9b8fd9] rounded-lg text-sm font-semibold" onclick="openModal('manage-admin')">Pelajari Lebih Lanjut</button>
                </div>

                <!-- Manage Product's Category -->
                <div class="feature-card rounded-2xl p-6">
                    <div class="feature-icon mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" />
                        </svg></div>
                    <h4 class="text-xl font-bold text-white mb-2">Kelola Kategori Produk</h4>
                    <p class="text-white text-opacity-80 text-sm mb-4">Organisir produk ke dalam kategori untuk manajemen yang lebih baik</p>
                    <button class="learn-more-btn px-4 py-2 text-[#9b8fd9] rounded-lg text-sm font-semibold" onclick="openModal('manage-category')">Pelajari Lebih Lanjut</button>
                </div>

                <!-- Manage Product -->
                <div class="feature-card rounded-2xl p-6">
                    <div class="feature-icon mb-4"><svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg></div>
                    <h4 class="text-xl font-bold text-white mb-2">Kelola Produk</h4>
                    <p class="text-white text-opacity-80 text-sm mb-4">Tambah, edit, dan lacak semua produk Anda dengan efisien</p>
                    <button class="learn-more-btn px-4 py-2 text-[#9b8fd9] rounded-lg text-sm font-semibold" onclick="openModal('manage-product')">Pelajari Lebih Lanjut</button>
                </div>

                <!-- Manage Room -->
                <div class="feature-card rounded-2xl p-6">
                    <div class="feature-icon mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 12v.01" />
                            <path d="M3 21h18" />
                            <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />
                        </svg></div>
                    <h4 class="text-xl font-bold text-white mb-2">Kelola Ruangan</h4>
                    <p class="text-white text-opacity-80 text-sm mb-4">Organisir ruang penyimpanan dan konfigurasi ruangan</p>
                    <button class="learn-more-btn px-4 py-2 text-[#9b8fd9] rounded-lg text-sm font-semibold" onclick="openModal('manage-room')">Pelajari Lebih Lanjut</button>
                </div>

                <!-- Manage Transaction -->
                <div class="feature-card rounded-2xl p-6">
                    <div class="feature-icon mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M21 15h-2.5c-.398 0 -.779 .158 -1.061 .439c-.281 .281 -.439 .663 -.439 1.061c0 .398 .158 .779 .439 1.061c.281 .281 .663 .439 1.061 .439h1c.398 0 .779 .158 1.061 .439c.281 .281 .439 .663 .439 1.061c0 .398 -.158 .779 -.439 1.061c-.281 .281 -.663 .439 -1.061 .439h-2.5" />
                            <path d="M19 21v1m0 -8v1" />
                            <path d="M13 21h-7c-.53 0 -1.039 -.211 -1.414 -.586c-.375 -.375 -.586 -.884 -.586 -1.414v-10c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h2m12 3.12v-1.12c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2" />
                            <path d="M16 10v-6c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-4c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414v6m8 0h-8m8 0h1m-9 0h-1" />
                            <path d="M8 14v.01" />
                            <path d="M8 17v.01" />
                            <path d="M12 13.99v.01" />
                            <path d="M12 17v.01" />
                        </svg></div>
                    <h4 class="text-xl font-bold text-white mb-2">Kelola Transaksi</h4>
                    <p class="text-white text-opacity-80 text-sm mb-4">Lacak dan kelola semua transaksi inventaris</p>
                    <button class="learn-more-btn px-4 py-2 text-[#9b8fd9] rounded-lg text-sm font-semibold" onclick="openModal('manage-transaction')">Pelajari Lebih Lanjut</button>
                </div>

                <!-- scan qr -->
                <div class="feature-card rounded-2xl p-6">
                    <div class="feature-icon mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                            <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z" />
                            <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z" />
                            <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z" />
                            <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z" />
                            <path d="M12 9h2V8h-2z" />
                        </svg></div>
                    <h4 class="text-xl font-bold text-white mb-2">Scan QR</h4>
                    <p class="text-white text-opacity-80 text-sm mb-4">Scan QR untuk mendapatkan detail barang</p>
                    <button class="learn-more-btn px-4 py-2 text-[#9b8fd9] rounded-lg text-sm font-semibold" onclick="openModal('scan-qr')">Pelajari Lebih Lanjut</button>
                </div>

                <!-- Manage Warehouse -->
                <div class="feature-card rounded-2xl p-6">
                    <div class="feature-icon mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 21v-13l9 -4l9 4v13" />
                            <path d="M13 13h4v8h-10v-6h6" />
                            <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                        </svg></div>
                    <h4 class="text-xl font-bold text-white mb-2">Kelola Gudang</h4>
                    <p class="text-white text-opacity-80 text-sm mb-4">Kelola beberapa gudang dari satu platform</p>
                    <button class="learn-more-btn px-4 py-2 text-[#9b8fd9] rounded-lg text-sm font-semibold" onclick="openModal('manage-warehouse')">Pelajari Lebih Lanjut</button>
                </div>
            </div>
        </div>

        <!-- Partner Features -->
        <div>
            <h3 class="text-2xl md:text-3xl font-bold mb-8 flex items-center gap-3">
                <span class="w-2 h-2 bg-white rounded-full"></span>
                Fitur Partner
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Dashboard -->
                <div class="feature-card rounded-2xl p-6">
                    <div class="feature-icon mb-4"><svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg></div>
                    <h4 class="text-xl font-bold text-white mb-2">Dashboard</h4>
                    <p class="text-white text-opacity-80 text-sm mb-4">Pantau metrik kemitraan dan kinerja Anda</p>
                    <button class="learn-more-btn px-4 py-2 text-[#9b8fd9] rounded-lg text-sm font-semibold" onclick="openModal('dashboard-partner')">Pelajari Lebih Lanjut</button>
                </div>

                <!-- Transaction's History -->
                <div class="feature-card rounded-2xl p-6">
                    <div class="feature-icon mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M21 15h-2.5c-.398 0 -.779 .158 -1.061 .439c-.281 .281 -.439 .663 -.439 1.061c0 .398 .158 .779 .439 1.061c.281 .281 .663 .439 1.061 .439h1c.398 0 .779 .158 1.061 .439c.281 .281 .439 .663 .439 1.061c0 .398 -.158 .779 -.439 1.061c-.281 .281 -.663 .439 -1.061 .439h-2.5" />
                            <path d="M19 21v1m0 -8v1" />
                            <path d="M13 21h-7c-.53 0 -1.039 -.211 -1.414 -.586c-.375 -.375 -.586 -.884 -.586 -1.414v-10c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h2m12 3.12v-1.12c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2" />
                            <path d="M16 10v-6c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-4c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414v6m8 0h-8m8 0h1m-9 0h-1" />
                            <path d="M8 14v.01" />
                            <path d="M8 17v.01" />
                            <path d="M12 13.99v.01" />
                            <path d="M12 17v.01" />
                        </svg></div>
                    <h4 class="text-xl font-bold text-white mb-2">Riwayat Transaksi</h4>
                    <p class="text-white text-opacity-80 text-sm mb-4">Lihat riwayat detail semua transaksi Anda</p>
                    <button class="learn-more-btn px-4 py-2 text-[#9b8fd9] rounded-lg text-sm font-semibold" onclick="openModal('transaction-history')">Pelajari Lebih Lanjut</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div id="featureModal" class="modal-overlay" onclick="closeModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="p-6 md:p-8">
            <!-- Close Button -->
            <button onclick="closeModal()" class="float-right text-purple-300 hover:text-purple-200 text-2xl leading-none">×</button>

            <!-- Modal Image -->
            <img class="modal-icon" id="modalImage" class="w-full object-contain" src="modalImage" alt="">

            <!-- Modal Content -->
            <h3 id="modalTitle" class="text-2xl md:text-3xl font-bold text-purple-200 mb-4 text-center"></h3>
            <p id="modalDescription" class="text-purple-100 text-base md:text-lg leading-relaxed mb-6"></p>

            <!-- Features List -->
            <div class="mb-6">
                <h4 class="font-bold text-purple-200 mb-3">Fitur Utama:</h4>
                <ul id="modalFeatures" class="space-y-2"></ul>
            </div>

            <!-- CTA Button -->
            <button onclick="closeModal()" class="w-full px-6 py-3 text-white rounded-lg font-semibold transition-all cursor-pointer hover:scale-105 active:scale-95" style="background: linear-gradient(135deg, #9b8fd9 0%, #877acc 100%);">
                Kembali
            </button>
        </div>
    </div>
</div>

<script>
    const featureData = {
        'dashboard-organizer': {
            image: '/assets/feature/dashboard.png',
            description: 'Dapatkan gambaran lengkap tentang seluruh sistem inventaris Anda secara real-time. Pantau jumlah stok, transaksi terbaru, dan metrik kunci semuanya di satu tempat.',
            features: [
                'Gambaran inventaris real-time',
                'Akses cepat ke metrik kunci',
                'Top 5 barang berdasarkan stok',
                'Transaksi 6 bulan terakhir',
                'Ringkasan stok barang'
            ]
        },
        'manage-admin': {
            image: '/assets/feature/admin.png',
            title: 'Kelola Admin',
            description: 'Kelola dan manajemen akun admin dengan mudah.',
            features: [
                'Buat dan kelola akun admin',
                'Pengaturan profil',
                'Pengaturan password',
            ]
        },
        'manage-category': {
            image: '/assets/feature/kategori.png',
            title: 'Kelola Kategori Produk',
            description: 'Kelola kategori produk Anda dengan mudah. Buat kategori tanpa batas, dan manajemen kategori.',
            features: [
                'Buat kategori tanpa batas',
                'Manajemen kategori',
                'Edit dan hapus kategori',
            ]
        },
        'manage-product': {
            image: '/assets/feature/barang.png',
            title: 'Kelola Produk',
            description: 'Tambah, edit, dan lacak semua produk Anda dengan informasi terperinci. Kelola foto, harga, dan batch produk dengan efisien.',
            features: [
                'Tambah dan edit detail produk',
                'Kelola foto produk',
                'Lacak harga dan batch produk',
                'Pengaturan stok produk',
            ]
        },
        'manage-room': {
            image: '/assets/feature/ruangan.png',
            title: 'Kelola Ruangan',
            description: 'Organisir ruang penyimpanan Anda dan konfigurasi tata letak ruangan. Lacak produk mana yang disimpan di ruangan mana untuk kontrol inventaris yang lebih baik.',
            features: [
                'Buat dan konfigurasi ruang penyimpanan',
                'Manajemen kapasitas ruangan',
                'Pelacakan lokasi produk',
                'Pengaturan tata letak ruangan',
                'Optimasi penyimpanan',
            ]
        },
        'manage-transaction': {
            image: '/assets/feature/transaksi.png',
            title: 'Kelola Transaksi',
            description: 'Lacak dan kelola semua transaksi inventaris termasuk masuk, keluar, dan transfer. Pertahankan riwayat transaksi lengkap.',
            features: [
                'Catat transaksi masuk',
                'Lacak pergerakan keluar',
                'Manajemen transfer internal',
                'Alur kerja persetujuan transaksi',
                'Jejak audit lengkap'
            ]
        },
        'scan-qr': {
            image: '/assets/feature/scan_qr.png',
            title: 'Scan QR',
            description: 'Scan QR untuk melihat detail barang',
            features: [
                'Scan QR untuk melihat detail barang',
            ]
        },
        'manage-warehouse': {
            image: '/assets/feature/gudang.png',
            title: 'Kelola Gudang',
            description: 'Kelola beberapa gudang dari satu platform. Kelola inventaris di berbagai lokasi dengan kontrol terpusat.',
            features: [
                'Manajemen multi-gudang',
                'Kontrol inventaris terpusat',
                'Transfer lintas gudang',
                'Laporan spesifik gudang',
                'Analitik berbasis lokasi'
            ]
        },
        'dashboard-partner': {
            image: '/assets/feature/dashboard.png',
            title: 'Dashboard',
            description: 'Pantau metrik kemitraan dan kinerja Anda. Lacak kontribusi Anda dan lihat bagaimana produk Anda berkinerja.',
            features: [
                'Metrik kinerja kemitraan',
                'Pelacakan penjualan produk',
                'Analitik pendapatan',
                'Tren kinerja',
                'Wawasan cepat dan KPI'
            ]
        },
        'transaction-history': {
            image: '/assets/feature/dashboard.png',
            title: 'Riwayat Transaksi',
            description: 'Lihat riwayat detail semua transaksi Anda. Filter dan cari transaksi masa lalu dengan pelaporan komprehensif.',
            features: [
                'Catatan transaksi lengkap',
                'Opsi penyaringan lanjutan',
                'Pencarian rentang tanggal',
                'Ekspor detail transaksi',
                'Pelacakan status transaksi'
            ]
        }
    };

    function openModal(featureId) {
        const data = featureData[featureId];
        if (!data) return;

        document.getElementById('modalImage').src = data.image;
        document.getElementById('modalTitle').textContent = data.title;
        document.getElementById('modalDescription').textContent = data.description;

        const featuresList = document.getElementById('modalFeatures');
        featuresList.innerHTML = data.features.map(feature =>
            `<li class="flex items-start gap-3">
                <span class="text-purple-300 font-bold mt-1">✓</span>
                <span class="text-purple-100">${feature}</span>
            </li>`
        ).join('');

        const modal = document.getElementById('featureModal');
        modal.classList.remove('closing');
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(event) {
        if (event && event.target.id !== 'featureModal') return;
        const modal = document.getElementById('featureModal');
        modal.classList.add('closing');
        setTimeout(() => {
            modal.classList.remove('active', 'closing');
            document.body.style.overflow = 'auto';
        }, 300);
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });
</script>