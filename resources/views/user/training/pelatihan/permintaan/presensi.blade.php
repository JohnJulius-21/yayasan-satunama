{{-- @extends('layouts.user')

@section('content')
    <div>
        <div class="p-4 border rounded-lg inline-block text-center">
            <h2>QR Code Presensi: {{ $permintaan->judul_presensi }}</h2>
            <p class="mt-2">
                {!! $reguler->qr_code !!}
        </div>
    </div>
@endsection --}}

@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $permintaan->nama_pelatihan }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('permintaan.pelatihan.show') }}">Pelatihan Saya</a></li>
                    <li><a
                            href="{{ route('permintaan.pelatihan.list', $permintaan->nama_pelatihan) }}">{{ $permintaan->nama_pelatihan }}</a>
                    </li>
                    <li class="current">Presensi </li>
                </ol>
            </nav>
        </div>
    </div>
    <section id="contact" class="contact section">
        <!-- Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-3">
                    @include('partials.user-routes-permintaan')
                </div>
                <div class="col-lg-9">
                    <div class="php-email-form">
                        @if ($presensi)
                            <div>
                                <div class="p-4 inline-block">
                                    <h2>Daftar Presensi</h2>
                                    <table class="table">
                                        <thead>
                                            <th>No</th>
                                            <th>Judul Presensi</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($presensi as $key => $p)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $p->judul_presensi }}</td>
                                                    <td><a href="{{ route('scanQrPresensiPermintaan', ['id' => $permintaan->id_pelatihan_permintaan, 'presensi' => $p->id_presensi]) }}">Lihat
                                                            Presensi</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset('images/nopelatihan.png') }}" alt="Hero Image"
                                    style="max-width:400px; height:auto">
                                <h5 class="text-muted">Belum ada Presensi yang dibuat.</h5>
                            </div>
                        @endif
                    </div><!-- End Contact Form -->
                </div><!-- End Contact Form -->
            </div>
        </div>
    </section><!-- /Contact Section -->

@endsection
