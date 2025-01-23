@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: green"><a href="{{ route('fasilitatorAdmin') }}">Fasilitator</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Fasilitator</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Tambah Fasilitator</h1>
    </div>
    <div class="col-lg-12 mb-4 ">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Fasilitator</h6>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('fasilitatorStoreAdmin') }}">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="nama_fasilitator">Nama Fasilitator</label>
                        <input type="text" class="form-control @error('nama_fasilitator') is-invalid @enderror"
                            placeholder="Masukan Nama Fasilitator" name="nama_fasilitator"
                            value="{{ old('nama_fasilitator') }}">
                        @error('nama_fasilitator')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                            placeholder="Masukan NIK" name="nik" value="{{ old('nik') }}">
                        @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="email_fasilitator">Email</label>
                        <input type="email" class="form-control @error('email_fasilitator') is-invalid @enderror"
                            placeholder="Masukan Email Fasilitator" name="email_fasilitator"
                            value="{{ old('email_fasilitator') }}">
                        @error('email_fasilitator')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="nomor_telepon">Nomor Telepon</label>
                        <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                            placeholder="Masukan Nomor Telepon Fasilitator" name="nomor_telepon"
                            value="{{ old('nomor_telepon') }}">
                        @error('nomor_telepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                            placeholder="Masukan Alamat" name="alamat" value="{{ old('alamat') }}">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-group mb-2">
                        <label for="gender">Jenis Kelamin</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki" {{ old('gender') == 'Laki-Laki' ? 'selected' : '' }}>
                                Laki-Laki</option>
                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                            <option value="Transgender" {{ old('gender') == 'Transgender' ? 'selected' : '' }}>
                                Transgender</option>
                            <option value="Tidak ingin menyebutkan"
                                {{ old('gender') == 'Tidak ingin menyebutkan' ? 'selected' : '' }}>Tidak ingin
                                menyebutkan</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="id_internal_eksternal">Fasilitator Internal atau Eksternal</label>
                        <select id="id_internal_eksternal"
                            class="form-control @error('id_internal_eksternal') is-invalid @enderror"
                            name="id_internal_eksternal">
                            <option value="">Pilih jenis fasilitator</option>
                            @foreach ($internal_eksternal as $item)
                                <option value="{{ $item['id_internal_eksternal'] }}"
                                    {{ old('id_internal_eksternal') == $item['id_internal_eksternal'] ? 'selected' : '' }}>
                                    {{ $item['internal_eksternal'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_internal_eksternal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="asal-lembaga" class="form-group mb-2">
                        <label for="asal_lembaga">Asal Lembaga</label>
                        <input type="text" class="form-control  @error('asal_lembaga') is-invalid @enderror"
                            placeholder="Masukan Asal lembaga" id="asal_lembaga" name="asal_lembaga">
                        @error('asal_lembaga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div id="keahlian" class="mb-3">
                        <label for="body" class="form-label">Tambahkan Keahlian</label>
                        <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                        <trix-editor class="trix-editor @error('body') is-invalid @enderror" input="body"></trix-editor>
                        @error('body')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <a href="{{ route('fasilitatorAdmin') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#id_internal_eksternal').change(function() {
                if ($(this).val() == 1) {
                    $('#asal-lembaga input[name="asal_lembaga"]').val('SATUNAMA');
                    $('#asal-lembaga input[name="asal_lembaga"]').prop('readonly', true);
                } else {
                    $('#asal-lembaga input[name="asal_lembaga"]').val('');
                    $('#asal-lembaga input[name="asal_lembaga"]').prop('readonly', false);
                }
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('#internal_eksternal').change(function() {
                if ($(this).val() == '2') {
                    $('#asal-lembaga').show();
                    $('#keahlian').show();
                } else {
                    $('#asal-lembaga').hide();
                    $('#keahlian').hide();
                }
            });
        });
    </script> --}}
@endsection
