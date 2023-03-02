<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankSampahController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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
Route::resources([
    'welcome' => WelcomeController::class,
]);

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'store'])->name('register');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/', function () {
    return redirect()->route('welcome.index');
});
Route::post('/logout', [AuthController::class, 'logout']);

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
        'beranda' => TokoController::class,
        'keranjang' => KeranjangController::class,
        'pembelian' => PembelianController::class,
        'profil' => ProfilController::class,
    ]);
    Route::get('/toko/{id}', [TokoController::class, 'show'])->name('beranda.show');
    Route::get('/toko/{id}/{idsampah}', [TokoController::class, 'showSampah'])->name('beranda.showsampah');
    Route::post('/search', [TokoController::class, 'search'])->name('beranda.search');
    Route::post('/addToCart', [TokoController::class, 'addToCart'])->name('beranda.keranjang');
    Route::post('/checkout', [KeranjangController::class, 'checkout'])->name('keranjang.checkout');
});

// group middleware agar login terlebih dahulu baru bisa akses dashboard dkk //
Route::group(['middleware' => ['auth', 'cekrole:2']], function () {
    Route::resources([
        'sampah' => SampahController::class,
        'penjualan' => PenjualanController::class,
        'profil' => ProfilController::class,
    ]);

    Route::get('/daftarbanksampah', [AuthController::class, 'daftarbanksampah']);
    Route::post('/daftarbanksampah', [AuthController::class, 'create']);

});

Route::get('/landing2', [WelcomeController::class, 'index2']);
