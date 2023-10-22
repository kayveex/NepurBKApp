<?php

namespace App\Http\Controllers;

use App\Models\ProfilSiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfilSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_userSiswa = Auth::id();
        $detailProfilSiswa = ProfilSiswa::where('user_id', $id_userSiswa)->first();

        return view('Fitur.ProfilSiswa.index'. ['detailProfilSiswa'=> $detailProfilSiswa]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfilSiswa $profilSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfilSiswa $profilSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfilSiswa $profilSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfilSiswa $profilSiswa)
    {
        //
    }
}