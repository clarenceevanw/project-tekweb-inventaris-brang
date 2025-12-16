<style>
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, padding 0.4s ease;
        padding-top: 0;
        padding-bottom: 0;
    }

    .faq-answer.open {
        max-height: 500px;
        padding-top: 0.5rem;
        padding-bottom: 1.25rem;
    }

    .faq-icon {
        transition: transform 0.3s ease;
    }

    .faq-icon.rotate {
        transform: rotate(180deg);
    }
</style>

<section id="faq" class="relative py-10 md:py-12 px-4 md:px-8 bg-[#FBEFDF] z-10">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-[#2F3D44] mb-4">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-lg text-[#2F3D44]/90 max-w-2xl mx-auto">Temukan jawaban untuk pertanyaan umum tentang GudangPintar dan fitur-fiturnya</p>
        </div>

        <!-- Category Tabs -->
        <div class="flex flex-wrap gap-3 justify-center mb-8">
            <button type="button" data-category="general" class="category-btn px-6 py-2.5 cursor-pointer bg-[#2F3D44] text-[#FBEFDF] rounded-full text-sm font-semibold transition-all duration-300 shadow-[3px_3px_6px_rgba(0,0,0,0.3),-3px_-3px_6px_rgba(71,93,104,0.5)] hover:scale-105">Umum</button>
            <button type="button" data-category="features" class="category-btn px-6 py-2.5 cursor-pointer bg-[#2F3D44]/30 text-[#2F3D44] rounded-full text-sm font-semibold transition-all duration-300 hover:bg-[#2F3D44]/50 hover:scale-105">Fitur</button>
            <button type="button" data-category="subscription" class="category-btn px-6 py-2.5 cursor-pointer bg-[#2F3D44]/30 text-[#2F3D44] rounded-full text-sm font-semibold transition-all duration-300 hover:bg-[#2F3D44]/50 hover:scale-105">Langganan & Harga</button>
            <button type="button" data-category="technical" class="category-btn px-6 py-2.5 cursor-pointer bg-[#2F3D44]/30 text-[#2F3D44] rounded-full text-sm font-semibold transition-all duration-300 hover:bg-[#2F3D44]/50 hover:scale-105">Teknis</button>
        </div>

        <!-- FAQ Content -->
        <div class="min-h-[400px]">
            <!-- General -->
            <div data-category-content="general" class="category-content">
                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Apa itu GudangPintar?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">GudangPintar adalah solusi manajemen inventaris terpadu yang mengubah cara Anda mengelola gudang dengan teknologi cerdas dan efisien. Platform ini membantu Anda melacak produk, mengelola transaksi, dan mengoptimalkan ruang penyimpanan dari satu dashboard terpusat.</p>
                    </div>
                </div>

                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Siapa yang bisa menggunakan GudangPintar?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">GudangPintar dirancang untuk dua tipe pengguna: Organizer (pemilik gudang) yang mengelola inventaris dan operasional gudang, serta Partner (mitra bisnis) yang dapat memantau transaksi dan kinerja produk mereka.</p>
                    </div>
                </div>

                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Apakah GudangPintar mendukung multi-gudang?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">Ya, GudangPintar mendukung manajemen multi-gudang. Anda dapat mengelola beberapa gudang dari satu platform dengan kontrol terpusat, transfer lintas gudang, dan laporan spesifik untuk setiap lokasi.</p>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div data-category-content="features" class="category-content hidden">
                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Apa saja fitur utama untuk Organizer?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">Organizer memiliki akses ke Dashboard real-time, Kelola Admin, Kelola Kategori Produk, Kelola Produk, Kelola Ruangan, Kelola Transaksi, Scan QR untuk detail barang, dan Kelola Gudang untuk manajemen multi-lokasi.</p>
                    </div>
                </div>

                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Bagaimana cara kerja fitur Scan QR?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">Fitur Scan QR memungkinkan Anda untuk dengan cepat mengakses detail lengkap barang hanya dengan memindai kode QR yang terdapat pada produk. Ini mempercepat proses identifikasi dan pelacakan inventaris.</p>
                    </div>
                </div>

                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Apa yang bisa dilakukan Partner di platform ini?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">Partner dapat memantau metrik kemitraan melalui Dashboard khusus, melihat Riwayat Transaksi lengkap, melacak kinerja produk mereka, dan mengakses analitik pendapatan serta tren penjualan.</p>
                    </div>
                </div>

                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Bagaimana cara mengelola ruangan penyimpanan?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">Fitur Kelola Ruangan memungkinkan Anda membuat dan mengkonfigurasi ruang penyimpanan, mengelola kapasitas, melacak lokasi produk, mengatur tata letak, dan mengoptimalkan penggunaan ruang gudang Anda.</p>
                    </div>
                </div>
            </div>

            <!-- Subscription -->
            <div data-category-content="subscription" class="category-content hidden">
                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Apakah ada paket langganan yang tersedia?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">Ya, GudangPintar menawarkan berbagai paket langganan yang disesuaikan dengan kebutuhan bisnis Anda. Kunjungi halaman Langganan untuk melihat detail paket dan fitur yang tersedia di setiap tier.</p>
                        <a href="/#subscription" class="bg-[#EC4E3D] font-bold text-[#FBEFDF] hover:bg-[#EC4E3D]/90 active:bg-[#EC4E3D]/80 py-2 px-4 rounded inline-flex items-center mt-4">Langganan
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="w-6 h-6 ml-2">
                                <path d="M5 12h14" />
                                <path d="M13 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Bagaimana cara melakukan pembayaran?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">Pembayaran dapat dilakukan melalui berbagai metode yang terintegrasi dengan sistem kami. Setelah memilih paket langganan, Anda akan diarahkan ke halaman pembayaran yang aman untuk menyelesaikan transaksi.</p>
                    </div>
                </div>
            </div>

            <!-- Technical -->
            <div data-category-content="technical" class="category-content hidden">
                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Apakah data saya aman di GudangPintar?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">Keamanan data adalah prioritas utama kami. GudangPintar menggunakan enkripsi tingkat enterprise, backup rutin, dan protokol keamanan terkini untuk melindungi informasi inventaris dan bisnis Anda.</p>
                    </div>
                </div>

                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Apakah GudangPintar dapat diakses dari perangkat mobile?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">Ya, GudangPintar dirancang dengan desain responsif yang dapat diakses dari berbagai perangkat termasuk smartphone, tablet, dan desktop. Anda dapat mengelola inventaris kapan saja, di mana saja.</p>
                    </div>
                </div>

                <div class="faq-item bg-[#2F3D44] rounded-2xl mb-4 overflow-hidden transition-all duration-300 shadow-[6px_6px_12px_rgba(0,0,0,0.3),-6px_-6px_12px_rgba(71,93,104,0.5)] hover:shadow-[10px_10px_20px_rgba(0,0,0,0.4),-10px_-10px_20px_rgba(71,93,104,0.6)]">
                    <div class="faq-header p-5 md:p-6 cursor-pointer flex justify-between items-center gap-4 transition-all duration-300 hover:bg-[#FBEFDF]/5">
                        <span class="text-base md:text-lg font-semibold text-[#FBEFDF] flex-1">Bagaimana cara menghubungi support jika ada masalah?</span>
                        <svg class="faq-icon w-6 h-6 text-[#FBEFDF] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                    <div class="faq-answer px-5 md:px-6">
                        <p class="text-[#FBEFDF]/85 leading-relaxed text-sm md:text-base">Anda dapat menghubungi tim support kami melalui halaman Kontak. Kami siap membantu Anda dengan pertanyaan teknis, panduan penggunaan, atau masalah lainnya yang Anda hadapi.</p>
                        <a href="/#contact" class="bg-[#EC4E3D] font-bold text-[#FBEFDF] hover:bg-[#EC4E3D]/90 active:bg-[#EC4E3D]/80 py-2 px-4 rounded inline-flex items-center mt-4">Kontak Kami
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="w-6 h-6 ml-2">
                                <path d="M5 12h14" />
                                <path d="M13 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener untuk tab kategori
        const categoryButtons = document.querySelectorAll('.category-btn');
        categoryButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                switchCategory(category);
            });
        });

        // Event listener untuk FAQ items
        const faqHeaders = document.querySelectorAll('.faq-header');
        faqHeaders.forEach(header => {
            header.addEventListener('click', function() {
                toggleFaq(this);
            });
        });
    });

    // Fungsi untuk switch kategori
    function switchCategory(category) {
        // Sembunyikan semua kategori content
        const allContents = document.querySelectorAll('.category-content');
        allContents.forEach(content => {
            content.classList.add('hidden');
            // Tutup semua FAQ di kategori yang disembunyikan
            const answers = content.querySelectorAll('.faq-answer');
            const icons = content.querySelectorAll('.faq-icon');
            answers.forEach(answer => answer.classList.remove('open'));
            icons.forEach(icon => icon.classList.remove('rotate'));
        });

        // Tampilkan kategori yang dipilih
        const selectedContent = document.querySelector(`[data-category-content="${category}"]`);
        if (selectedContent) {
            selectedContent.classList.remove('hidden');
        }

        // Update styling tombol kategori
        const allButtons = document.querySelectorAll('.category-btn');
        allButtons.forEach(btn => {
            if (btn.getAttribute('data-category') === category) {
                // Tombol aktif
                btn.classList.remove('bg-[#2F3D44]/30', 'text-[#2F3D44]');
                btn.classList.add('bg-[#2F3D44]', 'text-[#FBEFDF]');
            } else {
                // Tombol tidak aktif
                btn.classList.remove('bg-[#2F3D44]', 'text-[#FBEFDF]');
                btn.classList.add('bg-[#2F3D44]/30', 'text-[#2F3D44]');
            }
        });
    }

    // Fungsi untuk toggle FAQ
    function toggleFaq(header) {
        const faqItem = header.closest('.faq-item');
        const answer = faqItem.querySelector('.faq-answer');
        const icon = faqItem.querySelector('.faq-icon');
        const isOpen = answer.classList.contains('open');

        // Tutup semua FAQ lain dalam kategori yang sama
        const categoryContent = faqItem.closest('.category-content');
        const allAnswers = categoryContent.querySelectorAll('.faq-answer');
        const allIcons = categoryContent.querySelectorAll('.faq-icon');

        allAnswers.forEach(a => a.classList.remove('open'));
        allIcons.forEach(i => i.classList.remove('rotate'));

        // Toggle FAQ yang diklik (jika sebelumnya tertutup, buka)
        if (!isOpen) {
            answer.classList.add('open');
            icon.classList.add('rotate');
        }
    }
</script>