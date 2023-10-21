{{-- Template Utama --}}
@extends('Layouts.master')

{{-- Bagian: Content --}}

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Tahun Ajar</h6>
        </div>
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary d-flex align-items-center" data-toggle="modal" data-target="#modalTA">
                <i class="fa-solid fa-circle-plus"></i>
                <p class="mb-0 ml-2">Tambahkan</p>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modalTA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Input</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/tahun-ajar/store" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><strong>Tahun Ajar</strong></label>
                                    <input type="text"
                                        class="form-control @error('tahun_ajar_siswa') is-invalid @enderror"
                                        name="tahun_ajar_siswa" id="tahun_ajar_siswa" placeholder="Misal: 2022/2023">
                                    @error('tahun_ajar_siswa')
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
            <table class="table table-bordered">
                <thead class="thead bg-primary text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tahun Ajar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tahun_ajar as $key => $item)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $item->tahun_ajar_siswa }}</td>
                            <td>
                                <form action="/tahun-ajar/{{ $item->id }}/destroy" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger my-1">
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
@endsection
