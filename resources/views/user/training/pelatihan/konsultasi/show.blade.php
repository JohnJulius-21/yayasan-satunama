@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $konsultasi->nama_pelatihan }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('konsultasi.pelatihan.show') }}">Pelatihan Saya</a></li>
                    <li class="current">{{ $konsultasi->nama_pelatihan }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <!-- Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-3">
                    @include('partials.user-routes-konsultasi')
                </div>
                <div class="col-lg-9">
                    <div class="php-email-form">
                        <h3>{{ $konsultasi->nama_pelatihan }}</h3>
                        <p><strong>Konsultan :</strong>
                            @foreach ($konsultasi->fasilitators as $fasilitator)
                                {{ $fasilitator->nama_fasilitator }}{{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </p>

                        <p><strong>Deskripsi Pelatihan :</strong> {{ strip_tags($konsultasi->deskripsi_pelatihan) }}</p>


                    </div>
                </div><!-- End Contact Form -->
            </div>
        </div>
    </section><!-- /Contact Section -->
@endsection
