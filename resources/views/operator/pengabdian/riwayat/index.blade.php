@extends('layouts.app')

@section('title', 'Arsip Pengabdian')

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
                        <h1>Arsip Pengabdian</h1>
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
                        <h3 class="card-title">Arsip Pengabdian</h3>
                        <a href="{{ url('operator/pengabdian-riwayat/create') }}"
                            class="btn btn-primary btn-sm btn-flat float-right">
                            Buat Pengabdian
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-2 justify-content-between">
                            <div class="col-md-3">

                            </div>
                            <div class="col-md-4">
                                <form action="{{ url('operator/pengabdian-riwayat') }}" id="form-search" method="GET">
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
                            <table class="table table-bordered table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center align-top" style="width: 20px">No</th>
                                        <th class="align-top">Dosen / Personel</th>
                                        <th class="align-top">Judul Pengabdian</th>
                                        <th class="text-center align-top" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pengabdians as $key => $pengabdian)
                                        <tr>
                                            <td class="text-center">{{ $pengabdians->firstItem() + $key }}</td>
                                            <td>
                                                <div class="mb-2">
                                                    <strong>Ketua Peneliti:</strong>
                                                    <br>
                                                    {{ $pengabdian->user->nama }}
                                                    <br>
                                                    <strong>Anggota:</strong>
                                                    <br>
                                                    @if (count($pengabdian->personels) || count($pengabdian->mahasiswas))
                                                        <ol class="px-3 mb-0">
                                                            @foreach ($pengabdian->personels as $personel)
                                                                <li>{{ $personel->user->nama }}</li>
                                                            @endforeach
                                                            @foreach ($pengabdian->mahasiswas as $nama => $prodi)
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
                                            <td>
                                                {{ $pengabdian->judul }}
                                                <br>
                                                <small class="text-muted">({{ $pengabdian->tahun }})</small>
                                                <hr class="my-2">
                                                @rupiah($pengabdian->dana_setuju)
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $pengabdian->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ url('operator/pengabdian-riwayat/' . $pengabdian->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm btn-flat btn-block">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-hapus-{{ $pengabdian->id }}">
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
                            @if ($pengabdians->total() > 10)
                                <div class="pagination float-right">
                                    {{ $pengabdians->appends(Request::all())->links('pagination::bootstrap-4') }}
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
    @foreach ($pengabdians as $pengabdian)
        <div class="modal fade" id="modal-lihat-{{ $pengabdian->id }}">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Pengabdian</h4>
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
                                {{ $pengabdian->user->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Tahun Kegiatan</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengabdian->tahun }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Judul Pengabdian</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengabdian->judul }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Jenis Pengabdian</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengabdian->jenis_pengabdian->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Sumber Dana</strong>
                            </div>
                            <div class="col-md-6">
                                {{ $pengabdian->jenis_pendanaan->nama }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Dana Disetujui</strong>
                            </div>
                            <div class="col-md-6">
                                @rupiah($pengabdian->dana_setuju)
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Laporan Pengabdian</strong>
                            </div>
                            <div class="col-md-6">
                                @if ($pengabdian->file)
                                    <a href="{{ asset('storage/uploads/' . $pengabdian->file) }}"
                                        class="btn btn-info btn-xs btn-flat" target="_blank">
                                        Lihat Laporan
                                    </a>
                                @else
                                    <button type="button" class="btn btn-default btn-xs btn-flat"
                                        style="pointer-events: none">File laporan belum diunggah</button>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Personel</strong>
                                <small class="text-muted">(anggota)</small>
                            </div>
                            <div class="col-md-6">
                                @if (count($pengabdian->personels) || count($pengabdian->mahasiswas))
                                    <ol class="px-3 mb-0">
                                        @foreach ($pengabdian->personels as $personel)
                                            <li>{{ $personel->user->nama }}</li>
                                        @endforeach
                                        @foreach ($pengabdian->mahasiswas as $nama => $prodi)
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
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat"
                            data-dismiss="modal">Tutup</button>
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
