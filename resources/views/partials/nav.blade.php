<nav class="fixed top-0 z-40 w-full bg-white border-b border-gray-200">
    <div class="flex items-center justify-between px-4 py-3">
        <!-- Left: Sidebar Toggle + Logo + Title -->
        <div class="flex items-center space-x-4">
            <!-- Mobile sidebar toggle button -->
            <button id="sidebar-toggle" type="button"
                class="p-2 text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Logo -->
            {{-- <a href="#" class="flex items-center space-x-2">
                <span class="text-lg font-semibold text-blue-800">CMS LOGO</span>
            </a> --}}
            <a class="flex items-center space-x-2" href="/admin/dashboard">
                <img loading="lazy" src="{{ asset('images/stc.png') }}" class="w-20 h-25" alt="Logo" />
            </a>
        </div>

        <!-- Right: Notification + User dropdown -->
        <div class="flex items-center space-x-4">
            <!-- Notification -->
            <button type="button"
                class="p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <span class="sr-only">View notifications</span>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>

            <!-- User dropdown -->
            {{-- <div class="relative">
                <button id="user-dropdown-button" type="button"
                    class="flex text-sm rounded-full focus:ring-2 focus:ring-gray-200" aria-expanded="false">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full"
                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="User photo">
                </button>

                <!-- Dropdown menu -->
                <div id="user-dropdown"
                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                    <div class="px-4 py-2">
                        <p class="text-sm text-gray-900">John Doe</p>
                        <p class="text-xs text-gray-500 truncate">john.doe@example.com</p>
                    </div>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Earnings</a>
                    <a href="#" id="logout-btn"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
                </div>
            </div> --}}
        </div>
    </div>
</nav>
