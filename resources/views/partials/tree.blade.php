{{-- resources/views/partials/tree-gallery.blade.php --}}
<div class="space-y-6" x-data="{ openSections: {} }">
    @foreach ($branch as $key => $value)
        @if (is_array($value) && !isset($value['file_name']))
            {{-- This is a folder --}}
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 cursor-pointer" 
                     @click="openSections['{{ $key }}'] = !openSections['{{ $key }}']"
                     x-data="{ isOpen: false }"
                     x-init="openSections['{{ $key }}'] = true; $watch('openSections[\'{{ $key }}\']', value => isOpen = value)">
                    <h2 class="text-2xl font-semibold flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="bi bi-folder-fill mr-3 text-3xl"></i>
                            📁 {{ ucwords(str_replace(['_', '-'], ' ', $key)) }}
                        </div>
                        <i class="bi bi-chevron-down transform transition-transform" 
                           :class="{ 'rotate-180': openSections['{{ $key }}'] }"></i>
                    </h2>
                    <p class="mt-2 opacity-90">Klik untuk membuka/tutup folder</p>
                </div>
                
                <div x-show="openSections['{{ $key }}']" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="p-6">
                    
                    @php
                        $fileCount = 0;
                        $folderCount = 0;
                        foreach ($value as $subKey => $subValue) {
                            if (is_array($subValue) && isset($subValue['file_name'])) {
                                $fileCount++;
                            } else {
                                $folderCount++;
                            }
                        }
                    @endphp
                    
                    @if ($folderCount > 0)
                        {{-- Sub-folders --}}
                        <div class="mb-6">
                            @foreach ($value as $subKey => $subValue)
                                @if (is_array($subValue) && !isset($subValue['file_name']))
                                    <div class="mb-4 border rounded-lg p-4 bg-gray-50" 
                                         x-data="{ subOpen: false }">
                                        <button @click="subOpen = !subOpen" 
                                                class="w-full flex items-center justify-between text-left hover:bg-gray-100 p-2 rounded">
                                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm mr-3">
                                                    📂
                                                </span>
                                                {{ ucwords(str_replace(['_', '-'], ' ', $subKey)) }}
                                            </h3>
                                            <i class="bi bi-chevron-down transform transition-transform" 
                                               :class="{ 'rotate-180': subOpen }"></i>
                                        </button>
                                        <div x-show="subOpen" x-transition class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                            @foreach ($subValue as $fileKey => $fileValue)
                                                @if (is_array($fileValue) && isset($fileValue['file_name']))
                                                    @include('partials.file-card', ['fileValue' => $fileValue])
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    
                    @if ($fileCount > 0)
                        {{-- Files in this folder --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($value as $fileKey => $fileValue)
                                @if (is_array($fileValue) && isset($fileValue['file_name']))
                                    @include('partials.file-card', ['fileValue' => $fileValue])
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @else
            {{-- This is a direct file --}}
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @include('partials.file-card', ['fileValue' => $value])
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

{{-- File Card Component --}}
{{-- resources/views/partials/file-card.blade.php --}}
@php
    $fileName = $fileValue['file_name'] ?? 'Unnamed File';
    $fileUrl = $fileValue['file_url'] ?? '#';
    
    // Determine file type and colors based on file extension
    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
    $fileConfig = [
        'pdf' => [
            'icon' => 'bi-file-earmark-pdf-fill',
            'color' => 'red',
            'bgColor' => 'bg-red-100',
            'textColor' => 'text-red-600',
            'buttonColor' => 'bg-red-500 hover:bg-red-600',
            'emoji' => '📄'
        ],
        'ppt' => [
            'icon' => 'bi-file-earmark-ppt-fill',
            'color' => 'orange',
            'bgColor' => 'bg-orange-100',
            'textColor' => 'text-orange-600',
            'buttonColor' => 'bg-orange-500 hover:bg-orange-600',
            'emoji' => '📊'
        ],
        'pptx' => [
            'icon' => 'bi-file-earmark-ppt-fill',
            'color' => 'orange',
            'bgColor' => 'bg-orange-100',
            'textColor' => 'text-orange-600',
            'buttonColor' => 'bg-orange-500 hover:bg-orange-600',
            'emoji' => '📊'
        ],
        'doc' => [
            'icon' => 'bi-file-earmark-word-fill',
            'color' => 'blue',
            'bgColor' => 'bg-blue-100',
            'textColor' => 'text-blue-600',
            'buttonColor' => 'bg-blue-500 hover:bg-blue-600',
            'emoji' => '📝'
        ],
        'docx' => [
            'icon' => 'bi-file-earmark-word-fill',
            'color' => 'blue',
            'bgColor' => 'bg-blue-100',
            'textColor' => 'text-blue-600',
            'buttonColor' => 'bg-blue-500 hover:bg-blue-600',
            'emoji' => '📝'
        ],
        'default' => [
            'icon' => 'bi-file-earmark-fill',
            'color' => 'gray',
            'bgColor' => 'bg-gray-100',
            'textColor' => 'text-gray-600',
            'buttonColor' => 'bg-gray-500 hover:bg-gray-600',
            'emoji' => '📎'
        ]
    ];
    
    $config = $fileConfig[$extension] ?? $fileConfig['default'];
@endphp

<div class="bg-white rounded-lg p-4 border-2 border-transparent hover:border-{{ $config['color'] }}-200 hover:shadow-lg transition-all duration-300 cursor-pointer group">
    <div class="flex items-start mb-4">
        <div class="{{ $config['bgColor'] }} p-3 rounded-xl mr-4 group-hover:scale-110 transition-transform duration-200">
            <i class="bi {{ $config['icon'] }} {{ $config['textColor'] }} text-3xl"></i>
        </div>
        <div class="flex-1 min-w-0">
            <h4 class="font-semibold text-gray-800 group-hover:text-{{ $config['color'] }}-600 transition-colors duration-200 mb-1 leading-tight">
                {{ $config['emoji'] }} {{ Str::limit($fileName, 40) }}
            </h4>
            <p class="text-sm text-gray-500 capitalize">{{ $extension ?: 'File' }} • {{ ucfirst($config['color']) }}</p>
        </div>
    </div>
    
    <div class="space-y-2">
        <a href="{{ $fileUrl }}" 
           target="_blank" 
           class="inline-flex items-center {{ $config['buttonColor'] }} text-white px-4 py-2 rounded-lg transition-all duration-200 w-full justify-center text-sm font-medium hover:shadow-md transform hover:-translate-y-0.5">
            <i class="bi bi-eye mr-2"></i>
            Lihat & Unduh
        </a>
        
        {{-- Quick preview button for certain file types --}}
        @if(in_array($extension, ['pdf', 'doc', 'docx']))
            <button onclick="window.open('{{ $fileUrl }}', '_blank', 'width=800,height=600')"
                    class="inline-flex items-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors w-full justify-center text-sm">
                <i class="bi bi-window mr-2"></i>
                Preview Cepat
            </button>
        @endif
    </div>
</div>