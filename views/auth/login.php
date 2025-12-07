<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap');
    
    .role-content {
        transition: opacity 0.4s ease;
    }
    
    .role-content.hidden {
        opacity: 0;
        position: absolute;
        pointer-events: none;
    }
    
    .role-content.active {
        opacity: 1;
        position: relative;
    }
    
    @keyframes scan {
        0% { left: 0; opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { left: 100%; opacity: 0; }
    }
    
    @keyframes scanReverse {
        0% { left: 100%; opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { left: 0; opacity: 0; }
    }
    
    #scanLine {
        animation: none;
    }
</style>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br py-12 px-4 sm:px-6 lg:px-8" style="background: linear-gradient(135deg, #FBEFDF 0%, #f5e5d0 50%, #FBEFDF 100%);">
    <div class="max-w-5xl w-full rounded-2xl shadow-2xl overflow-hidden" style="background: #25343B;">
        <div class="flex flex-col lg:flex-row">
            <!-- Left Side - Branding -->
            <div class="lg:w-1/2 p-12 flex flex-col justify-center relative" style="background: linear-gradient(135deg, #FBEFDF, #f5e5d0); color: #25343B; overflow: hidden;">
                <!-- Scanning Line -->
                <div id="scanLine" class="absolute top-0 left-0 h-full w-1 bg-gradient-to-b from-transparent via-theme-secondary to-transparent opacity-0 pointer-events-none" style="background: linear-gradient(to bottom, transparent, #5FA59C, transparent); box-shadow: 0 0 20px #5FA59C;"></div>
                <!-- Admin Content -->
                <div id="admin-content" class="role-content <?= ($role ?? 'admin') === 'admin' ? 'active' : 'hidden' ?>">
                    <div class="mb-8">
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6" style="background: rgba(37, 52, 59, 0.1);">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <h1 class="text-4xl mb-4">As <span style="font-family: 'Inter', sans-serif; font-weight: 700; font-style: italic;">Organizer</span></h1>
                        <p style="color: rgba(37, 52, 59, 0.9);" class="text-lg">Warehouse Inventory Management System</p>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold">Create Warehouses</h3>
                                <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Full control to create and manage warehouses</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold">Track Items</h3>
                                <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Record items entering or leaving warehouses</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold">Transfer Items</h3>
                                <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Efficiently transfer items between rooms</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mitra Content -->
                <div id="mitra-content" class="role-content <?= ($role ?? 'admin') === 'mitra' ? 'active' : 'hidden' ?>">
                    <div class="mb-8">
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center mb-6" style="background: rgba(37, 52, 59, 0.1);">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                            </svg>
                        </div>
                        <h1 class="text-4xl mb-4">As <span style="font-family: 'Inter', sans-serif; font-weight: 700; font-style: italic;">Partner</span></h1>
                        <p style="color: rgba(37, 52, 59, 0.9);" class="text-lg">Warehouse Inventory Management System</p>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold">Provide Supplies</h3>
                                <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Supply items to the warehouse easily</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold">Purchase Items</h3>
                                <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Buy items directly from the warehouse</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 mt-1" style="color: rgba(37, 52, 59, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold">Track History</h3>
                                <p style="color: rgba(37, 52, 59, 0.9);" class="text-sm">Complete supply and purchase history tracking</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="lg:w-1/2 p-12">
                <div class="max-w-md mx-auto">
                    <!-- Toggle Button -->
                    <div class="flex justify-center mb-6">
                        <div class="inline-flex rounded-lg p-1" style="background: rgba(251, 239, 223, 0.1);">
                            <button id="btn-admin" onclick="switchRole('admin')" class="px-6 py-2 rounded-lg text-sm font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95" style="background: <?= ($role ?? 'admin') === 'admin' ? '#5FA59C' : 'transparent' ?>; color: <?= ($role ?? 'admin') === 'admin' ? 'white' : '#FBEFDF' ?>;">
                                Organizer
                            </button>
                            <button id="btn-mitra" onclick="switchRole('mitra')" class="px-6 py-2 rounded-lg text-sm font-semibold transition-all duration-300 transform hover:scale-105 active:scale-95" style="background: <?= ($role ?? 'admin') === 'mitra' ? '#5FA59C' : 'transparent' ?>; color: <?= ($role ?? 'admin') === 'mitra' ? 'white' : '#FBEFDF' ?>;">
                                Partner
                            </button>
                        </div>
                    </div>

                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold mb-2" style="color: #FBEFDF;">Welcome Back</h2>
                        <p id="subtitle" style="color: rgba(251, 239, 223, 0.8);"><?= ($role ?? 'admin') === 'mitra' ? 'Sign in to your partner account' : 'Sign in to your organizer account' ?></p>
                    </div>

                    <form id="loginForm" action="/login" method="POST" class="space-y-6">
                        <input type="hidden" name="role" id="roleInput" value="<?= $role ?? 'admin' ?>">
                        <div>
                            <label for="username" class="block text-sm font-semibold mb-2" style="color: #FBEFDF;">Username</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5" style="color: rgba(251, 239, 223, 0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input type="text" id="username" name="username" required autofocus 
                                    class="block w-full pl-10 pr-3 py-3 border rounded-lg focus:ring-2 focus:border-transparent transition duration-150 ease-in-out" style="background: rgba(251, 239, 223, 0.1); border-color: rgba(251, 239, 223, 0.3); color: #FBEFDF; --tw-ring-color: #5FA59C;"
                                    placeholder="Enter username">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold mb-2" style="color: #FBEFDF;">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5" style="color: rgba(251, 239, 223, 0.6);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password" required 
                                    class="block w-full pl-10 pr-3 py-3 border rounded-lg focus:ring-2 focus:border-transparent transition duration-150 ease-in-out" style="background: rgba(251, 239, 223, 0.1); border-color: rgba(251, 239, 223, 0.3); color: #FBEFDF; --tw-ring-color: #5FA59C;"
                                    placeholder="Enter password">
                            </div>
                        </div>

                        <button type="submit" 
                            class="w-full flex justify-center mb-0 cursor-pointer py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold transition duration-150 ease-in-out transform hover:scale-[1.02]" style="background: #EC4E3D; color: #FBEFDF;" onmouseover="this.style.backgroundColor='#d43d2e'" onmouseout="this.style.backgroundColor='#EC4E3D'">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Sign In to Dashboard
                        </button>

                        <div class="relative flex items-center my-3">
                            <div class="flex-grow border-t" style="border-color: #FBEFDF;"></div>
                            <span class="flex-shrink mx-4 text-sm" style="color: #FBEFDF;">or</span>
                            <div class="flex-grow border-t" style="border-color: #FBEFDF;"></div>
                        </div>

                        <a id="googleBtn" href="/auth/google/login?role=<?= $role ?? 'admin' ?>" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold transition duration-150 ease-in-out transform hover:scale-[1.02]" style="background-color: #5FA59C; color: white; text-decoration: none;" onmouseover="this.style.backgroundColor='#4d8680'" onmouseout="this.style.backgroundColor='#5FA59C'">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2"><path d="M12 2a9.96 9.96 0 0 1 6.29 2.226a1 1 0 0 1 .04 1.52l-1.51 1.362a1 1 0 0 1 -1.265 .06a6 6 0 1 0 2.103 6.836l.001 -.004h-3.66a1 1 0 0 1 -.992 -.883l-.007 -.117v-2a1 1 0 0 1 1 -1h6.945a1 1 0 0 1 .994 .89c.04 .367 .061 .737 .061 1.11c0 5.523 -4.477 10 -10 10s-10 -4.477 -10 -10s4.477 -10 10 -10z" /></svg>
                            Login with Google
                        </a>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-sm" style="color: rgba(251, 239, 223, 0.8);">
                            Don't have an account? 
                            <a id="signupLink" href="/signup/<?= $role ?? 'admin' ?>" class="font-semibold" style="color: #FBEFDF;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentRole = '<?= $role ?? 'admin' ?>';

function switchRole(role) {
    if (currentRole === role) return;
    
    currentRole = role;
    const adminContent = document.getElementById('admin-content');
    const mitraContent = document.getElementById('mitra-content');
    const btnAdmin = document.getElementById('btn-admin');
    const btnMitra = document.getElementById('btn-mitra');
    const subtitle = document.getElementById('subtitle');
    const loginForm = document.getElementById('loginForm');
    const googleBtn = document.getElementById('googleBtn');
    const signupLink = document.getElementById('signupLink');
    const scanLine = document.getElementById('scanLine');
    
    // Trigger scanning animation with direction
    const scanDirection = role === 'admin' ? 'scanReverse' : 'scan';
    scanLine.style.animation = 'none';
    setTimeout(() => {
        scanLine.style.animation = `${scanDirection} 0.6s ease-in-out`;
    }, 10);
    

    
    if (role === 'admin') {
        // Update content
        adminContent.classList.remove('hidden');
        adminContent.classList.add('active');
        mitraContent.classList.remove('active');
        mitraContent.classList.add('hidden');
        
        // Update buttons with transition
        btnAdmin.style.background = '#5FA59C';
        btnAdmin.style.color = 'white';
        btnAdmin.style.transform = 'scale(1.05)';
        setTimeout(() => btnAdmin.style.transform = 'scale(1)', 200);
        btnMitra.style.background = 'transparent';
        btnMitra.style.color = '#FBEFDF';
        
        // Update form
        subtitle.textContent = 'Sign in to your organizer account';
        document.getElementById('roleInput').value = 'admin';
        googleBtn.href = '/auth/google/login?role=admin';
        signupLink.href = '/signup/admin';
    } else {
        // Update content
        mitraContent.classList.remove('hidden');
        mitraContent.classList.add('active');
        adminContent.classList.remove('active');
        adminContent.classList.add('hidden');
        
        // Update buttons with transition
        btnMitra.style.background = '#5FA59C';
        btnMitra.style.color = 'white';
        btnMitra.style.transform = 'scale(1.05)';
        setTimeout(() => btnMitra.style.transform = 'scale(1)', 200);
        btnAdmin.style.background = 'transparent';
        btnAdmin.style.color = '#FBEFDF';
        
        // Update form
        subtitle.textContent = 'Sign in to your partner account';
        document.getElementById('roleInput').value = 'mitra';
        googleBtn.href = '/auth/google/login?role=mitra';
        signupLink.href = '/signup/mitra';
    }
}
</script>

<?php $this->endSection(); ?>
