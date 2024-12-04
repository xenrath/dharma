@extends('statistik.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="mb-2">
                <h1>LPPM - Statistik <strong>{{ $prodi->nama }}</strong> SIDHARMA</h1>
                <span class="text-muted">
                    Halaman Informasi Statistik <strong>{{ $prodi->nama }}</strong> LPPM Universitas Bhamada Slawi
                </span>
            </div>
        </div>
        <div class="content pb-2">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="card-title">Kategori Data</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center align-top" style="width: 40px;">No.</th>
                                    <th class="align-top">Kategori</th>
                                    <th class="align-top" style="width: 400px;">Jumlah Total</th>
                                    <th class="align-top" style="width: 60px;">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Data Penelitian</td>
                                    <td>
                                        {{ $jumlah_penelitian }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/prodi/' . $prodi->id . '/penelitian') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Data Pengabdian</td>
                                    <td>
                                        {{ $jumlah_pengabdian }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/prodi/' . $prodi->id . '/pengabdian') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Publikasi Jurnal</td>
                                    <td>
                                        {{ $jumlah_jurnal }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/prodi/' . $prodi->id . '/jurnal') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Buku Ajar / Teks</td>
                                    <td>
                                        {{ $jumlah_buku }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/prodi/' . $prodi->id . '/buku') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>Pemakalah Forum Ilmiah</td>
                                    <td>
                                        {{ $jumlah_makalah }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/prodi/' . $prodi->id . '/makalah') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">6</td>
                                    <td>Hak Kekayaan Intelektual (HKI)</td>
                                    <td>
                                        {{ $jumlah_hki }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/prodi/' . $prodi->id . '/hki') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">7</td>
                                    <td>Luaran Lain</td>
                                    <td>
                                        {{ $jumlah_luaran }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/prodi/' . $prodi->id . '/luaran') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Dosen
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
                                    <th class="align-top" style="width: 200px;">Penelitian</th>
                                    <th class="align-top" style="width: 200px;">Pengabdian</th>
                                    <th class="align-top" style="width: 200px;">
                                        Publikasi
                                        <small class="text-muted" data-toggle="tooltip" data-placement="top"
                                            title="Jurnal, Buku Ajar, Makalah, HKI dan Luaran Lain"
                                            style="cursor: pointer;">
                                            <i class="fas fa-question-circle"></i>
                                        </small>
                                    </th>
                                    <th class="align-top" style="width: 60px;">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dosens as $dosen)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $dosen['nama'] }}</td>
                                        <td>{{ $dosen['penelitian'] }} data</td>
                                        <td>{{ $dosen['pengabdian'] }} data</td>
                                        <td>{{ $dosen['publikasi'] }} data</td>
                                        <td>
                                            <a href="{{ url('statistik/dosen/' . $dosen['id']) }}">
                                                <u>Lihat</u>
                                            </a>
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
    <!-- Chart JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    </script> --}}
@endsection
