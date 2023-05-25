<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pengajar_pelajaran extends Model
{
    protected $table = 'pengajar_pelajaran';
    protected $primaryKey = 'id_pengajar_pelajaran';
    protected $allowedFields = ['id_pengajar', 'id_pelajaran'];

    public function getpengajar_pelajaran()
    {
        return $this->db->table('pengajar_pelajaran')
            ->get()
            ->getResultArray();
    }
    public function getpengajar_pelajaran2($id)
    {
        return $this->db->table('pengajar_pelajaran')
            ->where('id_pengajar_pelajaran', $id)
            ->get()
            ->getResultArray();
    }

    public function getpengajar_pelajaran3()
    {
        return $this->db->table('v_pengajar_pelajaran')
            ->get()
            ->getResultArray();
    }
}
