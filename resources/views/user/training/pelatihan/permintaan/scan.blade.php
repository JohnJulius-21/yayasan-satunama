{@extends('layouts.user')

@section('content')
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">{{ $permintaan->nama_pelatihan }}</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('permintaan.pelatihan.show') }}">Pelatihan Saya</a></li>
                    <li><a
                            href="{{ route('permintaan.pelatihan.list', $permintaan->nama_pelatihan) }}">{{ $permintaan->nama_pelatihan }}</a>
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
                    @include('partials.user-routes-permintaan')
                </div>
                <div class="col-lg-9">
                    <div class="php-email-form">
                        @if ($presensi)
                            <div>
                                <div class="p-4 inline-block text-center">
                                    <h2>QR Code Presensi: {{ $presensi->judul_presensi }}</h2>
                                </div>

                                @if ($sudahPresensi)
                                    {{-- Tampilkan pesan jika sudah presensi --}}
                                    <div class="alert alert-success text-center" role="alert">
                                        <i class="fas fa-check-circle"></i>
                                        <h4 class="alert-heading">Presensi Berhasil!</h4>
                                        <p class="mb-0">Anda sudah melakukan presensi untuk sesi ini.</p>
                                    </div>
                                @else
                                    {{-- Tampilkan QR Code dan scanner jika belum presensi --}}
                                    <div class="text-center mb-4">
                                        <!-- Pastikan ada ID ini di HTML -->
                                        <div id="qr-svg-container">
                                            {!! $presensi->qr_code !!}
                                        </div>
                                        <button id="download-qr" class="btn btn-outline-success mt-3">Download QR
                                            Code</button>
                                    </div>

                                    <h3>Scan QR Code</h3>

                                    <div class="container mt-4">
                                        <div class="border p-3 rounded">
                                            <div class="d-flex justify-content-between mb-2">
                                                <h5 class="text-success m-0">Scan Presensi</h5>
                                                <span class="text-muted" id="scan-status">Status</span>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="camera-select">Pilih Kamera:</label>
                                                <select id="camera-select" class="form-control"></select>
                                            </div>

                                            <div id="reader" class="bg-light mx-auto"
                                                style="width: 100%; max-width: 300px; height: auto;"></div>

                                            @guest
                                                {{-- Jika belum login, tampilkan tombol yang memicu modal login --}}
                                                <div class="text-center mt-3">
                                                    <button class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#loginModal">
                                                        Masuk untuk Presensi
                                                    </button>
                                                </div>
                                            @else
                                                {{-- Tampilkan form presensi jika sudah login --}}
                                                <div class="mt-3 d-grid">
                                                    <button id="start-scan" class="btn btn-outline-success">Mulai Scan</button>
                                                </div>

                                                <p class="text-center mt-2">
                                                    <a href="#" id="upload-image-link"
                                                        class="text-decoration-underline text-success small">
                                                        Scan dengan Gambar
                                                    </a>
                                                </p>
                                            @endguest



                                            <input type="file" id="qr-image-file" accept="image/*" class="d-none">
                                        </div>

                                        <p id="scan-result" class="text-center mt-3 text-success fw-semibold"></p>

                                        <form id="presensi-form" method="POST"
                                            action="{{ route('presensi.process.permintaan', $permintaan->id_pelatihan_permintaan) }}"
                                            class="d-none">
                                            @csrf
                                            <input type="hidden" name="qr_data" id="qr-data">
                                            <input type="hidden" name="id_presensi_permintaan"
                                                value="{{ $presensi->id_presensi }}">
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset('images/nopelatihan.png') }}" alt="Hero Image"
                                    style="max-width:400px; height:auto">
                                <h5 class="text-muted">Belum ada Presensi yang dibuat.</h5>
                            </div>
                        @endif
                    </div>ZZ
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

        let selectedCameraId = null;
        document.getElementById("start-scan").addEventListener("click", function() {
            scanStatus.innerText = "Scanning...";
            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    const cameraId = selectedCameraId || devices[0].id;


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
                            document.getElementById("scan-result").innerText =
                                "Presensi Berhasil Dilakukan";
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

                    // Kirim pakai fetch agar bisa baca respon JSON
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
                                    text: 'Data presensi berhasil dikirim!',
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

                })
                .catch(err => {
                    scanStatus.innerText = "Idle";

                    // Tampilkan notifikasi gagal
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Membaca Gambar',
                        text: err
                    });
                });
        });



        document.getElementById('download-qr').addEventListener('click', function(e) {
            e.preventDefault();

            const svgElement = document.querySelector('#qr-svg-container svg');
            if (!svgElement) {
                Swal.fire('QR Code tidak ditemukan', '', 'error');
                return;
            }

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
                ctx.fillStyle = '#FFFFFF'; // latar belakang putih
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(image, 0, 0);

                const pngUrl = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.download = 'qr-code-pelatihan.png';
                link.href = pngUrl;
                link.click();

                // Bersihkan
                URL.revokeObjectURL(url);
            };
            image.onerror = function() {
                Swal.fire('Gagal memuat gambar dari SVG', '', 'error');
            };
            image.src = url;
        });


        // Inisialisasi dropdown kamera
        // ... (bagian awal script tetap sama)

        // Inisialisasi dropdown kamera
        Html5Qrcode.getCameras().then(devices => {
            const cameraSelect = document.getElementById("camera-select");
            if (devices.length === 0) {
                cameraSelect.innerHTML = '<option disabled>Tidak ada kamera terdeteksi</option>';
                return;
            }

            devices.forEach((device, index) => {
                const option = document.createElement("option");
                option.value = device.id;
                option.text = device.label || `Kamera ${index + 1}`;
                cameraSelect.appendChild(option);
            });

            // Set default kamera pertama
            selectedCameraId = devices[0].id;

            cameraSelect.addEventListener("change", async function() {
                const newCameraId = this.value;

                // Jika scanner sedang berjalan, hentikan dulu
                if (scanner.isScanning) {
                    try {
                        await scanner.stop();
                        scanStatus.innerText = "Idle";
                    } catch (err) {
                        console.error("Gagal menghentikan scanner:", err);
                    }
                }

                // Update kamera yang dipilih
                selectedCameraId = newCameraId;

                // Jika tombol scan sudah ditekan sebelumnya, mulai scan dengan kamera baru
                if (scanStatus.innerText !== "Idle") {
                    document.getElementById("start-scan").click();
                }
            });
        }).catch(err => {
            console.error("Gagal mendeteksi kamera:", err);
        });

        // ... (bagian akhir script tetap sama)
    </script>
@endsection
