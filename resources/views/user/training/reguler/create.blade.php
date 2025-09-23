@extends('layouts.main')

@section('content')
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                <h1 class="text-3xl font-bold text-gray-900">Form Reguler</h1>
                <nav class="text-sm text-gray-600">
                    <ol class="flex items-center space-x-2">
                        <li><a href="#" class="hover:text-green-600 transition-colors">Beranda</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li><a href="#" class="hover:text-green-600 transition-colors">Pelatihan</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li><a href="#" class="hover:text-green-600 transition-colors">Detail Pelatihan</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li class="text-green-600 font-medium">Form Reguler</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-green-600 to-green-600 px-6 py-8 text-white">
                    <div class="flex items-center gap-3">
                        <div class="bg-white/20 p-3 rounded-full">
                            <i class="fas fa-user-graduate text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold">Form Pendaftaran Pelatihan Reguler</h2>
                            <p class="text-green-100 mt-1">Lengkapi data peserta dengan teliti</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-6 lg:p-8">
                    <form id="myForm" method="post" action="{{ route('reguler.store') }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id_reguler" name="id_reguler" value="{{ $reguler->id_reguler }}">
                        <input type="hidden" id="id_user" name="id_user" value="{{ Auth::id() }}">

                        <!-- Progress Indicator -->
                        <div class="mb-8">
                            <div class="flex items-center justify-center mb-4">
                                <div class="bg-green-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <p class="text-center text-gray-600">Mengisi data untuk <span class="font-semibold text-green-600">{{ $jumlahPeserta }} peserta</span></p>
                        </div>

                        <!-- Peserta Sections -->
                        @for ($i = 1; $i <= $jumlahPeserta; $i++)
                            <div class="peserta-section mb-8 bg-gray-50 rounded-xl p-6 border border-gray-200">
                                <!-- Peserta Header -->
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="bg-green-600 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold">
                                        {{ $i }}
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-900">Peserta {{ $i }}</h3>
                                </div>

                                <!-- Personal Information Section -->
                                <div class="bg-white rounded-lg p-6 mb-6 border border-gray-100">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                        <i class="fas fa-user text-green-600"></i>
                                        Informasi Personal
                                    </h4>

                                    <!-- Nama Peserta -->
                                    <div class="mb-6">
                                        <label for="nama_peserta_{{ $i }}" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Lengkap Peserta <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="nama_peserta_{{ $i }}" name="peserta[{{ $i }}][nama_peserta]"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("peserta.{$i}.nama_peserta") border-red-500 bg-red-50 @enderror"
                                               placeholder="Masukkan nama lengkap Anda"
                                               value="{{ old("peserta.{$i}.nama_peserta") }}">
                                        @error("peserta.{$i}.nama_peserta")
                                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <!-- Email & Kontak -->
                                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                                        <div>
                                            <label for="email_peserta_{{ $i }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                Email Peserta <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <input type="email" id="email_peserta_{{ $i }}" name="peserta[{{ $i }}][email_peserta]"
                                                       class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("peserta.{$i}.email_peserta") border-red-500 bg-red-50 @enderror"
                                                       placeholder="contoh@email.com"
                                                       value="{{ old("peserta.{$i}.email_peserta") }}">
                                                <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                            </div>
                                            @error("peserta.{$i}.email_peserta")
                                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="no_hp_{{ $i }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                Kontak WhatsApp <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <input type="tel" id="no_hp_{{ $i }}" name="peserta[{{ $i }}][no_hp]"
                                                       class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("peserta.{$i}.no_hp") border-red-500 bg-red-50 @enderror"
                                                       placeholder="08123456789" maxlength="12"
                                                       value="{{ old("peserta.{$i}.no_hp") }}">
                                                <i class="fab fa-whatsapp absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                            </div>
                                            @error("peserta.{$i}.no_hp")
                                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Gender & Usia -->
                                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Gender <span class="text-red-500">*</span>
                                            </label>
                                            <select name="peserta[{{ $i }}][gender]"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("peserta.{$i}.gender") border-red-500 bg-red-50 @enderror">
                                                <option value="">Pilih Gender</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                                <option value="Transgender">Transgender</option>
                                                <option value="Tidak ingin menyebutkan">Tidak ingin menyebutkan</option>
                                            </select>
                                            @error("peserta.{$i}.gender")
                                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Rentang Usia <span class="text-red-500">*</span>
                                            </label>
                                            <select name="peserta[{{ $i }}][rentang_usia]"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("peserta.{$i}.rentang_usia") border-red-500 bg-red-50 @enderror">
                                                <option value="">Pilih Rentang Usia</option>
                                                <option value="20-25">20-25 tahun</option>
                                                <option value="26-30">26-30 tahun</option>
                                                <option value="31-35">31-35 tahun</option>
                                                <option value="36-40">36-40 tahun</option>
                                                <option value="41-45">41-45 tahun</option>
                                                <option value="46-50">46-50 tahun</option>
                                                <option value="> 50">Lebih dari 50 tahun</option>
                                            </select>
                                            @error("peserta.{$i}.rentang_usia")
                                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Location Information Section -->
                                <div class="bg-white rounded-lg p-6 mb-6 border border-gray-100">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                        <i class="fas fa-map-marker-alt text-green-600"></i>
                                        Asal Daerah Peserta
                                    </h4>
                                    <p class="text-gray-600 text-sm mb-4">Pilih negara, provinsi, dan kabupaten/kota asal Anda</p>

                                    <div class="grid md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Negara</label>
                                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 select2 select-negara @error("peserta.{$i}.id_negara") border-red-500 bg-red-50 @enderror"
                                                    name="peserta[{{ $i }}][id_negara]"
                                                    id="id_negara_{{ $i }}"
                                                    data-index="{{ $i }}">
                                                <option value="">Pilih Negara</option>
                                                @foreach ($negara as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old("peserta.{$i}.id_negara") == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_negara }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("peserta.{$i}.id_negara")
                                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 select2 select-provinsi @error("peserta.{$i}.id_provinsi") border-red-500 bg-red-50 @enderror"
                                                    name="peserta[{{ $i }}][id_provinsi]"
                                                    id="id_provinsi_{{ $i }}"
                                                    data-index="{{ $i }}">
                                                <option value="">Pilih Provinsi</option>
                                            </select>
                                            @error("peserta.{$i}.id_provinsi")
                                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 select2 select-kabupaten @error("peserta.{$i}.id_kabupaten") border-red-500 bg-red-50 @enderror"
                                                    name="peserta[{{ $i }}][id_kabupaten]"
                                                    id="id_kabupaten_{{ $i }}"
                                                    data-index="{{ $i }}">
                                                <option value="">Pilih Kota</option>
                                            </select>
                                            @error("peserta.{$i}.id_kabupaten")
                                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Organization Information Section -->
                                <div class="bg-white rounded-lg p-6 mb-6 border border-gray-100">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                        <i class="fas fa-building text-green-600"></i>
                                        Informasi Organisasi
                                    </h4>

                                    <!-- Nama Organisasi -->
                                    <div class="mb-6">
                                        <label for="nama_organisasi_{{ $i }}" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Organisasi <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="nama_organisasi_{{ $i }}" name="peserta[{{ $i }}][nama_organisasi]"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("peserta.{$i}.nama_organisasi") border-red-500 bg-red-50 @enderror"
                                               placeholder="Masukkan Nama Organisasi Anda"
                                               value="{{ old("peserta.{$i}.nama_organisasi") }}">
                                        @error("peserta.{$i}.nama_organisasi")
                                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                                        <!-- Jenis Organisasi -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Jenis Organisasi <span class="text-red-500">*</span>
                                            </label>
                                            <select name="peserta[{{ $i }}][organisasi]" id="organisasi_{{ $i }}"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("peserta.{$i}.organisasi") border-red-500 bg-red-50 @enderror">
                                                <option value="">Pilih Jenis Organisasi</option>
                                                <option value="Personal" {{ old("peserta.{$i}.organisasi") == 'Personal' ? 'selected' : '' }}>Personal</option>
                                                <option value="Pemerintah" {{ old("peserta.{$i}.organisasi") == 'Pemerintah' ? 'selected' : '' }}>Pemerintah</option>
                                                <option value="Lembaga Pendidikan" {{ old("peserta.{$i}.organisasi") == 'Lembaga Pendidikan' ? 'selected' : '' }}>Lembaga Pendidikan</option>
                                                <option value="Komunitas" {{ old("peserta.{$i}.organisasi") == 'Komunitas' ? 'selected' : '' }}>Komunitas</option>
                                                <option value="Organisasi Nirlaba" {{ old("peserta.{$i}.organisasi") == 'Organisasi Nirlaba' ? 'selected' : '' }}>Organisasi Nirlaba</option>
                                                <option value="Perusahaan" {{ old("peserta.{$i}.organisasi") == 'Perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                                                <option value="Partai Politik" {{ old("peserta.{$i}.organisasi") == 'Partai Politik' ? 'selected' : '' }}>Partai Politik</option>
                                            </select>
                                            @error("peserta.{$i}.organisasi")
                                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>

                                        <!-- Jabatan -->
                                        <div>
                                            <label for="jabatan_peserta_{{ $i }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                Jabatan <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" id="jabatan_peserta_{{ $i }}" name="peserta[{{ $i }}][jabatan_peserta]"
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("peserta.{$i}.jabatan_peserta") border-red-500 bg-red-50 @enderror"
                                                   placeholder="Masukkan Jabatan Anda"
                                                   value="{{ old("peserta.{$i}.jabatan_peserta") }}">
                                            @error("peserta.{$i}.jabatan_peserta")
                                            <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Information Section -->
                                <div class="bg-white rounded-lg p-6 border border-gray-100">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                        <i class="fas fa-info-circle text-green-600"></i>
                                        Informasi Tambahan
                                    </h4>

                                    <!-- Sumber Informasi -->
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Sumber Informasi Pelatihan <span class="text-red-500">*</span>
                                        </label>
                                        <select name="peserta[{{ $i }}][informasi]" id="informasi_{{ $i }}"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("peserta.{$i}.informasi") border-red-500 bg-red-50 @enderror">
                                            <option value="">Pilih Sumber Info</option>
                                            <option value="Instagram" {{ old("peserta.{$i}.informasi") == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                            <option value="Website SATUNAMA" {{ old("peserta.{$i}.informasi") == 'Website SATUNAMA' ? 'selected' : '' }}>Website SATUNAMA</option>
                                            <option value="Facebook" {{ old("peserta.{$i}.informasi") == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                            <option value="Whatsapp" {{ old("peserta.{$i}.informasi") == 'Whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                                            <option value="Linkedin" {{ old("peserta.{$i}.informasi") == 'Linkedin' ? 'selected' : '' }}>LinkedIn</option>
                                        </select>
                                        @error("peserta.{$i}.informasi")
                                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <!-- Pelatihan Relevan -->
                                    <div class="mb-6">
                                        <label for="pelatihan_relevan_{{ $i }}" class="block text-sm font-medium text-gray-700 mb-2">
                                            Pelatihan Relevan (Opsional)
                                        </label>
                                        <input type="text" id="pelatihan_relevan_{{ $i }}" name="peserta[{{ $i }}][pelatihan_relevan]"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 @error("peserta.{$i}.pelatihan_relevan") border-red-500 bg-red-50 @enderror"
                                               placeholder="Sebutkan pelatihan relevan yang pernah Anda ikuti"
                                               value="{{ old("peserta.{$i}.pelatihan_relevan") }}">
                                        @error("peserta.{$i}.pelatihan_relevan")
                                        <p class="text-red-600 text-sm mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <!-- Harapan Dari Pelatihan -->
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Harapan Dari Pelatihan <span class="text-red-500">*</span>
                                        </label>
                                        <textarea name="peserta[{{ $i }}][harapan_pelatihan]" rows="4"
                                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all duration-200 resize-none @error("peserta.{$i}.harapan_pelatihan") border-red-500 bg-red-50 @enderror"
                                                  placeholder="Ceritakan harapan dan tujuan Anda mengikuti pelatihan ini...">{{ old("peserta.{$i}.harapan_pelatihan") }}</textarea>
                                        @error("peserta.{$i}.harapan_pelatihan")
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
                                            <h5 class="font-semibold text-gray-900 mb-2">Penting untuk Diperhatikan:</h5>
                                            <ul class="text-sm text-gray-700 space-y-1">
                                                <li class="flex items-start gap-2">
                                                    <i class="fas fa-check text-green-500 mt-1 text-xs"></i>
                                                    <span>Nama lengkap akan digunakan untuk sertifikat pelatihan, pastikan penulisan sudah benar</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <i class="fas fa-check text-green-500 mt-1 text-xs"></i>
                                                    <span>Gunakan email pribadi yang aktif untuk akses materi pelatihan</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor

                        <!-- Submit Button -->
                        <div class="text-center mt-8">
                            <button type="submit" class="bg-gradient-to-r from-green-600 to-green-600 text-white px-12 py-4 rounded-xl font-semibold text-lg hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Daftar Pelatihan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
            border-color: #3b82f6 !important;
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
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
        $(document).ready(function() {
            // Add form fade-in animation
            $('.peserta-section').addClass('form-fade-in');

            // Initialize Select2 with custom styling
            $('.select2.select-negara, .select2.select-provinsi, .select2.select-kabupaten').select2({
                theme: 'default',
                width: '100%',
                placeholder: function() {
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
            $(document).on('change', '.select-negara', function() {
                var index = $(this).data('index');
                var negaraId = $(this).val();
                var provinsiSelect = $('#id_provinsi_' + index);
                var kabupatenSelect = $('#id_kabupaten_' + index);

                // Reset dan loading state
                provinsiSelect.empty().append('<option value="">Pilih Provinsi</option>').trigger('change');
                kabupatenSelect.empty().append('<option value="">Pilih Kota</option>').trigger('change');

                if (negaraId) {
                    showSelectLoading(provinsiSelect);

                    $.ajax({
                        url: '/get-provinsi/' + negaraId,
                        type: 'GET',
                        success: function(data) {
                            var options = '<option value="">Pilih Provinsi</option>';
                            $.each(data.provinsi, function(key, value) {
                                options += '<option value="' + key + '">' + value + '</option>';
                            });
                            provinsiSelect.html(options).trigger('change');
                            hideSelectLoading(provinsiSelect);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                            hideSelectLoading(provinsiSelect);

                            // Show error notification
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
            $(document).on('change', '.select-provinsi', function() {
                var index = $(this).data('index');
                var provinsiId = $(this).val();
                var kabupatenSelect = $('#id_kabupaten_' + index);

                // Reset kabupaten
                kabupatenSelect.empty().append('<option value="">Pilih Kota</option>').trigger('change');

                if (provinsiId) {
                    showSelectLoading(kabupatenSelect);

                    $.ajax({
                        url: '/get-kabupaten/' + provinsiId,
                        type: 'GET',
                        success: function(data) {
                            var options = '<option value="">Pilih Kota</option>';
                            $.each(data.kabupaten, function(key, value) {
                                options += '<option value="' + key + '">' + value + '</option>';
                            });
                            kabupatenSelect.html(options).trigger('change');
                            hideSelectLoading(kabupatenSelect);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                            hideSelectLoading(kabupatenSelect);

                            // Show error notification
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
            $('.form-control, select, textarea').on('input change', function() {
                $(this).removeClass('border-red-500 bg-red-50');
                $(this).siblings('.text-red-600').remove();

                // Add success state temporarily
                $(this).addClass('border-green-300');
                setTimeout(() => {
                    $(this).removeClass('border-green-300');
                }, 1000);
            });

            // Form submission with loading state
            $('#myForm').on('submit', function() {
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
            $('input[type="tel"]').on('input', function() {
                let value = $(this).val().replace(/\D/g, '');
                if (value.length > 0 && !value.startsWith('08')) {
                    if (value.startsWith('8')) {
                        value = '0' + value;
                    }
                }
                $(this).val(value);
            });

            // Email validation on blur
            $('input[type="email"]').on('blur', function() {
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
@endsection
