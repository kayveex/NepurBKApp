<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index() {
        echo "Halo, Selamat Datang";
        // echo Auth::user()-> username;
        echo "<h1>" . Auth::user()->username . "</h1>";
    }
}
