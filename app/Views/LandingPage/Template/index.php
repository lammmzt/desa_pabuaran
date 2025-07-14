<!DOCTYPE html>
<html lang="en">
<?php 
use App\Models\dataDesaModel;
$desaModel = new dataDesaModel();
$data_desa = $desaModel->first();
?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $title; ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?= base_url('Assets/img/data_desa/'); ?><?= $data_desa['logo_desa']; ?>" rel="icon" width="32"
        height="32">
    <link href="<?= base_url('Assets/img/data_desa/'); ?><?= $data_desa['logo_desa']; ?>" rel="apple-touch-icon"
        width="32" height="32">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('Assets/LandingPage/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('Assets/LandingPage/'); ?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('Assets/LandingPage/'); ?>vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url('Assets/LandingPage/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('Assets/LandingPage/'); ?>vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('Assets/LandingPage/'); ?>vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('Assets/LandingPage/'); ?>css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Logis
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="<?= base_url('/'); ?>" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="<?= base_url('Assets/LandingPage/'); ?>img/logo.png" alt=""> -->
                <h1 class="sitename"><?= $data_desa['nama_alias_desa']; ?></h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="<?= base_url('/'); ?>"
                            class="<?= $menu_active == 'Home' ? 'active' : ''; ?>">Beranda<br></a></li>
                    <li><a href="<?= base_url('Panduan'); ?>">Daftar Panduan</a></li>
                    <li><a href="<?= base_url('Kontak'); ?>">Kontak Kami</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <a class="btn-getstarted" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                Masuk
            </a>


        </div>
    </header>

    <main class="main">
        <?= $this->renderSection('content'); ?>

        <!-- modal login -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('Login'); ?>" method="post">
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Masukan nomor kartu keluar" minlength="16" maxlength="16" required>
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required
                                    placeholder="Masukan password">
                            </div>
                            <a href="#" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#registerModal"
                                data-dismiss="modal" aria-label="Close">
                                Belum punya akun?
                            </a>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal register -->
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
            aria-hidden="true">
            <div class="modal-lg modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('Keluarga/save'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="id_kartu_keluarga">No. KK</label>
                                        <input type="text" name="id_kartu_keluarga" id="id_kartu_keluarga"
                                            class="form-control" required placeholder="Masukkan No. KK" minlength="16"
                                            maxlength="16">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="nama_kartu_keluarga">Nama Kartu Keluarga</label>
                                        <input type="text" name="nama_kartu_keluarga" id="nama_kartu_keluarga"
                                            class="form-control" required placeholder="Masukkan Nama Kartu Keluarga">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="alamat_kartu_keluarga">Alamat Kartu Keluarga</label>
                                        <input type="text" name="alamat_kartu_keluarga" id="alamat_kartu_keluarga"
                                            class="form-control" required placeholder="Masukkan Alamat Kartu Keluarga">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="rt_kartu_keluarga">RT</label>
                                        <input type="text" name="rt_kartu_keluarga" id="rt_kartu_keluarga"
                                            class="form-control" required placeholder="Masukkan RT Kartu Keluarga"
                                            minlength="3" maxlength="3">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="rw_kartu_keluarga">RW</label>
                                        <input type="text" name="rw_kartu_keluarga" id="rw_kartu_keluarga"
                                            class="form-control" required placeholder="Masukkan RW Kartu Keluarga"
                                            minlength="3" maxlength="3">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="no_tpl_kartu_keluarga">No. Whatsapp</label>
                                        <input type="text" name="no_tpl_kartu_keluarga" id="no_tpl_kartu_keluarga"
                                            class="form-control" required placeholder="Masukkan No. Whatsapp"
                                            minlength="10" maxlength="15">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="foto_kartu_keluarga">Foto Kartu Keluarga</label>
                                        <input type="file" name="foto_kartu_keluarga" id="foto_kartu_keluarga"
                                            class="form-control-file" accept=".jpg, .jpeg, .png">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer" class="footer dark-background">
        <div class="container copyright text-center mt-4">
            <a href="<?= base_url('Auth'); ?>" class="btn btn-primary mb-2">Login Admin</a>
            <p>© <span>Copyright</span> <strong class="px-1 sitename"><?= $data_desa['nama_desa']; ?></strong> <span>All
                    Rights Reserved</span>
            </p>
            <div class="credits">
                <!-- button to login admin -->
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a
                    href=“https://themewagon.com>ThemeWagon -->
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('Assets/LandingPage/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('Assets/LandingPage/'); ?>vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url('Assets/LandingPage/'); ?>vendor/aos/aos.js"></script>
    <script src="<?= base_url('Assets/LandingPage/'); ?>vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= base_url('Assets/LandingPage/'); ?>vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url('Assets/LandingPage/'); ?>vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="<?= base_url('Assets/LandingPage/'); ?>js/main.js"></script>

</body>

</html>