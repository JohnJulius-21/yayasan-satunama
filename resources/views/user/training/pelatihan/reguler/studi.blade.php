@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $reguler->nama_pelatihan }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('reguler.pelatihan') }}">Pelatihan Saya</a></li>
                    <li><a href="{{ route('reguler.pelatihan') }}">{{ $reguler->nama_pelatihan }}</a></li>
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
                <div class="col-lg-3">
                    @include('partials.user-routes')
                </div>

                <div class="col-lg-9">
                    <div class="php-email-form">
                        <form id="form-eval" action="" method="POST">
                            @csrf
                            <!-- Tambahkan input hidden dengan nilai dari $formData -->
                            {{-- <input type="hidden" name="formData" value="{{ $formData }}"> --}}
                            <!-- Tambahkan input lainnya sesuai kebutuhan -->
                            <input type="hidden" name="form_source" value="pelatihan">
                            <input type="hidden" id="data_respons" name="data_respons">
                            <input type="hidden" name="id_reguler" value="{{ $reguler->id_reguler }}">
                            <input type="hidden" id="id_user" name="id_user" value="{{ Auth::id() }}">
                            {{-- <input type="hidden" id="data_respons" name="data_respons"> --}}
                            {{-- <input type="submit" value="Submit" class="btn btn-success"> --}}
                            <div id="fb-render"></div>
                            <div class="text-center">
                                <button id="save-button" class="btn btn-success mt-3" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div><!-- End Contact Form -->
            </div>
        </div>


    </section><!-- /Contact Section -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ asset('form-builder/form-render.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        jQuery(function($) {
            var formData = {!! $formData !!}; // Menggunakan PHP Blade untuk menyisipkan data JSON
            var fbRender = $('#fb-render');
            var saveButton = $('#save-button');

            // Render setiap field ke dalam div masing-masing
            formData.forEach(function(field) {
                // Buat div untuk menyimpan field
                var fieldDiv = $('<div class="form-eval"></div>');

                // Tambahkan header dan paragraph ke dalam satu div
                if (field.type === 'header' || field.type === 'paragraph') {
                    var element = $('<' + field.type + '></' + field.type + '>').addClass('form-text').html(
                        field.label);
                    fieldDiv.append(element);
                    // Tambahkan margin antara label dan input
                    fieldDiv.css('margin-bottom', '10px');
                } else {
                    // Tambahkan label jika ada
                    if (field.label) {
                        var label = $('<label></label>').html(field.label);
                        // Tambahkan asterisk (*) jika field required
                        if (field.required) {
                            label.append($('<span>*</span>').css('color', 'red'));
                        }
                        fieldDiv.append(label);
                    }
                }



                // Tambahkan input field
                switch (field.type) {
                    case 'text':
                        var input = $('<input class="form-control"></input>').attr('type', field
                            .type);
                        // Tambahkan atribut lain jika diperlukan
                        if (field.name) {
                            input.attr('name', field.name);
                        }
                        if (field.required) {
                            input.prop('required', true);
                        }
                        fieldDiv.append(input);
                        break;
                    case 'textarea':
                        var textarea = $('<textarea class="form-control form-eval"></textarea>');
                        // Tambahkan atribut lain jika diperlukan
                        if (field.name) {
                            textarea.attr('name', field.name);
                        }
                        if (field.required) {
                            textarea.prop('required', true);
                        }
                        fieldDiv.append(textarea);
                        break;
                    case 'radio-group':
                        // Buat div untuk menyimpan radio button
                        var radioDiv;
                        if (field.inline) {
                            radioDiv = $('<div class="form-group"></div>');
                        } else {
                            radioDiv = $('<div></div>');
                        }

                        // Loop melalui nilai-nilai radio dan tambahkan ke radioDiv
                        field.values.forEach(function(value) {
                            var radio = $('<input class="form-check-input"></input>').attr('type',
                                'radio').attr('name', field.name).val(value.value);
                            if (field.required) {
                                radio.prop('required', true);
                            }
                            var label = $('<label class="form-check-label"></label>').append(radio)
                                .append(value.label);
                            // Buat div baru dengan kelas 'form-check' untuk setiap pasangan radio button dan labelnya jika tidak dalam mode inline
                            if (!field.inline) {
                                var radioItemDiv = $('<div class="form-check"></div>');
                                radioItemDiv.append(label);
                                radioDiv.append(radioItemDiv);
                            } else {
                                if (field.inline) {
                                    label.addClass('form-check-inline');
                                }
                                radioDiv.append(label);
                            }
                        });
                        // Tambahkan radioDiv ke dalam fieldDiv
                        fieldDiv.append(radioDiv);
                        break;
                    case 'check-group':
                        var checkDiv;
                        if (field.inline) {
                            checkDiv = $('<div class="form-group"></div>');
                        } else {
                            checkDiv = $('<div></div>');
                        }

                        field.values.forEach(function(value) {
                            var checkbox = $('<input class="form-check-input"></input>').attr(
                                'type', 'checkbox').attr('name', field.name + '[]').val(value
                                .value);
                            if (field.required) {
                                checkbox.prop('required', true);
                            }
                            var label = $('<label class="form-check-label"></label>').append(
                                checkbox).append(value.label);

                            if (!field.inline) {
                                var checkItemDiv = $('<div class="form-check"></div>');
                                checkItemDiv.append(label);
                                checkDiv.append(checkItemDiv);
                            } else {
                                if (field.inline) {
                                    label.addClass('form-check-inline');
                                }
                                checkDiv.append(label);
                            }
                        });
                        fieldDiv.append(checkDiv);
                        break;

                        // Untuk date field
                    case 'date':
                        var dateInput = $('<input class="form-control"></input>').attr('type', 'date');
                        // Tambahkan atribut lain jika diperlukan
                        if (field.name) {
                            dateInput.attr('name', field.name);
                        }
                        if (field.required) {
                            dateInput.prop('required', true);
                        }
                        fieldDiv.append(dateInput);
                        break;

                        // Untuk select
                    case 'select':
                        var select = $('<select class="form-control"></select>').attr('name', field.name);
                        // Tambahkan atribut lain jika diperlukan
                        if (field.required) {
                            select.prop('required', true);
                        }
                        // Tambahkan opsi select
                        field.values.forEach(function(option) {
                            var optionElement = $('<option></option>').attr('value', option.value)
                                .text(option.label);
                            select.append(optionElement);
                        });
                        fieldDiv.append(select);
                        break;

                        // Untuk file upload
                    case 'file':
                        var fileInput = $('<input class="form-control-file"></input>').attr('type', 'file');
                        // Tambahkan atribut lain jika diperlukan
                        if (field.name) {
                            fileInput.attr('name', field.name);
                        }
                        if (field.required) {
                            fileInput.prop('required', true);
                        }
                        fieldDiv.append(fileInput);
                        break;

                        // Untuk field input number
                    case 'number':
                        var numberInput = $('<input class="form-control"></input>').attr('type', 'number');
                        // Tambahkan atribut lain jika diperlukan
                        if (field.name) {
                            numberInput.attr('name', field.name);
                        }
                        if (field.required) {
                            numberInput.prop('required', true);
                        }
                        fieldDiv.append(numberInput);
                        break;

                        // Handle jenis field lainnya sesuai kebutuhan
                }

                // Tambahkan field ke dalam div render
                fbRender.append(fieldDiv);
            });


            // Lanjutkan pengiriman formulir
            $('#myForm').on('submit', function() {
                var userData = {}; // Data pengguna dari formulir

                // Ambil nilai dari setiap input dan simpan dalam userData
                $('#fb-render input, #fb-render textarea').each(function() {
                    var name = $(this).attr('name');
                    var value = $(this).val();

                    // Periksa apakah input adalah input radio dan apakah dipilih
                    if ($(this).is(':radio') && !$(this).is(':checked')) {
                        // Jika input radio tidak dipilih, jangan masukkan ke dalam userData
                        return; // Lanjutkan ke input berikutnya dalam loop
                    }

                    // Masukkan nilai input ke dalam userData
                    userData[name] = value;
                });

                // Mengubah data respons menjadi string JSON
                var jsonData = JSON.stringify(userData);
                $('#data_respons').val(jsonData);

                console.log(jsonData);

                // Lanjutkan pengiriman formulir
                return true;
            });
        });
    </script>
@endsection
