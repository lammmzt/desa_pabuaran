<?php 
namespace App\Controllers;

use App\Models\kartuKeluargaModel;
use App\Models\wargaModel;
use App\Models\usersModel;
use App\Models\dataDesaModel;
use App\Models\pengajuanModel;
use App\Models\jenisSuratModel;
use App\Models\detailJenisSuratModel;
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
        $desaModel = new dataDesaModel();
        $datas_desa = $desaModel->first();
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Panduan | ' . $datas_desa['nama_desa'], // Judul halaman
            'datas_desa' => $datas_desa,
            'menu_active' => 'Panduan', // Menu yang aktif
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('LandingPage/Panduan', $data); // Mengembalikan view dengan data yang telah disiapkan
    }
    public function Kontak() // Fungsi untuk menampilkan daftar Warga
    {
        $desaModel = new dataDesaModel();
        $datas_desa = $desaModel->first();
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Kontak | ' . $datas_desa['nama_desa'], // Judul halaman
            'datas_desa' => $datas_desa,
            'menu_active' => 'Kontak', // Menu yang aktif
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('LandingPage/Kontak', $data); // Mengembalikan view dengan data yang telah disiapkan
    }
    public function Data_keluarga() // Fungsi untuk menampilkan daftar Warga
    {
        $desaModel = new dataDesaModel();  // Inisialisasi model Desa
        $model = new kartuKeluargaModel(); // Inisialisasi model Kartu Keluarga
        $wargaModel = new wargaModel(); // Inisialisasi model Warga
        $datas_desa = $desaModel->first(); // Mengambil data Desa
        $id_user = session()->get('id_user'); // Mengambil ID user
        $data_keluarga = $model->getKeluargaByIduser($id_user); // Mengambil data Keluarga berdasarkan ID user
        $anggota_keluarga = $wargaModel->getWargaByIdKartuKeluarga($data_keluarga['id_kartu_keluarga']);
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Data keluarga | ' . $datas_desa['nama_desa'], // Judul halaman
            'datas_desa' => $datas_desa,
            'menu_active' => 'Data_keluarga', // Menu yang aktif
            'data_keluarga' => $data_keluarga,
            'anggota_keluarga' => $anggota_keluarga,
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('LandingPage/Data_keluarga', $data); // Mengembalikan view dengan data yang telah disiapkan
    }
    
    public function Ajuan(){
        $desaModel = new dataDesaModel();
        $pengajuanModel = new pengajuanModel();
        $kartuKeluargaModel = new kartuKeluargaModel();
        $wargaModel = new wargaModel();
        $jenisSuratModel = new jenisSuratModel();
        $datas_desa = $desaModel->first();
        $id_user = session()->get('id_user');
        $data_keluarga = $kartuKeluargaModel->getKeluargaByIduser($id_user);
        $data_pengajuan = $pengajuanModel->getAjuanByIdUser($id_user);
        $data_warga = $wargaModel->getWargaByIdKartuKeluarga($data_keluarga['id_kartu_keluarga']);
        // dd($data_pengajuan);
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Ajuan Surat | ' . $datas_desa['nama_desa'], // Judul halaman
            'datas_desa' => $datas_desa,
            'data_pengajuan' => $data_pengajuan,
            'data_warga' => $data_warga,
            'data_keluarga' => $data_keluarga,
            'data_jenis_surat' => $jenisSuratModel->where('status_jenis_surat', '1')->findAll(),
            'menu_active' => 'Ajuan', // Menu yang aktif
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('LandingPage/Ajuan', $data); // Mengembalikan view dengan data yang telah disiapkan
    }
}