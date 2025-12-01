<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: <?= $title ?? 'Inventaris'?></title>
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

    <?= $this->renderSection('header') ?>

    <style>
        /* Custom Transition */
        .sidebar-transition {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

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
            background-color: #3b82f6; /* Blue-500 */
        }

        @keyframes toast-progress {
            from { width: 100%; }
            to { width: 0%; }
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
        <script>Swal.fire({icon: 'error', title: 'Error', text: '<?= $flash['error'] ?>'})</script>
    <?php endif; ?>

    <div class="flex h-screen overflow-hidden">
        <aside id="sidebar" class="bg-white text-gray-800 border-r border-gray-200 fixed md:relative z-30 h-full w-0 md:w-20 md:hover:w-64 group sidebar-transition flex flex-col shadow-xl overflow-hidden">
            <div class="h-16 flex items-center justify-between px-4 md:px-0 border-b border-gray-100 min-w-[5rem] relative">
                
                <!-- Logo Container -->
                <div class="flex items-center w-full md:w-auto">
                    <!-- Icon Logo -->
                    <div class="w-10 md:w-20 flex justify-center items-center flex-shrink-0">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <!-- Text Logo -->
                    <div class="opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-300 whitespace-nowrap overflow-hidden">
                        <span class="font-bold text-lg tracking-wider text-gray-800">GUDANG <span class="text-indigo-600">PINTAR</span></span>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 py-6 space-y-1 overflow-y-auto no-scrollbar px-2">
                
                <?php 
                    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                    $segments = explode('/', trim($path, '/'));
                    $activePage = isset($segments[1]) ? $segments[1] : 'dashboard';
                    $isActive = function($keyword) use ($activePage) {
                        return $activePage === $keyword;
                    };
                ?>

                <!-- 1. Dashboard -->
                <a href="/admin/dashboard" class="relative flex items-center h-12 px-3 rounded-lg transition-colors <?= $isActive('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Dashboard
                    </span>
                </a>

                <!-- 2. Barang -->
                <a href="/admin/barang" class="relative flex items-center h-12 px-3 rounded-lg transition-colors <?= $isActive('barang') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Data Barang
                    </span>
                </a>

                <!-- 3. Ruangan -->
                <a href="/admin/ruangan" class="relative flex items-center h-12 px-3 rounded-lg transition-colors <?= $isActive('ruangan') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-door">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 12v.01" />
                            <path d="M3 21h18" />
                            <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />
                        </svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Data Ruangan
                    </span>
                </a>

                <!-- 4. Scan -->
                <a href="/admin/scan" class="relative flex items-center h-12 px-3 rounded-lg transition-colors <?= $isActive('scan') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' ?>">
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
                    <span class="absolute right-2 px-2 py-0.5 rounded text-[10px] bg-indigo-100 text-indigo-700 opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200">
                        Action
                    </span>
                </a>

                <!-- 5. Gudang -->
                <a href="/admin/gudang" class="relative flex items-center h-12 px-3 rounded-lg transition-colors <?= $isActive('gudang') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <!-- <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
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
            <div class="border-t border-gray-100 p-4">
                <a href="/logout" class="flex items-center group/logout hover:bg-red-50 rounded-lg transition-colors p-2 text-gray-600 hover:text-red-600">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </div>
                    <span class="ml-4 text-sm font-medium opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Logout
                    </span>
                </a>
            </div>
        </aside>

        <!-- ==================== MAIN CONTENT AREA ==================== -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- Mobile Header -->
            <header class="md:hidden bg-white border-b border-gray-200 h-16 flex items-center justify-between px-4 z-20">
                <div class="font-bold text-gray-800">GUDANG <span class="text-indigo-600">PINTAR</span></div>
                <button onclick="toggleSidebar()" class="text-gray-500 hover:text-indigo-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-0 relative">
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