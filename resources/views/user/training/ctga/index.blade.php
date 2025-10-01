<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/stc.png') }}">
    <title>Change The Game Academy - Local Fundraising & Community Mobilisation</title>
    <!-- Vite CSS & JS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .blob-orange {
            background: #FF6B47;
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            animation: morph 8s ease-in-out infinite;
        }

        .blob-blue {
            background: #00B8D4;
            border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
            animation: morph 8s ease-in-out infinite reverse;
        }

        .blob-yellow {
            background: #FFB000;
            border-radius: 40% 60% 60% 40% / 60% 30% 60% 40%;
            animation: morph 6s ease-in-out infinite;
        }

        .blob-green {
            background: #7CB342;
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            animation: morph 7s ease-in-out infinite reverse;
        }

        @keyframes morph {
            0% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
                transform: translate3d(0, 0, 0) rotateZ(0deg);
            }
            34% {
                border-radius: 70% 60% 50% 40% / 50% 60% 30% 60%;
                transform: translate3d(30px, -30px, 0) rotateZ(-5deg);
            }
            67% {
                border-radius: 100% 60% 60% 100% / 100% 100% 60% 60%;
                transform: translate3d(-20px, 20px, 0) rotateZ(5deg);
            }
            100% {
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
                transform: translate3d(0, 0, 0) rotateZ(0deg);
            }
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .glass-effect {
            backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.125);
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        .ctga-orange {
            color: #FF6B47;
        }

        .ctga-blue {
            color: #00B8D4;
        }

        .ctga-green {
            color: #7CB342;
        }

        .ctga-yellow {
            color: #FFB000;
        }

        .bg-ctga-orange {
            background-color: #438848;
        }

        .bg-ctga-blue {
            background-color: #00B8D4;
        }

        .bg-ctga-green {
            background-color: #7CB342;
        }

        .bg-ctga-yellow {
            background-color: #FFB000;
        }
    </style>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 overflow-x-hidden">
<!-- Header -->
<nav class="fixed top-0 left-0 right-0 z-50 glass-effect ">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <div>
                    <a href="{{route('ctga')}}">
                        <img src="{{ asset('images/satunama-ctga.jpg') }}"
                             class="h-10 w-auto sm:h-12 md:h-14 object-contain"
                             alt="CTGA Satunama Logo">
                    </a>
                </div>
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="#about" id="link-about" class="nav-link text-gray-700 hover:text-green-500 transition-colors">Tentang
                    Kami</a>
                <a href="#cita-cita" id="link-cita-cita"
                   class="nav-link text-gray-700 hover:text-green-500 transition-colors">Cita-Cita</a>
                <a href="#programs" id="link-programs"
                   class="nav-link text-gray-700 hover:text-green-500 transition-colors">Kelas Pelatihan</a>
                <a href="#impact" id="link-impact"
                   class="nav-link text-gray-700 hover:text-green-500 transition-colors">Program</a>
                <a href="#testimonials" id="link-testimonials"
                   class="nav-link text-gray-700 hover:text-green-500 transition-colors">Testimoni</a>
            </div>
            <a
                href="{{route('detail.ctga')}}"
                class="bg-ctga-orange text-white px-6 py-2 rounded-full font-medium hover:shadow-lg transition-all duration-300">
                Daftar MS CtGA Batch 4
            </a>
        </div>
    </div>
</nav>

