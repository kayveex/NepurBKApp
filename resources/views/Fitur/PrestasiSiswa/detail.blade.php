{{-- Template Utama --}}
@extends('Layouts.master')

{{-- Konten --}}
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body p-5">
            <h1 class="text-primary text-center font-weight-bold">Catatan Prestasi Siswa</h1>
            <hr>
            <p><span class="font-weight-bold">Nomor</span> : {{ $prestasi->id }}</p>
            <p><span class="font-weight-bold">Tahun Pencapaian</span> : {{ $prestasi->tahunPencapaian }} </p>
            <p><span class="font-weight-bold">Bidang Prestasi</span> : {{ $prestasi->bidangPrestasi }} </p>
            <br>
            <h3 class="font-weight-bold">Informasi Lomba</h3>
            <p><span class="font-weight-bold">Posisi Juara</span> : {{ $prestasi->posisiJuara }} </p>
            <p><span class="font-weight-bold">Tingkat Prestasi</span> : {{ $prestasi->tingkatPrestasi }} </p>
            <p><span class="font-weight-bold">Siswa yang Berprestasi</span> : <a target="_blank"
                    class="text-primary text-decoration-underline font-weight-bold"
                    href="/akun/akun-siswa/{{ $prestasi->profilSiswa->userFromSiswa->id }}">{{ $prestasi->profilSiswa->namaSiswa }}</a>
            </p>
            <p><span class="font-weight-bold">Bukti Prestasi</span> : <a target="_blank"
                    class="text-primary text-decoration-underline font-weight-bold"
                    href="{{ $prestasi->buktiPrestasi }}">Link Bukti</a>
            </p>
            <br>
            <h3 class="font-weight-bold">Mengenai Lomba</h3>
            <div class="border border-primary p-2">
                <p>{{ $prestasi->deskripsi }}</p>
            </div>
            <br>
        </div>
    </div>
@endsection
