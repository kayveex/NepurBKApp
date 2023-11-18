<?php

namespace App\Http\Controllers;

use App\Models\LaporanBimbingan;
use App\Models\PrestasiSiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    function index () {
        if (Auth::user()->role == 'guru') {
            $id = Auth::id();
            $totalLaporan = LaporanBimbingan::count('*');
            $laporanGuru =  LaporanBimbingan::where('user_id', $id)->count();
            return view ('beranda', compact('totalLaporan','laporanGuru'));
        }else if (Auth::user()->role == 'admin' || Auth::user()->role == 'kepalaSekolah') {
            $totalLaporan = LaporanBimbingan::count('*');
            $guruList = User::where('role', 'guru')->get();
            return view('beranda',compact('totalLaporan', 'guruList'));
        }else if(Auth::user()->role == 'siswa') {
            $id = Auth::user()->profilSiswa->id;
            $riwayatSiswa = LaporanBimbingan::where('siswa_id',$id)->count();
            $prestasiTotal = PrestasiSiswa::where('siswa_id',$id)->count();
            return view('beranda', compact('riwayatSiswa', 'prestasiTotal'));
        }   
    }
}
