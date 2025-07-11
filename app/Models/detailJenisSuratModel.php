<?php 
namespace App\Models;

use CodeIgniter\Model;

class jenisSuratModel extends Model
{
    protected $table = 'detail_jenis_surat';
    protected $primaryKey = 'id_detail_jenis_surat';
    protected $allowedFields = ['id_detail_jenis_surat','id_jenis_surat', 'id_persyaratan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getDetailJenisSurat($id_detail_jenis_surat = false)
    {
        if ($id_detail_jenis_surat === false) {
            return $this
                ->select('detail_jenis_surat.*, persyaratan.nama_persyaratan, jenis_surat.nama_jenis_surat')
                ->join('persyaratan', 'persyaratan.id_persyaratan = detail_jenis_surat.id_persyaratan')
                ->join('jenis_surat', 'jenis_surat.id_jenis_surat = detail_jenis_surat.id_jenis_surat')
                ->findAll();
        }

        return $this
            ->select('detail_jenis_surat.*, persyaratan.nama_persyaratan, jenis_surat.nama_jenis_surat')
            ->join('persyaratan', 'persyaratan.id_persyaratan = detail_jenis_surat.id_persyaratan')
            ->join('jenis_surat', 'jenis_surat.id_jenis_surat = detail_jenis_surat.id_jenis_surat')
            ->where(['detail_jenis_surat.id_detail_jenis_surat' => $id_detail_jenis_surat])
            ->first();
    }
}
?>