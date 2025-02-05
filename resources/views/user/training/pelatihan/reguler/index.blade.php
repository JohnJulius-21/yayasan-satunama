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

        @if (Session::has('success'))
            <div class="pt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        @include('partials.navbar-pelatihan')

        @if (isset($reguler) && $reguler->isEmpty())
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('images/nopelatihan.png') }}" alt="Hero Image" class="img-small">
                <h5>Sayangnya, belum ada pelatihan yang anda telah daftarkan.</h5>
            </div>
        @else
            @foreach ($reguler as $item)
                <div class="card px-3 my-4 py-3" data-aos="fade-up" data-aos-delay="100">
                    <strong>{{ $item->reguler->nama_pelatihan }}</strong>
                    <p>Tanggal Pelatihan:
                        {{ \Carbon\Carbon::parse($item->reguler->tanggal_mulai)->locale('id')->isoFormat('D MMMM') }}
                        -
                        {{ \Carbon\Carbon::parse($item->reguler->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}
                    </p>
                    <div class="text-start">
                        @if ($item->reguler)
                            <a href="{{ route('reguler.pelatihan.list', urlencode($item->reguler->nama_pelatihan)) }}"
                                class="btn btn-outline-success">Lihat Detail
                            </a>
                        @endif
                    </div>
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
