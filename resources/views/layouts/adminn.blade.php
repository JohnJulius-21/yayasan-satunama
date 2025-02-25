<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('images/stc.png') }}">
    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <title>Admin | STC</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">

    <!-- select2 -->
    <script src="{{ asset('select2/dist/js/jquery.min.js') }}"></script>
    <link href="{{ asset('select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  


    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- End layout styles -->
    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" /> --}}
</head>

<body>
    <div class="container-scroller">
        @include('partials.admin_navbar')
        @include('partials.admin_sidebar')

        {{-- @yield('content') --}}
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->

    <!-- Form Builder -->
    {{-- <script src="{{ asset('form-builder/form-builder.min.js') }}"></script>
    <script src="{{ asset('form-builder/form-render.min.js') }}"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>

    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> 
    {{-- <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script> --}}
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>

    <!-- End custom js for this page -->
</body>

</html>
