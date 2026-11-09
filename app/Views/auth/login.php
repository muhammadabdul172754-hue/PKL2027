<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tim466App</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Inter', sans-serif; 
            height: 100vh; 
            display: flex; 
            background-color: #f8fafc;
        }

        /* BAGIAN KIRI (DESAIN VISUAL) */
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .login-left h1 { font-size: 3rem; font-weight: 800; margin-bottom: 20px; line-height: 1.2; }
        .login-left h1 span { color: #60a5fa; }
        .login-left p { font-size: 1.1rem; color: #cbd5e1; line-height: 1.6; max-width: 400px; }

        /* BAGIAN KANAN (FORM LOGIN) */
        .login-right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            background: white;
        }
        .login-box { width: 100%; max-width: 400px; }
        .login-box h2 { font-size: 2rem; color: #0f172a; margin-bottom: 10px; font-weight: 800; }
        .login-box p.subtitle { color: #64748b; margin-bottom: 30px; font-size: 15px; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 14px; font-weight: 600; color: #334155; }
        .form-group input { 
            width: 100%; 
            padding: 12px 15px; 
            border: 1px solid #cbd5e1; 
            border-radius: 8px; 
            font-size: 15px; 
            outline: none; 
            transition: border 0.3s;
            font-family: 'Inter', sans-serif;
        }
        .form-group input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }

        .btn { 
            width: 100%; 
            padding: 14px; 
            background: #3b82f6; 
            color: white; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-size: 16px; 
            font-weight: 600; 
            transition: background 0.3s;
            margin-top: 10px;
        }
        .btn:hover { background: #2563eb; }

        .alert { 
            color: #b91c1c; 
            background: #fee2e2; 
            border: 1px solid #fecaca; 
            padding: 12px; 
            border-radius: 8px; 
            margin-bottom: 20px; 
            font-size: 14px; 
            text-align: center; 
        }

        .bottom-link { text-align: center; margin-top: 25px; font-size: 14px; color: #64748b; }
        .bottom-link a { color: #3b82f6; text-decoration: none; font-weight: 600; }
        .bottom-link a:hover { text-decoration: underline; }

        /* RESPONSIVE (Untuk HP) */
        @media (max-width: 768px) {
            .login-left { display: none; } /* Sembunyikan bagian kiri di HP */
            body { background: #f1f5f9; }
            .login-right { background: transparent; }
            .login-box { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        }

                /* --- ANIMASI LOGIN --- */
        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .login-box {
            animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .login-left h1 {
            animation: slideUpFade 0.8s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0; /* Mulai dari transparan */
        }
        .login-left p {
            animation: slideUpFade 0.8s ease-out forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }

        .btn {
            transition: transform 0.2s ease, background 0.3s;
        }
        .btn:hover {
            transform: translateY(-2px); /* Tombol naik sedikit saat di-hover */
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body>

    <!-- Bagian Kiri -->
    <div class="login-left">
        <h1>Selamat Datang di <br> <span>Tim466App</span></h1>
        <p>Platform terpadu untuk manajemen Jurnal Kerja PKL. Kelola aktivitas, presensi, dan komunikasi tim dalam satu tempat.</p>
    </div>

    <!-- Bagian Kanan -->
    <div class="login-right">
        <div class="login-box">
            <h2>Sign In</h2>
            <p class="subtitle">Masukkan kredensial Anda untuk melanjutkan.</p>
            
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert" style="color: #15803d; background: #dcfce7; border-color: #bbf7d0;">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/login/process') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan username..." required autofocus>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password..." required>
                </div>
                
                <button type="submit" class="btn">Sign In</button>
            </form>
            
            <div class="bottom-link">
                Belum punya akun? <a href="<?= base_url('/register') ?>">Daftar di sini</a>
            </div>
        </div>
    </div>

</body>
</html>