@extends('layouts.app')

@section('title', 'Admin | Buat Pelatihan Reguler')

@section('content')

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

    <style>
        /* Custom modal styles */
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .custom-modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            position: relative;
        }

        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-modal:hover {
            color: black;
        }

        /* Select2 custom styling for Tailwind */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem;
            min-height: 2.5rem;
        }

        .select2-container--default .select2-selection--multiple:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* Tombol mengambang */
        .floating-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 100;
        }

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



    <div class="container mx-auto px-4 py-6 max-w-7xl">
        <!-- Ikon kembali -->
        <a href="{{ route('regulerAdmin') }}" class="back-icon mb-3" title="Kembali">
            ←
        </a>
        <!-- Header -->
        <div class="flex justify-between items-center flex-wrap mb-6 pb-4 border-b border-gray-200">
            <h1 class="text-lg font-medium text-gray-600">Form Tambah Pelatihan Reguler</h1>
            <div class="flex justify-end">
                <button
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200 btn-modal">
                    Kelola Tema Pelatihan
                </button>
            </div>
        </div>

        <!-- Form -->
        <form method="post" action="{{ route('regulerStoreAdmin') }}" enctype="multipart/form-data" id="form-pelatihan">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Left Column - Main Form -->
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-lg shadow-md">
                        <!-- Card Header -->
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-lg">
                            <h1 class="text-lg font-medium text-green-600">Informasi Pelatihan</h1>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 space-y-6">
                            <!-- Nama Pelatihan -->
                            <div>
                                <label for="nama_pelatihan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Pelatihan
                                </label>
                                <input type="text"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                       placeholder="Masukkan Nama Pelatihan" name="nama_pelatihan" id="nama_pelatihan"
                                       autofocus>
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>

                            <!-- Tema Pelatihan -->
                            <div>
                                <label for="tema" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tema Pelatihan
                                </label>
                                <select
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                    name="id_tema">
                                    <option value="">Pilih Tema Pelatihan</option>
                                    @foreach ($tema as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('id_tema') == $item->id ? 'selected' : '' }}>
                                            {{ $item->judul_tema }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Fee Pelatihan -->
                            <div>
                                <label for="fee_pelatihan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Fee Pelatihan
                                </label>
                                <input
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                    placeholder="Masukkan Fee Pelatihan" name="fee_pelatihan" id="fee_pelatihan">
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>

                            <!-- Metode Pelatihan -->
                            <div>
                                <label for="metode_pelatihan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Metode Pelatihan
                                </label>
                                <select
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                    name="metode_pelatihan">
                                    <option value="">Pilih Metode Pelatihan</option>
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                </select>
                            </div>

                            <!-- Lokasi Pelatihan -->
                            <div>
                                <label for="lokasi_pelatihan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Lokasi Pelatihan
                                </label>
                                <input type="text"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                       placeholder="Masukkan Lokasi Pelatihan" name="lokasi_pelatihan"
                                       id="lokasi_pelatihan">
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>

                            <!-- Kuota Peserta -->
                            <div>
                                <label for="kuota_peserta" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kuota Peserta
                                </label>
                                <input type="number"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                       placeholder="Masukkan Kuota Peserta" name="kuota_peserta" id="kuota_peserta">
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>

                            <!-- Deskripsi Pelatihan -->
                            <div>
                                <label for="deskripsi_pelatihan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Deskripsi Pelatihan
                                </label>
                                <textarea
                                    class="ckeditor w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                    name="deskripsi_pelatihan" id="deskripsi_pelatihan" rows="5"
                                    placeholder="Masukkan deskripsi pelatihan..."></textarea>
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>

                            <!-- Pengumuman Pelatihan -->
                            <div>
                                <label for="pengumuman" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pengumuman Pelatihan
                                </label>
                                <textarea
                                    class="ckeditor w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                    name="pengumuman" id="pengumuman" rows="5"
                                    placeholder="Masukkan pengumuman pelatihan..."></textarea>
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Additional Info -->
                <div class="lg:col-span-5 space-y-6">
                    <!-- Tanggal Pelatihan -->
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-lg">
                            <h1 class="text-lg font-medium text-green-600">Tanggal Pelatihan</h1>
                        </div>
                        <div class="p-6 space-y-4">
                            <!-- Tanggal Pendaftaran -->
                            <div>
                                <label for="tanggal_pendaftaran" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Pendaftaran Pelatihan
                                </label>
                                <input type="date" id="tanggal_pendaftaran"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                       name="tanggal_pendaftaran">
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>

                            <!-- Tanggal Batas Pendaftaran -->
                            <div>
                                <label for="tanggal_batas_pendaftaran"
                                       class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Batas Pendaftaran Pelatihan
                                </label>
                                <input type="date" id="tanggal_batas_pendaftaran"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                       name="tanggal_batas_pendaftaran">
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>

                            <!-- Tanggal Mulai -->
                            <div>
                                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Mulai Pelatihan
                                </label>
                                <input type="date" id="tanggal_mulai"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                       name="tanggal_mulai">
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>

                            <!-- Tanggal Selesai -->
                            <div>
                                <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tanggal Selesai Pelatihan
                                </label>
                                <input type="date" id="tanggal_selesai"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                       name="tanggal_selesai">
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Poster & Materi -->
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-lg">
                            <h1 class="text-lg font-medium text-green-600">Poster & Materi</h1>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Upload Poster -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Upload Poster Pelatihan
                                </label>
                                <input
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    type="file" id="image" name="image[]" multiple>
                                <div class="mt-2 text-xs text-gray-500">
                                    <ul class="list-disc list-inside">
                                        <li>Poster tidak boleh lebih dari 2mb</li>
                                    </ul>
                                </div>
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>

                            <!-- Upload Materi -->
                            <div>
                                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                    Upload Materi
                                </label>
                                <input
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    type="file" id="file" name="file[]" multiple>
                                <div class="mt-2 text-xs text-gray-500">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>File tidak boleh lebih dari 5mb</li>
                                        <li>Kosongkan kolom upload materi jika tidak ingin mengupload materi</li>
                                    </ul>
                                </div>
                                <div class="text-red-600 text-sm mt-1 hidden error-message">
                                    Error message here
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fasilitator -->
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-lg">
                            <h1 class="text-lg font-medium text-green-600">Fasilitator Pelatihan</h1>
                        </div>
                        <div class="p-6">
                            <label for="fasilitator" class="block text-sm font-medium text-gray-700 mb-2">
                                Fasilitator Pelatihan
                            </label>
                            <select id="fasilitator" class="w-full" name="id_fasilitator[]" multiple="multiple">
                                @foreach ($fasilitator as $item)
                                    <option value="{{ $item->id_fasilitator }}"
                                            @if (in_array($item->id_fasilitator, $oldIdFasilitator)) selected @endif>{{ $item->nama_fasilitator }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            {{-- <div class="flex gap-4 mt-8">
                <a class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200"
                    href="#">
                    Kembali
                </a>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                    Simpan
                </button>
            </div> --}}

            <!-- Tombol mengambang kanan bawah -->
            <div class="floating-buttons">
                <!-- Tombol Simpan Bulat Mengambang di Kanan Bawah -->
                <button type="submit" form="form-pelatihan"
                        class="fixed bottom-5 right-5 bg-green-600 hover:bg-green-700 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg transition duration-200 z-50">
                    <!-- Ikon Save Heroicons -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16v5H7v-5M12 3v13m0 0l-4-4m4 4l4-4"/>
                    </svg>
                </button>
            </div>
        </form>

        <!-- Modal untuk Kelola Tema -->
        <div id="temaModal" class="custom-modal">
            <div class="custom-modal-content">
                <div class="flex justify-between items-center border-b pb-3 mb-6">
                    <h5 class="text-xl font-semibold text-gray-800">Kelola Tema Pelatihan</h5>
                    <span class="close-modal text-gray-400 hover:text-gray-600 text-2xl cursor-pointer">&times;</span>
                </div>

                <!-- Form Tambah Tema -->
                <form id="temaForm" method="POST" action="{{ route('regulerStoreTemaAdmin') }}" class="mb-6">
                    @csrf
                    <label for="judul_tema" class="block text-sm font-medium text-gray-700 mb-2">
                        Tambah Tema
                    </label>
                    <input type="text" name="judul_tema"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 mb-3"
                           placeholder="Tambah Tema">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                        Tambah Tema
                    </button>
                </form>

                <hr class="my-6">

                <!-- Form Hapus Tema -->
                <form id="hapusTemaForm" method="POST"
                      action="{{ route('regulerDestroyTemaAdmin', ['id' => '__ID__']) }}">
                    @csrf
                    @method('DELETE')
                    <label for="hapus_tema" class="block text-sm font-medium text-gray-700 mb-2">
                        Hapus Tema
                    </label>
                    <select id="hapus_tema" name="id_tema"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 mb-3">
                        <option value="">-- Pilih Tema --</option>
                        @foreach ($tema as $t)
                            <option value="{{ $t->id }}">{{ $t->judul_tema }}</option>
                        @endforeach
                    </select>
                    <button type="submit" id="btnSubmitHapus"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                        Hapus Tema
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#fasilitator').select2({
                placeholder: "Pilih Fasilitator",
                theme: "classic"
            });

        });

        document.addEventListener('DOMContentLoaded', function () {
            const feeInput = document.getElementById('fee_pelatihan');

            // Format rupiah saat input
            feeInput.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, ''); // hapus semua selain angka
                if (value) {
                    e.target.value = formatRupiah(value);
                } else {
                    e.target.value = '';
                }
            });

            // Hapus format saat submit
            document.getElementById('form-pelatihan').addEventListener('submit', function () {
                feeInput.value = feeInput.value.replace(/\D/g, ''); // kirim hanya angka
            });

            function formatRupiah(angka) {
                let number_string = angka.toString(),
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    let separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                return 'Rp ' + rupiah;
            }
        });
        // Initialize Select2 for multiple select
        document.addEventListener('DOMContentLoaded', function () {

            // Modal functionality
            const modal = document.getElementById('temaModal');
            const btnModal = document.querySelector('.btn-modal');
            const closeModal = document.querySelector('.close-modal');

            btnModal?.addEventListener('click', function () {
                modal.style.display = 'block';
            });

            closeModal?.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });

        document.getElementById('form-pelatihan').addEventListener('submit', function (e) {
            let valid = true;

            // Helper function untuk set error
            function setError(input, message) {
                const errorDiv = input.parentElement.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.textContent = message;
                    errorDiv.classList.remove('hidden');
                }
                input.classList.add('border-red-500');
                valid = false;
            }

            // Helper function untuk clear error
            function clearError(input) {
                const errorDiv = input.parentElement.querySelector('.error-message');
                if (errorDiv) {
                    errorDiv.textContent = '';
                    errorDiv.classList.add('hidden');
                }
                input.classList.remove('border-red-500');
            }

            // Ambil semua field yang wajib diisi
            const requiredFields = [{
                id: 'nama_pelatihan',
                message: 'Nama pelatihan wajib diisi'
            },
                {
                    id: 'fee_pelatihan',
                    message: 'Fee pelatihan wajib diisi'
                },
                {
                    id: 'lokasi_pelatihan',
                    message: 'Lokasi pelatihan wajib diisi'
                },
                {
                    id: 'kuota_peserta',
                    message: 'Kuota peserta wajib diisi'
                },
                {
                    id: 'deskripsi_pelatihan',
                    message: 'Deskripsi pelatihan wajib diisi'
                },
                // {
                //     id: 'pengumuman',
                //     message: 'Pengumuman pelatihan wajib diisi'
                // },
                {
                    id: 'tanggal_pendaftaran',
                    message: 'Tanggal pendaftaran wajib diisi'
                },
                {
                    id: 'tanggal_batas_pendaftaran',
                    message: 'Tanggal batas pendaftaran wajib diisi'
                },
                {
                    id: 'tanggal_mulai',
                    message: 'Tanggal mulai wajib diisi'
                },
                {
                    id: 'tanggal_selesai',
                    message: 'Tanggal selesai wajib diisi'
                }
            ];

            requiredFields.forEach(field => {
                const input = document.getElementById(field.id);
                if (input && !input.value.trim()) {
                    setError(input, field.message);
                } else if (input) {
                    clearError(input);
                }
            });

            // Validasi select tema
            const tema = document.querySelector('select[name="id_tema"]');
            if (!tema.value) {
                setError(tema, 'Tema pelatihan wajib dipilih');
            } else {
                clearError(tema);
            }

            // Validasi select metode
            const metode = document.querySelector('select[name="metode_pelatihan"]');
            if (!metode.value) {
                setError(metode, 'Metode pelatihan wajib dipilih');
            } else {
                clearError(metode);
            }

            // Validasi upload poster max 2MB
            const posterInput = document.getElementById('image');
            if (posterInput.files.length > 0) {
                for (let file of posterInput.files) {
                    if (file.size > 2 * 1024 * 1024) {
                        setError(posterInput, 'Ukuran file poster tidak boleh lebih dari 2MB');
                        break;
                    } else {
                        clearError(posterInput);
                    }
                }
            }

            // Validasi upload materi max 5MB
            const materiInput = document.getElementById('file');
            if (materiInput.files.length > 0) {
                for (let file of materiInput.files) {
                    if (file.size > 5 * 1024 * 1024) {
                        setError(materiInput, 'Ukuran file materi tidak boleh lebih dari 5MB');
                        break;
                    } else {
                        clearError(materiInput);
                    }
                }
            }

            if (!valid) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-pelatihan'); // ganti sesuai id form kamu
            if (form) {
                form.addEventListener('submit', function () {
                    for (instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                });
            }
        });

        $(document).ready(function () {
            $('#btnSubmitHapus').click(function (e) {
                const idTema = $('#hapus_tema').val();

                if (!idTema) {
                    e.preventDefault();
                    alert('Silakan pilih tema terlebih dahulu.');
                    return;
                }

                const form = $('#hapusTemaForm');
                let action = form.attr('action').replace('__ID__', idTema);
                form.attr('action', action);
            });
        });
    </script>

@endsection
