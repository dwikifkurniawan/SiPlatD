<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pengajar extends Model
{

    protected $table = 'pengajar';
    protected $primaryKey = 'id_pengajar';
    protected $allowedFields = ['id_user', 'id_jurusan', 'nama', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'NIK', 'no_kk', 'PT', 'NIM', 'tahun_masuk', 'review', 'deskripsi_diri'];

    public function getpengajar()
    {
        return $this->db->table('pengajar')
            ->join('jurusan', 'pengajar.id_jurusan = jurusan.id_jurusan')
            ->get()
            ->getResultArray();
    }
    public function getpengajar2($id)
    {
        return $this->db->table('pengajar')
            ->join('jurusan', 'pengajar.id_jurusan = jurusan.id_jurusan')
            ->where('id_pengajar', $id)
            ->get()
            ->getResultArray();
    }

    public function getpengajar_pelajaran()
    {
        return $this->db->table('v_pengajar_pelajaran')
            ->get()
            ->getResultArray();
    }

    public function cek_user($id)
    {
        return $this->db->table('pengajar')
            ->join('jurusan', 'pengajar.id_jurusan = jurusan.id_jurusan')
            ->join('pengajar_pelajaran', 'pengajar.id_pengajar = pengajar_pelajaran.id_pengajar')
            ->where('pengajar.id_pengajar', $id)
            ->limit(1)
            ->get()
            ->getResultArray();
    }

    public function cek_user2($id)
    {
        return $this->db->table('pengajar')
            ->where('id_pengajar', $id)
            ->limit(1)
            ->get()
            ->getRow();
    }
    public function cek_user3($id)
    {
        return $this->db->table('pengajar')
            ->join('jurusan', 'pengajar.id_jurusan = jurusan.id_jurusan')
            ->where('pengajar.id_user', $id)
            ->get()
            ->getResultArray();
    }

    public function cari_pengajar_pelajaran($keyword)
    {
        return $this->db->table('V_pengajar_pelajaran')
            ->like('nama', $keyword)
            ->orLike('nama_pengajar', $keyword)
            ->get()
            ->getResultArray();
    }

    public function cari_pengajar_pelajaran2($keyword)
    {
        return $this->db->table('V_pengajar_pelajaran')
            ->where('id_pelajaran', $keyword)
            ->get()
            ->getResultArray();
    }

    public function cari_pengajar_pelajaran3($keyword)
    {
        return $this->db->table('V_pengajar_pelajaran')
            ->where('id_pengajar', $keyword)
            ->get()
            ->getResultArray();
    }
    public function pengajar_pelajaran($keyword)
    {
        return $this->db->table('V_pengajar_pelajaran')
            ->where('id_pengajar', $keyword)
            ->get()
            ->getRow();
    }

    public function pengajar_pelajaran2($keyword)
    {
        return $this->db->table('V_pengajar_pelajaran')
            ->where('id_pelajaran', $keyword)
            ->get()
            ->getRow();
    }

    public function pengajar_add()
    {
        return $this->db->table('pengajar')
            ->get()
            ->getRow();
    }
}
