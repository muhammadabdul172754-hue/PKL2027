<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalModel extends Model
{
    protected $table            = 'jurnal_pkl';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = true;
    
    protected $allowedFields    = [
        'user_id', 'tanggal', 'waktu_mulai', 'waktu_selesai',
        'judul_kegiatan', 'kategori', 'deskripsi', 'hasil',
        'kendala', 'solusi', 'foto', 'status', 'catatan_guru'
    ];

    public function getFilteredJurnal($userId, $search = null, $tanggal = null, $status = null)
    {
        $builder = $this->where('user_id', $userId);

        if ($search) {
            $builder->groupStart()
                    ->like('judul_kegiatan', $search)
                    ->orLike('deskripsi', $search)
                    ->orLike('kategori', $search)
                    ->groupEnd();
        }

        if ($tanggal) {
            $builder->where('tanggal', $tanggal);
        }

        if ($status) {
            $builder->where('status', $status);
        }

        return $builder->orderBy('tanggal', 'DESC')->findAll();
    }
}