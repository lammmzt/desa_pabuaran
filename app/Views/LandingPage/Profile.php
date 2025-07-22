<?= $this->extend('LandingPage/Template/index'); ?>
<?= $this->section('content'); ?>
<?php 
use App\Models\detailPengajuanModel;
$detailPengajuanModel = new detailPengajuanModel();
?>
<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade"
    style="background-image: url('<?= base_url('Assets/LandingPage/img/bg_apps.png'); ?>');">
    <!-- <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);"> -->
    <div class="container position-relative">
        <h1>Pofile</h1>
        <!-- <p>
                Data Keluarga pendukung aplikasi Administrasi Kependudukan.
            </p> -->
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="current">Profile Akun</li>
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

        <h3 class="text-center fw-bold mb-4">Profile Akun</h3>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Diri</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('LandingPage/updateUser'); ?>" method="post">
                            <input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="nama_user">Nama Lengkap</label>
                                        <input type="text" name="nama_user" class="form-control mt-1" required
                                            placeholder="Masukkan Nama Lengkap" value="<?= $user['nama_user']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="username">username</label>
                                        <input type="username" name="username" class="form-control mt-1" required
                                            placeholder="Masukkan username" value="<?= $user['username']; ?>" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control mt-1"
                                            placeholder="Masukkan Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="password">Konfirmasi Password</label>
                                        <input type="password" name="konfirmasi_password" class="form-control mt-1"
                                            placeholder="Masukkan Konfirmasi Password">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /Contact Section -->
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
</script>
<?= $this->endSection('script'); ?>