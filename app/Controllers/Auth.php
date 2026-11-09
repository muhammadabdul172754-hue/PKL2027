<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, lempar ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function process()
    {
        $session = session();
        $model = new UsersModel();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $model->where('username', $username)->first();

        if ($data) {
            // Cek status aktif
            if ($data['status'] == 'nonaktif') {
                $session->setFlashdata('error', 'Akun Anda dinonaktifkan.');
                return redirect()->to('/login');
            }

            $pass = $data['password'];
            // Verifikasi password hash
            $verify_pass = password_verify($password, $pass);
            
            if ($verify_pass) {
                // Set session sesuai modul guru
                $ses_data = [
                    'id'        => $data['id'],
                    'nama'      => $data['nama'],
                    'username'  => $data['username'],
                    'role'      => $data['role'],
                    'foto'      => $data['foto'],
                    'logged_in' => TRUE // Flag untuk ngecek sudah login
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('error', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }
    }

        // Menampilkan halaman register
    public function register()
    {
        // Jika sudah login, tidak perlu daftar lagi
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/register');
    }

    // Memproses data register
    public function store_register()
    {
        $model = new UsersModel();
        $session = session();

        // Aturan validasi (Username harus unik, password minimal 6 karakter)
        $rules = [
            'nama'     => 'required',
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'email'    => 'required|valid_email|is_unique[users.email]'
        ];

        if (!$this->validate($rules)) {
            // Jika gagal validasi, kembalikan ke form dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data ke database
        $model->save([
            'nama'     => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email'    => $this->request->getVar('email'),
            // Password WAJIB di-hash agar sama dengan sistem login
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role'     => 'anggota', // Default role untuk pendaftar baru
            'status'   => 'aktif'
        ]);

        $session->setFlashdata('success', 'Registrasi berhasil! Silakan login.');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/dashboard');
    }
}