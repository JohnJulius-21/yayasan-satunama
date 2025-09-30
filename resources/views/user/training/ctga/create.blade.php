<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/stc.png') }}">
    <title>Form Registrasi MS CtGA Batch - 4</title>
    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .blob-orange {
            background: #FF6B47;
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            animation: morph 8s ease-in-out infinite;
        }

        .blob-blue {
            background: #00B8D4;
            border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
            animation: morph 8s ease-in-out infinite reverse;
        }

        .blob-yellow {
            background: #FFB000;
            border-radius: 40% 60% 60% 40% / 60% 30% 60% 40%;
            animation: morph 6s ease-in-out infinite;
        }

        .blob-green {
            background: #7CB342;
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            animation: morph 7s ease-in-out infinite reverse;
        }

        @keyframes morph {
            0% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
                transform: translate3d(0, 0, 0) rotateZ(0deg);
            }
            34% {
                border-radius: 70% 60% 50% 40% / 50% 60% 30% 60%;
                transform: translate3d(30px, -30px, 0) rotateZ(-5deg);
            }
            67% {
                border-radius: 100% 60% 60% 100% / 100% 100% 60% 60%;
                transform: translate3d(-20px, 20px, 0) rotateZ(5deg);
            }
            100% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
                transform: translate3d(0, 0, 0) rotateZ(0deg);
            }
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .glass-effect {
            backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.125);
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        .ctga-orange {
            color: #FF6B47;
        }

        .ctga-blue {
            color: #00B8D4;
        }

        .ctga-green {
            color: #7CB342;
        }

        .ctga-yellow {
            color: #FFB000;
        }

        .bg-ctga-orange {
            background-color: #FF6B47;
        }

        .bg-ctga-blue {
            background-color: #00B8D4;
        }

        .bg-ctga-green {
            background-color: #7CB342;
        }

        .bg-ctga-yellow {
            background-color: #FFB000;
        }
    </style>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 overflow-x-hidden">
<!-- Header -->
<nav class="fixed top-0 left-0 right-0 z-50 glass-effect mb-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <div>
                    <img src="{{ asset('images/ctga-satunama.png') }}"
                         class="h-10 w-auto sm:h-12 md:h-14 object-contain"
                         alt="CTGA Satunama Logo">
                </div>
            </div>

        </div>
    </div>
</nav>

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'bottom-end'
            });
        });
    </script>
@endif
@if (session('warning'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Berhasil!',
                text: "{{ session('warning') }}",
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'bottom-end'
            });
        });
    </script>
@endif

