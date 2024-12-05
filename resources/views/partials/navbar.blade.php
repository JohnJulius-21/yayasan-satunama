<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img loading="lazy" src="{{ asset('images/stc.png') }}" class="img" alt="Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" aria-expanded="false">Daftar
                        Pelatihan</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('pelatihan') }}">Pelatihan</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="#">Innovation Lab</a></li>
                        {{-- <li><a class="dropdown-item" href="#">Konsultasi</a></li> --}}
                        {{-- <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Innovation</a></li> --}}
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('tentang') ? 'active' : '' }}"
                        href="{{ route('tentang') }}">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
            </ul>

            <!-- Separator with | -->
            <span class="nav-separator mx-3">|</span>

            <!-- Second group for Login and Sign Up -->
            <ul class="navbar-nav">
                @guest
                    <!-- Show this section if the user is NOT logged in -->
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('masuk') ? 'active' : '' }}" href="{{ route('masuk') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-success py-2 px-3" href="{{ route('daftar') }}">Daftar</a>
                    </li>
                @else
                    <!-- Show this section if the user is logged in -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" aria-expanded="false">Selamat
                            Datang, {{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('reguler.pelatihan') }}">Pelatihan Saya</a></li>
                            <hr class="dropdown-divider">
                            <li class="nav-item">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a href="#" class="dropdown-item text-danger"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
