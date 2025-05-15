@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Detail Pelatihan</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a href="{{ route('pelatihan') }}">Pelatihan</a></li>
                    <li class="current">Detail Pelatihan</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container overflow-hidden">
        <!-- Adjust the image size and add border radius -->
        <!-- Container for the image gallery -->
        <div class="container-image">
            @foreach ($imageUrls as $index => $imageUrl)
                <div class="mySlides">
                    <div class="numbertext">{{ $index + 1 }} / {{ count($imageUrls) }}</div>
                    <div class="skeleton skeleton-img"></div>
                    <img src="{{ $imageUrl }}" style="width:100%; display: none;" onload="removeSkeleton(this)">
                </div>
            @endforeach

            <!-- Next and previous buttons -->
            <div class="container-buttons">
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            {{-- <!-- Image text -->
            <div class="caption-container">
                <p id="caption"></p>
            </div> --}}

            <!-- Thumbnail images -->
            <div class="row">
                @foreach ($imageUrls as $index => $imageUrl)
                    <div class="column">
                        <div class="skeleton skeleton-thumbnail"></div>
                        <img class="demo cursor" src="{{ $imageUrl }}"
                            style="width:100%; display: none;" onclick="currentSlide({{ $index + 1 }})"
                            onload="removeSkeleton(this)">
                    </div>
                @endforeach
            </div>
        </div>


        <hr class="container mt-5" style="height: 3px; background-color: #000000; border: none;">

        <div class="row gx-6">
            <div class="col-sm-6 col-md-8">
                <div class="p-3">
                    <h4>{{ $pelatihan->nama_pelatihan }}</h4>
                    <p>Tanggal Pelaksanaan Pelatihan : <small><i class="far fa-calendar-days"></i>
                            {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }}
                            -
                            {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->locale('id')->translatedFormat('d F Y') }}
                        </small>
                    </p>
                    <span>Tentang Pelatihan ini : </span>
                    <div class="deskripsi-container">
                        <!-- Short text shown initially with ellipsis -->
                        <p id="deskripsi">
                            <span id="short-text">
                                {{ \Illuminate\Support\Str::words(strip_tags($pelatihan->deskripsi_pelatihan), 20, '...') }}
                            </span>
                            <span id="more" style="display: none;">
                                {{ strip_tags($pelatihan->deskripsi_pelatihan) }}
                            </span>
                        </p>
                        <div class="show-more-container">
                            <button onclick="toggleDescription()" id="toggleBtn" class="btn btn-link">Show More</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4 mb-3">
                <div class="card p-3 mt-3">
                    <h5>Daftar Pelatihan</h5>
                    <span>Tanggal Pendaftaran : </span>
                    <small><i class="far fa-calendar-days"></i>
                        {{ \Carbon\Carbon::parse($pelatihan->tanggal_pendaftaran)->locale('id')->translatedFormat('d F Y') }}
                        -
                        {{ \Carbon\Carbon::parse($pelatihan->tanggal_batas_pendaftaran)->locale('id')->translatedFormat('d F Y') }}
                    </small>
                    <hr>
                    <h5>Informasi Pelatihan</h5>
                    <span>Fasilitator :
                        @foreach ($fasilitators as $fasilitator)
                            {{ $fasilitator->nama_fasilitator }}@if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </span>
                    <span>Kuota Peserta : {{ $pelatihan->kuota_peserta }} Orang</span>
                    <span>Metode Pelatihan : {{ $pelatihan->metode_pelatihan }} </span>
                    <span>Lokasi Pelatihan : {{ $pelatihan->lokasi_pelatihan }} </span>
                    <span>Fee Pelatihan : Rp {{ number_format($pelatihan->fee_pelatihan, 0, ',', '.') }}</span>


                    <div class="card-footer text-center mt-2">
                        @php
                            $registrationDeadline = \Carbon\Carbon::parse($pelatihan->tanggal_batas_pendaftaran);
                            $isRegistrationClosed = \Carbon\Carbon::now()->gt($registrationDeadline);
                        @endphp

                        @guest
                            <!-- Belum login -->
                            <button type="button" class="btn btn-success w-100 {{ $isRegistrationClosed ? 'disabled' : '' }}"
                                {{ $isRegistrationClosed ? 'aria-disabled=true tabindex=-1' : '' }} data-bs-toggle="modal"
                                data-bs-target="#loginModal">
                                Daftar Pelatihan
                            </button>
                        @else
                            <!-- Sudah login -->
                            <button type="button" class="btn btn-success w-100 {{ $isRegistrationClosed ? 'disabled' : '' }}"
                                {{ $isRegistrationClosed ? 'aria-disabled=true tabindex=-1' : '' }} data-bs-toggle="modal"
                                data-bs-target="#pilihPesertaModal">
                                Daftar Pelatihan
                            </button>
                        @endguest

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pilih Jumlah Peserta -->
    <div class="modal fade" id="pilihPesertaModal" tabindex="-1" aria-labelledby="pilihPesertaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pilihPesertaModalLabel">Pilih Jumlah Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="jumlah_peserta">Berapa orang yang ingin mendaftar?</label>
                    <input type="number" id="jumlah_peserta" class="form-control" min="1" max="10"
                        value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="btnLanjutDaftar">Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>


    <style>
        /* Styling for pelatihan image */
        .pelatihan-image {
            width: 100%;
            /* or set a specific width, e.g., 75% */
            max-width: 1100px;
            max-height: 600px;
            /* Limit the maximum width */
            border-radius: 15px;
            /* Rounded corners */
            margin: 20px auto;
            /* Center if within a container */
            display: block;
            /* Ensures centering with margin auto */
        }

        /* Ensure card-footer is full width */
        .card-footer {
            background-color: #f8f9fa;
            /* Optional: Set to match the card’s color */
            margin-left: -1rem;
            /* Removes padding added by .card */
            margin-right: -1rem;
            margin-bottom: -1rem;
            /* Removes padding added by .card */
            padding: 1rem;
            /* Adjust padding for the footer content */
        }


        /* Styling for the button */
        .daftar-button {
            width: 100%;
            /* Make the button take 80% of the footer width */
            /* max-width: px; */
            /* Optional: limit max width for large screens */
        }

        /* Optional: Style for disabled button */
        .daftar-button:disabled {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }

        /* Style for visually disabled button */
        .disabled-link {
            pointer-events: none;
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }

        /* Mobile-specific adjustments */
        @media (max-width: 768px) {
            .card {
                padding: 1rem;
            }

            .card-footer {
                margin-left: -1rem;
                margin-right: -1rem;
            }
        }

        /* Styling for description container */
        .deskripsi-container {
            position: relative;
        }

        /* Hide more content initially */
        #more {
            display: none;
        }

        /* Show More button styling with lines on the sides */
        .show-more-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }

        #toggleBtn {
            color: #008b8b;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            position: relative;
            background: none;
            border: none;
            font-family: inherit;
            text-decoration: none;
            transition: color 0.3s;
            padding: 0 15px;
            display: flex;
            align-items: center;
        }

        /* Lines on the left and right */
        #toggleBtn::before,
        #toggleBtn::after {
            content: "";
            display: block;
            width: 50px;
            /* Length of the line */
            height: 1px;
            background-color: #ddd;
            margin: 0 10px;
            /* Space between the line and the text */
        }

        #toggleBtn:hover {
            color: #005f5f;
        }

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
            border-radius: 8px;
        }

        .skeleton-img {
            width: 100%;
            height: 400px;
            /* Sesuaikan tinggi gambar utama */
        }

        .skeleton-thumbnail {
            width: 100%;
            height: 80px;
            /* Sesuaikan tinggi thumbnail */
        }

        img {
            transition: opacity 0.3s ease-in-out;
        }

        * {
            box-sizing: border-box;
        }

        .container-image {
            position: relative;
            text-align: center;
        }

        .container-image img {
            width: 80%;
            max-height: 700px;
            border-radius: 10px;
            display: block;
            margin: 0 auto;
        }

        .container-buttons {
            position: absolute;
            top: 50%;
            width: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: space-between;
        }

        .prev,
        .next {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 10px;
            border-radius: 50%;
            transition: background-color 0.3s ease;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .row {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .column {
            flex: 0 1 80px;
            margin: 5px;
        }

        .column img {
            width: 100%;
            height: auto;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>

    <script>
        document.getElementById('btnLanjutDaftar').addEventListener('click', function() {
            let jumlahPeserta = document.getElementById('jumlah_peserta').value;
            let idPelatihan = "{{ $pelatihan->id_reguler }}"; // Ambil ID pelatihan dari Blade

            // Redirect ke halaman pendaftaran dengan jumlah peserta
            window.location.href = `/pelatihan/reguler/daftar/${idPelatihan}?jumlah=${jumlahPeserta}`;
        });

        function toggleDescription() {
            const moreText = document.getElementById("more");
            const shortText = document.getElementById("short-text");
            const btnText = document.getElementById("toggleBtn");

            // Toggle visibility and button text
            if (moreText.style.display === "none") {
                shortText.style.display = "none"; // Hide short text
                moreText.style.display = "inline"; // Show full text
                btnText.innerHTML = "Show Less";
            } else {
                shortText.style.display = "inline"; // Show short text
                moreText.style.display = "none"; // Hide full text
                btnText.innerHTML = "Show More";
            }
        }

        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("demo");
            let captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }

        function removeSkeleton(img) {
            let skeleton = img.previousElementSibling; // Skeleton ada sebelum gambar
            if (skeleton) {
                skeleton.style.display = 'none'; // Hilangkan skeleton
            }
            img.style.display = 'block'; // Tampilkan gambar
        }
    </script>
@endsection
