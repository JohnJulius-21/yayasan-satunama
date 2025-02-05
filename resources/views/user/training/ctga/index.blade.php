@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">CTGA</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="current">CTGA</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="why-satunama-section py-5">
            <div class="container text-center">
                <h2>CTGA</h2>
                <h5>Paket Pelatihan yang kami tawarkan</h5>
                <div class="row mt-4 d-flex justify-content-center">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="icon icon-circle">
                                    <img src="{{ asset('images/icon9.png') }}" alt="Gratis" class="img-fluid">
                                </div>
                                <h5 class="card-title">Tema yang Menarik</h5>
                                <p class="card-text">Akses ragam produk pembelajaran yang berkualitas tanpa dipungut biaya.
                                </p>
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
                            <div class="card-body text-start">
                                <div class="icon">
                                    <img src="{{ asset('images/icon10.png') }}" alt="Dari Ahli" class="img-fluid">
                                </div>
                                <h5 class="card-title">Dari Ahli</h5>
                                <p class="card-text">Materi pembelajaran disusun oleh ahli yang berpengalaman di bidang
                                    pengembangan kapasitas OMS.</p>
                                <a href="" class="btn btn-outline-success">Pilih Paket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
@endsection
