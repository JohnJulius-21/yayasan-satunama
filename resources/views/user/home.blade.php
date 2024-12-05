@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <div class="hero">
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
    </div>

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
    <div class="products-section py-5" style="background-color: #fff8e5">
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
    </div>

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
            <h2>Apakah Anda Membutuhkan Pengembangan Kapasitas?</h2>
            <p>Kami siap membantu Anda dalam meningkatkan kemampuan dan kapasitas melalui berbagai program pelatihan dan pendampingan.</p>
            <a href="#" class="btn btn-warning">Hubungi Kami</a>
        </div>
    </div>
    
    
@endsection
