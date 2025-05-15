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
                        {{-- <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="{{ route('ctga') }}">CTGA</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="#">Konsultasi</a></li> --}}
                        {{-- <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Innovation</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}"
                        href="{{ route('tentang') }}">Tentang Kami</a>
                </li>

                <li><a class="nav-link {{ request()->routeIs('userDiskusi') ? 'active' : '' }}"
                        href="{{ route('userDiskusi') }}">Ruang Diskusi</a></li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" role="button"
                            aria-expanded="false">{{ Auth::user()->name }}<i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('reguler.pelatihan') }}">Pelatihan Saya</a></li>
                            <hr class="dropdown-divider">
                            <li class="nav-item">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
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
            <button class="btn-getstarted text-only" data-bs-toggle="modal" data-bs-target="#loginModal">
                Masuk
            </button>

            <a class="btn-getstarted" href="{{ route('daftar') }}">Daftar</a>
        @endguest
    </div>
</header>
