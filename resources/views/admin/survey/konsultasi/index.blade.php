@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Survey Kepuasan Pelatihan Konsultasi</h6>
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
    <div class="col-lg-18 mb-4 ">
        {{-- <div class="container"> --}}

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="d-flex justify-content-start">
                    <h6 class="m-0 font-weight-bold text-success">Konsultasi</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-md">
                    <table id="reguler" class="table table-bordered display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="col-md-3" scope="col">Nama Pelatihan</th>
                                <th class="col-md-2" scope="col">Tanggal Pelatihan</th>
                                <th class="col-md-1" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($konsultasi as $item)
                                <tr>

                                    <td>{{ $item['nama_pelatihan'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('surveyShowKonsultasiAdmin', $item->id_pelatihan_konsultasi) }}"
                                            class="btn btn-primary px-2">Lihat Detail</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-start">
                    <h6 class="m-0 font-weight-bold text-success">Permintaan</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="permintaan" class="table table-bordered display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="col-md-3" scope="col">Judul Pelatihan</th>
                                <th class="col-md-2" scope="col">Tanggal Pelatihan</th>
                                <th class="col-md-1" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data2 as $item)
                                <tr>
                                    <td>{{ $item->nama_pelatihan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->waktu_pelaksanaan)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.surveykepuasan.showpermintaan', $item->id) }}"
                                            class="btn btn-primary px-2"><i style="width:17px" data-feather="eye"></i></a>
                                        <a href="{{ url('/dashboard/surveykepuasan/edit-permintaan/' . $item->id) }}"
                                            class="btn btn-warning px-2"><i style="width:17px" data-feather="edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
                                <th class="col-md-3" scope="col">Judul Pelatihan</th>
                                <th class="col-md-2" scope="col">Tanggal</th>
                                <th class="col-md-1" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data3 as $item)
                                <tr>
                                    <td>{{ $item['nama_pelatihan'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }} </td>
                                    <td>
                                        <a href="{{ route('dashboard.surveykepuasan.showkonsultasi', $item->id_konsultasi) }}"
                                            class="btn btn-primary px-2"><i style="width:17px" data-feather="eye"></i></a>
                                        <a href="{{ url('/dashboard/surveykepuasan/edit-konsultasi/' . $item->id_konsultasi) }}"
                                            class="btn btn-warning px-2"><i style="width:17px" data-feather="edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- Sertakan jQuery dan DataTables JS -->
    {{-- <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.css"
        rel="stylesheet"> --}}

    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#reguler').DataTable({
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
                }]
            });

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
        });
    </script>
@endsection
