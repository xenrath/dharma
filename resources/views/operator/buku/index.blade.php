@extends('layouts.app')

@section('title', 'Data Buku Ajar')

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
                        <h1>Data Buku Ajar</h1>
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
                        <h3 class="card-title">Data Buku Ajar</h3>
                        <div class="text-right">
                            <a href="{{ url('operator/buku/create') }}" class="btn btn-primary btn-sm btn-flat">
                                Tambah Buku
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-2 justify-content-between">
                            <div class="col-md-3"></div>
                            <div class="col-md-4">
                                <form action="{{ url('operator/buku') }}" id="form-search" method="GET">
                                    <div class="form-group mb-2">
                                        <div class="input-group">
                                            <input type="search" class="form-control rounded-0" id="keyword"
                                                name="keyword" placeholder="cari nama / judul" autocomplete="off"
                                                value="{{ request()->get('keyword') }}">
                                            <div class="input-group-append rounded-0">
                                                <button type="submit" class="btn btn-default btn-flat" onclick="search()">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>Penulis</th>
                                        <th>Judul Buku</th>
                                        <th class="text-center" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bukus as $key => $buku)
                                        <tr>
                                            <td class="text-center">{{ $bukus->firstItem() + $key }}</td>
                                            <td>
                                                <ul class="px-3 mb-0">
                                                    <li>{{ $buku->user->nama }}</li>
                                                    @foreach ($buku->buku_personels as $personel)
                                                        <li>{{ $personel->user->nama }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                {{ $buku->judul }}
                                                <br>
                                                <small class="text-muted">({{ $buku->tahun }})</small>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $buku->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ url('operator/buku/' . $buku->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm btn-flat btn-block">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-hapus-{{ $buku->id }}">
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
                            @if ($bukus->total() > 10)
                                <div class="pagination float-right">
                                    {{ $bukus->appends(Request::all())->links('pagination::bootstrap-4') }}
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
    @foreach ($bukus as $buku)
        <div class="modal fade" id="modal-lihat-{{ $buku->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Buku Ajar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Judul Buku</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $buku->judul }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Tahun Penerbitan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $buku->tahun }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>ISBN</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $buku->isbn }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Jumlah Halaman</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $buku->jumlah }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Penerbit</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $buku->penerbit }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>File Buku</strong>
                            </div>
                            <div class="col-md-6">
                                @if ($buku->file)
                                    <a href="{{ asset('storage/uploads/' . $buku->file) }}"
                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                        Lihat File
                                    </a>
                                @else
                                    <button type="button" class="btn btn-default btn-xs btn-flat"
                                        style="pointer-events: none">File buku belum diunggah</button>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Penulis</strong>
                            </div>
                            <div class="col-md-6">
                                <ul class="px-3 mb-0">
                                    <li>{{ $buku->user->nama }}</li>
                                    @foreach ($buku->buku_personels as $personel)
                                        <li>{{ $personel->user->nama }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-hapus-{{ $buku->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Buku Ajar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin hapus buku ajar dari <strong>{{ $buku->user->nama }}</strong>?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
                        <form action="{{ url('operator/buku/' . $buku->id) }}" method="POST">
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

@section('script')
    <script>
        $('#keyword').on('search', function() {
            search();
        });

        function search() {
            $('#form-search').submit();
        }
    </script>
@endsection