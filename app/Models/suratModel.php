<?php 
namespace App\Models;

use CodeIgniter\Model;

class suratModel extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'id_surat';
    protected $allowedFields = ['id_surat','id_pengajuan','data_surat', 'no_surat','tanggal_surat', 'status_surat','created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getSurat($id = false){
       if($id == false){
            return $this    
                ->select('surat.*, jenis_surat.nama_jenis_surat, pengajuan.keperluan_pengajuan, warga.nama_warga')
                ->join('pengajuan', 'pengajuan.id_pengajuan = surat.id_pengajuan')
                ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
                ->join('warga', 'warga.id_warga = pengajuan.id_warga')
                ->findAll();
       }else{
            return $this
                ->select('surat.*, jenis_surat.nama_jenis_surat, pengajuan.keperluan_pengajuan, warga.nama_warga')
                ->join('pengajuan', 'pengajuan.id_pengajuan = surat.id_pengajuan')
                ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
                ->join('warga', 'warga.id_warga = pengajuan.id_warga')
                ->where('surat.id_surat', $id)
                ->first();
       }
    }

    public function getSuratByIdPengajuan($id_pengajuan){
        return $this
                ->select('surat.*, jenis_surat.nama_jenis_surat, pengajuan.keperluan_pengajuan, warga.nama_warga')
                ->join('pengajuan', 'pengajuan.id_pengajuan = surat.id_pengajuan')
                ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
                ->join('warga', 'warga.id_warga = pengajuan.id_warga')
                ->where('surat.id_pengajuan', $id_pengajuan)
                ->first();
    }
    
    public function getSuratByIdKeluarga($id_keluarga){
        return $this
                ->select('surat.*, jenis_surat.nama_jenis_surat, pengajuan.keperluan_pengajuan, warga.nama_warga')
                ->join('pengajuan', 'pengajuan.id_pengajuan = surat.id_pengajuan')
                ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
                ->join('warga', 'warga.id_warga = pengajuan.id_warga')
                ->join('kartu_keluarga', 'kartu_keluarga.id_kartu_keluarga = warga.id_kartu_keluarga')
                ->where('warga.id_kartu_keluarga', $id_keluarga)
                ->findAll();
    }
    public function getNomorSurat(){
        return $this
                ->select('no_surat')
                ->where('YEAR(no_surat)', date('Y'))
                ->orderBy('no_surat', 'DESC')
                ->first();
    }

    public function getLaporanSurat($tgl_awal, $tgl_akhir){
        return $this
                ->select('surat.*, jenis_surat.nama_jenis_surat, jenis_surat.kode_jenis_surat, pengajuan.keperluan_pengajuan, warga.nama_warga')
                ->join('pengajuan', 'pengajuan.id_pengajuan = surat.id_pengajuan')
                ->join('jenis_surat', 'jenis_surat.id_jenis_surat = pengajuan.id_jenis_surat')
                ->join('warga', 'warga.id_warga = pengajuan.id_warga')
                ->where('surat.tanggal_surat >=', $tgl_awal)
                ->where('surat.tanggal_surat <=', $tgl_akhir)
                ->orderBy('surat.id_surat', 'DESC')
                ->findAll();
    }
}
?>