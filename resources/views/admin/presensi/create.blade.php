@extends('layouts.admin')

@section('content')

<div class="text-center">
    <h2>QR Code Presensi: {{ $reguler->title }}</h2>
    <div class="p-4 border rounded-lg inline-block">
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code">
    </div>
    <div class="p-4 border rounded-lg inline-block">{{ $qrCode }}</div>
    <p class="mt-2">Scan QR Code ini untuk presensi</p>
</div>

@endsection