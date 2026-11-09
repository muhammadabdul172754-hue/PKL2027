<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center" data-aos="zoom-in">
    <div class="col-lg-9">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-light mb-0"><i class="fa-solid fa-pen-to-square text-warning me-2"></i>Edit Jurnal PKL</h4>
                <a href="/jurnal" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-arrow-left me-1"></i>Kembali</a>
            </div>

            <form action="/jurnal/update/<?= $jurnal['id'] ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label text-light">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= old('tanggal', $jurnal['tanggal']) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" class="form-control" value="<?= old('waktu_mulai', $jurnal['waktu_mulai']) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-light">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control" value="<?= old('waktu_selesai', $jurnal['waktu_selesai']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">Judul Kegiatan</label>
                    <input type="text" name="judul_kegiatan" class="form-control" value="<?= old('judul_kegiatan', $jurnal['judul_kegiatan']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">Kategori Pekerjaan</label>
                    <input type="text" name="kategori" class="form-control" value="<?= old('kategori', $jurnal['kategori']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">Deskripsi Kegiatan</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required><?= old('deskripsi', $jurnal['deskripsi']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-light">Hasil Pekerjaan</label>
                    <textarea name="hasil" class="form-control" rows="2" required><?= old('hasil', $jurnal['hasil']) ?></textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-light">Kendala</label>
                        <textarea name="kendala" class="form-control" rows="2"><?= old('kendala', $jurnal['kendala']) ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-light">Solusi</label>
                        <textarea name="solusi" class="form-control" rows="2"><?= old('solusi', $jurnal['solusi']) ?></textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-light">Ganti Foto Dokumentasi (Biarkan kosong jika tidak diganti)</label>
                    <input type="file" name="foto" id="fotoInput" class="form-control" accept="image/png, image/jpeg, image/jpg">
                    
                    <div class="mt-3 text-center" id="previewContainer">
                        <p class="small text-secondary mb-2">Foto Saat Ini / Preview:</p>
                        <img id="previewImage" src="/uploads/jurnal/<?= esc($jurnal['foto']) ?>" alt="Dokumentasi" class="img-preview-box img-fluid">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top border-secondary pt-3">
                    <a href="/jurnal" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-warning px-4"><i class="fa-solid fa-square-check me-1"></i>Perbarui Jurnal</button>
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
        document.getElementById('previewImage').src = URL.createObjectURL(file);
    }
});
</script>
<?= $this->endSection() ?>