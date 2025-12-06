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
            background: "linear-gradient(135deg, #FBEFDF 0%, #FBEFDF 100%)",
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
        confirmButtonColor: '#FBEFDF'
    })
</script>
<?php endif; ?>

<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-20 px-4" style="background: linear-gradient(135deg, #FBEFDF 0%, #FBEFDF 50%, #FBEFDF 100%);">
    <div class="max-w-4xl mx-auto">
        
        <!-- Back Button -->
        <a href="javascript:history.back()" class="inline-flex justify-center items-center font-bold gap-2 text-[#25343B] hover:text-[#39464D] mb-6 transition-colors" style="filter: brightness(0.9);">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>

        <!-- Profile Card -->
        <div class="rounded-2xl shadow-xl overflow-hidden" style="background: #25343B;">
            
            <!-- Header -->
            <div class="bg-gradient-to-r px-8 py-12 text-center" style="background: linear-gradient(to right, #FBEFDF, #FBEFDF);">
                <div class="inline-flex items-center justify-center w-32 h-32 rounded-full mb-4" style="background: #25343B;">
                    <svg class="w-20 h-20 text-[#FBEFDF]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold mb-2" style="color: #25343B;">
                    <?php echo htmlspecialchars($user[$role === 'admin' ? 'nama_admin' : 'nama_mitra']); ?>
                </h1>
                <p class="text-lg" style="color: rgba(37, 52, 59, 0.8);">
                    <?php echo ucfirst($role); ?>
                </p>
            </div>

            <!-- Profile Information -->
            <div class="px-3 py-4 md:px-6 md:py-8">
                <h2 class="text-2xl font-bold mb-6" style="color: #FBEFDF;">Informasi Profile</h2>
                
                <div class="space-y-6">
                    <!-- Nama -->
                    <div class="border-b pb-4" style="border-color: rgba(251, 239, 223, 0.3);">
                        <label class="text-sm font-medium block mb-2" style="color: #FBEFDF;">Nama Lengkap</label>
                        <p class="text-lg font-semibold" style="color: #FBEFDF;">
                            <?php echo htmlspecialchars($user[$role === 'admin' ? 'nama_admin' : 'nama_mitra']); ?>
                        </p>
                    </div>

                    <!-- Username -->
                    <div class="border-b pb-4" style="border-color: rgba(251, 239, 223, 0.3);">
                        <label class="text-sm font-medium block mb-2" style="color: #FBEFDF;">Username</label>
                        <form method="POST" action="/profile/update-username" class="flex gap-2">
                            <input type="text" name="username" value="<?php echo htmlspecialchars($user[$role === 'admin' ? 'username_admin' : 'username_mitra']); ?>" 
                                   class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" style="border-color: rgba(251, 239, 223, 0.3); background: rgba(251, 239, 223, 0.1); color: #FBEFDF; --tw-ring-color: #FBEFDF;">
                            <button type="submit" class="px-6 py-2 rounded-lg transition-colors" style="background: #FBEFDF; color: #25343B;">
                                Update
                            </button>
                        </form>
                    </div>

                    <!-- Email -->
                    <div class="border-b pb-4" style="border-color: rgba(251, 239, 223, 0.3);">
                        <label class="text-sm font-medium block mb-2" style="color: #FBEFDF;">Email</label>
                        <form method="POST" action="/profile/update-email" class="flex gap-2">
                            <input type="email" name="email" value="<?php echo htmlspecialchars($user[$role === 'admin' ? 'email_admin' : 'email_mitra']); ?>" 
                                   class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" style="border-color: rgba(251, 239, 223, 0.3); background: rgba(251, 239, 223, 0.1); color: #FBEFDF; --tw-ring-color: #FBEFDF;">
                            <button type="submit" class="px-6 py-2 rounded-lg transition-colors" style="background: #FBEFDF; color: #25343B;">
                                Update
                            </button>
                        </form>
                    </div>

                    <!-- Gudang (Admin Only) -->
                    <?php if ($role === 'admin' && !empty($gudang)): ?>
                    <div class="border-b pb-4" style="border-color: rgba(251, 239, 223, 0.3);">
                        <label class="text-sm font-medium block mb-2" style="color: #FBEFDF;">Nama Gudang</label>
                        <p class="text-lg font-semibold" style="color: #FBEFDF;">
                            <?php echo htmlspecialchars($gudang['nama_gudang']); ?>
                        </p>
                    </div>

                    <div class="border-b pb-4" style="border-color: rgba(251, 239, 223, 0.3);">
                        <label class="text-sm font-medium block mb-2" style="color: #FBEFDF;">Lokasi Gudang</label>
                        <p class="text-lg font-semibold" style="color: #FBEFDF;">
                            <?php echo htmlspecialchars($gudang['lokasi_gudang']); ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex gap-4">
                    <a href="<?php echo $role === 'admin' ? '/admin/dashboard' : '/mitra/dashboard'; ?>" 
                       class="flex-1 font-semibold py-3 px-6 rounded-lg transition-all text-center border-2 border-[#FBEFDF] bg-[#FBEFDF] text-[#25343B] hover:bg-[#25343B] hover:text-[#FBEFDF] active:scale-95">
                        Ke Dashboard
                    </a>
                    <a href="/logout" 
                       class="flex-1 font-semibold py-3 px-6 rounded-lg transition-all text-center border-2 border-[#FBEFDF] bg-[#FBEFDF] text-[#25343B] hover:bg-[#25343B] hover:text-[#FBEFDF] active:scale-95">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
