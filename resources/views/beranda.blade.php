{{-- Template Utama --}}
@extends('Layouts.master')

{{-- Bagian: Heading  --}}

@section('cards')
    @if (Auth::user()->role == 'guru')
        <!-- Total Laporan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            @if ($totalLaporan == 0)
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Laporan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                            @endif
                            @if ($totalLaporan > 0)
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Laporan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLaporan }}</div>
                            @endif
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
                            @if ($laporanGuru == 0)
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Laporan Mu</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                            @endif
                            @if ($laporanGuru > 0)
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Laporan Mu</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $laporanGuru }}</div>
                            @endif

                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-bell-concierge fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Auth::user()->role == 'admin')
        <!-- Total Laporan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            @if ($totalLaporan == 0)
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Laporan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                            @endif
                            @if ($totalLaporan > 0)
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Laporan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLaporan }}</div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-flag fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (Auth::user()->role == 'siswa')
        <!-- Total Laporan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            @if ($riwayatSiswa == 0)
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Riwayat Laporanku</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                            @endif
                            @if ($riwayatSiswa > 0)
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Riwayat Laporanku</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $riwayatSiswa }}</div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-flag fa-2x text-gray-300"></i>
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
