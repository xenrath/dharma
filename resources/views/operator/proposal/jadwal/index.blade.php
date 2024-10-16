@extends('layouts.app')

@section('title', 'Penjadwalan Proposal')

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
                        <h1>Penjadwalan Proposal</h1>
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
                        <div class="float-right">
                            <a href="{{ url('operator/proposal-jadwal/menunggu') }}"
                                class="btn btn-warning btn-sm btn-flat">
                                Proposal Menunggu
                                @if ($proposal_menunggu)
                                    <span class="badge badge-info rounded-0">{{ $proposal_menunggu }}</span>
                                @endif
                            </a>
                            <a href="{{ url('operator/proposal-jadwal/create') }}"
                                class="btn btn-primary btn-sm btn-flat">Buat
                                Laporan</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>Nomor Surat</th>
                                        <th class="text-center" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jadwals as $key => $jadwal)
                                        <tr>
                                            <td class="text-center">{{ $jadwals->firstItem() + $key }}</td>
                                            <td>
                                                <div class="mb-2">
                                                    {{ $jadwal->nomor }}
                                                    <br>
                                                    <small>
                                                        {{ Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d F Y') }}
                                                    </small>
                                                    <br>
                                                </div>
                                                <button type="button" class="btn btn-primary btn-sm btn-flat"
                                                    data-toggle="modal" data-target="#modal-kirim-{{ $jadwal->id }}">
                                                    Kirim
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('jadwal/' . $jadwal->id) }}" target="_blank"
                                                    class="btn btn-info btn-sm btn-flat btn-block">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                                {{-- <a href="{{ url('operator/proposal-jadwal/' . $jadwal->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm btn-flat btn-block">
                                                    <i class="fas fa-pen"></i>
                                                </a> --}}
                                                <button type="button" class="btn btn-danger btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-hapus-{{ $jadwal->id }}">
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
                            @if ($jadwals->total() > 10)
                                <div class="pagination pagination-sm float-right">
                                    {{ $jadwals->appends(Request::all())->links('pagination::bootstrap-4') }}
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
    @foreach ($jadwals as $jadwal)
        <div class="modal fade" id="modal-kirim-{{ $jadwal->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Kirim Laporan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @php
                            $user_id = \App\Models\Proposal::where('jadwal_id', $jadwal->id)->pluck('user_id');
                            $users = \App\Models\User::whereIn('id', $user_id)->select('nama', 'telp')->get();
                            $peninjau_id = \App\Models\Proposal::where('jadwal_id', $jadwal->id)->pluck('peninjau_id');
                            $peninjaus = \App\Models\User::whereIn('id', $peninjau_id)->select('nama', 'telp')->get();
                        @endphp
                        Kirim pemberitahuan Penjadwal Proposal
                        <hr class="my-2">
                        <strong>Dosen Penerima:</strong>
                        <ol class="px-3 mb-0">
                            @foreach ($users as $user)
                                <li>
                                    @if ($user->telp)
                                        {{ $user->nama }}
                                    @else
                                        <del>{{ $user->nama }}</del>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                        <strong>Reviewer Penerima:</strong>
                        <ol class="px-3 mb-0">
                            @foreach ($peninjaus as $peninjau)
                                <li>
                                    @if ($peninjau->telp)
                                        {{ $peninjau->nama }}
                                    @else
                                        <del>{{ $peninjau->nama }}</del>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                        <form action="{{ url('operator/proposal-jadwal/notif/' . $jadwal->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm btn-flat btn-block">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-hapus-{{ $jadwal->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Laporan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin hapus jadwal proposal dengan nomor surat <strong>{{ $jadwal->nomor }}</strong>?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                        <form action="{{ url('operator/proposal-jadwal/' . $jadwal->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm btn-flat btn-block">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
