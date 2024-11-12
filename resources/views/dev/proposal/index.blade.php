@extends('layouts.app')

@section('title', 'Data Proposal')

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
                        <h1>Data Proposal</h1>
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
                        <h3 class="card-title">Data Proposal</h3>
                        <div class="text-right">
                            <a href="{{ url('dev/proposal/create') }}" class="btn btn-primary btn-sm btn-flat">
                                Buat Proposal
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
                                        <th>Proposal</th>
                                        <th class="text-center" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($proposals as $key => $proposal)
                                        <tr>
                                            <td class="text-center">{{ $proposals->firstItem() + $key }}</td>
                                            <td>
                                                {{ $proposal->user->nama }}
                                                <hr class="my-2">
                                                <strong>{{ ucfirst($proposal->jenis) }}</strong>
                                                <br>
                                                {{ $proposal->judul }}
                                                <br>
                                                @if ($proposal->status == 'menunggu' || $proposal->status == 'revisi1' || $proposal->status == 'revisi2')
                                                    <span class="badge badge-warning rounded-0">
                                                        {{ $proposal->status }}
                                                    </span>
                                                @elseif ($proposal->status == 'proses' || $proposal->status == 'setuju1' || $proposal->status == 'setuju2')
                                                    <span class="badge badge-primary rounded-0">
                                                        {{ $proposal->status }}
                                                    </span>
                                                @elseif ($proposal->status == 'pendanaan' || $proposal->status == 'mou')
                                                    <span class="badge badge-info rounded-0">
                                                        {{ $proposal->status }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-success rounded-0">
                                                        {{ $proposal->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $proposal->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ url('dev/proposal/' . $proposal->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm btn-flat btn-block">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-hapus-{{ $proposal->id }}">
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
                                {{ $proposals->appends(Request::all())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
    @foreach ($proposals as $proposal)
        <div class="modal fade" id="modal-lihat-{{ $proposal->id }}">
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
                                {{ $proposal->user->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Jenis Proposal</strong>
                            </div>
                            <div class="col-md-6">
                                {{ ucfirst($proposal->jenis) }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Tahun Kegiatan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $proposal->tahun }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Judul Proposal</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $proposal->judul }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Jenis {{ $proposal->jenis == 'penelitian' ? 'Penelitian' : 'Pengabdian' }}</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $proposal->jenis == 'penelitian' ? $proposal->jenis_penelitian->nama : $proposal->jenis_pengabdian->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Sumber Dana</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $proposal->jenis_pendanaan->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Dana Usulan</strong>
                            </div>
                            <div class="col-md-6">
                                @rupiah($proposal->dana_usulan)
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Dana Disetujui</strong>
                            </div>
                            <div class="col-md-6">
                                @if ($proposal->dana_setuju)
                                    @rupiah($proposal->dana_setuju)
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Dokumen Proposal</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ asset('storage/uploads/' . $proposal->file) }}"
                                    class="btn btn-info btn-xs btn-flat" target="_blank">
                                    Lihat Dokumen
                                </a>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Personel</strong>
                                <small class="text-muted">(anggota)</small>
                            </div>
                            <div class="col-md-6">
                                @if (count($proposal->personels) || count($proposal->mahasiswas))
                                    <ol class="px-3 mb-0">
                                        @foreach ($proposal->personels as $personel)
                                            <li>{{ $personel->user->nama }}</li>
                                        @endforeach
                                        @foreach ($proposal->mahasiswas as $nama => $prodi)
                                            <li>
                                                {{ $nama }}
                                                @if ($prodi)
                                                    <br>
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
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>MOU Proposal</strong>
                            </div>
                            <div class="col-md-6">
                                @if ($proposal->mou)
                                    <a href="{{ asset('storage/uploads/' . $proposal->mou) }}"
                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                        Lihat MOU
                                    </a>
                                @else
                                    <button type="button" class="btn btn-default btn-xs btn-flat"
                                        style="pointer-events: none">Belum ada MOU</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-body border-top">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Reviewer</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $proposal->peninjau->nama ?? '-' }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Jadwal</strong>
                            </div>
                            <div class="col-md-6">
                                @if ($proposal->mou)
                                    <a href="{{ url('jadwal/' . $proposal->jadwal_id) }}"
                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                        Lihat Jadwal
                                    </a>
                                @else
                                    <button type="button" class="btn btn-default btn-xs btn-flat"
                                        style="pointer-events: none">Belum ada Jadwal</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-body border-top">
                        @if ($proposal->status == 'menunggu')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Menunggu Operator menetapkan jadwal -</span>
                            </div>
                        @endif
                        @if ($proposal->status == 'proses')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Jadwal proposal telah ditetapkan -</span>
                            </div>
                        @endif
                        @if ($proposal->status == 'revisi1')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Proposal dalam tahap revisi oleh Reviewer -</span>
                            </div>
                        @endif
                        @if ($proposal->status == 'setuju1')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Proposal telah disetujui oleh Reviewer -</span>
                            </div>
                        @endif
                        @if ($proposal->status == 'revisi2')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Proposal dalam tahap revisi oleh Operator -</span>
                            </div>
                        @endif
                        @if ($proposal->status == 'pendanaan')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Menunggu Ka. LPPM mengonfirmasi pendanaan -</span>
                            </div>
                        @endif
                        @if ($proposal->status == 'mou' || $proposal->status == 'setuju2')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Proposal dalam tahap persetujuan MOU -</span>
                            </div>
                        @endif
                        @if ($proposal->status == 'selesai')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Proposal telah diselesaikan -</span>
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
    @endforeach
@endsection
