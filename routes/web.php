<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;

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
    Route::get('/dashboardAdmin', [AdminController::class, 'index']);
});
require __DIR__.'/auth.php';
