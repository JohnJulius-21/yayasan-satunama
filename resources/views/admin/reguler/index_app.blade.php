@extends('layouts.app')

@section('title', 'Admin | Pelatihan Reguler')

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
            border: 1px solid #e2e8f0;
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
            /*min-width: 1200px;*/
            /*border-spacing: 0 8px;*/
        }

        .table th {
            background: #f8fafc;
            padding: 16px 12px;
            /*text-align: left;*/
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table td {
            padding: 16px 12px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            line-height: 1.6;
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

    <!-- Judul -->
    <div class="flex items-center justify-between py-2">
        <h1 class="text-lg font-medium text-gray-600">Pelatihan Reguler</h1>
    </div>

    <div class="card">
        <div class="controls">
            <div class="search-container">
                <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <input type="text" id="searchInput" placeholder="Cari Pelatihan"
                       class="search-input"
                       value="{{ request('search') }}">
            </div>

            <select id="statusFilter"
                    class="border border-gray-300 px-3 py-2 rounded-md w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="">Semua Status Pelatihan</option>
                <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Belum Mulai</option>
                <option value="on-going" {{ request('status') == 'on-going' ? 'selected' : '' }}>Sedang Berlangsung
                </option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>

            <select id="categoryFilter"
                    class="border border-gray-300 px-3 py-2 rounded-md w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="">Semua Tema</option>
                @foreach ($tema as $item)
                    <option value="{{ $item->id }}" {{ request('category') == $item->id ? 'selected' : '' }}>
                        {{ $item->judul_tema }}
                    </option>
                @endforeach
            </select>

            <a href="{{ route('regulerCreateAdmin') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                Tambah Pelatihan
            </a>
        </div>

        <div class="table-container">
            <table class="table" id="pesertaTable">
                <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                        Pelatihan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        Pendaftaran
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        Pelatihan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tema</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                    </th>
                </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200 text-sm">
                @include('admin.reguler.table_rows')
                </tbody>
            </table>
        </div>


        <div class="pagination">
            <div style="display: flex; gap: 12px; align-items: center;">
                <label for="entriesSelect" style="font-size: 14px; color: #64748b;">Tampilkan:</label>
                <select id="entriesSelect" class="entries-select">
                    <option value="10">10</option>
                    <option value="25" selected>25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
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



    {{--    <!-- Filter -->--}}
    {{--    <div class="flex flex-col md:flex-row gap-4 mb-6 w-full">--}}
    {{--        <input type="text" id="searchInput" placeholder="Cari Pelatihan"--}}
    {{--               class="border border-gray-300 px-3 py-2 rounded-md w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-green-500"--}}
    {{--               value="{{ request('search') }}">--}}

    {{--        <select id="statusFilter"--}}
    {{--                class="border border-gray-300 px-3 py-2 rounded-md w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-green-500">--}}
    {{--            <option value="">Semua Status Pelatihan</option>--}}
    {{--            <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Belum Mulai</option>--}}
    {{--            <option value="on-going" {{ request('status') == 'on-going' ? 'selected' : '' }}>Sedang Berlangsung</option>--}}
    {{--            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>--}}
    {{--        </select>--}}

    {{--        <select id="categoryFilter"--}}
    {{--                class="border border-gray-300 px-3 py-2 rounded-md w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-green-500">--}}
    {{--            <option value="">Semua Tema</option>--}}
    {{--            @foreach ($tema as $item)--}}
    {{--                <option value="{{ $item->id }}" {{ request('category') == $item->id ? 'selected' : '' }}>--}}
    {{--                    {{ $item->judul_tema }}--}}
    {{--                </option>--}}
    {{--            @endforeach--}}
    {{--        </select>--}}

    {{--        <button type="button" id="resetFilters"--}}
    {{--                class="bg-gray-500 hover:bg-gray-600 text-white text-xs px-3 py-1.5 rounded-md transition-colors duration-200">--}}
    {{--            Reset--}}
    {{--        </button>--}}

    {{--        <a class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md w-full md:w-auto md:ml-auto text-center transition-colors duration-200"--}}
    {{--           href="{{ route('regulerCreateAdmin') }}">--}}
    {{--            + Buat Pelatihan--}}
    {{--        </a>--}}
    {{--    </div>--}}

    {{--    <!-- Loading indicator -->--}}
    {{--    <div id="loadingIndicator" class="hidden text-center py-4">--}}
    {{--        <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-green-600"></div>--}}
    {{--        <span class="ml-2 text-gray-600">Memuat...</span>--}}
    {{--    </div>--}}


    {{--    <!-- Table Responsive -->--}}
    {{--    <div class="bg-white rounded-lg shadow overflow-x-auto">--}}
    {{--        <table class="min-w-full text-left whitespace-nowrap">--}}
    {{--            <thead class="bg-gray-100 text-gray-900 text-sm font-medium">--}}
    {{--            <tr>--}}
    {{--                <th class="px-4 py-3 font-medium">Judul Pelatihan</th>--}}
    {{--                <th class="px-4 py-3 font-medium">Tanggal Pendaftaran</th>--}}
    {{--                <th class="px-4 py-3 font-medium">Tanggal Pelatihan</th>--}}
    {{--                <th class="px-4 py-3 font-medium">Tema</th>--}}
    {{--                <th class="px-4 py-3 font-medium">Status</th>--}}
    {{--                <th class="px-4 py-3 font-medium">Aksi</th>--}}
    {{--            </tr>--}}
    {{--            </thead>--}}
    {{--            <tbody id="newsTableBody" class="divide-y divide-gray-200 text-sm">--}}
    {{--            @include('admin.reguler.table_rows')--}}
    {{--            </tbody>--}}
    {{--        </table>--}}

    {{--        <!-- No data message -->--}}
    {{--        <div id="noDataMessage" class="hidden text-center py-8 text-gray-500">--}}
    {{--            <p>Tidak ada data yang ditemukan.</p>--}}
    {{--        </div>--}}

    {{--    </div>--}}


    {{--    <!-- Pagination -->--}}
    {{--    <div class="flex flex-col sm:flex-row justify-between items-center mt-6 gap-4">--}}
    {{--        <div class="flex items-center gap-2 text-sm text-gray-600">--}}
    {{--            <span>Show</span>--}}
    {{--            <form id="perPageForm">--}}
    {{--                <select name="per_page" id="entriesPerPage"--}}
    {{--                        class="border border-gray-300 px-2 py-1 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500">--}}
    {{--                    <option value="12" {{ request('per_page') == 12 ? 'selected' : '' }}>12</option>--}}
    {{--                    <option value="24" {{ request('per_page') == 24 ? 'selected' : '' }}>24</option>--}}
    {{--                    <option value="48" {{ request('per_page') == 48 ? 'selected' : '' }}>48</option>--}}
    {{--                    <option value="96" {{ request('per_page') == 96 ? 'selected' : '' }}>96</option>--}}
    {{--                </select>--}}
    {{--            </form>--}}
    {{--            <span>entries</span>--}}
    {{--        </div>--}}

    {{--        <nav class="flex items-center gap-1">--}}
    {{--            {{ $reguler->links('pagination::tailwind') }}--}}
    {{--        </nav>--}}
    {{--    </div>--}}

    {{--    <script>--}}
    {{--
    {{--    </script>--}}

    <script>
        // Tunggu DOM selesai dimuat
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM loaded, initializing reguler filters');

            let debounceTimer;
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const categoryFilter = document.getElementById('categoryFilter');
            const tableBody = document.getElementById('tableBody'); // ID yang benar dari HTML
            const paginationInfo = document.getElementById('paginationInfo');
            const entriesSelect = document.getElementById('entriesSelect');

            // Variabel untuk pagination
            let currentPage = 1;
            let totalPages = 1;
            let totalItems = 0;
            let itemsPerPage = parseInt(entriesSelect?.value) || 25;
            let allData = []; // Menyimpan semua data untuk client-side pagination

            // Debug: Check if elements exist
            console.log('Elements found:', {
                searchInput: !!searchInput,
                statusFilter: !!statusFilter,
                categoryFilter: !!categoryFilter,
                tableBody: !!tableBody,
                paginationInfo: !!paginationInfo,
                entriesSelect: !!entriesSelect
            });

            // Function to show loading
            function showLoading() {
                if (tableBody) {
                    tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center">
                        <div class="flex justify-center items-center">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-500"></div>
                            <span class="ml-2 text-gray-500">Memuat data...</span>
                        </div>
                    </td>
                </tr>
            `;
                }
            }

            // Function to show no data message
            function showNoData(message = 'Tidak ada data yang ditemukan') {
                if (tableBody) {
                    tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p>${message}</p>
                        </div>
                    </td>
                </tr>
            `;
                }
            }

            // Function to update pagination info
            function updatePaginationInfo() {
                if (paginationInfo) {
                    const startItem = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
                    const endItem = Math.min(currentPage * itemsPerPage, totalItems);
                    paginationInfo.textContent = `Menampilkan ${startItem} sampai ${endItem} dari ${totalItems} data`;
                }
            }

            // Function to update pagination controls
            function updatePaginationControls() {
                totalPages = Math.ceil(totalItems / itemsPerPage);

                const prevButton = document.getElementById('prevButton');
                const nextButton = document.getElementById('nextButton');
                const pageNumbers = document.getElementById('pageNumbers');

                // Update prev/next buttons
                if (prevButton) {
                    prevButton.disabled = currentPage <= 1;
                    prevButton.style.opacity = currentPage <= 1 ? '0.5' : '1';
                }

                if (nextButton) {
                    nextButton.disabled = currentPage >= totalPages;
                    nextButton.style.opacity = currentPage >= totalPages ? '0.5' : '1';
                }

                // Update page numbers
                if (pageNumbers) {
                    pageNumbers.innerHTML = '';

                    if (totalPages > 0) {
                        // Show page numbers (max 5 pages visible)
                        let startPage = Math.max(1, currentPage - 2);
                        let endPage = Math.min(totalPages, startPage + 4);

                        if (endPage - startPage < 4) {
                            startPage = Math.max(1, endPage - 4);
                        }

                        for (let i = startPage; i <= endPage; i++) {
                            const pageButton = document.createElement('button');
                            pageButton.className = `page-button ${i === currentPage ? 'active' : ''}`;
                            pageButton.textContent = i;
                            pageButton.onclick = () => goToPage(i);
                            pageNumbers.appendChild(pageButton);
                        }
                    }
                }
            }

            // Function to go to specific page
            function goToPage(page) {
                if (page >= 1 && page <= totalPages && page !== currentPage) {
                    currentPage = page;
                    displayCurrentPage();
                    updatePaginationControls();
                    updatePaginationInfo();
                }
            }

            // Function to change page (prev/next) - Make it global for onclick handlers
            window.changePage = function (direction) {
                const newPage = currentPage + direction;
                goToPage(newPage);
            }

            // Function to display current page data
            function displayCurrentPage() {
                if (!allData || allData.length === 0) {
                    showNoData();
                    updatePaginationInfo();
                    return;
                }

                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, allData.length);
                const pageData = allData.slice(startIndex, endIndex);

                // Render table rows
                if (tableBody) {
                    tableBody.innerHTML = pageData.join('');
                }

                updatePaginationInfo();
            }

            // Function to perform search and filter
            function performSearch() {
                const searchTerm = searchInput ? searchInput.value.trim() : '';
                const statusValue = statusFilter ? statusFilter.value : '';
                const categoryValue = categoryFilter ? categoryFilter.value : '';

                console.log('Performing search with:', {
                    search: searchTerm,
                    status: statusValue,
                    category: categoryValue
                });

                showLoading();

                // Build URL with parameters
                const url = new URL(window.location.pathname, window.location.origin);
                if (searchTerm) url.searchParams.set('search', searchTerm);
                if (statusValue) url.searchParams.set('status', statusValue);
                if (categoryValue) url.searchParams.set('category', categoryValue);

                // Get all data for client-side pagination
                url.searchParams.set('per_page', 1000);

                console.log('Fetching URL:', url.toString());

                fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }
                })
                    .then(response => {
                        console.log('Response status:', response.status);

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);

                        if (data.success && tableBody) {
                            tableBody.innerHTML = data.html;

                            totalItems = data.total;
                            currentPage = data.current_page ?? 1;

                            if (totalItems === 0) {
                                showNoData('Tidak ada data yang sesuai dengan filter');
                            }

                            updatePaginationControls();
                            updatePaginationInfo();

                            // Update browser URL
                            const displayUrl = new URL(window.location.pathname, window.location.origin);
                            if (searchTerm) displayUrl.searchParams.set('search', searchTerm);
                            if (statusValue) displayUrl.searchParams.set('status', statusValue);
                            if (categoryValue) displayUrl.searchParams.set('category', categoryValue);
                            window.history.pushState({}, '', displayUrl);
                        }
                        else {
                            console.error('Invalid response format:', data);
                            showNoData('Terjadi kesalahan saat memuat data');
                            allData = [];
                            totalItems = 0;
                            updatePaginationControls();
                            updatePaginationInfo();
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        showNoData('Terjadi kesalahan saat memuat data: ' + error.message);
                        allData = [];
                        totalItems = 0;
                        updatePaginationControls();
                        updatePaginationInfo();
                    });
            }

            // Search input with debounce
            if (searchInput) {
                searchInput.addEventListener('keyup', function (e) {
                    console.log('Search input keyup:', e.target.value);
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(performSearch, 300);
                });
            }

            // Filter changes
            if (statusFilter) {
                statusFilter.addEventListener('change', function (e) {
                    console.log('Status filter changed:', e.target.value);
                    performSearch();
                });
            }

            if (categoryFilter) {
                categoryFilter.addEventListener('change', function (e) {
                    console.log('Category filter changed:', e.target.value);
                    performSearch();
                });
            }

            // Entries per page change
            if (entriesSelect) {
                entriesSelect.addEventListener('change', function (e) {
                    console.log('Entries per page changed:', e.target.value);
                    itemsPerPage = parseInt(e.target.value);
                    currentPage = 1; // Reset to first page
                    displayCurrentPage();
                    updatePaginationControls();
                    updatePaginationInfo();
                });
            }

            // Initialize with current data
            function initializeData() {
                // Get existing table rows
                const existingRows = tableBody ? tableBody.querySelectorAll('tr') : [];
                allData = Array.from(existingRows).map(row => row.outerHTML);
                totalItems = allData.length;

                // Initialize pagination
                displayCurrentPage();
                updatePaginationControls();
                updatePaginationInfo();
            }

            // Initialize on page load
            initializeData();

            console.log('Reguler filter initialization complete');
        });

        // Function for delete modal (global function for onclick handlers)
        window.openDeleteModal = function (type, url) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Yakin hapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create and submit form
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;

                        // Add CSRF token
                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        if (csrfToken) {
                            const csrfInput = document.createElement('input');
                            csrfInput.type = 'hidden';
                            csrfInput.name = '_token';
                            csrfInput.value = csrfToken;
                            form.appendChild(csrfInput);
                        }

                        // Add method field for DELETE
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';
                        form.appendChild(methodInput);

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            } else {
                // Fallback if SweetAlert is not available
                if (confirm('Yakin ingin menghapus data ini? Data yang dihapus tidak bisa dikembalikan!')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (csrfToken) {
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;
                        form.appendChild(csrfInput);
                    }

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(methodInput);
                    form.submit();
                }
            }
        };
    </script>
@endsection

