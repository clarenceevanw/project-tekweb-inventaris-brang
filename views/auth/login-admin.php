<?php $this->extend('layouts/main'); ?>

<?php $this->section('content'); ?>
<style>
    .login-container { max-width: 400px; margin: 50px auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    h2 { text-align: center; margin-bottom: 30px; color: #333; }
    .form-group { margin-bottom: 20px; }
    label { display: block; margin-bottom: 5px; color: #555; font-weight: bold; }
    input[type="text"], input[type="password"] { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
    input[type="text"]:focus, input[type="password"]:focus { outline: none; border-color: #667eea; }
    button { width: 100%; padding: 12px; background: #667eea; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; }
    button:hover { background: #5568d3; }
    .error { background: #fee; border: 1px solid #fcc; color: #c33; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center; }
    .success { background: #efe; border: 1px solid #cfc; color: #3c3; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center; }
    .link { text-align: center; margin-top: 15px; }
    .link a { color: #667eea; text-decoration: none; }
    .link a:hover { text-decoration: underline; }
</style>

<div class="login-container">
    <h2>Login Admin</h2>
    
    <?php if (isset($flash['error'])): ?>
        <div class="error"><?= $flash['error'] ?></div>
    <?php endif; ?>
    
    <?php if (isset($flash['success'])): ?>
        <div class="success"><?= $flash['success'] ?></div>
    <?php endif; ?>

    <form action="/login/admin" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required autofocus>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit">Login</button>
    </form>
</div>

<?php $this->endSection(); ?>
