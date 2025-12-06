<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

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
            background: "linear-gradient(135deg, #7a6bb8 0%, #ada1ea 100%)",
        }
    }).showToast();
</script>
<?php endif; ?>

<?php if (!empty($flash['error'])): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '<?= $flash['error'] ?>',
        confirmButtonColor: '#7a6bb8'
    })
</script>
<?php endif; ?>

<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-20 px-4" style="background: linear-gradient(135deg, #e8e4f3 0%, #d4cde8 50%, #c5bce0 100%);">
    <div class="max-w-4xl mx-auto">
        
        <!-- Back Button -->
        <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-[#7a6bb8] hover:text-[#6d60b0] mb-6 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>

        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-[#7a6bb8] to-[#ada1ea] px-8 py-12 text-center">
                <div class="inline-flex items-center justify-center w-32 h-32 bg-white rounded-full mb-4">
                    <svg class="w-20 h-20 text-[#7a6bb8]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">
                    <?php echo htmlspecialchars($user[$role === 'admin' ? 'nama_admin' : 'nama_mitra']); ?>
                </h1>
                <p class="text-white/80 text-lg">
                    <?php echo ucfirst($role); ?>
                </p>
            </div>

            <!-- Profile Information -->
            <div class="px-3 py-4 md:px-6 md:py-8">
                <h2 class="text-2xl font-bold text-[#7a6bb8] mb-6">Informasi Profile</h2>
                
                <div class="space-y-6">
                    <!-- Nama -->
                    <div class="border-b border-[#d4c5f9]/30 pb-4">
                        <label class="text-sm font-medium text-[#877acc] block mb-2">Nama Lengkap</label>
                        <p class="text-lg text-[#6d60b0] font-semibold">
                            <?php echo htmlspecialchars($user[$role === 'admin' ? 'nama_admin' : 'nama_mitra']); ?>
                        </p>
                    </div>

                    <!-- Username -->
                    <div class="border-b border-[#d4c5f9]/30 pb-4">
                        <label class="text-sm font-medium text-[#877acc] block mb-2">Username</label>
                        <form method="POST" action="/profile/update-username" class="flex gap-2">
                            <input type="text" name="username" value="<?php echo htmlspecialchars($user[$role === 'admin' ? 'username_admin' : 'username_mitra']); ?>" 
                                   class="flex-1 px-4 py-2 border border-[#d4c5f9] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7a6bb8] text-[#6d60b0]">
                            <button type="submit" class="bg-[#7a6bb8] hover:bg-[#6d60b0] text-white px-6 py-2 rounded-lg transition-colors">
                                Update
                            </button>
                        </form>
                    </div>

                    <!-- Email -->
                    <div class="border-b border-[#d4c5f9]/30 pb-4">
                        <label class="text-sm font-medium text-[#877acc] block mb-2">Email</label>
                        <form method="POST" action="/profile/update-email" class="flex gap-2">
                            <input type="email" name="email" value="<?php echo htmlspecialchars($user[$role === 'admin' ? 'email_admin' : 'email_mitra']); ?>" 
                                   class="flex-1 px-4 py-2 border border-[#d4c5f9] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#7a6bb8] text-[#6d60b0]">
                            <button type="submit" class="bg-[#7a6bb8] hover:bg-[#6d60b0] text-white px-6 py-2 rounded-lg transition-colors">
                                Update
                            </button>
                        </form>
                    </div>

                    <!-- Gudang (Admin Only) -->
                    <?php if ($role === 'admin' && !empty($gudang)): ?>
                    <div class="border-b border-[#d4c5f9]/30 pb-4">
                        <label class="text-sm font-medium text-[#877acc] block mb-2">Nama Gudang</label>
                        <p class="text-lg text-[#6d60b0] font-semibold">
                            <?php echo htmlspecialchars($gudang['nama_gudang']); ?>
                        </p>
                    </div>

                    <div class="border-b border-[#d4c5f9]/30 pb-4">
                        <label class="text-sm font-medium text-[#877acc] block mb-2">Lokasi Gudang</label>
                        <p class="text-lg text-[#6d60b0] font-semibold">
                            <?php echo htmlspecialchars($gudang['lokasi_gudang']); ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex gap-4">
                    <a href="<?php echo $role === 'admin' ? '/admin/dashboard' : '/mitra/dashboard'; ?>" 
                       class="flex-1 bg-[#7a6bb8] hover:bg-[#6d60b0] text-white font-semibold py-3 px-6 rounded-lg transition-colors text-center">
                        Ke Dashboard
                    </a>
                    <a href="/logout" 
                       class="flex-1 bg-[#877acc] hover:bg-[#7a6bb8] text-white font-semibold py-3 px-6 rounded-lg transition-colors text-center">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
