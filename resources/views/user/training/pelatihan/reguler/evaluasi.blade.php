@extends('layouts.user')

@section('content')

    <style>
        /* Gaya radio dengan border lebih tebal */
        .form-check-input[type="radio"] {
            width: 18px;
            height: 18px;
            border: 2px solid #198754;
            /* tebal dan warna hijau */
            padding: 0;
        }

        .form-check-input[type="radio"]:checked {
            background-color: #198754;
            /* warna saat dipilih */
            border-color: #198754;
        }

        .form-check-label {
            margin-left: 6px;
            font-weight: 500;
        }

        .form-check.inline-scale {
            display: inline-block;
            margin-right: 1rem;
            text-align: center;
        }

        .progress {
            height: 20px;
            background-color: #e9ecef;
        }

        .progress-bar {
            transition: width 0.4s ease;
            font-weight: bold;
        }
    </style>

    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $reguler->nama_pelatihan }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('reguler.pelatihan') }}">Pelatihan Saya</a></li>
                    <li><a
                            href="{{ route('reguler.pelatihan.list', $reguler->nama_pelatihan) }}">{{ $reguler->nama_pelatihan }}</a>
                    </li>
                    <li class="current">Evaluasi Pelatihan</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                {{-- <div class="col-lg-3">
                    @include('partials.user-routes')
                </div> --}}


                <div>
                    <h4>Form Evaluasi</h4>
                </div>

                <div class="mb-3">
                    <h6>Progress Pertanyaan</h6>
                    <div class="progress">
                        <div id="evalProgressBar" class="progress-bar bg-success" role="progressbar"
                            style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="php-email-form">
                        
                        @if ($sudahMengisi)
                            <!-- Tampilkan pesan jika user sudah mengisi evaluasi -->
                            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset('images/icon5.png') }}" alt="Hero Image"
                                    style="max-width:400px; height:auto">
                                <h5>Anda telah mengisi Form Evaluasi.</h5>
                            </div>
                        @elseif (!Auth::check())
                            <!-- Jika belum login, tampilkan trigger untuk modal login -->
                            <div class="text-center" style="margin-top: 2rem;">
                                <p>Silakan <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"
                                        style="cursor:pointer; text-decoration: underline; color:rgb(17, 100, 42);">login
                                        terlebih
                                        dahulu</a> untuk mengisi form evaluasi.</p>
                            </div>
                        @elseif (!empty($formData) && is_array($formData) && count($formData) > 0)
                            <!-- Tampilkan Form Evaluasi jika user sudah login dan belum mengisi -->
                            <form action="{{ route('reguler.pelatihan.evaluasi.store') }}" method="POST" id="form-eval">
                                @csrf
                                <input type="hidden" name="form_source" value="pelatihan">
                                <input type="hidden" id="data_respons" name="data_respons">
                                <input type="hidden" name="id_reguler" value="{{ $reguler->id_reguler }}">

                                @if ($pesertaId)
                                    <input type="hidden" id="id_peserta" value="{{ $pesertaId }}">
                                @endif

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
                                <h5>Form Evaluasi Belum ada.</h5>
                            </div>
                        @endif

                        @push('scripts')
                            <script>
                                // Ketika klik link login, buka modal login yang sudah ada dengan id #loginModal
                                document.getElementById('loginTrigger')?.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                                    loginModal.show();
                                });
                            </script>
                        @endpush


                    </div>
                </div><!-- End Contact Form -->
            </div>
        </div>
    </section><!-- /Contact Section -->

    @if ($showLoginModal)
        <script>
            $(document).ready(function() {
                $('#loginModal').modal('show');
            });
        </script>
    @endif






    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ asset('form-builder/form-render.min.js') }}"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        jQuery(function($) {
            var formDataGrouped = {!! json_encode($formData) !!};
            var fbRender = $('#stepContainer');
            var groups = Object.keys(formDataGrouped || {});
            var currentGroupIndex = 0;
            var currentStepIndex = 0;
            var userData = {};

            function updateProgressBar() {
                let totalSteps = 0;
                let currentStep = 0;

                groups.forEach((group, groupIndex) => {
                    const fields = formDataGrouped[group] || [];
                    totalSteps += fields.length;

                    if (groupIndex < currentGroupIndex) {
                        currentStep += fields.length;
                    } else if (groupIndex === currentGroupIndex) {
                        currentStep += currentStepIndex + 1;
                    }
                });

                let percent = Math.round((currentStep / totalSteps) * 100);
                $('#evalProgressBar')
                    .css('width', percent + '%')
                    .attr('aria-valuenow', percent)
                    .text(percent + '%');
            }


            // Load dari localStorage jika tersedia
            if (localStorage.getItem('eval-user-data')) {
                userData = JSON.parse(localStorage.getItem('eval-user-data'));
            }


            function renderField(field) {
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
                        input = $('<input class="form-control">').attr('type', field.type).attr('name', field.name);
                        break;
                    case 'textarea':
                        input = $('<textarea class="form-control"></textarea>').attr('name', field.name);
                        break;
                    case 'radio-group':
                        var isSkala = field.label?.toLowerCase().includes('skala') || field.name?.toLowerCase()
                            .includes('skala');

                        var radioDiv = $('<div></div>');
                        if (isSkala) {
                            radioDiv.addClass('d-flex gap-2 justify-content-between'); // inline style
                        }

                        field.values.forEach(function(value) {
                            var radio = $('<input class="form-check-input">')
                                .attr('type', 'radio')
                                .attr('name', field.name)
                                .val(value.value)
                                .attr('id', field.name + '-' + value.value);

                            if (userData[field.name] === value.value) {
                                radio.prop('checked', true);
                            }

                            var radioLabel = $('<label class="form-check-label text-center"></label>')
                                .attr('for', field.name + '-' + value.value)
                                .text(value.label);

                            var wrapper = $('<div class="form-check"></div>')
                                .append(radio)
                                .append(radioLabel);

                            if (isSkala) {
                                wrapper.css({
                                    flex: '1',
                                    display: 'flex',
                                    flexDirection: 'column',
                                    alignItems: 'center'
                                });
                            }

                            radioDiv.append(wrapper);
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
                            if (userData[field.name] && userData[field.name].includes(value.value)) {
                                checkbox.prop('checked', true);
                            }
                            var checkboxLabel = $('<label class="form-check-label"></label>').text(value
                                .label);
                            checkboxDiv.append($('<div class="form-check"></div>').append(checkbox).append(
                                checkboxLabel));
                        });
                        fieldDiv.append(checkboxDiv);
                        break;
                    case 'select':
                        var select = $('<select class="form-control"></select>').attr('name', field.name);
                        field.values.forEach(function(option) {
                            var optionElement = $('<option></option>').attr('value', option.value).text(
                                option.label);
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
                return fieldDiv;
            }

            function renderCurrentStep() {
                fbRender.fadeOut(300, function() {
                    fbRender.empty();

                    var currentGroup = groups[currentGroupIndex];
                    var fields = formDataGrouped[currentGroup] || [];

                    // Judul group
                    fbRender.append($('<h5></h5>').text(currentGroup.charAt(0).toUpperCase() + currentGroup
                        .slice(1)));

                    var field = fields[currentStepIndex];
                    if (field) {
                        fbRender.append(renderField(field));
                    }

                    $('#prevBtn').toggle(currentGroupIndex > 0 || currentStepIndex > 0);
                    $('#nextBtn').toggle(true);
                    $('#submitBtn').toggle(false);

                    // Jika sudah di akhir group dan field terakhir, tampilkan submit
                    if (currentGroupIndex === groups.length - 1 && currentStepIndex === fields.length - 1) {
                        $('#nextBtn').hide();
                        $('#submitBtn').show();
                    }

                    checkNextButton();
                    fbRender.fadeIn(300);
                });
            }

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
                saveToLocalStorage();
                console.log("Data sementara:", userData);
            }

            function saveToLocalStorage() {
                localStorage.setItem('eval-user-data', JSON.stringify(userData));
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

            function checkNextButton() {
                $('#nextBtn').prop('disabled', !validateStep());
            }

            $('#stepContainer').on('input change', 'input, textarea, select', function() {
                checkNextButton();
            });

            $('#nextBtn').click(function() {
                if (!validateStep()) {
                    alert("Harap isi semua pertanyaan sebelum melanjutkan.");
                    return;
                }
                saveCurrentStepData();

                var currentGroup = groups[currentGroupIndex];
                var fields = formDataGrouped[currentGroup];

                if (currentStepIndex < fields.length - 1) {
                    currentStepIndex++;
                } else if (currentGroupIndex < groups.length - 1) {
                    currentGroupIndex++;
                    currentStepIndex = 0;
                }
                renderCurrentStep();
                updateProgressBar();
            });

            $('#prevBtn').click(function() {
                saveCurrentStepData();

                if (currentStepIndex > 0) {
                    currentStepIndex--;
                } else if (currentGroupIndex > 0) {
                    currentGroupIndex--;
                    var prevGroup = groups[currentGroupIndex];
                    currentStepIndex = (formDataGrouped[prevGroup] || []).length - 1;
                }
                renderCurrentStep();
                updateProgressBar();
            });

            $('#submitBtn').click(function(e) {
                e.preventDefault();
                saveCurrentStepData();

                $('#data_respons').val(JSON.stringify(userData));

                $.ajax({
                    url: "{{ route('reguler.pelatihan.evaluasi.store') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_reguler: '{{ $reguler->id_reguler }}',
                        id_peserta: $('#id_peserta').val(),
                        data_respons: JSON.stringify(userData)
                    },
                    success: function(response) {
                        localStorage.removeItem('eval-user-data');
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Form Evaluasi berhasil disimpan!",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            window.location.href =
                                "{{ route('reguler.pelatihan.list', ['nama_pelatihan' => $reguler->nama_pelatihan]) }}";
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

            renderCurrentStep();
        });
    </script>
@endsection
