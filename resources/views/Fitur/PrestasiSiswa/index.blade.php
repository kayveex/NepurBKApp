{{-- Template Utama --}}
@extends('Layouts.master')

{{-- Bagian Konten --}}

@section('content')
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'guru' || Auth::user()->role == 'kepalaSekolah')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Prestasi Siswa</h6>
            </div>
            <div class="card-body">
                @if (Auth::user()->role == 'guru' || Auth::user()->role == 'admin')
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary d-flex align-items-center" data-toggle="modal"
                        data-target="#modalTA">
                        <i class="fa-solid fa-circle-plus"></i>
                        <p class="mb-0 ml-2">Tambahkan</p>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalTA" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Input Prestasi Siswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/siswa/prestasi-siswa/store" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label><strong>Tahun Pencapaian</strong></label>
                                            <input type="number"
                                                class="form-control @error('tahunPencapaian') is-invalid @enderror"
                                                name="tahunPencapaian" id="tahunPencapaian" placeholder="">
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
                                                <option value="akademik">Akademik</option>
                                                <option value="non-akademik">Non Akademik</option>
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
                                                rows="3"></textarea>
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
                                                <option value="lokal">Lokal</option>
                                                <option value="regional">Regional</option>
                                                <option value="nasional">Nasional</option>
                                                <option value="internasional">Internasional</option>
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
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="harapan">Harapan</option>
                                            </select>
                                            @error('posisiJuara')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Bukti Prestasi (Link Gdrive/Lainnya)</strong></label>
                                            <input type="text"
                                                class="form-control @error('buktiPrestasi') is-invalid @enderror"
                                                name="buktiPrestasi" id="buktiPrestasi" placeholder="">
                                            @error('buktiPrestasi')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label><strong> Siswa yang Berprestasi</strong></label>
                                            <div class="input-group">
                                                <input type="text" id="searchInput" class="form-control"
                                                    placeholder="Cari siswa...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                                </div>
                                            </div>
                                            <hr>
                                            <select name="siswa_id" id="siswa_id" class="form-control">
                                                <option>-- Buka Untuk Mendapatkan Hasil Search --</option>
                                                <!-- Menampilkan pilihan klien siswa -->
                                                @foreach ($profilSiswaList as $siswa)
                                                    <option value="{{ $siswa->id }}">{{ $siswa->namaSiswa }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                <br />
                <!-- Table -->
                <div class="table-responsive text-center">
                    <table class="table table-bordered text-center" id="prestasiSiswaTable">
                        <thead class="thead bg-primary text-white">
                            <tr>
                                <th scope="col">Tahun</th>
                                <th scope="col">Bidang Prestasi</th>
                                <th scope="col">Tingkat Prestasi</th>
                                <th scope="col">Posisi Juara</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Bukti Prestasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prestasiSiswaList as $key => $prestasi)
                                <tr>
                                    <td>{{ $prestasi->tahunPencapaian }}</td>
                                    <td>{{ $prestasi->bidangPrestasi }}</td>
                                    <td>{{ $prestasi->tingkatPrestasi }}</td>
                                    <td>{{ $prestasi->posisiJuara }}</td>
                                    <td>{{ $prestasi->deskripsi }}</td>
                                    <td><a class="text-primary text-decoration-underline font-weight-bold" target="_blank"
                                            href="/akun/akun-siswa/{{ $prestasi->profilSiswa->userFromSiswa->id }}">{{ $prestasi->profilSiswa->namaSiswa }}</a>
                                    </td>
                                    <td><a class="text-primary text-decoration-underline font-weight-bold" target="_blank"
                                            href="{{ $prestasi->buktiPrestasi }}">Link</a></td>
                                    <td>
                                        @if (Auth::user()->role == 'guru' || Auth::user()->role == 'admin')
                                            <form action="/siswa/prestasi-siswa/{{ $prestasi->id }}/destroy"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <a href="/siswa/prestasi-siswa/{{ $prestasi->id }}"
                                                    class="btn btn-info my-1 px-3">
                                                    <i class="fa-solid fa-info"></i>
                                                </a>
                                                <a href="/siswa/prestasi-siswa/{{ $prestasi->id }}/edit"
                                                    class="btn btn-warning my-1 px-2">
                                                    <i class="fa-solid fa-user-pen"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger my-1">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if (Auth::user()->role == 'siswa' || Auth::user()->role == 'kepalaSekolah')
                                            <a href="/siswa/prestasi-siswa/{{ $prestasi->id }}"
                                                class="btn btn-info my-1 px-3">
                                                <i class="fa-solid fa-info"></i>
                                            </a>
                                        @endif

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
    @endif
    @if (Auth::user()->role == 'siswa')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Prestasi: {{ Auth::user()->profilSiswa->namaSiswa }}
                </h6>
            </div>
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary d-flex align-items-center" data-toggle="modal"
                    data-target="#modalTA">
                    <i class="fa-solid fa-circle-plus"></i>
                    <p class="mb-0 ml-2">Tambahkan</p>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modalTA" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Input Prestasi Siswa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/siswa/prestasi-siswa/store" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label><strong>Tahun Pencapaian</strong></label>
                                        <input type="number"
                                            class="form-control @error('tahunPencapaian') is-invalid @enderror"
                                            name="tahunPencapaian" id="tahunPencapaian" placeholder="">
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
                                            <option value="akademik">Akademik</option>
                                            <option value="non-akademik">Non Akademik</option>
                                        </select>
                                        @error('bidangPrestasi')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Deskripsi</strong></label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi"
                                            cols="100" rows="3"></textarea>
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
                                            <option value="lokal">Lokal</option>
                                            <option value="regional">Regional</option>
                                            <option value="nasional">Nasional</option>
                                            <option value="internasional">Internasional</option>
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
                                            <option value="I">I</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="harapan">Harapan</option>
                                        </select>
                                        @error('posisiJuara')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Bukti Prestasi (Link Gdrive/Lainnya)</strong></label>
                                        <input type="text"
                                            class="form-control @error('buktiPrestasi') is-invalid @enderror"
                                            name="buktiPrestasi" id="buktiPrestasi" placeholder="">
                                        @error('buktiPrestasi')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <br />
                <!-- Table -->
                <div class="table-responsive text-center">
                    <table class="table table-bordered text-center" id="prestasiSiswaTable">
                        <thead class="thead bg-primary text-white">
                            <tr>
                                <th scope="col">Tahun</th>
                                <th scope="col">Bidang Prestasi</th>
                                <th scope="col">Tingkat Prestasi</th>
                                <th scope="col">Posisi Juara</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Bukti Prestasi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prestasiSiswaList as $key => $prestasi)
                                @if ($prestasi->siswa_id == Auth::user()->profilSiswa->id)
                                    <tr>
                                        <td>{{ $prestasi->tahunPencapaian }}</td>
                                        <td>{{ $prestasi->bidangPrestasi }}</td>
                                        <td>{{ $prestasi->tingkatPrestasi }}</td>
                                        <td>{{ $prestasi->posisiJuara }}</td>
                                        <td>{{ $prestasi->deskripsi }}</td>
                                        <td><a class="text-primary text-decoration-underline font-weight-bold"
                                                target="_blank" href="{{ $prestasi->buktiPrestasi }}">Link</a></td>
                                        <td>
                                            <form action="/siswa/prestasi-siswa/{{ $prestasi->id }}/destroy"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <a href="/siswa/prestasi-siswa/{{ $prestasi->id }}"
                                                    class="btn btn-info my-1 px-3">
                                                    <i class="fa-solid fa-info"></i>
                                                </a>
                                                <a href="/siswa/prestasi-siswa/{{ $prestasi->id }}/edit"
                                                    class="btn btn-warning my-1 px-2">
                                                    <i class="fa-solid fa-user-pen"></i>
                                                </a>
                                                <button type="submit" class="btn btn-danger my-1">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif

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
    @endif

@endsection


@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
@endpush

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
    <script>
        $(document).ready(function() {
            $('#prestasiSiswaTable').DataTable({
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print', 'pageLength'
                ]
            });
        });
    </script>
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/datatables.css"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/datatables.js">
    </script>
@endpush