<!-- Hero Carousel Section -->
<section class="relative min-h-screen overflow-hidden pt-16">
    <!-- Hero Carousel Container -->
    <div class="relative h-screen">
        <!-- Carousel Track -->
        <div id="heroCarousel" class="flex transition-transform duration-500 ease-in-out h-full"
             style="transform: translateX(0%);">
            <!-- Slide 1 -->
            <div class="min-w-full h-full relative">
                <img class="w-full h-full object-cover" src="{{asset('images/ctga-8.jpg')}}">
                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            </div>

            <!-- Slide 2 -->
            <div class="min-w-full h-full relative">
                <img class="w-full h-full object-cover" src="{{asset('images/ctga-10.jpg')}}">
                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            </div>

            <!-- Slide 3 -->
            <div class="min-w-full h-full relative">
                <img class="w-full h-full object-cover" src="{{asset('images/ctga-5.jpg')}}">
                <!-- Dark Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            </div>
        </div>

        <!-- Centered Content Overlay -->
        <div class="absolute inset-0 flex items-center justify-center z-10">
            <div class="text-center px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 text-white">
                    <span style="color: #f40000;">C</span><span style="color: #58c7f1;">H</span><span
                        style="color: #7cb342;">A</span><span style="color: #ff6b47;">N</span><span
                        style="color: #f40000;">G</span><span style="color: #58c7f1;">E </span><br>THE
                    <span style="color: #58c7f1;">G</span><span style="color: #7cb342;">A</span><span
                        style="color: #f40000;">M</span><span style="color: #FF6B47FF;">E</span>
                    <br>
                    <span class="md:text-5xl font-normal" style="color: #d1d5db;">ACADEMY</span>
                    <p class="text-xl md:text-2xl font-normal" style="color: #d1d5db;">INDONESIA</p>
                </h1>
                <p class="text-base md:text-lg leading-relaxed mb-6" style="color: #e5e7eb;">
                    Memperkuat kapasitas Organisasi Masyarakat Sipil
                    melalui mobilisasi dukungan & diversifikasi pendanaan
                </p>

            </div>
            <!-- column -->
            <div class="absolute bottom-0 left-0 right-0 bg-white/90 backdrop-blur-sm border-t border-gray-100 z-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <a href="{{route('detail.ctga')}}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-center">
                            <div>
                                <div class="text-sm md:text-xl font-bold text-black">PELATIHAN TERDEKAT :</div>
                            </div>
                            <div>

                                <div class="text-sm md:text-xl font-bold text-green-500 hover:text-green-600 hover:underline transition-all duration-300 cursor-pointer">
                                    MOBILIZING SUPPORT (MS) – Batch 4
                                    <br>17 – 22 November 2025
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Carousel Navigation Arrows -->
    <button id="heroPrevBtn"
            class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-700 p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 z-30"
            style="background-color: rgba(255, 255, 255, 0.9);">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>

    <button id="heroNextBtn"
            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-700 p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 z-30"
            style="background-color: rgba(255, 255, 255, 0.9);">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>
</section>

<script>
    // Hero carousel functionality
    let currentCarouselSlide = 0;
    const carouselTrack = document.getElementById('heroCarousel');
    const carouselIndicators = document.querySelectorAll('.hero-carousel-indicator');
    const totalCarouselSlides = 3;

    function moveCarousel(slideIndex) {
        const translateX = -slideIndex * 100;
        carouselTrack.style.transform = `translateX(${translateX}%)`;

        // Update indicators
        carouselIndicators.forEach((indicator, index) => {
            if (index === slideIndex) {
                indicator.classList.remove('bg-gray-300');
                indicator.classList.add('bg-ctga-orange');
            } else {
                indicator.classList.remove('bg-ctga-orange');
                indicator.classList.add('bg-gray-300');
            }
        });

        currentCarouselSlide = slideIndex;
    }

    function nextCarouselSlide() {
        const next = (currentCarouselSlide + 1) % totalCarouselSlides;
        moveCarousel(next);
    }

    function prevCarouselSlide() {
        const prev = (currentCarouselSlide - 1 + totalCarouselSlides) % totalCarouselSlides;
        moveCarousel(prev);
    }

    // Event listeners for navigation
    document.getElementById('heroNextBtn').addEventListener('click', nextCarouselSlide);
    document.getElementById('heroPrevBtn').addEventListener('click', prevCarouselSlide);

    // Indicator click events
    carouselIndicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => moveCarousel(index));
    });

    // Auto-play carousel
    setInterval(nextCarouselSlide, 7000);

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') prevCarouselSlide();
        if (e.key === 'ArrowRight') nextCarouselSlide();
    });

    // Touch/Swipe support
    let startX = 0;
    let endX = 0;

    carouselTrack.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });

    carouselTrack.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = startX - endX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                nextCarouselSlide(); // Swipe left - next slide
            } else {
                prevCarouselSlide(); // Swipe right - previous slide
            }
        }
    }
