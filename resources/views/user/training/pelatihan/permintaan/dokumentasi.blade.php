@extends('layouts.app_user')

@section('title', 'Dokumentasi')
@section('page-title', 'Dokumentasi')

@section('content')

    <div class="max-w-2xl mx-auto text-center py-16">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="mb-6">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-green-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <!-- Development/Construction SVG -->
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Sedang Dalam Pengembangan</h2>
                <p class="text-lg text-gray-600 mb-4">Fitur ini sedang dalam tahap pengembangan</p>
                <p class="text-sm text-gray-500">Kami sedang bekerja keras untuk menghadirkan fitur terbaik untuk Anda.
                    Mohon bersabar ya!</p>
            </div>

            <!-- Progress indicator -->
            <div class="flex justify-center items-center space-x-2 mt-6">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                <div class="w-2 h-2 bg-green-500 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
            </div>
        </div>
    </div>
    {{-- <style>
        .filter-btn {
            @apply px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors;
        }

        .filter-btn.active {
            @apply bg-blue-500 text-white border-blue-500;
        }

        .loading-placeholder {
            @apply bg-gray-200 animate-pulse;
        }

        .modal {
            @apply fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4 hidden;
        }

        .media-item {
            @apply bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 cursor-pointer;
        }

        .media-item:hover {
            transform: translateY(-2px);
        }

        .video-overlay {
            @apply absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center;
        }

        .play-button {
            @apply bg-white bg-opacity-80 rounded-full p-3 hover:bg-opacity-100 transition-all;
        }
    </style>
    <header class="bg-white shadow-md mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Gallery Media</h1>
                    <p class="text-gray-600 mt-1">Foto dan Video dari Cloud Storage</p>
                </div>
                <div class="flex gap-3">
                    <button id="refreshBtn"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Refresh
                    </button>
                    <button id="uploadBtn"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        Upload
                    </button>
                    <button id="signInBtn"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors hidden">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Sign In
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Filter dan Search -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex flex-col sm:flex-row gap-4 items-center">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari file..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="filter-btn active" data-filter="all">Semua</button>
                    <button class="filter-btn" data-filter="image">Foto</button>
                    <button class="filter-btn" data-filter="video">Video</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading State -->
    <div id="loadingState" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 hidden">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="loading-placeholder h-64 rounded-lg"></div>
            <div class="loading-placeholder h-64 rounded-lg"></div>
            <div class="loading-placeholder h-64 rounded-lg"></div>
            <div class="loading-placeholder h-64 rounded-lg"></div>
        </div>
    </div>

    <!-- Gallery Container -->
    <div id="galleryContainer" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="mediaGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Media items will be inserted here by JavaScript -->
        </div>
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="text-center py-12 hidden">
        <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada media ditemukan</h3>
        <p class="text-gray-500">Coba refresh atau upload file baru</p>
    </div>

    <!-- Modal untuk preview -->
    <div id="mediaModal" class="modal">
        <!-- Navigation Buttons - Hidden by default -->
        <button id="prevBtn"
            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-70 transition-all z-10 opacity-0 hover:opacity-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <button id="nextBtn"
            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-70 transition-all z-10 opacity-0 hover:opacity-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Top Controls -->
        <div class="absolute top-4 right-4 z-10 flex gap-2">
            <button id="downloadBtn"
                class="bg-green-500 bg-opacity-80 text-white p-2 rounded-full hover:bg-opacity-100 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </button>
            <button id="closeModal"
                class="bg-red-500 bg-opacity-80 text-white p-2 rounded-full hover:bg-opacity-100 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div id="modalContent" class="relative max-w-4xl max-h-full flex items-center justify-center">
            <!-- Media content will be inserted here -->
        </div>

        <!-- Bottom Info Panel -->
        <div class="absolute bottom-4 left-4 right-4 bg-black bg-opacity-60 text-white p-4 rounded-lg">
            <div id="mediaInfo" class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                <div>
                    <h3 id="mediaTitle" class="font-semibold text-lg"></h3>
                    <p id="mediaDetails" class="text-sm text-gray-300"></p>
                </div>
                <div id="mediaCounter" class="text-sm text-gray-300">
                    <!-- Counter will be inserted here -->
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Google Drive API -->
    <script src="https://apis.google.com/js/api.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <script>
        // Google Drive Configuration - Pilih salah satu metode

        // METODE 1: API KEY (Buat API Key baru)
        const API_KEY = 'AIzaSyDIbromU2X6F6JFYrPEyFDFNCJddQqSCbA'; // Ganti dengan API Key baru

        // METODE 2: OAuth Client ID (Gunakan yang sudah ada)
        const CLIENT_ID = '951085626727-av31pqhqmq4rp7tfs4pn6vr19c2cvl1s.apps.googleusercontent.com';
        // const FOLDER_ID = '1bSgya57vzI8Vuh4ACRiuYDs64FfeZORj';

        let mediaItems = [];
        let gapi;
        let isSignedIn = false;

        let currentFilter = 'all';
        let currentMediaIndex = 0;
        let filteredMedia = mediaItems;

        // DOM elements
        const mediaGrid = document.getElementById('mediaGrid');
        const searchInput = document.getElementById('searchInput');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const mediaModal = document.getElementById('mediaModal');
        const modalContent = document.getElementById('modalContent');
        const mediaInfo = document.getElementById('mediaInfo');
        const mediaTitle = document.getElementById('mediaTitle');
        const mediaDetails = document.getElementById('mediaDetails');
        const mediaCounter = document.getElementById('mediaCounter');
        const closeModal = document.getElementById('closeModal');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const downloadBtn = document.getElementById('downloadBtn');
        const refreshBtn = document.getElementById('refreshBtn');

        // Initialize Google Drive API
        function initializeGapi() {
            gapi.load('client:auth2', initializeGapiClient);
        }

        async function initializeGapiClient() {
            try {
                await gapi.client.init({
                    apiKey: API_KEY || '',
                    clientId: CLIENT_ID,
                    discoveryDocs: ['https://www.googleapis.com/discovery/v1/apis/drive/v3/rest'],
                    scope: 'https://www.googleapis.com/auth/drive.readonly'
                });

                // Check sign-in status
                const authInstance = gapi.auth2.getAuthInstance();
                isSignedIn = authInstance.isSignedIn.get();

                if (isSignedIn || API_KEY !== 'YOUR_API_KEY_HERE') {
                    await loadMediaFromDrive();
                } else {
                    showSignInButton();
                }

                renderMedia();
                setupEventListeners();
            } catch (error) {
                console.error('Error initializing Google API:', error);
                showErrorState('Gagal menghubungkan ke Google Drive. Menggunakan data sample.');
                loadSampleData();
                renderMedia();
                setupEventListeners();
            }
        }

        function showSignInButton() {
            const signInBtn = document.getElementById('signInBtn');
            signInBtn.classList.remove('hidden');
            signInBtn.onclick = signIn;
        }

        function signIn() {
            const authInstance = gapi.auth2.getAuthInstance();
            authInstance.signIn().then(() => {
                isSignedIn = true;
                document.getElementById('signInBtn').classList.add('hidden');
                loadMediaFromDrive();
            });
        }

        // Load media files from Google Drive
        async function loadMediaFromDrive() {
            const loadingState = document.getElementById('loadingState');
            const galleryContainer = document.getElementById('galleryContainer');

            // Show loading
            loadingState.classList.remove('hidden');
            galleryContainer.classList.add('hidden');

            try {
                const response = await gapi.client.drive.files.list({
                    q: `'${FOLDER_ID}' in parents and trashed=false and (mimeType contains 'image/' or mimeType contains 'video/')`,
                    fields: 'files(id,name,mimeType,size,modifiedTime,webContentLink,webViewLink,thumbnailLink)',
                    orderBy: 'modifiedTime desc'
                });

                const files = response.result.files;
                mediaItems = files.map(file => ({
                    id: file.id,
                    type: file.mimeType.startsWith('image/') ? 'image' : 'video',
                    url: `https://drive.google.com/uc?export=view&id=${file.id}`,
                    thumbnail: file.thumbnailLink ||
                        `https://drive.google.com/thumbnail?id=${file.id}&sz=w400-h300-c`,
                    title: file.name.replace(/\.[^/.]+$/, ""), // Remove extension
                    size: formatFileSize(file.size),
                    date: formatDate(file.modifiedTime),
                    filename: file.name,
                    downloadUrl: file.webContentLink
                }));

                filteredMedia = [...mediaItems];

            } catch (error) {
                console.error('Error loading files from Drive:', error);
                showErrorState('Gagal memuat file dari Google Drive');
            } finally {
                loadingState.classList.add('hidden');
                galleryContainer.classList.remove('hidden');
            }
        }

        // Helper functions
        function formatFileSize(bytes) {
            if (!bytes) return 'Unknown size';
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(1024));
            return Math.round(bytes / Math.pow(1024, i) * 100) / 100 + ' ' + sizes[i];
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID');
        }

        function showErrorState(message) {
            const emptyState = document.getElementById('emptyState');
            const galleryContainer = document.getElementById('galleryContainer');

            emptyState.querySelector('h3').textContent = 'Error';
            emptyState.querySelector('p').textContent = message;

            galleryContainer.classList.add('hidden');
            emptyState.classList.remove('hidden');
        }

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Google API
            if (typeof gapi !== 'undefined') {
                initializeGapi();
            } else {
                // Fallback: load sample data if Google API fails
                console.warn('Google API not loaded, using sample data');
                loadSampleData();
                renderMedia();
                setupEventListeners();
            }
        });

        // Sample data sebagai fallback
        function loadSampleData() {
            mediaItems = [{
                    id: 1,
                    type: 'image',
                    url: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&crop=center',
                    thumbnail: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop&crop=center',
                    title: 'Pemandangan Gunung',
                    size: '2.4 MB',
                    date: '2024-01-15',
                    filename: 'gunung.jpg'
                },
                {
                    id: 2,
                    type: 'video',
                    url: 'https://sample-videos.com/zip/10/mp4/SampleVideo_1280x720_1mb.mp4',
                    thumbnail: 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=400&h=300&fit=crop&crop=center',
                    title: 'Video Sample',
                    size: '5.1 MB',
                    date: '2024-01-14',
                    filename: 'video-sample.mp4'
                }
            ];
            filteredMedia = [...mediaItems];
        }

        function setupEventListeners() {
            // Filter buttons
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentFilter = this.dataset.filter;
                    filterMedia();
                });
            });

            // Search
            searchInput.addEventListener('input', function() {
                filterMedia();
            });

            // Modal controls
            closeModal.addEventListener('click', closeMediaModal);
            prevBtn.addEventListener('click', showPreviousMedia);
            nextBtn.addEventListener('click', showNextMedia);
            downloadBtn.addEventListener('click', downloadCurrentMedia);
            refreshBtn.addEventListener('click', refreshGallery);

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (!mediaModal.classList.contains('hidden')) {
                    switch (e.key) {
                        case 'Escape':
                            closeMediaModal();
                            break;
                        case 'ArrowLeft':
                            showPreviousMedia();
                            break;
                        case 'ArrowRight':
                            showNextMedia();
                            break;
                    }
                }
            });

            // Close modal when clicking backdrop
            mediaModal.addEventListener('click', function(e) {
                if (e.target === mediaModal) {
                    closeMediaModal();
                }
            });
        }

        function renderMedia() {
            mediaGrid.innerHTML = '';

            filteredMedia.forEach((item, index) => {
                const mediaElement = document.createElement('div');
                mediaElement.className = 'media-item';
                mediaElement.onclick = () => openMediaModal(index);

                const isVideo = item.type === 'video';

                mediaElement.innerHTML = `
                <div class="relative">
                    <img src="${item.thumbnail}" alt="${item.title}" class="w-full h-48 object-cover">
                    ${isVideo ? `
                                <div class="video-overlay">
                                    <div class="play-button">
                                        <svg class="w-8 h-8 text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            ` : ''}
                    <div class="absolute top-2 right-2">
                        <span class="bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">
                            ${item.type.toUpperCase()}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 truncate">${item.title}</h3>
                    <p class="text-sm text-gray-600 mt-1">${item.size} • ${item.date}</p>
                </div>
            `;

                mediaGrid.appendChild(mediaElement);
            });

            // Show empty state if no media
            const emptyState = document.getElementById('emptyState');
            const galleryContainer = document.getElementById('galleryContainer');

            if (filteredMedia.length === 0) {
                galleryContainer.classList.add('hidden');
                emptyState.classList.remove('hidden');
            } else {
                galleryContainer.classList.remove('hidden');
                emptyState.classList.add('hidden');
            }
        }

        function filterMedia() {
            const searchTerm = searchInput.value.toLowerCase();

            filteredMedia = mediaItems.filter(item => {
                const matchesFilter = currentFilter === 'all' || item.type === currentFilter;
                const matchesSearch = item.title.toLowerCase().includes(searchTerm) ||
                    item.filename.toLowerCase().includes(searchTerm);
                return matchesFilter && matchesSearch;
            });

            renderMedia();
        }

        function openMediaModal(index) {
            currentMediaIndex = index;
            const item = filteredMedia[index];

            // Update modal content
            if (item.type === 'image') {
                modalContent.innerHTML = `
                <img src="${item.url}" alt="${item.title}" class="max-w-full max-h-full object-contain rounded-lg">
            `;
            } else if (item.type === 'video') {
                modalContent.innerHTML = `
                <video controls class="max-w-full max-h-full rounded-lg" autoplay>
                    <source src="${item.url}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            `;
            }

            // Update info panel
            mediaTitle.textContent = item.title;
            mediaDetails.textContent = `${item.size} • ${item.date} • ${item.filename}`;
            mediaCounter.textContent = `${index + 1} dari ${filteredMedia.length}`;

            // Show navigation buttons only if more than 1 item
            if (filteredMedia.length > 1) {
                prevBtn.style.opacity = '0';
                nextBtn.style.opacity = '0';
                // Show on hover
                mediaModal.addEventListener('mousemove', showNavigationButtons);
            }

            // Show modal
            mediaModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function showNavigationButtons() {
            if (filteredMedia.length > 1) {
                prevBtn.style.opacity = '1';
                nextBtn.style.opacity = '1';
            }
        }

        function hideNavigationButtons() {
            prevBtn.style.opacity = '0';
            nextBtn.style.opacity = '0';
        }

        function closeMediaModal() {
            mediaModal.classList.add('hidden');
            document.body.style.overflow = 'auto';

            // Hide navigation buttons
            hideNavigationButtons();
            mediaModal.removeEventListener('mousemove', showNavigationButtons);

            // Stop video if playing
            const video = modalContent.querySelector('video');
            if (video) {
                video.pause();
                video.currentTime = 0;
            }
        }

        function showNextMedia() {
            currentMediaIndex = (currentMediaIndex + 1) % filteredMedia.length;
            openMediaModal(currentMediaIndex);
        }

        function showPreviousMedia() {
            currentMediaIndex = (currentMediaIndex - 1 + filteredMedia.length) % filteredMedia.length;
            openMediaModal(currentMediaIndex);
        }

        function downloadCurrentMedia() {
            const item = filteredMedia[currentMediaIndex];

            // For Google Drive files, use the direct download URL
            if (item.downloadUrl) {
                window.open(item.downloadUrl, '_blank');
            } else {
                // Fallback method
                const link = document.createElement('a');
                link.href = item.url;
                link.download = item.filename;
                link.target = '_blank';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }

        function refreshGallery() {
            if (typeof gapi !== 'undefined' && gapi.client) {
                loadMediaFromDrive();
            } else {
                const loadingState = document.getElementById('loadingState');
                const galleryContainer = document.getElementById('galleryContainer');

                // Show loading
                galleryContainer.classList.add('hidden');
                loadingState.classList.remove('hidden');

                // Simulate refresh
                setTimeout(() => {
                    loadingState.classList.add('hidden');
                    galleryContainer.classList.remove('hidden');
                    renderMedia();
                }, 1000);
            }
        }

        // Load Google API when script loads
        window.onload = function() {
            if (typeof gapi === 'undefined') {
                console.warn('Google API not loaded');
            }
        };
    </script>

@endsection
