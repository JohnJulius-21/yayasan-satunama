@extends('layouts.app')
@section('title', 'Admin | Upload Sertifikat Reguler')
@section('content')
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('sertiRegulerAdmin') }}"
                   class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-800 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Reguler
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Upload Sertifikat Pelatihan</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Daftar Peserta Pelatihan</h1>
                <p class="text-lg text-green-600 font-semibold">{{ $reguler->nama_pelatihan }}</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                    </svg>
                    <span>{{ count($reguler->peserta) }} Peserta</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        timer: 4000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'bottom-end'
                    });
                } else {
                    showSimpleNotification('success', 'Berhasil!', "{{ session('success') }}");
                }
            });
        </script>
    @endif

    <!-- Filter & Search Controls -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-4">
                <label class="text-sm font-medium text-gray-700">Tampilkan:</label>
                <select id="entriesPerPage" class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="-1">Semua</option>
                </select>
                <span class="text-sm text-gray-500">data per halaman</span>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Progress indicator -->
                <div class="flex items-center space-x-2">
                    @php
                        $totalPeserta = count($reguler->peserta);
                        $sudahUpload = 0;
                        foreach($reguler->peserta as $p) {
                            $sertifikat = DB::table('reguler_sertifikat')
                                ->where('id_reguler', $reguler->id_reguler)
                                ->where('id_peserta', $p->id_peserta_reguler)
                                ->first();
                            if($sertifikat) $sudahUpload++;
                        }
                        $progress = $totalPeserta > 0 ? ($sudahUpload / $totalPeserta) * 100 : 0;
                    @endphp
                    <span class="text-gray-600 text-sm">Progress:</span>
                    <div class="w-32 bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full transition-all duration-300" style="width: {{ $progress }}%"></div>
                    </div>
                    <span class="font-medium text-gray-700 text-sm">{{ $sudahUpload }}/{{ $totalPeserta }}</span>
                </div>

                <!-- Search -->
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari peserta..."
                           class="border border-gray-300 rounded-md pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <!-- Card Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-lg">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Daftar Peserta
            </h3>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table id="pesertaTable" class="w-full table-auto">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                            <span>Pilih Semua</span>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" onclick="sortTable(1)">
                        <div class="flex items-center space-x-1">
                            <span>Nama Peserta</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        File Sertifikat
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" onclick="sortTable(3)">
                        <div class="flex items-center space-x-1">
                            <span>Status</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                @foreach ($reguler->peserta as $index => $p)
                    <tr class="hover:bg-gray-50 transition-colors table-row" data-name="{{ strtolower($p->nama_peserta) }}" data-peserta-id="{{ $p->id_peserta_reguler }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox"
                                   class="peserta-checkbox rounded border-gray-300 text-green-600 focus:ring-green-500"
                                   data-peserta-id="{{ $p->id_peserta_reguler }}"
                                   data-nama="{{ $p->nama_peserta }}">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">
                                            {{ strtoupper(substr($p->nama_peserta, 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $p->nama_peserta }}</div>
                                    <div class="text-sm text-gray-500">Peserta {{ $index + 1 }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="relative flex-1">
                                    <input type="file"
                                           name="file_sertifikat"
                                           id="file_{{ $p->id_peserta_reguler }}"
                                           data-peserta-id="{{ $p->id_peserta_reguler }}"
                                           data-action="{{ route('sertiRegulerUploadAdmin', $p->id_peserta_reguler) }}"
                                           accept=".pdf,.jpg,.jpeg,.png"
                                           class="hidden file-input">
                                    <label for="file_{{ $p->id_peserta_reguler }}"
                                           class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors w-full justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        Pilih File
                                    </label>
                                    <div class="mt-2">
                                        <span id="filename_{{ $p->id_peserta_reguler }}"
                                              class="text-xs text-gray-500 block truncate">
                                            Tidak ada file dipilih
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $sertifikat = DB::table('reguler_sertifikat')
                                    ->where('id_reguler', $reguler->id_reguler)
                                    ->where('id_peserta', $p->id_peserta_reguler)
                                    ->first();
                            @endphp
                            @if ($sertifikat)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 status-badge" data-status="uploaded">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Sudah Upload
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 status-badge" data-status="pending">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                    Belum Upload
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-lg">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                    Menampilkan <span id="showingStart">1</span> sampai <span id="showingEnd">10</span> dari <span id="totalEntries">{{ count($reguler->peserta) }}</span> data
                </div>
                <div class="flex items-center space-x-2">
                    <button id="prevPage" class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        Sebelumnya
                    </button>
                    <div id="pageNumbers" class="flex items-center space-x-1">
                        <!-- Page numbers will be inserted here -->
                    </div>
                    <button id="nextPage" class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        Selanjutnya
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Panel -->
    <div id="floatingPanel" class="fixed bottom-6 right-6 bg-white rounded-lg shadow-2xl border border-gray-200 p-4 max-w-sm transform transition-all duration-300 translate-y-full opacity-0 pointer-events-none z-50">
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-sm font-semibold text-gray-900">Upload Sertifikat</h4>
            <button id="closePanelBtn" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div id="selectedFiles" class="space-y-2 mb-4 max-h-40 overflow-y-auto">
            <!-- Selected files will be listed here -->
        </div>

        <div class="flex space-x-2">
            <button id="uploadSelectedBtn"
                    class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="upload-text">Upload Terpilih</span>
                <span class="loading-text hidden">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Mengupload...
                </span>
            </button>
            <button id="clearSelectionBtn"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                Batal
            </button>
        </div>

        <div id="uploadProgress" class="hidden mt-3">
            <div class="text-xs text-gray-600 mb-1">Progress Upload:</div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="progressBar" class="bg-green-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
            <div class="text-xs text-gray-600 mt-1">
                <span id="progressText">0 / 0</span>
            </div>
        </div>
    </div>

    <!-- Hidden form for CSRF -->
    <form id="hiddenUploadForm" method="POST" enctype="multipart/form-data" style="display: none;">
        @csrf
    </form>

    <script>
        // Global variables
        let selectedFiles = new Map(); // pesertaId => {file, nama, action}
        let currentPage = 1;
        let entriesPerPage = 10;
        let filteredRows = [];
        let allRows = [];

        document.addEventListener('DOMContentLoaded', function() {
            console.log('Initializing floating upload system...');

            initializeTable();
            initializeFloatingPanel();
            initializeSearch();
            initializePagination();
        });

        function initializeTable() {
            const tableBody = document.getElementById('tableBody');
            if (tableBody) {
                allRows = Array.from(tableBody.querySelectorAll('.table-row'));
                filteredRows = [...allRows];
                updateTable();
            }
        }

        function initializeFloatingPanel() {
            // File input change handler
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('file-input')) {
                    console.log('File input changed:', e.target.id);
                    handleFileSelect(e.target);
                }
            });

            // Select all checkbox
            const selectAllCheckbox = document.getElementById('selectAll');
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.peserta-checkbox');
                    checkboxes.forEach(cb => {
                        cb.checked = this.checked;
                        handleCheckboxChange(cb);
                    });
                });
            }

            // Individual checkboxes
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('peserta-checkbox')) {
                    handleCheckboxChange(e.target);
                }
            });

            // Upload button
            const uploadBtn = document.getElementById('uploadSelectedBtn');
            if (uploadBtn) {
                uploadBtn.addEventListener('click', function() {
                    console.log('Upload button clicked');
                    uploadSelectedFiles();
                });
            }

            // Clear selection button
            const clearBtn = document.getElementById('clearSelectionBtn');
            if (clearBtn) {
                clearBtn.addEventListener('click', function() {
                    clearSelection();
                });
            }

            // Close panel button
            const closeBtn = document.getElementById('closePanelBtn');
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    hideFloatingPanel();
                });
            }
        }

        function handleFileSelect(fileInput) {
            const pesertaId = fileInput.dataset.pesertaId;
            const file = fileInput.files[0];

            if (!file) {
                // Remove from selection if file is cleared
                selectedFiles.delete(pesertaId);
                updateFileDisplay(fileInput, 'Tidak ada file dipilih');
                updateFloatingPanel();
                return;
            }

            // Validate file
            const allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
            const fileExtension = file.name.split('.').pop().toLowerCase();

            if (!allowedExtensions.includes(fileExtension)) {
                showNotification('error', 'Format File Tidak Valid', 'File harus berformat PDF, JPG, JPEG, atau PNG');
                fileInput.value = '';
                updateFileDisplay(fileInput, 'Tidak ada file dipilih');
                return;
            }

            const maxSize = 5 * 1024 * 1024; // 5MB
            if (file.size > maxSize) {
                showNotification('error', 'File Terlalu Besar', 'Ukuran file maksimal 5MB');
                fileInput.value = '';
                updateFileDisplay(fileInput, 'Tidak ada file dipilih');
                return;
            }

            // Add to selection
            const row = fileInput.closest('tr');
            const namaElement = row.querySelector('.text-gray-900');
            const nama = namaElement ? namaElement.textContent.trim() : 'Unknown';
            const action = fileInput.dataset.action;

            selectedFiles.set(pesertaId, {
                file: file,
                nama: nama,
                action: action
            });

            updateFileDisplay(fileInput, file.name);

            // Auto-check the checkbox
            const checkbox = row.querySelector('.peserta-checkbox');
            if (checkbox) {
                checkbox.checked = true;
            }

            updateFloatingPanel();
        }

        function handleCheckboxChange(checkbox) {
            const pesertaId = checkbox.dataset.pesertaId;

            if (!checkbox.checked) {
                // Remove from selection
                selectedFiles.delete(pesertaId);

                // Clear file input
                const fileInput = document.getElementById('file_' + pesertaId);
                if (fileInput) {
                    fileInput.value = '';
                    updateFileDisplay(fileInput, 'Tidak ada file dipilih');
                }
            }

            updateFloatingPanel();
        }

        function updateFileDisplay(fileInput, filename) {
            const pesertaId = fileInput.dataset.pesertaId;
            const filenameElement = document.getElementById('filename_' + pesertaId);

            if (filenameElement) {
                filenameElement.textContent = filename;
                filenameElement.className = filename !== 'Tidak ada file dipilih' ?
                    'text-xs text-gray-700 font-medium block truncate' :
                    'text-xs text-gray-500 block truncate';
            }
        }

        function updateFloatingPanel() {
            const panel = document.getElementById('floatingPanel');
            const selectedFilesDiv = document.getElementById('selectedFiles');
            const uploadBtn = document.getElementById('uploadSelectedBtn');

            if (!panel || !selectedFilesDiv || !uploadBtn) return;

            // Update selected files list
            selectedFilesDiv.innerHTML = '';

            if (selectedFiles.size === 0) {
                hideFloatingPanel();
                return;
            }

            selectedFiles.forEach((data, pesertaId) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'flex items-center justify-between p-2 bg-gray-50 rounded text-xs';
                fileItem.innerHTML = `
                    <div class="flex-1 min-w-0">
                        <div class="font-medium text-gray-900 truncate">${data.nama}</div>
                        <div class="text-gray-500 truncate">${data.file.name}</div>
                    </div>
                    <button onclick="removeSelection('${pesertaId}')" class="text-red-500 hover:text-red-700 ml-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                `;
                selectedFilesDiv.appendChild(fileItem);
            });

            // Update upload button text
            const uploadText = uploadBtn.querySelector('.upload-text');
            if (uploadText) {
                uploadText.textContent = `Upload ${selectedFiles.size} File${selectedFiles.size > 1 ? 's' : ''}`;
            }

            showFloatingPanel();
        }

        function showFloatingPanel() {
            const panel = document.getElementById('floatingPanel');
            if (panel) {
                panel.classList.remove('translate-y-full', 'opacity-0', 'pointer-events-none');
                panel.classList.add('translate-y-0', 'opacity-100');
            }
        }

        function hideFloatingPanel() {
            const panel = document.getElementById('floatingPanel');
            if (panel) {
                panel.classList.add('translate-y-full', 'opacity-0', 'pointer-events-none');
                panel.classList.remove('translate-y-0', 'opacity-100');
            }
        }

        function removeSelection(pesertaId) {
            selectedFiles.delete(pesertaId);

            // Uncheck checkbox
            const checkbox = document.querySelector(`.peserta-checkbox[data-peserta-id="${pesertaId}"]`);
            if (checkbox) {
                checkbox.checked = false;
            }

            // Clear file input
            const fileInput = document.getElementById('file_' + pesertaId);
            if (fileInput) {
                fileInput.value = '';
                updateFileDisplay(fileInput, 'Tidak ada file dipilih');
            }

            updateFloatingPanel();
        }

        function clearSelection() {
            selectedFiles.clear();

            // Uncheck all checkboxes
            const checkboxes = document.querySelectorAll('.peserta-checkbox');
            checkboxes.forEach(cb => cb.checked = false);

            const selectAll = document.getElementById('selectAll');
            if (selectAll) selectAll.checked = false;

            // Clear all file inputs
            const fileInputs = document.querySelectorAll('.file-input');
            fileInputs.forEach(input => {
                input.value = '';
                updateFileDisplay(input, 'Tidak ada file dipilih');
            });

            hideFloatingPanel();
        }

        async function uploadSelectedFiles() {
            if (selectedFiles.size === 0) return;

            const uploadBtn = document.getElementById('uploadSelectedBtn');
            const progressDiv = document.getElementById('uploadProgress');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');

            // Show loading state
            if (uploadBtn) {
                uploadBtn.disabled = true;
                uploadBtn.querySelector('.upload-text').classList.add('hidden');
                uploadBtn.querySelector('.loading-text').classList.remove('hidden');
            }

            if (progressDiv && progressBar && progressText) {
                progressDiv.classList.remove('hidden');
                progressBar.style.width = '0%';
                progressText.textContent = `0 / ${selectedFiles.size}`;
            }

            let completed = 0;
            const total = selectedFiles.size;
            const results = [];

            // Upload files one by one
            for (const [pesertaId, data] of selectedFiles) {
                try {
                    const formData = new FormData();
                    formData.append('file_sertifikat', data.file);
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                        document.querySelector('input[name="_token"]')?.value);

                    const response = await fetch(data.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    completed++;

                    // Update progress
                    if (progressBar && progressText) {
                        const percentage = (completed / total) * 100;
                        progressBar.style.width = percentage + '%';
                        progressText.textContent = `${completed} / ${total}`;
                    }

                    if (response.ok) {
                        results.push({ pesertaId, success: true, nama: data.nama });

                        // Update status badge in table
                        updateStatusBadge(pesertaId, true);
                    } else {
                        results.push({ pesertaId, success: false, nama: data.nama, error: 'Upload failed' });
                    }

                } catch (error) {
                    completed++;
                    results.push({ pesertaId, success: false, nama: data.nama, error: error.message });

                    // Update progress even on error
                    if (progressBar && progressText) {
                        const percentage = (completed / total) * 100;
                        progressBar.style.width = percentage + '%';
                        progressText.textContent = `${completed} / ${total}`;
                    }
                }
            }

            // Show results
            const successful = results.filter(r => r.success).length;
            const failed = results.filter(r => !r.success).length;

            if (successful > 0) {
                showNotification('success', 'Upload Berhasil',
                    `${successful} file berhasil diupload${failed > 0 ? `, ${failed} gagal` : ''}`);
            }

            if (failed > 0) {
                console.log('Failed uploads:', results.filter(r => !r.success));
            }

            // Reset UI
            setTimeout(() => {
                if (uploadBtn) {
                    uploadBtn.disabled = false;
                    uploadBtn.querySelector('.upload-text').classList.remove('hidden');
                    uploadBtn.querySelector('.loading-text').classList.add('hidden');
                }

                if (progressDiv) {
                    progressDiv.classList.add('hidden');
                }

                clearSelection();

                // Refresh page to show updated status
                if (successful > 0) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            }, 1000);
        }

        function updateStatusBadge(pesertaId, uploaded) {
            const row = document.querySelector(`tr[data-peserta-id="${pesertaId}"]`);
            if (!row) return;

            const statusBadge = row.querySelector('.status-badge');
            if (!statusBadge) return;

            if (uploaded) {
                statusBadge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 status-badge';
                statusBadge.dataset.status = 'uploaded';
                statusBadge.innerHTML = `
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Sudah Upload
                `;
            }
        }

        function initializeSearch() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase().trim();

                    if (searchTerm === '') {
                        filteredRows = [...allRows];
                    } else {
                        filteredRows = allRows.filter(row => {
                            const name = row.dataset.name;
                            return name && name.includes(searchTerm);
                        });
                    }

                    currentPage = 1;
                    updateTable();
                });
            }
        }

        function initializePagination() {
            const entriesSelect = document.getElementById('entriesPerPage');
            if (entriesSelect) {
                entriesSelect.addEventListener('change', function() {
                    entriesPerPage = parseInt(this.value);
                    currentPage = 1;
                    updateTable();
                });
            }

            const prevBtn = document.getElementById('prevPage');
            const nextBtn = document.getElementById('nextPage');

            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    if (currentPage > 1) {
                        currentPage--;
                        updateTable();
                    }
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    const totalPages = Math.ceil(filteredRows.length / (entriesPerPage === -1 ? filteredRows.length : entriesPerPage));
                    if (currentPage < totalPages) {
                        currentPage++;
                        updateTable();
                    }
                });
            }
        }

        function updateTable() {
            const tableBody = document.getElementById('tableBody');
            if (!tableBody) return;

            const totalEntries = filteredRows.length;
            const entriesToShow = entriesPerPage === -1 ? totalEntries : entriesPerPage;

            // Calculate pagination
            const startIndex = entriesPerPage === -1 ? 0 : (currentPage - 1) * entriesPerPage;
            const endIndex = entriesPerPage === -1 ? totalEntries : Math.min(startIndex + entriesPerPage, totalEntries);

            // Clear and show appropriate rows
            tableBody.innerHTML = '';
            for (let i = startIndex; i < endIndex; i++) {
                if (filteredRows[i]) {
                    tableBody.appendChild(filteredRows[i]);
                }
            }

            // Update pagination info
            const showingStart = document.getElementById('showingStart');
            const showingEnd = document.getElementById('showingEnd');
            const totalEntriesEl = document.getElementById('totalEntries');

            if (showingStart) showingStart.textContent = totalEntries === 0 ? 0 : startIndex + 1;
            if (showingEnd) showingEnd.textContent = endIndex;
            if (totalEntriesEl) totalEntriesEl.textContent = totalEntries;
        }

        function sortTable(columnIndex) {
            console.log('Sorting column:', columnIndex);
            // Implement sorting logic if needed
        }

        function showNotification(type, title, message) {
            console.log('Notification:', type, title, message);

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: type,
                    title: title,
                    text: message,
                    toast: true,
                    position: 'bottom-end',
                    timer: 4000,
                    showConfirmButton: false
                });
            } else {
                const bgColor = type === 'error' ? 'bg-red-500' :
                    type === 'warning' ? 'bg-yellow-500' : 'bg-green-500';

                const notification = document.createElement('div');
                notification.className = `fixed bottom-20 right-6 ${bgColor} text-white px-4 py-3 rounded-lg shadow-lg z-40 max-w-sm`;
                notification.innerHTML = `
                    <div class="flex items-center">
                        <div>
                            <div class="font-medium text-sm">${title}</div>
                            <div class="text-sm">${message}</div>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-3 text-white hover:text-gray-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                `;
                document.body.appendChild(notification);

                setTimeout(() => {
                    if (notification && notification.parentNode) {
                        notification.remove();
                    }
                }, 4000);
            }
        }

        function showSimpleNotification(type, title, message) {
            showNotification(type, title, message);
        }
    </script>

    <!-- Add CSRF token to meta for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
