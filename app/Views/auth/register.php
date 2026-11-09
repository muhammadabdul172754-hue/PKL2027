<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tim466App</title>
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
        .register-left {
            flex: 1;
            background: linear-gradient(135deg, #0f172a 0%, #065f46 100%); /* Warna hijau gelap untuk Register */
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .register-left h1 { font-size: 3rem; font-weight: 800; margin-bottom: 20px; line-height: 1.2; }
        .register-left h1 span { color: #34d399; }
        .register-left p { font-size: 1.1rem; color: #d1fae5; line-height: 1.6; max-width: 400px; }

        /* BAGIAN KANAN (FORM REGISTER) */
        .register-right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
            background: white;
            overflow-y: auto;
        }
        .register-box { width: 100%; max-width: 400px; margin: auto; }
        .register-box h2 { font-size: 2rem; color: #0f172a; margin-bottom: 10px; font-weight: 800; }
        .register-box p.subtitle { color: #64748b; margin-bottom: 30px; font-size: 15px; }

        .form-group { margin-bottom: 15px; }
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
        .form-group input:focus { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); }

        .btn { 
            width: 100%; 
            padding: 14px; 
            background: #10b981; /* Tombol hijau */
            color: white; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-size: 16px; 
            font-weight: 600; 
            transition: background 0.3s;
            margin-top: 15px;
        }
        .btn:hover { background: #059669; }

        .alert { 
            color: #b91c1c; 
            background: #fee2e2; 
            border: 1px solid #fecaca; 
            padding: 12px; 
            border-radius: 8px; 
            margin-bottom: 20px; 
            font-size: 14px; 
        }
        .alert ul { margin: 0; padding-left: 20px; }

        .bottom-link { text-align: center; margin-top: 25px; font-size: 14px; color: #64748b; }
        .bottom-link a { color: #10b981; text-decoration: none; font-weight: 600; }
        .bottom-link a:hover { text-decoration: underline; }

        /* RESPONSIVE (Untuk HP) */
        @media (max-width: 768px) {
            .register-left { display: none; }
            body { background: #f1f5f9; }
            .register-right { background: transparent; padding: 15px; }
            .register-box { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        }

                /* --- ANIMASI REGISTER --- */
        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .register-box {
            animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .register-left h1 {
            animation: slideUpFade 0.8s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }
        .register-left p {
            animation: slideUpFade 0.8s ease-out forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }

        .btn {
            transition: transform 0.2s ease, background 0.3s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); /* Shadow hijau untuk register */
        }
    </style>
</head>
<body>

    <!-- Bagian Kiri -->
    <div class="register-left">
        <h1>Bergabunglah <br> Bersama <span>Tim466</span></h1>
        <p>Buat akun Anda sekarang untuk mulai mencatat jurnal PKL, melakukan presensi, dan berkomunikasi dengan tim.</p>
    </div>

    <!-- Bagian Kanan -->
    <div class="register-right">
        <div class="register-box">
            <h2>Buat Akun</h2>
            <p class="subtitle">Isi data diri Anda dengan lengkap.</p>
            
            <!-- Menampilkan error validasi (jika ada) -->
            <?php if(session()->getFlashdata('errors')): ?>
                <div class="alert">
                    <ul>
                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/register/process') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap..." value="<?= old('nama') ?>" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="contoh@email.com" value="<?= old('email') ?>" required>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Pilih username..." value="<?= old('username') ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter..." required>
                </div>
                
                <button type="submit" class="btn">Daftar Sekarang</button>
            </form>
            
            <div class="bottom-link">
                Sudah punya akun? <a href="<?= base_url('/login') ?>">Login di sini</a>
            </div>
        </div>
    </div>

</body>
</html>