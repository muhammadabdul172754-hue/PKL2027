<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div style="max-width: 900px; margin: 50px auto; background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden;" data-aos="fade-up">
    
    <!-- Header / Bagian Kiri -->
    <div style="background: #0f172a; padding: 40px; text-align: center; color: white;">
        <img src="<?= base_url('uploads/img/kholiq1.webp') ?>" alt="Abdul" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #3b82f6; margin-bottom: 20px;">
        <h1 style="margin: 0 0 10px 0; font-size: 2rem;">Muhammad Abdul Kholiq</h1>
        <p style="color: #60a5fa; font-size: 18px; font-weight: 600; margin-bottom: 20px;">Frontend Developer</p>
        
        <!-- Sosmed Buttons -->
        <div style="display: flex; justify-content: center; gap: 15px;">
            <a href="https://instagram.com/orang.bias4_" target="_blank" style="background: #e1306c; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold;">Instagram</a>
            <a href="https://github.com/muhammadabdul172754-hue" target="_blank" style="background: #333; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold;">GitHub</a>
            <a href="https://wa.me/6281234567890" target="_blank" style="background: #25d366; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold;">WhatsApp</a>
        </div>
    </div>

    <!-- Body / Bagian Bawah (Data Diri) -->
    <div style="padding: 40px;">
        <h3 style="color: #0f172a; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-top: 0;">Tentang Saya</h3>
        <p style="color: #475569; line-height: 1.8; font-size: 16px;">
            Halo! Saya Abdul, penanggung jawab bagian tampilan (Frontend) di Tim466App. Di proyek PKL ini, saya fokus membangun antarmuka yang modern, responsif, dan beranimasi agar aplikasi jurnal kerja ini nyaman digunakan oleh para peserta PKL. Selain itu, saya juga dipercaya untuk mengembangkan fitur Chatroom!
        </p>

        <h3 style="color: #0f172a; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-top: 30px;">Data Pribadi</h3>
        
        <table style="width: 100%; border-collapse: collapse; font-size: 15px;">
            <tr>
                <td style="padding: 12px 0; width: 200px; color: #64748b; font-weight: 600;">Nama Lengkap</td>
                <td style="padding: 12px 0; color: #1e293b;">: Muhammad Abdul Kholiq</td>
            </tr>
            <tr>
                <td style="padding: 12px 0; color: #64748b; font-weight: 600;">Tempat, Tanggal Lahir</td>
                <td style="padding: 12px 0; color: #1e293b;">: Sumedang, 29 Oktober 2008</td>
            </tr>
            <tr>
                <td style="padding: 12px 0; color: #64748b; font-weight: 600;">Jenis Kelamin</td>
                <td style="padding: 12px 0; color: #1e293b;">: Laki-laki</td>
            </tr>
            <tr>
                <td style="padding: 12px 0; color: #64748b; font-weight: 600;">Alamat Lengkap</td>
                <td style="padding: 12px 0; color: #1e293b;">: Link. Gending Rt 05/ Rw 06 Kel. Kota Kulon, Kec. Sumedang Selatan, Kab. Sumedang</td>
            </tr>
            <tr>
                <td style="padding: 12px 0; color: #64748b; font-weight: 600;">Email</td>
                <td style="padding: 12px 0; color: #1e293b;">: aabdulkholiq9@gmail.com</td>
            </tr>
            <tr>
                <td style="padding: 12px 0; color: #64748b; font-weight: 600;">Asal Sekolah/Kampus</td>
                <td style="padding: 12px 0; color: #1e293b;">: SMKS Al-Mamun Sumedang</td>
            </tr>
            <tr>
                <td style="padding: 12px 0; color: #64748b; font-weight: 600;">Hobi</td>
                <td style="padding: 12px 0; color: #1e293b;">: Ngoding, Main Game, Desain</td>
            </tr>
        </table>

        <!-- Tombol Kembali -->
        <div style="text-align: center; margin-top: 40px;">
            <a href="<?= base_url('/') ?>" style="display: inline-block; background: #3b82f6; color: white; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: bold;">← Kembali ke Landing Page</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>