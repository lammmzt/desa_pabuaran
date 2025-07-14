<?php 
namespace App\Controllers;

use App\Models\kartuKeluargaModel;
use App\Models\wargaModel;
use App\Models\usersModel;
use Ramsey\Uuid\Uuid;

class LandingPage extends BaseController
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
        return view('LandingPage/index', $data); // Mengembalikan view dengan data yang telah disiapkan
    }
}