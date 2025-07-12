<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Data Jenis Surat</h6>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-primary btn-sm float-right"
                            href="<?= base_url('jenis_surat/Tambah'); ?>">Tambah
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
                                <th>Nama Jenis Surat</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($jenis_surat as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $value['nama_jenis_surat']; ?></td>
                                <td><?= $value['ket_jenis_surat']; ?></td>
                                <td class="text-center" style="width: 10%;">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input status_jenis_surat"
                                            id="customSwitch<?= $value['id_jenis_surat']; ?>"
                                            data-id="<?= $value['id_jenis_surat']; ?>"
                                            <?= ($value['status_jenis_surat'] == 1) ? 'checked' : ''; ?>>
                                        <label class="custom-control-label"
                                            for="customSwitch<?= $value['id_jenis_surat']; ?>"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('jenis_surat/edit/' . $value['id_jenis_surat']); ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <!-- <a href="<?= base_url('jenis_surat/delete/' . $value['id_jenis_surat']); ?>"
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
<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<script>
// when change status_jenis_surat
$('.status_jenis_surat').change(function() {
    var id = $(this).data('id');
    $.ajax({
        url: '<?= base_url('Jenis_surat/update_status'); ?>',
        type: 'POST',
        data: {
            id: id,
        },
        success: function(response) {
            if (response.status == '200') {
                location.reload();
            } else {
                alert('Gagal mengubah status jenis surat');
            }
        }
    });
});
</script>
<?= $this->endSection('script'); ?>