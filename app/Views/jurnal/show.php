<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="card p-4" data-aos="fade-up">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <span class="badge bg-secondary mb-2"><i class="fa-solid fa-tag me-1"></i><?= esc($jurnal['kategori']) ?></span>
            <h3 class="fw-bold text-light mb-0"><?= esc($jurnal['judul_kegiatan']) ?></h3>
        </div>
        <span class="badge badge-status-<?= strtolower($jurnal['status']) ?> fs-6 px-3 py-2"><?= $jurnal['status'] ?></span>
    </div>

    <hr class="border-secondary mb-4">

    <div class="row g-4">
        <div class="col-lg-6">
            <h6 class="fw-bold text-light mb-2"><i class="fa-solid fa-image me-2"></i>Foto Dokumentasi</h6>
            <img src="/uploads/jurnal/<?= esc($jurnal['foto']) ?>" class="img-fluid rounded border border-secondary w-100 shadow-sm" style="max-height: 420px; object-fit: cover;" alt="Dokumentasi Kegiatan">
        </div>

        <div class="col-lg-6">
            <table class="table table-dark table-borderless mb-4">
                <tr>
                    <th width="30%" class="text-secondary">Tanggal</th>
                    <td>: <?= date('d F Y', strtotime($jurnal['tanggal'])) ?></td>
                </tr>
                <tr>
                    <th class="text-secondary">Waktu Kerja</th>
                    <td>: <?= esc($jurnal['waktu_mulai']) ?> - <?= esc($jurnal['waktu_selesai']) ?> WIB</td>
                </tr>
            </table>

            <div class="mb-3">
                <h6 class="fw-bold text-light mb-1"><i class="fa-solid fa-file-lines me-2"></i>Deskripsi Pekerjaan</h6>
                <p class="text-secondary"><?= nl2br(esc($jurnal['deskripsi'])) ?></p>
            </div>

            <div class="mb-3">
                <h6 class="fw-bold text-light mb-1"><i class="fa-solid fa-square-poll-vertical me-2"></i>Hasil Pekerjaan</h6>
                <p class="text-secondary"><?= nl2br(esc($jurnal['hasil'])) ?></p>
            </div>

            <?php if ($jurnal['kendala'] || $jurnal['solusi']): ?>
                <div class="mb-3 p-3 bg-slate-900 border border-secondary rounded">
                    <h6 class="fw-bold text-warning mb-2"><i class="fa-solid fa-triangle-exclamation me-2"></i>Kendala & Solusi</h6>
                    <p class="text-secondary small mb-1"><strong>Kendala:</strong> <?= esc($jurnal['kendala'] ?: '-') ?></p>
                    <p class="text-secondary small mb-0"><strong>Solusi:</strong> <?= esc($jurnal['solusi'] ?: '-') ?></p>
                </div>
            <?php endif; ?>

            <?php if ($jurnal['catatan_guru']): ?>
                <div class="alert alert-info bg-opacity-10 border-info text-info mt-3">
                    <h6 class="fw-bold mb-1"><i class="fa-solid fa-comment-dots me-2"></i>Catatan Pembimbing:</h6>
                    <p class="mb-0 small"><?= nl2br(esc($jurnal['catatan_guru'])) ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center border-top border-secondary pt-3 mt-4">
        <a href="/jurnal" class="btn btn-secondary px-4"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
        <?php if ($jurnal['status'] !== 'Disetujui'): ?>
            <a href="/jurnal/edit/<?= $jurnal['id'] ?>" class="btn btn-warning px-4"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Jurnal</a>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>