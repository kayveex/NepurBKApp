<?php

namespace App\Http\Controllers;

use App\Models\LaporanBimbingan;
use App\Models\ProfilSiswa;
use App\Models\TahunAjar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanBimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporanBimbingan = LaporanBimbingan::all(); // Mengambil semua data dari model LaporanBimbingan
        // Import dari Model TahunAjar
        $tahunAjars = TahunAjar::all();

        // Import dari Model ProfilSiswa
        $profilSiswa = ProfilSiswa::all();

    
        return view('Fitur.LaporanBimbingan.index', compact('laporanBimbingan', 'tahunAjars', 'profilSiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Memvalidasi inputan
        $request->validate([
            'kelas' => 'required',
            'semester' => 'required',
            'bidangLayanan' => 'required',
            'tanggalBimbingan' => 'required|date',
            'keluhan' => 'required',
            'solusi' => 'required',
            'tahunAjar_id' => 'required',
            'siswa_id' => 'required'
        ]);

        // Membuat laporan bimbingan baru
        $laporanBimbingan = new LaporanBimbingan([
            'kelas' => $request->input('kelas'),
            'semester' => $request->input('semester'),
            'bidangLayanan' => $request->input('bidangLayanan'),
            'tanggalBimbingan' => $request->input('tanggalBimbingan'),
            'keluhan' => $request->input('keluhan'),
            'solusi' => $request->input('solusi'),
            'tahunAjar_id' => $request->input('tahunAjar_id'),
            'user_id' => $user->id, // Menggunakan user_id dari pengguna yang sedang login
            'siswa_id' => $request->input('siswa_id'), // Pastikan Anda memasukkan nilai siswa_id yang sesuai
        ]);

        // Menyimpan laporan bimbingan
        $laporanBimbingan->save();

        // Redirect ke tampilan tabel
        return redirect('/siswa/laporan-bimbingan')->with('success', 'Laporan Bimbingan telah berhasil disimpan.');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporanBimbingan = LaporanBimbingan::find($id);
        $laporanBimbingan->delete();
        // Redirect ke tampilan tabel
        return redirect('/siswa/laporan-bimbingan')->with('success', 'Laporan Bimbingan telah berhasil dihapus.');
    }
}
