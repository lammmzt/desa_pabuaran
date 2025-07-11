<?php 
namespace App\Controllers;

use App\Models\jenisSuratModel;
use App\Models\detailJenisSuratModel;
use App\Models\persyaratanModel;
use Ramsey\Uuid\Uuid;

class Jenis_surat extends BaseController
{
    public function index()
    {
        $jenisSuratModel = new jenisSuratModel();
        $data = [
            'title' => 'Jenis Surat',
            'menu_active' => 'jenis_surat',
            'jenis_surat' => $jenisSuratModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('Admin/jenis_surat/index', $data);
    }

    public function tambah()
    {
        $persyaratanModel = new persyaratanModel();
        $dataPersyaratan = $persyaratanModel->where('status_persyaratan', '1')->findAll();
        $data = [
            'title' => 'Tambah Jenis Surat',
            'persyaratan' => $dataPersyaratan,
            'menu_active' => 'jenis_surat',
            'validation' => \Config\Services::validation()
        ];
        return view('Admin/jenis_surat/tambah', $data);
    }

    public function save()
    {
        $model = new jenisSuratModel();
        $detailModel = new detailJenisSuratModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_jenis_surat' => 'required|is_unique[jenis_surat.nama_jenis_surat]',
            'kode_jenis_surat' => 'required',
            'ket_jenis_surat' => 'required',
            'template_jenis_surat' => 'required'
        ]);
        if (!$validation->run($this->request->getPost())) {
            // session()->setFlashdata('errors', $validation->getErrors()); 
            session()->setFlashdata('error', 'Data Jenis Surat gagal ditambahkan');
            return redirect()->to('/Jenis_surat/Tambah');
        }
        $id = Uuid::uuid4()->toString();
        $data = [
            'id_jenis_surat' => $id,
            'nama_jenis_surat' => $this->request->getPost('nama_jenis_surat'),
            'kode_jenis_surat' => $this->request->getPost('kode_jenis_surat'),
            'ket_jenis_surat' => $this->request->getPost('ket_jenis_surat'),
            'status_jenis_surat' => '1',
            'template_jenis_surat' => $this->request->getPost('template_jenis_surat'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $model->insert($data);
        $persyaratan = $this->request->getPost('persyaratan');
        if ($persyaratan) {
            foreach ($persyaratan as $id_persyaratan) {
                $detailData = [
                    'id_jenis_surat' => $id,
                    'id_persyaratan' => $id_persyaratan,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $detailModel->save($detailData);
            }
        }
        
        session()->setFlashdata('success', 'Data Jenis Surat berhasil ditambahkan');
        return redirect()->to('/Jenis_surat');
    }

    public function edit($id)
    {
        $model = new jenisSuratModel();
        $data = [
            'title' => 'Edit Jenis Surat',
            'menu_active' => 'jenis_surat',
            'validation' => \Config\Services::validation(),
            'jenis_surat' => $model->find($id)
        ];
        return view('Admin/jenis_surat/edit', $data);
    }

    public function update($id)
    {
        $model = new jenisSuratModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_jenis_surat' => 'required',
            'ket_jenis_surat' => 'required',
            'template_jenis_surat' => 'required'
        ]);
        if (!$validation->run($this->request->getPost())) {
            // session()->setFlashdata('errors', $validation->getErrors()); 
            session()->setFlashdata('error', 'Data Jenis Surat gagal diubah');
            return redirect()->to('/Jenis_surat');
        }
        $data = [
            'nama_jenis_surat' => $this->request->getPost('nama_jenis_surat'),
            'persyaratan_jenis_surat' => $this->request->getPost('persyaratan_jenis_surat'),
            'ket_jenis_surat' => $this->request->getPost('ket_jenis_surat'),
            'template_jenis_surat' => $this->request->getPost('template_jenis_surat'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $model->update($id, $data);
        session()->setFlashdata('success', 'Data Jenis Surat berhasil diubah');
        return redirect()->to('/Jenis_surat');
    }

    public function delete($id)
    {
        $model = new jenisSuratModel();
        $model->delete($id);
        session()->setFlashdata('success', 'Data Jenis Surat berhasil dihapus');
        return redirect()->to('/Jenis_surat');
    }
    
}
?>