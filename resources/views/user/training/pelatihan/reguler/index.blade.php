<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelatihan Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Filter System Styles */
        .training-card {
            transition: all 0.3s ease;
        }

        .training-card[style*="display: none"] {
            opacity: 0;
            transform: translateY(-10px);
        }

        /* Custom Select Styling */
        select {
            background-image: none;
        }

        select:focus {
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }

        /* Filter Tags Animation */
        #filterTags span {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Hover effects for filter buttons */
        .bg-gray-100:hover {
            background-color: #f3f4f6;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .flex.flex-col.sm\:flex-row {
                gap: 12px;
            }

            select {
                width: 100%;
                min-width: 0;
            }
        }

        /* Loading animation for when filters are applied */
        .training-card.filtering {
            opacity: 0.5;
            pointer-events: none;
        }

        /* Smooth transitions for showing/hiding elements */
        #noResults,
        #emptyState {
            animation: fadeInUp 0.4s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-gray-50 min-h-screen">
    <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-4">
                    <a href="/">
                        <img loading="lazy" src="{{ asset('images/stc.png') }}" class="w-20 h-25" alt="Logo" />
                    </a>

                    <!-- Mobile menu button -->
                    {{-- <button id="sidebarToggle"
                        class="lg:hidden p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 transition-colors">
                        <i class="fas fa-bars text-gray-600"></i>
                    </button>
                    <div>
                        <h1 id="pageTitle" class="text-xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                        @isset($reguler)
                            <p class="text-sm text-gray-500">{{ $reguler->nama_pelatihan }}</p>
                        @endisset
                    </div> --}}
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="bg-gray-100 p-2 rounded-full hover:bg-gray-200 transition-colors">
                            <i class="fas fa-bell text-gray-600"></i>
                        </button>
                        {{-- <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span> --}}
                    </div>
                    <!-- Logout Button -->
                    <button onclick="openLogoutModal()" type="button" class="text-gray-500 hover:text-gray-700"
                        title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>


    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-3 flex flex-wrap justify-between items-center bg-white rounded-lg p-4 border">
            <a href="/" class="inline-flex items-center text-gray-600 hover:text-green-600 transition-colors">
                <i class="bi bi-arrow-left mr-2"></i>
                Kembali ke Beranda
            </a>

            <div class="flex items-center text-sm text-gray-500">
                <i class="bi bi-shield-check mr-2"></i>
                Hak Cipta - Yayasan SATUNAMA Yogyakarta
            </div>
        </div>

        <!-- Header Section -->
        <div class="bg-gradient-to-r rounded-2xl from-green-600 via-green-500 to-emerald-500 text-white mb-3">
            <div class="max-w-7xl mx-auto px-4 py-8">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
                    <div class="mb-6 lg:mb-0">
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2 flex items-center">
                            <i class="fas fa-graduation-cap mr-4 text-4xl"></i>
                            Pelatihan Saya
                        </h1>
                        <p class="text-green-100 text-lg">Pantau progress dan kelola pelatihan yang Anda ikuti</p>
                    </div>
                    <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4">
                        <div class="flex items-center text-white">
                            <div
                                class="w-12 h-12 bg-white bg-opacity-30 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-xl"></i>
                            </div>
                            <div>
                                <p class="text-green-100 text-sm">Selamat datang,</p>
                                <p class="font-semibold text-lg">{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Pelatihan Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Pelatihan</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalPelatihan }}</p>
                        <p class="text-green-600 text-sm font-medium mt-1">
                            <i class="fas fa-graduation-cap mr-1"></i>
                            @if ($totalPelatihan > 0)
                                Terdaftar
                            @else
                                Belum ada
                            @endif
                        </p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-xl">
                        <i class="fas fa-graduation-cap text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Sudah Bayar Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-emerald-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Sudah Bayar</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $sudahBayar }}</p>
                        <p class="text-emerald-600 text-sm font-medium mt-1">
                            <i class="fas fa-check-circle mr-1"></i>
                            @if ($sudahBayar > 0)
                                @if ($pelatihanAktif > 0)
                                    {{ $pelatihanAktif }} sedang berjalan
                                @elseif($pelatihanAkanDatang > 0)
                                    {{ $pelatihanAkanDatang }} akan dimulai
                                @elseif($pelatihanSelesai > 0)
                                    {{ $pelatihanSelesai }} telah selesai
                                @else
                                    Siap mengikuti
                                @endif
                            @else
                                Belum ada
                            @endif
                        </p>
                    </div>
                    <div class="bg-emerald-100 p-3 rounded-xl">
                        <i class="fas fa-check-circle text-emerald-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Menunggu Pembayaran Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-amber-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Menunggu Pembayaran</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $belumBayar }}</p>
                        <p class="text-amber-600 text-sm font-medium mt-1">
                            <i class="fas fa-clock mr-1"></i>
                            @if ($belumBayar > 0)
                                Segera bayar
                            @else
                                Semua lunas
                            @endif
                        </p>
                    </div>
                    <div class="bg-amber-100 p-3 rounded-xl">
                        <i class="fas fa-exclamation-triangle text-amber-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg mb-6 p-6">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Filter Pelatihan</h3>
                    <p class="text-sm text-gray-600">Pilih filter untuk menampilkan pelatihan sesuai kebutuhan</p>
                </div>

                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 w-full lg:w-auto">
                    <!-- Filter Jenis Pelatihan -->
                    <div class="relative">
                        <select id="filterJenis"
                            class="appearance-none bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="semua">Semua Jenis</option>
                            <option value="reguler">Pelatihan Reguler</option>
                            <option value="permintaan">Pelatihan Permintaan</option>
                            {{-- <option value="konsultasi">Pelatihan Konsultasi</option> --}}
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                    </div>

                    <!-- Filter Status Pembayaran -->
                    <div class="relative">
                        <select id="filterStatus"
                            class="appearance-none bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="semua">Semua Status</option>
                            <option value="belum_bayar">Belum Bayar</option>
                            <option value="sudah_bayar">Sudah Bayar</option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                    </div>

                    <!-- Filter Status Waktu -->
                    <div class="relative">
                        <select id="filterWaktu"
                            class="appearance-none bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="semua">Semua Waktu</option>
                            <option value="akan_datang">Akan Dimulai</option>
                            <option value="berlangsung">Sedang Berlangsung</option>
                            <option value="selesai">Sudah Selesai</option>
                            <option value="belum_dijadwalkan">Belum Dijadwalkan</option>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                    </div>

                    <!-- Reset Filter -->
                    <button onclick="resetFilters()"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-3 rounded-xl text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <i class="fas fa-refresh mr-2"></i>
                        Reset
                    </button>
                </div>
            </div>

            <!-- Active Filters Display -->
            <div id="activeFilters" class="mt-4 hidden">
                <div class="flex flex-wrap gap-2">
                    <span class="text-sm text-gray-600">Filter aktif:</span>
                    <div id="filterTags" class="flex flex-wrap gap-2"></div>
                </div>
            </div>
        </div>

        <!-- Training List -->
        <div id="trainingList" class="space-y-6">
            @php
                $allTrainings = [];

                // Gabungkan semua pelatihan
                foreach ($reguler as $item) {
                    $allTrainings[] = [
                        'item' => $item,
                        'type' => 'reguler',
                        'training' => $item->reguler,
                        'sort_date' => $item->reguler->tanggal_mulai ?? $item->created_at,
                    ];
                }

                foreach ($permintaan as $item) {
                    $allTrainings[] = [
                        'item' => $item,
                        'type' => 'permintaan',
                        'training' => $item->permintaan_pelatihan,
                        'sort_date' => $item->permintaan_pelatihan->tanggal_mulai ?? $item->created_at,
                    ];
                }

                foreach ($konsultasi as $item) {
                    $allTrainings[] = [
                        'item' => $item,
                        'type' => 'konsultasi',
                        'training' => $item->pelatihan_konsultasi,
                        'sort_date' => $item->pelatihan_konsultasi->tanggal_mulai ?? $item->created_at,
                    ];
                }

                // Sort berdasarkan tanggal terbaru
                usort($allTrainings, function ($a, $b) {
                    return strtotime($b['sort_date']) - strtotime($a['sort_date']);
                });
            @endphp

            @if (empty($allTrainings))
                <!-- Empty State -->
                <div class="text-center py-16" id="emptyState">
                    <div class="bg-white rounded-3xl shadow-lg p-12 max-w-md mx-auto">
                        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-book-open text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum Ada Pelatihan</h3>
                        <p class="text-gray-600 mb-8 text-lg">
                            Anda belum mendaftarkan diri ke pelatihan apapun.
                            Mulai eksplorasi pelatihan yang tersedia untuk mengembangkan kemampuan Anda.
                        </p>
                        <a href="/pelatihan"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-8 rounded-2xl inline-block transition duration-300 transform hover:scale-105">
                            <i class="fas fa-search mr-2"></i>
                            Cari Pelatihan
                        </a>
                    </div>
                </div>
            @else
                @foreach ($allTrainings as $training)
                    @php
                        $item = $training['item'];
                        $type = $training['type'];
                        $trainingData = $training['training'];

                        // Determine training attributes
                        if ($type === 'reguler') {
                            $detailRoute = route('reguler.pelatihan.list', urlencode($trainingData->nama_pelatihan));
                            $typeLabel = 'Pelatihan Reguler';
                            $typeIcon = 'fas fa-users';
                            $typeColor = 'green';
                        } elseif ($type === 'permintaan') {
                            $detailRoute = '#'; // Sesuaikan dengan route yang sesuai
                            $typeLabel = 'Pelatihan Permintaan';
                            $typeIcon = 'fas fa-hand-paper';
                            $typeColor = 'blue';
                        } else {
                            // konsultasi
                            $detailRoute = '#'; // Sesuaikan dengan route yang sesuai
                            $typeLabel = 'Pelatihan Konsultasi';
                            $typeIcon = 'fas fa-comments';
                            $typeColor = 'purple';
                        }

                        // Get payment status
                        $paymentStatus = $item->status ? $item->status->status : 'unknown';

                        // Get time status
                        $timeStatus = 'belum_dijadwalkan';
                        if ($trainingData->tanggal_mulai && $trainingData->tanggal_selesai) {
                            $tanggalMulai = \Carbon\Carbon::parse($trainingData->tanggal_mulai);
                            $tanggalSelesai = \Carbon\Carbon::parse($trainingData->tanggal_selesai);
                            $sekarang = \Carbon\Carbon::now();

                            if ($sekarang->lt($tanggalMulai)) {
                                $timeStatus = 'akan_datang';
                            } elseif ($sekarang->between($tanggalMulai, $tanggalSelesai)) {
                                $timeStatus = 'berlangsung';
                            } else {
                                $timeStatus = 'selesai';
                            }
                        }
                    @endphp

                    <div class="training-card" data-jenis="{{ $type }}" data-status="{{ $paymentStatus }}"
                        data-waktu="{{ $timeStatus }}">
                        @include('partials.training-card', ['item' => $item, 'type' => $type])
                    </div>
                @endforeach

                <!-- No Results Message -->
                <div id="noResults" class="text-center py-16 hidden">
                    <div class="bg-white rounded-3xl shadow-lg p-12 max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-search text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Tidak Ada Hasil</h3>
                        <p class="text-gray-600 mb-8 text-lg">
                            Tidak ada pelatihan yang sesuai dengan filter yang dipilih.
                            Coba ubah filter atau reset untuk melihat semua pelatihan.
                        </p>
                        <button onclick="resetFilters()"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-8 rounded-2xl transition duration-300 transform hover:scale-105">
                            <i class="fas fa-refresh mr-2"></i>
                            Reset Filter
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <!-- Modal Backdrop -->
        <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <!-- Modal Content -->
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-sign-out-alt text-red-500 mr-2"></i>
                            Konfirmasi Logout
                        </h3>
                        <button onclick="closeLogoutModal()"
                            class="text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-4">
                    <p class="text-gray-600 mb-4">
                        Apakah Anda yakin ingin keluar dari sistem?
                    </p>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-yellow-400 mr-2"></i>
                            <p class="text-sm text-yellow-700">
                                Anda akan diarahkan ke halaman beranda setelah logout.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button onclick="closeLogoutModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                        <i class="fas fa-times mr-1"></i>
                        Batal
                    </button>
                    <button onclick="confirmLogout()"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt mr-1"></i>
                        Ya, Keluar
                    </button>
                </div>
            </div>
        </div>

        <!-- Hidden Form untuk Logout -->
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>

    <!-- JavaScript untuk Filter -->
    <script>
        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
            document.getElementById('logoutModal').classList.add('flex');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
            document.getElementById('logoutModal').classList.remove('flex');
        }

        function confirmLogout() {
            document.getElementById('logoutForm').submit();
        }

        // Close modal ketika klik di luar modal
        document.getElementById('logoutModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLogoutModal();
            }
        });

        // Close modal dengan ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLogoutModal();
            }
        });

        function applyFilters() {
            const filterJenis = document.getElementById('filterJenis').value;
            const filterStatus = document.getElementById('filterStatus').value;
            const filterWaktu = document.getElementById('filterWaktu').value;

            const cards = document.querySelectorAll('.training-card');
            const noResults = document.getElementById('noResults');
            const emptyState = document.getElementById('emptyState');

            let visibleCount = 0;

            cards.forEach(card => {
                const jenis = card.getAttribute('data-jenis');
                const status = card.getAttribute('data-status');
                const waktu = card.getAttribute('data-waktu');

                let shouldShow = true;

                // Filter by jenis
                if (filterJenis !== 'semua' && jenis !== filterJenis) {
                    shouldShow = false;
                }

                // Filter by status
                if (filterStatus !== 'semua' && status !== filterStatus) {
                    shouldShow = false;
                }

                // Filter by waktu
                if (filterWaktu !== 'semua' && waktu !== filterWaktu) {
                    shouldShow = false;
                }

                if (shouldShow) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide no results message
            if (visibleCount === 0 && cards.length > 0) {
                noResults.classList.remove('hidden');
                if (emptyState) emptyState.style.display = 'none';
            } else {
                noResults.classList.add('hidden');
                if (emptyState && cards.length === 0) emptyState.style.display = 'block';
            }

            // Update active filters display
            updateActiveFilters();
        }

        function updateActiveFilters() {
            const filterJenis = document.getElementById('filterJenis');
            const filterStatus = document.getElementById('filterStatus');
            const filterWaktu = document.getElementById('filterWaktu');
            const activeFilters = document.getElementById('activeFilters');
            const filterTags = document.getElementById('filterTags');

            const filters = [];

            if (filterJenis.value !== 'semua') {
                filters.push({
                    label: filterJenis.options[filterJenis.selectedIndex].text,
                    value: filterJenis.value,
                    type: 'jenis'
                });
            }

            if (filterStatus.value !== 'semua') {
                filters.push({
                    label: filterStatus.options[filterStatus.selectedIndex].text,
                    value: filterStatus.value,
                    type: 'status'
                });
            }

            if (filterWaktu.value !== 'semua') {
                filters.push({
                    label: filterWaktu.options[filterWaktu.selectedIndex].text,
                    value: filterWaktu.value,
                    type: 'waktu'
                });
            }

            if (filters.length > 0) {
                activeFilters.classList.remove('hidden');
                filterTags.innerHTML = filters.map(filter =>
                    `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                ${filter.label}
                <button onclick="removeFilter('${filter.type}')" class="ml-1 text-green-600 hover:text-green-800">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </span>`
                ).join('');
            } else {
                activeFilters.classList.add('hidden');
            }
        }

        function removeFilter(type) {
            if (type === 'jenis') {
                document.getElementById('filterJenis').value = 'semua';
            } else if (type === 'status') {
                document.getElementById('filterStatus').value = 'semua';
            } else if (type === 'waktu') {
                document.getElementById('filterWaktu').value = 'semua';
            }
            applyFilters();
        }

        function resetFilters() {
            document.getElementById('filterJenis').value = 'semua';
            document.getElementById('filterStatus').value = 'semua';
            document.getElementById('filterWaktu').value = 'semua';
            applyFilters();
        }

        // Event listeners
        document.getElementById('filterJenis').addEventListener('change', applyFilters);
        document.getElementById('filterStatus').addEventListener('change', applyFilters);
        document.getElementById('filterWaktu').addEventListener('change', applyFilters);

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            applyFilters();
        });
    </script>
</body>

</html>
