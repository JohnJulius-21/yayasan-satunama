{{-- resources/views/partials/file-card.blade.php --}}
@php
    $fileName = $fileValue['file_name'] ?? 'Unnamed File';
    $fileUrl = $fileValue['file_url'] ?? '#';
    $filePath = $fileValue['file_path'] ?? '';

    // Determine file type and colors based on file extension
    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // File configuration for different types
    $fileConfig = [
        'pdf' => [
            'icon' => 'bi-file-earmark-pdf-fill',
            'color' => 'red',
            'bgColor' => 'bg-red-100',
            'textColor' => 'text-red-600',
            'buttonColor' => 'bg-red-500 hover:bg-red-600',
            'borderColor' => 'hover:border-red-200',
            'hoverBg' => 'hover:bg-red-50',
            'emoji' => '📄',
            'label' => 'PDF Document',
        ],
        'ppt' => [
            'icon' => 'bi-file-earmark-ppt-fill',
            'color' => 'orange',
            'bgColor' => 'bg-orange-100',
            'textColor' => 'text-orange-600',
            'buttonColor' => 'bg-orange-500 hover:bg-orange-600',
            'borderColor' => 'hover:border-orange-200',
            'hoverBg' => 'hover:bg-orange-50',
            'emoji' => '📊',
            'label' => 'PowerPoint',
        ],
        'pptx' => [
            'icon' => 'bi-file-earmark-ppt-fill',
            'color' => 'orange',
            'bgColor' => 'bg-orange-100',
            'textColor' => 'text-orange-600',
            'buttonColor' => 'bg-orange-500 hover:bg-orange-600',
            'borderColor' => 'hover:border-orange-200',
            'hoverBg' => 'hover:bg-orange-50',
            'emoji' => '📊',
            'label' => 'PowerPoint',
        ],
        'doc' => [
            'icon' => 'bi-file-earmark-word-fill',
            'color' => 'blue',
            'bgColor' => 'bg-blue-100',
            'textColor' => 'text-blue-600',
            'buttonColor' => 'bg-blue-500 hover:bg-blue-600',
            'borderColor' => 'hover:border-blue-200',
            'hoverBg' => 'hover:bg-blue-50',
            'emoji' => '📝',
            'label' => 'Word Document',
        ],
        'docx' => [
            'icon' => 'bi-file-earmark-word-fill',
            'color' => 'blue',
            'bgColor' => 'bg-blue-100',
            'textColor' => 'text-blue-600',
            'buttonColor' => 'bg-blue-500 hover:bg-blue-600',
            'borderColor' => 'hover:border-blue-200',
            'hoverBg' => 'hover:bg-blue-50',
            'emoji' => '📝',
            'label' => 'Word Document',
        ],
        'xls' => [
            'icon' => 'bi-file-earmark-excel-fill',
            'color' => 'green',
            'bgColor' => 'bg-green-100',
            'textColor' => 'text-green-600',
            'buttonColor' => 'bg-green-500 hover:bg-green-600',
            'borderColor' => 'hover:border-green-200',
            'hoverBg' => 'hover:bg-green-50',
            'emoji' => '📈',
            'label' => 'Excel File',
        ],
        'xlsx' => [
            'icon' => 'bi-file-earmark-excel-fill',
            'color' => 'green',
            'bgColor' => 'bg-green-100',
            'textColor' => 'text-green-600',
            'buttonColor' => 'bg-green-500 hover:bg-green-600',
            'borderColor' => 'hover:border-green-200',
            'hoverBg' => 'hover:bg-green-50',
            'emoji' => '📈',
            'label' => 'Excel File',
        ],
        'mp4' => [
            'icon' => 'bi-file-earmark-play-fill',
            'color' => 'purple',
            'bgColor' => 'bg-purple-100',
            'textColor' => 'text-purple-600',
            'buttonColor' => 'bg-purple-500 hover:bg-purple-600',
            'borderColor' => 'hover:border-purple-200',
            'hoverBg' => 'hover:bg-purple-50',
            'emoji' => '🎥',
            'label' => 'Video File',
        ],
        'mp3' => [
            'icon' => 'bi-file-earmark-music-fill',
            'color' => 'pink',
            'bgColor' => 'bg-pink-100',
            'textColor' => 'text-pink-600',
            'buttonColor' => 'bg-pink-500 hover:bg-pink-600',
            'borderColor' => 'hover:border-pink-200',
            'hoverBg' => 'hover:bg-pink-50',
            'emoji' => '🎵',
            'label' => 'Audio File',
        ],
        'zip' => [
            'icon' => 'bi-file-earmark-zip-fill',
            'color' => 'yellow',
            'bgColor' => 'bg-yellow-100',
            'textColor' => 'text-yellow-600',
            'buttonColor' => 'bg-yellow-500 hover:bg-yellow-600',
            'borderColor' => 'hover:border-yellow-200',
            'hoverBg' => 'hover:bg-yellow-50',
            'emoji' => '📦',
            'label' => 'Archive File',
        ],
        'jpg' => [
            'icon' => 'bi-file-earmark-image-fill',
            'color' => 'indigo',
            'bgColor' => 'bg-indigo-100',
            'textColor' => 'text-indigo-600',
            'buttonColor' => 'bg-indigo-500 hover:bg-indigo-600',
            'borderColor' => 'hover:border-indigo-200',
            'hoverBg' => 'hover:bg-indigo-50',
            'emoji' => '🖼️',
            'label' => 'Image File',
        ],
        'png' => [
            'icon' => 'bi-file-earmark-image-fill',
            'color' => 'indigo',
            'bgColor' => 'bg-indigo-100',
            'textColor' => 'text-indigo-600',
            'buttonColor' => 'bg-indigo-500 hover:bg-indigo-600',
            'borderColor' => 'hover:border-indigo-200',
            'hoverBg' => 'hover:bg-indigo-50',
            'emoji' => '🖼️',
            'label' => 'Image File',
        ],
        'default' => [
            'icon' => 'bi-file-earmark-fill',
            'color' => 'gray',
            'bgColor' => 'bg-gray-100',
            'textColor' => 'text-gray-600',
            'buttonColor' => 'bg-gray-500 hover:bg-gray-600',
            'borderColor' => 'hover:border-gray-200',
            'hoverBg' => 'hover:bg-gray-50',
            'emoji' => '📎',
            'label' => 'File',
        ],
    ];

    $config = $fileConfig[$extension] ?? $fileConfig['default'];

    // Clean filename for display
    $displayName = Str::limit(pathinfo($fileName, PATHINFO_FILENAME), 30);
    $fileSize = ''; // You can add file size if available in your data
