<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MS CtGA 2025 - STC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#36753e',
                        secondary: '#d4c74d',
                        accent: '#F7931E',
                        dark: '#1A1A1A',
                        light: '#F8F9FA'
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #c5c6e9 0%, #36753e 100%);
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div
                        class="w-10 h-10 flex items-center justify-center">
                        <img src="{{ asset('images/stc.png') }}" alt="Hero Image">
                    </div>
                    {{-- <span class="text-xl font-bold text-dark">Re.Search</span> --}}
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-green-700 transition-colors">Beranda</a>
                    <a href="#about" class="text-gray-700 hover:text-green-700 transition-colors">Tentang</a>
                    <a href="#program" class="text-gray-700 hover:text-green-700 transition-colors">Program</a>
                    <a href="#timeline" class="text-gray-700 hover:text-green-700 transition-colors">Timeline</a>
                    <a href="#contact" class="text-gray-700 hover:text-green-700 transition-colors">Kontak</a>
                    <button class="bg-green-800 text-white px-6 py-2 rounded-full hover:bg-green-700 transition-colors">
                        Daftar Sekarang
                    </button>
                </div>

                <div class="md:hidden">
                    <button class="text-gray-700 hover:text-green-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen gradient-bg flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>

        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full floating-animation"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-accent/20 rounded-lg floating-animation"
            style="animation-delay: -2s;"></div>
        <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-secondary/30 rounded-full floating-animation"
            style="animation-delay: -4s;"></div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center text-white">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                    MS CtGA
                    <span class="block text-accent">2025</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90 leading-relaxed">
                    Bergabunglah dalam program inovasi terdepan untuk mengembangkan ide-ide revolusioner dan menciptakan
                    solusi masa depan
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button
                        class="bg-white text-green-700 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-lg">
                        Mulai Perjalanan Inovasi
                    </button>
                    <button
                        class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-green-700 transition-all duration-300">
                        Lihat Guidline Pendaftaran
                    </button>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                </path>
            </svg>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-dark mb-6">Tentang MS CtGA 2025</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Program komprehensif yang menggabungkan pembelajaran online dan offline untuk mengembangkan
                        inovator masa depan
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-16 items-center">
                    <div class="space-y-8">
                        <div class="space-y-4">
                            <h3 class="text-2xl font-bold text-dark">Format Hybrid Learning</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Program ini akan dilaksanakan secara Online dan Offline. Peserta diharapkan hadir secara
                                fisik sebanyak tiga sesi, yaitu dua sesi pada pelaksanaan Masterclass yang akan
                                dilaksanakan bulan Juni - Juli, serta satu sesi pada Demo Day yang akan dilaksanakan di
                                bulan September.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-primary/10 to-secondary/10 p-6 rounded-2xl">
                                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-dark mb-2">Inovasi Terdepan</h4>
                                <p class="text-sm text-gray-600">Teknologi dan metodologi terbaru dalam pengembangan
                                    produk</p>
                            </div>

                            <div class="bg-gradient-to-br from-secondary/10 to-accent/10 p-6 rounded-2xl">
                                <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-dark mb-2">Komunitas Global</h4>
                                <p class="text-sm text-gray-600">Networking dengan inovator dari berbagai industri</p>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div
                            class="bg-gradient-to-br from-primary to-secondary rounded-3xl p-8 text-white transform hover:scale-105 transition-transform duration-300">
                            <div class="space-y-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold">Bootcamp Intensif</h4>
                                        <p class="opacity-90">3 Bulan Program</p>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex justify-between items-center">
                                        <span>Masterclass Sessions</span>
                                        <span class="font-bold">2x</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span>Demo Day</span>
                                        <span class="font-bold">1x</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span>Virtual Sessions</span>
                                        <span class="font-bold">Unlimited</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Features -->
    <section id="program" class="py-20 bg-gradient-to-br from-light to-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-dark mb-6">Program Unggulan</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Kurikulum yang dirancang khusus untuk mengembangkan kemampuan inovasi dan entrepreneurship
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-shadow duration-300 group">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-primary to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-dark mb-4">Design Thinking</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Metodologi inovatif untuk memahami kebutuhan pengguna dan mengembangkan solusi yang tepat
                            sasaran
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>User Research & Empathy Mapping</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>Ideation & Brainstorming</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>Prototyping & Testing</span>
                            </li>
                        </ul>
                    </div>

                    <div
                        class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-shadow duration-300 group">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-secondary to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-dark mb-4">Business Model</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Strategi bisnis komprehensif untuk mengubah ide inovatif menjadi venture yang berkelanjutan
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>Lean Canvas Development</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>Revenue Model Strategy</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>Market Validation</span>
                            </li>
                        </ul>
                    </div>

                    <div
                        class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-shadow duration-300 group">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-accent to-yellow-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-9 0V3a1 1 0 011-1h8a1 1 0 011 1v1M7 4l1 16h8l1-16M7 4h10">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-dark mb-4">Tech Implementation</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Implementasi teknologi terdepan untuk mewujudkan solusi inovatif yang scalable dan
                            sustainable
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>MVP Development</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>Agile Development</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-accent" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span>Digital Product Launch</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section id="timeline" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-dark mb-6">Timeline Program</h2>
                    <p class="text-xl text-gray-600">
                        Jadwal lengkap kegiatan Innovation Lab 2025
                    </p>
                </div>

                <div class="relative">
                    <!-- Timeline Line -->
                    <div
                        class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-primary to-secondary">
                    </div>

                    <!-- Timeline Items -->
                    <div class="space-y-12">
                        <!-- Juni-Juli: Masterclass -->
                        <div class="relative flex items-center">
                            <div class="w-1/2 pr-8 text-right">
                                <div class="bg-gradient-to-br from-primary/10 to-primary/5 p-6 rounded-2xl">
                                    <h3 class="text-xl font-bold text-dark mb-2">Masterclass Sessions</h3>
                                    <p class="text-gray-600 mb-3">Dua sesi pembelajaran intensif dengan para ahli
                                        industri</p>
                                    <span class="bg-primary text-white px-3 py-1 rounded-full text-sm font-medium">Juni
                                        - Juli 2025</span>
                                </div>
                            </div>
                            <div
                                class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-primary rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <div class="w-1/2 pl-8"></div>
                        </div>

                        <!-- Agustus: Development Phase -->
                        <div class="relative flex items-center">
                            <div class="w-1/2 pr-8"></div>
                            <div
                                class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-secondary rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="w-1/2 pl-8">
                                <div class="bg-gradient-to-br from-secondary/10 to-secondary/5 p-6 rounded-2xl">
                                    <h3 class="text-xl font-bold text-dark mb-2">Development Phase</h3>
                                    <p class="text-gray-600 mb-3">Pengembangan produk dan implementasi teknologi secara
                                        virtual</p>
                                    <span
                                        class="bg-secondary text-white px-3 py-1 rounded-full text-sm font-medium">Agustus
                                        2025</span>
                                </div>
                            </div>
                        </div>

                        <!-- September: Demo Day -->
                        <div class="relative flex items-center">
                            <div class="w-1/2 pr-8 text-right">
                                <div class="bg-gradient-to-br from-accent/10 to-accent/5 p-6 rounded-2xl">
                                    <h3 class="text-xl font-bold text-dark mb-2">Demo Day</h3>
                                    <p class="text-gray-600 mb-3">Presentasi final dan showcase produk inovatif kepada
                                        investor</p>
                                    <span
                                        class="bg-accent text-white px-3 py-1 rounded-full text-sm font-medium">September
                                        2025</span>
                                </div>
                            </div>
                            <div
                                class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-accent rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                    </path>
                                </svg>
                            </div>
                            <div class="w-1/2 pl-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gradient-to-br from-dark to-gray-800 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">Dampak Innovation Lab</h2>
                    <p class="text-xl opacity-90 max-w-3xl mx-auto">
                        Track record kesuksesan program inovasi kami dalam menghasilkan startup dan solusi berkelanjutan
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-accent mb-2" id="counter1">500+</div>
                        <p class="text-gray-300">Alumni Inovator</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-primary mb-2" id="counter2">150+</div>
                        <p class="text-gray-300">Startup Terbentuk</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-secondary mb-2" id="counter3">$2M+</div>
                        <p class="text-gray-300">Funding Terkumpul</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl md:text-5xl font-bold text-green-400 mb-2" id="counter4">85%</div>
                        <p class="text-gray-300">Success Rate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-dark mb-6">Kata Alumni</h2>
                    <p class="text-xl text-gray-600">
                        Testimoni dari para inovator yang telah sukses melalui program kami
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-br from-primary/5 to-primary/10 p-8 rounded-3xl">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-primary to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                A
                            </div>
                            <div>
                                <h4 class="font-bold text-dark">Andi Prasetyo</h4>
                                <p class="text-gray-600 text-sm">CEO, TechStart Indonesia</p>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            "Program ini benar-benar mengubah cara pandang saya tentang inovasi. Dari ide sederhana,
                            kini startup saya telah mendapat funding seed round sebesar $500K."
                        </p>
                        <div class="flex text-accent mt-4">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-secondary/5 to-secondary/10 p-8 rounded-3xl">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-secondary to-red-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                S
                            </div>
                            <div>
                                <h4 class="font-bold text-dark">Sari Dewi</h4>
                                <p class="text-gray-600 text-sm">Founder, EcoSolution</p>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            "Metodologi design thinking yang diajarkan sangat powerful. Saya berhasil mengidentifikasi
                            pain point yang tepat dan mengembangkan solusi sustainable."
                        </p>
                        <div class="flex text-accent mt-4">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-accent/5 to-accent/10 p-8 rounded-3xl">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-accent to-yellow-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                                R
                            </div>
                            <div>
                                <h4 class="font-bold text-dark">Rahman Hakim</h4>
                                <p class="text-gray-600 text-sm">CTO, HealthTech Solutions</p>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            "Networking dan mentorship yang didapat sangat valuable. Sekarang produk kami digunakan di
                            20+ rumah sakit di Indonesia."
                        </p>
                        <div class="flex text-accent mt-4">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="contact" class="py-20 gradient-bg text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black/30"></div>

        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 border border-white rounded-full"></div>
            <div class="absolute top-40 right-20 w-24 h-24 border border-white rounded-lg rotate-45"></div>
            <div class="absolute bottom-20 left-1/3 w-20 h-20 border border-white rounded-full"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl md:text-6xl font-bold mb-6">
                    Siap Menjadi
                    <span class="text-accent">Inovator Masa Depan?</span>
                </h2>
                <p class="text-xl md:text-2xl mb-12 opacity-90 leading-relaxed">
                    Bergabunglah dengan 500+ alumni yang telah mengubah ide menjadi solusi nyata.
                    Pendaftaran Innovation Lab 2025 dibuka terbatas untuk 50 peserta terpilih.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-12">
                    <button
                        class="bg-white text-primary px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-xl">
                        Daftar Sekarang - Gratis
                    </button>
                    <button
                        class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-primary transition-all duration-300 flex items-center space-x-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <span>Hubungi Kami</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="space-y-2">
                        <div class="text-3xl font-bold text-accent">50</div>
                        <p class="opacity-90">Peserta Terpilih</p>
                    </div>
                    <div class="space-y-2">
                        <div class="text-3xl font-bold text-white">3 Bulan</div>
                        <p class="opacity-90">Program Intensif</p>
                    </div>
                    <div class="space-y-2">
                        <div class="text-3xl font-bold text-secondary">100%</div>
                        <p class="opacity-90">Hands-on Learning</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-4 gap-8 mb-12">
                    <!-- Logo & Description -->
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-2 mb-6">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-xl">R</span>
                            </div>
                            <span class="text-2xl font-bold">Re.Search</span>
                        </div>
                        <p class="text-gray-300 leading-relaxed mb-6 max-w-md">
                            Membangun ekosistem inovasi Indonesia melalui program-program berkualitas tinggi yang
                            mengembangkan talenta digital dan entrepreneurship masa depan.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="w-10 h-10 bg-gray-700 hover:bg-primary rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-gray-700 hover:bg-primary rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-gray-700 hover:bg-primary rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-gray-700 hover:bg-primary rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.758-1.378l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-lg font-bold mb-6">Quick Links</h4>
                        <ul class="space-y-3">
                            <li><a href="#about" class="text-gray-300 hover:text-white transition-colors">Tentang
                                    Program</a></li>
                            <li><a href="#program"
                                    class="text-gray-300 hover:text-white transition-colors">Kurikulum</a></li>
                            <li><a href="#timeline"
                                    class="text-gray-300 hover:text-white transition-colors">Timeline</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">FAQ</a>
                            </li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Syarat &
                                    Ketentuan</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h4 class="text-lg font-bold mb-6">Kontak</h4>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-primary mt-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-gray-300 text-sm">Yogyakarta, Indonesia</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-primary mt-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="text-gray-300 text-sm">hello@re-search.id</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-primary mt-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="text-gray-300 text-sm">+62 21 1234 5678</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="border-t border-gray-700 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <p class="text-gray-400 text-sm">
                            © 2025 SATUNAMA Training Center. All rights reserved.
                        </p>
                        <div class="flex space-x-6 text-sm">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy
                                Policy</a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of
                                Service</a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Cookie
                                Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop"
        class="fixed bottom-8 right-8 w-12 h-12 bg-primary text-white rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 transform scale-0 opacity-0">
        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18">
            </path>
        </svg>
    </button>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll to top functionality
        const scrollToTopBtn = document.getElementById('scrollToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('scale-100', 'opacity-100');
                scrollToTopBtn.classList.remove('scale-0', 'opacity-0');
            } else {
                scrollToTopBtn.classList.add('scale-0', 'opacity-0');
                scrollToTopBtn.classList.remove('scale-100', 'opacity-100');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Counter animation
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);

            function updateCounter() {
                start += increment;
                if (start < target) {
                    element.textContent = Math.floor(start) + (element.textContent.includes('+') ? '+' : '') + (element
                        .textContent.includes(') ? '
                            ' : '
                            ') + (element.textContent.includes(' % ') ? ' % ' : '
                            ');
                            requestAnimationFrame(updateCounter);
                        }
                        else {
                            element.textContent = element.textContent.includes(') ? ' + target + 'M+': target + (element
                                    .textContent.includes('+') ? '+' : '') + (element.textContent.includes('%') ?
                                    '%' : '');
                            }
                        }
                        updateCounter();
                    }

                    // Intersection Observer for counter animation
                    const counterObserver = new IntersectionObserver((entries) => {
                                entries.forEach(entry => {
                                    if (entry.isIntersecting) {
                                        const counter = entry.target;
                                        const text = counter.textContent;

                                        // Extract number from text
                                        let target;
                                        if (text.includes('500')) target = 500;
                                        else if (text.includes('150')) target = 150;
                                        else if (text.includes('$2M')) target = 2;
                                        else if (text.includes('85')) target = 85;

                                        if (target) {
                                            counter.textContent = '0' + (text.includes('+') ? '+' : '') + (text
                                                .includes(') ? '
                                                    ' : '
                                                    ') + (text.includes(' % ') ? ' % ' : '
                                                    ');
                                                    animateCounter(counter, target); counterObserver.unobserve(
                                                        counter);
                                                }
                                            }
                                        });
                                });

                                // Observe counter elements
                                document.querySelectorAll('[id^="counter"]').forEach(counter => {
                                    counterObserver.observe(counter);
                                });

                                // Mobile menu toggle (if needed)
                                const mobileMenuBtn = document.querySelector('.md\\:hidden button');
                                if (mobileMenuBtn) {
                                    mobileMenuBtn.addEventListener('click', () => {
                                        // Add mobile menu functionality here
                                        console.log('Mobile menu clicked');
                                    });
                                }

                                // Add parallax effect
                                window.addEventListener('scroll', () => {
                                    const scrolled = window.pageYOffset;
                                    const parallaxElements = document.querySelectorAll('.parallax-bg');

                                    parallaxElements.forEach(element => {
                                        const speed = 0.5;
                                        element.style.transform = `translateY(${scrolled * speed}px)`;
                                    });
                                });

                                // Add intersection observer for animations
                                const animationObserver = new IntersectionObserver((entries) => {
                                    entries.forEach(entry => {
                                        if (entry.isIntersecting) {
                                            entry.target.classList.add('animate-fade-in');
                                        }
                                    });
                                }, {
                                    threshold: 0.1
                                });

                                // Observe elements for animation
                                document.querySelectorAll('section').forEach(section => {
                                    animationObserver.observe(section);
                                });
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #036b32;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #036b32;
        }
    </style>
</body>

</html>
