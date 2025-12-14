<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin: <?= $title ?? 'Inventaris' ?></title>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <!-- Text Logo -->
                    <div class="opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-300 whitespace-nowrap overflow-hidden">
                        <span class="font-bold text-lg tracking-wider text-theme-light">SUPER <span class="text-theme-secondary">ADMIN</span></span>
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
                <a href="/superadmin/dashboard" class="sidebar-theme-item <?= $isActive('dashboard') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Dashboard
                    </span>
                </a>

                <!-- 2. Manage Gudang -->
                <a href="/superadmin/gudang" class="sidebar-theme-item <?= $isActive('gudang') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 21v-13l9 -4l9 4v13" />
                            <path d="M13 13h4v8h-10v-6h6" />
                            <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Kelola Gudang
                    </span>
                </a>

                <!-- 3. Manage Admin -->
                <a href="/superadmin/admin" class="sidebar-theme-item <?= $isActive('admin') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.85" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Kelola Admin
                    </span>
                </a>

                <!-- 4. Manage Mitra -->
                <a href="/superadmin/mitra" class="sidebar-theme-item <?= $isActive('mitra') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Kelola Mitra
                    </span>
                </a>

                <!-- 5. Laporan -->
                <a href="/superadmin/laporan" class="sidebar-theme-item <?= $isActive('laporan') ? 'active' : '' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M4 20l14 0" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Laporan
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
            <header class="md:hidden bg-theme-primary border-b border-theme-primary-dark h-16 flex items-center justify-between px-4 z-20">
                <div class="font-bold text-theme-light">SUPER <span class="text-theme-secondary">ADMIN</span></div>
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