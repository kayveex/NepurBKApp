{{-- Template Utama --}}
@extends('Layouts.master')


{{-- Bagian Konten --}}
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Laporan Bimbingan</h6>
        </div>
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary d-flex align-items-center" data-toggle="modal"
                data-target="#modalLaporanBimbingan">
                <i class="fa-solid fa-circle-plus"></i>
                <p class="mb-0 ml-2">Tambahkan</p>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalLaporanBimbingan" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Input Laporan Bimbingan Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/siswa/laporan-bimbingan/store" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><strong>Semester</strong></label>
                                    <select class="form-control" name="semester" id="semester">
                                        <option>-- Pilih Semester --</option>
                                        <option value="ganjil">Ganjil</option>
                                        <option value="genap">Genap</option>
                                    </select>
                                    @error('semester')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Bidang Layanan</strong></label>
                                    <select class="form-control" name="bidangLayanan" id="bidangLayanan">
                                        <option>-- Pilih Bidang Layanan --</option>
                                        <option value="pribadi">Pribadi</option>
                                        <option value="sosial">Sosial</option>
                                        <option value="belajar">Belajar</option>
                                        <option value="karir">Karir</option>
                                    </select>
                                    @error('bidangLayanan')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Tanggal Bimbingan</strong></label>
                                    <input type="date"
                                        class="form-control @error('tanggalBimbingan') is-invalid @enderror"
                                        name="tanggalBimbingan" id="tanggalBimbingan" placeholder="">
                                    @error('tanggalBimbingan')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Keluhan</strong></label>
                                    <textarea class="form-control @error('keluhan') is-invalid @enderror" name="keluhan" id="keluhan" cols="100"
                                        rows="3"></textarea>
                                    @error('keluhan')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Solusi</strong></label>
                                    <textarea class="form-control @error('solusi') is-invalid @enderror" name="solusi" id="solusi" cols="100"
                                        rows="3"></textarea>
                                    @error('solusi')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label><strong>Tahun Ajar</strong></label>
                                    <select name="tahunAjar_id" id="tahunAjar_id" class="form-control">
                                        <!-- Menampilkan pilihan tahun ajaran dari database atau hardcode jika perlu -->
                                        @foreach ($tahunAjars as $tahun)
                                            <option value="{{ $tahun->id }}">{{ $tahun->tahun_ajar_siswa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
