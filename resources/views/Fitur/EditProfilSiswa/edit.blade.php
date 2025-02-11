{{-- Template Utama --}}
@extends('Layouts.master')

{{-- Bagian Content --}}
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Edit Profil Siswa: {{ $siswa->profilSiswa->namaSiswa }}
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Picture -->
                    <img src="{{ asset($siswa->profilSiswa->fotoSiswa) }}" alt="Profile Picture"
                        class="img-thumbnail mx-auto my-auto rounded-circle" style="width: 256px; height: 256px;">

                    {{-- <!-- Account Information -->
                    <h4 class="font-weight-bold my-2">Ubah Foto Profil</h4> --}}
                </div>
                {{-- Update Profil Section --}}
                <div class="col-md-8">
                    <form action="/profil-siswa/{{ $siswa->id }}/update" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label><strong>Username</strong></label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" id="username" placeholder="" value="{{ $siswa->username }}">
                            @error('username')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Email</strong></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="" value="{{ $siswa->email }}">
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
                                value="{{ $siswa->profilSiswa->ulangPassword }}">
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
                                value="{{ $siswa->profilSiswa->ulangPassword }}">
                            @error('ulangPassword')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Nomor Induk Siswa</strong></label>
                            <input type="number" class="form-control @error('id') is-invalid @enderror" name="id"
                                id="id" placeholder="" value="{{ $siswa->profilSiswa->id }}">
                            @error('id')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Nama Siswa</strong></label>
                            <input type="text" class="form-control @error('namaSiswa') is-invalid @enderror"
                                name="namaSiswa" id="namaSiswa" placeholder=""
                                value="{{ $siswa->profilSiswa->namaSiswa }}">
                            @error('namaSiswa')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Tahun Masuk</strong></label>
                            <input type="number" class="form-control @error('tahunMasuk') is-invalid @enderror"
                                name="tahunMasuk" id="tahunMasuk" placeholder=""
                                value="{{ $siswa->profilSiswa->tahunMasuk }}">
                            @error('tahunMasuk')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Tahun Lulus</strong></label>
                            <input type="number" class="form-control @error('tahunLulus') is-invalid @enderror"
                                name="tahunLulus" id="tahunLulus" placeholder=""
                                value="{{ $siswa->profilSiswa->tahunLulus }}">
                            @error('tahunLulus')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Jurusan</strong></label>
                            <select class="form-control" name="jurusan" id="jurusan">
                                <option>-- Pilih Jurusan --</option>
                                <option value="TKJ" {{ $siswa->profilSiswa->jurusan == 'TKJ' ? 'selected' : '' }}>TKJ
                                </option>
                                <option value="DPIB" {{ $siswa->profilSiswa->jurusan == 'DPIB' ? 'selected' : '' }}>DPIB
                                </option>
                                <option value="TITL" {{ $siswa->profilSiswa->jurusan == 'TITL' ? 'selected' : '' }}>TITL
                                </option>
                                <option value="TKRO" {{ $siswa->profilSiswa->jurusan == 'TKRO' ? 'selected' : '' }}>TKRO
                                </option>
                                <option value="TPM" {{ $siswa->profilSiswa->jurusan == 'TPM' ? 'selected' : '' }}>TPM
                                </option>
                                <option value="T.ELIN" {{ $siswa->profilSiswa->jurusan == 'T.ELIN' ? 'selected' : '' }}>
                                    T.ELIN</option>
                                <option value="TSM" {{ $siswa->profilSiswa->jurusan == 'TSM' ? 'selected' : '' }}>TSM
                                </option>
                                <option value="TAV" {{ $siswa->profilSiswa->jurusan == 'TAV' ? 'selected' : '' }}>TAV
                                </option>
                                <option value="IOP" {{ $siswa->profilSiswa->jurusan == 'IOP' ? 'selected' : '' }}>IOP
                                </option>
                            </select>
                            @error('jurusan')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Tanggal Lahir</strong></label>
                            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                name="tgl_lahir" id="tgl_lahir" value="{{ $siswa->profilSiswa->tgl_lahir }}">
                            @error('tgl_lahir')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Upload Foto Profil (Max: 5 MB)</strong></label>
                            <br />
                            <input class="input-file-normal" type="file" name="fotoSiswa" id="fotoSiswa" />
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
