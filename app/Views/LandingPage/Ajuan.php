<?= $this->extend('LandingPage/Template/index'); ?>
<?= $this->section('content'); ?>
<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade"
    style="background-image: url('<?= base_url('Assets/LandingPage/img/bg_apps.png'); ?>');">
    <!-- <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);"> -->
    <div class="container position-relative">
        <h1>Pengajuan</h1>
        <!-- <p>
                Data Keluarga pendukung aplikasi Administrasi Kependudukan.
            </p> -->
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="current">Pengajuan</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->
<section id="contact" class="contact section">

    <div class="container">
        <div class="row mb-2">
            <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> <?= session()->getFlashdata('success'); ?>

            </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> <?= session()->getFlashdata('error'); ?>

            </div>
            <?php endif; ?>
        </div>

        <h3 class="text-center fw-bold mb-4">Data Pengajuan Dokumen </h3>
        <div class="row">
            <div class="col-12 mb-4">
                <a class="btn btn-primary btn-sm text-white float-right" data-bs-toggle="modal"
                    data-bs-target="#addModal">Tambah
                    Data</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped my-2" width="100%" cellspacing="0" id="anggota_keluarga">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th width="5%" class="text-center">No</th>
                            <th class="text-center" width="10%">Tanggal</th>
                            <th>Nama Pemohon</th>
                            <th>Jenis Surat</th>
                            <th>Keperluan</th>
                            <th width="10%" class="text-center">Status</th>
                            <th class="text-center" width="10%">File</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($data_pengajuan as $row) : ?>
                        <tr class="text-center">
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($row['created_at'])); ?></td>
                            <td style="text-align: left;"><?= $row['nama_warga']; ?></td>
                            <td style="text-align: left;"><?= $row['nama_jenis_surat']; ?></td>
                            <td style="text-align: left;"><?= $row['keperluan_pengajuan']; ?></td>
                            <td class="text-center">
                                <?php if ($row['status_pengajuan'] == '1') : ?>
                                Menunggu
                                <?php elseif ($row['status_pengajuan'] == '2') : ?>
                                Disetujui
                                <?php elseif ($row['status_pengajuan'] == '3') : ?>
                                Ditolak
                                <?php endif; ?>
                            </td>
                            <td class="text-center">

                            </td>
                            <td class="text-center">
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section><!-- /Contact Section -->
<!-- Modal add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('Ajuan_surat/save'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="id_warga">Nama Pemohon</label>
                                <select name="id_warga" id="id_warga" class="form-control mt-1" required>
                                    <option value="">Pilih Nama Pemohon</option>
                                    <?php foreach ($data_warga as $value) : ?>
                                    <option value="<?= $value['id_warga']; ?>">
                                        <?= $value['nama_warga']; ?>
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
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="keperluan_pengajuan">Keperluan</label>
                                <input type="text" name="keperluan_pengajuan" id="keperluan_pengajuan"
                                    class="form-control mt-1" required placeholder="Masukkan Keperluan Pengajuan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="ket_pengajuan_pengajuan">Ket Pengajuan</label>
                                <textarea name="ket_pengajuan_pengajuan" id="ket_pengajuan_pengajuan"
                                    class="form-control mt-1" required
                                    placeholder="Masukkan Keterangan Pengajuan"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="file_pengajuan" style="display: none;">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn_register">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal add -->
<!-- End Modal edit -->
<?php $this->endSection('content'); ?>

<?= $this->section('script'); ?>
<script>
// alert dimis
$(document).ready(function() {
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 4000);
});

$(document).ready(function() {
    $('#anggota_keluarga').DataTable({
        "order": [
            [0, "asc"]
        ],
        "language": {
            "emptyTable": "Data masih kosong"
        }
    });
});
// when change jenis_surat
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
                html += '<hr style="border: 1px solid #000; margin: 20px 0px;">';
                html += '<h6>File Persyaratan</h6>';
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