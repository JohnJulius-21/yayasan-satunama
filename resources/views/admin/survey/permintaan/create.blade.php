@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('surveyPermintaanAdmin') }}" style="color: green !important;">Survey Kepuasan</a>
            </li>
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('surveyShowPermintaanAdmin', $permintaan->id_pelatihan_permintaan) }}" style="color: green !important;">Detail
                    Survey Kepuasan</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Buat Survey Pelatihan Permintaan</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Buat Form Survey Kepuasan Pelatihan Permintaan</h6>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Form Survey Kepuasan</h6>
        </div>


        <div class="card-body">
            <select name="formTemplates" id="formTemplates" class="form-control mb-2">
                <option value="">Pilih template</option>
                <option value="survey">Form Survey</option>
            </select>
            {{-- Hidden form for storing form data --}}
            <form id="hidden-form" action="{{ route('surveyStorePermintaanAdmin') }}" method="post" style="display: none;">
                @csrf
                <input type="hidden" id="form" name="form">
                <input type="hidden" id="id_pelatihan_permintaan" name="id_pelatihan_permintaan"
                    value="{{ $permintaan->id_pelatihan_permintaan }}">
            </form>

            {{-- Form builder container --}}
            <div id="form-builder-container" style="overflow: auto; height: 600px;">
                <div id="fb-editor"></div>
            </div>

            {{-- Save button --}}
            <button id="save-button" class="btn btn-success mt-3">Simpan</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ asset('form-builder/form-builder.min.js') }}"></script>
    <script>
        jQuery(function($) {
            var options = {
                controlOrder: [
                    'header',
                    'text',
                    'paragraph'
                ],
                disabledActionButtons: [
                    'data',
                    'clear',
                    'save'
                ],
                disabledAttrs: [
                    'name',
                    'placeholder',
                    'value',
                    'access',
                    'class',
                ],
                disableFields: [
                    'autocomplete',
                    'button',
                    'hidden',
                    'number',
                    'file',
                    'paragraph',
                ]
            };

            var container = $(document.getElementById('fb-editor'));
            const templateSelect = document.getElementById("formTemplates");

            // Initialize form builder
            var formBuilderInstance = $(container).formBuilder(options);


            // Templates data
            const templates = {
                survey: [{
                    "type": "radio-group",
                    "required": true,
                    "label": "Seberapa puas anda dengan pelatihan di SATUNAMA?",
                    "inline": true,
                    "name": "tingkat_kepuasan",
                    "other": false,
                    "values": [{
                        "label": "Sangat tidak puas",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Cukup puas",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Puas",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat puas",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "Seberapa cocok dan membantu topik pelatihan yang Anda ikuti dengan pekerjaan Anda?",
                    "inline": true,
                    "name": "kemampuan_merespon_peserta",
                    "other": false,
                    "values": [{
                        "label": "Sangat tidak cocok",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Kurang cocok",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Cocok",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat cocok",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "radio-group",
                    "required": true,
                    "label": "Seberapa relevan fasilitas dengan harga yang Anda bayar untuk pelatihan di SATUNAMA?",
                    "inline": true,
                    "name": "pengembangan_proses",
                    "other": false,
                    "values": [{
                        "label": "Sangat tidak relevan ",
                        "value": "1",
                        "selected": false
                    }, {
                        "label": "Kurang relevan",
                        "value": "2",
                        "selected": false
                    }, {
                        "label": "Relevan",
                        "value": "3",
                        "selected": false
                    }, {
                        "label": "Sangat relevan",
                        "value": "4",
                        "selected": false
                    }]
                }, {
                    "type": "text",
                    "required": true,
                    "label": "Hal penting apa yang Anda ambil dari mengikuti pelatihan di SATUNAMA?",
                    "className": "form-control",
                    "name": "text-1712755105419-0",
                    "subtype": "text"
                }, {
                    "type": "text",
                    "required": true,
                    "label": "Berapa kali Anda mengikuti Pelatihan di SATUNAMA?",
                    "className": "form-control",
                    "name": "text-1712755107411",
                    "subtype": "text"
                }, {
                    "type": "text",
                    "required": true,
                    "label": "Selain di SATUNAMA, apakah Anda pernah mengikuti pelatihan lainnya? Sebutkan lembaga/ instansinya.",
                    "className": "form-control",
                    "name": "text-1712755106955",
                    "subtype": "text"
                }]
            };

            // Event listener for template select
            templateSelect.addEventListener("change", function(e) {
                formBuilderInstance.actions.setData(templates[e.target.value]);
            });

            // Save button click event
            $('#save-button').on('click', function() {
                // Get form data
                var formData = formBuilderInstance.formData;

                // Set form data to hidden input
                $('#form').val(JSON.stringify(formData));

                // Submit the hidden form
                $('#hidden-form').submit();
            });

        });
    </script>
@endsection
