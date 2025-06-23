{{-- @extends('layouts.user')

@section('content')
    <div>
        <div class="p-4 border rounded-lg inline-block text-center">
            <h2>QR Code Presensi: {{ $reguler->judul_presensi }}</h2>
            <p class="mt-2">
                {!! $reguler->qr_code !!}
        </div>
    </div>
@endsection --}}

@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $reguler->nama_pelatihan }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('reguler.pelatihan') }}">Pelatihan Saya</a></li>
                    <li><a
                            href="{{ route('reguler.pelatihan.list', $reguler->nama_pelatihan) }}">{{ $reguler->nama_pelatihan }}</a>
                    </li>
                    <li class="current">Presensi </li>
                </ol>
            </nav>
        </div>
    </div>
    <section id="contact" class="contact section">
        <!-- Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-3">
                    @include('partials.user-routes')
                </div>
                <div class="col-lg-9">
                    <div class="php-email-form">
                        @if ($presensi)
                            <div>
                                <div class="p-4 inline-block text-center">
                                    <h2>QR Code Presensi: {{ $presensi->judul_presensi }}</h2>
                                    <p class="text-center mt-2 p-5">
                                        {!! $presensi->qr_code !!}
                                    </p>
                                </div>
                                <div class="text-center mb-4">
                                    {{-- <a href="#" id="download-qr" class="btn btn-success btn-sm mt-2"
                                        download="qr-code.png">Download QR Code</a> --}}

                                    <button id="download-qr" class="btn btn-outline-success">Download QR Code</button>
                                </div>
                                <h3>Scan QR Code</h3>

                                <div class="container mt-4">
                                    <div class="border p-3 rounded">
                                        <div class="d-flex justify-content-between mb-2">
                                            <h5 class="text-success m-0">Code Scanner</h5>
                                            <span class="text-muted" id="scan-status">Idle</span>
                                        </div>

                                        <div id="reader" class="bg-light mx-auto"
                                            style="width: 100%; max-width: 300px; height: auto;"></div>


                                        <div class="mt-3 d-grid">
                                            <button id="start-scan" class="btn btn-outline-success">Mulai Scan</button>
                                        </div>

                                        <p class="text-center mt-2">
                                            <a href="#" id="upload-image-link"
                                                class="text-decoration-underline text-success small">
                                                Scan dengan Gambar
                                            </a>
                                        </p>

                                        <input type="file" id="qr-image-file" accept="image/*" class="d-none">
                                    </div>

                                    <p id="scan-result" class="text-center mt-3 text-success fw-semibold"></p>

                                    <form id="presensi-form" method="POST"
                                        action="{{ route('presensi.process', $reguler->id_reguler) }}" class="d-none">
                                        @csrf
                                        <input type="hidden" name="qr_data" id="qr-data">
                                        <input type="hidden" name="id_presensi_reguler"
                                            value="{{ $presensi->id_presensi }}">
                                    </form>
                                </div>
                            @else
                                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                                    <img src="{{ asset('images/nopelatihan.png') }}" alt="Hero Image"
                                        style="max-width:400px; height:auto">
                                    <h5 class="text-muted">Belum ada Presensi yang dibuat.</h5>
                                </div>
                        @endif
                    </div><!-- End Contact Form -->
                </div><!-- End Contact Form -->
            </div>
        </div>
    </section><!-- /Contact Section -->

    {{-- Langsung tempelkan script di bawah content --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const scanner = new Html5Qrcode("reader");
        const scanStatus = document.getElementById("scan-status");

        document.getElementById("start-scan").addEventListener("click", function() {
            scanStatus.innerText = "Scanning...";
            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    const cameraId = devices[0].id;

                    scanner.start(
                        cameraId, {
                            fps: 10,
                            qrbox: {
                                width: 250,
                                height: 250
                            }
                        },
                        qrCodeMessage => {
                            scanStatus.innerText = "Berhasil";
                            document.getElementById("scan-result").innerText = "Presensi Berhasil Dilakukan";
                            document.getElementById("qr-data").value = qrCodeMessage;

                            scanner.stop();

                            const form = document.getElementById("presensi-form");
                            const formData = new FormData(form);

                            fetch(form.action, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': formData.get('_token')
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Presensi Berhasil',
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal',
                                            text: data.message || 'Presensi gagal!'
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Fetch error:', error);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Kesalahan',
                                        text: 'Terjadi kesalahan saat mengirim data.'
                                    });
                                });
                        },
                        error => {
                            // silent
                        }
                    ).catch(err => {
                        scanStatus.innerText = "Idle";
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Membuka Kamera',
                            text: err
                        });
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Kamera Tidak Ditemukan',
                        text: 'Pastikan perangkat memiliki kamera.'
                    });
                }
            }).catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Gagal mendeteksi kamera: ' + err
                });
            });
        });

        // Scan dari file gambar
        document.getElementById("upload-image-link").addEventListener("click", () => {
            document.getElementById("qr-image-file").click();
        });

        document.getElementById("qr-image-file").addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (!file) return;

            scanStatus.innerText = "Processing Image...";

            scanner.scanFile(file, true)
                .then(qrCodeMessage => {
                    scanStatus.innerText = "Berhasil";
                    document.getElementById("scan-result").innerText = "Hasil: " + qrCodeMessage;
                    document.getElementById("qr-data").value = qrCodeMessage;
                    document.getElementById("presensi-form").submit();
                })
                .catch(err => {
                    scanStatus.innerText = "Idle";
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Membaca Gambar',
                        text: err
                    });
                });
        });

        // Download QR PNG dari SVG
        document.getElementById('download-qr').addEventListener('click', function(e) {
            e.preventDefault();

            const svgElement = document.querySelector('#qr-svg-container svg');
            const svgData = new XMLSerializer().serializeToString(svgElement);
            const svgBlob = new Blob([svgData], {
                type: 'image/svg+xml;charset=utf-8'
            });
            const url = URL.createObjectURL(svgBlob);

            const image = new Image();
            image.onload = function() {
                const canvas = document.createElement('canvas');
                canvas.width = image.width;
                canvas.height = image.height;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(image, 0, 0);

                const pngUrl = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.download = "qr-code.png";
                link.href = pngUrl;
                link.click();
                URL.revokeObjectURL(pngUrl);
            };
            image.src = url;
        });
    </script>
@endsection
