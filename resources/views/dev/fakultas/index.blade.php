@extends('layouts.app')

@section('title', 'Data Fakultas')

@section('loader')
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('storage/uploads/asset/logo-lppm.png') }}" alt="SIDHARMA" height="80"
            width="80" style="border-radius: 50%">
    </div>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Fakultas</h1>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h3 class="card-title">Data Fakultas</h3>
                        <div class="text-right">
                            <button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal"
                                data-target="#modal-tambah">
                                Tambah
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>Nama Fakultas</th>
                                        <th class="text-center" style="width: 100px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($fakultases as $key => $fakultas)
                                        <tr>
                                            <td class="text-center">{{ $fakultases->firstItem() + $key }}</td>
                                            <td>{{ $fakultas->nama }} ({{ $fakultas->kode }})</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm btn-flat"
                                                    data-toggle="modal" data-target="#modal-edit-{{ $fakultas->id }}">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm btn-flat"
                                                    data-toggle="modal" data-target="#modal-hapus-{{ $fakultas->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="4">
                                                <span class="text-muted">- Data tidak ditemukan -</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @if ($fakultases->total() > 10)
                                <div class="pagination pagination-sm float-right">
                                    {{ $fakultases->appends(Request::all())->links('pagination::bootstrap-4') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Fakultas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('dev/fakultas') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="nama">Nama Fakultas</label>
                            <input type="text"
                                class="form-control rounded-0 @if (!session('id')) @error('nama') is-invalid @enderror @endif"
                                name="nama" id="nama" value="{{ !session('id') ? old('nama') : '' }}">
                            @if (!session('id'))
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <label for="kode">Singkatan</label>
                            <input type="text"
                                class="form-control rounded-0 @if (!session('id')) @error('kode') is-invalid @enderror @endif"
                                name="kode" id="kode" oninput="this.value = this.value.toUpperCase()"
                                value="{{ !session('id') ? old('kode') : '' }}">
                            @if (!session('id'))
                                @error('kode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($fakultases as $fakultas)
        <div class="modal fade" id="modal-edit-{{ $fakultas->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Fakultas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('dev/fakultas/' . $fakultas->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="nama">Nama Fakultas</label>
                                <input type="text"
                                    class="form-control rounded-0 @if (session('id') == $fakultas->id) @error('nama') is-invalid @enderror @endif"
                                    name="nama" id="nama"
                                    value="{{ session('id') == $fakultas->id ? old('nama') : $fakultas->nama }}">
                                @if (session('id') == $fakultas->id)
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group mb-2">
                                <label for="kode">Singkatan</label>
                                <input type="text"
                                    class="form-control rounded-0 @if (session('id') == $fakultas->id) @error('kode') is-invalid @enderror @endif"
                                    name="kode" id="kode" oninput="this.value = this.value.toUpperCase()"
                                    value="{{ session('id') == $fakultas->id ? old('kode') : $fakultas->kode }}">
                                @if (session('id') == $fakultas->id)
                                    @error('kode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-hapus-{{ $fakultas->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Fakultas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin hapus <strong>{{ $fakultas->nama }}</strong>?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                        <form action="{{ url('dev/fakultas/' . $fakultas->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm btn-flat">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
