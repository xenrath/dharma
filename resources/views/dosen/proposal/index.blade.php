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
                                            <td class="text-center">{{ $proposals->firstItem() + $key }}</td>
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
                                                @if ($proposal->status == 'selesai')
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
                                                    @if (count($proposal->personels))
                                                        <ol class="px-3 mb-0">
                                                            @foreach ($proposal->personels as $personel)
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
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $proposal->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @if ($proposal->user_id == auth()->user()->id)
                                                    @if ($proposal->status == 'menunggu')
                                                        <a href="{{ url('dosen/proposal/' . $proposal->id . '/edit') }}"
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
                                                    @if ($proposal->status == 'revisi1' || $proposal->status == 'revisi2')
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
                                                @if ($proposal->status == 'pendanaan' || $proposal->status == 'selesai')
                                                    <button type="button" class="btn btn-warning btn-sm btn-flat btn-block"
                                                        data-toggle="modal"
                                                        data-target="#modal-revisi-list-{{ $proposal->id }}">
                                                        <i class="fas fa-clipboard-list"></i>
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
    <div class="modal fade" id="modal-buat">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Buat Proposal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('dosen/proposal') }}" method="POST">
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
                        @if ($proposal->status == 'selesai')
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
                                <a href="{{ asset('storage/uploads/' . $proposal->berkas) }}"
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
                                @if (count($proposal->personels))
                                    <ol class="px-3 mb-0">
                                        @foreach ($proposal->personels as $personel)
                                            <li>{{ $personel->user->nama }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        @if ($proposal->jadwal_id)
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
                                    <a href="{{ url('dosen/jadwal/' . $proposal->jadwal_id) }}"
                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                        Lihat Jadwal
                                    </a>
                                </div>
                            </div>
                            <hr class="my-2">
                            @if ($proposal->status == 'menunggu')
                                <div class="alert alert-light text-center rounded-0 mb-2">
                                    <span class="text-muted">- Menunggu operator menetapkan jadwal -</span>
                                </div>
                            @endif
                            @if ($proposal->status == 'proses')
                                <div class="alert alert-light text-center rounded-0 mb-2">
                                    <span class="text-muted">- Jadwal proposal telah ditetapkan -</span>
                                </div>
                            @endif
                            @if ($proposal->status == 'revisi1')
                                <div class="alert alert-light text-center rounded-0 mb-2">
                                    <span class="text-muted">- Proposal dalam tahap revisi oleh reviewer -</span>
                                </div>
                            @endif
                            @if ($proposal->status == 'setuju')
                                <div class="alert alert-light text-center rounded-0 mb-2">
                                    <span class="text-muted">- Proposal telah disetujui oleh reviewer -</span>
                                </div>
                            @endif
                            @if ($proposal->status == 'revisi2')
                                <div class="alert alert-light text-center rounded-0 mb-2">
                                    <span class="text-muted">- Proposal dalam tahap revisi oleh operator -</span>
                                </div>
                            @endif
                            @if ($proposal->status == 'pendanaan')
                                <div class="alert alert-light text-center rounded-0 mb-2">
                                    <span class="text-muted">- Menunggu Ka. LPPM mengonfirmasi pendanaan -</span>
                                </div>
                            @endif
                            @if ($proposal->status == 'selesai')
                                <div class="alert alert-light text-center rounded-0 mb-2">
                                    <span class="text-muted">- Proposal telah disetujui -</span>
                                </div>
                            @endif
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
                                <form action="{{ url('dosen/proposal/' . $proposal->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm btn-flat">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($proposal->status == 'revisi1' || $proposal->status == 'revisi2')
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
                            <form action="{{ url('dosen/proposal/perbaikan/' . $revisi->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    @if ($revisi->file)
                                        <div class="alert alert-light text-center rounded-0 mb-2">
                                            <span class="text-muted">- Menunggu respon dari
                                                {{ $revisi->user_id == $proposal->peninjau_id ? 'Reviewer' : 'Operator' }}
                                                -</span>
                                        </div>
                                    @endif
                                    <strong>
                                        Revisi
                                        {{ count($proposal_revisis) + 1 }}
                                        -
                                        {{ $revisi->user_id == $proposal->peninjau_id ? 'Reviewer' : 'Operator' }}
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
                                            <label for="file">Upload File Revisi</label>
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
        @endif
        @if ($proposal->status == 'pendanaan' || $proposal->status == 'selesai')
            <div class="modal fade" id="modal-revisi-list-{{ $proposal->id }}">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h4 class="modal-title">Revisi Proposal</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body border-top">
                            @if (count($proposal->proposal_revisis))
                                @foreach ($proposal->proposal_revisis as $key => $proposal_revisi)
                                    <div class="mb-2">
                                        <strong>
                                            Revisi
                                            {{ count($proposal->proposal_revisis) - $key }}
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
                            @else
                                <div class="alert alert-light text-center rounded-0 mb-2">
                                    <span>
                                        Proposal disetujui <strong>tanpa</strong> revisi
                                        <i class="far fa-thumbs-up"></i>
                                    </span>
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
        @endif
    @endforeach
@endsection
