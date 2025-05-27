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

                        <div class="container my-4">

                            @if ($tree)
                                @include('partials.tree', ['branch' => $tree])
                            @else
                                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                                    <img src="{{ asset('images/nopelatihan.png') }}" alt="Hero Image"
                                        style="max-width:400px; height:auto">
                                    <h5>Belum ada Materi.</h5>
                                </div>
                            @endif
                        </div>
                        {{-- @if ($files->isNotEmpty())
                            @foreach ($files as $file)
                                <div class="card p-3 mb-2">
                                    <p>{{ $loop->iteration }}. {{ $file->file_name }}</p>
                                    <a href="{{ $file->file_url }}" target="_blank">Download File</a><br>
                                </div>
                            @endforeach

                            <div class="mt-3">
                                @if ($files->hasPages())
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination">
                                            <li class="page-item {{ $files->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $files->previousPageUrl() }}"
                                                    tabindex="-1">Previous</a>
                                            </li>

                                            @for ($i = 1; $i <= $files->lastPage(); $i++)
                                                <li class="page-item {{ $files->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $files->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor

                                            <li class="page-item {{ !$files->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $files->nextPageUrl() }}">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                @endif
                            </div>
                        @else
                            <p class="text-muted">Belum ada materi yang diunggah.</p>
                        @endif --}}
                    </div>
                </div><!-- End Contact Form -->
            </div>
        </div>
    </section><!-- /Contact Section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