@endphp

<div class="bg-white rounded-xl p-5 border-2 border-transparent {{ $config['borderColor'] }} {{ $config['hoverBg'] }} shadow-sm hover:shadow-lg transition-all duration-300 cursor-pointer group"
    x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">

    {{-- File Icon and Type --}}
    <div class="flex items-start mb-4">
        <div
            class="{{ $config['bgColor'] }} p-4 rounded-xl mr-4 group-hover:scale-110 transition-transform duration-200 shadow-sm">
            <i class="bi {{ $config['icon'] }} {{ $config['textColor'] }} text-3xl"></i>
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center mb-1">
                <span class="text-xl mr-2">{{ $config['emoji'] }}</span>
                <span
                    class="px-2 py-1 {{ $config['bgColor'] }} {{ $config['textColor'] }} rounded-full text-xs font-medium">
                    {{ strtoupper($extension ?: 'FILE') }}
                </span>
            </div>
            <h4
                class="font-bold text-gray-800 group-hover:text-{{ $config['color'] }}-600 transition-colors duration-200 mb-1 leading-tight text-lg">
                {{ $displayName }}
            </h4>
            <p class="text-sm text-gray-500 mb-2">{{ $config['label'] }}</p>

            {{-- File Info --}}
            <div class="flex items-center text-xs text-gray-400 space-x-3">
                @if ($fileSize)
                    <span class="flex items-center">
                        <i class="bi bi-hdd mr-1"></i>
                        {{ $fileSize }}
                    </span>
                @endif
                <span class="flex items-center">
                    <i class="bi bi-calendar3 mr-1"></i>
                    {{ date('d M Y') }}
                </span>
            </div>
        </div>
    </div>

    {{-- File Actions --}}
    <div class="space-y-3">
        {{-- Primary Action Button --}}
        <a href="{{ $fileUrl }}" target="_blank"
            onclick="trackFileAccess('{{ $fileName }}', '{{ $fileUrl }}')"
            class="inline-flex items-center {{ $config['buttonColor'] }} text-white px-6 py-3 rounded-xl transition-all duration-200 w-full justify-center text-base font-semibold hover:shadow-lg transform hover:-translate-y-1 group-hover:scale-105">
            <i class="bi bi-box-arrow-up-right mr-3 text-lg"></i>
            <span>Buka & Unduh</span>
        </a>

        {{-- Secondary Actions --}}
        <div class="flex gap-2">
            {{-- Quick Preview for supported files --}}
            @if (in_array($extension, ['pdf', 'jpg', 'png', 'doc', 'docx']))
                <button onclick="previewFile('{{ $fileUrl }}', '{{ $fileName }}')"
                    class="flex-1 inline-flex items-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">
                    <i class="bi bi-eye mr-2"></i>
                    <span class="hidden sm:inline">Preview</span>
                </button>
            @endif

            {{-- Copy Link --}}
            <button onclick="copyFileLink('{{ $fileUrl }}', '{{ $fileName }}')"
                class="flex-1 inline-flex items-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">
                <i class="bi bi-link-45deg mr-2"></i>
                <span class="hidden sm:inline">Salin Link</span>
            </button>

            {{-- Info Button --}}
            <button onclick="showFileInfo('{{ $fileName }}', '{{ $config['label'] }}', '{{ $filePath }}')"
                class="inline-flex items-center bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                <i class="bi bi-info-circle"></i>
            </button>
        </div>
    </div>

    {{-- File Path Info (collapsible) --}}
    @if ($filePath)
        <div class="mt-4 pt-4 border-t border-gray-100" x-show="isHovered"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100">
            <div class="flex items-center text-xs text-gray-500">
                <i class="bi bi-folder2-open mr-2"></i>
                <span class="truncate">{{ $filePath }}</span>
            </div>
        </div>
    @endif
