@extends('statistik.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="mb-2">
                <h1>LPPM - Statistik Publikasi Jurnal <strong>{{ $prodi->nama }}</strong> SIDHARMA</h1>
                <span class="text-muted">
                    Halaman Informasi Statistik Publikasi Jurnal <strong>{{ $prodi->nama }}</strong> LPPM Universitas
                    Bhamada Slawi
                </span>
            </div>
        </div>
        <div class="content pb-2">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Publikasi Jurnal
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-2 justify-content-start">
                        <div class="col-md-3">
                            <form action="{{ url('statistik/prodi/' . $prodi->id . '/jurnal') }}" method="get"
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
                                    <th>Judul Jurnal</th>
                                    <th>Penulis</th>
                                    <th style="width: 300px">Publikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jurnals as $key => $jurnal)
                                    <tr>
                                        <td class="text-center">{{ $jurnals->firstItem() + $key }}</td>
                                        <td class="w-50">
                                            <strong>{{ $jurnal->nama }}</strong>
                                            <br>
                                            {{ $jurnal->judul }}
                                            <br>
                                            <small class="text-muted">({{ $jurnal->tahun }})</small>
                                        </td>
                                        <td>
                                            <ul class="px-3 mb-0">
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
                                            </ul>
                                        </td>
                                        <td style="max-width: 300px;">
                                            <strong>ISSN:</strong>
                                            <span>{{ $jurnal->issn }}</span>
                                            <br>
                                            <strong>Volume:</strong>
                                            <span>{{ $jurnal->volume }}</span>
                                            <br>
                                            <strong>Nomor:</strong>
                                            <span>{{ $jurnal->nomor }}</span>
                                            <br>
                                            <strong>Halaman:</strong>
                                            <span>{{ $jurnal->halaman_awal }} s/d {{ $jurnal->halaman_akhir }}</span>
                                            <br>
                                            <strong>URL:</strong>
                                            <a href="{{ $jurnal->url }}" style="word-wrap: break-word;"
                                                target="_blank">{{ $jurnal->url }}</a>
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
                        @if ($jurnals->total() > 10)
                            <div class="pagination float-md-right">
                                {{ $jurnals->appends(Request::all())->links('pagination::bootstrap-4') }}
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
                                        Jumlah Jurnal
                                        <small class="text-muted" data-toggle="tooltip" data-placement="top"
                                            title="jumlah dihitung dari jurnal yang diikuti dosen" style="cursor: pointer;">
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
                                Grafik Jenis Jurnal
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
                                <canvas id="jenis-jurnal"></canvas>
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
        const jenis_jurnal = document.getElementById('jenis-jurnal');
        new Chart(jenis_jurnal, {
            type: 'pie',
            data: {
                labels: @json($jenis_jurnal_label),
                datasets: [{
                    label: 'Jumlah',
                    data: @json($jenis_jurnal_data),
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
