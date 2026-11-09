<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Tim466 App' ?></title>
    <!-- Library Animasi AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Font Google (Inter) untuk tampilan modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <style>
        body { margin: 0; font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #1e293b; }
        a { transition: all 0.3s ease; }
        a:hover { opacity: 0.8; }
    </style>
</head>
<body>
    <?= $this->include('layouts/menu') ?>
    
    <main style="min-height: 80vh;">
        <?= $this->renderSection('content') ?>
    </main>

    <footer style="text-align: center; padding: 20px; color: #64748b; font-size: 14px; border-top: 1px solid #e2e8f0; margin-top: 40px;">
        &copy; <?= date('Y') ?> Tim466 App - Jurnal Kerja PKL.
    </footer>

    <!-- Script Animasi AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800, // Durasi animasi (milidetik)
            once: true,    // Animasi hanya jalan sekali
        });
    </script>
</body>
</html>