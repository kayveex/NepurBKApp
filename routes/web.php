<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\SesiController;
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
    Route::get('/beranda',[BerandaController::class,'index']);
    Route::get('/logout',[SesiController::class,'logout']);

    // CRUD TahunAjar - Start
    Route::resource('tahun-ajar',TahunAjarController::class);

    // Route Error 404
    Route::fallback(function () {
        return view('errors.404');
    });
});





