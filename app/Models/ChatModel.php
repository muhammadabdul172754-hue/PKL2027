<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table            = 'messages';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'nama_pengirim', 'isi'];
    
    // Otomatis mengisi created_at dan updated_at
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = ''; // Kita tidak butuh updated_at untuk chat

    // Fungsi untuk mengambil semua pesan (urut dari yang paling lama)
    public function getMessages()
    {
        return $this->orderBy('created_at', 'ASC')->findAll();
    }
}