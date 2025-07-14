<?php 
namespace App\Controllers;

use App\Models\kartuKeluargaModel;
use App\Models\wargaModel;
use App\Models\usersModel;
use Ramsey\Uuid\Uuid;

class Keluarga extends BaseController
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
        return view('Admin/Warga/index', $data); // Mengembalikan view dengan data yang telah disiapkan
    }


    public function save() // Fungsi untuk menyimpan data Warga baru
    {
        $model = new kartuKeluargaModel(); // Inisialisasi model Kartu Keluarga
        $usersModel = new usersModel(); // Inisialisasi model User

        $validation = \Config\Services::validation(); // Inisialisasi layanan validasi
        $validation->setRules([
            'id_kartu_keluarga' => [
                'label' => 'No. KK',
                'rules' => 'required|min_length[16]|max_length[16]|is_unique[kartu_keluarga.id_kartu_keluarga]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 16 karakter.',
                    'max_length' => '{field} maksimal 16 karakter.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'nama_kartu_keluarga' => [
                'label' => 'Nama Kartu Keluarga',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'alamat_kartu_keluarga' => [
                'label' => 'Alamat Kartu Keluarga',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'rt_kartu_keluarga' => [
                'label' => 'RT Kartu Keluarga',
                'rules' => 'required|min_length[3]|max_length[3]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 3 karakter.'
                ]
            ],
            'rw_kartu_keluarga' => [
                'label' => 'RW Kartu Keluarga',
                'rules' => 'required|min_length[3]|max_length[3]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 3 karakter.'
                ]
            ],
            'foto_kartu_keluarga' => [
                'label' => 'Foto Kartu Keluarga',
                'rules' => 'mime_in[foto_kartu_keluarga,image/jpg,image/jpeg,image/png]|max_size[foto_kartu_keluarga,2048]',
                'errors' => [
                    'mime_in' => '{field} harus berupa file gambar (jpg, jpeg, png).',
                    'max_size' => '{field} maksimal ukuran 2MB.'
                ]
            ],
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
        if (!$validation->run($this->request->getPost())) { // Jika validasi gagal
            // session()->setFlashdata('errors', $validation->getErrors());
            session()->setFlashdata('error', 'Data Keluarga gagal ditambahkan'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('Keluarga'); // Redirect ke halaman tambah keluarga
        }
        // check username already exists
        $checkUsername = $usersModel->where('username', $this->request->getPost('id_kartu_keluarga'))->first();
        if ($checkUsername) { // Jika username sudah ada
            session()->setFlashdata('error', 'No. KK sudah terdaftar sebagai user'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('Keluarga'); // Redirect ke halaman tambah keluarga
        }
        // insert to user
        $id_user = Uuid::uuid4()->toString(); // Generate UUID untuk id
        $usersModel->insert([
            'id_user' => $id_user,
            'nama_user' => $this->request->getPost('nama_kartu_keluarga'),
            'username' => $this->request->getPost('id_kartu_keluarga'),
            'password' => password_hash($this->request->getPost('id_kartu_keluarga'), PASSWORD_DEFAULT),
            'role' => 'Warga',
            'alamat_user' => $this->request->getPost('alamat_kartu_keluarga'),
            'status_user' => '1',
            'created_at' => date('Y-m-d H:i:s'),    
        ]);
        $foto = $this->request->getFile('foto_kartu_keluarga'); // Mengambil file foto dari request
        $fotoName = $foto->getRandomName(); // Menghasilkan nama file acak
        $foto->move('Assets/foto_kk/', $fotoName); // Memindahkan file ke direktori yang ditentukan
        $data = [ // Data yang akan disimpan
            'id_kartu_keluarga' => $this->request->getPost('id_kartu_keluarga'),
            'id_user' => $id_user,
            'nama_kartu_keluarga' => $this->request->getPost('nama_kartu_keluarga'),
            'alamat_kartu_keluarga' => $this->request->getPost('alamat_kartu_keluarga'),
            'rt_kartu_keluarga' => $this->request->getPost('rt_kartu_keluarga'),
            'rw_kartu_keluarga' => $this->request->getPost('rw_kartu_keluarga'),
            'foto_kartu_keluarga' => $fotoName,
            'status_kartu_keluarga' => '1',
            'no_tpl_kartu_keluarga' => $this->request->getPost('no_tpl_kartu_keluarga'),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $model->insert($data); // Menyimpan data ke database
        session()->setFlashdata('success', 'Data Keluarga berhasil ditambahkan'); // Menyimpan pesan sukses ke session
        return redirect()->to('Keluarga'); // Redirect ke halaman keluarga
    }


    public function update() // Fungsi untuk memperbarui data Keluarga
    {
        $model = new kartuKeluargaModel(); // Inisialisasi model Kartu Keluarga
        $usersModel = new usersModel(); // Inisialisasi model User
        $id = $this->request->getPost('id_kartu_keluarga'); // Mengambil id dari request
        $validation = \Config\Services::validation(); // Inisialisasi layanan validasi
        $validation->setRules([
            'no_kk' => [
                'label' => 'No. KK',
                'rules' => 'required|min_length[16]|max_length[16]|is_unique[kartu_keluarga.id_kartu_keluarga,id_kartu_keluarga,' . $id . ']',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 16 karakter.',
                    'max_length' => '{field} maksimal 16 karakter.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'nama_kartu_keluarga' => [
                'label' => 'Nama Kartu Keluarga',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'alamat_kartu_keluarga' => [
                'label' => 'Alamat Kartu Keluarga',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'rt_kartu_keluarga' => [
                'label' => 'RT Kartu Keluarga',
                'rules' => 'required|min_length[3]|max_length[3]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 3 karakter.'
                ]
            ],
            'rw_kartu_keluarga' => [
                'label' => 'RW Kartu Keluarga',
                'rules' => 'required|min_length[3]|max_length[3]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 3 karakter.'
                ]
            ],
            
            
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
        if (!$validation->run($this->request->getPost())) { // Jika validasi gagal
            dd($validation->getErrors()); // Debugging untuk melihat kesalahan validasi
            // session()->setFlashdata('errors', $validation->getErrors());
            session()->setFlashdata('error', 'Data Keluarga gagal diperbarui'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('Keluarga'); // Redirect ke halaman keluarga
        }

        // Jika validasi berhasil, lakukan update data
        $data = [
            'id_kartu_keluarga' => $this->request->getPost('no_kk'),
            'nama_kartu_keluarga' => $this->request->getPost('nama_kartu_keluarga'),
            'alamat_kartu_keluarga' => $this->request->getPost('alamat_kartu_keluarga'),
            'rt_kartu_keluarga' => $this->request->getPost('rt_kartu_keluarga'),
            'rw_kartu_keluarga' => $this->request->getPost('rw_kartu_keluarga'),
            'status_kartu_keluarga' => $this->request->getPost('status_kartu_keluarga'),
            'no_tpl_kartu_keluarga' => $this->request->getPost('no_tpl_kartu_keluarga'),
        ];
        $fileNew = $this->request->getFile('foto_kartu_keluarga'); // Mengambil file foto dari request
        // Cek apakah ada file foto yang diupload
        if ($fileNew->isValid() && !$fileNew->hasMoved()) {
            // chek apakah file foto sudah ada sebelumnya
            $oldFoto = $model->find($id)['foto_kartu_keluarga'];
            if ($oldFoto) {
                // Hapus file foto lama jika ada
                if (file_exists('Assets/foto_kk/' . $oldFoto)) {
                    unlink('Assets/foto_kk/' . $oldFoto);
                }
            }
            $fotoName = $fileNew->getRandomName(); // Menghasilkan nama file acak
            $fileNew->move('Assets/foto_kk/', $fotoName); // Memindahkan file ke direktori yang ditentukan
            $data['foto_kartu_keluarga'] = $fotoName; // Menambahkan nama file foto ke data
        } 
        $model->update($id, $data); // Update data ke database
        // update user
        $usersModel->update($model->find($id)['id_user'], [
            'nama_user' => $this->request->getPost('nama_kartu_keluarga'),
            'alamat_user' => $this->request->getPost('alamat_kartu_keluarga'),
            'username' => $this->request->getPost('no_kk'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        session()->setFlashdata('success', 'Data Keluarga berhasil diperbarui'); // Menyimpan pesan sukses ke session
        return redirect()->to('Keluarga'); // Redirect ke halaman keluarga
    }
    
    public function DetailKeluarga($id)
    {
        $model = new kartuKeluargaModel(); // Inisialisasi model Kartu Keluarga
        $wargaModel = new wargaModel(); // Inisialisasi model Warga
        $data = [ // Data yang akan dikirim ke view
            'title' => 'Detail Keluarga',
            'menu_active' => 'Keluarga',
            'keluarga' => $model->getkartuKeluarga($id), // Mengambil data Keluarga berdasarkan id
            'anggota_keluarga' => $wargaModel->where('id_kartu_keluarga', $id)->findAll(), // Mengambil anggota keluarga berdasarkan id_kartu_keluarga
        ];
        // dd($data); // Debugging untuk melihat data yang akan dikirim ke view
        return view('Admin/Warga/detail', $data); // Mengembalikan view dengan data yang telah disiapkan
    }

    public function saveWarga() // Fungsi untuk menyimpan data Warga baru
    {
        $model = new wargaModel(); // Inisialisasi model Warga
        $validation = \Config\Services::validation(); // Inisialisasi layanan validasi
        $validation->setRules([
            'id_warga' => 'required|is_unique[warga.id_warga]', // Aturan validasi untuk id_warga
            'id_kartu_keluarga' => 'required',
            'nama_warga' => 'required',
            'tempat_lahir_warga' => 'required',
            'tanggal_lahir_warga' => 'required',
            'agama_warga' => 'required',
            'pekerjaan_warga' => 'required',
            'status_kawin_warga' => 'required',
            'shdk_warga' => 'required',
            'kebangsaan_warga' => 'required',
            'pendidikan_warga' => 'required',
            'berkas_ktp_warga' => 'mime_in[berkas_ktp_warga,image/jpg,image/jpeg,image/png]|max_size[berkas_ktp_warga,2048]',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
        if (!$validation->run($this->request->getPost())) { // Jika validasi gagal
            session()->setFlashdata('error', 'Data Warga gagal ditambahkan'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('Keluarga/DetailKeluarga/' . $this->request->getPost('id_kartu_keluarga')); // Redirect ke halaman detail keluarga
        }
        $berkas = $this->request->getFile('berkas_ktp_warga'); // Mengambil file berkas KTP dari request
        $berkasName = $berkas->getRandomName(); // Menghasilkan nama file
        $berkas->move('Assets/berkas_ktp/', $berkasName); // Memindahkan file ke direktori yang ditentukan
        // Menyimpan data Warga ke database
        $data = [ // Data yang akan disimpan
            'id_warga' => $this->request->getPost('id_warga'),
            'id_kartu_keluarga' => $this->request->getPost('id_kartu_keluarga'),
            'nama_warga' => $this->request->getPost('nama_warga'),
            'tempat_lahir_warga' => $this->request->getPost('tempat_lahir_warga'),
            'tanggal_lahir_warga' => $this->request->getPost('tanggal_lahir_warga'),
            'agama_warga' => $this->request->getPost('agama_warga'),
            'pekerjaan_warga' => $this->request->getPost('pekerjaan_warga'),
            'status_kawin_warga' => $this->request->getPost('status_kawin_warga'),
            'shdk_warga' => $this->request->getPost('shdk_warga'),
            'kebangsaan_warga' => $this->request->getPost('kebangsaan_warga'),
            'pendidikan_warga' => $this->request->getPost('pendidikan_warga'),
            'berkas_ktp_warga' => $berkasName,
            'status_warga' => '1',
        ];
        $model->insert($data); // Menyimpan data ke database
        session()->setFlashdata('success', 'Data Warga berhasil ditambahkan'); // Menyimpan pesan sukses ke session
        return redirect()->to('Keluarga/DetailKeluarga/' . $this->request->getPost('id_kartu_keluarga')); // Redirect ke halaman detail keluarga
    }

    public function updateWarga() // Fungsi untuk memperbarui data Warga
    {
        $model = new wargaModel(); // Inisialisasi model Warga
        $id = $this->request->getPost('id_warga'); // Mengambil id dari request
        $validation = \Config\Services::validation(); // Inisialisasi layanan validasi
        $validation->setRules([
            'nik' => 'required|is_unique[warga.id_warga,id_warga,' . $id . ']', // Aturan validasi untuk id_warga
            'id_kartu_keluarga' => 'required',
            'nama_warga' => 'required',
            'tempat_lahir_warga' => 'required',
            'tanggal_lahir_warga' => 'required',
            'agama_warga' => 'required',
            'pekerjaan_warga' => 'required',
            'status_kawin_warga' => 'required',
            'shdk_warga' => 'required',
            'kebangsaan_warga' => 'required',
            'pendidikan_warga' => 'required',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
        if (!$validation->run($this->request->getPost())) { // Jika validasi gagal
            session()->setFlashdata('error', 'Data Warga gagal diperbarui'); // Menyimpan pesan kesalahan ke session
            return redirect()->to('Keluarga/DetailKeluarga/' . $this->request->getPost('id_kartu_keluarga')); // Redirect ke halaman detail keluarga
        }
        $data = [ // Data yang akan disimpan
            'id_kartu_keluarga' => $this->request->getPost('id_kartu_keluarga'),
            'id_warga' => $this->request->getPost('nik'),
            'nama_warga' => $this->request->getPost('nama_warga'),
            'tempat_lahir_warga' => $this->request->getPost('tempat_lahir_warga'),
            'tanggal_lahir_warga' => $this->request->getPost('tanggal_lahir_warga'),
            'agama_warga' => $this->request->getPost('agama_warga'),
            'pekerjaan_warga' => $this->request->getPost('pekerjaan_warga'),
            'status_kawin_warga' => $this->request->getPost('status_kawin_warga'),
            'shdk_warga' => $this->request->getPost('shdk_warga'),
            'kebangsaan_warga' => $this->request->getPost('kebangsaan_warga'),
            'pendidikan_warga' => $this->request->getPost('pendidikan_warga'),
            'status_warga' => $this->request->getPost('status_warga'),
        ];
        $fileNew = $this->request->getFile('berkas_ktp_warga'); // Mengambil file berkas KTP dari request
        // Cek apakah ada file berkas KTP yang diupload
        if ($fileNew->isValid() && !$fileNew->hasMoved()) {
            // Cek apakah file berkas KTP sudah ada sebelumnya
            $oldBerkas = $model->find($id)['berkas_ktp_warga'];
            if ($oldBerkas) {
                // Hapus file berkas KTP lama jika ada
                if (file_exists('Assets/berkas_ktp/' . $oldBerkas)) {
                    unlink('Assets/berkas_ktp/' . $oldBerkas);
                }
            }
            $berkasName = $fileNew->getRandomName(); // Menghasilkan nama file acak
            $fileNew->move('Assets/berkas_ktp/', $berkasName); // Memindahkan file ke direktori yang ditentukan
            $data['berkas_ktp_warga'] = $berkasName; // Menambahkan nama file berkas KTP ke data
        }
        $model->update($id, $data); // Update data ke database
        session()->setFlashdata('success', 'Data Warga berhasil diperbarui'); // Menyimpan pesan sukses ke session
        return redirect()->to('Keluarga/DetailKeluarga/' . $this->request->getPost('id_kartu_keluarga')); // Redirect ke halaman detail keluarga
    }
}
?>