<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center" data-aos="zoom-in">
    <div class="col-lg-9">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-light mb-0"><i class="fa-solid fa-plus-circle text-primary me-2"></i>Tambah Jurnal PKL Baru</h4>
                <a href="<?= base_url('jurnal') ?>" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-arrow-left me-1"></i>Kembali</a>
            </div>

            <!-- PERBAIKAN: Diarahkan ke jurnal/store -->
            <form action="<?= base_url('jurnal/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label text-light">Tanggal Kegiatan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" value="<?= old('tanggal', date('Y-m-d')) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light">Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="time" name="waktu_mulai" class="form-control" value="<?= old('waktu_mulai') ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light">Waktu Selesai <span class="text-danger">*</span></label>
                        <input type="time" name="waktu_selesai" class="form-control" value="<?= old('waktu_selesai') ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">Judul Kegiatan <span class="text-danger">*</span></label>
                    <input type="text" name="judul_kegiatan" class="form-control" placeholder="Masukkan judul utama pekerjaan..." value="<?= old('judul_kegiatan') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">Kategori Pekerjaan <span class="text-danger">*</span></label>
                    <input type="text" name="kategori" class="form-control" placeholder="Contoh: Web Development, Network Engineering, System Support" value="<?= old('kategori') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">Deskripsi Kegiatan <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Uraikan alur kegiatan yang Anda kerjakan..." required><?= old('deskripsi') ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">Hasil Pekerjaan <span class="text-danger">*</span></label>
                    <textarea name="hasil" class="form-control" rows="2" placeholder="Uraikan output/hasil yang dicapai dari pekerjaan..." required><?= old('hasil') ?></textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-light">Kendala yang Dialami (Opsional)</label>
                        <textarea name="kendala" class="form-control" rows="2" placeholder="Sebutkan hambatan teknis yang dihadapi..."><?= old('kendala') ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light">Solusi yang Dilakukan (Opsional)</label>
                        <textarea name="solusi" class="form-control" rows="2" placeholder="Sebutkan tindakan penyelesaian masalah..."><?= old('solusi') ?></textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-light">Foto Dokumentasi Kegiatan <span class="text-danger">*</span></label>
                    <input type="file" name="foto" id="fotoInput" class="form-control" accept="image/png, image/jpeg, image/jpg" required>
                    <div class="form-text text-secondary">Format: JPG, JPEG, PNG. Maksimal ukuran 2MB.</div>

                    <div class="mt-3 text-center d-none" id="previewContainer">
                        <p class="small text-secondary mb-2">Preview Foto:</p>
                        <img id="previewImage" src="#" alt="Preview Dokumentasi" class="img-preview-box img-fluid">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top border-secondary pt-3">
                    <a href="<?= base_url('jurnal') ?>" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan Jurnal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const [file] = this.files;
    if (file) {
        const previewImage = document.getElementById('previewImage');
        const previewContainer = document.getElementById('previewContainer');
        previewImage.src = URL.createObjectURL(file);
        previewContainer.classList.remove('d-none');
    }
});
</script>
<?= $this->endSection() ?>