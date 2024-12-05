@extends('layouts.main')

@section('content')
    <div class="bg-light">
        <div class="container bg-light">
            <div class="hero-content d-flex flex-column flex-md-row align-items-center p-5">
                <div class="hero-image px-3 py-3">
                    <img src="{{ asset('images/register.png') }}" alt="Hero Image" class="img-fluid">
                </div>
                <div class="hero-text flex-grow-1">
                    <h1>Daftar Akun Anda</h1>
                    <form action="{{ route('register.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukan nama anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="********" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="********" required>
                        </div>
                        <div class="buttons">
                            <button type="submit" class="btn btn-success">Daftar</button>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('masuk') }}" class="text-success"><span>Sudah Punya Akun?. Ayo
                                    Login!</span></a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
