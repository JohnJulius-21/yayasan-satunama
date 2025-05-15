@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('sertiKonsultasiAdmin') }}" style="color: green !important;">Konsultasi</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Upload Sertifikat Pelatihan</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Daftar Peserta Pelatihan {{ $konsultasi->nama_pelatihan }}</h6>
        {{-- <div class="d-flex justify-content-end">
            <a href="{{ route('regulerCreateAdmin') }}" class="btn btn-success "><i style="width:17px" data-feather="plus"></i>
                Tambah Pelatihan</a>
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

    <div class="col-lg-18 mb-4 ">
        {{-- <div class="container"> --}}

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <div class="d-flex justify-content-start">
                    <h6 class="m-0 font-weight-bold text-success">Daftar Peserta</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-md">
                    <table id="reguler" class="table table-bordered display responsive nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="col-md-3" scope="col">Nama Peserta</th>
                                <th class="col-md-2" scope="col">File</th>
                                <th class="col-md-1" scope="col">Tindakan</th>
                                <th class="col-md-1" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($konsultasi->peserta_konsultasi as $p)
                                <tr>
                                    <td>{{ $p->nama_peserta }}</td>
                                    <td>
                                        <form class="upload-form" method="POST"
                                            action="{{ route('sertiKonsultasiUploadAdmin', $p->id_peserta) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file_sertifikat" class="form-control-file">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success btn-sm">Tambah Sertifikat</button>
                                        </form>
                                    </td>
                                    <td>
                                        @php
                                            $sertifikat = DB::table('konsultasi_sertifikat')
                                                ->where('id_pelatihan_konsultasi', $konsultasi->id_pelatihan_konsultasi)
                                                ->where('id_peserta', $p->id_peserta)
                                                ->first();
                                        @endphp
                                        @if ($sertifikat)
                                            <span class="badge bg-success" style="color: white">Sudah Upload</span>
                                        @else
                                            <span class="badge bg-secondary" style="color: white">Belum Upload</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
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

            $('.upload-form').on('submit', function(e) {
                var fileInput = $(this).find('input[name="file_sertifikat"]');
                if (!fileInput.val()) {
                    e.preventDefault(); // cegah submit
                    $.notify({
                        icon: 'la la-exclamation-triangle',
                        message: 'Silakan pilih file sertifikat terlebih dahulu.'
                    }, {
                        type: 'danger',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        delay: 3000
                    });
                }
            });
        });
    </script>
@endsection
