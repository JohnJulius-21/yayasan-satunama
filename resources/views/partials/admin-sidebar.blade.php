<nav class="sidebar card py-2 mb-4">
    <div class="scrollbar-inner sidebar-wrapper">
        <ul class="nav flex-column" id="nav_accordion">
            <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('indexAdmin') }}">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item has-submenu {{ Request::is('admin/pelatihan/*') ? 'active' : '' }}">
                <a class="nav-link" href="#"> <i class="la la-book"></i> Pelatihan </a>
                <ul class="submenu collapse">
                    <li><a class="nav-link" href="{{ route('regulerAdmin') }}">Reguler</a></li>
                    <li><a class="nav-link" href="{{ route('permintaanAdmin') }}">Permintaan</a></li>
                    <li><a class="nav-link" href="{{ route('konsultasiAdmin') }}">Konsultasi</a> </li>
                </ul>
            </li>
            <li class="nav-item has-submenu {{ Request::is('admin/evaluasi/*') ? 'active' : '' }}">
                <a class="nav-link" href="#"> <i class="la la-file"></i> Evaluasi Pelatihan </a>
                <ul class="submenu collapse">
                    <li><a class="nav-link" href="{{ route('evaluasiRegulerAdmin') }}">Reguler</a></li>
                    <li><a class="nav-link" href="{{ route('evaluasiPermintaanAdmin') }}">Permintaan</a></li>
                    <li><a class="nav-link" href="{{ route('evaluasiKonsultasiAdmin') }}">Konsultasi</a></li>
                </ul>
            </li>
            <li class="nav-item has-submenu {{ Request::is('admin/survey/*') ? 'active' : '' }}">
                <a class="nav-link" href="#"> <i class="la la-list"></i> Survey Kepuasan Pelatihan </a>
                <ul class="submenu collapse">
                    <li><a class="nav-link" href="{{ route('surveyRegulerAdmin') }}">Reguler</a></li>
                    <li><a class="nav-link" href="{{ route('surveyPermintaanAdmin') }}">Permintaan</a></li>
                    <li><a class="nav-link" href="{{ route('surveyKonsultasiAdmin') }}">Konsultasi</a></li>
                </ul>
            </li>
            <li class="nav-item has-submenu {{ Request::is('admin/studidampak/*') ? 'active' : '' }}">
                <a class="nav-link" href="#"> <i class="la la-folder"></i> Studi Kepuasan Pelatihan </a>
                <ul class="submenu collapse">
                    <li><a class="nav-link" href="{{ route('studiRegulerAdmin') }}">Reguler</a></li>
                    <li><a class="nav-link" href="{{ route('studiPermintaanAdmin') }}">Permintaan</a></li>
                    <li><a class="nav-link" href="{{ route('studiKonsultasiAdmin') }}">Konsultasi</a></li>
                </ul>
            </li>
            <li class="nav-item has-submenu {{ Request::is('admin/sertifikat-pelatihan/*') ? 'active' : '' }}">
                <a class="nav-link" href="#"> <i class="la la-folder-open"></i> Sertifikat Pelatihan </a>
                <ul class="submenu collapse">
                    <li><a class="nav-link" href="{{ route('sertiRegulerAdmin') }}">Reguler</a></li>
                    <li><a class="nav-link" href="{{ route('sertiPermintaanAdmin') }}">Permintaan</a></li>
                    <li><a class="nav-link" href="{{ route('sertiKonsultasiAdmin') }}">Konsultasi</a></li>
                </ul>
            </li>
            <li class="nav-item {{ Request::is('admin/fasilitator/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('fasilitatorAdmin') }}"><i class="la la-users"></i> Fasilitator </a>
            </li>
            {{-- <li class="nav-item {{ Request::is('admin/sertifikat/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('adminSertifikat') }}"> Sertifikat </a>
            </li> --}}
            <li class="nav-item {{ Request::is('admin/ruang-diskusi/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('adminDiskusi') }}"><i class="la la-comments"></i> Ruang Diskusi </a>
            </li>
        </ul>

    </div>
</nav>

<style>
    .sidebar li .submenu {
        list-style: none;
        margin: 0;
        padding: 0;
        padding-left: 1rem;
        padding-right: 1rem;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.sidebar .nav-link').forEach(function(element) {

            element.addEventListener('click', function(e) {

                let nextEl = element.nextElementSibling;
                let parentEl = element.parentElement;

                if (nextEl) {
                    e.preventDefault();
                    let mycollapse = new bootstrap.Collapse(nextEl);

                    if (nextEl.classList.contains('show')) {
                        mycollapse.hide();
                    } else {
                        mycollapse.show();
                        // find other submenus with class=show
                        var opened_submenu = parentEl.parentElement.querySelector(
                            '.submenu.show');
                        // if it exists, then close all of them
                        if (opened_submenu) {
                            new bootstrap.Collapse(opened_submenu);
                        }
                    }
                }
            }); // addEventListener
        }) // forEach
    });
</script>
