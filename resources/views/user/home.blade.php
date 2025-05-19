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
                    <div class="d-flex">
                        <a href="{{ route('pelatihan') }}" class="btn-get-started">Cari Pelatihan</a>
                        <a href="https://youtu.be/6IJRKUNlnxM?si=b27BlsoK5eelsJBd"
                            class="glightbox btn-watch-video d-flex align-items-center"><i
                                class="bi bi-play-circle"></i><span>Tentang Kami</span></a>
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

                                <a href="{{ route('reguler.show', $item->hash_id) }}"
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


    <!-- Team Section -->
    {{-- <section id="team" class="team section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Fasilitator Kami</span>
            <h2>Fasilitator Kami</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper" data-speed="600" data-delay="5000"
                data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 20 }, &quot;768&quot;: { &quot;slidesPerView&quot;: 2, &quot;spaceBetween&quot;: 20 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 30 } }">

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
                        "spaceBetween": 20
                    },
                    "768": {
                        "slidesPerView": 2,
                        "spaceBetween": 20
                    },
                    "1200": {
                        "slidesPerView": 3,
                        "spaceBetween": 30
                    }
                }
            }
            </script>

                <div class="swiper-wrapper mb-5">
                    @foreach ($fasilitator as $item)
                        <div class="swiper-slide">
                            <div class="member mb-3">
                                <div class="pic">
                                    <img src="{{ $item->photo_url ? route('file.show', ['filename' => $item->photo_url]) : asset('images/default.png') }}"
                                        class="img-fluid" alt="{{ $item->nama_fasilitator }}">
                                </div>
                                <div class="member-info">
                                    <h4>{{ $item->nama_fasilitator }}</h4>
                                    <span>{{ $item->asal_lembaga }}</span>
                                    <div class="social">
                                        <a href="{{ $item->twitter }}"><i class="bi bi-twitter-x"></i></a>
                                        <a href="{{ $item->facebook }}"><i class="bi bi-facebook"></i></a>
                                        <a href="{{ $item->instagram }}"><i class="bi bi-instagram"></i></a>
                                        <a href="{{ $item->linkedin }}"><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section><!-- /Team Section --> --}}


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
