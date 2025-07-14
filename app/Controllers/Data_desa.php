<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\dataDesaModel;
use Ramsey\Uuid\Uuid;

class Data_desa extends Controller
{
    public function index() // menampilkan data desa
    {
        $dataDesaModel = new dataDesaModel(); // membuat objek model data desa
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Data desa', // Judul halaman
            'menu_active' => 'Data_desa', // Menu yang aktif
            'data_desa' => $dataDesaModel->first(), // Mengambil semua data jenis surat
            'validation' => \Config\Services::validation()  // Validasi untuk form
        ];
        return view('Admin/Data_desa/index', $data); // tampilkan view data desa
    }

    public function save() // adalah fungsi untuk menyimpan data
    {
        // dd($this->request->getVar());
        if(!$this->validate([ // validasi inputan
            'nama_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama desa harus diisi'
                ]
            ],
            'nama_alias_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alias Nama desa harus diisi'
                ]
            ],
            'alamat_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat desa harus diisi'
                ]
            ],
            'no_tlp_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No. Telp desa harus diisi'
                ]
            ],
            'email_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email desa harus diisi'
                ]
            ],
            'nama_kepala_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kepala desa harus diisi'
                ]
            ],
            'nip_kepala_desa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NIP Kepala desa harus diisi'
                ]
            ]
        ])){ // jika validasi tidak terpenuhi
            session()->setFlashdata('errors', 'Data gagal diubah'); // set flashdata error
            return redirect()->to('/Data_desa')->withInput(); // redirect ke halaman data desa
        }

        $dataDesaModel = new dataDesaModel(); // membuat objek model data desa
        $check = $dataDesaModel->first(); // mengambil data desa
        // dd($check);  
        $logo_desa = $this->request->getFile('logo_desa'); // mengambil file logo desa
    
        if($check){ // jika data desa sudah ada
            if($logo_desa->getError() == 4){ // jika file logo desa tidak diubah
                $nama_logo_desa = $check['logo_desa']; // set nama logo desa
            }else{  // jika file logo desa diubah
                $nama_logo_desa = $logo_desa->getRandomName(); // set nama logo desa
                // jika tidak ada logo
                if($check['logo_desa'] != null){
                    unlink('Assets/img/data_desa/'.$check['logo_desa']); // hapus file logo desa
                }
                $logo_desa->move('Assets/img/data_desa', $nama_logo_desa); // upload file logo desa
            } 
            $dataDesaModel->update($check['id_data_desa'], [ // update data desa
                'nama_desa' => $this->request->getVar('nama_desa'),
                'nama_alias_desa' => $this->request->getVar('nama_alias_desa'),
                'alamat_desa' => $this->request->getVar('alamat_desa'),
                'no_tlp_desa' => $this->request->getVar('no_tlp_desa'),
                'email_desa' => $this->request->getVar('email_desa'),
                'nama_kepala_desa' => $this->request->getVar('nama_kepala_desa'),
                'nip_kepala_desa' => $this->request->getVar('nip_kepala_desa'),
                'logo_desa' => $nama_logo_desa,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }else{
            if($logo_desa->getError() == 4){ // jika file logo desa tidak diupload
                $nama_logo_desa = ''; // set nama logo desa
            }else{
                $nama_logo_desa = $logo_desa->getRandomName(); // set nama logo desa
                $logo_desa->move('Assets/img/data_desa', $nama_logo_desa); // upload file logo desa
            }
            $id_data_desa = Uuid::uuid4()->toString(); // generate id data desa
            $dataDesaModel->insert([ // insert data desa
                'id_data_desa' => $id_data_desa,
                'nama_desa' => $this->request->getVar('nama_desa'),
                'nama_alias_desa' => $this->request->getVar('nama_alias_desa'),
                'alamat_desa' => $this->request->getVar('alamat_desa'),
                'no_tlp_desa' => $this->request->getVar('no_tlp_desa'),
                'email_desa' => $this->request->getVar('email_desa'),
                'nama_kepala_desa' => $this->request->getVar('nama_kepala_desa'),
                'nip_kepala_desa' => $this->request->getVar('nip_kepala_desa'),
                'logo_desa' => $nama_logo_desa,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
        
        session()->setFlashdata('success', 'Data berhasil diubah'); // set flashdata success
        return redirect()->to('/Data_desa'); // redirect ke halaman data desa

    }

}
?>