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
use Ramsey\Uuid\Uuid;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;

class Ajuan_surat extends BaseController
{
    public function index() // menampilkan data desa
    {
        $dataDesaModel = new dataDesaModel(); // membuat objek model data desa
        $pengajuanModel = new pengajuanModel();
        $suratModel = new suratModel();
        $data_surat = $suratModel->getSurat();
        $role = session()->get('role'); 
        if($role == 'Kades'){
            $data_pengajuan = $pengajuanModel->getPengajuan()->where('status_pengajuan !=', '1')->Where('status_pengajuan !=', '0')->orderBy('created_at', 'DESC')->findAll();
        }else{
            $data_pengajuan = $pengajuanModel->getPengajuan()->orderBy('created_at', 'DESC')->findAll();
        }
        $array_surat = array_column($data_surat, 'id_pengajuan');
        // dd($data_surat);
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Ajuan Surat', // Judul halaman
            'menu_active' => 'Ajuan_surat', // Menu yang aktif
            'data_desa' => $dataDesaModel->first(), // Mengambil semua data jenis surat
            'data_ajuan' => $data_pengajuan,
            'data_surat' => $array_surat,
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('Admin/Ajuan_surat/index', $data); // tampilkan view data desa
    }

    public function Tambah(){
        $wargaModel = new wargaModel();
        $jenisSuratModel = new jenisSuratModel();
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Tambah Ajuan Surat', // Judul halaman
            'menu_active' => 'Ajuan_surat', // Menu yang aktif
            'data_warga' => $wargaModel->where('status_warga', '1')->findAll(),
            'data_jenis_surat' => $jenisSuratModel->where('status_jenis_surat', '1')->findAll(),
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('Admin/Ajuan_surat/tambah', $data);
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
            'status_pengajuan' => '1',
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
        }else{
            return $this->response->setJSON(['status' => '400', 'message' => 'Pengajuan gagal disimpan', 'error' => true]);
        }
        // return $this->response->setJSON(['status' => '200', 'data' => 'Pengajuan berhasil disimpan', 'error' => false]);
        session()->setFlashdata('success', 'Pengajuan berhasil disimpan');
        return redirect()->to(base_url('Ajuan'));
    }

    public function saveAdmin(){
        $model = new pengajuanModel();
        $detailModel = new detailPengajuanModel();
        $detailJenisSuratModel = new detailJenisSuratModel();
        $id_pengajuan = Uuid::uuid4()->toString();
        $data = [
            'id_pengajuan' => $id_pengajuan,
            'id_jenis_surat' => $this->request->getVar('id_jenis_surat'),
            'id_warga' => $this->request->getVar('id_warga'),
            'keperluan_pengajuan' => $this->request->getVar('keperluan_pengajuan'),
            'status_pengajuan' => '1',
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
                    session()->setFlashdata('error', 'Pengajuan gagal disimpan');
                    return redirect()->to(base_url('Ajuan_Surat/Tambah'))->withInput();
                }
            }
        }else{
            session()->setFlashdata('error', 'Pengajuan gagal disimpan');
            return redirect()->to(base_url('Ajuan_Surat/Tambah'))->withInput();
        }
        // return $this->response->setJSON(['status' => '200', 'data' => 'Pengajuan berhasil disimpan', 'error' => false]);
        session()->setFlashdata('success', 'Pengajuan berhasil disimpan');
        return redirect()->to(base_url('Ajuan_surat'));
    }

    public function edit($id_pengajuan){
        $wargaModel = new wargaModel();
        $jenisSuratModel = new jenisSuratModel();
        $pengajuanModel = new pengajuanModel();
        $detailPengajuanModel = new detailPengajuanModel();
        $data_pengajuan = $pengajuanModel->getPengajuan($id_pengajuan);
        $data_detail_pengajuan = $detailPengajuanModel->getDetailPengajuanByIdPengajuan($id_pengajuan);
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Edit Ajuan Surat', // Judul halaman
            'menu_active' => 'Ajuan_surat', // Menu yang aktif
            'data_warga' => $wargaModel->where('status_warga', '1')->findAll(),
            'data_jenis_surat' => $jenisSuratModel->where('status_jenis_surat', '1')->findAll(),
            'data_pengajuan' => $data_pengajuan,
            'data_detail_pengajuan' => $data_detail_pengajuan,
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        // dd($data);
        return view('Admin/Ajuan_surat/edit', $data);
    }
    
    public function detail($id_pengajuan){
        $wargaModel = new wargaModel();
        $jenisSuratModel = new jenisSuratModel();
        $pengajuanModel = new pengajuanModel();
        $detailPengajuanModel = new detailPengajuanModel();
        $suratModel = new suratModel();
        $data_pengajuan = $pengajuanModel->getPengajuan($id_pengajuan);
        $data_detail_pengajuan = $detailPengajuanModel->getDetailPengajuanByIdPengajuan($id_pengajuan);
        $data_surat = $suratModel->getSuratByIdPengajuan($id_pengajuan);
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Edit Ajuan Surat', // Judul halaman
            'menu_active' => 'Ajuan_surat', // Menu yang aktif
            'data_warga' => $wargaModel->where('status_warga', '1')->findAll(),
            'data_jenis_surat' => $jenisSuratModel->where('status_jenis_surat', '1')->findAll(),
            'data_pengajuan' => $data_pengajuan,
            'data_detail_pengajuan' => $data_detail_pengajuan,
            'data_surat' => $data_surat,
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        // dd($data);
        return view('Admin/Ajuan_surat/detail', $data);
    }

    public function updateAdmin(){
        $model = new pengajuanModel();
        $detailModel = new detailPengajuanModel();
        $detailJenisSuratModel = new detailJenisSuratModel();
        $id_pengajuan = $this->request->getVar('id_pengajuan');
        $data = [
            'id_warga' => $this->request->getVar('id_warga'),
            'keperluan_pengajuan' => $this->request->getVar('keperluan_pengajuan'),
            'status_pengajuan' =>   $this->request->getVar('status_pengajuan'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $model->update($id_pengajuan, $data);
        // jika ada upload file jenis surat
        $data_detail = $detailModel->getDetailPengajuanByIdPengajuan($id_pengajuan);
        if($data_detail){
            foreach ($data_detail as $detail) {
                // upload file
                $file_detail_penajuan = $this->request->getFile($detail['id_detail_pengajuan']);
                // checle file apakah foto atau bukan
                if ($file_detail_penajuan->isValid() && !$file_detail_penajuan->hasMoved()) {
                    // hapus file lama
                    $file_lama = $detail['file_detail_penajuan'];
                    unlink('Assets/file_pengajuan/' . $file_lama);

                    $newName = $file_detail_penajuan->getRandomName();
                    $file_detail_penajuan->move('Assets/file_pengajuan', $newName);

                    $detailData = [
                        'file_detail_penajuan' => $newName,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    $detailModel->update($detail['id_detail_pengajuan'], $detailData);
                }
            }
        }
        
        // return $this->response->setJSON(['status' => '200', 'data' => 'Pengajuan berhasil disimpan', 'error' => false]);
        session()->setFlashdata('success', 'Pengajuan berhasil diubah');
        return redirect()->back();
    }

     public function proses($id_pengajuan){
        $wargaModel = new wargaModel();
        $jenisSuratModel = new jenisSuratModel();
        $pengajuanModel = new pengajuanModel();
        $detailPengajuanModel = new detailPengajuanModel();
        $data_pengajuan = $pengajuanModel->getPengajuan($id_pengajuan);
        $data_detail_pengajuan = $detailPengajuanModel->getDetailPengajuanByIdPengajuan($id_pengajuan);
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Proses Ajuan Surat', // Judul halaman
            'menu_active' => 'Ajuan_surat', // Menu yang aktif
            'data_warga' => $wargaModel->where('status_warga', '1')->findAll(),
            'data_jenis_surat' => $jenisSuratModel->where('status_jenis_surat', '1')->findAll(),
            'data_pengajuan' => $data_pengajuan,
            'data_detail_pengajuan' => $data_detail_pengajuan,
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        // dd($data);
        return view('Admin/Ajuan_surat/proses', $data);
    }
    public function updateProses(){
        $model = new pengajuanModel();
        $jenisSuratModel = new jenisSuratModel();
        $wargaModel = new wargaModel();
        $suratModel = new suratModel();
        $desaModel = new dataDesaModel();
        $id_pengajuan = $this->request->getVar('id_pengajuan');
    
        $data = [
            'status_pengajuan' => $this->request->getVar('status_pengajuan'),
            'ket_pengajuan' => $this->request->getVar('ket_pengajuan'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        
        $model->update($id_pengajuan, $data);
        if($this->request->getVar('status_pengajuan') == '3'){
            $data_desa = $desaModel->first();
            $surat_terakhir = $suratModel->getNomorSurat();
            $data_pengajuan = $model->getPengajuan($id_pengajuan);
            $warga = $wargaModel->getWarga($data_pengajuan['id_warga']);
            $no_surat = ($surat_terakhir != null ? $surat_terakhir['no_surat'] + 1 : 1);
            $data_jenis_surat = $jenisSuratModel->find($data_pengajuan['id_jenis_surat']);
             $bulan_indo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']; // array bulan indo
            //  dd($data_jenis_surat, $data_pengajuan, $surat_terakhir);
            $id_surat = 'SR-' . date('Y') . '-' . $no_surat;
            $template_surat = $data_jenis_surat['template_jenis_surat'];
            $isi_surat['nomor_surat'] = $data_jenis_surat['kode_jenis_surat'] . '/' . $no_surat ;
            $isi_surat['tanggal_surat'] = date('d') . ' ' . $bulan_indo[date('n') - 1] . ' ' . date('Y');
            $isi_surat['ttd_kepala_desa'] = '<img src="' . base_url('Assets/ttd_surat/'. $id_surat . '.png') . '" width="120px">';
            $isi_surat['nama_kepala_desa'] = $data_desa['nama_kepala_desa'];
            $isi_surat['nip_kepala_desa'] = $data_desa['nip_kepala_desa'];
            $nama_file = 'Assets/ttd_surat/' . $id_surat . '.png'; // set nama file surat keluar
            $url = base_url('Ajuan_surat/preview_hasil/' . $id_surat); // set url surat
            if (file_exists($nama_file)) { // jika file sudah ada
                unlink($nama_file); // hapus file
            }
            $result = Builder::create() // buat qr code
                    ->writer(new PngWriter())
                    ->writerOptions([])
                    ->data($url)
                    ->encoding(new Encoding('UTF-8'))
                    ->errorCorrectionLevel(ErrorCorrectionLevel::High)
                    ->size(300)
                    ->margin(10)
                    ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
                    ->logoPath('Assets/img/data_desa/' . $data_desa['logo_desa'])
                    ->logoResizeToWidth(50)
                    ->logoPunchoutBackground(true)
                    // ->labelText('This is the label')
                    // ->labelFont(new NotoSans(20))
                    // ->labelAlignment(LabelAlignment::Center)
                    ->validateResult(false)
                    ->build();
                    
            $result->saveToFile('Assets/ttd_surat/' . $id_surat . '.png'); // simpan file qr code
            // masukan data warga kedalam form
            foreach ($warga as $key => $val) {
                $isi_surat[$key] = $val;
            }
            // dd($isi_surat);
            foreach ($isi_surat as $key => $val) {
                if (strpos($key, 'tanggal') !== false) { // jika ada {} pada key
                    $val = date('d', strtotime($val)) . ' ' . $bulan_indo[date('n', strtotime($val)) - 1] . ' ' . date('Y', strtotime($val)); // format tanggal surat keluar
                }
                $template_surat = str_replace('{' . $key . '}', $val, $template_surat);
            }
            // dd($template_surat);
            $insert_sruat = [
                'id_surat' => $id_surat,
                'id_pengajuan' => $id_pengajuan,
                'no_surat' => $data_jenis_surat['kode_jenis_surat'] . '/' . $no_surat,
                'tanggal_surat' => date('Y-m-d'),
                'data_surat' => $template_surat,
                'status_surat' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $suratModel->insert($insert_sruat);
        }
        session()->setFlashdata('success', 'Pengajuan berhasil diupdate');
        return redirect()->to(base_url('Ajuan_surat'));
    }
    
    public function preview_hasil($id) // menampilkan preview surat keluar
    {
        $suratModel = new suratModel();
        $data_surat =  $suratModel->getSuratByIdPengajuan($id);
        if(!$data_surat){ // jika data surat tidak ada
            session()->setFlashdata('error', 'Surat tidak ditemukan');
            return redirect()->back();
        }
        // dd($data_surat);
        $data['template'] = $data_surat['data_surat'];
        $data['title'] = 'Preview Surat Keluar'; // untuk set judul halaman
        $data['active'] = 'preview_surat'; // set active menu  
        return view('Surat/print_prev', $data); // tampilkan view edit surat keluar
    }
}