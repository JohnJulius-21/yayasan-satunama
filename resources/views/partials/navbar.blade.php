<!-- Navbar -->
<nav class="bg-white shadow-lg sticky top-0 z-50 transition-all duration-300" id="navbar">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center space-x-2 group">
                    <img loading="lazy" src="{{ asset('images/stc.png') }}"
                         class="h-10 w-15 transition-transform duration-300 group-hover:scale-110" alt="Logo"/>
                    {{--                    <img src="https://via.placeholder.com/40x40/438848/FFFFFF?text=STC"--}}
                    {{--                         alt="STC Logo"--}}
                    {{--                         class="h-10 w-10 rounded-lg transition-transform duration-300 group-hover:scale-110">--}}
                    {{--                    <span class="text-xl font-bold text-gray-800 group-hover:text-primary transition-colors duration-300">STC</span>--}}
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-8">
                <!-- Main Navigation -->
                <ul class="flex items-center space-x-6">
                    <li>
                        <a href="{{ route('beranda') }}"
                           class="nav-link text-gray-700 hover:text-green-700 transition-colors duration-300 font-medium relative group {{ Request::is('/') ? 'active text-green-700' : '' }}">
                            Beranda
                            <span class="absolute -bottom-1 left-0 h-0.5 bg-green-700 transition-all duration-300 {{ Request::is('/') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                        </a>
                    </li>

                    <!-- Dropdown Menu -->
                    <li class="relative group">
                        <button
                            class="nav-link text-gray-700 hover:text-green-700 transition-colors duration-300 font-medium flex items-center space-x-1 group">
                            <span>Daftar Pelatihan</span>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                        </button>

                        <!-- Dropdown Content -->
                        <div
                            class="absolute top-full left-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <div class="py-2">
                                <a href="{{route('reguler.index')}}"
                                   class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-green-700 transition-colors duration-200 font-medium">
                                    <i class="fas fa-graduation-cap mr-2 text-green-700"></i>
                                    Reguler
                                </a>
                                <hr class="border-gray-100 my-1">
                                <a href="{{ route('permintaan.create') }}"
                                   class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-green-700 transition-colors duration-200 font-medium">
                                    <i class="fas fa-lightbulb mr-2 text-primary"></i>
                                    Permintaan
                                </a>
                            </div>
                        </div>
                    </li>

                    <li>
                        <a href="{{route('tentang')}}"
                           class="nav-link text-gray-700 hover:text-green-700 transition-colors duration-300 font-medium relative group {{ Route::currentRouteName() == 'tentang' ? 'w-full' : 'w-0 group-hover:w-full' }}">
                            Tentang Kami
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-700 transition-all duration-300 group-hover:w-full {{ Route::currentRouteName() == 'tentang' ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('userDiskusi')}}"
                           class="nav-link text-gray-700 hover:text-green-700 transition-colors duration-300 font-medium relative group {{ Route::currentRouteName() == 'userDiskusi' ? 'w-full' : 'w-0 group-hover:w-full' }}">
                            Ruang Diskusi
                            <span
                                class="absolute -bottom-1 left-0 w-0 h-0.5 bg-green-700 transition-all duration-300 group-hover:w-full {{ Route::currentRouteName() == 'userDiskusi' ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                        </a>
                    </li>
                </ul>

                <!-- Separator -->
                <div class="h-6 w-px bg-gray-300"></div>

                <!-- Auth Section -->
                <div class="flex items-center">
                    <!-- Guest Section (Not Logged In) -->
                    <div class="guest-section flex items-center space-x-4">
                        {{--                        <a href="#" class="text-gray-700 hover:text-green-700 transition-colors duration-300 font-medium">--}}
                        {{--                            Masuk--}}
                        {{--                        </a>--}}
                        {{--                        <a href="#" class="">--}}

                        {{--                        </a>--}}
                        @guest
                            <button id="loginBtn"
                                    class="bg-green-700 text-white px-6 py-2 rounded-full hover:bg-green-600 transition-all duration-300 font-medium shadow-md hover:shadow-lg transform hover:scale-105">
                                Masuk atau Daftar
                            </button>
                        @endguest
                    </div>

                    <!-- User Section (Logged In) - Hidden by default -->
                    @auth
                        <div class="user-section">
                            <div class="relative group">
                                <button
                                    class="flex items-center space-x-2 text-gray-700 hover:text-green-700 transition-colors duration-300 font-medium">
                                    <div
                                        class="w-8 h-8 bg-green-700 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                        {{ Auth::user()->initials }}
                                    </div>
                                    <span>Selamat Datang, {{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                                </button>

                                <!-- User Dropdown -->

                                <div
                                    class="absolute top-full right-0 mt-2 w-52 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                    <div class="py-2">
                                        <a href="{{route('reguler.pelatihan')}}"
                                           class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-green-700 transition-colors duration-200 font-medium">
                                            <i class="fas fa-book mr-2 text-green-700"></i>
                                            Pelatihan Saya
                                        </a>
                                        <hr class="border-gray-100 my-1">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                class="w-full text-left block px-4 py-3 text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-200 font-medium">
                                            <i class="fas fa-sign-out-alt mr-2"></i>
                                            Logout
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button id="mobile-menu-btn"
                        class="p-2 rounded-lg text-gray-700 hover:text-green-700 hover:bg-gray-100 transition-colors duration-300">
                    <i class="fas fa-bars text-xl" id="menu-icon"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
             class="lg:hidden absolute top-full left-0 w-full bg-white shadow-lg border-t border-gray-100 opacity-0 invisible transform -translate-y-4 transition-all duration-300">
            <div class="container mx-auto px-4 py-4">
                <!-- Mobile Navigation -->
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('beranda') }}"
                           class="block text-gray-700 hover:text-green-700 transition-colors duration-300 font-medium py-2
              {{ Route::currentRouteName() == 'beranda' ? 'text-green-700 bg-green-50 border-r-4 border-green-700' : '' }}">
                            <i class="fas fa-home mr-3 {{ Route::currentRouteName() == 'beranda' ? 'text-green-700' : 'text-gray-500' }}"></i>
                            Beranda
                        </a>
                    </li>

                    <!-- Mobile Dropdown -->
                    <li>
                        <button onclick="toggleMobileDropdown('training')"
                                class="w-full flex items-center justify-between text-gray-700 hover:text-green-700 transition-colors duration-300 font-medium py-2">
                            <span>
                                <i class="fas fa-graduation-cap mr-3"></i>
                                Daftar Pelatihan
                            </span>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-300"
                               id="training-icon"></i>
                        </button>

                        <div id="training-dropdown" class="hidden pl-6 pt-2 space-y-2">
                            <a href="{{route('reguler.index')}}"
                               class="block text-gray-600 hover:text-green-700 transition-colors duration-300 py-2">
                                <i class="fas fa-graduation-cap mr-2 text-green-700 text-sm"></i>
                                Reguler
                            </a>
                            <a href="{{ route('permintaan.create') }}"
                               class="block text-gray-600 hover:text-green-700 transition-colors duration-300 py-2">
                                <i class="fas fa-lightbulb mr-2 text-green-700 text-sm"></i>
                                Permintaan
                            </a>
                        </div>
                    </li>

                    <li>
                        <a href="{{route('tentang')}}"
                           class="block text-gray-700 hover:text-green-700 transition-colors duration-300 font-medium py-2 {{ Route::currentRouteName() == 'tentang' ? 'text-green-700 bg-green-50 border-r-4 border-green-700' : '' }}">
                            <i class="fas fa-info-circle mr-3" {{ Route::currentRouteName() == 'tentang' ? 'text-green-700 bg-green-50 border-r-4 border-green-700' : '' }}></i>
                            Tentang Kami
                        </a>
                    </li>

                    <li>
                        <a href="{{route('userDiskusi')}}"
                           class="block text-gray-700 hover:text-green-700 transition-colors duration-300 font-medium py-2 {{ Route::currentRouteName() == 'userDiskusi' ? 'text-green-700 bg-green-50 border-r-4 border-green-700' : '' }}">
                            <i class="fas fa-message mr-3 {{ Route::currentRouteName() == 'userDiskusi' ? 'text-green-700 bg-green-50 border-r-4 border-green-700' : '' }}"></i>
                            Ruang Diskusi
                        </a>
                    </li>
                </ul>

                <!-- Mobile Auth Section -->
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <!-- Guest Section -->
                    @guest
                        <div class="mobile-guest-section space-y-3">
                            <button id="loginBtn"
                                    class="block w-full text-center bg-green-700 text-white py-3 rounded-lg hover:bg-green-600 transition-colors duration-300 font-medium shadow-md">
                                Masuk atau Daftar
                            </button>
                        </div>
                    @endguest

                    <!-- User Section (Hidden by default) -->
                    <div class="mobile-user-section">
                        @auth
                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg mb-3">
                                <div
                                    class="w-8 h-8 bg-green-700 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                    {{ Auth::user()->initials }}
                                </div>
                                <span>Selamat Datang, {{ Auth::user()->name }}</span>
                            </div>


                            <div class="space-y-2">
                                <a href="{{route('reguler.pelatihan')}}"
                                   class="block w-full text-left text-gray-700 hover:text-primary transition-colors duration-300 font-medium py-3 px-4 hover:bg-gray-50 rounded-lg">
                                    <i class="fas fa-book mr-3 text-primary"></i>
                                    Pelatihan Saya
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="block w-full text-left text-red-600 hover:text-red-700 transition-colors duration-300 font-medium py-3 px-4 hover:bg-red-50 rounded-lg">
                                    <i class="fas fa-sign-out-alt mr-3"></i>
                                    Logout
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

