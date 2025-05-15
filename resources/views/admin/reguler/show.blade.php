@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('regulerAdmin') }}" style="color: green !important;">Reguler</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Peserta Pelatihan</li>
        </ol>
    </nav>
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
    @if (session('error'))
    <script>
        $(document).ready(function () {
            $.notify({
                icon: 'la la-exclamation-circle',
                title: 'Gagal',
                message: "{{ session('error') }}"
            }, {
                type: 'danger',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                delay: 4000
            });
        });
    </script>
    @endif
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Daftar Peserta Pelatihan</h6>
        <div class="d-flex justify-content-end">
            <!-- Tombol untuk memunculkan modal -->
                    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalTambahPeserta">
                        Tambah Peserta
                    </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Tabel Daftar Peserta</h6>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="pesertaReguler" class="display table dataTable" style="width: 800px; margin: 0 auto;">
                    <thead>
                        <tr>
                            <th>Nama Peserta</th>
                            <th>Email Peserta</th>
                            <th>No. HP</th>
                            <th>Rentang Usia</th>
                            <th>Gender</th>
                            <th>Kabupaten/Kota</th>
                            <th>Provinsi</th>
                            <th>Negara</th>
                            <th>Nama Organisasi</th>
                            <th>Jenis Organisasi</th>
                            <th>Jabatan Peserta</th>
                            <th>Informasi Pelatihan</th>
                            <th>Pelatihan Relevan</th>
                            <th>Harapan Pelatihan</th>
                            <th>Status Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peserta as $item)
                            <!-- Tampilkan data hanya jika nama peserta mengandung kata kunci pencarian -->
                            <tr>
                                <td class="editable">{{ $item['nama_peserta'] ?? '-' }}</td>
        <td class="editable">{{ $item['email_peserta'] ?? '-' }}</td>
        <td class="editable">{{ $item['no_hp'] ?? '-' }}</td>
        <td class="editable">{{ $item->rentang_usia ?? '-' }}</td>
        <td class="editable">{{ $item->gender ?? '-' }}</td>
        <td class="editable">{{ $item->kabupaten_kota->nama_kabupaten_kota ?? '-' }}</td>
        <td class="editable">{{ $item->provinsi->nama_provinsi ?? '-' }}</td>
        <td class="editable">{{ $item->negara->nama_negara ?? '-' }}</td>
        <td class="editable">{{ $item['nama_organisasi'] ?? '-' }}</td>
        <td class="editable">{{ $item->organisasi ?? '-' }}</td>
        <td class="editable">{{ $item['jabatan_peserta'] ?? '-' }}</td>
        <td class="editable">{{ $item->informasi ?? '-' }}</td>
        <td class="editable">{{ $item['pelatihan_relevan'] ?? '-' }}</td>
        <td class="editable">{{ $item['harapan_pelatihan'] ?? '-' }}</td>
                                <td>
                                    <select class="form-select form-select-sm status-dropdown"
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
<div class="modal fade" id="modalTambahPeserta" tabindex="-1" aria-labelledby="modalTambahPesertaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{route('regulerStorePesertaAdmin')}}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahPesertaLabel">Tambah Peserta Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Nama -->
                        <div class="col-md-6 mb-3">
                            <label for="nama_peserta" class="form-label">Nama Peserta</label>
                            <input type="text" name="nama_peserta" class="form-control" required>
                        </div>
                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label for="email_peserta" class="form-label">Email</label>
                            <input type="email" name="email_peserta" class="form-control" required>
                        </div>
                        <!-- No HP -->
                        <div class="col-md-6 mb-3">
                            <label for="no_hp" class="form-label">No. HP</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <!-- Gender -->
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="">Pilih Gender</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                                <option value="Transgender">Transgender</option>
                                <option value="Tidak ingin menyebutkan">Tidak ingin menyebutkan</option>
                            </select>
                        </div>
                        <!-- Rentang Usia -->
                        <div class="col-md-6 mb-3">
                            <label for="rentang_usia" class="form-label">Rentang Usia</label>
                            <select name="rentang_usia" class="form-control">
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
                        <div class="col-md-6 mb-3">
                            <label for="nama_organisasi" class="form-label">Nama Organisasi</label>
                            <input type="text" name="nama_organisasi" class="form-control">
                        </div>
                        <!-- Jenis Organisasi -->
                        <div class="col-md-6 mb-3">
                            <label for="jenis_organisasi" class="form-label">Jenis Organisasi</label>
                            <select name="organisasi" class="form-control">
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
                        <div class="col-md-6 mb-3">
                            <label for="jabatan_peserta" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan_peserta" class="form-control">
                        </div>
                        <!-- Harapan -->
                        <div class="col-md-12 mb-3">
                            <label for="harapan_pelatihan" class="form-label">Harapan Pelatihan</label>
                            <textarea name="harapan_pelatihan" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
        .select2-container .select2-selection--single {
            height: 38px;
            /* Set tinggi untuk mirip dengan field Bootstrap */
            border: 1px solid #ced4da;
            /* Border default Bootstrap */
            border-radius: 0.25rem;
            /* Radius border Bootstrap */
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            /* Vertikal center teks */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
            /* Tinggi panah dropdown */
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6c757d;
            /* Warna placeholder mirip Bootstrap */
        }
    </style>
    
    <!-- Sertakan jQuery dan DataTables JS -->
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>


    <script>
       $(document).ready(function() {
        $('#pesertaReguler').DataTable({
            lengthChange: false,
            responsive: true,
            paging: true,
            scrollX: true,
            scrollY: 300,
            autoWidth: false,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
                ],
            columnDefs: [
                { orderable: false, targets: 3 }
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
        
        $(document).ready(function() {
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
    </script>
@endsection
