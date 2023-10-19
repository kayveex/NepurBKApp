<?php

namespace App\Http\Controllers;

use App\Models\TahunAjar;
use Illuminate\Http\Request;

class TahunAjarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_ajar = TahunAjar::all();
        return view('Fitur.tahunAjar.index',compact('tahun_ajar'));
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
        $this->validate($request, [
            'tahun_ajar_siswa' =>'required'
        ]);

        TahunAjar::create([
            'tahun_ajar_siswa'=>$request->tahun_ajar_siswa
        ]);

        return redirect('/tahun-ajar');
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
        $tahun_ajar = TahunAjar::find($id_tahunAjar);
        $tahun_ajar = delete();
        return redirect('/tahun-ajar');
    }
}
