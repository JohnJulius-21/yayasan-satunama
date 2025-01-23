@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: green"><a href="{{ route('fasilitatorAdmin') }}">Fasilitator</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Fasilitator</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Edit Fasilitator</h1>
    </div>
    <div class="col-lg-12 mb-4 ">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-start">
                    <h6 class="m-0 font-weight-bold text-success">Edit Fasilitator</h6>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('fasilitatorUpdateAdmin', $fasilitator->id_fasilitator) }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="id_fasilitator" name="id_fasilitator" value="{{ $fasilitator->id_fasilitator }}">
                    <div class="form-group mb-2">
                        <label for="nama_fasilitator">Nama Fasilitator</label>
                        <input type="text" class="form-control" placeholder="Masukan Nama Fasilitator"
                            name="nama_fasilitator" value="{{ old('nama_fasilitator', $fasilitator->nama_fasilitator) }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" placeholder="Masukan NIK" name="nik"
                            value="{{ old('nik', $fasilitator->nik) }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="email_fasilitator">Email</label>
                        <input type="email" class="form-control" placeholder="Masukan Email Anda" name="email_fasilitator"
                            value="{{ old('email_fasilitator', $fasilitator->email_fasilitator) }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="nomor_telepon">Nomor Telepon</label>
                        <input type="text" class="form-control" placeholder="Masukan Nomor Telepon Anda"
                            name="nomor_telepon" value="{{ old('nomor_telepon', $fasilitator->nomor_telepon) }}" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" placeholder="Masukan Alamat" name="alamat"
                            value="{{ old('alamat', $fasilitator->alamat) }}">
                    </div>

                    <div class="form-group mb-2">
                        <label for="gender">Gender</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                            <!-- Opsi jenis kelamin -->
                            <option value="Laki-Laki"
                                {{ old('gender', $fasilitator->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                            </option>
                            <option value="Perempuan"
                                {{ old('gender', $fasilitator->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                            <option value="Transgender"
                                {{ old('gender', $fasilitator->jenis_kelamin) == 'Transgender' ? 'selected' : '' }}>Transgender
                            </option>
                            <option value="Tidak ingin menyebutkan"
                                {{ old('gender', $fasilitator->jenis_kelamin) == 'Tidak ingin menyebutkan' ? 'selected' : '' }}>
                                Tidak ingin menyebutkan</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="id_internal_eksternal">Fasilitator Internal atau Eksternal</label>
                        <select id="id_internal_eksternal" class="form-control" name="id_internal_eksternal">
                            <option value="">Pilih jenis fasilitator</option>
                            @foreach ($internal_eksternal as $item)
                                <option value="{{ $item->id_internal_eksternal }}"
                                    {{ old('id_internal_eksternal', $fasilitator->internal_eksternal->id_internal_eksternal) == $item->id ? 'selected' : '' }}>
                                    {{ $item->internal_eksternal }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div id="asal-lembaga" class="form-group mb-2">
                        <label for="asal_lembaga">Asal Lembaga</label>
                        <input type="text" class="form-control" placeholder="Masukan Asal lembaga" id="asal_lembaga"
                            name="asal_lembaga" value="{{ old('asal_lembaga', $fasilitator->asal_lembaga) }}">
                    </div>
                    <div id="keahlian" class="mb-3">
                        <label for="body" class="form-label"> Tambahkan Keahlian</label>
                        <input id="body" type="hidden" name="body" value="{{ old('body', $fasilitator->body) }}">
                        <trix-editor input="body"></trix-editor>
                    </div>
                    <a class="btn btn-secondary" href="{{ route('fasilitatorAdmin') }}"><i style="width:15px"
                            data-feather="arrow-left"></i>Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
    </script>
@endsection
