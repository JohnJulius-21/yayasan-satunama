@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $permintaan->nama_pelatihan }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('permintaan.pelatihan.show') }}">Pelatihan Saya</a></li>
                    <li><a
                            href="{{ route('permintaan.pelatihan.list', $permintaan->nama_pelatihan) }}">{{ $permintaan->nama_pelatihan }}</a>
                    </li>
                    <li class="current">Survey Kepuasan Pelatihan</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">

                <div>
                    <h4>Form Survey Kepuasan</h4>
                </div>
                <div class="col-lg-12">
                    <div class="php-email-form">
                        @if ($sudahMengisi)
                            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset('images/icon5.png') }}" alt="Hero Image"
                                    style="max-width:400px; height:auto">
                                <h5>Anda telah mengisi Form Survey Kepuasan.</h5>
                            </div>
                        @elseif (!empty($formData) && is_array($formData) && count($formData) > 0)
                            <form id="myForm" method="post" role="form"
                                action="">
                                @csrf
                                <input type="hidden" name="form_source" value="pelatihan">
                                <input type="hidden" id="data_respons" name="data_respons">
                                {{-- <input type="hidden" name="id_permintaan_pelatihan" value="{{ $permintaan->id_permintaan_pelatihan }}"> --}}
                                <input type="hidden" id="id_peserta" name="id_peserta"
                                    value="{{ $peserta->id_peserta }}">

                                <div id="stepContainer">
                                    <div class="step" id="step-0">
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="button" class="btn btn-secondary" id="prevBtn"
                                        style="display: none;">Previous</button>
                                    <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                                    <button type="submit" class="btn btn-success" id="submitBtn"
                                        style="display: none;">Submit</button>
                                </div>
                            </form>
                        @else
                            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset('images/nopelatihan.png') }}" alt="Hero Image"
                                    style="max-width:400px; height:auto">
                                <h5>Form Survey Belum ada.</h5>
                            </div>
                        @endif
                    </div>
                </div><!-- End Contact Form -->
            </div>
        </div>


    </section><!-- /Contact Section -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ asset('form-builder/form-render.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        jQuery(function($) {
            var formData = {!! json_encode($formData) !!};
            var fbRender = $('#stepContainer');
            var currentStep = 0;
            var totalSteps = formData.length + 1; // Tambah 1 untuk form lokasi peserta
            var userData = {}; // Menyimpan data input

            // Mencegah form terkirim ketika menekan Enter dalam input
            $(document).on("keydown", "input, textarea", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault(); // Mencegah submit form

                    if ($("#nextBtn").is(":visible") && !$("#nextBtn").prop("disabled")) {
                        $("#nextBtn").click(); // Jika tombol Next tersedia, lanjut ke step berikutnya
                    }
                }
            });

            renderStep(currentStep);

            function saveCurrentStepData() {
                $('#stepContainer input, #stepContainer textarea, #stepContainer select').each(function() {
                    var name = $(this).attr('name');

                    if (name) {
                        var value;
                        if ($(this).is(':radio')) {
                            if ($(this).is(':checked')) {
                                value = $(this).val();
                            } else {
                                return;
                            }
                        } else if ($(this).is(':checkbox')) {
                            if ($(this).is(':checked')) {
                                value = $(this).val();
                            } else {
                                return;
                            }
                        } else {
                            value = $(this).val();
                        }

                        userData[name] = value;
                    }
                });

                console.log("Data sementara:", userData);
            }

            function validateStep() {
                var isValid = true;
                $('#stepContainer input, #stepContainer textarea, #stepContainer select').each(function() {
                    var name = $(this).attr('name');
                    if (!name) return;

                    if ($(this).is(':radio')) {
                        if (!$('input[name="' + name + '"]:checked').length) {
                            isValid = false;
                        }
                    } else if ($(this).is(':checkbox')) {
                        if (!$('input[name="' + name + '"]:checked').length) {
                            isValid = false;
                        }
                    } else {
                        if (!$(this).val()) {
                            isValid = false;
                        }
                    }
                });

                return isValid;
            }


            // Pastikan event handler tetap bekerja meskipun elemen di-refresh
            $(document).on('change', '#id_negara', function() {
                var negaraId = $(this).val();
                $('#id_provinsi, #id_kabupaten').html('<option value="">Pilih</option>').trigger('change');

                if (negaraId) {
                    $.ajax({
                        url: '/get-provinsi-survey/' + negaraId,
                        type: 'GET',
                        success: function(data) {
                            var options = '<option value="">Pilih Provinsi</option>';
                            $.each(data.provinsi, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#id_provinsi').html(options).trigger('change');
                        }
                    });
                }
            });

            $(document).on('change', '#id_provinsi', function() {
                var provinsiId = $(this).val();
                $('#id_kabupaten').html('<option value="">Pilih Kota</option>').trigger('change');

                if (provinsiId) {
                    $.ajax({
                        url: '/get-kabupaten-survey/' + provinsiId,
                        type: 'GET',
                        success: function(data) {
                            var options = '<option value="">Pilih Kota</option>';
                            $.each(data.kabupaten, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#id_kabupaten').html(options).trigger('change');
                        }
                    });
                }
            });

            function renderStep(step) {
                fbRender.fadeOut(300, function() {
                    fbRender.empty();

                    if (step === 0) {
                        // Form Lokasi Peserta sebagai langkah pertama
                        var locationForm = `
                    <div class="form-survey">
                        <h6>Asal Daerah Peserta Pelatihan</h6>
                        <span class="entry-content">Negara, Provinsi & Kabupaten/Kota</span>
                        <div class="form-group mb-2">
                            <div class="row mt-3">
                                <div class="col-md-4 form-group">
                                    <select class="form-select" name="id_negara" id="id_negara">
                                        <option value="">Pilih Negara</option>
                                        @foreach ($negara as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['nama_negara'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 form-group mt-3 mt-md-0">
                                    <select class="form-select" name="id_provinsi" id="id_provinsi">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group mt-3 mt-md-0">
                                    <select class="form-select" name="id_kabupaten" id="id_kabupaten">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                        fbRender.append(locationForm);
                    } else {
                        // Menampilkan langkah survey dari formData
                        var field = formData[step - 1];
                        var fieldDiv = $('<div class="myform mb-3"></div>');

                        if (field.label) {
                            var label = $('<label></label>').html(field.label);
                            if (field.required) label.append($('<span>*</span>').css('color', 'red'));
                            fieldDiv.append(label);
                        }

                        var input;
                        switch (field.type) {
                            case 'text':
                            case 'number':
                            case 'date':
                                input = $('<input class="form-control">').attr('type', field.type).attr(
                                    'name', field.name);
                                break;
                            case 'textarea':
                                input = $('<textarea class="form-control"></textarea>').attr('name', field
                                    .name);
                                break;
                            case 'radio-group':
                                var radioDiv = $('<div></div>');
                                field.values.forEach(function(value) {
                                    var radio = $('<input class="form-check-input">')
                                        .attr('type', 'radio')
                                        .attr('name', field.name)
                                        .val(value.value);
                                    var radioLabel = $('<label class="form-check-label"></label>')
                                        .text(value.label);
                                    radioDiv.append($('<div class="form-check"></div>').append(
                                        radio).append(radioLabel));
                                });
                                fieldDiv.append(radioDiv);
                                break;
                            case 'select':
                                var select = $('<select class="form-control"></select>').attr('name', field
                                    .name);
                                field.values.forEach(function(option) {
                                    var optionElement = $('<option></option>').attr('value', option
                                        .value).text(option.label);
                                    select.append(optionElement);
                                });
                                fieldDiv.append(select);
                                break;
                        }

                        if (input) {
                            if (userData[field.name]) {
                                input.val(userData[field.name]);
                            }
                            fieldDiv.append(input);
                        }

                        fbRender.append(fieldDiv);
                    }

                    fbRender.fadeIn(300);

                    $('#prevBtn').toggle(step > 0);
                    $('#nextBtn').toggle(step < totalSteps - 1);
                    $('#submitBtn').toggle(step === totalSteps - 1);
                    checkNextButton();
                });
            }

            function checkNextButton() {
                $('#nextBtn').prop('disabled', !validateStep());
            }

            $('#stepContainer').on('input change', 'input, textarea, select', function() {
                checkNextButton();
            });

            renderStep(currentStep);

            $('#nextBtn').click(function() {
                if (!validateStep()) {
                    alert("Harap isi semua pertanyaan sebelum melanjutkan.");
                    return;
                }

                saveCurrentStepData();
                if (currentStep < totalSteps - 1) {
                    currentStep++;
                    renderStep(currentStep);
                }
            });

            $('#prevBtn').click(function() {
                saveCurrentStepData();
                if (currentStep > 0) {
                    currentStep--;
                    renderStep(currentStep);
                }
            });



            $('#submitBtn').click(function(e) {
                e.preventDefault();
                saveCurrentStepData();
                $('#data_respons').val(JSON.stringify(userData));

                console.log("Data yang akan dikirim:", userData);

                $.ajax({
                    url: "{{ route('permintaan.pelatihan.survey.store') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_pelatihan_permintaan: "{{ $permintaan->id_pelatihan_permintaan }}",
                        id_peserta: "{{ $peserta->id_peserta }}",
                        data_respons: JSON.stringify(userData)
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Form Survey Kepuasan berhasil disimpan!",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href =
                                "{{ route('permintaan.pelatihan.list', ['nama_pelatihan' => $permintaan->nama_pelatihan]) }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Gagal!",
                            text: "Terjadi kesalahan: " + xhr.responseText,
                            icon: "error",
                            confirmButtonText: "Tutup"
                        });
                    }
                });
            });


        });
    </script>
@endsection
