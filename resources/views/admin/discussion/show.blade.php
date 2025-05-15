@extends('layouts.admin')

@section('content')


    @if (session('success'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'la la-thumbs-up',
                    title: 'Berhasil',
                    message: "{{ session('success') }}"
                }, {
                    type: 'success',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 3000
                });
            });
        </script>
    @endif
    <div class="container">
        <a style="color: green" href="{{ route('adminDiskusi') }}"><i style="width:17px" class="la la-chevron-left"></i> Kembali</a>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h6 class="h4">Ruang Diskusi</h6>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h5>{{ $discussion->title }}</h5>
            </div>
            <div class="card-body">
                <p>{!! $discussion->content !!}</p>
            </div>
            <div class="card-body">
                @php
                    // Cek apakah ada file yang valid (tidak null)
                    $validFiles = collect($files)->filter(fn($file) => !is_null($file->file_url));
                @endphp

                @if ($validFiles->isNotEmpty())
                    @foreach ($validFiles as $file)
                        <div class="card p-3 mb-2">
                            <p>File {{ $loop->iteration }}</p>
                            <a href="{{ $file->file_url }}" target="_blank">Download File</a><br>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="card-footer">
                <p class="text-muted">Diposting oleh: {{ $discussion->user->name }} |
                    {{ $discussion->created_at->diffForHumans() }}</p>
            </div>
        </div>

        <!-- Menampilkan komentar utama -->
        <div class="card mt-3">
            <div class="card-header">Komentar</div>
            <div class="card-body">
                @foreach ($discussion->comments->whereNull('id_parent') as $comment)
                    @include('partials.comment-admin', ['comment' => $comment])
                @endforeach
            </div>
        </div>


        <!-- Form Tambah Komentar -->

        <div class="card mt-3">
            <div class="card-header">Tambah Komentar</div>
            <div class="card-body">
                <form action="{{ route('adminKomenStore', $discussion->id_diskusi) }}" method="POST">
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

    </div>
@endsection
