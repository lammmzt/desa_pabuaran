<?php 
namespace App\Controllers;

use App\Models\persyaratanModel;
use Ramsey\Uuid\Uuid;

class Persyaratan extends BaseController
{
    public function index() // Fungsi untuk menampilkan daftar persyaratan
    {
        $persyaratanModel = new persyaratanModel(); // Inisialisasi model persyaratan
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Persyaratan', // Judul halaman
            'menu_active' => 'Persyaratan', // Menu yang aktif
            'persyaratan' => $persyaratanModel->findAll(),  // Mengambil semua data persyaratan
            'validation' => \Config\Services::validation() // Validasi untuk form
        ];
        return view('Admin/Persyaratan/index', $data); // Mengembalikan view dengan data yang telah disiapkan
    }

    public function save() // Fungsi untuk menyimpan data persyaratan baru
    {
        $model = new persyaratanModel(); // Inisialisasi model persyaratan
        $validation = \Config\Services::validation(); // Inisialisasi layanan validasi
        $validation->setRules([ // Aturan validasi untuk nama persyaratan
            'nama_persyaratan' => [ // Aturan validasi
                'label' => 'Nama Persyaratan', // Label untuk field
                'rules' => 'required|is_unique[persyaratan.nama_persyaratan]', // Aturan: harus diisi dan unik
                'errors' => [ // Pesan kesalahan jika aturan tidak terpenuhi
                    'required' => '{field} harus diisi.',   // Pesan jika field tidak diisi
                ]
            ]
        ]);
        if (!$validation->run($this->request->getPost())) { // Jika validasi gagal
            // session()->setFlashdata('errors', $validation->getErrors());  
            session()->setFlashdata('error', 'Data Persyaratan gagal ditambahkan'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('/Persyaratan'); // Redirect ke halaman persyaratan
        }
        $data = [ // Data yang akan disimpan
            'nama_persyaratan' => $this->request->getPost('nama_persyaratan'), // Mengambil nama persyaratan dari input
            'status_persyaratan' => '1', // Status persyaratan aktif
            'created_at' => date('Y-m-d H:i:s'), // Waktu pembuatan
        ];
        $model->save($data); // Menyimpan data ke database
        session()->setFlashdata('success', 'Data Persyaratan berhasil ditambahkan'); // Menyimpan pesan sukses ke session
        return redirect()->to('/Persyaratan'); // Redirect ke halaman persyaratan
    }

    public function update($id) // Fungsi untuk mengupdate data persyaratan
    {
        $model = new persyaratanModel(); // Inisialisasi model persyaratan
        $validation = \Config\Services::validation(); // Inisialisasi layanan validasi
        $validation->setRules([ // Aturan validasi untuk nama persyaratan
            'nama_persyaratan' => [ // Aturan validasi
                'label' => 'Nama Persyaratan', // Label untuk field
                'rules' => 'required|is_unique[persyaratan.nama_persyaratan,id_persyaratan,' . $id . ']', // Aturan: harus diisi, unik kecuali untuk id yang sama
                'errors' => [ // Pesan kesalahan jika aturan tidak terpenuhi
                    'required' => '{field} harus diisi.', // Pesan jika field tidak diisi
                ]
            ]
        ]);
        if (!$validation->run($this->request->getPost())) { // Jika validasi gagal
            session()->setFlashdata('error', 'Data Persyaratan gagal diubah'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('/Persyaratan'); // Redirect ke halaman persyaratan
        } 
        $data = [ // Data yang akan diupdate
            'id_persyaratan' => $id, // ID persyaratan yang akan diupdate
            'nama_persyaratan' => $this->request->getPost('nama_persyaratan'),  // Mengambil nama persyaratan dari input
            'status_persyaratan' => '1', // Status persyaratan aktif
            'updated_at' => date('Y-m-d H:i:s'), // Waktu update
        ]; 
        $model->save($data); // Menyimpan data ke database
        session()->setFlashdata('success', 'Data Persyaratan berhasil diubah'); // Menyimpan pesan sukses ke session
        return redirect()->to('/Persyaratan'); // Redirect ke halaman persyaratan
    }

    public function update_status() // Fungsi untuk mengupdate status persyaratan
    {
        $model = new persyaratanModel(); // Inisialisasi model persyaratan
        $id = $this->request->getPost('id'); // Mengambil ID persyaratan dari input
        $data_persyaratan = $model->find($id); // Mencari data persyaratan berdasarkan ID
        if ($data_persyaratan) { // Jika data persyaratan ditemukan
            $status = $data_persyaratan['status_persyaratan'] == '1' ? '0' : '1'; // Toggle status
            $data = [ // Data yang akan diupdate
                'id_persyaratan' => $id, // ID persyaratan yang akan diupdate
                'status_persyaratan' => $status, // Status persyaratan baru
                'updated_at' => date('Y-m-d H:i:s'), // Waktu update
            ];
            $model->save($data); // Menyimpan data ke database
            return $this->response->setJSON(['status' => '200', 'message' => 'Status Persyaratan berhasil diubah', 'error' => false]); // Mengembalikan response JSON sukses
        } else {
            return $this->response->setJSON(['status' => '404', 'message' => 'Data Persyaratan tidak ditemukan', 'error' => true]); // Mengembalikan response JSON error jika data tidak ditemukan
        }
    }
    
    public function delete($id) // Fungsi untuk menghapus data persyaratan
    { 
        $model = new persyaratanModel(); // Inisialisasi model persyaratan
        $model->delete($id); // Menghapus data persyaratan berdasarkan ID
        session()->setFlashdata('success', 'Data User berhasil dihapus'); // Menyimpan pesan sukses ke session
        return redirect()->to('/Persyaratan'); // Redirect ke halaman persyaratan
    }
}
?>