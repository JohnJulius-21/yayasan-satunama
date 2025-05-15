@extends('layouts.user')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <style>
        .swiper-container {
            width: 80%;
            max-height: 800px;
            border-radius: 10px;
            overflow: hidden;
            margin: 0 auto;
            position: relative;
            display: block;

        }

        .swipper-container img {
            width: 100%;
            border-radius: 10px;
            display: block;
        }


        .swiper-slide {
            position: relative;
        }

        .slide-image {
            width: 100%;
            height: auto;
            display: block;
        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(22, 86, 22, 0.6);
            /* Hijau gelap transparan */
            display: inline-flex;
            align-items: end;
            justify-content: start;
            text-align: left;
            color: white;
            font-size: 24px;
            font-weight: bold;
            padding: 15px 20px;
        }

        /* Navigasi Swiper */
        .swiper-button-next,
        .swiper-button-prev {
            color: white;
        }

        .faq-container {
            max-width: 1300px;
            margin: 50px auto;
            padding: 10px;
        }

        .faq-title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .faq-accordion {
            background-color: #2a6d2e;
            color: #fff;
            cursor: pointer;
            padding: 15px 20px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 18px;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .faq-accordion:hover {
            background-color: #143d1b;
        }

        .faq-accordion.active {
            background-color: #194c2e;
        }

        .faq-accordion:after {
            content: '\25BC';
            /* Panah bawah */
            font-size: 14px;
            color: #ffcc00;
        }

        .faq-accordion.active:after {
            content: '\25B2';
            /* Panah atas */
        }

        .faq-panel {
            padding: 15px 20px;
            background-color: #ffffff;
            display: none;
            overflow: hidden;
            border-radius: 8px;
            border: 1px solid #ffffff;
            margin-bottom: 10px;
            box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.2);
        }

        .faq-section {
            margin-bottom: 20px;
        }

        .faq-pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .faq-page-indicator {
            font-size: 30px;
            color: #999;
            cursor: pointer;
            margin: 0 5px;
            transition: color 0.3s;
        }

        .faq-page-indicator.active {
            color: #2a6d2e;
        }
    </style>

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="slide-image" src="{{ asset('images/pelatihan1.jpg') }}" alt="Pelatihan 1">
                    <div class="overlay">SATUNAMA TRAINING CENTER </div>
                </div>
                <div class="swiper-slide">
                    <img class="slide-image" src="{{ asset('images/pelatihan2.jpg') }}" alt="Pelatihan 2">
                    <div class="overlay">SATUNAMA TRAINING CENTER </div>
                </div>
                <div class="swiper-slide">
                    <img class="slide-image" src="{{ asset('images/contact.png') }}" alt="Pelatihan 3">
                    <div class="overlay">SATUNAMA TRAINING CENTER </div>
                </div>
            </div>
            <!-- Tombol Navigasi -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <!-- Section Title -->
        <div class="container section-title mt-3" data-aos="fade-up">
            <span>Tentang Kami<br></span>
            <h2>Tentang Kami</h2>
            <p>SATUNAMA Training Center adalah ....</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                    <img src="assetss/img/about.png" class="img-fluid" alt="">
                    {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a> --}}
                </div>
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>SATUNAMA Training Center.</h3>
                    <p class="fst-italic">
                        SATUNAMA sebagai lembaga swadaya masyarakat mempunyai sejarah yang cukup panjang. Sejarah yang
                        panjang itu bermuatan perkembagan lembaga sesuai dengan dinamika internal lembaga maupun dalam
                        menanggapi perkembangan masyarakat yang dilayaninya. Maka wajar kalau SATUNAMA mempunyai modal yang
                        memadai dalam bentuk pengetahuan dan praktek yang bisa di-share ke banyak pihak melalui pelatihan
                        dan konsultasi.
                    </p>
                    <p>
                        Pelatihan dan Konsultasi yang dijalankan oleh SATUNAMA sudah berjalan selama 2 (dua) dekade dengan
                        perkembangan dan dinamikanya sendiri. Pada awalnya layanan SATUNAMA berada dalam kerangka
                        pembangunan yang langsung berkaitan dengan pengentasan dari kemiskinan. Pelatihan-pelatihan yang
                        diberikan banyak menyangkut hal-hal praktis, seperti akupuntur, ekonomi rumah tangga, dan
                        sebagainya.
                    </p>
                </div>
            </div>

        </div>

    </section><!-- /About Section -->

    <div class="faq-container" data-aos="fade-up">
        <div class="faq-title">FAQ</div>
        <hr class="container">
        <!-- FAQ Items -->
        <div class="faq-section">
            <button class="faq-accordion">Apa itu program pelatihan reguler?</button>
            <div class="faq-panel">
                <p>Program ini dirancang untuk membantu pengusaha dalam mengembangkan ide bisnis mereka melalui bimbingan
                    dan pelatihan intensif.</p>
            </div>

            <button class="faq-accordion">Apa saja yang perlu disiapkan dalam mendaftar pelatihan?</button>
            <div class="faq-panel">
                <p>Durasi program ini berlangsung selama 3 bulan dengan sesi pelatihan mingguan.</p>
            </div>
        </div>

        <div class="faq-section">
            <button class="faq-accordion">Dimana program pelatihan akan dilaksanakan?</button>
            <div class="faq-panel">
                <p>Program akan dilaksanakan secara online melalui platform Zoom dan offline di lokasi mitra kami.</p>
            </div>

            <button class="faq-accordion">Siapa saja yang bisa mendaftar pelatihan di SATUANAMA?</button>
            <div class="faq-panel">
                <p>Program ini terbuka untuk semua pengusaha yang memiliki ide bisnis atau usaha kecil yang ingin
                    dikembangkan.</p>
            </div>
        </div>

        <div class="faq-section">
            <button class="faq-accordion">Apakah program ini dipungut biaya?</button>
            <div class="faq-panel">
                <p>Tidak, program ini sepenuhnya gratis bagi peserta yang lolos seleksi.</p>
            </div>
        </div>

        <!-- Pagination Controls -->
        <div class="faq-pagination">
            <span class="faq-page-indicator" data-page="0">•</span>
            <span class="faq-page-indicator" data-page="1">•</span>
            <span class="faq-page-indicator" data-page="2">•</span>
        </div>

    </div>

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Kontak Kami</span>
            <h2>Kontak Kami</h2>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-12">

                    <div class="info-wrap">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Address</h3>
                                <p>Jl. Sambisari Jl. Duwet No.99
                                    Sleman, Daerah Istimewa Yogyakarta 55285</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Phone</h3>
                                <p>+62 822-2688-7110</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email</h3>
                                <p>training@satunama.org</p>
                            </div>
                        </div><!-- End Info Item -->

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.5880153886765!2d110.35459690948655!3d-7.727272976542171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59b8fe4e6201%3A0x15b92587dba99384!2sYayasan%20SATUNAMA%20Yogyakarta!5e0!3m2!1sen!2sid!4v1728727068306!5m2!1sen!2sid"
                            frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /Contact Section -->



    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const accordions = document.querySelectorAll(".faq-accordion");
            const faqSections = document.querySelectorAll(".faq-section");
            const pageIndicators = document.querySelectorAll(".faq-page-indicator");
            let currentPage = 0;

            // Menyembunyikan semua halaman dan hanya menampilkan halaman aktif
            function showPage(pageIndex) {
                faqSections.forEach((section, index) => {
                    section.style.display = (index === pageIndex) ? "block" : "none";
                });
                pageIndicators.forEach((indicator, index) => {
                    if (index === pageIndex) {
                        indicator.classList.add("active");
                    } else {
                        indicator.classList.remove("active");
                    }
                });
            }

            // Menambahkan event listener untuk accordion
            accordions.forEach(accordion => {
                accordion.addEventListener("click", function() {
                    // Tutup semua panel lainnya
                    accordions.forEach(acc => {
                        if (acc !== this) {
                            acc.classList.remove("active");
                            acc.nextElementSibling.style.display = "none";
                        }
                    });

                    // Toggle panel saat ini
                    this.classList.toggle("active");
                    const panel = this.nextElementSibling;
                    if (panel.style.display === "block") {
                        panel.style.display = "none";
                    } else {
                        panel.style.display = "block";
                    }
                });
            });

            // Menambahkan event listener untuk indikator pagination
            pageIndicators.forEach(indicator => {
                indicator.addEventListener("click", function() {
                    const pageIndex = parseInt(this.getAttribute("data-page"));
                    currentPage = pageIndex;
                    showPage(currentPage);
                });
            });

            // Tampilkan halaman pertama saat awal
            showPage(currentPage);
        });

        const swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade', // opsional: 'slide', 'fade', 'cube', etc
            speed: 1000,
        });
    </script>
@endsection
