<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Statistik SIDHARMA</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>

<body class="hold-transition layout-top-nav">
    @include('sweetalert::alert')
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="mb-2">
                        <h1>LPPM - Statistik Penelitian SIDHARMA</h1>
                        <span class="text-muted">Halaman Informasi Statistik Penelitian LPPM Universitas Bhamada
                            SLawi</span>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Data Penelitian
                                <small class="text-muted">(Semua)</small>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row justify-content-end">
                                <div class="col-md-4">
                                    <form action="{{ url('peminjaman-cbt') }}" method="get">
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control rounded-0" name="tanggal"
                                                min="{{ date('Y-m-d') }}"
                                                value="{{ request()->get('tanggal') ?? date('Y-m-d') }}">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary btn-flat">Cari</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 20px;">No</th>
                                            <th>Judul</th>
                                            <th>Personel</th>
                                            <th style="width: 160px;">Jenis Penelitian</th>
                                            <th style="width: 160px;">Jenis Pendanaan</th>
                                            <th style="width: 60px;">Tahun</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($penelitians as $penelitian)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-wrap">
                                                    <strong>{{ $penelitian->judul }}</strong>
                                                </td>
                                                <td>
                                                    <strong>Ketua Peneliti:</strong>
                                                    <br>
                                                    {{ $penelitian->user->nama }}
                                                    <br>
                                                    <strong>Anggota:</strong>
                                                    <br>
                                                    @if (count($penelitian->personels))
                                                        <ol class="px-3 mb-0">
                                                            @foreach ($penelitian->personels as $personel)
                                                                <li>{{ $personel->user->nama }}</li>
                                                            @endforeach
                                                            @foreach ($penelitian->mahasiswas as $nama => $prodi)
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
                                                    {{ $penelitian->jenis_penelitian->nama }}
                                                </td>
                                                <td>
                                                    {{ $penelitian->jenis_pendanaan->nama }}
                                                </td>
                                                <td>
                                                    {{ $penelitian->tahun }}
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
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Data Penelitian
                                <small class="text-muted">(Program Studi)</small>
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
                                            <th style="width: 160px;">Jumlah Penelitian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($prodis as $prodi)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $prodi->nama }}</td>
                                                <td>12 data</td>
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
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Data Penelitian
                                <small class="text-muted">(Grafik)</small>
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
                                            <th style="width: 160px;">Jumlah Penelitian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($prodis as $prodi)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $prodi->nama }}</td>
                                                <td>12 data</td>
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
        </div>
        <footer class="main-footer">
            <strong>Copyright &copy; 2023, Designed &amp; Developed by <a href="">IT Bhamada</a></strong>
        </footer>
    </div>
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
</body>

</html>
