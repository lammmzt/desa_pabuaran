<?php 
namespace App\Models;

use CodeIgniter\Model;

class detailPengajuanModel extends Model
{
    protected $table = 'detail_pengajuan';
    protected $primaryKey = 'id_detail_pengajuan';
    protected $allowedFields = ['id_detail_pengajuan','id_pengajuan', 'id_persyaratan', 'file_detail_penajuan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getDetailPengajuan($id_detail_pengajuan = false)
    {
        if ($id_detail_pengajuan === false) {
            return $this
                ->select('detail_pengajuan.*, persyaratan.nama_persyaratan, jenis_surat.nama_jenis_surat')
                ->join('persyaratan', 'persyaratan.id_persyaratan = detail_pengajuan.id_persyaratan')
                ->join('pengajuan', 'pengajuan.id_pengajuan = detail_pengajuan.id_pengajuan')
                ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
                ->findAll();
        }

        return $this
                ->select('detail_pengajuan.*, persyaratan.nama_persyaratan, jenis_surat.nama_jenis_surat')
                ->join('persyaratan', 'persyaratan.id_persyaratan = detail_pengajuan.id_persyaratan')
                ->join('pengajuan', 'pengajuan.id_pengajuan = detail_pengajuan.id_pengajuan')
                ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
                ->where(['detail_pengajuan.id_detail_pengajuan' => $id_detail_pengajuan])
                ->first();
    }

    public function getDetailPengajuanByIdPengajuan($id_pengajuan)
    {
        return $this
                ->select('detail_pengajuan.*, persyaratan.nama_persyaratan, jenis_surat.nama_jenis_surat')
                ->join('persyaratan', 'persyaratan.id_persyaratan = detail_pengajuan.id_persyaratan')
                ->join('pengajuan', 'pengajuan.id_pengajuan = detail_pengajuan.id_pengajuan')
                ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
                ->where(['detail_pengajuan.id_pengajuan' => $id_pengajuan])
                ->findAll();
    }
}
?>