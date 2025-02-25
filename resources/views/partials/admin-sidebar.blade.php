<nav class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="index.html">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            
            <li class="nav-item dropdown {{ Request::is('admin/pelatihan/*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="pelatihanDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="la la-book"></i>
                    <p>Pelatihan</p>
                </a>
                <div class="dropdown-menu" aria-labelledby="pelatihanDropdown">
                    <a class="dropdown-item" href="{{ route('regulerAdmin') }}">Reguler</a>
                    <a class="dropdown-item" href="{{ route('permintaanAdmin') }}">Permintaan</a>
                    <a class="dropdown-item" href="{{ route('konsultasiAdmin') }}">Konsultasi</a>
                    <a class="dropdown-item" href="../../pages/ui-features/typography.html">CTGA</a>
                </div>
            </li>
            
            <li class="nav-item dropdown {{ Request::is('admin/evaluasi/*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="evaluasiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="la la-book"></i>
                    <p>Evaluasi Pelatihan</p>
                </a>
                <div class="dropdown-menu" aria-labelledby="evaluasiDropdown">
                    <a class="dropdown-item" href="{{ route('evaluasiRegulerAdmin') }}">Reguler</a>
                    <a class="dropdown-item" href="{{ route('evaluasiPermintaanAdmin') }}">Permintaan</a>
                    <a class="dropdown-item" href="">Konsultasi</a>
                    <a class="dropdown-item" href="../../pages/ui-features/typography.html">CTGA</a>
                </div>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/survey/*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="surveyDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="la la-book"></i>
                    <p>Survey Kepuasan</p>
                </a>
                <div class="dropdown-menu" aria-labelledby="surveyDropdown">
                    <a class="dropdown-item" href="{{ route('surveyRegulerAdmin') }}">Reguler</a>
                    <a class="dropdown-item" href="">Permintaan</a>
                    <a class="dropdown-item" href="">Konsultasi</a>
                    <a class="dropdown-item" href="../../pages/ui-features/typography.html">CTGA</a>
                </div>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/studidampak/*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="studiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="la la-book"></i>
                    <p>Studi Dampak</p>
                </a>
                <div class="dropdown-menu" aria-labelledby="studiDropdown">
                    <a class="dropdown-item" href="{{ route('studiRegulerAdmin') }}">Reguler</a>
                    <a class="dropdown-item" href="">Permintaan</a>
                    <a class="dropdown-item" href="">Konsultasi</a>
                    <a class="dropdown-item" href="../../pages/ui-features/typography.html">CTGA</a>
                </div>
            </li>
            
            <li class="nav-item {{ Request::is('admin/fasilitator/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('fasilitatorAdmin') }}">
                    <i class="la la-users"></i>
                    <p>Fasilitator</p>
                </a>
            </li>
            <li class="nav-item {{ Request::is('admin/ruang-diskusi/*') ? 'active' : '' }}">
                <a href="{{ route('adminDiskusi') }}">
                    <i class="la la-comments"></i>
                    <p>Ruang Diskusi</p>
                </a>
            </li>
        </ul>
    </div>
</nav>
