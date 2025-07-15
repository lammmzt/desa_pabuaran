<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\dataDesaModel;
use App\Models\jenisSuratModel;
use App\Models\detailJenisSuratModel;
use App\Models\persyaratanModel;
use App\Models\pengajuanModel;
use App\Models\detailPengajuanModel;
use Ramsey\Uuid\Uuid;

class Ajuan_surat extends BaseController
{
    public function index() // menampilkan data desa
    {
        $dataDesaModel = new dataDesaModel(); // membuat objek model data desa
        $pengajuanModel = new pengajuanModel();
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Ajuan Surat', // Judul halaman
            'menu_active' => 'Ajuan_surat', // Menu yang aktif
            'data_desa' => $dataDesaModel->first(), // Mengambil semua data jenis surat
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('Admin/Ajaun_surat/index', $data); // tampilkan view data desa
    }

    public function save(){
        $model = new pengajuanModel();
        $detailModel = new detailPengajuanModel();
        $detailJenisSuratModel = new detailJenisSuratModel();
        $id_pengajuan = Uuid::uuid4()->toString();
        $data = [
            'id_pengajuan' => $id_pengajuan,
            'id_jenis_surat' => $this->request->getVar('id_jenis_surat'),
            'id_warga' => $this->request->getVar('id_warga'),
            'keperluan_pengajuan' => $this->request->getVar('keperluan_pengajuan'),
            'ket_pengajuan_pengajuan' => $this->request->getVar('ket_pengajuan_pengajuan'),
            'status_pengajuan' => '0',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $model->insert($data);
        // chek detail jeni surat
        $detail_jenis_surat = $detailJenisSuratModel->where('id_jenis_surat', $this->request->getVar('id_jenis_surat'))->find();
        if($detail_jenis_surat){
            foreach ($detail_jenis_surat as $detail) {
                // upload file
                $file_detail_penajuan = $this->request->getFile($detail['id_persyaratan']);
                // checle file apakah foto atau bukan
                if ($file_detail_penajuan->isValid() && !$file_detail_penajuan->hasMoved()) {
                    $newName = $file_detail_penajuan->getRandomName();
                    $file_detail_penajuan->move('Assets/file_pengajuan', $newName);
                    $detailData = [
                        'id_pengajuan' => $id_pengajuan,
                        'id_persyaratan' => $detail['id_persyaratan'],
                        'file_detail_penajuan' => $newName,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    $detailModel->save($detailData);
                }else{
                    return $this->response->setJSON(['status' => '400', 'message' => 'Pengajuan gagal disimpan', 'error' => true]);
                }
            }
        }
        // return $this->response->setJSON(['status' => '200', 'data' => 'Pengajuan berhasil disimpan', 'error' => false]);
        session()->setFlashdata('success', 'Pengajuan berhasil disimpan');
        return redirect()->to(base_url('Ajuan'));
    }
}