<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CtgaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\StudiController;
use App\Http\Controllers\SurveyController;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use App\Http\Controllers\RegulerController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\FasilitatorController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\AlumniController;

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('tentang');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


Route::get('/masuk', [AuthController::class, 'login'])->name('masuk');
Route::get('/daftar', [AuthController::class, 'register'])->name('daftar')->middleware('guest');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process')->middleware('guest');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/reset-password', [AuthController::class, 'showResetForm'])->name('reset.password.input');
Route::post('/reset-password-check', [AuthController::class, 'checkUsername'])->name('reset.password.check');
Route::post('/reset-password-update', [AuthController::class, 'resetPasswordManual'])->name('reset.password.manual');

// Forgot password form
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');

// Handle password reset link request
Route::post('forgot-password', [AuthController::class, 'sendResetLink'])->name('password.whatsapp');

// Reset password form (after user clicks the reset link in the email)
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');

// Handle reset password request
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


Route::get('/pelatihanSaya', [TrainingController::class, 'indexPelatihan'])->name('pelatihan.saya');

Route::get('/pelatihan', [TrainingController::class, 'index'])->name('pelatihan');
Route::get('/pelatihan/reguler', [TrainingController::class, 'indexReguler'])->name('reguler.index');
Route::post('/pelatihan/reguler', [TrainingController::class, 'storeReguler'])->name('store.index');

Route::get('/pelatihan/reguler/{hash}', [TrainingController::class, 'showReguler'])->name('reguler.show');
Route::get('/pelatihan/reguler/daftar/{hash}', [TrainingController::class, 'createReguler'])->name('reguler.create');

Route::get('/file/{filename}', function ($filename) {
    try {
        // Lokasi folder cache di local storage
        $cachePath = storage_path('app/public/cache_drive/' . $filename);

        // Pastikan folder-nya ada
        if (!file_exists(dirname($cachePath))) {
            mkdir(dirname($cachePath), 0775, true);
        }

        // Kalau file sudah ada di lokal → ambil langsung
        if (file_exists($cachePath)) {
            $mimeType = File::mimeType($cachePath);
            return response()->file($cachePath, [
                'Content-Type' => $mimeType,
                'Cache-Control' => 'public, max-age=604800', // cache di browser 7 hari
            ]);
        }

        // Ambil dari Google Drive via helper atau service Gdrive kamu
        $data = Gdrive::get($filename); // asumsi: ->file (isi biner), ->ext (mimeType)
        if (!$data || empty($data->file)) {
            abort(404, 'File tidak ditemukan di Drive');
        }

        // Simpan file ke cache lokal
        file_put_contents($cachePath, $data->file);

        return response($data->file, 200)
            ->header('Content-Type', $data->ext)
            ->header('Cache-Control', 'public, max-age=604800'); // cache di browser

    } catch (\Exception $e) {
        report($e);
        abort(500, 'Terjadi kesalahan saat memuat gambar');
    }
})->where('filename', '.*')->name('file.show');


Route::get('pelatihan-saya', [TrainingController::class, 'regulerList'])
    ->name('reguler.pelatihan');

Route::get('/pelatihan/permintaan/form-request-permintaan', [TrainingController::class, 'createPermintaan'])
    ->name('permintaan.create');

Route::middleware(['peserta'])->group(function () {


    Route::post('/pelatihan/permintaan/store', [TrainingController::class, 'storePermintaan'])
        ->name('permintaan.store');

    Route::get('/pelatihan/konsultasi/create', [TrainingController::class, 'createKonsultasi'])
        ->name('konsultasi.create');

    Route::post('/pelatihan/konsultasi/store', [TrainingController::class, 'storeKonsultasi'])
        ->name('konsultasi.store');

    Route::get('/pelatihan/reguler/create/{id}', [TrainingController::class, 'createReguler'])
        ->name('reguler.create');

    Route::get('/pelatihan-saya/permintaan/show', [TrainingController::class, 'permintaanShow'])
        ->name('permintaan.pelatihan.show');

    Route::get('/pelatihan-saya/konsultasi/show', [TrainingController::class, 'konsultasiShow'])
        ->name('konsultasi.pelatihan.show');

    // Route::get('/pelatihan-saya/konsultasi/show', [TrainingController::class, 'konsultasiShow'])
    //     ->name('konsultasi.pelatihan.show');

    Route::get('/ctga', [CtgaController::class, 'index'])
        ->name('ctga');

    Route::get('/ruang-diskusi/buat-ruang-diskusi', [DiscussionController::class, 'createUser'])->middleware('peserta')->name('userForumCreate');
    Route::post('/ruang-diskusi/simpan-ruang-diskusi', [DiscussionController::class, 'storeUser'])->name('userForumStore');
    Route::post('/ruang-diskusi/simpan-komen-ruang-diskusi/{id}', [DiscussionController::class, 'storeKomenUser'])->name('userKomenStore');

    Route::get('/form-evaluasi/{hash}', [TrainingController::class, 'regulerListShowEvaluasi'])
        ->name('reguler.pelatihan.evaluasi');

    Route::post('/pelatihan-saya/evaluasi/simpan', [TrainingController::class, 'regulerListStoreEvaluasi'])
        ->name('reguler.pelatihan.evaluasi.store');
});

