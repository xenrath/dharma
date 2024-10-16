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
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center align-top" style="width: 20px">No</th>
                                        <th class="align-top">Judul</th>
                                        <th class="align-top">Dosen / Personel</th>
                                        <th class="text-center align-top" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($penelitians as $key => $penelitian)
                                        <tr>
                                            <td class="text-center">{{ $penelitians->firstItem() + $key }}</td>
                                            <td>
                                                {{ $penelitian->judul }}
                                                <hr class="my-2">
                                                @rupiah($penelitian->dana_setuju)
                                            </td>
                                            <td>
                                                <div class="mb-2">
                                                    <strong>Ketua Peneliti:</strong>
                                                    <br>
                                                    {{ $penelitian->user->nama }}
                                                    <br>
                                                    <strong>Anggota:</strong>
                                                    <br>
                                                    @if (count($penelitian->personels) || count($penelitian->mahasiswas))
                                                        <ol class="px-3 mb-0">
                                                            @foreach ($penelitian->personels as $personel)
                                                                <li>{{ $personel->user->nama }}</li>
                                                            @endforeach
                                                            @foreach ($penelitian->mahasiswas as $mahasiswa)
                                                                <li>{{ $mahasiswa }}</li>
                                                            @endforeach
                                                        </ol>
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $penelitian->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @if ($penelitian->status == 'menunggu')
                                                    <button type="button" class="btn btn-warning btn-sm btn-flat btn-block"
                                                        data-toggle="modal"
                                                        data-target="#modal-upload-{{ $penelitian->id }}">
                                                        @if ($penelitian->file)
                                                            <i class="fas fa-clock"></i>
                                                        @else
                                                            <i class="fas fa-upload"></i>
                                                        @endif
                                                    </button>
                                                @endif
                                                @if ($penelitian->status == 'revisi')
                                                    @php
                                                        $revisi = \App\Models\PenelitianRevisi::where([
                                                            ['penelitian_id', $penelitian->id],
                                                            ['status', true],
                                                        ])
                                                            ->orderByDesc('id')
                                                            ->first();
                                                    @endphp
                                                    <button type="button" class="btn btn-warning btn-sm btn-flat btn-block"
                                                        data-toggle="modal"
                                                        data-target="#modal-revisi-{{ $penelitian->id }}">
                                                        @if ($penelitian->status == 'revisi' && $revisi->file)
                                                            <i class="fas fa-clock"></i>
                                                        @else
                                                            <i class="fas fa-upload"></i>
                                                        @endif
                                                    </button>
                                                @endif
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
                        <h4 class="modal-title">Data Penelitian</h4>
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
                                <strong>Jenis Pendanaan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $penelitian->jenis_pendanaan->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Sumber Dana</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $penelitian->dana_sumber }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Dana Disetujui</strong>
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
                                        class="btn btn-info btn-xs btn-flat" target="_blank">Lihat Laporan</a>
                                @else
                                    <button type="button" class="btn btn-default btn-xs btn-flat"
                                        style="pointer-events: none">File Laporan belum diunggah</button>
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
                                        @foreach ($penelitian->mahasiswas as $mahasiswa)
                                            <li>{{ $mahasiswa }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <hr class="my-2">
                        @if ($penelitian->status == 'menunggu')
                            @if ($penelitian->file)
                                <div class="alert alert-light text-center rounded-0 mb-2">
                                    <span class="text-muted">- Operator sedang mengecek laporan Anda -</span>
                                </div>
                            @else
                                <div class="alert alert-light text-center rounded-0 mb-2">
                                    <span class="text-muted">- Menunggu Anda mengunggah file -</span>
                                </div>
                            @endif
                        @endif
                        @if ($penelitian->status == 'revisi')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Penelitian dalam tahap revisi oleh Operator -</span>
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
        @if ($penelitian->status == 'menunggu')
            <div class="modal fade" id="modal-upload-{{ $penelitian->id }}">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h4 class="modal-title">File Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('dosen/penelitian/' . $penelitian->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                @if ($penelitian->file)
                                    <div class="alert alert-light text-center rounded-0 mb-2">
                                        <span class="text-muted">- Menunggu respon dari Operator -</span>
                                    </div>
                                @else
                                    <div class="form-group mb-2">
                                        <label for="file">Laporan Penelitian</label>
                                        <input type="file"
                                            class="form-control rounded-0 @if (session('id') == $penelitian->id) @error('file') is-invalid @enderror @endif"
                                            id="file" name="file" accept=".pdf">
                                        @if (session('id') == $penelitian->id)
                                            @error('file')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @endif
                                    </div>
                                @endif
                            </div>
                            @if ($penelitian->file)
                                <div class="modal-body border-top">
                                    <div class="mb-2">
                                        <strong>Laporan Penelitian</strong>
                                        <br>
                                        <a href="{{ asset('storage/uploads/' . $penelitian->file) }}"
                                            class="btn btn-secondary btn-xs btn-flat" target="_blank">
                                            Lihat Laporan
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default btn-sm btn-flat"
                                    data-dismiss="modal">Tutup</button>
                                @if (!$penelitian->file)
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Kirim</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @if ($penelitian->status == 'revisi')
            @php
                $revisi = \App\Models\PenelitianRevisi::where([['penelitian_id', $penelitian->id], ['status', true]])
                    ->orderByDesc('id')
                    ->first();
                $penelitian_revisis = \App\Models\PenelitianRevisi::where([
                    ['penelitian_id', $penelitian->id],
                    ['status', false],
                ])
                    ->orderByDesc('id')
                    ->get();
            @endphp
            <div class="modal fade" id="modal-revisi-{{ $penelitian->id }}">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h4 class="modal-title">Revisi Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('dosen/penelitian/perbaikan/' . $revisi->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                @if ($revisi->file)
                                    <div class="alert alert-light text-center rounded-0 mb-2">
                                        <span class="text-muted">- Menunggu respon dari Operator -</span>
                                    </div>
                                @else
                                    <div class="mb-2">
                                        <strong>
                                            Revisi
                                            {{ count($penelitian_revisis) + 1 }}
                                        </strong>
                                        <br>
                                        <span>{{ $revisi->keterangan }}</span>
                                        <br>
                                        @if ($revisi->file)
                                            <div class="mb-2">
                                                <a href="{{ asset('storage/uploads/' . $revisi->file) }}" target="_blank"
                                                    class="btn btn-secondary btn-xs btn-flat">
                                                    Lihat Laporan
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="file">File Revisi</label>
                                        <input type="file"
                                            class="form-control rounded-0 @if (session('id') == $penelitian->id) @error('file') is-invalid @enderror @endif"
                                            id="file" name="file" accept=".pdf">
                                        @if (session('id') == $penelitian->id)
                                            @error('file')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="modal-body border-top">
                                @if ($revisi->file)
                                    <div class="mb-2">
                                        <strong>
                                            Revisi
                                            {{ count($penelitian_revisis) + 1 }}
                                        </strong>
                                        <br>
                                        <span>{{ $revisi->keterangan }}</span>
                                        <br>
                                        @if ($revisi->file)
                                            <div class="mb-2">
                                                <a href="{{ asset('storage/uploads/' . $revisi->file) }}" target="_blank"
                                                    class="btn btn-secondary btn-xs btn-flat">
                                                    Lihat Laporan
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if (count($penelitian_revisis))
                                    @foreach ($penelitian_revisis as $penelitian_revisi)
                                        <div class="mb-2">
                                            <strong>Revisi {{ count($penelitian_revisis) - $key }}</strong>
                                            <br>
                                            <span>{{ $penelitian_revisi->keterangan }}</span>
                                            <br>
                                            @if ($penelitian_revisi->file)
                                                <a href="{{ asset('storage/uploads/' . $penelitian_revisi->file) }}"
                                                    target="_blank" class="btn btn-secondary btn-xs btn-flat">
                                                    Lihat Laporan
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                                <div class="mb-2">
                                    <strong>Laporan Penelitian</strong>
                                    <br>
                                    <a href="{{ asset('storage/uploads/' . $penelitian->file) }}"
                                        class="btn btn-secondary btn-xs btn-flat" target="_blank">
                                        Lihat Laporan
                                    </a>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default btn-sm btn-flat"
                                    data-dismiss="modal">Tutup</button>
                                @if (!$revisi->file)
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Kirim</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
