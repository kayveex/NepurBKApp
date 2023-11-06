{{-- Template Utama --}}
@extends('Layouts.master')


@section('content')
    <div class="card shadow mb-4">
        <div class="card-body p-5">
            <h1 class="text-primary text-center font-weight-bold">Edit Catatan Laporan Bimbingan</h1>
            <hr>
            <form action="/siswa/laporan-bimbingan/{{ $laporanBimbingan->id }}/update" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label><strong>Kelas</strong></label>
                    <select class="form-control" name="kelas" id="kelas">
                        <option>-- Pilih Kelas --</option>
                        <option value="10" {{ $laporanBimbingan->kelas == '10' ? 'selected' : '' }}>10</option>
                        <option value="11" {{ $laporanBimbingan->kelas == '11' ? 'selected' : '' }}>11</option>
                        <option value="12" {{ $laporanBimbingan->kelas == '12' ? 'selected' : '' }}>12</option>
                    </select>
                    @error('kelas')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Semester</strong></label>
                    <select class="form-control" name="semester" id="semester">
                        <option>-- Pilih Semester --</option>
                        <option value="ganjil" {{ $laporanBimbingan->semester == 'ganjil' ? 'selected' : '' }}>Ganjil
                        </option>
                        <option value="genap" {{ $laporanBimbingan->semester == 'genap' ? 'selected' : '' }}>Genap
                        </option>
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
                        <option value="pribadi" {{ $laporanBimbingan->bidangLayanan == 'pribadi' ? 'selected' : '' }}>
                            Pribadi</option>
                        <option value="sosial" {{ $laporanBimbingan->bidangLayanan == 'sosial' ? 'selected' : '' }}>Sosial
                        </option>
                        <option value="belajar" {{ $laporanBimbingan->bidangLayanan == 'belajar' ? 'selected' : '' }}>
                            Belajar</option>
                        <option value="karir" {{ $laporanBimbingan->bidangLayanan == 'karir' ? 'selected' : '' }}>Karir
                        </option>
                    </select>
                    @error('bidangLayanan')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Tanggal Bimbingan</strong></label>
                    <input type="date" class="form-control @error('tanggalBimbingan') is-invalid @enderror"
                        name="tanggalBimbingan" id="tanggalBimbingan" value="{{ $laporanBimbingan->tanggalBimbingan }}">
                    @error('tanggalBimbingan')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Keluhan</strong></label>
                    <textarea class="form-control @error('keluhan') is-invalid @enderror" name="keluhan" id="keluhan" cols="100"
                        rows="3">{{ $laporanBimbingan->keluhan }}</textarea>
                    @error('keluhan')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Solusi</strong></label>
                    <textarea class="form-control @error('solusi') is-invalid @enderror" name="solusi" id="solusi" cols="100"
                        rows="3">{{ $laporanBimbingan->solusi }}</textarea>
                    @error('solusi')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Tahun Ajar</strong></label>
                    <select name="tahunAjar_id" id="tahunAjar_id" class="form-control">
                        <option>-- Pilih Tahun Ajar --</option>
                        <!-- Menampilkan pilihan tahun ajaran dari database  -->
                        @foreach ($tahunAjars as $tahun)
                            <option value="{{ $tahun->id }}"
                                {{ $tahun->id == $laporanBimbingan->tahunAjar_id ? 'selected' : '' }}>
                                {{ $tahun->tahun_ajar_siswa }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label><strong>Klien Siswa</strong></label>
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari siswa...">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                    <hr>
                    <select name="siswa_id" id="siswa_id" class="form-control">
                        <option value="">-- Buka Untuk Mendapatkan Hasil Search --</option>
                        <!-- Menampilkan pilihan klien siswa -->
                        @foreach ($profilSiswa as $siswa)
                            <option value="{{ $siswa->id }}"
                                {{ $siswa->id == $laporanBimbingan->siswa_id ? 'selected' : '' }}>{{ $siswa->namaSiswa }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2 float-right">Update</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            var input, filter, select, option, a, i;
            input = this;
            filter = input.value.toUpperCase();
            select = document.getElementById('siswa_id');
            option = select.getElementsByTagName('option');

            for (i = 0; i < option.length; i++) {
                a = option[i].textContent || option[i].innerText;
                if (a.toUpperCase().indexOf(filter) > -1) {
                    option[i].style.display = "";
                } else {
                    option[i].style.display = "none";
                }
            }
        });
    </script>
@endpush