<!-- What We Offer -->
<section id="programs" class="py-20 bg-gradient-to-br from-gray-50 to-green-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-5">
        <div class="text-center mb-16">
            <h5 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Form Registration </h5>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Form ini merupakan formulir pendaftaran untuk organisasi calon peserta Change the Game Academy Batch 4
                tanggal 17 - 22 November 2025.
            </p>
            <p>Pendaftaran ini dibuka mulai tanggal 1 - 24 Oktober 2025</p>
        </div>

        <div class="gap-16 items-start">
            <div class="card bg-white p-6 lg:p-8 rounded-3xl shadow-lg">
                @if(now()->format('Y-m-d') == '2025-10-30')
                    <form id="myForm" method="post" action="{{route('ctga.store')}}" role="form"
                          enctype="multipart/form-data">
                        @csrf

                        <!-- Peserta Sections -->

                        <div class="peserta-section mb-8">

                            <!-- Personal Information Section -->
                            <div class="bg-white rounded-lg p-6 mb-6 border border-gray-100">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="fas fa-user text-green-600"></i>
                                    Informasi Lembaga
                                </h4>

                                <!-- Nama lembaga -->
                                <div class="mb-6">
                                    <label for="nama_lembaga"
                                           class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lembaga <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama_lembaga"
                                           name="nama_lembaga"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("nama_lembaga") border-red-500 bg-red-50 @enderror"
                                           placeholder="Masukkan nama lengkap Lembaga"
                                           value="{{ old("nama_lembaga") }}">
                                    @error("nama_lembaga")
                                    <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <!-- Email & Kontak -->
                                <div class="grid md:grid-cols-2 gap-6 mb-6">
                                    <div>
                                        <label for="email_lembaga"
                                               class="block text-sm font-medium text-gray-700 mb-2">
                                            Email Lembaga <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="email" id="email_lembaga"
                                                   name="email_lembaga"
                                                   class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("email_lembaga") border-red-500 bg-red-50 @enderror"
                                                   placeholder="contoh@email.com"
                                                   value="{{ old("email_lembaga") }}">
                                            <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        </div>
                                        @error("email_lembaga")
                                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="kontak_lembaga"
                                               class="block text-sm font-medium text-gray-700 mb-2">
                                            Kontak Person / PIC <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="tel" id="kontak_lembaga" name="kontak_lembaga"
                                                   class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("kontak_lembaga") border-red-500 bg-red-50 @enderror"
                                                   placeholder="08123456789" maxlength="12"
                                                   value="{{ old("kontak_lembaga") }}">
                                            <i class="fab fa-whatsapp absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                        </div>
                                        @error("kontak_lembaga")
                                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nama Pemimpin lembaga -->
                                <div class="mb-6">
                                    <label for="nama_pemimpin_lembaga"
                                           class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Direktur/Pemimpin/Ketua <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama_pemimpin_lembaga"
                                           name="nama_pemimpin_lembaga"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("nama_pemimpin_lembaga") border-red-500 bg-red-50 @enderror"
                                           placeholder="Masukkan nama lengkap Direktur/Pemimpin/Ketua"
                                           value="{{ old("nama_pemimpin_lembaga") }}">
                                    @error("nama_pemimpin_lembaga")
                                    <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="bg-white rounded-lg p-6 mb-6 border border-gray-100">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="fas fa-user text-green-600"></i>
                                    Legalitas Lembaga
                                </h4>
                                <div class="mb-6">
                                    <label for="legalitas_lembaga"
                                           class="block text-sm font-medium text-gray-700 mb-2">
                                        Upload Legalitas Lembaga <span class="text-red-500">*</span>
                                    </label>
                                    <input type="file" id="legalitas_lembaga"
                                           name="legalitas_lembaga"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("legalitas_lembaga") border-red-500 bg-red-50 @enderror"
                                           placeholder="Masukkan nama lengkap Direktur/Pemimpin/Ketua"
                                           value="{{ old("legalitas_lembaga") }}">
                                    @error("legalitas_lembaga")
                                    <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                    @enderror
                                    <div class="mt-2 text-xs text-gray-500">
                                        <ul class="list-disc list-inside">
                                            <li>File tidak boleh lebih dari 2MB</li>
                                            <li>Format yang diterima: PDF</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Information Section -->
                            <div class="bg-white rounded-lg p-6 mb-6 border border-gray-100">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-green-600"></i>
                                    Alamat Lengkap Lembaga
                                </h4>
                                <p class="text-gray-600 text-sm mb-4">Pilih negara, provinsi, dan kabupaten/kota
                                    asal
                                    Anda</p>

                                <div class="grid md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Negara</label>
                                        <select
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 select2 select-negara @error("id_negara") border-red-500 bg-red-50 @enderror"
                                            name="id_negara"
                                            id="id_negara">
                                            <option value="">Pilih Negara</option>
                                            @foreach ($negara as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old("id_negara") == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_negara }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("id_negara")
                                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                        <select
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 select2 select-provinsi @error("id_provinsi") border-red-500 bg-red-50 @enderror"
                                            name="id_provinsi"
                                            id="id_provinsi">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                        @error("id_provinsi")
                                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                                        <select
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 select2 select-kabupaten @error("id_kabupaten") border-red-500 bg-red-50 @enderror"
                                            name="id_kabupaten"
                                            id="id_kabupaten">
                                            <option value="">Pilih Kota</option>
                                        </select>
                                        @error("id_kabupaten")
                                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Harapan Dari Pelatihan -->
                                <div class="mb-6 mt-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Alamat Lengkap Lembaga <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="alamat_lembaga" rows="4"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 resize-none @error("alamat_lembaga") border-red-500 bg-red-50 @enderror"
                                              placeholder="Alamat lengkap lembaga ...">{{ old("alamat_lembaga") }}</textarea>
                                    @error("alamat_lembaga")
                                    <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Important Notes -->
                            <div class="bg-green-50 border-l-4 border-green-600 p-4 rounded-r-lg mt-6">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-lightbulb text-green-600 mt-1"></i>
                                    <div>
                                        <h5 class="font-semibold text-gray-900 mb-2">Penting untuk
                                            Diperhatikan:</h5>
                                        <ul class="text-sm text-gray-700 space-y-1">
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-info text-green-500 mt-1 text-xs"></i>
                                                <span>Jika anda melakukan salah pengisian dan form terload kembali mohon mengisi kembali field negara, provinsi dan kabupaten/kota dengan cara pada field negara memilih negara kembali maka akan muncul pilihan provinsi dan kota</span>
                                            </li>
                                            <li class="flex items-start gap-2">
                                                <i class="fas fa-check text-green-500 mt-1 text-xs"></i>
                                                <span>Gunakan email pribadi dan kontak person yang aktif agar dapat dihubungi oleh tim kami</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-8">
                            <button type="submit"
                                    class="bg-gradient-to-r from-green-600 to-green-600 text-white px-12 py-4 rounded-xl font-semibold text-lg hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Daftar Pelatihan Sekarang
                            </button>
                        </div>
                    </form>
                @else
                    <h4 class="text-xl text-gray-600 max-w-3xl mx-auto text-center">Form ini telah ditutup</h4>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-white text-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-3 mb-6 md:mb-0">
                <img src="{{asset('images/ctga-satunama.png')}}" class="w-50 h-12">
            </div>

            <div class="text-center md:text-right">
                <p class="text-gray-400 text-sm">
                    Strengthening social changemakers worldwide
                </p>
                <p class="text-gray-400 text-sm">
                    © 2025 Change the Game Academy Alliance
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    /* Custom Select2 Styling untuk Tailwind */
    .select2-container .select2-selection--single {
        height: 50px !important;
        border: 1px solid #d1d5db !important;
        border-radius: 0.5rem !important;
        padding: 0 16px !important;
        background: white !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 48px !important;
        color: #374151 !important;
        font-size: 16px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 48px !important;
        right: 16px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #9ca3af !important;
    }

    .select2-container--default .select2-selection--single:focus {
        border-color: #346a32 !important;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1) !important;
    }

    .select2-dropdown {
        border: 1px solid #d1d5db !important;
        border-radius: 0.5rem !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #3b82f6 !important;
    }

    /* Loading Animation */
    .loading-spinner {
        border: 2px solid #f3f4f6;
        border-top: 2px solid #3b82f6;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    /* Form Animation */
    .form-fade-in {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Progress bar animation */
    .progress-bar {
        background: linear-gradient(90deg, #3b82f6, #60a5fa);
        height: 4px;
        border-radius: 2px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
        transition: width 0.3s ease;
    }
</style>
<script>
    $(document).ready(function () {
        // Add form fade-in animation
        $('.peserta-section').addClass('form-fade-in');

        // Initialize Select2 with custom styling
        $('.select2.select-negara, .select2.select-provinsi, .select2.select-kabupaten').select2({
            theme: 'default',
            width: '100%',
            placeholder: function () {
                return $(this).data('placeholder');
            }
        });

        // Add loading state to selects
        function showSelectLoading(selectElement) {
            selectElement.prop('disabled', true);
            selectElement.siblings('.select2').find('.select2-selection').append('<div class="loading-spinner absolute right-8 top-1/2 transform -translate-y-1/2"></div>');
        }

        function hideSelectLoading(selectElement) {
            selectElement.prop('disabled', false);
            selectElement.siblings('.select2').find('.loading-spinner').remove();
        }

        // Event listener untuk Negara -> Ambil daftar provinsi
        $(document).on('change', '.select-negara', function () {
            var negaraId = $(this).val();
            var provinsiSelect = $('#id_provinsi'); // Langsung pakai ID tanpa index
            var kabupatenSelect = $('#id_kabupaten'); // Langsung pakai ID tanpa index

            // Reset dan loading state
            provinsiSelect.empty().append('<option value="">Pilih Provinsi</option>').trigger('change');
            kabupatenSelect.empty().append('<option value="">Pilih Kota</option>').trigger('change');

            if (negaraId) {
                showSelectLoading(provinsiSelect);

                $.ajax({
                    url: '/get-provinsi/' + negaraId,
                    type: 'GET',
                    success: function (data) {
                        var options = '<option value="">Pilih Provinsi</option>';
                        $.each(data.provinsi, function (key, value) {
                            options += '<option value="' + key + '">' + value + '</option>';
                        });
                        provinsiSelect.html(options).trigger('change');
                        hideSelectLoading(provinsiSelect);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                        hideSelectLoading(provinsiSelect);

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                        Toast.fire({
                            icon: 'error',
                            title: 'Gagal memuat data provinsi'
                        });
                    }
                });
            }
        });

// Event listener untuk Provinsi -> Ambil daftar kabupaten
        $(document).on('change', '.select-provinsi', function () {
            var provinsiId = $(this).val();
            var kabupatenSelect = $('#id_kabupaten'); // Langsung pakai ID tanpa index

            // Reset kabupaten
            kabupatenSelect.empty().append('<option value="">Pilih Kota</option>').trigger('change');

            if (provinsiId) {
                showSelectLoading(kabupatenSelect);

                $.ajax({
                    url: '/get-kabupaten/' + provinsiId,
                    type: 'GET',
                    success: function (data) {
                        var options = '<option value="">Pilih Kota</option>';
                        $.each(data.kabupaten, function (key, value) {
                            options += '<option value="' + key + '">' + value + '</option>';
                        });
                        kabupatenSelect.html(options).trigger('change');
                        hideSelectLoading(kabupatenSelect);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                        hideSelectLoading(kabupatenSelect);

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                        Toast.fire({
                            icon: 'error',
                            title: 'Gagal memuat data kabupaten'
                        });
                    }
                });
            }
        });

        // Remove validation error messages when input is updated
        $('.form-control, select, textarea').on('input change', function () {
            $(this).removeClass('border-red-500 bg-red-50');
            $(this).siblings('.text-red-600').remove();

            // Add success state temporarily
            $(this).addClass('border-green-300');
            setTimeout(() => {
                $(this).removeClass('border-green-300');
            }, 1000);
        });

        // Form submission with loading state
        $('#myForm').on('submit', function () {
            const submitBtn = $(this).find('button[type="submit"]');
            const originalText = submitBtn.html();

            // Show loading state
            submitBtn.prop('disabled', true);
            submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i>Memproses Pendaftaran...');

            // Add progress bar
            $('body').prepend('<div class="progress-bar" style="width: 0%"></div>');

            let progress = 0;
            const progressInterval = setInterval(() => {
                progress += Math.random() * 10;
                if (progress > 90) progress = 90;
                $('.progress-bar').css('width', progress + '%');
            }, 200);

            // Reset on error (this would normally be handled by server response)
            setTimeout(() => {
                clearInterval(progressInterval);
                $('.progress-bar').css('width', '100%');
                setTimeout(() => {
                    $('.progress-bar').remove();
                }, 500);
            }, 2000);
        });

        // Smooth scroll to error fields
        if ($('.border-red-500').length > 0) {
            $('html, body').animate({
                scrollTop: $('.border-red-500').first().offset().top - 100
            }, 1000);
        }

        // Auto-save draft (localStorage alternative - using sessionStorage briefly then clearing)
        const autoSave = () => {
            const formData = $('#myForm').serializeArray();
            // In a real implementation, you'd send this to the server
            console.log('Auto-saving form data...', formData);
        };

        // Auto-save every 30 seconds
        setInterval(autoSave, 30000);

        // Phone number formatting
        $('input[type="tel"]').on('input', function () {
            let value = $(this).val().replace(/\D/g, '');
            if (value.length > 0 && !value.startsWith('08')) {
                if (value.startsWith('8')) {
                    value = '0' + value;
                }
            }
            $(this).val(value);
        });

        // Email validation on blur
        $('input[type="email"]').on('blur', function () {
            const email = $(this).val();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email && !emailRegex.test(email)) {
                $(this).addClass('border-red-500 bg-red-50');
                if (!$(this).siblings('.text-red-600').length) {
                    $(this).after('<p class="text-red-600 text-sm mt-1 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i>Format email tidak valid</p>');
                }
            } else {
                $(this).removeClass('border-red-500 bg-red-50');
                $(this).siblings('.text-red-600').remove();
            }
        });
    });
</script>
</body>
</html>
