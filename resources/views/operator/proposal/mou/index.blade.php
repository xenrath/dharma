@extends('layouts.app')

@section('title', 'MOU Proposal')

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
                        <h1>MOU Proposal</h1>
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
                                        <th>Proposal</th>
                                        <th>Dana</th>
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
                                            </td>
                                            <td>
                                                <strong>Dana Disetujui</strong>
                                                <br>
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
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $proposal->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @php
                                                    $proposal_mou = \App\Models\ProposalMou::where(
                                                        'proposal_id',
                                                        $proposal->id,
                                                    )->exists();
                                                @endphp
                                                @if ($proposal_mou)
                                                    @if ($proposal->status == 'mou')
                                                        <button type="button"
                                                            class="btn btn-primary btn-sm btn-flat btn-block"
                                                            data-toggle="modal"
                                                            data-target="#modal-setuju-{{ $proposal->id }}">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button type="button"
                                                        class="btn btn-secondary btn-sm btn-flat btn-block"
                                                        data-toggle="modal" data-target="#modal-mou-{{ $proposal->id }}">
                                                        <i class="fas fa-file-signature"></i>
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
                        @if ($proposal->mou)
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>MOU Proposal</strong>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ asset('storage/uploads/' . $proposal->mou) }}"
                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                        Lihat MOU
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-body border-top">
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
                                <a href="{{ url('jadwal/' . $proposal->jadwal_id) }}"
                                    class="btn btn-info btn-xs btn-flat" target="_blank">
                                    Lihat Jadwal
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body border-top">
                        @if ($proposal->status == 'mou')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Menunggu Anda membuat MOU Proposal -</span>
                            </div>
                        @else
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Menunggu persetujuan dari Ka. LPPM -</span>
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
        <div class="modal fade" id="modal-mou-{{ $proposal->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">MOU Proposal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('operator/proposal-mou/' . $proposal->id) }}" method="POST"
                        autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            @if (!$proposal->user->nipy)
                                <div class="alert alert-light rounded-0 mb-2">
                                    <div class="mb-2">
                                        <span class="text-danger">
                                            <i class="fas fa-exclamation"></i>
                                            Dosen belum menambahkan NIPY
                                        </span>
                                        <br>
                                        <span class="text-muted">Hubungi Dosen untuk menambahkan di Menu Profile</span>
                                    </div>
                                    @if ($proposal->user->telp)
                                        <a href="{{ url('hubungi/' . $proposal->user->telp) }}"
                                            class="btn btn-success btn-sm btn-flat" style="text-decoration: none;"
                                            target="_blank">
                                            <i class="fab fa-whatsapp"></i>
                                            Hubungi
                                        </a>
                                    @endif
                                </div>
                            @else
                                <div class="form-group mb-2">
                                    <label for="nomor">Nomor Surat</label>
                                    <input type="text"
                                        class="form-control rounded-0 @if (session('id') == $proposal->id) @error('nomor') is-invalid @enderror @endif"
                                        id="nomor" name="nomor" value="{{ old('nomor') }}">
                                    @if (session('id') == $proposal->id)
                                        @error('nomor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                data-dismiss="modal">Tutup</button>
                            @if ($proposal->user->nipy)
                                <button type="submit" class="btn btn-primary btn-sm btn-flat">Buat MOU</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @php
            $proposal_mou = \App\Models\ProposalMou::where('proposal_id', $proposal->id)->first();
        @endphp
        @if ($proposal_mou)
            <div class="modal fade" id="modal-setuju-{{ $proposal->id }}">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h4 class="modal-title">Konfirmasi MOU</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Yakin konfirmasi Proposal MOU dari <strong>{{ $proposal->user->nama }}</strong>?
                        </div>
                        <div class="modal-body border-top">
                            <div class="mb-2">
                                <strong>File Draft</strong>
                                <br>
                                <a href="{{ asset('storage/uploads/' . $proposal_mou->draft) }}"
                                    class="btn btn-secondary btn-xs btn-flat" target="_blank">
                                    Lihat File
                                </a>
                            </div>
                            <div class="mb-2">
                                <strong>File Persetujuan MOU</strong>
                                <br>
                                @if ($proposal->mou)
                                    <a href="{{ asset('storage/uploads/' . $proposal->mou) }}"
                                        class="btn btn-secondary btn-xs btn-flat" target="_blank">
                                        Lihat File
                                    </a>
                                @else
                                    <button type="button" class="btn btn-default btn-xs btn-flat"
                                        style="pointer-events: none">File MOU belum diunggah</button>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm btn-flat"
                                data-dismiss="modal">Tutup</button>
                            @if ($proposal->mou)
                                <form action="{{ url('operator/proposal-mou/setujui/' . $proposal->id) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm btn-flat">Konfirmasi</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
