@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Ruang Diskusi</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li class="current">Ruang Diskusi</li>
                </ol>
            </nav>
        </div>
    </div>
    @if (session('error'))
        <script>
            new Notyf().error('{{ session('error') }}');
        </script>
    @endif

    <div class="container mt-3">
        <div class="row">
            <div class="d-flex justify-content-end mb-3">
                @if (Auth::check())
                    <a class="btn btn-success" href="{{ route('userForumCreate') }}">Buat Ruang Diskusi</a>
                @else
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Buat Ruang Diskusi
                    </button>
                @endif
            </div>


            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Kategori -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Cari Diskusi</h5>
                        <div class="col">
                            <!-- Search Bar -->
                            <div class="mb-4">
                                <form action="" method="GET">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Cari Diskusi"
                                            value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-success">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Konten Utama -->
            <div class="col-md-8">

                <!-- Daftar Postingan -->
                @foreach ($discussions as $discussion)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('userForumShow', $discussion->id_diskusi) }}">{{ $discussion->title }}</a>
                            </h5>
                            <p class="card-text">{!! Str::limit($discussion->content, 200) !!}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <p class="text-muted mt-2">Oleh: {{ $discussion->user->name }}</p>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">
                            <!-- Jumlah Komentar -->
                            <div>
                                <i class="fas fa-comment"></i> {{ $discussion->comments->count() }} Komentar
                            </div>
                            <!-- Jumlah Views -->
                            <div>
                                <i class="fas fa-eye"></i> {{ $discussion->views }} Dilihat
                            </div>
                            <!-- Waktu Posting -->
                            <div>
                                @php
                                    $createdAt = \Carbon\Carbon::parse($discussion->created_at);
                                    $now = \Carbon\Carbon::now();
                                    $diffInDays = $createdAt->diffInDays($now);
                                @endphp

                                @if ($diffInDays > 7)
                                    <i class="fas fa-clock"></i> Diposting pada {{ $createdAt->format('d M Y') }}
                                @else
                                    <i class="fas fa-clock"></i> {{ $createdAt->diffForHumans() }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $discussions->links() }}
                </div>
            </div>


        </div>
    </div>
@endsection
