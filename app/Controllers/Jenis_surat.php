<?php 
namespace App\Controllers;

use App\Models\jenisSuratModel;
use App\Models\detailJenisSuratModel;
use App\Models\persyaratanModel;
use Ramsey\Uuid\Uuid;

class Jenis_surat extends BaseController
{
    public function index() // Fungsi untuk menampilkan daftar jenis surat
    {
        $jenisSuratModel = new jenisSuratModel(); // Inisialisasi model jenis surat
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Jenis Surat', // Judul halaman
            'menu_active' => 'jenis_surat', // Menu yang aktif
            'jenis_surat' => $jenisSuratModel->findAll(), // Mengambil semua data jenis surat
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('Admin/jenis_surat/index', $data); // Mengembalikan view dengan data yang telah disiapkan
    }

    public function tambah() // Fungsi untuk menampilkan form tambah jenis surat
    {
        $persyaratanModel = new persyaratanModel(); // Inisialisasi model persyaratan
        $dataPersyaratan = $persyaratanModel->where('status_persyaratan', '1')->findAll(); // Mengambil semua data persyaratan yang aktif
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Tambah Jenis Surat', // Judul halaman
            'persyaratan' => $dataPersyaratan, // Data persyaratan yang akan ditampilkan di form
            'menu_active' => 'jenis_surat', // Menu yang aktif
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('Admin/jenis_surat/tambah', $data); // Mengembalikan view dengan data yang telah disiapkan
    }

