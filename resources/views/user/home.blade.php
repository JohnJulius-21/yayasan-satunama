@extends('layouts.user')

@section('content')
    <style>
        @keyframes loading {
            0% {
                background-color: #e0e0e0;
            }

            50% {
                background-color: #f0f0f0;
            }

            100% {
                background-color: #e0e0e0;
            }
        }

        .skeleton {
            animation: loading 1.5s infinite ease-in-out;
            border-radius: 10px;
        }

        .skeleton-wrapper {
            overflow: hidden;
            border-radius: 10px;
            width: 100%;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .skeleton-img {
            width: 100%;
            height: 200px;
            border-radius: 10px;
            /* Sesuaikan dengan ukuran gambar */
        }

        .real-img {
            display: none;
            /* Sembunyikan gambar asli sampai dimuat */
        }

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

    <section id="hero" class="hero section">

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
                    <h1>Apakah Anda Membutuhkan Pengembangan Kapasitas?</h1>
                    <p>Kami siap membantu Anda dalam meningkatkan kemampuan dan kapasitas melalui berbagai program pelatihan
                        dan pendampingan.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('pelatihan') }}" class="btn-get-started">Cari Pelatihan</a>

                        <a href="https://youtu.be/6IJRKUNlnxM?si=b27BlsoK5eelsJBd"
                            class="glightbox btn-watch-video d-flex align-items-center">
                            <i class="bi bi-play-circle"></i><span>Tentang Kami</span>
                        </a>

                        <a href="{{ asset('files/panduan-pengguna.pdf') }}" class="btn btn-outline" download>
                            <i class="bi bi-download me-1"></i> Download Panduan Pengguna
                        </a>
                    </div>

                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                    <img src="assetss/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- /Hero Section -->

    <section class="pelatihan" id="pelatihan" data-aos="fade-up">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Pelatihan Terbaru Kami</span>
            <h2>Pelatihan Terbaru Kami</h2>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row">
                @foreach ($reguler as $item)
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="skeleton-wrapper">
                                <div class="skeleton skeleton-img"></div> <!-- Skeleton sementara -->
                                <img src="{{ $item->image_url ?? asset('img/stc.png') }}" alt="{{ $item->nama_pelatihan }}"
                                    class="card-img-top real-img" onload="removeSkeleton(this)"
                                    onerror="this.onerror=null; this.src='{{ asset('images/stc.png') }}'">


                            </div>

                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                    {{ $item->nama_pelatihan }}
                                    @php
                                        $now = \Carbon\Carbon::now();
                                        $batasPendaftaran = \Carbon\Carbon::parse($item->tanggal_batas_pendaftaran);
                                    @endphp
                                    @if ($now->lessThanOrEqualTo($batasPendaftaran))
                                        <span class="badge bg-success">Buka</span>
                                    @else
                                        <span class="badge bg-danger">Tutup</span>
                                    @endif
                                </h5>

                                <small><i class="far fa-calendar-days"></i> Tanggal Pendaftaran :
                                    {{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->translatedFormat('d F Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->tanggal_batas_pendaftaran)->translatedFormat('d F Y') }}
                                </small>

                                <p class="card-text mt-2">
                                    {{ \Illuminate\Support\Str::words(strip_tags($item->deskripsi_pelatihan), 5, '...') }}
                                </p>

                                <a href="{{ route('reguler.show', ['hash' => $item->hash_id]) }}"
                                    class="btn btn-outline-success btn-sm">Lihat Detail</a>
                            </div>

                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    <a href="{{ route('pelatihan') }}" class="btn btn-outline-success my-5">Lihat Semua Pelatihan
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Pelatihan dan Layanan</span>
            <h2>Pelatihan dan Layanan</h2>
            <p>Telusuri produk - produk pelatihan kami untuk menunjang pekerjaan dan
                usaha Anda</p>
        </div><!-- End Section Title -->

        <div class="container px-4" data-aos="fade-up">
            <div class="row gy-4 text-center">

                <!-- Reguler -->
                <div class="col-md-4">
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
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm animate-card" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            @guest
                                <button type="button" class="btn p-0 border-0 bg-transparent" data-bs-toggle="modal"
                                    data-bs-target="#loginModal">
                                    <img src="{{ asset('images/permintaan1.png') }}" alt="Permintaan"
                                        class="img-fluid mb-3 icon-image">
                                    <h4 class="card-title">Permintaan</h4>
                                </button>
                            @else
                                <a href="{{ route('permintaan.create') }}">
                                    <img src="{{ asset('images/permintaan1.png') }}" alt="Permintaan"
                                        class="img-fluid mb-3 icon-image">
                                    <h4 class="card-title">Permintaan</h4>
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>

                <!-- Konsultasi -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm animate-card" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            @guest
                                <button type="button" class="btn p-0 border-0 bg-transparent" data-bs-toggle="modal"
                                    data-bs-target="#loginModal">
                                    <img src="{{ asset('images/konsultasi1.png') }}" alt="Konsultasi"
                                        class="img-fluid mb-3 icon-image">
                                    <h4 class="card-title">Konsultasi</h4>
                                </button>
                            @else
                                <a href="{{ route('konsultasi.create') }}">
                                    <img src="{{ asset('images/konsultasi1.png') }}" alt="Konsultasi"
                                        class="img-fluid mb-3 icon-image">
                                    <h4 class="card-title">Konsultasi</h4>
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </section><!-- /Portfolio Section -->



    <!-- Facilitator Section -->
    <section id="fasilitator" class="facilitators-section py-5 bg-light">
        <div class="container text-center">
            <h2 class="mb-4">Fasilitator Kami</h2>
            <div id="facilitatorCarousel" class="carousel slide" data-bs-ride="carousel">


                <!-- Carousel items -->
                <div class="carousel-inner">
                    @foreach ($fasilitator->chunk(3) as $index => $chunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row justify-content-center">
                                @foreach ($chunk as $f)
                                    <div class="col-md-3 mb-3">
                                        <div class="card shadow-sm h-100 animate-card">
                                            <img src="{{ !empty($f->photo_url) ? asset('storage/public/fasilitator_foto/' . $f->photo_url) : asset('images/lab.png') }}"
                                            class="card-img-top img-fluid rounded mx-auto d-block"
                                            alt="{{ $f->nama_fasilitator }}"
                                            style="height: 220px; width: 280px; object-fit: cover; object-position: top;">
                                        
                                            <div class="card-body">
                                                <h5 class="card-title text-success">{{ $f->nama_fasilitator }}</h5>
                                                <p class="card-text">
                                                    {{ \Illuminate\Support\Str::words(strip_tags($f->asal_lembaga), 20, '...') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Indicators -->
                <div class="carousel-indicators">
                    @foreach ($fasilitator->chunk(3) as $index => $chunk)
                        <button type="button" data-bs-target="#facilitatorCarousel"
                            data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                            aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#facilitatorCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Sebelumnya</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#facilitatorCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Berikutnya</span>
                </button>
            </div>


        </div>
    </section>




    {{-- <!-- Stats Section -->
    <section id="stats" class="stats section">
        <div class="container section-title" data-aos="fade-up">
            <span>Dampak Kami</span>
            <h2>Dampak Kami</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-3">

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <p>

                            <span data-purecounter-start="0" data-purecounter-end="290" data-purecounter-duration="1"
                                class="purecounter"></span>
                                +
                        </p>
                        <p>Clients</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="586964836800"
                            data-purecounter-duration="1" data-purecounter-currency="Rp" data-purecounter-decimals="10" data-purecounter-separator="true" class="purecounter"></span>
                        <p>Projects</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="1599" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Hours Of Support</p>
                    </div>
                </div><!-- End Stats Item -->

            </div>

        </div>

    </section><!-- /Stats Section --> --}}


    <script>
        AOS.init();
    </script>

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
            background-color: rgba(0, 0, 0, 0.5);
            /* Adjust opacity as needed */
            z-index: 1;
            /* Make sure the overlay is above the background */
        }

        /* Text inside parallax */
        .parallax-text {
            position: absolute;
            top: 50%;
            /* Center vertically */
            left: 50%;
            /* Center horizontally */
            transform: translate(-50%, -50%);
            color: #fff;
            text-align: center;
            z-index: 2;
            /* Ensure text is above the overlay */
        }

        .facilitators-section h2 {
            font-weight: 700;
            color: #1b5e20;
        }

        .facilitators-section .card {
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .facilitators-section .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .carousel-indicators {
            position: relative !important;
            /* agar tidak absolute */
            /* margin-top: 3rem; */
            /* atau sesuaikan */
        }


        .carousel-indicators [data-bs-target] {
            background-color: #438848;

        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #1b5e20;
            /* Hijau tua */
            border-radius: 50%;
            background-size: 100% 100%;
            background-image: none;
            /* Hapus ikon default */
            width: 2.5rem;
            height: 2.5rem;
            display: inline-block;
            position: relative;
        }

        .carousel-control-prev-icon::after,
        .carousel-control-next-icon::after {
            content: '';
            display: block;
            width: 0.6rem;
            height: 0.6rem;
            border: solid white;
            border-width: 0 3px 3px 0;
            padding: 5px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .carousel-control-prev-icon::after {
            transform: translate(-50%, -50%) rotate(135deg);
            /* Panah kiri */
        }

        .carousel-control-next-icon::after {
            transform: translate(-50%, -50%) rotate(-45deg);
            /* Panah kanan */
        }
    </style>

    <!-- Parallax Section -->
    <div class="parallax">
        <div class="parallax-text">
            <h2 style="color: #fff">Apakah Anda Membutuhkan Pengembangan Kapasitas?</h2>
            <p style="color: #fff">Kami siap membantu Anda dalam meningkatkan kemampuan dan kapasitas melalui berbagai
                program pelatihan dan pendampingan.</p>
            <a href="https://api.whatsapp.com/send?phone=6282226887110&text=Halo,%20saya%20tertarik%20dengan%20program%20pengembangan%20kapasitas."
                class="btn btn-success" target="_blank"><i class="bi bi-whatsapp"></i> Hubungi Kami</a>
        </div>
    </div>

    <script>
        if (!localStorage.getItem('cacheNoticeAccepted')) {
            const div = document.createElement('div');
            div.style =
                "position: fixed; bottom: 0; left: 0; right: 0; background: #198754; color: white; padding: 10px; z-index: 9999; text-align: center;";
            div.innerHTML = `
                <span>Website ini menyimpan cache di perangkat Anda untuk mempercepat loading. </span>
                <button style="margin-left:10px; background:white; color:#198754; border:none; padding:5px 10px; cursor:pointer" onclick="acceptCache()">Oke</button>
            `;
            document.body.appendChild(div);

            window.acceptCache = function() {
                localStorage.setItem('cacheNoticeAccepted', 'yes');
                div.remove();
            }
        }

        function removeSkeleton(img) {
            let skeleton = img.previousElementSibling;
            if (skeleton) {
                skeleton.style.display = 'none';
            }
            img.style.display = 'block';
        }
    </script>
@endsection
