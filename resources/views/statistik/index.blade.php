@extends('statistik.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="mb-2">
                <h1>LPPM - Statistik SIDHARMA LPPM</h1>
                <span class="text-muted">Halaman Informasi Statistik LPPM Universitas Bhamada Slawi</span>
            </div>
        </div>
        <div class="content pb-2">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Semua Data
                    </h3>
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
                                        {{ $penelitian }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/penelitian') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>Data Pengabdian</td>
                                    <td>
                                        {{ $pengabdian }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/pengabdian') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Publikasi Jurnal</td>
                                    <td>
                                        {{ $jurnal }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/jurnal') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td>Buku Ajar / Teks</td>
                                    <td>
                                        {{ $buku }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/buku') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td>Pemakalah Forum Ilmiah</td>
                                    <td>
                                        {{ $makalah }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/makalah') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">6</td>
                                    <td>Hak Kekayaan Intelektual (HKI)</td>
                                    <td>
                                        {{ $hki }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/hki') }}">
                                            <u>Lihat</u>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">7</td>
                                    <td>Luaran Lain</td>
                                    <td>
                                        {{ $luaran }} data
                                    </td>
                                    <td>
                                        <a href="{{ url('statistik/luaran') }}">
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
                        Berdasarkan Program Studi
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center align-top" style="width: 40px;">No.</th>
                                    <th class="align-top">Program Studi</th>
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
                                @forelse ($prodis as $prodi)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $prodi['nama'] }}</td>
                                        <td>{{ $prodi['penelitian'] }} data</td>
                                        <td>{{ $prodi['pengabdian'] }} data</td>
                                        <td>{{ $prodi['publikasi'] }} data</td>
                                        <td>
                                            <a href="{{ url('statistik/prodi/' . $prodi['id']) }}">
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
@endsection
