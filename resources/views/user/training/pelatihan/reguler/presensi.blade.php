@extends('layouts.app_user')

@section('title', 'Presensi')
@section('page-title', 'Presensi')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Presensi Pelatihan</h2>
        <p class="text-gray-600">Riwayat kehadiran Anda dalam pelatihan {{ $reguler->nama_pelatihan }}</p>
    </div>

    <!-- Presensi Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Kehadiran</p>
                    <p class="text-3xl font-bold text-green-600">{{ $persentaseKehadiran }}%</p>
                </div>
                <div class="bg-green-100 p-4 rounded-full">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Sesi Hadir</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $sesiHadir }}/{{ $totalSesi }}</p>
                </div>
                <div class="bg-blue-100 p-4 rounded-full">
                    <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Presensi Detail -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">

        @if ($presensiList->isNotEmpty())
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Detail Presensi</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sesi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($presensiList as $p)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($p->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $p->judul_presensi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($p->sudahPresensi)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i> Hadir
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times mr-1"></i> Belum Hadir
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500 text-white"
                                        href="{{ route('scanQrPresensi', ['id' => $reguler->id_reguler, 'presensi' => $p->id_presensi]) }}">
                                        👁️ Lihat Presensi
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="max-w-2xl mx-auto text-center py-16">
                <div class="mb-6">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Presensi Belum Tersedia</h2>
                    <p class="text-lg text-gray-600">Presensi untuk pelatihan ini belum tersedia.</p>
                </div>
            </div>
        @endif

    </div>
@endsection