{{--<script>--}}
{{--    tailwind.config = {--}}
{{--        theme: {--}}
{{--            extend: {--}}
{{--                colors: {--}}
{{--                    primary: '#438848',--}}
{{--                    secondary: '#BFE7AB',--}}
{{--                    accent: '#28a745',--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}
{{--    }--}}
{{--</script>--}}

<script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    let isMobileMenuOpen = false;

    mobileMenuBtn.addEventListener('click', () => {
        isMobileMenuOpen = !isMobileMenuOpen;

        if (isMobileMenuOpen) {
            mobileMenu.classList.remove('opacity-0', 'invisible', '-translate-y-4');
            mobileMenu.classList.add('opacity-100', 'visible', 'translate-y-0');
            menuIcon.classList.remove('fa-bars');
            menuIcon.classList.add('fa-times');
        } else {
            mobileMenu.classList.add('opacity-0', 'invisible', '-translate-y-4');
            mobileMenu.classList.remove('opacity-100', 'visible', 'translate-y-0');
            menuIcon.classList.remove('fa-times');
            menuIcon.classList.add('fa-bars');
        }
    });

    // Mobile dropdown toggle
    function toggleMobileDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId + '-dropdown');
        const icon = document.getElementById(dropdownId + '-icon');

        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            dropdown.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }

    // Toggle auth state for demo
    let isLoggedIn = false;

    function toggleAuthState() {
        isLoggedIn = !isLoggedIn;

        const guestSections = document.querySelectorAll('.guest-section, .mobile-guest-section');
        const userSections = document.querySelectorAll('.user-section, .mobile-user-section');

        if (isLoggedIn) {
            guestSections.forEach(section => section.classList.add('hidden'));
            userSections.forEach(section => section.classList.remove('hidden'));
        } else {
            guestSections.forEach(section => section.classList.remove('hidden'));
            userSections.forEach(section => section.classList.add('hidden'));
        }
    }

    // Logout function
    function logout() {
        console.log('Logout clicked - implement your logout logic here');
        // For demo, just toggle back to guest state
        toggleAuthState();
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', (event) => {
        if (!mobileMenu.contains(event.target) && !mobileMenuBtn.contains(event.target) && isMobileMenuOpen) {
            mobileMenuBtn.click();
        }
    });

    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('shadow-xl');
            navbar.classList.remove('shadow-lg');
        } else {
            navbar.classList.add('shadow-lg');
            navbar.classList.remove('shadow-xl');
        }
    });
</script>
