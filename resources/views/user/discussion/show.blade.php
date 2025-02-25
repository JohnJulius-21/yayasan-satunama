@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Ruang Diskusi</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('userDiskusi') }}">Ruang Diskusi</a></li>
                    <li class="current">{{ $discussion->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="card mt-3">
            <div class="card-header">
                <h5>{{ $discussion->title }}</h5>
            </div>
            <div class="card-body">
                <p>{!! $discussion->content !!}</p>
            </div>
            <div class="card-footer">
                <p class="text-muted">Diposting oleh: {{ $discussion->user->name }} | {{ $discussion->created_at->diffForHumans() }}</p>
            </div>
        </div>

        <!-- Menampilkan komentar utama -->
        <div class="card mt-3">
            <div class="card-header">Komentar</div>
            <div class="card-body">
                @foreach ($discussion->comments as $comment)
                    @include('partials.comment', ['comment' => $comment])
                @endforeach
            </div>
        </div>

        <!-- Form Tambah Komentar -->
        @auth
            <div class="card mt-3">
                <div class="card-header">Tambah Komentar</div>
                <div class="card-body">
                    <form action="{{ route('userKomenStore', $discussion->id_diskusi) }}" method="POST">
                        @csrf
                        <input type="hidden" name="parent_id" value="">
                        <div class="mb-3">
                            <label for="content" class="form-label">Komentar</label>
                            <textarea class="ckeditor form-control" name="content" id="content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Kirim</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center mt-3">Silakan <a href="{{ route('masuk') }}">login</a> untuk berkomentar.</p>
        @endauth
    </div>
@endsection
