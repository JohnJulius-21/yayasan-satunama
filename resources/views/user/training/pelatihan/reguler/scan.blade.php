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
                                </div>
                                <div class="text-center mb-4">
                                    <!-- QR Code Display -->
                                    <div id="qr-svg-container">
                                        {!! $presensi->qr_code !!}
                                    </div>
                                    <button id="download-qr" class="btn btn-outline-success mt-3">Download QR Code</button>
                                </div>

                                <h3>Scan QR Code</h3>

                                <div class="container mt-4">
                                    <div class="border p-3 rounded">
                                        <div class="d-flex justify-content-between mb-2">
                                            <h5 class="text-success m-0">Scan Presensi</h5>
                                            <span class="text-muted" id="scan-status">Status</span>
                                        </div>

                                        @if (!$isLoggedIn)
                                            {{-- Jika belum login --}}
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                                                    loginModal.show();
                                                });
                                            </script>

                                            <div class="text-center">
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle"></i>
                                                    Silakan login terlebih dahulu untuk melakukan presensi.
                                                </div>
                                                <button class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#loginModal">
                                                    Masuk untuk Presensi
                                                </button>
                                            </div>
                                            {{-- Jika login tapi bukan peserta --}}
                                            {{-- @elseif (!$peserta)
                                            <div class="text-center">
                                                <div class="alert alert-warning">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Anda belum terdaftar sebagai peserta pelatihan ini.
                                                </div>
                                            </div> --}}
                                        @elseif ($sudahPresensi)
                                            {{-- Jika sudah presensi --}}
                                            <div class="text-center">
                                                <div class="alert alert-success">
                                                    <i class="fas fa-check-circle"></i>
                                                    Anda sudah melakukan presensi untuk sesi ini.
                                                </div>
                                            </div>
                                        @else
                                            {{-- Jika bisa melakukan presensi --}}
                                            <div class="form-group mb-3">
                                                <label for="camera-select">Pilih Kamera:</label>
                                                <select id="camera-select" class="form-control"></select>
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
                                        @endif
                                    </div>

                                    <p id="scan-result" class="text-center mt-3 text-success fw-semibold"></p>

                                    {{-- @if ($isLoggedIn && $peserta && !$sudahPresensi) --}}
                                        <form id="presensi-form" method="POST"
                                            action="{{ route('presensi.process', $reguler->id_reguler) }}" class="d-none">
                                            @csrf
                                            <input type="hidden" name="qr_data" id="qr-data">
                                            <input type="hidden" name="id_presensi_reguler"
                                                value="{{ $presensi->id_presensi }}">
                                            <input type="hidden" name="id_presensi" value="{{ $id_presensi }}">
                                        </form>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        @else
                            {{-- Jika tidak ada presensi --}}
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
                            document.getElementById("scan-result").innerText = "Presensi Berhasil Dilakukan";
                            document.getElementById("qr-data").value = qrCodeMessage;
    
                            scanner.stop();
    
                            const form = document.getElementById("presensi-form");
                            const formData = new FormData(form);
    
                            // Debug: Log data yang akan dikirim
                            console.log('Mengirim data presensi:', {
                                action: form.action,
                                qr_data: qrCodeMessage,
                                csrf: formData.get('_token')
                            });
    
                            fetch(form.action, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(response => {
                                    console.log('Response status:', response.status);
                                    console.log('Response headers:', response.headers);
                                    
                                    if (!response.ok) {
                                        throw new Error(`HTTP error! status: ${response.status}`);
                                    }
                                    
                                    return response.json();
                                })
                                .then(data => {
                                    console.log('Response data:', data);
                                    
                                    if (data.status === 'success') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Presensi Berhasil',
                                            text: 'Data presensi berhasil disimpan!',
                                            showConfirmButton: true,
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            if (result.isConfirmed || result.isDismissed) {
                                                // Reload halaman untuk menampilkan status "sudah presensi"
                                                window.location.reload();
                                            }
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
                                        text: 'Terjadi kesalahan saat mengirim data: ' + error.message
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
    
                    const form = document.getElementById("presensi-form");
                    const formData = new FormData(form);
    
                    // Debug: Log data yang akan dikirim
                    console.log('Mengirim data presensi dari gambar:', {
                        action: form.action,
                        qr_data: qrCodeMessage,
                        csrf: formData.get('_token')
                    });
    
                    fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            console.log('Response status:', response.status);
                            
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            
                            return response.json();
                        })
                        .then(data => {
                            console.log('Response data:', data);
                            
                            if (data.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Presensi Berhasil',
                                    text: 'Data presensi berhasil disimpan!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {
                                        // Reload halaman untuk menampilkan status "sudah presensi"
                                        window.location.reload();
                                    }
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
                                text: 'Terjadi kesalahan saat mengirim data: ' + error.message
                            });
                        });
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
                ctx.fillStyle = '#FFFFFF';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(image, 0, 0);
    
                const pngUrl = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.download = 'qr-code-pelatihan.png';
                link.href = pngUrl;
                link.click();
    
                URL.revokeObjectURL(url);
            };
            image.onerror = function() {
                Swal.fire('Gagal memuat gambar dari SVG', '', 'error');
            };
            image.src = url;
        });
    
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
    
            selectedCameraId = devices[0].id;
    
            cameraSelect.addEventListener("change", async function() {
                const newCameraId = this.value;
    
                if (scanner.isScanning) {
                    try {
                        await scanner.stop();
                        scanStatus.innerText = "Idle";
                    } catch (err) {
                        console.error("Gagal menghentikan scanner:", err);
                    }
                }
    
                selectedCameraId = newCameraId;
    
                if (scanStatus.innerText !== "Idle") {
                    document.getElementById("start-scan").click();
                }
            });
        }).catch(err => {
            console.error("Gagal mendeteksi kamera:", err);
        });
    </script>
@endsection
