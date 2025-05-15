@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('konsultasiAdmin') }}" style="color: green !important;">Konsultasi</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail Konsultasi</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h4">Detail Pelatihan Konsultasi</h1>
        <div class="d-flex justify-content-end">
            {{-- @foreach ($konsultasi as $item)
                    <a href="{{ route('konsultasiCreateAdmin', $item->id_konsultasi) }}" class="btn btn-success mx-1"><i
                            style="width:17px" data-feather="plus"></i> Buatkan Pelatihan
                    </a>
                @endforeach --}}
            @foreach ($konsultasi_pelatihan as $item)
                <a href="{{ route('konsultasiCreatePeserta', $item->id_pelatihan_konsultasi) }}" class="btn btn-success mx-1"><i
                        style="width:17px" data-feather="plus"></i> Buatkan Akun Peserta</a>
            @endforeach

        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-start">
                <p class="m-0 font-weight-bold text-success">Informasi Pelatihan</p>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    @foreach ($konsultasi_pelatihan as $item)
                        <tr>
                            <th>Nama Pelatihan : </th>
                            <td>{{ $item['nama_pelatihan'] }}</td>
                        </tr>
                        <tr>
                            <th>Tema : </th>
                            <td>{{ $item->tema->judul_tema }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Mulai Pelatihan :</th>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Selesai Pelatihan :</th>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Metode Pelatihan : </th>
                            <td>{{ $item['metode_pelatihan'] }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi Pelatihan : </th>
                            <td>{{ $item['lokasi_pelatihan'] }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi Pelatihan : </th>
                            <td>{!! $item['deskripsi_pelatihan'] !!}</td>
                        </tr>
                    @endforeach
                </table>
                {{-- <a class="btn btn-secondary mt-4" href="{{ route('konsultasiAdmin') }}">Kembali</a> --}}
            </div>
        </div>
    </div>

    



    <!-- Sertakan jQuery dan DataTables JS -->
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" rel="stylesheet"
        integrity="sha384-ZVBvXH2IGOw6fHIntvmU2wOUGWutDViMwSQwdGEvaJkHVvm1S8N/HE/zBK91NXSV" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.css" rel="stylesheet"
        integrity="sha384-WnU9UKIFykmC5nUngG4IGkdl3+/E5Rx7JmiggfjyAY804EuDkGcxL4aJMdN5iuTJ" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.dataTables.css" rel="stylesheet"
        integrity="sha384-inDoREwjvy5La3vgUWcIczhlGcfXAt1V1DsIU/yHRTbfL3W/HfMnReyF4xwS7S+x" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/scroller/2.4.3/css/scroller.dataTables.css" rel="stylesheet"
        integrity="sha384-fvFMooh85/CFhRcmgNLO/DEXj4/h8h4Fz2s0Wtq2hPU/s7z0rLzrk77ID2JS+YUg" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha384-ogycHROOTGA//2Q8YUfjz1Sr7xMOJTUmY2ucsPVuXAg4CtpgQJQzGZsX768KqetU" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.js"
        integrity="sha384-w52cgKJL63XVo8/Wwyl+z8ly0lI51gzCtqADl8pHQTXUXkF08iRa7D+sjSmCyHp+" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.js"
        integrity="sha384-P2rohseTZr3+/y/u+6xaOAE3CIkcmmC0e7ZjhdkTilUMHfNHCerfVR9KICPeFMOP" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"
        integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"
        integrity="sha384-gGekiWQ/bm8p71RTsvhPShoIBxcf8BsVjRTi0WY8FvxuQa2nKS0PKHiSXV9nfW/A" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"
        integrity="sha384-wCLG3FbyFPnMZM65D+pam9KW+2joK88dh4jfSMK0OuMQ2cBQHV0t55OqmQduaQ1S" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.js"
        integrity="sha384-r5RumiuQhALaYWd8i8v0DxCjEXRayyj6nl1wP379+GexLAvE4yuLNoyPEvE6hzDu" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.js"
        integrity="sha384-zAVoatBLtEAzOhdX4Xkli8AOOsRiPj+iFEsCh/BBYnKNHJCM/G8PNGupst4xx3Ft" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/scroller/2.4.3/js/dataTables.scroller.js"
        integrity="sha384-cCDhK6VsxVGKfl0shwjJr2UXaCzEpxhSnd7C8Uan8yABW71pdY3iaz8aVBklw8uz" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#konsultasi').DataTable({
                // dom: 'Bfrtip',
                layout: {
                    topStart: {
                        buttons: [{
                                extend: 'pdfHtml5',
                                orientation: 'potrait',
                                pageSize: 'LEGAL',
                                title: 'Data Detail Konsultasi',
                            },
                            'spacer',
                            {
                                extend: 'excel',
                                title: 'Data Detail Konsultasi',
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
                scrollX: true,
                scrollY: 200,
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
            //     // responsive: true,
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
