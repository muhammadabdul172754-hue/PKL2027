<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    /* ANIMASI BACKGROUND HERO */
    .hero-section {
        background: linear-gradient(-45deg, #0f172a, #1e3a8a, #0f172a, #3b82f6);
        background-size: 400% 400%;
        animation: gradientBG 10s ease infinite;
        color: white; 
        padding: 140px 20px; 
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* ANIMASI KARTU HOVER */
    .card-hover {
        background: white; 
        padding: 30px; 
        border-radius: 15px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    /* ANIMASI TEAM CARD */
    .team-card {
        display: block; 
        background: white; 
        padding: 30px 20px; 
        border-radius: 15px; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.05); 
        text-decoration: none; 
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }
    .team-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 15px 30px rgba(59, 130, 246, 0.15);
        border-color: #3b82f6;
    }
</style>

<!-- HERO SECTION -->
<div class="hero-section">
    <div data-aos="fade-up" data-aos-duration="1000">
        <h1 style="font-size: 4rem; margin-bottom: 20px; font-weight: 800; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">Selamat Datang di <span style="color: #60a5fa;">Tim466App</span></h1>
        <p style="font-size: 1.3rem; color: #e2e8f0; max-width: 700px; margin: 0 auto; line-height: 1.6;" data-aos="fade-up" data-aos-delay="200">
            Solusi modern untuk manajemen Jurnal Kerja PKL. Kelola aktivitas, presensi, tugas, dan komunikasi tim dalam satu platform terpadu.
        </p>
    </div>
</div>

<!-- FITUR SECTION -->
<div style="padding: 100px 20px; max-width: 1200px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 70px;" data-aos="fade-up">
        <h2 style="font-size: 2.5rem; color: #0f172a; margin-bottom: 15px; font-weight: 800;">Fitur Unggulan</h2>
        <p style="color: #64748b; font-size: 1.1rem;">Semua yang kamu butuhkan untuk kelancaran PKL.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
        
        <!-- Fitur 1 -->
        <div class="card-hover" data-aos="fade-up" data-aos-delay="100" style="border-top: 4px solid #3b82f6;">
            <h3 style="margin-top: 0; color: #0f172a; font-size: 1.3rem;">Jurnal Aktivitas</h3>
            <p style="color: #64748b; line-height: 1.6;">Catat setiap pekerjaan PKL kamu lengkap dengan foto dokumentasi sebagai bukti nyata.</p>
        </div>
        
        <!-- Fitur 2 -->
        <div class="card-hover" data-aos="fade-up" data-aos-delay="200" style="border-top: 4px solid #10b981;">
            <h3 style="margin-top: 0; color: #0f172a; font-size: 1.3rem;">Sistem Presensi</h3>
            <p style="color: #64748b; line-height: 1.6;">Lakukan absensi harian dengan mudah. Pantau kehadiranmu selama masa PKL berlangsung.</p>
        </div>
        
        <!-- Fitur 3 -->
        <div class="card-hover" data-aos="fade-up" data-aos-delay="300" style="border-top: 4px solid #8b5cf6;">
            <h3 style="margin-top: 0; color: #0f172a; font-size: 1.3rem;">Chatroom Tim</h3>
            <p style="color: #64748b; line-height: 1.6;">Komunikasi real-time antar anggota. Bisa hapus pesan dan kutip balasan dengan rapi.</p>
        </div>
        
        <!-- Fitur 4 -->
        <div class="card-hover" data-aos="fade-up" data-aos-delay="400" style="border-top: 4px solid #f59e0b;">
            <h3 style="margin-top: 0; color: #0f172a; font-size: 1.3rem;">Task Planner</h3>
            <p style="color: #64748b; line-height: 1.6;">Manajemen tugas harian yang terorganisir. Atur prioritas dan pantau progres pekerjaan PKL kamu.</p>
        </div>
    </div>
</div>

<!-- TEAM SECTION -->
<div style="background: #f1f5f9; padding: 100px 20px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 70px;" data-aos="fade-up">
            <h2 style="font-size: 2.5rem; color: #0f172a; margin-bottom: 15px; font-weight: 800;">Tim Pengembang</h2>
            <p style="color: #64748b; font-size: 1.1rem;">5 orang hebat di balik aplikasi ini. Klik untuk melihat profil.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; text-align: center;">
            
            <!-- Anggota 1 -->
            <a href="<?= base_url('/tim/abdul') ?>" class="team-card" data-aos="zoom-in" data-aos-delay="100">
                <img src="<?= base_url('uploads/img/kholiq1.webp') ?>" alt="Abdul" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin: 0 auto 20px auto; display: block; border: 4px solid #e2e8f0;">
                <h4 style="margin: 0 0 8px 0; color: #1e293b; font-size: 1.1rem;">Muhammad Abdul Kholiq</h4>
                <p style="color: #3b82f6; font-size: 14px; margin: 0; font-weight: 600;">Frontend Dev</p>
            </a>

            <!-- Anggota 2 -->
            <a href="<?= base_url('/tim/wildan') ?>" class="team-card" data-aos="zoom-in" data-aos-delay="200">
                <img src="<?= base_url('uploads/img/wildan1.jpg') ?>" alt="Wildan" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin: 0 auto 20px auto; display: block; border: 4px solid #e2e8f0;">
                <h4 style="margin: 0 0 8px 0; color: #1e293b; font-size: 1.1rem;">Wildan Azmi Muzaki</h4>
                <p style="color: #3b82f6; font-size: 14px; margin: 0; font-weight: 600;">Backend Dev</p>
            </a>

            <!-- Anggota 3 -->
            <a href="<?= base_url('/tim/gumelar') ?>" class="team-card" data-aos="zoom-in" data-aos-delay="300">
                <img src="<?= base_url('uploads/img/gumelar1.jpg') ?>" alt="Gumelar" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin: 0 auto 20px auto; display: block; border: 4px solid #e2e8f0;">
                <h4 style="margin: 0 0 8px 0; color: #1e293b; font-size: 1.1rem;">Gumelar Ramadhan Nugraha</h4>
                <p style="color: #3b82f6; font-size: 14px; margin: 0; font-weight: 600;">UI/UX Designer</p>
            </a>

            <!-- Anggota 4 -->
            <a href="<?= base_url('/tim/arya') ?>" class="team-card" data-aos="zoom-in" data-aos-delay="400">
                <img src="<?= base_url('uploads/img/arya1.jpg') ?>" alt="Arya" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin: 0 auto 20px auto; display: block; border: 4px solid #e2e8f0;">
                <h4 style="margin: 0 0 8px 0; color: #1e293b; font-size: 1.1rem;">Muhammad Arya Agustira</h4>
                <p style="color: #3b82f6; font-size: 14px; margin: 0; font-weight: 600;">QA / Tester</p>
            </a>

            <!-- Anggota 5 -->
            <a href="<?= base_url('/tim/nandra') ?>" class="team-card" data-aos="zoom-in" data-aos-delay="500">
                <img src="<?= base_url('uploads/img/nandra1.jpg') ?>" alt="Nandra" style="width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin: 0 auto 20px auto; display: block; border: 4px solid #e2e8f0;">
                <h4 style="margin: 0 0 8px 0; color: #1e293b; font-size: 1.1rem;">Nandra Rizky Al-Fauzan</h4>
                <p style="color: #3b82f6; font-size: 14px; margin: 0; font-weight: 600;">Project Manager</p>
            </a>

        </div>
    </div>
</div>

<!-- TOMBOL CHAT MENGAMBANG -->
<?php if (session()->get('logged_in')) : ?>
<style>
    @keyframes floatAnimation {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); } /* Mengambang ke atas 15px */
        100% { transform: translateY(0px); }
    }

    .floating-chat-btn {
        position: fixed;
        bottom: 40px;
        right: 40px;
        background-color: #10b981; /* Warna hijau */
        color: white;
        width: 65px;
        height: 65px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        text-decoration: none;
        z-index: 1000;
        animation: floatAnimation 3s ease-in-out infinite; /* Animasi mengambang tanpa henti */
        transition: background-color 0.3s, transform 0.3s;
    }

    .floating-chat-btn:hover {
        background-color: #059669; /* Warna agak gelap saat di-hover */
        animation-play-state: paused; /* Berhenti mengambang saat disentuh kursor */
        transform: scale(1.1); /* Sedikit membesar */
    }

    .floating-chat-btn svg {
        width: 32px;
        height: 32px;
        fill: currentColor;
    }
</style>

<!-- Ganti href jika rute chatroom kamu berbeda -->
<a href="<?= base_url('/chat') ?>" class="floating-chat-btn" title="Buka Chatroom">
    <!-- Ikon Chat (SVG) -->
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12z"/>
        <path d="M7 9h10v2H7zm0-4h10v2H7z"/>
    </svg>
</a>
<?php endif; ?>


<?= $this->endSection() ?>