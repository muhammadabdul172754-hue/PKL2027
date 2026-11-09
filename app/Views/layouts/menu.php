<style>
    .navbar { 
        background: #0f172a; 
        padding: 15px 40px; 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); 
        position: sticky; 
        top: 0; 
        z-index: 100; 
        flex-wrap: wrap; /* Agar responsif di layar kecil */
        gap: 15px;
    }
    .navbar-brand { 
        color: white; 
        font-size: 22px; 
        font-weight: 800; 
        letter-spacing: 1px; 
        text-decoration: none; 
    }
    .navbar-brand span { color: #3b82f6; }
    .navbar-menu { 
        display: flex; 
        gap: 20px; 
        align-items: center; 
        flex-wrap: wrap;
    }
    .navbar-menu a { 
        color: #cbd5e1; 
        text-decoration: none; 
        font-size: 15px; 
        font-weight: 500; 
        transition: color 0.3s ease; 
    }
    .navbar-menu a:hover { color: #60a5fa; }
    .btn-logout { 
        background: #ef4444; 
        color: white !important; 
        padding: 8px 18px; 
        border-radius: 6px; 
        font-weight: 600 !important; 
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); 
        transition: transform 0.2s, background 0.2s !important; 
    }
    .btn-logout:hover { 
        transform: translateY(-2px); 
        background: #dc2626; 
    }
    .user-info { 
        color: #94a3b8; 
        font-size: 14px; 
        border-left: 1px solid #334155; 
        padding-left: 20px; 
    }
    .user-info b { color: #f8fafc; }
    .btn-signin { 
        background: #3b82f6; 
        color: white !important; 
        padding: 8px 20px; 
        border-radius: 6px; 
        font-weight: 600 !important; 
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3); 
        transition: transform 0.2s, background 0.2s !important; 
    }
    .btn-signin:hover { 
        transform: translateY(-2px); 
        background: #2563eb; 
    }
</style>

<nav class="navbar">
    <a href="<?= base_url('/') ?>" class="navbar-brand">Tim466<span>App</span></a>
    
    <div class="navbar-menu">
        <?php if (session('logged_in')) : ?>
            <a href="<?= base_url('dashboard') ?>"><i class="fa-solid fa-house me-1"></i>Dashboard</a>
       <!-- PERBAIKAN: Gunakan helper base_url() -->
            <a href="<?= base_url('jurnal') ?>"><i class="fa-solid fa-book-journal-whills me-1"></i>Jurnal PKL</a>
            <a href="<?= base_url('chat') ?>"><i class="fa-solid fa-comments me-1"></i>Chatroom</a>
            
            <?php 
                $role = session('role');
                if ($role === 'admin' || $role === 'petugas') : 
            ?>
                <a href="<?= base_url('jurnal/verifikasi') ?>"><i class="fa-solid fa-user-check me-1"></i>Verifikasi Jurnal</a>
                <a href="<?= base_url('users') ?>"><i class="fa-solid fa-users me-1"></i>Users</a>
            <?php endif; ?>
            
            <a href="<?= base_url('logout') ?>" class="btn-logout"><i class="fa-solid fa-right-from-bracket me-1"></i>Log Out</a>
            
            <div class="user-info">
                Halo, <b><?= esc(session('nama') ?? 'User'); ?></b> (<?= ucfirst(esc($role ?? '')); ?>)
            </div>
        <?php else : ?>
            <a href="<?= base_url('jurnal') ?>"><i class="fa-solid fa-book-journal-whills me-1"></i>Jurnal PKL</a>
            <a href="<?= base_url('login') ?>" class="btn-signin"><i class="fa-solid fa-right-to-bracket me-1"></i>Sign In</a>
        <?php endif; ?>
    </div>
</nav>