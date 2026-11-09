<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
    <div>
        <h3 class="fw-bold text-light mb-1"><i class="fa-solid fa-user-check text-success me-2"></i>Verifikasi Jurnal Siswa</h3>
        <p class="text-secondary small mb-0">Tinjau dan berikan persetujuan serta catatan jurnal kerja siswa bimbingan</p>
    </div>
</div>

<div class="card p-3" data-aos="fade-up">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead>
                <tr class="border-secondary text-secondary">
                    <th>Tanggal</th>
                    <th>Kegiatan & Kategori</th>
                    <th>Dokumentasi</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($jurnal)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-secondary">Belum ada entri jurnal siswa.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($jurnal as $row): ?>
                        <tr class="border-secondary">
                            <td><i class="fa-regular fa-calendar me-2 text-secondary"></i><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                            <td>
                                <strong class="text-light d-block"><?= esc($row['judul_kegiatan']) ?></strong>
                                <span class="badge bg-secondary"><?= esc($row['kategori']) ?></span>
                            </td>
                            <td>
                                <!-- PERBAIKAN: Gunakan base_url() untuk gambar -->
                                <a href="<?= base_url('uploads/jurnal/' . esc($row['foto'])) ?>" target="_blank">
                                    <img src="<?= base_url('uploads/jurnal/' . esc($row['foto'])) ?>" width="60" height="45" class="rounded border border-secondary" style="object-fit: cover;">
                                </a>
                            </td>
                            <td>
                                <span class="badge badge-status-<?= strtolower($row['status']) ?>"><?= $row['status'] ?></span>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-primary px-3" data-bs-toggle="modal" data-bs-target="#verifModal<?= $row['id'] ?>">
                                    <i class="fa-solid fa-pen-to-square me-1"></i>Review
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- PERBAIKAN: Modal Diletakkan di Luar Tabel -->
<?php if (!empty($jurnal)): ?>
    <?php foreach ($jurnal as $row): ?>
        <div class="modal fade" id="verifModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-dark text-light border-secondary">
                    <!-- PERBAIKAN: Gunakan base_url() pada action form -->
                    <form action="<?= base_url('jurnal/verifikasi-update/' . $row['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="modal-header border-secondary">
                            <h5 class="modal-title fw-bold"><i class="fa-solid fa-clipboard-check text-primary me-2"></i>Verifikasi Jurnal</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label text-secondary">Pilih Status Verifikasi</label>
                                <select name="status" class="form-select" required>
                                    <option value="Disetujui" <?= $row['status'] === 'Disetujui' ? 'selected' : '' ?>>Disetujui</option>
                                    <option value="Ditolak" <?= $row['status'] === 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                    <option value="Menunggu" <?= $row['status'] === 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-secondary">Catatan Guru Pembimbing</label>
                                <textarea name="catatan_guru" class="form-control" rows="3" placeholder="Tuliskan umpan balik atau saran koreksi..."><?= esc($row['catatan_guru']) ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer border-secondary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-check me-1"></i>Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>