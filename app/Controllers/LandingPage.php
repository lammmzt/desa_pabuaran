<?php 
namespace App\Controllers;

use App\Models\kartuKeluargaModel;
use App\Models\wargaModel;
use App\Models\usersModel;
use App\Models\dataDesaModel;
use Ramsey\Uuid\Uuid;

class LandingPage extends BaseController
{
    public function index() // Fungsi untuk menampilkan daftar Warga
    {
        $model = new kartuKeluargaModel(); // Inisialisasi model Kartu Keluarga
        $desaModel = new dataDesaModel();
        $datas_desa = $desaModel->first();
        $data = [ // Data yang akan dikirim ke view
            'title' => 'HOME | ' . $datas_desa['nama_desa'], // Judul halaman
            'datas_desa' => $datas_desa,
            'menu_active' => 'Home', // Menu yang aktif
            'keluarga' => $model->getkartuKeluarga(), // Mengambil semua data Warga dari model
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('LandingPage/Home', $data); // Mengembalikan view dengan data yang telah disiapkan
    }

    public function Panduan() // Fungsi untuk menampilkan daftar Warga
    {
        $model = new kartuKeluargaModel(); // Inisialisasi model Kartu Keluarga
        $desaModel = new dataDesaModel();
        $datas_desa = $desaModel->first();
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Panduan | ' . $datas_desa['nama_desa'], // Judul halaman
            'datas_desa' => $datas_desa,
            'menu_active' => 'Panduan', // Menu yang aktif
            'keluarga' => $model->getkartuKeluarga(), // Mengambil semua data Warga dari model
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('LandingPage/Panduan', $data); // Mengembalikan view dengan data yang telah disiapkan
    }
    public function Kontak() // Fungsi untuk menampilkan daftar Warga
    {
        $model = new kartuKeluargaModel(); // Inisialisasi model Kartu Keluarga
        $desaModel = new dataDesaModel();
        $datas_desa = $desaModel->first();
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Kontak | ' . $datas_desa['nama_desa'], // Judul halaman
            'datas_desa' => $datas_desa,
            'menu_active' => 'Kontak', // Menu yang aktif
            'keluarga' => $model->getkartuKeluarga(), // Mengambil semua data Warga dari model
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('LandingPage/Kontak', $data); // Mengembalikan view dengan data yang telah disiapkan
    }
}