<style>
    .subscription-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow:
            0 8px 32px rgba(122, 107, 184, 0.15),
            0 4px 16px rgba(135, 122, 204, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    .subscription-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.6s ease;
    }

    .subscription-card:hover::before {
        left: 100%;
    }

    .subscription-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow:
            0 20px 60px rgba(122, 107, 184, 0.25),
            0 10px 30px rgba(135, 122, 204, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .featured {
        background: rgba(122, 107, 184, 0.2) !important;
        border: 2px solid rgba(122, 107, 184, 0.4) !important;
    }

    .featured::after {
        content: 'POPULAR';
        position: absolute;
        top: 10px;
        right: 16px;
        background: linear-gradient(135deg, #877acc, #7a6bb8);
        color: white;
        padding: 6px 16px;
        border-radius: 16px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        box-shadow: 0 4px 12px rgba(122, 107, 184, 0.4);
    }

    .gradient-text {
        background: linear-gradient(135deg, #7a6bb8, #877acc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .divider {
        width: 48px;
        height: 2px;
        background: linear-gradient(135deg, #877acc, #7a6bb8);
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(122, 107, 184, 0.3);
    }

    .subscribe-btn {
        background: linear-gradient(135deg, #877acc, #7a6bb8);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(122, 107, 184, 0.3);
    }

    .subscribe-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #9b8fd9, #877acc);
        transition: left 0.3s ease;
        z-index: -1;
    }

    .subscribe-btn:hover::before {
        left: 0;
    }

    .subscribe-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(122, 107, 184, 0.4);
    }

    .trial-badge {
        background: linear-gradient(135deg, #e0d4f7, #f9f1ffff);
        color: #7a6bb8;
        border: 1px solid rgba(122, 107, 184, 0.2);
    }

    .feature-item::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #877acc;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .feature-item2::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #fff;
        font-weight: 700;
        font-size: 1.1rem;
    }
</style>

<section id="subscription" class="h-auto flex items-center justify-center px-4 relative overflow-hidden py-20" style="background: linear-gradient(135deg, #f9f1ffff 0%, #e0d4f7 30%, #9b8fd9 70%, #877acc 100%);">
    <div class="max-w-6xl mx-auto w-full relative z-10">
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-2">Choose Your Plan</h1>
            <p class="text-lg font-medium" style="color: #7a6bb8;">Pilih paket yang sesuai dengan kebutuhan bisnis Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            <!-- Trial Plan -->
            <div class="subscription-card rounded-3xl p-6 text-center relative">
                <div class="trial-badge rounded-full px-4 py-2 text-sm font-semibold mb-3 inline-block">Free Trial</div>
                <h3 class="text-2xl font-bold uppercase tracking-wide mb-1" style="color: #7a6bb8;">Trial</h3>
                <p class="text-sm font-medium mb-4" style="color: #877acc;">7 Days Free</p>

                <div class="mb-4">
                    <span class="text-4xl font-extrabold" style="color: #7a6bb8;">
                        <span class="text-xl align-top">Rp</span>0
                    </span>
                    <div class="text-sm font-medium" style="color: #877acc;">untuk 7 hari</div>
                </div>

                <div class="divider mx-auto mb-4"></div>

                <ul class="space-y-2 mb-6 text-sm">
                    <li class="feature-item relative pl-6 font-medium" style="color: #7a6bb8;">Akses Penuh sistem inventaris</li>
                    <li class="feature-item relative pl-6 font-medium" style="color: #7a6bb8;">Manajemen barang & ruangan</li>
                    <li class="feature-item relative pl-6 font-medium" style="color: #7a6bb8;">Laporan & analitik</li>
                    <li class="feature-item relative pl-6 font-medium" style="color: #7a6bb8;">QR Code Scanner</li>
                </ul>

                <a href="/login/admin" class="subscribe-btn text-white border-0 px-8 py-3 rounded-full font-bold cursor-pointer no-underline inline-block uppercase tracking-wide text-sm">Start Trial</a>
            </div>

            <!-- Monthly Plan -->
            <div class="subscription-card featured rounded-3xl p-6 text-center relative transform scale-105">
                <h3 class="text-2xl font-bold uppercase tracking-wide mb-1" style="color: white;">Basic</h3>
                <p class="text-sm font-medium mb-4" style="color: white;">Monthly Plan</p>

                <div class="mb-4">
                    <span class="text-4xl font-extrabold" style="color: white;">
                        <span class="text-xl align-top">Rp</span>500K
                    </span>
                    <div class="text-sm font-medium" style="color: white;">per bulan</div>
                </div>

                <div class="divider mx-auto mb-4"></div>

                <ul class="space-y-2 mb-6 text-sm">
                    <li class="feature-item2 relative pl-6 font-medium" style="color: white;">Akses Penuh sistem inventaris</li>
                    <li class="feature-item2 relative pl-6 font-medium" style="color: white;">Manajemen barang & ruangan</li>
                    <li class="feature-item2 relative pl-6 font-medium" style="color: white;">Laporan & analitik</li>
                    <li class="feature-item2 relative pl-6 font-medium" style="color: white;">QR Code Scanner</li>
                </ul>

                <a href="/login/admin" class="subscribe-btn text-white border-0 px-8 py-3 rounded-full font-bold cursor-pointer no-underline inline-block uppercase tracking-wide text-sm">Subscribe Now</a>
            </div>

            <!-- Annual Plan -->
            <div class="subscription-card rounded-3xl p-6 text-center relative">
                <h3 class="text-2xl font-bold uppercase tracking-wide mb-1" style="color: #7a6bb8;">Pro</h3>
                <p class="text-sm font-medium mb-4" style="color: #877acc;">Annual Plan</p>

                <div class="mb-4">
                    <span class="text-4xl font-extrabold" style="color: #7a6bb8;">
                        <span class="text-xl align-top">Rp</span>5.000.000
                    </span>
                    <div class="text-sm font-medium" style="color: #877acc;">per tahun</div>
                </div>

                <div class="divider mx-auto mb-4"></div>

                <ul class="space-y-2 mb-6 text-sm">
                    <li class="feature-item relative pl-6 font-medium" style="color: #7a6bb8;">Akses Penuh sistem inventaris</li>
                    <li class="feature-item relative pl-6 font-medium" style="color: #7a6bb8;">Manajemen barang & ruangan</li>
                    <li class="feature-item relative pl-6 font-medium" style="color: #7a6bb8;">Laporan & analitik</li>
                    <li class="feature-item relative pl-6 font-medium" style="color: #7a6bb8;">QR Code Scanner</li>
                </ul>

                <a href="/login/admin" class="subscribe-btn text-white border-0 px-8 py-3 rounded-full font-bold cursor-pointer no-underline inline-block uppercase tracking-wide text-sm">Subscribe Now</a>
            </div>
        </div>
    </div>
</section>