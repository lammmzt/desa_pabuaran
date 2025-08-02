<?= $this->extend('LandingPage/Template/index'); ?>
<?= $this->section('content'); ?>
<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade"
    style="background-image: url('<?= base_url('Assets/LandingPage/img/bg_apps.png'); ?>');">
    <!-- <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);"> -->
    <div class="container position-relative">
        <h1>Data Keluarga</h1>
        <!-- <p>
                Data Keluarga pendukung aplikasi Administrasi Kependudukan.
            </p> -->
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="current">Data Keluarga</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->
<section id="contact" class="contact section">

    <div class="container">
        <div class="row mb-2">
            <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> <?= session()->getFlashdata('success'); ?>

            </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> <?= session()->getFlashdata('error'); ?>

            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <h3 class="text-center fw-bold mb-4">Data Kartu Keluarga</h3>
            <form action="<?= base_url('Keluarga/updateUser'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_kartu_keluarga" value="<?= $data_keluarga['id_kartu_keluarga']; ?>">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="form-group mb-2">
                            <label for="no_kk">No. KK</label>
                            <input type="text" name="no_kk" id="no_kk" class="form-control mt-1" required
                                placeholder="Masukkan No. KK" minlength="16" maxlength="16"
                                value="<?= $data_keluarga['id_kartu_keluarga']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group mb-2">
                            <label for="nama_kartu_keluarga">Nama Kartu Keluarga</label>
                            <input type="text" name="nama_kartu_keluarga" id="nama_kartu_keluarga"
                                class="form-control mt-1" required placeholder="Masukkan Nama Kartu Keluarga"
                                value="<?= $data_keluarga['nama_kartu_keluarga']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group mb-2">
                            <label for="alamat_kartu_keluarga">Alamat Kartu Keluarga</label>
                            <input type="text" name="alamat_kartu_keluarga" id="alamat_kartu_keluarga"
                                class="form-control mt-1" required placeholder="Masukkan Alamat Kartu Keluarga"
                                value="<?= $data_keluarga['alamat_kartu_keluarga']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group mb-2">
                            <label for="rt_kartu_keluarga">RT</label>
                            <input type="text" name="rt_kartu_keluarga" id="rt_kartu_keluarga" class="form-control mt-1"
                                required placeholder="Masukkan RT Kartu Keluarga" minlength="3" maxlength="3"
                                value="<?= $data_keluarga['rt_kartu_keluarga']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group mb-2">
                            <label for="rw_kartu_keluarga">RW</label>
                            <input type="text" name="rw_kartu_keluarga" id="rw_kartu_keluarga" class="form-control mt-1"
                                required placeholder="Masukkan RW Kartu Keluarga" minlength="3" maxlength="3"
                                value="<?= $data_keluarga['rw_kartu_keluarga']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group mb-2">
                            <label for="no_tpl_kartu_keluarga">No. Whatsapp</label>
                            <input type="text" name="no_tpl_kartu_keluarga" id="no_tpl_kartu_keluarga"
                                class="form-control mt-1" required placeholder="Masukkan No. Whatsapp" minlength="10"
                                maxlength="15" value="<?= $data_keluarga['no_tpl_kartu_keluarga']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="foto_kartu_keluarga">Foto Kartu Keluarga</label>
                            <input type="file" name="foto_kartu_keluarga" class="form-control mt-1"
                                accept=".jpg, .jpeg, .png">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="preview_kartu_keluarga">Preview</label>
                            <a class="form-control mt-1"
                                href="<?= base_url('Assets/foto_kk/' . $data_keluarga['foto_kartu_keluarga']); ?>"
                                style="text-decoration: none; border: none; color: #000;" target="_blank"><img
                                    src="<?= base_url('Assets/img/icon-kk.png'); ?>" alt="Foto KK" class="img-thumbnail"
                                    width="100">
                            </a>

                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
        <hr style="border: 1px solid #000;">
        <h3 class="text-center fw-bold mb-4">Data Anggota Keluarga</h3>
        <div class="row">
            <div class="col-12 mb-4">
                <a class="btn btn-primary btn-sm text-white float-right" data-bs-toggle="modal"
                    data-bs-target="#addModal">Tambah
                    Data</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped my-2" width="100%" cellspacing="0" id="anggota_keluarga">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th width="5%" class="text-center">No</th>
                            <th>Nama</th>
                            <th class="text-center">NIK</th>
                            <th width="10%" class="text-center">SHDK</th>
                            <th class="text-center">KTP</th>
                            <th class="text-center">Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                            foreach ($anggota_keluarga as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $value['nama_warga']; ?></td>
                            <td class="text-center"><?= $value['id_warga']; ?></td>
                            <td class="text-center">
                                <?= $value['shdk_warga']; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('Assets/berkas_ktp/' . $value['berkas_ktp_warga']); ?>"
                                    style="text-decoration: none; border: none; color: #000;" target="_blank"><img
                                        src="<?= base_url('Assets/img/icon-kk.png'); ?>" alt="Foto KK"
                                        class="img-thumbnail" width="100"></a>
                            </td>
                            <td class="text-center" style="width: 10%;">
                                <?php if ($value['status_warga'] == '1') { ?>
                                Hidup
                                <?php } else { ?>
                                Meninggal
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <a haref="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal<?= $value['id_warga']; ?>">Edit</a>
                                <!-- <a haref="#" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#detail<?= $value['id_warga']; ?>">Detail</a> -->
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section><!-- /Contact Section -->
<!-- Modal add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Keluarga/saveUserWarga'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id_kartu_keluarga"
                            value="<?= $data_keluarga['id_kartu_keluarga']; ?>">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="id_warga">No. NIK</label>
                                <input type="text" name="id_warga" id="id_warga" class="form-control mt-1" required
                                    placeholder="Masukkan No. KK" minlength="16" maxlength="16">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="nama_warga">Nama Lengkap</label>
                                <input type="text" name="nama_warga" id="nama_warga" class="form-control mt-1" required
                                    placeholder="Masukkan Nama Lengkap">
                            </div>
                        </div>
                        <!-- jenis_kelamin_warga -->
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="jenis_kelamin_warga">Jenis Kelamin</label>
                                <select name="jenis_kelamin_warga" id="jenis_kelamin_warga" class="form-control mt-1"
                                    required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="tempat_lahir_warga">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir_warga" id="tempat_lahir_warga"
                                    class="form-control mt-1" required placeholder="Masukkan Tempat Lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="tanggal_lahir_warga">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir_warga" id="tanggal_lahir_warga"
                                    class="form-control mt-1" required min="1900-01-01" max="<?= date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="agama_warga">Agama</label>
                                <select name="agama_warga" id="agama_warga" class="form-control mt-1" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="pekerjaan_warga">Pekerjaan</label>
                                <input type="text" name="pekerjaan_warga" id="pekerjaan_warga" class="form-control mt-1"
                                    required placeholder="Masukkan Pekerjaan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="status_kawin_warga">Status Kawin</label>
                                <select name="status_kawin_warga" id="status_kawin_warga" class="form-control mt-1"
                                    required>
                                    <option value="">Pilih Status Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="shdk_warga">SHDK</label>
                                <select name="shdk_warga" id="shdk_warga" class="form-control mt-1" required>
                                    <option value="">Pilih SHDK</option>
                                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                                    <option value="Istri">Istri</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Orang Tua">Orang Tua</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="kebangsaan_warga">Kebangsaan</label>
                                <input type="text" name="kebangsaan_warga" id="kebangsaan_warga"
                                    class="form-control mt-1" required placeholder="Masukkan Kebangsaan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="pendidikan_warga">Pendidikan</label>
                                <select name="pendidikan_warga" id="pendidikan_warga" class="form-control mt-1"
                                    required>
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="TIDAK / BELUM SEKOLAH">TIDAK / BELUM SEKOLAH</option>
                                    <option value="TAMAT SD / SEDERAJAT">TAMAT SD / SEDERAJAT</option>
                                    <option value="SLTA / SEDERAJAT">SLTA / SEDERAJAT</option>
                                    <option value="SLTP/SEDERAJAT">SLTP/SEDERAJAT</option>
                                    <option value="BELUM TAMAT SD/SEDERAJAT">BELUM TAMAT SD/SEDERAJAT</option>
                                    <option value="DIPLOMA IV/ STRATA I">DIPLOMA IV/ STRATA I</option>
                                    <option value="DIPLOMA I / II">DIPLOMA I / II</option>
                                    <option value="AKADEMI/ DIPLOMA III/S. MUDA">AKADEMI/ DIPLOMA III/S. MUDA
                                    </option>
                                    <option value="STRATA II">STRATA II</option>
                                    <option value="STRATA III">STRATA III</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="berkas_ktp_warga">Berkas KTP</label>
                                <input type="file" name="berkas_ktp_warga" id="berkas_ktp_warga"
                                    class="form-control mt-1" required accept=".jpg, .jpeg, .png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn_register">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal add -->
<!-- Modal edit -->
<?php foreach ($anggota_keluarga as $key => $value) { ?>
<div class="modal fade" id="editModal<?= $value['id_warga']; ?>" tabindex="-1" aria-labelledby="addModalLabel"
    aria-hidden="true">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Keluarga/updateUserWarga'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id_kartu_keluarga"
                            value="<?= $data_keluarga['id_kartu_keluarga']; ?>">
                        <input type="hidden" name="id_warga" value="<?= $value['id_warga']; ?>">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="nik">No. NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control mt-1" required
                                    placeholder="Masukkan No. KK" minlength="16" maxlength="16"
                                    value="<?= $value['id_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="nama_warga">Nama Lengkap</label>
                                <input type="text" name="nama_warga" id="nama_warga" class="form-control mt-1" required
                                    placeholder="Masukkan Nama Lengkap" value="<?= $value['nama_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="jenis_kelamin_warga">Jenis Kelamin</label>
                                <select name="jenis_kelamin_warga" id="jenis_kelamin_warga" class="form-control mt-1"
                                    required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki"
                                        <?= $value['jenis_kelamin_warga'] == 'Laki-laki' ? 'selected' : ''; ?>>
                                        Laki-laki </option>
                                    <option value="Perempuan"
                                        <?= $value['jenis_kelamin_warga'] == 'Perempuan' ? 'selected' : ''; ?>>
                                        Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="tempat_lahir_warga">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir_warga" id="tempat_lahir_warga"
                                    class="form-control mt-1" required placeholder="Masukkan Tempat Lahir"
                                    value="<?= $value['tempat_lahir_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="tanggal_lahir_warga">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir_warga" id="tanggal_lahir_warga"
                                    class="form-control mt-1" required min="1900-01-01" max="<?= date('Y-m-d'); ?>"
                                    value="<?= $value['tanggal_lahir_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="agama_warga">Agama</label>
                                <select name="agama_warga" id="agama_warga" class="form-control mt-1" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" <?= ($value['agama_warga'] == 'Islam') ? 'selected' : ''; ?>>
                                        Islam</option>
                                    <option value="Kristen"
                                        <?= ($value['agama_warga'] == 'Kristen') ? 'selected' : ''; ?>>
                                        Kristen</option>
                                    <option value="Katolik"
                                        <?= ($value['agama_warga'] == 'Katolik') ? 'selected' : ''; ?>>
                                        Katolik</option>
                                    <option value="Hindu" <?= ($value['agama_warga'] == 'Hindu') ? 'selected' : ''; ?>>
                                        Hindu</option>
                                    <option value="Buddha"
                                        <?= ($value['agama_warga'] == 'Buddha') ? 'selected' : ''; ?>>
                                        Buddha</option>
                                    <option value="Konghucu"
                                        <?= ($value['agama_warga'] == 'Konghucu') ? 'selected' : ''; ?>>
                                        Konghucu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="pekerjaan_warga">Pekerjaan</label>
                                <input type="text" name="pekerjaan_warga" id="pekerjaan_warga" class="form-control mt-1"
                                    required placeholder="Masukkan Pekerjaan" value="<?= $value['pekerjaan_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="status_kawin_warga">Status Kawin</label>
                                <select name="status_kawin_warga" id="status_kawin_warga" class="form-control mt-1"
                                    required>
                                    <option value="">Pilih Status Kawin</option>
                                    <option value="Kawin"
                                        <?= ($value['status_kawin_warga'] == 'Kawin') ? 'selected' : ''; ?>>
                                        Kawin</option>
                                    <option value="Belum Kawin"
                                        <?= ($value['status_kawin_warga'] == 'Belum Kawin') ? 'selected' : ''; ?>>
                                        Belum Kawin</option>
                                    <option value="Cerai Hidup"
                                        <?= ($value['status_kawin_warga'] == 'Cerai Hidup') ? 'selected' : ''; ?>>
                                        Cerai Hidup</option>
                                    <option value="Cerai Mati"
                                        <?= ($value['status_kawin_warga'] == 'Cerai Mati') ? 'selected' : ''; ?>>
                                        Cerai Mati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="shdk_warga">SHDK</label>
                                <select name="shdk_warga" id="shdk_warga" class="form-control mt-1" required>
                                    <option value="">Pilih SHDK</option>
                                    <option value="Kepala Keluarga"
                                        <?= ($value['shdk_warga'] == 'Kepala Keluarga') ? 'selected' : ''; ?>>
                                        Kepala Keluarga</option>
                                    <option value="Istri" <?= ($value['shdk_warga'] == 'Istri') ? 'selected' : ''; ?>>
                                        Istri</option>
                                    <option value="Anak" <?= ($value['shdk_warga'] == 'Anak') ? 'selected' : ''; ?>>
                                        Anak</option>
                                    <option value="Orang Tua"
                                        <?= ($value['shdk_warga'] == 'Orang Tua') ? 'selected' : ''; ?>>Orang Tua
                                    </option>
                                    <option value="Lainnya"
                                        <?= ($value['shdk_warga'] == 'Lainnya') ? 'selected' : ''; ?>>
                                        Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="kebangsaan_warga">Kebangsaan</label>
                                <input type="text" name="kebangsaan_warga" id="kebangsaan_warga"
                                    class="form-control mt-1" required placeholder="Masukkan Kebangsaan"
                                    value="<?= $value['kebangsaan_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="pendidikan_warga">Pendidikan</label>
                                <select name="pendidikan_warga" id="pendidikan_warga" class="form-control mt-1"
                                    required>
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="	TIDAK / BELUM SEKOLAH"
                                        <?= ($value['pendidikan_warga'] == 'TIDAK / BELUM SEKOLAH') ? 'selected' : ''; ?>>
                                        TIDAK / BELUM SEKOLAH</option>
                                    <option value="TAMAT SD / SEDERAJAT"
                                        <?= ($value['pendidikan_warga'] == 'TAMAT SD / SEDERAJAT') ? 'selected' : ''; ?>>
                                        TAMAT SD / SEDERAJAT</option>
                                    <option value="SLTA / SEDERAJAT"
                                        <?= ($value['pendidikan_warga'] == 'SLTA / SEDERAJAT') ? 'selected' : ''; ?>>
                                        SLTA / SEDERAJAT</option>
                                    <option value="SLTP/SEDERAJAT"
                                        <?= ($value['pendidikan_warga'] == 'SLTP/SEDERAJAT') ? 'selected' : ''; ?>>
                                        SLTP/SEDERAJAT</option>
                                    <option value="BELUM TAMAT SD/SEDERAJAT"
                                        <?= ($value['pendidikan_warga'] == 'BELUM TAMAT SD/SEDERAJAT') ? 'selected' : ''; ?>>
                                        BELUM TAMAT SD/SEDERAJAT</option>
                                    <option value="DIPLOMA IV/ STRATA I"
                                        <?= ($value['pendidikan_warga'] == 'DIPLOMA IV/ STRATA I') ? 'selected' : ''; ?>>
                                        DIPLOMA IV/ STRATA I</option>
                                    <option value="DIPLOMA I / II"
                                        <?= ($value['pendidikan_warga'] == 'DIPLOMA I / II') ? 'selected' : ''; ?>>
                                        DIPLOMA I / II</option>
                                    <option value="AKADEMI/ DIPLOMA III/S. MUDA"
                                        <?= ($value['pendidikan_warga'] == 'AKADEMI/ DIPLOMA III/S. MUDA') ? 'selected' : ''; ?>>
                                        AKADEMI/ DIPLOMA III/S. MUDA</option>
                                    <option value="STRATA II"
                                        <?= ($value['pendidikan_warga'] == 'STRATA II') ? 'selected' : ''; ?>>
                                        STRATA II</option>
                                    <option value="STRATA III"
                                        <?= ($value['pendidikan_warga'] == 'STRATA III') ? 'selected' : ''; ?>>
                                        STRATA III</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="berkas_ktp_warga">Berkas KTP</label>
                                <input type="file" name="berkas_ktp_warga" id="berkas_ktp_warga"
                                    class="form-control mt-1" accept=".jpg, .jpeg, .png">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah berkas KTP</small>
                            </div>
                        </div>
                        <!-- status -->
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="status_warga">Status Warga</label>
                                <select name="status_warga" id="status_warga" class="form-control mt-1" required>
                                    <option value="">Pilih Status Warga</option>
                                    <option value="1" <?= ($value['status_warga'] == '1') ? 'selected' : ''; ?>>
                                        Hidup</option>
                                    <option value="0" <?= ($value['status_warga'] == '0') ? 'selected' : ''; ?>>
                                        Meninggal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn_register">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>
<!-- End Modal edit -->
<?php $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
// alert dimis
$(document).ready(function() {
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 4000);
});
$(document).ready(function() {
    $('#anggota_keluarga').DataTable({
        "order": [
            [0, "asc"]
        ],
        "language": {
            "emptyTable": "Data masih kosong"
        }
    });
});
</script>
<?= $this->endSection('script'); ?>