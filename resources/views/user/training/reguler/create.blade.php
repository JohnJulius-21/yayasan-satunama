@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Form Reguler</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a href="{{ route('pelatihan') }}">Pelatihan</a></li>
                    <li><a href="{{ route('reguler.show', $reguler->id_reguler) }}">Detail Pelatihan</a></li>
                    <li class="current">Form Reguler</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container my-3">
        <div class="card px-3 mb-4">
            <div class="row mt-3 justify-content-center">
                <div class="col-lg-10">
                    <div class="form-studi mb-3">
                        <form id="myForm" method="post" action="{{ route('reguler.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id_reguler" name="id_reguler" value="{{ $reguler->id_reguler }}">
                            <input type="hidden" id="id_user" name="id_user" value="{{ Auth::id() }}">

                            <h4>Form Pendaftaran Pelatihan Reguler</h4>
                            <hr>

                            <div class="peserta-section mb-4 border p-3">
                                @for ($i = 1; $i <= $jumlahPeserta; $i++)
                                    <h5>Peserta {{ $i }}</h5>
                                    <hr>

                                    <!-- Nama Peserta -->
                                    <div class="form-group mt-3">
                                        <h6>Nama Peserta</h6>
                                        <input type="text" id="nama_peserta_{{ $i }}"
                                            name="peserta[{{ $i }}][nama_peserta]"
                                            class="form-control @error("peserta.{$i}.nama_peserta") is-invalid @enderror"
                                            placeholder="Masukkan nama Anda" value="{{ old("peserta.{$i}.nama_peserta") }}">
                                        @error("peserta.{$i}.nama_peserta")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email & Kontak -->
                                    <div class="row mt-3">
                                        <div class="col-md-6 form-group">
                                            <h6>Email Peserta</h6>
                                            <input type="email" id="email_peserta_{{ $i }}"
                                                name="peserta[{{ $i }}][email_peserta]"
                                                class="form-control @error("peserta.{$i}.email_peserta") is-invalid @enderror"
                                                placeholder="Masukkan Email Anda"
                                                value="{{ old("peserta.{$i}.email_peserta") }}">
                                            @error("peserta.{$i}.email_peserta")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <h6>Kontak Personal / Whatsapp</h6>
                                            <input type="tel" id="no_hp_{{ $i }}"
                                                name="peserta[{{ $i }}][no_hp]"
                                                class="form-control @error("peserta.{$i}.no_hp") is-invalid @enderror"
                                                placeholder="Masukkan Nomor Telepon Anda" maxlength="12"
                                                value="{{ old("peserta.{$i}.no_hp") }}">
                                            @error("peserta.{$i}.no_hp")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Gender & Usia -->
                                    <div class="row mt-3">
                                        <div class="col-md-6 form-group">
                                            <h6>Gender</h6>
                                            <select name="peserta[{{ $i }}][gender]"
                                                class="form-select @error("peserta.{$i}.gender") is-invalid @enderror">
                                                <option value="">Pilih Gender</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                                <option value="Transgender">Transgender</option>
                                                <option value="Tidak ingin menyebutkan">Tidak ingin menyebutkan</option>
                                            </select>
                                            @error("peserta.{$i}.gender")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <h6>Rentang Usia</h6>
                                            <select name="peserta[{{ $i }}][rentang_usia]"
                                                class="form-select @error("peserta.{$i}.rentang_usia") is-invalid @enderror">
                                                <option value="">Pilih Rentang Usia</option>
                                                <option value="20-25">20-25</option>
                                                <option value="26-30">26-30</option>
                                                <option value="31-35">31-35</option>
                                                <option value="36-40">36-40</option>
                                                <option value="41-45">41-45</option>
                                                <option value="46-50">46-50</option>
                                                <option value="> 50">> 50</option>
                                            </select>
                                            @error("peserta.{$i}.rentang_usia")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-survey mt-3">
                                        <h6>Asal Daerah Peserta Pelatihan</h6>
                                        <span class="entry-content">Negara, Provinsi & Kabupaten/Kota</span>
                                        <div class="form-group mb-2">
                                            <div class="row mt-3">
                                                <div class="col-md-4 form-group">
                                                    <select
                                                        class="form-select select2 select-negara @error("peserta.{$i}.id_negara") is-invalid @enderror"
                                                        name="peserta[{{ $i }}][id_negara]"
                                                        id="id_negara_{{ $i }}"
                                                        data-index="{{ $i }}">
                                                        <option value="">Pilih Negara</option>
                                                        @foreach ($negara as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ old("peserta.{$i}.id_negara") == $item->id ? 'selected' : '' }}>
                                                                {{ $item->nama_negara }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error("peserta.{$i}.id_negara")
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group mt-3 mt-md-0">
                                                    <select
                                                        class="form-select select2 select-provinsi @error("peserta.{$i}.id_provinsi") is-invalid @enderror"
                                                        name="peserta[{{ $i }}][id_provinsi]"
                                                        id="id_provinsi_{{ $i }}"
                                                        data-index="{{ $i }}">
                                                        <option value="">Pilih Provinsi</option>
                                                    </select>
                                                    @error("peserta.{$i}.id_provinsi")
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 form-group mt-3 mt-md-0">
                                                    <select
                                                        class="form-select select2 select-kabupaten @error("peserta.{$i}.id_kabupaten") is-invalid @enderror"
                                                        name="peserta[{{ $i }}][id_kabupaten]"
                                                        id="id_kabupaten_{{ $i }}"
                                                        data-index="{{ $i }}">
                                                        <option value="">Pilih Kota</option>
                                                    </select>
                                                    @error("peserta.{$i}.id_kabupaten")
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Nama Organisasi -->
                                    <div class="form-group mt-4">
                                        <h6>Nama Organisasi</h6>
                                        <input type="text"
                                            class="form-control @error("peserta.{$i}.nama_organisasi") is-invalid @enderror"
                                            placeholder="Masukkan Nama Organisasi Anda"
                                            name="peserta[{{ $i }}][nama_organisasi]"
                                            id="nama_organisasi_{{ $i }}"
                                            value="{{ old("peserta.{$i}.nama_organisasi") }}">
                                        @error("peserta.{$i}.nama_organisasi")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row mt-3">
                                        <!-- Jenis Organisasi -->
                                        <div class="col-md-6 form-group mt-3 mt-md-0">
                                            <h6>Jenis Organisasi</h6>
                                            <select name="peserta[{{ $i }}][organisasi]"
                                                id="organisasi_{{ $i }}"
                                                class="form-select @error("peserta.{$i}.organisasi") is-invalid @enderror">
                                                <option value="">Pilih Jenis Organisasi</option>
                                                <option value="Personal"
                                                    {{ old("peserta.{$i}.organisasi") == 'Personal' ? 'selected' : '' }}>
                                                    Personal</option>
                                                <option value="Pemerintah"
                                                    {{ old("peserta.{$i}.organisasi") == 'Pemerintah' ? 'selected' : '' }}>
                                                    Pemerintah</option>
                                                <option value="Lembaga Pendidikan"
                                                    {{ old("peserta.{$i}.organisasi") == 'Lembaga Pendidikan' ? 'selected' : '' }}>
                                                    Lembaga Pendidikan</option>
                                                <option value="Komunitas"
                                                    {{ old("peserta.{$i}.organisasi") == 'Komunitas' ? 'selected' : '' }}>
                                                    Komunitas</option>
                                                <option value="Organisasi Nirlaba"
                                                    {{ old("peserta.{$i}.organisasi") == 'Organisasi Nirlaba' ? 'selected' : '' }}>
                                                    Organisasi Nirlaba</option>
                                                <option value="Perusahaan"
                                                    {{ old("peserta.{$i}.organisasi") == 'Perusahaan' ? 'selected' : '' }}>
                                                    Perusahaan</option>
                                                <option value="Partai Politik"
                                                    {{ old("peserta.{$i}.organisasi") == 'Partai Politik' ? 'selected' : '' }}>
                                                    Partai Politik</option>
                                            </select>
                                            @error("peserta.{$i}.organisasi")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Jabatan -->
                                        <div class="col-md-6 form-group mt-3 mt-md-0">
                                            <h6>Jabatan Pada Organisasi</h6>
                                            <input id="jabatan_peserta_{{ $i }}" type="text"
                                                class="form-control @error("peserta.{$i}.jabatan_peserta") is-invalid @enderror"
                                                placeholder="Masukkan Jabatan Anda"
                                                name="peserta[{{ $i }}][jabatan_peserta]"
                                                value="{{ old("peserta.{$i}.jabatan_peserta") }}">
                                            @error("peserta.{$i}.jabatan_peserta")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Sumber Informasi -->
                                    <div class="form-group mt-3 mb-3">
                                        <h6>Dimana Anda Mendapat Info Tentang Pelatihan Ini?</h6>
                                        <select name="peserta[{{ $i }}][informasi]"
                                            id="informasi_{{ $i }}"
                                            class="form-select @error("peserta.{$i}.informasi") is-invalid @enderror">
                                            <option value="">Pilih Info Pelatihan</option>
                                            <option value="Instagram"
                                                {{ old("peserta.{$i}.informasi") == 'Instagram' ? 'selected' : '' }}>
                                                Instagram</option>
                                            <option value="Website SATUNAMA"
                                                {{ old("peserta.{$i}.informasi") == 'Website SATUNAMA' ? 'selected' : '' }}>
                                                Website SATUNAMA</option>
                                            <option value="Facebook"
                                                {{ old("peserta.{$i}.informasi") == 'Facebook' ? 'selected' : '' }}>
                                                Facebook</option>
                                            <option value="Whatsapp"
                                                {{ old("peserta.{$i}.informasi") == 'Whatsapp' ? 'selected' : '' }}>
                                                Whatsapp</option>
                                            <option value="Linkedin"
                                                {{ old("peserta.{$i}.informasi") == 'Linkedin' ? 'selected' : '' }}>
                                                Linkedin</option>
                                        </select>
                                        @error("peserta.{$i}.informasi")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Pelatihan Relevan -->
                                    <div class="form-group mt-3 mb-3">
                                        <h6>Pelatihan Relevan Yang Pernah Diikuti?</h6>
                                        <input id="pelatihan_relevan_{{ $i }}" type="text"
                                            class="form-control @error("peserta.{$i}.pelatihan_relevan") is-invalid @enderror"
                                            placeholder="Pelatihan Relevan Yang Pernah Anda Ikuti"
                                            name="peserta[{{ $i }}][pelatihan_relevan]"
                                            value="{{ old("peserta.{$i}.pelatihan_relevan") }}">
                                        @error("peserta.{$i}.pelatihan_relevan")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Harapan Dari Pelatihan -->
                                    <h6 class="mt-4">Harapan Dari Pelatihan Ini</h6>
                                    <div class="form-floating mb-4">
                                        <textarea class="form-control @error("peserta.{$i}.harapan_pelatihan") is-invalid @enderror"
                                            placeholder="Leave a comment here" name="peserta[{{ $i }}][harapan_pelatihan]" style="height: 100px">{{ old("peserta.{$i}.harapan_pelatihan") }}</textarea>
                                        <label for="floatingTextarea2">Request Khusus</label>
                                        @error("peserta.{$i}.harapan_pelatihan")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <hr>
                                @endfor
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success" style="width: 30%;">Daftar
                                        Pelatihan</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .select2-container .select2-selection--single {
            height: 38px;
            /* Set tinggi untuk mirip dengan field Bootstrap */
            border: 1px solid #ced4da;
            /* Border default Bootstrap */
            border-radius: 0.25rem;
            /* Radius border Bootstrap */
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            /* Vertikal center teks */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            /* Tinggi panah dropdown */
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6c757d;
            /* Warna placeholder mirip Bootstrap */
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $('.select2 select-negara').select2();
            $('.select2 select-provinsi').select2();
            $('.select2 select-kabupaten').select2();

            // Event listener untuk Negara -> Ambil daftar provinsi
            $(document).on('change', '.select-negara', function() {
                var index = $(this).data('index'); // Ambil nomor peserta
                var negaraId = $(this).val();

                // Reset Provinsi dan Kabupaten
                $('#id_provinsi_' + index).empty().append('<option value="">Pilih Provinsi</option>')
                    .trigger('change');
                $('#id_kabupaten_' + index).empty().append('<option value="">Pilih Kota</option>').trigger(
                    'change');

                if (negaraId) {
                    $.ajax({
                        url: '/get-provinsi/' + negaraId,
                        type: 'GET',
                        success: function(data) {
                            var options = '<option value="">Pilih Provinsi</option>';
                            $.each(data.provinsi, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#id_provinsi_' + index).html(options).trigger('change');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                        }
                    });
                }
            });

            // Event listener untuk Provinsi -> Ambil daftar kabupaten
            $(document).on('change', '.select-provinsi', function() {
                var index = $(this).data('index'); // Ambil nomor peserta
                var provinsiId = $(this).val();

                // Reset Kabupaten
                $('#id_kabupaten_' + index).empty().append('<option value="">Pilih Kota</option>').trigger(
                    'change');

                if (provinsiId) {
                    $.ajax({
                        url: '/get-kabupaten/' + provinsiId,
                        type: 'GET',
                        success: function(data) {
                            var options = '<option value="">Pilih Kota</option>';
                            $.each(data.kabupaten, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#id_kabupaten_' + index).html(options).trigger('change');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                        }
                    });
                }
            });
        });

        // Remove validation error messages when input is updated
        $('.form-control').on('input', function() {
            $(this).removeClass('is-invalid');
            $(this).siblings('.invalid-feedback').remove();
        });
    </script>
@endsection
