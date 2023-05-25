<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pertanyaan extends Model
{
    protected $table = 'pertanyaan';
    protected $primaryKey = 'id_pertanyaan';
    protected $allowedFields = ['id_user', 'deskripsi'];


    public function getpertanyaan()
    {
        return $this->db->table('pertanyaan')
            ->limit(5)
            ->orderBy('id_pertanyaan', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function getpertanyaan2()
    {
        return $this->db->table('pertanyaan')
            ->get()
            ->getResultArray();
    }

    public function cari_pertanyaan($keyword)
    {
        return $this->db->table('pertanyaan')
            ->like('deskripsi', $keyword)
            ->get()
            ->getResultArray();
    }


    public function pilih_pertanyaan($keyword)
    {
        return $this->db->table('pertanyaan')
            ->like('id_pertanyaan', $keyword)
            ->get()
            ->getResultArray();
    }
}
