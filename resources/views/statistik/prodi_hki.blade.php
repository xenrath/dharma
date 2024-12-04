@extends('statistik.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="mb-2">
                <h1>LPPM - Statistik HKI <strong>{{ $prodi->nama }}</strong> SIDHARMA</h1>
                <span class="text-muted">Halaman Informasi Statistik HKI <strong>{{ $prodi->nama }}</strong> LPPM
                    Universitas Bhamada
                    Slawi</span>
            </div>
        </div>
        <div class="content pb-2">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data HKI <strong>{{ $prodi->nama }}</strong>
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-2 justify-content-start">
                        <div class="col-md-3">
                            <form action="{{ url('statistik/prodi/' . $prodi->id . '/hki') }}" method="get"
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
                                    <th>Judul HKI</th>
                                    <th>Dosen</th>
                                    <th style="width: 300px">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($hkis as $key => $hki)
                                    <tr>
                                        <td class="text-center">{{ $hkis->firstItem() + $key }}</td>
                                        <td class="w-50">
                                            {{ $hki->judul }}
                                            <br>
                                            <small class="text-muted">({{ $hki->tahun }})</small>
                                        </td>
                                        <td>
                                            <ul class="px-3 mb-0">
                                                <li>{{ $hki->user->nama }}</li>
                                                @foreach ($hki->hki_personels as $personel)
                                                    <li>{{ $personel->user->nama }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td style="max-width: 300px;">
                                            <strong>Jenis HKI:</strong>
                                            <span>{{ ucfirst($hki->jenis_hki->nama) }}</span>
                                            <br>
                                            <strong>No. HKI:</strong>
                                            <span>{{ $hki->nomor }}</span>
                                            <br>
                                            <strong>No. Pendaftaran:</strong>
                                            <a
                                                href="https://pdki-indonesia.dgip.go.id/search?type=copyright&keyword={{ $hki->pendaftaran }}&page=1">
                                                <u>{{ $hki->pendaftaran }}</u>
                                            </a>
                                            <br>
                                            <strong>Status:</strong>
                                            <span>{{ ucfirst($hki->status) }}</span>
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
                        @if ($hkis->total() > 10)
                            <div class="pagination float-md-right">
                                {{ $hkis->appends(Request::all())->links('pagination::bootstrap-4') }}
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
                                        Jumlah HKI
                                        <small class="text-muted" data-toggle="tooltip" data-placement="top"
                                            title="jumlah dihitung dari HKI yang diikuti dosen" style="cursor: pointer;">
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
            <div class="row">
                <div class="col-md-6">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Grafik Jenis HKI
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
                                <canvas id="jenis-hki"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Grafik Status HKI
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
                                <canvas id="status-hki"></canvas>
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
        const jenis_hki = document.getElementById('jenis-hki');
        new Chart(jenis_hki, {
            type: 'pie',
            data: {
                labels: @json($jenis_hki_label),
                datasets: [{
                    label: 'Jumlah',
                    data: @json($jenis_hki_data),
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'right'
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
            },
        });
    </script>
    <script>
        const status_hki = document.getElementById('status-hki');
        new Chart(status_hki, {
            type: 'pie',
            data: {
                labels: @json($status_hki_label),
                datasets: [{
                    label: 'Jumlah',
                    data: @json($status_hki_data),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        });
    </script>
@endsection
