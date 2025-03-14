@extends('layouts.user')

@section('content')
    <style>
        .pelatihan .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s ease;
            min-height: 400px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .pelatihan .card-has-bg {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            position: relative;
        }

        .pelatihan .card-img-overlay {
            background: rgba(191, 231, 171, 0.6);
            /* Semi-transparent white overlay */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
        }

        .pelatihan .card-title {
            font-weight: bold;
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .pelatihan .card-footer {
            background-color: transparent;
            border-top: none;
        }

        .pelatihan .media img {
            border-radius: 50%;
        }

        .pelatihan .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .pelatihan a {
            text-decoration: none;
        }

        .pelatihan a:hover {
            color: #438848;
        }

        .btn-outline-success {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .pelatihan .btn-outline-success:hover {
            background-color: #28a745;
            /* Background color on hover */
            color: white;
            /* Text color on hover */
            border-color: #28a745;
            /* Ensure border stays green */
        }

        .pelatihan .btn-outline-success:focus {
            box-shadow: none;
            /* Remove focus outline */
        }

        @media (max-width: 768px) {
            .pelatihan .card {
                min-height: 350px;
            }
        }

        @media (max-width: 576px) {
            .pelatihan .card {
                min-height: 300px;
            }
        }

        /* Animation on Hover */
        .animate-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .animate-card:hover {
            transform: translateY(-15px);
            /* Card moves up by 15px */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
            /* Enhanced shadow for lifted effect */
        }

        /* Image Hover Animation */
        .icon-image {
            transition: transform 0.3s ease;
        }

        .icon-image:hover {
            transform: scale(1.1);
            /* Scale image slightly when hovered */
        }

        /* Card Styling */
        .card {
            background-color: #ffffff;
            border-radius: 15px;
            transition: all 0.3s ease-in-out;
        }

        /* Card Title */
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #000000;
        }

        /* Hover effect on card title */
        .card-title:hover {
            color: #438848;
        }

        @media (max-width: 768px) {
            .col-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
    <!-- Hero Section -->
    {{-- <div class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Tingkatkan pengetahuan demi masa depan organisasi Anda.</h1>
                <p>Kami menyediakan kursus online dan modul bacaan untuk membantu organisasi masyarakat sipil (OMS)
                    Anda lebih resiliensi secara finansial.</p>
                <div class="buttons">
                    <a href="{{ route('pelatihan') }}" class="btn btn-success">Lihat Produk Pelatihan Kami</a>
                    <a href="{{ route('tentang') }}" class="btn btn-outline-success">Tentang Kami</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/hero.png') }}" alt="Hero Image">
            </div>
        </div>
    </div>


    <!-- About Section with Video -->
    <div class="about-section py-5 bg-light">
        <div class="container text-center">
            <h5>Tentang</h5>
            <h2 style="color: #438848;">SATUNAMA <span style="color: #000000;">Training Center </span></h2>

            <!-- Video Container -->
            <div class="video-container my-4">
                <iframe src="https://www.youtube.com/embed/70tJNqm9t0w?si=HO6XvrSNOJwHgKiM" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>

            <!-- Descriptive Text -->
            <p class="about-description">
                <strong style="color: #438848;">SATUNAMA</strong> melalui Unit Training dan Konsultasi ingin
                menyumbangkan seoptimal mungkin kepada semua pihak apa yang dimiliki serta apa yang menjadi pusat
                keprihatinannya. Menjadi jelas bahwa SATUNAMA merupakan bagian integral dari perkembangan Bangsa Indonesia
                yang bergerak maju dalam semangat saling mendukung, menguatkan, dan menyumbangkan yang dimilikinya.
            </p>
        </div>
    </div>

    <!-- Mengapa SATUNAMA Training Center Section -->
    <div class="why-satunama-section py-5">
        <div class="container text-center">
            <h5>Mengapa</h5>
            <h2 style="color: #438848;">SATUNAMA <span style="color: #000000;">Training Center </span></h2>
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon icon-circle">
                                <img src="{{ asset('images/icon9.png') }}" alt="Gratis" class="img-fluid">
                            </div>
                            <h5 class="card-title">Tema yang Menarik</h5>
                            <p class="card-text">Akses ragam produk pembelajaran yang berkualitas tanpa dipungut biaya.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon">
                                <img src="{{ asset('images/icon8.png') }}" alt="Fleksibel" class="img-fluid">
                            </div>
                            <h5 class="card-title">Fleksibel</h5>
                            <p class="card-text">Dapat diakses kapanpun dan di manapun. Daftar sekarang untuk mengikuti
                                pelatihan nanti.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="icon">
                                <img src="{{ asset('images/icon10.png') }}" alt="Dari Ahli" class="img-fluid">
                            </div>
                            <h5 class="card-title">Dari Ahli</h5>
                            <p class="card-text">Materi pembelajaran disusun oleh ahli yang berpengalaman di bidang
                                pengembangan kapasitas OMS.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div style="width: 80%; max-width: 1200px; margin: 20px auto;">
        <!-- Section 1 -->
        <div
            style="display: flex; align-items: center; padding: 20px; margin-bottom: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div style="flex: 1; padding: 20px;">
                <h2 style="font-size: 24px; margin-bottom: 10px; color: #333;">Reguler</h2>
                <p style="font-size: 16px; line-height: 1.6; color: #666;">Our laptop sleeve is compact and precisely fits
                    13" devices. The zipper allows you to access the interior with ease, and the front pouch provides a
                    convenient place for your charger cable.</p>
                    <a class="btn btn-success" href="">Lihat Pelatihan</a>
            </div>
            <div style="flex: 1; display: flex; justify-content: center; align-items: center; padding: 20px;">
                <img src="{{ asset('images/pelatihan1.jpg') }}" alt="Laptop Sleeve" style="width: 80%; max-width: 500px; border-radius: 8px;">
            </div>
        </div>

        <!-- Section 2 -->
        <div
            style="display: flex; align-items: center; padding: 20px; margin-bottom: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); flex-direction: row-reverse;">
            <div style="flex: 1; padding: 20px;">
                <h2 style="font-size: 24px; margin-bottom: 10px; color: #333;">Refined details</h2>
                <p style="font-size: 16px; line-height: 1.6; color: #666;">We design every detail with the best materials
                    and finishes. This laptop sleeve features durable canvas with double-stitched construction, a felt
                    interior, and a high quality zipper that hold up to daily use.</p>
            </div>
            <div style="flex: 1; display: flex; justify-content: center; align-items: center; padding: 20px;">
                <img src="{{ asset('images/icon10.png') }}" alt="Laptop Sleeve Close-up"
                    style="width: 100%; max-width: 500px; border-radius: 8px;">
            </div>
        </div>
    </div> --}}

    <!-- Products Section -->
    {{-- <div class="products-section py-5" style="background-color: #fff8e5">
        <div class="container text-center">
            <h2>Produk Pelatihan Kami</h2>
            <p>
                Kami menyediakan kursus online dan modul bacaan untuk membantu organisasi masyarakat sipil Anda lebih
                resilien secara finansial.
            </p>
            <div class="card-wrapper">
                <div class="card">
                    <img src="{{ asset('images/reguler.png') }}" alt="Modul Belajar">
                    <h3>Reguler</h3>
                    <p>Jelajahi materi bacaan seputar topik ketahanan finansial dan inovasi sosial</p>
                    <a href="#" class="button">Lihat Modul</a>
                </div>
                <div class="card">
                    <img src="{{ asset('images/permintaan.png') }}" alt="Kursus Daring">
                    <h3>Permintaan</h3>
                    <p>Ikuti kursus seputar ketahanan dan inovasi finansial untuk organisasi Anda</p>
                    <a href="#" class="button">Lihat Kursus</a>
                </div>
                <div class="card">
                    <img src="{{ asset('images/konsultasi.png') }}" alt="Kursus Daring">
                    <h3>Konsultasi</h3>
                    <p>Ikuti kursus seputar ketahanan dan inovasi finansial untuk organisasi Anda</p>
                    <a href="#" class="button">Lihat Kursus</a>
                </div>
                <div class="card">
                    <img src="{{ asset('images/lab.png') }}" alt="Kursus Daring">
                    <h3>Innovation Lab</h3>
                    <p>Ikuti kursus seputar ketahanan dan inovasi finansial untuk organisasi Anda</p>
                    <a href="#" class="button">Lihat Kursus</a>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Facilitator Section -->
    {{-- <div class="facilitators-section py-4">
        <div class="container text-center">
            <h2>Fasilitator Kami</h2>
            <div id="facilitatorCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($fasilitator->chunk(2) as $index => $chunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $f)
                                    <div class="col-md-4"> <!-- Ubah ke 4 untuk 3 kartu per slide -->
                                        <div class="card">
                                            <img src="{{ asset('images/lab.png') }}" alt="{{ $f->nama_fasilitator }}"
                                                class="card-img-top">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $f->nama_fasilitator }}</h5>
                                                <p class="card-text">{{ strip_tags($f->body) }}</p>
                                                <!-- Menghapus tag HTML -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> <!-- tutup carousel-item -->
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#facilitatorCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#facilitatorCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div> --}}
    {{-- 
    <style>
        .parallax {
            /* The image used */
            background-image: url('/images/contact.png');
    
            /* Set a specific height */
            min-height: 500px;
    
            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
    
        /* Dark overlay */
        .parallax::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity as needed */
            z-index: 1; /* Make sure the overlay is above the background */
        }
    
        /* Text inside parallax */
        .parallax-text {
            position: absolute;
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%);
            color: #fff;
            text-align: center;
            z-index: 2; /* Ensure text is above the overlay */
        }
    
        /* Responsive adjustment for devices */
        /* @media only screen and (max-device-width: 1366px) {
            .parallax {
                background-attachment: scroll;
            }
    
            .parallax-text {
                position: static;
                transform: none;
                text-align: center;
                margin-top: 20px;
            }
        } */
    </style>
     --}}
    <!-- Parallax Section -->
    {{-- <div class="parallax">
        <div class="parallax-text">
            <h2>Apakah Anda Membutuhkan Pengembangan Kapasitas?</h2>
            <p>Kami siap membantu Anda dalam meningkatkan kemampuan dan kapasitas melalui berbagai program pelatihan dan pendampingan.</p>
            <a href="#" class="btn btn-warning">Hubungi Kami</a>
        </div>
    </div> --}}
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
                    <h1>Apakah Anda Membutuhkan Pengembangan Kapasitas?</h1>
                    <p>Kami siap membantu Anda dalam meningkatkan kemampuan dan kapasitas melalui berbagai program pelatihan
                        dan pendampingan.</p>
                    <div class="d-flex">
                        <a href="#about" class="btn-get-started">Get Started</a>
                        <a href="https://youtu.be/6IJRKUNlnxM?si=b27BlsoK5eelsJBd"
                            class="glightbox btn-watch-video d-flex align-items-center"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                    <img src="assetss/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->
    {{-- 
    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-activity icon"></i></div>
                        <img src="{{ asset('images/icon9.png') }}" alt="Gratis" class="img-fluid">
                        <h4><a href="" class="stretched-link">Tema yang Menarik</a></h4>
                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                        <h4><a href="" class="stretched-link">Sed ut perspici</a></h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
                        <h4><a href="" class="stretched-link">Magni Dolores</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>

    </section><!-- /Featured Services Section --> --}}

    <!-- About Section -->
    <section id="about" class="about section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Tentang Kami<br></span>
            <h2>Tentang</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                    <img src="assetss/img/about.png" class="img-fluid" alt="">
                    <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
                </div>
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                    <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore
                        magna aliqua.
                    </p>
                    <ul>
                        <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                consequat.</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Duis aute irure dolor in reprehenderit in
                                voluptate velit.</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate trideta
                                storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li>
                    </ul>
                    <p>
                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident
                    </p>
                </div>
            </div>

        </div>

    </section><!-- /About Section -->

    {{-- <!-- Stats Section -->
    <section id="stats" class="stats section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Clients</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Projects</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Hours Of Support</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Workers</p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section --> --}}

    <!-- Services Section -->
    {{-- <section id="services" class="services section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Pelatihan</span>
            <h2>Pelatihan</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-activity"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Nesciunt Mete</h3>
                        </a>
                        <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores
                            iure perferendis tempore et consequatur.</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-broadcast"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Eosle Commodi</h3>
                        </a>
                        <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum
                            hic non ut nesciunt dolorem.</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-easel"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Ledo Markt</h3>
                        </a>
                        <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id
                            voluptas adipisci eos earum corrupti.</p>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-bounding-box-circles"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Asperiores Commodit</h3>
                        </a>
                        <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga
                            sit provident adipisci neque.</p>
                        <a href="service-details.html" class="stretched-link"></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-calendar4-week"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Velit Doloremque</h3>
                        </a>
                        <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed
                            animi at autem alias eius labore.</p>
                        <a href="service-details.html" class="stretched-link"></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="bi bi-chat-square-text"></i>
                        </div>
                        <a href="service-details.html" class="stretched-link">
                            <h3>Dolori Architecto</h3>
                        </a>
                        <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure.
                            Corrupti recusandae ducimus enim.</p>
                        <a href="service-details.html" class="stretched-link"></a>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div>
        
    </div>

    </section><!-- /Services Section --> --}}

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Produk dan Layanan</span>
            <h2>Produk dan Layanan</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        {{-- <div class="container">

            <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-app">App</li>
                    <li data-filter=".filter-product">Product</li>
                    <li data-filter=".filter-branding">Branding</li>
                    <li data-filter=".filter-books">Books</li>
                </ul><!-- End Portfolio Filters -->

                <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                        <img src="assetss/img/portfolio/app-1.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 1</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/app-1.jpg" title="App 1" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                        <img src="assetss/img/portfolio/product-1.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Product 1</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/product-1.jpg" title="Product 1"
                                data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                        <img src="assetss/img/portfolio/branding-1.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Branding 1</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/branding-1.jpg" title="Branding 1"
                                data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                        <img src="assetss/img/portfolio/books-1.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Books 1</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/books-1.jpg" title="Branding 1"
                                data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                        <img src="assetss/img/portfolio/app-2.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 2</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/app-2.jpg" title="App 2" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                        <img src="assetss/img/portfolio/product-2.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Product 2</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/product-2.jpg" title="Product 2"
                                data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                        <img src="assetss/img/portfolio/branding-2.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Branding 2</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/branding-2.jpg" title="Branding 2"
                                data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                        <img src="assetss/img/portfolio/books-2.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Books 2</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/books-2.jpg" title="Branding 2"
                                data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                        <img src="assetss/img/portfolio/app-3.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App 3</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/app-3.jpg" title="App 3" data-gallery="portfolio-gallery-app"
                                class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                        <img src="assetss/img/portfolio/product-3.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Product 3</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/product-3.jpg" title="Product 3"
                                data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
                        <img src="assetss/img/portfolio/branding-3.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Branding 3</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/branding-3.jpg" title="Branding 2"
                                data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                    <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
                        <img src="assetss/img/portfolio/books-3.jpg" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Books 3</h4>
                            <p>Lorem ipsum, dolor sit amet consectetur</p>
                            <a href="assetss/img/portfolio/books-3.jpg" title="Branding 3"
                                data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i
                                    class="bi bi-zoom-in"></i></a>
                            <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                    class="bi bi-link-45deg"></i></a>
                        </div>
                    </div><!-- End Portfolio Item -->

                </div><!-- End Portfolio Container -->

            </div>

        </div> --}}

        <div class="container px-4">
            <div class="row gx-5">
                <!-- Section Header Column -->
                <div class="col" style="margin-top: 150px;">
                    <div class="py-5">
                        <!-- Adding more margin to push the header section down -->
                        <div class="container text-left mt-5" style="margin-top: 180px;">
                            {{-- <h5>Produk dan Layanan</h5> --}}
                            <h2 style="color: #438848;">SATUNAMA <span style="color: #000000;">Training Center</span></h2>
                            <hr>
                            <p class="text-muted">Telusuri produk - produk pelatihan kami untuk menunjang pekerjaan dan
                                usaha Anda</p>
                        </div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="col">
                    <div class="container py-5">
                        <div class="row gy-5 text-center">
                            <!-- Reguler -->
                            <div class="col-6 mb-4">
                                <div class="card h-100 shadow-sm animate-card" style="border-radius: 15px;">
                                    <div class="card-body">
                                        <a href="{{ route('reguler.index') }}">
                                            <img src="{{ asset('images/reguler1.png') }}" alt="Materi Pembelajaran"
                                                class="img-fluid mb-3 icon-image">
                                            <h4 class="card-title">Reguler</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Permintaan -->
                            <div class="col-6 mb-4">
                                <div class="card h-100 shadow-sm animate-card" style="border-radius: 15px;">
                                    <div class="card-body">
                                        <a href="{{ route('permintaan.create') }}">
                                            <img src="{{ asset('images/permintaan1.png') }}" alt="Permintaan"
                                                class="img-fluid mb-3 icon-image">
                                            <h4 class="card-title">Permintaan</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Konsultasi -->
                            <div class="col-6 mb-4">
                                <div class="card h-100 shadow-sm animate-card" style="border-radius: 15px;">
                                    <div class="card-body">
                                        <a href="{{ route('konsultasi.create') }}">
                                            <img src="{{ asset('images/konsultasi1.png') }}" alt="Konsultasi"
                                                class="img-fluid mb-3 icon-image">
                                            <h4 class="card-title">Konsultasi</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Innovation Lab -->
                            <div class="col-6 mb-4">
                                <div class="card h-100 shadow-sm animate-card" style="border-radius: 15px;">
                                    <div class="card-body">
                                        <a href="{{ route('ctga') }}">
                                            <img src="{{ asset('images/ctga.png') }}" alt="Innovation Lab"
                                                class="img-fluid mb-3 icon-image">
                                            <h4 class="card-title">CTGA</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Portfolio Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Testimonials</span>
            <h2>Testimonials</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper" data-speed="600" data-delay="5000"
                data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
                <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 40
            },
            "1200": {
              "slidesPerView": 3,
              "spaceBetween": 20
            }
          }
        }
      </script>
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item" "="">
                        <p>
                          <i class=" bi bi-quote quote-icon-left"></i>
                            <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <img src="assetss/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                            <h3>Saul Goodman</h3>
                            <h4>Ceo &amp; Founder</h4>
                          </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                          <div class="testimonial-item">
                            <p>
                              <i class="bi bi-quote quote-icon-left"></i>
                              <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                              <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <img src="assetss/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                            <h3>Sara Wilsson</h3>
                            <h4>Designer</h4>
                          </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                          <div class="testimonial-item">
                            <p>
                              <i class="bi bi-quote quote-icon-left"></i>
                              <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                              <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <img src="assetss/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                            <h3>Jena Karlis</h3>
                            <h4>Store Owner</h4>
                          </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                          <div class="testimonial-item">
                            <p>
                              <i class="bi bi-quote quote-icon-left"></i>
                              <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                              <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <img src="assetss/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                            <h3>Matt Brandon</h3>
                            <h4>Freelancer</h4>
                          </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                          <div class="testimonial-item">
                            <p>
                              <i class="bi bi-quote quote-icon-left"></i>
                              <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                              <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                            <img src="assetss/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                            <h3>John Larson</h3>
                            <h4>Entrepreneur</h4>
                          </div>
                        </div><!-- End testimonial item -->

                      </div>
                      <div class="swiper-pagination"></div>
                    </div>

                  </div>

                </section><!-- /Testimonials Section -->

                <!-- Call To Action Section -->
                <section id="call-to-action" class="call-to-action section accent-background">

                  <div class="container">
                    <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                      <div class="col-xl-10">
                        <div class="text-center">
                          <h3>Call To Action</h3>
                          <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                          <a class="cta-btn" href="#">Call To Action</a>
                        </div>
                      </div>
                    </div>
                  </div>

                </section><!-- /Call To Action Section -->

                <!-- Team Section -->
                <section id="team" class="team section">

                  <!-- Section Title -->
                  <div class="container section-title" data-aos="fade-up">
                    <span>Section Title</span>
                    <h2>Team</h2>
                    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
                  </div><!-- End Section Title -->

                  <div class="container">

                    <div class="row gy-5">

                      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                          <div class="pic"><img src="assetss/img/team/team-1.jpg" class="img-fluid" alt=""></div>
                          <div class="member-info">
                            <h4>Walter White</h4>
                            <span>Chief Executive Officer</span>
                            <div class="social">
                              <a href=""><i class="bi bi-twitter-x"></i></a>
                              <a href=""><i class="bi bi-facebook"></i></a>
                              <a href=""><i class="bi bi-instagram"></i></a>
                              <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                          </div>
                        </div>
                      </div><!-- End Team Member -->

                      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                          <div class="pic"><img src="assetss/img/team/team-2.jpg" class="img-fluid" alt=""></div>
                          <div class="member-info">
                            <h4>Sarah Jhonson</h4>
                            <span>Product Manager</span>
                            <div class="social">
                              <a href=""><i class="bi bi-twitter-x"></i></a>
                              <a href=""><i class="bi bi-facebook"></i></a>
                              <a href=""><i class="bi bi-instagram"></i></a>
                              <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                          </div>
                        </div>
                      </div><!-- End Team Member -->

                      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="member">
                          <div class="pic"><img src="assetss/img/team/team-3.jpg" class="img-fluid" alt=""></div>
                          <div class="member-info">
                            <h4>William Anderson</h4>
                            <span>CTO</span>
                            <div class="social">
                              <a href=""><i class="bi bi-twitter-x"></i></a>
                              <a href=""><i class="bi bi-facebook"></i></a>
                              <a href=""><i class="bi bi-instagram"></i></a>
                              <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                          </div>
                        </div>
                      </div><!-- End Team Member -->

                    </div>

                  </div>

                </section><!-- /Team Section -->

                {{-- <!-- Contact Section -->
        <section id="contact" class="contact section">

          <!-- Section Title -->
          <div class="container section-title" data-aos="fade-up">
            <span>Section Title</span>
            <h2>Contact</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
          </div><!-- End Section Title -->

          <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

              <div class="col-lg-5">

                <div class="info-wrap">
                  <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                    <i class="bi bi-geo-alt flex-shrink-0"></i>
                    <div>
                      <h3>Address</h3>
                      <p>A108 Adam Street, New York, NY 535022</p>
                    </div>
                  </div><!-- End Info Item -->

                  <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                    <i class="bi bi-telephone flex-shrink-0"></i>
                    <div>
                      <h3>Call Us</h3>
                      <p>+1 5589 55488 55</p>
                    </div>
                  </div><!-- End Info Item -->

                  <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                    <i class="bi bi-envelope flex-shrink-0"></i>
                    <div>
                      <h3>Email Us</h3>
                      <p>info@example.com</p>
                    </div>
                  </div><!-- End Info Item -->

                  <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              </div>

              <div class="col-lg-7">
                <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                  <div class="row gy-4">

                    <div class="col-md-6">
                      <label for="name-field" class="pb-2">Your Name</label>
                      <input type="text" name="name" id="name-field" class="form-control" required="">
                    </div>

                    <div class="col-md-6">
                      <label for="email-field" class="pb-2">Your Email</label>
                      <input type="email" class="form-control" name="email" id="email-field" required="">
                    </div>

                    <div class="col-md-12">
                      <label for="subject-field" class="pb-2">Subject</label>
                      <input type="text" class="form-control" name="subject" id="subject-field" required="">
                    </div>

                    <div class="col-md-12">
                      <label for="message-field" class="pb-2">Message</label>
                      <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                    </div>

                    <div class="col-md-12 text-center">
                      <div class="loading">Loading</div>
                      <div class="error-message"></div>
                      <div class="sent-message">Your message has been sent. Thank you!</div>

                      <button type="submit">Send Message</button>
                    </div>

                  </div>
                </form>
              </div><!-- End Contact Form -->

            </div>

          </div>
          

        </section><!-- /Contact Section -->
         --}}
                <style>
                    .parallax {
                        /* The image used */
                        background-image: url('/images/contact.png');
                
                        /* Set a specific height */
                        min-height: 500px;
                
                        /* Create the parallax scrolling effect */
                        background-attachment: fixed;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                        position: relative;
                    }
                
                    /* Dark overlay */
                    .parallax::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity as needed */
                        z-index: 1; /* Make sure the overlay is above the background */
                    }
                
                    /* Text inside parallax */
                    .parallax-text {
                        position: absolute;
                        top: 50%; /* Center vertically */
                        left: 50%; /* Center horizontally */
                        transform: translate(-50%, -50%);
                        color: #fff;
                        text-align: center;
                        z-index: 2; /* Ensure text is above the overlay */
                    }
                
                    /* Responsive adjustment for devices */
                    /* @media only screen and (max-device-width: 1366px) {
                        .parallax {
                            background-attachment: scroll;
                        }
                
                        .parallax-text {
                            position: static;
                            transform: none;
                            text-align: center;
                            margin-top: 20px;
                        }
                    } */
                </style>
                <!-- Parallax Section -->
                <div class="parallax">
                    <div class="parallax-text">
                        <h2 style="color: #fff">Apakah Anda Membutuhkan Pengembangan Kapasitas?</h2>
                        <p style="color: #fff">Kami siap membantu Anda dalam meningkatkan kemampuan dan kapasitas melalui berbagai program pelatihan dan pendampingan.</p>
                        <a href="#" class="btn btn-success">Hubungi Kami</a>
                    </div>
                </div>
@endsection
