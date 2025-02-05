<nav class="nav nav-pills nav-fill mb-3 custom-nav" >
    <a class="nav-link {{ request()->routeIs('reguler.pelatihan') ? 'active' : '' }}" href="{{ route('reguler.pelatihan') }}">
        Reguler
    </a>
    <a class="nav-link {{ request()->routeIs('permintaan.pelatihan.show') ? 'active' : '' }}" href="{{ route('permintaan.pelatihan.show') }}">
        Permintaan
    </a>
    <a class="nav-link {{ request()->routeIs('konsultasi.pelatihan.show') ? 'active' : '' }}" href="{{ route('konsultasi.pelatihan.show') }}">
        Konsultasi
    </a>
    <a class="nav-link {{ request()->routeIs('konsultasi.pelatihan.show') ? 'active' : '' }}" href="{{ route('konsultasi.pelatihan.show') }}">CTGA</a>
</nav>

<style>
    .custom-nav {
        background-color: #f8f9fa; /* Warna hijau */
        border-radius: 3px; /* Radius sudut */
        padding: 5px;
    }

    .custom-nav .nav-link {
        color: #6c757d; /* Warna teks putih */
    }

    .custom-nav .nav-link.active {
        background-color: #ffffff; /* Warna hijau lebih gelap untuk tautan aktif */
        color: rgb(3, 83, 0); 
    }
</style>