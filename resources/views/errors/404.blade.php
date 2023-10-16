@extends('Layouts.base404')

{{-- Bagian: Content  --}}
@section('content')
    <div class="container-fluid">

        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Halaman Tidak Ditemukan</p>
            <p class="text-gray-500 mb-0">Sepertinya anda salah alamat...</p>
            <a href="/beranda">&larr; Kembali Ke Beranda</a>
        </div>

    </div>
@endsection
