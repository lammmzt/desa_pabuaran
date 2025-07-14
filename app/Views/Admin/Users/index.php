<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
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
                                <th>Username</th>
                                <th>Nama User</th>
                                <th>Role</th>
                                <th>Status User</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($users as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $value['username']; ?></td>
                                <td><?= $value['nama_user']; ?></td>
                                <td class="text-center"><?= $value['role']; ?></td>

                                <td class="text-center" style="width: 10%;">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input status_user"
                                            id="customSwitch<?= $value['id_user']; ?>"
                                            data-id="<?= $value['id_user']; ?>"
                                            <?= ($value['status_user'] == 1) ? 'checked' : ''; ?>>
                                        <label class="custom-control-label"
                                            for="customSwitch<?= $value['id_user']; ?>"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a haref="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#edit<?= $value['id_user']; ?>">Edit</a>
                                    <!-- <a href="<?= base_url('Users/delete/' . $value['id_user']); ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a> -->
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('Users/save'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required
                            placeholder="Masukkan Username">
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required
                            placeholder="Masukkan Password">
                    </div>
                    <div class="form-group mt-2">
                        <label for="nama_user">Nama User</label>
                        <input type="text" name="nama_user" id="nama_user" class="form-control" required
                            placeholder="Masukkan Nama User">
                    </div>
                    <div class="form-group mt-2">
                        <label for="status_user">Status User</label>
                        <select name="status_user" id="status_user" class="form-control" required
                            placeholder="Masukkan Status User">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="alamat_user">Alamat User</label>
                        <textarea name="alamat_user" id="alamat_user" class="form-control" required
                            placeholder="Masukkan Alamat User"></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required placeholder="Masukkan Role">
                            <option value="">Pilih Role</option>
                            <option value="Admin">Admin</option>
                            <option value="Kades">Kades</option>
                            <option value="Warga">Warga</option>
                        </select>
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
<?php foreach ($users as $key => $value) { ?>
<div class="modal fade" id="edit<?= $value['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('Users/update/' . $value['id_user']); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group mt-2">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required
                            value="<?= $value['username']; ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="nama_user">Nama User</label>
                        <input type="text" name="nama_user" id="nama_user" class="form-control" required
                            value="<?= $value['nama_user']; ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Passowrd</label>
                        <input type="text" name="password" id="password" class="form-control">
                        <span class="text-muted">Biarkan kosong jika tidak ingin merubah password</span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="alamat_user">Alamat User</label>
                        <textarea name="alamat_user" id="alamat_user" class="form-control"
                            required><?= $value['alamat_user']; ?></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">Pilih Role</option>
                            <option value="Admin" <?= ($value['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="Kades" <?= ($value['role'] == 'Kades') ? 'selected' : ''; ?>>Kades</option>
                            <option value="Warga" <?= ($value['role'] == 'Warga') ? 'selected' : ''; ?>>Warga</option>
                        </select>
                    </div>
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
<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<script>
// when change status_persyaratan
$('.status_user').change(function() {
    var id = $(this).data('id');
    $.ajax({
        url: '<?= base_url('Users/update_status'); ?>',
        type: 'POST',
        data: {
            id: id,
        },
        success: function(response) {
            if (response.status == '200') {
                location.reload();
            } else {
                alert('Gagal mengubah status user');
            }
        }
    });
});
</script>
<?= $this->endSection('script'); ?>