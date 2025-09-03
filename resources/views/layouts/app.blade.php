<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- CSS Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.css"
        rel="stylesheet">

    <!-- Bootstrap CSS (jika diperlukan untuk tooltip dan komponen lain) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
@include('partials.nav')
@include('partials.sidebar')

<!-- Konten utama dengan padding atas untuk navbar -->
<div class="pt-16 pl-0 lg:pl-64 transition-all duration-300">
    <div class="p-4">
        @yield('content')
    </div>
</div>

<!-- JavaScript Dependencies - Urutan penting! -->

<!-- 1. jQuery (hanya satu versi) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- 2. Bootstrap JS (untuk tooltip dan komponen Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- 3. Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- 4. DataTables dan dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
<script
    src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.js"></script>

<!-- 5. Other Libraries -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.js"></script>

<!-- 6. Template JS Files (optional - load only if needed) -->
<!-- Uncomment hanya jika Anda benar-benar memerlukan file-file ini -->
<!--
    <script src="{{ asset('template/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
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
    -->

<script src="{{ asset('/components/data-table.js') }}"></script>
<!-- CKEditor (load only if needed) -->
<script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>

<!-- Custom JS for sidebar functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Mobile sidebar toggle
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('-translate-x-full');
                sidebar.classList.toggle('transform-none');
            });
        }

        // Dropdown functionality
        const userDropdownButton = document.getElementById('user-dropdown-button');
        const userDropdown = document.getElementById('user-dropdown');

        if (userDropdownButton && userDropdown) {
            userDropdownButton.addEventListener('click', function () {
                userDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                if (!userDropdownButton.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }

        // Submenu functionality
        const submenuButtons = document.querySelectorAll('[data-submenu-toggle]');
        submenuButtons.forEach(button => {
            button.addEventListener('click', function () {
                const submenuId = this.getAttribute('data-submenu-toggle');
                const submenu = document.getElementById(submenuId);
                if (submenu) {
                    submenu.classList.toggle('hidden');

                    // Rotate chevron icon
                    const chevron = this.querySelector('.submenu-chevron');
                    if (chevron) {
                        chevron.classList.toggle('rotate-90');
                    }
                }
            });
        });
    });
</script>

@yield('scripts')
</body>

</html>
