<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('adminAsal') ? 'active' : '' }}" href="{{ route('adminAsal') }}">Asal Peserta</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('adminUsia') ? 'active' : '' }}" href="{{ route('adminUsia') }}">Rentang Usia Peserta</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('adminInformasi') ? 'active' : '' }}" href="{{ route('adminInformasi') }}">Informasi</a>
    </li>
</ul>
