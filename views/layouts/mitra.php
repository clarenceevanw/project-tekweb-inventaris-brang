<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra: <?= $title ?? 'Inventaris' ?></title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Admin Theme -->
    <link rel="stylesheet" href="/assets/admin-theme.css">

    <?= $this->renderSection('header') ?>

    <style>
        /* Custom Transition */
        .sidebar-transition {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .toastify {
            padding: 16px 20px;
            color: #1f2937;
            display: inline-block;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            background: white;
            position: fixed;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            max-width: calc(100% - 20px);
            z-index: 2147483647;
            overflow: hidden;
            border: 1px solid #f3f4f6;
        }

        @media (min-width: 640px) {
            .toastify {
                max-width: 400px;
            }
        }

        .toastify::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            width: 100%;
            animation: toast-progress 4000ms linear forwards;
        }

        /* Warna Progress Bar: Success (Biru) */
        .toast-success::after {
            background-color: #3b82f6;
            /* Blue-500 */
        }

        @keyframes toast-progress {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .toastify:hover::after {
            animation-play-state: paused;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <!-- Flash Message Logic -->
    <?php if (!empty($flash['success'])): ?>
        <script>
            Toastify({
                text: "<?= $flash['success'] ?>",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                className: "toast-success",
                style: {
                    background: "#ffffff",
                }
            }).showToast();
        </script>
    <?php endif; ?>
    <?php if (!empty($flash['error'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= $flash['error'] ?>'
            })
        </script>
    <?php endif; ?>

    <div class="flex h-screen overflow-hidden">
        <aside id="sidebar" class="sidebar-theme fixed md:relative z-30 h-full w-0 md:w-20 md:hover:w-64 group sidebar-transition flex flex-col overflow-hidden">
            <div class="h-16 flex items-center justify-between px-4 md:px-0 min-w-[5rem] relative">

                <!-- Logo Container -->
                <div class="flex items-center w-full md:w-auto">
                    <!-- Icon Logo -->
                    <div class="w-10 md:w-20 flex justify-center items-center flex-shrink-0">
                        <svg class="w-8 h-8 text-theme-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <!-- Text Logo -->
                    <div class="opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-300 whitespace-nowrap overflow-hidden">
                        <span class="font-bold text-lg tracking-wider text-theme-light">GUDANG <span class="text-theme-secondary">PINTAR</span></span>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 py-6 overflow-y-auto no-scrollbar px-2">

                <?php
                $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                $segments = explode('/', trim($path, '/'));
                $activePage = isset($segments[1]) ? $segments[1] : 'dashboard';
                $isActive = function ($keyword) use ($activePage) {
                    return $activePage === $keyword;
                };
                ?>

                <!-- 1. Dashboard -->
                <a href="/mitra/dashboard" class="sidebar-theme-item <?= $isActive('dashboard') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Dashboard
                    </span>
                </a>

                <!-- 2. Transaksi -->
                <a href="/mitra/transaksi" class="sidebar-theme-item <?= $isActive('transaksi') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M21 15h-2.5c-.398 0 -.779 .158 -1.061 .439c-.281 .281 -.439 .663 -.439 1.061c0 .398 .158 .779 .439 1.061c.281 .281 .663 .439 1.061 .439h1c.398 0 .779 .158 1.061 .439c.281 .281 .439 .663 .439 1.061c0 .398 -.158 .779 -.439 1.061c-.281 .281 -.663 .439 -1.061 .439h-2.5" />
                            <path d="M19 21v1m0 -8v1" />
                            <path d="M13 21h-7c-.53 0 -1.039 -.211 -1.414 -.586c-.375 -.375 -.586 -.884 -.586 -1.414v-10c0 -.53 .211 -1.039 .586 -1.414c.375 -.375 .884 -.586 1.414 -.586h2m12 3.12v-1.12c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2" />
                            <path d="M16 10v-6c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-4c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414v6m8 0h-8m8 0h1m-9 0h-1" />
                            <path d="M8 14v.01" />
                            <path d="M8 17v.01" />
                            <path d="M12 13.99v.01" />
                            <path d="M12 17v.01" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        History Transaksi
                    </span>
                </a>
            </nav>

            <!-- Bottom: Logout -->
            <div class="border-t border-theme-primary-dark px-2 py-2">
                <a href="/#hero" class="sidebar-theme-item">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" stroke-width="0.3" stroke="currentColor" fill="currentColor" class="bi w-6 h-6 bi-house-door" viewBox="0 0 16 16">
                            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Home
                    </span>
                </a>
            </div>
            <div class="px-2 pb-2">
                <a href="/logout" class="sidebar-theme-item">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg class="w-6 h-6 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Logout
                    </span>
                </a>
            </div>
        </aside>

        <!-- ==================== MAIN CONTENT AREA ==================== -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">

            <!-- Mobile Header -->
            <header class="md:hidden bg-theme-primary border-b border-theme-primary-light h-16 flex items-center justify-between px-4 z-20">
                <div class="font-bold text-theme-light">GUDANG <span class="text-theme-secondary">PINTAR</span></div>
                <button onclick="toggleSidebar()" class="text-theme-light hover:text-theme-secondary focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-0 relative">
                <!-- Overlay Mobile -->
                <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-20 hidden md:hidden backdrop-blur-sm transition-opacity"></div>

                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <!-- Script Toggle Sidebar -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar.classList.contains('w-0')) {
                // Buka Sidebar
                sidebar.classList.remove('w-0');
                sidebar.classList.add('w-64');

                sidebar.classList.add('mobile-open');

                overlay.classList.remove('hidden');
            } else {
                // Tutup Sidebar
                sidebar.classList.add('w-0');
                sidebar.classList.remove('w-64');

                // Hapus marker
                sidebar.classList.remove('mobile-open');

                overlay.classList.add('hidden');
            }
        }
    </script>

    <?= $this->renderSection('script') ?>
</body>

</html>