@extends('layouts.app')

@section('title', 'Data Pengabdian')

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
                        <h1>Data Pengabdian</h1>
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
                        <h3 class="card-title">Data Pengabdian</h3>
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
                                    @forelse ($pengabdians as $key => $pengabdian)
                                        <tr>
                                            <td class="text-center">{{ $pengabdians->firstItem() + $key }}</td>
                                            <td>
                                                {{ $pengabdian->judul }}
                                            </td>
                                            <td>
                                                <div class="mb-2">
                                                    <strong>Ketua Peneliti:</strong>
                                                    <br>
                                                    {{ $pengabdian->user->nama }}
                                                    <br>
                                                    <strong>Anggota:</strong>
                                                    <br>
                                                    @if (count($pengabdian->personels))
                                                        <ol class="px-3 mb-0">
                                                            @foreach ($pengabdian->personels as $personel)
                                                                <li>{{ $personel->user->nama }}</li>
                                                            @endforeach
                                                        </ol>
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $pengabdian->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-revisi-{{ $pengabdian->id }}">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm btn-flat btn-block"
                                                    data-toggle="modal"
                                                    data-target="#modal-setuju-{{ $pengabdian->id }}">
                                                    <i class="fas fa-check"></i>
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
                                {{ $pengabdians->appends(Request::all())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
    @foreach ($pengabdians as $pengabdian)
        @php
            $revisi = \App\Models\PengabdianRevisi::where([['pengabdian_id', $pengabdian->id], ['status', true]])
                ->orderByDesc('id')
                ->first();
            $pengabdian_revisis = \App\Models\PengabdianRevisi::where([
                ['pengabdian_id', $pengabdian->id],
                ['status', false],
            ])
                ->orderByDesc('id')
                ->get();
        @endphp
        <div class="modal fade" id="modal-lihat-{{ $pengabdian->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Pengabdian</h4>
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
                                {{ $pengabdian->user->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Tahun Kegiatan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengabdian->tahun }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Judul Pengabdian</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengabdian->judul }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Jenis Pengabdian</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengabdian->jenis_pengabdian->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Jenis Pendanaan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengabdian->jenis_pendanaan->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Sumber Dana</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengabdian->dana_sumber }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Dana Disetujui</strong>
                            </div>
                            <div class="col-md-6">
                                @rupiah($pengabdian->dana_setuju)
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Personel</strong>
                                <small class="text-muted">(anggota)</small>
                            </div>
                            <div class="col-md-6">
                                @if (count($pengabdian->personels))
                                    <ol class="px-3 mb-0">
                                        @foreach ($pengabdian->personels as $personel)
                                            <li>{{ $personel->user->nama }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <hr class="my-2">
                        @if ($pengabdian->status == 'menunggu')
                            @if ($pengabdian->file)
                                <div class="alert alert-light text-center rounded-0 mb-0">
                                    <span class="text-muted">- Mengunggu Anda mengonfirmasi file laporan -</span>
                                </div>
                            @else
                                <div class="alert alert-light text-center rounded-0 mb-0">
                                    <span class="text-muted">- Menunggu dosen mengunggah file laporan -</span>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-revisi-{{ $pengabdian->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Revisi Penelitian</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('operator/pengabdian-list/perbaikan/' . $pengabdian->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            @if ($pengabdian->status == 'menunggu')
                                <div class="mb-2">
                                    <strong>Laporan Penelitian</strong>
                                    <br>
                                    @if ($pengabdian->file)
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/uploads/' . $pengabdian->file) }}" target="_blank"
                                                class="btn btn-secondary btn-xs btn-flat">
                                                Lihat Laporan
                                            </a>
                                        </div>
                                    @else
                                        <button type="button" class="btn btn-default btn-xs btn-flat"
                                            style="pointer-events: none">File laporan belum diunggah</button>
                                    @endif
                                </div>
                            @else
                                <div class="mb-2">
                                    <strong>
                                        Revisi
                                        {{ count($pengabdian_revisis) + 1 }}
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
                                    @else
                                        <button type="button" class="btn btn-default btn-xs btn-flat"
                                            style="pointer-events: none">File laporan belum diunggah</button>
                                    @endif
                                </div>
                            @endif
                            @if (($pengabdian->status == 'menunggu' && $pengabdian->file) || ($pengabdian->status == 'revisi' && $revisi->file))
                                <div class="form-group mb-2">
                                    <label for="keterangan">Keterangan Revisi</label>
                                    <textarea
                                        class="form-control rounded-0 @if (session('id') == $pengabdian->id) @error('keterangan') is-invalid @enderror @endif"
                                        name="keterangan" id="keterangan" cols="30" rows="4">{{ session('id') == $pengabdian->id ? old('keterangan') : '' }}</textarea>
                                    @if (session('id') == $pengabdian->id)
                                        @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif
                                </div>
                            @endif
                        </div>
                        @if ($pengabdian->status == 'revisi')
                            <div class="modal-body border-top">
                                @if (count($pengabdian_revisis))
                                    @foreach ($pengabdian_revisis as $key => $pengabdian_revisi)
                                        <div class="mb-2">
                                            <strong>Revisi {{ count($pengabdian_revisis) - $key }}</strong>
                                            <br>
                                            <span>{{ $pengabdian_revisi->keterangan }}</span>
                                            <br>
                                            @if ($pengabdian_revisi->file)
                                                <a href="{{ asset('storage/uploads/' . $pengabdian_revisi->file) }}"
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
                                    <a href="{{ asset('storage/uploads/' . $pengabdian->file) }}" target="_blank"
                                        class="btn btn-secondary btn-xs btn-flat">
                                        Lihat Laporan
                                    </a>
                                </div>
                            </div>
                        @endif
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                data-dismiss="modal">Tutup</button>
                            @if (($pengabdian->status == 'menunggu' && $pengabdian->file) || ($pengabdian->status == 'revisi' && $revisi->file))
                                <button type="submit" class="btn btn-warning btn-sm btn-flat">Revisi</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-setuju-{{ $pengabdian->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Penelitian</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('operator/pengabdian-list/setujui/' . $pengabdian->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            @if (($pengabdian->status == 'menunggu' && $pengabdian->file) || ($pengabdian->status == 'revisi' && $revisi->file))
                                Yakin menyetujui Laporan Penelitian dari <strong>{{ $pengabdian->user->nama }}</strong>?
                            @else
                                <div class="alert alert-light text-center rounded-0 mb-2">
                                    <span class="text-muted">- Menunggu dosen mengunggah file revisi -</span>
                                </div>
                            @endif
                        </div>
                        @if (($pengabdian->status == 'menunggu' && $pengabdian->file) || ($pengabdian->status == 'revisi' && $revisi->file))
                            <div class="modal-body border-top">
                                @if ($revisi)
                                    <div class="mb-2">
                                        <strong>Revisi Terakhir</strong>
                                        <br>
                                        <span>{{ $revisi->keterangan }}</span>
                                        <br>
                                        <a href="{{ asset('storage/uploads/' . $revisi->file) }}" target="_blank"
                                            class="btn btn-secondary btn-xs btn-flat">
                                            Lihat Laporan
                                        </a>
                                    </div>
                                @else
                                    <div class="mb-2">
                                        <strong>Laporan Penelitian</strong>
                                        <br>
                                        <a href="{{ asset('storage/uploads/' . $pengabdian->file) }}" target="_blank"
                                            class="btn btn-secondary btn-xs btn-flat">
                                            Lihat Laporan
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                data-dismiss="modal">Tutup</button>
                            @if (($pengabdian->status == 'menunggu' && $pengabdian->file) || ($pengabdian->status == 'revisi' && $revisi->file))
                                <button type="submit" class="btn btn-primary btn-sm btn-flat">Konfirmasi</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
