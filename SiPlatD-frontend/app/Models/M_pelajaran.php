<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pelajaran extends Model
{
    protected $table = 'pelajaran';
    protected $primaryKey = 'id_pelajaran';
    protected $allowedFields = ['id_jurusan', 'nama', 'kategori', 'deskripsi'];

    public function getpelajaran()
    {
        return $this->db->table('pelajaran')
            ->limit(5)
            ->get()
            ->getResultArray();
    }

    public function getpelajaran2()
    {
        return $this->db->table('pelajaran')
            ->join('jurusan', 'pelajaran.id_jurusan = jurusan.id_jurusan')
            ->get()
            ->getResultArray();
    }

    public function getpelajaran3($id)
    {
        return $this->db->table('pelajaran')
            ->where('id_pelajaran', $id)
            ->get()
            ->getResultArray();
    }

    public function cari_pelajaran($keyword)
    {
        return $this->db->table('pelajaran')
            ->like('nama', $keyword)
            ->get()
            ->getResultArray();
    }

    public function cari_pelajaran2($keyword)
    {
        return $this->db->table('pelajaran')
            ->where('id_jurusan', $keyword)
            ->get()
            ->getResultArray();
    }

    public function cari_pelajaran3($keyword)
    {
        return $this->db->table('pelajaran')
            ->where('id_pelajaran', $keyword)
            ->get()
            ->getResultArray();
    }
}
