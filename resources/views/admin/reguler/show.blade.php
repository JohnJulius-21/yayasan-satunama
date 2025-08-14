@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'la la-thumbs-up',
                    title: 'Berhasil',
                    message: "{{ session('success') }}"
                }, {
                    type: 'success',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 3000
                });
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                // buka kembali modal tambah peserta
                $('#modalTambahPeserta').modal('show');

                // gabungkan semua pesan error menjadi satu string
                const errors = `{!! implode('<br>', $errors->all()) !!}`;

                $.notify({
                    icon: 'la la-exclamation-circle',
                    title: 'Gagal',
                    message: errors
                }, {
                    type: 'danger',
                    placement: {
                        from: 'bottom',
                        align: 'right'
                    },
                    delay: 5000
                });
            });
        </script>
    @endif

    <div class="flex flex-wrap md:flex-nowrap justify-between items-center pt-3 pb-2 mb-3 border-b border-gray-200">
        <h6 class="text-xl font-semibold text-gray-800">Daftar Peserta Pelatihan</h6>
        <div class="flex justify-end">
            <!-- Tombol untuk memunculkan modal -->
            <button class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded mb-3"
                data-toggle="modal" data-target="#modalTambahPeserta">
                Tambah Peserta
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md mb-4">
        

            <div class="overflow-x-auto">
                <table class="min-w-full text-left whitespace-nowrap">
                    <thead class="bg-gray-100 text-gray-900 text-sm font-medium">
                        <tr>
                            <th class="px-4 py-3 font-medium">Nama Peserta</th>
                            <th class="px-4 py-3 font-medium">Email Peserta</th>
                            <th class="px-4 py-3 font-medium">No. HP</th>
                            <th class="px-4 py-3 font-medium">Rentang Usia</th>
                            <th class="px-4 py-3 font-medium">Gender</th>
                            <th class="px-4 py-3 font-medium">Kabupaten/Kota</th>
                            <th class="px-4 py-3 font-medium">Provinsi</th>
                            <th class="px-4 py-3 font-medium">Negara</th>
                            <th class="px-4 py-3 font-medium">Nama Organisasi</th>
                            <th class="px-4 py-3 font-medium">Jenis Organisasi</th>
                            <th class="px-4 py-3 font-medium">Jabatan Peserta</th>
                            <th class="px-4 py-3 font-medium">Informasi Pelatihan</th>
                            <th class="px-4 py-3 font-medium">Pelatihan Relevan</th>
                            <th class="px-4 py-3 font-medium">Harapan Pelatihan</th>
                            <th class="px-4 py-3 font-medium">Status Bayar</th>
                        </tr>
                    </thead>
                    <tbody id="newsTableBody" class="divide-y divide-gray-200 text-sm">
                        @foreach ($peserta as $item)
                            <!-- Tampilkan data hanya jika nama peserta mengandung kata kunci pencarian -->
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-900 editable">{{ $item['nama_peserta'] ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">{{ $item['email_peserta'] ?? '-' }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">{{ $item['no_hp'] ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">{{ $item->rentang_usia ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">{{ $item->gender ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">
                                    {{ $item->kabupaten_kota->nama_kabupaten_kota ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">
                                    {{ $item->provinsi->nama_provinsi ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">{{ $item->negara->nama_negara ?? '-' }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">{{ $item['nama_organisasi'] ?? '-' }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">{{ $item->organisasi ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">{{ $item['jabatan_peserta'] ?? '-' }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">{{ $item->informasi ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">
                                    {{ $item['pelatihan_relevan'] ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900 editable">
                                    {{ $item['harapan_pelatihan'] ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    <select
                                        class="w-full px-3 py-1 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent status-dropdown"
                                        data-id="{{ $item->id_peserta_reguler }}">
                                        <option value="belum_bayar"
                                            {{ $item->status && $item->status->status === 'belum_bayar' ? 'selected' : '' }}>
                                            Belum Bayar</option>
                                        <option value="sudah_bayar"
                                            {{ $item->status && $item->status->status === 'sudah_bayar' ? 'selected' : '' }}>
                                            Sudah Bayar</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" id="modalTambahPeserta" tabindex="-1"
        aria-labelledby="modalTambahPesertaLabel" aria-hidden="true">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-y-auto">
                <form action="{{ route('regulerStorePesertaAdmin') }}" method="POST">
                    @csrf
                    <input type="hidden" id="id_reguler" name="id_reguler" value="{{ $reguler->id_reguler }}">
                    <div class="bg-white rounded-lg">
                        <div class="flex justify-between items-center p-6 border-b border-gray-200">
                            <h5 class="text-xl font-semibold text-gray-800" id="modalTambahPesertaLabel">Tambah Peserta Baru
                            </h5>
                            <button type="button" class="text-gray-400 hover:text-gray-600 text-2xl font-bold"
                                data-dismiss="modal" aria-label="Tutup">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Nama -->
                                <div class="mb-3">
                                    <label for="nama_peserta" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                        Peserta</label>
                                    <input type="text" name="nama_peserta"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                        required>
                                </div>
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email_peserta"
                                        class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email_peserta"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                        required>
                                </div>
                                <!-- No HP -->
                                <div class="mb-3">
                                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No.
                                        HP</label>
                                    <input type="text" name="no_hp"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('no_hp') border-red-500 @enderror"
                                        value="{{ old('no_hp') }}" required maxlength="12" pattern="\d{1,12}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,12);">
                                    @error('no_hp')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Gender -->
                                <div class="mb-3">
                                    <label for="gender"
                                        class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                                    <select name="gender"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                        required>
                                        <option value="">Pilih Gender</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                        <option value="Transgender">Transgender</option>
                                        <option value="Tidak ingin menyebutkan">Tidak ingin menyebutkan</option>
                                    </select>
                                </div>
                                <!-- Rentang Usia -->
                                <div class="mb-3">
                                    <label for="rentang_usia" class="block text-sm font-medium text-gray-700 mb-2">Rentang
                                        Usia</label>
                                    <select name="rentang_usia"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                        <option value="">Pilih Rentang Usia</option>
                                        <option value="20-25">20-25</option>
                                        <option value="26-30">26-30</option>
                                        <option value="31-35">31-35</option>
                                        <option value="36-40">36-40</option>
                                        <option value="41-45">41-45</option>
                                        <option value="46-50">46-50</option>
                                        <option value="> 50">> 50</option>
                                    </select>
                                </div>
                                <!-- Nama Organisasi -->
                                <div class="mb-3">
                                    <label for="nama_organisasi" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                        Organisasi</label>
                                    <input type="text" name="nama_organisasi"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                                <!-- Jenis Organisasi -->
                                <div class="mb-3">
                                    <label for="jenis_organisasi"
                                        class="block text-sm font-medium text-gray-700 mb-2">Jenis Organisasi</label>
                                    <select name="organisasi"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                        <option value="">Pilih Jenis Organisasi</option>
                                        <option value="Personal">Personal</option>
                                        <option value="Pemerintah">Pemerintah</option>
                                        <option value="Lembaga Pendidikan">Lembaga Pendidikan</option>
                                        <option value="Komunitas">Komunitas</option>
                                        <option value="Organisasi Nirlaba">Organisasi Nirlaba</option>
                                        <option value="Perusahaan">Perusahaan</option>
                                        <option value="Partai Politik">Partai Politik</option>
                                    </select>
                                </div>
                                <!-- Jabatan -->
                                <div class="mb-3">
                                    <label for="jabatan_peserta"
                                        class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                                    <input type="text" name="jabatan_peserta"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                                {{-- negara --}}
                                <div class="mb-3">
                                    <label for="negara"
                                        class="block text-sm font-medium text-gray-700 mb-2">Negara</label>
                                    <select
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent select2 select-negara @error('id_negara') border-red-500 @enderror"
                                        name="id_negara">
                                        <option value="">Pilih Negara</option>
                                        @foreach ($negara as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('id_negara') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_negara }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_negara')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="provinsi"
                                        class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                    <select
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent select2 select-provinsi @error('id_provinsi') border-red-500 @enderror"
                                        name="id_provinsi">
                                        <option value="">Pilih Provinsi</option>
                                    </select>
                                    @error('id_provinsi')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kabupaten"
                                        class="block text-sm font-medium text-gray-700 mb-2">Kabupaten</label>
                                    <select
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent select2 select-kabupaten @error('id_kabupaten') border-red-500 @enderror"
                                        name="id_kabupaten">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                    @error('id_kabupaten')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Alamat -->
                                <div class="mb-3">
                                    <label for="alamat"
                                        class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                    <input type="text" name="alamat"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                                <!-- Harapan -->
                                <div class="col-span-1 md:col-span-2 mb-3">
                                    <label for="harapan_pelatihan"
                                        class="block text-sm font-medium text-gray-700 mb-2">Harapan Pelatihan</label>
                                    <textarea name="harapan_pelatihan"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                        rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-3 px-6 py-4 border-t border-gray-200">
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md">Simpan</button>
                            <button type="button"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md"
                                data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sertakan jQuery dan DataTables JS -->
    <!-- DataTables CSS -->
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.css"
        rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.js">
    </script>


    <script>
        $(document).ready(function() {
            $('#pesertaReguler').DataTable({
                layout: {
                    topStart: {
                        buttons: [{
                            extend: 'excel',
                            title: 'Data Peserta Pelatihan',
                        }]

                    }
                },
                lengthChange: false,
                paging: true,
                select: true,
                // scrollX: 1200,
                scrollY: 300,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ]
            });

            $('#daftar_hadir').DataTable({
                // dom: 'Bfrtip',
                layout: {
                    topStart: {
                        buttons: [{
                                extend: 'pdfHtml5',
                                orientation: 'potrait',
                                pageSize: 'LEGAL',
                                title: 'Data Hadir Peserta Pelatihan ' + nama_pelatihan,
                            },
                            'spacer',
                            {
                                extend: 'excel',
                                title: 'Data Hadir Peserta Pelatihan ' + nama_pelatihan,
                            }
                        ]

                    }
                },
                // layout: {
                //     top1: 'searchBuilder'
                // },
                lengthChange: false,
                responsive: true,
                // fixedColumns: {
                //     start: 1
                // },
                paging: true,
                select: true,
                // scrollX: true,
                // scrollY: 200,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ]
            });

            // Inisialisasi Select2
            $('.select2 select-negara').select2();
            $('.select2 select-provinsi').select2();
            $('.select2 select-kabupaten').select2();

            // Event listener untuk Negara -> Ambil daftar provinsi
            $(document).on('change', '.select-negara', function() {
                var index = $(this).data('index'); // Ambil nomor peserta
                var negaraId = $(this).val();

                // Reset Provinsi dan Kabupaten
                $('#id_provinsi_' + index).empty().append('<option value="">Pilih Provinsi</option>')
                    .trigger('change');
                $('#id_kabupaten_' + index).empty().append('<option value="">Pilih Kota</option>').trigger(
                    'change');

                if (negaraId) {
                    $.ajax({
                        url: '/get-provinsi/' + negaraId,
                        type: 'GET',
                        success: function(data) {
                            var options = '<option value="">Pilih Provinsi</option>';
                            $.each(data.provinsi, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#id_provinsi_' + index).html(options).trigger('change');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                        }
                    });
                }
            });

            // Event listener untuk Provinsi -> Ambil daftar kabupaten
            $(document).on('change', '.select-provinsi', function() {
                var index = $(this).data('index'); // Ambil nomor peserta
                var provinsiId = $(this).val();

                // Reset Kabupaten
                $('#id_kabupaten_' + index).empty().append('<option value="">Pilih Kota</option>').trigger(
                    'change');

                if (provinsiId) {
                    $.ajax({
                        url: '/get-kabupaten/' + provinsiId,
                        type: 'GET',
                        success: function(data) {
                            var options = '<option value="">Pilih Kota</option>';
                            $.each(data.kabupaten, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#id_kabupaten_' + index).html(options).trigger('change');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseText);
                        }
                    });
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.status-dropdown').forEach(dropdown => {
                dropdown.addEventListener('change', function() {
                    const status = this.value;
                    const id = this.getAttribute('data-id');

                    fetch(`/admin/update-status-peserta/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: status
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                $.notify({
                                    icon: 'la la-thumbs-up',
                                    title: 'Berhasil',
                                    message: 'Status berhasil diperbarui'
                                }, {
                                    type: 'success',
                                    placement: {
                                        from: "bottom",
                                        align: "right"
                                    },
                                    delay: 3000
                                });
                            } else {
                                $.notify({
                                    icon: 'la la-exclamation-triangle',
                                    title: 'Gagal',
                                    message: 'Gagal memperbarui status'
                                }, {
                                    type: 'danger',
                                    placement: {
                                        from: "bottom",
                                        align: "right"
                                    },
                                    delay: 3000
                                });
                            }
                        });
                });
            });
        });
    </script>
@endsection
