@extends('layouts.user')

@section('content')
    @if (session('show_login_modal'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            });
        </script>
    @endif

    <div class="bg-light py-5">
        <div class="container d-flex justify-content-center align-items-center">
            <!-- Card untuk Form Registrasi -->
            <div class="card shadow-lg rounded p-4"
                style="max-width: 700px; width: 100%; margin-top: 50px; margin-bottom: 50px;">
                <!-- Gambar di dalam card, di atas form -->
                <div class="text-center mb-4">
                    <img src="{{ asset('images/stc.png') }}" alt="Gambar Registrasi" class="img-fluid"
                        style="max-width: 100px; height: auto;">
                </div>

                <div class="hero-content w-100">
                    <h3 class="mb-3 text-center">Daftar Akun Anda</h4>
                        <form action="{{ route('register.process') }}" method="POST" style="width: 100%;">
                            @csrf


                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text"
                                    class="form-control form-control-lg shadow-sm border-0 border-success @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Masukan nama anda"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email"
                                    class="form-control form-control-lg shadow-sm border-0 border-success @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password"
                                    class="form-control form-control-lg shadow-sm border-0 border-success @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="********" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password"
                                    class="form-control form-control-lg shadow-sm border-0 border-success @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation" placeholder="********" required>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" name="redirect_to" id="redirect_to_register"
                                value="{{ url()->current() }}">


                            <div class="buttons d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-success btn-lg px-5 py-2">Daftar</button>
                            </div>

                            <div class="mt-3 text-center">
                                <button class="btn btn-link text-success p-0" data-bs-toggle="modal"
                                    data-bs-target="#loginModal">
                                    Sudah Punya Akun? Ayo Login!
                                </button>

                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Mengubah border input menjadi hijau ketika diisi */
        .form-control:focus {
            border-color: #28a745 !important;
            /* Warna hijau */
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
        }

        /* Pastikan background dan border input lainnya tidak mengganggu */
        .form-control {
            border-color: #ced4da;
            /* Warna border standar */
        }

        /* Mobile Responsiveness */
        @media (max-width: 767px) {
            .container {
                flex-direction: column;
                /* Mengubah urutan gambar dan form di mobile */
            }
        }
    </style>
@endpush
