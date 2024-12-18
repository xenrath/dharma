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
                            <button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal"
                                data-target="#modal-buat">
                                Buat Proposal
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center align-top" style="width: 20px">No</th>
                                        <th class="align-top">Judul Proposal</th>
                                        <th class="align-top">Dosen / Personel</th>
                                        <th class="text-center align-top" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($proposals as $key => $proposal)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>
                                                    {{ $proposal->jenis == 'penelitian' ? 'Penelitian' : 'Pengabdian' }}
                                                </strong>
                                                <br>
                                                {{ $proposal->judul }}
                                                <br>
                                                @if ($proposal->jadwal_id && $proposal->status != 'selesai')
                                                    <hr class="my-2">
                                                    @if ($proposal->status == 'proses')
                                                        <strong>Jadwal:</strong>
                                                        <br>
                                                        {{ Carbon\Carbon::parse($proposal->tanggal)->translatedFormat('l, d F Y') }}
                                                        |
                                                        {{ $proposal->jam }} WIB
                                                        <br>
                                                    @endif
                                                    <strong>Reviewer:</strong>
                                                    <br>
                                                    {{ $proposal->peninjau->nama }}
                                                @endif
                                                @if ($proposal->status == 'mou' || $proposal->status == 'setuju2')
                                                    <hr class="my-2">
                                                    <strong>Dana Disetujui:</strong>
                                                    <br>
                                                    @rupiah($proposal->dana_setuju)
                                                @endif
                                            </td>
                                            <td>
                                                <div class="mb-2">
                                                    <strong>Ketua Peneliti:</strong>
                                                    <br>
                                                    {{ $proposal->user->nama }}
                                                    <br>
                                                    <strong>Anggota:</strong>
                                                    <br>
                                                    @if (count($proposal->personels) || count($proposal->mahasiswas))
                                                        <ol class="px-3 mb-0">
                                                            @foreach ($proposal->personels as $personel)
                                                                <li>{{ $personel->user->nama }}</li>
                                                            @endforeach
                                                            @foreach ($proposal->mahasiswas as $nama => $prodi)
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
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $proposal->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @if ($proposal->user_id == auth()->user()->id)
                                                    @if ($proposal->status == 'menunggu')
                                                        <a href="{{ url('dosen/proposal-list/' . $proposal->id . '/edit') }}"
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
                                                    @if ($proposal->status == 'revisi1')
                                                        @php
                                                            $revisi = \App\Models\ProposalRevisi::where([
                                                                ['proposal_id', $proposal->id],
                                                                ['status', 'revisi1'],
                                                                ['is_aktif', true],
                                                            ])
                                                                ->orderByDesc('id')
                                                                ->first();
                                                        @endphp
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm btn-flat btn-block"
                                                            data-toggle="modal"
                                                            data-target="#modal-revisi1-{{ $proposal->id }}">
                                                            @if ($revisi->file)
                                                                <i class="fas fa-clock"></i>
                                                            @else
                                                                <i class="fas fa-upload"></i>
                                                            @endif
                                                        </button>
                                                    @endif
                                                    @if ($proposal->status == 'revisi2')
                                                        @php
                                                            $revisi = \App\Models\ProposalRevisi::where([
                                                                ['proposal_id', $proposal->id],
                                                                ['status', 'revisi2'],
                                                                ['is_aktif', true],
                                                            ])
                                                                ->orderByDesc('id')
                                                                ->first();
                                                        @endphp
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm btn-flat btn-block"
                                                            data-toggle="modal"
                                                            data-target="#modal-revisi2-{{ $proposal->id }}">
                                                            @if ($revisi->file)
                                                                <i class="fas fa-clock"></i>
                                                            @else
                                                                <i class="fas fa-upload"></i>
                                                            @endif
                                                        </button>
                                                    @endif
                                                    @if ($proposal->status == 'mou' || $proposal->status == 'setuju2')
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm btn-flat btn-block"
                                                            data-toggle="modal"
                                                            data-target="#modal-mou-{{ $proposal->id }}">
                                                            @if ($proposal->mou)
                                                                <i class="fas fa-clock"></i>
                                                            @else
                                                                <i class="fas fa-upload"></i>
                                                            @endif
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
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
    <div class="modal fade" id="modal-buat">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Buat Proposal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('dosen/proposal-list') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="jenis">Jenis Proposal</label>
                            <select class="custom-select rounded-0 @error('jenis') is-invalid @enderror" name="jenis"
                                id="jenis">
                                <option value="">- Pilih -</option>
                                <option value="penelitian">Proposal Penelitian</option>
                                <option value="pengabdian">Proposal Pengabdian</option>
                            </select>
                            @if (!session('id'))
                                @error('jenis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm btn-flat">Selanjutnya</button>
                    </div>
                </form>
            </div>
        </div>
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
                                <strong>Jenis Pendanaan</strong>
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
                        @if ($proposal->status == 'mou' || $proposal->status == 'selesai')
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Dana Disetujui</strong>
                                </div>
                                <div class="col-md-6">
                                    @rupiah($proposal->dana_setuju)
                                    @if ($proposal->status == 'pendanaan')
                                        <span class="badge badge-warning rounded-circle p-1">
                                            <i class="far fa-clock"></i>
                                        </span>
                                    @else
                                        <span class="badge badge-primary rounded-circle p-1">
                                            <i class="far fa-check-circle"></i>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Laporan Proposal</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ asset('storage/uploads/' . $proposal->file) }}"
                                    class="btn btn-info btn-xs btn-flat" target="_blank">
                                    Lihat Laporan
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
                    @if ($proposal->jadwal_id)
                        <div class="modal-body border-top">
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
                                    <a href="{{ url('jadwal/' . $proposal->jadwal->kode) }}"
                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                        Lihat Jadwal
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
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
                                <h4 class="modal-title">Hapus Proposal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Yakin hapus <strong>Proposal
                                    {{ $proposal->jenis == 'penelitian' ? 'Penelitian' : 'Pengabdian' }}</strong> dengan
                                judul
                                <strong>{{ $proposal->judul }}</strong>?
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default btn-sm btn-flat"
                                    data-dismiss="modal">Batal</button>
                                <form action="{{ url('dosen/proposal-list/' . $proposal->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm btn-flat">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($proposal->status == 'revisi1')
                @php
                    $revisi = \App\Models\ProposalRevisi::where([
                        ['proposal_id', $proposal->id],
                        ['status', 'revisi1'],
                        ['is_aktif', true],
                    ])
                        ->orderByDesc('id')
                        ->first();
                    $proposal_revisis = \App\Models\ProposalRevisi::where([
                        ['proposal_id', $proposal->id],
                        ['status', 'revisi1'],
                        ['is_aktif', false],
                    ])
                        ->orderByDesc('id')
                        ->get();
                @endphp
                <div class="modal fade" id="modal-revisi1-{{ $proposal->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h4 class="modal-title">Revisi Proposal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('dosen/proposal-list/perbaikan/' . $revisi->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    @if ($revisi->file)
                                        <div class="alert alert-light text-center rounded-0 mb-2">
                                            <span class="text-muted">- Menunggu respon dari Reviewer -</span>
                                        </div>
                                    @endif
                                    <div>
                                        <strong>
                                            Revisi
                                            {{ count($proposal_revisis) + 1 }}
                                            -
                                            {{ $revisi->user_id == $proposal->peninjau_id ? 'Reviewer' : 'Operator' }}
                                        </strong>
                                        <br>
                                        <span>{{ $revisi->keterangan }}</span>
                                    </div>
                                    @if ($revisi->file)
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/uploads/' . $revisi->file) }}" target="_blank"
                                                class="btn btn-secondary btn-xs btn-flat">
                                                Lihat Laporan
                                            </a>
                                        </div>
                                    @else
                                        <div class="form-group my-2">
                                            <label for="file">File Revisi</label>
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
                                        @foreach ($proposal_revisis as $key => $proposal_revisi)
                                            <div class="mb-2">
                                                <strong>
                                                    Revisi {{ count($proposal_revisis) - $key }} - Reviewer
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
            @if ($proposal->status == 'revisi2')
                @php
                    $revisi = \App\Models\ProposalRevisi::where([
                        ['proposal_id', $proposal->id],
                        ['status', 'revisi2'],
                        ['is_aktif', true],
                    ])
                        ->orderByDesc('id')
                        ->first();
                    $proposal_revisis = \App\Models\ProposalRevisi::where([
                        ['proposal_id', $proposal->id],
                        ['status', 'revisi2'],
                        ['is_aktif', false],
                    ])
                        ->orderByDesc('id')
                        ->get();
                @endphp
                <div class="modal fade" id="modal-revisi2-{{ $proposal->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h4 class="modal-title">Revisi Proposal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('dosen/proposal-list/perbaikan/' . $revisi->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    @if ($revisi->file)
                                        <div class="alert alert-light text-center rounded-0 mb-2">
                                            <span class="text-muted">- Menunggu respon dari Operator -</span>
                                        </div>
                                    @endif
                                    <strong>
                                        Revisi {{ count($proposal_revisis) + 1 }} - Operator
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
                                            <label for="file">File Revisi</label>
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
                                        @foreach ($proposal_revisis as $key => $proposal_revisi)
                                            <div class="mb-2">
                                                <strong>
                                                    Revisi
                                                    {{ count($proposal_revisis) - $key }}
                                                    -
                                                    {{ $proposal_revisi->user_id == $proposal->peninjau_id ? 'Reviewer' : 'Operator' }}
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
            @if ($proposal->status == 'mou' || $proposal->status == 'setuju2')
                @php
                    $proposal_mou = \App\Models\ProposalMou::where('proposal_id', $proposal->id)->first();
                @endphp
                <div class="modal fade" id="modal-mou-{{ $proposal->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-0">
                            <div class="modal-header">
                                <h4 class="modal-title">MOU Proposal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ url('dosen/proposal-list/mou/' . $proposal->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    @if ($proposal->mou)
                                        <div class="alert alert-light text-center rounded-0 mb-2">
                                            <span class="text-muted">- Menunggu persetujuan MOU -</span>
                                        </div>
                                    @endif
                                    <div class="form-group mb-2">
                                        <strong>File Persetujuan MOU</strong>
                                        @if ($proposal->mou)
                                            <div>
                                                <a href="{{ asset('storage/uploads/' . $proposal->mou) }}"
                                                    class="btn btn-secondary btn-xs btn-flat" target="_blank">
                                                    Lihat File
                                                </a>
                                            </div>
                                        @else
                                            <div class="mt-2">
                                                <input type="file"
                                                    class="form-control rounded-0 @if (session('id') == $proposal->id) @error('file') is-invalid @enderror @endif"
                                                    id="file" name="file" accept=".pdf">
                                                @if (session('id') == $proposal->id)
                                                    @error('file')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-body border-top">
                                    <div class="mb-2">
                                        <strong>File Draft MOU</strong>
                                        <br>
                                        <a href="{{ asset('storage/uploads/' . $proposal_mou->draft) }}"
                                            class="btn btn-secondary btn-xs btn-flat" target="_blank">
                                            Lihat Draft
                                        </a>
                                    </div>
                                    <div id="accordion">
                                        <div class="card rounded-0">
                                            <div class="card-header">
                                                <h4 class="card-title w-100" style="font-size: 16px;">
                                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                        Cara melakukan persetujuan MOU Proposal
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <span>
                                                        Beberapa tahapan untuk melakukan persetujuan MOU Proposal:
                                                    </span>
                                                    <ol class="px-3 mb-2">
                                                        <li>Unduh <u>File Draft MOU</u> terlebih dahulu</li>
                                                        <li>
                                                            Print halaman terakhir dari File Draft (yang terdapat tanda
                                                            tangan Ka.
                                                            LPPM dan Dosen)
                                                        </li>
                                                        <li>
                                                            Lakukan persetujuan dengan memberikan materai pada berkas
                                                            serta
                                                            tanda tangan
                                                        </li>
                                                        <li>
                                                            Scan satu lembar file draft tersebut dan jadikan format .pdf
                                                        </li>
                                                        <li>
                                                            Unggah file di kolom <u>File Persetujuan MOU</u>
                                                        </li>
                                                        <li>
                                                            Tekan tombol <u>Kirim</u> dan tunggu konfirmasi Ka. LPPM
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default btn-sm btn-flat"
                                        data-dismiss="modal">Tutup</button>
                                    @if (!$proposal->mou)
                                        <button type="submit" class="btn btn-primary btn-sm btn-flat">Kirim</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach
@endsection
