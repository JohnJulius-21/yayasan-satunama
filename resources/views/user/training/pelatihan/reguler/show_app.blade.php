@extends('layouts.app_user')

@section('title', 'Dashboard Pelatihan')
@section('page-title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')

    <div class="mb-3 flex flex-wrap justify-between items-center bg-white rounded-lg p-4 border">
        <a href="{{ route('reguler.pelatihan') }}"
            class="inline-flex items-center text-gray-600 hover:text-green-600 transition-colors">
            <i class="bi bi-arrow-left mr-2"></i>
            Kembali ke Pelatihan Saya
        </a>

        <div class="flex items-center text-sm text-gray-500">
            <i class="bi bi-shield-check mr-2"></i>
            Konten dilindungi - hanya untuk peserta pelatihan
        </div>
    </div>
    <!-- Course Header -->
    <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 text-white mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
            <div class="mb-6 md:mb-0">
                <h2 class="text-3xl font-bold mb-2">{{ $reguler->nama_pelatihan }}</h2>
                <p class="text-primary-100 mb-4">Fasilitator:
                    @foreach ($reguler->fasilitators as $fasilitator)
                        {{ $fasilitator->nama_fasilitator }}{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </p>
                <div class="flex items-center space-x-4 text-sm">
                    <div class="flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>{{ \Carbon\Carbon::parse($reguler->tanggal_mulai)->locale('id')->isoFormat('D MMMM') }}
                            -
                            {{ \Carbon\Carbon::parse($reguler->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($reguler->tanggal_mulai)->diffInDays(
                                \Carbon\Carbon::parse($reguler->tanggal_selesai),
                            ) + 1 }}
                            Hari
                        </span>
                    </div>
                    {{-- <div class="flex items-center">
                        <i class="fas fa-users mr-2"></i>
                        <span>15 Peserta</span>
                    </div> --}}
                </div>
            </div>
            {{-- <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center">
            <div class="text-2xl font-bold">85%</div>
            <div class="text-sm opacity-90">Progress</div>
        </div> --}}
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Presensi Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Presensi</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $persentaseKehadiran }}%</p>
                    @if ($persentaseKehadiran >= 80)
                        <span class="text-xs text-green-600 font-medium">Kehadiran Baik</span>
                    @elseif($persentaseKehadiran >= 60)
                        <span class="text-xs text-yellow-600 font-medium">Kehadiran Cukup</span>
                    @else
                        <span class="text-xs text-red-600 font-medium">Kehadiran Kurang</span>
                    @endif
                </div>
                <div
                    class="@if ($persentaseKehadiran >= 80) bg-green-100 @elseif($persentaseKehadiran >= 60) bg-yellow-100 @else bg-red-100 @endif p-3 rounded-lg">
                    <i
                        class="fas fa-user-check @if ($persentaseKehadiran >= 80) text-green-600 @elseif($persentaseKehadiran >= 60) text-yellow-600 @else text-red-600 @endif"></i>
                </div>
            </div>
        </div>

        <!-- Evaluasi Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Evaluasi</p>
                    <p class="text-2xl font-bold text-gray-900">
                        @if ($sudahEvaluasi)
                            Selesai
                        @else
                            Belum 
                        @endif
                    </p>
                    @if ($sudahEvaluasi)
                        <span class="text-xs text-green-600 font-medium">Evaluasi Terkirim</span>
                    @else
                        <span class="text-xs text-yellow-600 font-medium">Anda belum megisi evaluasi</span>
                    @endif
                </div>
                <div class="@if ($sudahEvaluasi) bg-green-100 @else bg-yellow-100 @endif p-3 rounded-lg">
                    <i
                        class="fas fa-star @if ($sudahEvaluasi) text-green-600 @else text-yellow-600 @endif"></i>
                </div>
            </div>
        </div>

        <!-- Sertifikat Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Sertifikat</p>
                    <p class="text-2xl font-bold text-gray-900">
                        @if ($sertifikatTersedia)
                            Siap
                        @else
                            Belum Tersedia
                        @endif
                    </p>
                    @if ($sertifikatTersedia)
                        <span class="text-xs text-purple-600 font-medium">Dapat Diunduh</span>
                    @else
                        @if ($persentaseKehadiran >= 80 && $sudahEvaluasi)
                            <span class="text-xs text-blue-600 font-medium">Dalam Proses</span>
                        @else
                            <span class="text-xs text-gray-500 font-medium">Syarat Belum Terpenuhi</span>
                        @endif
                    @endif
                </div>
                <div
                    class="@if ($sertifikatTersedia) bg-purple-100 @elseif($persentaseKehadiran >= 80 && $sudahEvaluasi) bg-blue-100 @else bg-gray-100 @endif p-3 rounded-lg">
                    <i
                        class="fas fa-certificate @if ($sertifikatTersedia) text-purple-600 @elseif($persentaseKehadiran >= 80 && $sudahEvaluasi) text-blue-600 @else text-gray-400 @endif"></i>
                </div>
            </div>
        </div>
    </div>

    @if (!$peserta)
        <!-- Alert jika user belum terdaftar sebagai peserta -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Perhatian:</strong> Anda belum terdaftar sebagai peserta pelatihan ini. Silakan hubungi
                        admin untuk informasi lebih lanjut.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Sessions Timeline -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Pengumuman Pelatihan</h3>
        <div class="space-y-6">
            <div class="relative">
                <div class="flex items-center space-x-4">
                    @if (!empty($reguler->pengumuman))
                        {!! \Illuminate\Support\Str::words($reguler->pengumuman, 1000, '...') !!}
                    @else
                        <p>Belum ada pengumuman untuk pelatihan ini</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