Route::get('/pelatihan-saya/{nama_pelatihan}', [TrainingController::class, 'regulerListShow'])
    ->name('reguler.pelatihan.list');


Route::get('/pelatihan-saya/survey-kepuasan/{id}', [TrainingController::class, 'regulerListShowSurvey'])
    ->name('reguler.pelatihan.survey');
Route::post('/pelatihan-saya/survey-kepuasan/simpan', [TrainingController::class, 'regulerListStoreSurvey'])
    ->name('reguler.pelatihan.survey.store');

Route::get('/pelatihan-saya/studi-dampak/{id}', [TrainingController::class, 'regulerListShowStudi'])
    ->name('reguler.pelatihan.studi-dampak');
Route::post('/pelatihan-saya/studi-dampak/simpan', [TrainingController::class, 'regulerListStoreStudi'])
    ->name('reguler.pelatihan.studi.store');
Route::get('/pelatihan-saya/materi/{id}', [TrainingController::class, 'regulerListShowMateri'])
    ->name('reguler.pelatihan.materi');
Route::get('/pelatihan-saya/sertifikat/{id}', [TrainingController::class, 'regulerListShowSertifikat'])
    ->name('reguler.pelatihan.sertifikat');
Route::get('/pelatihan-saya/forum/{id}', [TrainingController::class, 'regulerListShowForum'])
    ->name('reguler.pelatihan.forum');
Route::get('/pelatihan-saya/dokumentasi/{id}', [TrainingController::class, 'regulerListShowDokumentasi'])
    ->name('reguler.pelatihan.dokumentasi');
Route::post('/pelatihan/reguler/simpanReguler', [TrainingController::class, 'storeReguler'])->name('reguler.store');

Route::get('/get-provinsi/{negaraId}', [TrainingController::class, 'getProvinsi']);
Route::get('/get-kabupaten/{provinsiId}', [TrainingController::class, 'getKabupaten']);

Route::get('/get-provinsi-survey/{negaraId}', [TrainingController::class, 'getProvinsiSurvey']);
Route::get('/get-kabupaten-survey/{provinsiId}', [TrainingController::class, 'getKabupatenSurvey']);

Route::get('/get-provinsi-reguler/{negaraId}', [RegulerController::class, 'getProvinsi']);
Route::get('/get-kabupaten-reguler/{provinsiId}', [RegulerController::class, 'getKabupaten']);


Route::get('/ruang-diskusi', [DiscussionController::class, 'indexUser'])->name('userDiskusi');
Route::get('/ruang-diskusi/lihat-ruang-diskusi/{id}', [DiscussionController::class, 'showUser'])->name('userForumShow');

Route::post('/upload/image', [DiscussionController::class, 'uploadImage'])->name('upload.image');

Route::get('/admin/login', [AuthController::class, 'adminLogin'])->name('adminLogin');
Route::post('/admin/login', [AuthController::class, 'adminLoginProcess'])->name('loginAdmin');

Route::get('/pelatihan-saya/permintaan/{nama_pelatihan}', [TrainingController::class, 'permintaanListShow'])
    ->name('permintaan.pelatihan.list');

Route::get('/form-evaluasi/permintaan/{hash}', [TrainingController::class, 'permintaanListShowEvaluasi'])
    ->name('permintaan.pelatihan.evaluasi');

Route::post('/pelatihan-saya/evaluasi/permintaan/simpan', [TrainingController::class, 'permintaanListStoreEvaluasi'])
    ->name('permintaan.pelatihan.evaluasi.store');

Route::get('/pelatihan-saya/survey-kepuasan/permintaan/{id}', [TrainingController::class, 'permintaanListShowSurvey'])
    ->name('permintaan.pelatihan.survey');
Route::post('/pelatihan-saya/survey-kepuasan/permintaan/simpan', [TrainingController::class, 'permintaanListStoreSurvey'])
    ->name('permintaan.pelatihan.survey.store');

Route::get('/pelatihan-saya/studi-dampak/permintaan/{id}', [TrainingController::class, 'permintaanListShowStudi'])
    ->name('permintaan.pelatihan.studi-dampak');
Route::post('/pelatihan-saya/studi-dampak/permintaan/simpan', [TrainingController::class, 'permintaanListStoreStudi'])
    ->name('permintaan.pelatihan.studi.store');
Route::get('/pelatihan-saya/materi/permintaan/{id}', [TrainingController::class, 'permintaanListShowMateri'])
    ->name('permintaan.pelatihan.materi');
