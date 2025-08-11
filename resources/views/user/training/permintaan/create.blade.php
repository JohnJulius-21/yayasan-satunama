@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Form Permintaan</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a href="{{ route('pelatihan') }}">Permintaan</a></li>
                    <li class="current">Form Permintaan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container my-3">
        <div class="card px-3 mb-4">
            {{-- @if (Session::has('success'))
                <div class="container mt-3" data-aos="fade-up">
                    <div class="pt-3">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    </div>
            @endif --}}

            <section id="contact" class="contact">
                <div class="row mt-1 justify-content-center" data-aos="fade-up">
                    <div class="col-lg-10">
                        <div class="form-studi">
                            {{-- <form id="dynamicForm" method="post" action="{{ route('peserta.permintaan.store') }}"> --}}

                            @if (!Auth::check())
                                <h5 class="text-center">Silahkan Masuk / Daftar Terlebih dahulu..</h5>
                                {{-- Jika belum login --}}
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                                        loginModal.show();
                                    });
                                </script>
                            @else
                                <form id="multi-step-form" method="post" role="form">
                                    @csrf
                                    <input type="hidden" id="id_user" name="id_user" value="{{ Auth::id() }}">
                                    <h4 class="mb-2">Check List Training & Konsultasi</h4>
                                    <hr>
                                    <div class="stepper mb-4">
                                        <div class="step active">
                                            <div class="circle">1</div>
                                            <div class="label">Informasi Mitra</div>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step">
                                            <div class="circle">2</div>
                                            <div class="label">Jadwal Pelaksanaan Pelatihan</div>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step">
                                            <div class="circle">3</div>
                                            <div class="label">Asesesment Dasar</div>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step">
                                            <div class="circle">4</div>
                                            <div class="label">Asessment Peserta</div>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step">
                                            <div class="circle">5</div>
                                            <div class="label">Request Khusus</div>
                                        </div>
                                    </div>

                                    <div class="step-content active" id="step-1">
                                        <div class="form-group mt-3">
                                            {{-- <label for="nama_mitra">Nama Mitra</label> --}}
                                            <h6>Nama Mitra</h6>
                                            <select id="mitra"
                                                class="form-control @error('id_mitra') is-invalid @enderror" name="id_mitra"
                                                id="id_mitra">
                                                <option value="">Pilih Mitra</option>
                                                @foreach ($mitra as $item)
                                                    <option value="{{ $item->id_mitra }}"
                                                        {{ old('id_mitra') == $item->id_mitra ? 'seltected' : '' }}>
                                                        {{ $item->nama_mitra }}</option>
                                                @endforeach
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                            @error('id_mitra')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small style="color: #6c757d"> Note: Jika tidak ada nama organisasi anda,
                                                silahkan
                                                memilih opsi lainnya untuk mengisi nama organisasi anda.</small>
                                        </div>

                                        <div class="form-group mt-3" id="namaMitraContainer" style="display: none;">
                                            <input type="text"
                                                class="form-select @error('nama_mitra') is-invalid @enderror"
                                                id="nama_mitra" name="nama_mitra" placeholder="Masukan nama Organisasi anda"
                                                value="{{ old('nama_mitra') }}">
                                            @error('nama_mitra')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group mt-3">
                                            {{-- <label for="judul_pelatihan">Judul Pelatihan</label> --}}
                                            <h6>Judul Pelatihan</h6>
                                            <input type="text"
                                                class="form-control @error('judul_pelatihan') is-invalid @enderror"
                                                id="judul_pelatihan" name="judul_pelatihan" placeholder="Judul Pelatihan"
                                                value="{{ old('judul_pelatihan') }}">
                                            @error('judul_pelatihan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group mt-3">
                                                    <label for="id_tema">Tema Pelatihan</label>
                                                    <select class="form-control @error('id_tema') is-invalid @enderror"
                                                        name="id_tema" id="id_tema">
                                                        <option value="">Pilih Tema Pelatihan</option>
                                                        @foreach ($tema as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ old('id_tema') == $item->id ? 'selected' : '' }}>
                                                                {{ $item->judul_tema }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_tema')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group mt-3 mb-3">
                                                <label for="no_pic">Nomor PIC Mitra</label>
                                                <input type="text" maxlength="12" pattern="[0-9]*" inputmode="numeric"
                                                    class="form-control @error('no_pic') is-invalid @enderror"
                                                    id="no_pic" name="no_pic" placeholder="Masukan Nomor PIC"
                                                    value="{{ old('no_pic') }}">

                                                @error('no_pic')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success next-step">Next</button>
                                    </div>

                                    <div class="step-content" id="step-2">
                                        <div class="row mt-3 mb-3">
                                            <h6>Jadwal Pelaksanaan Pelatihan</h6>
                                            <div class="col">
                                                <div class="form-group">
                                                    <p>Tanggal Mulai</p>
                                                    <input type="date"
                                                        class="form-control @error('tanggal_waktu_mulai') is-invalid @enderror"
                                                        id="tanggal_waktu_mulai" name="tanggal_waktu_mulai"
                                                        value="{{ old('tanggal_waktu_mulai') }}">
                                                    @error('tanggal_waktu_mulai')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- datetime-local --}}
                                            <div class="col">
                                                <div class="form-group">
                                                    <p>Tanggal Selesai</p>
                                                    <input type="date"
                                                        class="form-control @error('tanggal_waktu_selesai') is-invalid @enderror"
                                                        id="tanggal_waktu_selesai" name="tanggal_waktu_selesai"
                                                        value="{{ old('tanggal_waktu_selesai') }}">
                                                    @error('tanggal_waktu_selesai')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                        <button type="button" class="btn btn-success next-step">Next</button>
                                    </div>


                                    <div class="step-content" id="step-3">
                                        <!-- Asessment Dasar -->
                                        <div class="form-group mt-3 mb-3">
                                            <h6>Asessment Dasar</h6>
                                            <p>Masalah yang sedang dihadapi oleh lembaga</p>
                                            <textarea class="form-control @error('masalah') is-invalid @enderror" name="masalah" rows="5">{{ old('masalah') }}</textarea>
                                            @error('masalah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Kebutuhan lembaga -->
                                        <div class="form-group mt-3 mb-3">
                                            <p>Kebutuhan lembaga</p>
                                            <textarea class="form-control @error('kebutuhan') is-invalid @enderror" name="kebutuhan" rows="5">{{ old('kebutuhan') }}</textarea>
                                            @error('kebutuhan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Materi & topik yang diharapkan dari pelatihan -->
                                        <div class="form-group mt-3 mb-3">
                                            <p>Materi & topik yang diharapkan dari pelatihan</p>
                                            <textarea class="form-control @error('materi') is-invalid @enderror" name="materi" rows="5">{{ old('materi') }}</textarea>
                                            @error('materi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                        <button type="button" class="btn btn-success next-step">Next</button>
                                    </div>


                                    <div class="step-content" id="step-4">
                                        <!-- Asessment Peserta -->
                                        <div>
                                            <h6>Asessment Peserta</h6>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Peserta</th>
                                                        <th>Email Peserta</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Jabatan di Lembaga</th>
                                                        <th>Tanggung Jawab Utama</th>
                                                        <th>Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableBody2">
                                                    <tr>
                                                        <td><input type="text" name="nama_peserta[]"
                                                                class="form-control @error('nama_peserta.*') is-invalid @enderror"
                                                                value="{{ old('nama_peserta.0') }}"></td>
                                                        <td><input type="email" name="email_peserta[]"
                                                                class="form-control @error('email_peserta.*') is-invalid @enderror"
                                                                value="{{ old('email_peserta.0') }}"></td>
                                                        <td>
                                                            <div class="form-group">
                                                                <select
                                                                    class="form-control @error('jenis_kelamin.*') is-invalid @enderror"
                                                                    name="jenis_kelamin[]" id="exampleFormControlSelect2">
                                                                    <option value="">Pilih</option>
                                                                    <option value="Laki-laki"
                                                                        {{ old('jenis_kelamin.0') == 'Laki-laki' ? 'selected' : '' }}>
                                                                        Laki-laki</option>
                                                                    <option value="Perempuan"
                                                                        {{ old('jenis_kelamin.0') == 'Perempuan' ? 'selected' : '' }}>
                                                                        Perempuan</option>
                                                                    <option value="Transgender"
                                                                        {{ old('jenis_kelamin.0') == 'Transgender' ? 'selected' : '' }}>
                                                                        Transgender</option>
                                                                    <option value="Tidak ingin menyebutkan"
                                                                        {{ old('jenis_kelamin.0') == 'Tidak ingin menyebutkan' ? 'selected' : '' }}>
                                                                        Tidak ingin menyebutkan</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td><input type="text" name="jabatan[]"
                                                                class="form-control @error('jabatan.*') is-invalid @enderror"
                                                                value="{{ old('jabatan.0') }}"></td>
                                                        <td><input type="text" name="tanggung_jawab[]"
                                                                class="form-control @error('tanggung_jawab.*') is-invalid @enderror"
                                                                value="{{ old('tanggung_jawab.0') }}"></td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm addRow2">+
                                                                Tambah
                                                                Peserta</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @error('nama_peserta.*')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                        <button type="button" class="btn btn-success next-step">Next</button>
                                    </div>

                                    <div class="step-content" id="step-5">
                                        <!-- Request Khusus -->
                                        <div class="form-group mt-3 mb-3">
                                            <h6>Request Khusus</h6>
                                            <textarea class="form-control @error('request_khusus') is-invalid @enderror" name="request_khusus" rows="5"
                                                placeholder="Request Khusus">{{ old('request_khusus') }}</textarea>
                                            @error('request_khusus')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                        <button type="submit" id="submit-button" class="btn btn-success"
                                            disabled>Daftar</button>

                                    </div>

                                    {{-- <div class="text-center my-3">
                                    <button type="submit" class="btn btn-success" style="width: 20%;">Daftar
                                        Pelatihan</button>
                                </div> --}}
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <style>
        .step-indicator .step {
            display: inline-block;
            padding: 10px 15px;
            background-color: #e9ecef;
            border-radius: 50px;
            margin: 5px;
            font-weight: bold;
        }

        .step-indicator .step.active {
            background-color: #28a745;
            color: white;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        /* Stepper container */
        .stepper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        /* Individual step */
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
        }

        /* Circle */
        .circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e0e0e0;
            color: #28a745;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
        }

        /* Active circle */
        .step.active .circle {
            background-color: #28a745;
            color: white;
        }

        /* Step label */
        .label {
            margin-top: 8px;
            font-size: 14px;
            color: #6c757d;
        }

        /* Line between steps */
        .line {
            flex-grow: 1;
            height: 2px;
            background-color: #e0e0e0;
        }

        /* Active line */
        .step.active~.line {
            background-color: #28a745;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            document.getElementById('no_pic').addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, ''); // hapus karakter selain angka
            });
            // Add row for Assessment Dasar
            $(".addRow1").click(function() {
                console.log('Tombol tambah Assessment Dasar diklik!');
                $("#tableBody1").append(
                    '<tr><td><input type="text" name="masalah[]" class="form-control" ></td><td><input type="text" name="kebutuhan[]" class="form-control" ></td><td><input type="text" name="materi[]" class="form-control" ></td><td><button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button></td></tr>'
                );
            });

            // Add row for Assessment Peserta
            $(".addRow2").click(function() {
                $("#tableBody2").append(
                    '<tr><td><input type="text" name="nama_peserta[]" class="form-control" ></td> <td><input type="text" name="email_peserta[]" class="form-control" > </td> <td><div class="form-group"><select class="form-control" name="jenis_kelamin[]"id="exampleFormControlSelect2"><option value="">Pilih</option><option value="Laki-laki">Laki-laki</option><option value="Perempuan">Perempuan</option><option value="Transgender">Transgender</option><option value="Tidak ingin menyebutkan">Tidak ingin menyebutkan</option></select></div></td><td><input type="text" name="jabatan[]" class="form-control" ></td><td><input type="text" name="tanggung_jawab[]" class="form-control" ></td><td><button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button></td></tr>'
                );
            });

            // Remove row on button click
            $(document).on("click", ".removeRow", function() {
                $(this).closest("tr").remove();
            });

            $('.form-control').on('input', function() {
                $(this).removeClass('is-invalid'); // Menghapus kelas 'is-invalid'
                $(this).siblings('.invalid-feedback').remove(); // Menghapus pesan kesalahan
            });

            $('#mitra').on('change', function() {
                var selected = $(this).val();
                if (selected === 'Lainnya') {
                    $('#namaMitraContainer').slideDown();
                    $('#nama_mitra').prop('required', true);
                } else {
                    $('#namaMitraContainer').slideUp();
                    $('#nama_mitra').val('');
                    $('#nama_mitra').prop('required', false);
                }
            });


            $('.form-control').on('input', function() {
                $(this).removeClass('is-invalid'); // Menghapus kelas 'is-invalid'
                $(this).siblings('.invalid-feedback').remove(); // Menghapus pesan kesalahan
            });
        });

        $(document).ready(function() {
            var currentStep = 1;

            // Function to validate fields of the current step
            function validateStep(step) {
                var valid = true;

                $("#step-" + step + " .form-control").each(function() {
                    var inputField = $(this);

                    // Logika validasi untuk mitra dan nama mitra
                    if (inputField.attr('id') === 'mitra' && inputField.val() === "") {
                        inputField.addClass("is-invalid"); // Add invalid class if mitra is empty
                        $('#nama_mitra').prop('required',
                            false); // Nama Mitra tidak wajib jika mitra kosong
                    } else if (inputField.attr('id') === 'nama_mitra' && inputField.val() === "" && !$(
                            '#mitra').val()) {
                        // Jika mitra kosong dan nama_mitra kosong, beri kesalahan
                        inputField.addClass("is-invalid");
                        valid = false;
                    } else {
                        // Hapus kelas is-invalid jika field tidak kosong
                        inputField.removeClass("is-invalid");
                    }

                    // Pengkondisian untuk validasi field lain yang mungkin kosong
                    if (inputField.val() === "") {
                        inputField.addClass("is-invalid"); // Add invalid class to show error
                        valid = false;
                    } else {
                        inputField.removeClass("is-invalid"); // Remove invalid class if input is filled
                    }
                });

                return valid;
            }

            // Navigate to next step
            $(".next-step").click(function() {
                if (validateStep(currentStep)) {
                    var currentContent = $("#step-" + currentStep);
                    var nextContent = $("#step-" + (currentStep + 1));

                    currentContent.removeClass("active");
                    nextContent.addClass("active");

                    currentStep++;
                    updateStepper();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Form Belum Lengkap',
                        text: 'Silakan isi semua kolom pada langkah ini sebelum melanjutkan.',
                        confirmButtonText: 'Oke'
                    });
                }
            });

            // Navigate to previous step
            $(".prev-step").click(function() {
                var currentContent = $("#step-" + currentStep);
                var prevContent = $("#step-" + (currentStep - 1));

                currentContent.removeClass("active");
                prevContent.addClass("active");

                currentStep--;
                updateStepper();
            });

            // Update the stepper to reflect current step
            function updateStepper() {
                $(".step").removeClass("active");
                $(".step").eq(currentStep - 1).addClass("active");
            }

            // Ensure that nama_mitra is required only if mitra is not selected
            $('#mitra').on('change', function() {
                if ($(this).val() === "") {
                    $('#nama_mitra').prop('required', false); // Nama Mitra tidak wajib jika mitra dipilih
                } else {
                    $('#nama_mitra').prop('required', true); // Nama Mitra wajib jika mitra tidak dipilih
                }
            });

            // Enable or disable the submit button based on validation
            function toggleSubmitButton() {
                var allStepsValid = true;

                // Check if all steps are valid
                $(".form-step").each(function() {
                    var step = $(this).attr('id').replace('step-', '');
                    if (!validateStep(step)) {
                        allStepsValid = false;
                    }
                });

                // Enable/disable submit button based on form validity
                if (allStepsValid) {
                    $('#submit-button').prop('disabled', false);
                } else {
                    $('#submit-button').prop('disabled', true);
                }
            }

            // Check form validity whenever there is an input change
            $(".form-control").on('input', function() {
                toggleSubmitButton();
            });

            // Ensure the submit button is initially checked
            toggleSubmitButton();

            $('#submit-button').click(function(e) {
                e.preventDefault(); // Prevent form from submitting normally

                // Collect form data
                var formData = new FormData($('#multi-step-form')[0]);

                // Show loading spinner (optional)
                Swal.fire({
                    title: 'Menyimpan data...',
                    text: 'Mohon tunggu sebentar.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Send AJAX request
                $.ajax({
                    url: "{{ route('permintaan.store') }}", // Route ke controller
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.close(); // Tutup loading

                        if (response.success) {
                            // Tampilkan alert sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan.',
                                confirmButtonText: 'Lanjut'
                            }).then(() => {
                                window.location.href = response.redirect_url;
                            });
                        } else {
                            // Tampilkan alert gagal (tanpa redirect)
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan, silakan coba lagi.',
                                confirmButtonText: 'Oke'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let messages = '';
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                messages += `• ${value[0]}<br>`;
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal',
                                html: messages,
                                confirmButtonText: 'Perbaiki'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan!',
                                html: xhr.responseJSON?.error ??
                                    'Gagal mengirim data. Silakan coba lagi nanti.',
                                confirmButtonText: 'Oke'
                            });
                        }
                    }

                });
            });
        });
    </script>
@endsection
