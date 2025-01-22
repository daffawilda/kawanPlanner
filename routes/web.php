<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MataPelajaranController;



Route::get('/', function () {
    return view('Home');
});
Route::get('/tes', function (){
    return view ('tes');
});
Route::get('/peminatan', function (){
    return view ('infMapel');
});

Route::get('/admin', function (){
    return view ('homeAdmin');
});

Route::resource('jurusan', JurusanController::class);
Route::get('/informasi-mata-pelajaran', [JurusanController::class, 'informasiMataPelajaran'])->name('informasi.mataPelajaran');



Route::resource('guru', GuruController::class);

Route::resource('mataPelajaran', MataPelajaranController::class);
Route::get('get-gurus/{jurusanId}', [MataPelajaranController::class, 'getGurus']);
Route::get('/mata-pelajaran/{id}', [MataPelajaranController::class, 'show'])->name('mataPelajaran.show');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
