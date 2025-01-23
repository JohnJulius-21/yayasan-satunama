<?php

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
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\FasilitatorController;

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

Route::get('/pelatihan/reguler/{id}', [TrainingController::class, 'showReguler'])->name('reguler.show');


Route::get('/pelatihan/list', [TrainingController::class, 'regulerList'])
        ->name('reguler.pelatihan');

Route::get('/pelatihan/list/{id}', [TrainingController::class, 'regulerListShow'])
        ->name('reguler.pelatihan.list');

Route::post('/pelatihan/reguler/simpanReguler', [TrainingController::class, 'storeReguler'])->name('reguler.store');

Route::get('/get-provinsi/{negaraId}', [TrainingController::class, 'getProvinsi']);
Route::get('/get-kabupaten/{provinsiId}', [TrainingController::class, 'getKabupaten']);


Route::middleware(['user'])->group(function () {
    Route::get('/pelatihan/permintaan/create', [TrainingController::class, 'createPermintaan'])
        ->name('permintaan.create');

    Route::get('/pelatihan/konsultasi/create', [TrainingController::class, 'createKonsultasi'])
        ->name('konsultasi.create');

    Route::get('/pelatihan/reguler/create/{id}', [TrainingController::class, 'createReguler'])
        ->name('reguler.create');
        
    Route::get('/pelatihan/permintaan/show', [TrainingController::class, 'permintaanShow'])
        ->name('permintaan.pelatihan.show');

    Route::get('/pelatihan/konsultasi/show', [TrainingController::class, 'konsultasiShow'])
        ->name('konsultasi.pelatihan.show');
    
    
});

Route::get('/admin/pelatihan/reguler', [RegulerController::class, 'index'])->name('regulerAdmin');
Route::get('/admin/pelatihan/reguler/tambah-pelatihan', [RegulerController::class, 'create'])->name('regulerCreateAdmin');
Route::get('/admin/pelatihan/reguler/simpan-pelatihan', [RegulerController::class, 'store'])->name('regulerStoreAdmin');

Route::get('/admin/pelatihan/permintaan', [PermintaanController::class, 'index'])->name('permintaanAdmin');
Route::get('/admin/pelatihan/permintaan/tambah-pelatihan', [PermintaanController::class, 'create'])->name('permintaanCreateAdmin');

Route::get('/admin/pelatihan/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasiAdmin');
Route::get('/admin/pelatihan/konsultasi/tambah-pelatihan', [KonsultasiController::class, 'create'])->name('konsultasiCreateAdmin');

Route::get('/admin/evaluasi/reguler', [EvaluasiController::class, 'indexReguler'])->name('evaluasiRegulerAdmin');
Route::get('/admin/evaluasi/buat-form-evaluasi-reguler', [EvaluasiController::class, 'createReguler'])->name('evaluasiCreateRegulerAdmin');
Route::get('/admin/evaluasi/lihat-evaluasi-reguler', [EvaluasiController::class, 'showReguler'])->name('evaluasiShowRegulerAdmin');

Route::get('/admin/evaluasi/permintaan', [EvaluasiController::class, 'indexPermintaan'])->name('evaluasiPermintaanAdmin');
Route::get('/admin/evaluasi/buat-form-evaluasi-permintaan', [EvaluasiController::class, 'createPermintaan'])->name('evaluasiCreatePermintaanAdmin');
Route::get('/admin/evaluasi/lihat-evaluasi-permintaan', [EvaluasiController::class, 'showPermintaan'])->name('evaluasiShowPermintaanAdmin');

Route::get('/admin/surveykepuasan', [SurveyController::class, 'index'])->name('surveyAdmin');
Route::get('/admin/surveykepuasan/tambah-survey-kepuasan', [SurveyController::class, 'create'])->name('surveyCreateAdmin');

Route::get('/admin/studidampak', [StudiController::class, 'index'])->name('studiAdmin');
Route::get('/admin/studidampak/tambah-studi-dampak', [studiController::class, 'create'])->name('studiCreateAdmin');

Route::get('/admin/fasilitator', [FasilitatorController::class, 'index'])->name('fasilitatorAdmin');
Route::get('/admin/fasilitator/tambah-fasilitator', [FasilitatorController::class, 'create'])->name('fasilitatorCreateAdmin');
Route::post('/admin/fasilitator/simpan-fasilitator', [FasilitatorController::class, 'store'])->name('fasilitatorStoreAdmin');
Route::get('/admin/fasilitator/{id_fasilitator}', [FasilitatorController::class, 'show'])->name('fasilitatorShowAdmin');
Route::get('/admin/fasilitator/edit-fasilitator/{id_fasilitator}', [FasilitatorController::class, 'edit'])->name('fasilitatorEditAdmin');
Route::put('/admin/fasilitator/update-fasilitator/{id_fasilitator}', [FasilitatorController::class, 'update'])->name('fasilitatorUpdateAdmin');
Route::delete('/admin/fasilitator/hapus-fasilitator/{id_fasilitator}', [FasilitatorController::class, 'destroy'])->name('fasilitatorDestroyAdmin');