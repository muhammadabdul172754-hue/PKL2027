<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h3 class="fw-bold mb-1 text-light"><i class="fa-solid fa-book-journal-whills text-primary me-2"></i>Jurnal Kerja PKL</h3>
        <p class="text-secondary small mb-0">Kelola dan pantau seluruh catatan kegiatan harian PKL Anda</p>
    </div>
    <!-- PERBAIKAN: Gunakan base_url() -->
    <a href="<?= base_url('jurnal/create') ?>" class="btn btn-primary px-3 shadow-sm"><i class="fa-solid fa-plus me-2"></i>Tambah Jurnal</a>
</div>

<!-- Form Filter & Pencarian -->
<div class="card p-3 mb-4" data-aos="fade-up">
    <!-- PERBAIKAN: Gunakan base_url() pada action form -->
    <form method="GET" action="<?= base_url('jurnal') ?>" class="row g-3">
        <div class="col-md-4">
            <label class="form-label small text-secondary">Pencarian</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Cari judul, deskripsi, atau kategori..." value="<?= esc($search) ?>">
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label small text-secondary">Filter Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="<?= esc($tanggal) ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label small text-secondary">Filter Status</label>
            <select name="status" class="form-select">
                <option value="">-- Semua Status --</option>
                <option value="Menunggu" <?= $status === 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                <option value="Disetujui" <?= $status === 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
                <option value="Ditolak" <?= $status === 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-filter me-1"></i>Filter</button>
            <!-- PERBAIKAN: Gunakan base_url() -->
            <a href="<?= base_url('jurnal') ?>" class="btn btn-outline-secondary w-100"><i class="fa-solid fa-rotate-right"></i></a>
        </div>
    </form>
</div>

<!-- Grid Card Daftar Jurnal -->
<div class="row g-4">
    <?php if (empty($jurnal)): ?>
        <div class="col-12 py-5 text-center" data-aos="zoom-in">
            <i class="fa-solid fa-folder-open text-secondary fa-3x mb-3"></i>
            <h5 class="text-secondary">Belum ada jurnal kerja yang ditemukan</h5>
            <p class="text-secondary small">Silakan tambah jurnal kegiatan baru Anda.</p>
        </div>
    <?php else: ?>
        <?php foreach ($jurnal as $index => $item): ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                <div class="card h-100 overflow-hidden shadow-sm">
                    <!-- PERBAIKAN: Path foto menggunakan base_url() -->
                    <img src="<?= base_url('uploads/jurnal/' . esc($item['foto'])) ?>" class="card-img-top" style="height: 190px; object-fit: cover;" alt="<?= esc($item['judul_kegiatan']) ?>">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-status-<?= strtolower($item['status']) ?> px-2 py-1"><?= $item['status'] ?></span>
                            <small class="text-secondary"><i class="fa-regular fa-calendar me-1"></i><?= date('d M Y', strtotime($item['tanggal'])) ?></small>
                        </div>
                        <h5 class="card-title text-truncate text-light mb-1"><?= esc($item['judul_kegiatan']) ?></h5>
                        <p class="text-primary small mb-2"><i class="fa-solid fa-tag me-1"></i><?= esc($item['kategori']) ?></p>
                        <p class="card-text text-secondary small text-truncate"><?= esc($item['deskripsi']) ?></p>
                    </div>
                    <div class="card-footer bg-transparent border-top border-secondary d-flex justify-content-between align-items-center">
                        <!-- PERBAIKAN: Link Detail -->
                        <a href="<?= base_url('jurnal/show/' . $item['id']) ?>" class="btn btn-sm btn-info text-white"><i class="fa-solid fa-eye me-1"></i>Detail</a>
                        <?php if ($item['status'] !== 'Disetujui'): ?>
                            <div class="btn-group">
                                <!-- PERBAIKAN: Link Edit -->
                                <a href="<?= base_url('jurnal/edit/' . $item['id']) ?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button onclick="confirmDelete(<?= $item['id'] ?>)" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Jurnal?',
        text: 'Data dan file foto dokumentasi akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Ya, Hapus Jurnal!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // PERBAIKAN: URL hapus dinamis mengikuti base_url
            window.location.href = `<?= base_url('jurnal/delete') ?>/${id}`;
        }
    });
}
</script>
<?= $this->endSection() ?>