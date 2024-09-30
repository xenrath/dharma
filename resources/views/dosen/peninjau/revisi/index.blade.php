@extends('layouts.app')

@section('title', 'Revisi Proposal')

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
                        <h1>Revisi Proposal</h1>
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
                        <h3 class="card-title mb-2">Data Proposal</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>Jadwal</th>
                                        <th>Proposal</th>
                                        <th class="text-center" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($proposals as $proposal)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                {{ Carbon\Carbon::parse($proposal->tanggal)->translatedFormat('l, d F Y') }}
                                                <br>
                                                {{ $proposal->jam }} WIB - Selesai
                                            </td>
                                            <td>
                                                {{ $proposal->user->nama }}
                                                <hr class="my-2">
                                                <strong>
                                                    {{ $proposal->jenis == 'penelitian' ? 'Penelitian' : 'Pengabdian' }}
                                                </strong>
                                                <br>
                                                {{ $proposal->judul }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $proposal->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-perbaikan-{{ $proposal->id }}">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-setuju-{{ $proposal->id }}">
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
                                <strong>Laporan Proposal</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ asset('storage/uploads/' . $proposal->berkas) }}"
                                    class="btn btn-info btn-xs btn-flat" target="_blank">
                                    Lihat Berkas
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
                        <hr class="my-2">
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
                        <hr class="my-2">
                        <div class="alert alert-light text-center rounded-0 mb-0">
                            <span class="text-muted">- Menunggu konfirmasi hasil revisi dari Anda -</span>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @php
            $revisi = \App\Models\ProposalRevisi::where([
                ['proposal_id', $proposal->id],
                ['user_id', auth()->user()->id],
                ['status', true],
            ])
                ->orderByDesc('id')
                ->first();
            $proposal_revisis = \App\Models\ProposalRevisi::where([
                ['proposal_id', $proposal->id],
                ['user_id', auth()->user()->id],
                ['status', false],
            ])
                ->orderByDesc('id')
                ->get();
        @endphp
        <div class="modal fade" id="modal-perbaikan-{{ $proposal->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Revisi Proposal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('dosen/peninjau/revisi/perbaikan/' . $proposal->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-2">
                                <strong>Revisi {{ count($proposal_revisis) + 1 }}</strong>
                                <br>
                                <span>{{ $revisi->keterangan }}</span>
                                <br>
                                @if ($revisi->file)
                                    <a href="{{ asset('storage/uploads/' . $revisi->file) }}" target="_blank"
                                        class="btn btn-secondary btn-xs btn-flat">
                                        Lihat Laporan
                                    </a>
                                    <div class="form-group my-2">
                                        <label for="keterangan">Keterangan Revisi</label>
                                        <textarea
                                            class="form-control rounded-0 @if (session('id') == $proposal->id) @error('keterangan') is-invalid @enderror @endif"
                                            name="keterangan" id="keterangan" cols="30" rows="4">{{ old('keterangan') }}</textarea>
                                        @if (session('id') == $proposal->id)
                                            @error('keterangan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @endif
                                    </div>
                                @else
                                    <button type="button" class="btn btn-default btn-xs btn-flat"
                                        style="pointer-events: none">File revisi belum diunggah</button>
                                @endif
                            </div>
                        </div>
                        @if (count($proposal_revisis))
                            <div class="modal-body border border-top">
                                @foreach ($proposal_revisis as $key => $proposal_revisi)
                                    <div class="mb-2">
                                        <strong>Revisi {{ count($proposal_revisis) - $key }}</strong>
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
                            @if ($revisi->file)
                                <button type="submit" class="btn btn-warning btn-sm btn-flat">Revisi</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-setuju-{{ $proposal->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Setujui Proposal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($revisi->file)
                            Yakin menyetujui <strong>Proposal
                                {{ $proposal->jenis == 'penelitian' ? 'Penelitian' : 'Pengabdian' }}</strong> dari
                            <strong>{{ $proposal->user->nama }}</strong>?
                        @else
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Menunggu dosen mengunggah file revisi -</span>
                            </div>
                        @endif
                    </div>
                    @if ($revisi->file)
                        <div class="modal-body border-top">
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
                        </div>
                    @endif
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                        <form action="{{ url('dosen/peninjau/revisi/setujui/' . $proposal->id) }}" method="POST">
                            @csrf
                            @if ($revisi->file)
                                <button type="submit" class="btn btn-primary btn-sm btn-flat">Setujui</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
