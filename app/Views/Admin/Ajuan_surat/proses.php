<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Proses Ajuan Surat</h6>
                    </div>
                </div>
            </div>
            <form action="<?= base_url('Ajuan_surat/updateProses'); ?>" method="post" enctype="multipart/form-data">
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
                                <label for="nama_warga">Nama Pemohon</label>
                                <input type="text" name="nama_warga" id="nama_warga" class="form-control mt-1" required
                                    readonly placeholder="Masukkan Nama Pemohon"
                                    value="<?= $data_pengajuan['nama_warga']; ?>">
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
                                    required readonly
                                    placeholder="Masukkan Keperluan Pengajuan"><?= $data_pengajuan['keperluan_pengajuan']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <hr style="border: 1px solid #000; margin: 20px 0px;">
                            <h6 class="m-0 font-weight-bold text-primary">Persyaratan</h6>
                        </div>
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
                                    class="text-dark" target="_blank"><i class="fa fa-file-pdf"></i>
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
                                    <?php 
                                    // if role admin
                                    if(session()->get('role') == 'Admin'):
                                    ?>
                                    <option value="0"
                                        <?= ($data_pengajuan['status_pengajuan'] == '0') ? 'selected' : ''; ?>>
                                        Tolak
                                    </option>
                                    <option value="2"
                                        <?= ($data_pengajuan['status_pengajuan'] == '2') ? 'selected' : ''; ?>>
                                        Proses
                                    </option>
                                    <?php endif;
                                    if(session()->get('role') == 'Kades'):
                                    ?>
                                    <option value="3"
                                        <?= ($data_pengajuan['status_pengajuan'] == '3') ? 'selected' : ''; ?>>
                                        Selesai
                                    </option>
                                    <option value="2"
                                        <?= ($data_pengajuan['status_pengajuan'] == '2') ? 'selected' : ''; ?>>
                                        Proses
                                    </option>
                                    <?php 
                                    endif;
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="kete_pengajuan" style="display: none;">
                            <div class="form-group mb-2">
                                <label for="ket_pengajuan">Keterangan</label>
                                <input type="text" name="ket_pengajuan" class="form-control mt-1"
                                    placeholder="Masukkan Keterangan" value="<?= $data_pengajuan['ket_pengajuan']; ?>">
                            </div>
                        </div>
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