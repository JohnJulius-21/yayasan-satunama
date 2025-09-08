@extends('layouts.app')
@section('title', 'Admin | Evaluasi Pelatihan Permintaan')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h6 class="h4">Evaluasi Pelatihan Permintaan</h6>
    </div>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 4000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'bottom-end'
                });
            });
        </script>
    @endif

    <x-data-table
        title="Data Pelatihan Permintaan"
        description="Kelola data pelatihan reguler dengan mudah"
        search-placeholder="Cari pelatihan..."
        :columns="$columns"
        :add-button="false"
        search-route="{{ route('evaluasiPermintaanAdmin') }}"
        table-id="pelatihanTable"
        :show-back-button="false"
        :show-pagination="true"
    >
        @include('partials.table_rows', [
            'rows' => $data,
            'columns' => $columns,
            'actions' => $actions
        ])
    </x-data-table>
{{--    <div class="col-lg-18 mb-4 ">--}}
{{--        --}}{{-- <div class="container"> --}}

{{--        <!-- Project Card Example -->--}}

{{--        <div class="card shadow mb-4">--}}
{{--            <div class="card-header py-3">--}}
{{--                <div class="d-flex justify-content-start">--}}
{{--                    <h6 class="m-0 font-weight-bold text-success">Permintaan</h6>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="table-responsive">--}}
{{--                    <table id="permintaan" class="table table-bordered display responsive nowrap" width="100%">--}}
{{--                        <thead>--}}
{{--                            <tr>--}}
{{--                                <th class="col-md-3" scope="col">Judul Pelatihan</th>--}}
{{--                                <th class="col-md-2" scope="col">Tanggal Pelatihan</th>--}}
{{--                                <th class="col-md-1" scope="col">Tindakan</th>--}}
{{--                            </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                            @foreach ($permintaan as $item)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $item->nama_pelatihan }}</td>--}}
{{--                                    <td>{{ \Carbon\Carbon::parse($item->waktu_pelaksanaan)->format('D MMMM Y') }} ---}}
{{--                                        {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('D MMMM Y') }}</td>--}}
{{--                                    <td>--}}
{{--                                        <a href="{{ route('evaluasiShowPermintaanAdmin', $item->id_pelatihan_permintaan) }}"--}}
{{--                                            class="btn btn-primary px-2">Lihat Detail</a>--}}

{{--                                        --}}{{-- <button class="btn btn-danger btn-delete" data-action="">--}}
{{--                                            <i style="width:17px" class="la la-trash"></i>--}}
{{--                                        </button> --}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            --}}{{-- <tr>--}}
{{--                                <td>test</td>--}}
{{--                                <td>test--}}
{{--                                </td>--}}
{{--                                <td>--}}

{{--                                    <a href="{{ route('evaluasiShowPermintaanAdmin') }}" class="btn btn-primary px-2"><i--}}
{{--                                            class="mdi mdi-eye-circle-outline" style="width:117px"></i></a>--}}
{{--                                    <a href="" class="btn btn-warning px-2"><span--}}
{{--                                            class="mdi mdi-pencil-outline"></span></i></a>--}}
{{--                                </td>--}}
{{--                            </tr> --}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Sertakan jQuery dan DataTables JS -->
    {{-- <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.css"
        rel="stylesheet"> --}}

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
                    targets: 2
                }]
            });
        });
    </script>
@endsection
