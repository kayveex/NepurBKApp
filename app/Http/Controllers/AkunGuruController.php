<?php

namespace App\Http\Controllers;

use App\Models\ProfilGuru;
use App\Models\User;
use Illuminate\Http\Request;

class AkunGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = User::where('role','guru')
        ->with('profilGuru')
        ->get();
        return view('Fitur.AkunGuru.index',compact('gurus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi Data
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
        // Simpan Data User
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 'guru'
        ]);
        // Simpan Data ProfilGuru
        $profilGuruData = [
            'id' => $request->input('id'),
            'namaGuruBK' => $request->input('namaGuruBK'),
            'alamat' => $request->input('alamat'),
            'nomorWA' => $request->input('nomorWA'),
            'ulangPassword' => $request->input('ulangPassword'),
            'user_id' => $user->id,
        ];
        // Mengecek ada foto guru atau tidak, akan mengupload foto jika terpenuhi syaratnya

        if ($request->hasFile('fotoGuruBK')) {
            $fotoGuru = $request->file('fotoGuruBK');
            $imageNameGuru = time() . '.' . $fotoGuru->extension(); // Mengambil ekstensi file
            $fotoGuru->move(public_path('FotoGuru'), $imageNameGuru); // Menyimpan file
            $profilGuruData['fotoGuruBK'] = 'FotoGuru/' . $imageNameGuru; // Simpan path ke dalam data profil guru
        }

        ProfilGuru::create($profilGuruData);
        return redirect('/akun/akun-guru');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guru = User::where('id', $id)
        ->where('role', 'guru')
        ->with('profilGuru')
        ->first();

        return view('Fitur.AkunGuru.detail',compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guru = User::where('id', $id)
        ->where('role', 'guru')
        ->with('profilGuru')
        ->first();

        return view('Fitur.AkunGuru.update',compact('guru'));
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
        return redirect('/akun/akun-guru')->with('success', 'Data Guru BK berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        // Hapus foto jika ada
        if ($user->profilGuru && $user->profilGuru->fotoGuruBK) {
            $oldImagePath = public_path($user->profilGuru->fotoGuruBK);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Hapus profilSiswa terkait
        $user->profilGuru()->delete();

        // Hapus data user
        $user->delete();

        return redirect('/akun/akun-guru')->with('success', 'Data Guru berhasil dihapus.');
    }
}
