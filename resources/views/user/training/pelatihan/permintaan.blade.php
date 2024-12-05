@extends('layouts.main')

@section('content')
    <div class="section py-5"
        style="position: relative; background-image: url('../images/pelatihan2.jpg'); background-size: cover; background-position: center; color: #ffffff;">
        <div
            style="content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(40, 66, 41, 0.6); z-index: 1;">
        </div>
        <div class="container text-left" style="position: relative; z-index: 2;">
            <h5>Pelatihan Saya</h5>
            <h2>SATUNAMA <span>Training Center </span></h2>
        </div>
    </div>
    <div class="container my-3" id="scrollspy-container">

        @include('partials.navbar-pelatihan')

        @if (isset($permintaans) && $permintaans->isEmpty())
            <div class="text-center">
                <img src="{{ asset('images/nopelatihan.png') }}" alt="Hero Image" class="img-small">
                <h5>Sayangnya, belum ada pelatihan yang anda telah daftarkan.</h5>
            </div>
        @else
            @foreach ($permintaans as $item)
                <div class="card px-3 my-4 py-3">
                    <strong>{{ $item['id_pelatihan'] }}</strong> -
                    {{-- Tanggal Mulai: {{ $item->tanggal_mulai }} |
                    Tanggal Selesai: {{ $item->tanggal_selesai }} |
                    <a href="{{ route('reguler.pelatihan.show', $item->id_pelatihan) }}" class="btn btn-info">Lihat --}}
                    {{-- Detail</a> --}}
                </div>
            @endforeach
        @endif
    </div>
    <style>
        .img-small {
            max-width: 400px;
            /* Atur lebar maksimum gambar */
            height: auto;
            /* Menjaga rasio aspek */
        }

        .text-center {
            text-align: center;
            /* Memusatkan teks */
            margin-top: 20px;
            /* Tambahkan margin atas jika diperlukan */
        }
    </style>
@endsection
