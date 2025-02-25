@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Form Konsultasi</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a href="{{ route('pelatihan') }}">Konsultasi</a></li>
                    <li class="current">Form Konsultasi</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container my-3" id="scrollspy-container">

        <div class="container my-3">
            <div class="card px-3 mb-4">
                @if (Session::has('success'))
                    <div class="container mt-3" data-aos="fade-up">
                        <div class="pt-3">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                            </div>
                        </div>
                    </div>
                @endif

                <section id="contact" class="contact">
                    <div class="row mt-1 justify-content-center" data-aos="fade-up">
                        <div class="col-lg-10">
                            <div class="form-studi">
                                <form method="post" action="{{ route('konsultasi.store') }}" role="form">
                                    @csrf
                                    <h5 class="mt-3">Data Organisasi</h5>
                                    <hr>
                                    <div class="form-group mt-3">
                                        <h6>Nama Organisasi</h6>
                                        <input type="text"
                                            class="form-control @error('nama_organisasi') is-invalid @enderror"
                                            id="nama_organisasi" name="nama_organisasi" placeholder="Nama Organisasi"
                                            value="{{ old('nama_organisasi') }}">
                                        @error('nama_organisasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <h6>Jenis Organisasi</h6>
                                        <select name="jenis_organisasi" id="jenis_organisasi"
                                            class="form-select @error('jenis_organisasi') is-invalid @enderror">
                                            <option value="">Pilih jenis organisasi</option>
                                            <option value="Pemerintah"
                                                {{ old('jenis_organisasi') == 'Pemerintah' ? 'selected' : '' }}>
                                                Pemerintah</option>
                                            <option value="Lembaga Pendidikan"
                                                {{ old('jenis_organisasi') == 'Lembaga Pendidikan' ? 'selected' : '' }}>
                                                Lembaga
                                                Pendidikan</option>
                                            <option value="Komunitas"
                                                {{ old('jenis_organisasi') == 'Komunitas' ? 'selected' : '' }}>
                                                Komunitas</option>
                                            <option value="Organisasi Nirlaba"
                                                {{ old('jenis_organisasi') == 'Organisasi Nirlaba' ? 'selected' : '' }}>
                                                Organisasi
                                                Nirlaba</option>
                                            <option value="Perusahaan"
                                                {{ old('jenis_organisasi') == 'Perusahaan' ? 'selected' : '' }}>
                                                Perusahaan</option>
                                            <option value="Partai Politik"
                                                {{ old('jenis_organisasi') == 'Partai Politik' ? 'selected' : '' }}>Partai
                                                Politik
                                            </option>
                                        </select>
                                        @error('jenis_organisasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6 form-group">
                                            <h6>Email Organisasi</h6>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder=" Email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group mt-3 mt-md-0">
                                            <h6>Nomor Telepon Organisasi</h6>
                                            <input id="no_hp" type="tel" maxlength="12"
                                                class="form-control @error('no_hp') is-invalid @enderror"
                                                placeholder="Nomor Telepon" name="no_hp" value="{{ old('no_hp') }}">
                                            @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <h5 class="mt-3">Alamat Organisasi</h5>
                                    <div class="row mt-3">
                                        <div class="col-md-4 form-group">
                                            <h6>Negara</h6>
                                            <select class="form-select" name="id_negara" id="id_negara">
                                                <option value="">Pilih Negara</option>
                                                @foreach ($negara as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['nama_negara'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group mt-3 mt-md-0">
                                            <h6>Provinsi</h6>
                                            <select class="form-select" name="id_provinsi" id="id_provinsi">
                                                <option value="">Pilih Provinsi</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group mt-3 mt-md-0">
                                            <h6>Kabupaten atau Kota</h6>
                                            <select class="form-select" name="id_kabupaten" id="id_kabupaten">
                                                <option value="">Pilih Kota</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <h6>Deskripsi Kebutuhan</h6>
                                        <textarea class="form-control @error('deskripsi_kebutuhan') is-invalid @enderror" name="deskripsi_kebutuhan"
                                            rows="5" id="deskripsi_kebutuhan" placeholder="Deskripsi Kebutuhan"></textarea>
                                        @error('deskripsi_kebutuhan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="text-center my-3">
                                        <button type="submit" class="btn btn-success" style="width: 30%;">Daftar
                                            Pelatihan</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                </section>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                // Inisialisasi Select2 pada elemen-elemen select
                $('#id_negara').select2();
                $('#id_provinsi').select2();
                $('#id_kabupaten').select2();

                // Memantau perubahan pada elemen negara
                $('#id_negara').on('change', function() {
                    var negaraId = $(this).val();

                    // Hapus opsi sebelumnya pada elemen provinsi dan kota
                    $('#id_provinsi').empty().append('<option value="">Pilih Provinsi</option>').trigger(
                        'change');
                    $('#id_kabupaten').empty().append('<option value="">Pilih Kota</option>').trigger('change');

                    if (negaraId) {
                        // Lakukan AJAX request untuk mendapatkan daftar provinsi
                        $.ajax({
                            url: '/get-provinsi/' + negaraId,
                            type: 'GET',
                            success: function(data) {
                                // Isi dropdown provinsi dengan data yang diterima dari server
                                var options = '<option value="">Pilih Provinsi</option>';
                                $.each(data.provinsi, function(key, value) {
                                    options += '<option value="' + key + '">' + value +
                                        '</option>';
                                });
                                $('#id_provinsi').html(options).trigger(
                                    'change'); // Aktifkan event change pada elemen provinsi
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', xhr.responseText);
                            }
                        });
                    }
                });

                // Memantau perubahan pada elemen provinsi
                $('#id_provinsi').on('change', function() {
                    var provinsiId = $(this).val();

                    // Hapus opsi sebelumnya pada elemen kota
                    $('#id_kabupaten').empty().append('<option value="">Pilih Kota</option>').trigger('change');

                    if (provinsiId) {
                        // Lakukan AJAX request untuk mendapatkan daftar kota
                        $.ajax({
                            url: '/get-kabupaten/' + provinsiId,
                            type: 'GET',
                            success: function(data) {
                                // Isi dropdown kota dengan data yang diterima dari server
                                var options = '<option value="">Pilih Kota</option>';
                                $.each(data.kabupaten, function(key, value) {
                                    options += '<option value="' + key + '">' + value +
                                        '</option>';
                                });
                                $('#id_kabupaten').html(options).trigger(
                                    'change'); // Aktifkan event change pada elemen kota
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', xhr.responseText);
                            }
                        });
                    }
                });
            });
        </script>
    @endsection