</script>

<!-- Tentang Kami Section -->
<section id="about" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Tentang Kami</h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    <strong>CHANGE THE GAME ACADEMY</strong> adalah sebuah inisiasi global yang mendedikasikan diri
                    untuk memperkuat
                    Organisasi Masyarakat Sipil. Sejak tahun 2015, program ini mendorong penguatan kapasitas lembaga
                    melalui pelatihan-pelatihan di berbagai belahan dunia. Saat ini, anggota aliansi Change the Game
                    Academy berjumlah 15 negara.
                </p>

                <div class="space-y-6">
                    <div class="border-l-4 border-ctga-orange pl-6">
                        <p class="text-gray-600">
                            Pada tahun 2022, Yayasan SATUNAMA bergabung ke dalam aliansi global, dan menjadi lembaga
                            penyelenggara kelas-kelas pelatihan di wilayah Republik Indonesia.
                        </p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div
                    class="card-hover bg-gradient-to-br from-orange-50 to-blue-50 p-6 rounded-3xl border border-orange-100 max-w-3xl mx-auto">
                    <div class="relative w-full aspect-video">
                        <iframe
                            class="w-full h-full rounded-2xl"
                            src="https://www.youtube.com/embed/nXa1ZrGTH-M?autoplay=1&mute=1&rel=0"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>


                <!-- Decorative elements -->
                <img src="{{asset('images/Picture9.png')}}" class="absolute -top-6 -right-6 w-12 h-12">
                <img src="{{asset('images/Picture8.png')}}" class="absolute -bottom-6 -left-6 w-8 h-8">
            </div>
        </div>
    </div>
</section>

<section id="cita-cita" class="py-20 bg-white">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="text-center mb-16">
            <div class="inline-block">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 relative">
                    Cita-cita
                </h2>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border-l-4 border-green-600">
            <h3 class="text-2xl font-bold text-gray-900 mb-8">
                Aliansi Change the Game Academy memiliki cita-cita bersama bagi Organisasi Masyarakat Sipil:
            </h3>

            <div class="space-y-6">
                <div class="flex gap-4 group hover:translate-x-2 transition-transform duration-300">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-lg flex items-center justify-center text-white font-bold shadow-lg">
                        1
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-700 leading-relaxed text-lg">
                            Organisasi Masyarakat Sipil (OMS) memiliki <span class="font-semibold text-green-600">skema diversifikasi pendanaan</span>
                            untuk mendukung kerja-kerjanya dalam memperjuangkan kepentingan komunitas.
                        </p>
                    </div>
                </div>

                <div class="flex gap-4 group hover:translate-x-2 transition-transform duration-300">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-lg flex items-center justify-center text-white font-bold shadow-lg">
                        2
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-700 leading-relaxed text-lg">
                            Organisasi Masyarakat Sipil (OMS) memiliki <span class="font-semibold text-green-600">kapasitas dalam berkolaborasi</span>
                            dengan berbagai pemangku kepentingan dalam memperjuangkan kepentingan komunitas melalui
                            kerja sama yang relevan.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative elements -->
        <div class="absolute top-10 right-10 w-20 h-20 bg-green-200 rounded-full opacity-20 blur-xl"></div>
        <div class="absolute bottom-10 left-10 w-32 h-32 bg-green-300 rounded-full opacity-20 blur-2xl"></div>
    </div>
</section>

