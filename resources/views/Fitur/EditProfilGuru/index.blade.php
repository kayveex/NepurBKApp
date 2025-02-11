{{-- Template Utama --}}
@extends('Layouts.master')

{{-- Isi Konten --}}
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit Profil Guru BK: {{ $guru->profilGuru->namaGuruBK }}
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Picture -->
                    <img src="{{ asset($guru->profilGuru->fotoGuruBK) }}" alt="Profile Picture"
                        class="img-thumbnail mx-auto my-auto rounded-circle" style="width: 256px; height: 256px;">
                </div>
                {{-- Update Profil Section --}}
                <div class="col-md-8">
                    <form action="/profil-guru/{{ $guru->id }}/update" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label><strong>Username</strong></label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" id="username" placeholder="" value="{{ $guru->username }}">
                            @error('username')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Email</strong></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="" value="{{ $guru->email }}">
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Password (Min: 8 | Max: 16)</strong></label>
                            <input type="text" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder=""
                                value="{{ $guru->profilGuru->ulangPassword }}">
                            @error('password')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Ulangi Password Baru</strong></label>
                            <input type="text" class="form-control @error('ulangPassword') is-invalid @enderror"
                                name="ulangPassword" id="ulangPassword" placeholder=""
                                value="{{ $guru->profilGuru->ulangPassword }}">
                            @error('ulangPassword')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>NIP</strong></label>
                            <input type="number" class="form-control @error('id') is-invalid @enderror" name="id"
                                id="id" placeholder="" value="{{ $guru->profilGuru->id }}">
                            @error('id')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Nama Guru BK</strong></label>
                            <input type="text" class="form-control @error('namaGuruBK') is-invalid @enderror"
                                name="namaGuruBK" id="namaGuruBK" placeholder=""
                                value="{{ $guru->profilGuru->namaGuruBK }}">
                            @error('namaGuruBK')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Alamat</strong></label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                id="alamat" placeholder="" value="{{ $guru->profilGuru->alamat }}">
                            @error('alamat')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>No.WA</strong></label>
                            <input type="number" class="form-control @error('nomorWA') is-invalid @enderror" name="nomorWA"
                                id="nomorWA" placeholder="" value="{{ $guru->profilGuru->nomorWA }}">
                            @error('nomorWA')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label><strong>Upload Foto Profil (Max: 5 MB)</strong></label>
                            <br />
                            <input class="input-file-normal" type="file" name="fotoGuruBK" id="fotoGuruBK" />
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
