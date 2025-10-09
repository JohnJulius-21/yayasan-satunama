<!-- Mobile menu overlay -->
<div id="mobile-overlay" class="fixed inset-0 z-20 bg-black bg-opacity-50 hidden lg:hidden"></div>

<!-- Mobile menu button -->
<button id="mobile-menu-btn" class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-md bg-white shadow-lg">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<!-- Sidebar -->
<aside id="sidebar"
       class="fixed top-0 left-0 z-30 w-64 h-screen transition-transform -translate-x-full lg:translate-x-0 bg-white border-r border-gray-200 shadow-sm">
    <div class="h-full flex flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
            <span class="text-xl font-bold text-gray-900">CMS LOGO</span>
            <button id="close-sidebar" class="lg:hidden p-1 rounded-md hover:bg-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto px-3 py-4">
            <ul class="space-y-1" id="nav-menu">
                @if(auth()->user()->username !== 'ctgaadmin')
                    <!-- Dashboard -->
                    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('indexAdmin') }}"
                           class="nav-link flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 group transition-colors duration-200">
                            <i class="la la-dashboard text-lg text-gray-500 group-hover:text-gray-700"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                @endif

                <!-- Pelatihan -->
                <li class="nav-item-submenu {{ Request::is('admin/pelatihan/*') || Request::is('change-the-game-academy*') ? 'active-parent' : '' }}">
                    <button type="button"
                            class="nav-toggle flex items-center w-full p-3 text-gray-700 transition duration-200 rounded-lg hover:bg-gray-100 group"
                            data-submenu="pelatihan">
                        <i class="la la-book text-lg text-gray-500 group-hover:text-gray-700"></i>
                        <span class="flex-1 ml-3 text-left">Pelatihan</span>
                        <svg
                            class="w-4 h-4 transition-transform duration-200 submenu-chevron {{ Request::is('admin/pelatihan/*') || Request::is('change-the-game-academy*') ? 'rotate-180' : '' }}"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul class="submenu ml-8 mt-1 space-y-1 {{ Request::is('admin/pelatihan/*') || Request::is('change-the-game-academy*') ? '' : 'hidden' }}">
                        @if(auth()->user()->username !== 'ctgaadmin')
                            <li class="nav-subitem {{ Request::is('admin/pelatihan/reguler*') ? 'active' : '' }}">
                                <a href="{{ route('regulerAdmin') }}"
                                   class="nav-link flex items-center p-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                    <span>Reguler</span>
                                </a>
                            </li>
                            <li class="nav-subitem {{ Request::is('admin/pelatihan/permintaan*') ? 'active' : '' }}">
                                <a href="{{ route('permintaanAdmin') }}"
                                   class="nav-link flex items-center p-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                    <span>Permintaan</span>
                                </a>
                            </li>
                            <li class="nav-subitem {{ Request::is('admin/pelatihan/konsultasi*') ? 'active' : '' }}">
                                <a href="{{ route('konsultasiAdmin') }}"
                                   class="nav-link flex items-center p-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                    <span>Konsultasi</span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->roles === 'admin' || auth()->user()->username === 'ctgaadmin')
                            <li class="nav-subitem {{ Request::is('change-the-game-academy*') ? 'active' : '' }}">
                                <a href="{{ route('ctga.admin') }}"
                                   class="nav-link flex items-center p-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                    <span>Change the Game Academy</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>

                @if(auth()->user()->username !== 'ctgaadmin')
                    <!-- Presensi Pelatihan -->
                    <li class="nav-item-submenu {{ Request::is('admin/presensi/*') ? 'active-parent' : '' }}">
                        <button type="button"
                                class="nav-toggle flex items-center w-full p-3 text-gray-700 transition duration-200 rounded-lg hover:bg-gray-100 group"
                                data-submenu="presensi">
                            <i class="la la-check-circle text-lg text-gray-500 group-hover:text-gray-700"></i>
                            <span class="flex-1 ml-3 text-left">Presensi Pelatihan</span>
                            <svg
                                class="w-4 h-4 transition-transform duration-200 submenu-chevron {{ Request::is('admin/presensi/*') ? 'rotate-180' : '' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul class="submenu ml-8 mt-1 space-y-1 {{ Request::is('admin/presensi/*') ? '' : 'hidden' }}">
                            <li class="nav-subitem {{ Request::is('admin/presensi/reguler*') ? 'active' : '' }}">
                                <a href="{{ route('adminPresensiReguler') }}"
                                   class="nav-link flex items-center p-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                    <span>Reguler</span>
                                </a>
                            </li>
                            <li class="nav-subitem {{ Request::is('admin/presensi/permintaan*') ? 'active' : '' }}">
                                <a href="{{ route('adminPresensiPermintaan') }}"
                                   class="nav-link flex items-center p-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                    <span>Permintaan</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Evaluasi Pelatihan -->
                    <li class="nav-item-submenu {{ Request::is('admin/evaluasi/*') ? 'active-parent' : '' }}">
                        <button type="button"
                                class="nav-toggle flex items-center w-full p-3 text-gray-700 transition duration-200 rounded-lg hover:bg-gray-100 group"
                                data-submenu="evaluasi">
                            <i class="la la-file text-lg text-gray-500 group-hover:text-gray-700"></i>
                            <span class="flex-1 ml-3 text-left">Evaluasi Pelatihan</span>
                            <svg
                                class="w-4 h-4 transition-transform duration-200 submenu-chevron {{ Request::is('admin/evaluasi/*') ? 'rotate-180' : '' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul class="submenu ml-8 mt-1 space-y-1 {{ Request::is('admin/evaluasi/*') ? '' : 'hidden' }}">
                            <li class="nav-subitem {{ Request::is('admin/evaluasi/reguler*') ? 'active' : '' }}">
                                <a href="{{ route('evaluasiRegulerAdmin') }}"
                                   class="nav-link flex items-center p-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                    <span>Reguler</span>
                                </a>
                            </li>
                            <li class="nav-subitem {{ Request::is('admin/evaluasi/permintaan*') ? 'active' : '' }}">
                                <a href="{{ route('evaluasiPermintaanAdmin') }}"
                                   class="nav-link flex items-center p-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                    <span>Permintaan</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Sertifikat Pelatihan -->
                    <li class="nav-item-submenu {{ Request::is('admin/sertifikat-pelatihan/*') ? 'active-parent' : '' }}">
                        <button type="button"
                                class="nav-toggle flex items-center w-full p-3 text-gray-700 transition duration-200 rounded-lg hover:bg-gray-100 group"
                                data-submenu="sertifikat">
                            <i class="la la-folder-open text-lg text-gray-500 group-hover:text-gray-700"></i>
                            <span class="flex-1 ml-3 text-left">Sertifikat Pelatihan</span>
                            <svg
                                class="w-4 h-4 transition-transform duration-200 submenu-chevron {{ Request::is('admin/sertifikat-pelatihan/*') ? 'rotate-180' : '' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul class="submenu ml-8 mt-1 space-y-1 {{ Request::is('admin/sertifikat-pelatihan/*') ? '' : 'hidden' }}">
                            <li class="nav-subitem {{ Request::is('admin/sertifikat-pelatihan/reguler*') ? 'active' : '' }}">
                                <a href="{{ route('sertiRegulerAdmin') }}"
                                   class="nav-link flex items-center p-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                    <span>Reguler</span>
                                </a>
                            </li>
                            <li class="nav-subitem {{ Request::is('admin/sertifikat-pelatihan/permintaan*') ? 'active' : '' }}">
                                <a href="{{ route('sertiPermintaanAdmin') }}"
                                   class="nav-link flex items-center p-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                                    <span>Permintaan</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Fasilitator -->
                    <li class="nav-item {{ Request::is('admin/fasilitator/*') ? 'active' : '' }}">
                        <a href="{{ route('fasilitatorAdmin') }}"
                           class="nav-link flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 group transition-colors duration-200">
                            <i class="la la-users text-lg text-gray-500 group-hover:text-gray-700"></i>
                            <span class="ml-3">Expert</span>
                        </a>
                    </li>

                    <!-- alumni -->
                    <li class="nav-item {{ request()->routeIs('adminAlumni') ? 'active' : '' }}">
                        <a href="{{ route('adminAlumni') }}"
                           class="nav-link flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 group transition-colors duration-200">
                            <i class="la la-user text-lg text-gray-500 group-hover:text-gray-700"></i>
                            <span class="ml-3">Alumni Pelatihan</span>
                        </a>
                    </li>

                    <!-- Ruang Diskusi -->
                    <li class="nav-item {{ Request::is('admin/ruang-diskusi/*') ? 'active' : '' }}">
                        <a href="{{ route('adminDiskusi') }}"
                           class="nav-link flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100 group transition-colors duration-200">
                            <i class="la la-comments text-lg text-gray-500 group-hover:text-gray-700"></i>
                            <span class="ml-3">Ruang Diskusi</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- User Profile -->
        <div class="p-4 border-t border-gray-200 bg-gray-50">
            <div class="flex items-center">
                <img class="w-10 h-10 rounded-full object-cover"
                     src="https://img.freepik.com/free-psd/3d-illustration-with-online-avatar_23-2151303089.jpg?t=st=1717285370~exp=1717285970~hmac=9b04d221b5291a6636d4d5024733fa756054ef0e1cdd8817c7261ac1a5b45180"
                     alt="User photo">
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-gray-900">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->roles }}</p>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button class="p-1 rounded-md hover:bg-gray-200 text-gray-400 hover:text-gray-600"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="la la-sign-out text-lg"></i>
                </button>
            </div>
        </div>
    </div>
