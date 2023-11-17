{{-- Template Utama --}}
@extends('Layouts.master')

{{-- Konten --}}
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body p-5">
            <h1 class="text-primary text-center font-weight-bold">Edit Catatan Prestasi Siswa</h1>
            <hr>
            <form action="/siswa/prestasi-siswa/{{ $prestasi->id }}/update" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label><strong>Tahun Pencapaian</strong></label>
                    <input type="number" class="form-control @error('tahunPencapaian') is-invalid @enderror"
                        name="tahunPencapaian" id="tahunPencapaian" value="{{ $prestasi->tahunPencapaian }}">
                    @error('tahunPencapaian')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Bidang Prestasi</strong></label>
                    <select class="form-control" name="bidangPrestasi" id="bidangPrestasi">
                        <option>-- Pilih Bidang Prestasi --</option>
                        <option value="akademik" {{ $prestasi->bidangPrestasi == 'akademik' ? 'selected' : '' }}>Akademik
                        </option>
                        <option value="non-akademik" {{ $prestasi->bidangPrestasi == 'non-akademik' ? 'selected' : '' }}>Non
                            Akademik</option>
                    </select>
                    @error('bidangPrestasi')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Deskripsi</strong></label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" cols="100"
                        rows="3">{{ $prestasi->deskripsi }}</textarea>
                    @error('deskripsi')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Tingkat Prestasi</strong></label>
                    <select class="form-control" name="tingkatPrestasi" id="tingkatPrestasi">
                        <option>-- Pilih Tingkat Prestasi --</option>
                        <option value="lokal" {{ $prestasi->tingkatPrestasi == 'lokal' ? 'selected' : '' }}>Lokal</option>
                        <option value="regional" {{ $prestasi->tingkatPrestasi == 'regional' ? 'selected' : '' }}>Regional
                        </option>
                        <option value="nasional" {{ $prestasi->tingkatPrestasi == 'nasional' ? 'selected' : '' }}>Nasional
                        </option>
                        <option value="internasional"
                            {{ $prestasi->tingkatPrestasi == 'internasional' ? 'selected' : '' }}>Internasional</option>
                    </select>
                    @error('tingkatPrestasi')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Posisi Juara</strong></label>
                    <select class="form-control" name="posisiJuara" id="posisiJuara">
                        <option>-- Pilih Posisi Juara --</option>
                        <option value="I" {{ $prestasi->posisiJuara == 'I' ? 'selected' : '' }}>I</option>
                        <option value="II" {{ $prestasi->posisiJuara == 'II' ? 'selected' : '' }}>II</option>
                        <option value="III" {{ $prestasi->posisiJuara == 'III' ? 'selected' : '' }}>III</option>
                        <option value="harapan" {{ $prestasi->posisiJuara == 'harapan' ? 'selected' : '' }}>Harapan
                        </option>
                    </select>
                    @error('posisiJuara')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Bukti Prestasi (Link Gdrive/Lainnya)</strong></label>
                    <input type="text" class="form-control @error('buktiPrestasi') is-invalid @enderror"
                        name="buktiPrestasi" id="buktiPrestasi" value="{{ $prestasi->buktiPrestasi }}">
                    @error('buktiPrestasi')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Mencari Siswa --}}
                <div class="form-group">
                    <label><strong>Siswa yang Berprestasi</strong></label>
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
                        @foreach ($profilSiswaList as $siswa)
                            <option value="{{ $siswa->id }}" {{ $siswa->id == $prestasi->siswa_id ? 'selected' : '' }}>
                                {{ $siswa->namaSiswa }}
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