    public function save() // Fungsi untuk menyimpan data jenis surat baru
    {
        $model = new jenisSuratModel(); // Inisialisasi model jenis surat
        $detailModel = new detailJenisSuratModel(); // Inisialisasi model detail jenis surat
        $validation = \Config\Services::validation(); // Inisialisasi layanan validasi
        $validation->setRules([ // Aturan validasi untuk nama jenis surat
            'nama_jenis_surat' => 'required|is_unique[jenis_surat.nama_jenis_surat]', // Aturan: harus diisi dan unik
            'kode_jenis_surat' => 'required', // Aturan validasi untuk kode jenis surat
            'ket_jenis_surat' => 'required', // Aturan validasi untuk keterangan jenis surat
            'template_jenis_surat' => 'required' // Aturan validasi untuk template jenis surat
        ]);
        if (!$validation->run($this->request->getPost())) { // Jika validasi gagal
            // session()->setFlashdata('errors', $validation->getErrors()); 
            session()->setFlashdata('error', 'Data Jenis Surat gagal ditambahkan'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('/Jenis_surat/Tambah'); // Redirect ke halaman tambah jenis surat
        }
        $id = Uuid::uuid4()->toString(); // Membuat ID unik untuk jenis surat
        $data = [ // Data yang akan disimpan
            'id_jenis_surat' => $id, // ID jenis surat
            'nama_jenis_surat' => $this->request->getPost('nama_jenis_surat'), // Mengambil nama jenis surat dari input
            'kode_jenis_surat' => $this->request->getPost('kode_jenis_surat'), // Mengambil kode jenis surat dari input
            'ket_jenis_surat' => $this->request->getPost('ket_jenis_surat'), // Mengambil keterangan jenis surat dari input
            'status_jenis_surat' => '1', // Status jenis surat aktif
            'template_jenis_surat' => $this->request->getPost('template_jenis_surat'), // Mengambil template jenis surat dari input
            'created_at' => date('Y-m-d H:i:s') // Waktu pembuatan
        ];
        $model->insert($data); // Menyimpan data jenis surat ke database
        $persyaratan = $this->request->getPost('persyaratan'); // Mengambil persyaratan yang dipilih dari input
        if ($persyaratan) { // Jika ada persyaratan yang dipilih
            foreach ($persyaratan as $id_persyaratan) { // Looping melalui setiap persyaratan
                $detailData = [ // Data detail jenis surat yang akan disimpan
                    'id_jenis_surat' => $id, // ID jenis surat yang baru dibuat
                    'id_persyaratan' => $id_persyaratan, // ID persyaratan yang dipilih
                    'created_at' => date('Y-m-d H:i:s') // Waktu pembuatan detail jenis surat
                ];
                $detailModel->save($detailData); // Menyimpan detail jenis surat ke database
            }
        }
        
        session()->setFlashdata('success', 'Data Jenis Surat berhasil ditambahkan'); // Menyimpan pesan sukses ke session
        return redirect()->to('/Jenis_surat'); // Redirect ke halaman jenis surat
    }

    public function edit($id) // Fungsi untuk menampilkan form edit jenis surat
    {
        $model = new jenisSuratModel(); // Inisialisasi model jenis surat
        $detailModel = new detailJenisSuratModel(); // Inisialisasi model detail jenis surat
        $persyaratanModel = new persyaratanModel(); // Inisialisasi model persyaratan
        $jenis_surat = $model->find($id); // Mencari jenis surat berdasarkan ID
        if (!$jenis_surat) { // Jika jenis surat tidak ditemukan
            session()->setFlashdata('error', 'Data Jenis Surat tidak ditemukan'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('/Jenis_surat'); // Redirect ke halaman jenis surat
        } 
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Edit Jenis Surat', // Judul halaman
            'menu_active' => 'jenis_surat', // Menu yang aktif
            'persyaratan' => $persyaratanModel->where('status_persyaratan', '1')->findAll(), // Mengambil semua data persyaratan yang aktif
            'detail_jenis_surat' => $detailModel->where('id_jenis_surat', $id)->findAll(), // Mengambil detail jenis surat berdasarkan ID
            'validation' => \Config\Services::validation(), // Validasi untuk form
            'jenis_surat' => $model->find($id) // Data jenis surat yang akan diedit
        ];
        // dd($data);
        return view('Admin/jenis_surat/edit', $data); // Mengembalikan view dengan data yang telah disiapkan
    }

    public function update() // Fungsi untuk mengupdate data jenis surat
    { 
        $model = new jenisSuratModel(); // Inisialisasi model jenis surat
        $detailModel = new detailJenisSuratModel(); // Inisialisasi model detail jenis surat
        
        $validation = \Config\Services::validation(); // Inisialisasi layanan validasi
        $id = $this->request->getPost('id_jenis_surat'); // Mengambil ID jenis surat dari input
        $jenis_surat = $model->find($id); // Mencari jenis surat berdasarkan ID
        if (!$jenis_surat) { // Jika jenis surat tidak ditemukan
            session()->setFlashdata('error', 'Data Jenis Surat tidak ditemukan'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('/Jenis_surat'); // Redirect ke halaman jenis surat
        }
        $validation->setRules([
            'nama_jenis_surat' => 'required|is_unique[jenis_surat.nama_jenis_surat,id_jenis_surat,' . $id . ']', // Aturan: harus diisi, unik kecuali untuk id yang sama
            'ket_jenis_surat' => 'required', // Aturan validasi untuk keterangan jenis surat
            'kode_jenis_surat' => 'required', // Aturan validasi untuk keterangan jenis surat
            'template_jenis_surat' => 'required' // Aturan validasi untuk template jenis surat
        ]);
        if (!$validation->run($this->request->getPost())) { // Jika validasi gagal
            // session()->setFlashdata('errors', $validation->getErrors()); 
            session()->setFlashdata('error', 'Data Jenis Surat gagal diubah'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('/Jenis_surat');  // Redirect ke halaman jenis surat
        }
        $data = [ // Data yang akan diupdate
            'nama_jenis_surat' => $this->request->getPost('nama_jenis_surat'), // Mengambil nama jenis surat dari input
            'ket_jenis_surat' => $this->request->getPost('ket_jenis_surat'), // Mengambil keterangan jenis surat dari input
            'kode_jenis_surat' => $this->request->getPost('kode_jenis_surat'), // Mengambil kode jenis surat dari input
            'template_jenis_surat' => $this->request->getPost('template_jenis_surat'), // Mengambil template jenis surat dari input
            'updated_at' => date('Y-m-d H:i:s') // Waktu update
        ]; 
        $model->update($id, $data); // Mengupdate data jenis surat di database
        $detailModel->where('id_jenis_surat', $id)->delete(); // Menghapus detail jenis surat yang lama
         // Mengambil persyaratan yang dipilih dari input
        $persyaratan = $this->request->getPost('persyaratan'); // Mengambil persyaratan yang dipilih dari input
        if ($persyaratan) { // Jika ada persyaratan yang dipilih
            foreach ($persyaratan as $id_persyaratan) { // Looping melalui setiap persyaratan
                $detailData = [ // Data detail jenis surat yang akan disimpan
                    'id_jenis_surat' => $id, // ID jenis surat yang akan diupdate
                    'id_persyaratan' => $id_persyaratan, // ID persyaratan yang dipilih
                    'created_at' => date('Y-m-d H:i:s') // Waktu pembuatan detail jenis surat
                ];
                $detailModel->save($detailData); // Menyimpan detail jenis surat ke database
            }
        }
        
        session()->setFlashdata('success', 'Data Jenis Surat berhasil diubah'); // Menyimpan pesan sukses ke session
         // Redirect ke halaman jenis surat
        return redirect()->to('/Jenis_surat');  // Redirect ke halaman jenis surat
    }

    public function delete($id)  // Fungsi untuk menghapus data jenis surat
    {
        $model = new jenisSuratModel(); // Inisialisasi model jenis surat
        $model->delete($id); // Menghapus data jenis surat berdasarkan ID
        session()->setFlashdata('success', 'Data Jenis Surat berhasil dihapus'); // Menyimpan pesan sukses ke session
         // Redirect ke halaman jenis surat
        return redirect()->to('/Jenis_surat'); // Redirect ke halaman jenis surat
    }

    public function update_status() // Fungsi untuk mengupdate status jenis surat
    {
        $model = new jenisSuratModel(); // Inisialisasi model jenis surat
        $id = $this->request->getPost('id'); // Mengambil ID jenis surat dari input
        $data_jenis_surat = $model->find($id); // Mencari data jenis surat berdasarkan ID
        if ($data_jenis_surat) { // Jika data jenis surat ditemukan
            $status = $data_jenis_surat['status_jenis_surat'] == '1' ? '0' : '1'; // Toggle status
            $data = [
                'id_jenis_surat' => $id, // ID jenis surat yang akan diupdate
                'status_jenis_surat' => $status, // Status jenis surat yang baru
                'updated_at' => date('Y-m-d H:i:s'), // Waktu update
            ];
            $model->save($data);
            return $this->response->setJSON(['status' => '200', 'message' => 'Status Jenis Surat berhasil diubah', 'error' => false]); // Mengembalikan response JSON sukses
        } else {
            return $this->response->setJSON(['status' => '404', 'message' => 'Data Jenis Surat tidak ditemukan', 'error' => true]); // Mengembalikan response JSON error jika data tidak ditemukan
        }
    }


    public function Duplikat($id) // Fungsi untuk menduplikat data jenis surat
    {
        $model = new jenisSuratModel(); // Inisialisasi model jenis surat
        $detailModel = new detailJenisSuratModel(); // Inisialisasi model detail jenis surat 

        $data_jenis_surat = $model->find($id); // Mencari data jenis surat berdasarkan ID
        if ($data_jenis_surat) { // Jika data jenis surat ditemukan
            $id_jenis_surat = Uuid::uuid4()->toString(); // Membuat ID unik untuk jenis surat
            $nama_jenis_surat = $data_jenis_surat['nama_jenis_surat'] . ' (Copy)'; // Nama jenis surat yang sama
            $checkNama = $model->where('nama_jenis_surat', $nama_jenis_surat)->find(); // Mencari jenis surat dengan nama yang sama
            if ($checkNama) { // Jika jenis surat dengan nama yang sama sudah ada
                $nama_jenis_surat = $data_jenis_surat['nama_jenis_surat'] . ' (Copy 2)'.date('Y-m-d H:i:s'); // Nama jenis surat yang sama
            }
            $data = [
                'id_jenis_surat' => $id_jenis_surat, // ID jenis surat yang baru
                'nama_jenis_surat' => $nama_jenis_surat, // Nama jenis surat yang sama
                'ket_jenis_surat' => $data_jenis_surat['ket_jenis_surat'], // ket_jenis_surat jenis surat yang sama
                'status_jenis_surat' => $data_jenis_surat['status_jenis_surat'], // Status jenis surat yang sama
                'template_jenis_surat' => $data_jenis_surat['template_jenis_surat'], // Template jenis surat yang sama
                'created_at' => date('Y-m-d H:i:s'), // Waktu pembuatan
            ];
            $model->insert($data);
            
            $detail_jenis_surat = $detailModel->where('id_jenis_surat', $id)->find(); // Mencari detail jenis surat berdasarkan ID jenis surat lama
            foreach ($detail_jenis_surat as $detail) { // Melakukan perulangan untuk setiap detail jenis surat
                $detailData = [ // Data detail jenis surat yang akan disimpan
                    'id_jenis_surat' => $id_jenis_surat, // ID jenis surat yang akan diupdate
                    'id_persyaratan' => $detail['id_persyaratan'], // ID persyaratan yang sama
                    'created_at' => date('Y-m-d H:i:s') // Waktu pembuatan detail jenis surat
                ];
                $model->save($data);
            }

            session()->setFlashdata('success', 'Data Jenis Surat berhasil di duplikat'); // Menyimpan pesan sukses ke session
            return redirect()->to('/Jenis_surat'); // Redirect ke halaman jenis surat
        }
    }

    public function getPersyartan() // Fungsi untuk mendapatkan persyaratan berdasarkan ID jenis surat
    {
        $detaiJenisSuratModel = new detailJenisSuratModel(); // Inisialisasi model detail jenis surat
        $id = $this->request->getPost('id'); // Mengambil ID jenis surat dari input
        $persyaratan = $detaiJenisSuratModel->getDetailJenisSuratByJenisSurat($id); // Mendapatkan persyaratan berdasarkan ID jenis surat
        if($persyaratan){ // Jika persyaratan ditemukan
            return $this->response->setJSON(['status' => '200', 'error' => false, 'data' => $persyaratan]); // Mengembalikan response JSON sukses
        }else{ // Jika persyaratan tidak ditemukan
            return $this->response->setJSON(['status' => '404', 'error' => true, 'data' =>'Persyaratan tidak ditemukan']); // Mengembalikan response JSON error
        }
    }
    
}
?>