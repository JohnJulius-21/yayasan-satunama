{{-- resources/views/partials/search-materials.blade.php --}}
<div class="bg-white rounded-xl shadow-sm border p-6 mb-6" x-data="{ showAdvanced: false }">
    <div class="text-center mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">🔍 Cari Materi</h3>
        <p class="text-gray-600">Temukan file atau folder yang Anda butuhkan dengan mudah</p>
    </div>

    {{-- Basic Search --}}
    <form action="{{ route('user.reguler.materi.search', $reguler->id ?? 0) }}" method="GET" class="space-y-4">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="bi bi-search text-gray-400"></i>
                </div>
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Ketik nama file atau folder..."
                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
            </div>

            <div class="flex gap-2">
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                    <i class="bi bi-search mr-2"></i>
                    Cari
                </button>

                <button type="button" @click="showAdvanced = !showAdvanced"
                    class="inline-flex items-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="bi bi-sliders mr-2"></i>
                    Filter
                </button>
            </div>
        </div>

        {{-- Advanced Search --}}
        <div x-show="showAdvanced" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" class="bg-gray-50 rounded-lg p-4 space-y-4">

            <h4 class="font-medium text-gray-800 mb-3">Filter Pencarian</h4>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- File Type Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe File</label>
                    <select name="type"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Semua Tipe</option>
                        <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>📄 PDF</option>
                        <option value="ppt,pptx" {{ request('type') == 'ppt,pptx' ? 'selected' : '' }}>📊 PowerPoint
                        </option>
                        <option value="doc,docx" {{ request('type') == 'doc,docx' ? 'selected' : '' }}>📝 Word</option>
                    </select>
                </div>

                {{-- Folder Filter --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Folder</label>
                    <select name="folder"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Semua Folder</option>
                        <option value="session" {{ request('folder') == 'session' ? 'selected' : '' }}>📋 Session Plan
                        </option>
                        <option value="day" {{ request('folder') == 'day' ? 'selected' : '' }}>📅 Day Sessions
                        </option>
                        <option value="sesi" {{ request('folder') == 'sesi' ? 'selected' : '' }}>🎯 Sesi</option>
                    </select>
                </div>

                {{-- Sort Order --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                    <select name="sort"
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A
                        </option>
                        <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Terbaru</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-4
