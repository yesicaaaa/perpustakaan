<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AnggotaController;
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
    Route::get('/restore', [AdminController::class, 'restore']);
    Route::get('/dashboardAdmin', [AdminController::class, 'index']);
    Route::get('/daftarBuku', [AdminController::class, 'daftarBuku']);
    Route::post('/tambahBuku', [AdminController::class, 'tambahBuku']);
    Route::post('/hapusBuku', [AdminController::class, 'hapusBuku']);
    Route::get('/detailBuku/{id}', [AdminController::class, 'detailBuku']);
    Route::post('/getBukuRow', [AdminController::class, 'getBukuRow']);
    Route::put('/editBuku/', [AdminController::class, 'editBuku']);
    Route::get('/exportBukuExcel', [AdminController::class, 'exportBukuExcel']);
    Route::get('/exportBukuPdf/', [AdminController::class, 'exportBukuPdf']);
    Route::get('/dataPetugas', [AdminController::class, 'dataPetugas']);
    Route::get('/refreshBuku', [AdminController::class, 'refreshBuku']);
    Route::post('/hapusPetugas', [AdminController::class, 'hapusPetugas']);
    Route::get('/refreshPetugas', [AdminController::class, 'refreshPetugas']);
    Route::get('/exportPetugasExcel', [AdminController::class, 'exportPetugasExcel']);
    Route::get('/exportPetugasPdf', [AdminController::class, 'exportPetugasPdf']);
    Route::get('/detailPetugas/{id}',[AdminController::class, 'detailPetugas']);
    Route::get('/dataAnggota', [AdminController::class, 'dataAnggota']);
    Route::get('/detailAnggota/{id}', [AdminController::class, 'detailAnggota']);
    Route::post('/hapusAnggota', [AdminController::class, 'hapusAnggota']);
    Route::get('/refreshAnggota', [AdminController::class, 'refreshAnggota']);
    Route::get('/exportAnggotaExcel', [AdminController::class, 'exportAnggotaExcel']);
    Route::get('/exportAnggotaPdf', [AdminController::class, 'exportAnggotaPdf']);
    Route::get('/profileSayaAdmin', [AdminController::class, 'profileSaya']);
    Route::post('/ubahProfileSayaAdmin', [AdminController::class, 'ubahProfileSaya']);
    Route::get('/laporanPeminjaman', [AdminController::class, 'laporanPeminjaman']);
    Route::get('/detailLaporanPeminjaman/{tgl}', [AdminController::class, 'detailLaporanPeminjaman']);
    Route::get('/laporanPengembalian', [AdminController::class, 'laporanPengembalian']);
    Route::get('/detailLaporanPengembalian/{tgl}', [AdminController::class, 'detailLaporanPengembalian']);
    Route::get('/exportLaporanPeminjamanExcel', [AdminController::class, 'exportLaporanPeminjamanExcel']);
    Route::get('/exportLaporanPeminjamanPdf', [AdminController::class, 'exportLaporanPeminjamanPdf']);
    Route::get('/exportDetailLaporanPeminjamanExcel/{tgl}', [AdminController::class, 'exportDetailLaporanPeminjamanExcel']);
    Route::get('/exportDetailLaporanPeminjamanPdf/{tgl}', [AdminController::class, 'exportDetailLaporanPeminjamanPdf']);
    Route::get('/exportLaporanPengembalianExcel', [AdminController::class, 'exportLaporanPengembalianExcel']);
    Route::get('/exportLaporanPengembalianPdf', [AdminController::class, 'exportLaporanPengembalianPdf']);
    Route::get('/exportDetailLaporanPengembalianExcel/{tgl}', [AdminController::class, 'exportDetailLaporanPengembalianExcel']);
    Route::get('/exportDetailLaporanPengembalianPdf/{tgl}', [AdminController::class, 'exportDetailLaporanPengembalianPdf']);
});

