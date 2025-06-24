@extends('layouts.admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: rgb(2, 160, 2) !important;">
                <a href="{{ route('adminPresensiPermintaan') }}" style="color: green !important;">Presensi Permintaan</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Buat Presensi Pelatihan</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h6 class="h4">Buat Presensi Pelatihan Permintaan</h6>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Form Presensi</h6>
        </div>


        <div class="card-body">

            {{-- Hidden form for storing form data --}}
            <form id="hidden-form" action="{{ route('savePresensiPermintaan', $permintaan->id_pelatihan_permintaan) }}" method="post">
                @csrf
                <label for="judul_presensi" class="form-label">Judul Presensi</label>
                {{-- <input type="hidden" id="form" name="form">
                <input type="hidden" id="id_Permintaan" name="id_Permintaan" value="{{ $Permintaan->id_Permintaan }}"> --}}
                <input type="text" class="form-control mb-3" id="judul_presensi" name="judul_presensi"
                    placeholder="Judul Presensi" value="{{ $permintaan->judul_presensi }}">
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
    {{-- <div class="text-center">
    <h2>QR Code Presensi: {{ $Permintaan->title }}</h2>
    <div class="p-4 border rounded-lg inline-block">
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
    </div>
    <div class="p-4 border rounded-lg inline-block">{{ $qrCode }}</div>
    <p class="mt-2">Scan QR Code ini untuk presensi</p>
</div> --}}
@endsection