<!-- What We Offer -->
<section id="programs" class="py-20 bg-gradient-to-br from-gray-50 to-green-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Kelas Pelatihan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Change the Game Academy (CtGA) di Indonesia menawarkan 2 pelatihan bagi Organisasi Masyarakat Sipil:
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 items-start">
            <div class="space-y-8">
                <div class="card-hover bg-white p-8 rounded-3xl shadow-lg border border-blue-100">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-ctga-blue rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Penggalangan Dana Lokal (Local
                                Fundraising)</h3>
                            <p class="text-gray-600">“Menopang Misi, Merawat Organisasi”
                                Kelas intensif tatap muka (offline) selama 5 hari. Membantu OMS memetakan
                                potensi-potensi pendanaan lembaga, dan merancang program penggalangan dana.</p>
                        </div>
                    </div>
                </div>

                <div class="card-hover bg-white p-8 rounded-3xl shadow-lg border border-orange-100">
                    <div class="flex items-start space-x-4">
                        <div
                            class="w-12 h-12 bg-ctga-orange rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Mobilisasi Dukungan (Mobilizing
                                Support)</h3>
                            <p class="text-gray-600">“Aksi Bersama, Dampak Luar Biasa”
                                Kelas intensif tatap muka (offline) selama 6 hari. Membantu OMS mengenali dan memetakan
                                berbagai pemangku kepentingan, dan merancang rencana & strategi pelibatan pemangku
                                kepentingan di dalam program lembaga.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-hover bg-white p-8 rounded-3xl shadow-lg">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Keunggulan Pelatihan Change The Game Academy</h3>
                <div class="space-y-6">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-ctga-blue rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">1</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Tidak hanya kelas tatap muka, <strong>setiap kelas
                                    pelatihan memiliki masa trajectory selama 6 bulan.</strong> Apa maksudnya? Setelah
                                pelatihan tatap muka, OMS peserta akan mendapat akses coaching reguler dari fasilitator
                                pelatihan, serta mendiskusikan berbagai hal terkait implementasi pelatihan di kerja
                                nyata.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-ctga-orange rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">2</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm"><strong>Kelas Intensif.</strong> Di setiap batch kelas
                                pelatihan, ada penerapan seleksi dan kuota peserta pelatihan, untuk memastikan proses
                                berjalan efektif, interaktif, dan dapat dipahami oleh setiap peserta.</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-ctga-green rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">3</span>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm"><strong>Modul pelatihan berskala internasional</strong>
                                (CtGA Global) yang telah diterjemahkan dan di kontekstualisasikan bagi OMS di Indonesia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="impact" class="py-20 bg-gradient-to-b from-orange-50 via-white to-blue-50">
    <div class="max-w-6xl mx-auto px-6">

        <!-- TERBARU -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 tracking-tight">✨ Terbaru</h2>
            <div class="bg-white border border-gray-200 rounded-2xl shadow-lg overflow-hidden mb-6">
                <img src="{{asset('images/banner-ctga.jpg')}}" class="w-full h-full object-cover object-center" alt="Banner CTGA">
            </div>
            <a href="{{route('detail.ctga')}}"
               class="inline-block px-8 py-3 bg-green-600 text-white font-semibold rounded-xl shadow hover:shadow-lg hover:scale-105 transition transform">
                Daftar Sekarang
            </a>
        </div>

        <!-- STATISTIK -->
        <div class="text-center mb-3">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-10">📊 Statistik</h2>
                <p class="text-lg text-gray-700 leading-relaxed mb-5">
                   Pelatihan Change the Game Academy tahun 2023 - saat ini.
                </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 mx-auto mb-4 flex items-center justify-center bg-orange-100 text-orange-600 rounded-full">
                        <!-- Icon buku -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 6V4m0 16v-2m-6-6h2m10 0h2m-7-7h0m0 14h0m0-7h0"/>
                        </svg>
                    </div>
                    <p class="text-4xl font-bold text-orange-600">10</p>
                    <p class="mt-2 text-gray-600">Kelas Pelatihan</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 mx-auto mb-4 flex items-center justify-center bg-blue-100 text-blue-600 rounded-full">
                        <!-- Icon gedung -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 21h18M9 8h6v13H9zM5 21V8h14v13"/>
                        </svg>
                    </div>
                    <p class="text-4xl font-bold text-blue-600">50+</p>
                    <p class="mt-2 text-gray-600">Lembaga peserta pelatihan</p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow hover:shadow-xl transition transform hover:-translate-y-1">
                    <div
                        class="w-12 h-12 mx-auto mb-4 flex items-center justify-center bg-green-100 text-green-600 rounded-full">
                        <!-- Icon user -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A8 8 0 1118.364 4.561M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <p class="text-4xl font-bold text-green-600">100+</p>
                    <p class="mt-2 text-gray-600">Individu peserta pelatihan</p>
                </div>

            </div>
        </div>

        <!-- FASILITATOR -->
        <div class="text-center max-w-4xl mx-auto mt-5">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 mt-5">👩‍🏫 Fasilitator</h2>
            <p class="text-lg text-gray-700 leading-relaxed">
                Setiap kelas dipandu oleh <span class="font-semibold text-orange-600">2–3 fasilitator</span> pelatihan
                CtGA bersertifikat,
                yang telah mendapatkan pendidikan oleh <em>Master Trainers</em> dari aliansi
                <span class="font-semibold text-blue-600">Change the Game Academy</span>.
            </p>
        </div>

    </div>
