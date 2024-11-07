<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pertemuan1;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\users;
use App\Http\Controllers\posts2;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\SendEmailController;



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

Route::get('/bukupublic', [BukuController::class, 'indexpublic'])->name('buku.index.public') ;
Route::get('/admin/buku', [BukuController::class, 'indexadmin'])->name('buku.index.admin') ;


// cara pertama menggunakan menggunakan middleware
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create')->middleware('admin');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store')->middleware('admin');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy')->middleware('admin');
Route::put('/buku/edit/{id}', [BukuController::class, 'update'])->name('buku.update')->middleware('admin');
Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit')->middleware('admin');
Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search')->middleware('admin');


//cara kedua menggunakan menggunakan middleware
// Route::middleware(['admin'])->group(function(){
//     Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
//     Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
//     Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
//     Route::put('/buku/edit/{id}', [BukuController::class, 'update'])->name('buku.update');
//     Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
//     Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
// });

// praktikum 9
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
   });


// praktikum 10
   Route::get('/send-mail', [SendEmailController::class,
   'index'])->name('kirim-email');

   Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');


//    Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
//    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
   Route::get('/home', function() {
       return view('home'); // Adjust this to your actual home view
   })->name('home');



