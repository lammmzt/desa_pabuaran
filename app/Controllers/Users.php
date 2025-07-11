<?php 
namespace App\Controllers;

use App\Models\usersModel;
use Ramsey\Uuid\Uuid;

class Users extends BaseController
{
    public function index()
    {
        $usersModel = new usersModel();
        $data = [
            'title' => 'Users',
            'menu_active' => 'Users',
            'users' => $usersModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('Admin/Users/index', $data);
    }

    public function save()
    {
        $model = new usersModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|is_unique[users.username]',
            'password' => 'required',
            'nama_user' => 'required',
            'status_user' => 'required',
            'alamat_user' => 'required',
            'role' => 'required'
        ]);
        if (!$validation->run($this->request->getPost())) {
            // session()->setFlashdata('errors', $validation->getErrors()); 
            session()->setFlashdata('error', 'Data User gagal ditambahkan');
            return redirect()->to('/users');
        }
        $data = [
            'id_user' => Uuid::uuid4()->toString(),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama_user' => $this->request->getPost('nama_user'),
            'status_user' => $this->request->getPost('status_user'),
            'alamat_user' => $this->request->getPost('alamat_user'),
            'role' => $this->request->getPost('role'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $model->insert($data);
        session()->setFlashdata('success', 'Data User berhasil ditambahkan');
        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $model = new usersModel();
        $data = [
            'title' => 'Edit User',
            'menu_active' => 'users',
            'user' => $model->find($id)
        ];
        return view('Admin/Users/edit', $data);
    }

    public function update($id)
    {
        $model = new usersModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'nama_user' => $this->request->getPost('nama_user'),
            'status_user' => $this->request->getPost('status_user'),
            'alamat_user' => $this->request->getPost('alamat_user'),
            'role' => $this->request->getPost('role'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $model->update($id, $data);
        session()->setFlashdata('success', 'Data User berhasil diubah');
        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $model = new usersModel();
        $model->delete($id);
        session()->setFlashdata('success', 'Data User berhasil dihapus');
        return redirect()->to('/users');
    }
}
?>