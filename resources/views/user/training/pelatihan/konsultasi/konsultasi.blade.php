@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Pelatihan Saya</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li class="current">Pelatihan Saya</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container my-3" id="scrollspy-container">

        @include('partials.navbar-pelatihan')

        @if ($konsultasi->isEmpty())
            <div class="text-center">
                <img src="{{ asset('images/nopelatihan.png') }}" alt="Hero Image" class="img-small">
                <h5>Sayangnya, belum ada pelatihan konsultasi yang anda telah daftarkan.</h5>
            </div>
        @else
            @foreach ($konsultasi as $item)
                <div class="card px-3 my-4 py-3">
                    <strong>{{ $item->pelatihan_konsultasi->nama_pelatihan }}</strong>
                    <p>Tanggal Pelatihan:
                        {{ \Carbon\Carbon::parse($item->pelatihan_konsultasi->tanggal_mulai)->locale('id')->isoFormat('D MMMM') }}
                        -
                        {{ \Carbon\Carbon::parse($item->pelatihan_konsultasi->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}
                    </p>
                    <div class="text-start">
                        @if ($item->pelatihan_konsultasi)
                            <a href="{{ route('konsultasi.pelatihan.list', urlencode($item->pelatihan_konsultasi->nama_pelatihan)) }}"
                                class="btn btn-outline-success">Lihat Detail
                            </a>
                        @endif
                    </div>
                    {{-- <a href="{{ route('reguler.pelatihan.show', $item->id_pelatihan) }}" class="btn btn-info">Lihat
            Detail</a> --}}
                </div>
            @endforeach
        @endif

        <div class="pagination">
            {{ $konsultasi->links('pagination::bootstrap-4') }}
        </div>
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
