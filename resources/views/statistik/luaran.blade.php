@extends('statistik.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="mb-2">
                <h1>LPPM - Statistik Luaran Lainnya SIDHARMA</h1>
                <span class="text-muted">Halaman Informasi Statistik Luaran Lainnya LPPM Universitas Bhamada
                    Slawi</span>
            </div>
        </div>
        <div class="content pb-2">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Luaran Lainnya
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-2 justify-content-start">
                        <div class="col-md-3">
                            <form action="{{ url('statistik/luaran') }}" method="get" id="form-filter">
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
                                    <th>Judul Luaran</th>
                                    <th>Dosen</th>
                                    <th style="width: 300px">Forum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($luarans as $key => $luaran)
                                    <tr>
                                        <td class="text-center">{{ $luarans->firstItem() + $key }}</td>
                                        <td class="w-50">
                                            {{ $luaran->judul }}
                                            <br>
                                            <small class="text-muted">({{ $luaran->tahun }})</small>
                                        </td>
                                        <td>
                                            <ul class="px-3 mb-0">
                                                <li>{{ $luaran->user->nama }}</li>
                                                @foreach ($luaran->luaran_personels as $personel)
                                                    <li>{{ $personel->user->nama }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td style="max-width: 300px;">
                                            <strong>Tingkat:</strong>
                                            <span>{{ ucfirst($luaran->jenis) }}</span>
                                            <br>
                                            <strong>Nama Forum:</strong>
                                            <span>{{ $luaran->forum }}</span>
                                            <br>
                                            <strong>Institusi:</strong>
                                            <span>{{ $luaran->institusi }}</span>
                                            <br>
                                            <strong>Tempat:</strong>
                                            <span>{{ $luaran->tempat }}</span>
                                            <br>
                                            <strong>Waktu Pelaksanaan:</strong>
                                            <span>
                                                @if ($luaran->tanggal_awal == $luaran->tanggal_akhir)
                                                    {{ Carbon\Carbon::parse($luaran->tanggal_awal)->translatedFormat('d F Y') }}
                                                @else
                                                    <span>{{ Carbon\Carbon::parse($luaran->tanggal_awal)->translatedFormat('d F Y') }}</span>
                                                    <span>-</span>
                                                    <br>
                                                    <span>{{ Carbon\Carbon::parse($luaran->tanggal_akhir)->translatedFormat('d F Y') }}</span>
                                                @endif
                                            </span>
                                            <br>
                                            <strong>Status Peluaran:</strong>
                                            @if ($luaran->status == 'biasa')
                                                <span>Peluaran Biasa</span>
                                            @elseif ($luaran->status == 'spesial')
                                                <span>Invited / Keynote Speaker</span>
                                            @endif
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
                        @if ($luarans->total() > 10)
                            <div class="pagination float-md-right">
                                {{ $luarans->appends(Request::all())->links('pagination::bootstrap-4') }}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Berdasarkan Program Studi
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun
                                <strong>{{ request()->get('tahun') }})</strong>
                            </small>
                        @endif
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px;">No</th>
                                    <th>Program Studi</th>
                                    <th style="width: 180px;">Jumlah Jurnal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($prodis as $prodi)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $prodi['nama'] }}</td>
                                        <td>{{ $prodi['jumlah'] }} data</td>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Grafik Tingkat Publikasi
                                @if (request()->get('tahun'))
                                    <small class="text-muted">(tahun
                                        <strong>{{ request()->get('tahun') }})</strong>
                                    </small>
                                @endif
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div>
                                <canvas id="jenis-luaran"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Grafik Program Studi
                                @if (request()->get('tahun'))
                                    <small class="text-muted">(tahun
                                        <strong>{{ request()->get('tahun') }})</strong>
                                    </small>
                                @endif
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div>
                                <canvas id="prodi"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const jenis_luaran = document.getElementById('jenis-luaran');
        new Chart(jenis_luaran, {
            type: 'pie',
            data: {
                labels: @json($jenis_luaran_label),
                datasets: [{
                    label: 'Jumlah',
                    data: @json($jenis_luaran_data),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        });
    </script>
    <script>
        const prodi = document.getElementById('prodi');
        new Chart(prodi, {
            type: 'bar',
            data: {
                labels: @json($prodi_label),
                datasets: [{
                    label: 'Jumlah',
                    data: @json($prodi_data),
                    borderWidth: 1,
                }]
            },
            options: {
                indexAxis: 'y',
                maintainAspectRatio: false,
                responsive: true,
                aspectRatio: 0.5,
            },
        });
    </script>
@endsection
