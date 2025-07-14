<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">


                <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> <?= session()->getFlashdata('success'); ?>.
                </div>

                <?php endif; ?>
                <?php if(session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> <?= session()->getFlashdata('errors'); ?>.
                </div>
                <?php endif; ?>
                <form action="<?= base_url('Data_desa/save') ?>" method="post" enctype="multipart/form-data"
                    class="form-horizontal">
                    <!-- logo ditengah" bisa diubah -->
                    <div class="text-center mb-4">
                        <img src="<?= ($data_desa != null) ? base_url('Assets/img/data_desa/' . $data_desa['logo_desa']) : base_url('Assets/hope-ui-html-2.0/html/assets/images/avatars/01.png') ?>"
                            alt="User-Profile" class="theme-color-default-img img-fluid rounded-pill"
                            id="view_logo_desa">
                        <input type="file" class="form-control" id="logo_desa" name="logo_desa"
                            value="<?= old('logo_desa') ?>">
                        <style>
                        /* sesuaikan input di  */
                        #logo_desa {
                            display: none;
                        }

                        .theme-color-default-img {
                            cursor: pointer;
                        }

                        .theme-color-default-img:hover {
                            opacity: 0.7;
                        }

                        #view_logo_desa {
                            width: 150px;
                            height: 150px;
                            object-fit: cover;
                            border-radius: 50%;
                        }
                        </style>

                        <script type="text/javascript">
                        //    when click image, trigger input file to choose file
                        document.getElementById('view_logo_desa').addEventListener('click', function() {
                            document.getElementById('logo_desa').click();
                        });

                        //    when file is selected, show image
                        document.getElementById('logo_desa').addEventListener('change', function() {
                            const file = this.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function() {
                                    document.getElementById('view_logo_desa').setAttribute('src', reader
                                        .result);
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                        </script>
                    </div>
                    <!-- end logo -->
                    <hr>
                    <?= csrf_field(); ?>
                    <div class="form-group row mt-2">
                        <label for="nama_desa" class="col-sm-2">Nama Desa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_desa" name="nama_desa"
                                value="<?= ($data_desa) ? $data_desa['nama_desa'] : old('nama_desa') ?>" required
                                placeholder="Nama desa">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="nama_alias_desa" class="col-sm-2">Alias Nama desa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_alias_desa" name="nama_alias_desa"
                                value="<?= ($data_desa) ? $data_desa['nama_alias_desa'] : old('nama_alias_desa') ?>"
                                required placeholder="Nama Alias desa">
                        </div>
                    </div>
                    <div class="form-group row mt-2 ">
                        <label for="alamat_desa" class="col-sm-2">Alamat Desa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat_desa" name="alamat_desa"
                                value="<?= ($data_desa) ? $data_desa['alamat_desa'] : old('alamat_desa') ?>" required
                                placeholder="Alamat desa">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="no_tlp_desa" class="col-sm-2">No. Telp Desa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_tlp_desa" name="no_tlp_desa"
                                value="<?= ($data_desa) ? $data_desa['no_tlp_desa'] : old('no_tlp_desa') ?>" required
                                placeholder="No. Telp desa">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="email_desa" class="col-sm-2">Email Desa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email_desa" name="email_desa"
                                value="<?= ($data_desa) ? $data_desa['email_desa'] : old('email_desa') ?>" required
                                placeholder="Email desa">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="nama_kepala_desa" class="col-sm-2">Nama Kepala Desa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa"
                                value="<?= ($data_desa) ? $data_desa['nama_kepala_desa'] : old('nama_kepala_desa') ?>"
                                required placeholder="Nama Kepala desa">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="nip_kepala_desa" class="col-sm-2">NIP Kepala Desa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nip_kepala_desa" name="nip_kepala_desa"
                                value="<?= ($data_desa) ? $data_desa['nip_kepala_desa'] : old('nip_kepala_desa') ?>"
                                required placeholder="NIP Kepala desa">
                        </div>
                    </div>
                    <div class="form-group row mt-4">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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