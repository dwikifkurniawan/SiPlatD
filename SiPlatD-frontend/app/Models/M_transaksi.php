<?php

namespace App\Models;

use CodeIgniter\Model;

class M_transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_pengajar_pelajaran', 'id_konsumen', 'pengajuan', 'rating'];


    public function gettransaksi()
    {
        return $this->db->table('v_kontrak')
            ->get()
            ->getResultArray();
    }

    public function list_transaksi($id_user)
    {
        return $this->db->table('v_kontrak')
            ->where('id_user', $id_user)
            ->get()
            ->getResultArray();
    }

    public function list_transaksi_pengajar($id_user)
    {
        return $this->db->table('v_kontrak')
            ->where('id_user_pengajar', $id_user)
            ->get()
            ->getResultArray();
    }
}
