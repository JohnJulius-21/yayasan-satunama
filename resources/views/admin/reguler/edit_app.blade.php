@extends('layouts.app')

@section('title', 'Admin | Edit Pelatihan Reguler')

@section('content')

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

    <div class="container mx-auto px-4 py-6 max-w-7xl">

        <!-- Ikon kembali -->
        <a href="{{ route('regulerAdmin') }}" class="back-icon mb-3" title="Kembali">
            ←
        </a>

        <h6 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Form Edit Pelatihan Reguler</h6>

        <form method="post" action="{{ route('regulerUpdateAdmin', $reguler->id_reguler) }}"
              enctype="multipart/form-data"
              id="form-pelatihan">
            @csrf
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium">Terdapat kesalahan pada form:</h3>
                            <div class="mt-2 text-sm">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-lg">
                            <h6 class="text-lg font-semibold text-green-600">Informasi Pelatihan</h6>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Nama Pelatihan -->
                            <div>
                                <label for="nama_pelatihan" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Pelatihan</label>
                                <input type="text" name="nama_pelatihan" id="nama_pelatihan"
                                       value="{{ old('nama_pelatihan', $reguler->nama_pelatihan) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                @error('nama_pelatihan')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tema Pelatihan -->
                            <div>
                                <label for="id_tema" class="block text-sm font-medium text-gray-700 mb-2">Tema
                                    Pelatihan</label>
                                <select name="id_tema"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                    <option value="">Pilih Tema Pelatihan</option>
                                    @foreach ($tema as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('id_tema', $reguler->id_tema) == $item->id ? 'selected' : '' }}>
                                            {{ $item->judul_tema }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_tema')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Fee Pelatihan -->
                            <div>
                                <label for="fee_pelatihan" class="block text-sm font-medium text-gray-700 mb-2">Fee
                                    Pelatihan</label>
                                <input type="text" name="fee_pelatihan" id="fee_pelatihan"
                                       value="{{ old('fee_pelatihan', $reguler->fee_pelatihan) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                @error('fee_pelatihan')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Metode Pelatihan -->
                            <div>
                                <label for="metode_pelatihan" class="block text-sm font-medium text-gray-700 mb-2">Metode
                                    Pelatihan</label>
                                <select name="metode_pelatihan"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                    <option value="">Pilih Metode Pelatihan</option>
                                    <option value="Online"
                                        {{ old('metode_pelatihan', $reguler->metode_pelatihan) == 'Online' ? 'selected' : '' }}>
                                        Online
                                    </option>
                                    <option value="Offline"
                                        {{ old('metode_pelatihan', $reguler->metode_pelatihan) == 'Offline' ? 'selected' : '' }}>
                                        Offline
                                    </option>
                                </select>
                                @error('metode_pelatihan')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Lokasi Pelatihan -->
                            <div>
                                <label for="lokasi_pelatihan" class="block text-sm font-medium text-gray-700 mb-2">Lokasi
                                    Pelatihan</label>
                                <input type="text" name="lokasi_pelatihan" id="lokasi_pelatihan"
                                       value="{{ old('lokasi_pelatihan', $reguler->lokasi_pelatihan) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                @error('lokasi_pelatihan')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kuota Peserta -->
                            <div>
                                <label for="kuota_peserta" class="block text-sm font-medium text-gray-700 mb-2">Kuota
                                    Peserta</label>
                                <input type="number" name="kuota_peserta" id="kuota_peserta"
                                       value="{{ old('kuota_peserta', $reguler->kuota_peserta) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                                @error('kuota_peserta')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi Pelatihan -->
                            <div>
                                <label for="deskripsi_pelatihan"
                                       class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Pelatihan</label>
                                <textarea name="deskripsi_pelatihan" id="deskripsi_pelatihan" rows="5"
                                          class="ckeditor w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">{{ old('deskripsi_pelatihan', $reguler->deskripsi_pelatihan) }}</textarea>
                                @error('deskripsi_pelatihan')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pengumuman Pelatihan -->
                            <div>
                                <label for="pengumuman" class="block text-sm font-medium text-gray-700 mb-2">Pengumuman
                                    Pelatihan</label>
                                <textarea name="pengumuman" id="pengumuman" rows="5"
                                          class="ckeditor w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">{{ old('pengumuman', $reguler->pengumuman) }}</textarea>
                                @error('pengumuman')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Details -->
                <div class="lg:col-span-5 space-y-6">

                    <!-- Tanggal -->
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-lg">
                            <h6 class="text-lg font-semibold text-green-600">Tanggal Pelatihan</h6>
                        </div>
                        <div class="p-6">
                            <label for="tanggal_pendaftaran" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                Pendaftaran Pelatihan</label>
                            <input type="date" id="tanggal_pendaftaran" name="tanggal_pendaftaran"
                                   value="{{ old('tanggal_pendaftaran', $reguler->tanggal_pendaftaran) }}"
                                   class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-500">

                            <label for="tanggal_batas_pendaftaran"
                                   class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                Batas Pendaftaran</label>
                            <input type="date" id="tanggal_batas_pendaftaran" name="tanggal_batas_pendaftaran"
                                   value="{{ old('tanggal_batas_pendaftaran', $reguler->tanggal_batas_pendaftaran) }}"
                                   class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-500">

                            <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                Mulai</label>
                            <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                                   value="{{ old('tanggal_mulai', $reguler->tanggal_mulai) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-500">

                            <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mt-4 mb-2">Tanggal
                                Selesai</label>
                            <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                   value="{{ old('tanggal_selesai', $reguler->tanggal_selesai) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-500">
                        </div>
                    </div>

                    <!-- Poster -->
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-lg">
                            <h6 class="text-lg font-semibold text-green-600">Poster & Materi</h6>
                        </div>
                        <div class="p-6">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Poster Pelatihan
                            </label>

                            <!-- Single File Input (TIDAK ADA multiple dan array) -->
                            <input
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100 @error('image') border-red-500 @enderror"
                                type="file"
                                id="image"
                                name="image"
                                accept="image/jpeg,image/png,image/jpg,image/gif">

                            <div class="mt-2 text-xs text-gray-500">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Poster tidak boleh lebih dari 2MB</li>
                                    <li>Format yang diterima: JPEG, PNG, JPG, GIF</li>
                                    <li>Kosongkan kolom upload poster jika tidak ingin merubah poster</li>
                                </ul>
                            </div>

                            @error('image')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror

                            <!-- Tampilkan image yang sudah ada (hanya 1) -->
                            @if (!empty($images) && (is_array($images) || is_countable($images)) && count($images) > 0)
                                @php
                                    // Ambil image pertama, bisa dari array atau collection
                                    if (is_array($images)) {
                                        $image = $images[0];
                                    } elseif (is_object($images) && method_exists($images, 'first')) {
                                        $image = $images->first();
                                    } else {
                                        $image = $images[0];
                                    }
                                @endphp

                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 mb-2">Poster saat ini:</p>
                                    <div class="relative inline-block">
                                        @php
                                            // Ambil URL image dengan cara yang aman
                                            $imageUrl = '';
                                            if (is_object($image)) {
                                                $imageUrl = $image->image ?? ($image->image_url ?? '');
                                            } elseif (is_array($image)) {
                                                $imageUrl = $image['image'] ?? ($image['image_url'] ?? '');
                                            }
                                        @endphp

                                        <img
                                            src="{{ $imageUrl ? route('file.show', ['filename' => $imageUrl]) : asset('images/stc.png') }}"
                                            class="rounded-lg shadow-md max-w-xs h-40 object-cover"
                                            alt="Poster Pelatihan"/>

                                        <!-- Optional: Preview label -->
                                        <div
                                            class="absolute bottom-2 left-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded text-xs">
                                            Preview
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="mt-4 p-4 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                                    <div class="text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                             viewBox="0 0 48 48">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">Belum ada poster yang diunggah</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Fasilitator -->
                    <div class="bg-white rounded-lg shadow-md">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 rounded-t-lg">
                            <h6 class="text-lg font-semibold text-green-600">Fasilitator</h6>
                        </div>
                        <div class="p-6">
                            <label for="fasilitator"
                                   class="block text-sm font-medium text-gray-700 mb-2">Fasilitator</label>
                            <select id="fasilitator" class="form-control @error('id_fasilitator') is-invalid @enderror"
                                    name="id_fasilitator[]" multiple="multiple" style="width: 100%">
                                @foreach ($fasilitators as $item)
                                    <option value="{{ $item->id_fasilitator }}"
                                            @if (in_array($item->id_fasilitator, $oldIdFasilitator)) selected @endif>
                                        {{ $item->nama_fasilitator }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="floating-buttons">
                <button type="submit"
                        class="fixed bottom-5 right-5 bg-green-600 hover:bg-green-700 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16v5H7v-5M12 3v13m0 0l-4-4m4 4l4-4"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#fasilitator').select2({
                placeholder: "Pilih Fasilitator",
                theme: "classic"
            });
        });

        document.getElementById('image').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // You can add image preview functionality here if needed
                    console.log('File selected:', file.name);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
