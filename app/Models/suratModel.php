<?php 
namespace App\Models;

use CodeIgniter\Model;

class suratModel extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'id_surat';
    protected $allowedFields = ['id_jenis_surat','id_user', 'id_pengajuan','data_surat', 'no_surat','tanggal_surat', 'status_surat','created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
?>