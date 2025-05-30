<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>STC - ADMIN</title>
    <link rel="icon" type="image/png" href="{{ asset('images/stc.png') }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link rel="stylesheet" href="{{ asset('template/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('template/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/demo.css') }}">
    {{-- datatable --}}

    <!-- select2 -->
    <script src="{{ asset('select2/dist/js/jquery.min.js') }}"></script>
    <link href="{{ asset('select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a href="{{ route('indexAdmin') }}" class="logo">
                    SATUNAMA
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">

                    <form class="navbar-left navbar-form nav-search mr-md-3" action="">
                        <div class="input-group">
                            <input type="text" placeholder="Search ..." class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-search search-icon"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

                        <li class="nav-item dropdown">
                            {{-- <a href="https://www.flaticon.com/free-icons/profile-image"
                                title="profile image icons">Profile image icons created by Stasy - Flaticon</a> --}}
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false"> <img src="{{ asset('profile.png') }}" alt="user-img"
                                    width="36" class="img-circle"><span>Admin</span></span> </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <div class="user-box">
                                        {{-- <div class="u-img"><img src="{{ asset('profile.png') }}" alt="user"></div> --}}
                                        <div class="u-text">
                                            <h4>Admin</h4>
                                        </div>
                                    </div>
                                </li>
                                <div class="dropdown-divider"></div>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>

                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off"></i> Logout
                                </a>

                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        @include('partials.admin-sidebar')

        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            
        </div>
    </div>
    </div>
    
</body>
{{-- <script src="{{ asset('template/js/core/jquery.3.2.1.min.js') }}"></script> --}}
<script src="{{ asset('template/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('template/js/core/popper.min.js') }}"></script>
<script src="{{ asset('template/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/chartist/chartist.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/jquery-mapael/maps/world_countries.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/chart-circle/circles.min.js') }}"></script>
<script src="{{ asset('template/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('template/js/ready.min.js') }}"></script>
<script src="{{ asset('template/js/demo.js') }}"></script>

<!-- jQuery dan Bootstrap JS -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


{{-- select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- ckeditor --}}
<script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>

</html>
