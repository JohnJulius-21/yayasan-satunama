@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $reguler->nama_pelatihan }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('reguler.pelatihan') }}">Pelatihan Saya</a></li>
                    <li><a
                            href="{{ route('reguler.pelatihan.list', $reguler->nama_pelatihan) }}">{{ $reguler->nama_pelatihan }}</a>
                    </li>
                    <li class="current">Materi </li>
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
                    @include('partials.user-routes')
                </div>
                <div class="col-lg-9">
                    <div class="php-email-form">
                        <h3>Materi Pelatihan</h3>

                        @if ($files->isNotEmpty())
                            @foreach ($files as $file)
                                <div class="card p-3 mb-2">
                                    <p>{{ $loop->iteration }}. {{ $file->file_name }}</p>
                                    <a href="{{ $file->file_url }}" target="_blank">Download File</a><br>
                                </div>
                            @endforeach

                            <div class="mt-3">
                                {{ $files->onEachSide(5)->links() }}
                            </div>
                        @else
                            <p class="text-muted">Belum ada materi yang diunggah.</p>
                        @endif
                    </div>
                </div><!-- End Contact Form -->
            </div>
        </div>
    </section><!-- /Contact Section -->

@endsection
