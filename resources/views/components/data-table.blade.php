@if($showBackButton)
    <div class="back-icon" onclick="history.back()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15,18 9,12 15,6"></polyline>
        </svg>
    </div>
@endif

<div class="card">
    <div class="controls">
        <div class="search-container">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input type="text"
                   id="searchInput_{{ $tableId }}"
                   placeholder="{{ $searchPlaceholder }}"
                   class="search-input"
                   value="{{ request('search') }}">
        </div>

        {{-- Dynamic Filters --}}
        @if($filters && count($filters) > 0)
            @foreach($filters as $filter)
                <select id="{{ $filter['id'] }}_{{ $tableId }}"
                        class="border border-gray-300 px-3 py-2 rounded-md w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">{{ $filter['placeholder'] ?? 'Semua' }}</option>
                    @if(isset($filter['options']))
                        @foreach($filter['options'] as $option)
                            <option value="{{ $option['value'] }}"
                                {{ request($filter['param']) == $option['value'] ? 'selected' : '' }}>
                                {{ $option['label'] }}
                            </option>
                        @endforeach
                    @endif
                </select>
            @endforeach
        @endif

        {{-- Add Button --}}
        @if(is_array($addButton) && isset($addButton['url']))
            <a href="{{ $addButton['url'] }}"
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                {{ $addButton['text'] ?? 'Tambah Data' }}
            </a>
        @endif

    </div>

    <div class="table-container">
        <table class="table" id="{{ $tableId }}">
            <thead>
            <tr>
                @foreach($columns as $column)
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider {{ $column['class'] ?? '' }}">
                        {{ $column['label'] }}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody id="tableBody_{{ $tableId }}" class="divide-y divide-gray-200 text-sm">
            {{ $slot }}
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($showPagination)
        <div class="pagination">
            @if($showEntriesSelect)
                <div style="display: flex; gap: 12px; align-items: center;">
                    <label for="entriesSelect_{{ $tableId }}"
                           style="font-size: 14px; color: #64748b;">Tampilkan:</label>
                    <select id="entriesSelect_{{ $tableId }}" class="entries-select">
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            @endif

            <div class="pagination-info" id="paginationInfo_{{ $tableId }}">
                Menampilkan 0 dari 0 data
            </div>

            <div class="pagination-controls">
                <button class="page-button" id="prevButton_{{ $tableId }}" onclick="changePage_{{ $tableId }}(-1)"
                        disabled>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15,18 9,12 15,6"></polyline>
                    </svg>
                </button>
                <div id="pageNumbers_{{ $tableId }}"></div>
                <button class="page-button" id="nextButton_{{ $tableId }}" onclick="changePage_{{ $tableId }}(1)"
                        disabled>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9,18 15,12 9,6"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    @endif
</div>

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

<!-- Ganti seluruh modal HTML dengan script ini saja -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tableId = '{{ $tableId }}';
        const deleteRoutePrefix = '{{ $deleteRoutePrefix ?? '' }}';

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

                    document.body.appendChild(form);
                    form.submit();
                }
            }
        };

        // Event delegation untuk tombol delete (untuk kompatibilitas dengan kode lama)
        document.addEventListener('click', function(event) {
            if (event.target.closest('.open-delete-modal') &&
                event.target.closest(`#${tableId}`)) {

                const deleteButton = event.target.closest('.open-delete-modal');
                const id = deleteButton.getAttribute('data-id');

                if (!id) {
                    console.error('Data ID not found on delete button');
                    return;
                }

                // Panggil fungsi openDeleteModal dengan URL yang sesuai
                const deleteUrl = `/${deleteRoutePrefix}/${id}`;
                openDeleteModal('delete', deleteUrl);
            }
        });
    });
</script>
