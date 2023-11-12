<?php

namespace App\Http\Controllers;

use App\Models\ProfilGuru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditProfilGuruController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loggedUser = Auth::user()->id;

        if ($loggedUser == $id) {
            $guru = User::where('id', $id)
            ->where('role', 'guru')
            ->with('profilGuru')
            ->first();

            return view('Fitur.EditProfilGuru.index', compact('guru'));
        }else {
            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guru = User::where('id', $id)
        ->where('role', 'guru')
        ->with('profilGuru')
        ->first();

        // Mem-validasi Data 
        $request->validate([
            // Validasi dari Model: User
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|max:16',
            // Validasi dari Model: ProfilGuru
            'id' => 'required',
            'namaGuruBK' => 'required|string|max:255',
            'alamat' => 'required',
            'nomorWA' => 'required|numeric',
            'fotoGuruBK' => 'mimes:png,jpg,jpeg|max: 5120',
            'ulangPassword' => 'required|min:8|max:16'
        ]);

        // Mengupdate user model
        $guru->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);
        // Update Data ProfilGuru
        $profilGuruData = [
            'id' => $request->input('id'),
            'namaGuruBK' => $request->input('namaGuruBK'),
            'alamat' => $request->input('alamat'),
            'nomorWA' => $request->input('nomorWA'),
            'ulangPassword' => $request->input('ulangPassword'),
            'user_id' => $guru->id
        ];

        // Memeriksa apakah ada file foto baru yang diunggah
        if ($request->hasFile('fotoGuruBK')) {
            $fotoGuruBK = $request->file('fotoGuruBK');
            $imageNameGuru = time() . '.' . $fotoGuruBK->extension();
            $fotoGuruBK->move(public_path('FotoGuru'), $imageNameGuru);
            $profilGuruData['fotoGuruBK'] = 'FotoGuru/' . $imageNameGuru;
        } else {
            // Jika tidak ada foto baru, gunakan foto lama
            $profilGuruData['fotoGuruBK'] = $guru->profilGuru->fotoGuruBK;
        }

            // Mengupdate atau membuat ProfilSiswa
        if ($guru->profilGuru) {
            $guru->profilGuru->update($profilGuruData);
        } else {
            ProfilGuru::create($profilGuruData);
        }

        

        return redirect('/beranda')->with('success', 'Profil Siswa berhasil diperbarui.');
    }
}
