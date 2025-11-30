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

    <?= $this->renderSection('header') ?>

    <style>
        /* Custom Transition */
        .sidebar-transition {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <!-- Flash Message Logic -->
    <?php if (!empty($flash['success'])): ?>
        <script>Swal.fire({icon: 'success', title: 'Success', text: '<?= $flash['success'] ?>'})</script>
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
                    <!-- 
                        FIX: 
                        - Changed w-12 to md:w-20 (80px) on desktop.
                        - This forces the icon to be centered exactly within the 80px collapsed width.
                    -->
                    <div class="w-10 md:w-20 flex justify-center items-center flex-shrink-0">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <!-- Text Logo -->
                    <!-- Added group-[.mobile-open]:opacity-100 so it shows on mobile open -->
                    <div class="opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-300 whitespace-nowrap overflow-hidden">
                        <span class="font-bold text-lg tracking-wider text-gray-800">GUDANG <span class="text-indigo-600">PINTAR</span></span>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 py-6 space-y-1 overflow-y-auto no-scrollbar px-2">
                
                <?php 
                $current_uri = $_SERVER['REQUEST_URI'];
                $isActive = function($keyword) use ($current_uri) {
                    return strpos($current_uri, $keyword) !== false;
                };
                ?>

                <!-- 1. Dashboard -->
                <a href="/admin/dashboard" class="relative flex items-center h-12 px-3 rounded-lg transition-colors <?= $isActive('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    </div>
                    <!-- Teks Menu: Muncul saat Hover Desktop ATAU saat Mobile Open -->
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

                <!-- 3. Scan -->
                <a href="/admin/scan" class="relative flex items-center h-12 px-3 rounded-lg transition-colors <?= $isActive('scan') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4h2v-4zM6 6h6v6H6V6zm12 0h-6v6h6V6zm-6 12H6v-6h6v6z"></path></svg>
                    </div>
                    <span class="ml-3 text-sm font-medium tracking-wide opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200 whitespace-nowrap">
                        Scan QR
                    </span>
                    <span class="absolute right-2 px-2 py-0.5 rounded text-[10px] bg-indigo-100 text-indigo-700 opacity-0 group-hover:opacity-100 group-[.mobile-open]:opacity-100 transition-opacity duration-200">
                        Action
                    </span>
                </a>

                <!-- 4. Gudang -->
                <a href="/admin/gudang" class="relative flex items-center h-12 px-3 rounded-lg transition-colors <?= $isActive('gudang') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-100 hover:text-indigo-600' ?>">
                    <div class="w-8 flex justify-center items-center flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
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
                
                // Tambahkan class marker 'mobile-open' agar teks muncul
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