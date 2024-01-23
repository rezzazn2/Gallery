<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\galleryController;
use Illuminate\Support\Facades\Route;

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

// Route auth

Route::get('/', function () {
    return view('auth.login.login');
});
Route::get('register', function () {
    return view('auth.register.register');
});
Route::post('register', [authController::class, 'register']);

Route::get('login', function () {
    return view('auth.login.login');
})->name('login');

Route::post('login', [authController::class, 'login']);

Route::get('logout', [authController::class, 'logout']);

// Route Gallery

Route::get('beranda', [galleryController::class, 'index'])->middleware('auth:web');

Route::get('buat', [galleryController::class, 'hlmBuat'])->middleware('auth:web');

Route::post('buat', [galleryController::class, 'store'])->middleware('auth:web');








