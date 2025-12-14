<?php
$cardStyles = [
    ['bg' => '#FBEFDF', 'text' => '#25343B', 'subtext' => '#25343B', 'feature' => 'feature-item', 'badge' => true],
    ['bg' => '#e8d9c8', 'text' => '#25343B', 'subtext' => '#25343B', 'feature' => 'feature-item', 'badge' => false, 'featured' => true],
    ['bg' => '#FBEFDF', 'text' => '#25343B', 'subtext' => '#25343B', 'feature' => 'feature-item', 'badge' => false]
];
?>

<style>
    .subscription-card {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(95, 165, 156, 0.2);
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 8px 32px rgba(37, 52, 59, 0.15), 0 4px 16px rgba(95, 165, 156, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.3);
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
        box-shadow: 0 20px 60px rgba(37, 52, 59, 0.25), 0 10px 30px rgba(95, 165, 156, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.4);
        border-color: rgba(95, 165, 156, 0.3);
    }

    .featured {
        border: 2px solid rgba(236, 78, 61, 0.4) !important;
    }

    .featured::after {
        content: 'POPULAR';
        position: absolute;
        top: -4px;
        right: 16px;
        background: #EC4E3D;
        color: white;
        padding: 6px 16px;
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        box-shadow: 0 4px 12px rgba(236, 78, 61, 0.4);
    }

    .gradient-text {
        color: #FBEFDF;
    }

    .divider {
        width: 48px;
        height: 2px;
        background: linear-gradient(135deg, #5fa59c, #EC4E3D);
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(95, 165, 156, 0.3);
    }

    .subscribe-btn {
        background: #EC4E3D;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(236, 78, 61, 0.3);
    }

    .subscribe-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: #d43d2d;
        transition: left 0.3s ease;
        z-index: -1;
    }

    .subscribe-btn:hover::before {
        left: 0;
    }

    .subscribe-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(236, 78, 61, 0.4);
    }

    .trial-badge {
        background: #25343B;
        color: #FBEFDF;
        border: 1px solid rgba(37, 52, 59, 0.2);
    }

    .feature-item::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #25343B;
        font-weight: 700;
        font-size: 1.1rem;
    }

    #subscription {
        background: #FBEFDF;
        position: relative;
        /* min-height: 200vh; */
        transition: background 0.5s ease;
    }

    .box {
        background: linear-gradient(135deg, #1F2B31 0%, #25343B 50%, #2F3D44 100%);
        box-shadow: 0 20px 60px rgba(31, 43, 49, 0.5);
        border-radius: 20px;
    }

    .subscription-content {
        opacity: 0;
        position: relative;
        z-index: 10;
    }

    .card-wrapper {
        opacity: 0;
        transform: translateY(100px);
    }
</style>


<section id="subscription" class="relative z-2 flex items-center justify-center px-4 overflow-hidden py-20">
    <div class="box z-1 w-[20rem] h-[20rem] absolute top-[10%] left-1/2 transform -translate-x-1/2"></div>
    <div class="max-w-6xl mx-auto w-full relative z-10 subscription-content">
        <div class="text-center mb-8 header-content">
            <h1 class="text-4xl md:text-5xl font-bold gradient-text mb-2">Choose Your Plan</h1>
            <p class="text-lg font-medium" style="color: #FBEFDF;">Pilih paket yang sesuai dengan kebutuhan bisnis Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-6 max-w-5xl mx-auto p-4">
            <?php if (isset($paket_subscriptions) && !empty($paket_subscriptions)): ?>
                <?php foreach ($paket_subscriptions as $index => $paket): ?>
                    <?php $style = $cardStyles[$index % 3]; ?>
                    <div class="card-wrapper">
                        <div class="subscription-card rounded-3xl px-6 py-12 text-center relative <?= isset($style['featured']) ? 'featured transform scale-105' : '' ?>" style="background: <?= $style['bg'] ?>">
                            <?php if ($style['badge']): ?>
                                <div class="trial-badge absolute top-2 left-[52%] transform -translate-x-1/2 rounded-full px-4 py-2 text-sm font-semibold mb-3 inline-block">Free Trial</div>
                            <?php endif; ?>

                            <h3 class="text-2xl font-bold uppercase tracking-wide mb-1" style="color: <?= $style['text'] ?>"><?= htmlspecialchars($paket['nama_paket']) ?></h3>
                            <p class="text-sm font-medium mb-4" style="color: <?= $style['subtext'] ?>"><?= $paket['durasi_hari'] ?> Hari</p>

                            <div class="mb-4">
                                <span class="text-4xl font-extrabold" style="color: <?= $style['text'] ?>">
                                    <span class="text-xl align-top">Rp</span><?= number_format($paket['harga'], 0, ',', '.') ?>
                                </span>
                                <div class="text-sm font-medium" style="color: <?= $style['subtext'] ?>">
                                    <?= $paket['durasi_hari'] == 7 ? 'untuk 7 hari' : ($paket['durasi_hari'] <= 31 ? 'per bulan' : 'per tahun') ?>
                                </div>
                            </div>

                            <div class="divider mx-auto mb-4"></div>

                            <ul class="space-y-2 mb-6 text-sm">
                                <li class="<?= $style['feature'] ?> relative pl-6 font-medium" style="color: <?= $style['text'] ?>">Akses Penuh sistem inventaris</li>
                                <li class="<?= $style['feature'] ?> relative pl-6 font-medium" style="color: <?= $style['text'] ?>">Manajemen barang & ruangan</li>
                                <li class="<?= $style['feature'] ?> relative pl-6 font-medium" style="color: <?= $style['text'] ?>">Laporan & analitik</li>
                                <li class="<?= $style['feature'] ?> relative pl-6 font-medium" style="color: <?= $style['text'] ?>">QR Code Scanner</li>
                            </ul>

                            <a href="/auth/subscribe-redirect" class="subscribe-btn text-white border-0 px-8 py-3 rounded-full font-bold cursor-pointer no-underline inline-block uppercase tracking-wide text-sm">
                                <?= $paket['harga'] == 0 ? 'Try Now' : 'Subscribe Now' ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center text-white">
                    <p>Tidak ada paket subscription tersedia saat ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<script>
    gsap.registerPlugin(ScrollTrigger);

    (function() {
        const box = document.querySelector('.box');
        const section = document.querySelector('#subscription');
        const content = document.querySelector('.subscription-content');
        const header = document.querySelector('.header-content');
        const cards = document.querySelectorAll('.card-wrapper');

        // Reset awal
        gsap.set(box, {
            width: '20rem',
            height: '20rem',
            borderRadius: '20px'
        });
        gsap.set(content, {
            opacity: 0
        }); 

        // Fungsi menentukan start/end berdasarkan orientasi
        function getScrollValues() {
            if (window.matchMedia("(orientation: portrait)").matches) {
                return {
                    start: "top top",
                    end: "top center"
                };
            } else {
                return {
                    start: "top center",
                    end: "center center"
                };
            }
        }

        // Ambil nilai
        let {
            start,
            end
        } = getScrollValues();

        // Timeline utama
        let tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: start,
                end: end,
                scrub: false,
                once: true,
                toggleActions: "play none none none",
            }
        });

        tl.to(box, {
            width: '100vw',
            height: '100%',
            borderRadius: '0px',
            top: 0
        }).to(content, {
            opacity: 1
        }, "-=0.3");

        // Jika orientasi berubah → refresh ScrollTrigger
        const mq = window.matchMedia("(orientation: portrait)");
        mq.addEventListener("change", () => {
            ({
                start,
                end
            } = getScrollValues());
            ScrollTrigger.refresh();
        });

        // Cards animation
        ScrollTrigger.create({
            trigger: section,
            start: "center bottom",
            onEnter: () => {
                gsap.to(header, {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    ease: "power2.out"
                });

                gsap.to(cards, {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    stagger: 0.15,
                    ease: "power3.out",
                    delay: 0.3
                });
            }
        });
    })();
</script>