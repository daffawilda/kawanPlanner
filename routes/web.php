<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\TesController;

Route::get('/', function () {
    return view('Home');
});

route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/informasi-mata-pelajaran', [JurusanController::class, 'informasiMataPelajaran'])->name('informasi.mataPelajaran');
Route::get('mataPelajaran/{id}', [MataPelajaranController::class, 'show'])->name('mataPelajaran.show');



Route::get('/tes', [TesController::class, 'index'])->name('tes.index');
Route::get('tes/{jurusanId}', [TesController::class, 'showTes'])->name('tes.show');
Route::post('tes', [TesController::class, 'storeTes'])->name('tes.store');


Route::middleware('auth')->group(function () {
    //admin
    Route::get('/admin', function (){
        return view ('homeAdmin');
    });
    //jurusan
    Route::group(['prefix' => 'jurusan'], function () {
        Route::get('/', [JurusanController::class, 'index'])->name('jurusan.index'); // Tampil daftar jurusan
        Route::get('/create', [JurusanController::class, 'create'])->name('jurusan.create'); // Form tambah jurusan
        Route::post('/create', [JurusanController::class, 'store'])->name('jurusan.store'); // Simpan jurusan
        Route::get('/{id}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit'); // Form edit jurusan
        Route::put('/{id}/edit', [JurusanController::class, 'update'])->name('jurusan.update'); // Update jurusan
        Route::delete('/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy'); // Hapus jurusan
    });
    //guru
    Route::group(['prefix' => 'guru'], function () {
        Route::get('/', [GuruController::class, 'index'])->name('guru.index'); // Tampil daftar guru
        Route::get('/create', [GuruController::class, 'create'])->name('guru.create'); // Form tambah guru
        Route::post('/create', [GuruController::class, 'store'])->name('guru.store'); // Simpan guru
        Route::get('/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit'); // Form edit guru
        Route::put('/{id}/edit', [GuruController::class, 'update'])->name('guru.update'); // Update guru
        Route::delete('/{id}', [GuruController::class, 'destroy'])->name('guru.destroy'); // Hapus guru
    });
    //mataPelajaran
    Route::group(['prefix' => 'mata-pelajaran'], function () {
        Route::get('/', [MataPelajaranController::class, 'index'])->name('mataPelajaran.index'); // Tampil daftar mataPelajaran
        Route::get('/create', [MataPelajaranController::class, 'create'])->name('mataPelajaran.create'); // Form tambah mataPelajaran
        Route::post('/create', [MataPelajaranController::class, 'store'])->name('mataPelajaran.store'); // Simpan mataPelajaran
        Route::get('/{id}/edit', [MataPelajaranController::class, 'edit'])->name('mataPelajaran.edit'); // Form edit mataPelajaran
        Route::put('/{id}/edit', [MataPelajaranController::class, 'update'])->name('mataPelajaran.update'); // Update mataPelajaran
        Route::delete('/{id}', [MataPelajaranController::class, 'destroy'])->name('mataPelajaran.destroy'); // Hapus mataPelajaran
        Route::delete('/delete-all', [MataPelajaranController::class, 'destroyAll'])->name('mataPelajaran.destroyAll');
    });

    Route::get('get-gurus/{jurusanId}', [MataPelajaranController::class, 'getGurus']);
    Route::get('/get-mata-pelajaran/{jurusanId}', [SoalController::class, 'getMataPelajaran']);
    
    //soals
    route::group(['prefix' => 'soals'], function () {
        Route::get('/', [SoalController::class, 'index'])->name('soals.index'); // Tampil daftar soal
        Route::get('/create', [SoalController::class, 'create'])->name('soals.create'); // Form tambah soal
        Route::post('/create', [SoalController::class, 'store'])->name('soals.store'); // Simpan soal
        Route::get('/{id}/edit', [SoalController::class, 'edit'])->name('soals.edit'); // Form edit soal
        Route::put('/{id}/edit', [SoalController::class, 'update'])->name('soals.update'); // Update soal
        Route::delete('/{id}', [SoalController::class, 'destroy'])->name('soals.destroy'); // Hapus soal
        Route::delete('/delete-all', [SoalController::class, 'destroyAll'])->name('soals.destroyAll');
    });
    Route::delete('/delete-all', [SoalController::class, 'destroyAll'])
    ->name('soals.destroyAll');
    Route::get('/logout', function (\Illuminate\Http\Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

});

require __DIR__.'/auth.php';
