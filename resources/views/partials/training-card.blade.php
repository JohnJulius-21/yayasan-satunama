{{-- Training Card Component --}}
@php
    // Determine training data based on type
    if ($type === 'reguler') {
        $training = $item->reguler;
        $detailRoute = route('reguler.pelatihan.list', urlencode($training->nama_pelatihan));
        $typeLabel = 'Pelatihan Reguler';
        $typeIcon = 'fas fa-users';
        $typeColor = 'green';
        $hasPaymentSystem = true;
    } elseif ($type === 'permintaan') {
        $training = $item->permintaan_pelatihan;
        $detailRoute = route('permintaan.pelatihan.list', urlencode($training->nama_pelatihan)); // Sesuaikan dengan route yang sesuai
        $typeLabel = 'Pelatihan Permintaan';
        $typeIcon = 'fas fa-hand-paper';
        $typeColor = 'blue';
        $hasPaymentSystem = false;
    } else {
        // konsultasi
        $training = $item->pelatihan_konsultasi;
        $detailRoute = route('konsultasi.pelatihan.list', urlencode($training->nama_pelatihan)); // Sesuaikan dengan route yang sesuai
        $typeLabel = 'Pelatihan Konsultasi';
        $typeIcon = 'fas fa-comments';
        $typeColor = 'purple';
        $hasPaymentSystem = false;
    }
@endphp

