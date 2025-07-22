<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Ajuan Surat</h6>
                    </div>
                </div>
            </div>
            <form action="<?= base_url('Ajuan_surat/updateAdmin'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_pengajuan" value="<?= $data_pengajuan['id_pengajuan']; ?>">
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
                                    <option value="<?= $value['id_warga']; ?>"
                                        <?= ($data_pengajuan['id_warga'] == $value['id_warga']) ? 'selected' : ''; ?>>
                                        <?= $value['nama_warga']; ?> - <?= $value['id_warga']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="id_jenis_surat">Jenis Surat</label>
                                <input type="text" name="id_jenis_surat" id="" class="form-control mt-1" required
                                    readonly placeholder="Masukkan Jenis Surat"
                                    value="<?= $data_pengajuan['nama_jenis_surat']; ?>">
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="form-group mb-2">
                                <label for="keperluan_pengajuan">Keperluan</label>
                                <textarea name="keperluan_pengajuan" id="keperluan_pengajuan" class="form-control mt-1"
                                    required
                                    placeholder="Masukkan Keperluan Pengajuan"><?= $data_pengajuan['keperluan_pengajuan']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="file_pengajuan">
                        <?php 
                            if($data_detail_pengajuan != null):
                        ?>
                        <div class="col-lg-12 mb-2">
                            <hr style="border: 1px solid #000; margin: 20px 0px;">
                            <h6 class="m-0 font-weight-bold text-primary">Persyaratan</h6>
                        </div>
                        <?php foreach ($data_detail_pengajuan as $value) : ?>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label
                                    for="<?= $value['id_persyaratan']; ?>"><?= $value['nama_persyaratan']; ?></label><br>
                                <input type="file" name="<?= $value['id_detail_pengajuan']; ?>"
                                    class="form-control my-1" accept="image/*">
                                <a href="<?= base_url('Assets/file_pengajuan/'.$value['file_detail_penajuan']); ?>"
                                    class="text-dark mt-1" target="_blank"><i class="fa fa-file-pdf"></i>
                                    Lihat </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="status_pengajuan">Status Pengajuan</label>
                                <select name="status_pengajuan" id="status_pengajuan" class="form-control mt-1"
                                    required>
                                    <option value="">Pilih Status Pengajuan</option>
                                    <option value="0"
                                        <?= ($data_pengajuan['status_pengajuan'] == '0') ? 'selected' : ''; ?>>
                                        Tolak
                                    </option>
                                    <option value="1"
                                        <?= ($data_pengajuan['status_pengajuan'] == '1') ? 'selected' : ''; ?>>
                                        Pengajuan
                                    </option>
                                    <option value="2"
                                        <?= ($data_pengajuan['status_pengajuan'] == '2') ? 'selected' : ''; ?>>
                                        Proses
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="kete_pengajuan"
                            style="<?= ($data_pengajuan['status_pengajuan'] == '0') ? '' : 'display: none;'; ?>">
                            <div class="form-group mb-2">
                                <label for="ket_pengajuan">Keterangan</label>
                                <input type="text" name="ket_pengajuan" class="form-control mt-1"
                                    placeholder="Masukkan Keterangan" value="<?= $data_pengajuan['ket_pengajuan']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Ubah</button>
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
    $('#id_warga').select2();
});
// when click status tolak show ket_pengajuan
$('#status_pengajuan').change(function() {
    var status = $(this).val();
    if (status == '0') {
        $('#kete_pengajuan').show();
    } else {
        $('#kete_pengajuan').hide();
    }
});
</script>
<?= $this->endSection('script'); ?>