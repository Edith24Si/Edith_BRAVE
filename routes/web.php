<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MultipleUploadController;
use App\Http\Controllers\ProductController;





Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
});

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: '.$param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'NIM saya: '.$param1;
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

Route::get('/mahasiswa/{paraml}',[MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/home',[HomeController::class, 'index'])
    ->name('home');

Route::get('/question/store',[QuestionController::class, 'store'])
    ->name('question.store');

Route::get('dashboard', [DashboardController::class,'index'])
 ->name('dashboard');

 Route::resource('pelanggan', PelangganController::class);

 Route::resource('user', UserController::class);

// Routes untuk Multiple Upload pada Pelanggan
Route::post('/pelanggan/upload', [MultipleUploadController::class, 'store'])->name('pelanggan.upload');
Route::delete('/pelanggan/delete-file/{id}', [MultipleUploadController::class, 'destroy'])->name('pelanggan.deleteFile');

// Routes lainnya
Route::resource('products', ProductController::class);


