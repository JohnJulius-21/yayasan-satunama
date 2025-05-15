@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('permintaanAdmin') }}" style="color: green !important;">Permintaan</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail Permintaan</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h6 class="h4">Detail Permintaan</h6>
        <div class="d-flex justify-content-end">
            @if ($showButtons)
                @foreach ($permintaan as $item)
                    <a href="{{ route('permintaanCreateAdmin', $item->id_permintaan) }}" class="btn btn-success mx-1"><i
                            style="width:17px" data-feather="plus"></i> Buatkan Pelatihan
                    </a>
                @endforeach
            @endif
            {{-- @foreach ($permintaan_pelatihan as $item)
                <a href="{{ route('permintaanCreatePeserta', $item->id_pelatihan_permintaan) }}" class="btn btn-success mx-1"><i
                        style="width:17px" data-feather="plus"></i> Buatkan Akun Peserta</a>
            @endforeach --}}
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-start">
                <p class="m-0 font-weight-bold text-success">Detail Permintaan</p>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    @foreach ($permintaan as $item)
                        <tr>
                            <th>Nama Mitra : </th>
                            <td>{{ $item->mitra->nama_mitra }}</td>
                        </tr>
                        <tr>
                            <th>Judul Pelatihan : </th>
                            <td>{{ $item->judul_pelatihan }}</td>
                        </tr>
                        <tr>
                            <th>Tema Pelatihan: </th>
                            <td>{{ $item->tema->judul_tema }}</td>
                        </tr>
                        <tr>
                            <th>Nomor PIC Mitra : </th>
                            <td>{{ $item->no_pic }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Mulai Pelatihan :</th>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->locale('id')->isoFormat('D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Selesai Pelatihan :</th>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Masalah yang sedang dihadapi oleh lembaga : </th>
                            <td>{!! $item['masalah'] !!}</td>
                        </tr>
                        <tr>
                            <th>Kebutuhan Lembaga : </th>
                            <td>{!! $item['kebutuhan'] !!}</td>
                        </tr>
                        <tr>
                            <th>Materi & topik yang diharapkan dari pelatihan : </th>
                            <td>{!! $item['materi'] !!}</td>
                        </tr>
                        <tr>
                            <th>Request Khusus : </th>
                            <td>{!! $item['request_khusus'] !!}</td>
                        </tr>
                    @endforeach
                </table>
                {{-- <a class="btn btn-secondary mt-4" href="{{ route('konsultasiAdmin') }}">Kembali</a> --}}
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-start">
                <p class="m-0 font-weight-bold text-success">Assesment Peserta</p>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="peserta" class="table table-bordered display responsive nowrap" width="100%"">
                    <thead>
                        <tr>
                            <th class="col-md-3" scope="col">Nama Peserta</th>
                            <th class="col-md-3" scope="col">Email</th>
                            <th class="col-md-3" scope="col">Jenis Kelamin</th>
                            <th class="col-md-3" scope="col">Jabatan</th>
                            <th class="col-md-3" scope="col">Tanggung Jawab</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peserta as $item)
                            <tr>
                                <td>{{ $item['nama_peserta'] }}</td>
                                <td>{{ $item['email_peserta'] }}</td>
                                <td>{{ $item['jenis_kelamin'] }}</td>
                                <td>{{ $item['jabatan'] }}</td>
                                <td>{{ $item['tanggung_jawab'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <a class="btn btn-secondary mt-4" href="{{ route('konsultasiAdmin') }}">Kembali</a> --}}
            </div>
        </div>
    </div>

    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.1/b-3.0.0/sl-2.0.0/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#peserta').DataTable({
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
        });
    </script>
@endsection
