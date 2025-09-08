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

    <a href="{{ route('evaluasiShowRegulerAdmin', $form->id_reguler) }}" class="back-icon mb-3"
       title="Kembali">
        ←
    </a>
{{--    <div class="grid grid-cols-2 gap-4 md:grid-cols-2">--}}
{{--        <div>--}}
{{--            --}}
{{--        </div>--}}
{{--        <div class="justify-content-end">--}}
{{--            <!-- Breadcrumb Navigation -->--}}
{{--            <nav class="" aria-label="breadcrumb">--}}
{{--                <ol class="flex items-center space-x-2 text-sm">--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('evaluasiRegulerAdmin') }}"--}}
{{--                           class="text-green-600 hover:text-green-800 transition-colors duration-200">--}}
{{--                            Evaluasi--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="text-gray-400">--}}
{{--                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">--}}
{{--                            <path fill-rule="evenodd"--}}
{{--                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"--}}
{{--                                  clip-rule="evenodd"></path>--}}
{{--                        </svg>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('evaluasiShowRegulerAdmin', $form->id_reguler) }}"--}}
{{--                           class="text-green-600 hover:text-green-800 transition-colors duration-200">--}}
{{--                            Detail Evaluasi--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="text-gray-400">--}}
{{--                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">--}}
{{--                            <path fill-rule="evenodd"--}}
{{--                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"--}}
{{--                                  clip-rule="evenodd"></path>--}}
{{--                        </svg>--}}
{{--                    </li>--}}
{{--                    <li class="text-gray-600 font-medium">--}}
{{--                        Edit Form Evaluasi Pelatihan Reguler--}}
{{--                    </li>--}}
{{--                </ol>--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Alert Scripts (unchanged) -->
    @if (session('warning'))
        <script>
            $(document).ready(function () {
                $.notify({
                    icon: 'la la-exclamation-triangle',
                    title: 'Peringatan',
                    message: "{{ session('warning') }}"
                }, {
                    type: 'warning',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 4000
                });
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            $(document).ready(function () {
                $.notify({
                    icon: 'la la-info-circle',
                    title: 'Info',
                    message: "{{ session('info') }}"
                }, {
                    type: 'info',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 10000
                });
            });
        </script>
    @endif

    <!-- Page Header -->
    <div class="flex justify-between items-center py-6 mb-6 border-b border-gray-200">
        <h1 class="text-2xl font-bold text-gray-900">Edit Form Evaluasi</h1>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Card Header -->
        <div class="bg-green-50 border-b border-green-100 px-6 py-4">
            <h2 class="text-lg font-semibold text-green-800">Edit Form Evaluasi</h2>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <!-- Hidden Form (unchanged) -->
            <form id="hidden-form" action="{{ route('evaluasiUpdateRegulerAdmin', ['id' => $id]) }}" method="post"
                  style="display: none;">
                @csrf
                <input type="hidden" id="form" name="form">
                <input type="hidden" name="id_reguler" value="{{ $id }}">
            </form>

            <!-- Form Builder Container -->
            <div id="form-builder-container" class="border border-gray-200 rounded-lg overflow-auto bg-gray-50"
                 style="height: 600px;">
                <div id="fb-editor" class="h-full"></div>
            </div>

            {{-- Action buttons --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('evaluasiShowRegulerAdmin', $form->id_reguler) }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    Kembali
                </a>
                <button id="save-button"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                    Update
                </button>
            </div>
        </div>
    </div>

    <!-- CSS Dependencies -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/ui-lightness/jquery-ui.min.css">

    <!-- JavaScript Dependencies - Load in correct order -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Form Builder Dependencies -->
    <script>
        // Wait for jQuery UI to load completely
        $(document).ready(function () {
            // Check if jQuery UI is properly loaded
            if (typeof $.ui === 'undefined') {
                console.error('jQuery UI failed to load, trying alternative CDN...');

                // Try alternative CDN
                $.getScript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js')
                    .done(function () {
                        console.log('jQuery UI loaded from alternative CDN');
                        loadFormBuilder();
                    })
                    .fail(function () {
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
            // Try to load from local first, then fallback to CDN
            $.getScript('{{ asset('form-builder/form-builder.min.js') }}')
                .done(function () {
                    console.log('Form Builder loaded successfully from local');
                    initializeFormBuilder();
                })
                .fail(function () {
                    console.warn('Failed to load local Form Builder, trying CDN...');
                    // Fallback to CDN
                    $.getScript('https://formbuilder.online/assets/js/form-builder.min.js')
                        .done(function () {
                            console.log('Form Builder loaded successfully from CDN');
                            initializeFormBuilder();
                        })
                        .fail(function () {
                            console.error('Failed to load Form Builder from all sources');
                            Swal.fire({
                                icon: 'error',
                                title: 'Form Builder Error',
                                text: 'Gagal memuat Form Builder dari semua sumber. Periksa koneksi internet.',
                                confirmButtonColor: '#10b981'
                            });
                        });
                });
        }

        function initializeFormBuilder() {
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
                Swal.fire({
                    icon: 'error',
                    title: 'Error Loading Form Builder',
                    text: 'Unable to load the form builder. Please check if all required files are present.',
                    confirmButtonColor: '#10b981'
                });
                return;
            }

            console.log('All dependencies loaded successfully');

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

            try {
                // Initialize form builder with error handling
                var formBuilderInstance = container.formBuilder(options);
                console.log('FormBuilder initialized successfully');

                // Load existing form data when the form builder is ready
                formBuilderInstance.promise.then(function () {
                    loadExistingFormData(formBuilderInstance);
                }).catch(function (error) {
                    console.error('Error initializing form builder:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Initialization Error',
                        text: 'Gagal menginisialisasi form builder.',
                        confirmButtonColor: '#10b981'
                    });
                });

                // Save button click event with confirmation
                $('#save-button').on('click', function () {
                    // Show confirmation dialog
                    Swal.fire({
                        title: 'Update Form Evaluasi?',
                        text: "Apakah Anda yakin ingin menyimpan perubahan form evaluasi pelatihan reguler ini?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#10b981',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, Update!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            try {
                                // Get form data using the correct method
                                var formData = $(document.getElementById('fb-editor')).formBuilder('getData');

                                if (!formData || formData.length === 0) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Form Kosong!',
                                        text: 'Form tidak boleh kosong.',
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

        function loadExistingFormData(formBuilderInstance) {
            // Show loading while fetching data
            Swal.fire({
                title: 'Memuat data...',
                text: 'Sedang mengambil data form evaluasi reguler',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('evaluasiEditRegulerAdmin', ['id' => $id]) }}",
                type: 'GET',
                success: function (data) {
                    Swal.close(); // Close loading

                    if (data && data.content) {
                        console.log('Content loaded:', data.content);

                        try {
                            // Set evaluation data to the form builder
                            formBuilderInstance.actions.setData(data.content);

                            // Show success notification
                            Swal.fire({
                                icon: 'success',
                                title: 'Data dimuat!',
                                text: 'Form evaluasi berhasil dimuat',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                toast: true,
                                position: 'bottom-end'
                            });
                        } catch (error) {
                            console.error('Error setting form data:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Gagal memuat data form evaluasi',
                                confirmButtonColor: '#10b981'
                            });
                        }
                    } else {
                        console.error('Failed to retrieve evaluation data or data is empty.');
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Kosong',
                            text: 'Data form evaluasi tidak ditemukan atau kosong.',
                            confirmButtonColor: '#10b981'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.close(); // Close loading
                    console.error('AJAX Error:', error);

                    let errorMessage = 'Terjadi kesalahan saat memuat data';
                    if (xhr.status === 404) {
                        errorMessage = 'Data form evaluasi tidak ditemukan';
                    } else if (xhr.status === 500) {
                        errorMessage = 'Kesalahan server internal';
                    } else if (xhr.status === 403) {
                        errorMessage = 'Akses ditolak';
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage,
                        confirmButtonColor: '#10b981'
                    });
                }
            });
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
                    transition: all 0.2s;
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
                    transition: all 0.2s;
                }

                #fb-editor .btn-primary {
                    background-color: #10b981;
                    color: white;
                }

                #fb-editor .btn-primary:hover {
                    background-color: #059669;
                    transform: translateY(-1px);
                }

                #fb-editor .btn-secondary {
                    background-color: #d1d5db;
                    color: #374151;
                }

                #fb-editor .btn-secondary:hover {
                    background-color: #9ca3af;
                }

                #fb-editor .btn-danger {
                    background-color: #ef4444;
                    color: white;
                }

                #fb-editor .btn-danger:hover {
                    background-color: #dc2626;
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

                /* Custom styling for better visual consistency */
                #fb-editor .stage-wrap {
                    background: white;
                    border-radius: 0.375rem;
                    min-height: 400px;
                    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
                }

                #fb-editor .form-field {
                    margin-bottom: 1rem;
                    padding: 0.75rem;
                    border: 1px solid #e5e7eb;
                    border-radius: 0.375rem;
                    background: white;
                    transition: all 0.2s;
                }

                #fb-editor .form-field:hover {
                    border-color: #10b981;
                    box-shadow: 0 0 0 1px rgba(16, 185, 129, 0.1);
                    transform: translateY(-1px);
                }

                #fb-editor .form-field.editing {
                    border-color: #10b981;
                    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
                }

                /* Improve control buttons */
                #fb-editor .field-actions {
                    display: flex;
                    gap: 0.25rem;
                    align-items: center;
                }

                #fb-editor .del-button,
                #fb-editor .copy-button,
                #fb-editor .edit-form {
                    padding: 0.25rem 0.5rem;
                    font-size: 0.75rem;
                    border-radius: 0.25rem;
                    border: none;
                    cursor: pointer;
                    transition: all 0.2s;
                }

                /* Responsive adjustments */
                @media (max-width: 768px) {
                    #fb-editor .stage-wrap {
                        padding: 0.5rem;
                    }

                    #fb-editor .form-field {
                        padding: 0.5rem;
                    }
                }
            `)
            .appendTo('head');

        // Handle session messages with SweetAlert
        @if (session('warning'))
        $(document).ready(function () {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: "{{ session('warning') }}",
                confirmButtonColor: '#10b981'
            });
        });
        @endif

        @if (session('info'))
        $(document).ready(function () {
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: "{{ session('info') }}",
                confirmButtonColor: '#10b981',
                timer: 4000,
                timerProgressBar: true
            });
        });
        @endif

        @if (session('success'))
        $(document).ready(function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                toast: true,
                position: 'bottom-end'
            });
        });
        @endif

        @if (session('error'))
        $(document).ready(function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonColor: '#10b981'
            });
        });
        @endif
    </script>
@endsection
