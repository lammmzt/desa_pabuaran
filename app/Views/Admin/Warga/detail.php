<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary"><a href="<?= base_url('Keluarga'); ?>"
                                style="text-decoration: none; color: #000;"><i class="fas fa-arrow-left"></i>
                            </a>
                            <span class="ml-2">Detail Kartu Keluarga</span>
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-primary btn-sm float-right" href="#" data-toggle="modal"
                            data-target="#add">Tambah
                            Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> <?= session()->getFlashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> <?= session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_kartu_keluarga">Nama Kartu Keluarga</label>
                            <input type="text" name="nama_kartu_keluarga" class="form-control" required
                                placeholder="Masukkan Nama Kartu Keluarga"
                                value="<?= $keluarga['nama_kartu_keluarga']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_kartu_keluarga">No Kartu Keluarga</label>
                            <input type="text" name="id_kartu_keluarga" class="form-control" required
                                placeholder="Masukkan No Kartu Keluarga" value="<?= $keluarga['id_kartu_keluarga']; ?>"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat_kartu_keluarga">Alamat Kartu Keluarga</label>
                            <input type="text" name="alamat_kartu_keluarga" class="form-control" required
                                placeholder="Masukkan Alamat Kartu Keluarga"
                                value="<?= $keluarga['alamat_kartu_keluarga']; ?>, Rt <?= $keluarga['rt_kartu_keluarga']; ?>, Rw <?= $keluarga['rw_kartu_keluarga']; ?>"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>SHDK</th>
                                <th>KTP</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($anggota_keluarga as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $value['nama_warga']; ?></td>
                                <td><?= $value['id_warga']; ?></td>
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
                                    <span class="badge badge-success">Aktif</span>
                                    <?php } else if ($value['status_warga'] == '2') { ?>
                                    <span class="badge badge-danger">Tidak Valid</span>
                                    <?php } else { ?>
                                    <span class="badge badge-warning">Tidak Aktif</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <a haref="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#edit<?= $value['id_warga']; ?>">Edit</a>
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
    </div>
</div>
<!-- Modal add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('Keluarga/saveWarga'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Keluarga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <input type="hidden" name="id_kartu_keluarga" value="<?= $keluarga['id_kartu_keluarga']; ?>">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_warga">No. NIK</label>
                                <input type="text" name="id_warga" id="id_warga" class="form-control" required
                                    placeholder="Masukkan No. KK" minlength="16" maxlength="16">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_warga">Nama Lengkap</label>
                                <input type="text" name="nama_warga" id="nama_warga" class="form-control" required
                                    placeholder="Masukkan Nama Lengkap">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir_warga">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir_warga" id="tempat_lahir_warga"
                                    class="form-control" required placeholder="Masukkan Tempat Lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_warga">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir_warga" id="tanggal_lahir_warga"
                                    class="form-control" required min="1900-01-01" max="<?= date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agama_warga">Agama</label>
                                <select name="agama_warga" id="agama_warga" class="form-control" required>
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
                            <div class="form-group">
                                <label for="pekerjaan_warga">Pekerjaan</label>
                                <input type="text" name="pekerjaan_warga" id="pekerjaan_warga" class="form-control"
                                    required placeholder="Masukkan Pekerjaan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_kawin_warga">Status Kawin</label>
                                <select name="status_kawin_warga" id="status_kawin_warga" class="form-control" required>
                                    <option value="">Pilih Status Kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Belum Kawin">Belum Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shdk_warga">SHDK</label>
                                <select name="shdk_warga" id="shdk_warga" class="form-control" required>
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
                            <div class="form-group">
                                <label for="kebangsaan_warga">Kebangsaan</label>
                                <input type="text" name="kebangsaan_warga" id="kebangsaan_warga" class="form-control"
                                    required placeholder="Masukkan Kebangsaan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan_warga">Pendidikan</label>
                                <select name="pendidikan_warga" id="pendidikan_warga" class="form-control" required>
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
                            <div class="form-group">
                                <label for="berkas_ktp_warga">Berkas KTP</label>
                                <input type="file" name="berkas_ktp_warga" id="berkas_ktp_warga" class="form-control"
                                    required accept=".jpg, .jpeg, .png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal add -->
<!-- Modal edit -->
<?php foreach ($anggota_keluarga as $key => $value) { ?>
<div class="modal fade" id="edit<?= $value['id_warga']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="editModalLabel<?= $value['id_warga']; ?>" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('Keluarga/updateWarga'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $value['id_warga']; ?>">Edit Data Keluarga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id_kartu_keluarga" value="<?= $keluarga['id_kartu_keluarga']; ?>">
                        <input type="hidden" name="id_warga" value="<?= $value['id_warga']; ?>">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">No. NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" required
                                    placeholder="Masukkan No. KK" minlength="16" maxlength="16"
                                    value="<?= $value['id_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_warga">Nama Lengkap</label>
                                <input type="text" name="nama_warga" id="nama_warga" class="form-control" required
                                    placeholder="Masukkan Nama Lengkap" value="<?= $value['nama_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat_lahir_warga">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir_warga" id="tempat_lahir_warga"
                                    class="form-control" required placeholder="Masukkan Tempat Lahir"
                                    value="<?= $value['tempat_lahir_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir_warga">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir_warga" id="tanggal_lahir_warga"
                                    class="form-control" required min="1900-01-01" max="<?= date('Y-m-d'); ?>"
                                    value="<?= $value['tanggal_lahir_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="agama_warga">Agama</label>
                                <select name="agama_warga" id="agama_warga" class="form-control" required>
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
                            <div class="form-group">
                                <label for="pekerjaan_warga">Pekerjaan</label>
                                <input type="text" name="pekerjaan_warga" id="pekerjaan_warga" class="form-control"
                                    required placeholder="Masukkan Pekerjaan" value="<?= $value['pekerjaan_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_kawin_warga">Status Kawin</label>
                                <select name="status_kawin_warga" id="status_kawin_warga" class="form-control" required>
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
                            <div class="form-group">
                                <label for="shdk_warga">SHDK</label>
                                <select name="shdk_warga" id="shdk_warga" class="form-control" required>
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
                            <div class="form-group">
                                <label for="kebangsaan_warga">Kebangsaan</label>
                                <input type="text" name="kebangsaan_warga" id="kebangsaan_warga" class="form-control"
                                    required placeholder="Masukkan Kebangsaan"
                                    value="<?= $value['kebangsaan_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pendidikan_warga">Pendidikan</label>
                                <select name="pendidikan_warga" id="pendidikan_warga" class="form-control" required>
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
                            <div class="form-group">
                                <label for="berkas_ktp_warga">Berkas KTP</label>
                                <input type="file" name="berkas_ktp_warga" id="berkas_ktp_warga" class="form-control"
                                    accept=".jpg, .jpeg, .png">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah berkas KTP</small>
                            </div>
                        </div>
                        <!-- status -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_warga">Status Warga</label>
                                <select name="status_warga" id="status_warga" class="form-control" required>
                                    <option value="">Pilih Status Warga</option>
                                    <option value="1" <?= ($value['status_warga'] == '1') ? 'selected' : ''; ?>>
                                        Aktif</option>
                                    <option value="2" <?= ($value['status_warga'] == '2') ? 'selected' : ''; ?>>
                                        Tidak Valid</option>
                                    <option value="3" <?= ($value['status_warga'] == '3') ? 'selected' : ''; ?>>
                                        Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>
<!-- End Modal edit -->

<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<script>
$(document).ready(function() {
    // Your custom JavaScript code here
});
</script>
<?= $this->endSection('script'); ?>