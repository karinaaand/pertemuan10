<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pertemuan1;
use App\Http\Controllers\PostController;
use App\Http\Controllers\users;
use App\Http\Controllers\posts2;
use App\Http\Controllers\BukuController;



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

/*Tugas praktikum 4 */
Route::get('/users', [users::class, 'index']);

Route::get('/posts2', [posts2::class, 'index']);

/*Pertemuan 5 dan 6*/
Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::get('/buku/{id}', [BukuController::class, 'edit'])->name('buku.edit');
