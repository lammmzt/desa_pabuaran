<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Ajuan Surat</h6>
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
                                <input type="text" name="id_warga" id="" class="form-control mt-1" required readonly
                                    placeholder="Masukkan Nama Pemohon" value="<?= $data_pengajuan['nama_warga']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="id_jenis_surat">Jenis Surat</label>
                                <input type="text" name="id_jenis_surat" id="" class="form-control mt-1" required
                                    readonly placeholder="Masukkan Jenis Surat"
                                    value="<?= $data_pengajuan['nama_jenis_surat']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="form-group mb-2">
                                <label for="keperluan_pengajuan">Keperluan</label>
                                <textarea name="keperluan_pengajuan" id="keperluan_pengajuan" class="form-control mt-1"
                                    required readonly
                                    placeholder="Masukkan Keperluan Pengajuan"><?= $data_pengajuan['keperluan_pengajuan']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2">
                        <hr style="border: 1px solid #000; margin: 20px 0px;">
                        <h6 class="m-0 font-weight-bold text-primary">Persyaratan</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">
                                    KTP</label><br>

                                <a href="<?= base_url('Assets/berkas_ktp/'.$data_pengajuan['berkas_ktp_warga']); ?>"
                                    class="text-dark mt-1" target="_blank"><i class="fa fa-file-pdf"></i>
                                    Lihat </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="">
                                    KK</label><br>

                                <a href="<?= base_url('Assets/foto_Kk/'.$data_pengajuan['foto_kartu_keluarga']); ?>"
                                    class="text-dark mt-1" target="_blank"><i class="fa fa-file-pdf"></i>
                                    Lihat </a>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="file_pengajuan">
                        <?php 
                            if($data_detail_pengajuan != null):
                        ?>

                        <?php foreach ($data_detail_pengajuan as $value) : ?>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label
                                    for="<?= $value['id_persyaratan']; ?>"><?= $value['nama_persyaratan']; ?></label><br>

                                <a href="<?= base_url('Assets/file_pengajuan/'.$value['file_detail_penajuan']); ?>"
                                    class="text-dark mt-1" target="_blank"><i class="fa fa-file-pdf"></i>
                                    Lihat </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <!-- acordion -->
                    <?php 
                    if($data_surat != null):
                    ?>
                    <div class="accordion mt-4" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button"
                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <h6 class="m-0 font-weight-bold text-primary">Preview Surat</h6>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse " aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-12 mt-1">
                                            <label for="preview_hasil_surat" class="form-label">Preview Hasil
                                                Surat</label>
                                            <textarea class="form-control" id="preview_hasil_surat"
                                                name="preview_hasil_surat" required
                                                placeholder="Preview Hasil Surat"><?= ($data_surat != null ) ? $data_surat['data_surat'] : ''; ?></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;
                    ?>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('Ajuan_surat'); ?>" class="btn btn-danger">Kembali</a>
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
CKEDITOR.replace('preview_hasil_surat', {
    height: '1000px',
    width: '100%',
    baseFloatZIndex: 10005,
    // tidak bisa mengedit
    readOnly: true,
    // hilangkan buttons
    removeButtons: 'Cut,Copy,Paste,Undo,Redo,Anchor,HorizontalRule,SpecialChar,PageBreak,Iframe,About,Save,',
    // judul print preview
    toolbar: 'Print'
});
</script>
<?= $this->endSection('script'); ?>