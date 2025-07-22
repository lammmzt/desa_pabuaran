<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Ajuan Surat</h6>
                    </div>
                </div>
            </div>
            <form action="<?= base_url('Ajuan_surat/saveAdmin'); ?>" method="post" enctype="multipart/form-data">
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
                    <?= csrf_field(); ?>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="id_warga">Nama Pemohon</label>
                                <select name="id_warga" id="id_warga" class="form-control mt-1" required
                                    style="width: 100%;">
                                    <option value="">Pilih Nama Pemohon</option>
                                    <?php foreach ($data_warga as $value) : ?>
                                    <option value="<?= $value['id_warga']; ?>">
                                        <?= $value['nama_warga']; ?> - <?= $value['id_warga']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="id_jenis_surat">Jenis Surat</label>
                                <select name="id_jenis_surat" id="id_jenis_surat" class="form-control mt-1" required
                                    style="width: 100%;">
                                    <option value="">Pilih Jenis Surat</option>
                                    <?php foreach ($data_jenis_surat as $value) : ?>
                                    <option value="<?= $value['id_jenis_surat']; ?>">
                                        <?= $value['nama_jenis_surat']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="form-group mb-2">
                                <label for="keperluan_pengajuan">Keperluan</label>
                                <textarea name="keperluan_pengajuan" id="keperluan_pengajuan" class="form-control mt-1"
                                    required placeholder="Masukkan Keperluan Pengajuan"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="file_pengajuan" style="display: none;">

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('Ajuan_surat'); ?>" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<script type="text/javascript">
// select2
$(document).ready(function() {
    $('#id_jenis_surat').select2();
    $('#id_warga').select2();
});
$('#id_jenis_surat').change(function() {
    var id_jenis_surat = $(this).val();
    console.log(id_jenis_surat);
    $.ajax({
        url: '<?= base_url('Jenis_surat/getPersyartan'); ?>',
        type: 'POST',
        data: {
            id: id_jenis_surat
        },
        success: function(response) {
            console.log(response);
            if (response.status == '200') {
                // $('#file_pengajuan').html(response.data);
                // empty
                $('#file_pengajuan').html('');
                var html = '';
                // add judul
                html += '<div class="col-md-12">';
                html += '<hr style="border: 1px solid #000; margin: 20px 0px;">';
                html += '<h6 class="font-weight-bold black">File Persyaratan</h6>';
                html += '</div>';
                $.each(response.data, function(index, value) {
                    html += '<div class="col-md-6">' +
                        '<div class="form-group mb-2">' +
                        '<label for="' + value.id_persyaratan + '">' + value
                        .nama_persyaratan +
                        '</label>' +
                        '<input type="file" name="' + value.id_persyaratan + '" id="' +
                        value.id_persyaratan +
                        '" class="form-control mt-1" required accept="image/*">' +
                        '</div>' +
                        '</div>';
                });
                $('#file_pengajuan').html(html);
                $('#file_pengajuan').show();
            } else {
                // empty
                $('#file_pengajuan').html('');
                $('#file_pengajuan').hide();
            }
        }
    });
});
</script>
<?= $this->endSection('script'); ?>