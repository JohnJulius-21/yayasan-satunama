@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('fasilitatorAdmin') }}" style="color: green;">Fasilitator</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Fasilitator</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Form Edit Fasilitator</h6>
    </div>

    <form method="post" action="{{ route('fasilitatorUpdateAdmin', $fasilitator->id_fasilitator) }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Fasilitator</h6>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nama_fasilitator">Nama Fasilitator</label>
                            <input type="text" class="form-control @error('nama_fasilitator') is-invalid @enderror"
                                name="nama_fasilitator"
                                value="{{ old('nama_fasilitator', $fasilitator->nama_fasilitator) }}">
                            @error('nama_fasilitator')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                value="{{ old('nik', $fasilitator->nik) }}"maxlength="16" minlength="16" pattern="\d{16}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16)">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email_fasilitator">Email</label>
                            <input type="email" class="form-control @error('email_fasilitator') is-invalid @enderror"
                                name="email_fasilitator"
                                value="{{ old('email_fasilitator', $fasilitator->email_fasilitator) }}">
                            @error('email_fasilitator')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                name="nomor_telepon" value="{{ old('nomor_telepon', $fasilitator->nomor_telepon) }}"
                                maxlength="12" minlength="11" pattern="\d{12}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)">
                            @error('nomor_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                value="{{ old('alamat', $fasilitator->alamat) }}">
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                <option value="">Pilih Jenis Kelamin</option>
                                @foreach (['Laki-Laki', 'Perempuan', 'Transgender', 'Tidak ingin menyebutkan'] as $gender)
                                    <option value="{{ $gender }}"
                                        {{ old('gender', $fasilitator->jenis_kelamin) == $gender ? 'selected' : '' }}>
                                        {{ $gender }}
                                    </option>
                                @endforeach
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Ubah Foto (Opsional)</label>
                            <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
                            <li class="p-1"><small>Maksimal 2MB, format jpeg/png/jpg</small></li>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="id_internal_eksternal">Internal / Eksternal</label>
                            <select class="form-control @error('id_internal_eksternal') is-invalid @enderror"
                                name="id_internal_eksternal">
                                <option value="">Pilih jenis fasilitator</option>
                                @foreach ($internal_eksternal as $item)
                                    <option value="{{ $item['id_internal_eksternal'] }}"
                                        {{ old('id_internal_eksternal', $fasilitator->id_internal_eksternal) == $item['id_internal_eksternal'] ? 'selected' : '' }}>
                                        {{ $item['internal_eksternal'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_internal_eksternal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="asal_lembaga">Asal Lembaga</label>
                            <input type="text" class="form-control @error('asal_lembaga') is-invalid @enderror"
                                name="asal_lembaga" id="asal_lembaga"
                                value="{{ old('asal_lembaga', $fasilitator->asal_lembaga) }}">
                            @error('asal_lembaga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="body">Keahlian</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" name="body">{{ old('body', $fasilitator->body) }}</textarea>
                            @error('body')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Link Sosial Media (Opsional)</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" class="form-control" name="facebook"
                                value="{{ old('facebook', $fasilitator->facebook) }}">
                        </div>

                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" class="form-control" name="twitter"
                                value="{{ old('twitter', $fasilitator->twitter) }}">
                        </div>

                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" class="form-control" name="instagram"
                                value="{{ old('instagram', $fasilitator->instagram) }}">
                        </div>

                        <div class="form-group">
                            <label>LinkedIn</label>
                            <input type="text" class="form-control" name="linkedin"
                                value="{{ old('linkedin', $fasilitator->linkedin) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('fasilitatorAdmin') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Update</button>
    </form>

    <script>
        $(document).ready(function() {
            $('#id_internal_eksternal').change(function() {
                if ($(this).val() == 1) {
                    $('#asal_lembaga').val('SATUNAMA').prop('readonly', true);
                } else {
                    $('#asal_lembaga').val('').prop('readonly', false);
                }
            }).trigger('change');
        });
    </script>
@endsection
