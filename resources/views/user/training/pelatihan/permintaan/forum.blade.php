@extends('layouts.app_user')

@section('title', 'Forum Diskusi')
@section('page-title', 'Forum Diskusi')

@section('content')
    <!-- Forum Page -->
    {{-- <div class="container mx-auto px-4">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Forum Diskusi</h2>
            <p class="text-gray-600">Diskusikan materi pelatihan dengan peserta lain dan fasilitator</p>
        </div>

        <!-- Forum Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                <div class="text-2xl font-bold text-primary mb-1">24</div>
                <div class="text-sm text-gray-500">Total Diskusi</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                <div class="text-2xl font-bold text-blue-600 mb-1">156</div>
                <div class="text-sm text-gray-500">Total Pesan</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                <div class="text-2xl font-bold text-green-600 mb-1">15</div>
                <div class="text-sm text-gray-500">Anggota Aktif</div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                <div class="text-2xl font-bold text-purple-600 mb-1">3</div>
                <div class="text-sm text-gray-500">Diskusi Hari Ini</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Forum Categories -->
            <div class="lg:col-span-2 space-y-6">
                <!-- New Post -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Buat Diskusi Baru</h3>
                    <div class="space-y-4">
                        <input type="text" placeholder="Judul diskusi..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary">
                        <select
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary">
                            <option>Pilih kategori...</option>
                            <option>Materi Pelatihan</option>
                            <option>Implementasi</option>
                            <option>Tanya Jawab</option>
                            <option>Sharing Pengalaman</option>
                        </select>
                        <textarea rows="3" placeholder="Tulis pertanyaan atau topik diskusi..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary"></textarea>
                        <button class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                            <i class="fas fa-plus mr-2"></i>Buat Diskusi
                        </button>
                    </div>
                </div>

                <!-- Forum Topics -->
                <div class="space-y-4">
                    <!-- Topic 1 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Materi
                                        Pelatihan</span>
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        <i class="fas fa-thumbtack mr-1"></i>Dipinned
                                    </span>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2 hover:text-primary cursor-pointer">
                                    Panduan Lengkap Implementasi Sistem Manajemen Kinerja
                                </h4>
                                <p class="text-gray-600 text-sm mb-4">
                                    Diskusi mengenai langkah-langkah praktis dalam mengimplementasikan sistem manajemen
                                    kinerja yang efektif di organisasi...
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1">
                                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=32&h=32&fit=crop&crop=face&facepad=2&mask=ellipse"
                                                alt="Author" class="w-6 h-6 rounded-full">
                                            <span>Dr. Ahmad Fadli</span>
                                        </div>
                                        <span>•</span>
                                        <span>2 jam yang lalu</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-reply text-gray-400"></i>
                                            <span>23 balasan</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-eye text-gray-400"></i>
                                            <span>145 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Topic 2 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <span
                                        class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Tanya
                                        Jawab</span>
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        <i class="fas fa-fire mr-1"></i>Hot
                                    </span>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2 hover:text-primary cursor-pointer">
                                    Bagaimana cara mengatasi resistance to change dari karyawan?
                                </h4>
                                <p class="text-gray-600 text-sm mb-4">
                                    Saya sedang menghadapi tantangan dalam mengimplementasikan perubahan sistem di kantor.
                                    Ada tips khusus?
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1">
                                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b739?w=32&h=32&fit=crop&crop=face&facepad=2&mask=ellipse"
                                                alt="Author" class="w-6 h-6 rounded-full">
                                            <span>Sarah Putri</span>
                                        </div>
                                        <span>•</span>
                                        <span>4 jam yang lalu</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-reply text-gray-400"></i>
                                            <span>18 balasan</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-eye text-gray-400"></i>
                                            <span>89 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Topic 3 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Sharing
                                        Pengalaman</span>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2 hover:text-primary cursor-pointer">
                                    Success Story: Implementasi OKRs di Startup Tech
                                </h4>
                                <p class="text-gray-600 text-sm mb-4">
                                    Berbagi pengalaman sukses mengimplementasikan Objectives and Key Results (OKRs) di
                                    perusahaan startup teknologi...
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1">
                                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=32&h=32&fit=crop&crop=face&facepad=2&mask=ellipse"
                                                alt="Author" class="w-6 h-6 rounded-full">
                                            <span>Budi Santoso</span>
                                        </div>
                                        <span>•</span>
                                        <span>6 jam yang lalu</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-reply text-gray-400"></i>
                                            <span>12 balasan</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-eye text-gray-400"></i>
                                            <span>67 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Topic 4 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Implementasi</span>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2 hover:text-primary cursor-pointer">
                                    Template KPI Dashboard untuk Small Business
                                </h4>
                                <p class="text-gray-600 text-sm mb-4">
                                    Mencari template atau contoh dashboard KPI yang cocok untuk bisnis kecil dengan team
                                    10-15 orang...
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1">
                                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=32&h=32&fit=crop&crop=face&facepad=2&mask=ellipse"
                                                alt="Author" class="w-6 h-6 rounded-full">
                                            <span>Maya Sari</span>
                                        </div>
                                        <span>•</span>
                                        <span>1 hari yang lalu</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-reply text-gray-400"></i>
                                            <span>8 balasan</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-eye text-gray-400"></i>
                                            <span>34 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Topic 5 -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-3">
                                    <span
                                        class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Materi
                                        Pelatihan</span>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2 hover:text-primary cursor-pointer">
                                    Diskusi Modul 3: Performance Review Techniques
                                </h4>
                                <p class="text-gray-600 text-sm mb-4">
                                    Mari diskusikan berbagai teknik performance review yang telah dipelajari di modul 3.
                                    Mana yang paling efektif?
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1">
                                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=32&h=32&fit=crop&crop=face&facepad=2&mask=ellipse"
                                                alt="Author" class="w-6 h-6 rounded-full">
                                            <span>Dr. Ahmad Fadli</span>
                                        </div>
                                        <span>•</span>
                                        <span>2 hari yang lalu</span>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-reply text-gray-400"></i>
                                            <span>15 balasan</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-eye text-gray-400"></i>
                                            <span>78 views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-8">
                    <div class="text-sm text-gray-500">
                        Menampilkan 1-5 dari 24 diskusi
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50"
                            disabled>
                            <i class="fas fa-chevron-left mr-1"></i>Sebelumnya
                        </button>
                        <div class="flex items-center gap-1">
                            <button class="px-3 py-2 text-sm bg-primary text-white rounded-lg">1</button>
                            <button class="px-3 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                            <button class="px-3 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                            <span class="px-2 text-gray-500">...</span>
                            <button class="px-3 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">5</button>
                        </div>
                        <button class="px-3 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50">
                            Selanjutnya<i class="fas fa-chevron-right ml-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Active Users -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-users text-primary mr-2"></i>Anggota Online
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face&facepad=2&mask=ellipse"
                                    alt="User" class="w-10 h-10 rounded-full">
                                <div
                                    class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full">
                                </div>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Dr. Ahmad Fadli</div>
                                <div class="text-xs text-gray-500">Fasilitator</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b612b739?w=40&h=40&fit=crop&crop=face&facepad=2&mask=ellipse"
                                    alt="User" class="w-10 h-10 rounded-full">
                                <div
                                    class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full">
                                </div>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Sarah Putri</div>
                                <div class="text-xs text-gray-500">Peserta</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop&crop=face&facepad=2&mask=ellipse"
                                    alt="User" class="w-10 h-10 rounded-full">
                                <div
                                    class="absolute -bottom-1 -right-1 w-4 h-4 bg-yellow-500 border-2 border-white rounded-full">
                                </div>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Budi Santoso</div>
                                <div class="text-xs text-gray-500">Peserta</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=40&h=40&fit=crop&crop=face&facepad=2&mask=ellipse"
                                    alt="User" class="w-10 h-10 rounded-full">
                                <div
                                    class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full">
                                </div>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Maya Sari</div>
                                <div class="text-xs text-gray-500">Peserta</div>
                            </div>
                        </div>
                    </div>
                    <button class="w-full mt-4 text-sm text-primary hover:text-primary-dark font-medium">
                        Lihat semua anggota
                    </button>
                </div>

                <!-- Categories -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-tags text-primary mr-2"></i>Kategori Forum
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <span class="text-gray-900">Materi Pelatihan</span>
                            </div>
                            <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">8</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <span class="text-gray-900">Implementasi</span>
                            </div>
                            <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">6</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                <span class="text-gray-900">Tanya Jawab</span>
                            </div>
                            <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">7</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-gray-900">Sharing Pengalaman</span>
                            </div>
                            <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">3</span>
                        </div>
                    </div>
                </div>

                <!-- Forum Guidelines -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-info-circle text-primary mr-2"></i>Panduan Forum
                    </h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-green-500 mt-0.5 text-xs"></i>
                            <span>Gunakan bahasa yang sopan dan professional</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-green-500 mt-0.5 text-xs"></i>
                            <span>Berikan judul yang deskriptif untuk diskusi</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-green-500 mt-0.5 text-xs"></i>
                            <span>Pilih kategori yang sesuai</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <i class="fas fa-check-circle text-green-500 mt-0.5 text-xs"></i>
                            <span>Berikan konteks yang jelas dalam pertanyaan</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <i class="fas fa-times-circle text-red-500 mt-0.5 text-xs"></i>
                            <span>Hindari spam atau konten tidak relevan</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-clock text-primary mr-2"></i>Aktivitas Terbaru
                    </h3>
                    <div class="space-y-4">
                        <div class="flex gap-3">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b739?w=32&h=32&fit=crop&crop=face&facepad=2&mask=ellipse"
                                alt="User" class="w-8 h-8 rounded-full">
                            <div class="flex-1">
                                <div class="text-sm text-gray-900">
                                    <span class="font-medium">Sarah Putri</span> membalas diskusi
                                </div>
                                <div class="text-xs text-gray-500 mt-1">"Resistance to change..."</div>
                                <div class="text-xs text-gray-400">5 menit lalu</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=32&h=32&fit=crop&crop=face&facepad=2&mask=ellipse"
                                alt="User" class="w-8 h-8 rounded-full">
                            <div class="flex-1">
                                <div class="text-sm text-gray-900">
                                    <span class="font-medium">Budi Santoso</span> membuat diskusi baru
                                </div>
                                <div class="text-xs text-gray-500 mt-1">"Success Story: OKRs..."</div>
                                <div class="text-xs text-gray-400">15 menit lalu</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=32&h=32&fit=crop&crop=face&facepad=2&mask=ellipse"
                                alt="User" class="w-8 h-8 rounded-full">
                            <div class="flex-1">
                                <div class="text-sm text-gray-900">
                                    <span class="font-medium">Maya Sari</span> menyukai balasan
                                </div>
                                <div class="text-xs text-gray-500 mt-1">"Template KPI Dashboard..."</div>
                                <div class="text-xs text-gray-400">1 jam lalu</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="max-w-2xl mx-auto text-center py-16">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="mb-6">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-green-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <!-- Development/Construction SVG -->
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Sedang Dalam Pengembangan</h2>
                <p class="text-lg text-gray-600 mb-4">Fitur ini sedang dalam tahap pengembangan</p>
                <p class="text-sm text-gray-500">Kami sedang bekerja keras untuk menghadirkan fitur terbaik untuk Anda.
                    Mohon bersabar ya!</p>
            </div>

            <!-- Progress indicator -->
            <div class="flex justify-center items-center space-x-2 mt-6">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
            </div>
        </div>
    </div>
@endsection
