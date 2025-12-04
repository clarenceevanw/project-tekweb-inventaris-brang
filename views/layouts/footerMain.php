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
            background: linear-gradient(90deg, transparent, #eef2ff, transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
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
            background: linear-gradient(90deg, #eef2ff, #ffffff);
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
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-login:hover {
            background-color: #eef2ff;
            color: #4F46E5;
            border-color: #eef2ff;
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3), 0 0 20px rgba(238, 242, 255, 0.5);
        }

        .btn-signup:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.35), 0 0 30px rgba(255, 255, 255, 0.4);
            background: linear-gradient(135deg, #ffffff 0%, #eef2ff 100%);
        }

        .footer-copyright:hover {
            opacity: 1;
        }

        .footer-legal-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            transform: scale(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .footer-legal-link:hover::before {
            transform: scale(1);
        }

        .footer-legal-link:hover {
            opacity: 1;
            transform: translateY(-2px);
        }

        /* Responsive untuk tablet */
        @media (min-width: 640px) {
            .footer-main {
                grid-template-columns: repeat(2, 1fr);
                gap: 32px;
            }
        }

        /* Responsive untuk desktop */
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

    <footer id="footer" class="relative overflow-hidden bg-indigo-600 text-indigo-100 mt-auto">
        <div class="mx-auto px-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-24 mb-12">

                <!-- Column 1: Pages -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-70">Pages</h3>
                    <a href="/" class="footer-link relative inline-block w-fit text-base font-medium transition-all">Home</a>
                    <a href="/#demo" class="footer-link relative inline-block w-fit text-base font-medium transition-all">Demo</a>
                </div>

                <!-- Column 2 -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-70">Features</h3>
                    <a href="#feature1" class="footer-link relative inline-block w-fit font-medium">Feature 1</a>
                    <a href="#feature2" class="footer-link relative inline-block w-fit font-medium">Feature 2</a>
                    <a href="#feature3" class="footer-link relative inline-block w-fit font-medium">Feature 3</a>
                    <a href="#feature4" class="footer-link relative inline-block w-fit font-medium">Feature 4</a>
                </div>

                <!-- Column 3 -->
                <div class="inline-flex flex-col gap-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-70">Subscription</h3>
                    <a href="#trial" class="footer-link relative inline-block w-fit font-medium">Trial 7 Hari</a>
                    <a href="#monthly" class="footer-link relative inline-block w-fit font-medium">Basic Bulanan</a>
                    <a href="#yearly" class="footer-link relative inline-block w-fit font-medium">Pro Tahunan</a>
                </div>

                <!-- Column 4: Auth -->
                <div class="flex flex-col gap-4">
                    <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-70">Get Started</h3>
                    <a href="/auth/select/login"
                        class="btn relative inline-block px-7 py-3 rounded-lg font-semibold border-2 border-indigo-100 text-indigo-100 transition-all hover:bg-indigo-100 hover:text-indigo-600 hover:-translate-y-1 shadow-none hover:shadow-xl">
                        Login
                    </a>
                    <a href="/auth/select/signup"
                        class="btn relative inline-block px-7 py-3 rounded-lg font-semibold border-2 bg-gradient-to-br from-indigo-100 to-white text-indigo-600 shadow-md transition-all hover:-translate-y-1 hover:scale-[1.02] hover:shadow-2xl hover:from-white hover:to-indigo-100">
                        Sign Up
                    </a>
                </div>

            </div>

            <div class="border-t border-indigo-100/20 pt-8 mt-8">
                <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                    <p class="text-sm opacity-70 hover:opacity-100 transition">© 2025 GUDANGPINTAR. All rights reserved.</p>

                    <div class="flex gap-6">
                        <a href="#privacy" class="footer-legal-link relative px-2 py-1 text-sm opacity-70 hover:opacity-100 transition">Privacy Policy</a>
                        <a href="#terms" class="footer-legal-link relative px-2 py-1 text-sm opacity-70 hover:opacity-100 transition">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>