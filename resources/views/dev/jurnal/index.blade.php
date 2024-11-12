@extends('layouts.app')

@section('title', 'Data Jurnal')

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
                        <h1>Data Jurnal</h1>
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
                        <h3 class="card-title">Data Jurnal</h3>
                        <div class="text-right">
                            <a href="{{ url('dev/jurnal/create') }}" class="btn btn-primary btn-sm btn-flat">
                                Buat Jurnal
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
                                        <th>Judul Jurnal</th>
                                        <th>Penulis</th>
                                        <th class="text-center" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jurnals as $key => $jurnal)
                                        <tr>
                                            <td class="text-center">{{ $jurnals->firstItem() + $key }}</td>
                                            <td>{{ $jurnal->judul }}</td>
                                            <td>
                                                <ol class="px-3 mb-0">
                                                    <li>{{ $jurnal->user->nama }}</li>
                                                    @foreach ($jurnal->jurnal_personels as $personel)
                                                        <li>{{ $personel->user->nama }}</li>
                                                    @endforeach
                                                    @foreach ($jurnal->mahasiswas as $nama => $prodi)
                                                        <li>
                                                            {{ $nama }}
                                                            @if ($prodi)
                                                                ({{ $prodi }})
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $jurnal->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ url('dev/jurnal/' . $jurnal->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm btn-flat btn-block">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-hapus-{{ $jurnal->id }}">
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
                                {{ $jurnals->appends(Request::all())->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
    @foreach ($jurnals as $jurnal)
        <div class="modal fade" id="modal-lihat-{{ $jurnal->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Jurnal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Nama Jurnal</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $jurnal->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Judul Jurnal</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $jurnal->judul }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Tahun Publikasi</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $jurnal->tahun }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>ISSN</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $jurnal->issn }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Volume</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $jurnal->volume }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Nomor</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $jurnal->nomor }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Halaman</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $jurnal->halaman_awal }} s/d {{ $jurnal->halaman_akhir }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>URL</strong>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ asset('storage/uploads/' . $jurnal->file) }}"
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
                                <ol class="px-3 mb-0">
                                    <li>{{ $jurnal->user->nama }}</li>
                                    @foreach ($jurnal->jurnal_personels as $personel)
                                        <li>{{ $personel->user->nama }}</li>
                                    @endforeach
                                    @foreach ($jurnal->mahasiswas as $nama => $prodi)
                                        <li>
                                            {{ $nama }}
                                            @if ($prodi)
                                                ({{ $prodi }})
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body border-top">
                        @if ($jurnal->status == 'menunggu')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Menunggu respon dari Operator -</span>
                            </div>
                        @endif
                        @if ($jurnal->status == 'revisi')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Jurnal sedang dalam tahap revisi -</span>
                            </div>
                        @endif
                        @if ($jurnal->status == 'selesai')
                            <div class="alert alert-light text-center rounded-0 mb-2">
                                <span class="text-muted">- Penelitian telah disetujui -</span>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
