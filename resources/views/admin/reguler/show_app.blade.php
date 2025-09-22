@extends('layouts.app')
@section('title', 'Admin | Daftar Peserta Pelatihan Reguler')
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

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // buka kembali modal tambah peserta
                $('#modalTambahPeserta').modal('show');

                // gabungkan semua pesan error menjadi satu string
                const errors = `{!! implode('<br>', $errors->all()) !!}`;

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    html: errors, // pakai html agar <br> terbaca
                    timer: 5000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'bottom-end'
                });
            });
        </script>
    @endif


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #1a202c;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            padding: 24px;
            border-bottom: 1px solid #e2e8f0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header p {
            opacity: 0.9;
        }

        .controls {
            padding: 24px;
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }

        .search-container {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: #346a32;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }

        .button {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .button-success {
            background: linear-gradient(135deg, #438848 0%, #438848 100%);
            color: white;
        }

        .button-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgb(81, 162, 75);
        }

        .button-secondary {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .button-secondary:hover {
            background: #e2e8f0;
        }

        .table-container {
            overflow: auto;
            max-height: 600px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1200px;
        }

        .table th {
            background: #f8fafc;
            padding: 16px 12px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
            position: sticky;
            top: 0;
        }

        .table td {
            padding: 12px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .table tr:hover {
            background-color: #f8fafc;
        }

        .status-select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 13px;
            background: white;
            cursor: pointer;
        }

        .status-select:focus {
            outline: none;
            border-color: #51a24b;
        }

        .pagination {
            padding: 20px 24px;
            display: flex;
            justify-content: between;
            align-items: center;
            gap: 16px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        .pagination-info {
            flex: 1;
            color: #64748b;
            font-size: 14px;
        }

        .pagination-controls {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .page-button {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            background: white;
            color: #64748b;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
        }

        .page-button:hover:not(:disabled) {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }

        .page-button.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .page-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .entries-select {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: white;
            font-size: 14px;
        }

        .no-data {
            padding: 40px;
            text-align: center;
            color: #64748b;
        }

        .loading {
            padding: 40px;
            text-align: center;
            color: #667eea;
        }

        @media (max-width: 768px) {
            .controls {
                flex-direction: column;
                align-items: stretch;
            }

            .search-container {
                min-width: auto;
            }
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


    <!-- Ikon kembali -->
    <a href="{{ route('regulerAdmin') }}" class="back-icon mb-3" title="Kembali">
        ←
    </a>
    <div class="flex flex-wrap md:flex-nowrap justify-between items-center pt-3 pb-2 mb-3 border-b border-gray-200">
        <h6 class="text-xl font-semibold text-gray-800">Daftar Peserta Pelatihan</h6>
    </div>

    <div class="card">
        <div class="controls">
            <div class="search-container">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" id="searchInput" class="search-input"
                       placeholder="Cari nama peserta, email, atau organisasi...">
            </div>

            <div style="display: flex; gap: 12px; align-items: center;">
                <label for="entriesSelect" style="font-size: 14px; color: #64748b;">Tampilkan:</label>
                <select id="entriesSelect" class="entries-select">
                    <option value="10">10</option>
                    <option value="25" selected>25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <button
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200"
                onclick="exportToExcel()">
                {{--                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">--}}
                {{--                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>--}}
                {{--                    <polyline points="7,10 12,15 17,10"></polyline>--}}
                {{--                    <line x1="12" y1="15" x2="12" y2="3"></line>--}}
                {{--                </svg>--}}
                Export Excel
            </button>

            <button
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200"
                data-toggle="modal" data-target="#modalTambahPeserta" id="btn-tambah-peserta">
                Tambah Peserta
            </button>
        </div>

        <div class="table-container">
            <table class="table" id="pesertaTable">
                <thead>
                <tr>
                    <!-- Kolom sticky pertama -->
                    <th class="sticky left-0 top-0 bg-gray-400 z-30">Nama Peserta</th>

                    <!-- Header lain cukup sticky top-0 -->
                    <th class="sticky top-0 bg-white z-20">Email Peserta</th>
                    <th class="sticky top-0 bg-white z-20">No. HP</th>
                    <th class="sticky top-0 bg-white z-20">Rentang Usia</th>
                    <th class="sticky top-0 bg-white z-20">Gender</th>
                    <th class="sticky top-0 bg-white z-20">Kabupaten/Kota</th>
                    <th class="sticky top-0 bg-white z-20">Provinsi</th>
                    <th class="sticky top-0 bg-white z-20">Negara</th>
                    <th class="sticky top-0 bg-white z-20">Nama Organisasi</th>
                    <th class="sticky top-0 bg-white z-20">Jenis Organisasi</th>
                    <th class="sticky top-0 bg-white z-20">Jabatan Peserta</th>
                    <th class="sticky top-0 bg-white z-20">Informasi Pelatihan</th>
                    <th class="sticky top-0 bg-white z-20">Pelatihan Relevan</th>
                    <th class="sticky top-0 bg-white z-20">Harapan Pelatihan</th>
                    <th class="sticky top-0 bg-white z-20">Status Bayar</th>
                </tr>
                </tr>
                </thead>
                <tbody id="tableBody">
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <div class="pagination-info" id="paginationInfo">
                Menampilkan 0 dari 0 data
            </div>
            <div class="pagination-controls">
                <button class="page-button" id="prevButton" onclick="changePage(-1)" disabled>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15,18 9,12 15,6"></polyline>
                    </svg>

                </button>
                <div id="pageNumbers"></div>
                <button class="page-button" id="nextButton" onclick="changePage(1)" disabled>

                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9,18 15,12 9,6"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4"
         id="modalTambahPeserta" tabindex="-1"
         aria-labelledby="modalTambahPesertaLabel" aria-hidden="true">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <form action="{{ route('regulerStorePesertaAdmin') }}" method="POST">
                @csrf
                <input type="hidden" id="id_reguler" name="id_reguler" value="{{ $reguler->id_reguler }}">

                <!-- Modal Header -->
                <div class="flex justify-between items-center p-6 border-b border-gray-200 bg-white">
                    <h5 class="text-xl font-semibold text-gray-700" id="modalTambahPesertaLabel">Tambah Peserta
                        Baru</h5>
                    <button type="button"
                            class="text-gray-700 hover:text-gray-200 text-2xl font-bold transition-colors duration-200"
                            data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 max-h-[70vh] overflow-y-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="nama_peserta" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                Peserta</label>
                            <input type="text" name="nama_peserta"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email_peserta"
                                   class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email_peserta"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   required>
                        </div>

                        <!-- No HP -->
                        <div class="mb-3">
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP</label>
                            <input type="text" name="no_hp"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('no_hp') border-red-500 @enderror"
                                   value="{{ old('no_hp') }}" required maxlength="12" pattern="\d{1,12}"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,12);">
                            @error('no_hp')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="mb-3">
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <select name="gender"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    required>
                                <option value="">Pilih Gender</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                                <option value="Transgender">Transgender</option>
                                <option value="Tidak ingin menyebutkan">Tidak ingin menyebutkan</option>
                            </select>
                        </div>

                        <!-- Rentang Usia -->
                        <div class="mb-3">
                            <label for="rentang_usia" class="block text-sm font-medium text-gray-700 mb-2">Rentang
                                Usia</label>
                            <select name="rentang_usia"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Pilih Rentang Usia</option>
                                <option value="20-25">20-25</option>
                                <option value="26-30">26-30</option>
                                <option value="31-35">31-35</option>
                                <option value="36-40">36-40</option>
                                <option value="41-45">41-45</option>
                                <option value="46-50">46-50</option>
                                <option value="> 50">> 50</option>
                            </select>
                        </div>

                        <!-- Nama Organisasi -->
                        <div class="mb-3">
                            <label for="nama_organisasi" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                Organisasi</label>
                            <input type="text" name="nama_organisasi"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>

                        <!-- Jenis Organisasi -->
                        <div class="mb-3">
                            <label for="jenis_organisasi" class="block text-sm font-medium text-gray-700 mb-2">Jenis
                                Organisasi</label>
                            <select name="organisasi"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Pilih Jenis Organisasi</option>
                                <option value="Personal">Personal</option>
                                <option value="Pemerintah">Pemerintah</option>
                                <option value="Lembaga Pendidikan">Lembaga Pendidikan</option>
                                <option value="Komunitas">Komunitas</option>
                                <option value="Organisasi Nirlaba">Organisasi Nirlaba</option>
                                <option value="Perusahaan">Perusahaan</option>
                                <option value="Partai Politik">Partai Politik</option>
                            </select>
                        </div>

                        <!-- Jabatan -->
                        <div class="mb-3">
                            <label for="jabatan_peserta"
                                   class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                            <input type="text" name="jabatan_peserta"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>

                        <!-- Negara -->
                        <div class="mb-3">
                            <label for="negara" class="block text-sm font-medium text-gray-700 mb-2">Negara</label>
                            <select
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent select2 select-negara @error('id_negara') border-red-500 @enderror"
                                name="id_negara">
                                <option value="">Pilih Negara</option>
                                @foreach ($negara as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('id_negara') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_negara }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_negara')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Provinsi -->
                        <div class="mb-3">
                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                            <select
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent select2 select-provinsi @error('id_provinsi') border-red-500 @enderror"
                                name="id_provinsi">
                                <option value="">Pilih Provinsi</option>
                            </select>
                            @error('id_provinsi')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kabupaten -->
                        <div class="mb-3">
                            <label for="kabupaten"
                                   class="block text-sm font-medium text-gray-700 mb-2">Kabupaten</label>
                            <select
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent select2 select-kabupaten @error('id_kabupaten') border-red-500 @enderror"
                                name="id_kabupaten">
                                <option value="">Pilih Kota</option>
                            </select>
                            @error('id_kabupaten')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <input type="text" name="alamat"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>

                        <!-- Harapan -->
                        <div class="col-span-1 md:col-span-2 mb-3">
                            <label for="harapan_pelatihan" class="block text-sm font-medium text-gray-700 mb-2">Harapan
                                Pelatihan</label>
                            <textarea name="harapan_pelatihan"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                      rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end space-x-5 px-6 py-3 border-t border-gray-200 bg-gray-50">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-md transition-colors duration-200">
                        Simpan
                    </button>
                    <button type="button"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-md transition-colors duration-200"
                            data-dismiss="modal">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')

    <!-- XLSX Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        $(document).ready(function () {

            let allData = @json($peserta);
            let filteredData = [...allData];
            let currentPage = 1;
            let itemsPerPage = 25;
            let originalTableBody = document.getElementById('tableBody').innerHTML;

            // Event listeners
            document.getElementById('searchInput').addEventListener('input', handleSearch);
            document.getElementById('entriesSelect').addEventListener('change', handleEntriesChange);

            function handleSearch() {
                const searchTerm = document.getElementById('searchInput').value.toLowerCase();
                if (searchTerm === '') {
                    filteredData = [...allData];
                } else {
                    filteredData = allData.filter(item =>
                        item.nama_peserta.toLowerCase().includes(searchTerm) ||
                        item.email_peserta.toLowerCase().includes(searchTerm) ||
                        item.nama_organisasi.toLowerCase().includes(searchTerm) ||
                        item.jabatan_peserta.toLowerCase().includes(searchTerm) ||
                        item.provinsi.toLowerCase().includes(searchTerm) ||
                        item.kabupaten_kota.toLowerCase().includes(searchTerm)
                    );
                }
                currentPage = 1;
                renderTable();
                renderPagination();
            }

            function handleEntriesChange() {
                itemsPerPage = parseInt(document.getElementById('entriesSelect').value);
                currentPage = 1;
                renderTable();
                renderPagination();
            }

            function renderTable() {
                const tbody = document.getElementById('tableBody');
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const currentData = filteredData.slice(startIndex, endIndex);

                if (currentData.length === 0) {
                    tbody.innerHTML = `
                <tr>
                    <td colspan="15" class="text-center py-10 text-gray-500">
                        <div class="flex flex-col items-center gap-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <div>
                                <div class="font-semibold mb-1">Tidak ada data yang ditemukan</div>
                                <div class="text-sm">Coba ubah kata kunci pencarian Anda</div>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
                    return;
                }

                tbody.innerHTML = currentData.map(item => `
            <tr class="hover:bg-gray-50 transition-colors duration-200">
                <td class="px-4 py-2 text-sm text-gray-900 sticky left-0 bg-white z-10" title="${item.nama_peserta}">${item.nama_peserta}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.email_peserta}">${item.email_peserta}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.no_hp}">${item.no_hp}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.rentang_usia}">${item.rentang_usia}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.gender}">${item.gender}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.kabupaten_kota}">${item.kabupaten_kota}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.provinsi}">${item.provinsi}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.negara}">${item.negara}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.nama_organisasi}">${item.nama_organisasi}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.jenis_organisasi}">${item.jenis_organisasi}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.jabatan_peserta}">${item.jabatan_peserta}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.informasi}">${item.informasi}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.pelatihan_relevan}">${item.pelatihan_relevan}</td>
                <td class="px-4 py-2 text-sm text-gray-900 editable" title="${item.harapan_pelatihan}">${item.harapan_pelatihan}</td>
                <td class="px-4 py-2 w-40 min-w-[192px]">
    <select class="w-full px-3 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 status-dropdown" data-id="${item.id}">
        <option value="belum_bayar" ${item.status_bayar === 'belum_bayar' ? 'selected' : ''}>Belum Bayar</option>
        <option value="sudah_bayar" ${item.status_bayar === 'sudah_bayar' ? 'selected' : ''}>Sudah Bayar</option>
    </select>
</td>
            </tr>
        `).join('');

                attachStatusDropdownListeners();

                // Re-initialize tooltips for new elements
                if (typeof tippy !== 'undefined') {
                    tippy('[title]', {
                        content(reference) {
                            const title = reference.getAttribute('title');
                            reference.removeAttribute('title');
                            return title;
                        },
                        arrow: true,
                        theme: 'light-border'
                    });
                }
            }

            function renderPagination() {
                const totalPages = Math.ceil(filteredData.length / itemsPerPage);
                const startItem = filteredData.length === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
                const endItem = Math.min(currentPage * itemsPerPage, filteredData.length);

                const paginationInfo = document.getElementById('paginationInfo');
                if (paginationInfo) {
                    paginationInfo.textContent = `Menampilkan ${startItem}-${endItem} dari ${filteredData.length} data`;
                }

                const prevButton = document.getElementById('prevButton');
                const nextButton = document.getElementById('nextButton');

                if (prevButton) prevButton.disabled = currentPage <= 1;
                if (nextButton) nextButton.disabled = currentPage >= totalPages;

                const pageNumbers = document.getElementById('pageNumbers');
                if (pageNumbers) {
                    let pageNumbersHtml = '';
                    const maxVisiblePages = 5;
                    let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                    if (endPage - startPage < maxVisiblePages - 1) {
                        startPage = Math.max(1, endPage - maxVisiblePages + 1);
                    }

                    for (let i = startPage; i <= endPage; i++) {
                        const activeClass = i === currentPage ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-50';
                        pageNumbersHtml += `
                    <button class="page-button px-3 py-2 text-sm border border-gray-300 ${activeClass} transition-colors duration-200" onclick="goToPage(${i})">
                        ${i}
                    </button>
                `;
                    }
                    pageNumbers.innerHTML = pageNumbersHtml;
                }
            }

            function attachStatusDropdownListeners() {
                document.querySelectorAll('.status-dropdown').forEach(dropdown => {
                    dropdown.addEventListener('change', function () {
                        const status = this.value;
                        const id = this.getAttribute('data-id');
                        const originalStatus = this.dataset.originalValue || (status === 'sudah_bayar' ? 'belum_bayar' : 'sudah_bayar');

                        // Store original value for potential revert
                        this.dataset.originalValue = originalStatus;

                        updateLocalData(id, status);

                        fetch(`/admin/update-status-peserta/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({status: status})
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Status berhasil diperbarui',
                                        timer: 2000,
                                        showConfirmButton: false,
                                        toast: true,
                                        position: 'bottom-end'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan pada server',
                                        timer: 2000,
                                        showConfirmButton: false,
                                        toast: true,
                                        position: 'bottom-end'
                                    });
                                    revertLocalData(id, originalStatus);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                showNotification('error', 'Terjadi kesalahan sistem');
                                revertLocalData(id, originalStatus);
                            });
                    });
                });
            }

            // Custom notification function using Notyf
            function showNotification(type, message) {
                if (typeof notyf !== 'undefined') {
                    notyf.open({
                        type: type,
                        message: message
                    });
                } else {
                    // Fallback to browser alert
                    alert(message);
                }
            }

            function updateLocalData(id, newStatus) {
                const itemIndex = allData.findIndex(item => item.id == id);
                if (itemIndex !== -1) {
                    allData[itemIndex].status_bayar = newStatus;
                    const filteredIndex = filteredData.findIndex(item => item.id == id);
                    if (filteredIndex !== -1) {
                        filteredData[filteredIndex].status_bayar = newStatus;
                    }
                }
            }

            function revertLocalData(id, originalStatus) {
                updateLocalData(id, originalStatus);
                const dropdown = document.querySelector(`.status-dropdown[data-id="${id}"]`);
                if (dropdown) {
                    dropdown.value = originalStatus;
                }
            }

            // Global functions
            window.changePage = function (direction) {
                const totalPages = Math.ceil(filteredData.length / itemsPerPage);
                const newPage = currentPage + direction;
                if (newPage >= 1 && newPage <= totalPages) {
                    currentPage = newPage;
                    renderTable();
                    renderPagination();
                }
            };

            window.goToPage = function (page) {
                currentPage = page;
                renderTable();
                renderPagination();
            };

            window.exportToExcel = function () {
                try {
                    const exportData = filteredData.map(item => ({
                        'Nama Peserta': item.nama_peserta,
                        'Email Peserta': item.email_peserta,
                        'No. HP': item.no_hp,
                        'Rentang Usia': item.rentang_usia,
                        'Gender': item.gender,
                        'Kabupaten/Kota': item.kabupaten_kota,
                        'Provinsi': item.provinsi,
                        'Negara': item.negara,
                        'Nama Organisasi': item.nama_organisasi,
                        'Jenis Organisasi': item.jenis_organisasi,
                        'Jabatan Peserta': item.jabatan_peserta,
                        'Informasi Pelatihan': item.informasi_pelatihan,
                        'Pelatihan Relevan': item.pelatihan_relevan,
                        'Harapan Pelatihan': item.harapan_pelatihan,
                        'Status Bayar': item.status_bayar === 'sudah_bayar' ? 'Sudah Bayar' : 'Belum Bayar'
                    }));

                    const wb = XLSX.utils.book_new();
                    const ws = XLSX.utils.json_to_sheet(exportData);

                    const colWidths = [
                        {wch: 20}, {wch: 25}, {wch: 15}, {wch: 12}, {wch: 10},
                        {wch: 18}, {wch: 15}, {wch: 12}, {wch: 20}, {wch: 18},
                        {wch: 18}, {wch: 18}, {wch: 18}, {wch: 25}, {wch: 20}
                    ];
                    ws['!cols'] = colWidths;

                    XLSX.utils.book_append_sheet(wb, ws, 'Peserta Reguler');

                    const now = new Date();
                    const timestamp = now.toISOString().slice(0, 10).replace(/-/g, '');
                    const filename = `data_peserta_reguler_${timestamp}.xlsx`;

                    XLSX.writeFile(wb, filename);
                    showNotification('success', `File Excel berhasil diunduh: ${filename}`);

                } catch (error) {
                    console.error('Error saat export Excel:', error);
                    showNotification('error', 'Terjadi kesalahan saat mengunduh file Excel');
                }
            };

            // Initialize table
            renderTable();
            renderPagination();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Fungsi untuk menampilkan modal
            function showModal(modalId) {
                $('#' + modalId).removeClass('hidden').addClass('flex');
                $('body').addClass('overflow-hidden'); // Prevent background scroll
            }

            // Fungsi untuk menyembunyikan modal
            function hideModal(modalId) {
                $('#' + modalId).addClass('hidden').removeClass('flex');
                $('body').removeClass('overflow-hidden');

                // Reset form ketika modal ditutup
                $('#' + modalId + ' form')[0].reset();

                // Reset dropdown select2
                $('#' + modalId + ' .select2').val(null).trigger('change');
            }

            // Event listener untuk tombol yang membuka modal
            // Ganti 'btn-tambah-peserta' dengan ID atau class tombol Anda
            $(document).on('click', '#btn-tambah-peserta, .btn-tambah-peserta', function (e) {
                e.preventDefault();
                showModal('modalTambahPeserta');
            });

            // Event listener untuk tombol close (X) di modal
            $(document).on('click', '[data-dismiss="modal"]', function () {
                const modalId = $(this).closest('.fixed').attr('id');
                hideModal(modalId);
            });

            // Event listener untuk menutup modal ketika klik di background/overlay
            $(document).on('click', '.fixed.inset-0', function (e) {
                if (e.target === this) {
                    const modalId = $(this).attr('id');
                    hideModal(modalId);
                }
            });

            // Event listener untuk tombol ESC
            $(document).keydown(function (e) {
                if (e.key === "Escape") {
                    $('.fixed.inset-0:not(.hidden)').each(function () {
                        const modalId = $(this).attr('id');
                        hideModal(modalId);
                    });
                }
            });

            // Inisialisasi Select2
            $('.select2 select-negara').select2();
            $('.select2 select-provinsi').select2();
            $('.select2 select-kabupaten').select2();

            // Event listener untuk Negara -> Ambil daftar provinsi
            $(document).on('change', '.select-negara', function () {
                var negaraId = $(this).val();
                var provinsiSelect = $('.select-provinsi');
                var kabupatenSelect = $('.select-kabupaten');

                // Reset Provinsi dan Kabupaten
                provinsiSelect.empty().append('<option value="">Pilih Provinsi</option>').trigger('change');
                kabupatenSelect.empty().append('<option value="">Pilih Kabupaten/Kota</option>').trigger('change');

                if (negaraId) {
                    // Show loading state
                    provinsiSelect.append('<option value="">Loading...</option>').trigger('change');

                    $.ajax({
                        url: '/get-provinsi-reguler/' + negaraId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            console.log('Response provinsi:', response);

                            var options = '<option value="">Pilih Provinsi</option>';

                            // Handle different response formats
                            if (response.success && response.provinsi) {
                                // Format: {success: true, provinsi: {id: name, ...}}
                                $.each(response.provinsi, function (key, value) {
                                    options += '<option value="' + key + '">' + value + '</option>';
                                });
                            } else if (response.provinsi) {
                                // Format: {provinsi: {id: name, ...}}
                                $.each(response.provinsi, function (key, value) {
                                    options += '<option value="' + key + '">' + value + '</option>';
                                });
                            } else if (Array.isArray(response)) {
                                // Format: [{id: 1, nama_provinsi: 'name'}, ...]
                                $.each(response, function (index, item) {
                                    options += '<option value="' + item.id + '">' + item.nama_provinsi + '</option>';
                                });
                            }

                            provinsiSelect.html(options).trigger('change');
                        },
                        error: function (xhr, status, error) {
                            console.error('Error loading provinsi:', xhr.responseText);
                            provinsiSelect.html('<option value="">Error loading data</option>');

                            // Show user-friendly error
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Gagal memuat data provinsi. Silakan coba lagi.'
                                });
                            } else {
                                alert('Gagal memuat data provinsi. Silakan coba lagi.');
                            }
                        }
                    });
                }
            });

            // Event listener untuk Provinsi -> Ambil daftar kabupaten
            $(document).on('change', '.select-provinsi', function () {
                var provinsiId = $(this).val();
                var kabupatenSelect = $('.select-kabupaten');

                // Reset Kabupaten
                kabupatenSelect.empty().append('<option value="">Pilih Kabupaten/Kota</option>').trigger('change');

                if (provinsiId) {
                    // Show loading state
                    kabupatenSelect.append('<option value="">Loading...</option>').trigger('change');

                    $.ajax({
                        url: '/get-kabupaten-reguler/' + provinsiId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            console.log('Response kabupaten:', response);

                            var options = '<option value="">Pilih Kabupaten/Kota</option>';

                            // Handle different response formats
                            if (response.success && response.kabupaten) {
                                // Format: {success: true, kabupaten: {id: name, ...}}
                                $.each(response.kabupaten, function (key, value) {
                                    options += '<option value="' + key + '">' + value + '</option>';
                                });
                            } else if (response.kabupaten) {
                                // Format: {kabupaten: {id: name, ...}}
                                $.each(response.kabupaten, function (key, value) {
                                    options += '<option value="' + key + '">' + value + '</option>';
                                });
                            } else if (Array.isArray(response)) {
                                // Format: [{id: 1, nama_kabupaten: 'name'}, ...]
                                $.each(response, function (index, item) {
                                    options += '<option value="' + item.id + '">' + item.nama_kabupaten + '</option>';
                                });
                            }

                            kabupatenSelect.html(options).trigger('change');
                        },
                        error: function (xhr, status, error) {
                            console.error('Error loading kabupaten:', xhr.responseText);
                            kabupatenSelect.html('<option value="">Error loading data</option>');

                            // Show user-friendly error
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Gagal memuat data kabupaten. Silakan coba lagi.'
                                });
                            } else {
                                alert('Gagal memuat data kabupaten. Silakan coba lagi.');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