Route::get('/pelatihan-saya/sertifikat/permintaan/{id}', [TrainingController::class, 'permintaanListShowSertifikat'])
    ->name('permintaan.pelatihan.sertfikat');
Route::get('/pelatihan-saya/dokumentasi/permintaan/{id}', [TrainingController::class, 'permintaanListShowDokumentasi'])
    ->name('permintaan.pelatihan.dokumentasi');
Route::get('/pelatihan-saya/forum/permintaan/{id}', [TrainingController::class, 'permintaanListShowForum'])
    ->name('permintaan.pelatihan.forum');

Route::get('/pelatihan-saya/konsultasi/{nama_pelatihan}', [TrainingController::class, 'konsultasiListShow'])
    ->name('konsultasi.pelatihan.list');

Route::get('/pelatihan-saya/evaluasi/konsultasi/{id}', [TrainingController::class, 'konsultasiListShowEvaluasi'])
    ->name('konsultasi.pelatihan.evaluasi');
Route::post('/pelatihan-saya/evaluasi/konsultasi/simpan', [TrainingController::class, 'konsultasiListStoreEvaluasi'])
    ->name('konsultasi.pelatihan.evaluasi.store');

Route::get('/pelatihan-saya/survey-kepuasan/konsultasi/{id}', [TrainingController::class, 'konsultasiListShowSurvey'])
    ->name('konsultasi.pelatihan.survey');
Route::post('/pelatihan-saya/survey-kepuasan/konsultasi/simpan', [TrainingController::class, 'konsultasiListStoreSurvey'])
    ->name('konsultasi.pelatihan.survey.store');

Route::get('/pelatihan-saya/studi-dampak/konsultasi/{id}', [TrainingController::class, 'konsultasiListShowStudi'])
    ->name('konsultasi.pelatihan.studi-dampak');
Route::post('/pelatihan-saya/studi-dampak/konsultasi/simpan', [TrainingController::class, 'konsultasiListStoreStudi'])
    ->name('konsultasi.pelatihan.studi.store');
Route::get('/pelatihan-saya/materi/konsultasi/{id}', [TrainingController::class, 'konsultasiListShowMateri'])
    ->name('konsultasi.pelatihan.materi');