</div>

{{-- Add this script once in your main layout or at the bottom of your page --}}
@push('scripts')
    <script>
        // File interaction functions
        function trackFileAccess(fileName, fileUrl) {
            // Track file access for analytics
            console.log('Accessing file:', fileName);

            // Show loading toast
            showToast('Membuka file: ' + fileName, 'info');

            // You can add analytics tracking here
            // Example: gtag('event', 'file_access', { file_name: fileName });
        }

        function previewFile(fileUrl, fileName) {
            // Open file in a popup window for preview
            const popup = window.open(fileUrl, 'preview', 'width=900,height=700,scrollbars=yes,resizable=yes');

            if (!popup) {
                // If popup is blocked, fallback to new tab
                window.open(fileUrl, '_blank');
                showToast('Popup diblokir. File dibuka di tab baru.', 'info');
            } else {
                showToast('Membuka preview: ' + fileName, 'success');
            }
        }

        function copyFileLink(fileUrl, fileName) {
            // Copy file URL to clipboard
            if (navigator.clipboard) {
                navigator.clipboard.writeText(fileUrl).then(function() {
                    showToast('Link berhasil disalin: ' + fileName, 'success');
                }).catch(function() {
                    fallbackCopyTextToClipboard(fileUrl, fileName);
                });
            } else {
                fallbackCopyTextToClipboard(fileUrl, fileName);
            }
        }

        function fallbackCopyTextToClipboard(text, fileName) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";

            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    showToast('Link berhasil disalin: ' + fileName, 'success');
                } else {
                    showToast('Gagal menyalin link', 'error');
                }
            } catch (err) {
                showToast('Gagal menyalin link', 'error');
            }

            document.body.removeChild(textArea);
        }

        function showFileInfo(fileName, fileType, filePath) {
            // Show file information modal or alert
            const info = `
📄 Nama File: ${fileName}
📋 Tipe: ${fileType}
📁 Lokasi: ${filePath}
    `;

            // You can replace this with a proper modal
            alert('Informasi File:\n\n' + info);
        }

        function showToast(message, type = 'info') {
            // Create toast notification
            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' :
                type === 'error' ? 'bg-red-500' : 'bg-blue-500';

            toast.className =
                `fixed top-4 right-4 z-50 p-4 rounded-lg text-white ${bgColor} shadow-lg transform transition-all duration-300 translate-x-full opacity-0`;
            toast.innerHTML = `
        <div class="flex items-center">
            <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'error' ? 'x-circle' : 'info-circle'} mr-2"></i>
            <span>${message}</span>
        </div>
    `;

            document.body.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
            }, 100);

            // Animate out and remove
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }
    </script>
@endpush
