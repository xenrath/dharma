@extends('layouts.app')

@section('title', 'Data Makalah Ilmiah')

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
                        <h1>Data Makalah Ilmiah</h1>
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
                        <h3 class="card-title">Data Makalah Ilmiah</h3>
                        <div class="text-right">
                            <a href="{{ url('dosen/makalah/create') }}" class="btn btn-primary btn-sm btn-flat">
                                Tambah Makalah
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
                                        <th>Judul Makalah</th>
                                        <th>Dosen</th>
                                        <th class="text-center" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($makalahs as $key => $makalah)
                                        <tr>
                                            <td class="text-center">{{ $makalahs->firstItem() + $key }}</td>
                                            <td>
                                                <strong>{{ $makalah->forum }}</strong>
                                                <br>
                                                {{ $makalah->judul }}
                                                <br>
                                                <small class="text-muted">({{ $makalah->tahun }})</small>
                                            </td>
                                            <td>
                                                <ol class="px-3 mb-0">
                                                    <li>{{ $makalah->user->nama }}</li>
                                                    @foreach ($makalah->makalah_personels as $personel)
                                                        <li>{{ $personel->user->nama }}</li>
                                                    @endforeach
                                                </ol>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $makalah->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                @if ($makalah->user_id == auth()->user()->id)
                                                    <a href="{{ url('dosen/makalah/' . $makalah->id . '/edit') }}"
                                                        class="btn btn-warning btn-sm btn-flat btn-block">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm btn-flat btn-block"
                                                        data-toggle="modal" data-target="#modal-hapus-{{ $makalah->id }}">
                                                        <i class="fas fa-trash"></i>
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
                                {{ $makalahs->appends(Request::all())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
    @foreach ($makalahs as $makalah)
        <div class="modal fade" id="modal-lihat-{{ $makalah->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Makalah Ilmiah</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Judul Makalah</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $makalah->judul }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Tingkat Publikasi</strong>
                            </div>
                            <div class="col-md-6">
                                {{ ucfirst($makalah->tingkat) }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Tahun Pelaksanaan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $makalah->tahun }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Nama Forum</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $makalah->forum }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Institusi Penyelenggara</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $makalah->institusi }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Tempat Pelaksanaan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $makalah->tempat }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Waktu Pelaksanaan</strong>
                            </div>
                            <div class="col-md-6">
                                @if ($makalah->tanggal_awal == $makalah->tanggal_akhir)
                                    {{ Carbon\Carbon::parse($makalah->tanggal_awal)->translatedFormat('d F Y') }}
                                @else
                                    <span>{{ Carbon\Carbon::parse($makalah->tanggal_awal)->translatedFormat('d F Y') }}</span>
                                    <span>-</span>
                                    <br>
                                    <span>{{ Carbon\Carbon::parse($makalah->tanggal_akhir)->translatedFormat('d F Y') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Status Pemakalah</strong>
                            </div>
                            <div class="col-md-6">
                                @if ($makalah->status == 'biasa')
                                    <span>Pemakalah Biasa</span>
                                @elseif ($makalah->status == 'spesial')
                                    <span>Invited / Keynote Speaker</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>File Makalah</strong>
                            </div>
                            <div class="col-md-6">
                                @if ($makalah->file)
                                    <a href="{{ asset('storage/uploads/' . $makalah->file) }}"
                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                        Lihat File
                                    </a>
                                @else
                                    <button type="button" class="btn btn-default btn-xs btn-flat"
                                        style="pointer-events: none">file makalah belum diunggah</button>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Penulis</strong>
                            </div>
                            <div class="col-md-6">
                                <ol class="px-3 mb-0">
                                    <li>{{ $makalah->user->nama }}</li>
                                    @foreach ($makalah->makalah_personels as $personel)
                                        <li>{{ $personel->user->nama }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-hapus-{{ $makalah->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Makalah Ilmiah</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin hapus makalah ilmiah dengan judul <strong>{{ $makalah->judul }}</strong>?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                        <form action="{{ url('dosen/makalah/' . $makalah->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm btn-flat">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
