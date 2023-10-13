<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    function index() {
        return view('Auth.login');
    }

    function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],[
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        $info_login = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if (Auth::attempt($info_login, true)) {
            return redirect('admin');
        }else {
            return redirect('')->withErrors('Username dan password yang dimasukkan tidak valid!')->withInput();
        }
    }
}
