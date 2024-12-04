@extends('statistik.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="mb-2">
                <h1>LPPM - Statistik Pengabdian <strong>{{ $prodi->nama }}</strong> SIDHARMA</h1>
                <span class="text-muted">
                    Halaman Informasi Statistik Pengabdian <strong>{{ $prodi->nama }}</strong> LPPM Universitas Bhamada
                    Slawi
                </span>
            </div>
        </div>
        <div class="content pb-2">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Pengabdian
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-2 justify-content-start">
                        <div class="col-md-3">
                            <form action="{{ url('statistik/prodi/' . $prodi->id . '/pengabdian') }}" method="get"
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
                                    <th class="text-center" style="width: 20px;">No</th>
                                    <th class="w-50">Judul</th>
                                    <th>Personel</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengabdians as $key => $pengabdian)
                                    <tr>
                                        <td class="text-center">{{ $pengabdians->firstItem() + $key }}</td>
                                        <td class="text-wrap">
                                            {{ $pengabdian->judul }}
                                            <br>
                                            <small class="text-muted">({{ $pengabdian->tahun }})</small>
                                        </td>
                                        <td>
                                            <strong>Ketua Peneliti:</strong>
                                            <br>
                                            {{ $pengabdian->user->nama }}
                                            <br>
                                            <strong>Anggota:</strong>
                                            <br>
                                            @if (count($pengabdian->personels))
                                                <ol class="px-3 mb-0">
                                                    @foreach ($pengabdian->personels as $personel)
                                                        <li>{{ $personel->user->nama }}</li>
                                                    @endforeach
                                                    @foreach ($pengabdian->mahasiswas as $nama => $prodi)
                                                        <li>
                                                            {{ $nama }}
                                                            @if ($prodi)
                                                                <br>
                                                                ({{ $prodi }})
                                                            @endif

                                                        </li>
                                                    @endforeach
                                                </ol>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <strong>Jenis Pengabdian:</strong>
                                            <br>
                                            {{ $pengabdian->jenis_pengabdian->nama }}
                                            <br>
                                            <strong>Jenis Pendanaan:</strong>
                                            <br>
                                            {{ $pengabdian->jenis_pendanaan->nama }}
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
                        @if ($pengabdians->total() > 10)
                            <div class="pagination float-md-right">
                                {{ $pengabdians->appends(Request::all())->links('pagination::bootstrap-4') }}
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
                                        Jumlah Pengabdian
                                        <small class="text-muted" data-toggle="tooltip" data-placement="top"
                                            title="jumlah dihitung dari pengabdian yang diikuti dosen"
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
            <div class="row">
                <div class="col-md-6">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Grafik Jenis Pengabdian
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
                                <canvas id="jenis-pengabdian"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Grafik Jenis Pendanaan
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
                                <canvas id="jenis-pendanaan"></canvas>
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
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const jenis_pengabdian = document.getElementById('jenis-pengabdian');
        new Chart(jenis_pengabdian, {
            type: 'pie',
            data: {
                labels: @json($jenis_pengabdian_label),
                datasets: [{
                    label: 'Jumlah',
                    data: @json($jenis_pengabdian_data),
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
        const jenis_pendanaan = document.getElementById('jenis-pendanaan');
        new Chart(jenis_pendanaan, {
            type: 'doughnut',
            data: {
                labels: @json($jenis_pendanaan_label),
                datasets: [{
                    label: 'Jumlah',
                    data: @json($jenis_pendanaan_data),
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
@endsection
