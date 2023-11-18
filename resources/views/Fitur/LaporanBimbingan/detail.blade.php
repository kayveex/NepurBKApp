{{-- Template Utama --}}
@extends('Layouts.master')


{{-- Konten --}}
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body p-5">
            <h1 class="text-primary text-center font-weight-bold">Catatan Laporan Bimbingan</h1>
            <hr>
            <p><span class="font-weight-bold">Tanggal Bimbingan</span> : {{ $laporanBimbingan->tanggalBimbingan }} </p>
            <p><span class="font-weight-bold">Bidang Layanan</span> : {{ $laporanBimbingan->bidangLayanan }} </p>
            <p><span class="font-weight-bold">Ditangani Oleh</span> :

                @if ($laporanBimbingan->userAuthor->role == 'admin')
                    @ {{ $laporanBimbingan->userAuthor->username }}
                @else
                    <a class="text-info" href="/akun/akun-guru/{{ $laporanBimbingan->userAuthor->id }}">@
                        {{ $laporanBimbingan->userAuthor->username }}</a>
                @endif

            </p>
            <br>
            <h3 class="font-weight-bold">Informasi Pasien</h3>
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'guru' || Auth::user()->role == 'kepalaSekolah')
                <p><span class="font-weight-bold">Nama Pasien</span> : <a class="text-info"
                        href="/akun/akun-siswa/{{ $laporanBimbingan->fromProfilSiswa->userFromSiswa->id }}">{{ $laporanBimbingan->fromProfilSiswa->namaSiswa }}</a>
                </p>
            @endif
            <p><span class="font-weight-bold">Kelas</span> : {{ $laporanBimbingan->kelas }} </p>
            <p><span class="font-weight-bold">Semester</span> : {{ $laporanBimbingan->semester }} </p>
            <p><span class="font-weight-bold">Tahun Ajar</span> : {{ $laporanBimbingan->tahunAjar->tahun_ajar_siswa }} </p>
            <br>
            <h3 class="font-weight-bold">Deskripsi Masalah</h3>
            <div class="border border-primary p-2">
                <p>{{ $laporanBimbingan->keluhan }}</p>
            </div>
            <br>
            <h3 class="font-weight-bold">Solusi</h3>
            <div class="border border-primary p-2">
                <p>{{ $laporanBimbingan->solusi }}</p>
            </div>
        </div>
    </div>
@endsection
