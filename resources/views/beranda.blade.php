{{-- Template Utama --}}
@extends('Layouts.master')

{{-- Bagian: Heading  --}}

@section('cards')
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'guru' || Auth::user()->role == 'kepalaSekolah')
        <!-- Total Laporan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Laporan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-flag fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Siswa yang Dilayani Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Siswa yang Dilayani</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-bell-concierge fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('heading')
    Beranda | Selamat Datang 😆🔥
@endsection

{{-- Bagian: Content  --}}
@section('content')
    {{--  --}}
@endsection
