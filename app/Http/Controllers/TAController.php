<?php

namespace App\Http\Controllers;

use App\Models\TahunAjar;
use Illuminate\Http\Request;

class TAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_ajar = TahunAjar::orderBy('id', 'ASC') ->get();
        return view('Fitur.tahunAjar.index',compact('tahun_ajar'));
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tahun_ajar = TahunAjar::find($id);
        $tahun_ajar->delete();
        return redirect('/tahun-ajar');

    }
}
