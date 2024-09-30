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
                            <a href="{{ url('dosen/proposal-penelitian/create') }}" class="btn btn-primary btn-sm btn-flat">
                                Tambah
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
                                        <th>
                                            Dosen / Personel
                                        </th>
                                        <th>Judul</th>
                                        <th class="text-center" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($proposals as $key => $proposal)
                                        <tr>
                                            <td class="text-center">{{ $proposals->firstItem() + $key }}</td>
                                            <td>
                                                <strong>Ketua Peneliti:</strong>
                                                <br>
                                                {{ $proposal->user->nama }}
                                                <br>
                                                <strong>Anggota:</strong>
                                                <br>
                                                <ol class="px-3">
                                                    @foreach ($proposal->personels as $personel)
                                                        <li>{{ $personel->user->nama }}</li>
                                                    @endforeach
                                                </ol>
                                            </td>
                                            <td>
                                                {{ $proposal->judul }}
                                                <br>
                                                @if ($proposal->peninjau_id)
                                                    <hr class="my-2">
                                                    <strong>Reviewer:</strong>
                                                    {{ $proposal->peninjau->nama }}
                                                @endif
                                                @if ($proposal->laporan_id)
                                                    <br>
                                                    <a href="{{ url('dosen/proposal-laporan/' . $proposal->laporan_id) }}"
                                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                                        Lihat Jadwal
                                                    </a>
                                                @endif
                                                @if ($proposal->file)
                                                    <a href="{{ url('dosen/proposal-laporan/' . $proposal->laporan_id) }}"
                                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                                        Lihat Laporan
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $proposal->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @if ($proposal->user_id == auth()->user()->id)
                                                    @if ($proposal->status == 'menunggu')
                                                        <a href="{{ url('dosen/proposal-penelitian/' . $proposal->id . '/edit') }}"
                                                            class="btn btn-warning btn-sm btn-flat btn-block">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm btn-flat btn-block"
                                                            data-toggle="modal"
                                                            data-target="#modal-hapus-{{ $proposal->id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
                                                    @if ($proposal->status == 'revisi' || $proposal->status == 'revisi2')
                                                        @php
                                                            $revisi = $proposal->proposal_revisis
                                                                ->where('status', true)
                                                                ->sortBy('id', true)
                                                                ->first();
                                                        @endphp
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm btn-flat btn-block"
                                                            data-toggle="modal"
                                                            data-target="#modal-revisi-{{ $proposal->id }}">
                                                            @if ($revisi->file)
                                                                <i class="fas fa-clock"></i>
                                                            @else
                                                                <i class="fas fa-upload"></i>
                                                            @endif
                                                        </button>
                                                    @endif
                                                    @if ($proposal->status == 'konfirmasi')
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm btn-flat btn-block"
                                                            data-toggle="modal"
                                                            data-target="#modal-konfirmasi-{{ $proposal->id }}">
                                                            <i class="fas fa-upload"></i>
                                                        </button>
                                                    @endif
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
                                <strong>Jenis Penelitian</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $proposal->jenis_penelitian->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Jenis Pendanaan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $proposal->jenis_pendanaan->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Sumber Dana</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $proposal->dana_sumber }}
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
                                <strong>Berkas</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ asset('storage/uploads/' . $proposal->berkas) }}"
                                    class="btn btn-info btn-xs btn-flat" target="_blank">
                                    Lihat Berkas
                                </a>
                            </div>
                        </div>
                        @if (count($proposal->personels))
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Personel</strong>
                                    <small class="text-muted">(anggota)</small>
                                </div>
                                <div class="col-md-6">
                                    <ol class="px-3 mb-0">
                                        @foreach ($proposal->personels as $personel)
                                            <li>{{ $personel->user->nama }}</li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        @endif
                        @if ($proposal->laporan_id)
                            <hr class="my-2">
                            @if ($proposal->status == 'proses')
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Tanggal</strong>
                                    </div>
                                    <div class="col-md-6">
                                        {{ Carbon\Carbon::parse($proposal->tanggal)->translatedFormat('l, d F Y') }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Jam</strong>
                                    </div>
                                    <div class="col-md-6">
                                        {{ $proposal->jam }} WIB
                                    </div>
                                </div>
                            @endif
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Reviewer</strong>
                                </div>
                                <div class="col-md-6">
                                    {{ $proposal->peninjau->nama }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Jadwal</strong>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ url('dosen/proposal-laporan/' . $proposal->laporan_id) }}"
                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                        Lihat Jadwal
                                    </a>
                                </div>
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
        @if ($proposal->user_id == auth()->user()->id)
            @if ($proposal->status == 'menunggu')
                <div class="modal fade" id="modal-hapus-{{ $proposal->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h4 class="modal-title">Hapus Penelitian</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Yakin hapus Proposal Penelitian dengan judul <strong>{{ $proposal->judul }}</strong>?
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default btn-sm btn-flat"
                                    data-dismiss="modal">Tutup</button>
                                <form action="{{ url('dosen/proposal-penelitian/' . $proposal->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm btn-flat">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($proposal->status == 'revisi' || $proposal->status == 'revisi2')
                @php
                    $revisi = \App\Models\ProposalRevisi::where([['proposal_id', $proposal->id], ['status', true]])
                        ->orderByDesc('id')
                        ->first();
                    $proposal_revisis = \App\Models\ProposalRevisi::where([
                        ['proposal_id', $proposal->id],
                        ['status', false],
                    ])
                        ->orderByDesc('id')
                        ->get();
                @endphp
                <div class="modal fade" id="modal-revisi-{{ $proposal->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h4 class="modal-title">Revisi Proposal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('dosen/proposal-penelitian/perbaikan/' . $revisi->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    @if ($revisi->file)
                                        <div class="alert alert-light text-center rounded-0">
                                            <span class="text-muted">- Menunggu respon dari
                                                {{ $revisi->user_id == $proposal->peninjau_id ? 'Reviewer' : 'Administrator' }}
                                                -</span>
                                        </div>
                                    @endif
                                    <strong>
                                        Revisi
                                        {{ count($proposal_revisis) + 1 }}
                                        -
                                        {{ $revisi->user_id == $proposal->peninjau_id ? 'Reviewer' : 'Administrator' }}
                                    </strong>
                                    <br>
                                    <span>{{ $revisi->keterangan }}</span>
                                    @if ($revisi->file)
                                        <br>
                                        <a href="{{ asset('storage/uploads/' . $revisi->file) }}" target="_blank"
                                            class="btn btn-secondary btn-xs btn-flat">
                                            Lihat Laporan
                                        </a>
                                    @else
                                        <div class="form-group my-2">
                                            <label for="file">Upload File Laporan</label>
                                            <input type="file"
                                                class="form-control rounded-0 @if (session('id') == $revisi->id) @error('file') is-invalid @enderror @endif"
                                                id="file" name="file" accept=".pdf">
                                            @if (session('id') == $revisi->id)
                                                @error('file')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                @if (count($proposal_revisis))
                                    <div class="modal-body border-top">
                                        @if ($proposal->status == 'revisi2')
                                        @endif
                                        @foreach ($proposal_revisis as $key => $proposal_revisi)
                                            <div class="mb-2">
                                                <strong>
                                                    Revisi
                                                    {{ count($proposal_revisis) - $key }}
                                                    -
                                                    {{ $proposal_revisi->user_id == $proposal->peninjau_id ? 'Reviewer' : 'Administrator' }}
                                                </strong>
                                                <br>
                                                <span>{{ $proposal_revisi->keterangan }}</span>
                                                <br>
                                                @if ($proposal_revisi->file)
                                                    <a href="{{ asset('storage/uploads/' . $proposal_revisi->file) }}"
                                                        target="_blank" class="btn btn-secondary btn-xs btn-flat">
                                                        Lihat Laporan
                                                    </a>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
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
            @if ($proposal->status == 'konfirmasi')
                <div class="modal fade" id="modal-konfirmasi-{{ $proposal->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi Proposal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Yakin konfirmasi Proposal {{ ucfirst($proposal->jenis) }} dengan judul
                                <strong>{{ $proposal->judul }}</strong>?
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default btn-sm btn-flat"
                                    data-dismiss="modal">Tutup</button>
                                <form action="{{ url('dosen/proposal-penelitian/' . $proposal->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm btn-flat">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach
@endsection
