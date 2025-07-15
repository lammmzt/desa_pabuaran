<?php 
namespace App\Models;

use CodeIgniter\Model;

class kartuKeluargaModel extends Model
{
    protected $table = 'kartu_keluarga';
    protected $primaryKey = 'id_kartu_keluarga';
    protected $allowedFields = ['id_kartu_keluarga', 'id_user', 'nama_kartu_keluarga', 'alamat_kartu_keluarga', 'rt_kartu_keluarga', 'rw_kartu_keluarga', 'status_kartu_keluarga', 'foto_kartu_keluarga', 'no_tpl_kartu_keluarga', 'created_at', 'updated_at'];

    public function getkartuKeluarga($id = false)
    {
        if ($id === false) {
            return $this
            ->select('kartu_keluarga.*, users.nama_user')
            ->join('users', 'users.id_user = kartu_keluarga.id_user')
            ->orderBy('kartu_keluarga.nama_kartu_keluarga', 'DESC')
            ->findAll();
        } else {
            return $this
            ->select('kartu_keluarga.*, users.nama_user')
            ->join('users', 'users.id_user = kartu_keluarga.id_user')
            ->where(['kartu_keluarga.id_kartu_keluarga' => $id])
            ->first();
        }
    }
    public function getKeluargaByIduser($id = false)
    {
        return $this
        ->select('kartu_keluarga.*, users.nama_user')
        ->join('users', 'users.id_user = kartu_keluarga.id_user')
        ->where(['kartu_keluarga.id_user' => $id])
        ->first();
    }
}

?>