@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Evaluasi Pelatihan</h1>
    </div>
    @if (Session::has('success'))
        <div class="pt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
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
                    <table id="reguler" class="table table-bordered display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="col-md-5" scope="col">Nama Pelatihan</th>
                                <th class="col-md-1" scope="col">Tanggal Pelatihan</th>
                                <th class="col-md-1" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item['nama_pelatihan'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->locale('id')->isoFormat('D MMMM') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->tanggal_batas_pendaftaran)->locale('id')->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.evaluasi.show', $item->id_pelatihan) }}"
                                            class="btn btn-primary px-2"><i style="width:17px" data-feather="eye"></i></a>
                                        <a href="{{ url('/dashboard/evaluasi/edit-reguler/' . $item->id_pelatihan) }}"
                                            class="btn btn-warning px-2"><i style="width:17px" data-feather="edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach --}}
                            <tr>
                                <td>test</td>
                                <td>test
                                </td>
                                <td>

                                    <a href="{{ route('evaluasiShowRegulerAdmin') }}" class="btn btn-primary px-2"><i
                                            class="mdi mdi-eye-circle-outline" style="width:117px"></i></a>
                                    <a href="" class="btn btn-warning px-2"><span
                                            class="mdi mdi-pencil-outline"></span></i></a>
                                </td>
                            </tr>
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
        });
    </script>
@endsection
