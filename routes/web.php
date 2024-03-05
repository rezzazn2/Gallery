<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\userController;
use App\Http\Controllers\searchController;
use App\Http\Controllers\galleryController;
use App\Models\laporan;

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
Route::get('', function() {
    if(auth()->check()){
        return redirect('/beranda');
    }else{
        return redirect('/guest');
    }
});
// Route::get('', [authController::class, 'checkAuth']);
Route::get('/login', function () {
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
Route::get('guest', [galleryController::class, 'guest']);

Route::post('edit-user', [userController::class, 'editUser'])->middleware('auth:web')->name('edit-user');
Route::post('edit-komentar', [userController::class, 'editKomentar'])->middleware('auth:web')->name('edit-komentar');

// admin

Route::get('admin', [adminController::class, 'checkAdmin'])->middleware('auth:web')->name('data-user');
Route::get('laporan', [adminController::class, 'laporan'])->middleware('auth:web')->name('laporan');


// user
Route::get('success-message', [response::class, 'addSuccessMessage'])->middleware('auth:web')->name('success-message');
Route::get('get-latest-user-data', [userController::class, 'getLatestUserData'])->middleware('auth:web')->name('lastestUserData');
Route::post('edit-foto', [searchController::class, 'editFoto'])->middleware('auth:web')->name('edit-foto');
Route::post('edit-album', [searchController::class, 'editAlbum'])->middleware('auth:web');

// Route Gallery

Route::get('beranda', [galleryController::class, 'index'])->middleware('auth:web')->name('beranda');

Route::get('buat', [galleryController::class, 'hlmBuat'])->middleware('auth:web');
Route::post('buat', [galleryController::class, 'store'])->middleware('auth:web');

Route::get('buat-album', [galleryController::class, 'buatAlbum'])->middleware('auth:web');
Route::post('buat-album', [galleryController::class, 'storeAlbum'])->middleware('auth:web');

Route::get('profil', [galleryController::class, 'hlmProfil'])->middleware('auth:web');
Route::get('bookmark', [galleryController::class, 'hlmBookMark'])->middleware('auth:web')->name('bookmark');


// rute ajax
Route::get('search', [searchController::class, 'search'])->name('search');
Route::get('search-user', [userController::class, 'searchUser'])->middleware('auth:web')->name('search-user');
Route::get('search-lapor', [userController::class, 'searchLapor'])->middleware('auth:web')->name('search-lapor');
Route::get('modal-simpan', [searchController::class, 'modalById'])->middleware('auth:web')->name('modal-simpan');
Route::get('simpan-ke-album', [searchController::class, 'storeFotoAlbum'])->middleware('auth:web')->name('simpan-ke-album');
Route::get('preview-img', [searchController::class, 'previewImg'])->name('preview-img');
Route::get('tambah-komentar', [searchController::class, 'storeKomentar'])->middleware('auth:web')->name('tambah-komentar');
Route::get('like', [searchController::class, 'prosesLike'])->middleware('auth:web')->name('likefoto');
Route::post('report-foto', [userController::class, 'report'])->middleware('auth:web')->name('report-foto');



Route::get('hapus-foto', [searchController::class, 'hapusFoto'])->middleware('auth:web')->name('hapus-foto');
Route::get('hapus-album', [searchController::class, 'hapusAlbum'])->middleware('auth:web')->name('hapus-album');
Route::get('hapus-user', [userController::class, 'hapusUser'])->middleware('auth:web')->name('hapus-user');
Route::get('hapus-komen', [userController::class, 'hapusKomen'])->middleware('auth:web')->name('hapus-komen');
Route::get('hapus-lapor', [userController::class, 'hapuslapor'])->middleware('auth:web')->name('hapus-lapor');

Route::get('modal-edit-foto', [searchController::class, 'modalEditFoto'])->middleware('auth:web')->name('modal-edit-foto');
Route::get('modal-edit-album', [searchController::class, 'modalEditAlbum'])->middleware('auth:web')->name('modal-edit-album');
Route::get('modal-album', [searchController::class, 'modalAlbum'])->middleware('auth:web')->name('modal-album');
Route::get('modal-edit-user', [userController::class, 'modalEditUser'])->middleware('auth:web')->name('modal-edit-user');
Route::get('modal-report', [userController::class, 'modalReport'])->middleware('auth:web')->name('modal-report');
Route::get('modal-edit-komen', [userController::class, 'modaleditKomen'])->middleware('auth:web')->name('modal-edit-komen');
Route::get('modal-preview-foto', [userController::class, 'modalPreviewFoto'])->middleware('auth:web')->name('modal-preview-foto');
Route::get('konfirmasi-lapor', [userController::class, 'konfirmasiLapor'])->middleware('auth:web')->name('konfirmasi-lapor');











