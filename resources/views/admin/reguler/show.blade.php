@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Daftar Peserta Pelatihan</h1>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peserta as $item)
                            <!-- Tampilkan data hanya jika nama peserta mengandung kata kunci pencarian -->
                            <tr>
                                <td class="editable">{{ $item['nama_peserta'] }}</td>
                                <td class="editable">{{ $item['email_peserta'] }}</td>
                                <td class="editable">{{ $item['no_hp'] }}</td>
                                <td class="editable">{{ $item->rentang_usia }}</td>
                                <td class="editable">{{ $item->gender }}</td>
                                <td class="editable">{{ $item->kabupaten_kota->nama_kabupaten_kota }}</td>
                                <td class="editable">{{ $item->provinsi->nama_provinsi }}</td>
                                <td class="editable">{{ $item->negara->nama_negara }}</td>
                                <td class="editable">{{ $item['nama_organisasi'] }}</td>
                                <td class="editable">{{ $item->organisasi }}</td>
                                <td class="editable">{{ $item['jabatan_peserta'] }}</td>
                                <td class="editable">{{ $item->informasi }}</td>
                                <td class="editable">{{ $item['pelatihan_relevan'] }}</td>
                                <td class="editable">{{ $item['harapan_pelatihan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    {{-- <table id="daftar_hadir">
        <thead>
            <tr>
                <th class="col-md-2">Nama Peserta</th>
                <th class="col-md-2">Email Peserta</th>
                <th class="col-md-2">Tanggal Presensi</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>test</td>
                <td>test</td>
                <td>test</td>
            </tr>
        </tbody>
    </table> --}}
    {{-- <td class="editable">
                                    <a href="{{ asset('storage/' . $item->bukti_bayar) }}" download>
                                        <img src="{{ asset('storage/' . $item->bukti_bayar) }}" alt="Bukti Bayar"
                                            style="max-width: 100px; max-height: 100px;">
                                        {{ basename($item['bukti_bayar']) }}
                                    </a>
                                </td> --}}



    {{-- @php
    $data2 = app('App\Http\Controllers\DashboardDaftarHadir')->show();
@endphp --}}
    {{-- <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Tabel Daftar Hadir</h6>
    </div> --}}
    {{-- <div class="card-body"> --}}
    {{-- <div class="col-sm-12 ">
            <div id="dataTable_filter" class="dataTables_filter">
                <label>Search:<input type="search" class="form-control form-control-sm" placeholder=""
                        aria-controls="dataTable" name="search"></label>
            </div>
        </div> --}}
    {{-- <div class="col-sm-12 col-md-6 mb-2"> --}}
    {{-- @if ($data->isNotEmpty())
                <a href="{{ route('export.daftarhadir', ['id_pelatihan' => $data->first()->pelatihan->id_pelatihan]) }}"
                    class="btn btn-success"><i style="width:17px" data-feather="file-text"></i></a>
            @endif --}}
    {{-- {{ dd($presensiStatus) }} --}}
    {{-- @if ($data->isEmpty())
                <p>No item available</p>
            @else
                @if ($presensiStatus == 'buka')
                    <!-- If presensi is open, allow admin to close it -->
                    <a href="{{ route('dashboard.reguler.presensi', ['id_pelatihan' => $item->id_pelatihan, 'aksi' => 'tutup']) }}"
                        class="btn btn-danger">Tutup Presensi</a>
                @else
                    <!-- If presensi is closed, allow admin to open it -->
                    <a href="{{ route('dashboard.reguler.presensi', ['id_pelatihan' => $item->id_pelatihan, 'aksi' => 'buka']) }}"
                        class="btn btn-success">Buka Presensi</a>
                @endif
            @endif --}}
    {{-- </div> --}}
    {{-- <div class="table-responsive">
            <table id="daftar_hadir" class="display responsive nowrap" width="100%">
                <thead>
                    <tr>
                        <th class="col-md-2">Nama Peserta</th>
                        <th class="col-md-2">Email Peserta</th>
                        <th class="col-md-2">Tanggal Presensi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataHadir as $item)
                        <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->user->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    <!-- Sertakan jQuery dan DataTables JS -->
    <!-- DataTables CSS -->
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
            var nama_pelatihan = '{{ $nama_pelatihan }}';
            // Inisialisasi DataTable
            $('#pesertaReguler').DataTable({
                layout: {
                    topStart: {
                        buttons: [
                            'excel', 'pdf'
                        ]
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
                scrollX: true,
                scrollY: 200,
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
        });
    </script>
@endsection
