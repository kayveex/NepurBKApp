<?php

use App\Http\Controllers\AkunGuruController;
use App\Http\Controllers\AkunSiswaController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\EditProfilGuruController;
use App\Http\Controllers\EditProfilSiswaController;
use App\Http\Controllers\LaporanBimbinganController;
use App\Http\Controllers\PrestasiSiswaController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\TAController;
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

    // CRUD Akun Siswa - Start
    Route::get('/akun/akun-siswa', [AkunSiswaController::class,'index'])->middleware('userAkses:admin|guru') ->name('akunSiswa');
    Route::post('/akun/akun-siswa/store', [AkunSiswaController::class,'store'])->middleware('userAkses:admin|guru');
    Route::get('/akun/akun-siswa/{id}',[AkunSiswaController::class,'show'])->middleware('userAkses:admin|guru')->name('akunSiswa');
    Route::get('/akun/akun-siswa/{id}/edit',[AkunSiswaController::class,'edit'])->middleware('userAkses:admin')->name('akunSiswa');
    Route::put('/akun/akun-siswa/{id}/update',[AkunSiswaController::class,'update'])->middleware('userAkses:admin')->name('akunSiswa');
    Route::delete('/akun/akun-siswa/{id}/destroy',[AkunSiswaController::class,'destroy'])->middleware('userAkses:admin');
    // End

    // CRUD Akun Guru BK - Start
    Route::get('/akun/akun-guru', [AkunGuruController::class,'index'])->middleware('userAkses:admin')->name('akunGuru');
    Route::post('/akun/akun-guru/store', [AkunGuruController::class,'store'])->middleware('userAkses:admin');
    Route::get('/akun/akun-guru/{id}',[AkunGuruController::class,'show'])->middleware('userAkses:admin|guru|siswa|kepalaSekolah')->name('akunGuru');
    Route::get('/akun/akun-guru/{id}/edit',[AkunGuruController::class,'edit'])->middleware('userAkses:admin')->name('akunGuru');
    Route::put('/akun/akun-guru/{id}/update',[AkunGuruController::class,'update'])->middleware('userAkses:admin')->name('akunGuru');
    Route::delete('/akun/akun-guru/{id}/destroy',[AkunGuruController::class,'destroy'])->middleware('userAkses:admin');
    // End

    // CRUD Laporan Bimbingan - Start
    Route::get('/siswa/laporan-bimbingan',[LaporanBimbinganController::class,'index'])->middleware('userAkses:admin|guru|siswa|kepalaSekolah')->name('laporanBimbingan');
    Route::post('/siswa/laporan-bimbingan/store',[LaporanBimbinganController::class,'store'])->middleware('userAkses:admin|guru')->name('laporanBimbingan');
    Route::get('/siswa/laporan-bimbingan/{id}',[LaporanBimbinganController::class,'show'])->middleware('userAkses:admin|guru|kepalaSekolah|siswa')->name('laporanBimbingan');
    Route::get('/siswa/laporan-bimbingan/{id}/edit',[LaporanBimbinganController::class,'edit'])->middleware('userAkses:admin|guru')->name('laporanBimbingan');
    Route::put('/siswa/laporan-bimbingan/{id}/update',[LaporanBimbinganController::class,'update'])->middleware('userAkses:admin|guru')->name('laporanBimbingan');
    Route::delete('/siswa/laporan-bimbingan/{id}/destroy',[LaporanBimbinganController::class,'destroy'])->middleware('userAkses:admin|guru')->name('laporanBimbingan');
    // End

    // CRUD Prestasi Siswa
    Route::get('/siswa/prestasi-siswa', [PrestasiSiswaController::class, 'index'])->middleware('userAkses:admin|guru|kepalaSekolah|siswa')->name('prestasiSiswa');
    Route::post('/siswa/prestasi-siswa/store',[PrestasiSiswaController::class, 'store'])->middleware('userAkses:admin|guru|siswa')->name('prestasiSiswa');
    Route::get('/siswa/prestasi-siswa/{id}',[PrestasiSiswaController::class,'show'])->middleware('userAkses:admin|guru|kepalaSekolah|siswa')->name('prestasiSiswa');
    Route::get('/siswa/prestasi-siswa/{id}/edit',[PrestasiSiswaController::class,'edit'])->middleware('userAkses:admin|guru|kepalaSekolah|siswa')->name('prestasiSiswa');
    Route::put('/siswa/prestasi-siswa/{id}/update',[PrestasiSiswaController::class,'update'])->middleware('userAkses:admin|guru|kepalaSekolah|siswa')->name('prestasiSiswa');
    Route::delete('/siswa/prestasi-siswa/{id}/destroy',[PrestasiSiswaController::class,'destroy'])->middleware('userAkses:admin|guru|siswa')->name('prestasiSiswa');
    // END

    // // Read - List Siswa
    Route::get('/siswa/list-siswa',[AkunSiswaController::class,'index'])->middleware('userAkses:guru|kepalaSekolah')->name('listSiswa');
    Route::get('/siswa/list-siswa/{id}',[AkunSiswaController::class,'show'])->middleware('userAkses:guru|kepalaSekolah')->name('listSiswa');

    // Update ProfilSiswa
    Route::get('/profil-siswa/{id}',[EditProfilSiswaController::class,'edit'])->middleware('userAkses:siswa')->name('profilSiswa');
    Route::put('/profil-siswa/{id}/update',[EditProfilSiswaController::class, 'update'])->middleware('userAkses:siswa')->name('profilSiswa');
    // End

    // Update ProfilGuruBK
    Route::get('/profil-guru/{id}',[EditProfilGuruController::class, 'edit'])->middleware('userAkses:guru')->name('profilGuru');
    Route::put('/profil-guru/{id}/update',[EditProfilGuruController::class, 'update'])->middleware('userAkses:guru')->name('profilGuru');
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