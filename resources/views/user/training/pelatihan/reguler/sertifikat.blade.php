@extends('layouts.app_user')

@section('title', 'Sertifikat')
@section('page-title', 'Sertifikat')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-50 to-indigo-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                    📜 Sertifikat Pelatihan Saya
                </h1>
                <p class="text-lg text-gray-600">
                    Koleksi sertifikat pelatihan yang telah Anda selesaikan
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @php
            $validFiles = collect($files)->filter(fn($file) => !is_null($file->file_url));

            function formatGoogleDriveUrl($url)
            {
                if (str_contains($url, 'drive.google.com')) {
                    return str_replace('/view?usp=sharing', '/preview', $url);
                }
                return $url;
            }
        @endphp

        @if ($validFiles->isNotEmpty())
            <!-- Info Banner -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-8 rounded-r-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>Petunjuk:</strong> Klik tombol "Unduh Sertifikat" untuk menyimpan sertifikat ke
                            perangkat Anda
                        </p>
                    </div>
                </div>
            </div>

            <!-- Certificate Cards -->
            <div class="space-y-8">
                @foreach ($validFiles as $index => $file)
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                        <!-- Card Header -->
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                            <span class="text-green-600 font-bold text-lg">{{ $index + 1 }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">
                                            Sertifikat Pelatihan #{{ $index + 1 }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            Dokumen sertifikat resmi
                                        </p>
                                    </div>
                                </div>

                                <!-- Download Button -->
                                <a href="{{ $file->file_url }}" target="_blank"
                                    class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Unduh Sertifikat
                                </a>
                            </div>
                        </div>

                        <!-- Certificate Preview -->
                        <div class="p-6">
                            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Pratinjau Sertifikat
                                </h4>

                                <!-- iframe dengan loading state -->
                                <div class="relative">
                                    <div class="absolute inset-0 bg-gray-100 rounded-lg flex items-center justify-center"
                                        id="loading-{{ $index }}">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-4 h-4 bg-blue-500 rounded-full animate-pulse"></div>
                                            <span class="text-gray-600">Memuat sertifikat...</span>
                                        </div>
                                    </div>

                                    <iframe src="{{ formatGoogleDriveUrl($file->file_url) }}" width="100%" height="600"
                                        class="rounded-lg border border-gray-300 shadow-inner" style="border: none;"
                                        onload="document.getElementById('loading-{{ $index }}').style.display='none'"
                                        title="Sertifikat Pelatihan #{{ $index + 1 }}">
                                    </iframe>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="{{ $file->file_url }}" target="_blank"
                                    class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Buka di Tab Baru
                                </a>

                                <button onclick="shareCertificate('{{ $file->file_url }}')"
                                    class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                                    </svg>
                                    Bagikan
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Card -->
            <div class="mt-8 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        Selamat! 🎉
                    </h3>
                    <p class="text-gray-600 max-w-md mx-auto">
                        Anda telah berhasil menyelesaikan <strong>{{ $validFiles->count() }}</strong>
                        {{ $validFiles->count() == 1 ? 'pelatihan' : 'pelatihan' }} dan meraih sertifikat resmi
                    </p>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-800 mb-2">
                    Belum Ada Sertifikat
                </h3>
                <p class="text-gray-600 max-w-md mx-auto mb-6">
                    Sertifikat Anda akan muncul di sini setelah menyelesaikan pelatihan.
                    Mulai ikuti pelatihan untuk mendapatkan sertifikat pertama Anda!
                </p>
                {{-- <a href="#"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Mulai Pelatihan
                </a> --}}
            </div>
        @endif
    </div>

    <!-- JavaScript untuk fungsi tambahan -->
    <script>
        function shareCertificate(url) {
            if (navigator.share) {
                navigator.share({
                    title: 'Sertifikat Pelatihan Saya',
                    text: 'Lihat sertifikat pelatihan yang saya peroleh',
                    url: url
                });
            } else {
                // Fallback untuk browser yang tidak mendukung Web Share API
                navigator.clipboard.writeText(url).then(function() {
                    alert('Link sertifikat berhasil disalin ke clipboard!');
                });
            }
        }
    </script>
@endsection
