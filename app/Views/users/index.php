<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div style="max-width: 1100px; margin: 40px auto; padding: 20px;" data-aos="fade-up">
    
    <!-- Header & Tombol Tambah -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0; color: #0f172a; font-weight: 800;">Data Users</h2>
        <a href="<?= base_url('/users/create') ?>" style="background: #3b82f6; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px;">+ Tambah User</a>
    </div>

    <!-- Kotak Pencarian & Filter -->
    <div style="background: white; padding: 15px 20px; border-radius: 10px 10px 0 0; border-bottom: 1px solid #e2e8f0; display: flex; gap: 15px; align-items: center;">
        <form action="<?= base_url('/users') ?>" method="get" style="display: flex; gap: 10px; margin: 0; width: 100%;">
            <input type="text" name="cari" placeholder="Cari nama..." value="<?= $_GET['cari'] ?? '' ?>" style="padding: 8px 15px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; flex: 1; max-width: 300px;">
            
            <select name="role" style="padding: 8px 15px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none;">
                <option value="">-- Semua Role --</option>
                <option value="admin" <?= (isset($_GET['role']) && $_GET['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                <option value="petugas" <?= (isset($_GET['role']) && $_GET['role'] == 'petugas') ? 'selected' : '' ?>>Petugas</option>
                <option value="anggota" <?= (isset($_GET['role']) && $_GET['role'] == 'anggota') ? 'selected' : '' ?>>Anggota</option>
            </select>
            
            <button type="submit" style="padding: 8px 20px; background: #0f172a; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;">Cari</button>
            <a href="<?= base_url('/users') ?>" style="padding: 8px 15px; background: #f1f5f9; color: #334155; border-radius: 6px; text-decoration: none; font-size: 14px;">Reset</a>
            <a href="<?= base_url('/users/print') ?>" style="padding: 8px 15px; background: #10b981; color: white; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: bold;">Print</a>
        </form>
    </div>

    <!-- Tabel Data -->
    <div style="background: white; border-radius: 0 0 10px 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 15px; color: #475569; font-weight: 600; font-size: 14px;">No</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; font-size: 14px;">Nama</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; font-size: 14px;">Email</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; font-size: 14px;">Username</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; font-size: 14px;">Role</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; font-size: 14px;">Foto</th>
                    <th style="padding: 15px; color: #475569; font-weight: 600; font-size: 14px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($users as $u) : ?>
                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                    <td style="padding: 15px; color: #334155;"><?= $no++ ?></td>
                    <td style="padding: 15px; color: #0f172a; font-weight: 600;"><?= $u['nama'] ?></td>
                    <td style="padding: 15px; color: #475569;"><?= $u['email'] ?></td>
                    <td style="padding: 15px; color: #475569;"><?= $u['username'] ?></td>
                    <td style="padding: 15px;">
                        <?php 
                            $roleColor = '#3b82f6'; // default biru
                            if($u['role'] == 'admin') $roleColor = '#ef4444'; // merah
                            if($u['role'] == 'petugas') $roleColor = '#f59e0b'; // kuning
                            if($u['role'] == 'anggota') $roleColor = '#10b981'; // hijau
                        ?>
                        <span style="background: <?= $roleColor ?>20; color: <?= $roleColor ?>; padding: 5px 10px; border-radius: 50px; font-size: 12px; font-weight: bold; text-transform: capitalize;">
                            <?= $u['role'] ?>
                        </span>
                    </td>
                    <td style="padding: 15px;">
                        <?php if($u['foto']) : ?>
                            <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" alt="Foto" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        <?php else : ?>
                            <span style="color: #94a3b8; font-size: 12px;">-</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding: 15px; text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <a href="<?= base_url('users/detail/'.$u['id']) ?>" style="padding: 6px 12px; background: #e0e7ff; color: #4338ca; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: bold;">Detail</a>
                            <a href="<?= base_url('users/edit/'.$u['id']) ?>" style="padding: 6px 12px; background: #fef3c7; color: #b45309; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: bold;">Edit</a>
                            <a href="<?= base_url('users/delete/'.$u['id']) ?>" onclick="return confirm('Yakin ingin menghapus user ini?')" style="padding: 6px 12px; background: #fee2e2; color: #b91c1c; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: bold;">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination (Jika ada) -->
    <div style="margin-top: 20px; display: flex; justify-content: center;">
        <?= $pager->links() ?? '' ?>
    </div>

</div>
<?= $this->endSection() ?>