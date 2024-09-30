@extends('layouts.app')

@section('title', 'Data Sampah User')

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
                        <h1>Data Sampah User</h1>
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
                        <h3 class="card-title">Data Sampah User</h3>
                        <div class="text-right">
                            <button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal"
                                data-target="#modal-restore">
                                Restore Semua
                            </button>
                            |
                            <button type="button" class="btn btn-danger btn-sm btn-flat" data-toggle="modal"
                                data-target="#modal-hapus">
                                Hapus Semua
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
                                                <form action="{{ url('dev/user/restore/' . $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="button" class="btn btn-info btn-sm btn-flat"
                                                        data-toggle="modal" data-target="#modal-lihat-{{ $user->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary btn-sm btn-flat">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm btn-flat"
                                                        data-toggle="modal" data-target="#modal-hapus-{{ $user->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
    <div class="modal fade" id="modal-restore">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Restore Sampah User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin <strong>restore semua</strong> sampah user?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Tutup</button>
                    <form action="{{ url('dev/user/restore') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm btn-flat">Restore</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin <strong>hapus permanen semua</strong> sampah user?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                    <form action="{{ url('dev/user/delete') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm btn-flat">Hapus</button>
                    </form>
                </div>
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
        <div class="modal fade" id="modal-hapus-{{ $user->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin hapus permanen user <strong>{{ $user->nama }}</strong>?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Batal</button>
                        <form action="{{ url('dev/user/delete/' . $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm btn-flat">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
