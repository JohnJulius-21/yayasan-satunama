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
                    <li class="current">Sertifikat</li>
                </ol>
            </nav>
        </div>
    </div>
    <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-3">
                    @include('partials.user-routes-permintaan')
                </div>
                <div class="col-lg-9">
                    <div class="php-email-form">
                        <h3>Sertifikat Pelatihan</h3>

                        @php
                            $validFiles = collect($files)->filter(fn($file) => !is_null($file->file_url));

                            function formatGoogleDriveUrl($url)
                            {
                                if (str_contains($url, 'drive.google.com')) {
                                    return str_replace('/view?usp=sharing', '/preview', $url);
                                }
                                return $url;
                            }
                        @endphp

                        @if ($validFiles->isNotEmpty())
                            @foreach ($validFiles as $file)
                                <div class="d-flex justify-content-end mb-3">
                                    <a class="btn btn-outline-success" href="{{ $file->file_url }}" target="_blank">Unduh
                                        Sertifikat</a><br>
                                </div>
                                <div class="card p-3 mb-4">
                                    <iframe src="{{ formatGoogleDriveUrl($file->file_url) }}" width="100%" height="600px"
                                        style="border: none;"></iframe>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">Belum ada Sertifikat yang diunggah.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