<div class="space-y-6 mb-5">
    @if ($hasPaymentSystem && $item->status && $item->status->status === 'belum_bayar')
        <!-- Belum Bayar Card (Hanya untuk Reguler) -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-l-4 border-amber-500">
            <div class="bg-gradient-to-r from-amber-50 to-yellow-50 px-6 py-4 border-b">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
                    <div class="flex items-center mb-3 lg:mb-0">
                        <div class="bg-amber-100 p-2 rounded-xl mr-4">
                            <i class="fas fa-exclamation-triangle text-amber-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="flex items-center mb-1">
                                <span
                                    class="text-xs bg-{{ $typeColor }}-100 text-{{ $typeColor }}-700 px-2 py-1 rounded-full font-medium mr-2">
                                    <i class="{{ $typeIcon }} mr-1"></i>
                                    {{ $typeLabel }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $training->nama_pelatihan }}</h3>
                            <p class="text-amber-700 font-medium flex items-center mt-1">
                                <i class="fas fa-clock mr-2"></i>
                                Menunggu Pembayaran
                            </p>
                        </div>
                    </div>
                    <span class="bg-amber-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                        <i class="fas fa-credit-card mr-1"></i>
                        Belum Bayar
                    </span>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-4">
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-amber-600 mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-amber-800 mb-2">Segera Lakukan Pembayaran</h4>
                                    <p class="text-amber-700 text-sm">Untuk mengikuti pelatihan, silakan transfer
                                        sesuai nominal yang tertera ke rekening berikut:</p>
                                </div>
                            </div>
                        </div>

                        <!-- Bank Information Section -->
                        <div class="bg-gray-50 rounded-xl p-5">
                            <h5 class="font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-university text-green-600 mr-2"></i>
                                Informasi Rekening
                            </h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Bank</p>
                                        <p class="font-medium text-gray-900">BNI KCP UGM Yogyakarta</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">No.
                                            Rekening</p>
                                        <p
                                            class="text-lg font-bold text-green-600 bg-green-50 px-3 py-1 rounded-lg inline-block">
                                            5557778967</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Atas Nama
                                        </p>
                                        <p class="font-medium text-gray-900">YAYASAN SATUNAMA YOGYAKARTA</p>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Alamat</p>
                                        <p class="text-sm text-gray-700">JL. Kaliurang KM 4.5, Sleman, DI Yogyakarta</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Mata Uang
                                        </p>
                                        <p class="font-medium text-gray-900">IDR (Rupiah)</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Swift Code
                                        </p>
                                        <p class="font-medium text-gray-900">BNINIDJA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="bg-green-50 rounded-2xl p-6 mb-4">
                            <div
                                class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fab fa-whatsapp text-green-600 text-2xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-2">Kirim Bukti Bayar</h4>
                            <p class="text-sm text-gray-600">Setelah transfer, kirim bukti pembayaran ke WhatsApp kami
                            </p>
                        </div>
                        <a href="https://api.whatsapp.com/send?phone=6282226887110&text=Halo,%20saya%20ingin%20mengirim%20bukti%20pembayaran%20pelatihan."
                            target="_blank"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-xl w-full inline-block transition duration-300 transform hover:scale-105">
                            <i class="fab fa-whatsapp mr-2"></i>
                            WhatsApp Admin
                        </a>
                        <p class="text-sm text-gray-500 mt-2">+62 822-2688-7110</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Card untuk yang sudah bayar (Reguler) atau untuk Permintaan/Konsultasi -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-l-4 border-{{ $typeColor }}-500">
            <div class="bg-gradient-to-r from-{{ $typeColor }}-50 to-emerald-50 px-6 py-4 border-b">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
                    <div class="flex items-center mb-3 lg:mb-0">
                        <div class="bg-{{ $typeColor }}-100 p-2 rounded-xl mr-4">
                            <i class="fas fa-check-circle text-{{ $typeColor }}-600 text-xl"></i>
                        </div>
                        <div>
                            <div class="flex items-center mb-1">
                                <span
                                    class="text-xs bg-{{ $typeColor }}-100 text-{{ $typeColor }}-700 px-2 py-1 rounded-full font-medium mr-2">
                                    <i class="{{ $typeIcon }} mr-1"></i>
                                    {{ $typeLabel }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $training->nama_pelatihan }}</h3>
                            <p class="text-{{ $typeColor }}-700 font-medium flex items-center mt-1">
                                <i class="fas fa-check-circle mr-2"></i>
                                @if ($hasPaymentSystem)
                                    Pembayaran Berhasil
                                @else
                                    Terdaftar
                                @endif
                            </p>
                        </div>
                    </div>

                    @if ($training->tanggal_mulai && $training->tanggal_selesai)
                        @php
                            $tanggalMulai = \Carbon\Carbon::parse($training->tanggal_mulai);
                            $tanggalSelesai = \Carbon\Carbon::parse($training->tanggal_selesai);
                            $sekarang = \Carbon\Carbon::now();

                            $status = '';
                            $badgeClass = '';
                            $icon = '';

                            if ($sekarang->lt($tanggalMulai)) {
                                $status = 'Akan Dimulai';
                                $badgeClass = 'bg-blue-500';
                                $icon = 'fas fa-hourglass-start';
                            } elseif ($sekarang->between($tanggalMulai, $tanggalSelesai)) {
                                $status = 'Sedang Berlangsung';
                                $badgeClass = 'bg-green-500';
                                $icon = 'fas fa-play-circle';
                            } else {
                                $status = 'Selesai';
                                $badgeClass = 'bg-gray-500';
                                $icon = 'fas fa-flag-checkered';
                            }
                        @endphp
                        <span class="{{ $badgeClass }} text-white px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="{{ $icon }} mr-1"></i>
                            {{ $status }}
                        </span>
                    @else
                        <span class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            Jadwal Belum Ditetapkan
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
                        @if ($training->tanggal_mulai && $training->tanggal_selesai)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="flex items-center">
                                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                        <i class="fas fa-calendar-alt text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Tanggal
                                            Pelatihan</p>
                                        <p class="font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($training->tanggal_mulai)->locale('id')->isoFormat('DD MMMM') }}
                                            -
                                            {{ \Carbon\Carbon::parse($training->tanggal_selesai)->locale('id')->isoFormat('DD MMMM YYYY') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                        <i class="fas fa-clock text-purple-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Durasi</p>
                                        <p class="font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($training->tanggal_mulai)->diffInDays(
                                                \Carbon\Carbon::parse($training->tanggal_selesai),
                                            ) + 1 }}
                                            Hari
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @php
                                $tanggalMulai = \Carbon\Carbon::parse($training->tanggal_mulai);
                                $tanggalSelesai = \Carbon\Carbon::parse($training->tanggal_selesai);
                                $sekarang = \Carbon\Carbon::now();

                                if ($sekarang->lt($tanggalMulai)) {
                                    $statusText = 'Status: Pelatihan belum dimulai';
                                    $infoText = 'Materi, form evaluasi dan presensi belum tersedia';
                                    $bgColor = 'bg-blue-50 border-blue-200';
                                    $textColor = 'text-blue-800';
                                    $iconColor = 'text-blue-600';
                                } elseif ($sekarang->between($tanggalMulai, $tanggalSelesai)) {
                                    $statusText = 'Status: Pelatihan sedang berlangsung';
                                    $infoText = 'Anda dapat mengakses presensi dan form evaluasi, cek secara berkala!';
                                    $bgColor = 'bg-green-50 border-green-200';
                                    $textColor = 'text-green-800';
                                    $iconColor = 'text-green-600';
                                } else {
                                    $statusText = 'Status: Pelatihan telah selesai';
                                    $infoText = 'Anda dapat mengakses materi, presensi dan form evaluasi';
                                    $bgColor = 'bg-gray-50 border-gray-200';
                                    $textColor = 'text-gray-800';
                                    $iconColor = 'text-gray-600';
                                }
                            @endphp
                        @else
                            <div class="grid grid-cols-1 gap-4 mb-4">
                                <div class="flex items-center">
                                    <div class="bg-orange-100 p-2 rounded-lg mr-3">
                                        <i class="fas fa-calendar-times text-orange-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wide font-medium">Status
                                            Jadwal</p>
                                        <p class="font-semibold text-gray-900">Jadwal Belum Ditetapkan</p>
                                    </div>
                                </div>
                            </div>

                            @php
                                $statusText = 'Status: Menunggu penjadwalan';
                                $infoText = 'Admin akan menghubungi Anda untuk menentukan jadwal pelatihan';
                                $bgColor = 'bg-orange-50 border-orange-200';
                                $textColor = 'text-orange-800';
                                $iconColor = 'text-orange-600';
                            @endphp
                        @endif

                        <div class="{{ $bgColor }} border rounded-xl p-4">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle {{ $iconColor }} mr-3"></i>
                                <div>
                                    <p class="{{ $textColor }} font-medium">{{ $statusText }}</p>
                                    <p class="{{ $textColor }} text-sm mt-1">{{ $infoText }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="bg-{{ $typeColor }}-50 rounded-2xl p-6 mb-4">
                            <div
                                class="w-16 h-16 bg-{{ $typeColor }}-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="{{ $typeIcon }} text-{{ $typeColor }}-600 text-2xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-2">
                                @if ($type === 'reguler')
                                    Masuk Pelatihan
                                @elseif($type === 'permintaan')
                                    Lihat Detail
                                @else
                                    Mulai Konsultasi
                                @endif
                            </h4>
                            <p class="text-sm text-gray-600">
                                @if ($type === 'reguler')
                                    Akses materi dan sesi live pelatihan
                                @elseif($type === 'permintaan')
                                    Lihat detail pelatihan permintaan Anda
                                @else
                                    Akses sesi konsultasi dan materi
                                @endif
                            </p>
                        </div>
                        <a href="{{ $detailRoute }}"
                            class="bg-{{ $typeColor }}-600 hover:bg-{{ $typeColor }}-700 text-white font-semibold py-3 px-6 rounded-xl w-full inline-block transition duration-300 transform hover:scale-105">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
