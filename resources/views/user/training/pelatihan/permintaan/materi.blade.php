{{-- resources/views/user/training/pelatihan/permintaan/materi.blade.php --}}
@extends('layouts.app_user')

@section('title', 'Materi')
@section('page-title', 'Materi')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
    <section id="contact" class="contact section bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 py-1" data-aos="fade-up" data-aos-delay="100">
            <div class="max-w-7xl mx-auto">

                {{-- Header Section --}}
                <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
                    <div class="text-center">
                        <div class="flex items-center justify-center mb-4">
                            <div class="bg-blue-100 p-4 rounded-full mr-4">
                                <i class="bi bi-book-fill text-blue-600 text-4xl"></i>
                            </div>
                            <div class="text-left">
                                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                                    📚 {{ $title ?? 'Materi Pelatihan' }}
                                </h1>
                                <p class="text-gray-600">{{ $permintaan->nama_pelatihan ?? 'Pelatihan' }}</p>
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                            <p class="text-blue-800 font-medium flex items-center justify-center">
                                <i class="bi bi-info-circle-fill mr-2"></i>
                                Klik pada folder untuk membuka, klik tombol untuk melihat atau mengunduh file
                            </p>
                        </div>

                        {{-- Quick Stats --}}
                        @php
                            $totalFiles = 0;
                            $totalFolders = 0;

                            function countItems($branch, &$files, &$folders)
                            {
                                foreach ($branch as $key => $value) {
                                    if (is_array($value)) {
                                        if (isset($value['file_name'])) {
                                            $files++;
                                        } else {
                                            $folders++;
                                            countItems($value, $files, $folders);
                                        }
                                    }
                                }
                            }

                            if ($tree) {
                                countItems($tree, $totalFiles, $totalFolders);
                            }
                        @endphp

                        <div class="flex flex-wrap justify-center gap-6 text-sm">
                            <div class="flex items-center text-blue-600">
                                <i class="bi bi-folder-fill mr-2"></i>
                                <span class="font-semibold">{{ $totalFolders }}</span> Folder
                            </div>
                            <div class="flex items-center text-green-600">
                                <i class="bi bi-file-earmark-fill mr-2"></i>
                                <span class="font-semibold">{{ $totalFiles }}</span> File
                            </div>
                            <div class="flex items-center text-purple-600">
                                <i class="bi bi-clock-fill mr-2"></i>
                                Diperbarui: {{ now()->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="bg-white rounded-xl shadow-sm border p-6">
                    @if ($tree && count($tree) > 0)
                        {{-- Include the tree gallery component --}}
                        @include('partials.tree', ['branch' => $tree])
                    @else
                        {{-- Empty State --}}
                        <div class="text-center py-16" data-aos="fade-up" data-aos-delay="200">
                            <div class="mb-8">
                                <div
                                    class="inline-flex items-center justify-center w-32 h-32 bg-gray-100 rounded-full mb-6">
                                    <i class="bi bi-folder-x text-gray-400 text-5xl"></i>
                                </div>
                                <h3 class="text-2xl font-semibold text-gray-600 mb-4">Belum Ada Materi</h3>
                                <p class="text-gray-500 text-lg max-w-md mx-auto">
                                    Materi pelatihan belum tersedia. Silakan hubungi instruktur atau admin untuk informasi
                                    lebih lanjut.
                                </p>
                            </div>

                            <div class="flex flex-wrap justify-center gap-4">
                                {{-- <a href="{{ route('permintaan.pelatihan.list') }}"
                                    class="inline-flex items-center bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                                    <i class="bi bi-arrow-left mr-2"></i>
                                    Kembali ke Dashboard
                                </a> --}}
                                {{-- <a href="mailto:admin@example.com"
                                    class="inline-flex items-center bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition-colors">
                                    <i class="bi bi-envelope mr-2"></i>
                                    Hubungi Admin
                                </a> --}}
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Help Section --}}
                <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                            <i class="bi bi-question-circle-fill text-blue-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-blue-800 mb-3">Butuh Bantuan?</h3>
                        <p class="text-blue-700 mb-6 max-w-2xl mx-auto">
                            Jika mengalami kesulitan mengakses atau mengunduh materi, jangan ragu untuk menghubungi tim
                            support kami.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                            <div class="bg-white rounded-lg p-4 border border-blue-200">
                                <i class="bi bi-download text-blue-600 text-2xl mb-2"></i>
                                <h4 class="font-semibold text-gray-800 mb-1">Cara Mengunduh</h4>
                                <p class="text-sm text-gray-600">Klik tombol "Lihat & Unduh" untuk membuka file di tab baru
                                </p>
                            </div>

                            <div class="bg-white rounded-lg p-4 border border-blue-200">
                                <i class="bi bi-eye text-green-600 text-2xl mb-2"></i>
                                <h4 class="font-semibold text-gray-800 mb-1">Preview File</h4>
                                <p class="text-sm text-gray-600">Gunakan "Preview Cepat" untuk melihat isi file tanpa
                                    mengunduh</p>
                            </div>

                            <div class="bg-white rounded-lg p-4 border border-blue-200">
                                <i class="bi bi-phone text-purple-600 text-2xl mb-2"></i>
                                <h4 class="font-semibold text-gray-800 mb-1">Butuh Support?</h4>
                                <p class="text-sm text-gray-600">Hubungi admin jika ada kendala teknis atau file rusak</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Navigation Footer --}}
                <div class="mt-8 flex flex-wrap justify-between items-center bg-white rounded-lg p-4 border">
                    <a href="{{ url()->previous() }}"
                        class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                        <i class="bi bi-arrow-left mr-2"></i>
                        Kembali
                    </a>

                    <div class="flex items-center text-sm text-gray-500">
                        <i class="bi bi-shield-check mr-2"></i>
                        Konten dilindungi - hanya untuk peserta pelatihan
                    </div>

                    <a href="#" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                        class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors">
                        Ke Atas
                        <i class="bi bi-arrow-up ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading states for file links
            const fileLinks = document.querySelectorAll('a[target="_blank"]');
            fileLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const button = this;
                    const originalText = button.innerHTML;

                    // Show loading state
                    button.innerHTML =
                        '<i class="bi bi-spinner-border animate-spin mr-2"></i>Membuka...';
                    button.classList.add('opacity-75');

                    // Reset after 2 seconds
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.classList.remove('opacity-75');
                    }, 2000);
                });
            });

            // Add smooth scrolling for internal links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });

        // Add some utility functions for better UX
        function showToast(message, type = 'info') {
            // Simple toast notification
            const toast = document.createElement('div');
            toast.className =
                `fixed top-4 right-4 z-50 p-4 rounded-lg text-white ${type === 'success' ? 'bg-green-500' : 'bg-blue-500'} shadow-lg`;
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        // Track file access for analytics (optional)
        function trackFileAccess(fileName, fileUrl) {
            // You can implement analytics tracking here
            console.log('File accessed:', fileName);
        }
    </script>

    <style>
        /* Additional custom styles */
        .contact.section {
            padding-top: 2rem;
        }

        /* Loading animation */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        /* Smooth transitions for better UX */
        .transition-all {
            transition: all 0.2s ease-in-out;
        }

        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .text-3xl {
                font-size: 1.5rem;
            }

            .text-2xl {
                font-size: 1.25rem;
            }
        }
    </style>
@endpush
