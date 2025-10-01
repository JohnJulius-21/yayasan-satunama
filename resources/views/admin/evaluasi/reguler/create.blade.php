@extends('layouts.app')

@section('content')
    <style>
        /* Tombol kembali kiri atas */
        .back-icon {
            /* position: fixed; */
            top: 20px;
            left: 20px;
            background-color: #4b5563;
            /* abu-abu */
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            z-index: 100;
        }

        .back-icon:hover {
            background-color: #374151;
        }
    </style>

    <a href="{{ route('evaluasiRegulerAdmin')}}" class="back-icon mb-3"
       title="Kembali">
        ←
    </a>
    <!-- Breadcrumb -->
{{--    <nav aria-label="breadcrumb" class="mb-4">--}}
{{--        <ol class="flex items-center space-x-2 text-sm">--}}
{{--            <li>--}}
{{--                <a href="{{ route('evaluasiRegulerAdmin') }}" class="text-green-600 hover:text-green-800">Evaluasi</a>--}}
{{--            </li>--}}
{{--            <li class="text-gray-500">/</li>--}}
{{--            <li>--}}
{{--                <a href="{{ route('evaluasiShowRegulerAdmin', $reguler->id_reguler) }}" class="text-green-600 hover:text-green-800">Detail Evaluasi</a>--}}
{{--            </li>--}}
{{--            <li class="text-gray-500">/</li>--}}
{{--            <li class="text-gray-700" aria-current="page">Buat Evaluasi Pelatihan Reguler</li>--}}
{{--        </ol>--}}
{{--    </nav>--}}

    <!-- Header -->
    <div class="flex flex-wrap items-center justify-between pt-3 pb-2 mb-3 border-b border-gray-200">
        <h6 class="text-2xl font-medium text-gray-900">Buat Evaluasi Pelatihan Reguler</h6>
    </div>

    <!-- Main Card -->
    <div class="bg-white shadow-lg rounded-lg mb-6">
        <div class="px-6 py-3 border-b border-gray-200">
            <h6 class="text-lg font-semibold text-green-600">Form Evaluasi</h6>
        </div>

        <div class="p-6">
            <!-- Template Selector -->
            <div class="mb-4">
                <label for="formTemplates" class="block text-sm font-medium text-gray-700 mb-2">Pilih Template</label>
                <select name="formTemplates" id="formTemplates"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">Pilih template</option>
                    <option value="eval">Evaluasi Form</option>
                </select>
            </div>

            {{-- Hidden form for storing form data --}}
            <form id="hidden-form" action="{{ route('evaluasiStoreRegulerAdmin') }}" method="post" class="hidden">
                @csrf
                <input type="hidden" id="form" name="form">
                <input type="hidden" id="id_reguler" name="id_reguler" value="{{ $reguler->id_reguler }}">
            </form>

            {{-- Form builder container --}}
            <div class="mb-6">
                <div id="form-builder-container" class="border border-gray-300 rounded-lg overflow-auto" style="height: 600px;">
                    <div id="fb-editor" class="p-4"></div>
                </div>
            </div>

            {{-- Action buttons --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('evaluasiShowRegulerAdmin', $reguler->id_reguler) }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    Kembali
                </a>
                <button id="save-button"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/ui-lightness/jquery-ui.min.css">

    <!-- JavaScript Dependencies - Load in correct order -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Form Builder Dependencies -->
    <script>
        // Wait for jQuery UI to load completely
        $(document).ready(function() {
            // Check if jQuery UI is properly loaded
            if (typeof $.ui === 'undefined') {
                console.error('jQuery UI failed to load, trying alternative CDN...');

                // Try alternative CDN
                $.getScript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js')
                    .done(function() {
                        console.log('jQuery UI loaded from alternative CDN');
                        loadFormBuilder();
                    })
                    .fail(function() {
                        console.error('All jQuery UI CDNs failed');
                        Swal.fire({
                            icon: 'error',
                            title: 'Dependency Error',
                            text: 'Gagal memuat jQuery UI. Silakan refresh halaman.',
                            confirmButtonColor: '#10b981'
                        });
                    });
            } else {
                console.log('jQuery UI loaded successfully');
                loadFormBuilder();
            }
        });

        function loadFormBuilder() {
            // Now load form builder after jQuery UI is confirmed
            $.getScript('{{ asset('form-builder/form-builder.min.js') }}')
                .done(function() {
                    console.log('Form Builder loaded successfully');
                    initializeFormBuilder();
                })
                .fail(function() {
                    console.error('Failed to load Form Builder');
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Builder Error',
                        text: 'Gagal memuat Form Builder. Periksa file form-builder.min.js.',
                        confirmButtonColor: '#10b981'
                    });
                });
        }
    </script>

    <script>
        // Wait for all dependencies to load
        $(document).ready(function() {
            // Check if all required libraries are loaded
            if (typeof jQuery === 'undefined') {
                console.error('jQuery is not loaded');
                return;
            }

            if (typeof jQuery.ui === 'undefined') {
                console.error('jQuery UI is not loaded');
                return;
            }

            if (!jQuery.fn.formBuilder) {
                console.error('FormBuilder is not loaded');
                // Show user-friendly error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error Loading Form Builder',
                    text: 'Unable to load the form builder. Please check if all required files are present.',
                    confirmButtonColor: '#10b981'
                });
                return;
            }

            console.log('All dependencies loaded successfully');
            initializeFormBuilder();
        });

        function initializeFormBuilder() {
            var options = {
                controlOrder: [
                    'header',
                    'text',
                    'textarea',
                    'radio-group',
                    'checkbox-group',
                    'select'
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
                ],
                // Add i18n configuration to prevent language file loading issues
                i18n: {
                    locale: 'en-US',
                    location: 'https://formbuilder.online/assets/lang/'
                },
                // Disable sortable if jQuery UI sortable is not available
                sortableControls: typeof jQuery.fn.sortable !== 'undefined'
            };

            var container = $('#fb-editor');
            const templateSelect = document.getElementById("formTemplates");

            try {
                // Initialize form builder with error handling
                var formBuilderInstance = container.formBuilder(options);
                console.log('FormBuilder initialized successfully');

                // Templates data
                const templates = {
                    eval: [
                        {
                            "type": "radio-group",
                            "required": true,
                            "label": "1. Apakah Anda puas dengan pelatihan ini?",
                            "inline": false,
                            "name": "radio-group-1752133451853",
                            "other": false,
                            "values": [
                                {
                                    "label": "Tidak Puas",
                                    "value": "Tidak Puas",
                                    "selected": false
                                },
                                {
                                    "label": "Kurang Puas",
                                    "value": "Kurang Puas",
                                    "selected": false
                                },
                                {
                                    "label": "Cukup Puas",
                                    "value": "Cukup Puas",
                                    "selected": false
                                },
                                {
                                    "label": "Puas",
                                    "value": "Puas",
                                    "selected": false
                                },
                                {
                                    "label": "Sangat Puas",
                                    "value": "Sangat Puas",
                                    "selected": false
                                }
                            ]
                        },
                        {
                            "type": "textarea",
                            "required": true,
                            "label": "2. Berikan Alasannya",
                            "className": "form-control",
                            "name": "textarea-1752133802774-0",
                            "subtype": "textarea"
                        },
                        {
                            "type": "radio-group",
                            "required": true,
                            "label": "3. Seberapa relevan topik-topik yang dibahas di Pelatihan Monitoring, Evaluasi dan Learning (MEL)",
                            "inline": false,
                            "name": "radio-group-1752133472421",
                            "other": false,
                            "values": [
                                {
                                    "label": "Tidak Relevan",
                                    "value": "Tidak Relevan",
                                    "selected": false
                                },
                                {
                                    "label": "Kurang Relevan",
                                    "value": "Kurang Relevan",
                                    "selected": false
                                },
                                {
                                    "label": "Cukup Relevan",
                                    "value": "Cukup Relevan",
                                    "selected": false
                                },
                                {
                                    "label": "Relevan",
                                    "value": "Relevan",
                                    "selected": false
                                },
                                {
                                    "label": "Sangat relevan",
                                    "value": "Sangat relevan",
                                    "selected": false
                                }
                            ]
                        },
                        {
                            "type": "textarea",
                            "required": true,
                            "label": "4. Berikan Alasannya",
                            "className": "form-control",
                            "name": "textarea-1752133837680",
                            "subtype": "textarea"
                        },
                        {
                            "type": "textarea",
                            "required": true,
                            "label": "5. Untuk Pelatihan Monitoring, Evaluasi dan Learning (MEL), pertanyaan atau tanggapan apa, yang masih ingin Anda sampaikan kepada pihak SATUNAMA?",
                            "className": "form-control",
                            "name": "textarea-1752133852927",
                            "subtype": "textarea"
                        },
                        {
                            "type": "textarea",
                            "required": true,
                            "label": "6. Untuk Pelatihan Monitoring, Evaluasi dan Learning (MEL), topik apa yang menurut Anda paling menginspirasi dan perlu untuk ditindak lanjuti, dan apa alasannya? (Boleh jawab lebih dari satu topik).",
                            "className": "form-control",
                            "name": "textarea-1752134288614",
                            "subtype": "textarea"
                        },
                        {
                            "type": "textarea",
                            "required": true,
                            "label": "7. Moment apa saja yang meninggalkan kesan baik dari pelatihan ini bagi Anda?",
                            "className": "form-control",
                            "name": "textarea-1752134359728",
                            "subtype": "textarea"
                        },
                        {
                            "type": "textarea",
                            "required": true,
                            "label": "8. Pembelajaran apa saja yang Anda bawa pulang dari pelatihan ini? ",
                            "className": "form-control",
                            "name": "textarea-1752134469233",
                            "subtype": "textarea"
                        },
                        {
                            "type": "radio-group",
                            "required": true,
                            "label": "9. Penilaian Anda atas fasilitasi akomodasi dan logistik pelatihan. Skala 1 (Rendah) - 5 (Tinggi)",
                            "inline": true,
                            "name": "ruang_kelas",
                            "other": false,
                            "values": [
                                {
                                    "label": "1",
                                    "value": "1",
                                    "selected": false
                                },
                                {
                                    "label": "2",
                                    "value": "2",
                                    "selected": false
                                },
                                {
                                    "label": "3",
                                    "value": "3",
                                    "selected": false
                                },
                                {
                                    "label": "4",
                                    "value": "4",
                                    "selected": false
                                },
                                {
                                    "label": "5",
                                    "value": "5",
                                    "selected": false
                                }
                            ]
                        },
                        {
                            "type": "textarea",
                            "required": true,
                            "label": "10. Berikan Alasannya",
                            "className": "form-control",
                            "name": "textarea-1752134554189",
                            "subtype": "textarea"
                        },
                        {
                            "type": "radio-group",
                            "required": true,
                            "label": "11. Penilaian Anda atas penyelenggara dalam mengorganisir (dari persiapan sampai dengan pelaksanaan), dan hal yang perlu diperbaiki untuk penyelenggaraan pelatihan yang akan datang: Skala 1 (Rendah) - 5 (Tinggi)",
                            "inline": true,
                            "name": "radio-group-1752134578179",
                            "other": false,
                            "values": [
                                {
                                    "label": "1",
                                    "value": "1",
                                    "selected": false
                                },
                                {
                                    "label": "2",
                                    "value": "2",
                                    "selected": false
                                },
                                {
                                    "label": "3",
                                    "value": "3",
                                    "selected": false
                                },
                                {
                                    "label": "4",
                                    "value": "4",
                                    "selected": false
                                },
                                {
                                    "label": "5",
                                    "value": "5",
                                    "selected": false
                                }
                            ]
                        },
                        {
                            "type": "textarea",
                            "required": true,
                            "label": "12. Saran perbaikan untuk Pelatihan ini",
                            "className": "form-control",
                            "name": "textarea-1752134630356",
                            "subtype": "textarea"
                        },
                        {
                            "type": "textarea",
                            "required": true,
                            "label": "13. Adakah usulan Anda untuk pelatihan yang akan datang?",
                            "className": "form-control",
                            "name": "textarea-1752134651746",
                            "subtype": "textarea"
                        },
                        {
                            "type": "radio-group",
                            "required": true,
                            "label": "14. Apakah anda akan merekomendasikan orang lain untuk mengikuti pelatihan ini ?",
                            "inline": false,
                            "name": "rekomendasi_pelatihan",
                            "other": false,
                            "values": [
                                {
                                    "label": "Ya",
                                    "value": "Ya",
                                    "selected": false
                                },
                                {
                                    "label": "Tidak",
                                    "value": "Tidak",
                                    "selected": false
                                }
                            ]
                        },
                        {
                            "type": "text",
                            "required": true,
                            "label": "15. Jika ya, sebutkan nama, lembaga dan kontak yang bisa dihubungi:",
                            "className": "form-control",
                            "name": "kontak",
                            "subtype": "text"
                        }
                    ]
                };

                // Event listener for template select
                templateSelect.addEventListener("change", function(e) {
                    if (e.target.value && templates[e.target.value]) {
                        try {
                            formBuilderInstance.actions.setData(templates[e.target.value]);

                            // Show success notification
                            Swal.fire({
                                icon: 'success',
                                title: 'Template dimuat!',
                                text: `Template ${e.target.value} berhasil dimuat`,
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                toast: true,
                                position: 'bottom-end'
                            });
                        } catch (error) {
                            console.error('Error loading template:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Gagal memuat template',
                                confirmButtonColor: '#10b981'
                            });
                        }
                    }
                });

                // Save button click event with confirmation
                $('#save-button').on('click', function() {
                    // Show confirmation dialog
                    Swal.fire({
                        title: 'Simpan Form Evaluasi?',
                        text: "Apakah Anda yakin ingin menyimpan form evaluasi ini?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#10b981',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Simpan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            try {
                                // Get form data
                                var formData = formBuilderInstance.formData;

                                if (!formData || formData.length === 0) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Form Kosong!',
                                        text: 'Silakan buat form terlebih dahulu atau pilih template.',
                                        confirmButtonColor: '#10b981'
                                    });
                                    return;
                                }

                                // Set form data to hidden input
                                $('#form').val(JSON.stringify(formData));

                                // Show loading
                                Swal.fire({
                                    title: 'Menyimpan...',
                                    text: 'Mohon tunggu sebentar',
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                // Submit the hidden form
                                $('#hidden-form').submit();

                            } catch (error) {
                                console.error('Error saving form:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan!',
                                    text: 'Gagal menyimpan form. Silakan coba lagi.',
                                    confirmButtonColor: '#10b981'
                                });
                            }
                        }
                    });
                });

            } catch (error) {
                console.error('Error initializing FormBuilder:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Initialization Error',
                    text: 'Gagal menginisialisasi form builder. Periksa console untuk detail error.',
                    confirmButtonColor: '#10b981'
                });
            }
        }

        // Add custom CSS for form builder to match Tailwind design
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                #fb-editor .form-control {
                    width: 100%;
                    padding: 0.5rem 0.75rem;
                    border: 1px solid #d1d5db;
                    border-radius: 0.375rem;
                    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                }

                #fb-editor .form-control:focus {
                    outline: none;
                    border-color: #10b981;
                    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
                }

                #fb-editor .btn {
                    display: inline-flex;
                    align-items: center;
                    padding: 0.5rem 0.75rem;
                    font-size: 0.875rem;
                    font-weight: 500;
                    border-radius: 0.375rem;
                    text-decoration: none;
                    border: none;
                    cursor: pointer;
                }

                #fb-editor .btn-primary {
                    background-color: #10b981;
                    color: white;
                }

                #fb-editor .btn-primary:hover {
                    background-color: #059669;
                }

                #fb-editor .btn-secondary {
                    background-color: #d1d5db;
                    color: #374151;
                }

                #fb-editor .btn-secondary:hover {
                    background-color: #9ca3af;
                }

                #fb-editor .form-group {
                    margin-bottom: 1rem;
                }

                #fb-editor label {
                    display: block;
                    font-size: 0.875rem;
                    font-weight: 500;
                    color: #374151;
                    margin-bottom: 0.5rem;
                }

                #fb-editor .formbuilder-wrapper {
                    background: #f9fafb;
                    border: 1px solid #e5e7eb;
                    border-radius: 0.5rem;
                    padding: 1rem;
                }
            `)
            .appendTo('head');
    </script>
@endsection
