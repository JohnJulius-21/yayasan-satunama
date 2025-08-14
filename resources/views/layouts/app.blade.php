<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Pastikan Tailwind CSS dimuat -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pastikan font-family di-set */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
    </style>

    <!-- select2 -->
    <script src="{{ asset('select2/dist/js/jquery.min.js') }}"></script>
    <link href="{{ asset('select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50">
    @include('partials.nav')

    @include('partials.sidebar')


    <!-- Konten utama dengan padding atas untuk navbar -->
    <div class="pt-16 pl-0 sm:pl-64">
        <div class="p-4">
            @yield('content')
        </div>
    </div>

    
    <!-- Sertakan jQuery dan DataTables JS -->
    <!-- DataTables CSS -->
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.css"
        rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.0/b-3.0.0/b-html5-3.0.0/fc-5.0.0/fh-4.0.0/r-3.0.0/sc-2.4.0/sp-2.3.0/datatables.min.js">
    </script>

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

    {{-- select2 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.js"></script>
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>

    <!-- Custom JS for sidebar functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar toggle
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                sidebar.classList.toggle('transform-none');
            });

            // Dropdown functionality
            const userDropdownButton = document.getElementById('user-dropdown-button');
            const userDropdown = document.getElementById('user-dropdown');

            if (userDropdownButton && userDropdown) {
                userDropdownButton.addEventListener('click', function() {
                    userDropdown.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!userDropdownButton.contains(event.target) && !userDropdown.contains(event
                            .target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }

            // Submenu functionality
            const submenuButtons = document.querySelectorAll('[data-submenu-toggle]');
            submenuButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const submenuId = this.getAttribute('data-submenu-toggle');
                    const submenu = document.getElementById(submenuId);
                    submenu.classList.toggle('hidden');

                    // Rotate chevron icon
                    const chevron = this.querySelector('.submenu-chevron');
                    if (chevron) {
                        chevron.classList.toggle('rotate-90');
                    }
                });
            });
        });
    </script>

    {{-- @yield('scripts') --}}
</body>

</html>
