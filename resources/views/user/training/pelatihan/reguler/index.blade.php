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

        {{-- @if (Session::has('success'))
            <div class="pt-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif --}}

        @include('partials.navbar-pelatihan')

        @if (isset($reguler) && $reguler->isEmpty())
            <div class="text-center">
                <img src="{{ asset('images/nopelatihan.png') }}" alt="Hero Image" class="img-small">
                <h5>Sayangnya, belum ada pelatihan Reguler yang anda telah daftarkan.</h5>
            </div>
        @else
            @foreach ($reguler as $item)
                @if ($item->status && $item->status->status === 'belum_bayar')
                    <div class="card px-3 my-4 py-3 bg-warning-subtle" data-aos="fade-up" data-aos-delay="100">
                        <strong>{{ $item->reguler->nama_pelatihan }}</strong>
                        <p class="mt-2">Mohon melakukan pembayaran ke:</p>
                        <ul>
                            <li><strong>Bank Account</strong> : YAYASAN SATUNAMA YOGYAKARTA</li>
                            <li><strong>Account Number</strong> : 5557778967</li>
                            <li><strong>Address</strong> : BNI KCP UGM Yogyakarta JL. Kaliurang KM 4.5, Sleman, DI
                                Yogyakarta</li>
                            <li><strong>Currency</strong> : IDR</li>
                            <li><strong>Swift Code</strong> : BNINIDJA</li>
                        </ul>
                        <div class="text-start mt-3">
                            <p>Mohon untuk mengirim bukti pembayaran dinomor ini <a
                                    href="https://api.whatsapp.com/send?phone=6282226887110&text=Halo,%20saya%20ingin%20mengirim%20bukti%20pembayaran%20pelatihan."
                                    target="_blank"><i class="bi bi-whatsapp"></i> +62 822-2688-7110</a></p>
                        </div>
                    </div>
                @elseif ($item->status && $item->status->status === 'sudah_bayar')
                    <div class="card px-3 my-4 py-3" data-aos="fade-up" data-aos-delay="100">
                        <strong>{{ $item->reguler->nama_pelatihan }}</strong>
                        <p>Tanggal Pelatihan:
                            {{ \Carbon\Carbon::parse($item->reguler->tanggal_mulai)->locale('id')->isoFormat('D MMMM') }}
                            -
                            {{ \Carbon\Carbon::parse($item->reguler->tanggal_selesai)->locale('id')->isoFormat('D MMMM Y') }}
                        </p>
                        <div class="text-start">
                            <a href="{{ route('reguler.pelatihan.list', urlencode($item->reguler->nama_pelatihan)) }}"
                                class="btn btn-outline-success">Lihat Detail</a>
                        </div>
                    </div>
                @endif
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
