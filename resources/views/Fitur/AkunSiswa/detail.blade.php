{{-- Template Utama --}}
@extends('Layouts.master')


{{-- Bagian Content --}}
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Detail Profil Siswa
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Picture -->
                    <img src="{{ asset($siswa->profilSiswa->fotoSiswa) }}" alt="Profile Picture"
                        class="img-thumbnail mx-auto my-auto rounded-circle" style="width: 128px; height: 128px;">


                    <!-- Account Information -->
                    @if (Auth::user()->role == 'admin')
                        <h4 class="font-weight-bold my-2">Informasi Akun</h4>
                        <p>Username: {{ $siswa->username }} </p>
                        <p>Email: {{ $siswa->email }} </p>
                        <p>Password: {{ $siswa->profilSiswa->ulangPassword }}</p>
                    @endif
                </div>
                <div class="col-md-8">
                    <!-- Personal Information -->
                    <h2>{{ $siswa->profilSiswa->namaSiswa }}</h2>
                    <p>No. Induk: {{ $siswa->profilSiswa->id }}</p>
                    <p>Angkatan: {{ $siswa->profilSiswa->tahunMasuk }}</p>
                    <p>Prediksi Lulus: {{ $siswa->profilSiswa->tahunLulus }}</p>
                    <p>Jurusan: {{ $siswa->profilSiswa->jurusan }} </p>
                    <p>Tanggal Lahir: {{ $siswa->profilSiswa->tgl_lahir }} </p>

                    <!-- Awards / Lomba -->
                    <h4>Prestasi Siswa</h4>
                    <ul>
                        <li>Fitur Sedang Dikembangkan! 🙏</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
