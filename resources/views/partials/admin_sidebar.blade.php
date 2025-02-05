<!-- partial -->
<div class="container-fluid page-body-wrapper zindex-absolute">
    <!-- partial:../../partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a class="nav-link" href="../../index.html">
            <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/pelatihan/*') ? 'active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <span class="icon-bg"><i class="mdi mdi-book"></i></span>
            <span class="menu-title">Pelatihan</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('regulerAdmin') }}">Reguler</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('permintaanAdmin') }}">Permintaan</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('konsultasiAdmin') }}">Konsultasi</a></li>
              <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/typography.html">CTGA</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item {{ Request::is('admin/evaluasi/*') ? 'active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
            <span class="icon-bg"><i class="mdi mdi-book-open-outline"></i></span>
            <span class="menu-title">Evaluasi Pelatihan</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic1">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('evaluasiRegulerAdmin') }}">Reguler</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ route('evaluasiPermintaanAdmin') }}">Permintaan</a></li>
              <li class="nav-item"> <a class="nav-link" href="">Konsultasi</a></li>
              <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/typography.html">CTGA</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item {{ Request::is('admin/survey/*') ? 'active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic1">
            <span class="icon-bg"><i class="mdi mdi-book-open-outline"></i></span>
            <span class="menu-title">Survey Kepuasan</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic2">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('surveyRegulerAdmin') }}">Reguler</a></li>
              <li class="nav-item"> <a class="nav-link" href="">Permintaan</a></li>
              <li class="nav-item"> <a class="nav-link" href="">Konsultasi</a></li>
              <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/typography.html">CTGA</a></li>
            </ul>
          </div>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{ route('evaluasiAdmin') }}">
            <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
            <span class="menu-title">Evaluasi Pelatihan</span>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{ route('surveyRegulerAdmin') }}">
            <span class="icon-bg"><i class="mdi mdi-comment-account"></i></span>
            <span class="menu-title">Survey Kepuasan</span>
          </a>
        </li> --}}
        <li class="nav-item {{ Request::is('admin/studidampak/*') ? 'active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic1">
            <span class="icon-bg"><i class="mdi mdi-book-open-outline"></i></span>
            <span class="menu-title">Studi Dampak</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic3">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{ route('studiRegulerAdmin') }}">Reguler</a></li>
              <li class="nav-item"> <a class="nav-link" href="">Permintaan</a></li>
              <li class="nav-item"> <a class="nav-link" href="">Konsultasi</a></li>
              <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/typography.html">CTGA</a></li>
            </ul>
          </div>
        </li>
        {{-- <li class="nav-item {{ Request::is('admin/studidampak/*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('studiAdmin') }}">
            <span class="icon-bg"><i class="mdi mdi-file-search"></i></span>
            <span class="menu-title">Studi Dampak</span>
          </a>
        </li> --}}
        <li class="nav-item {{ Request::is('admin/fasilitator/*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('fasilitatorAdmin') }}">
            <span class="icon-bg"><i class="mdi mdi-account"></i></span>
            <span class="menu-title">Fasilitator</span>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
            <span class="menu-title">User Pages</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="../../pages/samples/blank-page.html"> Blank Page </a></li>
              <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login.html"> Login </a></li>
              <li class="nav-item"> <a class="nav-link" href="../../pages/samples/register.html"> Register </a></li>
              <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-404.html"> 404 </a></li>
              <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-500.html"> 500 </a></li>
            </ul>
          </div>
        </li> --}}
        {{-- <li class="nav-item documentation-link">
          <a class="nav-link" href="http://www.bootstrapdash.com/demo/connect-plus-free/jquery/documentation/documentation.html" target="_blank">
            <span class="icon-bg">
              <i class="mdi mdi-file-document-box menu-icon"></i>
            </span>
            <span class="menu-title">Documentation</span>
          </a>
        </li> --}}
        {{-- <li class="nav-item sidebar-user-actions">
          <div class="user-details">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="d-flex align-items-center">
                  <div class="sidebar-profile-img">
                    <img src="../../assets/images/faces/face28.png" alt="image">
                  </div>
                  <div class="sidebar-profile-text">
                    <p class="mb-1">Henry Klein</p>
                  </div>
                </div>
              </div>
              <div class="badge badge-danger">3</div>
            </div>
          </div>
        </li>
        <li class="nav-item sidebar-user-actions">
          <div class="sidebar-user-menu">
            <a href="#" class="nav-link"><i class="mdi mdi-settings menu-icon"></i>
              <span class="menu-title">Settings</span>
            </a>
          </div>
        </li>
        <li class="nav-item sidebar-user-actions">
          <div class="sidebar-user-menu">
            <a href="#" class="nav-link"><i class="mdi mdi-speedometer menu-icon"></i>
              <span class="menu-title">Take Tour</span></a>
          </div>
        </li>
        <li class="nav-item sidebar-user-actions">
          <div class="sidebar-user-menu">
            <a href="#" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
              <span class="menu-title">Log Out</span></a>
          </div>
        </li> --}}
      </ul>
    </nav>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        @yield('content')
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:../../partials/_footer.html -->
      {{-- <footer class="footer">
        <div class="footer-inner-wraper">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from Bootstrapdash.com</span>
          </div>
        </div>
      </footer> --}}
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>