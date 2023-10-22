<?php

namespace App\Http\Controllers;
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
        ->join('profil_siswa', 'users.id', '=', 'profil_siswa.user_id')
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
            'namaSiswa' => 'required|string|max:255',
            'tahunMasuk' => 'required|numeric',
            'tahunLulus' => 'required|numeric',
            'jurusan' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'fotoSiswa' => 'mimes:png,jpg,jpeg|max: 2048'
        ]);

        // Simpan Data User
        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'siswa'
        ]);

        // Simpan Data ProfilSiswa
        $profilSiswaData = [
            'namaSiswa' => $request->input('namaSiswa'),
            'tahunMasuk' => $request->input('tahunMasuk'),
            'tahunLulus' => $request->input('tahunLulus'),
            'jurusan' => $request->input('jurusan'),
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
        ->join('profil_siswa', 'users.id', '=', 'profil_siswa.user_id')
        ->first();

        // if (!$siswa) {
        //     return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan');
        // }

        return view('Fitur.AkunSiswa.detail', compact('siswa'));
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

        // if (!$siswa) {
        //     return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan');
        // }

        return view('Fitur.AkunSiswa.update', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $siswa = User::where('id', $id)
        // ->where('role', 'siswa')
        // ->join('profil_siswa', 'users.id', '=', 'profil_siswa.user_id')
        // ->first();

        $siswa = User::where('id', $id)
        ->where('role', 'siswa')
        ->with('profilSiswa')
        ->first();

        // if (!$siswa) {
        //     return redirect()->route('siswa.index')->with('error', 'Siswa tidak ditemukan');
        // }

        $request->validate([
            'namaSiswa' => 'required|string|max:255',
            'tahunMasuk' => 'required|numeric',
            'tahunLulus' => 'required|numeric',
            'jurusan' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'fotoSiswa' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $profilSiswaData = [
            'namaSiswa' => $request->input('namaSiswa'),
            'tahunMasuk' => $request->input('tahunMasuk'),
            'tahunLulus' => $request->input('tahunLulus'),
            'jurusan' => $request->input('jurusan'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'user_id' => $siswa->id,
        ];

        // Memeriksa apakah ada file foto baru yang diunggah
        if ($request->hasFile('fotoSiswa')) {
            $fotoSiswa = $request->file('fotoSiswa');
            $imageName = time() . '.' . $fotoSiswa->extension();
            $fotoSiswa->move(public_path('FotoSiswa'), $imageName);
            $profilSiswaData['fotoSiswa'] = 'FotoSiswa/' . $imageName;
        } else {
            // Jika tidak ada foto baru, gunakan foto lama
            $profilSiswaData['fotoSiswa'] = $siswa->fotoSiswa;
        }

        ProfilSiswa::where('user_id', $siswa->id)->update($profilSiswaData);

        return redirect()->route('/akun/akun-siswa', $siswa->id)->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        // Hapus profilSiswa terkait
        $user->profilSiswa()->delete();

        // Hapus foto jika ada
        if ($user->image) {
            $oldImagePath = public_path('FotoSiswa/' . $user->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Hapus data tanya
        $user->delete();

        return redirect('/tanyajawab')->with('success', 'Data Pertanyaan berhasil dihapus.');
    }
}
