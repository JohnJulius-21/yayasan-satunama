@extends('layouts.main')

@section('content')
    <!-- Pelatihan Section -->
    <div class="section py-5"
        style="position: relative; background-image: url('../images/contact.png'); background-size: cover; background-position: center; color: #ffffff;">
        <div
            style="content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(68, 117, 71, 0.6); z-index: 1;">
        </div>
        <div class="container text-left" style="position: relative; z-index: 2;">
            <h3>Pelatihan</h3>
            <!-- <h2 style="color: #438848;">SATUNAMA <span style="color: #000000;">Training Center </span></h2> -->

            <!-- Descriptive Text -->
            <p class="about-description" style="text-align: justify; text-lg">
                Pelatihan dan Konsultasi yang dijalankan oleh <strong>SATUNAMA</strong> sudah
                berjalan selama 2 (dua) dekade dengan
                perkembangan dan dinamikanya sendiri. Pada awalnya layanan <strong>SATUNAMA</strong>
                berada dalam kerangka pembangunan yang
                langsung berkaitan dengan pengentasan dari kemiskinan. Pelatihan-pelatihan yang diberikan banyak menyangkut
                hal-hal praktis, seperti akupuntur, ekonomi rumah tangga, dan sebagainya.
            </p>
        </div>
    </div>


    <div class="container px-4">
        <div class="row gx-5">
            <!-- Section Header Column -->
            <div class="col" style="margin-top: 150px;">
                <div class="py-5">
                    <!-- Adding more margin to push the header section down -->
                    <div class="container text-left mt-5" style="margin-top: 180px;">
                        <h5>Produk dan Layanan</h5>
                        <h2 style="color: #438848;">SATUNAMA <span style="color: #000000;">Training Center</span></h2>
                        <hr>
                        <p class="text-muted">Telusuri produk - produk untuk menunjang bisnis dan usaha sosial Anda</p>
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
                                    <img src="{{ asset('images/hero.png') }}" alt="Materi Pembelajaran"
                                        class="img-fluid mb-3 icon-image">
                                    <h4 class="card-title">Reguler</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Permintaan -->
                        <div class="col-6 mb-4">
                            <div class="card h-100 shadow-sm animate-card" style="border-radius: 15px;">
                                <div class="card-body">
                                    <img src="{{ asset('images/hero.png') }}" alt="Permintaan"
                                        class="img-fluid mb-3 icon-image">
                                    <h4 class="card-title">Permintaan</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Konsultasi -->
                        <div class="col-6 mb-4">
                            <div class="card h-100 shadow-sm animate-card" style="border-radius: 15px;">
                                <div class="card-body">
                                    <img src="{{ asset('images/hero.png') }}" alt="Konsultasi"
                                        class="img-fluid mb-3 icon-image">
                                    <h4 class="card-title">Konsultasi</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Innovation Lab -->
                        <div class="col-6 mb-4">
                            <div class="card h-100 shadow-sm animate-card" style="border-radius: 15px;">
                                <div class="card-body">
                                    <img src="{{ asset('images/hero.png') }}" alt="Innovation Lab"
                                        class="img-fluid mb-3 icon-image">
                                    <h4 class="card-title">Innovation Lab</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="container" style="height: 3px; background-color: #000000; border: none;">


    <section class="pelatihan" id="pelatihan">
        <h4 class="text-center my-5">Pelatihan Reguler</h4>
        <div class="container">
            <div class="row">
                @foreach ($reguler as $item)
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('images/pelatihan4.png') }}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_pelatihan }}</h5>
                                <small><i class="far fa-calendar-days"></i> Tanggal Pendaftaran :
                                    {{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->translatedFormat('d F Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->tanggal_batas_pendaftaran)->translatedFormat('d F Y') }}
                                </small>
                                <p class="card-text mt-2">
                                    {{ \Illuminate\Support\Str::words(strip_tags($item->deskripsi_pelatihan), 5, '...') }}
                                </p>

                                <a href="{{ route('reguler.show', ['id' => $item->id_pelatihan]) }}"
                                    class="btn btn-outline-success btn-sm">Lihat Detail</a>

                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    <a href="{{ route('reguler.index') }}" class="btn btn-outline-success my-5">Lihat Pelatihan Reguler</a>
                    {{-- <button class="btn btn-outline-success my-5">Lebih banyak</button> --}}
                </div>
            </div>
        </div>
    </section>

    <hr class="container" style="height: 3px; background-color: #000000; border: none;">

    <section class="pelatihan" id="pelatihan">
        <h4 class="text-center my-5">Pelatihan Permintaan</h4>

        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-4 text-center"><img src="{{ asset('images/hero.png') }}" alt="Permintaan" class="img-fluid icon-image" style="width: 70%"></div>
                <div class="col-md-6"><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, voluptates, non adipisci nesciunt dolore nisi
                    corrupti commodi expedita quod omnis iste soluta mollitia veniam ut corporis suscipit debitis distinctio,
                    quisquam nulla tenetur et. Iusto, ex, hic eaque officiis, earum molestiae necessitatibus esse quis fuga
                    repellendus quas perferendis asperiores eius magnam quos labore explicabo distinctio maxime sunt modi. A
                    quae
                    rerum voluptatibus esse necessitatibus ab est neque mollitia cum. Iusto porro sint quos laborum optio
                    consequatur in quaerat nisi molestiae dolor asperiores deserunt eveniet quisquam debitis error earum amet
                    nulla
                    dolores aliquid similique, impedit molestias? Voluptatem sint voluptate voluptas consequuntur ab!</p></div>
            </div>
            
            
            <div class="row">

                <div class="d-flex justify-content-center">
                    <a href="{{ route('permintaan.create') }}" class="btn btn-outline-success my-5">Lihat Pelatihan
                        Permintaan</a>
                    {{-- <button class="btn btn-outline-success my-5">Lebih banyak</button> --}}
                </div>

                {{-- @foreach ($reguler as $item)
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('images/pelatihan4.png') }}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_pelatihan }}</h5>
                                <small><i class="far fa-clock"></i> Tanggal Pendaftaran :
                                    {{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->translatedFormat('d F Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->tanggal_batas_pendaftaran)->translatedFormat('d F Y') }}
                                </small>
                                <p class="card-text mt-2">
                                    {{ \Illuminate\Support\Str::words(strip_tags($item->deskripsi_pelatihan), 5, '...') }}
                                </p>

                                <a href="{{ route('pelatihan.show', ['id' => $item->id_pelatihan]) }}"
                                    class="btn btn-outline-success btn-sm">Lihat Detail</a>

                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-outline-success my-5">Lihat Pelatihan Reguler</a>
                   
                </div> --}}
            </div>
        </div>
    </section>

    <hr class="container" style="height: 3px; background-color: #000000; border: none;">

    <section class="pelatihan" id="pelatihan">
        <h4 class="text-center my-5">Pelatihan Konsultasi</h4>
        <div class="container">
            <div class="row">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 text-center"><img src="{{ asset('images/hero.png') }}" alt="Permintaan" class="img-fluid icon-image" style="width: 70%"></div>
                    <div class="col-md-6"><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error, voluptates, non adipisci nesciunt dolore nisi
                        corrupti commodi expedita quod omnis iste soluta mollitia veniam ut corporis suscipit debitis distinctio,
                        quisquam nulla tenetur et. Iusto, ex, hic eaque officiis, earum molestiae necessitatibus esse quis fuga
                        repellendus quas perferendis asperiores eius magnam quos labore explicabo distinctio maxime sunt modi. A
                        quae
                        rerum voluptatibus esse necessitatibus ab est neque mollitia cum. Iusto porro sint quos laborum optio
                        consequatur in quaerat nisi molestiae dolor asperiores deserunt eveniet quisquam debitis error earum amet
                        nulla
                        dolores aliquid similique, impedit molestias? Voluptatem sint voluptate voluptas consequuntur ab!</p></div>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('konsultasi.create') }}" class="btn btn-outline-success my-5">Lihat Pelatihan
                        Konsultasi</a>
                    {{-- <button class="btn btn-outline-success my-5">Lebih banyak</button> --}}
                </div>

                {{-- @foreach ($reguler as $item)
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('images/pelatihan4.png') }}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->nama_pelatihan }}</h5>
                                <small><i class="far fa-clock"></i> Tanggal Pendaftaran :
                                    {{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->translatedFormat('d F Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->tanggal_batas_pendaftaran)->translatedFormat('d F Y') }}
                                </small>
                                <p class="card-text mt-2">
                                    {{ \Illuminate\Support\Str::words(strip_tags($item->deskripsi_pelatihan), 5, '...') }}
                                </p>

                                <a href="{{ route('pelatihan.show', ['id' => $item->id_pelatihan]) }}"
                                    class="btn btn-outline-success btn-sm">Lihat Detail</a>

                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-outline-success my-5">Lihat Pelatihan Reguler</a>
                   
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Custom CSS for Hover Animations -->
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
