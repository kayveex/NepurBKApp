{{-- Template Utama --}}
@extends('Layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Detail Profil Guru BK
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Picture -->
                    <img src="{{ asset($guru->profilGuru->fotoGuruBK) }}" alt="Profile Picture"
                        class="img-thumbnail mx-auto my-auto rounded-circle" style="width: 128px; height: 128px;">


                    <!-- Account Information -->
                    @if (Auth::user()->role == 'admin')
                        <h4 class="font-weight-bold my-2">Informasi Akun</h4>
                        <p>Username: {{ $guru->username }} </p>
                        <p>Email: {{ $guru->email }} </p>
                        <p>Password: {{ $guru->profilGuru->ulangPassword }}</p>
                    @endif
                </div>
                <div class="col-md-8">
                    <!-- Personal Information -->
                    <h2>{{ $guru->profilGuru->namaGuruBK }}</h2>
                    <p>NIP: {{ $guru->profilGuru->id }}</p>
                    <p>Alamat: {{ $guru->profilGuru->alamat }}</p>
                    <p>No. WA: {{ $guru->profilGuru->nomorWA }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
