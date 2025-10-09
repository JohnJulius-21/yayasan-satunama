@extends('layouts.app')

@section('title', 'Admin | Change the Game Academy')

@section('content')
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center pt-6 pb-4 mb-6 space-y-4 sm:space-y-0">
        <h1 class="text-2xl font-bold text-gray-900">Change the Game Academy</h1>
    </div>
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
                Tabel Daftar Pelatihan
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
                    <input type="text" id="pelatihan-search" placeholder="Cari pelatihan..."
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                        Pelatihan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        Pelatihan
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tindakan
                    </th>
                </tr>
                </thead>
                <tbody id="permintaan-tbody" class="bg-white divide-y divide-gray-200">
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 text-sm text-gray-900">Mobilizing Support
                        Batch IV
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        17-22 November 2025
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{route('ctga.admin.show')}}"
                               class="inline-flex items-center px-3 py-2 border border-blue-300 shadow-sm text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Lihat Detail
                            </a>
                            <a href="{{route('ctga.admin.stats')}}"
                               class="inline-flex items-center px-3 py-2 border border-blue-300 shadow-sm text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Statistik
                            </a>
                        </div>
                    </td>
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
