<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Models\PetugasModel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
});

//auth route for all routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [MainController::class, 'index']);
});

//auth route for admin
Route::group(['middleware' => ['auth', 'role:admin']], function() {
    Route::get('/profileSaya', [AdminController::class, 'profileSaya']);
    Route::get('/dashboardAdmin', [AdminController::class, 'index']);
    Route::get('/daftarBuku', [AdminController::class, 'daftarBuku']);
    Route::post('/tambahBuku', [AdminController::class, 'tambahBuku']);
    Route::post('/hapusBuku', [AdminController::class, 'hapusBuku']);
    Route::get('/detailBuku/{id}', [AdminController::class, 'detailBuku']);
    Route::post('/getBukuRow', [AdminController::class, 'getBukuRow']);
    Route::put('/editBuku/', [AdminController::class, 'editBuku']);
    Route::get('/exportBukuExcel', [AdminController::class, 'exportBukuExcel']);
    Route::get('/exportBukuPdf/{cari}', [AdminController::class, 'exportBukuPdf']);
    Route::get('/dataPetugas', [AdminController::class, 'dataPetugas']);
    Route::get('/refreshBuku', [AdminController::class, 'refreshBuku']);
    Route::post('/hapusPetugas', [AdminController::class, 'hapusPetugas']);
    Route::get('/refreshPetugas', [AdminController::class, 'refreshPetugas']);
    Route::get('/exportPetugasExcel', [AdminController::class, 'exportPetugasExcel']);
    Route::get('/exportPetugasPdf/{cari}', [AdminController::class, 'exportPetugasPdf']);
    Route::get('/detailPetugas/{id}',[AdminController::class, 'detailPetugas']);
    Route::get('/dataAnggota', [AdminController::class, 'dataAnggota']);
    Route::get('/detailAnggota/{id}', [AdminController::class, 'detailAnggota']);
    Route::post('/hapusAnggota', [AdminController::class, 'hapusAnggota']);
    Route::get('/refreshAnggota', [AdminController::class, 'refreshAnggota']);
    Route::get('/exportAnggotaExcel', [AdminController::class, 'exportAnggotaExcel']);
    Route::get('/exportAnggotaPdf/{cari}', [AdminController::class, 'exportAnggotaPdf']);
});

//auth route for petugas
Route::group(['middleware' => ['auth', 'role:petugas']], function() {
    Route::get('dashboardPetugas', [PetugasController::class, 'index']);
    Route::get('/daftarBukuPetugas', [PetugasController::class, 'daftarBuku']);
    Route::post('/tambahBukuPetugas', [PetugasController::class, 'tambahBuku']);
    Route::get('/dataAnggotaPetugas', [PetugasController::class, 'dataAnggota']);
    Route::get('/dataPeminjaman', [PetugasController::class, 'dataPeminjaman']);
    Route::post('/tambahPeminjaman', [PetugasController::class, 'tambahPeminjaman']);
    Route::get('/detailPeminjaman/{id}', [PetugasController::class, 'detailPeminjaman']);
    Route::post('/getPeminjamanRow', [PetugasController::class, 'getPeminjamanRow']);
    Route::post('/perpanjangan', [PetugasController::class, 'perpanjangPinjam']);
});
require __DIR__.'/auth.php';
