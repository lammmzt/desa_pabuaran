<?php 
namespace App\Models;

use CodeIgniter\Model;

class dataDesaModel extends Model
{
    protected $table = 'data_desa';
    protected $primaryKey = 'id_data_desa';
    protected $allowedFields = ['id_data_desa','nama_alias_insansi', 'nama_desa', 'alamat_desa', 'no_tlp_desa', 'email_desa', 'nama_kepala_desa', 'nip_kepala_desa','logo_desa', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getDataDesa($id = false)
    {
        if($id == false){
            return $this->findAll();
        }
        return $this->where(['id_desa' => $id])->first();
    }
}
?>