<style>
    @keyframes pulse {

        0%,
        100% {
            opacity: 0.3;
            transform: scale(1);
        }

        50% {
            opacity: 0.5;
            transform: scale(1.05);
        }
    }

    .animate-pulse {
        animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Neumorphism Shadows */
    .neuro-card {
        background: #FBEFDF;
        box-shadow:
            6px 6px 12px rgba(37, 52, 59, 0.08),
            -6px -6px 12px rgba(251, 247, 240, 0.9);
    }

    .neuro-card:hover {
        box-shadow:
            10px 10px 20px rgba(37, 52, 59, 0.12),
            -10px -10px 20px rgba(254, 250, 250, 1);;
    }

    .neuro-icon {
        background: #FBEFDF;
        color: #25343B;
        box-shadow:
            3px 3px 6px rgba(37, 52, 59, 0.08),
            -3px -3px 6px rgba(255, 255, 255, 0.9);
    }

    .neuro-icon:hover {
        box-shadow:
            2px 2px 4px rgba(37, 52, 59, 0.06),
            -2px -2px 4px rgba(255, 255, 255, 0.8);
    }

    .neuro-map {
        background: #FBEFDF;
        box-shadow:
            6px 6px 12px rgba(37, 52, 59, 0.08),
            -6px -6px 12px rgba(255, 255, 255, 0.9);
    }

    .neuro-badge {
        box-shadow:
            3px 3px 6px rgba(34, 197, 94, 0.3),
            -2px -2px 4px rgba(134, 239, 172, 0.2),
            inset 1px 1px 2px rgba(255, 255, 255, 0.2);
    }
</style>

<section id="contact" class="relative z-2 min-h-screen py-12 md:py-20 px-4 md:px-6 text-[#25343B] relative overflow-hidden" style="background: linear-gradient(135deg, #FBEFDF 0%, #f5e5d0 50%, #FBEFDF 100%);">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-48 h-48 md:w-72 md:h-72 bg-white/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-64 h-64 md:w-96 md:h-96 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="max-w-6xl mx-auto relative z-10">
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-center mb-2 md:mb-4" style="color: #25343B;">
            Hubungi Kami
        </h2>
        <p class="text-center mb-8 md:mb-12 text-sm md:text-lg" style="color: #25343B; opacity: 0.7;">Kami Siap Melayani Anda</p>

        <div class="grid md:grid-cols-2 gap-4 md:gap-8">

            <!-- LEFT INFO -->
            <div class="flex flex-col gap-3 md:gap-6">

                <!-- Address Card -->
                <a href="https://maps.google.com/?q=Jl.+Siwalankerto+No.121-131,+Surabaya"
                    target="_blank"
                    class="group p-4 md:p-5 rounded-2xl md:rounded-3xl
                          neuro-card transition-all duration-500 ease-out
                          hover:scale-[1.02] cursor-pointer">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 md:w-10 md:h-10 rounded-xl md:rounded-2xl
                                    flex items-center justify-center flex-shrink-0
                                    neuro-icon transition-all duration-500 group-hover:rotate-6">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-[#25343B] drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base md:text-lg font-semibold mb-1 md:mb-2 drop-shadow" style="color: #25343B;">Alamat</h3>
                            <p class="leading-relaxed text-sm md:text-base" style="color: #25343B; opacity: 0.8;">Jl. Siwalankerto No.121-131, Surabaya, Jawa Timur</p>
                        </div>
                        <svg class="w-4 h-4 md:w-5 md:h-5 group-hover:translate-x-1 transition-all duration-300 drop-shadow flex-shrink-0" style="color: #25343B; opacity: 0.6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                <!-- Email Card -->
                <a href="mailto:info@gudangpintar.com"
                    class="group p-4 md:p-5 rounded-2xl md:rounded-3xl
                          neuro-card transition-all duration-500 ease-out
                          hover:scale-[1.02] cursor-pointer">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 md:w-10 md:h-10 rounded-xl md:rounded-2xl
                                    flex items-center justify-center flex-shrink-0
                                    neuro-icon transition-all duration-500 group-hover:rotate-6">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-[#25343B] drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base md:text-lg font-semibold mb-1 md:mb-2 drop-shadow" style="color: #25343B;">Email</h3>
                            <p class="text-sm md:text-base break-all" style="color: #25343B; opacity: 0.8;">info@gudangpintar.com</p>
                        </div>
                        <svg class="w-4 h-4 md:w-5 md:h-5 group-hover:translate-x-1 transition-all duration-300 drop-shadow flex-shrink-0" style="color: #25343B; opacity: 0.6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                <!-- WhatsApp Card -->
                <a href="https://wa.me/628123456789"
                    target="_blank"
                    class="group p-4 md:p-5 rounded-2xl md:rounded-3xl
                          neuro-card transition-all duration-500 ease-out
                          hover:scale-[1.02] cursor-pointer">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 md:w-10 md:h-10 rounded-xl md:rounded-2xl
                                    flex items-center justify-center flex-shrink-0
                                    neuro-icon transition-all duration-500 group-hover:rotate-6">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-[#25343B] drop-shadow-lg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base md:text-lg font-semibold mb-1 md:mb-2 drop-shadow" style="color: #25343B;">WhatsApp</h3>
                            <p class="text-sm md:text-base" style="color: #25343B; opacity: 0.8;">+62 812-3456-7890</p>
                        </div>
                        <svg class="w-4 h-4 md:w-5 md:h-5 group-hover:translate-x-1 transition-all duration-300 drop-shadow flex-shrink-0" style="color: #25343B; opacity: 0.6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>

                <!-- Business Hours Card -->
                <div class="p-4 md:p-5 rounded-2xl md:rounded-3xl
                            neuro-card transition-all duration-500 ease-out
                            hover:scale-[1.02]">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 md:w-10 md:h-10 rounded-xl md:rounded-2xl
                                    flex items-center justify-center flex-shrink-0
                                    neuro-icon transition-all duration-500">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-[#25343B] drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1 md:mb-2 gap-2">
                                <h3 class="text-base md:text-lg font-semibold drop-shadow" style="color: #25343B;">Jam Operasional</h3>
                                <span id="statusBadge" class="px-2 py-0.5 md:px-3 md:py-1 rounded-full text-[10px] md:text-xs font-semibold 
                                           bg-gradient-to-r from-green-400/30 to-green-500/30 
                                           text-green-50 neuro-badge whitespace-nowrap flex-shrink-0">
                                    Buka
                                </span>
                            </div>
                            <p class="mb-0.5 md:mb-1 text-sm md:text-base" style="color: #25343B; opacity: 0.8;">Senin - Jumat: 09:00 - 17:00</p>
                            <p class="text-sm md:text-base" style="color: #25343B; opacity: 0.8;">Sabtu: 09:00 - 13:00</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- MAP RIGHT -->
            <div class="rounded-2xl md:rounded-3xl overflow-hidden
                        neuro-map transition-all duration-500
                        hover:scale-[1.02] group h-[300px] md:h-auto">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.8476123456789!2d112.7456789!3d-7.2575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb63d5c5c5c5%3A0x5c5c5c5c5c5c5c5c!2sJl.%20Siwalankerto%20No.121-131%2C%20Surabaya%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1234567890"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-full border-0 transition-all duration-500">
                </iframe>
            </div>

        </div>
    </div>
</section>

<script>
    function checkBusinessHours() {
        // Get current time in WIB (UTC+7)
        const now = new Date();
        const wibTime = new Date(now.toLocaleString("en-US", {
            timeZone: "Asia/Jakarta"
        }));

        const day = wibTime.getDay();
        const hours = wibTime.getHours();
        const minutes = wibTime.getMinutes();
        const currentTime = hours * 60 + minutes;

        const badge = document.getElementById('statusBadge');

        let isOpen = false;

        if (day >= 1 && day <= 5) {
            if (currentTime >= 9 * 60 && currentTime < 17 * 60) {
                isOpen = true;
            }
        } else if (day === 6) {
            if (currentTime >= 9 * 60 && currentTime < 13 * 60) {
                isOpen = true;
            }
        }

        if (isOpen) {
            badge.textContent = 'Buka';
            badge.className = 'px-2 py-0.5 md:px-3 md:py-1 rounded-full text-[10px] md:text-xs font-semibold bg-gradient-to-r from-green-400/30 to-green-500/30 text-green-50 neuro-badge whitespace-nowrap flex-shrink-0';
        } else {
            badge.textContent = 'Tutup';
            badge.className = 'px-2 py-0.5 md:px-3 md:py-1 rounded-full text-[10px] md:text-xs font-semibold bg-gradient-to-r from-red-400/30 to-red-500/30 text-red-50 neuro-badge-closed whitespace-nowrap flex-shrink-0';
        }
    }

    // Check on page load
    checkBusinessHours();

    // Update every minute
    setInterval(checkBusinessHours, 60000);
</script>