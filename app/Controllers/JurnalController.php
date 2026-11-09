<?php

namespace App\Controllers;

use App\Models\JurnalModel;

class JurnalController extends BaseController
{
    protected $jurnalModel;

    public function __construct()
    {
        $this->jurnalModel = new JurnalModel();
    }

    public function index()
    {
        $userId  = session()->get('user_id') ?? 1;
        $search  = $this->request->getGet('search');
        $tanggal = $this->request->getGet('tanggal');
        $status  = $this->request->getGet('status');

        $data = [
            'title'   => 'Daftar Jurnal Kerja PKL',
            'jurnal'  => $this->jurnalModel->getFilteredJurnal($userId, $search, $tanggal, $status),
            'search'  => $search,
            'tanggal' => $tanggal,
            'status'  => $status,
        ];

        return view('jurnal/index', $data);
    }

    public function create()
    {
        return view('jurnal/create', ['title' => 'Tambah Jurnal PKL']);
    }

    public function store()
    {
        $rules = [
            'tanggal'        => 'required|valid_date',
            'waktu_mulai'    => 'required',
            'waktu_selesai'  => 'required',
            'judul_kegiatan' => 'required|min_length[5]|max_length[255]',
            'kategori'       => 'required',
            'deskripsi'      => 'required',
            'hasil'          => 'required',
            'foto'           => 'uploaded[foto]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileFoto = $this->request->getFile('foto');
        $namaFoto = $fileFoto->getRandomName();
        $fileFoto->move(FCPATH . 'uploads/jurnal', $namaFoto);

        $this->jurnalModel->save([
            'user_id'        => session()->get('user_id') ?? 1,
            'tanggal'        => $this->request->getPost('tanggal'),
            'waktu_mulai'    => $this->request->getPost('waktu_mulai'),
            'waktu_selesai'  => $this->request->getPost('waktu_selesai'),
            'judul_kegiatan' => $this->request->getPost('judul_kegiatan'),
            'kategori'       => $this->request->getPost('kategori'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'hasil'          => $this->request->getPost('hasil'),
            'kendala'        => $this->request->getPost('kendala'),
            'solusi'         => $this->request->getPost('solusi'),
            'foto'           => $namaFoto,
            'status'         => 'Menunggu'
        ]);

        // PERBAIKAN: Gunakan base_url()
        return redirect()->to(base_url('jurnal'))->with('success', 'Jurnal berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jurnal = $this->jurnalModel->find($id);

        if (!$jurnal) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Jurnal tidak ditemukan.');
        }

        return view('jurnal/show', [
            'title'  => 'Detail Jurnal PKL',
            'jurnal' => $jurnal
        ]);
    }

    public function edit($id)
    {
        $jurnal = $this->jurnalModel->find($id);

        if (!$jurnal) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ($jurnal['status'] === 'Disetujui') {
            // PERBAIKAN: Gunakan base_url()
            return redirect()->to(base_url('jurnal'))->with('error', 'Jurnal yang telah disetujui tidak dapat diubah.');
        }

        return view('jurnal/edit', [
            'title'  => 'Edit Jurnal PKL',
            'jurnal' => $jurnal
        ]);
    }

    public function update($id)
    {
        $jurnal = $this->jurnalModel->find($id);

        if (!$jurnal || $jurnal['status'] === 'Disetujui') {
            // PERBAIKAN: Gunakan base_url()
            return redirect()->to(base_url('jurnal'))->with('error', 'Akses ditolak.');
        }

        $rules = [
            'tanggal'        => 'required|valid_date',
            'waktu_mulai'    => 'required',
            'waktu_selesai'  => 'required',
            'judul_kegiatan' => 'required|min_length[5]|max_length[255]',
            'kategori'       => 'required',
            'deskripsi'      => 'required',
            'hasil'          => 'required',
            'foto'           => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileFoto = $this->request->getFile('foto');
        $namaFoto = $jurnal['foto'];

        if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
            if (!empty($jurnal['foto']) && file_exists(FCPATH . 'uploads/jurnal/' . $jurnal['foto'])) {
                unlink(FCPATH . 'uploads/jurnal/' . $jurnal['foto']);
            }
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move(FCPATH . 'uploads/jurnal', $namaFoto);
        }

        $this->jurnalModel->update($id, [
            'tanggal'        => $this->request->getPost('tanggal'),
            'waktu_mulai'    => $this->request->getPost('waktu_mulai'),
            'waktu_selesai'  => $this->request->getPost('waktu_selesai'),
            'judul_kegiatan' => $this->request->getPost('judul_kegiatan'),
            'kategori'       => $this->request->getPost('kategori'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'hasil'          => $this->request->getPost('hasil'),
            'kendala'        => $this->request->getPost('kendala'),
            'solusi'         => $this->request->getPost('solusi'),
            'foto'           => $namaFoto,
            'status'         => 'Menunggu'
        ]);

        // PERBAIKAN: Gunakan base_url()
        return redirect()->to(base_url('jurnal'))->with('success', 'Jurnal berhasil diperbarui.');
    }

    public function delete($id)
    {
        $jurnal = $this->jurnalModel->find($id);

        if (!$jurnal) {
            // PERBAIKAN: Gunakan base_url()
            return redirect()->to(base_url('jurnal'))->with('error', 'Jurnal tidak ditemukan.');
        }

        if ($jurnal['status'] === 'Disetujui') {
            // PERBAIKAN: Gunakan base_url()
            return redirect()->to(base_url('jurnal'))->with('error', 'Jurnal yang telah disetujui tidak dapat dihapus.');
        }

        if (!empty($jurnal['foto']) && file_exists(FCPATH . 'uploads/jurnal/' . $jurnal['foto'])) {
            unlink(FCPATH . 'uploads/jurnal/' . $jurnal['foto']);
        }

        $this->jurnalModel->delete($id);

        // PERBAIKAN: Gunakan base_url()
        return redirect()->to(base_url('jurnal'))->with('success', 'Jurnal berhasil dihapus.');
    }

    public function verifikasiIndex()
    {
        $data = [
            'title'  => 'Verifikasi Jurnal Siswa',
            'jurnal' => $this->jurnalModel->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('jurnal/verifikasi', $data);
    }

    public function verifikasiUpdate($id)
    {
        $status      = $this->request->getPost('status');
        $catatanGuru = $this->request->getPost('catatan_guru');

        $this->jurnalModel->update($id, [
            'status'       => $status,
            'catatan_guru' => $catatanGuru
        ]);

        return redirect()->back()->with('success', 'Status jurnal berhasil diperbarui.');
    }
}