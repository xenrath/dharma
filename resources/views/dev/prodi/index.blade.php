@extends('layouts.app')

@section('title', 'Data Prodi')

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
                        <h1>Data Prodi</h1>
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
                        <h3 class="card-title">Data Prodi</h3>
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
                                        <th>Nama Prodi</th>
                                        <th>Fakultas</th>
                                        <th class="text-center" style="width: 100px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($prodis as $key => $prodi)
                                        <tr>
                                            <td class="text-center">{{ $prodis->firstItem() + $key }}</td>
                                            <td>{{ $prodi->nama }}</td>
                                            <td>{{ $prodi->fakultas->nama }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm btn-flat"
                                                    data-toggle="modal" data-target="#modal-edit-{{ $prodi->id }}">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm btn-flat"
                                                    data-toggle="modal" data-target="#modal-hapus-{{ $prodi->id }}">
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
                            @if ($prodis->total() > 10)
                                <div class="pagination pagination-sm float-right">
                                    {{ $prodis->appends(Request::all())->links('pagination::bootstrap-4') }}
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
                    <h4 class="modal-title">Tambah Prodi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('dev/prodi') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="nama">Nama Prodi</label>
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
                            <label for="fakultas_id">Fakultas</label>
                            <select
                                class="custom-select rounded-0 @if (!session('id')) @error('fakultas_id') is-invalid @enderror @endif"
                                name="fakultas_id" id="fakultas_id">
                                <option value="">- Pilih -</option>
                                @foreach ($fakultases as $fakultas)
                                    <option value="{{ $fakultas->id }}"
                                        {{ (!session('id') ? old('fakultas_id') : '') == $fakultas->id ? 'selected' : '' }}>
                                        {{ $fakultas->nama }}</option>
                                @endforeach
                            </select>
                            @if (!session('id'))
                                @error('fakultas_id')
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
    @foreach ($prodis as $prodi)
        <div class="modal fade" id="modal-edit-{{ $prodi->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Prodi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('dev/prodi/' . $prodi->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="nama">Nama Prodi</label>
                                <input type="text"
                                    class="form-control rounded-0 @if (session('id') == $prodi->id) @error('nama') is-invalid @enderror @endif"
                                    name="nama" id="nama"
                                    value="{{ session('id') == $prodi->id ? old('nama') : $prodi->nama }}">
                                @if (session('id') == $prodi->id)
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group mb-2">
                                <label for="fakultas_id">Fakultas</label>
                                <select
                                    class="custom-select rounded-0 @if (session('id') == $prodi->id) @error('fakultas_id') is-invalid @enderror @endif"
                                    name="fakultas_id" id="fakultas_id">
                                    <option value="">- Pilih -</option>
                                    @foreach ($fakultases as $fakultas)
                                        <option value="{{ $fakultas->id }}"
                                            {{ (session('id') == $prodi->id ? old('fakultas_id') : $prodi->fakultas_id) == $fakultas->id ? 'selected' : '' }}>
                                            {{ $fakultas->nama }}</option>
                                    @endforeach
                                </select>
                                @if (session('id') == $prodi->id)
                                    @error('fakultas_id')
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
        <div class="modal fade" id="modal-hapus-{{ $prodi->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Prodi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin hapus prodi <strong>{{ $prodi->nama }}</strong>?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                        <form action="{{ url('dev/prodi/' . $prodi->id) }}" method="POST">
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
