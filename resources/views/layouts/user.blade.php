<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" type="image/png" href="{{ asset('images/stc.png') }}">
    <title>{{ $title }} - STC</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicons -->
    {{-- <link href="{{ asset('assetss/img/favicon.png') }}" rel="icon"> --}}
    {{-- <link href="{{ asset('assetss/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assetss/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assetss/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assetss/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assetss/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assetss/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- Main CSS File -->
    <link href="{{ asset('assetss/css/main.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/css/trix.css">

</head>

<body class="index-page">

    @include('partials.header')


    <main class="main">

        <div class="content-wrapper">
            @yield('content')
        </div>

        @php
            if (!session()->has('url.intended') && !Auth::check()) {
                session(['url.intended' => url()->current()]);
            }
        @endphp

    </main>




    <div class="modal fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ asset('images/stc.png') }}" alt="Hero Image"
                        class="img-fluid mx-auto d-block logo-img mb-4">
                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email </label>
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="email@example.com"
                                    name="email">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="passwordInput"
                                    placeholder="Masukan Password anda" name="password">
                                <span class="input-group-text password-toggle" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </span>

                            </div>
                        </div>

                        <input type="hidden" name="redirect_to" value="{{ url()->full() }}">


                        <div class="form-check">
                            <div>
                                <input type="checkbox" class="form-check-input" id="remember" hidden>
                                <label class="form-check-label" for="remember" hidden>Remember me</label>
                            </div>
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#forgotPasswordModal">Lupa Password?</a>

                        </div>

                        <button type="submit" class="btn btn-login text-white">Masuk</button>

                        <div class="divider">
                            <span>atau gunakan akun</span>
                        </div>

                        <div class="social-login">
                            <a href="{{ route('auth.google') }}" class="btn btn-social"><i
                                    class="fab fa-google"></i>Google</a>
                        </div>

                        <div class="register-link">
                            Belum punya akun? <a href="{{ route('daftar') }}" class="text-decoration-none">Daftar
                                Sekarang</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Lupa Password -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- Gambar diperkecil -->
                    <img src="{{ asset('images/stc.png') }}" alt="Hero Image"
                        class="img-fluid mx-auto d-block logo-img mb-3" style="max-width: 100px;">

                    <h5 class="text-center mb-3">Reset Password</h5>

                    <form action="{{ route('password.whatsapp') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nomor WhatsApp*</label>
                            <div class="input-group">
                                <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx"
                                    required>
                                <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Kirim Link via WhatsApp</button>
                    </form>


                    <div class="text-center mt-3">
                        <button class="btn btn-link text-decoration-none" data-bs-dismiss="modal"
                            data-bs-toggle="modal" data-bs-target="#loginModal">
                            Kembali ke Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <img class="w-25" src="{{ asset('images/stc.png') }}" alt="Logo" />
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Sambisari Jl. Duwet No.99</p>
                        <p>Sleman, Daerah Istimewa Yogyakarta, 55285</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+62 822-2688-7110</span></p>
                        <p><strong>Email:</strong> <span>training@satunama.org</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Link</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('beranda') }}">Beranda</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('pelatihan') }}">Daftar
                                Pelatihan</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('tentang') }}">Tentang Kami</a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('userDiskusi') }}">Ruang
                                Diskusi</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Pelatihan Kami</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('reguler.index') }}">Reguler</a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('pelatihan') }}">Permintaan</a>
                        </li>
                        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('pelatihan') }}">Konsultasi</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Ikuti Sosial Media Kami</p>
                    <div class="social-links d-flex">
                        {{-- <a href=""><i class="bi bi-twitter-x"></i></a> --}}
                        <a href="https://www.facebook.com/SATUNAMATrainingCenter"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/yayasansatunama/?hl=en"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/yayasan-satunama-yogyakarta/posts/?feedView=all"><i
                                class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">SATUNAMA Training Center</strong> <span>All
                    Rights Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    {{-- <div id="preloader"></div> --}}

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <script>
        AOS.init(); // Inisialisasi AOS setelah file JS dimuat
    </script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assetss/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetss/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assetss/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assetss/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assetss/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assetss/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assetss/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assetss/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <!-- Main JS File -->
    <script src="{{ asset('assetss/js/main.js') }}"></script>
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('img.real-img');

            images.forEach(img => {
                // Kalau sudah selesai loading, langsung hilangkan skeleton
                if (img.complete) {
                    removeSkeleton(img);
                } else {
                    img.addEventListener('load', function() {
                        removeSkeleton(img);
                    });
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {

            const togglePassword = document.getElementById("togglePassword");
            const passwordInput = document.getElementById("passwordInput");
            const icon = togglePassword.querySelector("i");

            togglePassword.addEventListener("click", function() {
                const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                passwordInput.setAttribute("type", type);

                // Ganti ikon
                if (type === "text") {
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            });

            const notyf = new Notyf({
                duration: 4000,
                position: {
                    x: 'center',
                    y: 'bottom'
                },
                types: [{
                        type: 'error',
                        background: '#dc3545',
                        icon: false,
                    },
                    {
                        type: 'success',
                        background: '#198754',
                        icon: false,
                    },
                ]
            });

            @if (session('error'))
                notyf.open({
                    type: 'error',
                    message: `
                      <div class="d-flex align-items-center gap-2">
                          <i class="bi bi-x-circle-fill"></i> 
                          <span>{{ session('error') }}</span>
                      </div>`
                });

                const loginModalEl = document.getElementById('loginModal');
                const loginModal = new bootstrap.Modal(loginModalEl);
                loginModal.show();
            @endif

            @if (session('success'))
                notyf.open({
                    type: 'success',
                    message: `
                      <div class="d-flex align-items-center gap-2">
                          <i class="bi bi-check-circle-fill"></i> 
                          <span>{{ session('success') }}</span>
                      </div>`
                });
            @endif

            @if (session('error') && session('from') === 'forgot-password')
                const forgotModalEl = document.getElementById('forgotPasswordModal');
                const forgotModal = new bootstrap.Modal(forgotModalEl);
                forgotModal.show();
            @endif

        });
    </script>
</body>

</html>
