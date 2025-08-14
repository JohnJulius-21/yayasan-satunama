<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelatihan - SATUNAMA Training Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#059669',
                        secondary: '#0d9488',
                        accent: '#10b981'
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Mobile sidebar styles */
        .sidebar-hidden {
            transform: translateX(-100%);
        }

        .sidebar-visible {
            transform: translateX(0);
        }

        .overlay-hidden {
            opacity: 0;
            pointer-events: none;
        }

        .overlay-visible {
            opacity: 1;
            pointer-events: auto;
        }

        /* Desktop sidebar styles */
        .content-expanded {
            margin-left: 0 !important;
        }

        .content-collapsed {
            margin-left: 16rem;
        }

        /* Sidebar toggle button styles */
        .sidebar-toggle-btn {
            transition: all 0.3s ease;
        }

        .sidebar-toggle-btn:hover {
            background-color: #f3f4f6;
            transform: scale(1.05);
        }

        /* Desktop sidebar collapse styles */
        @media (min-width: 1024px) {
            .sidebar-collapsed {
                width: 4rem !important;
            }

            .sidebar-collapsed .sidebar-text {
                opacity: 0;
                visibility: hidden;
            }

            .sidebar-collapsed .sidebar-logo-text {
                display: none;
            }

            .sidebar-collapsed .nav-item {
                justify-content: center;
                padding: 0.75rem;
            }

            .sidebar-collapsed .user-profile {
                display: none;
            }

            /* Show sidebar on desktop by default */
            .sidebar {
                transform: translateX(0) !important;
            }

            /* Adjust main content on desktop */
            .main-content {
                margin-left: 16rem;
            }
        }

        /* Smooth transitions */
        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .content-transition {
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Ensure sidebar is visible on larger screens */
        @media (min-width: 1024px) {
            #sidebar {
                position: relative !important;
                transform: translateX(0) !important;
            }

            #sidebarOverlay {
                display: none !important;
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Mobile Overlay -->
    <div id="sidebarOverlay"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden overlay-hidden transition-opacity duration-300"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg z-50 transform transition-transform duration-300 ease-in-out sidebar-hidden lg:sidebar-visible">
        <div class="p-6">
            <div class="flex items-center space-x-3 mb-8">
                <div class="bg-primary text-white p-2 rounded-lg">
                    <i class="fas fa-graduation-cap text-xl"></i>
                </div>
                <div>
                    <h2 class="font-bold text-gray-900">SATUNAMA</h2>
                    <p class="text-sm text-gray-500">Training Center</p>
                </div>
                <!-- Sidebar Toggle Button inside sidebar -->
                <button id="sidebarToggleInside" class="p-2 rounded-lg hover:bg-gray-100 sidebar-toggle-btn">
                    <i class="fas fa-bars text-gray-600"></i>
                </button>
            </div>

            <!-- Navigation Menu -->
            <nav class="space-y-2">
                <a href="#" onclick="showPage('dashboard')"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" onclick="showPage('presensi')"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors">
                    <i class="fas fa-user-check"></i>
                    <span>Presensi</span>
                </a>
                <a href="#" onclick="showPage('materi')"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors">
                    <i class="fas fa-book"></i>
                    <span>Materi</span>
                </a>
                <a href="#" onclick="showPage('evaluasi')"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors">
                    <i class="fas fa-star"></i>
                    <span>Evaluasi Pelatihan</span>
                </a>
                <a href="#" onclick="showPage('sertifikat')"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors">
                    <i class="fas fa-certificate"></i>
                    <span>Sertifikat</span>
                </a>
                <a href="#" onclick="showPage('survey')"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors">
                    <i class="fas fa-poll"></i>
                    <span>Survey Kepuasan</span>
                </a>
                <a href="#" onclick="showPage('studi-dampak')"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors">
                    <i class="fas fa-chart-line"></i>
                    <span>Studi Dampak</span>
                </a>
                <a href="#" onclick="showPage('forum')"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors">
                    <i class="fas fa-comments"></i>
                    <span>Forum Diskusi</span>
                </a>
            </nav>
        </div>

        <!-- User Profile in Sidebar -->
        <div class="absolute bottom-6 left-6 right-6">
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">GP</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Gerald Parongko</p>
                        <p class="text-xs text-gray-500">Peserta</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Top Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-4">
                        <button id="sidebarToggle" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                            <i class="fas fa-bars text-gray-600"></i>
                        </button>
                        <div>
                            <h1 id="pageTitle" class="text-xl font-semibold text-gray-900">Dashboard</h1>
                            <p class="text-sm text-gray-500">Project Cycle Management (PCM)</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="bg-gray-100 p-2 rounded-full hover:bg-gray-200 transition-colors">
                                <i class="fas fa-bell text-gray-600"></i>
                            </button>
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                        </div>
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-4 sm:p-6 lg:p-8">
            <!-- Dashboard Page -->
            <div id="dashboard-page" class="page-content">
                <!-- Course Header -->
                <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 text-white mb-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div class="mb-6 md:mb-0">
                            <h2 class="text-3xl font-bold mb-2">Project Cycle Management (PCM)</h2>
                            <p class="text-primary-100 mb-4">Fasilitator: Gerald Parongko</p>
                            <div class="flex items-center space-x-4 text-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>19 - 21 Mei 2025</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>3 Hari</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-users mr-2"></i>
                                    <span>15 Peserta</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center">
                            <div class="text-2xl font-bold">85%</div>
                            <div class="text-sm opacity-90">Progress</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Sesi Selesai</p>
                                <p class="text-2xl font-bold text-gray-900">2/3</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-lg">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                        </div>
                    </div>
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
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Timeline Pelatihan</h3>
                    <div class="space-y-6">
                        <!-- Hari 1 -->
                        <div class="relative">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                                    ✓
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">Hari 1 - 19 Mei 2025</h4>
                                    <p class="text-gray-600">Pengenalan Project Cycle Management</p>
                                    <div class="flex space-x-4 mt-2">
                                        <span
                                            class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Hadir</span>
                                        <a href="#" class="text-primary text-sm hover:underline">Lihat
                                            Rekaman</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hari 2 -->
                        <div class="relative">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                                    ✓
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">Hari 2 - 20 Mei 2025</h4>
                                    <p class="text-gray-600">Implementasi dan Studi Kasus</p>
                                    <div class="flex space-x-4 mt-2">
                                        <span
                                            class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Hadir</span>
                                        <a href="#" class="text-primary text-sm hover:underline">Lihat
                                            Rekaman</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hari 3 -->
                        <div class="relative">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white font-bold animate-pulse">
                                    LIVE
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">Hari 3 - 21 Mei 2025</h4>
                                    <p class="text-gray-600">Evaluasi dan Diskusi Interaktif</p>
                                    <div class="flex space-x-4 mt-2">
                                        <button
                                            class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600">
                                            <i class="fas fa-video mr-1"></i> Gabung Live
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Presensi Page -->
            <div id="presensi-page" class="page-content hidden">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Presensi Pelatihan</h2>
                    <p class="text-gray-600">Riwayat kehadiran Anda dalam pelatihan PCM</p>
                </div>

                <!-- Presensi Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Total Kehadiran</p>
                                <p class="text-3xl font-bold text-green-600">100%</p>
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
                                <p class="text-3xl font-bold text-blue-600">2/3</p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Durasi Total</p>
                                <p class="text-3xl font-bold text-purple-600">16 Jam</p>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-full">
                                <i class="fas fa-clock text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Presensi Detail -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Detail Presensi</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sesi</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Waktu Masuk</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Waktu Keluar</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Durasi</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">19 Mei 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Hari 1 - Pengenalan
                                        PCM</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">08:00</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">17:00</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">8 Jam</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i> Hadir
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">20 Mei 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Hari 2 - Implementasi
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">08:00</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">17:00</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">8 Jam</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i> Hadir
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">21 Mei 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Hari 3 - Evaluasi
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">-</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">-</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">-</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-circle animate-pulse mr-1"></i> Live
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Materi Page -->
            <div id="materi-page" class="page-content hidden">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Materi Pelatihan</h2>
                    <p class="text-gray-600">Akses semua materi pembelajaran dan sumber daya pelatihan</p>
                </div>

                <!-- Materi Categories -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Presentasi</h3>
                                <p class="text-blue-100">6 File PDF</p>
                            </div>
                            <i class="fas fa-file-powerpoint text-3xl text-blue-200"></i>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Video Rekaman</h3>
                                <p class="text-green-100">3 Video</p>
                            </div>
                            <i class="fas fa-video text-3xl text-green-200"></i>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Handout</h3>
                                <p class="text-purple-100">4 Dokumen</p>
                            </div>
                            <i class="fas fa-book text-3xl text-purple-200"></i>
                        </div>
                    </div>
                </div>

                <!-- Materi List -->
                <div class="space-y-6">
                    <!-- Hari 1 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <span
                                    class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm font-medium mr-3">Hari
                                    1</span>
                                Pengenalan Project Cycle Management
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div
                                class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-red-100 p-3 rounded-lg">
                                        <i class="fas fa-file-pdf text-red-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Konsep Dasar PCM</h4>
                                        <p class="text-sm text-gray-500">Presentasi • 3.2 MB</p>
                                    </div>
                                </div>
                                <button
                                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                                    <i class="fas fa-download mr-2"></i>Download
                                </button>
                            </div>

                            <div
                                class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-blue-100 p-3 rounded-lg">
                                        <i class="fas fa-video text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Rekaman Sesi Hari 2</h4>
                                        <p class="text-sm text-gray-500">Video • 2 Jam 30 Menit</p>
                                    </div>
                                </div>
                                <button
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                                    <i class="fas fa-play mr-2"></i>Tonton
                                </button>
                            </div>

                            <div
                                class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="bg-yellow-100 p-3 rounded-lg">
                                        <i class="fas fa-tasks text-yellow-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Studi Kasus & Template</h4>
                                        <p class="text-sm text-gray-500">Excel & Word • 2.1 MB</p>
                                    </div>
                                </div>
                                <button
                                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                                    <i class="fas fa-download mr-2"></i>Download
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Hari 3 -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm font-medium mr-3">Hari
                                    3</span>
                                Evaluasi dan Diskusi
                                <span class="ml-2 bg-red-100 text-red-800 px-2 py-1 rounded text-xs animate-pulse">Live
                                    Session</span>
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="text-center py-8">
                                <i class="fas fa-video text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500 mb-4">Materi akan tersedia setelah sesi live selesai</p>
                                <button
                                    class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition-colors">
                                    <i class="fas fa-video mr-2"></i>Gabung Live Session
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Evaluasi Page -->
            <div id="evaluasi-page" class="page-content hidden">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Evaluasi Pelatihan</h2>
                    <p class="text-gray-600">Berikan penilaian Anda terhadap pelatihan ini</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <form class="space-y-6">
                        <!-- Overall Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Penilaian Keseluruhan Pelatihan
                            </label>
                            <div class="flex items-center space-x-2">
                                <div class="flex space-x-1" id="overall-rating">
                                    <button type="button" class="star text-gray-300 hover:text-yellow-400 text-2xl"
                                        data-rating="1">★</button>
                                    <button type="button" class="star text-gray-300 hover:text-yellow-400 text-2xl"
                                        data-rating="2">★</button>
                                    <button type="button" class="star text-gray-300 hover:text-yellow-400 text-2xl"
                                        data-rating="3">★</button>
                                    <button type="button" class="star text-gray-300 hover:text-yellow-400 text-2xl"
                                        data-rating="4">★</button>
                                    <button type="button" class="star text-gray-300 hover:text-yellow-400 text-2xl"
                                        data-rating="5">★</button>
                                </div>
                                <span id="rating-text" class="text-sm text-gray-500 ml-2">Pilih rating</span>
                            </div>
                        </div>

                        <!-- Content Quality -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Kualitas Materi Pelatihan
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="content_quality" value="excellent"
                                        class="text-primary">
                                    <span class="ml-2 text-sm text-gray-700">Sangat Baik</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="content_quality" value="good"
                                        class="text-primary">
                                    <span class="ml-2 text-sm text-gray-700">Baik</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="content_quality" value="fair"
                                        class="text-primary">
                                    <span class="ml-2 text-sm text-gray-700">Cukup</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="content_quality" value="poor"
                                        class="text-primary">
                                    <span class="ml-2 text-sm text-gray-700">Kurang</span>
                                </label>
                            </div>
                        </div>

                        <!-- Instructor Rating -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Penilaian Fasilitator
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Penguasaan Materi</label>
                                    <div class="flex space-x-1">
                                        <button type="button"
                                            class="instructor-star text-gray-300 hover:text-yellow-400"
                                            data-category="mastery" data-rating="1">★</button>
                                        <button type="button"
                                            class="instructor-star text-gray-300 hover:text-yellow-400"
                                            data-category="mastery" data-rating="2">★</button>
                                        <button type="button"
                                            class="instructor-star text-gray-300 hover:text-yellow-400"
                                            data-category="mastery" data-rating="3">★</button>
                                        <button type="button"
                                            class="instructor-star text-gray-300 hover:text-yellow-400"
                                            data-category="mastery" data-rating="4">★</button>
                                        <button type="button"
                                            class="instructor-star text-gray-300 hover:text-yellow-400"
                                            data-category="mastery" data-rating="5">★</button>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Metode Penyampaian</label>
                                    <div class="flex space-x-1">
                                        <button type="button"
                                            class="instructor-star text-gray-300 hover:text-yellow-400"
                                            data-category="delivery" data-rating="1">★</button>
                                        <button type="button"
                                            class="instructor-star text-gray-300 hover:text-yellow-400"
                                            data-category="delivery" data-rating="2">★</button>
                                        <button type="button"
                                            class="instructor-star text-gray-300 hover:text-yellow-400"
                                            data-category="delivery" data-rating="3">★</button>
                                        <button type="button"
                                            class="instructor-star text-gray-300 hover:text-yellow-400"
                                            data-category="delivery" data-rating="4">★</button>
                                        <button type="button"
                                            class="instructor-star text-gray-300 hover:text-yellow-400"
                                            data-category="delivery" data-rating="5">★</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Comments -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Komentar dan Saran
                            </label>
                            <textarea rows="4"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary"
                                placeholder="Berikan komentar, saran, atau masukan untuk pelatihan ini..."></textarea>
                        </div>

                        <!-- What you learned -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Apa yang paling berharga yang Anda pelajari?
                            </label>
                            <textarea rows="3"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary"
                                placeholder="Jelaskan pembelajaran terpenting yang Anda dapatkan..."></textarea>
                        </div>

                        <!-- Recommend -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Apakah Anda akan merekomendasikan pelatihan ini?
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="recommend" value="definitely" class="text-primary">
                                    <span class="ml-2 text-sm text-gray-700">Sangat merekomendasikan</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="recommend" value="likely" class="text-primary">
                                    <span class="ml-2 text-sm text-gray-700">Kemungkinan merekomendasikan</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="recommend" value="neutral" class="text-primary">
                                    <span class="ml-2 text-sm text-gray-700">Netral</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="recommend" value="unlikely" class="text-primary">
                                    <span class="ml-2 text-sm text-gray-700">Tidak merekomendasikan</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark transition-colors">
                                <i class="fas fa-paper-plane mr-2"></i>Kirim Evaluasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sertifikat Page -->
            <div id="sertifikat-page" class="page-content hidden">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Sertifikat Pelatihan</h2>
                    <p class="text-gray-600">Unduh sertifikat kelulusan pelatihan Anda</p>
                </div>

                <!-- Certificate Status -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-8 text-white mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Selamat! 🎉</h3>
                            <p class="text-green-100 mb-4">Anda telah menyelesaikan pelatihan Project Cycle Management
                            </p>
                            <div class="flex items-center space-x-4 text-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <span>Kehadiran: 100%</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-star mr-2"></i>
                                    <span>Status: Lulus</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>Tanggal: 21 Mei 2025</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 text-center">
                            <i class="fas fa-certificate text-4xl mb-2"></i>
                            <div class="text-sm opacity-90">Sertifikat Siap</div>
                        </div>
                    </div>
                </div>

                <!-- Certificate Preview -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Preview Sertifikat</h3>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-indigo-100 border-2 border-dashed border-blue-200 rounded-xl p-8 text-center">
                        <div class="max-w-2xl mx-auto">
                            <div class="border-4 border-blue-300 rounded-lg p-8 bg-white shadow-lg">
                                <div class="text-center">
                                    <div class="flex justify-center mb-4">
                                        <div class="bg-primary text-white p-4 rounded-full">
                                            <i class="fas fa-graduation-cap text-2xl"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-2xl font-bold text-gray-900 mb-2">SERTIFIKAT PELATIHAN</h2>
                                    <div class="h-1 bg-gradient-to-r from-primary to-secondary w-24 mx-auto mb-6">
                                    </div>
                                    <p class="text-lg text-gray-700 mb-4">Diberikan kepada:</p>
                                    <h3 class="text-3xl font-bold text-primary mb-6">Gerald Parongko</h3>
                                    <p class="text-gray-600 mb-4">Telah berhasil menyelesaikan pelatihan</p>
                                    <h4 class="text-xl font-semibold text-gray-900 mb-6">Project Cycle Management (PCM)
                                    </h4>
                                    <div class="flex justify-between items-center text-sm text-gray-600 mt-8">
                                        <div>
                                            <p>Yogyakarta, 21 Mei 2025</p>
                                        </div>
                                        <div class="text-center">
                                            <div
                                                class="w-24 h-16 bg-gray-200 rounded mb-2 flex items-center justify-center">
                                                <i class="fas fa-stamp text-gray-400"></i>
                                            </div>
                                            <p class="font-semibold">SATUNAMA Training Center</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Download Actions -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="text-center">
                            <div
                                class="bg-red-100 p-4 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Sertifikat PDF</h3>
                            <p class="text-gray-600 text-sm mb-4">Format PDF berkualitas tinggi untuk pencetakan</p>
                            <button
                                class="w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-download mr-2"></i>Download PDF
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="text-center">
                            <div
                                class="bg-blue-100 p-4 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                                <i class="fas fa-image text-blue-600 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Sertifikat Digital</h3>
                            <p class="text-gray-600 text-sm mb-4">Format PNG untuk media sosial dan web</p>
                            <button
                                class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition-colors">
                                <i class="fas fa-download mr-2"></i>Download PNG
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Verification Info -->
                <div class="mt-8 bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Verifikasi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600">Nomor Sertifikat:</span>
                            <span class="font-medium text-gray-900 ml-2">STC-PCM-2025-001</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Tanggal Terbit:</span>
                            <span class="font-medium text-gray-900 ml-2">21 Mei 2025</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Verifikasi Online:</span>
                            <a href="#" class="text-primary hover:underline ml-2">verify.satunama.org</a>
                        </div>
                        <div>
                            <span class="text-gray-600">Masa Berlaku:</span>
                            <span class="font-medium text-gray-900 ml-2">Seumur Hidup</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Survey Page -->
            <div id="survey-page" class="page-content hidden">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Survey Kepuasan</h2>
                    <p class="text-gray-600">Bantu kami meningkatkan kualitas pelatihan dengan mengisi survey ini</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="mb-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Survey Kepuasan Peserta</h3>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">15 Pertanyaan</span>
                        </div>
                        <div class="mt-2 bg-gray-200 rounded-full h-2">
                            <div class="bg-primary h-2 rounded-full" style="width: 0%" id="survey-progress"></div>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Progress: <span id="progress-text">0/15</span></p>
                    </div>

                    <form id="survey-form" class="space-y-6">
                        <!-- Question 1 -->
                        <div class="survey-question">
                            <h4 class="text-md font-medium text-gray-900 mb-3">
                                1. Seberapa puas Anda dengan pelatihan Project Cycle Management secara keseluruhan?
                            </h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="q1" value="5" class="text-primary"
                                        onchange="updateProgress()">
                                    <span class="ml-2 text-sm text-gray-700">Sangat Puas</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="q1" value="4" class="text-primary"
                                        onchange="updateProgress()">
                                    <span class="ml-2 text-sm text-gray-700">Puas</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="q1" value="3" class="text-primary"
                                        onchange="updateProgress()">
                                    <span class="ml-2 text-sm text-gray-700">Cukup Puas</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="q1" value="2" class="text-primary"
                                        onchange="updateProgress()">
                                    <span class="ml-2 text-sm text-gray-700">Kurang Puas</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="q1" value="1" class="text-primary"
                                        onchange="updateProgress()">
                                    <span class="ml-2 text-sm text-gray-700">Tidak Puas</span>
                                </label>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="survey-question">
                            <h4 class="text-md font-medium text-gray-900 mb-3">
                                2. Bagaimana penilaian Anda terhadap kualitas materi pelatihan?
                            </h4>
                            <div class="flex space-x-1 mb-2">
                                <button type="button"
                                    class="survey-star text-gray-300 hover:text-yellow-400 text-2xl"
                                    data-question="q2" data-rating="1">★</button>
                                <button type="button"
                                    class="survey-star text-gray-300 hover:text-yellow-400 text-2xl"
                                    data-question="q2" data-rating="2">★</button>
                                <button type="button"
                                    class="survey-star text-gray-300 hover:text-yellow-400 text-2xl"
                                    data-question="q2" data-rating="3">★</button>
                                <button type="button"
                                    class="survey-star text-gray-300 hover:text-yellow-400 text-2xl"
                                    data-question="q2" data-rating="4">★</button>
                                <button type="button"
                                    class="survey-star text-gray-300 hover:text-yellow-400 text-2xl"
                                    data-question="q2" data-rating="5">★</button>
                            </div>
                            <input type="hidden" name="q2" id="q2_value">
                        </div>

                        <!-- Question 3 -->
                        <div class="survey-question">
                            <h4 class="text-md font-medium text-gray-900 mb-3">
                                3. Seberapa mudah Anda memahami materi yang disampaikan?
                            </h4>
                            <select name="q3"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary"
                                onchange="updateProgress()">
                                <option value="">Pilih jawaban...</option>
                                <option value="5">Sangat Mudah</option>
                                <option value="4">Mudah</option>
                                <option value="3">Cukup</option>
                                <option value="2">Sulit</option>
                                <option value="1">Sangat Sulit</option>
                            </select>
                        </div>

                        <!-- More questions can be added here -->
                        <div class="survey-question">
                            <h4 class="text-md font-medium text-gray-900 mb-3">
                                4. Bagaimana penilaian Anda terhadap fasilitator?
                            </h4>
                            <textarea name="q4" rows="3"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-primary focus:border-primary"
                                placeholder="Berikan komentar Anda..." onchange="updateProgress()"></textarea>
                        </div>

                        <div class="flex justify-between">
                            <button type="button"
                                class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 transition-colors">
                                Simpan Draft
                            </button>
                            <button type="submit"
                                class="bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark transition-colors">
                                <i class="fas fa-paper-plane mr-2"></i>Kirim Survey
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Studi Dampak Page -->
            <div id="studi-dampak-page" class="page-content hidden">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Studi Dampak</h2>
                    <p class="text-gray-600">Ikuti program studi dampak untuk mengukur efektivitas pelatihan</p>
                </div>

                <!-- Timeline -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Timeline Studi Dampak</h3>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div
                                class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                                ✓
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Baseline Survey</h4>
                                <p class="text-gray-600 text-sm">Selesai - 18 Mei 2025</p>
                                <p class="text-gray-500 text-xs">Survey awal untuk mengukur pengetahuan sebelum
                                    pelatihan</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div
                                class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                2
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Post Training Survey</h4>
                                <p class="text-gray-600 text-sm">Aktif - Deadline: 28 Mei 2025</p>
                                <p class="text-gray-500 text-xs">Evaluasi langsung setelah pelatihan selesai</p>
                                <button
                                    class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">
                                    Isi Survey Sekarang
                                </button>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div
                                class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                                3
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-500">Follow-up Survey (1 Bulan)</h4>
                                <p class="text-gray-500 text-sm">Terjadwal - 21 Juni 2025</p>
                                <p class="text-gray-400 text-xs">Evaluasi implementasi pengetahuan di tempat kerja</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div
                                class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                                4
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-500">Follow-up Survey (3 Bulan)</h4>
                                <p class="text-gray-500 text-sm">Terjadwal - 21 Agustus 2025</p>
                                <p class="text-gray-400 text-xs">Evaluasi dampak jangka menengah</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Survey -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Post Training Survey Aktif</h3>
                            <p class="text-blue-100 mb-4">Bantu kami mengukur efektivitas pelatihan dengan mengisi
                                survey</p>
                            <div class="flex items-center space-x-4 text-sm">
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span>Estimasi: 10 menit</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>Deadline: 28 Mei 2025</span>
                                </div>
                            </div>
                        </div>
                        <button
                            class="bg-white text-blue-600 px-6 py-3 rounded-lg hover:bg-gray-100 transition-colors font-semibold">
                            <i class="fas fa-play mr-2"></i>Mulai Survey
                        </button>
                    </div>
                </div>

                <!-- Progress Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-green-600 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Progress Studi</h3>
                            <div class="text-3xl font-bold text-green-600 mb-1">25%</div>
                            <p class="text-sm text-gray-500">1 dari 4 survey selesai</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Partisipasi</h3>
                            <div class="text-3xl font-bold text-blue-600 mb-1">87%</div>
                            <p class="text-sm text-gray-500">13 dari 15 peserta</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <div class="text-center">
                            <div
                                class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-trophy text-purple-600 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Insentif</h3>
                            <div class="text-3xl font-bold text-purple-600 mb-1">50K</div>
                            <p class="text-sm text-gray-500">Voucher belanja</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forum Page -->
            <div id="forum-page" class="page-content hidden">
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
                                <button
                                    class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Buat Diskusi
                                </button>
                            </div>
                        </div>

                        <!-- Forum Topics -->
                        <div class="space-y-4">
                            <!-- Topic 1 -->
                            <div
                                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-start space-x-4">
                                        <div
                                            class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                            AP
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 hover:text-primary cursor-pointer">
                                                Bagaimana menerapkan PCM di organisasi kecil?
                                            </h4>
                                            <p class="text-sm text-gray-600 mt-1">
                                                Saya bekerja di NGO kecil dengan 10 karyawan. Bagaimana cara menerapkan
                                                PCM dengan resource terbatas?
                                            </p>
                                            <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                                <span>oleh Andi Pratama</span>
                                                <span>2 jam lalu</span>
                                                <span
                                                    class="bg-blue-100 text-blue-800 px-2 py-1 rounded">Implementasi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center text-gray-500">
                                            <i class="fas fa-reply mr-1"></i> 8 balasan
                                        </span>
                                        <span class="flex items-center text-gray-500">
                                            <i class="fas fa-eye mr-1"></i> 45 views
                                        </span>
                                    </div>
                                    <button class="text-primary hover:text-primary-dark">
                                        <i class="fas fa-arrow-right mr-1"></i> Lihat Diskusi
                                    </button>
                                </div>
                            </div>

                            <!-- Topic 2 -->
                            <div
                                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-start space-x-4">
                                        <div
                                            class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-bold">
                                            SR
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 hover:text-primary cursor-pointer">
                                                Template untuk Logical Framework?
                                            </h4>
                                            <p class="text-sm text-gray-600 mt-1">
                                                Ada yang punya template LogFrame yang praktis? Sharing dong...
                                            </p>
                                            <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                                <span>oleh Sari Rahayu</span>
                                                <span>4 jam lalu</span>
                                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Materi
                                                    Pelatihan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center text-gray-500">
                                            <i class="fas fa-reply mr-1"></i> 12 balasan
                                        </span>
                                        <span class="flex items-center text-gray-500">
                                            <i class="fas fa-eye mr-1"></i> 78 views
                                        </span>
                                    </div>
                                    <button class="text-primary hover:text-primary-dark">
                                        <i class="fas fa-arrow-right mr-1"></i> Lihat Diskusi
                                    </button>
                                </div>
                            </div>

                            <!-- Topic 3 -->
                            <div
                                class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-start space-x-4">
                                        <div
                                            class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold">
                                            GP
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 hover:text-primary cursor-pointer">
                                                <i class="fas fa-thumbtack text-yellow-500 mr-1"></i>
                                                [PINNED] Materi Tambahan dan Referensi
                                            </h4>
                                            <p class="text-sm text-gray-600 mt-1">
                                                Halo semua! Berikut adalah materi tambahan dan referensi yang bisa
                                                kalian pelajari...
                                            </p>
                                            <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                                <span>oleh Gerald Parongko (Fasilitator)</span>
                                                <span>1 hari lalu</span>
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Pengumuman</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center text-gray-500">
                                            <i class="fas fa-reply mr-1"></i> 5 balasan
                                        </span>
                                        <span class="flex items-center text-gray-500">
                                            <i class="fas fa-eye mr-1"></i> 156 views
                                        </span>
                                    </div>
                                    <button class="text-primary hover:text-primary-dark">
                                        <i class="fas fa-arrow-right mr-1"></i> Lihat Diskusi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Forum Sidebar -->
                    <div class="space-y-6">
                        <!-- Online Users -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Anggota Online</h3>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-sm relative">
                                        GP
                                        <div
                                            class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Gerald Parongko</p>
                                        <p class="text-xs text-gray-500">Fasilitator</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm relative">
                                        AP
                                        <div
                                            class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Andi Pratama</p>
                                        <p class="text-xs text-gray-500">Peserta</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-sm relative">
                                        SR
                                        <div
                                            class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Sari Rahayu</p>
                                        <p class="text-xs text-gray-500">Peserta</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Forum Rules -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Aturan Forum</h3>
                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                    <span>Gunakan bahasa yang sopan dan profesional</span>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                    <span>Tetap on-topic sesuai materi pelatihan</span>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                    <span>Saling menghormati pendapat peserta lain</span>
                                </div>
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                                    <span>Hindari spam dan konten tidak relevan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tautan Cepat</h3>
                            <div class="space-y-2">
                                <a href="#" class="block text-primary hover:text-primary-dark text-sm">
                                    <i class="fas fa-book mr-2"></i>Panduan Forum
                                </a>
                                <a href="#" class="block text-primary hover:text-primary-dark text-sm">
                                    <i class="fas fa-question-circle mr-2"></i>FAQ
                                </a>
                                <a href="#" class="block text-primary hover:text-primary-dark text-sm">
                                    <i class="fas fa-envelope mr-2"></i>Kontak Admin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Initialize sidebar state
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const desktopToggle = document.getElementById('desktopToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mainContent = document.querySelector('.main-content');

        // Mobile sidebar toggle
        function toggleMobileSidebar() {
            const isHidden = sidebar.classList.contains('sidebar-hidden');

            if (isHidden) {
                // Show sidebar
                sidebar.classList.remove('sidebar-hidden');
                sidebar.classList.add('sidebar-visible');
                sidebarOverlay.classList.remove('overlay-hidden');
                sidebarOverlay.classList.add('overlay-visible');
            } else {
                // Hide sidebar
                sidebar.classList.add('sidebar-hidden');
                sidebar.classList.remove('sidebar-visible');
                sidebarOverlay.classList.add('overlay-hidden');
                sidebarOverlay.classList.remove('overlay-visible');
            }
        }

        // Desktop sidebar collapse
        function toggleDesktopSidebar() {
            sidebar.classList.toggle('sidebar-collapsed');
            if (sidebar.classList.contains('sidebar-collapsed')) {
                mainContent.classList.remove('lg:ml-64');
                mainContent.classList.add('lg:ml-16');
            } else {
                mainContent.classList.remove('lg:ml-16');
                mainContent.classList.add('lg:ml-64');
            }
        }

        // Close sidebar function
        function closeSidebar() {
            sidebar.classList.add('sidebar-hidden');
            sidebar.classList.remove('sidebar-visible');
            sidebarOverlay.classList.add('overlay-hidden');
            sidebarOverlay.classList.remove('overlay-visible');
        }

        // Get the inside toggle button
        const sidebarToggleInside = document.getElementById('sidebarToggleInside');

        // Event listeners
        sidebarToggle.addEventListener('click', toggleMobileSidebar);
        desktopToggle.addEventListener('click', toggleDesktopSidebar);

        // Inside sidebar toggle (works for both mobile and desktop)
        sidebarToggleInside.addEventListener('click', () => {
            if (window.innerWidth >= 1024) {
                toggleDesktopSidebar();
            } else {
                toggleMobileSidebar();
            }
        });

        sidebarOverlay.addEventListener('click', closeSidebar);

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                // Desktop - ensure sidebar is visible
                sidebar.classList.remove('sidebar-hidden', 'sidebar-visible');
                sidebarOverlay.classList.add('overlay-hidden');
                sidebarOverlay.classList.remove('overlay-visible');
            } else {
                // Mobile - ensure sidebar is hidden by default
                sidebar.classList.add('sidebar-hidden');
                sidebar.classList.remove('sidebar-visible');
                sidebarOverlay.classList.add('overlay-hidden');
                sidebarOverlay.classList.remove('overlay-visible');
            }
        });

        // Initialize on page load
        window.addEventListener('load', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('sidebar-hidden');
            } else {
                sidebar.classList.add('sidebar-hidden');
            }
        });

        // Rating System
        function initializeRating() {
            // Overall rating stars
            const stars = document.querySelectorAll('#overall-rating .star');
            const ratingText = document.getElementById('rating-text');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    const ratingTexts = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];

                    // Update star colors
                    stars.forEach((s, index) => {
                        if (index < rating) {
                            s.classList.remove('text-gray-300');
                            s.classList.add('text-yellow-400');
                        } else {
                            s.classList.remove('text-yellow-400');
                            s.classList.add('text-gray-300');
                        }
                    });

                    ratingText.textContent = ratingTexts[rating];
                });
            });

            // Instructor rating stars
            const instructorStars = document.querySelectorAll('.instructor-star');
            instructorStars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    const category = this.dataset.category;
                    const categoryStars = document.querySelectorAll(`[data-category="${category}"]`);

                    categoryStars.forEach((s, index) => {
                        if (index < rating) {
                            s.classList.remove('text-gray-300');
                            s.classList.add('text-yellow-400');
                        } else {
                            s.classList.remove('text-yellow-400');
                            s.classList.add('text-gray-300');
                        }
                    });
                });
            });

            // Survey rating stars
            const surveyStars = document.querySelectorAll('.survey-star');
            surveyStars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    const question = this.dataset.question;
                    const questionStars = document.querySelectorAll(`[data-question="${question}"]`);

                    questionStars.forEach((s, index) => {
                        if (index < rating) {
                            s.classList.remove('text-gray-300');
                            s.classList.add('text-yellow-400');
                        } else {
                            s.classList.remove('text-yellow-400');
                            s.classList.add('text-gray-300');
                        }
                    });

                    // Update hidden input
                    const hiddenInput = document.getElementById(question + '_value');
                    if (hiddenInput) {
                        hiddenInput.value = rating;
                        updateProgress();
                    }
                });
            });
        }

        // Survey Progress
        function updateProgress() {
            const form = document.getElementById('survey-form');
            if (!form) return;

            const inputs = form.querySelectorAll('input[type="radio"]:checked, select, textarea, input[type="hidden"]');
            const totalQuestions = 15; // Adjust based on actual questions
            let answered = 0;

            const answeredQuestions = new Set();
            inputs.forEach(input => {
                if (input.value && input.value.trim() !== '') {
                    answeredQuestions.add(input.name);
                }
            });

            answered = answeredQuestions.size;
            const progress = (answered / totalQuestions) * 100;

            const progressBar = document.getElementById('survey-progress');
            const progressText = document.getElementById('progress-text');

            if (progressBar) progressBar.style.width = progress + '%';
            if (progressText) progressText.textContent = answered + '/' + totalQuestions;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeRating();

            // Set default active nav
            const firstNavItem = document.querySelector('.nav-item');
            if (firstNavItem) {
                firstNavItem.classList.add('bg-primary', 'text-white');
                firstNavItem.classList.remove('text-gray-700');
            }
        });
    </script>
</body>

</html>
