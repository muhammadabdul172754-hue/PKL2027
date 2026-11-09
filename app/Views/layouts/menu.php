<style>
    .navbar { background: #0f172a; padding: 15px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 100; }
    .navbar-brand { color: white; font-size: 22px; font-weight: 800; letter-spacing: 1px; text-decoration: none; }
    .navbar-brand span { color: #3b82f6; }
    .navbar-menu { display: flex; gap: 25px; align-items: center; }
    .navbar-menu a { color: #cbd5e1; text-decoration: none; font-size: 15px; font-weight: 500; transition: color 0.3s ease; }
    .navbar-menu a:hover { color: #60a5fa; }
    .btn-logout { background: #ef4444; color: white !important; padding: 8px 18px; border-radius: 6px; font-weight: 600 !important; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); transition: transform 0.2s !important; }
    .btn-logout:hover { transform: translateY(-2px); background: #dc2626; }
    .user-info { color: white; font-size: 14px; border-left: 1px solid #334155; padding-left: 25px; }
    .btn-signin { background: #3b82f6; color: white !important; padding: 8px 20px; border-radius: 6px; font-weight: 600 !important; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3); transition: transform 0.2s !important; }
    .btn-signin:hover { transform: translateY(-2px); background: #2563eb; }
</style>

<nav class="navbar">
    <a href="<?= base_url('/') ?>" class="navbar-brand">Tim466<span>App</span></a>
    
    <div class="navbar-menu">
        <?php if (session()->get('logged_in')) : ?>
            <a href="<?= base_url('/dashboard') ?>">Dashboard</a>
            <a href="<?= base_url('/chat') ?>">Chatroom</a>
            
            <?php if (session()->get('role') == 'admin' || session()->get('role') == 'petugas') : ?>
                <a href="<?= base_url('/users') ?>">Users</a>
            <?php endif; ?>
            
            <a href="<?= base_url('/logout') ?>" class="btn-logout">Log Out</a>
            
            <div class="user-info">
                Halo, <b><?= session('nama'); ?></b>
            </div>
        <?php else : ?>
            <a href="<?= base_url('/login') ?>" class="btn-signin">Sign In</a>
        <?php endif; ?>
    </div>
</nav>