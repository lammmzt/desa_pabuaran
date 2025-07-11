<?php 
namespace App\Models;

use CodeIgniter\Model;

class pengajuanModel extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = 'id_pengajuan';
    protected $allowedFields = ['id_pengajuan','id_jenis_surat', 'id_warga','keperluan_pengajuan', 'ket_pengajuan_pengajuan','status_pengajuan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getPengajuan($id_pengajuan = false)
    {
        if ($id_pengajuan === false) {
            return $this
                ->select('pengajuan.*, jenis_surat.nama_jenis_surat, warga.nama_warga')
                ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
                ->join('warga', 'warga.id_warga = pengajuan.id_warga')
                ->findAll();
        }

        return $this
            ->select('pengajuan.*, jenis_surat.nama_jenis_surat, warga.nama_warga')
            ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
            ->join('warga', 'warga.id_warga = pengajuan.id_warga')
            ->where(['pengajuan.id_pengajuan' => $id_pengajuan])
            ->first();
    }
}
?>