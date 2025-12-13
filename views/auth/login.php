<?php $this->extend('layouts/main'); ?>

<?php $this->section('header'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap');

    /* Mobile: Simple layout */
    .login-wrapper {
        display: flex;
        flex-direction: column;
    }

    .form-container {
        width: 100%;
    }

    .info-container {
        display: none;
    }

    /* Desktop: Sliding transition */
    @media (min-width: 1024px) {
        .login-wrapper {
            position: relative;
            flex-direction: row;
            height: 600px;
        }

        .form-container {
            position: absolute;
            width: 50%;
            height: 100%;
            left: 0;
            transition: left 0.8s cubic-bezier(0.645, 0.045, 0.355, 1);
            z-index: 1;
        }

        .info-container {
            display: block;
            position: absolute;
            width: 50%;
            height: 100%;
            right: 0;
            transition: right 0.8s cubic-bezier(0.645, 0.045, 0.355, 1);
            z-index: 2;
        }

        .login-wrapper.show-mitra .form-container {
            left: 50%;
        }

        .login-wrapper.show-mitra .info-container {
            right: 50%;
        }
    }

    .overlay {
        position: relative;
        overflow: hidden;
    }

    .overlay::before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background: linear-gradient(to top,
                rgba(95, 165, 156, 0.8),
                rgba(95, 165, 156, 0.4));
        z-index: 1;
    }

    .overlay-content {
        position: relative;
        z-index: 2;
    }
