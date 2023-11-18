<?php

namespace App\Http\Controllers;

use App\Models\LaporanBimbingan;
use App\Models\PrestasiSiswa;
use App\Models\User;
use App\Models\ProfilSiswa;

use Illuminate\Http\Request;

class AkunSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = User::where('role', 'siswa')
        ->with('profilSiswa') // Eager loading untuk mengambil profil siswa
        ->get();
        return view('Fitur.AkunSiswa.index', compact('siswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validasi Data
        $request->validate([
            // Validasi dari Model: User
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|max:16',
            // Validasi dari Model: ProfilSiswa
            'id' => 'required',
            'namaSiswa' => 'required|string|max:255',
            'ulangPassword' => 'required|min:8|max:16',
            'tahunMasuk' => 'required|numeric',
            'tahunLulus' => 'required|numeric',
            'jurusan' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'fotoSiswa' => 'mimes:png,jpg,jpeg|max: 5120'
        ]);

        // Simpan Data User
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 'siswa'
        ]);

        // Simpan Data ProfilSiswa
        $profilSiswaData = [
            'id' => $request->input('id'),
            'namaSiswa' => $request->input('namaSiswa'),
            'tahunMasuk' => $request->input('tahunMasuk'),
            'tahunLulus' => $request->input('tahunLulus'),
            'jurusan' => $request->input('jurusan'),
            'ulangPassword' => $request->input('ulangPassword'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'user_id' => $user->id,
        ];
        // Mengecek apakah ada file foto diunggah atau tidak
        if ($request->hasFile('fotoSiswa')) {
            $fotoSiswa = $request->file('fotoSiswa');
            $imageNameSiswa = time() . '.' . $fotoSiswa->extension(); // Mengambil ekstensi file
            $fotoSiswa->move(public_path('FotoSiswa'), $imageNameSiswa); // Menyimpan file
            $profilSiswaData['fotoSiswa'] = 'FotoSiswa/' . $imageNameSiswa; // Simpan path ke dalam data profil siswa
        }

        ProfilSiswa::create($profilSiswaData);

        return redirect('/akun/akun-siswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = User::where('id', $id)
        ->where('role', 'siswa')
        ->with('profilSiswa')
        ->first();

        $prestasi = PrestasiSiswa::all();
        $laporanBimbingan = LaporanBimbingan::all();

        return view('Fitur.AkunSiswa.detail', compact('siswa', 'prestasi', 'laporanBimbingan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = User::where('id', $id)
        ->where('role', 'siswa')
        ->with('profilSiswa')
        ->first();

        return view('Fitur.AkunSiswa.update', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = User::where('id', $id)
        ->where('role', 'siswa')
        ->with('profilSiswa')
        ->first();

        $request->validate([
            // Validasi dari Model: User
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|max:16',
            // Validasi dari Model: ProfilSiswa
            'id' => 'required',
            'namaSiswa' => 'required|string|max:255',
            'ulangPassword' => 'required|min:8|max:16',
            'tahunMasuk' => 'required|numeric',
            'tahunLulus' => 'required|numeric',
            'jurusan' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'fotoSiswa' => 'mimes:png,jpg,jpeg|max:5120'
        ]);

    // Mengupdate user
        $siswa->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
    ]);

        $profilSiswaData = [
            // Model: ProfilSiswa
            'id' => $request->input('id'),
            'namaSiswa' => $request->input('namaSiswa'),
            'tahunMasuk' => $request->input('tahunMasuk'),
            'tahunLulus' => $request->input('tahunLulus'),
            'jurusan' => $request->input('jurusan'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'ulangPassword' => $request->input('ulangPassword'),
            'user_id' => $siswa->id
        ];

        // Memeriksa apakah ada file foto baru yang diunggah
        if ($request->hasFile('fotoSiswa')) {
            $fotoSiswa = $request->file('fotoSiswa');
            $imageNameSiswa = time() . '.' . $fotoSiswa->extension();
            $fotoSiswa->move(public_path('FotoSiswa'), $imageNameSiswa);
            $profilSiswaData['fotoSiswa'] = 'FotoSiswa/' . $imageNameSiswa;
        } else {
            // Jika tidak ada foto baru, gunakan foto lama
            $profilSiswaData['fotoSiswa'] = $siswa->profilSiswa->fotoSiswa;
        }

            // Mengupdate atau membuat ProfilSiswa
        if ($siswa->profilSiswa) {
            $siswa->profilSiswa->update($profilSiswaData);
        } else {
            ProfilSiswa::create($profilSiswaData);
        }
        // return redirect()->route('/akun/akun-siswa', $siswa->id)->with('success', 'Data siswa berhasil diperbarui');
        return redirect('/akun/akun-siswa')->with('success', 'Data Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);



        // Hapus foto jika ada
        if ($user->profilSiswa && $user->profilSiswa->fotoSiswa) {
            $oldImagePath = public_path($user->profilSiswa->fotoSiswa);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Hapus profilSiswa terkait
        $user->profilSiswa()->delete();

        // Hapus data user
        $user->delete();

        return redirect('/akun/akun-siswa')->with('success', 'Data Siswa berhasil dihapus.');
    }
}
