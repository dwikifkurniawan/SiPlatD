<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pesan extends Model
{
    protected $table = 'pesan';
    protected $primaryKey = 'id_pesan';
    protected $allowedFields = ['id_user', 'id_tujuan', 'isi_pesan'];


    public function getpesan()
    {
        return $this->db->table('pesan')
            ->get()
            ->getResultArray();
    }

    public function list_pesan()
    {
        return $this->db->table('pesan')
            ->join('pengajar', 'pesan.id_user = pengajar.id_user')
            ->groupBy('pesan.id_user')
            ->get()
            ->getResultArray();
    }

    public function list_pesan2()
    {
        return $this->db->table('pesan')
            ->join('konsumen', 'pesan.id_user = konsumen.id_user')
            ->groupBy('pesan.id_user')
            ->get()
            ->getResultArray();
    }
}
