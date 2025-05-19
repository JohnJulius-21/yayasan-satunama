@extends('layouts.user')

@section('content')
    <!-- Pelatihan Section -->
    {{-- <div class="section py-5"
        style="position: relative; background-image: url('../images/contact.png'); background-size: cover; background-position: center; color: #ffffff;">
        <div
            style="content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(40, 66, 41, 0.6); z-index: 1;">
        </div>
        <div class="container text-left" style="position: relative; z-index: 2; ">
            <h5 style="color: #ffffff;">Pelatihan Reguler</h5>
            <h2 style="color: #ffffff;">SATUNAMA <span>Training Center </span></h2>
        </div>
    </div> --}}

    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Reguler</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a href="{{ route('pelatihan') }}">Pelatihan</a></li>
                    <li class="current">Reguler</li>
                </ol>
            </nav>
        </div>
    </div>


    <section class="pelatihan mt-2" id="pelatihan">
        <div class="container">
            <div class="d-flex justify-content-end p-4">
                <!-- Search Form -->
                <form action="{{ route('reguler.index') }}" method="GET" class="d-flex">
                    <div class="input-group" style="width: 270px;">
                        <input type="text" name="search" class="form-control form-control-sm"
                            placeholder="Cari pelatihan" value="{{ request('search') }}" aria-label="Cari pelatihan"
                            aria-describedby="button-addon2">
                        <button class="btn btn-outline-success btn-sm" type="submit" id="button-addon2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Filter Button -->
                <div class="mx-1">
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#filterModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-filter" viewBox="0 0 16 16">
                            <path
                                d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Pelatihan Content -->
            <div class="row">
                @if ($isEmpty)
                    <div class="col-12 text-center mt-5">
                        <img src="{{ asset('images/search1.png') }}" alt="No results found" class="img-fluid"
                            style="max-width: 300px;">
                        <h5 class="mt-3">Pelatihan tidak ditemukan</h5>
                        <p>Coba dengan kata kunci yang berbeda.</p>
                    </div>
                @else
                    @foreach ($regulerPelatihan as $item)
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <div class="skeleton-wrapper">
                                    <div class="skeleton skeleton-img"></div> <!-- Skeleton sementara -->
                                    <img src="{{ route('file.show', ['filename' => $item->image]) }}"
                                        alt="{{ $item->nama_pelatihan }}" class="card-img-top real-img"
                                        onload="removeSkeleton(this)" onerror="handleImageError(this)">
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
                                        {{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->locale('id')->translatedFormat('d F Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->tanggal_batas_pendaftaran)->locale('id')->translatedFormat('d F Y') }}
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
                @endif
            </div>
        </div>
    </section>

    <!-- Modal Filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Pelatihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reguler.index') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Status Pendaftaran</label>
                            <select name="status" class="form-select">
                                <option value="">-- Semua --</option>
                                <option value="buka" {{ request('status') == 'buka' ? 'selected' : '' }}>Buka</option>
                                <option value="tutup" {{ request('status') == 'tutup' ? 'selected' : '' }}>Tutup</option>
                            </select>
                        </div>
                        
                        <!-- Tambahkan filter lain jika diperlukan -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-outline-success">Terapkan Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <hr class="container" style="height: 3px; background-color: #000000; border: none;"> --}}

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

        .section #pelatihan {
            position: relative;
            background-image: url('images/dekorasi1.png'), url('images/image2.png'), url('images/image3.png');
            background-size: cover, cover, cover;
            background-position: center, center, center;
            color: #ffffff;
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
            background-color: #438848;
            /* Background color on hover */
            color: white;
            /* Text color on hover */
            border-color: #438848;
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
