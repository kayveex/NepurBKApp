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
        return view('Fitur.PrestasiSiswa.index',compact('prestasiSiswaList','profilSiswaList'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

            return redirect('/siswa/prestasi-siswa')->with('success', 'Berhasil membuat laporan prestasi siswa');

        }else if (Auth::user()->role == 'siswa') {
            $userSiswa = Auth::user()->profilSiswa->id;
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

            return redirect('/siswa/prestasi-siswa')->with('success', 'Berhasil membuat laporan prestasi siswa');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prestasi = PrestasiSiswa::find($id);

        return view('Fitur.PrestasiSiswa.detail',compact('prestasi'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mengambil semua data PrestasiSiswa dari database berdasarkan id
        $prestasi = PrestasiSiswa::find($id);
        // Mengambil semua data ProfilSiswa dari database
        $profilSiswaList = ProfilSiswa::all();
        
        return view('Fitur.PrestasiSiswa.update', compact('prestasi','profilSiswaList'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'guru') {
            // Validasi Data - Admin, guru
            $request->validate([
                'tahunPencapaian' => 'required',
                'bidangPrestasi' => 'required',
                'deskripsi' => 'required',
                'tingkatPrestasi' => 'required',
                'posisiJuara' => 'required',
                'buktiPrestasi' => 'required',
                'siswa_id' => 'required'
            ]);
    
            // Temukan data prestasi yang akan diupdate berdasarkan ID
            $prestasi = PrestasiSiswa::findOrFail($id);
    
            // Update data prestasi
            $prestasi->update([
                'tahunPencapaian' => $request->input('tahunPencapaian'),
                'bidangPrestasi' => $request->input('bidangPrestasi'),
                'deskripsi' => $request->input('deskripsi'),
                'tingkatPrestasi' => $request->input('tingkatPrestasi'),
                'posisiJuara' => $request->input('posisiJuara'),
                'buktiPrestasi' => $request->input('buktiPrestasi'),
                'siswa_id' => $request->input('siswa_id')
            ]);
    
            return redirect('/siswa/prestasi-siswa')->with('success', 'Berhasil mengupdate laporan prestasi siswa');
    
        } else if (Auth::user()->role == 'siswa') {
            $userSiswa = Auth::user()->profilSiswa->id;
            // Validasi Data - siswa
            $request->validate([
                'tahunPencapaian' => 'required',
                'bidangPrestasi' => 'required',
                'deskripsi' => 'required',
                'tingkatPrestasi' => 'required',
                'posisiJuara' => 'required',
                'buktiPrestasi' => 'required',
            ]);
    
            // Temukan data prestasi yang akan diupdate berdasarkan ID
            $prestasi = PrestasiSiswa::findOrFail($id);
    
            // Update data prestasi
            $prestasi->update([
                'tahunPencapaian' => $request->input('tahunPencapaian'),
                'bidangPrestasi' => $request->input('bidangPrestasi'),
                'deskripsi' => $request->input('deskripsi'),
                'tingkatPrestasi' => $request->input('tingkatPrestasi'),
                'posisiJuara' => $request->input('posisiJuara'),
                'buktiPrestasi' => $request->input('buktiPrestasi'),
                'siswa_id' => $userSiswa
            ]);
    
            return redirect('/siswa/prestasi-siswa')->with('success', 'Berhasil mengupdate laporan prestasi siswa');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $laporanPrestasiSiswa = PrestasiSiswa::find($id);
        $laporanPrestasiSiswa->delete();
        // Kembali ke tampilan tabel Prestasi Siswa
        return redirect('/siswa/prestasi-siswa')->with('success', 'Prestasi Siswa telah berhasil dihapus.');
    }
}
