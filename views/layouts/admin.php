<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: <?= $title ?? 'Inventaris' ?></title>
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

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

        .toast-success::after {
            background-color: var(--theme-secondary);
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

<body class="font-sans antialiased text-theme-primary">

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
        <aside id="sidebar" class="sidebar-theme border-r border-theme-primary-dark fixed md:relative z-30 h-full w-0 md:w-20 md:hover:w-64 group sidebar-transition flex flex-col shadow-xl overflow-hidden">
            <div class="h-16 flex items-center justify-between px-4 md:px-0 border-b border-theme-primary-dark min-w-[5rem] relative">

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
            <nav class="flex-1 py-6 space-y-1 overflow-y-auto no-scrollbar px-2">

                <?php
                $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                $segments = explode('/', trim($path, '/'));
                $activePage = isset($segments[1]) ? $segments[1] : 'dashboard';
                $isActive = function ($keyword) use ($activePage) {
                    return $activePage === $keyword;
                };
                ?>

                <!-- 1. Dashboard -->
                <a href="/admin/dashboard" class="sidebar-theme-item <?= $isActive('dashboard') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Dashboard
                    </span>
                </a>

                <!-- 2. Admin -->
                <a href="/admin/manage-admin" class="sidebar-theme-item <?= $isActive('manage-admin') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.85" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Data Admin
                    </span>
                </a>

                <!-- 3. Kategori -->
                <a href="/admin/kategori" class="sidebar-theme-item <?= $isActive('kategori') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 icon icon-tabler icons-tabler-outline icon-tabler-tag">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Data Kategori
                    </span>
                </a>

                <!-- 4. Barang -->
                <a href="/admin/barang" class="sidebar-theme-item <?= $isActive('barang') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 bi bi-box-seam" viewBox="0 0 16 16" stroke="currentColor" stroke-width="0.3">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Data Barang
                    </span>
                </a>

                <!-- 5. Ruangan -->
                <a href="/admin/ruangan" class="sidebar-theme-item <?= $isActive('ruangan') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-door">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 12v.01" />
                            <path d="M3 21h18" />
                            <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Data Ruangan
                    </span>
                </a>

                <!-- 6. Transaksi -->
                <a href="/admin/transaksi" class="sidebar-theme-item <?= $isActive('transaksi') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 icon icon-tabler icons-tabler-outline icon-tabler-cash-register">
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
                        Data Transaksi
                    </span>
                </a>

                <!-- 7. Scan -->
                <a href="/admin/scan" class="sidebar-theme-item <?= $isActive('scan') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <!-- <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 6h6v6H6V6zm12 0h-6v6h6V6zm-6 12H6v-6h6v6z"></path></svg> -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Scan QR
                    </span>
                    <span class="absolute right-2 badge-theme-info opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200">
                        Action
                    </span>
                </a>

                <!-- 8. Gudang -->
                <a href="/admin/gudang" class="sidebar-theme-item <?= $isActive('gudang') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <!-- <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 21v-13l9 -4l9 4v13" />
                            <path d="M13 13h4v8h-10v-6h6" />
                            <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Manajemen Gudang
                    </span>
                </a>

            </nav>

            <!-- Bottom: Logout -->
            <div class="border-t border-theme-primary-dark px-2 py-2">
                <a href="/#hero" class="sidebar-theme-item">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" stroke-width="0.3" stroke="currentColor" fill="currentColor" class="bi w-5 h-5 bi-house-door" viewBox="0 0 16 16">
                            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Home
                    </span>
                </a>
            </div>
            <div class="px-2 py-2">
                <a href="/logout" class="sidebar-theme-item">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <header class="md:hidden bg-theme-primary border-b border-theme-primary-dark h-16 flex items-center justify-between px-4 z-20">
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