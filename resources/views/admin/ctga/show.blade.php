@extends('layouts.app')

@section('title', 'Admin | Detail Mobilizing Support Batch IV')

@section('content')
    <style>
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
    <a href="{{ route('ctga.admin') }}" class="back-icon mb-3" title="Kembali">
        ←
    </a>

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center pt-6 pb-4 mb-6 space-y-4 sm:space-y-0">
        <h1 class="text-2xl font-bold text-gray-900">Mobilizing Support Batch IV</h1>
    </div>
    <!-- Alert Success/Error -->
    @if(session('success'))
        <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
        <!-- Card Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                    <path fill-rule="evenodd"
                          d="M4 5a2 2 0 012-2v1a1 1 0 001 1h6a1 1 0 001-1V3a2 2 0 012 2v6.5a1.5 1.5 0 01-1.5 1.5h-7A1.5 1.5 0 016 11.5V5z"
                          clip-rule="evenodd"></path>
                </svg>
                Tabel Daftar Lembaga
            </h2>
        </div>

        <!-- Table Controls -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <!-- Entries per page -->
                <div class="flex items-center">
                    <label class="text-sm text-gray-700 mr-2">Tampilkan</label>
                    <select id="permintaan-entries"
                            class="border border-gray-300 rounded-lg px-3 py-1 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-sm text-gray-700 ml-2">entri</span>
                </div>

                <!-- Search -->
                <div class="relative">
                    <input type="text" id="lembaga-search" placeholder="Cari lembaga..."
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 w-full sm:w-64">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                        Lembaga
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        Lembaga
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak
                        Person
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                        Direktur
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Negara
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provinsi
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Kabupen/Kota
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat
                        lengkap
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File
                        Legalitas
                    </th>
                </tr>
                </thead>
                <tbody id="permintaan-tbody" class="bg-white divide-y divide-gray-200">
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    @foreach($lembaga as $item)
                        <td class="px-6 py-4 text-sm text-gray-900">{{$item->nama_lembaga}}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{$item->email_lembaga}}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{$item->kontak_lembaga}}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{$item->nama_pemimpin_lembaga}}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{$item->negara->nama_negara}}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{$item->provinsi->nama_provinsi}}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{$item->kabupaten->nama_kabupaten_kota}}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{$item->alamat_lembaga}}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $item->created_at->timezone('Asia/Jakarta')->translatedFormat('l, d F Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{route('ctga.admin.download', $item->id_registrasi)}}"
                                   class="inline-flex items-center px-3 py-2 border border-blue-300 shadow-sm text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 16v5H7v-5M12 3v13m0 0l-4-4m4 4l4-4"/>
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </td>
                    @endforeach



                </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <div class="text-sm text-gray-700">
                    {{--                    Menampilkan <span class="font-medium" id="permintaan-start">1</span> sampai <span class="font-medium" id="permintaan-end">10</span> dari <span class="font-medium" id="permintaan-total">{{ count($permintaan) }}</span> entri--}}
                </div>
                <div class="flex justify-center sm:justify-end">
                    <div id="permintaan-pagination" class="pagination-container">
                        <!-- Pagination akan digenerate oleh JavaScript -->
                        {{--                        @if(count($permintaan) > 10)--}}
                        {{--                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">--}}
                        {{--                                <button class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-300 rounded-l-md cursor-not-allowed" disabled>--}}
                        {{--                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
                        {{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>--}}
                        {{--                                    </svg>--}}
                        {{--                                </button>--}}
                        {{--                                <button class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 border-t border-b border-r border-green-600 z-10">1</button>--}}
                        {{--                                <button class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">--}}
                        {{--                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
                        {{--                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>--}}
                        {{--                                    </svg>--}}
                        {{--                                </button>--}}
                        {{--                            </nav>--}}
                        {{--                        @endif--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
