<?php

namespace App\Models;

use CodeIgniter\Model;

class M_konsumen extends Model
{

    protected $table = 'konsumen';
    protected $primaryKey = 'id_konsumen';
    protected $allowedFields = ['id_user', 'id_jurusan', 'nama', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'NIK', 'no_kk', 'PT', 'NIM', 'tahun_masuk'];

    public function getkonsumen()
    {
        return $this->db->table('konsumen')
            ->join('jurusan', 'konsumen.id_jurusan = jurusan.id_jurusan')
            ->get()
            ->getResultArray();
    }
    public function getkonsumen2($id)
    {
        return $this->db->table('konsumen')
            ->where('id_konsumen', $id)
            ->get()
            ->getResultArray();
    }

    public function cek_user($id)
    {
        return $this->db->table('konsumen')
            ->join('jurusan', 'konsumen.id_jurusan = jurusan.id_jurusan')
            ->where('id_user', $id)
            ->get()
            ->getResultArray();
    }

    public function cek_user2($id)
    {
        return $this->db->table('konsumen')
            ->where('id_konsumen', $id)
            ->limit(1)
            ->get()
            ->getRow();
    }

    public function cari_pengajar_pelajaran($keyword)
    {
        return $this->db->table('V_pengajar_pelajaran')
            ->like('nama', $keyword)
            ->orLike('nama_pengajar', $keyword)
            ->get()
            ->getResultArray();
    }

    public function konsumen_cek($id)
    {
        return $this->db->table('konsumen')
            ->where('id_user', $id)
            ->get()
            ->getRow();
    }
}
