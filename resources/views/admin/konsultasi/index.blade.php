@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Daftar Konsultasi</h1>
    </div>
    @if (Session::has('success'))
        <div class="pt-3">
            <div class="alert alert-success">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="col-lg-18 mb-4 ">
        {{-- <div class="container"> --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-start">
                    <h6 class="m-0 font-weight-bold text-success">Konsultasi</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="konsultasi" class="table table-bordered display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="col-md-3" scope="col">Nama Organisasi</th>
                                <th class="col-md-1" scope="col">Tanggal Daftar</th>
                                <th class="col-md-1 text-center" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($konsultasi as $item)
                                <tr>
                                    <td>{{ $item['nama_organisasi'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('konsultasiShowAdmin', $item->id_konsultasi) }}"
                                            class="btn btn-primary px-2"><i style="width:17px" data-feather="eye"></i> Lihat
                                            Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-18 mb-4 ">
        {{-- <div class="container"> --}}

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="d-flex justify-content-start">
                    <h6 class="m-0 font-weight-bold text-success">Tabel Pelatihan</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-md">
                    <table id="daftar" class="table table-bordered display responsive nowrap" width="100%"">
                        <thead>
                            <tr>
                                <th class="col-md-3" scope="col">Nama Pelatihan</th>
                                <th class="col-md-2" scope="col">Tanggal Pelatihan</th>
                                <th class="col-md-1" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item['nama_pelatihan'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('D MMMM') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.konsultasi.detail', $item->id_konsultasi) }}"
                                            class="btn btn-primary px-2"><i style="width:17px" data-feather="eye"></i></a>
                                        <a href="{{ url('dashboard/konsultasi/' . $item->id . '/edit') }}"
                                            class="btn btn-warning px-2"><i style="width:17px" data-feather="edit"></i></a>
                                        <form class="d-inline m-0"
                                            action="{{ route('dashboard.konsultasi.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger px-2" type="submit"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                    style="width:17px" data-feather="trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Sertakan jQuery dan DataTables JS -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#konsultasi').DataTable({
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
                }]
            });

            $('#daftar').DataTable({
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
                }]
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
