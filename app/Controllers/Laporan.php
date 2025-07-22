<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\dataDesaModel;
use App\Models\jenisSuratModel;
use App\Models\detailJenisSuratModel;
use App\Models\persyaratanModel;
use App\Models\pengajuanModel;
use App\Models\detailPengajuanModel;
use App\Models\suratModel;
use App\Models\wargaModel;

class Laporan extends BaseController
{
    public function index() // menampilkan data desa
    {
        $dataDesaModel = new dataDesaModel(); // membuat objek model data desa
        $pengajuanModel = new pengajuanModel();
        $suratModel = new suratModel();

        $tanggalAwal = ''; // Inisialisasi tanggal awal
        $tanggalAkhir = ''; // Inisialisasi tanggal akhir
        if($this->request->getPost('tanggal_awal') && $this->request->getPost('tanggal_akhir')) {
            // Ambil tanggal awal dan akhir dari input
            $tanggalAwal = $this->request->getPost('tanggal_awal');
            $tanggalAkhir = $this->request->getPost('tanggal_akhir');

            // Ambil data surat keluar berdasarkan rentang tanggal
            $data['data_surat'] = $suratModel->getLaporanSurat($tanggalAwal, $tanggalAkhir);
            // dd($data['data_surat']);
        } else {
            // Jika tidak ada filter tanggal, ambil semua surat keluar
            $data['data_surat'] = $suratModel->getLaporanSurat('1990-01-01', '1999-12-31');
        }
        $data['title'] = 'Laporan Surat'; // Set judul halaman
        $data['menu_active'] = 'Laporan'; // Set menu aktif
        $data['tanggal_awal'] = $tanggalAwal; // Set tanggal awal ke data array
        $data['tanggal_akhir'] = $tanggalAkhir; // Set tanggal akhir ke data array

        return view('Admin/Laporan/Surat', $data);
    }

    public function cetakLaporan($tanggalAwal, $tanggalAkhir) // menampilkan data desa
    {
        $suratModel = new suratModel();
        $data['data_surat'] = $suratModel->getLaporanSurat($tanggalAwal, $tanggalAkhir);
        $data['title'] = 'Laporan Surat'; // Set judul halaman
        $data['menu_active'] = 'Laporan'; // Set menu aktif
        $data['tanggal_awal'] = $tanggalAwal; // Set tanggal awal ke data array
        $data['tanggal_akhir'] = $tanggalAkhir; // Set tanggal akhir ke data array
        return view('Admin/Laporan/cetakLaporan', $data);
    }

}