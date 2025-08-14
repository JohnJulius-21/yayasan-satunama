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
                <h2 class="text-3xl font-bold mb-2">{{ $konsultasi->nama_pelatihan }}</h2>
                <p class="text-primary-100 mb-4">Fasilitator:
                    @foreach ($konsultasi->fasilitators as $fasilitator)
                        {{ $fasilitator->nama_fasilitator }}{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </p>
                <div class="flex items-center space-x-4 text-sm">
                    <div class="flex items-center">
                        <i class="fas fa-calendar mr-2"></i>
                        <span>{{ \Carbon\Carbon::parse($konsultasi->tanggal_mulai)->locale('id')->isoFormat('D MMMM') }}
                            -
                            {{ \Carbon\Carbon::parse($konsultasi->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($konsultasi->tanggal_mulai)->diffInDays(
                                \Carbon\Carbon::parse($konsultasi->tanggal_selesai),
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
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Presensi</p>
                    <p class="text-2xl font-bold text-gray-900">100%</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i class="fas fa-user-check text-blue-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Evaluasi</p>
                    <p class="text-2xl font-bold text-gray-900">Belum</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <i class="fas fa-star text-yellow-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Sertifikat</p>
                    <p class="text-2xl font-bold text-gray-900">Siap</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <i class="fas fa-certificate text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Sessions Timeline -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Pengumuman Pelatihan</h3>
        <div class="space-y-6">
            <div class="relative">
                <div class="flex items-center space-x-4">
                    @if (!empty($konsultasi->pengumuman))
                        {!! \Illuminate\Support\Str::words($konsultasi->pengumuman, 1000, '...') !!}
                    @else
                        <p>Belum ada pengumuman untuk pelatihan ini</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
