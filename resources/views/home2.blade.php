<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/style2.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container-fluid p-0">



        <!-- Hero Section -->
        <div class="hero">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Tingkatkan pengetahuan demi masa depan organisasi Anda.</h1>
                    <p>Kami menyediakan kursus online dan modul bacaan untuk membantu organisasi masyarakat sipil (OMS)
                        Anda lebih resiliensi secara finansial.</p>
                    <div class="buttons">
                        <a href="#" class="btn btn-success">Baca Modul Sekarang</a>
                        <a href="#" class="btn btn-outline-success">Ikuti Kursus</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('images/illustration1.png') }}" alt="Hero Image">
                </div>
            </div>
        </div>

    </div>

    <!-- About Section with Video -->
    <div class="about-section py-5 bg-light">
        <div class="container text-center">
            <h2>Tentang Re.Search</h2>

            <!-- Video Container -->
            <div class="video-container my-4">
                <iframe src="https://www.youtube.com/embed/70tJNqm9t0w?si=HO6XvrSNOJwHgKiM" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>

            <!-- Descriptive Text -->
            <p class="about-description">
                Re.Search hadir sebagai wadah dari dan bagi organisasi masyarakat sipil di Indonesia untuk belajar,
                berbagi dan berkolaborasi dalam mencapai inovasi, ketahanan finansial, dan keberlanjutan dampak.
            </p>
        </div>
    </div>




    <!-- Products Section -->
    <div class="products-section py-5 bg-warning">
        <div class="container text-center">
            <h2>Produk Pembelajaran Kami</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <img src="path_to_image_1" alt="Modul Belajar" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Modul Belajar</h5>
                            <p class="card-text">Dapatkan modul belajar yang dapat diakses kapan saja, di mana saja.</p>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <img src="path_to_image_2" alt="Kursus Daring" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Kursus Daring</h5>
                            <p class="card-text">Ikuti kursus daring dengan pengajar profesional.</p>
                            <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Facilitator Section -->
    <div class="facilitators-section py-5">
        <div class="container text-center">
            <h2>Facilitator Kami</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="facilitator_image_1" alt="Facilitator 1" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Facilitator 1</h5>
                            <p class="card-text">Deskripsi singkat tentang facilitator.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="facilitator_image_2" alt="Facilitator 2" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Facilitator 2</h5>
                            <p class="card-text">Deskripsi singkat tentang facilitator.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="facilitator_image_3" alt="Facilitator 3" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Facilitator 3</h5>
                            <p class="card-text">Deskripsi singkat tentang facilitator.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-section py-5 bg-light">
        <div class="container text-center">
            <h2>Apakah Anda Membutuhkan Pengembangan Kapasitas?</h2>
            <a href="#" class="btn btn-primary">Hubungi Kami</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
