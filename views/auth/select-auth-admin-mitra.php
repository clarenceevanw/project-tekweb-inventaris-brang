<?php $this->extend('layouts/main'); ?>

<?php $this->section('header'); ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap');

    .login-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #9b8fd9 0%, #877acc 50%, #7a6bb8 100%);
        display: grid;
        grid-template-columns: 1fr 1px 1fr;
        padding: 40px 20px;
        min-width: 100vw;
    }

    .login-side {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px;
    }

    .divider {
        background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.3) 20%, rgba(255, 255, 255, 0.3) 80%, transparent);
    }

    .login-title {
        font-size: 32px;
        color: white;
        margin-bottom: 20px;
    }

    .login-title .role {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-style: italic;
    }

    .login-description {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
        margin-bottom: 40px;
        max-width: 400px;
        min-height: 120px;
        display: flex;
        align-items: center;
    }

    .login-btn {
        padding: 15px 60px;
        background: white;
        color: #877acc;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        margin-bottom: 25px;
        width: 200px;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        background: #f0e6ff;
    }

    .signup-text {
        font-size: 14px;
        color: white;
    }

    .signup-text a {
        color: white;
        font-weight: 600;
        text-decoration: underline;
    }

    .signup-text a:hover {
        opacity: 0.8;
    }

    @media (max-width: 768px) {
        .login-wrapper {
            grid-template-columns: 1fr;
        }

        .divider {
            display: none;
        }
    }
</style>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div class="min-h-screen w-full flex items-center justify-center bg-white">

    <?php if ($mode === 'login'): ?>
        <div class="login-wrapper">
            <div class="login-side">
                <h2 class="login-title">As <span class="role">Organizer</span></h2>
                <p class="login-description">
                    As an organizer, you have full control to create warehouses, record items entering or leaving, and transfer items between rooms for efficient inventory management.
                </p>
                <a href="/login/admin" class="login-btn">Login</a>
                <p class="signup-text">Don't have an account? <a href="/signup/admin">Sign up</a></p>
            </div>

            <div class="divider"></div>

            <div class="login-side">
                <h2 class="login-title">As <span class="role">Partner</span></h2>
                <p class="login-description">
                    As a partner, you can provide supplies to the warehouse, buy items directly from it, and easily track your complete supply and purchase history.
                </p>
                <a href="/login/mitra" class="login-btn">Login</a>
                <p class="signup-text">Don't have an account? <a href="/signup/mitra">Sign up</a></p>
            </div>
        </div>

    <?php elseif ($mode == 'signup'): ?>
        <div class="login-wrapper">
            <div class="login-side">
                <h2 class="login-title">As <span class="role">Organizer</span></h2>
                <p class="login-description">
                    As an organizer, you have full control to create warehouses, record items entering or leaving, and transfer items between rooms for efficient inventory management.
                </p>
                <a href="/signup/admin" class="login-btn">Sign Up</a>
                <p class="signup-text">Already have an account? <a href="/login/admin">Login</a></p>
            </div>
            <div class="divider"></div>
            <div class="login-side">
                <h2 class="login-title">As <span class="role">Partner</span></h2>
                <p class="login-description">
                    As a partner, you can provide supplies to the warehouse, buy items directly from it, and easily track your complete supply and purchase history.
                </p>
                <a href="/signup/mitra" class="login-btn">Sign Up</a>
                <p class="signup-text">Already have an account? <a href="/login/mitra">Login</a></p>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php $this->endSection(); ?>