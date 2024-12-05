@extends('layouts.main')

@section('content')
    <!-- About Section -->
    <div class="about-section py-5" style="background-color: #ffffff">
        <div class="container text-center">
            <h2>Tentang Kami</h2>
            <p>
                Kami menyediakan pelatihan untuk membantu organisasi masyarakat Anda menjadi lebih baik.
            </p>
            <div class="card-wrapper">
                <div class="card">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.5880153886765!2d110.35459690948655!3d-7.727272976542171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59b8fe4e6201%3A0x15b92587dba99384!2sYayasan%20SATUNAMA%20Yogyakarta!5e0!3m2!1sen!2sid!4v1728727068306!5m2!1sen!2sid"
                        width="1294" height="450" style="border:1;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Set a background color and font only for the timeline section */
        section.timeline {
            background-color: #ffffff;
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            height: 500px;
            /* Menetapkan tinggi untuk scroll */
            overflow-y: auto;
            /* Menambahkan scroll vertikal */
        }

        /* Menambahkan indikator posisi scroll */
        section.timeline::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 10px;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.1);
        }

        /* The actual timeline (the vertical ruler) */
        section.timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: rgb(204, 203, 203);
            top: 0;
            bottom: 0;
            left: 50%;
            /* Tempatkan garis vertikal di tengah */
            transform: translateX(-50%);
            /* Menambahkan transform untuk memastikan di tengah */
        }


        /* Update height of indicator based on scroll */
        section.timeline.scrolling::after {
            height: 100%;
        }

        /* The actual timeline (the vertical ruler) */
        section.timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* The actual timeline (the vertical ruler) */
        section.timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: rgb(204, 203, 203);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }

        /* Container around content */
        section.timeline .timeline-container {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }

        /* The circles on the timeline */
        section.timeline .timeline-container::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            right: -17px;
            background-color: rgb(255, 255, 255);
            border: 4px solid #FF9F55;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }

        /* Place the container to the left */
        section.timeline .left {
            left: 0;
        }

        /* Place the container to the right */
        section.timeline .right {
            left: 50%;
        }

        /* Add arrows to the left container (pointing right) */
        section.timeline .left::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            right: 30px;
            border: medium solid rgb(223, 220, 220);
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent white;
        }

        /* Add arrows to the right container (pointing left) */
        section.timeline .right::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            left: 30px;
            border: medium solid white;
            border-width: 10px 10px 10px 0;
            border-color: transparent white transparent transparent;
        }

        /* Fix the circle for containers on the right side */
        section.timeline .right::after {
            left: -16px;
        }

        /* The actual content */
        section.timeline .timeline-content {
            padding: 20px 30px;
            background-color: rgb(200, 236, 189);
            position: relative;
            border-radius: 6px;
        }

        /* Media queries - Responsive timeline on screens less than 600px wide */
        @media screen and (max-width: 600px) {

            /* Adjust vertical position of timeline ruler */
            section.timeline::after {
                left: 31px;
            }

            /* Full-width containers */
            section.timeline .timeline-container {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            /* Ensure arrows on left containers point left */
            section.timeline .timeline-container::before {
                left: 60px;
                border: medium solid white;
                border-width: 10px 10px 10px 0;
                border-color: transparent white transparent transparent;
            }

            /* Fix positions of circles on both sides */
            section.timeline .left::after,
            section.timeline .right::after {
                left: 15px;
            }

            /* Make right containers behave like the left ones */
            section.timeline .right {
                left: 0%;
            }
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

    <div class="faq-title">Timeline</div>
    <hr class="container">
    <section class="timeline">
        <div class="timeline-container left">
            <div class="timeline-content">
                <h2>2017</h2>
                <p>Lorem ipsum..</p>
            </div>
        </div>
        <div class="timeline-container right">
            <div class="timeline-content">
                <h2>2016</h2>
                <p>Lorem ipsum..</p>
            </div>
        </div>
        <div class="timeline-container left">
            <div class="timeline-content">
                <h2>2016</h2>
                <p>Lorem ipsum..</p>
            </div>
        </div>
        <div class="timeline-container right">
            <div class="timeline-content">
                <h2>2016</h2>
                <p>Lorem ipsum..</p>
            </div>
        </div>
    </section>

    <div class="faq-container">
        <div class="faq-title">FAQ</div>
        <hr class="container">
        <!-- FAQ Items -->
        <div class="faq-section">
            <button class="faq-accordion">Apa itu program inkubasi bisnis Innovation Lab?</button>
            <div class="faq-panel">
                <p>Program ini dirancang untuk membantu pengusaha dalam mengembangkan ide bisnis mereka melalui bimbingan
                    dan pelatihan intensif.</p>
            </div>

            <button class="faq-accordion">Berapa lama durasi program Innovation Lab?</button>
            <div class="faq-panel">
                <p>Durasi program ini berlangsung selama 3 bulan dengan sesi pelatihan mingguan.</p>
            </div>
        </div>

        <div class="faq-section">
            <button class="faq-accordion">Dimana program ini akan dilaksanakan?</button>
            <div class="faq-panel">
                <p>Program akan dilaksanakan secara online melalui platform Zoom dan offline di lokasi mitra kami.</p>
            </div>

            <button class="faq-accordion">Siapa saja yang bisa mendaftar Innovation Lab?</button>
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

        // Update the scroll indicator
        document.querySelector('.timeline').addEventListener('scroll', function() {
            var timeline = document.querySelector('.timeline');
            var scrollHeight = timeline.scrollHeight - timeline.clientHeight;
            var scrollPosition = timeline.scrollTop;

            // Set the height of the indicator based on scroll position
            var indicator = timeline.querySelector('::after');
            var indicatorHeight = (scrollPosition / scrollHeight) * 100;
            indicator.style.height = indicatorHeight + '%';
        });
    </script>
@endsection
