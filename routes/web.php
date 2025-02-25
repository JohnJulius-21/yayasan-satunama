<?php

use App\Http\Controllers\DiscussionController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\StudiController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\RegulerController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\CtgaController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\FasilitatorController;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use Illuminate\Support\Facades\Response;

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/tentang', [AboutController::class, 'index'])->name('tentang');


Route::get('/masuk', [AuthController::class, 'login'])->name('masuk');
Route::get('/daftar', [AuthController::class, 'register'])->name('daftar')->middleware('guest');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process')->middleware('guest');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::get('/pelatihanSaya', [TrainingController::class, 'indexPelatihan'])->name('pelatihan.saya');

Route::get('/pelatihan', [TrainingController::class, 'index'])->name('pelatihan');
Route::get('/pelatihan/reguler', [TrainingController::class, 'indexReguler'])->name('reguler.index');
Route::post('/pelatihan/reguler', [TrainingController::class, 'storeReguler'])->name('store.index');

Route::get('/pelatihan/reguler/{id}', [TrainingController::class, 'showReguler'])->name('reguler.show');
Route::get('/pelatihan/reguler/daftar/{id}', [TrainingController::class, 'createReguler'])->name('reguler.create');

Route::get('/file/{filename}', function ($filename) {
    try {
        $data = Gdrive::get($filename);
        if (!$data) {
            abort(404);
        }
        return response($data->file, 200)
            ->header('Content-Type', $data->ext);
    } catch (\Exception $e) {
        abort(404);
    }
})->where('filename', '.*')->name('file.show');

Route::get('pelatihan-saya', [TrainingController::class, 'regulerList'])
    ->name('reguler.pelatihan');

Route::get('/pelatihan-saya/{nama_pelatihan}', [TrainingController::class, 'regulerListShow'])
    ->name('reguler.pelatihan.list');

Route::get('/pelatihan-saya/evaluasi/{id}', [TrainingController::class, 'regulerListShowEvaluasi'])
    ->name('reguler.pelatihan.evaluasi');
Route::get('/pelatihan-saya/survey-kepuasan/{id}', [TrainingController::class, 'regulerListShowSurvey'])
    ->name('reguler.pelatihan.survey');
Route::get('/pelatihan-saya/studi-dampak/{id}', [TrainingController::class, 'regulerListShowStudi'])
    ->name('reguler.pelatihan.studi-dampak');

Route::post('/pelatihan/reguler/simpanReguler', [TrainingController::class, 'storeReguler'])->name('reguler.store');

Route::get('/get-provinsi/{negaraId}', [TrainingController::class, 'getProvinsi']);
Route::get('/get-kabupaten/{provinsiId}', [TrainingController::class, 'getKabupaten']);

Route::get('/admin/ruang-diskusi', [DiscussionController::class, 'indexAdmin'])->name('adminDiskusi');
Route::get('/ruang-diskusi', [DiscussionController::class, 'indexUser'])->name('userDiskusi');
Route::get('/ruang-diskusi/lihat-ruang-diskusi/{id}', [DiscussionController::class, 'showUser'])->name('userForumShow');

Route::post('/upload/image', [DiscussionController::class, 'uploadImage'])->name('upload.image');

Route::middleware(['user'])->group(function () {
    Route::get('/pelatihan/permintaan/create', [TrainingController::class, 'createPermintaan'])
        ->name('permintaan.create');

    Route::post('/pelatihan/permintaan/store', [TrainingController::class, 'storePermintaan'])
        ->name('permintaan.store');

    Route::get('/pelatihan/konsultasi/create', [TrainingController::class, 'createKonsultasi'])
        ->name('konsultasi.create');

    Route::post('/pelatihan/konsultasi/store', [TrainingController::class, 'storeKonsultasi'])
        ->name('konsultasi.store');

    Route::get('/pelatihan/reguler/create/{id}', [TrainingController::class, 'createReguler'])
        ->name('reguler.create');

    Route::get('/pelatihan/permintaan/show', [TrainingController::class, 'permintaanShow'])
        ->name('permintaan.pelatihan.show');

    Route::get('/pelatihan/konsultasi/show', [TrainingController::class, 'konsultasiShow'])
        ->name('konsultasi.pelatihan.show');

    Route::get('/pelatihan/ctga', [CtgaController::class, 'index'])
        ->name('ctga');

    Route::get('/ruang-diskusi/buat-ruang-diskusi', [DiscussionController::class, 'createUser'])->name('userForumCreate');
    Route::post('/ruang-diskusi/simpan-ruang-diskusi', [DiscussionController::class, 'storeUser'])->name('userForumStore');
    Route::post('/ruang-diskusi/simpan-komen-ruang-diskusi/{id}', [DiscussionController::class, 'storeKomenUser'])->name('userKomenStore');


});

Route::get('/admin/pelatihan/reguler', [RegulerController::class, 'index'])->name('regulerAdmin');
Route::get('/admin/pelatihan/reguler/tambah-pelatihan', [RegulerController::class, 'create'])->name('regulerCreateAdmin');
Route::post('/admin/pelatihan/reguler/simpan-pelatihan', [RegulerController::class, 'store'])->name('regulerStoreAdmin');
Route::get('/admin/pelatihan/reguler/lihat-pelatihan/{id}', [RegulerController::class, 'show'])->name('regulerShowAdmin');
Route::get('/admin/pelatihan/reguler/edit-pelatihan/{id}', [RegulerController::class, 'edit'])->name('regulerEditAdmin');
Route::put('/admin/pelatihan/reguler/update-pelatihan/{id}', [RegulerController::class, 'update'])->name('regulerUpdateAdmin');
Route::delete('/admin/pelatihan/reguler/hapus-pelatihan/{id}', [RegulerController::class, 'destroy'])->name('regulerDestroyAdmin');

