<?php 
namespace App\Models;

use CodeIgniter\Model;

class pengajuanModel extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = 'id_pengajuan';
    protected $allowedFields = ['id_pengajuan','id_jenis_surat', 'id_warga','keperluan_pengajuan', 'ket_pengajuan','status_pengajuan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getPengajuan($id_pengajuan = false)
    {
        if ($id_pengajuan === false) {
            return $this
                ->select('pengajuan.*, jenis_surat.nama_jenis_surat, warga.nama_warga, warga.id_kartu_keluarga, warga.tempat_lahir_warga, warga.tanggal_lahir_warga, warga.tanggal_lahir_warga, warga.agama_warga, warga.pekerjaan_warga, warga.berkas_ktp_warga, kartu_keluarga.nama_kartu_keluarga, kartu_keluarga.alamat_kartu_keluarga, kartu_keluarga.rt_kartu_keluarga, kartu_keluarga.rw_kartu_keluarga, kartu_keluarga.no_tpl_kartu_keluarga, kartu_keluarga.foto_kartu_keluarga, users.nama_user')
                ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
                ->join('warga', 'warga.id_warga = pengajuan.id_warga')
                ->join('kartu_keluarga', 'kartu_keluarga.id_kartu_keluarga = warga.id_kartu_keluarga')
                ->join('users', 'users.id_user = kartu_keluarga.id_user');
        }

        return $this
             ->select('pengajuan.*, jenis_surat.nama_jenis_surat, warga.nama_warga, warga.id_kartu_keluarga, warga.tempat_lahir_warga, warga.tanggal_lahir_warga, warga.tanggal_lahir_warga, warga.agama_warga, warga.pekerjaan_warga, warga.berkas_ktp_warga, kartu_keluarga.nama_kartu_keluarga, kartu_keluarga.alamat_kartu_keluarga, kartu_keluarga.rt_kartu_keluarga, kartu_keluarga.rw_kartu_keluarga, kartu_keluarga.no_tpl_kartu_keluarga, kartu_keluarga.foto_kartu_keluarga, users.nama_user')
            ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
            ->join('warga', 'warga.id_warga = pengajuan.id_warga')
            ->join('kartu_keluarga', 'kartu_keluarga.id_kartu_keluarga = warga.id_kartu_keluarga')
            ->join('users', 'users.id_user = kartu_keluarga.id_user')
            ->where(['pengajuan.id_pengajuan' => $id_pengajuan])
            ->first();
    }

    public function getAjuanByIdUser($idUser){
        return $this
        ->select('pengajuan.*, jenis_surat.nama_jenis_surat, warga.nama_warga, warga.id_kartu_keluarga, warga.tempat_lahir_warga, warga.tanggal_lahir_warga, warga.tanggal_lahir_warga, warga.agama_warga, warga.pekerjaan_warga, warga.berkas_ktp_warga, kartu_keluarga.nama_kartu_keluarga, kartu_keluarga.alamat_kartu_keluarga, kartu_keluarga.rt_kartu_keluarga, kartu_keluarga.rw_kartu_keluarga, kartu_keluarga.no_tpl_kartu_keluarga, kartu_keluarga.foto_kartu_keluarga, users.nama_user')
        ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
        ->join('warga', 'warga.id_warga = pengajuan.id_warga')
        ->join('kartu_keluarga', 'kartu_keluarga.id_kartu_keluarga = warga.id_kartu_keluarga')
        ->join('users', 'users.id_user = kartu_keluarga.id_user')
        ->where(['kartu_keluarga.id_user' => $idUser])
        ->orderBy('pengajuan.created_at', 'DESC')
        ->findAll();
    }

}
?>