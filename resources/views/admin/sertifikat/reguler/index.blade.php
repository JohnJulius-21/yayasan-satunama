@extends('layouts.app')
@section('title', 'Admin | Sertifikat Pelatihan Reguler')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Sertifikat Pelatihan Reguler</h6>
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
        title="Data Pelatihan Reguler"
        description="Kelola data pelatihan reguler dengan mudah"
        search-placeholder="Cari pelatihan..."
        :columns="$columns"
        :add-button="false"
        search-route="{{ route('sertiRegulerAdmin') }}"
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
{{--                    <h6 class="m-0 font-weight-bold text-success">Reguler</h6>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <div class="table-responsive-md">--}}
{{--                    <table id="reguler" class="table table-bordered display responsive nowrap" width="100%">--}}
{{--                        <thead>--}}
{{--                            <tr>--}}
{{--                                <th class="col-md-3" scope="col">Nama Pelatihan</th>--}}
{{--                                <th class="col-md-2" scope="col">Tanggal Pelatihan</th>--}}
{{--                                <th class="col-md-1" scope="col">Tindakan</th>--}}
{{--                            </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                            @foreach ($reguler as $item)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $item['nama_pelatihan'] }}</td>--}}
{{--                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pendaftaran)->locale('id')->isoFormat('D MMMM') }}--}}
{{--                                        ---}}
{{--                                        {{ \Carbon\Carbon::parse($item->tanggal_batas_pendaftaran)->locale('id')->isoFormat('D MMMM Y') }}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <a href="{{ route('sertiRegulerShowAdmin', $item->id_reguler) }}"--}}
{{--                                            class="btn btn-primary px-2">Lihat Daftar Peserta</a>--}}


{{--                                        --}}{{-- </form> --}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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

            const modal = $('#confirmDeleteModal');
            const deleteForm = $('#deleteForm');

            // Event click untuk tombol delete
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const actionUrl = $(this).data('action');
                deleteForm.attr('action', actionUrl);
                modal.show();
            });

            // Event untuk menutup modal
            $('.close-modal, .btn-cancel').click(function() {
                modal.hide();
                deleteForm.attr('action', '');
            });

            // Klik di luar modal untuk menutup
            $(window).click(function(event) {
                if ($(event.target).is(modal)) {
                    modal.hide();
                    deleteForm.attr('action', '');
                }
            });
        });
    </script>
@endsection
