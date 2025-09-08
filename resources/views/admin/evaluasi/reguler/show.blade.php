@extends('layouts.app')

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

    <a href="{{ route('evaluasiRegulerAdmin')}}" class="back-icon mb-3"
       title="Kembali">
        ←
    </a>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'bottom-end'
                });
            });
        </script>
    @endif
    @if (session('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: "{{ session('warning') }}",
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'bottom-end'
                });
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'info',
                    title: 'Info!',
                    text: "{{ session('info') }}",
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'bottom-end'
                });
            });
        </script>
    @endif

    <!-- Header dengan tombol -->
    <div class="flex flex-wrap items-center justify-between pt-3 pb-2 mb-3 border-b border-gray-200">
        <h6 class="text-2xl font-medium text-gray-900">Detail Evaluasi Pelatihan Reguler</h6>
        <div class="flex justify-end">
            @if ($showButtons)
                <a href="{{ route('evaluasiCreateRegulerAdmin', $reguler->id_reguler) }}"
                   class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <i style="width:17px" data-feather="plus" class="mr-2"></i> Buat Form Evaluasi
                </a>
            @else
                <!-- Tombol Edit dan Hapus hanya muncul jika form ada -->
                <a href="{{ url('/admin/evaluasi/edit-form-evaluasi-reguler/' . $reguler->id_reguler) }}"
                   class="inline-flex items-center px-3 py-2 mx-1 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                    Edit Form
                </a>
                <button type="button" id="openDeleteModal"
                        class="inline-flex items-center px-3 py-2 mx-1 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    Hapus Form
                </button>
            @endif
        </div>
    </div>

    <!-- Card Tabel Daftar Peserta -->
    <div class="bg-white shadow-lg rounded-lg mb-6">
        <div class="px-6 py-3 border-b border-gray-200">
            <h6 class="text-lg font-semibold text-green-600">Tabel Daftar Peserta</h6>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <div class="max-w-full mx-auto">
                    <table id="peserta" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Peserta
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pesertaStatus as $peserta)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $peserta->nama_peserta }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $peserta->hasilEvaluasiReguler ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $peserta->hasilEvaluasiReguler ? 'Sudah Mengisi' : 'Belum Mengisi' }}
                                        </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Tabel Evaluasi Pelatihan Peserta -->
    <div class="bg-white shadow-lg rounded-lg mb-6">
        <div class="px-6 py-3 border-b border-gray-200">
            <h6 class="text-lg font-semibold text-green-600">Tabel Evaluasi Pelatihan Peserta</h6>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                @if (empty($labels))
                    <p class="text-center text-gray-500 py-8">Belum ada form evaluasi yang dibuat.</p>
                @else
                    <div class="max-w-full mx-auto">
                        <table id="evaluasi" class="min-w-full divide-y divide-gray-200 border border-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">
                                    Nama Peserta
                                </th>
                                @foreach ($labels as $item)
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-300">{{ $item }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($nama_peserta as $index => $nama)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r border-gray-300">{{ $nama }}</td>
                                    @foreach ($respons[$index] as $value)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r border-gray-300">{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Hapus Form dengan Tailwind CSS -->
    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!-- Header -->
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Penghapusan</h3>
                    <button id="closeDeleteModal" class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-gray-500 hover:text-gray-700" xmlns="http://www.w3.org/2000/svg"
                             width="18" height="18" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <div class="mb-4">
                    <p class="text-gray-700">Apakah Anda yakin ingin menghapus form evaluasi ini? Data Evaluasi ini
                        tidak dapat dikembalikan.</p>
                </div>

                <!-- Footer -->
                <div class="flex justify-end pt-2 space-x-3">
                    <button id="cancelDelete"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Batal
                    </button>
                    <button id="confirmDelete"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Hapus Form
                    </button>
                    <form id="deleteForm" action="{{ route('evaluasiDeleteRegulerAdmin', $reguler->id_reguler) }}"
                          method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS Dependencies -->
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.css"
        rel="stylesheet">

    <!-- JavaScript Dependencies - Load jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.js">
    </script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fungsi untuk menampilkan modal
        function openModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        // Fungsi untuk menyembunyikan modal
        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Event listeners untuk modal
        document.addEventListener('DOMContentLoaded', function () {
            // Buka modal saat tombol diklik
            document.getElementById('openDeleteModal').addEventListener('click', openModal);

            // Tutup modal saat tombol close diklik
            document.getElementById('closeDeleteModal').addEventListener('click', closeModal);

            // Tutup modal saat tombol batal diklik
            document.getElementById('cancelDelete').addEventListener('click', closeModal);

            // Tutup modal saat area luar modal diklik
            document.querySelector('.modal-overlay').addEventListener('click', closeModal);

            // Konfirmasi hapus
            document.getElementById('confirmDelete').addEventListener('click', function () {
                closeModal();
                confirmDelete();
            });
        });

        // Fungsi konfirmasi hapus dengan SweetAlert2
        function confirmDelete() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Form evaluasi ini akan dihapus dan tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                }
            });
        }

        // Ensure DOM is ready and jQuery is loaded
        $(document).ready(function () {
            console.log('jQuery version:', $.fn.jquery);
            console.log('DataTables available:', typeof $.fn.DataTable !== 'undefined');

            // Initialize DataTable for evaluasi table
            if ($('#evaluasi').length > 0) {
                try {
                    $('#evaluasi').DataTable({
                        layout: {
                            topStart: {
                                buttons: [{
                                    extend: 'excel',
                                    title: 'Data Evaluasi Peserta Pelatihan',
                                    className: 'btn btn-success btn-sm',
                                    text: '<svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>Export PDF'
                                }]
                            }
                        },
                        lengthChange: false,
                        paging: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        autoWidth: false,
                        scrollY: 300,
                        // scrollCollapse: true,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, 'All']
                        ]
                    });
                } catch (error) {
                    console.error('Error initializing evaluasi DataTable:', error);
                }
            }

            // Initialize DataTable for peserta table
            if ($('#peserta').length > 0) {
                try {
                    $('#peserta').DataTable({
                        lengthChange: false,
                        paging: true,
                        searching: true,
                        ordering: true,
                        info: true,
                        autoWidth: true,
                        scrollY: 300,
                        scrollCollapse: false,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, 'All']
                        ]
                    });
                } catch (error) {
                    console.error('Error initializing peserta DataTable:', error);
                }
            }
        });
    </script>
@endsection
