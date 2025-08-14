@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('adminPresensiReguler') }}" style="color: green !important;">Presensi Reguler</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Buat Presensi Pelatihan</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">List Presensi Pelatihan Reguler</h6>
        {{-- <div class="d-flex justify-content-end">
            <a href="{{ route('generatePresensi', $reguler->id_reguler) }}" class="btn btn-success"><i style="width:17px"
                    data-feather="plus"></i>
                Buat
                Presensi</a>
        </div> --}}
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
    <div class="col-lg-18 mb-4 ">
        {{-- <div class="container"> --}}

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="d-flex justify-content-start">
                    <h6 class="m-0 font-weight-bold text-success">Reguler</h6>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive-md">
                    <table id="reguler" class="table table-bordered display" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>Email Peserta</th>
                                <th>No Hp Peserta</th>
                                <th>Nama Organisasi</th>
                                <th>Tanggal dan Waktu Presensi</th>
                                <th>Status Presensi</th>
                                {{-- <th class="col-md-1" scope="col">Tindakan</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_peserta }}</td>
                                    <td>{{ $item->email_peserta }}</td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td>{{ $item->nama_organisasi }}</td>
                                    <td>
                                        @if ($item->tanggal_presensi)
                                            {{ \Carbon\Carbon::parse($item->tanggal_presensi)->locale('id')->isoFormat('DD-MM-Y [-] HH:mm') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <span
                                            class="text-white badge bg-{{ $item->status_presensi === 'Sudah Presensi' ? 'success' : 'secondary' }}">
                                            {{ $item->status_presensi }}
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
    <!-- Sertakan jQuery dan DataTables JS -->
    {{-- <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.css"
        rel="stylesheet"> --}}

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
            // Inisialisasi DataTable
            $('#reguler').DataTable({
                layout: {
                    topStart: {
                        buttons: [{
                            extend: 'pdf',
                            title: 'Data Presensi Peserta Pelatihan {{ $presensi->judul_presensi }}',
                        }]

                    }
                },
                lengthChange: true,
                // responsive: true,
                paging: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                // rowReorder: true,
                // columnDefs: [{
                //     orderable: false,
                //     targets: 6
                // }]
            });
        });
    </script>
@endsection
