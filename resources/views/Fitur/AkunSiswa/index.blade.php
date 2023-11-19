{{-- Template Utama --}}
@extends('Layouts.master')

{{-- Bagian: Content  --}}
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Akun Siswa</h6>
        </div>
        <div class="card-body">
            @if (Auth::user()->role == 'admin')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary d-flex align-items-center" data-toggle="modal"
                    data-target="#modalAkunSiswa">
                    <i class="fa-solid fa-circle-plus"></i>
                    <p class="mb-0 ml-2">Tambahkan</p>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modalAkunSiswa" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Input Akun Baru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="/akun/akun-siswa/store" method="POST" enctype="multipart/form-data">
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
                                        <input type="password"
                                            class="form-control @error('ulangPassword') is-invalid @enderror"
                                            name="ulangPassword" id="ulangPassword" placeholder="Ulangi Password!">
                                        @error('ulangPassword')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Nomor Induk Siswa</strong></label>
                                        <input type="number" class="form-control @error('id') is-invalid @enderror"
                                            name="id" id="id" placeholder="">
                                        @error('id')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Nama Siswa</strong></label>
                                        <input type="text" class="form-control @error('namaSiswa') is-invalid @enderror"
                                            name="namaSiswa" id="namaSiswa" placeholder="">
                                        @error('namaSiswa')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Tahun Masuk</strong></label>
                                        <input type="number" class="form-control @error('tahunMasuk') is-invalid @enderror"
                                            name="tahunMasuk" id="tahunMasuk" placeholder="">
                                        @error('tahunMasuk')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Tahun Lulus</strong></label>
                                        <input type="number" class="form-control @error('tahunLulus') is-invalid @enderror"
                                            name="tahunLulus" id="tahunLulus" placeholder="">
                                        @error('tahunLulus')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Jurusan</strong></label>
                                        <select class="form-control"class="form-control" name="jurusan" id="jurusan">
                                            <option>-- Pilih Jurusan --</option>
                                            <option value="TKJ">TKJ</option>
                                            <option value="DPIB">DPIB</option>
                                            <option value="TITL">TITL</option>
                                            <option value="TKRO">TKRO</option>
                                            <option value="TPM">TPM</option>
                                            <option value="T.ELIN">T.ELIN</option>
                                            <option value="TSM">TSM</option>
                                            <option value="TAV">TAV</option>
                                            <option value="IOP">IOP</option>
                                        </select>
                                        @error('jurusan')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Tanggal Lahir</strong></label>
                                        <input type="date"
                                            class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir"
                                            id="tgl_lahir" placeholder="">
                                        @error('tgl_lahir')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Upload Foto Siswa (Max: 5 MB)</strong></label>
                                        <br />
                                        <input class="input-file-normal" type="file" name="fotoSiswa"
                                            id="fotoSiswa" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <br />
                <div class="table-responsive text-center">
                    <table class="table table-bordered " id="akunSiswaTable">
                        <thead class="thead bg-primary text-white">
                            <tr>
                                <th scope="col">No. Induk</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Angkatan</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $key => $siswa)
                                <tr>
                                    <th class="copyable-cell" scope="row">{{ $siswa->profilSiswa->id }}</th>
                                    <td class="copyable-cell">{{ $siswa->profilSiswa->namaSiswa }}</td>
                                    <td class="copyable-cell">{{ $siswa->profilSiswa->jurusan }}</td>
                                    <td class="copyable-cell">{{ $siswa->profilSiswa->tahunMasuk }}</td>
                                    <td class="copyable-cell">{{ $siswa->username }}</td>
                                    <td class="copyable-cell">{{ $siswa->profilSiswa->ulangPassword }}</td>
                                    <td class="text-center">
                                        <form action="/akun/akun-siswa/{{ $siswa->id }}/destroy" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <a href="/akun/akun-siswa/{{ $siswa->id }}"
                                                class="btn btn-info my-1 px-3">
                                                <i class="fa-solid fa-info"></i>
                                            </a>
                                            <a href="/akun/akun-siswa/{{ $siswa->id }}/edit"
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
            @endif

            @if (Auth::user()->role == 'guru' || Auth::user()->role == 'kepalaSekolah')
                <div class="table-responsive text-center">
                    <table class="table table-bordered " id="akunSiswaTable">
                        <thead class="thead bg-primary text-white">
                            <tr>
                                <th scope="col">No. Induk</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Angkatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswas as $key => $siswa)
                                <tr>
                                    <th class="copyable-cell" scope="row">{{ $siswa->profilSiswa->id }}</th>
                                    <td class="copyable-cell">{{ $siswa->profilSiswa->namaSiswa }}</td>
                                    <td class="copyable-cell">{{ $siswa->profilSiswa->jurusan }}</td>
                                    <td class="copyable-cell">{{ $siswa->profilSiswa->tahunMasuk }}</td>
                                    <td class="text-center">
                                        <a href="/siswa/list-siswa/{{ $siswa->id }}" class="btn btn-info my-1 px-3">
                                            <i class="fa-solid fa-info"></i>
                                        </a>
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

        </div>
    </div>

    <br />

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#akunSiswaTable').DataTable({
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var copyableCells = document.querySelectorAll('.copyable-cell');

            copyableCells.forEach(function(cell) {
                cell.addEventListener('dblclick', function() {
                    // Membuat elemen input untuk menampung teks yang akan di-copy
                    var inputElement = document.createElement('input');
                    inputElement.value = cell.innerText;
                    document.body.appendChild(inputElement);

                    // Memilih teks dalam elemen input
                    inputElement.select();
                    inputElement.setSelectionRange(0, 99999); // Untuk mendukung mobile devices

                    // Menyalin teks ke clipboard
                    document.execCommand('copy');

                    // Menghapus elemen input setelah selesai
                    document.body.removeChild(inputElement);

                    // Tidak menampilkan toast, kode untuk toast dihapus
                });
            });
        });
    </script>
@endpush
