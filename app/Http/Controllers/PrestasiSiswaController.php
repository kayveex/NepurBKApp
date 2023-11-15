<?php

namespace App\Http\Controllers;

use App\Models\PrestasiSiswa;
use App\Models\ProfilSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrestasiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data PrestasiSiswa dari database
        $prestasiSiswaList = PrestasiSiswa::all();
        // Mengambil semua data ProfilSiswa dari database
        $profilSiswaList = ProfilSiswa::all();
        //Menampilkan dalam index
        return view('Fitur.PrestasiSiswa.index',compact('prestasiSiswaList'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userSiswa = Auth::user()->profilSiswa->id;

        if (Auth::user()->role == 'admin' || Auth::user()->role == 'guru') {
            //Validasi Data - Admin, guru
            $request->validate([
                'tahunPencapaian' => 'required',
                'bidangPrestasi' => 'required',
                'deskripsi' => 'required',
                'tingkatPrestasi' => 'required',
                'posisiJuara' => 'required',
                'buktiPrestasi' => 'required',
                'siswa_id' => 'required'
            ]);
            // Membuat Laporan Prestasi Siswa Baru
            $buatPrestasiSiswa = new PrestasiSiswa([
                'tahunPencapaian' => $request->input('tahunPencapaian'),
                'bidangPrestasi' => $request->input('bidangPrestasi'),
                'deskripsi' => $request->input('deskripsi'),
                'tingkatPrestasi' => $request->input('tingkatPrestasi'),
                'posisiJuara' => $request->input('posisiJuara'),
                'buktiPrestasi' => $request->input('buktiPrestasi'),
                'siswa_id' => $request->input('siswa_id')
            ]);
            
            $buatPrestasiSiswa->save();

        }else if (Auth::user()->role == 'siswa') {
            //Validasi Data - siswa
            $request->validate([
                'tahunPencapaian' => 'required',
                'bidangPrestasi' => 'required',
                'deskripsi' => 'required',
                'tingkatPrestasi' => 'required',
                'posisiJuara' => 'required',
                'buktiPrestasi' => 'required',
            ]);
            // Membuat Laporan Prestasi Siswa Baru
            $buatPrestasiSiswa = new PrestasiSiswa([
                'tahunPencapaian' => $request->input('tahunPencapaian'),
                'bidangPrestasi' => $request->input('bidangPrestasi'),
                'deskripsi' => $request->input('deskripsi'),
                'tingkatPrestasi' => $request->input('tingkatPrestasi'),
                'posisiJuara' => $request->input('posisiJuara'),
                'buktiPrestasi' => $request->input('buktiPrestasi'),
                'siswa_id' => $userSiswa
            ]);

            $buatPrestasiSiswa->save();
        }

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
        //
    }
}
