<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('beranda') }}" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assetss/img/logo.png" alt=""> -->
            {{-- <h1 class="sitename">SATUNAMA</h1> --}}
            <img class="sitename img" loading="lazy" src="{{ asset('images/stc.png') }}" alt="Logo" />
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a></li>
                <li class="nav-item dropdown">
                    <a class="dropdown" href="#" role="button" aria-expanded="false">Daftar
                        Pelatihan<i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('pelatihan') }}">Pelatihan</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="{{ route('ctga') }}">CTGA</a></li>
                        {{-- <li><a class="dropdown-item" href="#">Konsultasi</a></li> --}}
                        {{-- <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Innovation</a></li> --}}
                    </ul>
                </li>
                <li><a href="#about">Tentang Kami</a></li>
                {{-- <li><a href="#services">Pelatihan</a></li> --}}
                {{-- <li><a href="#portfolio">Portfolio</a></li> --}}
                {{-- <li><a href="#team">Team</a></li> --}}
                {{-- <li><a href="#contact">Contact</a></li> --}}
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" role="button"
                            aria-expanded="false">{{ Auth::user()->name }}<i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
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
                @endauth
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

        </nav>

        @guest
            <a class="btn-getstarted btn-outline-success" style="text-decoration: none" href="{{ route('masuk') }}">Masuk</a>
            <a class="btn-getstarted" href="{{ route('daftar') }}">Daftar</a>
        @endguest

        {{-- @guest
            <ul class="navbar-nav">
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
            </ul>
        @endguest --}}

    </div>
</header>
