@extends('layouts.app')

@section('title', 'Data Dosen')

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
                        <h1>Data Dosen</h1>
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
                        <h3 class="card-title">Data Dosen</h3>
                        <div class="text-right">
                            <a href="{{ url('operator/dosen/create') }}" class="btn btn-primary btn-sm btn-flat">
                                Tambah
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ url('operator/dosen') }}" method="get" autocomplete="off" id="form-filter">
                            <div class="row justify-content-between">
                                <div class="col-12 col-md-4 mb-2">
                                    <select class="custom-select rounded-0" name="kategori" id="kategori"
                                        onchange="document.getElementById('form-filter').submit();">
                                        <option value="semua"
                                            {{ request()->get('kategori') == 'semua' ? 'selected' : '' }}>Semua Dosen
                                        </option>
                                        <option value="peninjau"
                                            {{ request()->get('kategori') == 'peninjau' ? 'selected' : '' }}>Hanya Reviewer
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 mb-2">
                                    <div class="input-group">
                                        <input type="search" class="form-control rounded-0" id="keyword" name="keyword"
                                            placeholder="cari nama / nidn" value="{{ request()->get('keyword') }}">
                                        <div class="input-group-prepend rounded-0">
                                            <button type="submit" class="btn btn-secondary btn-sm">Cari</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>Dosen</th>
                                        <th class="text-center" style="width: 140px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dosens as $key => $dosen)
                                        <tr>
                                            <td class="text-center">{{ $dosens->firstItem() + $key }}</td>
                                            <td>
                                                {{ $dosen->nama }}
                                                <br>
                                                {{ $dosen->nidn }}
                                                @if ($dosen->is_peninjau)
                                                    <span class="badge badge-primary rounded-0">Reviewer</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $dosen->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ url('operator/dosen/' . $dosen->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm btn-flat">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm btn-flat"
                                                    data-toggle="modal" data-target="#modal-hapus-{{ $dosen->id }}">
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
                            <div class="pagination pagination-sm float-right">
                                {{ $dosens->appends(Request::all())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
    @foreach ($dosens as $dosen)
        <div class="modal fade" id="modal-lihat-{{ $dosen->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Dosen</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Nama Dosen</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $dosen->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>NIDN</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $dosen->nidn }}
                                @if ($dosen->is_peninjau)
                                    <span class="badge badge-primary rounded-0">Reviewer</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Prodi</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $dosen->prodi->fakultas->kode }} - {{ $dosen->prodi->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Nomor WhatsApp</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('hubungi/' . $dosen->telp) }}" target="_blank">
                                    {{ $dosen->telp }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-danger btn-sm btn-flat" data-dismiss="modal"
                            data-target="#modal-reset-{{ $dosen->id }}" data-toggle="modal">Reset Password</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-reset-{{ $dosen->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Reset Password</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin reset password dari <strong>{{ $dosen->nama }}</strong>?
                        <br><br>
                        <small class="text-muted">
                            Password akan direset menjadi
                            <strong>bhamada</strong>
                        </small>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                        <a href="{{ url('operator/dosen/reset/' . $dosen->id) }}"
                            class="btn btn-danger btn-sm btn-flat">Reset</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-hapus-{{ $dosen->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Dosen</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin hapus dosen <strong>{{ $dosen->nama }}</strong>?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                        <form action="{{ url('operator/dosen/' . $dosen->id) }}" method="POST">
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