</section>

<!-- Testimonials -->
<section id="testimonials" class="py-20 bg-gray-50 text-gray-900 relative overflow-hidden">
    <!-- Decorative elements -->
    <div
        class="absolute top-10 right-10 w-20 h-20 bg-gradient-to-br from-ctga-yellow to-ctga-orange rounded-full opacity-80"></div>
    <div
        class="absolute bottom-10 left-10 w-16 h-16 bg-gradient-to-br from-ctga-orange to-red-400 rounded-full opacity-60"></div>
    {{--    <div class="absolute bottom-20 right-20 w-12 h-12 bg-ctga-orange rounded-full opacity-40"></div>--}}
    <div class="absolute bottom-20 right-20">
        <img src="{{asset('images/Picture1.png')}}" class=" w-40 h-40">
    </div>


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Testimoni</h2>
        </div>

        <div class="space-y-16">
            <!-- First Testimonial - Main Feature -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="text-6xl font-bold ctga-yellow mb-6">"</div>
                    <p class="text-l md:text-3xl text-gray-800 leading-relaxed font-light mb-8">
                        Merupakan sebuah keberuntungan bagi kami untuk mendapatkan pengetahuan seperti Mobilizing
                        Support ini. Kami telah menerapkan dan merasakan hasilnya melalui kolaborasi dengan berbagai
                        pihak. Salah satu prinsip penting yang kami ingat dalam MS adalah membangun organisasi yang
                        kredibel dan akuntabel, serta mampu mempertanggungjawabkan setiap kerja berdasarkan bukti.
                        Dengan ini, kerja- kerja kami dapat memberi dampak nyata bagi masyarakat dan komunitas tempat
                        kami berada.
                    </p>
                    <div class="text-lg">
                        <div class="font-bold text-gray-900">Heri Se</div>
                        <div class="text-gray-600">Peserta Pelatihan dari Tananua Flores</div>
                    </div>
                </div>
                <div class="order-1 lg:order-2 flex justify-center">
                    <div class="relative">
                        <div class="w-80 h-80 rounded-full overflow-hidden border-4 border-white shadow-2xl">
                            <img src="{{asset('images/testi1.png')}}" class="w-full h-full">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Testimonial -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-80 h-80 rounded-full overflow-hidden border-4 border-white shadow-2xl">
                            <img src="{{asset('images/testi2.png')}}" class="w-full h-full">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="text-6xl font-bold ctga-yellow mb-6">"</div>
                    <p class="text-l md:text-3xl text-gray-800 leading-relaxed font-light mb-8">
                        Setelah mengikuti dan mengimplementasikan ilmu-ilmu dalam pelatihan Mobilizing Support (MS)
                        selama 1 tahun ini tentu ada perubahan yang nyata pada pribadi saya dan bisa saya tularkan
                        kepada rekan-rekan satu organisasi kita. Harapannya, dengan MS ini, ke depannya kami bisa
                        menghimpun seluruh dukungan dari semua pihak untuk mendukung semua kerja-kerja nyata di tingkat
                        tapak.
                    </p>
                    <div class="text-lg">
                        <div class="font-bold text-gray-900">Ridho Iskandar</div>
                        <div class="text-gray-600">Peserta Pelatihan dari Setara Jambi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="flex justify-center">
        <!-- Inspirasi Section -->
        <div class="bg-gradient-to-br from-green-50 to-white rounded-xl p-8 mb-8 border border-green-100">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                <i class="fas fa-lightbulb text-green-600"></i>
                INSPIRASI
            </h3>

            <div class="space-y-4">
                <!-- Video Link -->
                <div class="flex items-start gap-3 group">
                    <i class="fas fa-play-circle text-green-600 mt-1 group-hover:text-green-700"></i>
                    <a href="https://www.youtube.com/watch?v=6IJRKUNlnxM"
                       target="_blank"
                       class="text-gray-700 hover:text-green-600 transition-colors duration-200">
                        Sempena Kolaborasi
                    </a>
                </div>

                <!-- Article Links -->
                <div class="flex items-start gap-3 group">
                    <i class="fas fa-link text-green-600 mt-1 group-hover:text-green-700"></i>
                    <a href="http://satunama.org/8930/integrasi-layanan-kesehatan-dan-penggalangan-dana-lokal-sebagai-strategi-pemberdayaan/"
                       target="_blank"
                       class="text-gray-700 hover:text-green-600 transition-colors duration-200">
                        Integrasi Layanan Kesehatan dan Penggalangan Dana Lokal sebagai Strategi Pemberdayaan
                    </a>
                </div>

                <div class="flex items-start gap-3 group">
                    <i class="fas fa-link text-green-600 mt-1 group-hover:text-green-700"></i>
                    <a href="http://satunama.org/8858/local-fundraising-batch-vii-menguatkan-komunitas-meningkatkan-komunikasi-dan-mendorong-perubahan-sosial/"
                       target="_blank"
                       class="text-gray-700 hover:text-green-600 transition-colors duration-200">
                        Local Fundraising Batch VII: Menguatkan Komunitas, Meningkatkan Komunikasi dan Mendorong
                        Perubahan Sosial
                    </a>
                </div>

                <!-- More Link -->
                <div class="flex items-start gap-3 group mt-6">
                    <i class="fas fa-arrow-right text-green-600 mt-1 group-hover:text-green-700"></i>
                    <a href="https://satunama.org/tag/change-the-game-academy/"
                       target="_blank"
                       class="text-green-600 font-semibold hover:text-green-700 transition-colors duration-200 flex items-center gap-2">
                        More...
                        <i class="fas fa-external-link-alt text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Photo Gallery Slideshow -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Galeri Pelatihan</h2>
            <p class="text-base md:text-xl text-gray-600 max-w-2xl mx-auto">
                Galeri dari pelatihan CtGA yang telah dilaksanakan
            </p>
        </div>

        <div class="relative max-w-4xl mx-auto">
            <!-- Main Slideshow Container -->
            <div class="relative w-full aspect-video md:h-[500px] rounded-3xl overflow-hidden shadow-2xl">
                <!-- Slides -->
                <div id="slide1" class="slide absolute inset-0 transition-opacity duration-1000 opacity-100">
                    <img src="{{asset('images/ctga-9.jpg')}}" alt="Learning Together"
                         class="w-full h-full object-cover"/>
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

                <div id="slide2" class="slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                    <img src="{{asset('images/ctga-2.jpg')}}" alt="Learning Together"
                         class="w-full h-full object-cover"/>
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

                <div id="slide3" class="slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                    <img src="{{asset('images/ctga-10.jpg')}}" alt="Learning Together"
                         class="w-full h-full object-cover"/>
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

                <div id="slide4" class="slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                    <img src="{{asset('images/ctga-13.jpg')}}" alt="Learning Together"
                         class="w-full h-full object-cover"/>
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

                <div id="slide5" class="slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                    <img src="{{asset('images/ctga-3.jpg')}}" alt="Learning Together"
                         class="w-full h-full object-cover"/>
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

                <div id="slide6" class="slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                    <img src="{{asset('images/ctga-4.jpg')}}" alt="Learning Together"
                         class="w-full h-full object-cover"/>
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button id="prevBtn"
                    class="absolute left-3 md:left-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-700 p-2 md:p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 z-20">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button id="nextBtn"
                    class="absolute right-3 md:right-4 top-1/2 transform -translate-y-1/2 bg-white/90 hover:bg-white text-gray-700 p-2 md:p-3 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 z-20">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Slide Indicators -->
            <div class="flex justify-center mt-6 space-x-2 md:space-x-3">
                <button class="indicator w-2 h-2 md:w-3 md:h-3 rounded-full bg-ctga-orange transition-all duration-300"
                        data-slide="0"></button>
                <button class="indicator w-2 h-2 md:w-3 md:h-3 rounded-full bg-gray-300 hover:bg-gray-400"
                        data-slide="1"></button>
                <button class="indicator w-2 h-2 md:w-3 md:h-3 rounded-full bg-gray-300 hover:bg-gray-400"
                        data-slide="2"></button>
                <button class="indicator w-2 h-2 md:w-3 md:h-3 rounded-full bg-gray-300 hover:bg-gray-400"
                        data-slide="3"></button>
                <button class="indicator w-2 h-2 md:w-3 md:h-3 rounded-full bg-gray-300 hover:bg-gray-400"
                        data-slide="4"></button>
                <button class="indicator w-2 h-2 md:w-3 md:h-3 rounded-full bg-gray-300 hover:bg-gray-400"
                        data-slide="5"></button>
            </div>
        </div>
    </div>
