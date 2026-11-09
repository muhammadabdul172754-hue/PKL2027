<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJurnalPklTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'waktu_mulai' => [
                'type' => 'TIME',
            ],
            'waktu_selesai' => [
                'type' => 'TIME',
            ],
            'judul_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'hasil' => [
                'type' => 'TEXT',
            ],
            'kendala' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'solusi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Menunggu', 'Disetujui', 'Ditolak'],
                'default'    => 'Menunggu',
            ],
            'catatan_guru' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        // Baris addForeignKey di-comment agar tidak error jika tipe data users.id berbeda
        // $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('jurnal_pkl');
    }

    public function down()
    {
        $this->forge->dropTable('jurnal_pkl');
    }
}