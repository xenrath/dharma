@extends('layouts.app')

@section('title', 'Proposal Penelitian')

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
                        <h1>Proposal Penelitian</h1>
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
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>Dosen</th>
                                        <th>Judul</th>
                                        <th class="text-center" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($proposals as $key => $proposal)
                                        <tr>
                                            <td class="text-center">{{ $proposals->firstItem() + $key }}</td>
                                            <td>{{ $proposal->user->nama }}</td>
                                            <td>{{ $proposal->judul }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $proposal->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-konfirmasi-{{ $proposal->id }}">
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
                        <h4 class="modal-title">Detail Penelitian</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Dosen</strong>
                                <span class="text-muted">(ketua)</span>
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
                        @if ($proposal->anggota_ids)
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Personel</strong>
                                    <span class="text-muted">(anggota)</span>
                                </div>
                                <div class="col-md-6">
                                    @php
                                        $anggotas = \App\Models\User::whereIn('id', $proposal->anggota_ids)
                                            ->select('nama', 'nidn')
                                            ->orderBy('nama')
                                            ->get();
                                    @endphp
                                    <ul class="px-3">
                                        @foreach ($anggotas as $anggota)
                                            <li>{{ $anggota->nama }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-konfirmasi-{{ $proposal->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi Proposal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('operator/proposal-penelitian/' . $proposal->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="tanggal">Tanggal</label>
                                <input type="date"
                                    class="form-control rounded-0 @if (session('id') == $proposal->id) @error('tanggal') is-invalid @enderror @endif"
                                    id="tanggal" name="tanggal" min="{{ date('Y-m-d') }}"
                                    value="{{ session('id') == $proposal->id ? old('tanggal') : '' }}">
                                @if (session('id') == $proposal->id)
                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group mb-2">
                                <label for="jam">Jam</label>
                                <input type="time"
                                    class="form-control rounded-0 @if (session('id') == $proposal->id) @error('jam') is-invalid @enderror @endif"
                                    id="jam" name="jam"
                                    value="{{ session('id') == $proposal->id ? old('jam') : '' }}">
                                @if (session('id') == $proposal->id)
                                    @error('jam')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group mb-2">
                                <label for="peninjau_id">Reviewer</label>
                                <select
                                    class="custom-select rounded-0 @if (session('id') == $proposal->id) @error('peninjau_id') is-invalid @enderror @endif"
                                    name="peninjau_id" id="peninjau_id">
                                    <option value="">- Pilih -</option>
                                    @foreach ($peninjaus as $peninjau)
                                        <option value="{{ $peninjau->id }}"
                                            {{ session('id') == $proposal->id ? (old('peninjau_id') == $peninjau->id ? 'selected' : '') : '' }}>
                                            {{ $peninjau->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @if (session('id') == $proposal->id)
                                    @error('peninjau_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-sm btn-flat">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