</aside>

<script>
    // Mobile sidebar functionality
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const closeSidebarBtn = document.getElementById('close-sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const navToggles = document.querySelectorAll('.nav-toggle');

        // Mobile menu toggle
        mobileMenuBtn.addEventListener('click', function () {
            sidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
        });

        // Close sidebar
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        }

        closeSidebarBtn.addEventListener('click', closeSidebar);
        mobileOverlay.addEventListener('click', closeSidebar);

        // Handle window resize
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024) {
                closeSidebar();
            }
        });

        // Submenu toggles (untuk interaksi manual jika diperlukan)
        navToggles.forEach(function (toggle) {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                const submenu = this.nextElementSibling;
                const chevron = this.querySelector('.submenu-chevron');

                submenu.classList.toggle('hidden');
                chevron.classList.toggle('rotate-180');
            });
        });
    });
</script>

<style>
    /* Active link styles */
    .nav-item.active > .nav-link,
    .nav-subitem.active > .nav-link {
        @apply bg-blue-50 text-blue-700 border-r-2 border-blue-700;
    }

    .nav-item.active > .nav-link i,
    .nav-subitem.active > .nav-link i {
        @apply text-blue-700;
    }

    .nav-item-submenu.active-parent > .nav-toggle {
        @apply bg-gray-100 text-gray-900;
    }

    .nav-item-submenu.active-parent > .nav-toggle i {
        @apply text-gray-900;
    }

    /* Smooth transitions */
    .submenu {
        transition: all 0.3s ease;
    }

    .submenu-chevron {
        transition: transform 0.2s ease;
    }

    /* Custom scrollbar */
    .overflow-y-auto::-webkit-scrollbar {
        width: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
        background: transparent;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 2px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }

    /* Mobile responsive adjustments */
    @media (max-width: 1023px) {
        .lg\:ml-64 {
            margin-left: 0 !important;
        }
    }
</style>
