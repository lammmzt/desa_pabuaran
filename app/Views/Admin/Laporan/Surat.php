<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Laporan Pengajuan Surat</h6>
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
                <div class="row m-2 mb-3">
                    <div class="col-12 ">
                        <form action="<?= base_url('Laporan'); ?>" method="post" class="d-flex">
                            <div class="input-group">
                                <label for="tanggal_awal" class="input-group-text">Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" class="form-control"
                                    value="<?= $tanggal_awal; ?>" required>
                                <span class="input-group-text">s/d</span>
                                <label for="tanggal_akhir" class="input-group-text">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" class="form-control"
                                    value="<?= $tanggal_akhir; ?>" required>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row m-2">
                    <?php 
                if(!empty($tanggal_awal) && !empty($tanggal_akhir)): ?>
                    <div class="col-12">
                        <a href="<?= base_url('Laporan/cetakLaporan/' . $tanggal_awal . '/' . $tanggal_akhir); ?>"
                            class="btn btn-primary mb-3" target="_blank">Cetak Laporan</a>
                    </div>
                    <?php 
                endif;
                ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nomor</th>
                                <th>Tanggal</th>
                                <th>Pemohon</th>
                                <th>Jenis Surat</th>
                                <th>Keperluan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            if(!empty($data_surat)): 
                            foreach ($data_surat as $key => $value) :
                            ?>
                            <tr class="text-center">
                                <td><?= $no++; ?></td>
                                <td><?= $value['kode_jenis_surat']; ?>/<?= $value['no_surat']; ?></td>
                                <td><?= $value['tanggal_surat']; ?></td>
                                <td><?= $value['nama_warga']; ?></td>
                                <td><?= $value['nama_jenis_surat']; ?></td>
                                <td><?= $value['keperluan_pengajuan']; ?></td>
                            </tr>
                            <?php 
                            
                            endforeach;
                            endif; ?>
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
</script>
<?= $this->endSection('script'); ?>