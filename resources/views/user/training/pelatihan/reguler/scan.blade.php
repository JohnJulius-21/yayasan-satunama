@extends('layouts.app_user')

@section('title', 'Scan Presensi')
@section('page-title', 'Scan Presensi')
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush
@section('content')

    <div class="mb-3 flex flex-wrap justify-between items-center bg-white rounded-lg p-4 border">
        <a href="{{ url('/pelatihan-saya/presensi/' . $reguler->id_reguler) }}"
            class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors">
            <i class="bi bi-arrow-left mr-2"></i>
            Kembali
        </a>

        <div class="flex items-center text-sm text-gray-500">
            <i class="bi bi-shield-check mr-2"></i>
            Konten dilindungi - hanya untuk peserta pelatihan
        </div>
    </div>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-green-50">
        <!-- Header dengan instruksi yang jelas -->
        <div class="bg-white shadow-sm border-b-2 border-green-200 py-6">
            <div class="container mx-auto px-4 text-center">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-green-100 p-3 rounded-full mr-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800">Presensi Digital</h1>
                </div>
                <h2 class="text-xl font-semibold text-gray-700 mb-2">{{ $reguler->nama_pelatihan }}</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Untuk melakukan presensi, silakan ikuti langkah-langkah sederhana di bawah ini.
                    Pastikan kamera HP Anda dapat berfungsi dengan baik.
                </p>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            @if ($presensi)
                <!-- Step-by-step guide -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-2xl font-bold text-center text-gray-800 mb-6 flex items-center justify-center">
                        <span
                            class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold mr-3">1</span>
                        Lihat QR Code Pelatihan
                    </h3>

                    <div class="text-center mb-6">
                        <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl p-8 inline-block">
                            <div id="qr-svg-container" class="mb-4">
                                {!! $presensi->qr_code !!}
                            </div>
                            <p class="text-gray-600 font-medium">{{ $presensi->judul_presensi }}</p>
                        </div>

                        <button id="download-qr"
                            class="mt-4 px-8 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 font-medium text-lg shadow-lg">
                            💾 Simpan QR Code
                        </button>
                    </div>
                </div>

                <!-- Scan Section -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-2xl font-bold text-center text-gray-800 mb-6 flex items-center justify-center">
                        <span
                            class="bg-green-100 text-green-600 rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold mr-3">2</span>
                        Scan untuk Presensi
                    </h3>

                    @if (!$isLoggedIn)
                        <!-- Belum Login -->
                        <div class="text-center py-8">
                            <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-6 mb-6 max-w-md mx-auto">
                                <div class="text-6xl mb-4">🔐</div>
                                <h4 class="text-xl font-bold text-blue-800 mb-2">Masuk Dulu Ya!</h4>
                                <p class="text-blue-700 mb-4">Untuk melakukan presensi, silakan masuk ke akun Anda terlebih
                                    dahulu.</p>
                            </div>
                            <button
                                class="px-8 py-4 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-colors duration-200 font-bold text-lg shadow-lg"
                                data-bs-toggle="modal" data-bs-target="#loginModal">
                                🚪 MASUK SEKARANG
                            </button>
                        </div>
                    @elseif ($sudahPresensi)
                        <!-- Sudah Presensi -->
                        <div class="text-center py-8">
                            <div class="bg-green-50 border-2 border-green-200 rounded-xl p-6 max-w-md mx-auto">
                                <div class="text-6xl mb-4">✅</div>
                                <h4 class="text-xl font-bold text-green-800 mb-2">Presensi Berhasil!</h4>
                                <p class="text-green-700">Anda sudah melakukan presensi untuk sesi ini. Terima kasih!</p>
                            </div>
                        </div>
                    @else
                        <!-- Form Presensi -->
                        <div class="max-w-2xl mx-auto">
                            <!-- Status Scan -->
                            <div class="bg-gray-50 border-2 border-gray-200 rounded-xl p-4 mb-6">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-medium text-gray-700">📱 Status Scanner:</span>
                                    <span id="scan-status"
                                        class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-full font-bold">Siap
                                        Memulai</span>
                                </div>
                            </div>

                            <!-- Pilih Kamera -->
                            <div class="mb-6">
                                <label class="block text-lg font-bold text-gray-700 mb-3">
                                    📷 Pilih Kamera yang Akan Digunakan:
                                </label>
                                <select id="camera-select"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl text-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white">
                                </select>
                            </div>

                            <!-- Scanner Area -->
                            <div class="bg-gray-900 rounded-xl p-4 mb-6">
                                <div id="reader" class="mx-auto rounded-lg overflow-hidden bg-black"
                                    style="width: 100%; max-width: 400px; height: 300px; border: 3px solid #10B981;">
                                    <div class="flex items-center justify-center h-full text-white text-center">
                                        <div>
                                            <div class="text-4xl mb-2">📷</div>
                                            <p class="text-lg">Kamera akan muncul di sini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Scan -->
                            <div class="text-center mb-6">
                                <button id="start-scan"
                                    class="px-12 py-4 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-colors duration-200 font-bold text-xl shadow-lg">
                                    🔍 MULAI SCAN SEKARANG
                                </button>
                            </div>

                            <!-- Alternatif Upload -->
                            <div class="text-center mb-6">
                                <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-4">
                                    <p class="text-blue-700 mb-3 text-lg">
                                        💡 <strong>Tips:</strong> Jika kamera tidak berfungsi, Anda bisa menggunakan foto
                                    </p>
                                    <button id="upload-image-link"
                                        class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 font-medium">
                                        📸 Pilih Foto dari Galeri
                                    </button>
                                </div>
                            </div>

                            <input type="file" id="qr-image-file" accept="image/*" class="hidden">

                            <!-- Hasil Scan -->
                            <div id="scan-result-container" class="text-center hidden">
                                <div class="bg-green-50 border-2 border-green-200 rounded-xl p-6">
                                    <div class="text-4xl mb-2">🎉</div>
                                    <p id="scan-result" class="text-xl font-bold text-green-700"></p>
                                </div>
                            </div>

                            <!-- Form Hidden -->
                            <form id="presensi-form" method="POST"
                                action="{{ route('presensi.process', $reguler->id_reguler) }}" class="hidden">
                                @csrf
                                <input type="hidden" name="qr_data" id="qr-data">
                                <input type="hidden" name="id_presensi_reguler" value="{{ $presensi->id_presensi }}">
                                <input type="hidden" name="id_presensi" value="{{ $id_presensi }}">
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Instruksi Bantuan -->
                <div class="bg-amber-50 border-2 border-amber-200 rounded-xl p-6 mt-8">
                    <h4 class="text-xl font-bold text-amber-800 mb-4 flex items-center">
                        💡 Bantuan & Tips
                    </h4>
                    <div class="grid md:grid-cols-2 gap-4 text-amber-700">
                        <div class="flex items-start">
                            <span class="text-2xl mr-3">📱</span>
                            <div>
                                <strong>Posisikan HP dengan baik:</strong>
                                <p>Jaga jarak sekitar 15-20 cm dari QR Code</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="text-2xl mr-3">💡</span>
                            <div>
                                <strong>Pastikan cahaya cukup:</strong>
                                <p>Scan di tempat yang terang agar QR Code terlihat jelas</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="text-2xl mr-3">📷</span>
                            <div>
                                <strong>Izinkan akses kamera:</strong>
                                <p>Klik "Allow" ketika browser meminta akses kamera</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="text-2xl mr-3">🔄</span>
                            <div>
                                <strong>Jika gagal:</strong>
                                <p>Coba refresh halaman atau gunakan foto dari galeri</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Tidak ada presensi -->
                <div class="text-center py-16">
                    <div class="bg-white rounded-xl shadow-lg p-8 max-w-md mx-auto">
                        <div class="text-6xl mb-4">📝</div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Presensi</h3>
                        <p class="text-gray-600 text-lg">Saat ini belum ada sesi presensi yang dibuat untuk pelatihan ini.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Custom styles untuk membantu readability */
        #reader video {
            border-radius: 8px;
        }

        #scan-status {
            transition: all 0.3s ease;
        }

        #scan-status.scanning {
            @apply bg-blue-100 text-blue-700;
        }

        #scan-status.success {
            @apply bg-green-100 text-green-700;
        }

        /* Animasi untuk hasil scan */
        #scan-result-container.show {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Memastikan QR Code terlihat jelas */
        #qr-svg-container svg {
            max-width: 250px;
            height: auto;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            #reader {
                max-width: 300px !important;
            }

            #qr-svg-container svg {
                max-width: 200px;
            }
        }
    </style>

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
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute('content'),
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
                                        text: 'Terjadi kesalahan saat mengirim data: ' +
                                            error.message
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
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
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
