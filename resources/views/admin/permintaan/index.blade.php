@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h6 class="h4">Daftar Permintaan</h6>
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
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-start">
                    <p class="m-0 font-weight-bold text-success">Tabel Daftar Permintaan</p>
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
                                <th class="col-md-1 text-center" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permintaan as $item)
                                <tr>
                                    <td>{{ $item->mitra->nama_mitra }}</td>
                                    <td>{{ $item['judul_pelatihan'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <div class="p-1">
                                            <a href="{{ route('permintaanShowAdmin', $item->id_permintaan) }}"
                                                class="btn btn-primary px-2"><i style="width:17px" data-feather="eye"></i>
                                                Lihat
                                                Detail</a>
                                        </div>
                                        <div class="p-1">
                                            <!-- Tombol Hapus Permintaan -->
                                            <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
                                                data-target="#deletePermintaanModal"
                                                data-action="{{ route('permintaanDestroyMitraAdmin', $item->id_permintaan) }}">
                                                Hapus
                                            </button>
                                        </div>

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

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="d-flex justify-content-start">
                    <p class="m-0 font-weight-bold text-success">Tabel Pelatihan</p>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-md">
                    <table id="daftar" class="table table-bordered display responsive nowrap" width="100%"">
                        <thead>
                            <tr>
                                <th class="col-md-3" scope="col">Nama Pelatihan</th>
                                <th class="col-md-2" scope="col">Tanggal Pelatihan</th>
                                <th class="col-md-2" scope="col">Mitra</th>
                                <th class="col-md-1" scope="col">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permintaan_pelatihan as $item)
                                <tr>
                                    <td>{{ $item['nama_pelatihan'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('D MMMM') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td>{{ $item->permintaan->mitra->nama_mitra }}</td>
                                    <td>
                                        <a href="{{ route('permintaanInfoAdmin', $item->id_pelatihan_permintaan) }}"
                                            class="btn btn-primary px-2"><i style="width:17px" class="la la-eye"></i></a>
                                        <a href="{{ url('/admin/pelatihan/permintaan/edit-pelatihan-permintaan/' . $item->id_pelatihan_permintaan) }}"
                                            class="btn btn-warning px-2"><i style="width:17px" class="la la-edit"></i></a>
                                        <!-- Tombol Hapus Pelatihan Permintaan -->
                                        <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
                                            data-target="#deletePelatihanModal"
                                            data-action="{{ route('permintaanDestroyAdmin', $item->id_pelatihan_permintaan) }}">
                                            <i style="width:17px" class="la la-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Pelatihan -->
    <div class="modal fade" id="deletePelatihanModal" tabindex="-1" role="dialog"
        aria-labelledby="deletePelatihanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Pelatihan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus pelatihan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="deleteFormPelatihan" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Konfirmasi Hapus Permintaan -->
    <div class="modal fade" id="deletePermintaanModal" tabindex="-1" role="dialog"
        aria-labelledby="deletePermintaanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Permintaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus permintaan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="deleteFormPermintaan" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
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
                scrollX: true,
                scrollY: 300,
                paging: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                columnDefs: [{
                    targets: 3
                }]
            });

            $('#daftar').DataTable({
                lengthChange: true,
                responsive: true,
                paging: true,
                scrollX: true,
                scrollY: 300,
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

        // Untuk Pelatihan Permintaan
        $('#deletePelatihanModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var action = button.data('action')
            $('#deleteFormPelatihan').attr('action', action)
        })

        // Untuk Permintaan
        $('#deletePermintaanModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var action = button.data('action')
            $('#deleteFormPermintaan').attr('action', action)
        })
    </script>
@endsection
