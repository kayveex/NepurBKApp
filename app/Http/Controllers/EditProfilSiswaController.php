<?php

namespace App\Http\Controllers;

use App\Models\ProfilSiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditProfilSiswaController extends Controller
{
    /**
     * Menampilkan profil user siswa yang bisa diedit
     */
    public function edit(string $id)
    {
        // Menangkap id user
        $loggedUser = Auth::user()->id;
        // Membuat syarat agar hanya id loggeduser yang bisa diedit
        if ($loggedUser == $id) {
            $siswa = User::where('id', $id)
            ->where('role', 'siswa')
            ->with('profilSiswa')
            ->first();

            return view('Fitur.EditProfilSiswa.edit', compact('siswa'));
            
        }else {
            return view('errors.404');
            // Menampilkan error not found
        }

    }

    /**
     * fungsi buat update profil siswa
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

        return redirect('/beranda')->with('success', 'Profil Siswa berhasil diperbarui.');


    }
}