</style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" style="background: linear-gradient(135deg, #FBEFDF 0%, #f5e5d0 50%, #FBEFDF 100%);">
    <div class="max-w-5xl w-full rounded-2xl shadow-2xl overflow-hidden" style="background: #25343B;">
        <div class="login-wrapper <?= ($role ?? 'admin') === 'mitra' ? 'show-mitra' : '' ?>">

            <!-- Form Container (z-index: 1) -->
            <div class="form-container">
                <div class="p-6 lg:p-12 flex flex-col items-center justify-center" style="background: #25343B; min-height: 600px;">
                    <!-- Mobile Toggle -->
                    <div class="lg:hidden w-full max-w-md mx-auto mb-6">
                        <div class="flex rounded-lg p-1" style="background: rgba(251, 239, 223, 0.1);">
                            <button onclick="switchToAdmin()" id="btn-mobile-admin" class="flex-1 py-2 rounded-lg text-sm font-semibold transition" style="background: <?= ($role ?? 'admin') === 'admin' ? '#5FA59C' : 'transparent' ?>; color: <?= ($role ?? 'admin') === 'admin' ? 'white' : '#FBEFDF' ?>;">
                                Organizer
                            </button>
                            <button onclick="switchToMitra()" id="btn-mobile-mitra" class="flex-1 py-2 rounded-lg text-sm font-semibold transition" style="background: <?= ($role ?? 'admin') === 'mitra' ? '#5FA59C' : 'transparent' ?>; color: <?= ($role ?? 'admin') === 'mitra' ? 'white' : '#FBEFDF' ?>;">
                                Partner
                            </button>
                        </div>
                    </div>
                    <!-- Form Admin -->
                    <div id="form-admin" class="form-content w-full max-w-md mx-auto" style="<?= ($role ?? 'admin') === 'mitra' ? 'display: none;' : '' ?>">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold mb-2" style="color: #FBEFDF;">Welcome Back</h2>
                            <p style="color: rgba(251, 239, 223, 0.8);">Sign in to your organizer account</p>
                        </div>

                        <form action="/login" method="POST" class="space-y-6">
                            <input type="hidden" name="role" value="admin">
                            <div>
                                <label for="username-admin" class="block text-sm font-semibold mb-2" style="color: #FBEFDF;">Username</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5" style="color: rgba(251, 239, 223, 0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="username-admin" name="username" required
                                        class="block w-full pl-10 pr-3 py-3 border rounded-lg focus:ring-2 focus:border-transparent transition"
                                        style="background: rgba(251, 239, 223, 0.1); border-color: rgba(251, 239, 223, 0.3); color: #FBEFDF;"
                                        placeholder="Enter username">
                                </div>
                            </div>

                            <div>
                                <label for="password-admin" class="block text-sm font-semibold mb-2" style="color: #FBEFDF;">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5" style="color: rgba(251, 239, 223, 0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input type="password" id="password-admin" name="password" required
                                        class="block w-full pl-10 pr-3 py-3 border rounded-lg focus:ring-2 focus:border-transparent transition"
                                        style="background: rgba(251, 239, 223, 0.1); border-color: rgba(251, 239, 223, 0.3); color: #FBEFDF;"
                                        placeholder="Enter password">
                                </div>
                            </div>

                            <button type="submit"
                                class="cursor-pointer w-full flex justify-center items-center py-3 px-4 mb-0 rounded-lg text-sm font-semibold transition transform hover:scale-[1.02]"
                                style="background: #EC4E3D; color: #FBEFDF;">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Sign In to Dashboard
                            </button>

                            <div class="relative flex items-center my-3">
                                <div class="flex-grow border-t" style="border-color: rgba(251, 239, 223, 0.3);"></div>
                                <span class="flex-shrink mx-4 text-sm" style="color: #FBEFDF;">or</span>
                                <div class="flex-grow border-t" style="border-color: rgba(251, 239, 223, 0.3);"></div>
                            </div>

                            <a href="/auth/google/login?role=admin"
                                class="cursor-pointer w-full flex justify-center items-center py-3 px-4 rounded-lg text-sm font-semibold transition transform hover:scale-[1.02]"
                                style="background-color: #5FA59C; color: white; text-decoration: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                                    <path d="M12 2a9.96 9.96 0 0 1 6.29 2.226a1 1 0 0 1 .04 1.52l-1.51 1.362a1 1 0 0 1 -1.265 .06a6 6 0 1 0 2.103 6.836l.001 -.004h-3.66a1 1 0 0 1 -.992 -.883l-.007 -.117v-2a1 1 0 0 1 1 -1h6.945a1 1 0 0 1 .994 .89c.04 .367 .061 .737 .061 1.11c0 5.523 -4.477 10 -10 10s-10 -4.477 -10 -10s4.477 -10 10 -10z" />
                                </svg>
                                Login with Google
                            </a>
                        </form>

                        <div class="mt-6 text-center">
                            <p class="text-sm" style="color: rgba(251, 239, 223, 0.8);">
                                Don't have an account?
                                <a href="/signup/admin" class="font-semibold" style="color: #FBEFDF;">Sign up</a>
                            </p>
                        </div>
                    </div>

                    <!-- Form Mitra -->
                    <div id="form-mitra" class="form-content w-full max-w-md mx-auto" style="<?= ($role ?? 'admin') === 'admin' ? 'display: none;' : '' ?>">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold mb-2" style="color: #FBEFDF;">Welcome Back</h2>
                            <p style="color: rgba(251, 239, 223, 0.8);">Sign in to your partner account</p>
                        </div>

                        <form action="/login" method="POST" class="space-y-6">
                            <input type="hidden" name="role" value="mitra">
                            <div>
                                <label for="username-mitra" class="block text-sm font-semibold mb-2" style="color: #FBEFDF;">Username</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5" style="color: rgba(251, 239, 223, 0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="username-mitra" name="username" required
                                        class="block w-full pl-10 pr-3 py-3 border rounded-lg focus:ring-2 focus:border-transparent transition"
                                        style="background: rgba(251, 239, 223, 0.1); border-color: rgba(251, 239, 223, 0.3); color: #FBEFDF;"
                                        placeholder="Enter username">
                                </div>
                            </div>

                            <div>
                                <label for="password-mitra" class="block text-sm font-semibold mb-2" style="color: #FBEFDF;">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5" style="color: rgba(251, 239, 223, 0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input type="password" id="password-mitra" name="password" required
                                        class="block w-full pl-10 pr-3 py-3 border rounded-lg focus:ring-2 focus:border-transparent transition"
                                        style="background: rgba(251, 239, 223, 0.1); border-color: rgba(251, 239, 223, 0.3); color: #FBEFDF;"
                                        placeholder="Enter password">
                                </div>
                            </div>

                            <button type="submit"
                                class="cursor-pointer w-full flex justify-center items-center py-3 px-4 mb-0 rounded-lg text-sm font-semibold transition transform hover:scale-[1.02]"
                                style="background: #EC4E3D; color: #FBEFDF;">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                Sign In to Dashboard
                            </button>

                            <div class="relative flex items-center my-3">
                                <div class="flex-grow border-t" style="border-color: rgba(251, 239, 223, 0.3);"></div>
                                <span class="flex-shrink mx-4 text-sm" style="color: #FBEFDF;">or</span>
                                <div class="flex-grow border-t" style="border-color: rgba(251, 239, 223, 0.3);"></div>
                            </div>

                            <a href="/auth/google/login?role=mitra"
                                class="cursor-pointer w-full flex justify-center items-center py-3 px-4 rounded-lg text-sm font-semibold transition transform hover:scale-[1.02]"
                                style="background-color: #5FA59C; color: white; text-decoration: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                                    <path d="M12 2a9.96 9.96 0 0 1 6.29 2.226a1 1 0 0 1 .04 1.52l-1.51 1.362a1 1 0 0 1 -1.265 .06a6 6 0 1 0 2.103 6.836l.001 -.004h-3.66a1 1 0 0 1 -.992 -.883l-.007 -.117v-2a1 1 0 0 1 1 -1h6.945a1 1 0 0 1 .994 .89c.04 .367 .061 .737 .061 1.11c0 5.523 -4.477 10 -10 10s-10 -4.477 -10 -10s4.477 -10 10 -10z" />
                                </svg>
                                Login with Google
                            </a>
                        </form>

                        <div class="mt-6 text-center">
                            <p class="text-sm" style="color: rgba(251, 239, 223, 0.8);">
                                Don't have an account?
                                <a href="/signup/mitra" class="font-semibold" style="color: #FBEFDF;">Sign up</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Container (z-index: 2, di atas form) -->
            <div class="info-container">
                <div class="overlay p-12 flex items-center justify-center" style="background: linear-gradient(135deg, #FBEFDF, #f5e5d0); min-height: 600px;">
                    <!-- Info Admin (untuk switch ke Mitra) -->
                    <div id="info-admin" class="info-content overlay-content" style="<?= ($role ?? 'admin') === 'mitra' ? 'display: none;' : '' ?>">
                        <div class="mb-8">
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6" style="background: rgba(37, 52, 59, 0.1);">
                                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </div>
                            <h1 class="text-4xl mb-4">As <span style="font-family: 'Inter', sans-serif; font-weight: 700; font-style: italic;">Organizer</span></h1>
                            <p style="color: rgba(37, 52, 59, 0.9);" class="text-lg">Warehouse Inventory Management System</p>
                        </div>
                        <div class="space-y-4 mb-8">
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Create Warehouses</h3>
                                    <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Full control to create and manage warehouses</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Track Items</h3>
                                    <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Record items entering or leaving warehouses</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Transfer Items</h3>
                                    <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Efficiently transfer items between rooms</p>
                                </div>
                            </div>
                        </div>
                        <button onclick="switchToMitra()"
                            class="cursor-pointer px-6 py-2.5 rounded-lg text-sm font-semibold transition transform hover:scale-105 border-2 border-white text-white hover:bg-white hover:text-teal-600" style="width: 180px;">
                            Switch to Partner
                        </button>
                    </div>

                    <!-- Info Mitra (untuk switch ke Admin) -->
                    <div id="info-mitra" class="info-content overlay-content" style="position: absolute; <?= ($role ?? 'admin') === 'admin' ? 'display: none;' : '' ?>">
                        <div class="mb-8">
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6" style="background: rgba(37, 52, 59, 0.1);">
                                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                            </div>
                            <h1 class="text-4xl mb-4">As <span style="font-family: 'Inter', sans-serif; font-weight: 700; font-style: italic;">Partner</span></h1>
                            <p style="color: rgba(37, 52, 59, 0.9);" class="text-lg">Warehouse Inventory Management System</p>
                        </div>
                        <div class="space-y-4 mb-8">
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Provide Supplies</h3>
                                    <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Supply items to the warehouse easily</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Purchase Items</h3>
                                    <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Buy items directly from the warehouse</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-semibold">Track History</h3>
                                    <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Complete supply and purchase history tracking</p>
                                </div>
                            </div>
                        </div>
                        <button onclick="switchToAdmin()"
                            class="cursor-pointer px-6 py-2.5 rounded-lg text-sm font-semibold transition transform hover:scale-105 border-2 border-white text-white hover:bg-white hover:text-teal-600" style="width: 180px;">
                            Switch to Organizer
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->endSection(); ?>

<?php $this->section('script'); ?>
<?php if (isset($login_error)): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?= $login_error ?>'
        });
    });
</script>
<?php endif; ?>
<?php if (!empty($flash['success'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
    });
</script>
<?php endif; ?>
<?php if (!empty($flash['error'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?= $flash['error'] ?>'
        });
    });
</script>
<?php endif; ?>
<script>
    let isTransitioning = false;

    function switchToMitra() {
        if (isTransitioning) return;

        const wrapper = document.querySelector('.login-wrapper');
        const formAdmin = document.getElementById('form-admin');
        const formMitra = document.getElementById('form-mitra');
        const infoAdmin = document.getElementById('info-admin');
        const infoMitra = document.getElementById('info-mitra');
        const btnMobileAdmin = document.getElementById('btn-mobile-admin');
        const btnMobileMitra = document.getElementById('btn-mobile-mitra');

        // Update mobile buttons
        if (btnMobileAdmin) {
            btnMobileAdmin.style.background = 'transparent';
            btnMobileAdmin.style.color = '#FBEFDF';
            btnMobileMitra.style.background = '#5FA59C';
            btnMobileMitra.style.color = 'white';
        }

        // Desktop: sliding transition
        if (window.innerWidth >= 1024) {
            isTransitioning = true;
            wrapper.classList.add('show-mitra');
            setTimeout(() => {
                formMitra.style.display = 'block';
                infoMitra.style.display = 'block';
                formAdmin.style.display = 'none';
                infoAdmin.style.display = 'none';
            }, 400);
            setTimeout(() => {
                isTransitioning = false;
            }, 800);
        } else {
            // Mobile: instant switch
            formMitra.style.display = 'block';
            formAdmin.style.display = 'none';
        }
    }

    function switchToAdmin() {
        if (isTransitioning) return;

        const wrapper = document.querySelector('.login-wrapper');
        const formAdmin = document.getElementById('form-admin');
        const formMitra = document.getElementById('form-mitra');
        const infoAdmin = document.getElementById('info-admin');
        const infoMitra = document.getElementById('info-mitra');
        const btnMobileAdmin = document.getElementById('btn-mobile-admin');
        const btnMobileMitra = document.getElementById('btn-mobile-mitra');

        // Update mobile buttons
        if (btnMobileAdmin) {
            btnMobileAdmin.style.background = '#5FA59C';
            btnMobileAdmin.style.color = 'white';
            btnMobileMitra.style.background = 'transparent';
            btnMobileMitra.style.color = '#FBEFDF';
        }

        // Desktop: sliding transition
        if (window.innerWidth >= 1024) {
            isTransitioning = true;
            wrapper.classList.remove('show-mitra');
            setTimeout(() => {
                formAdmin.style.display = 'block';
                infoAdmin.style.display = 'block';
                formMitra.style.display = 'none';
                infoMitra.style.display = 'none';
            }, 400);
            setTimeout(() => {
                isTransitioning = false;
            }, 800);
        } else {
            // Mobile: instant switch
            formAdmin.style.display = 'block';
            formMitra.style.display = 'none';
        }
    }
</script>

<?php $this->endSection(); ?>