<?php

namespace App\Models;

use CodeIgniter\Model;

class M_komentar extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';
    protected $allowedFields = ['id_user', 'id_pertanyaan', 'deskripsi'];


    public function getkomentar()
    {
        return $this->db->table('v_jawab_user')
            ->get()
            ->getResultArray();
    }


    public function tampil_komentar($keyword)
    {
        return $this->db->table('komentar')
            ->like('id_pertanyaan', $keyword)
            ->get()
            ->getResultArray();
    }
}
