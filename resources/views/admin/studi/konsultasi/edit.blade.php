@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('studiKonsultasiAdmin') }}" style="color: green !important;">Studi Dampak Konsultasi</a>
            </li>
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('studidampakShowKonsultasiAdmin', $form->id_pelatihan_konsultasi) }}"
                    style="color: green !important;">Detail
                    Studi Dampak Konsultasi </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Survey Pelatihan Konsultasi</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Edit Form Studi Dampak Konsultasi</h6>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Edit Form Evaluasi</h6>
        </div>

        <div class="card-body">

            <form id="hidden-form" action="{{ route('studidampakUpdateKonsultasiAdmin', ['id' => $id]) }}" method="post" style="display: none;">
                @csrf
                <input type="hidden" id="form" name="form">
                <input type="hidden" name="id_pelatihan" value="{{ $id }}">

                {{-- <input type="hidden" id="id_pelatihan" name="id_pelatihan"> --}}

            </form>

            <div id="form-builder-container" style="overflow: auto; height: 600px;">
                <div id="fb-editor"></div>
            </div>


            <button id="save-button" class="btn btn-success mt-3">Simpan</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    <script>
        jQuery(function($) {
            var options = {
                // scrollToFieldOnAdd: true,
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

            var container = $('#fb-editor');

            // Initialize form builder with options
            var formBuilderPromise = new Promise(function(resolve, reject) {
                var formBuilder = $(container).formBuilder(options);

                formBuilder.promise.then(function() {
                    resolve(formBuilder);
                }).catch(function(error) {
                    reject(error);
                });
            });

            // Load form data when the page is ready
            formBuilderPromise.then(function(formBuilder) {
                $.ajax({
                    url: "{{ route('studidampakEditKonsultasiAdmin', ['id' => $id]) }}",
                    type: 'GET',
                    success: function(data) {
                        if (data && data.content) {
                            console.log('Content:', data.content);

                            // Set evaluation data to the form builder
                            formBuilder.actions.setData(data.content);
                        } else {
                            console.error(
                                'Failed to retrieve evaluation data or data is empty.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }).catch(function(error) {
                console.error('Error:', error);
            });


            // Save button click event
            $('#save-button').on('click', function() {
                // Get form data
                var formData = $(document.getElementById('fb-editor')).formBuilder('getData');

                // Set form data to hidden input
                $('#form').val(JSON.stringify(formData));

                // Submit the hidden form
                $('#hidden-form').submit();
            });
        });
    </script>
@endsection
