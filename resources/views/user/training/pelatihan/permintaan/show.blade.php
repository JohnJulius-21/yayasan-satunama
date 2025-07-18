@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $permintaan->nama_pelatihan }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('permintaan.pelatihan.show') }}">Pelatihan Saya</a></li>
                    <li class="current">{{ $permintaan->nama_pelatihan }}</li>
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
                    @include('partials.user-routes-permintaan')
                </div>
                <div class="col-lg-9">
                    <div class="php-email-form">
                        <h3>{{ $permintaan->nama_pelatihan }}</h3>
                        <p><strong>Fasilitator :</strong>
                            @foreach ($permintaan->fasilitators as $fasilitator)
                                {{ $fasilitator->nama_fasilitator }}{{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </p>
                        @if (!empty($permintaan->pengumuman))
                            <p><strong>Pengumuman Pelatihan :</strong>
                                {!! \Illuminate\Support\Str::words($permintaan->pengumuman, 1000, '...') !!}
                            </p>
                        @else
                            <p>Belum ada pengumuman untuk pelatihan ini</p>
                        @endif

                    </div>
                </div><!-- End Contact Form -->
            </div>
        </div>
    </section><!-- /Contact Section -->
@endsection
