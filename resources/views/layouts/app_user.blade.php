<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/stc.png') }}">
    <title>@yield('title', 'Dashboard Pelatihan') - SATUNAMA Training Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#15803d',
                        secondary: '#16a34a',
                        accent: '#22c55e'
                    }
                }
            }
        }
    </script>
    {{-- <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d'
                        }
                    }
                }
            }
        }
    </script> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Enhanced transitions for smoother animations */
        .sidebar-hidden {
            transform: translateX(-100%);
        }

        .sidebar-visible {
            transform: translateX(0);
        }

        .overlay-hidden {
            opacity: 0;
            pointer-events: none;
            visibility: hidden;
        }

        .overlay-visible {
            opacity: 1;
            pointer-events: auto;
            visibility: visible;
        }

        /* Prevent body scroll when mobile sidebar is open */
        .no-scroll {
            overflow: hidden;
        }

        /* Smooth transition for sidebar */
        #sidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Overlay transition */
        #sidebarOverlay {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Mobile-first responsive design */
        @media (max-width: 1023px) {
            #sidebar {
                position: fixed;
                z-index: 50;
            }
        }

        /* Desktop sidebar positioning */
        @media (min-width: 1024px) {
            #sidebar {
                position: fixed;
                transform: translateX(0) !important;
            }

            #sidebarOverlay {
                display: none !important;
            }
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden overlay-hidden"></div>

    <!-- Sidebar -->
    @include('partials.app_user_sidebar')

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Top Header -->
        @include('partials.app_user_header')

        <!-- Page Content -->
        <main class="p-4 sm:p-6 lg:p-8">
            @yield('content')
            <!-- Modal Backdrop -->
            <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                <!-- Modal Content -->
                <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all">
                    <!-- Modal Header -->
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">
                                <i class="fas fa-sign-out-alt text-red-500 mr-2"></i>
                                Konfirmasi Logout
                            </h3>
                            <button onclick="closeLogoutModal()"
                                class="text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="px-6 py-4">
                        <p class="text-gray-600 mb-4">
                            Apakah Anda yakin ingin keluar dari sistem?
                        </p>
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-yellow-400 mr-2"></i>
                                <p class="text-sm text-yellow-700">
                                    Anda akan diarahkan ke halaman beranda setelah logout.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                        <button onclick="closeLogoutModal()"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                            <i class="fas fa-times mr-1"></i>
                            Batal
                        </button>
                        <button onclick="confirmLogout()"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                            <i class="fas fa-sign-out-alt mr-1"></i>
                            Ya, Keluar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hidden Form untuk Logout -->
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </main>
    </div>

    {{-- Modal Login (Tailwind) --}}
    @if (!Auth::check())
        <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <!-- Tombol close -->
                {{-- <button onclick="closeLoginModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                    ✕
                </button> --}}

                <div class="flex justify-center mb-4">
                    <img src="{{ asset('images/stc.png') }}" alt="Hero Image" class="w-20 h-auto">
                </div>

                <form action="{{ route('login.process') }}" method="POST" class="space-y-4">
                    @csrf
                    <!-- Email/Username -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email atau Username</label>
                        <div class="flex items-center border rounded-lg overflow-hidden">
                            <input type="text" name="login" placeholder="email@example.com / username"
                                class="flex-1 px-3 py-2 outline-none">
                            <span class="px-3 text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="flex items-center border rounded-lg overflow-hidden">
                            <input type="password" name="password" id="passwordInput"
                                placeholder="Masukan Password anda" class="flex-1 px-3 py-2 outline-none">
                            <span id="togglePassword" class="px-3 text-gray-400 cursor-pointer">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <input type="hidden" name="redirect_to" value="{{ url()->full() }}">

                    <div class="flex justify-between items-center text-sm">
                        <a href="#" class="text-blue-600 hover:underline">Lupa Password?</a>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-medium">
                        Masuk
                    </button>

                    <div class="relative my-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase">
                            <span class="bg-white px-2 text-gray-500">atau gunakan akun</span>
                        </div>
                    </div>

                    <a href="{{ route('auth.google') }}"
                        class="w-full flex items-center justify-center border rounded-lg py-2 text-gray-700 hover:bg-gray-100">
                        <i class="fab fa-google mr-2"></i> Google
                    </a>

                    <p class="text-center text-sm text-gray-500 mt-4">
                        Belum punya akun? <a href="{{ route('daftar') }}" class="text-blue-600 hover:underline">Daftar
                            Sekarang</a>
                    </p>
                </form>
            </div>
        </div>
    @endif



    <script>
        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
            document.getElementById('logoutModal').classList.add('flex');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
            document.getElementById('logoutModal').classList.remove('flex');
        }

        function confirmLogout() {
            document.getElementById('logoutForm').submit();
        }

        // Close modal ketika klik di luar modal
        document.getElementById('logoutModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLogoutModal();
            }
        });

        // Close modal dengan ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLogoutModal();
            }
        });
        // Toggle Password
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('passwordInput');
            if (togglePassword) {
                togglePassword.addEventListener('click', () => {
                    const type = passwordInput.type === 'password' ? 'text' : 'password';
                    passwordInput.type = type;
                    togglePassword.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' :
                        '<i class="fas fa-eye-slash"></i>';
                });
            }

            // Munculkan modal otomatis kalau belum login
            @if (!Auth::check())
                openLoginModal();
            @endif
        });

        function openLoginModal() {
            document.getElementById('loginModal').classList.remove('hidden');
        }

        function closeLoginModal() {
            document.getElementById('loginModal').classList.add('hidden');
        }
    </script>


    @include('partials.app_user_scripts')
    @stack('scripts')
</body>

</html>
