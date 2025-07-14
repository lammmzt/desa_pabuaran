<?= $this->extend('LandingPage/Template/index'); ?>
<?= $this->section('content'); ?>
<!-- Page Title -->
<div class="page-title dark-background" data-aos="fade"
    style="background-image: url('<?= base_url('Assets/LandingPage/img/bg_apps.png'); ?>');">
    <!-- <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);"> -->
    <div class="container position-relative">
        <h1>Pandunan</h1>
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
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-10">

                <div class="faq-container">

                    <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>Non consectetur a erat nam at lectus urna duis?</h3>
                        <div class="faq-content">
                            <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus
                                laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor
                                rhoncus dolor purus non.</p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div><!-- End Faq item-->

                    <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</h3>
                        <div class="faq-content">
                            <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id
                                interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus
                                scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.
                                Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div><!-- End Faq item-->

                    <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>Dolor sit amet consectetur adipiscing elit pellentesque?</h3>
                        <div class="faq-content">
                            <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci.
                                Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl
                                suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis
                                convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                            </p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div><!-- End Faq item-->

                    <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</h3>
                        <div class="faq-content">
                            <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id
                                interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus
                                scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.
                                Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                        </div>
                        <i class="faq-toggle bi bi-chevron-right"></i>
                    </div><!-- End Faq item-->

                    <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                        <i class="faq-icon bi bi-question-circle"></i>
                        <h3>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</h3>
                        <div class="faq-content">
                            <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse
                                in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl
                                suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
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