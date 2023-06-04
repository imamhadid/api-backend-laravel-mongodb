<?php

use App\Http\Controllers\AuthController;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PenjualanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/kendaraan/{type}', [KendaraanController::class, 'store']);
    Route::get('/kendaraan', [KendaraanController::class, 'index']);

    Route::post('/beli-kendaraan', [KendaraanController::class, 'beliKendaraan']);
    Route::get('/kendaraan-detail/{id}', [KendaraanController::class, 'show']);
    Route::get('/transaksi', [PenjualanController::class, 'getAllTransaksiPenjualan']);
    Route::get('/transaksi-detail/{id}', [PenjualanController::class, 'getTransaksiPenjualan']);
});




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('no-auth', function () {
    return response()->json(['message' => 'Not authenticated.'], 401);
});
