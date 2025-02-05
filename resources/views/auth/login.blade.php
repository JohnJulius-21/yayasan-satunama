@extends('layouts.user')

@section('content')
    <div class="bg-light">
        <div class="container bg-light">
            <div class="hero-content d-flex flex-column flex-md-row align-items-center p-5">
                {{-- <div class="hero-image px-3 py-3">
                    <img src="{{ asset('images/login.png') }}" alt="Hero Image" class="img-fluid">
                </div> --}}
                <div class="container card flex-grow-1">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <h1>Login</h1>
                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf
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
                        <div class="buttons">
                            <button type="submit" class="btn btn-success">Masuk</button>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('daftar') }}" class="text-success"><span>Belum
                                    Punya Akun?. Ayo
                                    Daftar Akun Anda.</span></a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
