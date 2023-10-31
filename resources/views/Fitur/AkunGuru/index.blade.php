{{-- Template Utama --}}
@extends('Layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Akun Guru BK</h6>
        </div>
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary d-flex align-items-center" data-toggle="modal"
                data-target="#modalAkunGuru">
                <i class="fa-solid fa-circle-plus"></i>
                <p class="mb-0 ml-2">Tambahkan</p>
            </button>
            <br>
            <div class="modal fade" id="modalAkunGuru" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Input Akun Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/akun/akun-guru/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><strong>Username</strong></label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        name="username" id="username" placeholder="">
                                    @error('username')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Email</strong></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" placeholder="">
                                    @error('email')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Password</strong></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" placeholder="Min: 8 huruf | Max: 16 huruf">
                                    @error('password')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Ulangi Password</strong></label>
                                    <input type="password" class="form-control @error('ulangPassword') is-invalid @enderror"
                                        name="ulangPassword" id="ulangPassword" placeholder="Ulangi Password!">
                                    @error('ulangPassword')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>NUPTK</strong></label>
                                    <input type="number" class="form-control @error('id') is-invalid @enderror"
                                        name="id" id="id" placeholder="">
                                    @error('id')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Nama Guru BK</strong></label>
                                    <input type="text" class="form-control @error('namaGuruBK') is-invalid @enderror"
                                        name="namaGuruBK" id="namaGuruBK" placeholder="">
                                    @error('namaGuruBK')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Alamat</strong></label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" id="alamat" placeholder="">
                                    @error('alamat')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>No.WA</strong></label>
                                    <input type="number" class="form-control @error('nomorWA') is-invalid @enderror"
                                        name="nomorWA" id="nomorWA" placeholder="">
                                    @error('nomorWA')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Upload Foto Guru BK (Max: 5 MB)</strong></label>
                                    <br />
                                    <input class="input-file-normal" type="file" name="fotoGuruBK" id="fotoGuruBK" />
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-center">
                <table class="table table-bordered " id="akunGuruTable">
                    <thead class="thead bg-primary text-white">
                        <tr>
                            <th scope="col">NUPTK</th>
                            <th scope="col">Nama Guru</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No WA</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gurus as $key => $guru)
                            <tr>
                                <th scope="row">{{ $guru->profilGuru->id }}</th>
                                <td>{{ $guru->profilGuru->namaGuruBK }}</td>
                                <td>{{ $guru->profilGuru->alamat }}</td>
                                <td>{{ $guru->profilGuru->nomorWA }}</td>
                                <td>{{ $guru->username }}</td>
                                <td>{{ $guru->profilGuru->ulangPassword }}</td>
                                <td class="text-center">
                                    <form action="/akun/akun-guru/{{ $guru->id }}/destroy" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <a href="/akun/akun-guru/{{ $guru->id }}" class="btn btn-info my-1 px-3">
                                            <i class="fa-solid fa-info"></i>
                                        </a>
                                        <a href="/akun/akun-guru/{{ $guru->id }}/edit"
                                            class="btn btn-warning my-1 px-2">
                                            <i class="fa-solid fa-user-pen"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger my-1 ">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">
                                Data Kosong ! 😢
                            </div>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
@endpush

@push('scripts')
    <script>
        $(function() {
            $("#akunGuruTable").DataTable();
        });
    </script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
@endpush
