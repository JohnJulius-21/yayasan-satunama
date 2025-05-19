@extends('layouts.user')

@section('content')
    <!-- Pelatihan Section -->
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Pelatihan</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="current">Pelatihan</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <section class="pelatihan" id="pelatihan">
        <h4 class="text-center my-5">Pelatihan Reguler</h4>
        <div class="container">
            <div class="row">
                @foreach ($reguler as $item)
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="skeleton-wrapper">
                                <div class="skeleton skeleton-img"></div> <!-- Skeleton sementara -->
                                {{-- <img src="{{ route('file.show', ['filename' => $item->image]) }}"
                                    alt="{{ $item->nama_pelatihan }}" class="card-img-top real-img"
                                    onload="removeSkeleton(this)" onerror="handleImageError(this); this.src='{{ asset('images/stc.png') }}'"> --}}

                                <img src="{{ $item->image ? route('file.show', ['filename' => $item->image]) : asset('images/stc.png') }}"
                                    alt="{{ $item->nama_pelatihan }}" class="card-img-top real-img"
                                    onload="removeSkeleton(this)"
                                    onerror="this.onerror=null; this.src='{{ asset('images/stc.png') }}';" />
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
                    <a href="{{ route('reguler.index') }}" class="btn btn-outline-success my-5">Lihat Semua Pelatihan
                        Reguler</a>
                </div>
            </div>
        </div>
    </section>

    <hr class="container" style="height: 3px; background-color: #000000; border: none;">

    <section class="pelatihan" id="pelatihan">
        <div class="my-5">
            <h4 class="text-center">Pelatihan Permintaan</h4>
            <p class="text-center">Pelatihan Permintaan yang sedang berlangsung dan telah selesai</p>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($permintaan as $item)
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="skeleton-wrapper">
                                <div class="skeleton skeleton-img"></div> <!-- Skeleton sementara -->
                                {{-- <img src="{{ route('file.show', ['filename' => $item->image]) }}"
                        alt="{{ $item->nama_pelatihan }}" class="card-img-top real-img"
                        onload="removeSkeleton(this)" onerror="handleImageError(this); this.src='{{ asset('images/stc.png') }}'"> --}}

                                <img src="{{ $item->image ? route('file.show', ['filename' => $item->image]) : asset('images/stc.png') }}"
                                    alt="{{ $item->nama_pelatihan }}" class="card-img-top real-img"
                                    onload="removeSkeleton(this)"
                                    onerror="this.onerror=null; this.src='{{ asset('images/stc.png') }}';" />
                            </div>

                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                    {{ $item->nama_pelatihan }}
                                </h5>

                                <small><i class="far fa-calendar-days"></i> Tanggal Pelatihan :
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}
                                </small>

                                <p class="card-text mt-2">
                                    {{ \Illuminate\Support\Str::words(strip_tags($item->deskripsi_pelatihan), 5, '...') }}
                                </p>

                                {{-- <a href="{{ route('reguler.show', ['id' => $item->id_reguler]) }}"
                            class="btn btn-outline-success btn-sm">Lihat Detail</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>



        <div class="row">

            <div class="d-flex justify-content-center">
                @guest
                    <button type="button" class="btn btn-outline-success my-5" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Daftar Pelatihan
                        Permintaan
                    </button>
                @else
                    <a href="{{ route('permintaan.create') }}" class="btn btn-outline-success my-5">Daftar Pelatihan
                        Permintaan</a>
                @endguest

                {{-- <button class="btn btn-outline-success my-5">Lebih banyak</button> --}}
            </div>
        </div>
    </section>

    <hr class="container" style="height: 3px; background-color: #000000; border: none;">

    <section class="pelatihan" id="pelatihan">
        <h4 class="text-center my-5">Pelatihan Konsultasi</h4>
        <div class="container">
            <div class="row">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 text-center"><img src="{{ asset('images/konsultasi1.png') }}" alt="Permintaan"
                            class="img-fluid icon-image" style="width: 70%"></div>
                    <div class="col-md-6">
                        <p>Pelatihan Konsultasi</p>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    @guest
                        <button type="button" class="btn btn-outline-success my-5" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Daftar Pelatihan
                            Konsultasi
                        </button>
                    @else
                        <a href="{{ route('konsultasi.create') }}" class="btn btn-outline-success my-5">Daftar Pelatihan
                            Konsultasi</a>
                    @endguest


                    {{-- <button class="btn btn-outline-success my-5">Lebih banyak</button> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Custom CSS for Hover Animations -->
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
    <script>
        function removeSkeleton(img) {
            let skeleton = img.previousElementSibling; // Skeleton ada sebelum gambar
            if (skeleton) {
                skeleton.style.display = 'none'; // Hilangkan skeleton
            }
            img.style.display = 'block'; // Tampilkan gambar asli
        }

        function handleImageError(img) {
            img.style.display = 'none'; // Sembunyikan gambar jika gagal dimuat
        }
    </script>
@endsection
