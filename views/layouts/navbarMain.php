<?php
if (!isset($isLoggedIn)) {
    $isLoggedIn = isset($_SESSION['user_id']);
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
}
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';
$dashboardUrl = ($userRole === 'mitra') ? '/mitra/dashboard' : (($userRole === 'admin') ? '/admin/dashboard' : '/superadmin/dashboard');
$userData = isset($_SESSION['user']) ? $_SESSION['user'] : [];
$gudangData = isset($_SESSION['gudang']) ? $_SESSION['gudang'] : [];
?>
<style>
    .nav-hidden {
        transform: translateY(-100%);
    }

    .navbar-left {
        background: rgba(37, 52, 59, 0.7);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        box-shadow: 0 8px 24px rgba(37, 52, 59, 0.35), inset 0 1px 0 rgba(251, 239, 223, 0.1);
        border: 1px solid rgba(251, 239, 223, 0.2);
        transition: background 0.5s ease;
    }

    .navbar-left:hover {
        background: rgba(251, 239, 223, 0.8);
    }

    .logo-wrapper {
        position: relative;
        display: inline-block;
    }


    .logo-wrapper img {
        height: 2.5rem;
        width: auto;
        display: block;
        transition: opacity 0.5s ease;
    }

    .logo-light {
        opacity: 1;
    }

    .logo-dark {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .navbar-left:hover .logo-light {
        opacity: 0;
    }

    .navbar-left:hover .logo-dark {
        opacity: 1;
    }
    
    .navbar-trapezoid {
        background: rgba(37, 52, 59, 0.7);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        position: relative;
        z-index: 1;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        box-shadow: 0 8px 24px rgba(37, 52, 59, 0.35), inset 0 1px 0 rgba(251, 239, 223, 0.1);
        border: 1px solid rgba(251, 239, 223, 0.2);
    }

    .navbar-right {
        background: rgba(37, 52, 59, 0.7);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        box-shadow: 0 8px 24px rgba(37, 52, 59, 0.35), inset 0 1px 0 rgba(251, 239, 223, 0.1);
        border: 1px solid rgba(251, 239, 223, 0.2);
    }

    .nav-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
    }

    .nav-link::before,
    .auth-button::before {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 0%;
        background: #FBEFDF;
        transition: height 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: -1;
    }

    .nav-link:hover::before,
    .auth-button:hover::before {
        height: 100%;
    }

    .nav-link:hover,
    .auth-button:hover {
        color: #25343B !important;
    }

    .nav-link:hover svg,
    .auth-button:hover svg {
        color: #25343B !important;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);;
    }

    .nav-icon {
        flex-shrink: 0;
    }

    .nav-text {
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        transition: max-width 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
        white-space: nowrap;
        color: #252525;
    }

    .nav-link:hover .nav-text {
        max-width: 150px;
        opacity: 1;
    }

    .signup-button {
        position: relative;
        overflow: hidden;
    }

    .signup-button:hover {
        color: #EC4E3D !important;
        background: #FBEFDF !important;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Dynamic Island Mobile Menu */
    .mobile-menu-container {
        position: fixed;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 1001;
    }

    .dynamic-island {
        position: relative;
        width: 3.5rem;
        height: 3.5rem;
        background: rgba(37, 52, 59, 0.9);
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 32px rgba(37, 52, 59, 0.4);
        overflow: hidden;
    }

    .dynamic-island.expanded {
        width: max(40vw, 20rem);
        max-width: 380px;
        height: 28rem;
        border-radius: 2rem;
        background: rgba(37, 52, 59, 0.95);
        backdrop-filter: blur(20px);
        box-shadow: 0 20px 60px rgba(37, 52, 59, 0.5);
    }

    .hamburger-icon {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hamburger-icon span {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dynamic-island.expanded .hamburger-icon {
        opacity: 0;
        transform: scale(0.8) rotate(90deg);
    }

    .menu-content {
        transform: scale(0.85);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dynamic-island.expanded .menu-content {
        opacity: 1;
        transform: scale(1);
        pointer-events: auto;
        transition-delay: 0.25s;
    }

    .menu-logo {
        width: 3.5rem;
        height: 3.5rem;
        margin-bottom: 1rem;
        opacity: 0;
        transform: translateY(-20px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dynamic-island.expanded .menu-logo {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.3s;
    }

    .menu-link {
        color: #FBEFDF;
        font-size: 1.35rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        text-decoration: none;
        opacity: 0;
        transform: translateX(-30px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0.5rem 1.5rem;
        border-radius: 0.75rem;
        position: relative;
        overflow: hidden;
    }

    .menu-link::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(251, 239, 223, 0.1);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
        border-radius: 0.75rem;
    }

    .menu-link:hover::before {
        transform: scaleX(1);
    }

    .dynamic-island.expanded .menu-link {
        opacity: 1;
        transform: translateX(0);
    }

    .dynamic-island.expanded .menu-link:nth-child(2) {
        transition-delay: 0.35s;
    }

    .dynamic-island.expanded .menu-link:nth-child(3) {
        transition-delay: 0.4s;
    }

    .dynamic-island.expanded .menu-link:nth-child(4) {
        transition-delay: 0.45s;
    }

    .dynamic-island.expanded .menu-link:nth-child(5) {
        transition-delay: 0.5s;
    }

    .dynamic-island.expanded .menu-link:nth-child(6) {
        transition-delay: 0.55s;
    }

    .menu-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(8px);
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.4s ease;
        z-index: 1000;
    }

    .menu-overlay.active {
        opacity: 1;
        pointer-events: auto;
    }

    body.menu-open {
        overflow: hidden;
    }

    .profile-popup {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 0.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(122, 107, 184, 0.3);
        padding: 1.5rem;
        min-width: 280px;
        opacity: 0;
        transform: translateY(-10px);
        pointer-events: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1001;
    }

    .profile-popup.active {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .profile-icon {
        cursor: pointer;
        transition: transform 0.2s;
    }

    .profile-icon:hover {
        transform: scale(1.1);
    }
</style>
</head>

<body class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">

    <div class="fixed top-0 left-0 right-0 w-screen z-[1000] translate-y-0 transition-transform duration-300 bg-transparent" id="navbar">

        <!-- Desktop Navbar -->
        <nav class="hidden lg:flex items-center justify-center w-full gap-16">
            <a href="/" class="navbar-left absolute left-0 px-6 py-4 flex items-center flex items-center transition-colors duration-400">
                <div class="logo-wrapper">
                    <img src="/assets/home/logoteksgudangtransparentv2.png" alt="Gudang Pintar" class="logo-light">
                    <img src="/assets/home/logoteksgudangtransparentv2_dark.png" alt="Gudang Pintar" class="logo-dark">
                </div>
            </a>

            <div class="navbar-trapezoid flex items-center gap-8 px-4 py-4">
                <a href="/#hero" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 font-medium" style="color: #FBEFDF;">
                    <svg class="nav-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="nav-text">Home</span>
                </a>
                <a href="/#demo" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 font-medium" style="color: #FBEFDF;">
                    <svg class="nav-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="nav-text">Demo</span>
                </a>
                <a href="/#features" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 font-medium" style="color: #FBEFDF;">
                    <svg xmlns="http://www.w3.org/2000/svg" stroke-width="0.3" stroke="currentColor" fill="currentColor" class="bi w-5 h-5 bi-journal-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                    </svg>
                    <span class="nav-text">Fitur</span>
                </a>
                <a href="/#subscription" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 font-medium" style="color: #FBEFDF;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi w-6 h-6 nav-icon bi-coin" viewBox="0 0 16 16">
                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518z" />
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11m0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12" />
                    </svg>
                    <span class="nav-text">Langganan</span>
                </a>
                <a href="/#contact" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 font-medium" style="color: #FBEFDF;">
                    <svg xmlns="http://www.w3.org/2000/svg" stroke-width="0.3" stroke="currentColor" fill="currentColor" class="bi nav-icon w-5 h-5 bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                    </svg>
                    <span class="nav-text">Kontak</span>
                </a>
                <?php if ($isLoggedIn): ?>
                    <a href="<?php echo $dashboardUrl; ?>" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 font-medium" style="color: #FBEFDF;">
                        <svg class="nav-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <span class="nav-text">Dashboard</span>
                    </a>
                <?php endif; ?>
            </div>

            <div class="navbar-right absolute right-0 gap-4 px-6 py-4 flex items-center">
                <?php if ($isLoggedIn): ?>
                    <a href="/profile" class="hover:opacity-80 transition-opacity">
                        <svg class="w-10 h-10" style="color: #FBEFDF;" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                        </svg>
                    </a>
                    <a href="/logout" class="auth-button relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block font-medium" style="color: #FBEFDF;">Log Out</a>
                <?php else: ?>
                    <a href="/auth/select/login" class="auth-button relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block font-medium" style="color: #FBEFDF;">Log In</a>
                    <a href="/auth/select/signup" class="signup-button relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block font-medium rounded-lg" style="background: #EC4E3D; color: #FBEFDF;">Sign Up</a>
                <?php endif; ?>
            </div>
        </nav>

    </div>

    <!-- Mobile Dynamic Island Menu -->
    <div class="lg:hidden mobile-menu-container">
        <div class="dynamic-island" id="dynamicIsland">

            <div class="hamburger-icon absolute flex flex-col gap-[0.35rem]">
                <span class="w-6 h-[2px] rounded" style="background: #FBEFDF;"></span>
                <span class="w-6 h-[2px] rounded" style="background: #FBEFDF;"></span>
                <span class="w-6 h-[2px] rounded" style="background: #FBEFDF;"></span>
            </div>

            <div class="menu-content absolute inset-0 flex flex-col items-center justify-center gap-5 opacity-0 scale-[0.85] pointer-events-none">
                <svg class="menu-logo" style="color: #FBEFDF;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <?php if ($isLoggedIn): ?>
                    <div class="w-full flex items-center justify-evenly gap-3 pb-3" style="border-bottom: 1px solid rgba(251, 239, 223, 0.2);">
                        <a href="/profile" class="flex items-center gap-3 p-2 rounded-lg transition-colors" style="color: #FBEFDF;">
                            <svg class="w-10 h-10" style="color: #FBEFDF;" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                            </svg>
                            <div class="text-left">
                                <p class="font-semibold text-sm" style="color: #FBEFDF;"><?php echo htmlspecialchars($userData[$userRole === 'admin' ? 'nama_admin' : 'nama_mitra'] ?? ''); ?></p>
                                <p class="text-xs" style="color: rgba(251, 239, 223, 0.7);"><?php echo htmlspecialchars($username); ?></p>
                            </div>
                        </a>
                        <a href="/logout" class="p-2 rounded-lg transition-colors" style="color: #FBEFDF;">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </a>
                    </div>
                    <a href="<?php echo $dashboardUrl; ?>" class="menu-link">DASHBOARD</a>
                <?php else: ?>
                    <div class="flex gap-4">
                        <a href="/auth/select/login" class="menu-link border-2" style="border-color: #FBEFDF;">Log In</a>
                        <a href="/auth/select/signup" class="menu-link border-2" style="border-color: #EC4E3D; background: #EC4E3D;">Sign Up</a>
                    </div>
                <?php endif; ?>
                <a href="/#hero" class="menu-link">HOME</a>
                <a href="/#demo" class="menu-link">DEMO</a>
                <a href="/#features" class="menu-link">FEATURES</a>
                <a href="/#subscription" class="menu-link">SUBSCRIPTION</a>
                <a href="#footer" class="menu-link">CONTACT</a>
            </div>

        </div>
    </div>

    <div class="menu-overlay" id="menuOverlay"></div>

    <script>
        let lastScroll = 0;
        const navbar = document.getElementById("navbar");
        const scrollThreshold = 10;

        window.addEventListener("scroll", () => {
            if (window.innerWidth >= 1024) {
                const current = window.pageYOffset || document.documentElement.scrollTop;

                if (Math.abs(current - lastScroll) < scrollThreshold) return;

                if (current <= 0) {
                    navbar.classList.remove("nav-hidden");
                    lastScroll = current;
                    return;
                }

                if (current > lastScroll && current > 100) {
                    navbar.classList.add("nav-hidden");
                } else {
                    navbar.classList.remove("nav-hidden");
                }

                lastScroll = current <= 0 ? 0 : current;
            }
        });

        // Dynamic Island Mobile Menu
        const dynamicIsland = document.getElementById("dynamicIsland");
        const menuOverlay = document.getElementById("menuOverlay");
        const body = document.body;
        let isMenuOpen = false;

        // Toggle menu when clicking the island
        dynamicIsland.addEventListener("click", (e) => {
            e.stopPropagation();
            toggleMenu();
        });

        // Close menu when clicking overlay
        menuOverlay.addEventListener("click", () => {
            if (isMenuOpen) {
                toggleMenu();
            }
        });

        // Close menu when clicking menu links
        document.querySelectorAll(".menu-link").forEach(link => {
            link.addEventListener("click", () => {
                if (isMenuOpen) {
                    toggleMenu();
                }
            });
        });

        function toggleMenu() {
            isMenuOpen = !isMenuOpen;

            if (isMenuOpen) {
                // Opening animation
                dynamicIsland.classList.add("expanded");
                menuOverlay.classList.add("active");
                body.classList.add("menu-open");
            } else {
                // Closing animation - hide content first, then shrink
                const menuContent = dynamicIsland.querySelector(".menu-content");
                const menuLinks = dynamicIsland.querySelectorAll(".menu-link");
                const menuLogo = dynamicIsland.querySelector(".menu-logo");

                // Immediately remove pointer events and start fade out
                menuContent.style.pointerEvents = "none";
                menuContent.style.opacity = "0";
                menuContent.style.transform = "scale(0.85)";
                menuContent.style.transition = "all 0.2s cubic-bezier(0.4, 0, 0.2, 1)";

                menuLogo.style.opacity = "0";
                menuLogo.style.transform = "translateY(-20px)";
                menuLogo.style.transition = "all 0.2s cubic-bezier(0.4, 0, 0.2, 1)";

                menuLinks.forEach(link => {
                    link.style.opacity = "0";
                    link.style.transform = "translateX(-30px)";
                    link.style.transition = "all 0.2s cubic-bezier(0.4, 0, 0.2, 1)";
                });

                // Wait for content to fade, then shrink the island
                setTimeout(() => {
                    dynamicIsland.classList.remove("expanded");
                    menuOverlay.classList.remove("active");
                    body.classList.remove("menu-open");

                    // Reset inline styles after animation
                    setTimeout(() => {
                        menuContent.style.cssText = "";
                        menuLogo.style.cssText = "";
                        menuLinks.forEach(link => {
                            link.style.cssText = "";
                        });
                    }, 600);
                }, 200);
            }
        }

        // Prevent menu from closing when clicking inside the island
        dynamicIsland.addEventListener("click", (e) => {
            e.stopPropagation();
        });

        // Close menu when clicking outside (on overlay)
        document.addEventListener("click", (e) => {
            if (isMenuOpen && !dynamicIsland.contains(e.target)) {
                toggleMenu();
            }
        });
    </script>