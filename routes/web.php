<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\TAController;
use App\Http\Controllers\TahunAjarController;
use Illuminate\Support\Facades\Auth;
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


// Yang Bisa Akses -> User yg BELUM LOGIN (guestmode) 
Route::middleware(['guest'])->group(function() {
    Route::get('/',[SesiController::class,'index'])->name('login');
    Route::post('/',[SesiController::class,'login']);
});

Auth::routes();

// Dari RedirectIfAuthenticated Class -> Dirombak jadi ke /admin - START
Route::get('/home', function() {
    return redirect('/beranda');
});
// END

Route::middleware(['auth'])->group(function() {
    Route::get('/beranda', [BerandaController::class,'index'])->name('beranda');
    Route::get('/logout',[SesiController::class,'logout']);

    // CRUD TahunAjar - Start
    Route::get('/tahun-ajar',[TAController::class,'index'])->middleware('userAkses:admin') ->name('tahunajar');
    Route::post('/tahun-ajar/store',[TAController::class,'store'])->middleware('userAkses:admin');
    Route::delete('/tahun-ajar/{id}/destroy',[TAController::class,'destroy'])->middleware('userAkses:admin');


    // End

    // Route Error 404 - Berfungsi jika memasukkan route ngawur
    Route::fallback(function () {
        return view('errors.404');
    });
});


/* 
Informasi:
    1. ->name pada tiap route index digunakan untuk menyalakan active button pada sidebar!
    2. Penggunaan middleware('userAkses) dipakai untuk menentukan fitur ini bisa diakses oleh role siapa saja.
*/

// DUMPCODES

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::resource('tahun-ajar',TahunAjarController::class)->middleware('userAkses:admin');