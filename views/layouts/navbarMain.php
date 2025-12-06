<?php
if (!isset($isLoggedIn)) {
    $isLoggedIn = isset($_SESSION['user_id']);
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
}
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';
$dashboardUrl = ($userRole === 'mitra') ? '/mitra/dashboard' : '/admin/dashboard';
$userData = isset($_SESSION['user']) ? $_SESSION['user'] : [];
$gudangData = isset($_SESSION['gudang']) ? $_SESSION['gudang'] : [];
?>
<style>
    .nav-hidden {
        transform: translateY(-100%);
    }

    .navbar-trapezoid {
        background: rgba(180, 150, 220, 0.5);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        position: relative;
        z-index: 1;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        box-shadow: 0 8px 24px rgba(180, 150, 220, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(210, 180, 240, 0.4);
    }

    .navbar-right {
        background: rgba(180, 150, 220, 0.5);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        box-shadow: 0 8px 24px rgba(180, 150, 220, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(210, 180, 240, 0.4);
    }

    .nav-link::before,
    .auth-button::before {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 0%;
        background: #fff;
        transition: height 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: -1;
    }

    .nav-link:hover::before,
    .auth-button:hover::before {
        height: 100%;
    }

    .nav-link:hover,
    .auth-button:hover {
        color: #ada1ea;
    }

    .signup-button:hover {
        background-color: #fff;
        color: #7a6bb8;
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
        background: linear-gradient(135deg, #7a6bb8 0%, #ada1ea 100%);
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 32px rgba(79, 70, 229, 0.4);
        overflow: hidden;
    }

    .dynamic-island.expanded {
        width: max(40vw, 20rem);
        max-width: 380px;
        height: 28rem;
        border-radius: 2rem;
        background: linear-gradient(135deg, #7a6bb8 0%, #ada1ea 100%);
        backdrop-filter: blur(20px);
        box-shadow: 0 20px 60px rgba(173, 161, 234, 0.5);
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
        color: white;
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
        background: rgba(255, 255, 255, 0.1);
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

            <div class="navbar-trapezoid flex items-center gap-8 px-4 py-4">
                <a href="/#hero" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block text-white font-medium">Home</a>
                <a href="/#demo" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block text-white font-medium">Demo</a>
                <a href="/#features" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block text-white font-medium">Features</a>
                <a href="/#subscription" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block text-white font-medium">Subscription</a>
                <a href="/#contact" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block text-white font-medium">Contact</a>
                <?php if ($isLoggedIn): ?>
                    <a href="<?php echo $dashboardUrl; ?>" class="nav-link relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block text-white font-medium">Dashboard</a>
                <?php endif; ?>
            </div>

            <div class="navbar-right absolute right-0 gap-4 px-6 py-4 flex items-center">
                <?php if ($isLoggedIn): ?>
                    <a href="/profile" class="hover:opacity-80 transition-opacity">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
                        </svg>
                    </a>
                    <a href="/logout" class="auth-button relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block text-white font-medium">Log Out</a>
                <?php else: ?>
                    <a href="/auth/select/login" class="auth-button relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block text-white font-medium">Log In</a>
                    <a href="/auth/select/signup" class="signup-button relative overflow-hidden px-4 py-2 rounded-md transition-colors duration-400 inline-block bg-[#7a6bb8] font-medium text-white rounded-lg">Sign Up</a>
                <?php endif; ?>
            </div>
        </nav>

    </div>

    <!-- Mobile Dynamic Island Menu -->
    <div class="lg:hidden mobile-menu-container">
        <div class="dynamic-island" id="dynamicIsland">

            <div class="hamburger-icon absolute flex flex-col gap-[0.35rem]">
                <span class="w-6 h-[2px] bg-white rounded"></span>
                <span class="w-6 h-[2px] bg-white rounded"></span>
                <span class="w-6 h-[2px] bg-white rounded"></span>
            </div>

            <div class="menu-content absolute inset-0 flex flex-col items-center justify-center gap-5 opacity-0 scale-[0.85] pointer-events-none">
                <svg class="menu-logo text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <?php if ($isLoggedIn): ?>
                    <div class="w-full flex items-center justify-evenly gap-3 pb-3 border-b border-white/20">
                        <a href="/profile" class="flex items-center gap-3 hover:bg-white/10 p-2 rounded-lg transition-colors">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                            </svg>
                            <div class="text-left">
                                <p class="text-white font-semibold text-sm"><?php echo htmlspecialchars($userData[$userRole === 'admin' ? 'nama_admin' : 'nama_mitra'] ?? ''); ?></p>
                                <p class="text-white/70 text-xs"><?php echo htmlspecialchars($username); ?></p>
                            </div>
                        </a>
                        <a href="/logout" class="text-white hover:bg-white/10 p-2 rounded-lg transition-colors">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </a>
                    </div>
                    <a href="<?php echo $dashboardUrl; ?>" class="menu-link">DASHBOARD</a>
                <?php else: ?>
                    <div class="flex gap-4">
                        <a href="/auth/select/login" class="menu-link border-2 border-[#ada1ea]">Log In</a>
                        <a href="/auth/select/signup" class="menu-link border-2 border-[#ada1ea]">Sign Up</a>
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