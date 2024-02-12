<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\galleryController;
use App\Http\Controllers\searchController;
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

Route::get('beranda', [galleryController::class, 'index'])->middleware('auth:web')->name('beranda');

Route::get('buat', [galleryController::class, 'hlmBuat'])->middleware('auth:web');
Route::post('buat', [galleryController::class, 'store'])->middleware('auth:web');

Route::get('buat-album', [galleryController::class, 'buatAlbum'])->middleware('auth:web');
Route::post('buat-album', [galleryController::class, 'storeAlbum'])->middleware('auth:web');

Route::get('profil', [galleryController::class, 'hlmProfil'])->middleware('auth:web');
Route::get('bookmark', [galleryController::class, 'hlmBookMark'])->middleware('auth:web');


// rute ajax
Route::get('search', [searchController::class, 'search'])->middleware('auth:web')->name('search');
Route::get('modal-simpan', [searchController::class, 'modalById'])->middleware('auth:web')->name('modal-simpan');
Route::get('simpan-ke-album', [searchController::class, 'storeFotoAlbum'])->middleware('auth:web')->name('simpan-ke-album');
Route::get('preview-img', [searchController::class, 'previewImg'])->middleware('auth:web')->name('preview-img');
Route::get('tambah-komentar', [searchController::class, 'storeKomentar'])->middleware('auth:web')->name('tambah-komentar');
Route::get('like', [searchController::class, 'prosesLike'])->middleware('auth:web')->name('likefoto');