</section>


<script>
    // Slideshow functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');
    const totalSlides = slides.length;

    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => slide.classList.remove('opacity-100'));
        slides.forEach(slide => slide.classList.add('opacity-0'));

        // Show current slide
        slides[index].classList.remove('opacity-0');
        slides[index].classList.add('opacity-100');

        // Update indicators
        indicators.forEach(indicator => {
            indicator.classList.remove('bg-ctga-orange');
            indicator.classList.add('bg-gray-300');
        });
        indicators[index].classList.remove('bg-gray-300');
        indicators[index].classList.add('bg-ctga-orange');

        currentSlide = index;
    }

    function nextSlide() {
        const next = (currentSlide + 1) % totalSlides;
        showSlide(next);
    }

    function prevSlide() {
        const prev = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(prev);
    }

    // Event listeners
    document.getElementById('nextBtn').addEventListener('click', nextSlide);
    document.getElementById('prevBtn').addEventListener('click', prevSlide);

    // Indicator click events
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => showSlide(index));
    });

    // Auto-play slideshow
    setInterval(nextSlide, 5000);

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') prevSlide();
        if (e.key === 'ArrowRight') nextSlide();
    });
</script>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-green-600 via-green-400 to-green-600 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl md:text-6xl font-bold mb-6">
            Hubungi Kami
        </h2>
        <p class="text-xl md:text-2xl mb-8 text-green-100">
            Tertarik mempelajari lebih lanjut, mendukung, bergabung dengan jaringan mitra, atau mendaftar kursus kami?
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            <a href="{{route('detail.ctga')}}"
               class="bg-white text-green-600 px-10 py-4 rounded-2xl text-lg font-bold hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                Bergabung
            </a>
        </div>

        <div class="space-y-4">
            <p class="text-lg">
                <strong>Email:</strong> training@satunama.org
            </p>
            <p class="text-lg">
                <strong>Website:</strong> https://training.satunama.org
            </p>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-white text-black py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-3 mb-6 md:mb-0">
                <img src="{{asset('images/satunama-ctga.jpg')}}" class="w-50 h-12">
            </div>

            <div class="text-center md:text-right">
                <p class="text-gray-400 text-sm">
                    © 2025 Yayasan SATUNAMA Yogyakarta
                </p>
            </div>
        </div>
    </div>
</footer>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sections = document.querySelectorAll("section");
        const navLinks = document.querySelectorAll(".nav-link");

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    const id = entry.target.getAttribute("id");
                    const link = document.getElementById("link-" + id);

                    if (entry.isIntersecting) {
                        navLinks.forEach((l) =>
                            l.classList.remove("text-green-500", "font-semibold", "border-b-2", "border-green-500")
                        );
                        link.classList.add("text-green-500", "font-semibold", "border-b-2", "border-green-500");
                    }
                });
            },
            {threshold: 0.6} // aktif kalau 60% section terlihat
        );

        sections.forEach((section) => {
            observer.observe(section);
        });
    });
</script>
</body>
</html>
