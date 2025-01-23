@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: green"><a href="{{ route('fasilitatorAdmin') }}">Fasilitator</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Fasilitator</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
        <h1 class="h2">Detail Fasilitator</h1>
    </div>

    <div class="card shadow ">
        <div class="card-header py-3">
            <div class="d-flex justify-content-start">
                <h6 class="m-0 font-weight-bold text-success">Informasi Fasilitator</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    @if ($fasilitator)
                        @foreach ($fasilitator as $item)
                            <tr>
                                <th>Nama : </th>
                                <td>{{ $item->nama_fasilitator }}</td>
                            </tr>
                            <tr>
                                <th>NIK : </th>
                                <td>{{ $item['nik'] }}</td>
                            </tr>
                            <tr>
                                <th>Email : </th>
                                <td>{{ $item['email_fasilitator'] }}</td>
                            </tr>
                            <tr>
                                <th>Alamat : </th>
                                <td>{{ $item['alamat'] }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin : </th>
                                <td>{{ $item['jenis_kelamin'] }}</td>
                            </tr>
                            <tr>
                                <th>Asal Lembaga : </th>
                                <td>{{ $item['asal_lembaga'] }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi Fasilitator : </th>
                                <td>{!! $item['body'] !!}</td>
                            </tr>
                        @endforeach
                    @else
                        <p>Tidak ada data fasilitator yang ditemukan.</p>
                    @endif
                </table>
                <a class="btn btn-secondary mt-4" href="{{ route('fasilitatorAdmin') }}">Kembali</a>
            </div>
        </div>
    </div>
@endsection
