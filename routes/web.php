<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegulerController;
use App\Http\Controllers\TrainingController;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/admin/reguler', [RegulerController::class, 'index'])->name('regulerAdmin');