@extends('statistik.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="mb-2">
                <h1>LPPM - Statistik Buku Ajar <strong>{{ $prodi->nama }}</strong> SIDHARMA</h1>
                <span class="text-muted">
                    Halaman Informasi Statistik Buku Ajar <strong>{{ $prodi->nama }}</strong> LPPM Universitas
                    Bhamada Slawi
                </span>
            </div>
        </div>
        <div class="content pb-2">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Buku Ajar
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-2 justify-content-start">
                        <div class="col-md-3">
                            <form action="{{ url('statistik/prodi/' . $prodi->id . '/buku') }}" method="get"
                                id="form-filter">
                                <select class="custom-select rounded-0" id="tahun" name="tahun"
                                    onchange="document.getElementById('form-filter').submit();">
                                    <option value="">Semua Tahun</option>
                                    @foreach ($tahuns as $tahun)
                                        <option value="{{ $tahun }}"
                                            {{ request()->get('tahun') == $tahun ? 'selected' : '' }}>
                                            {{ $tahun }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px">No</th>
                                    <th>Judul Buku</th>
                                    <th>Penulis</th>
                                    <th style="width: 300px">Penerbit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bukus as $key => $buku)
                                    <tr>
                                        <td class="text-center">{{ $bukus->firstItem() + $key }}</td>
                                        <td class="w-50">
                                            {{ $buku->judul }}
                                            <br>
                                            <small class="text-muted">({{ $buku->tahun }})</small>
                                        </td>
                                        <td>
                                            <ul class="px-3 mb-0">
                                                <li>{{ $buku->user->nama }}</li>
                                                @foreach ($buku->buku_personels as $personel)
                                                    <li>{{ $personel->user->nama }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <strong>ISBN:</strong>
                                            <span>{{ $buku->isbn }}</span>
                                            <br>
                                            <strong>Jumlah Halaman:</strong>
                                            <span>{{ $buku->jumlah }}</span>
                                            <br>
                                            <strong>Penerbit:</strong>
                                            <span>{{ $buku->penerbit }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <span class="text-muted">
                                                - Data tidak ditemukan -
                                            </span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if ($bukus->total() > 10)
                            <div class="pagination float-md-right">
                                {{ $bukus->appends(Request::all())->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Berdasarkan Dosen
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center align-top" style="width: 40px;">No.</th>
                                    <th class="align-top">Nama Dosen</th>
                                    <th class="align-top" style="width: 200px;">
                                        Jumlah Buku Ajar
                                        <small class="text-muted" data-toggle="tooltip" data-placement="top"
                                            title="jumlah dihitung dari buku ajar yang diikuti dosen"
                                            style="cursor: pointer;">
                                            <i class="fas fa-question-circle"></i>
                                        </small>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dosens as $dosen)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $dosen['nama'] }}</td>
                                        <td>{{ $dosen['jumlah'] }} data</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <span class="text-muted">
                                                - Data tidak ditemukan -
                                            </span>
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
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
