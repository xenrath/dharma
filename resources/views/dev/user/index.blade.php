@extends('layouts.app')

@section('title', 'Data User')

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
                        <h1>Data User</h1>
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
                        <h3 class="card-title">Data User</h3>
                        <div class="text-right">
                            <a href="{{ url('dev/user/trash') }}" class="btn btn-danger btn-sm btn-flat">Sampah</a>
                            |
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
                                        <th class="text-center" style="width: 140px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $key => $user)
                                        <tr>
                                            <td class="text-center">{{ $users->firstItem() + $key }}</td>
                                            <td>
                                                {{ $user->nama }}
                                                <span class="text-muted">
                                                    ({{ ucfirst($user->role) . ($user->is_ketua ? '|Ketua' : '') . ($user->is_peninjau ? '|Reviewer' : '') }})
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $user->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ url('dev/user/' . $user->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm btn-flat">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm btn-flat"
                                                    data-toggle="modal" data-target="#modal-hapus-{{ $user->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="4">
                                                <span class="text-muted">- Data tidak ditemukan -</span>
                                            </td>
                                        </tr>)
                                    @endforelse
                                </tbody>
                            </table>
                            @if ($users->total() > 10)
                                <div class="pagination pagination-sm float-right">
                                    {{ $users->appends(Request::all())->links('pagination::bootstrap-4') }}
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
                    <h4 class="modal-title">Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('dev/user') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="role">Pilih Role</label>
                            <select
                                class="custom-select rounded-0 @if (!session('id')) @error('role') is-invalid @enderror @endif"
                                name="role" id="role">
                                <option value="">- Pilih -</option>
                                <option value="operator">Operator</option>
                                <option value="dosen">Dosen</option>
                            </select>
                            @if (!session('id'))
                                @error('role')
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
    @foreach ($users as $user)
        <div class="modal fade" id="modal-lihat-{{ $user->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Nama Lengkap</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $user->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Role</strong>
                            </div>
                            <div class="col-md-6">
                                {{ ucfirst($user->role) }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Nomor Telepon</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $user->telp ?? '-' }}
                            </div>
                        </div>
                        @if ($user->role == 'dosen')
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>NIDN</strong>
                                </div>
                                <div class="col-md-6">
                                    {{ $user->nidn }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>NIPY</strong>
                                </div>
                                <div class="col-md-6">
                                    {{ $user->nipy ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Prodi</strong>
                                </div>
                                <div class="col-md-6">
                                    {{ $user->prodi->nama ?? '-' }}
                                </div>
                            </div>
                        @endif
                        @if ($user->is_ketua)
                            <span class="badge badge-primary rounded-0">KETUA</span>
                        @endif
                        @if ($user->is_peninjau)
                            <span class="badge badge-primary rounded-0">REVIEWER</span>
                        @endif
                    </div>
                    <div class="modal-footer justify-content-start">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-edit-{{ $user->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Fakultas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('dev/user/' . $user->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="nama">Nama Fakultas</label>
                                <input type="text"
                                    class="form-control rounded-0 @if (session('id') == $user->id) @error('nama') is-invalid @enderror @endif"
                                    name="nama" id="nama"
                                    value="{{ session('id') == $user->id ? old('nama') : $user->nama }}">
                                @if (session('id') == $user->id)
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
                                    class="form-control rounded-0 @if (session('id') == $user->id) @error('kode') is-invalid @enderror @endif"
                                    name="kode" id="kode" oninput="this.value = this.value.toUpperCase()"
                                    value="{{ session('id') == $user->id ? old('kode') : $user->kode }}">
                                @if (session('id') == $user->id)
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
        <div class="modal fade" id="modal-hapus-{{ $user->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Fakultas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin hapus user <strong>{{ $user->nama }}</strong>?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                        <form action="{{ url('dev/user/' . $user->id) }}" method="POST">
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
