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
                                <th>Foto KK</th>
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
                                <td class="text-center">
                                    <a href="<?= base_url('Assets/foto_kk/' . $value['foto_kartu_keluarga']); ?>"
                                        style="text-decoration: none; border: none; color: #000;" target="_blank"><img
                                            src="<?= base_url('Assets/img/icon-kk.png'); ?>" alt="Foto KK"
                                            class="img-thumbnail" width="100"></a>
                                </td>
                                <td class="text-center" style="width: 10%;">
                                    <?php if ($value['status_kartu_keluarga'] == '1') { ?>
                                    <span class="badge badge-success">Aktif</span>
                                    <?php } else if ($value['status_kartu_keluarga'] == '2') { ?>
                                    <span class="badge badge-danger">Tidak Valid</span>
                                    <?php } else { ?>
                                    <span class="badge badge-warning">Tidak Aktif</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <a haref="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#edit<?= $value['id_kartu_keluarga']; ?>">Edit</a>
                                    <a haref="#" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#detail<?= $value['id_kartu_keluarga']; ?>">Detail</a>
                                    <?php 
                                    if($value['status_kartu_keluarga'] == '1') { ?>
                                    <a href="<?= base_url('Keluarga/DetailKeluarga/' . $value['id_kartu_keluarga']); ?>"
                                        class="btn btn-success btn-sm">Anggota Keluarga</a>
                                    <?php }  ?>
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
                                    required placeholder="Masukkan RT Kartu Keluarga" minlength="3" maxlength="3">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rw_kartu_keluarga">RW</label>
                                <input type="text" name="rw_kartu_keluarga" id="rw_kartu_keluarga" class="form-control"
                                    required placeholder="Masukkan RW Kartu Keluarga" minlength="3" maxlength="3">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_tpl_kartu_keluarga">No. Whatsapp</label>
                                <input type="text" name="no_tpl_kartu_keluarga" id="no_tpl_kartu_keluarga"
                                    class="form-control" required placeholder="Masukkan No. Whatsapp" minlength="10"
                                    maxlength="15">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_kartu_keluarga">Foto Kartu Keluarga</label>
                                <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga"
                                    class="form-control" accept=".jpg, .jpeg, .png" required>
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
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('Keluarga/update'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Keluarga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="id_kartu_keluarga" value="<?= $value['id_kartu_keluarga']; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_kk">No. KK</label>
                                <input type="text" name="no_kk" id="no_kk" class="form-control"
                                    value="<?= $value['id_kartu_keluarga']; ?>" required placeholder="Masukkan No. KK"
                                    minlength="16" maxlength="16">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_kartu_keluarga">Nama Kartu Keluarga</label>
                                <input type="text" name="nama_kartu_keluarga" id="nama_kartu_keluarga"
                                    class="form-control" value="<?= $value['nama_kartu_keluarga']; ?>" required
                                    placeholder="Masukkan Nama Kartu Keluarga">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat_kartu_keluarga">Alamat Kartu Keluarga</label>
                                <input type="text" name="alamat_kartu_keluarga" id="alamat_kartu_keluarga"
                                    class="form-control" value="<?= $value['alamat_kartu_keluarga']; ?>" required
                                    placeholder="Masukkan Alamat Kartu Keluarga">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rt_kartu_keluarga">RT</label>
                                <input type="text" name="rt_kartu_keluarga" id="rt_kartu_keluarga" class="form-control"
                                    value="<?= $value['rt_kartu_keluarga']; ?>" required
                                    placeholder="Masukkan RT Kartu Keluarga" minlength="3" maxlength="3">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rw_kartu_keluarga">RW</label>
                                <input type="text" name="rw_kartu_keluarga" id="rw_kartu_keluarga" class="form-control"
                                    value="<?= $value['rw_kartu_keluarga']; ?>" required
                                    placeholder="Masukkan RW Kartu Keluarga" minlength="3" maxlength="3">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_tpl_kartu_keluarga">No. Whatsapp</label>
                                <input type="text" name="no_tpl_kartu_keluarga" id="no_tpl_kartu_keluarga"
                                    class="form-control" value="<?= $value['no_tpl_kartu_keluarga']; ?>" required
                                    placeholder="Masukkan No. Whatsapp" minlength="10" maxlength="15">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_kartu_keluarga">Foto Kartu Keluarga</label>
                                <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga"
                                    class="form-control-file" accept=".jpg, .jpeg, .png">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_kartu_keluarga">Status Kartu Keluarga</label>
                                <select name="status_kartu_keluarga" id="status_kartu_keluarga" class="form-control">
                                    <option value="1"
                                        <?= ($value['status_kartu_keluarga'] == '1') ? 'selected' : ''; ?>>
                                        Aktif
                                    </option>
                                    <!-- <option value="2"
                                        <?= ($value['status_kartu_keluarga'] == '2') ? 'selected' : ''; ?>>
                                        Tidak
                                        Valid</option> -->
                                    <option value="3"
                                        <?= ($value['status_kartu_keluarga'] == '0') ? 'selected' : ''; ?>>
                                        Tidak
                                        Aktif</option>
                                </select>
                                <small class="form-text text-muted">Pilih status Kartu Keluarga.</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<?php } ?>
<!-- detail -->
<?php foreach ($keluarga as $key => $value) { ?>
<div class="modal fade" id="detail<?= $value['id_kartu_keluarga']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Data Keluarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>No. KK:</strong> <?= $value['id_kartu_keluarga']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Nama Kartu Keluarga:</strong> <?= $value['nama_kartu_keluarga']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Alamat Kartu Keluarga:</strong> <?= $value['alamat_kartu_keluarga']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>RT:</strong> <?= $value['rt_kartu_keluarga']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>RW:</strong> <?= $value['rw_kartu_keluarga']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Status Kartu Keluarga:</strong>
                            <?php if ($value['status_kartu_keluarga'] == '1') { ?>
                            <span class="badge badge-success">Aktif</span>
                            <?php } else if ($value['status_kartu_keluarga'] == '2') { ?>
                            <span class="badge badge-danger">Tidak Valid</span>
                            <?php } else { ?>
                            <span class="badge badge-warning">Tidak Aktif</span>
                            <?php } ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>No. Whatsapp:</strong> <?= $value['no_tpl_kartu_keluarga']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Foto Kartu Keluarga:</strong></p>
                        <?php if ($value['foto_kartu_keluarga']) { ?>
                        <a href="<?= base_url('Assets/foto_kk/' . $value['foto_kartu_keluarga']); ?>" target="_blank">
                            <img src="<?= base_url('Assets/foto_kk/' . $value['foto_kartu_keluarga']); ?>"
                                alt="Foto Kartu Keluarga" class="img-thumbnail" width="150">
                        </a>
                        <?php } else { ?>
                        <p>Tidak ada foto Kartu Keluarga.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<script>
$(document).ready(function() {
    // Your custom JavaScript code here
});
</script>
<?= $this->endSection('script'); ?>