@extends('layouts.user')

@section('content')
    <div class="section py-5"
        style="position: relative; background-image: url('../images/pelatihan2.jpg'); background-size: cover; background-position: center; color: #ffffff;">
        <div
            style="content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(40, 66, 41, 0.6); z-index: 1;">
        </div>
        <div class="container text-left" style="position: relative; z-index: 2;">
            <h5>Pelatihan Reguler</h5>
            <h2>SATUNAMA <span>Training Center </span></h2>
        </div>
    </div>
    <div class="container my-3">
        {{-- <div class="card px-3 mb-4">
            <h5 class="card-header">Pelatihan Saya</h5>
            <div class="card-body">
                <div class="row align-items-end">
                    <div class="col">
                        <h5 class="card-title">{{ Auth::user()->name }}</h5>
                        <p class="card-text"><i class="fas fa-envelope"></i> Email : {{ Auth::user()->email }}</p>
                    </div>
                    <div class="col align-self-end">
                        <a href="" class="btn btn-primary">Pengaturan Akun</a>
                    </div>
                </div>
            </div>
        </div> --}}

        @include('partials.navbar-pelatihan')

        <!-- Konten Dinamis -->
        <div class="mt-3">
            @yield('dynamic-content')
        </div>
    </div>
@endsection
