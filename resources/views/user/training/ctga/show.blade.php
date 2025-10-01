<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/stc.png') }}">
    <title>Detail Pelatihan MS CTGA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">

<nav class="fixed top-0 left-0 right-0 z-50 glass-effect mb-4 bg-white">
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
        </div>
    </div>
</nav>

<div class="max-w-6xl mx-auto px-4 py-8 md:py-24 mt-8">

    <!-- Header -->
    <div class="text-center mb-12 mt-13">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-3">Mobilizing Support</h1>
        <p class="text-xl text-gray-600">Batch IV</p>
    </div>
    <!-- Image and Info Grid -->
    <div class="grid md:grid-cols-3 gap-8 mb-12">
        <!-- Left: Image (2 columns) -->
        <div class="md:col-span-2 bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm">
            <img src="{{asset('images/banner-ctga.jpg')}}" class="w-full h-full" alt="Banner CTGA">
        </div>

        <div class="bg-white rounded-2xl p-6 text-gray-800 card-shadow hover-lift border">
            <h3 class="text-xl font-bold">Informasi Pelatihan</h3>
            <div class="gap-6 mb-5 p-6">
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <span class="text-xl">📅</span>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Tanggal Pelatihan</h4>
                            <p>17-22 November 2025</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="text-xl">🏢</span>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Metode</h4>
                            <p>Tatap Muka (Offline)</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="text-xl">👥</span>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Kuota</h4>
                            <p>10 Organisasi (20 peserta)</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="text-xl">👨‍🏫</span>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Fasilitator</h4>
                            <p>• Iin Mendah</p>
                            <p>• Ariwan Perdana</p>
                            <p>• Agustine Dwi</p>

                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="text-xl">📍</span>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Lokasi Pelatihan</h4>
                            <p>SATUNAMA Training Center</p>
                        </div>
                    </div>


                    <div class="flex items-start gap-3">
                        <span class="text-xl">💰</span>
                        <div>
                            <h4 class="font-semibold text-gray-800 mb-1">Kontribusi Pelatihan</h4>
                            <p>
                                Rp. 4,500,000 per organisasi</p>
                        </div>
                    </div>
                </div>
            </div>
            <button
                onclick="window.location.href='{{route('daftar.ctga')}}'"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-xl transition-colors mb-3 cursor-pointer">
                DAFTAR SEKARANG
            </button>
            <div class="text-center">
                <span>Segera daftarkan organisasi anda</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-3xl border border-gray-200 p-8 md:p-12 mb-8 shadow-sm">

        <!-- About -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Tentang Pelatihan</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
                Pelatihan Change the Game Academy, Kelas Mobilizing Support membantu individu anggota organisasi untuk
                mendalami visi organisasinya, mengidentifikasi para pemangku kepentingan, dan menyusun strategi
                kolaborasi.
            </p>
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r">
                <p class="text-gray-700">
                    Dengan mengikuti kelas ini, individu peserta diharapkan dapat <strong class="text-green-700">memperkuat
                        peran dan kapasitas
                        organisasi</strong> dalam menciptakan dampak positif yang signifikan pada kerja-kerja di tengah
                    komunitas.
                </p>
            </div>
        </div>

        <!-- Requirements -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Ketentuan Peserta Pelatihan</h2>
            <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r mb-6">
                <p class="text-gray-700">
                    Kelas pelatihan ini diperuntukkan diperuntukkan bagi organisasi (NGO, CSO, CBO, kelompok swadaya)
                    yang memiliki
                    <strong>legalitas</strong>, berbasis di Indonesia, dan sedang menjalankan program kerja.
                </p>
            </div>
            <p class="text-gray-700 leading-relaxed mb-4">
                Untuk mengikuti pelatihan Change the Game Academy, kelas Mobilizing Support, setiap lembaga wajib
                mengikutsertakan 2 orang dari lembaganya:
            </p>
            <div class="space-y-4">
                <div class="flex gap-4">
                    <div
                        class="w-6 h-6 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm flex-shrink-0">
                        👔
                    </div>
                    <p class="text-gray-700">Peserta pelatihan sebaiknya <strong>manajer program dan/atau staf
                            program</strong>
                    </p>
                </div>

                <div class="flex gap-4">
                    <div
                        class="w-6 h-6 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm flex-shrink-0">
                        ⏱️
                    </div>
                    <p class="text-gray-700">Peserta yang ditunjuk lembaga untuk mengikuti pelatihan ini sangat
                        disarankan bersedia berkomitmen mengikuti pelatihan dan pendampingan (coaching) selama <strong>±
                            6 bulan</strong>
                        sejak selesainya pelatihan tatap muka
                    </p>
                </div>

                <div class="flex gap-4">
                    <div
                        class="w-6 h-6 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm flex-shrink-0">
                        ⚖️
                    </div>
                    <p class="text-gray-700">Lembaga disarankan mengirimkan <strong>1 laki-laki dan 1 perempuan</strong>
                        (keseimbangan gender)</p>
                </div>
            </div>
        </div>

        <!-- Facilities -->
        <div class="mb-12">
            <h3 class="text-xl font-bold text-gray-900 mb-3">Fasilitas Pelatihan</h3>
            <p class="text-gray-700 mb-4">Biaya kontribusi sebesar Rp 4,5 Juta Rupiah per organisasi, sudah termasuk
                fasilitas untuk 2 orang berupa:</p>
            <div class="grid md:grid-cols-2 gap-3 text-gray-700">
                <div>✈️ Biaya transportasi pergi - pulang</div>
                <div>🏨 Akomodasi dan konsumsi (makan 3x sehari, 2x snack)</div>
                <div>📦 Training kits</div>
                <div>🎓 Sertifikat pelatihan (diberikan setelah masa coaching)</div>
            </div>
        </div>

        <!-- Contact -->
        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-3">Kontak</h3>
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                    <span class="text-xl">💬</span>
                    <div>
                        <p class="font-medium text-gray-900">Agustine Dwi</p>
                        <p class="text-gray-600">0858 6826 1514</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                    <span class="text-xl">💬</span>
                    <div>
                        <p class="font-medium text-gray-900">Mediya J</p>
                        <p class="text-gray-600">0877 1041 7589</p>
                    </div>
                </div>
            </div>

        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3">Email</h3>
        <div>
            <p class="text-gray-600">✉️ training@satunama.org</p>
        </div>

    </div>

</div>

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

</body>
</html>
