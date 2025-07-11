<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Data Persyaratan</h6>
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
                                <th>Nama Persyaratan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($persyaratan as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $value['nama_persyaratan']; ?></td>
                                <td class="text-center" style="width: 10%;">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input status_persyaratan"
                                            id="customSwitch<?= $value['id_persyaratan']; ?>"
                                            data-id="<?= $value['id_persyaratan']; ?>"
                                            <?= ($value['status_persyaratan'] == 1) ? 'checked' : ''; ?>>
                                        <label class="custom-control-label"
                                            for="customSwitch<?= $value['id_persyaratan']; ?>"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a haref="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#edit<?= $value['id_persyaratan']; ?>">Edit</a>
                                    <!-- <a href="<?= base_url('Persyaratan/delete/' . $value['id_persyaratan']); ?>"
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
            <form action="<?= base_url('Persyaratan/save'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Persyaratan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label for="nama_persyaratan">Nama Persyaratan</label>
                        <input type="text" name="nama_persyaratan" id="nama_persyaratan" class="form-control" required
                            placeholder="Masukkan Nama Persyaratan">
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
<?php foreach ($persyaratan as $key => $value) { ?>
<div class="modal fade" id="edit<?= $value['id_persyaratan']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('Persyaratan/update/' . $value['id_persyaratan']); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Persyaratan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label for="nama_persyaratan">Nama Persyaratan</label>
                        <input type="text" name="nama_persyaratan" id="nama_persyaratan" class="form-control"
                            value="<?= $value['nama_persyaratan']; ?>" required>
                    </div>
                    <input type="hidden" name="id_persyaratan" value="<?= $value['id_persyaratan']; ?>">
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
$('.status_persyaratan').change(function() {
    var id = $(this).data('id');
    $.ajax({
        url: '<?= base_url('Persyaratan/update_status'); ?>',
        type: 'POST',
        data: {
            id: id,
        },
        success: function(response) {
            if (response.status == '200') {
                location.reload();
            } else {
                alert('Gagal mengubah status persyaratan');
            }
        }
    });
});
</script>
<?= $this->endSection('script'); ?>