<?php 
namespace App\Models;

use CodeIgniter\Model;

class persyaratanModel extends Model
{
    protected $table = 'persyaratan';
    protected $primaryKey = 'id_persyaratan';
    protected $allowedFields = ['id_persyaratan','nama_persyaratan', 'status_persyaratan', 'created_at', 'updated_at'];

    public function getpPrsyaratan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_persyaratan' => $id]);
        }
    }
}

?>