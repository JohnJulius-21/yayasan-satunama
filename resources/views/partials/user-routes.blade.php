<div class="info-wrap">
    <ul>
        <li> <a href="{{ url('/form-evaluasi/' . $reguler->hash_id) }}">
                Evaluasi Pelatihan
            </a></li>
        <li><a href="{{ url('/pelatihan-saya/survey-kepuasan/' . $reguler->id_reguler) }}">Survey Kepuasan</a></li>
        <li><a href="{{ url('/pelatihan-saya/studi-dampak/' . $reguler->id_reguler) }}">Studi Dampak</a></li>
        <li><a href="{{ url('/pelatihan-saya/presensi/' . $reguler->id_reguler) }}">Presensi</a></li>
        <li><a href="{{ url('/pelatihan-saya/materi/' . $reguler->id_reguler) }}">Materi</a></li>
        <li><a href="{{ url('/pelatihan-saya/sertifikat/' . $reguler->id_reguler) }}">Sertifikat</a></li>
    </ul>
</div>
