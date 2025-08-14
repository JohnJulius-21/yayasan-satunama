@extends('layouts.app_user')

@section('title', 'Evaluasi Pelatihan')
@section('page-title', 'Evaluasi Pelatihan')

@section('content')

    <!-- Tambahkan Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Custom radio button yang lebih baik dan jelas */
        .custom-radio {
            width: 24px;
            height: 24px;
            border: 3px solid #22c55e;
            border-radius: 50%;
            position: relative;
            cursor: pointer;
            background-color: white;
            /* Pastikan background putih */
            flex-shrink: 0;
            /* Prevent shrinking */
            margin: 0;
            /* Remove default margin */
            appearance: none;
            /* Remove browser default styling */
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .custom-radio:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
        }

        .custom-radio:hover {
            border-color: #16a34a;
        }

        .custom-radio:checked {
            background-color: #22c55e;
            border-color: #22c55e;
        }

        .custom-radio:checked::after {
            content: '';
            width: 10px;
            height: 10px;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Styling untuk label container */
        .radio-container {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .radio-container:hover {
            border-color: #22c55e;
            background-color: #f0fdf4;
        }

        .radio-container.selected {
            border-color: #22c55e;
            background-color: #f0fdf4;
        }

        /* Text styling */
        .radio-text {
            font-size: 1.125rem;
            line-height: 1.6;
            font-weight: 500;
            color: #374151;
            margin-left: 0.75rem;
        }

        /* Linear Scale Container (seperti Google Forms) */
        .linear-scale-container {
            padding: 1.5rem 0;
        }

        .linear-scale-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .scale-items {
            display: flex;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .scale-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .scale-number {
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
            text-align: center;
            min-width: 2rem;
        }

        .linear-radio-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0.25rem;
        }

        .linear-radio {
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            background-color: white;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            transition: all 0.2s ease;
            position: relative;
            margin: 0;
        }

        .linear-radio:hover {
            border-color: #16a34a;
            transform: scale(1.1);
        }

        .linear-radio:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .linear-radio:checked {
            background-color: #22c55e;
            border-color: #22c55e;
        }

        .linear-radio:checked::after {
            content: '';
            width: 8px;
            height: 8px;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .linear-radio-wrapper.selected .linear-radio {
            background-color: #22c55e;
            border-color: #22c55e;
        }

        .scale-left-label,
        .scale-right-label {
            font-size: 0.875rem;
            color: #6b7280;
            font-weight: 500;
            text-align: center;
            max-width: 120px;
            line-height: 1.3;
        }

        .scale-left-label {
            text-align: right;
        }

        .scale-right-label {
            text-align: left;
        }

        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .linear-scale-wrapper {
                flex-direction: column;
                gap: 1.5rem;
            }

            .scale-items {
                gap: 1.5rem;
            }

            .scale-left-label,
            .scale-right-label {
                max-width: none;
                text-align: center;
            }
        }

        /* Custom radio untuk non-linear */
        .custom-radio {
            width: 24px;
            height: 24px;
            border: 3px solid #22c55e;
            border-radius: 50%;
            position: relative;
            cursor: pointer;
            background-color: white;
            flex-shrink: 0;
            margin: 0;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .custom-radio:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
        }

        .custom-radio:hover {
            border-color: #16a34a;
        }

        .custom-radio:checked {
            background-color: #22c55e;
            border-color: #22c55e;
        }

        .custom-radio:checked::after {
            content: '';
            width: 10px;
            height: 10px;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Scale option untuk grid style */
        .scale-option {
            min-width: 80px;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .scale-option:hover {
            border-color: #22c55e;
            background-color: #f0fdf4;
        }

        .scale-option.selected {
            border-color: #22c55e;
            background-color: #22c55e;
            color: white;
        }

        /* Animasi dan effects */
        .progress-animation {
            transition: width 0.5s ease-in-out;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Animasi smooth untuk progress bar */
        .progress-animation {
            transition: width 0.5s ease-in-out;
        }

        /* Hover effects untuk interaktivitas */
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Skala rating yang lebih visual */
        .scale-option {
            min-width: 80px;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .scale-option:hover {
            border-color: #22c55e;
            background-color: #f0fdf4;
        }

        .scale-option.selected {
            border-color: #22c55e;
            background-color: #22c55e;
            color: white;
        }

        /* Animasi smooth untuk progress bar */
        .progress-animation {
            transition: width 0.5s ease-in-out;
        }

        /* Font size yang lebih besar untuk readability */
        .large-text {
            font-size: 1.125rem;
            line-height: 1.6;
        }

        /* Hover effects untuk interaktivitas */
        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Skala rating yang lebih visual */
        .scale-option {
            min-width: 80px;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .scale-option:hover {
            border-color: #22c55e;
            background-color: #f0fdf4;
        }

        .scale-option.selected {
            border-color: #22c55e;
            background-color: #22c55e;
            color: white;
        }
    </style>

    <!-- Main Content -->
    <section class="py-3 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4">

            @if ($sudahMengisi)
                <!-- Status sudah mengisi -->
                <div class="max-w-2xl mx-auto text-center py-16">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <div class="mb-6">
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Evaluasi Selesai</h2>
                            <p class="text-lg text-gray-600">Terima kasih! Anda telah mengisi form evaluasi.</p>
                        </div>
                    </div>
                </div>
            @elseif (!Auth::check())
                <!-- Belum login -->
                <div class="max-w-2xl mx-auto text-center py-16">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <div class="mb-6">
                            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">Masuk Terlebih Dahulu</h2>
                            <p class="text-lg text-gray-600 mb-6">Silakan masuk ke akun Anda untuk mengisi evaluasi
                                pelatihan.</p>
                            <button data-bs-toggle="modal" data-bs-target="#loginModal"
                                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors">
                                Masuk Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            @elseif (!empty($formData) && is_array($formData) && count($formData) > 0)
                <!-- Form Evaluasi -->
                <div class="max-w-4xl mx-auto">

                    <!-- Header Form dengan Progress -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-2xl font-bold text-gray-800">📝 Form Evaluasi</h2>
                            <div class="text-sm text-gray-500" id="stepInfo">Pertanyaan 1 dari 10</div>
                        </div>

                        <!-- Progress Bar yang lebih menarik -->
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-600">Progress Pengisian</span>
                                <span class="text-sm font-bold text-green-600" id="progressText">0%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div id="evalProgressBar"
                                    class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full progress-animation"
                                    style="width: 0%"></div>
                            </div>
                        </div>

                        <!-- Tips untuk pengguna -->
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        <strong>Petunjuk:</strong> Jawab setiap pertanyaan dengan jujur. Anda dapat kembali
                                        ke pertanyaan sebelumnya jika ingin mengubah jawaban.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Container -->
                    <form action="{{ route('permintaan.pelatihan.evaluasi.store') }}" method="POST" id="form-eval">
                        @csrf
                        <input type="hidden" name="form_source" value="pelatihan">
                        <input type="hidden" id="data_respons" name="data_respons">
                        <input type="hidden" name="id_pelatihan_permintaan" value="{{ $permintaan->id_pelatihan_permintaan }}">

                        @if ($pesertaId)
                            <input type="hidden" id="id_peserta" value="{{ $pesertaId }}">
                        @endif

                        <!-- Step Container dengan styling yang lebih baik -->
                        <div class="bg-white rounded-2xl shadow-lg p-8 mb-6">
                            <div id="stepContainer" class="min-h-[300px]">
                                <!-- Form fields akan dimuat di sini -->
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6">
                            <div
                                class="flex flex-col space-y-4 sm:flex-row sm:justify-between sm:items-center sm:space-y-0">

                                <!-- Previous Button - Hidden on mobile, shown on desktop -->
                                <button type="button"
                                    class="hidden sm:flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition-colors hover-lift"
                                    id="prevBtn">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    Sebelumnya
                                </button>

                                <!-- Main Actions -->
                                <div class="flex flex-col sm:flex-row w-full sm:w-auto space-y-3 sm:space-y-0 sm:space-x-3">
                                    <!-- Previous Button for Mobile -->
                                    {{-- <button type="button"
                                        class="hidden sm:flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition-colors hover-lift"
                                        id="prevBtnMobile">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        Sebelumnya
                                    </button> --}}

                                    <button type="button"
                                        class="flex items-center justify-center px-6 py-3 sm:px-8 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors hover-lift text-sm sm:text-base"
                                        id="nextBtn">
                                        Selanjutnya
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>

                                    <button type="submit"
                                        class="flex items-center justify-center px-6 py-3 sm:px-8 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors hover-lift text-sm sm:text-base"
                                        id="submitBtn" style="display: none;">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Kirim Evaluasi
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="bg-white rounded-2xl shadow-lg p-6">
                            <div class="flex justify-between items-center">
                                <button type="button"
                                    class="flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition-colors hover-lift"
                                    id="prevBtn" style="display: none;">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    Sebelumnya
                                </button>

                                <div class="flex space-x-3">
                                    <button type="button"
                                        class="flex items-center px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors hover-lift"
                                        id="nextBtn">
                                        Selanjutnya
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>

                                    <button type="submit"
                                        class="flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors hover-lift"
                                        id="submitBtn" style="display: none;">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Kirim Evaluasi
                                    </button>
                                </div>
                            </div>
                        </div> --}}
                    </form>
                </div>
            @else
                <!-- Form tidak tersedia -->
                <div class="max-w-2xl mx-auto text-center py-16">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <div class="mb-6">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2">Form Belum Tersedia</h2>
                            <p class="text-lg text-gray-600">Form evaluasi untuk pelatihan ini belum tersedia.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @if ($showLoginModal)
        <script>
            $(document).ready(function() {
                $('#loginModal').modal('show');
            });
        </script>
    @endif

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ asset('form-builder/form-render.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                    .attr('aria-valuenow', percent);

                $('#progressText').text(percent + '%');
                $('#stepInfo').text(`Pertanyaan ${currentStep} dari ${totalSteps}`);
            }

            // Load dari localStorage jika tersedia
            if (localStorage.getItem('eval-user-data')) {
                userData = JSON.parse(localStorage.getItem('eval-user-data'));
            }

            function renderField(field) {
                var fieldDiv = $('<div class="space-y-4"></div>');

                // Label dengan styling yang lebih baik
                if (field.label) {
                    var labelDiv = $('<div class="mb-6"></div>');
                    var label = $('<h3 class="text-xl font-semibold text-gray-800 mb-2"></h3>').html(field.label);
                    if (field.required) {
                        label.append($('<span class="text-red-500 ml-1">*</span>'));
                    }
                    labelDiv.append(label);
                    fieldDiv.append(labelDiv);
                }

                var input;
                switch (field.type) {
                    case 'text':
                    case 'number':
                    case 'date':
                        input = $(
                            '<input class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all large-text">'
                        ).attr('type', field.type).attr('name', field.name);
                        break;

                    case 'textarea':
                        input = $(
                            '<textarea rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all large-text"></textarea>'
                        ).attr('name', field.name);
                        break;

                        // Modifikasi untuk case 'radio-group' - Linear Scale Style
                    case 'radio-group':
                        var isSkala = field.label?.toLowerCase().includes('skala') ||
                            field.name?.toLowerCase().includes('skala') ||
                            field.name?.toLowerCase().includes('linear') ||
                            field.name?.toLowerCase().includes('rating');

                        var isLinear = field.linear === true ||
                            field.name?.toLowerCase().includes('linear') ||
                            (field.values && field.values.length <= 10 && field.values.every(v => !isNaN(v.value)));

                        var radioDiv = $('<div class="space-y-3"></div>');

                        // Jika linear scale (seperti Google Forms)
                        if (isLinear || (isSkala && field.values.length <= 10)) {
                            radioDiv = $('<div class="linear-scale-container"></div>');

                            // Container untuk scale
                            var scaleWrapper = $('<div class="linear-scale-wrapper"></div>');

                            // Label kiri dan kanan (jika ada)
                            var leftLabel = '';
                            var rightLabel = '';

                            // Cari label dari values atau gunakan default
                            if (field.values && field.values.length > 0) {
                                leftLabel = field.values[0].label || field.values[0].value;
                                rightLabel = field.values[field.values.length - 1].label || field.values[field
                                    .values.length - 1].value;
                            }

                            // Jika ada pattern seperti "1 - Sangat tidak setuju" sampai "5 - Sangat setuju"
                            var hasTextLabels = field.values && field.values.some(v =>
                                v.label && v.label.includes('-') || v.label.length > 3
                            );

                            if (hasTextLabels) {
                                // Extract left and right labels from text
                                var firstLabel = field.values[0].label || '';
                                var lastLabel = field.values[field.values.length - 1].label || '';

                                leftLabel = firstLabel.split('-')[1]?.trim() || firstLabel;
                                rightLabel = lastLabel.split('-')[1]?.trim() || lastLabel;
                            }

                            // Left label
                            if (leftLabel && leftLabel !== rightLabel) {
                                scaleWrapper.append($('<div class="scale-left-label"></div>').text(leftLabel));
                            }

                            // Scale items container
                            var scaleItems = $('<div class="scale-items"></div>');

                            field.values.forEach(function(value, index) {
                                var radioId = field.name + '-' + value.value + '-' + index;
                                var radio = $('<input type="radio" class="linear-radio">').attr('name',
                                    field.name).val(value.value).attr('id', radioId);

                                if (userData[field.name] === value.value) {
                                    radio.prop('checked', true);
                                }

                                // Scale item wrapper
                                var scaleItem = $('<div class="scale-item"></div>');

                                // Number/value label
                                var numberLabel = value.value;
                                if (!isNaN(numberLabel)) {
                                    scaleItem.append($('<div class="scale-number"></div>').text(
                                        numberLabel));
                                }

                                // Radio button
                                var radioWrapper = $('<label class="linear-radio-wrapper"></label>')
                                    .attr('for', radioId)
                                    .append(radio);

                                if (userData[field.name] === value.value) {
                                    radioWrapper.addClass('selected');
                                }

                                scaleItem.append(radioWrapper);
                                scaleItems.append(scaleItem);
                            });

                            scaleWrapper.append(scaleItems);

                            // Right label
                            if (rightLabel && rightLabel !== leftLabel) {
                                scaleWrapper.append($('<div class="scale-right-label"></div>').text(rightLabel));
                            }

                            radioDiv.append(scaleWrapper);

                        } else if (isSkala) {
                            // Grid style untuk skala biasa
                            radioDiv = $('<div class="grid grid-cols-2 md:grid-cols-5 gap-3"></div>');

                            field.values.forEach(function(value, index) {
                                var radioId = field.name + '-' + value.value + '-' + index;
                                var radio = $('<input type="radio" class="custom-radio sr-only">').attr(
                                    'name', field.name).val(value.value).attr('id', radioId);

                                if (userData[field.name] === value.value) {
                                    radio.prop('checked', true);
                                }

                                var wrapper = $('<label class="scale-option cursor-pointer block"></label>')
                                    .attr('for', radioId)
                                    .append($('<div class="text-2xl mb-2"></div>').text(value.value))
                                    .append($('<div class="text-sm font-medium"></div>').text(value.label));

                                if (userData[field.name] === value.value) {
                                    wrapper.addClass('selected');
                                }

                                wrapper.prepend(radio);
                                radioDiv.append(wrapper);
                            });

                        } else {
                            // Regular radio buttons (vertical list)
                            field.values.forEach(function(value, index) {
                                var radioId = field.name + '-' + value.value + '-' + index;
                                var radio = $('<input type="radio" class="custom-radio">').attr('name',
                                    field.name).val(value.value).attr('id', radioId);

                                if (userData[field.name] === value.value) {
                                    radio.prop('checked', true);
                                }

                                var wrapper = $(
                                        '<label class="flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-green-300 hover:bg-green-50 cursor-pointer transition-all hover-lift"></label>'
                                    )
                                    .attr('for', radioId)
                                    .append($(
                                        '<span class="large-text font-medium text-gray-700 ml-3"></span>'
                                    ).text(value.label));

                                if (userData[field.name] === value.value) {
                                    wrapper.addClass('border-green-500 bg-green-50');
                                }

                                wrapper.prepend(radio);
                                radioDiv.append(wrapper);
                            });
                        }

                        fieldDiv.append(radioDiv);
                        break;

                        // Event handler yang disederhanakan
                        $(document).on('change', 'input[type="radio"]', function() {
                            var name = $(this).attr('name');

                            // Reset semua wrapper dengan name yang sama
                            $('input[name="' + name + '"]').each(function() {
                                var parentLabel = $(this).closest('label');

                                if (parentLabel.hasClass('scale-option')) {
                                    parentLabel.removeClass('selected');
                                } else {
                                    parentLabel.removeClass('border-green-500 bg-green-50');
                                }
                            });

                            // Set yang dipilih
                            var selectedLabel = $(this).closest('label');
                            if (selectedLabel.hasClass('scale-option')) {
                                selectedLabel.addClass('selected');
                            } else {
                                selectedLabel.addClass('border-green-500 bg-green-50');
                            }
                        });

                        // Event handler yang diperbaiki untuk mendukung linear scale
                        $(document).on('change', 'input[type="radio"]', function() {
                            var name = $(this).attr('name');

                            // Reset semua radio dengan name yang sama
                            $('input[name="' + name + '"]').each(function() {
                                var parentLabel = $(this).closest('label');

                                if (parentLabel.hasClass('scale-option')) {
                                    // Grid scale style
                                    parentLabel.removeClass('selected');
                                } else if (parentLabel.hasClass('linear-radio-wrapper')) {
                                    // Linear scale style
                                    parentLabel.removeClass('selected');
                                } else {
                                    // Regular radio button style
                                    parentLabel.removeClass('border-green-500 bg-green-50');
                                }
                            });

                            // Set yang dipilih
                            var selectedLabel = $(this).closest('label');
                            if (selectedLabel.hasClass('scale-option')) {
                                selectedLabel.addClass('selected');
                            } else if (selectedLabel.hasClass('linear-radio-wrapper')) {
                                selectedLabel.addClass('selected');
                            } else {
                                selectedLabel.addClass('border-green-500 bg-green-50');
                            }
                        });

                        // Tambahan: Hover effect untuk linear radio
                        $(document).on('mouseenter', '.linear-radio', function() {
                            $(this).css('transform', 'scale(1.1)');
                        });

                        $(document).on('mouseleave', '.linear-radio', function() {
                            if (!$(this).is(':checked')) {
                                $(this).css('transform', 'scale(1)');
                            }
                        });
                    case 'checkbox-group':
                        var checkboxDiv = $('<div class="space-y-3"></div>');
                        field.values.forEach(function(value, index) {
                            var checkboxId = field.name + '-' + value.value + '-' + index;
                            var checkbox = $('<input type="checkbox" class="sr-only">').attr('name', field
                                .name).val(value.value).attr('id', checkboxId);

                            if (userData[field.name] && userData[field.name].includes(value.value)) {
                                checkbox.prop('checked', true);
                            }

                            var wrapper = $(
                                    '<label class="flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-green-300 hover:bg-green-50 cursor-pointer transition-all hover-lift"></label>'
                                )
                                .attr('for', checkboxId)
                                .append($(
                                        '<div class="w-6 h-6 border-2 border-green-500 rounded mr-4 flex items-center justify-center"></div>'
                                    )
                                    .append($(
                                        '<svg class="w-4 h-4 text-green-500 opacity-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>'
                                    )))
                                .append($('<span class="large-text font-medium text-gray-700"></span>')
                                    .text(value.label));

                            if (userData[field.name] && userData[field.name].includes(value.value)) {
                                wrapper.addClass('border-green-500 bg-green-50');
                                wrapper.find('svg').addClass('opacity-100');
                            }

                            wrapper.prepend(checkbox);
                            checkboxDiv.append(wrapper);
                        });
                        fieldDiv.append(checkboxDiv);
                        break;

                    case 'select':
                        var select = $(
                            '<select class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all large-text">'
                        ).attr('name', field.name);
                        select.append($('<option value="">Pilih salah satu...</option>'));

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

            // Replace the existing navigation button update logic in your renderCurrentStep() function

            function renderCurrentStep() {
                fbRender.fadeOut(200, function() {
                    fbRender.empty();

                    var currentGroup = groups[currentGroupIndex];
                    var fields = formDataGrouped[currentGroup] || [];

                    // Judul group dengan styling yang lebih baik
                    if (currentGroup) {
                        var groupTitle = $('<div class="mb-8 text-center"></div>');
                        groupTitle.append($('<h2 class="text-2xl font-bold text-green-600 mb-2"></h2>')
                            .text(currentGroup.charAt(0).toUpperCase() + currentGroup.slice(1)));
                        groupTitle.append($('<div class="w-20 h-1 bg-green-600 mx-auto rounded"></div>'));
                        fbRender.append(groupTitle);
                    }

                    var field = fields[currentStepIndex];
                    if (field) {
                        fbRender.append(renderField(field));
                    }

                    // Check if we should show previous button
                    var showPrevButton = currentGroupIndex > 0 || currentStepIndex > 0;

                    // Update both desktop and mobile previous buttons
                    if (showPrevButton) {
                        $('#prevBtn').show(); // Desktop previous button
                        $('#prevBtnMobile').show(); // Mobile previous button
                    } else {
                        $('#prevBtn').hide(); // Desktop previous button  
                        $('#prevBtnMobile').hide(); // Mobile previous button
                    }

                    // Update next/submit buttons
                    $('#nextBtn').show();
                    $('#submitBtn').hide();

                    // Check if this is the last step
                    if (currentGroupIndex === groups.length - 1 && currentStepIndex === fields.length - 1) {
                        $('#nextBtn').hide();
                        $('#submitBtn').show();
                    }

                    checkNextButton();
                    fbRender.fadeIn(200);
                });
            }

            // Event handlers untuk interaktivitas yang lebih baik
            $(document).on('change', 'input[type="radio"]', function() {
                var name = $(this).attr('name');
                $('label[for^="' + name + '"]').removeClass('selected border-green-500 bg-green-50');
                $('label[for^="' + name + '"] .opacity-100').removeClass('opacity-100').addClass(
                    'opacity-0');

                if ($(this).closest('.scale-option').length) {
                    $(this).closest('.scale-option').addClass('selected');
                } else {
                    $(this).closest('label').addClass('border-green-500 bg-green-50');
                    $(this).closest('label').find('.opacity-0').removeClass('opacity-0').addClass(
                        'opacity-100');
                }
            });

            $(document).on('change', 'input[type="checkbox"]', function() {
                var label = $(this).closest('label');
                if ($(this).is(':checked')) {
                    label.addClass('border-green-500 bg-green-50');
                    label.find('svg').addClass('opacity-100');
                } else {
                    label.removeClass('border-green-500 bg-green-50');
                    label.find('svg').removeClass('opacity-100');
                }
            });

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
                        userData[name] = [];
                        $('input[name="' + name + '"]:checked').each(function() {
                            userData[name].push($(this).val());
                        });
                    } else {
                        userData[name] = $(this).val();
                    }
                });
                saveToLocalStorage();
            }

            function saveToLocalStorage() {
                localStorage.setItem('eval-user-data', JSON.stringify(userData));
            }

            function validateStep() {
                var isValid = true;
                var requiredFields = [];

                $('#stepContainer input, #stepContainer textarea, #stepContainer select').each(function() {
                    var name = $(this).attr('name');
                    if (!name) return;

                    if ($(this).is(':radio')) {
                        if (!$('input[name="' + name + '"]:checked').length) {
                            isValid = false;
                            if (requiredFields.indexOf(name) === -1) requiredFields.push(name);
                        }
                    } else if ($(this).is(':checkbox')) {
                        if (!$('input[name="' + name + '"]:checked').length) {
                            isValid = false;
                            if (requiredFields.indexOf(name) === -1) requiredFields.push(name);
                        }
                    } else {
                        if (!$(this).val()) {
                            isValid = false;
                            if (requiredFields.indexOf(name) === -1) requiredFields.push(name);
                        }
                    }
                });
                return isValid;
            }

            function checkNextButton() {
                var isValid = validateStep();
                $('#nextBtn').prop('disabled', !isValid);
                $('#submitBtn').prop('disabled', !isValid);

                if (isValid) {
                    $('#nextBtn').removeClass('opacity-50 cursor-not-allowed');
                    $('#submitBtn').removeClass('opacity-50 cursor-not-allowed');
                } else {
                    $('#nextBtn').addClass('opacity-50 cursor-not-allowed');
                    $('#submitBtn').addClass('opacity-50 cursor-not-allowed');
                }
            }

            $('#stepContainer').on('input change', 'input, textarea, select', function() {
                setTimeout(checkNextButton, 100);
            });

            $('#nextBtn').click(function() {
                if (!validateStep()) {
                    Swal.fire({
                        title: "Perhatian!",
                        text: "Mohon jawab pertanyaan ini sebelum melanjutkan.",
                        icon: "warning",
                        confirmButtonText: "Mengerti",
                        confirmButtonColor: "#22c55e"
                    });
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

            // Also update your previous button click handlers to work with both buttons
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

                if (!validateStep()) {
                    Swal.fire({
                        title: "Perhatian!",
                        text: "Mohon lengkapi semua jawaban sebelum mengirim.",
                        icon: "warning",
                        confirmButtonText: "Mengerti",
                        confirmButtonColor: "#22c55e"
                    });
                    return;
                }

                // Konfirmasi sebelum submit
                Swal.fire({
                    title: "Konfirmasi Pengiriman",
                    text: "Apakah Anda yakin ingin mengirim evaluasi ini? Data yang sudah dikirim tidak dapat diubah lagi.",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#22c55e",
                    cancelButtonColor: "#6b7280",
                    confirmButtonText: "Ya, Kirim",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        saveCurrentStepData();
                        $('#data_respons').val(JSON.stringify(userData));

                        // Show loading
                        Swal.fire({
                            title: "Mengirim...",
                            text: "Mohon tunggu sebentar.",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: "{{ route('permintaan.pelatihan.evaluasi.store') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id_pelatihan_permintaan: '{{ $permintaan->id_pelatihan_permintaan }}',
                                id_peserta: $('#id_peserta').val(),
                                data_respons: JSON.stringify(userData)
                            },
                            success: function(response) {
                                localStorage.removeItem('eval-user-data');
                                Swal.fire({
                                    title: "Berhasil! 🎉",
                                    text: "Evaluasi Anda telah berhasil dikirim. Terima kasih atas partisipasinya!",
                                    icon: "success",
                                    confirmButtonText: "Selesai",
                                    confirmButtonColor: "#22c55e"
                                }).then(() => {
                                    window.location.href =
                                        "{{ route('permintaan.pelatihan.list', ['nama_pelatihan' => $permintaan->nama_pelatihan]) }}";
                                });
                            },
                            error: function(xhr) {
                                var errorMessage =
                                    "Terjadi kesalahan saat mengirim evaluasi.";
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }
                                Swal.fire({
                                    title: "Gagal!",
                                    text: errorMessage,
                                    icon: "error",
                                    confirmButtonText: "Coba Lagi",
                                    confirmButtonColor: "#ef4444"
                                });
                            }
                        });
                    }
                });
            });

            // Initialize
            if (groups.length > 0) {
                renderCurrentStep();
                updateProgressBar();
            } else {
                fbRender.html(
                    '<div class="text-center py-8"><h3 class="text-xl text-gray-600">Tidak ada pertanyaan tersedia.</h3></div>'
                );
            }
        });

        // Auto-save functionality
        setInterval(function() {
            if (typeof userData !== 'undefined' && Object.keys(userData).length > 0) {
                localStorage.setItem('eval-user-data', JSON.stringify(userData));
            }
        }, 30000); // Auto-save setiap 30 detik

        // Konfirmasi sebelum meninggalkan halaman
        window.addEventListener('beforeunload', function(e) {
            if (typeof userData !== 'undefined' && Object.keys(userData).length > 0) {
                e.preventDefault();
                e.returnValue =
                    'Anda memiliki data yang belum tersimpan. Apakah Anda yakin ingin meninggalkan halaman ini?';
            }
        });
    </script>

@endsection
