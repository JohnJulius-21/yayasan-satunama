@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h5">Daftar Pelatihan Reguler</h1>
        <div class="d-flex justify-content-end">
            <a href="{{ route('regulerCreateAdmin') }}" class="btn btn-success "><i style="width:17px" data-feather="plus"></i>
                Tambah Pelatihan</a>
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

    {{-- @if (Session::has('success'))
        <div class="pt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif --}}
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
                                <th class="col-md-3" scope="col">Nama Pelatihan</th>
                                <th class="col-md-2" scope="col">Tanggal Pelatihan</th>
                                <th class="col-md-1" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reguler as $item)
                                <tr>
                                    <td>{{ $item['nama_pelatihan'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->locale('id')->isoFormat('D MMMM') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->tanggal_batas_pendaftaran)->locale('id')->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('regulerShowAdmin', $item->id_reguler) }}"
                                            class="btn btn-primary px-2"><i style="width:17px" data-feather="eye"></i></a>
                                        <a href="{{ route('regulerEditAdmin', $item->id_reguler) }}"
                                            class="btn btn-warning px-2"><i style="width:17px" data-feather="edit"></i></a>
                                        <form class="d-inline m-0"
                                            action="{{ route('regulerDestroyAdmin', $item->id_reguler) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger px-2" type="submit"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                    style="width:17px" data-feather="trash"></i></button>

                                        </form>
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
