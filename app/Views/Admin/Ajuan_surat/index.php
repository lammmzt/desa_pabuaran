<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- kiri kanan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Data Ajuan Surat</h6>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-primary btn-sm float-right"
                            href="<?= base_url('Ajuan_surat/Tambah'); ?>">Tambah
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
                                <th>Tanggal</th>
                                <th>Pemohon</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                                <th>File</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data_ajuan as $key => $value) {  
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= date('d F Y', strtotime($value['created_at'])); ?></td>
                                <td><?= $value['nama_warga']; ?></td>
                                <td><?= $value['keperluan_pengajuan']; ?></td>
                                <td class="text-center" style="width: 10%;">
                                    <?php 
                                    if($value['status_pengajuan'] == '1'){
                                        echo '<span class="badge badge-warning">Pengajuan</span>';
                                    }else if($value['status_pengajuan'] == '2'){
                                        echo '<span class="badge badge-primary">Proses</span>';
                                    }else if($value['status_pengajuan'] == '3'){
                                        echo '<span class="badge badge-success">Selesai</span>';
                                    }else{
                                        echo '<span class="badge badge-danger">Ditolak</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                    // check apakah data id_pengjuan ada di $data_surat
                                    if (in_array($value['id_pengajuan'], $data_surat)) {
                                        echo '<a href="' . base_url('Ajuan_surat/preview_hasil/' . $value['id_pengajuan']) . '" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-file-pdf" ></i> </a>';
                                    }else{
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        if($value['status_pengajuan'] == '1'):
                                    ?>
                                    <a href="<?= base_url('Ajuan_surat/proses/' . $value['id_pengajuan']); ?>"
                                        class="btn btn-primary btn-sm">Proses</a>
                                    <?php 
                                        endif;
                                        if(session()->get('role') == 'Kades' && $value['status_pengajuan'] == '2'):
                                    ?>
                                    <a href="<?= base_url('Ajuan_surat/proses/' . $value['id_pengajuan']); ?>"
                                        class="btn btn-primary btn-sm">Proses</a>
                                    <?php endif; ?>
                                    <?php 
                                        if($value['status_pengajuan'] == '0' || $value['status_pengajuan'] == '1'):
                                    ?>
                                    <a href="<?= base_url('Ajuan_surat/edit/' . $value['id_pengajuan']); ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('Ajuan_surat/detail/' . $value['id_pengajuan']); ?>"
                                        class="btn btn-secondary btn-sm">Detail</a>
                                    <!-- <a href="<?= base_url('Ajuan_surat/detail/' . $value['id_pengajuan']); ?>"
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
</script>
<?= $this->endSection('script'); ?>