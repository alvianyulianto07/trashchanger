<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;

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
Route::post('/register', [AuthController::class, 'registrate'])->name('register');

Route::post('/logout', [AuthController::class, 'logout']);


// group middleware agar login terlebih dahulu baru bisa akses dashboard dkk //
Route::group(['middleware' => ['auth','cekrole:0,1,2']], function(){
    Route::resources([
        'beranda' => BerandaController::class,
        
    ]);
});
