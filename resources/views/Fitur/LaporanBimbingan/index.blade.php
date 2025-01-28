{{-- Template Utama --}}
@extends('Layouts.master')

{{-- Bagian Konten --}}
@section('content')
    <div class="card shadow mb-4">
        @if (Auth::user()->role == 'guru')
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Bimbingan:
                    {{ Auth::user()->profilGuru->namaGuruBK }}</h6>
            </div>
        @endif
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'kepalaSekolah')
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan Bimbingan Keseluruhan</h6>
            </div>
        @endif

        <div class="card-body">
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'guru')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary d-flex align-items-center" data-toggle="modal"
                    data-target="#modalLaporanBimbingan">
                    <i class="fa-solid fa-circle-plus"></i>
                    <p class="mb-0 ml-2">Tambahkan</p>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modalLaporanBimbingan" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Input Laporan Bimbingan Baru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="laporanBimbinganForm" action="/siswa/laporan-bimbingan/store" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label><strong>Kelas</strong></label>
                                        <select class="form-control" name="kelas" id="kelas" required>
                                            <option>-- Pilih Kelas --</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                        @error('kelas')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Semester</strong></label>
                                        <select class="form-control" name="semester" id="semester" required>
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
                                        <select class="form-control" name="bidangLayanan" id="bidangLayanan" required>
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
                                        <input type="date" required
                                            class="form-control @error('tanggalBimbingan') is-invalid @enderror"
                                            name="tanggalBimbingan" id="tanggalBimbingan" placeholder="">
                                        @error('tanggalBimbingan')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Deskripsi Masalah</strong></label>
                                        <textarea class="form-control @error('keluhan') is-invalid @enderror" name="keluhan" id="keluhan" cols="100" required
                                            rows="3"></textarea>
                                        @error('keluhan')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Solusi</strong></label>
                                        <textarea class="form-control @error('solusi') is-invalid @enderror" name="solusi" id="solusi" cols="100" required
                                            rows="3"></textarea>
                                        @error('solusi')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Tahun Ajar</strong></label>
                                        <select name="tahunAjar_id" id="tahunAjar_id" class="form-control" required>
                                            <option>-- Pilih Tahun Ajar --</option>
                                            <!-- Menampilkan pilihan tahun ajaran dari database  -->
                                            @foreach ($tahunAjars as $tahun)
                                                <option value="{{ $tahun->id }}">{{ $tahun->tahun_ajar_siswa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Klien Siswa</strong></label>
                                        <div class="input-group">
                                            <input type="text" id="searchInput" class="form-control"
                                                placeholder="Cari siswa...">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                        </div>
                                        <hr>
                                        <select name="siswa_id" id="siswa_id" class="form-control" required> 
                                            <option>-- Buka Untuk Mendapatkan Hasil Search --</option>
                                            <!-- Menampilkan pilihan klien siswa -->
                                            @foreach ($profilSiswa as $siswa)
                                                <option value="{{ $siswa->id }}">{{ $siswa->namaSiswa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="submitButton" type="submit" class="btn btn-primary" disabled>Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <br />
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'kepalaSekolah')
                <div class="table-responsive text-center">
                    <table class="table table-bordered " id="laporanBimbinganTable">
                        <thead class="thead bg-primary text-white">
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Tahun Ajar</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Bidang Layanan</th>
                                <th scope="col">Deskripsi Masalah</th>
                                <th scope="col">Solusi</th>
                                <th scope="col">Ditangani Oleh</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporanBimbingan as $key => $laporan)
                                <tr>
                                    <td>{{ $laporan->tanggalBimbingan }}</td>
                                    <td>{{ $laporan->kelas }}</td>
                                    <td>{{ $laporan->semester }}</td>
                                    <td>{{ $laporan->tahunAjar->tahun_ajar_siswa }}</td>
                                    <td><a class="text-primary text-decoration-underline font-weight-bold"
                                            href="/akun/akun-siswa/{{ $laporan->fromProfilSiswa->userFromSiswa->id }}">{{ $laporan->fromProfilSiswa->namaSiswa }}</a>
                                    </td>
                                    <td>{{ $laporan->bidangLayanan }}</td>
                                    <td>{{ $laporan->keluhan }}</td>
                                    <td>{{ $laporan->solusi }}</td>
                                    <td>
                                        @if ($laporan->userAuthor->role == 'admin')
                                            {{ $laporan->userAuthor->username }}
                                        @endif
                                        @if ($laporan->userAuthor->role == 'guru')
                                            <a class="text-primary text-decoration-underline font-weight-bold"
                                                href="/akun/akun-guru/{{ $laporan->userAuthor->id }}">{{ $laporan->userAuthor->username }}</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (Auth::user()->role == 'admin')
                                            <form action="/siswa/laporan-bimbingan/{{ $laporan->id }}/destroy"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <a href="/siswa/laporan-bimbingan/{{ $laporan->id }}"
                                                    class="btn btn-info my-1 px-3">
                                                    <i class="fa-solid fa-info"></i>
                                                </a>
                                                <a href="/siswa/laporan-bimbingan/{{ $laporan->id }}/edit"
                                                    class="btn btn-warning my-1 px-2">
                                                    <i class="fa-solid fa-user-pen"></i>
                                                </a>
                                                <button id="delete_laporan" type="submit" class="btn btn-danger my-1 ">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                        @if (Auth::user()->role == 'kepalaSekolah')
                                            <a href="/siswa/laporan-bimbingan/{{ $laporan->id }}"
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
            @endif
            @if (Auth::user()->role == 'guru')
                <div class="table-responsive text-center">
                    <table class="table table-bordered " id="laporanBimbinganTable">
                        <thead class="thead bg-primary text-white">
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Tahun Ajar</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Bidang Layanan</th>
                                <th scope="col">Deskripsi Masalah</th>
                                <th scope="col">Solusi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporanBimbingan as $key => $laporan)
                                @if ($laporan->userAuthor->id === Auth::id())
                                    <tr>
                                        <td>{{ $laporan->tanggalBimbingan }}</td>
                                        <td>{{ $laporan->kelas }}</td>
                                        <td>{{ $laporan->semester }}</td>
                                        <td>{{ $laporan->tahunAjar->tahun_ajar_siswa }}</td>
                                        <td><a class="text-primary text-decoration-underline font-weight-bold"
                                                href="/akun/akun-siswa/{{ $laporan->fromProfilSiswa->userFromSiswa->id }}">{{ $laporan->fromProfilSiswa->namaSiswa }}</a>
                                        </td>
                                        <td>{{ $laporan->bidangLayanan }}</td>
                                        <td>{{ $laporan->keluhan }}</td>
                                        <td>{{ $laporan->solusi }}</td>
                                        <td class="text-center">
                                            <form action="/siswa/laporan-bimbingan/{{ $laporan->id }}/destroy"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <a href="/siswa/laporan-bimbingan/{{ $laporan->id }}"
                                                    class="btn btn-info my-1 px-3">
                                                    <i class="fa-solid fa-info"></i>
                                                </a>
                                                <a href="/siswa/laporan-bimbingan/{{ $laporan->id }}/edit"
                                                    class="btn btn-warning my-1 px-2">
                                                    <i class="fa-solid fa-user-pen"></i>
                                                </a>
                                                <button id="delete_laporan" type="submit" class="btn btn-danger my-1 ">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="10">
                                        <div class="alert alert-danger" role="alert">
                                            Data Kosong ! 😢
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
            @if (Auth::user()->role == 'siswa')
                <div class="table-responsive text-center">
                    <table class="table table-bordered " id="laporanBimbinganTable">
                        <thead class="thead bg-primary text-white">
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Tahun Ajar</th>
                                <th scope="col">Bidang Layanan</th>
                                <th scope="col">Deskripsi Masalah</th>
                                <th scope="col">Solusi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($laporanBimbingan as $key => $laporan)
                                @if ($laporan->siswa_id == Auth::user()->profilSiswa->id)
                                    <tr>
                                        <td>{{ $laporan->tanggalBimbingan }}</td>
                                        <td>{{ $laporan->kelas }}</td>
                                        <td>{{ $laporan->semester }}</td>
                                        <td>{{ $laporan->tahunAjar->tahun_ajar_siswa }}</td>
                                        <td>{{ $laporan->bidangLayanan }}</td>
                                        <td>{{ $laporan->keluhan }}</td>
                                        <td>{{ $laporan->solusi }}</td>
                                        <td class="text-center">
                                            <a href="/siswa/laporan-bimbingan/{{ $laporan->id }}"
                                                class="btn btn-info my-1 px-3">
                                                <i class="fa-solid fa-info"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="10">
                                        <div class="alert alert-danger" role="alert">
                                            Data Kosong ! 😢
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" />
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
            $('#laporanBimbinganTable').DataTable({
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

    {{-- Validator Form Input Laporan Bimbingan --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('laporanBimbinganForm');
            const submitButton = document.getElementById('submitButton');
    
            // Pantau perubahan pada semua input, select, dan textarea
            form.addEventListener('input', function () {
                // Periksa apakah semua elemen form yang diperlukan telah diisi
                const allFieldsFilled = Array.from(form.querySelectorAll('input, select, textarea')).every(input => {
                    // Abaikan input dengan ID #searchInput dan validasi elemen dengan atribut required
                    if (input.id === 'searchInput') return true;
                    return input.hasAttribute('required') ? input.value.trim() !== '' : true;
                });
    
                // Aktifkan tombol submit jika semua field terisi, nonaktifkan jika tidak
                submitButton.disabled = !allFieldsFilled;
            });
        });
    </script>
    
    
    {{-- Sweetalert Delete --}}
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#delete_laporan', function(e) {
                e.preventDefault();
                // Make a small toast to notify the user that the data has been deleted on right top
                Swal.fire({
                    title: 'Laporan Bimbingan Siswa Telah Dihapus',
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: false,
                    color: 'white',
                    background: '#198754',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    
                });

                // Submit form after 3 seconds
                setTimeout(() => {
                    $(this).closest('form').submit();
                }, 3000); // Waktu sesuai durasi SweetAlert muncul
            })
        })
    </script>
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/datatables.css"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/datatables.js">
    </script>
@endpush
