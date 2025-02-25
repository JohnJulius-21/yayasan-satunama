@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('konsultasiAdmin') }}" style="color: green !important;">Konsultasi</a>
            </li>
            <li class="breadcrumb-item" style="color: green !important;">
                @foreach ($konsultasi as $item)
                    <a href="{{ route('konsultasiShowAdmin', $item->id_konsultasi) }}"
                        style="color: rgb(2, 160, 2) !important;">Lihat
                        Detail Konsultasi</a>
                @endforeach
            </li>
            <li class="breadcrumb-item active" aria-current="page">Buat Pelatihan Konsultasi</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Form Tambah Pelatihan</h1>
    </div>

    <form method="post" action="{{ route('konsultasiStoreAdmin') }}" enctype="multipart/form-data">
        @csrf
        @foreach ($konsultasi as $item)
            <input type="hidden" id="id_konsultasi" name="id_konsultasi" value="{{ $item->id_konsultasi }}">
        @endforeach

        <div class="row">
            <div class="col-sm-7 mb-2">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-start">
                            <h6 class="m-0 font-weight-bold text-success">Konsultasi</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Informasi Pelatihan -->
                        <div class="mb-3">
                            <label for="nama_pelatihan" class="form-label">Nama Pelatihan</label>
                            <input type="text" class="form-control @error('nama_pelatihan') is-invalid @enderror"
                                placeholder="Masukkan Nama Pelatihan" name="nama_pelatihan" id="nama_pelatihan"
                                value="{{ old('nama_pelatihan') }}" autofocus>
                            @error('nama_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tema" class="form-label">Tema Pelatihan</label>
                            <select class="form-control" name="id_tema" value="{{ old('id_tema') }}">
                                <option value="">Pilih Tema Pelatihan</option>
                                @foreach ($tema as $item)
                                    <option value="{{ $item->id }}">{{ $item->judul_tema }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="mb-3">
                            <label for="jenis_pelatihan" class="form-label">Jenis Pelatihan</label>
                            <select class="form-control" name="jenis_pelatihan" value="{{ old('jenis_pelatihan') }}" >
                                <option value="">Pilih Jenis Pelatihan</option> 
                                <option value="Reguler">Reguler</option> 
                                <option value="Permintaan">Permintaan</option> 
                                <option value="Konsultasi">Konsultasi</option> 
                            </select>
                        </div> --}}

                        {{-- <div class="mb-3">
                            <label for="fee_pelatihan" class="form-label">Fee Pelatihan</label>
                            <input type="text" class="form-control @error('fee_pelatihan') is-invalid @enderror"
                                placeholder="Masukkan Fee Pelatihan" name="fee_pelatihan" id="fee_pelatihan"
                                value="{{ old('fee_pelatihan') }}" >
                            @error('fee_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}

                        <div class="mb-3">
                            <label for="metode_pelatihan" class="form-label">Metode Pelatihan</label>
                            <select class="form-control" name="metode_pelatihan" value="{{ old('metode_pelatihan') }}">
                                <option value="">Pilih Metode Pelatihan</option>
                                <option value="Online">Online</option>
                                <option value="Offline">Offline</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lokasi_pelatihan" class="form-label">Lokasi Pelatihan</label>
                            <input type="text" class="form-control @error('lokasi_pelatihan') is-invalid @enderror"
                                placeholder="Masukkan Lokasi Pelatihan" name="lokasi_pelatihan" id="lokasi_pelatihan"
                                value="{{ old('lokasi_pelatihan') }}">
                            @error('fee_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="kuota_peserta" class="form-label">Kuota Peserta</label>
                            <input type="number" value="{{ old('kuota_peserta') }}"
                                class="form-control @error('kuota_peserta') is-invalid @enderror"
                                placeholder="Masukkan Kuota Peserta" name="kuota_peserta" id="kuota_peserta"
                                value="{{ old('kuota_peserta') }}" >
                            @error('fee_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}

                        <!-- Gambar, Materi, dan Deskripsi -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Poster Pelatihan</label>
                            <input value="{{ old('image') }}" class="form-control @error('image.*') is-invalid @enderror"
                                type="file" id="image" name="image[]" multiple>
                            @error('image.*')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Upload Materi</label>
                            <input value="{{ old('file') }}" class="form-control @error('file.*') is-invalid @enderror"
                                type="file" id="file" name="file[]" multiple>
                            @error('file.*')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="trix-content mb-3">
                            <label for="deskripsi_pelatihan" class="form-label">Deskripsi Pelatihan</label>
                            {{-- <textarea class="form-control" name="deskripsi_pelatihan" id="deskripsi_pelatihan" cols="70" rows="10"></textarea> --}}
                            {{-- <input id="deskripsi_pelatihan" type="hidden" name="deskripsi_pelatihan"
                                value="{{ old('deskripsi_pelatihan') }}"> --}}
                            {{-- <trix-editor input="deskripsi_pelatihan"
                                upload-url="/dashboard/reguler/upload/image"></trix-editor> --}}
                            {{-- <trix-editor input="deskripsi_pelatihan"
                            upload-url="/dashboard/reguler/upload/file"></trix-editor> --}}
                            <textarea class="ckeditor form-control" name="deskripsi_pelatihan" id="deskripsi_pelatihan"></textarea>
                            @error('deskripsi_pelatihan')
                                <div class="invalid-feedback">
                                    <p class="text-danger">{{ $message }}</p>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-5 mb-4">
                <!-- Tanggal Pelatihan -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-start">
                            <h6 class="m-0 font-weight-bold text-success">Tanggal Pelatihan</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="mb-3">
                            <label for="tanggal_pendaftaran" class="form-label">Tanggal Pendaftaran Pelatihan</label>
                            <input type="date" id="tanggal_pendaftaran" class="form-control"
                                name="tanggal_pendaftaran" value="{{ old('tanggal_pendaftaran') }}" >
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_batas_pendaftaran" class="form-label">Tanggal Batas Pendaftaran
                                Pelatihan</label>
                            <input type="date" id="tanggal_batas_pendaftaran" class="form-control"
                                name="tanggal_batas_pendaftaran" value="{{ old('tanggal_batas_pendaftaran') }}" >
                        </div> --}}
                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai Pelatihan</label>
                            <input type="date" id="tanggal_mulai" class="form-control" name="tanggal_mulai"
                                value="{{ old('tanggal_mulai') }}">
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai Pelatihan</label>
                            <input type="date" id="tanggal_selesai" class="form-control" name="tanggal_selesai"
                                value="{{ old('tanggal_selesai') }}">
                        </div>
                    </div>
                </div>

                <!-- Fasilitator -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-start">
                            <h6 class="m-0 font-weight-bold text-success">Fasilitator Pelatihan</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <label for="fasilitator-pelatihan">Fasilitator Pelatihan</label>
                        <div class="form-group mb-2">
                            <select id="fasilitator" class="form-control" name="id_fasilitator[]" multiple="multiple"
                                style="width: 100%">
                                @foreach ($fasilitator as $item)
                                    <option value="{{ $item->id_fasilitator }}"
                                        @if (in_array($item->id_fasilitator, $oldIdFasilitator)) selected @endif>{{ $item->nama_fasilitator }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success mb-3">Simpan</button>
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
