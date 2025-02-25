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
                        
                        <div id="stepContainer">
                            <!-- Form Steps -->
                            <form action="" method="POST">
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
                                
                            </form>
                        </div>

                        <div class="mt-4">
                            <button type="button" class="btn btn-secondary" id="prevBtn"
                                style="display: none;">Previous</button>
                            <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                            <button type="submit" class="btn btn-success" id="submitBtn"
                                style="display: none;">Submit</button>
                        </div>

                    </div>
                </div><!-- End Contact Form -->
            </div>
        </div>


    </section><!-- /Contact Section -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ asset('form-builder/form-render.min.js') }}"></script>
    <script>
        jQuery(function($) {
            var formData = {!! $formData !!};
            var fbRender = $('#stepContainer');
            var currentStep = 0;
            var totalSteps = formData.length;

            // Fungsi untuk menampilkan field dengan animasi
            function renderStep(step) {
                fbRender.fadeOut(300, function() {
                    fbRender.empty(); // Hapus field sebelumnya
                    var field = formData[step];
                    var fieldDiv = $('<div class="form-eval mb-3"></div>');

                    // Tambahkan label jika ada
                    if (field.label) {
                        var label = $('<label></label>').html(field.label);
                        if (field.required) label.append($('<span>*</span>').css('color', 'red'));
                        fieldDiv.append(label);
                    }

                    // Tambahkan input field berdasarkan jenis field
                    switch (field.type) {
                        case 'text':
                        case 'number':
                        case 'date':
                            var input = $('<input class="form-control">').attr('type', field.type).attr(
                                'name', field.name);
                            if (field.required) input.prop('required', true);
                            fieldDiv.append(input);
                            break;
                        case 'textarea':
                            var textarea = $('<textarea class="form-control"></textarea>').attr('name',
                                field.name);
                            if (field.required) textarea.prop('required', true);
                            fieldDiv.append(textarea);
                            break;
                        case 'radio-group':
                            var radioDiv = $('<div></div>');
                            field.values.forEach(function(value) {
                                var radio = $('<input class="form-check-input">').attr('type',
                                    'radio').attr('name', field.name).val(value.value);
                                var radioLabel = $('<label class="form-check-label"></label>').text(
                                    value.label);
                                radioDiv.append($('<div class="form-check"></div>').append(radio)
                                    .append(radioLabel));
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

                    fbRender.append(fieldDiv).fadeIn(300); // Animasi fade-in setelah konten diupdate

                    // Perbarui tombol navigasi
                    $('#prevBtn').toggle(step > 0);
                    $('#nextBtn').toggle(step < totalSteps - 1);
                    $('#submitBtn').toggle(step === totalSteps - 1);
                });
            }

            // Tampilkan langkah pertama
            renderStep(currentStep);

            // Navigasi antar langkah
            $('#nextBtn').click(function() {
                if (currentStep < totalSteps - 1) {
                    currentStep++;
                    renderStep(currentStep);
                }
            });

            $('#prevBtn').click(function() {
                if (currentStep > 0) {
                    currentStep--;
                    renderStep(currentStep);
                }
            });

            // Handle form submission
            $('#form-eval').on('submit', function() {
                var userData = {};

                // Ambil semua nilai input dari setiap langkah
                $('#stepContainer input, #stepContainer textarea, #stepContainer select').each(function() {
                    var name = $(this).attr('name');
                    if (name) {
                        var value = $(this).val();
                        if ($(this).is(':radio') && !$(this).is(':checked')) return;
                        userData[name] = value;
                    }
                });

                $('#data_respons').val(JSON.stringify(userData));
                console.log(userData);
                return true;
            });
        });
    </script>
@endsection
