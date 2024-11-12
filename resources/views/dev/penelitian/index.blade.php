@extends('layouts.app')

@section('title', 'Data Penelitian')

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
                        <h1>Data Penelitian</h1>
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
                        <h3 class="card-title">Data Penelitian</h3>
                        <div class="text-right">
                            <a href="{{ url('dev/penelitian/create') }}" class="btn btn-primary btn-sm btn-flat">
                                Buat Penelitian
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>Penelitian</th>
                                        <th class="text-center" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($penelitians as $key => $penelitian)
                                        <tr>
                                            <td class="text-center">{{ $penelitians->firstItem() + $key }}</td>
                                            <td>
                                                {{ $penelitian->user->nama }}
                                                <hr class="my-2">
                                                {{ $penelitian->judul }}
                                                <br>
                                                @if ($penelitian->status == 'menunggu' || $penelitian->status == 'revisi1' || $penelitian->status == 'revisi2')
                                                    <span class="badge badge-warning rounded-0">
                                                        {{ $penelitian->status }}
                                                    </span>
                                                @elseif ($penelitian->status == 'proses' || $penelitian->status == 'setuju1' || $penelitian->status == 'setuju2')
                                                    <span class="badge badge-primary rounded-0">
                                                        {{ $penelitian->status }}
                                                    </span>
                                                @elseif ($penelitian->status == 'pendanaan' || $penelitian->status == 'mou')
                                                    <span class="badge badge-info rounded-0">
                                                        {{ $penelitian->status }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-success rounded-0">
                                                        {{ $penelitian->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $penelitian->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ url('dev/penelitian/' . $penelitian->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm btn-flat btn-block">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-hapus-{{ $penelitian->id }}">
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
                                {{ $penelitians->appends(Request::all())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
    @foreach ($penelitians as $penelitian)
        <div class="modal fade" id="modal-lihat-{{ $penelitian->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Proposal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Dosen</strong>
                                <small class="text-muted">(ketua)</small>
                            </div>
                            <div class="col-md-6">
                                {{ $penelitian->user->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Tahun Kegiatan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $penelitian->tahun }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Judul Penelitian</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $penelitian->judul }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Jenis Penelitian</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $penelitian->jenis_penelitian->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Sumber Dana</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $penelitian->jenis_pendanaan->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Dana Disetuju</strong>
                            </div>
                            <div class="col-md-6">
                                @rupiah($penelitian->dana_setuju)
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Laporan Penelitian</strong>
                            </div>
                            <div class="col-md-6">
                                @if ($penelitian->file)
                                    <a href="{{ asset('storage/uploads/' . $penelitian->file) }}"
                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                        Lihat Laporan
                                    </a>
                                @else
                                    <button type="button" class="btn btn-default btn-xs btn-flat"
                                        style="pointer-events: none">File laporan belum diunggah</button>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Personel</strong>
                                <small class="text-muted">(anggota)</small>
                            </div>
                            <div class="col-md-6">
                                @if (count($penelitian->personels) || count($penelitian->mahasiswas))
                                    <ol class="px-3 mb-0">
                                        @foreach ($penelitian->personels as $personel)
                                            <li>{{ $personel->user->nama }}</li>
                                        @endforeach
                                        @foreach ($penelitian->mahasiswas as $nama => $prodi)
                                            <li>
                                                {{ $nama }}
                                                @if ($prodi)
                                                    ({{ $prodi }})
                                                @endif
                                            </li>
                                        @endforeach
                                    </ol>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-body border-top">
                        @if ($penelitian->status == 'menunggu')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Menunggu Dosen mengunggah File Laporan -</span>
                            </div>
                        @endif
                        @if ($penelitian->status == 'revisi')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Penelitian sedang dalam tahap revisi -</span>
                            </div>
                        @endif
                        @if ($penelitian->status == 'selesai')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Penelitian telah disetujui -</span>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-hapus-{{ $penelitian->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Penelitian</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin hapus penelitian dari <strong>{{ $penelitian->user->nama }}</strong>?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                        <form action="{{ url('dev/penelitian/' . $penelitian->id) }}" method="POST">
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
