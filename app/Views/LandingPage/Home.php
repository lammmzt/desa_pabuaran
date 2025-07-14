<?= $this->extend('LandingPage/Template/index'); ?>
<?= $this->section('content'); ?>

<!-- Hero Section -->
<section id="hero" class="hero section dark-background">

    <img src="<?= base_url('Assets/LandingPage/'); ?>img/world-dotted-map.png" alt="" class="hero-bg"
        data-aos="fade-in">

    <div class="container">
        <div class="row gy-4 d-flex justify-content-between">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h2 data-aos="fade-up">Aplikasi Administrasi Kependudukan</h2>
                <p data-aos="fade-up" data-aos-delay="100">
                    Aplikasi ini dibuat untuk memudahkan masyarakat dalam mendapatkan pelayanan administrasi
                    kependudukan di
                    <?= $datas_desa['nama_desa']; ?>
                </p>



                <div class="row gy-4" data-aos="fade-up" data-aos-delay="300">

                    <div class="col-lg-3 col-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="0"
                                class="purecounter">232</span>
                            <p>Pengguna</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="0"
                                class="purecounter">521</span>
                            <p>Pegawai</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="0"
                                class="purecounter">1453</span>
                            <p>Layanan</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="0"
                                class="purecounter">32</span>
                            <p>Terlayani</p>
                        </div>
                    </div><!-- End Stats Item -->

                </div>

            </div>

            <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                <img src="<?= base_url('Assets/LandingPage/'); ?>img/hero-img.svg" class="img-fluid mb-3 mb-lg-0"
                    alt="">
            </div>

        </div>
    </div>

</section><!-- /Hero Section -->

<!-- Featured Services Section -->
<section id="featured-services" class="featured-services section">

    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
                <div class="icon flex-shrink-0"><i class="fa-solid fa-truck-fast"></i></div>
                <div>
                    <h4 class="title">
                        Efisiensi
                    </h4>
                    <p class="description">
                        Mempercepat dan menyederhanakan proses pelayanan.
                    </p>
                </div>
            </div>
            <!-- End Service Item -->

            <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <div class="icon flex-shrink-0"><i class="fa-solid fa-users"></i></div>
                <div>
                    <h4 class="title">Transparan</h4>
                    <p class="description">
                        Memastikan kejelasan dan keterbukaan dalam setiap proses.
                    </p>
                </div>
            </div><!-- End Service Item -->

            <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <div class="icon flex-shrink-0"><i class="fa-solid fa-chart-line"></i></div>
                <div>
                    <h4 class="title">Akuntabilitas</h4>
                    <p class="description">
                        mendorong pertanggungjawaban dan integritas pemerintahan desa.
                    </p>
                </div>
            </div><!-- End Service Item -->

        </div>

    </div>

</section><!-- /Featured Services Section -->

<!-- About Section -->
<section id="about" class="about section">

    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up"
                data-aos-delay="200">
                <img src="<?= base_url('Assets/'); ?>img/BG PABUARAN.png" class="img-fluid" alt="">
                <a href="https://www.youtube.com/watch?v=jTiBhW8VMzA" class="glightbox pulsating-play-btn"></a>
            </div>

            <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
                <h3>Tentang Kami</h3>
                <p style="text-align: justify;">
                    Aplikasi Administrasi Kependudukan merupakan sebuah sistem digital yang dirancang untuk mempermudah
                    masyarakat dalam memperoleh layanan administrasi kependudukan yang disediakan oleh
                    <?= $datas_desa['nama_desa']; ?>
                    Pabuaran. Melalui pemanfaatan aplikasi ini, masyarakat dapat dengan lebih cepat, efisien, dan
                    praktis mengakses berbagai informasi terkait pelayanan administrasi kependudukan, tanpa harus datang
                    langsung ke <?= $datas_desa['nama_desa']; ?>, sehingga meningkatkan kualitas pelayanan publik dan
                    mengurangi potensi
                    antrean atau keterlambatan dalam proses administrasi.
                </p>

            </div>

        </div>

    </div>

</section><!-- /About Section -->

<?php $this->endSection('content'); ?>