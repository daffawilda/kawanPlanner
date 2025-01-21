<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\GuruController;


Route::get('/', function () {
    return view('Home');
});
Route::get('/tes', function (){
    return view ('tes');
});
Route::get('/peminatan', function (){
    return view ('infMapel');
});
Route::get('/kerja', function (){
    return view ('kerja');
});
Route::get('/informasi', function (){
    return view ('informasi');
});
Route::get('/admin', function (){
    return view ('homeAdmin');
});

Route::resource('jurusan', JurusanController::class);
Route::resource('guru', GuruController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
