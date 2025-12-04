<style>
    footer {
        padding: 64px 24px 32px;
    }

    footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #ffffff, transparent); /* disesuaikan agar kontras */
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    .footer-link {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .footer-link::before {
        content: '';
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #ffffff, #f4f4ff);
        transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .footer-link::after {
        content: '→';
        position: absolute;
        right: -20px;
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .footer-link:hover {
        color: #ffffff;
        transform: translateX(8px);
        padding-right: 20px;
    }

    .footer-link:hover::before {
        width: 100%;
    }

    .footer-link:hover::after {
        opacity: 1;
        transform: translateX(0);
    }

    .btn {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.25);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-login:hover {
        background-color: #ffffff;
        color: #4F46E5;
        border-color: #ffffff;
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.25), 0 0 20px rgba(255, 255, 255, 0.5);
    }

    .btn-signup:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.35), 0 0 30px rgba(255, 255, 255, 0.4);
        background: linear-gradient(135deg, #ffffff 0%, #f0eefe 100%);
    }

    .footer-legal-link {
        color: rgba(255, 255, 255, 0.75);
    }

    .footer-legal-link:hover {
        opacity: 1;
        transform: translateY(-2px);
    }

    .footer-legal-link::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 6px;
        transform: scale(0);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .footer-legal-link:hover::before {
        transform: scale(1);
    }

    @media (min-width: 640px) {
        .footer-main {
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
        }
    }

    @media (min-width: 1024px) {
        .footer-main {
            grid-template-columns: repeat(4, 1fr);
            gap: 48px;
        }
        .footer-bottom {
            flex-direction: row;
        }
    }
</style>

<footer id="footer" class="relative overflow-hidden text-white mt-auto" style="background-color:#9b8fd9;">
    <div class="mx-auto px-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-24 mb-12">

            <!-- Pages -->
            <div class="flex flex-col gap-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90">Pages</h3>
                <a href="/" class="footer-link relative inline-block w-fit text-base font-medium">Home</a>
                <a href="/#demo" class="footer-link relative inline-block w-fit text-base font-medium">Demo</a>
            </div>

            <!-- Features -->
            <div class="flex flex-col gap-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90">Features</h3>
                <a href="#feature1" class="footer-link relative inline-block w-fit font-medium">Feature 1</a>
                <a href="#feature2" class="footer-link relative inline-block w-fit font-medium">Feature 2</a>
                <a href="#feature3" class="footer-link relative inline-block w-fit font-medium">Feature 3</a>
                <a href="#feature4" class="footer-link relative inline-block w-fit font-medium">Feature 4</a>
            </div>

            <!-- Subscription -->
            <div class="flex flex-col gap-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90">Subscription</h3>
                <a href="#trial" class="footer-link relative inline-block w-fit font-medium">Trial 7 Hari</a>
                <a href="#monthly" class="footer-link relative inline-block w-fit font-medium">Basic Bulanan</a>
                <a href="#yearly" class="footer-link relative inline-block w-fit font-medium">Pro Tahunan</a>
            </div>

            <!-- Auth -->
            <div class="flex flex-col gap-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90">Get Started</h3>
                <a href="/auth/select/login"
                    class="btn btn-login relative inline-block px-7 py-3 rounded-lg font-semibold border-2 border-white text-white">
                    Login
                </a>
                <a href="/auth/select/signup"
                    class="btn btn-signup relative inline-block px-7 py-3 rounded-lg font-semibold text-[#9b8fd9] bg-white shadow-md">
                    Sign Up
                </a>
            </div>

        </div>

        <div class="border-t border-white/40 pt-8 mt-8">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                <p class="text-sm opacity-90">© 2025 GUDANGPINTAR. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#privacy" class="footer-legal-link relative px-2 py-1 text-sm">Privacy Policy</a>
                    <a href="#terms" class="footer-legal-link relative px-2 py-1 text-sm">Terms of Service</a>
                </div>
            </div>
        </div>

    </div>
</footer>