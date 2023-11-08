<?php

namespace App\Http\Controllers;

use App\Models\LaporanBimbingan;
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
            return view('beranda',compact('totalLaporan'));
        }else {
            return view('beranda');
        }   
    }
}
