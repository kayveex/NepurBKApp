<?php

namespace App\Http\Controllers;

use App\Models\ProfilGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        
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
    public function show(ProfilGuru $profilGuru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfilGuru $profilGuru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfilGuru $profilGuru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfilGuru $profilGuru)
    {
        //
    }
}
