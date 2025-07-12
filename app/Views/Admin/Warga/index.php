<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Data Keluarga</h6>
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
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>No KK</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($keluarga as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $value['id_kartu_keluarga']; ?></td>
                                <td><?= $value['nama_kartu_keluarga']; ?></td>
                                <td class="text-center" style="width: 10%;">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input status_kartu_keluarga"
                                            id="customSwitch<?= $value['id_kartu_keluarga']; ?>"
                                            data-id="<?= $value['id_kartu_keluarga']; ?>"
                                            <?= ($value['status_kartu_keluarga'] == 1) ? 'checked' : ''; ?>>
                                        <label class="custom-control-label"
                                            for="customSwitch<?= $value['id_kartu_keluarga']; ?>"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a haref="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#edit<?= $value['id_kartu_keluarga']; ?>">Edit</a>

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
            <form action="<?= base_url('Keluarga/save'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Keluarga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_kartu_keluarga">No. KK</label>
                                <input type="text" name="id_kartu_keluarga" id="id_kartu_keluarga" class="form-control"
                                    required placeholder="Masukkan No. KK" minlength="16" maxlength="16">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_kartu_keluarga">Nama Kartu Keluarga</label>
                                <input type="text" name="nama_kartu_keluarga" id="nama_kartu_keluarga"
                                    class="form-control" required placeholder="Masukkan Nama Kartu Keluarga">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat_kartu_keluarga">Alamat Kartu Keluarga</label>
                                <input type="text" name="alamat_kartu_keluarga" id="alamat_kartu_keluarga"
                                    class="form-control" required placeholder="Masukkan Alamat Kartu Keluarga">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rt_kartu_keluarga">RT</label>
                                <input type="text" name="rt_kartu_keluarga" id="rt_kartu_keluarga" class="form-control"
                                    required placeholder="Masukkan RT Kartu Keluarga" minlength="3" maxlength="3"
                                    onkeyup="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rw_kartu_keluarga">RW</label>
                                <input type="text" name="rw_kartu_keluarga" id="rw_kartu_keluarga" class="form-control"
                                    required placeholder="Masukkan RW Kartu Keluarga" minlength="3" maxlength="3"
                                    onkeyup="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_kartu_keluarga">Foto Kartu Keluarga</label>
                                <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga"
                                    class="form-control-file" accept=".jpg, .jpeg, .png">
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
<!-- edit -->
<?php foreach ($keluarga as $key => $value) { ?>
<div class="modal fade" id="edit<?= $value['id_kartu_keluarga']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('Keluarga/update'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php } ?>
<?= $this->endSection(); ?>