@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Buat Form Studi Dampak</h2>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Form Studi Dampak</h6>
        </div>


        <div class="card-body">
            <select name="formTemplates" id="formTemplates" class="form-control mb-2">
                <option value="">Pilih template</option>
                <option value="studidampak">Form Studi Dampak</option>
            </select>
            {{-- Hidden form for storing form data --}}
            <form id="hidden-form" action="" method="post" style="display: none;">
                @csrf
                <input type="hidden" id="form" name="form">
                {{-- <input type="hidden" id="id_pelatihan" name="id_pelatihan" value="{{ $id_pelatihan }}"> --}}
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
                ]
            };

            var container = $(document.getElementById('fb-editor'));
            const templateSelect = document.getElementById("formTemplates");

            // Initialize form builder
            var formBuilderInstance = $(container).formBuilder(options);


            // Templates data
            const templates = {
                studidampak: [{
                    "type": "radio-group",
                    "required": false,
                    "label": "Setelah pelatihan yang anda ikuti, apakah anda mengalami perubahan posisi dalam pekerjaan anda?",
                    "inline": false,
                    "name": "radio-group-1712923959383-0",
                    "other": false,
                    "values": [{
                        "label": "Ya",
                        "value": "Ya",
                        "selected": false
                    }, {
                        "label": "Tidak",
                        "value": "Tidak",
                        "selected": false
                    }]
                }, {
                    "type": "text",
                    "required": false,
                    "label": "Jika ya, sebutkan posisi pekerjaan anda sebelum mengikuti pelatihan",
                    "className": "form-control",
                    "name": "text-1712755105419-0",
                    "subtype": "text"
                }, {
                    "type": "text",
                    "required": false,
                    "label": "Jika ya, sebutkan posisi pekerjaan anda setelah mengikuti pelatihan",
                    "className": "form-control",
                    "name": "text-1712930169882",
                    "subtype": "text"
                }, {
                    "type": "text",
                    "required": false,
                    "label": "Dari materi yang diberikan, topik-topik mana yang langsung dapat digunakan dalam pekerjaan anda?",
                    "className": "form-control",
                    "name": "text-1712755107411",
                    "subtype": "text"
                }, {
                    "type": "text",
                    "required": false,
                    "label": "Dari materi yang diberikan, topik-topik mana yang dapat dimanfaatkan untuk meningkatkan kinerja Unit/ divisi/ departemen/ lembaga anda?",
                    "className": "form-control",
                    "name": "text-1712755106955",
                    "subtype": "text"
                }, {
                    "type": "text",
                    "required": false,
                    "label": "<div>Dari materi yang diberikan, topik-topik mana yang masih merupakan kesulitan dan perlu diperdalam pemahamannya?</div>",
                    "className": "form-control",
                    "name": "text-1712930405787",
                    "subtype": "text"
                }, {
                    "type": "text",
                    "required": false,
                    "label": "<div>Dari materi yang diberikan, topik-topik mana yang dianggap tidak relevan?</div>",
                    "className": "form-control",
                    "name": "text-1712930416026",
                    "subtype": "text"
                }, {
                    "type": "text",
                    "required": false,
                    "label": "<div>Kalau pelatihan yang sama ditawarkan lagi, apakah anda merekomendasikan teman sejawat anda untuk mengikuti atau lembaga anda untuk mengirimkan stafnya?</div>",
                    "className": "form-control",
                    "name": "text-1712930431010",
                    "subtype": "text"
                }, {
                    "type": "text",
                    "required": false,
                    "label": "<div>Untuk semakin meningkatkan kapasitas anda dan lembaga anda, pelatihan-pelatihan apa yang sangat diperlukan?</div>",
                    "className": "form-control",
                    "name": "text-1712930448250",
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
