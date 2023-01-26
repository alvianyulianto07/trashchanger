<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\BankSampahController;

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
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

// route login dan logout//
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'store'])->name('register');

Route::post('/logout', [AuthController::class, 'logout']);
// group middleware agar login terlebih dahulu baru bisa akses dashboard dkk //
Route::group(['middleware' => ['auth', 'cekrole:2']], function () {
    Route::get('/daftarbanksampah', [AuthController::class, 'daftarbanksampah'])->name('daftarbanksampah');
    Route::post('/daftarbanksampah', [AuthController::class, 'create'])->name('daftarbanksampah');
});

// group middleware agar login terlebih dahulu baru bisa akses dashboard dkk //
Route::group(['middleware' => ['auth', 'cekrole:0,1,2']], function () {
    Route::resources([
        'beranda' => BerandaController::class,
    ]);
});

// group middleware agar login terlebih dahulu baru bisa akses dashboard dkk //
Route::group(['middleware' => ['auth', 'cekrole:0']], function () {
    Route::resources([
        'user' => UserController::class,
        'banksampah' => BankSampahController::class,
    ]);
});

// group middleware agar login terlebih dahulu baru bisa akses dashboard dkk //
Route::group(['middleware' => ['auth', 'cekrole:1']], function () {
    Route::resources([
        'toko' => TokoController::class,
        'keranjang' => KeranjangController::class,
        'pembelian' => PembelianController::class,
        'profil' => ProfilController::class,
    ]);
});

// group middleware agar login terlebih dahulu baru bisa akses dashboard dkk //
Route::group(['middleware' => ['auth', 'cekrole:2']], function () {
    Route::resources([
        'sampah' => SampahController::class,
        'penjualan' => PenjualanController::class,
        'profil' => ProfilController::class,
    ]);
});

