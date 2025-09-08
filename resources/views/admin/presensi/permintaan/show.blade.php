@extends('layouts.app')
@section('title', 'Admin |  Daftar Presensi Pelatihan Permintaan')

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

    <a href="{{ route('adminPresensiPermintaan')}}" class="back-icon mb-3" title="Kembali">
        ←
    </a>

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 mb-8 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Presensi Pelatihan Permintaan</h1>
                <p class="text-green-100">Kelola dan buat presensi untuk pelatihan permintaan</p>
            </div>
            <div class="hidden md:block">
                <svg class="w-16 h-16 text-green-200" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form Section -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md border border-gray-100 sticky top-6">
                <div class="bg-green-50 px-6 py-4 rounded-t-xl border-b border-green-100">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-800">Buat Presensi Baru</h2>
                    </div>
                </div>

                <div class="p-6">
                    <form id="hidden-form" action="{{ route('savePresensiPermintaan', $permintaan->id_pelatihan_permintaan) }}" method="post" class="space-y-4">
                        @csrf
                        <div>
                            <label for="judul_presensi" class="block text-sm font-medium text-gray-700 mb-2">
                                Judul Presensi
                            </label>
                            <input type="text"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   id="judul_presensi"
                                   name="judul_presensi"
                                   placeholder="Masukkan judul presensi..."
                                   value="{{ $permintaan->judul_presensi }}"
                                   required>
                        </div>
                        <button type="submit"
                                class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Buat Presensi</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- List Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md border border-gray-100">
                <div class="flex items-center justify-between p-6 border-b border-gray-100">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold text-gray-800">Daftar Presensi</h2>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            {{ count($presensi) }} Presensi
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table id="permintaan" class="w-full">
                            <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-medium text-gray-700 w-16">No</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-700">Judul Presensi</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-700">Aksi</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                            @forelse ($presensi as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                                    <td class="py-4 px-4">
                                        <div class="font-medium text-gray-900">{{ $item['judul_presensi'] }}</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-2 flex-wrap gap-2">
                                            <!-- Daftar Peserta Button -->
                                            <a href="{{ route('adminShowPresensiPesertaPermintaan', $item['id_presensi']) }}"
                                               class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                                </svg>
                                                Daftar Peserta
                                            </a>

                                            <!-- Download QR Button -->
                                            <button class="inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-lg transition-colors btn-download-qr"
                                                    data-qr="{{ base64_encode($item['qr_code']) }}">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                QR Code
                                            </button>

                                            <!-- Delete Button -->
                                            <form action="{{ route('adminDestroyPresensiPermintaan', $item['id_presensi']) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                                  class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition-colors">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                            <p class="text-gray-500 text-lg mb-2">Belum ada presensi</p>
                                            <p class="text-gray-400 text-sm">Buat presensi baru menggunakan form di sebelah kiri</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Load jQuery first -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.css" rel="stylesheet">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>

    <!-- SweetAlert2 for success messages -->
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        timer: 4000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'bottom-end'
                    });
                }
            });
        </script>
    @endif

    <!-- Session Messages with SweetAlert2 -->
    @if (session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan!',
                        text: "{{ session('warning') }}",
                        timer: 4000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'bottom-end'
                    });
                }
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info!',
                        text: "{{ session('info') }}",
                        timer: 4000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'bottom-end'
                    });
                }
            });
        </script>
    @endif

    <!-- DataTable Initialization and QR Code functionality -->
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable dengan styling yang disesuaikan
            $('#permintaan').DataTable({
                lengthChange: true,
                responsive: true,
                paging: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                rowReorder: true,
                columnDefs: [{
                    orderable: false,
                    targets: 2
                }],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                }
            });

            // QR Code download functionality
            $('.btn-download-qr').on('click', function(e) {
                e.preventDefault();

                const encodedSvg = $(this).attr('data-qr');
                if (!encodedSvg) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('QR Code tidak tersedia', '', 'error');
                    } else {
                        alert('QR Code tidak tersedia');
                    }
                    return;
                }

                const svgString = atob(encodedSvg);
                const blob = new Blob([svgString], {
                    type: 'image/svg+xml'
                });
                const url = URL.createObjectURL(blob);

                const image = new Image();
                image.onload = function() {
                    const canvas = document.createElement('canvas');
                    canvas.width = image.width;
                    canvas.height = image.height;

                    const ctx = canvas.getContext('2d');
                    ctx.fillStyle = '#ffffff';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(image, 0, 0);

                    const pngUrl = canvas.toDataURL('image/png');

                    const link = document.createElement('a');
                    link.href = pngUrl;
                    link.download = 'qr-code-presensi.png';
                    link.click();

                    URL.revokeObjectURL(url);
                };

                image.onerror = function() {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Gagal memuat QR Code', '', 'error');
                    } else {
                        alert('Gagal memuat QR Code');
                    }
                };

                image.src = url;
            });
        });
    </script>
@endsection