Route::get('/pelatihan-saya/sertifikat/konsultasi/{id}', [TrainingController::class, 'konsultasiListShowSertifikat'])
    ->name('konsultasi.pelatihan.sertfikat');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'indexAdmin'])->name('indexAdmin');
    Route::get('/admin/asal', [HomeController::class, 'asal'])->name('adminAsal');
    Route::get('/admin/rentang-usia', [HomeController::class, 'usia'])->name('adminUsia');
    Route::get('/admin/informasi', [HomeController::class, 'informasi'])->name('adminInformasi');
    Route::get('/admin/gender', [HomeController::class, 'gender'])->name('adminGender');
    Route::get('/admin/pelatihan/reguler', [RegulerController::class, 'index'])->name('regulerAdmin');
    Route::get('/admin/pelatihan/reguler/lihat-pelatihan/{id}', [RegulerController::class, 'show'])->name('regulerShowAdmin');
    Route::get('/admin/pelatihan/reguler/edit-pelatihan/{id}', [RegulerController::class, 'edit'])->name('regulerEditAdmin');
    Route::get('/admin/pelatihan/reguler/buat-pelatihan-reguler', [RegulerController::class, 'create'])->name('regulerCreateAdmin');
    Route::post('/admin/pelatihan/reguler/simpan-pelatihan', [RegulerController::class, 'store'])->name('regulerStoreAdmin');
    Route::post('/admin/pelatihan/reguler/simpan-peserta', [RegulerController::class, 'storePeserta'])->name('regulerStorePesertaAdmin');
    Route::post('/admin/pelatihan/reguler/buat-tema-pelatihan', [RegulerController::class, 'storeTema'])->name('regulerStoreTemaAdmin');
    Route::post('/admin/update-status-peserta/{id}', [RegulerController::class, 'updateStatus']);
    Route::put('/admin/pelatihan/reguler/update-pelatihan/{id}', [RegulerController::class, 'update'])->name('regulerUpdateAdmin');
    Route::delete('/admin/pelatihan/reguler/hapus-pelatihan/{id}', [RegulerController::class, 'destroy'])->name('regulerDestroyAdmin');
    Route::delete('/admin/pelatihan/reguler/hapus-tema/{id}', [RegulerController::class, 'destroyTema'])->name('regulerDestroyTemaAdmin');

    Route::get('/admin/pelatihan/permintaan', [PermintaanController::class, 'index'])->name('permintaanAdmin');
    Route::get('/admin/pelatihan/permintaan/lihat-detail-permintaan/{id}', [PermintaanController::class, 'show'])->name('permintaanShowAdmin');
    Route::get('/admin/pelatihan/permintaan/buat-pelatihan-permintaan/{id}', [PermintaanController::class, 'create'])->name('permintaanCreateAdmin');
    Route::get('/admin/pelatihan/permintaan/edit-pelatihan-permintaan/{id}', [PermintaanController::class, 'edit'])->name('permintaanEditAdmin');
    Route::get('/admin/pelatihan/permintaan/lihat-pelatihan-permintaan/{id}', [PermintaanController::class, 'detailPelatihanPermintaan'])->name('permintaanInfoAdmin');
    Route::get('/admin/pelatihan/permintaan/pendaftaran-peserta-permintaan/{id}', [PermintaanController::class, 'createPeserta'])->name('permintaanCreatePeserta');
    Route::post('/admin/pelatihan/permintaan/simpan-pelatihan', [PermintaanController::class, 'store'])->name('permintaanStoreAdmin');
    Route::put('/admin/pelatihan/permintaan/update-pelatihan/{id}', [PermintaanController::class, 'update'])->name('permintaanUpdateAdmin');
    Route::post('/admin/pelatihan/permintaan/simpan-peserta-permintaan', [PermintaanController::class, 'storePeserta'])->name('permintaanStorePeserta');
    Route::put('/admin/pelatihan/permintaan/update-peserta-permintaan/{id}', [PermintaanController::class, 'updatePeserta'])->name('permintaanUpdatePeserta');
    Route::delete('/admin/pelatihan/permintaan/hapus-peserta-permintaan/{id}', [PermintaanController::class, 'destroyPeserta'])->name('permintaanDestroyPeserta');
    Route::delete('/admin/pelatihan/permintaan/hapus-pelatihan-permintaan/{id}', [PermintaanController::class, 'destroy'])->name('permintaanDestroyAdmin');
    Route::delete('/admin/pelatihan/permintaan/hapus-pelatihan-permintaan-mitra/{id}', [PermintaanController::class, 'destroyPermintaan'])->name('permintaanDestroyMitraAdmin');


    Route::get('/admin/pelatihan/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasiAdmin');
    Route::get('/admin/pelatihan/konsultasi/pendaftaran-peserta-konsultasi/{id}', [KonsultasiController::class, 'createPeserta'])->name('konsultasiCreatePeserta');
    Route::get('/admin/pelatihan/konsultasi/edit-pelatihan-konsultasi/{id}', [KonsultasiController::class, 'edit'])->name('konsultasiEditAdmin');
    Route::get('/admin/pelatihan/konsultasi/lihat-informasi-pelatihan/{id}', [KonsultasiController::class, 'show'])->name('konsultasiShowAdmin');
    Route::get('/admin/pelatihan/konsultasi/lihat-konsultasi/{id}', [KonsultasiController::class, 'detailPelatihan'])->name('konsultasiInfoAdmin');
    Route::get('/admin/pelatihan/konsultasi/buat-pelatihan-konsultasi/{id}', [KonsultasiController::class, 'create'])->name('konsultasiCreateAdmin');
    Route::delete('/admin/pelatihan/konsultasi/hapus-pelatihan-konsultasi/{id}', [KonsultasiController::class, 'destroy'])->name('konsultasiDestroyAdmin');
    Route::put('/admin/pelatihan/konsultasi/update-pelatihan-konsultasi/{id}', [KonsultasiController::class, 'update'])->name('konsultasiUpdateAdmin');
    Route::post('/admin/pelatihan/konsultasi/simpan-konsultasi', [KonsultasiController::class, 'store'])->name('konsultasiStoreAdmin');
    Route::post('/admin/pelatihan/konsultasi/simpan-peserta-konsultasi', [KonsultasiController::class, 'storePeserta'])->name('konsultasiStorePeserta');
    Route::put('/admin/pelatihan/konsultasi/update-peserta-konsultasi/{id}', [KonsultasiController::class, 'updatePeserta'])->name('konsultasiUpdatePeserta');
    Route::delete('/admin/pelatihan/konsultasi/hapus-peserta-konsultasi/{id}', [KonsultasiController::class, 'destroyPeserta'])->name('konsultasiDestroyPeserta');
    Route::delete('/admin/pelatihan/konsultasi/hapus-peserta-konsultasi-organisasi/{id}', [KonsultasiController::class, 'destroyKonsultasi'])->name('konsultasiDestroyOrganisasiAdmnin');

    Route::get('/admin/evaluasi/reguler', [EvaluasiController::class, 'indexReguler'])->name('evaluasiRegulerAdmin');
    Route::get('/admin/evaluasi/buat-form-evaluasi-reguler/{id}', [EvaluasiController::class, 'createReguler'])->name('evaluasiCreateRegulerAdmin');
    Route::post('/admin/evaluasi/simpan-form-evaluasi-reguler', [EvaluasiController::class, 'storeReguler'])->name('evaluasiStoreRegulerAdmin');
    Route::get('/admin/evaluasi/lihat-evaluasi-reguler/{id}', [EvaluasiController::class, 'showReguler'])->name('evaluasiShowRegulerAdmin');
    Route::post('/admin/evaluasi/update-form-evaluasi-reguler', [EvaluasiController::class, 'updateReguler'])->name('evaluasiUpdateRegulerAdmin');
    Route::get('/admin/evaluasi/edit-form-evaluasi-reguler/{id}', [EvaluasiController::class, 'showEditFormReguler'])->name('evaluasiEditRegulerAdmin');
    Route::get('/admin/evaluasi/edit-form-evaluasireguler/{id}', [EvaluasiController::class, 'editReguler'])->name('evaluasiEditRegulerAdmin');
    Route::delete('/admin/evaluasi/hapus-form-evaluasi-reguler/{id}', [EvaluasiController::class, 'deleteFormReguler'])->name('evaluasiDeleteRegulerAdmin');


    Route::get('/admin/evaluasi/permintaan', [EvaluasiController::class, 'indexPermintaan'])->name('evaluasiPermintaanAdmin');
    Route::get('/admin/evaluasi/buat-form-evaluasi-permintaan/{id}', [EvaluasiController::class, 'createPermintaan'])->name('evaluasiCreatePermintaanAdmin');
    Route::get('/admin/evaluasi/lihat-evaluasi-permintaan/{id}', [EvaluasiController::class, 'showPermintaan'])->name('evaluasiShowPermintaanAdmin');
    Route::get('/admin/evaluasi/edit-form-evaluasi-permintaan/{id}', [EvaluasiController::class, 'showEditFormPermintaan'])->name('evaluasiEditPermintaanAdmin');
    Route::get('/admin/evaluasi/edit-form-evaluasipermintaan/{id}', [EvaluasiController::class, 'editPermintaan'])->name('evaluasiEditPermintaanAdmin');
    Route::post('/admin/evaluasi/simpan-form-evaluasi-permintaan', [EvaluasiController::class, 'storePermintaan'])->name('evaluasiStorePermintaanAdmin');
    Route::post('/admin/evaluasi/update-form-evaluasi-permintaan', [EvaluasiController::class, 'updatePermintaan'])->name('evaluasiUpdatePermintaanAdmin');
    Route::delete('/admin/evaluasi/hapus-form-evaluasi-permintaan/{id}', [EvaluasiController::class, 'deleteFormPermintaan'])->name('evaluasiDeletePermintaanAdmin');

    Route::get('/admin/evaluasi/konsultasi', [EvaluasiController::class, 'indexKonsultasi'])->name('evaluasiKonsultasiAdmin');
    Route::get('/admin/evaluasi/buat-form-evaluasi-konsultasi/{id}', [EvaluasiController::class, 'createKonsultasi'])->name('evaluasiCreateKonsultasiAdmin');
    Route::get('/admin/evaluasi/lihat-evaluasi-konsultasi/{id}', [EvaluasiController::class, 'showKonsultasi'])->name('evaluasiShowKonsultasiAdmin');
    Route::get('/admin/evaluasi/edit-form-evaluasi-konsultasi/{id}', [EvaluasiController::class, 'showEditFormKonsultasi'])->name('evaluasiEditKonsultasiAdmin');
    Route::get('/admin/evaluasi/edit-form-evaluasikonsultasi/{id}', [EvaluasiController::class, 'editKonsultasi'])->name('evaluasiEditKonsultasiAdmin');
    Route::post('/admin/evaluasi/simpan-form-evaluasi-konsultasi', [EvaluasiController::class, 'storeKonsultasi'])->name('evaluasiStoreKonsultasiAdmin');
    Route::post('/admin/evaluasi/update-form-evaluasi-konsultasi', [EvaluasiController::class, 'updateKonsultasi'])->name('evaluasiUpdateKonsultasiAdmin');
    Route::delete('/admin/evaluasi/hapus-form-evaluasi-konsultasi/{id}', [EvaluasiController::class, 'deleteFormKonsultasi'])->name('evaluasiDeleteKonsultasiAdmin');

    Route::get('/admin/survey/reguler', [SurveyController::class, 'indexReguler'])->name('surveyRegulerAdmin');
    Route::get('/admin/survey/lihat-survey-reguler/{id}', [SurveyController::class, 'showReguler'])->name('surveyShowRegulerAdmin');
    Route::get('/admin/survey/buat-form-survey-reguler/{id}', [SurveyController::class, 'createReguler'])->name('surveyCreateRegulerAdmin');
    Route::post('/admin/survey/simpan-form-survey-reguler', [SurveyController::class, 'storeReguler'])->name('surveyStoreRegulerAdmin');
    Route::post('/admin/survey/update-form-survey-reguler', [SurveyController::class, 'updateReguler'])->name('surveyUpdateRegulerAdmin');
    Route::get('/admin/survey/edit-form-survey-reguler/{id}', [SurveyController::class, 'showEditFormReguler'])->name('SurveyEditRegulerAdmin');
    Route::get('/admin/survey/edit-form-surveyreguler/{id}', [SurveyController::class, 'editReguler'])->name('surveyEditRegulerAdmin');
    Route::delete('/admin/survey/hapus-form-survey-reguler/{id}', [SurveyController::class, 'deleteFormReguler'])->name('surveyDeleteRegulerAdmin');

    Route::get('/admin/survey/permintaan', [SurveyController::class, 'indexPermintaan'])->name('surveyPermintaanAdmin');
    Route::get('/admin/survey/lihat-survey-permintaan/{id}', [SurveyController::class, 'showPermintaan'])->name('surveyShowPermintaanAdmin');
    Route::get('/admin/survey/buat-form-survey-permintaan/{id}', [SurveyController::class, 'createPermintaan'])->name('surveyCreatePermintaanAdmin');
    Route::post('/admin/survey/simpan-form-survey-permintaan', [SurveyController::class, 'storePermintaan'])->name('surveyStorePermintaanAdmin');
    Route::post('/admin/survey/update-form-survey-permintaan', [SurveyController::class, 'updatePermintaan'])->name('surveyUpdatePermintaanAdmin');
    Route::get('/admin/survey/edit-form-survey-permintaan/{id}', [SurveyController::class, 'showEditFormPermintaan'])->name('SurveyEditPermintaanAdmin');
    Route::get('/admin/survey/edit-form-surveypermintaan/{id}', [SurveyController::class, 'editPermintaan'])->name('surveyEditPermintaanAdmin');
    Route::delete('/admin/survey/hapus-form-survey-permintaan/{id}', [SurveyController::class, 'deleteFormPermintaan'])->name('surveyDeletePermintaanAdmin');

    Route::get('/admin/survey/konsultasi', [SurveyController::class, 'indexKonsultasi'])->name('surveyKonsultasiAdmin');
    Route::get('/admin/survey/lihat-survey-konsultasi/{id}', [SurveyController::class, 'showKonsultasi'])->name('surveyShowKonsultasiAdmin');
    Route::get('/admin/survey/buat-form-survey-konsultasi/{id}', [SurveyController::class, 'createKonsultasi'])->name('surveyCreateKonsultasiAdmin');
    Route::post('/admin/survey/simpan-form-survey-konsultasi', [SurveyController::class, 'storeKonsultasi'])->name('surveyStoreKonsultasiAdmin');
    Route::post('/admin/survey/update-form-survey-konsultasi', [SurveyController::class, 'updateKonsultasi'])->name('surveyUpdateKonsultasiAdmin');
    Route::get('/admin/survey/edit-form-survey-konsultasi/{id}', [SurveyController::class, 'showEditFormKonsultasi'])->name('SurveyEditKonsultasiAdmin');
    Route::get('/admin/survey/edit-form-surveykonsultasi/{id}', [SurveyController::class, 'editKonsultasi'])->name('surveyEditKonsultasiAdmin');
    Route::delete('/admin/survey/hapus-form-survey-konsultasi/{id}', [SurveyController::class, 'deleteFormKonsultasi'])->name('surveyDeleteKonsultasiAdmin');

    Route::get('/admin/studidampak/reguler', [StudiController::class, 'indexReguler'])->name('studiRegulerAdmin');
    Route::get('/admin/studidampak/lihat-studidampak-reguler/{id}', [StudiController::class, 'showReguler'])->name('studidampakShowRegulerAdmin');
    Route::get('/admin/studidampak/buat-form-studidampak-reguler/{id}', [StudiController::class, 'createReguler'])->name('studidampakCreateRegulerAdmin');
    Route::post('/admin/studidampak/simpan-form-studidampak-reguler', [StudiController::class, 'storeReguler'])->name('studidampakStoreRegulerAdmin');
    Route::post('/admin/studidampak/update-form-studidampak-reguler', [StudiController::class, 'updateReguler'])->name('studidampakUpdateRegulerAdmin');
    Route::get('/admin/studidampak/edit-form-studidampak-reguler/{id}', [StudiController::class, 'showEditFormReguler'])->name('studidampakEditRegulerAdmin');
    Route::get('/admin/studidampak/edit-formstudidampakreguler/{id}', [StudiController::class, 'editReguler'])->name('studidampakEditRegulerAdmin');
    Route::delete('/admin/studidampak/hapus-form-studidampak-reguler/{id}', [StudiController::class, 'deleteFormReguler'])->name('studidampakDeleteRegulerAdmin');

    Route::get('/admin/studidampak/permintaan', [StudiController::class, 'indexPermintaan'])->name('studiPermintaanAdmin');
    Route::get('/admin/studidampak/lihat-studidampak-permintaan/{id}', [StudiController::class, 'showPermintaan'])->name('studidampakShowPermintaanAdmin');
    Route::get('/admin/studidampak/buat-form-studidampak-permintaan/{id}', [StudiController::class, 'createPermintaan'])->name('studidampakCreatePermintaanAdmin');
    Route::post('/admin/studidampak/simpan-form-studidampak-permintaan', [StudiController::class, 'storePermintaan'])->name('studidampakStorePermintaanAdmin');
    Route::post('/admin/studidampak/update-form-studidampak-permintaan', [StudiController::class, 'updatePermintaan'])->name('studidampakUpdatePermintaanAdmin');
    Route::get('/admin/studidampak/edit-form-studidampak-permintaan/{id}', [StudiController::class, 'showEditFormPermintaan'])->name('studidampakEditPermintaanAdmin');
    Route::get('/admin/studidampak/edit-form-studidampakpermintaan/{id}', [StudiController::class, 'editPermintaan'])->name('studidampakEditPermintaanAdmin');
    Route::delete('/admin/studidampak/hapus-form-studidampak-permintaan/{id}', [StudiController::class, 'deleteFormPermintaan'])->name('studidampakDeletePermintaanAdmin');

    Route::get('/admin/studidampak/konsultasi', [StudiController::class, 'indexKonsultasi'])->name('studiKonsultasiAdmin');
    Route::get('/admin/studidampak/lihat-studidampak-konsultasi/{id}', [StudiController::class, 'showKonsultasi'])->name('studidampakShowKonsultasiAdmin');
    Route::get('/admin/studidampak/buat-form-studidampak-konsultasi/{id}', [StudiController::class, 'createKonsultasi'])->name('studidampakCreateKonsultasiAdmin');
    Route::post('/admin/studidampak/simpan-form-studidampak-konsultasi', [StudiController::class, 'storeKonsultasi'])->name('studidampakStoreKonsultasiAdmin');
    Route::post('/admin/studidampak/update-form-studidampak-konsultasi', [StudiController::class, 'updateKonsultasi'])->name('studidampakUpdateKonsultasiAdmin');
    Route::get('/admin/studidampak/edit-form-studidampak-konsultasi/{id}', [StudiController::class, 'showEditFormKonsultasi'])->name('studidampakEditKonsultasiAdmin');
    Route::get('/admin/studidampak/edit-form-studidampakkonsultasi/{id}', [StudiController::class, 'editKonsultasi'])->name('studidampakEditKonsultasiAdmin');
    Route::delete('/admin/studidampak/hapus-form-studidampak-konsultasi/{id}', [StudiController::class, 'deleteFormKonsultasi'])->name('studidampakDeleteKonsultasiAdmin');

    Route::get('/admin/sertifikat-pelatihan/reguler', [CertificationController::class, 'indexReguler'])->name('sertiRegulerAdmin');
    Route::get('/admin/sertifikat-pelatihan/tambah-sertifikat-reguler/{id}', [CertificationController::class, 'showReguler'])->name('sertiRegulerShowAdmin');
    Route::post('/admin/sertifikat-pelatihan/upload-sertifikat-reguler/{id}', [CertificationController::class, 'uploadReguler'])->name('sertiRegulerUploadAdmin');

    Route::get('/admin/sertifikat-pelatihan/permintaan', [CertificationController::class, 'indexPermintaan'])->name('sertiPermintaanAdmin');
    Route::get('/admin/sertifikat-pelatihan/tambah-sertifikat-permintaan/{id}', [CertificationController::class, 'showPermintaan'])->name('sertiPermintaanShowAdmin');
    Route::post('/admin/sertifikat-pelatihan/upload-sertifikat-permintaan/{id}', [CertificationController::class, 'uploadPermintaan'])->name('sertiPermintaanUploadAdmin');

    Route::get('/admin/sertifikat-pelatihan/konsultasi', [CertificationController::class, 'indexKonsultasi'])->name('sertiKonsultasiAdmin');
    Route::get('/admin/sertifikat-pelatihan/tambah-sertifikat-konsultasi/{id}', [CertificationController::class, 'showKonsultasi'])->name('sertiKonsultasiShowAdmin');
    Route::post('/admin/sertifikat-pelatihan/upload-sertifikat-konsultasi/{id}', [CertificationController::class, 'uploadKonsultasi'])->name('sertiKonsultasiUploadAdmin');

    Route::get('/admin/fasilitator/daftar-fasilitator', [FasilitatorController::class, 'index'])->name('fasilitatorAdmin');
    Route::get('/admin/fasilitator/tambah-fasilitator', [FasilitatorController::class, 'create'])->name('fasilitatorCreateAdmin');
    Route::post('/admin/fasilitator/simpan-fasilitator', [FasilitatorController::class, 'store'])->name('fasilitatorStoreAdmin');
    Route::get('/admin/fasilitator/{id_fasilitator}', [FasilitatorController::class, 'show'])->name('fasilitatorShowAdmin');
    Route::get('/admin/fasilitator/edit-fasilitator/{id_fasilitator}', [FasilitatorController::class, 'edit'])->name('fasilitatorEditAdmin');
    Route::put('/admin/fasilitator/update-fasilitator/{id_fasilitator}', [FasilitatorController::class, 'update'])->name('fasilitatorUpdateAdmin');
    Route::delete('/admin/fasilitator/hapus-fasilitator/{id_fasilitator}', [FasilitatorController::class, 'destroy'])->name('fasilitatorDestroyAdmin');

    Route::get('/admin/ruang-diskusi/daftar-ruang-diskusi', [DiscussionController::class, 'indexAdmin'])->name(name: 'adminDiskusi');
    Route::get('/admin/ruang-diskusi/buat-ruang-diskusi', [DiscussionController::class, 'createAdmin'])->name(name: 'adminCreateDiskusi');
    Route::get('/admin/ruang-diskusi/lihat-ruang-diskusi/{id}', [DiscussionController::class, 'showAdmin'])->name(name: 'adminShowDiskusi');
    Route::post('/admin/ruang-diskusi/simpan-komen-ruang-diskusi/{id}', [DiscussionController::class, 'storeKomenAdmin'])->name('adminKomenStore');
    Route::delete('/admin/ruang-diskusi/hapus-komen/{id}', [DiscussionController::class, 'deleteComment'])->name('adminKomenDelete');
    Route::delete('/admin/diskusi/{id}', [DiscussionController::class, 'destroyAdmin'])->name('adminDestroyDiskusi');

    Route::get('/admin/sertifikat', [CertificationController::class, 'index'])->name('adminSertifikat');
    Route::get('/admin/alumni', [AlumniController::class, 'index'])->name('adminAlumni');
    Route::get('/admin/alumni/tambah-alumni', [AlumniController::class, 'create'])->name('adminAlumniCreate');

    // Route::get('/admin/sertifikat', [CertificationController::class, 'index'])->name('adminSertifikat');
    Route::get('/admin/presensi/reguler', [PresensiController::class, 'indexReguler'])->name('adminPresensiReguler');
    Route::get('/admin/presensi/list-reguler/{id}', [PresensiController::class, 'showReguler'])->name('adminShowPresensiReguler');
    Route::delete('/admin/presensi/delete/{id}', [PresensiController::class, 'destroyReguler'])->name('adminDestroyPresensiReguler');
    Route::get('/admin/presensi/list-peserta-reguler/{id}', [PresensiController::class, 'showPresensiPesertaReguler'])->name('adminShowPresensiPesertaReguler');
    Route::get('/admin/presensi/generate-presensi/{id}', [PresensiController::class, 'generateQRCode'])->name('generatePresensi');
    Route::post('/admin/presensi/generate-presensi/{id}', [PresensiController::class, 'store'])->name('savePresensi');

    Route::get('/admin/presensi/permintaan', [PresensiController::class, 'indexPermintaan'])->name('adminPresensiPermintaan');
    Route::get('/admin/presensi/list-permintaan/{id}', [PresensiController::class, 'showPermintaan'])->name('adminShowPresensiPermintaan');
    Route::get('/admin/presensi/list-peserta-permintaan/{id}', [PresensiController::class, 'showPresensiPesertaPermintaan'])->name('adminShowPresensiPesertaPermintaan');
    Route::get('/admin/presensi/generate-presensi-permintaan/{id}', [PresensiController::class, 'generateQRCodePermintaan'])->name('generatePresensiPermintaan');
    Route::post('/admin/presensi/generate-presensi-permintaan/{id}', [PresensiController::class, 'storePermintaan'])->name('savePresensiPermintaan');
    Route::delete('/admin/presensi/delete-permintaan/{id}', [PresensiController::class, 'destroyPermintaan'])->name('adminDestroyPresensiPermintaan');
});

Route::get('/form-fasilitator', [FasilitatorController::class, 'createFasilitator'])->name('fasilitatorCreate');
Route::post('/form-fasilitator/store', [FasilitatorController::class, 'storeFasilitator'])->name('fasilitatorStore');

Route::get('/pelatihan-saya/presensi/{id}', [TrainingController::class, 'presensiReguler'])->name('presensi.reguler');
Route::get('/scan-qr-presensi/{id}/{presensi}', [TrainingController::class, 'scanQRCode'])->name('scanQrPresensi');
Route::post('/presensi/scan/{id}', [TrainingController::class, 'processQRScan'])->name('presensi.process');

Route::get('/pelatihan-saya/presensi/permintaan/{id}', [TrainingController::class, 'presensiPermintaan'])->name('presensi.permintaan');
Route::get('/scan-qr-presensi/permintaan/{id}/{presensi}', [TrainingController::class, 'scanQRCodePermintaan'])->name('scanQrPresensiPermintaan');
Route::post('/presensi/scan/permintaan/{id}', [TrainingController::class, 'processQRScanPermintaan'])->name('presensi.process.permintaan');
