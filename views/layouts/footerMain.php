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
        background: linear-gradient(90deg, transparent, #ffffff, transparent);
        /* disesuaikan agar kontras */
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
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 mb-12 space-y-10">

            <!-- Pages -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 w-fit opacity-90 border-b pb-2">Pages</h3>
                <a href="/" class="footer-link relative inline-flex items-center gap-1 w-fit text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                    </svg>Home</a>
                <a href="/#demo" class="footer-link relative inline-flex items-center gap-1 w-fit text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z" />
                    </svg>Demo</a>
                <a href="/#feature" class="footer-link relative inline-flex items-center gap-1 w-fit text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                        <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                    </svg>Features</a>
                <a href="/#subscription" class="footer-link relative inline-flex items-center gap-1 w-fit text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                        <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                    </svg>Subscription</a>

            </div>

            <!-- Organizer Features -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90 w-fit border-b pb-2">Organizer's Features</h3>
                <a href="#feature-dashboard" class="footer-link relative inline-block w-fit font-medium">Dashboard</a>
                <a href="#feature-manage-admin" class="footer-link relative inline-block w-fit font-medium">Manage Admin</a>
                <a href="#feature-manage-category" class="footer-link relative inline-block w-fit font-medium">Manage Product's Category</a>
                <a href="#feature-manage-product" class="footer-link relative inline-block w-fit font-medium">Manage Product</a>
                <a href="#feature-manage-room" class="footer-link relative inline-block w-fit font-medium">Manage Room</a>
                <a href="#feature-manage-transaction" class="footer-link relative inline-block w-fit font-medium">Manage Transaction</a>
                <a href="#feature-manage-warehouse" class="footer-link relative inline-block w-fit font-medium">Manage Warehouse</a>
            </div>

            <!-- Partner Features -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90 w-fit border-b pb-2">Partner's Features</h3>
                <a href="#feature-dashboard" class="footer-link relative inline-block w-fit font-medium">Dashboard</a>
                <a href="#feature-manage-transaction" class="footer-link relative inline-block w-fit font-medium">Transaction's History</a>
            </div>

            <!-- Subscription -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90 w-fit border-b pb-2">Subscription</h3>
                <a href="#trial" class="footer-link relative inline-block w-fit font-medium">7 Days Trial</a>
                <a href="#monthly" class="footer-link relative inline-block w-fit font-medium">Monthly (Basic)</a>
                <a href="#yearly" class="footer-link relative inline-block w-fit font-medium">Anually (Pro)</a>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 mb-12 space-y-10">

            <!-- Contact -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90 w-fit border-b pb-2">Contact</h3>
                <a href="mailto:gudangpintar@gmail.com" target="_blank" rel="noopener noreferrer" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                    </svg>gudangpintar@gmail.com</a>
                <a href="tel:+628123456789" target="_blank" rel="noopener noreferrer" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                    </svg>+62 812 3456 7890</a>
                <a href="https://maps.app.goo.gl/PnwRgmck3LPSRgjp8" target="_blank" rel="noopener noreferrer" class="footer-link relative inline-flex items-start gap-1 w-fit font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                    </svg>Jl. Siwalankerto No.121-131, Surabaya, Jawa Timur</a>
            </div>

            <!-- Auth -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90 w-fit border-b pb-2">Get Started</h3>
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