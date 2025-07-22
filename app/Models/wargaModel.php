<?php 
namespace App\Models;

use CodeIgniter\Model;

class wargaModel extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'id_warga';
    protected $allowedFields = ['id_warga', 'id_kartu_keluarga', 'nama_warga', 'jenis_kelamin_warga','tempat_lahir_warga', 'tanggal_lahir_warga', 'agama_warga', 'pekerjaan_warga','status_kawin_warga', 'shdk_warga', 'kebangsaan_warga', 'pendidikan_warga', 'berkas_ktp_warga', 'status_warga', 'created_at', 'updated_at'];

    public function getWarga($id = false)
    {
        if ($id === false) {
            return $this
            ->select('warga.*, kartu_keluarga.nama_kartu_keluarga, kartu_keluarga.alamat_kartu_keluarga, kartu_keluarga.rt_kartu_keluarga, kartu_keluarga.rw_kartu_keluarga')
            ->join('kartu_keluarga', 'kartu_keluarga.id_kartu_keluarga = warga.id_kartu_keluarga')
            ->findAll();
        } else {
            return $this
            ->select('warga.*, kartu_keluarga.nama_kartu_keluarga, kartu_keluarga.alamat_kartu_keluarga, kartu_keluarga.rt_kartu_keluarga, kartu_keluarga.rw_kartu_keluarga')
            ->join('kartu_keluarga', 'kartu_keluarga.id_kartu_keluarga = warga.id_kartu_keluarga')
            ->where(['warga.id_warga' => $id])
            ->first();
        }
    }

    public function getWargaByIdKartuKeluarga($id_KK){
        return $this
        ->select('warga.*, kartu_keluarga.nama_kartu_keluarga, kartu_keluarga.alamat_kartu_keluarga, kartu_keluarga.rt_kartu_keluarga, kartu_keluarga.rw_kartu_keluarga')
        ->join('kartu_keluarga', 'kartu_keluarga.id_kartu_keluarga = warga.id_kartu_keluarga')
        ->where(['warga.id_kartu_keluarga' => $id_KK])
        ->findAll();
    }
}

?>