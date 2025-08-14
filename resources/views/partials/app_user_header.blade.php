<header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-4">
                <!-- Mobile menu button -->
                <button id="sidebarToggle"
                    class="lg:hidden p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 transition-colors">
                    <i class="fas fa-bars text-gray-600"></i>
                </button>
                <div>
                    <h1 id="pageTitle" class="text-xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                    @isset($reguler)
                        <p class="text-sm text-gray-500">{{ $reguler->nama_pelatihan }}</p>
                    @endisset
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button class="bg-gray-100 p-2 rounded-full hover:bg-gray-200 transition-colors">
                        <i class="fas fa-bell text-gray-600"></i>
                    </button>
                    {{-- <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span> --}}
                </div>
                <button onclick="openLogoutModal()" type="button" class="text-gray-500 hover:text-gray-700"
                    title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>
    </div>
</header>
