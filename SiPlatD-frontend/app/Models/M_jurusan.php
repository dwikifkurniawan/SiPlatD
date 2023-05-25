<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $allowedFields = ['nama_jurusan', 'kategori'];


    public function getjurusan()
    {
        return $this->db->table('jurusan')
            ->limit(5)
            ->get()
            ->getResultArray();
    }

    public function cari_pelajaran_jurusan($keyword)
    {
        return $this->db->table('V_pelajaran_jurusan')
            ->like('nama_pelajaran', $keyword)
            ->orLike('nama_jurusan', $keyword)
            ->get()
            ->getResultArray();
    }

    public function cari_jurusan2($keyword)
    {
        return $this->db->table('jurusan')
            ->like('id_jurusan', $keyword)
            ->get()
            ->getResultArray();
    }
}
