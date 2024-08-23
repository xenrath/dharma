@extends('layouts.app')

@section('title', 'Laporan Proposal')

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
                        <h1>Laporan Proposal</h1>
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
                        <form action="" method="get" autocomplete="off" id="form-submit">
                            <div class="row justify-content-end">
                                <div class="col-12 col-md-8 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend d-none d-md-inline">
                                            <span class="input-group-text rounded-0">Dari</span>
                                        </div>
                                        <input type="date" class="form-control rounded-0" id="dari" name="dari"
                                            value="{{ request()->get('dari') }}" oninput="sampai_set(this.value)">
                                        <div class="input-group-prepend d-none d-md-inline">
                                            <span class="input-group-text rounded-0">Sampai</span>
                                        </div>
                                        <input type="date" class="form-control rounded-0" id="sampai" name="sampai"
                                            value="{{ request()->get('sampai') }}" max="{{ date('Y-m-d') }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary btn-sm btn-flat" onclick="cari()">
                                                <i class="fas fa-search"></i>
                                                <span class="d-none d-md-inline">Cari</span>
                                            </button>
                                        </div>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary btn-sm btn-flat"
                                                onclick="print()">
                                                <i class="fas fa-print"></i>
                                                <span class="d-none d-md-inline">Print</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th style="width: 200px">Jadwal</th>
                                        <th>
                                            Dosen
                                            <small class="text-muted d-none d-md-inline">(ketua)</small>
                                        </th>
                                        <th class="text-center" style="width: 40px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($proposals as $key => $proposal)
                                        <tr>
                                            <td class="text-center">{{ $proposals->firstItem() + $key }}</td>
                                            <td>
                                                {{ ucfirst($proposal->jenis) }}
                                                <hr class="my-2">
                                                {{ Carbon\Carbon::parse($proposal->tanggal)->translatedFormat('l, d F Y') }}
                                                <br>
                                                {{ $proposal->jam }} WIB
                                            </td>
                                            <td>
                                                {{ $proposal->user->nama }}
                                                <hr class="my-2">
                                                {{ $proposal->judul }}
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info btn-sm btn-flat btn-block"
                                                    data-toggle="modal" data-target="#modal-lihat-{{ $proposal->id }}">
                                                    <i class="fas fa-eye"></i>
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
                                <strong>Jenis Proposal</strong>
                            </div>
                            <div class="col-md-6">
                                {{ ucfirst($proposal->jenis) }}
                            </div>
                        </div>
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
                        @if (count($proposal->personels))
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <strong>Personel</strong>
                                    <small class="text-muted">(anggota)</small>
                                </div>
                                <div class="col-md-6">
                                    <ul class="px-3">
                                        @foreach ($proposal->personels as $personel)
                                            <li>{{ $personel->user->nama }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <hr class="my-2">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <strong>Jadwal</strong>
                            </div>
                            <div class="col-md-6">
                                {{ Carbon\Carbon::parse($proposal->tanggal)->translatedFormat('l, d F Y') }}
                                <br>
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
        sampai_set();

        function sampai_set(dari) {
            if (dari) {
                $('#sampai').attr('disabled', false);
            } else {
                $('#sampai').attr('disabled', true);
                $('#sampai').val('');
            }
        }



        function cari() {
            $('#form-submit').attr('action', "{{ url('operator/proposal-laporan') }}");
            $('#form-submit').submit();
        }

        function print() {
            $('#form-submit').attr('action', "{{ url('operator/proposal-laporan/print') }}");
            $('#form-submit').submit();
        }
    </script>
@endsection
