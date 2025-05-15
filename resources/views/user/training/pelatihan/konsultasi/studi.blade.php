@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $konsultasi->nama_pelatihan }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('konsultasi.pelatihan.show') }}">Pelatihan Saya</a></li>
                    <li><a
                            href="{{ route('konsultasi.pelatihan.list', $konsultasi->nama_pelatihan) }}">{{ $konsultasi->nama_pelatihan }}</a>
                    </li>
                    <li class="current">Evaluasi Pelatihan</li>
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
                    <h4>Form Studi Dampak</h4>
                </div>
                <div class="col-lg-12">
                    <div class="php-email-form">
                        @if ($sudahMengisi)
                            <!-- Tampilkan pesan jika user sudah mengisi evaluasi -->
                            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset('images/icon5.png') }}" alt="Hero Image"
                                    style="max-width:400px; height:auto">
                                <h5>Anda telah mengisi Form Studi Dampak.</h5>
                            </div>
                        @elseif (!empty($formData) && is_array($formData) && count($formData) > 0)
                            <form id="form-eval" action="{{ route('konsultasi.pelatihan.studi.store') }}" method="POST">
                                @csrf
                                <!-- Tambahkan input hidden dengan nilai dari $formData -->
                                {{-- <input type="hidden" name="formData" value="{{ $formData }}"> --}}
                                <!-- Tambahkan input lainnya sesuai kebutuhan -->
                                <input type="hidden" name="form_source" value="pelatihan">
                                <input type="hidden" id="data_respons" name="data_respons">
                                <input type="hidden" name="id_pelatihan_konsultasi"
                                    value="{{ $konsultasi->id_pelatihan_konsultasi }}">
                                <input type="hidden" id="id_peserta" name="id_peserta" value="{{ $peserta->id_peserta }}">
                                {{-- <input type="hidden" id="data_respons" name="data_respons"> --}}
                                {{-- <input type="submit" value="Submit" class="btn btn-success"> --}}
                                <div id="stepContainer"></div>

                                <div class="mt-4">
                                    <button type="button" class="btn btn-secondary" id="prevBtn"
                                        style="display: none;">Previous</button>
                                    <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                                    <button type="submit" class="btn btn-success" id="submitBtn"
                                        style="display: none;">Submit</button>
                                </div>
                            </form>
                        @else
                            <!-- Tampilkan pesan jika form tidak tersedia -->
                            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset('images/nopelatihan.png') }}" alt="Hero Image"
                                    style="max-width:400px; height:auto">
                                <h5>Form Studi Dampak Belum ada.</h5>
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
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        jQuery(function($) {
            var formData = {!! json_encode($formData) !!}; // Menggunakan PHP Blade untuk menyisipkan data JSON
            var fbRender = $('#stepContainer');
            var currentStep = 0;
            var totalSteps = formData.length;
            var userData = {}; // Menyimpan jawaban user

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
                    if (!name) return;

                    if ($(this).is(':radio')) {
                        if ($(this).is(':checked')) {
                            userData[name] = $(this).val();
                        }
                    } else if ($(this).is(':checkbox')) {
                        if (!userData[name]) userData[name] = [];
                        if ($(this).is(':checked')) {
                            userData[name].push($(this).val());
                        }
                    } else {
                        userData[name] = $(this).val();
                    }
                });

                console.log("Data sementara:", userData); // Debugging
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

            function renderStep(step) {
                fbRender.fadeOut(300, function() {
                    fbRender.empty();
                    var field = formData[step];
                    var fieldDiv = $('<div class="form-eval mb-3"></div>');

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
                            input = $('<input class="form-control">')
                                .attr('type', field.type)
                                .attr('name', field.name);
                            break;
                        case 'textarea':
                            input = $('<textarea class="form-control"></textarea>')
                                .attr('name', field.name);
                            break;
                        case 'radio-group':
                            var radioDiv = $('<div></div>');
                            field.values.forEach(function(value) {
                                var radio = $('<input class="form-check-input">')
                                    .attr('type', 'radio')
                                    .attr('name', field.name)
                                    .val(value.value);
                                if (userData[field.name] === value.value) {
                                    radio.prop('checked', true);
                                }
                                var radioLabel = $('<label class="form-check-label"></label>')
                                    .text(value.label);
                                radioDiv.append($('<div class="form-check"></div>').append(radio)
                                    .append(radioLabel));
                            });
                            fieldDiv.append(radioDiv);
                            break;
                        case 'checkbox-group':
                            var checkboxDiv = $('<div></div>');
                            field.values.forEach(function(value) {
                                var checkbox = $('<input class="form-check-input">')
                                    .attr('type', 'checkbox')
                                    .attr('name', field.name)
                                    .val(value.value);
                                if (userData[field.name] && userData[field.name].includes(value
                                        .value)) {
                                    checkbox.prop('checked', true);
                                }
                                var checkboxLabel = $('<label class="form-check-label"></label>')
                                    .text(value.label);
                                checkboxDiv.append($('<div class="form-check"></div>').append(
                                    checkbox).append(checkboxLabel));
                            });
                            fieldDiv.append(checkboxDiv);
                            break;
                        case 'select':
                            var select = $('<select class="form-control"></select>').attr('name', field
                                .name);
                            field.values.forEach(function(option) {
                                var optionElement = $('<option></option>')
                                    .attr('value', option.value)
                                    .text(option.label);
                                if (userData[field.name] === option.value) {
                                    optionElement.prop('selected', true);
                                }
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

                    fbRender.append(fieldDiv).fadeIn(300);

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

                saveCurrentStepData(); // Simpan data terakhir sebelum submit

                $('#data_respons').val(JSON.stringify(userData)); // Simpan ke hidden input

                console.log("Data yang akan dikirim:", userData); // Debugging

                $.ajax({
                    url: "{{ route('konsultasi.pelatihan.studi.store') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_pelatihan_konsultasi: "{{ $konsultasi->id_pelatihan_konsultasi }}",
                        id_peserta: "{{ $peserta->id_peserta }}",
                        data_respons: JSON.stringify(userData)
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Form Studi Dampak berhasil disimpan!",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href =
                                "{{ route('konsultasi.pelatihan.list', ['nama_pelatihan' => $konsultasi->nama_pelatihan]) }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Gagal!",
                            text: "Terjadi kesalahan: " + xhr.responseText,
                            icon: "error",
                            confirmButtonText: "Tutup"
                        }).then(() => {
                            window.location.href =
                                "{{ route('konsultasi.pelatihan.studi-dampak', ['id' => $konsultasi->id_pelatihan_konsultasi]) }}";
                        });
                    }
                });
            });
        });
    </script>
@endsection