//auth route for petugas
Route::group(['middleware' => ['auth', 'role:petugas']], function() {
    Route::get('/dashboardPetugas', [PetugasController::class, 'index']);
    Route::get('/bukuDitambahkanPetugas', [PetugasController::class, 'bukuDitambahkanPetugas']);
    Route::get('/AnggotaDitambahkanPetugas', [PetugasController::class, 'anggotaDitambahkanPetugas']);
    Route::get('/daftarBukuPetugas', [PetugasController::class, 'daftarBuku']);
    Route::post('/tambahBukuPetugas', [PetugasController::class, 'tambahBuku']);
    Route::get('/dataAnggotaPetugas', [PetugasController::class, 'dataAnggota']);
    Route::get('/dataPeminjaman/', [PetugasController::class, 'dataPeminjaman']);
    Route::post('/tambahPeminjaman', [PetugasController::class, 'tambahPeminjaman']);
    Route::get('/detailPeminjaman/{id}', [PetugasController::class, 'detailPeminjaman']);
    Route::post('/getPeminjamanRow', [PetugasController::class, 'getPeminjamanRow']);
    Route::post('/perpanjangan', [PetugasController::class, 'perpanjangPinjam']);
    Route::get('/dataPengembalian', [PetugasController::class, 'dataPengembalian']);
    Route::post('/getPeminjamanPengembalianRow/', [PetugasController::class, 'getPeminjamanPengembalianRow']);
    Route::post('/pengembalian', [PetugasController::class, 'pengembalian']);
    Route::get('/profileSayaPetugas', [PetugasController::class, 'profileSaya']);
    Route::post('/ubahProfileSayaPetugas', [PetugasController::class, 'ubahProfileSaya']);
    Route::get('/historyPengembalian', [PetugasController::class, 'historyPengembalian']);
    Route::get('/exportBukuDitambahkanExcel', [PetugasController::class, 'exportBukuDitambahkanExcel']);
    Route::get('/exportBukuDitambahkanPdf', [PetugasController::class, 'exportBukuDitambahkanPdf']);
    Route::get('/exportAnggotaDitambahkanExcel', [PetugasController::class, 'exportAnggotaDitambahkanExcel']);
    Route::get('/exportAnggotaDitambahkanPdf', [PetugasController::class, 'exportAnggotaDitambahkanPdf']);
    Route::get('/exportPeminjamanPetugasExcel', [PetugasController::class, 'exportPeminjamanPetugasExcel']);
    Route::get('/exportPeminjamanPetugasPdf', [PetugasController::class, 'exportPeminjamanPetugasPdf']);
    Route::get('/exportDetailPeminjamanPetugasExcel/{id}', [PetugasController::class, 'exportDetailPeminjamanPetugasExcel']);
    Route::get('/exportDetailPeminjamanPetugasPdf/{id}', [PetugasController::class, 'exportDetailPeminjamanPetugasPdf']);
    Route::get('/exportDataPengembalianPetugasExcel', [PetugasController::class, 'exportDataPengembalianPetugasExcel']);
    Route::get('/exportDataPengembalianPetugasPdf', [PetugasController::class, 'exportDataPengembalianPetugasPdf']);
    Route::get('/exportHistoryPengembalianPetugasExcel', [PetugasController::class, 'exportHistoryPengembalianPetugasExcel']);
    Route::get('/exportHistoryPengembalianPetugasPdf', [PetugasController::class, 'exportHistoryPengembalianPetugasPdf']);
});

//auth route for anggota
Route::group(['middleware' => ['auth', 'role:anggota']], function() {
    Route::get('/dashboardAnggota/{id}', [AnggotaController::class, 'index']);
    Route::get('/daftarBukuAnggota', [AnggotaController::class, 'daftarBuku']);
    Route::get('/cariBukuAnggota', [AnggotaController::class, 'cariBukuAnggota']);
    Route::get('/peminjamanSaya/{id}', [AnggotaController::class, 'peminjamanSaya']);
    Route::post('/getPerpanjanganAnggotaRow', [AnggotaController::class, 'getPerpanjanganAnggotaRow']);
    Route::post('/perpanjanganAnggota', [AnggotaController::class, 'perpanjangPeminjaman']);
    Route::get('/cariPeminjamanAnggota', [AnggotaController::class, 'cariPeminjamanAnggota']);
    Route::get('/historySaya/{id}', [AnggotaController::class, 'historySaya']);
    Route::get('/profileSaya', [AnggotaController::class, 'profileSaya']);
    Route::post('/ubahProfileSaya', [AnggotaController::class, 'ubahProfileSaya']);
    Route::get('/bukuDipinjam/{id}', [AnggotaController::class, 'bukuDipinjam']);
    Route::get('/harusDikembalikan/{id}', [AnggotaController::class, 'harusDikembalikan']);
    Route::get('/dendaAnggota/{id}', [AnggotaController::class, 'dendaAnggota']);
});
require __DIR__.'/auth.php';
