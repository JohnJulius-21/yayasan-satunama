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

                            <!-- Nama Peserta -->
                            <div class="form-group mt-3">
                                <h6>Nama Peserta</h6>
                                <input type="text" class="form-control @error('nama_peserta') is-invalid @enderror"
                                    id="nama_peserta" name="nama_peserta" placeholder="Masukan nama Anda"
                                    value="{{ old('nama_peserta', optional($user)->name) }}">
                                @error('nama_peserta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Peserta & Kontak Personal -->
                            <div class="row mt-3">
                                <div class="col-md-6 form-group">
                                    <h6>Email Peserta</h6>
                                    <input id="email_peserta" type="email"
                                        class="form-control @error('email_peserta') is-invalid @enderror"
                                        placeholder="Masukan Email Anda" name="email_peserta"
                                        value="{{ old('email_peserta', optional($user)->email) }}">
                                    @error('email_peserta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <h6>Kontak Personal / Whatsapp</h6>
                                    <input id="no_hp" type="tel" maxlength="12"
                                        class="form-control @error('no_hp') is-invalid @enderror"
                                        placeholder="Masukkan Nomor Telepon Anda" name="no_hp"
                                        value="{{ old('no_hp') }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Jenis Kelamin & Rentang Usia -->
                            <div class="row mt-3">
                                <div class="col-md-6 form-group">
                                    <h6>Gender</h6>
                                    <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                                        <option value="">Pilih Gender</option>
                                        <option value="Laki-Laki" {{ old('gender') == 'Laki-Laki' ? 'selected' : '' }}>
                                            Laki-Laki
                                        </option>
                                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                        <option value="Transgender" {{ old('gender') == 'Transgender' ? 'selected' : '' }}>
                                            Transgender</option>
                                        <option value="Tidak ingin menyebutkan"
                                            {{ old('gender') == 'Tidak ingin menyebutkan' ? 'selected' : '' }}>Tidak
                                            ingin
                                            menyebutkan</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <h6>Rentang Usia</h6>
                                    <select class="form-select @error('rentang_usia') is-invalid @enderror"
                                        name="rentang_usia">
                                        <option value="">Pilih Rentang Usia</option>
                                        <option value="20-25">20-25</option>
                                        <option value="26-30">26-30</option>
                                        <option value="31-35">31-35</option>
                                        <option value="36-40">36-40</option>
                                        <option value="41-45">41-45</option>
                                        <option value="46-50">46-50</option>
                                        <option value="> 50">> 50</option>
                                        {{-- @foreach ($rentang_usia as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('id_rentang_usia') == $item->id ? 'selected' : '' }}>
                                                {{ $item->usia }}</option>
                                        @endforeach --}}
                                    </select>
                                    @error('rentang_usia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Negara, Provinsi & Kota with Select2 -->
                            <div class="row mt-2">
                                <h6 class="mt-2">Negara, Provinsi & Kabupaten/Kota</h6>
                                <div class="col-md-4 form-group mt-3 mt-md-0">
                                    <select class="form-control @error('id_negara') is-invalid @enderror"
                                        name="id_negara" id="id_negara">
                                        <option value="">Pilih Negara</option>
                                        @foreach ($negara as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_negara }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_negara')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group mt-3 mt-md-0">
                                    <select class="form-control @error('id_provinsi') is-invalid @enderror" name="id_provinsi" id="id_provinsi">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                    @error('id_provinsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group mt-3 mt-md-0">
                                    <select class="form-control @error('id_kabupaten') is-invalid @enderror" name="id_kabupaten" id="id_kabupaten">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                    @error('id_kabupaten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nama Organisasi & Jenis Organisasi -->
                            <div class="form-group mt-4">
                                <h6>Nama Organisasi</h6>
                                <input type="text" class="form-control @error('nama_organisasi') is-invalid @enderror"
                                    placeholder="Masukkan Nama Organisasi Anda" name="nama_organisasi" id="nama_organisasi"
                                    value="{{ old('nama_organisasi') }}">
                                @error('nama_organisasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <h6>Jenis Organisasi</h6>
                                    <select name="organisasi" id="organisasi"
                                        class="form-select @error('organisasi') is-invalid @enderror">
                                        <option value="">Pilih Jenis Organisasi</option>
                                        <option value="Personal">Personal</option>
                                        <option value="Pemerintah">Pemerintah</option>
                                        <option value="Lembaga Pendidikan">Lembaga Pendidikan</option>
                                        <option value="Komunitas">Komunitas</option>
                                        <option value="Organisasi Nirlaba">Organisasi Nirlaba</option>
                                        <option value="Perusahaan">Perusahaan</option>
                                        <option value="Partai Politik">Partai Politik</option>
                                    </select>
                                    @error('organisasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <h6>Jabatan Pada Organisasi</h6>
                                    <input id="jabatan_peserta" type="text"
                                        class="form-control @error('jabatan_peserta') is-invalid @enderror"
                                        placeholder="Masukkan Jabatan Anda" name="jabatan_peserta"
                                        value="{{ old('jabatan_peserta') }}">
                                    @error('jabatan_peserta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <h6>Dimana Anda Mendapat Info Tentang Pelatihan Ini?</h6>
                                <select name="informasi" id="informasi"
                                    class="form-select @error('informasi') is-invalid @enderror">
                                    <option value="">Pilih Info Pelatihan</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Website SATUNAMA">Website SATUNAMA</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Whatsapp">Whatsapp</option>
                                    <option value="Linkedin">Linkedin</option>
                                </select>
                                @error('informasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3 mb-3">
                                <h6>Pelatihan Relevan Yang Pernah DiIkuti?</h6>
                                <input id="pelatihan_relevan" type="text"
                                    class="form-control @error('pelatihan_relevan') is-invalid @enderror"
                                    placeholder="Pelatihan Relevan Yang Pernah Anda Ikuti" name="pelatihan_relevan"
                                    value="{{ old('pelatihan_relevan') }}">
                                @error('pelatihan_relevan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Harapan Dari Pelatihan Ini -->
                            <h6 class="mt-4">Harapan Dari Pelatihan Ini</h6>
                            <div class="form-floating mb-4">
                                <textarea class="form-control @error('harapan_pelatihan') is-invalid @enderror" placeholder="Leave a comment here"
                                    name="harapan_pelatihan" style="height: 100px">{{ old('harapan_pelatihan') }}</textarea>
                                <label for="floatingTextarea2">Request Khusus</label>
                                @error('harapan_pelatihan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <hr>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 on dropdowns
            $('#id_negara').select2({
                placeholder: "Pilih Negara",
                allowClear: true,
                width: '100%'
            });
            $('#id_provinsi').select2({
                placeholder: "Pilih Provinsi",
                allowClear: true,
                width: '100%'
            });
            $('#id_kabupaten').select2({
                placeholder: "Pilih Kota",
                allowClear: true,
                width: '100%'
            });

            // Watch for changes on the Negara dropdown
            $('#id_negara').on('change', function() {
                var negaraId = $(this).val();

                // Clear and reset Provinsi and Kabupaten dropdowns
                $('#id_provinsi').empty().append('<option value="">Pilih Provinsi</option>').trigger(
                    'change');
                $('#id_kabupaten').empty().append('<option value="">Pilih Kota</option>').trigger('change');

                if (negaraId) {
                    // Fetch provinces for the selected country
                    $.ajax({
                        url: '/get-provinsi/' + negaraId,
                        type: 'GET',
                        success: function(data) {
                            var options = '<option value="">Pilih Provinsi</option>';
                            $.each(data.provinsi, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#id_provinsi').html(options).trigger('change');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                        }
                    });
                }
            });

            // Watch for changes on the Provinsi dropdown
            $('#id_provinsi').on('change', function() {
                var provinsiId = $(this).val();

                // Clear and reset the Kabupaten dropdown
                $('#id_kabupaten').empty().append('<option value="">Pilih Kota</option>').trigger('change');

                if (provinsiId) {
                    // Fetch cities for the selected province
                    $.ajax({
                        url: '/get-kabupaten/' + provinsiId,
                        type: 'GET',
                        success: function(data) {
                            var options = '<option value="">Pilih Kota</option>';
                            $.each(data.kabupaten, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#id_kabupaten').html(options).trigger('change');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                        }
                    });
                }
            });

            // Remove validation error messages when input is updated
            $('.form-control').on('input', function() {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').remove();
            });
        });
    </script>
@endsection
