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
                <table id="peserta" class="display table dataTable" style="width: 800px; margin: 0 auto;">
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
                        {{-- @foreach ($reguler as $item)
                            <!-- Tampilkan data hanya jika nama peserta mengandung kata kunci pencarian -->
                            <tr>
                                <td class="editable">{{ $item['nama_peserta'] }}</td>
                                <td class="editable">{{ $item['email_peserta'] }}</td>
                                <td class="editable">{{ $item['no_hp'] }}</td>
                                <td class="editable">{{ $item->rentang_usia->usia }}</td>
                                <td class="editable">{{ $item->gender }}</td>
                                <td class="editable">{{ $item->kabupaten_kota->nama_kabupaten_kota }}</td>
                                <td class="editable">{{ $item->provinsi->nama_provinsi }}</td>
                                <td class="editable">{{ $item->negara->nama_negara }}</td>
                                <td class="editable">{{ $item['nama_organisasi'] }}</td>
                                <td class="editable">{{ $item->jenis_organisasi->organisasi }}</td>
                                <td class="editable">{{ $item['jabatan_peserta'] }}</td>
                                <td class="editable">{{ $item->informasi_pelatihan->keterangan }}</td>
                                <td class="editable">{{ $item['pelatihan_relevan'] }}</td>
                                <td class="editable">{{ $item['harapan_pelatihan'] }}</td>
                                <td class="editable">
                                    <a href="{{ asset('storage/' . $item->bukti_bayar) }}" download>
                                        <img src="{{ asset('storage/' . $item->bukti_bayar) }}" alt="Bukti Bayar"
                                            style="max-width: 100px; max-height: 100px;">
                                        {{ basename($item['bukti_bayar']) }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>

            </div>
        </div>
    </div>




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
            var nama_pelatihan = '{{ $nama_pelatihan }}';
            // Inisialisasi DataTable
            $('#peserta').DataTable({
                // dom: 'Bfrtip',
                layout: {
                    topStart: {
                        buttons: [{
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                title: 'Data Peserta Pelatihan ' + nama_pelatihan,
                            },
                            'spacer',
                            {
                                extend: 'excel',
                                title: 'Data Peserta Pelatihan ' + nama_pelatihan,
                            }
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
