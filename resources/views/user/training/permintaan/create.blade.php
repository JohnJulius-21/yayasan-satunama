@extends('layouts.main')
@section('title', 'Form Request Permintaan')
@section('content')
    <!-- Header Section -->
    <div class="bg-white/80 backdrop-blur-md border-b border-gray-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1
                        class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-green-600 to-green-600 bg-clip-text text-transparent">
                        Form Permintaan Training
                    </h1>
                    <p class="text-gray-600 mt-1">Manajemen Pelatihan & Konsultasi</p>
                </div>
                <!-- Breadcrumb -->
                <nav class="hidden sm:flex items-center space-x-2 text-sm">
                    <a href="/" class="text-green-600 hover:text-green-800 transition-colors">Beranda</a>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                    <span class="text-gray-500">Form Permintaan</span>
                </nav>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="multiStepForm()">
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <template x-for="(step, index) in steps" :key="index">
                    <div class="flex flex-col sm:flex-row items-center mb-4 sm:mb-0 relative">
                        <!-- Step Circle -->
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg transition-all duration-300 relative"
                                :class="index + 1 <= currentStep ?
                                    'bg-gradient-to-r from-green-500 to-green-600 shadow-lg scale-110' : 'bg-gray-300'">
                                <i :class="step.icon"
                                   x-show="index + 1 !== currentStep || index + 1 === steps.length"></i>
                                <div x-show="index + 1 === currentStep && index + 1 !== steps.length"
                                     class="animate-bounce-subtle">
                                    <i :class="step.icon"></i>
                                </div>
                                <!-- Progress Ring -->
                                <div x-show="index + 1 === currentStep"
                                     class="absolute inset-0 rounded-full border-2 border-green-300 animate-ping"></div>
                            </div>

                            <!-- Connector Line (Hidden on mobile, shown on larger screens) -->
                            <div x-show="index < steps.length - 1"
                                 class="hidden sm:block w-20 lg:w-32 h-1 mx-4 transition-all duration-500"
                                 :class="index + 1 < currentStep ? 'bg-gradient-to-r from-green-500 to-green-600' : 'bg-gray-300'">
                            </div>
                        </div>

                        <!-- Step Label -->
                        <div
                            class="text-center sm:text-left mt-2 sm:mt-0 sm:absolute sm:top-14 sm:left-1/2 sm:transform sm:-translate-x-1/2 sm:w-32">
                            <p class="text-sm font-medium transition-colors duration-300"
                               :class="index + 1 <= currentStep ? 'text-green-600' : 'text-gray-500'"
                               x-text="step.title">
                            </p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-clipboard-list mr-3"></i>
                    Check List Training & Konsultasi
                </h2>
                <p class="text-green-100 mt-2">Silakan isi formulir berikut dengan lengkap dan benar</p>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8">
{{--                @guest--}}
{{--                    <button id="loginBtn"--}}
{{--                            class="bg-green-700 text-white px-6 py-2 rounded-full hover:bg-green-600 transition-all duration-300 font-medium shadow-md hover:shadow-lg transform hover:scale-105">--}}
{{--                        Masuk atau Daftar--}}
{{--                    </button>--}}
{{--                @endguest--}}
{{--                @auth--}}
                    <form id="multi-step-form" method="post">
                        @csrf
{{--                        <input type="hidden" id="id_user" name="id_user" value="{{ Auth::id() }}">--}}
                        <!-- Step 1: Informasi Mitra -->
                        <div x-show="currentStep === 1" x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-x-4"
                             x-transition:enter-end="opacity-1 transform translate-x-0" class="space-y-6">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Nama Mitra -->
                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                                        <i class="fas fa-building mr-2 text-green-500"></i>Nama Mitra
                                    </label>
                                    <select x-model="formData.id_mitra" @change="toggleCustomMitra" name="id_mitra"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-0 transition-all duration-200 bg-white hover:border-gray-300">
                                        <option value="">Pilih Mitra</option>
                                        @foreach ($mitra as $item)
                                            <option value="{{ $item->id_mitra }}"
                                                {{ old('id_mitra') == $item->id_mitra ? 'seltected' : '' }}>
                                                {{ $item->nama_mitra }}</option>
                                        @endforeach
                                        <option value="Lainnya">Lainnya</option>
                                    </select>

                                    <!-- Custom Mitra Input -->
                                    <div x-show="showCustomMitra" x-transition class="mt-4">
                                        <input x-model="formData.nama_mitra" type="text" name="nama_mitra"
                                               placeholder="Masukan nama Organisasi anda"
                                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-0 transition-all duration-200 bg-gray-50 hover:border-gray-300">
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2 flex items-start">
                                        <i class="fas fa-info-circle mr-2 text-blue-500 mt-0.5"></i>
                                        Jika tidak ada nama organisasi anda, silahkan memilih opsi lainnya untuk
                                        mengisi
                                        nama organisasi anda.
                                    </p>
                                </div>

                                <!-- Judul Pelatihan -->
                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                                        <i class="fas fa-graduation-cap mr-2 text-green-500"></i>Judul Pelatihan
                                    </label>
                                    <input x-model="formData.judul_pelatihan" type="text" name="judul_pelatihan"
                                           placeholder="Masukan judul pelatihan yang diinginkan"
                                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-0 transition-all duration-200 bg-white hover:border-gray-300">
                                </div>

                                <!-- Tema Pelatihan -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                                        <i class="fas fa-tags mr-2 text-green-500"></i>Tema Pelatihan
                                    </label>
                                    <select x-model="formData.id_tema" name="id_tema"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-0 transition-all duration-200 bg-white hover:border-gray-300">
                                        <option value="">Pilih Tema Pelatihan</option>
                                        @foreach ($tema as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('id_tema') == $item->id ? 'selected' : '' }}>
                                                {{ $item->judul_tema }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Nomor PIC -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                                        <i class="fas fa-phone mr-2 text-green-500"></i>Nomor PIC Mitra
                                    </label>
                                    <input x-model="formData.no_pic" type="tel" placeholder="08xxxxxxxxxx"
                                           maxlength="12" pattern="[0-9]*" inputmode="numeric" name="no_pic"
                                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-0 transition-all duration-200 bg-white hover:border-gray-300">
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Jadwal Pelaksanaan -->
                        <div x-show="currentStep === 2" x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-x-4"
                             x-transition:enter-end="opacity-1 transform translate-x-0" class="space-y-6">
                            <div class="text-center mb-8">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Jadwal Pelaksanaan Pelatihan</h3>
                                <p class="text-gray-600">Tentukan waktu pelaksanaan pelatihan yang diinginkan</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Tanggal Mulai -->
                                <div
                                    class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl border border-green-200">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                                        <i class="fas fa-play-circle mr-2 text-green-500"></i>Tanggal Mulai
                                    </label>
                                    <input x-model="formData.tanggal_waktu_mulai" type="date" name="tanggal_waktu_mulai"
                                           class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-0 transition-all duration-200 bg-white">
                                </div>

                                <!-- Tanggal Selesai -->
                                <div
                                    class="bg-gradient-to-br from-red-50 to-rose-50 p-6 rounded-xl border border-red-200">
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                                        <i class="fas fa-stop-circle mr-2 text-red-500"></i>Tanggal Selesai
                                    </label>
                                    <input x-model="formData.tanggal_waktu_selesai" type="date" name="tanggal_waktu_selesai"
                                           class="w-full px-4 py-3 border-2 border-red-200 rounded-xl focus:border-red-500 focus:ring-0 transition-all duration-200 bg-white">
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Assessment Dasar -->
                        <div x-show="currentStep === 3" x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-x-4"
                             x-transition:enter-end="opacity-1 transform translate-x-0" class="space-y-8">
                            <div class="text-center mb-8">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Assessment Dasar</h3>
                                <p class="text-gray-600">Berikan informasi detail tentang kebutuhan pelatihan</p>
                            </div>

                            <!-- Masalah Lembaga -->
                            <div
                                class="bg-gradient-to-br from-orange-50 to-amber-50 p-6 rounded-xl border border-orange-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-exclamation-triangle mr-2 text-orange-500"></i>Masalah yang sedang
                                    dihadapi
                                    oleh lembaga
                                </label>
                                <textarea x-model="formData.masalah" rows="4" name="masalah"
                                          placeholder="Deskripsikan masalah utama yang dihadapi organisasi..."
                                          class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:border-orange-500 focus:ring-0 transition-all duration-200 bg-white resize-none"></textarea>
                            </div>

                            <!-- Kebutuhan Lembaga -->
                            <div
                                class="bg-gradient-to-br from-blue-50 to-green-50 p-6 rounded-xl border border-blue-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-lightbulb mr-2 text-blue-500"></i>Kebutuhan lembaga
                                </label>
                                <textarea x-model="formData.kebutuhan" rows="4" name="kebutuhan"
                                          placeholder="Jelaskan kebutuhan spesifik yang ingin dicapai..."
                                          class="w-full px-4 py-3 border-2 border-blue-200 rounded-xl focus:border-blue-500 focus:ring-0 transition-all duration-200 bg-white resize-none"></textarea>
                            </div>

                            <!-- Materi & Topik -->
                            <div
                                class="bg-gradient-to-br from-green-50 to-violet-50 p-6 rounded-xl border border-green-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-book-open mr-2 text-green-500"></i>Materi & topik yang diharapkan
                                    dari
                                    pelatihan
                                </label>
                                <textarea x-model="formData.materi" rows="4" name="materi"
                                          placeholder="Sebutkan materi dan topik yang diinginkan..."
                                          class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-0 transition-all duration-200 bg-white resize-none"></textarea>
                            </div>
                        </div>

                        <!-- Step 4: Assessment Peserta -->
                        <div x-show="currentStep === 4" x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-x-4"
                             x-transition:enter-end="opacity-1 transform translate-x-0">
                            <div class="text-center mb-8">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Data Peserta Pelatihan</h3>
                                <p class="text-gray-600">Masukan informasi peserta yang akan mengikuti pelatihan</p>
                            </div>

                            <div class="space-y-6">
                                <template x-for="(participant, index) in participants" :key="index">
                                    <div
                                        class="bg-gradient-to-r from-gray-50 to-slate-50 p-6 rounded-xl border-2 border-gray-200 relative">
                                        <!-- Remove Button -->
                                        <button x-show="participants.length > 1" @click="removeParticipant(index)"
                                                type="button"
                                                class="absolute top-4 right-4 w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded-full flex items-center justify-center transition-colors duration-200">
                                            <i class="fas fa-times"></i>
                                        </button>

                                        <h4 class="font-semibold text-gray-800 mb-4 flex items-center">
                                            <i class="fas fa-user mr-2 text-green-500"></i>
                                            Peserta <span x-text="index + 1"></span>
                                        </h4>

                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                            <!-- Nama -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama
                                                    Lengkap</label>
                                                <input name="`nama_peserta[${index}]`" x-model="participant.nama" type="text" placeholder="Nama peserta"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-0 transition-colors">
                                            </div>

                                            <!-- Email -->
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                                <input name="`email_peserta[${index}]`" x-model="participant.email" type="email"
                                                       placeholder="email@domain.com"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-0 transition-colors">
                                            </div>

                                            <!-- Jenis Kelamin -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis
                                                    Kelamin</label>
                                                <select name="`jenis_kelamin[${index}]`" x-model="participant.jenis_kelamin"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-0 transition-colors">
                                                    <option value="">Pilih</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                    <option value="Transgender">Transgender</option>
                                                    <option value="Tidak ingin menyebutkan">Tidak ingin menyebutkan
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- Jabatan -->
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                                                <input name="`jabatan[${index}]`" x-model="participant.jabatan" type="text"
                                                       placeholder="Jabatan di lembaga"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-0 transition-colors">
                                            </div>

                                            <!-- Tanggung Jawab -->
                                            <div class="md:col-span-2">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggung
                                                    Jawab
                                                    Utama</label>
                                                <input name="`tanggung_jawab[${index}]`" x-model="participant.tanggung_jawab" type="text"
                                                       placeholder="Deskripsi tanggung jawab utama"
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-green-500 focus:ring-0 transition-colors">
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <!-- Add Participant Button -->
                                <button @click="addParticipant" type="button"
                                        class="w-full py-3 border-2 border-dashed border-green-300 text-green-600 rounded-xl hover:border-green-400 hover:bg-green-50 transition-all duration-200 flex items-center justify-center space-x-2">
                                    <i class="fas fa-plus"></i>
                                    <span>Tambah Peserta</span>
                                </button>
                            </div>
                        </div>

                        <!-- Step 5: Request Khusus -->
                        <div x-show="currentStep === 5" x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-x-4"
                             x-transition:enter-end="opacity-1 transform translate-x-0">
                            <div class="text-center mb-8">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">Request Khusus</h3>
                                <p class="text-gray-600">Ada permintaan atau kebutuhan khusus? Sampaikan di sini</p>
                            </div>

                            <div
                                class="bg-gradient-to-br from-teal-50 to-cyan-50 p-8 rounded-xl border border-teal-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-4">
                                    <i class="fas fa-star mr-2 text-teal-500"></i>Request Khusus (Opsional)
                                </label>
                                <textarea name="request_khusus" x-model="formData.request_khusus" rows="6"
                                          placeholder="Sampaikan request khusus, kebutuhan tambahan, atau catatan penting lainnya..."
                                          class="w-full px-4 py-3 border-2 border-teal-200 rounded-xl focus:border-teal-500 focus:ring-0 transition-all duration-200 bg-white resize-none"></textarea>
                                <p class="text-sm text-gray-600 mt-3 flex items-start">
                                    <i class="fas fa-info-circle mr-2 text-teal-500 mt-0.5"></i>
                                    Contoh: Kebutuhan sertifikat, materi dalam bahasa tertentu, metode pembelajaran
                                    khusus,
                                    dll.
                                </p>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between items-center mt-12 pt-8 border-t border-gray-200">
                            <!-- Previous Button -->
                            <button x-show="currentStep > 1" @click="prevStep" type="button"
                                    class="flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition-all duration-200 font-medium">
                                <i class="fas fa-chevron-left mr-2"></i>
                                Sebelumnya
                            </button>

                            <div x-show="currentStep === 1"></div>

                            <!-- Next/Submit Button -->
                            <button x-show="currentStep < 5" @click="nextStep" type="button"
                                    class="flex items-center px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-xl transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                Selanjutnya
                                <i class="fas fa-chevron-right ml-2"></i>
                            </button>

                            <button x-show="currentStep === 5" type="submit" id="submit-button"
                                    class="flex items-center px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-xl transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Permintaan
                            </button>
                        </div>
                    </form>
{{--                @endauth--}}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function multiStepForm() {
            return {
                currentStep: 1,
                showCustomMitra: false,
                steps: [{
                    title: 'Informasi Mitra',
                    icon: 'fas fa-building'
                },
                    {
                        title: 'Jadwal',
                        icon: 'fas fa-calendar'
                    },
                    {
                        title: 'Assessment Dasar',
                        icon: 'fas fa-clipboard-check'
                    },
                    {
                        title: 'Data Peserta',
                        icon: 'fas fa-users'
                    },
                    {
                        title: 'Request Khusus',
                        icon: 'fas fa-star'
                    }
                ],
                formData: {
                    id_mitra: '',
                    nama_mitra: '',
                    judul_pelatihan: '',
                    id_tema: '',
                    no_pic: '',
                    tanggal_waktu_mulai: '',
                    tanggal_waktu_selesai: '',
                    masalah: '',
                    kebutuhan: '',
                    materi: '',
                    request_khusus: ''
                },
                participants: [{
                    nama: '',
                    email: '',
                    jenis_kelamin: '',
                    jabatan: '',
                    tanggung_jawab: ''
                }],

                nextStep() {
                    if (this.validateCurrentStep()) {
                        if (this.currentStep < 5) {
                            this.currentStep++;
                        }
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Form Belum Lengkap',
                            text: 'Silakan isi semua kolom yang diperlukan sebelum melanjutkan.',
                            confirmButtonText: 'Mengerti',
                            confirmButtonColor: '#6366f1'
                        });
                    }
                },

                prevStep() {
                    if (this.currentStep > 1) {
                        this.currentStep--;
                    }
                },

                validateCurrentStep() {
                    switch (this.currentStep) {
                        case 1:
                            if (this.formData.id_mitra === 'Lainnya') {
                                return this.formData.nama_mitra && this.formData.judul_pelatihan && this.formData.id_tema &&
                                    this.formData.no_pic;
                            }
                            return this.formData.id_mitra && this.formData.judul_pelatihan && this.formData.id_tema && this
                                .formData.no_pic;
                        case 2:
                            return this.formData.tanggal_waktu_mulai && this.formData.tanggal_waktu_selesai;
                        case 3:
                            return this.formData.masalah && this.formData.kebutuhan && this.formData.materi;
                        case 4:
                            return this.participants.every(p => p.nama && p.email && p.jenis_kelamin && p.jabatan && p
                                .tanggung_jawab);
                        case 5:
                            return true; // Request khusus is optional
                        default:
                            return false;
                    }
                },

                toggleCustomMitra() {
                    this.showCustomMitra = this.formData.id_mitra === 'Lainnya';
                    if (!this.showCustomMitra) {
                        this.formData.nama_mitra = '';
                    }
                },

                addParticipant() {
                    this.participants.push({
                        nama: '',
                        email: '',
                        jenis_kelamin: '',
                        jabatan: '',
                        tanggung_jawab: ''
                    });
                },

                removeParticipant(index) {
                    if (this.participants.length > 1) {
                        this.participants.splice(index, 1);
                    }
                },

                submitForm() {
                    if (!this.validateCurrentStep()) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Form Belum Lengkap',
                            text: 'Silakan lengkapi semua data yang diperlukan.',
                            confirmButtonText: 'Mengerti',
                            confirmButtonColor: '#6366f1'
                        });
                        return;
                    }

                    // Show loading
                    Swal.fire({
                        title: 'Mengirim Permintaan...',
                        text: 'Mohon tunggu sebentar.',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Simulate form submission
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Permintaan pelatihan Anda telah berhasil dikirim. Tim kami akan segera menghubungi Anda.',
                            confirmButtonText: 'Baik',
                            confirmButtonColor: '#10b981'
                        }).then(() => {
                            // Reset form or redirect
                            console.log('Form Data:', this.formData);
                            console.log('Participants:', this.participants);

                            // In real implementation, you would send this data to your Laravel backend
                            // window.location.href = '/success-page';
                        });
                    }, 2000);
                }
            }
        }

        $('#submit-button').click(function (e) {
            e.preventDefault();

            // Get Alpine.js data
            const alpineData = Alpine.$data(document.querySelector('[x-data]'));

            // Create FormData
            var formData = new FormData($('#multi-step-form')[0]);

            // Remove existing participant data that might be in form
            for (let [key, value] of formData.entries()) {
                if (key.startsWith('nama_peserta') ||
                    key.startsWith('email_peserta') ||
                    key.startsWith('jenis_kelamin') ||
                    key.startsWith('jabatan') ||
                    key.startsWith('tanggung_jawab')) {
                    formData.delete(key);
                }
            }

            // Add participants data in the correct format
            if (alpineData.participants && alpineData.participants.length > 0) {
                alpineData.participants.forEach((participant, index) => {
                    formData.append(`nama_peserta[${index}]`, participant.nama || '');
                    formData.append(`email_peserta[${index}]`, participant.email || '');
                    formData.append(`jenis_kelamin[${index}]`, participant.jenis_kelamin || '');
                    formData.append(`jabatan[${index}]`, participant.jabatan || '');
                    formData.append(`tanggung_jawab[${index}]`, participant.tanggung_jawab || '');
                });
            }

            // Debug: log what we're sending
            console.log('Sending participants data:');
            for (let [key, value] of formData.entries()) {
                if (key.includes('peserta') || key.includes('kelamin') || key.includes('jabatan') || key.includes('tanggung_jawab')) {
                    console.log(key + ': ' + value);
                }
            }

            // Show loading spinner
            Swal.fire({
                title: 'Menyimpan data...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Send AJAX request
            $.ajax({
                url: "{{ route('permintaan.store') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.close();

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil disimpan.',
                            confirmButtonText: 'Lanjut'
                        }).then(() => {
                            window.location.href = response.redirect_url;
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan, silakan coba lagi.',
                            confirmButtonText: 'Oke'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.close();

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let messages = '';
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            messages += `• ${value[0]}<br>`;
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal',
                            html: messages,
                            confirmButtonText: 'Perbaiki'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan!',
                            html: xhr.responseJSON?.error ?? 'Gagal mengirim data. Silakan coba lagi nanti.',
                            confirmButtonText: 'Oke'
                        });
                    }
                }
            });
        });

        // Format phone number input
        document.addEventListener('alpine:init', () => {
            Alpine.directive('phone', (el) => {
                el.addEventListener('input', function () {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            });
        });
    </script>

    <!-- Custom Styles -->
    <style>
        /* Smooth transitions for Alpine.js */
        [x-cloak] {
            display: none !important;
        }

        /* Custom focus styles */
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Hover effects for cards */
        .bg-gradient-to-br:hover {
            transform: translateY(-1px);
            transition: transform 0.2s ease-out;
        }

        /* Animation for step indicators */
        @keyframes pulse-ring {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(1.3);
                opacity: 0;
            }
        }

        .animate-ping {
            animation: pulse-ring 1s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
    </style>

@endsection
