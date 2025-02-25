@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Daftar Permintaan</h1>
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
                    <h6 class="m-0 font-weight-bold text-success">Tabel Daftar Permintaan</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-md">
                    <table id="permintaan" class="table table-bordered display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="col-md-2" scope="col">Mitra</th>
                                <th class="col-md-2" scope="col">Judul Pelatihan</th>
                                <th class="col-md-1" scope="col">Tanggal Permintaan</th>
                                {{-- <th class="col-md-1 text-center" scope="col">Tindakan</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permintaan as $item)
                                <tr>
                                    <td>{{ $item->mitra->nama_mitra }}</td>
                                    <td>{{ $item['judul_pelatihan'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM Y') }}
                                    </td>
                                    {{-- <td class="d-flex justify-content-center">
                                        <a href="{{ route('dashboard.permintaan.show', $item->id) }}"
                                            class="btn btn-primary px-2"><i style="width:17px" data-feather="eye"></i> Lihat
                                            Detail</a>
                                    </td> --}}
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
                            {{-- @foreach ($permintaan as $item)
                                <tr>
                                    <td>{{ $item['nama_pelatihan'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('D MMMM') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('dashboard.permintaan.detail', $item->id) }}"
                                            class="btn btn-primary px-2"><i style="width:17px" data-feather="eye"></i></a>
                                        <a href="{{ url('dashboard/permintaan/' . $item->id . '/edit') }}"
                                            class="btn btn-warning px-2"><i style="width:17px" data-feather="edit"></i></a>
                                        <form class="d-inline m-0"
                                            action="{{ route('dashboard.permintaan.destroy', $item->id) }}" method="post">
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
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
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
                    targets: 3
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
        });
    </script>
@endsection
