<?php 
namespace App\Controllers;

use App\Models\persyaratanModel;
use Ramsey\Uuid\Uuid;

class Persyaratan extends BaseController
{
    public function index()
    {
        $persyaratanModel = new persyaratanModel();
        $data = [
            'title' => 'Persyaratan',
            'menu_active' => 'Persyaratan',
            'persyaratan' => $persyaratanModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('Admin/Persyaratan/index', $data);
    }

    public function save()
    {
        $model = new persyaratanModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_persyaratan' => [
                'label' => 'Nama Persyaratan',
                'rules' => 'required|is_unique[persyaratan.nama_persyaratan]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ]
            ]
        ]);
        if (!$validation->run($this->request->getPost())) {
            // session()->setFlashdata('errors', $validation->getErrors()); 
            session()->setFlashdata('error', 'Data Persyaratan gagal ditambahkan');
            return redirect()->to('/Persyaratan');
        }
        $data = [
            'nama_persyaratan' => $this->request->getPost('nama_persyaratan'),
            'status_persyaratan' => '1',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $model->save($data);
        session()->setFlashdata('success', 'Data Persyaratan berhasil ditambahkan');
        return redirect()->to('/Persyaratan');
    }

    public function update($id)
    {
        $model = new persyaratanModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_persyaratan' => [
                'label' => 'Nama Persyaratan',
                'rules' => 'required|is_unique[persyaratan.nama_persyaratan,id_persyaratan,' . $id . ']',
                'errors' => [
                    'required' => '{field} harus diisi.',
                ]
            ]
        ]);
        if (!$validation->run($this->request->getPost())) {
            session()->setFlashdata('error', 'Data Persyaratan gagal diubah');
            return redirect()->to('/Persyaratan');
        }
        $data = [
            'id_persyaratan' => $id,
            'nama_persyaratan' => $this->request->getPost('nama_persyaratan'),
            'status_persyaratan' => '1',
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $model->save($data);
        session()->setFlashdata('success', 'Data Persyaratan berhasil diubah');
        return redirect()->to('/Persyaratan');
    }

    public function update_status()
    {
        $model = new persyaratanModel();
        $id = $this->request->getPost('id');
        $data_persyaratan = $model->find($id);
        if ($data_persyaratan) {
            $status = $data_persyaratan['status_persyaratan'] == '1' ? '0' : '1'; // Toggle status
            $data = [
                'id_persyaratan' => $id,
                'status_persyaratan' => $status,
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $model->save($data);
            return $this->response->setJSON(['status' => '200', 'message' => 'Status Persyaratan berhasil diubah', 'error' => false]);
        } else {
            return $this->response->setJSON(['status' => '404', 'message' => 'Data Persyaratan tidak ditemukan', 'error' => true]);
        }
    }
    public function delete($id)
    {
        $model = new persyaratanModel();
        $model->delete($id);
        session()->setFlashdata('success', 'Data User berhasil dihapus');
        return redirect()->to('/Persyaratan');
    }
}
?>