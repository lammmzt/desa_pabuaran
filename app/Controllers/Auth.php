<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\usersModel;

class Auth extends BaseController
{
    public function index() // menampilkan halaman login
    {
        $data['title'] = 'Login'; // membuat judul halaman
        $data['active'] = 'Login'; // membuat link active
        $data['validation'] = \Config\Services::validation(); // membuat validasi form
        if(session()->get('logged_in')) // jika sudah login
        {
            return redirect()->to(base_url('Home')); // mengalihkan ke halaman Dashboard
        }
        return view('Auth/index', $data); // menampilkan view Auth/login
    }

    public function login() // proses login
    {
        $usersModel = new usersModel(); // membuat instance dari model usersModel
        $username = $this->request->getPost('username'); // mengambil data username dari form
        $password = $this->request->getPost('password'); // mengambil data password dari form
        $users = $usersModel->where('username', $username)->first(); // mengambil data users berdasarkan username
        if($users) // jika data users ditemukan
        {
            if(password_verify($password, $users['password'])) // jika password sesuai
            {
                session()->set([ // membuat session
                    'id_user' => $users['id_user'],
                    'nama_user' => $users['nama_user'],
                    'username' => $users['username'],
                    'role' => $users['role'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('Home')); // mengalihkan ke halaman Dashboard
            }else{
                session()->setFlashdata('error', 'Password Salah'); // menampilkan pesan error
                return redirect()->to(base_url('Auth'))->withInput(); // mengalihkan ke halaman Auth
            }
        }else{
            session()->setFlashdata('error', 'Username Tidak Ditemukan'); // menampilkan pesan error
            return redirect()->to(base_url('Auth'))->withInput(); // mengalihkan ke halaman Auth
        }
    }

    public function loginUser()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        // dd($username, $password);
        $model = new usersModel();
        $user = $model->where('username', $username)->first();

        if($user){
            if(password_verify($password, $user['password'])){
                $ses_data = [
                    'id_user' => $user['id_user'],
                    'nama_user' => $user['nama_user'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'logged_in' => TRUE
                ];
                session()->set($ses_data);
                return $this->response->setJSON([
                    'error' => false,   
                    'status' => '200',
                    'data' => 'Login Berhasil',
                ]);
            }else{
                return $this->response->setJSON([
                    'error' => true,
                    'status' => 401,
                    'data' => 'Password Salah',
                ]);
            }
        }else{
            return $this->response->setJSON([
                'error' => true,
                'status' => 401,
                'data' => 'Username Tidak Ditemukan',
            ]);
        }
    }

    public function logout() // proses logout
    {
        session()->destroy(); // menghapus semua session
        return redirect()->to(base_url('/')); // mengalihkan ke halaman Auth
    }
}
?>