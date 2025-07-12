<?php 
namespace App\Controllers;

use App\Models\kartuKeluargaModel;
use App\Models\wargaModel;
use App\Models\usersModel;
use Ramsey\Uuid\Uuid;

class Keluarga extends BaseController
{
    public function index() // Fungsi untuk menampilkan daftar Warga
    {
        $model = new kartuKeluargaModel(); // Inisialisasi model Kartu Keluarga
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Keluarga', // Judul halaman
            'menu_active' => 'Keluarga', // Menu yang aktif
            'keluarga' => $model->getkartuKeluarga(), // Mengambil semua data Warga dari model
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('Admin/Warga/index', $data); // Mengembalikan view dengan data yang telah disiapkan
    }


    public function save() // Fungsi untuk menyimpan data Warga baru
    {
        $model = new kartuKeluargaModel(); // Inisialisasi model Kartu Keluarga
        $usersModel = new usersModel(); // Inisialisasi model User

        $validation = \Config\Services::validation(); // Inisialisasi layanan validasi
        $validation->setRules([
            'id_kartu_keluarga' => [
                'label' => 'No. KK',
                'rules' => 'required|min_length[16]|max_length[16]|is_unique[kartu_keluarga.id_kartu_keluarga]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 16 karakter.',
                    'max_length' => '{field} maksimal 16 karakter.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'nama_kartu_keluarga' => [
                'label' => 'Nama Kartu Keluarga',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'alamat_kartu_keluarga' => [
                'label' => 'Alamat Kartu Keluarga',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'rt_kartu_keluarga' => [
                'label' => 'RT Kartu Keluarga',
                'rules' => 'required|min_length[3]|max_length[3]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 3 karakter.'
                ]
            ],
            'rw_kartu_keluarga' => [
                'label' => 'RW Kartu Keluarga',
                'rules' => 'required|min_length[3]|max_length[3]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 3 karakter.'
                ]
            ],
            'foto_kartu_keluarga' => [
                'label' => 'Foto Kartu Keluarga',
                'rules' => 'mime_in[foto_kartu_keluarga,image/jpg,image/jpeg,image/png]|max_size[foto_kartu_keluarga,2048]',
                'errors' => [
                    'mime_in' => '{field} harus berupa file gambar (jpg, jpeg, png).',
                    'max_size' => '{field} maksimal ukuran 2MB.'
                ]
            ],
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
        if (!$validation->run($this->request->getPost())) { // Jika validasi gagal
            // session()->setFlashdata('errors', $validation->getErrors());
            session()->setFlashdata('error', 'Data Keluarga gagal ditambahkan'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('Keluarga'); // Redirect ke halaman tambah keluarga
        }
        // check username already exists
        $checkUsername = $usersModel->where('username', $this->request->getPost('id_kartu_keluarga'))->first();
        if ($checkUsername) { // Jika username sudah ada
            session()->setFlashdata('error', 'No. KK sudah terdaftar sebagai user'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('Keluarga'); // Redirect ke halaman tambah keluarga
        }
        // insert to user
        $id_user = Uuid::uuid4()->toString(); // Generate UUID untuk id
        $usersModel->insert([
            'id_user' => $id_user,
            'nama_user' => $this->request->getPost('nama_kartu_keluarga'),
            'username' => $this->request->getPost('id_kartu_keluarga'),
            'password' => password_hash($this->request->getPost('id_kartu_keluarga'), PASSWORD_DEFAULT),
            'role' => 'Warga',
            'alamat_user' => $this->request->getPost('alamat_kartu_keluarga'),
            'status_user' => '1',
            'created_at' => date('Y-m-d H:i:s'),    
        ]);
        $foto = $this->request->getFile('foto_kartu_keluarga'); // Mengambil file foto dari request
        $fotoName = $foto->getRandomName(); // Menghasilkan nama file acak
        $foto->move('Assets/foto_kk/', $fotoName); // Memindahkan file ke direktori yang ditentukan
        $data = [ // Data yang akan disimpan
            'id_kartu_keluarga' => $this->request->getPost('id_kartu_keluarga'),
            'id_user' => $id_user,
            'nama_kartu_keluarga' => $this->request->getPost('nama_kartu_keluarga'),
            'alamat_kartu_keluarga' => $this->request->getPost('alamat_kartu_keluarga'),
            'rt_kartu_keluarga' => $this->request->getPost('rt_kartu_keluarga'),
            'rw_kartu_keluarga' => $this->request->getPost('rw_kartu_keluarga'),
            'foto_kartu_keluarga' => $fotoName,
            'status_kartu_keluarga' => '1',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $model->insert($data); // Menyimpan data ke database
        session()->setFlashdata('success', 'Data Keluarga berhasil ditambahkan'); // Menyimpan pesan sukses ke session
        return redirect()->to('Keluarga'); // Redirect ke halaman keluarga
    }

   
    
}
?>