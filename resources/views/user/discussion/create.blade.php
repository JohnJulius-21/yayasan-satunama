@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Buat Ruang Diskusi</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('userDiskusi') }}">Ruang Diskusi</a></li>
                    <li class="current">Buat Ruang Diskusi</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header">
                Konten Diskusi
            </div>
            <div class="card-body">
                <h5 class="card-title">
            </div>
            <form action="{{ route('userForumStore') }}" method="POST">
                <div class="card-body">
                    {{-- {{ route('userForumStore') }} --}}
                    @csrf
                    <input type="hidden" name="id_user" value="{{ Auth::id() }}">

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title') }}">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Isi Diskusi</label>
                        {{-- <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title') }}"> --}}
                        <textarea class="ckeditor form-control" name="content" id="content"></textarea>
                    </div>
                    
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Posting</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('trix-attachment-add', function(event) {
            const file = event.attachment.file;

            if (file) {
                uploadFile(file).then(response => {
                    // Set URL file yang diunggah ke Trix Editor
                    event.attachment.setAttributes({
                        url: response.url,
                        href: response.url
                    });
                }).catch(error => {
                    console.error('Upload failed:', error);
                });
            }
        });

        function uploadFile(file) {
            const formData = new FormData();
            formData.append('file', file);

            return fetch('/upload/image', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => response.json());
        }
    </script>
@endsection

{{-- <div class="trix-content mb-3">
    <label for="deskripsi" class="form-label">Deskripsi</label>
    <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
    <trix-editor class="{{ $errors->has('deskripsi') ? 'is-invalid' : '' }}" input="deskripsi"
        upload-url="/dashboard/reguler/upload/image"></trix-editor>
    @error('deskripsi')
        <div class="invalid-feedback">
            <p class="text-danger">{{ $message }}</p>
        </div>
    @enderror
</div> --}}

