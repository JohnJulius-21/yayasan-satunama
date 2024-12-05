<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/stc.png') }}">
    <title>{{ $title }} - STC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Sanchez:ital@0;1&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- select2 -->
    <script src="{{ asset('select2/dist/js/jquery.min.js') }}"></script>
    <link href="{{ asset('select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
    <style>
        /* Style untuk menampilkan spinner di tengah layar */
        #loading-spinner {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
        }

        /* Sembunyikan spinner secara default */
        #loading-spinner.hidden {
            display: none;
        }

        /* Gaya gambar di dalam spinner */
        #loading-spinner .spinner-grow img {
            width: 50px;
            height: 50px;
        }

        /* Set fonts for different sections */
        body {
            font-family: 'Titillium Web', sans-serif;
            /* Body text font */
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Sanchez', serif;
            /* Heading font */
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example" data-bs-offset="0">
    <!-- Spinner akan ditampilkan di sini -->
    {{-- <div id="loading-spinner">
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> --}}

    <div class="container">
        @include('partials.navbar') <!-- Include Navbar -->
    </div>

    <div>
        @yield('content') <!-- Dynamic Content Section -->
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" class="scroll-to-top">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#008b8b" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>

    @include('partials.footer') <!-- Include Footer -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script>
        // Saat halaman dimuat, tampilkan spinner
        window.onload = function() {
            const spinner = document.getElementById("loading-spinner");
            setTimeout(() => {
                spinner.classList.add("hidden");
            }, 500);
        };

        // Script Scroll to Top
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        window.onscroll = function() {
            scrollToTopBtn.style.display = document.documentElement.scrollTop > 100 ? "block" : "none";
        };

        function scrollToTop() {
            const currentPosition = window.pageYOffset;
            if (currentPosition > 0) {
                window.requestAnimationFrame(scrollToTop);
                window.scrollTo(0, currentPosition - currentPosition / 10);
            }
        }

        scrollToTopBtn.addEventListener("click", scrollToTop);
    </script>
</body>

</html>
