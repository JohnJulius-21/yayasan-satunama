@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('permintaanAdmin') }}" style="color: green !important;">Permintaan</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Pelatihan Permintaan</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Form Edit Pelatihan</h6>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ada kesalahan pada form:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="post" action="{{ route('permintaanUpdateAdmin', $permintaan->id_pelatihan_permintaan) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-7 mb-2">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Permintaan</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama_pelatihan" class="form-label">Nama Pelatihan</label>
                            <input type="text" class="form-control @error('nama_pelatihan') is-invalid @enderror"
                                name="nama_pelatihan" id="nama_pelatihan"
                                value="{{ old('nama_pelatihan', $permintaan->nama_pelatihan) }}" autofocus>
                            @error('nama_pelatihan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_tema" class="form-label">Tema Pelatihan</label>
                            <select class="form-control" name="id_tema">
                                <option value="">Pilih Tema Pelatihan</option>
                                @foreach ($tema as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('id_tema', $permintaan->id_tema) == $item->id ? 'selected' : '' }}>
                                        {{ $item->judul_tema }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="metode_pelatihan" class="form-label">Metode Pelatihan</label>
                            <select class="form-control" name="metode_pelatihan">
                                <option value="Online"
                                    {{ old('metode_pelatihan', $permintaan->metode_pelatihan) == 'Online' ? 'selected' : '' }}>
                                    Online</option>
                                <option value="Offline"
                                    {{ old('metode_pelatihan', $permintaan->metode_pelatihan) == 'Offline' ? 'selected' : '' }}>
                                    Offline</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi_pelatihan" class="form-label">Lokasi Pelatihan</label>
                            <input type="text" class="form-control @error('lokasi_pelatihan') is-invalid @enderror"
                                name="lokasi_pelatihan" id="lokasi_pelatihan"
                                value="{{ old('lokasi_pelatihan', $permintaan->lokasi_pelatihan) }}">
                            @error('lokasi_pelatihan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_pelatihan" class="form-label">Deskripsi Pelatihan</label>
                            <textarea class="ckeditor form-control" name="deskripsi_pelatihan">{{ old('deskripsi_pelatihan', $permintaan->deskripsi_pelatihan) }}</textarea>
                            @error('deskripsi_pelatihan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-5 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Tanggal Pelatihan</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai Pelatihan</label>
                            <input type="date" id="tanggal_mulai" class="form-control" name="tanggal_mulai"
                                value="{{ old('tanggal_mulai', $permintaan->tanggal_mulai) }}">
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai Pelatihan</label>
                            <input type="date" id="tanggal_selesai" class="form-control" name="tanggal_selesai"
                                value="{{ old('tanggal_selesai', $permintaan->tanggal_selesai) }}">
                        </div>
                    </div>
                </div>

                <!-- Materi -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-start">
                            <h6 class="m-0 font-weight-bold text-success">Materi</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <label for="image" class="form-label">Upload Poster Pelatihan</label>
                        <input value="{{ old('images') }}" class="form-control mb-2 @error('image.*') is-invalid @enderror"
                            type="file" id="image" name="image[]" multiple>
                        <div class="p-1">
                            <li><small>Poster tidak boleh lebih dari 2mb</small></li>
                            <li><small>Kosongkan kolom upload poster jika tidak ingin merubah poster</small></li>
                        </div>
                        @error('images.*')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        @if ($images && count($images) > 0)
                            @foreach ($images as $item)
                                <img src="{{ route('file.show', ['filename' => $item->image]) }}" alt="Gambar Lama"
                                    class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                            @endforeach
                        @else
                            <p class="text-muted">Belum ada poster yang diunggah.</p>
                        @endif
                    </div>
                    <div class="card-body">
                        <label for="file" class="form-label">Upload Materi (zip)</label>
                        <input type="file" name="materi_zip" class="form-control" accept=".zip">
                        <div class="p-1">
                            <li><small>File tidak boleh lebih dari 20mb</small></li>
                            <li><small>Kosongkan kolom upload materi jika tidak ingin merubah materi</small></li>
                        </div>
                        @error('materi_zip')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        @php
                            // Cek apakah ada file yang valid (tidak null)
                            $validFiles = collect($files)->filter(fn($file) => !is_null($file->file_url));
                        @endphp

                        @if ($validFiles->isNotEmpty())
                            @foreach ($validFiles as $file)
                                <a href="{{ route('file.show', ['filename' => $file->file_url]) }}"
                                    target="_blank">Download File</a><br>
                            @endforeach
                        @else
                            <p class="text-muted">Belum ada materi yang diunggah.</p>
                        @endif
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Fasilitator Pelatihan</h6>
                    </div>
                    <div class="card-body">
                        <label for="fasilitator">Fasilitator Pelatihan</label>
                        <select id="fasilitator" class="form-control" name="id_fasilitator[]" multiple>
                            @foreach ($fasilitator as $item)
                                <option value="{{ $item->id_fasilitator }}"
                                    {{ in_array($item->id_fasilitator, $oldIdFasilitator) ? 'selected' : '' }}>
                                    {{ $item->nama_fasilitator }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success mb-3">Simpan Perubahan</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#fasilitator').select2({
                placeholder: "Pilih Fasilitator",
                theme: "classic"
            });

            $('.form-control').on('input', function() {
                $(this).removeClass('is-invalid'); // Menghapus kelas 'is-invalid'
                $(this).siblings('.invalid-feedback').remove(); // Menghapus pesan kesalahan
            });
        });

        document.addEventListener('trix-initialize', function(event) {
            var editor = event.target.editor;

            // Menonaktifkan grup tombol file-tools
            var fileToolsButtonGroup = editor.toolbarElement.querySelector('[data-trix-button-group="file-tools"]');
            editor.deactivateAttribute('toolbar', fileToolsButtonGroup);
        });
    </script>
@endsection
