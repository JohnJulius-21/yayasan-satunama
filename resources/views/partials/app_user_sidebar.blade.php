<aside id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg z-50 sidebar-hidden lg:sidebar-visible">
    <div class="p-6">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center space-x-3">
                <div class="bg-primary text-white p-2 rounded-lg">
                    <i class="fas fa-graduation-cap text-xl"></i>
                </div>
                <div>
                    <a href="{{ route('reguler.pelatihan') }}">
                        <h2 class="font-bold text-gray-900">SATUNAMA</h2>
                        <p class="text-sm text-gray-500">Training Center</p>
                    </a>
                </div>
            </div>
            <!-- Close button for mobile -->
            <button id="sidebarClose" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Training Info -->
        {{-- <div class="mb-6 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-400">
            <div class="flex items-center space-x-2 mb-2">
                @if(isset($reguler))
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                        Reguler
                    </span>
                @elseif(isset($permintaan))
                    <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2 py-1 rounded-full">
                        Permintaan
                    </span>
                @elseif(isset($konsultasi))
                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-1 rounded-full">
                        Konsultasi
                    </span>
                @endif
            </div>
            <h3 class="font-medium text-blue-900 mb-1">
                @if(isset($reguler))
                    {{ $reguler->nama_pelatihan }}
                @elseif(isset($permintaan))
                    {{ $permintaan->nama_pelatihan }}
                @elseif(isset($konsultasi))
                    {{ $konsultasi->nama_konsultasi }}
                @endif
            </h3>
            <p class="text-xs text-blue-700">
                @if(isset($reguler))
                    Kode: {{ $reguler->kode_pelatihan ?? '-' }}
                @elseif(isset($permintaan))
                    Kode: {{ $permintaan->kode_permintaan ?? '-' }}
                @elseif(isset($konsultasi))
                    Kode: {{ $konsultasi->kode_konsultasi ?? '-' }}
                @endif
            </p>
        </div> --}}

        <!-- Navigation Menu -->
        <nav class="space-y-2">
            <!-- Dashboard -->
            @if(isset($reguler))
                <a href="{{ url('/pelatihan-saya/' . $reguler->nama_pelatihan) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('reguler.pelatihan.list') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            @elseif(isset($permintaan))
                <a href="{{ url('/pelatihan-saya/permintaan/' . $permintaan->nama_pelatihan) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('permintaan.pelatihan.list') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            {{-- @elseif(isset($konsultasi))
                <a href="{{ url('/pelatihan-saya/konsultasi/' . $konsultasi->nama_pelatihan) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('konsultasi.pelatihan.list') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a> --}}
            @endif

            <!-- Presensi - Available for all types -->
            @if(isset($reguler))
                <a href="{{ url('/pelatihan-saya/presensi/' . $reguler->id_reguler) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('presensi.reguler') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-user-check"></i>
                    <span>Presensi</span>
                </a>
            @elseif(isset($permintaan))
                <a href="{{ url('/pelatihan-saya/presensi/permintaan/' . $permintaan->id_pelatihan_permintaan) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('presensi.permintaan') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-user-check"></i>
                    <span>Presensi</span>
                </a>
            {{-- @elseif(isset($konsultasi))
                <a href="{{ url('/konsultasi/presensi/' . $konsultasi->id_konsultasi) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('presensi.konsultasi') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-user-check"></i>
                    <span>Presensi</span>
                </a> --}}
            @endif

            <!-- Evaluasi Pelatihan - Only for reguler and permintaan -->
            @if(isset($reguler))
                <a href="{{ url('/form-evaluasi/' . $reguler->hash_id) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('reguler.pelatihan.evaluasi') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-star"></i>
                    <span>Evaluasi Pelatihan</span>
                </a>
            @elseif(isset($permintaan))
                <a href="{{ url('/form-evaluasi/permintaan/' . $permintaan->hash_id) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('permintaan.pelatihan.evaluasi') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-star"></i>
                    <span>Evaluasi Pelatihan</span>
                </a>
            @endif

            <!-- Materi -->
            @if(isset($reguler))
                <a href="{{ url('/pelatihan-saya/materi/' . $reguler->id_reguler) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('reguler.pelatihan.materi') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-book"></i>
                    <span>Materi</span>
                </a>    
            @elseif(isset($permintaan))
                <a href="{{ url('/pelatihan-saya/materi/permintaan/' . $permintaan->id_pelatihan_permintaan) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('permintaan.pelatihan.materi') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-book"></i>
                    <span>Materi</span>
                </a>
            {{-- @elseif(isset($konsultasi))
                <a href="{{ url('/konsultasi/materi/' . $konsultasi->id_konsultasi) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('konsultasi.materi') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-book"></i>
                    <span>Materi</span>
                </a> --}}
            @endif

            <!-- Sertifikat - Only for reguler and permintaan -->
            @if(isset($reguler))
                <a href="{{ url('/pelatihan-saya/sertifikat/' . $reguler->id_reguler) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('reguler.pelatihan.sertifikat') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-certificate"></i>
                    <span>Sertifikat</span>
                </a>
            @elseif(isset($permintaan))
                <a href="{{ url('/pelatihan-saya/sertifikat/permintaan/' . $permintaan->id_pelatihan_permintaan) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('permintaan.pelatihan.sertfikat') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-certificate"></i>
                    <span>Sertifikat</span>
                </a>
            @endif

            <!-- Laporan Konsultasi - Only for konsultasi -->
            {{-- @if(isset($konsultasi))
                <a href="{{ url('/konsultasi/laporan/' . $konsultasi->id_konsultasi) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('konsultasi.laporan') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Laporan Konsultasi</span>
                </a>
            @endif --}}

            <!-- Survey Kepuasan - Only for reguler and permintaan -->
            {{-- @if(isset($reguler))
                <a href="{{ url('/pelatihan-saya/survey-kepuasan/' . $reguler->id_reguler) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('training.survey') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-poll"></i>
                    <span>Survey Kepuasan</span>
                </a>
            @elseif(isset($permintaan))
                <a href="{{ url('/pelatihan-permintaan/survey-kepuasan/' . $permintaan->id_pelatihan_permintaan) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('permintaan.survey') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-poll"></i>
                    <span>Survey Kepuasan</span>
                </a>
            @endif --}}

            <!-- Studi Dampak - Only for reguler and permintaan -->
            {{-- @if(isset($reguler))
                <a href="{{ url('/pelatihan-saya/studi-dampak/' . $reguler->id_reguler) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('training.studi-dampak') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Studi Dampak</span>
                </a>
            @elseif(isset($permintaan))
                <a href="{{ url('/pelatihan-permintaan/studi-dampak/' . $permintaan->id_pelatihan_permintaan) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('permintaan.studi-dampak') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Studi Dampak</span>
                </a>
            @endif --}}

            <!-- Dokumentasi -->
            @if(isset($reguler))
                <a href="{{ url('/pelatihan-saya/dokumentasi/' . $reguler->id_reguler) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('reguler.pelatihan.dokumentasi') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-camera"></i>
                    <span>Dokumentasi</span>
                </a>
            @elseif(isset($permintaan))
                <a href="{{ url('/pelatihan-saya/dokumentasi/permintaan/' . $permintaan->id_pelatihan_permintaan) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('permintaan.dokumentasi') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-camera"></i>
                    <span>Dokumentasi</span>
                </a>
            {{-- @elseif(isset($konsultasi))
                <a href="{{ url('/konsultasi/dokumentasi/' . $konsultasi->id_konsultasi) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('konsultasi.dokumentasi') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-camera"></i>
                    <span>Dokumentasi</span>
                </a> --}}
            @endif

            <!-- Forum Diskusi -->
            @if(isset($reguler))
                <a href="{{ url('/pelatihan-saya/forum/' . $reguler->id_reguler) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('reguler.pelatihan.forum') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-comments"></i>
                    <span>Forum Diskusi</span>
                </a>
            @elseif(isset($permintaan))
                <a href="{{ url('/pelatihan-saya/forum/permintaan/' . $permintaan->id_pelatihan_permintaan) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('permintaan.pelatihan.forum') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-comments"></i>
                    <span>Forum Diskusi</span>
                </a>
            {{-- @elseif(isset($konsultasi))
                <a href="{{ url('/konsultasi/forum/' . $konsultasi->id_konsultasi) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('konsultasi.forum') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-comments"></i>
                    <span>Forum Diskusi</span>
                </a> --}}
            @endif

            <!-- Feedback - Only for konsultasi -->
            {{-- @if(isset($konsultasi))
                <a href="{{ url('/konsultasi/feedback/' . $konsultasi->id_konsultasi) }}"
                    class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-colors {{ request()->routeIs('konsultasi.feedback') ? 'bg-primary text-white' : '' }}">
                    <i class="fas fa-comment-dots"></i>
                    <span>Feedback</span>
                </a>
            @endif --}}
        </nav>
    </div>

    <!-- User Profile in Sidebar -->
    @if (Auth::check())
        <div class="absolute bottom-6 left-6 right-6">
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1) . (strstr(Auth::user()->name, ' ') ? substr(strrchr(Auth::user()->name, ' '), 1, 1) : '')) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">
                            @if(isset($reguler))
                                Peserta Reguler
                            @elseif(isset($permintaan))
                                Peserta Permintaan
                            @else
                                Klien Konsultasi
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

</aside>