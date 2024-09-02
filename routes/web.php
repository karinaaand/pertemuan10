<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pertemuan1;
use App\Http\Controllers\PostController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashbor', [pertemuan1::class, 'dashbor'])->name('mahasiswa.dashbor');

/*1 View Tanpa Extends*/
Route::get('/about', function () {
    return view('content.about', [
        "name" => "lala",
        "email" => "lala@gmail.com"
    ]);
});


/*2 Extends Kakanya*/
Route::get('/dashboard', function () {
    return view('content.dashboard');
});



/*3 Tugas Praktikum*/
Route::get('/selamat_datang', function () {
    return view('percobaan.selamat_datang');
});

Route::get('/tentang', function () {
    return view('percobaan.tentang');
});

Route::get('/kontak', function () {
    return view('percobaan.kontak');
});


/*Route cara lain*/
Route::get('about2', function () {
    return view('about2');
})->name('about');

Route::get('/posts', [PostController::class, 'index']);
