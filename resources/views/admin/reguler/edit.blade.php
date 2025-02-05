@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Form Edit Pelatihan</h1>
    </div>
    <form method="post" action="{{ route('regulerUpdateAdmin', $reguler->id_reguler) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-sm-7 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-start">
                            <h6 class="m-0 font-weight-bold text-success">Reguler</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Informasi Pelatihan -->
                        <div class="mb-3">
                            <label for="nama_pelatihan" class="form-label">Nama Pelatihan</label>
                            <input type="text" class="form-control @error('nama_pelatihan') is-invalid @enderror"
                                placeholder="Masukkan Nama Pelatihan" name="nama_pelatihan" id="nama_pelatihan"
                                value="{{ old('nama_pelatihan', $reguler->nama_pelatihan) }}">
                            @error('nama_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tema" class="form-label">Tema Pelatihan</label>
                            <select class="form-control @error('id_tema') is-invalid @enderror" name="id_tema">
                                <option value="">Pilih Tema Pelatihan</option>
                                @foreach ($tema as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $reguler->id_tema ? 'selected' : '' }}>
                                        {{ $item->judul_tema }}</option>
                                @endforeach
                            </select>
                            @error('id_tema')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fee_pelatihan" class="form-label">Fee Pelatihan</label>
                            <input type="text" class="form-control @error('fee_pelatihan') is-invalid @enderror"
                                placeholder="Masukkan Fee Pelatihan" name="fee_pelatihan" id="fee_pelatihan"
                                value="{{ old('fee_pelatihan', $reguler->fee_pelatihan) }}">
                            @error('fee_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="metode_pelatihan" class="form-label">Metode Pelatihan</label>
                            <select class="form-control @error('metode_pelatihan') is-invalid @enderror"
                                name="metode_pelatihan" value="{{ old('metode_pelatihan') }}">
                                <option value="">Pilih Metode Pelatihan</option>
                                <option value="Online" {{ $reguler->metode_pelatihan === 'Online' ? 'selected' : '' }}>
                                    Online
                                </option>
                                <option value="Offline" {{ $reguler->metode_pelatihan === 'Offline' ? 'selected' : '' }}>
                                    Offline
                                </option>
                            </select>
                            @error('metode_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lokasi_pelatihan" class="form-label">Lokasi Pelatihan</label>
                            <input type="text" class="form-control @error('lokasi_pelatihan') is-invalid @enderror"
                                placeholder="Masukkan Lokasi Pelatihan" name="lokasi_pelatihan" id="lokasi_pelatihan"
                                value="{{ old('lokasi_pelatihan', $reguler->lokasi_pelatihan) }}">
                            @error('lokasi_pelatihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kuota_peserta" class="form-label">Kuota Peserta</label>
                            <input type="number" class="form-control @error('kuota_peserta') is-invalid @enderror"
                                placeholder="Masukkan Kuota Peserta" name="kuota_peserta" id="kuota_peserta"
                                value="{{ old('kuota_peserta', $reguler->kuota_peserta) }}">
                            @error('kuota_peserta')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Gambar, Materi, dan Deskripsi -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Poster Pelatihan</label>
                            <input value="{{ old('images') }}"
                                class="form-control mb-2 @error('image.*') is-invalid @enderror" type="file"
                                id="image" name="image[]" multiple>
                            @error('images.*')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @foreach ($images as $image)
                                <img src="{{ $image->image_url }}" alt="Gambar Lama" class="img-thumbnail"
                                    style="max-width: 200px; max-height: 200px;">
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Upload Materi</label>
                            <input value="{{ old('file') }}"
                                class="form-control mb-2 @error('file.*') is-invalid @enderror" type="file"
                                id="file" name="file[]" multiple>
                            @error('file.*')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            @foreach ($files as $file)
                                <a href="{{ $file->file_url }}" target="_blank">Download File</a><br>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_pelatihan" class="form-label">Deskripsi Pelatihan</label>
                            <input id="x" type="hidden" name="deskripsi_pelatihan"
                                value="{{ old('deskripsi_pelatihan', $reguler->deskripsi_pelatihan) }}">
                            <trix-editor class="@error('deskripsi_pelatihan') is-invalid @enderror"
                                input="x"></trix-editor>
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
                        <div class="mb-3">
                            <label for="tanggal_pendaftaran" class="form-label">Tanggal Pendaftaran Pelatihan</label>
                            <input type="date" id="tanggal_pendaftaran"
                                class="form-control @error('tanggal_pendaftaran') is-invalid @enderror"
                                name="tanggal_pendaftaran"
                                value="{{ old('tanggal_pendaftaran', $reguler->tanggal_pendaftaran) }}">
                            @error('tanggal_pendaftaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_batas_pendaftaran" class="form-label">Tanggal Batas Pendaftaran
                                Pelatihan</label>
                            <input type="date" id="tanggal_batas_pendaftaran"
                                class="form-control @error('tanggal_batas_pendaftaran') is-invalid @enderror"
                                name="tanggal_batas_pendaftaran"
                                value="{{ old('tanggal_batas_pendaftaran', $reguler->tanggal_batas_pendaftaran) }}">
                            @error('tanggal_batas_pendaftaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai Pelatihan</label>
                            <input type="date" id="tanggal_mulai"
                                class="form-control @error('tanggal_mulai') is-invalid @enderror" name="tanggal_mulai"
                                value="{{ old('tanggal_mulai', $reguler->tanggal_mulai) }}">
                            @error('tanggal_mulai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai Pelatihan</label>
                            <input type="date" id="tanggal_selesai"
                                class="form-control @error('tanggal_selesai') is-invalid @enderror"
                                name="tanggal_selesai" value="{{ old('tanggal_selesai', $reguler->tanggal_selesai) }}">
                            @error('tanggal_selesai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                            <select id="fasilitator" class="form-control @error('id_fasilitator') is-invalid @enderror"
                                name="id_fasilitator[]" multiple="multiple" style="width: 100%">
                                @foreach ($fasilitators as $item)
                                    <option value="{{ $item->id_fasilitator }}"
                                        @if (in_array($item->id_fasilitator, $oldIdFasilitator)) selected @endif>{{ $item->nama_fasilitator }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_fasilitator')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
        });

        document.addEventListener('trix-initialize', function(event) {
            var editor = event.target.editor;

            // Menonaktifkan grup tombol file-tools
            var fileToolsButtonGroup = editor.toolbarElement.querySelector('[data-trix-button-group="file-tools"]');
            editor.deactivateAttribute('toolbar', fileToolsButtonGroup);
        });
    </script>
@endsection
