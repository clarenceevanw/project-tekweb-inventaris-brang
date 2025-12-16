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
        background: linear-gradient(90deg, transparent, #FBEFDF, transparent);
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
        background: linear-gradient(90deg, #FBEFDF, #f5e5d0);
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
        color: #FBEFDF;
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
        background-color: #FBEFDF;
        color: #25343B !important;
        border-color: #FBEFDF;
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.25), 0 0 20px rgba(251, 239, 223, 0.5);
    }

    .btn-signup:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.35), 0 0 30px rgba(255, 255, 255, 0.4);
    }

    .footer-legal-link {
        color: rgba(251, 239, 223, 0.75);
    }

    .footer-legal-link:hover {
        opacity: 1;
        transform: translateY(-2px);
    }

    .footer-legal-link::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(251, 239, 223, 0.15);
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
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes slideDown {
        from {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        to {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
    }

    .modal-fade-in {
        animation: fadeIn 0.3s ease-out;
    }

    .modal-fade-out {
        animation: fadeOut 0.3s ease-out;
    }

    .modal-slide-up {
        animation: slideUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .modal-slide-down {
        animation: slideDown 0.3s ease-out;
    }
</style>

<footer id="footer" class="relative z-2 overflow-hidden mt-auto" style="background-color:#25343B; color:#FBEFDF;">
    <div class="mx-auto px-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 mb-12 space-y-10">

            <!-- Pages -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 w-fit opacity-90 border-b pb-2">Pages</h3>
                <a href="/#hero" class="footer-link relative inline-flex items-center gap-1 w-fit text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" stroke-width="0.3" stroke="currentColor" fill="currentColor" class="bi w-5 h-5 bi-house-door" viewBox="0 0 16 16">
                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                    </svg>Home</a>
                <!-- <a href="/#demo" class="footer-link relative inline-flex items-center gap-1 w-fit text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" stroke-width="0.3" stroke="currentColor" fill="currentColor" class="bi w-5 h-5 bi-play-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M6.271 5.055a.5.5 0 0 1 .52.038l3.5 2.5a.5.5 0 0 1 0 .814l-3.5 2.5A.5.5 0 0 1 6 10.5v-5a.5.5 0 0 1 .271-.445" />
                    </svg>Demo</a> -->
                <a href="/#features" class="footer-link relative inline-flex items-center gap-1 w-fit text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" stroke-width="0.3" stroke="currentColor" fill="currentColor" class="bi w-5 h-5 bi-journal-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                    </svg>Fitur</a>
                <a href="/#subscription" class="footer-link relative inline-flex items-center gap-1 w-fit text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi w-5 h-5 bi-coin" viewBox="0 0 16 16">
                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z" />
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                    </svg>Langganan</a>
                <a href="/#faq" class="footer-link relative inline-flex items-center gap-1 w-fit text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi w-5 h-5 nav-icon" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94" />
                    </svg>FAQ</a>
                <a href="/#contact" class="footer-link relative inline-flex items-center gap-1 w-fit text-base font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" stroke-width="0.3" stroke="currentColor" fill="currentColor" class="bi w-5 h-5 bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                    </svg>Kontak</a>
            </div>

            <!-- Organizer Features -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90 w-fit border-b pb-2">Organizer's Features</h3>
                <button onclick="openModal('dashboard-organizer')" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>Dashboard</button>
                <button onclick="openModal('manage-admin')" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.85" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    Kelola Admin</button>
                <button onclick="openModal('manage-category')" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 icon icon-tabler icons-tabler-outline icon-tabler-tag">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" />
                    </svg>Kelola Kategori</button>
                <button onclick="openModal('manage-product')" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium"> <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>Kelola Barang</button>
                <button onclick="openModal('manage-room')" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-door">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 12v.01" />
                        <path d="M3 21h18" />
                        <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />
                    </svg>Kelola Ruangan</button>
                <button onclick="openModal('manage-transaction')" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 icon icon-tabler icons-tabler-outline icon-tabler-cash-register">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M21 15h-2.5c-.398 0 -.779 .158 -1.061 .439c-.281 .281 -.439 .663 -.439 1.061c0 .398 .158 .779 .439 1.061c.281 .281 .663 .439 1.061 .439h1c.398 0 .779 .158 1.061 .439c.281 .281 .439 .663 .439 1.061c0 .398 -.158 .779 -.439 1.061c-.281 .281 -.663 .439 -1.061 .439h-2.5" />
                        <path d="M19 21v1m0 -8v1" />
                        <path d="M13 21h-7c-.53 0 -1.039 -.211 -1.414 -.586c-.375 -.375 -.586 -.884 -.586 -1.414v-10c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h2m12 3.12v-1.12c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2" />
                        <path d="M16 10v-6c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-4c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414v6m8 0h-8m8 0h1m-9 0h-1" />
                        <path d="M8 14v.01" />
                        <path d="M8 17v.01" />
                        <path d="M12 13.99v.01" />
                        <path d="M12 17v.01" />
                    </svg>Kelola Transaksi
                </button>
                <button onclick="openModal('manage-warehouse')" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 21v-13l9 -4l9 4v13" />
                        <path d="M13 13h4v8h-10v-6h6" />
                        <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                    </svg>Kelola Gudang</button>
            </div>

            <!-- Partner Features -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90 w-fit border-b pb-2">Partner's Features</h3>
                <button onclick="openModal('dashboard-partner')" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>Dashboard</button>
                <button onclick="openModal('transaction-history')" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 icon icon-tabler icons-tabler-outline icon-tabler-cash-register">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M21 15h-2.5c-.398 0 -.779 .158 -1.061 .439c-.281 .281 -.439 .663 -.439 1.061c0 .398 .158 .779 .439 1.061c.281 .281 .663 .439 1.061 .439h1c.398 0 .779 .158 1.061 .439c.281 .281 .439 .663 .439 1.061c0 .398 -.158 .779 -.439 1.061c-.281 .281 -.663 .439 -1.061 .439h-2.5" />
                        <path d="M19 21v1m0 -8v1" />
                        <path d="M13 21h-7c-.53 0 -1.039 -.211 -1.414 -.586c-.375 -.375 -.586 -.884 -.586 -1.414v-10c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h2m12 3.12v-1.12c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2" />
                        <path d="M16 10v-6c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-4c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414v6m8 0h-8m8 0h1m-9 0h-1" />
                        <path d="M8 14v.01" />
                        <path d="M8 17v.01" />
                        <path d="M12 13.99v.01" />
                        <path d="M12 17v.01" />
                    </svg>Riwayat Transaksi</button>
            </div>

            <!-- Subscription -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90 w-fit border-b pb-2">Subscription</h3>
                <a href="/#subscription" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi w-5 h-5 bi-coin" viewBox="0 0 16 16">
                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z" />
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                    </svg>7 Days Trial</a>
                <a href="/#subscription" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi w-5 h-5 bi-coin" viewBox="0 0 16 16">
                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z" />
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                    </svg>Bulanan (Basic)</a>
                <a href="/#subscription" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi w-5 h-5 bi-coin" viewBox="0 0 16 16">
                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z" />
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                    </svg>Tahunan (Pro)</a>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 mb-12 space-y-10">

            <!-- Contact -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90 w-fit border-b pb-2">Contact</h3>
                <a href="mailto:gudangpintar@gmail.com" target="_blank" rel="noopener noreferrer" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" stroke-width="0.3" stroke="currentColor" fill="currentColor" class="bi w-5 h-5 bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                    </svg>info@gudangpintar.com</a>
                <a href="tel:+628123456789" target="_blank" rel="noopener noreferrer" class="footer-link relative inline-flex items-center gap-1 w-fit font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" stroke-width="0.3" stroke="currentColor" fill="currentColor" class="bi w-5 h-5 bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                    </svg>+62 812 3456 7890</a>
                <a href="https://maps.app.goo.gl/PnwRgmck3LPSRgjp8" target="_blank" rel="noopener noreferrer" class="footer-link relative inline-flex items-start gap-1 w-fit font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" stroke-width="0.3" stroke="currentColor" fill="currentColor" class="bi w-5 h-5 bi-geo-alt" viewBox="0 0 16 16">
                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                    </svg>Jl. Siwalankerto No.121-131, Surabaya, Jawa Timur</a>
            </div>

            <!-- Auth -->
            <div class="flex flex-col gap-4 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider mb-2 opacity-90 w-fit border-b pb-2">Get Started</h3>
                <a href="/auth/select/login"
                    class="btn btn-login relative inline-block px-7 py-3 rounded-lg font-semibold border-2" style="border-color: #FBEFDF; color: #FBEFDF;">
                    Login
                </a>
                <a href="/auth/select/signup"
                    class="btn btn-signup relative inline-block px-7 py-3 rounded-lg font-semibold shadow-md" style="color: #25343B; background: #FBEFDF;">
                    Sign Up
                </a>
            </div>
        </div>

        <div class="pt-8 mt-8" style="border-top: 1px solid rgba(251, 239, 223, 0.4);">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                <p class="text-sm opacity-90">© 2025 GUDANGPINTAR. All rights reserved.</p>
                <div class="flex gap-6">
                    <button onclick="openLegalModal('privacy')" class="footer-legal-link relative px-2 py-1 text-sm">Privacy Policy</button>
                    <button onclick="openLegalModal('terms')" class="footer-legal-link relative px-2 py-1 text-sm">Terms of Service</button>
                </div>
            </div>
        </div>

    </div>
</footer>

<!-- Legal Modals -->
<div id="legalModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4" onclick="closeLegalModal(event)">
    <div id="legalModalContent" class="bg-[#25343B] rounded-xl max-w-3xl w-full max-h-[85vh] overflow-hidden shadow-2xl" onclick="event.stopPropagation()">
        <div class="sticky top-0 bg-[#1F2B31] px-6 py-4 flex justify-between items-center border-b border-[#FBEFDF]/20">
            <h2 id="modalTitle" class="text-2xl font-bold text-[#FBEFDF]"></h2>
            <button onclick="closeLegalModal()" class="text-[#FBEFDF] hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div id="modalContent" class="px-6 py-6 overflow-y-auto max-h-[calc(85vh-80px)] text-[#FBEFDF]/90 leading-relaxed">
        </div>
    </div>
</div>

<script>
const legalContent = {
    privacy: {
        title: 'Privacy Policy',
        content: `
            <div class="space-y-6">
                <p class="text-sm opacity-75">Terakhir diperbarui: Januari 2025</p>
                
                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">1. Informasi yang Kami Kumpulkan</h3>
                    <p class="mb-2">Kami mengumpulkan informasi berikut untuk menyediakan layanan GUDANGPINTAR:</p>
                    <ul class="list-disc pl-6 space-y-1">
                        <li>Informasi akun (nama, email, nomor telepon)</li>
                        <li>Data inventaris dan transaksi gudang</li>
                        <li>Informasi penggunaan aplikasi dan log aktivitas</li>
                        <li>Data lokasi gudang dan ruangan</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">2. Penggunaan Informasi</h3>
                    <p class="mb-2">Informasi yang dikumpulkan digunakan untuk:</p>
                    <ul class="list-disc pl-6 space-y-1">
                        <li>Menyediakan dan meningkatkan layanan manajemen inventaris</li>
                        <li>Memproses transaksi dan mengelola data gudang</li>
                        <li>Mengirim notifikasi terkait aktivitas inventaris</li>
                        <li>Analisis penggunaan untuk peningkatan fitur</li>
                        <li>Keamanan dan pencegahan fraud</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">3. Keamanan Data</h3>
                    <p>Kami menerapkan langkah-langkah keamanan teknis dan organisasi untuk melindungi data Anda, termasuk enkripsi, kontrol akses, dan monitoring sistem secara berkala.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">4. Berbagi Informasi</h3>
                    <p>Kami tidak menjual data pribadi Anda. Informasi hanya dibagikan dengan:</p>
                    <ul class="list-disc pl-6 space-y-1">
                        <li>Partner yang Anda izinkan dalam sistem</li>
                        <li>Penyedia layanan pihak ketiga yang mendukung operasional</li>
                        <li>Otoritas hukum jika diwajibkan oleh peraturan</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">5. Hak Anda</h3>
                    <p class="mb-2">Anda memiliki hak untuk:</p>
                    <ul class="list-disc pl-6 space-y-1">
                        <li>Mengakses dan mengunduh data pribadi Anda</li>
                        <li>Memperbarui atau mengoreksi informasi</li>
                        <li>Menghapus akun dan data terkait</li>
                        <li>Menarik persetujuan penggunaan data</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">6. Cookies dan Teknologi Pelacakan</h3>
                    <p>Kami menggunakan cookies untuk meningkatkan pengalaman pengguna, mengingat preferensi, dan menganalisis penggunaan aplikasi.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">7. Kontak</h3>
                    <p>Untuk pertanyaan terkait privasi, hubungi kami di:</p>
                    <p class="mt-2">Email: <a href="mailto:privacy@gudangpintar.com" class="text-[#5FA59C] hover:underline">privacy@gudangpintar.com</a></p>
                </section>
            </div>
        `
    },
    terms: {
        title: 'Terms of Service',
        content: `
            <div class="space-y-6">
                <p class="text-sm opacity-75">Terakhir diperbarui: Januari 2025</p>
                
                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">1. Penerimaan Ketentuan</h3>
                    <p>Dengan mengakses dan menggunakan GUDANGPINTAR, Anda menyetujui untuk terikat dengan ketentuan layanan ini. Jika Anda tidak setuju, harap tidak menggunakan layanan kami.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">2. Deskripsi Layanan</h3>
                    <p>GUDANGPINTAR menyediakan platform manajemen inventaris berbasis cloud yang memungkinkan pengguna untuk:</p>
                    <ul class="list-disc pl-6 space-y-1">
                        <li>Mengelola data barang dan kategori</li>
                        <li>Melacak transaksi masuk dan keluar</li>
                        <li>Mengatur gudang dan ruangan penyimpanan</li>
                        <li>Berkolaborasi dengan partner bisnis</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">3. Akun Pengguna</h3>
                    <p class="mb-2">Anda bertanggung jawab untuk:</p>
                    <ul class="list-disc pl-6 space-y-1">
                        <li>Menjaga kerahasiaan kredensial akun</li>
                        <li>Semua aktivitas yang terjadi di akun Anda</li>
                        <li>Memberikan informasi yang akurat dan terkini</li>
                        <li>Melaporkan penggunaan tidak sah segera</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">4. Langganan dan Pembayaran</h3>
                    <p class="mb-2">Ketentuan langganan:</p>
                    <ul class="list-disc pl-6 space-y-1">
                        <li>Trial 7 hari gratis untuk pengguna baru</li>
                        <li>Pembayaran bulanan atau tahunan sesuai paket yang dipilih</li>
                        <li>Perpanjangan otomatis kecuali dibatalkan</li>
                        <li>Tidak ada pengembalian dana untuk periode yang sudah dibayar</li>
                        <li>Harga dapat berubah dengan pemberitahuan 30 hari</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">5. Penggunaan yang Dilarang</h3>
                    <p class="mb-2">Anda tidak diperbolehkan:</p>
                    <ul class="list-disc pl-6 space-y-1">
                        <li>Menggunakan layanan untuk tujuan ilegal</li>
                        <li>Mengganggu atau merusak sistem</li>
                        <li>Mengakses akun pengguna lain tanpa izin</li>
                        <li>Menyebarkan malware atau konten berbahaya</li>
                        <li>Melakukan reverse engineering pada platform</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">6. Kepemilikan Data</h3>
                    <p>Anda mempertahankan kepemilikan penuh atas data inventaris yang Anda masukkan. Kami hanya menyimpan dan memproses data untuk menyediakan layanan.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">7. Ketersediaan Layanan</h3>
                    <p>Kami berusaha menjaga layanan tersedia 99.9% uptime, namun tidak menjamin layanan bebas dari gangguan. Pemeliharaan terjadwal akan diinformasikan sebelumnya.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">8. Batasan Tanggung Jawab</h3>
                    <p>GUDANGPINTAR tidak bertanggung jawab atas kerugian tidak langsung, kehilangan data akibat force majeure, atau kesalahan pengguna dalam mengelola inventaris.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">9. Penghentian Layanan</h3>
                    <p>Kami berhak menangguhkan atau menghentikan akun yang melanggar ketentuan layanan tanpa pemberitahuan sebelumnya.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">10. Perubahan Ketentuan</h3>
                    <p>Kami dapat memperbarui ketentuan ini sewaktu-waktu. Perubahan signifikan akan diberitahukan melalui email atau notifikasi dalam aplikasi.</p>
                </section>

                <section>
                    <h3 class="text-xl font-semibold text-[#FBEFDF] mb-3">11. Kontak</h3>
                    <p>Untuk pertanyaan terkait ketentuan layanan, hubungi:</p>
                    <p class="mt-2">Email: <a href="mailto:support@gudangpintar.com" class="text-[#5FA59C] hover:underline">support@gudangpintar.com</a></p>
                </section>
            </div>
        `
    }
};

function openLegalModal(type) {
    const modal = document.getElementById('legalModal');
    const modalContent = document.getElementById('legalModalContent');
    const title = document.getElementById('modalTitle');
    const content = document.getElementById('modalContent');
    
    title.textContent = legalContent[type].title;
    content.innerHTML = legalContent[type].content;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex', 'modal-fade-in');
    modalContent.classList.add('modal-slide-up');
    document.body.style.overflow = 'hidden';
}

function closeLegalModal(event) {
    if (!event || event.target.id === 'legalModal') {
        const modal = document.getElementById('legalModal');
        const modalContent = document.getElementById('legalModalContent');
        
        modal.classList.remove('modal-fade-in');
        modal.classList.add('modal-fade-out');
        modalContent.classList.remove('modal-slide-up');
        modalContent.classList.add('modal-slide-down');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex', 'modal-fade-out');
            modalContent.classList.remove('modal-slide-down');
            document.body.style.overflow = 'auto';
        }, 300);
    }
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLegalModal();
    }
});
</script>