<?= $this->extend('LandingPage/Template/index'); ?>
<?= $this->section('content'); ?>
<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade"
    style="background-image: url('<?= base_url('Assets/LandingPage/img/bg_apps.png'); ?>');">
    <!-- <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);"> -->
    <div class="container position-relative">
        <h1>Panduan</h1>
        <!-- <p>
                Panduan pendukung aplikasi Administrasi Kependudukan.
            </p> -->
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="current">Panduan</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->
<!-- Faq Section -->
<section id="faq" class="faq section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>Panduan Aplikasi</span>
        <h2>Panduan Aplikasi</h2>
        <!-- <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p> -->
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="faq-container">

                    <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>
                            Bagiaman cara malakukan registrasi akun pada aplikasi ini?
                        </h3>
                        <div class="faq-content">
                            <!-- list tutorial -->
                            <ul style="list-style-type:none">
                                <li>1. Pilih tombol masuk pada menu kanan atas</li>
                                <li>2. Klik pada text belum punya akun?</li>
                                <li>3. Isikan data sesuai dengan kartu keluarga</li>
                                <li>4. Klik tombol daftar</li>
                                <li>5. Selesai, akun telah terdaftar</li>
                            </ul>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div><!-- End Faq item-->



                    <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>Bagiaman cara malakukan registrasi akun pada aplikasi ini?</h3>
                        <div class="faq-content">
                            <p>

                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div><!-- End Faq item-->


                </div>

            </div>

        </div>

    </div>

</section><!-- /Faq Section -->
<?php $this->endSection('content'); ?>