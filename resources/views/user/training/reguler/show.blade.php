@extends('layouts.user')

@section('content')
    <style>
        * {
            box-sizing: border-box;
        }

        /* Position the image container (needed to position the left and right arrows) */
        .container {
            position: relative;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        }

        /* Add a pointer when hovering over the thumbnail images */
        .cursor {
            cursor: pointer;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 40%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* Container for image text */
        .caption-container {
            text-align: center;
            background-color: #222;
            padding: 2px 16px;
            color: white;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Six columns side by side */
        .column {
            float: left;
            width: 16.66%;
        }

        /* Add a transparency effect for thumnbail images */
        .demo {
            opacity: 0.6;
        }

        .active,
        .demo:hover {
            opacity: 1;
        }
    </style>
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
        <div class="container">
            @foreach ($imageNames as $index => $filename)
                <div class="mySlides">
                    <div class="numbertext">{{ $index + 1 }} / {{ count($imageNames) }}</div>
                    <img src="{{ route('file.show', ['filename' => $filename]) }}" style="width:100%">
                </div>
            @endforeach

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <!-- Image text -->
            <div class="caption-container">
                <p id="caption"></p>
            </div>

            <!-- Thumbnail images -->
            <div class="row">
                @foreach ($imageNames as $index => $filename)
                    <div class="column">
                        <img class="demo cursor" src="{{ route('file.show', ['filename' => $filename]) }}"
                            style="width:100%" onclick="currentSlide({{ $index + 1 }})" alt="Image {{ $index + 1 }}">
                    </div>
                @endforeach
            </div>
        </div>

        <hr class="container mt-5" style="height: 3px; background-color: #000000; border: none;">

        <div class="row gx-6">
            <div class="col-sm-6 col-md-8">
                <div class="p-3">
                    <h4>{{ $pelatihan->nama_pelatihan }}</h4>
                    <p>Tanggal Pelatihan : <small><i class="far fa-clock"></i>
                            {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->translatedFormat('d F Y') }} -
                            {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->translatedFormat('d F Y') }}
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
                        {{ \Carbon\Carbon::parse($pelatihan->tanggal_pendaftaran)->translatedFormat('d F Y') }} -
                        {{ \Carbon\Carbon::parse($pelatihan->tanggal_batas_pendaftaran)->translatedFormat('d F Y') }}
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
                            // Check if the registration period is closed
                            $registrationDeadline = \Carbon\Carbon::parse($pelatihan->tanggal_batas_pendaftaran);
                            $isRegistrationClosed = \Carbon\Carbon::now()->gt($registrationDeadline);
                        @endphp

                        @guest
                            <!-- If user is not logged in, send them to login page -->
                            <a href="{{ !$isRegistrationClosed && isset($pelatihan->id_reguler) ? route('masuk') : '#' }}"
                                class="btn btn-success daftar-button {{ $isRegistrationClosed ? 'disabled-link' : '' }}"
                                {{ $isRegistrationClosed ? 'aria-disabled=true tabindex=-1' : '' }}>
                                Daftar Pelatihan
                            </a>
                        @else
                            <!-- If user is logged in, send them directly to the registration page -->
                            <a href="{{ !$isRegistrationClosed && isset($pelatihan->id_reguler) ? route('reguler.create', ['id' => $pelatihan->id_reguler]) : '#' }}"
                                class="btn btn-success daftar-button {{ $isRegistrationClosed ? 'disabled-link' : '' }}"
                                {{ $isRegistrationClosed ? 'aria-disabled=true tabindex=-1' : '' }}>
                                Daftar Pelatihan
                            </a>
                        @endguest
                    </div>
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
    </style>

    <script>
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
    </script>
@endsection
