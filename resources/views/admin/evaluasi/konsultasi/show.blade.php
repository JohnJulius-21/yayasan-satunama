@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('evaluasiKonsultasiAdmin') }}" style="color: green !important;">Evaluasi</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail Evaluasi {{ $konsultasi->nama_pelatihan }}</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h6 class="h4">Detail Hasil Evaluasi Pelatihan Konsultasi</h6>
        <div class="d-flex justify-content-end">
            @if ($showButtons)
                <a href="{{ route('evaluasiCreateKonsultasiAdmin', $konsultasi->id_pelatihan_konsultasi) }}"
                    class="btn btn-success "><i style="width:17px" data-feather="plus"></i>
                    Buat Form Evaluasi</a>
            @else
                <a href="{{ url('/admin/evaluasi/edit-form-evaluasi-konsultasi/' . $konsultasi->id_pelatihan_konsultasi) }}"
                    class="btn btn-warning px-2">Edit Form</a>
                <a href="#" class="btn btn-danger py-2 mx-1" data-toggle="modal" data-target="#deleteModal">Hapus
                    Form</a>
            @endif

        </div>
    </div>
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
    @if (session('warning'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'la la-exclamation-triangle',
                    title: 'Peringatan',
                    message: "{{ session('warning') }}"
                }, {
                    type: 'warning',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 4000
                });
            });
        </script>
    @endif

    @if (session('info'))
        <script>
            $(document).ready(function() {
                $.notify({
                    icon: 'la la-info-circle',
                    title: 'Info',
                    message: "{{ session('info') }}"
                }, {
                    type: 'info',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    delay: 4000
                });
            });
        </script>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Tabel Daftar Peserta</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="peserta" class="display table dataTable" style="width: 800px; margin: 0 auto;">
                    <thead>
                        <tr>
                            <th>Nama Peserta</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesertaStatus as $peserta)
                            <tr>
                                <td>{{ $peserta->nama_peserta }}</td>
                                <td>{{ $peserta->hasilEvaluasiKonsultasi ? 'Sudah Mengisi' : 'Belum Mengisi' }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Tabel Evaluasi Pelatihan Peserta</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if (empty($labels))
                    <p class="text-center">Belum ada form evaluasi yang dibuat.</p>
                @else
                    <table id="evaluasi" class="display table dataTable" style="width: 800px; margin: 0 auto;">
                        <thead>
                            <tr>
                                <th>Nama Peserta</th>
                                @foreach ($labels as $item)
                                    <th>{{ $item }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nama_peserta as $index => $nama)
                                <tr>
                                    <td>{{ $nama }}</td> <!-- Menampilkan nama pengguna -->
                                    @foreach ($respons[$index] as $value)
                                        <td>{{ $value }}</td> <!-- Menampilkan data respons -->
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Hapus Form -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus form evaluasi ini? Data Evaluasi ini tidak dapat dikembalikan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form action="{{ route('evaluasiDeleteKonsultasiAdmin', $konsultasi->id_pelatihan_konsultasi) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus Form</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sertakan jQuery dan DataTables JS -->
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.css"
        rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#evaluasi').DataTable({
                // dom: 'Bfrtip',
                layout: {
                    topStart: {
                        buttons: [{
                            extend: 'excel',
                            title: 'Data Evaluasi Peserta Pelatihan',
                        }]

                    }
                },
                // layout: {
                //     top1: 'searchBuilder'
                // },
                lengthChange: false,
                // responsive: true,
                // fixedColumns: {
                //     start: 1
                // },
                paging: true,
                select: true,
                // scrollX: 1200,
                scrollY: 300,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ]
            });

            $('#peserta').DataTable({
                // dom: 'Bfrtip',
                // layout: {
                //     topStart: {
                //         buttons: [{
                //             extend: 'excel',
                //             title: 'Data Evaluasi Peserta Pelatihan',
                //         }]

                //     }
                // },
                // layout: {
                //     top1: 'searchBuilder'
                // },
                lengthChange: false,
                // responsive: true,
                // fixedColumns: {
                //     start: 1
                // },
                paging: true,
                select: true,
                // scrollX: 1200,
                scrollY: 300,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ]
            });


            // $('#daftar_hadir').DataTable({
            //     // dom: 'Bfrtip',
            //     layout: {
            //         topStart: {
            //             buttons: [{
            //                     extend: 'pdfHtml5',
            //                     orientation: 'potrait',
            //                     pageSize: 'LEGAL',
            //                     title: 'Data Hadir Peserta Pelatihan ' + nama_pelatihan,
            //                 },
            //                 'spacer',
            //                 {
            //                     extend: 'excel',
            //                     title: 'Data Hadir Peserta Pelatihan ' + nama_pelatihan,
            //                 }
            //             ]

            //         }
            //     },
            //     // layout: {
            //     //     top1: 'searchBuilder'
            //     // },
            //     lengthChange: false,
            //     responsive: true,
            //     // fixedColumns: {
            //     //     start: 1
            //     // },
            //     paging: true,
            //     select: true,
            //     // scrollX: true,
            //     // scrollY: 200,
            //     lengthMenu: [
            //         [10, 25, 50, -1],
            //         [10, 25, 50, 'All']
            //     ]
            // });

        });
    </script>
@endsection
