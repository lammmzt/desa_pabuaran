<?= $this->extend('LandingPage/Template/index'); ?>
<?= $this->section('content'); ?>
<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade"
    style="background-image: url('<?= base_url('Assets/LandingPage/img/bg_apps.png'); ?>');">
    <!-- <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);"> -->
    <div class="container position-relative">
        <h1>Pengajuan</h1>
        <!-- <p>
                Data Keluarga pendukung aplikasi Administrasi Kependudukan.
            </p> -->
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="current">Pengajuan</li>
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

        <h3 class="text-center fw-bold mb-4">Data Pengajuan Dokumen </h3>
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