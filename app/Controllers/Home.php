<?php

namespace App\Controllers;
use App\Models\usersModel;
use App\Models\jenisSuratModel;
use App\Models\kartuKeluargaModel;
use App\Models\pengajuanModel;
use App\Models\suratModel;
class Home extends BaseController
{
    public function index(): string
    {
        $userModel = new usersModel();
        $jenisSuratModel = new jenisSuratModel();
        $pengajuanModel = new pengajuanModel();
        $suratModel = new suratModel();
        $jumlah_pengguna = $userModel->countAllResults();
        $jumlah_jenis_surat = $jenisSuratModel->where('status_jenis_surat', '1')->countAllResults();
        $jumlah_pengajuan = $pengajuanModel->where('status_pengajuan', '3')->countAllResults();
        $jumlah_surat = $suratModel->countAllResults();
        if($this->request->getPost('tahun')){ // if year is selected
            $year = $this->request->getPost('tahun'); // get selected year
        }else{
            $year = date('Y'); // get current year
        }
        $data_grafik = [];
        for ($i = 1; $i <= 12; $i++) {
            $data_surat = $suratModel
                ->where('YEAR(created_at)', $year)
                ->where('MONTH(created_at)', $i)
                ->countAllResults(); // hitung jumlah surat masuk per bulan
            $data_pengajuan = $pengajuanModel
                ->where('YEAR(created_at)', $year)
                ->where('MONTH(created_at)', $i)
                ->countAllResults();
            $data_grafik[] = [
                'bulan' => $i,
                'data_surat' => $data_surat, // jumlah surat masuk per bulan
                'data_pengajuan' => $data_pengajuan // jumlah surat keluar per bulan
            ];
        }
        
        // dd($data_grafik);
        $data = [
            'title' => 'Dashboard',
            'menu_active' => 'dashboard',
            'jumlah_pengguna' => $jumlah_pengguna,
            'jumlah_jenis_surat' => $jumlah_jenis_surat,
            'jumlah_pengajuan' => $jumlah_pengajuan,
            'selected_year' => $year,
            'data_grafik' => $data_grafik,
            'jumlah_surat' => $jumlah_surat
        ];
        return view('Admin/Dashboard', $data);
    }
}