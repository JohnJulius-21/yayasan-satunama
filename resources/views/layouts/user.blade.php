<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="icon" type="image/png" href="{{ asset('images/stc.png') }}">
    <title>{{ $title }} - STC</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assetss/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assetss/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assetss/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assetss/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assetss/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assetss/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assetss/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Main CSS File -->
    <link href="{{ asset('assetss/css/main.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/css/trix.css">
    

    <!-- =======================================================
  * Template Name: eNno
  * Template URL: https://bootstrapmade.com/enno-free-simple-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  @include('partials.header')
    

    <main class="main">

        <div class="content-wrapper">
            @yield('content')
        </div>

        

  </main>

  <footer id="footer" class="footer">

    {{-- <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
            <form action="forms/newsletter.php" method="post" class="php-email-form">
              <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>
        </div>
      </div>
    </div> --}}

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <img class="w-25" src="{{ asset('images/stc.png') }}" alt="Logo" />
          </a>
          <div class="footer-contact pt-3">
            <p>Jl. Sambisari Jl. Duwet No.99</p>
            <p>Sleman, Daerah Istimewa Yogyakarta 55285</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12">
          <h4>Follow Us</h4>
          <p>Ikuti Sosial Media Kami</p>
          <div class="social-links d-flex">
            {{-- <a href=""><i class="bi bi-twitter-x"></i></a> --}}
            <a href="https://www.facebook.com/SATUNAMATrainingCenter"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/yayasansatunama/?hl=en"><i class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/company/yayasan-satunama-yogyakarta/posts/?feedView=all"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">SATUNAMA Training Center</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assetss/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assetss/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assetss/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assetss/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assetss/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assetss/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assetss/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assetss/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assetss/js/main.js') }}"></script>
  <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script>
  <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

</body>

</html>