Route::get('/admin/pelatihan/permintaan', [PermintaanController::class, 'index'])->name('permintaanAdmin');
Route::get('/admin/pelatihan/permintaan/tambah-pelatihan', [PermintaanController::class, 'create'])->name('permintaanCreateAdmin');

Route::get('/admin/pelatihan/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasiAdmin');
Route::get('/admin/pelatihan/konsultasi/lihat-konsultasi/{id}', [KonsultasiController::class, 'show'])->name('konsultasiShowAdmin');
Route::get('/admin/pelatihan/konsultasi/buat-pelatihan-konsultasi/{id}', [KonsultasiController::class, 'create'])->name('konsultasiCreateAdmin');
Route::post('/admin/pelatihan/konsultasi/simpan-konsultasi', [KonsultasiController::class, 'store'])->name('konsultasiStoreAdmin');

Route::get('/admin/evaluasi/reguler', [EvaluasiController::class, 'indexReguler'])->name('evaluasiRegulerAdmin');
Route::get('/admin/evaluasi/buat-form-evaluasi-reguler/{id}', [EvaluasiController::class, 'createReguler'])->name('evaluasiCreateRegulerAdmin');
Route::post('/admin/evaluasi/simpan-form-evaluasi-reguler', [EvaluasiController::class, 'storeReguler'])->name('evaluasiStoreRegulerAdmin');
Route::get('/admin/evaluasi/lihat-evaluasi-reguler/{id}', [EvaluasiController::class, 'showReguler'])->name('evaluasiShowRegulerAdmin');
Route::view('/admin/evaluasi/edit-form-evaluasi-reguler/{id}', 'admin.evaluasi.reguler.edit');
Route::get('/admin/evaluasi/edit-form-evaluasireguler/{id}', [EvaluasiController::class, 'editReguler'])->name('evaluasiEditRegulerAdmin');

Route::get('/admin/evaluasi/permintaan', [EvaluasiController::class, 'indexPermintaan'])->name('evaluasiPermintaanAdmin');
Route::get('/admin/evaluasi/buat-form-evaluasi-permintaan', [EvaluasiController::class, 'createPermintaan'])->name('evaluasiCreatePermintaanAdmin');
Route::get('/admin/evaluasi/lihat-evaluasi-permintaan', [EvaluasiController::class, 'showPermintaan'])->name('evaluasiShowPermintaanAdmin');

Route::get('/admin/survey/reguler', [SurveyController::class, 'indexReguler'])->name('surveyRegulerAdmin');
Route::get('/admin/survey/lihat-survey-reguler/{id}', [SurveyController::class, 'showReguler'])->name('surveyShowRegulerAdmin');
Route::get('/admin/survey/buat-form-survey-reguler/{id}', [SurveyController::class, 'createReguler'])->name('surveyCreateRegulerAdmin');
Route::post('/admin/survey/simpan-form-survey-reguler', [SurveyController::class, 'storeReguler'])->name('surveyStoreRegulerAdmin');
Route::view('/admin/survey/edit-form-survey-reguler/{id}', 'admin.survey.reguler.edit');
Route::get('/admin/survey/edit-form-surveyreguler/{id}', [SurveyController::class, 'editReguler'])->name('surveyEditRegulerAdmin');

Route::get('/admin/studidampak/reguler', [StudiController::class, 'indexReguler'])->name('studiRegulerAdmin');
Route::get('/admin/studidampak/lihat-studidampak-reguler/{id}', [StudiController::class, 'showReguler'])->name('studidampakShowRegulerAdmin');
Route::get('/admin/studidampak/buat-form-studidampak-reguler/{id}', [StudiController::class, 'createReguler'])->name('studidampakCreateRegulerAdmin');
Route::post('/admin/studidampak/simpan-form-studidampak-reguler', [StudiController::class, 'storeReguler'])->name('studidampakStoreRegulerAdmin');
Route::view('/admin/studidampak/edit-form-studidampak-reguler/{id}', 'admin.studi.reguler.edit');
Route::get('/admin/studidampak/edit-form-studidampakreguler/{id}', [StudiController::class, 'editReguler'])->name('studidampakEditRegulerAdmin');

Route::get('/admin/fasilitator', [FasilitatorController::class, 'index'])->name('fasilitatorAdmin');
Route::get('/admin/fasilitator/tambah-fasilitator', [FasilitatorController::class, 'create'])->name('fasilitatorCreateAdmin');
Route::post('/admin/fasilitator/simpan-fasilitator', [FasilitatorController::class, 'store'])->name('fasilitatorStoreAdmin');
Route::get('/admin/fasilitator/{id_fasilitator}', [FasilitatorController::class, 'show'])->name('fasilitatorShowAdmin');
Route::get('/admin/fasilitator/edit-fasilitator/{id_fasilitator}', [FasilitatorController::class, 'edit'])->name('fasilitatorEditAdmin');
Route::put('/admin/fasilitator/update-fasilitator/{id_fasilitator}', [FasilitatorController::class, 'update'])->name('fasilitatorUpdateAdmin');
Route::delete('/admin/fasilitator/hapus-fasilitator/{id_fasilitator}', [FasilitatorController::class, 'destroy'])->name('fasilitatorDestroyAdmin');