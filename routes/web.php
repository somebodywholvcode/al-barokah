<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SantriController;

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

Route::get('/', function () {
    return view('index');
});

//login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');

//MODAL INPUT TAMBAH
Route::post('/santri/store', [SantriController::class, 'store'])->name('santri.store');
Route::put('/santri/{santri}', [SantriController::class, 'update'])->name('santri.update');
Route::delete('/hapusData/{santri}', [SantriController::class, 'destroy'])->name('santri.destroy');

//Rekap Rekap
Route::get('/rekapkehadiran',[SantriController::class,'rekap1']);

//Rute Santri
Route::get('/santri',[SantriController::class,'index']);

//Rute SPP
Route::get('/spp',[SppController::class,'index']);