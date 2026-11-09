<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ChatModel;

class Chat extends BaseController
{
    protected $chatModel;

    public function __construct()
    {
        $this->chatModel = new ChatModel();
    }

    // Menampilkan halaman chat
    public function index()
    {
        $data = [
            'title' => 'Chatroom PKL',
            // Kita ambil pesan lama saat pertama kali halaman dibuka
            'messages' => $this->chatModel->getMessages()
        ];

        return view('chat/index', $data);
    }

        // Menyimpan pesan baru
        public function send()
    {
        $nama_pengirim = session()->get('nama'); 
        $user_id       = session()->get('id'); 

        $isi_pesan = $this->request->getPost('isi');
        $reply_to_id = $this->request->getPost('reply_to_id'); // <-- Ambil ID kutipan

        if ($isi_pesan) {
            $this->chatModel->save([
                'user_id'       => $user_id,
                'nama_pengirim' => $nama_pengirim, 
                'isi'           => $isi_pesan,
                'reply_to_id'   => empty($reply_to_id) ? null : $reply_to_id // <-- Simpan
            ]);

            return $this->response->setJSON(['status' => 'success']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Pesan kosong']);
    }

    // Mengambil pesan untuk ditampilkan
       public function fetch()
    {
        $messages = $this->chatModel->getMessages();
        
        $data = [];
        foreach ($messages as $msg) {
            $reply_data = null;

            // Jika pesan ini adalah balasan, cari pesan aslinya
            if (!empty($msg['reply_to_id'])) {
                $original = $this->chatModel->find($msg['reply_to_id']);
                if ($original) {
                    $reply_data = [
                        'nama' => $original['nama_pengirim'],
                        'isi'  => $original['isi']
                    ];
                }
            }

            $data[] = [
                'id'       => $msg['id'],
                'user_id'  => $msg['user_id'], 
                'nama'     => $msg['nama_pengirim'],
                'isi'      => $msg['isi'],
                'waktu'    => date('H:i', strtotime($msg['created_at'])),
                'reply_to' => $reply_data // <-- Kirim data kutipan ke JS
            ];
        }

        return $this->response->setJSON($data);
    }

        public function delete($id)
    {
        $chatModel = new ChatModel();
        
        // Cari pesan berdasarkan ID
        $pesan = $chatModel->find($id);
        
        if (!$pesan) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Pesan tidak ditemukan']);
        }

        // Cek Keamanan: Hanya pembuat pesan atau Admin yang boleh menghapus
        $userId = session()->get('id');
        $role   = session()->get('role');

        if ($pesan['user_id'] == $userId || $role == 'admin') {
            // Hapus permanen dari database
            $chatModel->delete($id);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            // Jika bukan pembuatnya atau bukan admin, tolak!
            return $this->response->setJSON(['status' => 'error', 'message' => 'Anda tidak berhak menghapus pesan ini']);
        }
    }

        public function pin($id)
    {
        $chatModel = new ChatModel();
        $pesan = $chatModel->find($id);

        if (!$pesan) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Pesan tidak ditemukan']);
        }

        // Hanya Admin yang boleh menyematkan pesan (atau bisa diubah jadi semua user)
        if (session()->get('role') == 'admin') {
            // Toggle status (jika 1 jadi 0, jika 0 jadi 1)
            $newStatus = $pesan['is_pinned'] == 1 ? 0 : 1;
            
            $chatModel->update($id, ['is_pinned' => $newStatus]);
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Hanya Admin yang bisa menyematkan pesan']);
        }
    }
}