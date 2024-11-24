<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/books', App\Http\Controllers\Api\BookApiController::class);


Route::apiResource('items', ItemController::class);

// Route untuk mengambil semua data item
Route::get('/items', [ItemController::class, 'index']);

// Route untuk menambah data item baru
Route::post('/items', [ItemController::class, 'store']);

// Route untuk mengupdate data item berdasarkan ID
Route::put('/items/{id}', [ItemController::class, 'update']);

// Route untuk menghapus data item berdasarkan ID
Route::delete('/items/{id}', [ItemController::class, 'destroy']);
