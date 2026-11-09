<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Tim466 App - Jurnal Kerja PKL') ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Library Animasi AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Font Google (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-dark-primary: #0f172a;
            --bg-dark-card: #1e293b;
            --border-color: #334155;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark-primary);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a {
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        a:hover {
            opacity: 0.85;
        }

        /* Card & UI Containers Dark Theme */
        .card {
            background-color: var(--bg-dark-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
        }

        /* Form Controls Dark Mode */
        .form-control, .form-select {
            background-color: #0f172a !important;
            border: 1px solid var(--border-color) !important;
            color: #f8fafc !important;
            border-radius: 8px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25) !important;
        }

        /* Badges untuk Status Verifikasi Jurnal */
        .badge-status-menunggu {
            background-color: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
            border: 1px solid #f59e0b;
        }

        .badge-status-disetujui {
            background-color: rgba(16, 185, 129, 0.2);
            color: #34d399;
            border: 1px solid #10b981;
        }

        .badge-status-ditolak {
            background-color: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border: 1px solid #ef4444;
        }

        /* Image Preview Box */
        .img-preview-box {
            max-height: 250px;
            border-radius: 8px;
            border: 2px dashed var(--border-color);
            object-fit: cover;
        }

        footer {
            margin-top: auto;
            text-align: center;
            padding: 20px;
            color: #94a3b8;
            font-size: 14px;
            border-top: 1px solid var(--border-color);
            background-color: var(--bg-dark-card);
        }
    </style>
</head>
<body>
    <!-- Include Menu Navbar -->
    <?= $this->include('layouts/menu') ?>
    
    <!-- Main Content Area -->
    <main class="container py-4" style="min-height: 80vh;">
        <!-- Alert Flashdata Notifikasi -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show border-0 bg-success bg-opacity-20 text-success mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i><?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show border-0 bg-danger bg-opacity-20 text-danger mb-4" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i><?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Dynamic Content Render -->
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer>
        &copy; <?= date('Y') ?> Tim466 App - Jurnal Kerja PKL.
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Script Animasi AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800, // Durasi animasi (ms)
            once: true,    // Animasi hanya berjalan sekali saat scroll
        });
    </script>
    
    <!-- Section Script Khusus per Halaman -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>