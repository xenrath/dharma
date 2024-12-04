@extends('statistik.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="mb-2">
                <h1>LPPM - Statistik Dosen SIDHARMA</h1>
                <span class="text-muted">
                    Halaman Informasi Statistik Dosen LPPM Universitas Bhamada Slawi
                </span>
            </div>
        </div>
        <div class="content pb-2">
            <div class="card rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Detail Dosen
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Nama Lengkap</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $dosen->nama }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Jenis Kelamin</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $dosen->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Program Studi</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $dosen->prodi->nama }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>No. Telepon</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $dosen->telp ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Alamat</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $dosen->alamat ?? '-' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>NIDN</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $dosen->nidn }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>NIPY</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $dosen->nipy ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>ID Sinta</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $dosen->id_sinta ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>ID Scopus</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $dosen->id_scopus ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Jabatan</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $dosen->jabatan ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Pangkat / Golongan</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $dosen->golongan ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card {{ count($penelitians) ? '' : 'collapsed-card' }} rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Penelitian
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas {{ count($penelitians) ? 'fa-minus' : 'fa-plus' }}"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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
                                @forelse ($penelitians as $key => $penelitian)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-wrap">
                                            {{ $penelitian->judul }}
                                            <br>
                                            <small class="text-muted">({{ $penelitian->tahun }})</small>
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
                                            <strong>Jenis Penelitian:</strong>
                                            <br>
                                            {{ $penelitian->jenis_penelitian->nama }}
                                            <br>
                                            <strong>Jenis Pendanaan:</strong>
                                            <br>
                                            {{ $penelitian->jenis_pendanaan->nama }}
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
            <div class="card {{ count($pengabdians) ? '' : 'collapsed-card' }} rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Pengabdian
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas {{ count($pengabdians) ? 'fa-minus' : 'fa-plus' }}"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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
                                @forelse ($pengabdians as $pengabdian)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
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
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card {{ count($jurnals) ? '' : 'collapsed-card' }} rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Publikasi Jurnal
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas {{ count($jurnals) ? 'fa-minus' : 'fa-plus' }}"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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
                                @forelse ($jurnals as $jurnal)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
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
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card {{ count($bukus) ? '' : 'collapsed-card' }} rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Buku Ajar
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas {{ count($bukus) ? 'fa-minus' : 'fa-plus' }}"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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
                                @forelse ($bukus as $buku)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
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
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card {{ count($makalahs) ? '' : 'collapsed-card' }} rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Pemakalah Forum Ilmiah
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas {{ count($makalahs) ? 'fa-minus' : 'fa-plus' }}"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px">No</th>
                                    <th>Judul Makalah</th>
                                    <th>Dosen</th>
                                    <th style="width: 300px">Forum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($makalahs as $makalah)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="w-50">
                                            {{ $makalah->judul }}
                                            <br>
                                            <small class="text-muted">({{ $makalah->tahun }})</small>
                                        </td>
                                        <td>
                                            <ul class="px-3 mb-0">
                                                <li>{{ $makalah->user->nama }}</li>
                                                @foreach ($makalah->makalah_personels as $personel)
                                                    <li>{{ $personel->user->nama }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td style="max-width: 300px;">
                                            <strong>Tingkat:</strong>
                                            <span>{{ ucfirst($makalah->tingkat) }}</span>
                                            <br>
                                            <strong>Nama Forum:</strong>
                                            <span>{{ $makalah->forum }}</span>
                                            <br>
                                            <strong>Institusi:</strong>
                                            <span>{{ $makalah->institusi }}</span>
                                            <br>
                                            <strong>Tempat:</strong>
                                            <span>{{ $makalah->tempat }}</span>
                                            <br>
                                            <strong>Waktu Pelaksanaan:</strong>
                                            <span>
                                                @if ($makalah->tanggal_awal == $makalah->tanggal_akhir)
                                                    {{ Carbon\Carbon::parse($makalah->tanggal_awal)->translatedFormat('d F Y') }}
                                                @else
                                                    <span>{{ Carbon\Carbon::parse($makalah->tanggal_awal)->translatedFormat('d F Y') }}</span>
                                                    <span>-</span>
                                                    <br>
                                                    <span>{{ Carbon\Carbon::parse($makalah->tanggal_akhir)->translatedFormat('d F Y') }}</span>
                                                @endif
                                            </span>
                                            <br>
                                            <strong>Status Pemakalah:</strong>
                                            @if ($makalah->status == 'biasa')
                                                <span>Pemakalah Biasa</span>
                                            @elseif ($makalah->status == 'spesial')
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
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card {{ count($hkis) ? '' : 'collapsed-card' }} rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Hak Kekayaan Intelektual
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas {{ count($hkis) ? 'fa-minus' : 'fa-plus' }}"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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
                                @forelse ($hkis as $hki)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
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
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card {{ count($luarans) ? '' : 'collapsed-card' }} rounded-0">
                <div class="card-header">
                    <h3 class="card-title">
                        Data Luaran Lainnya
                        @if (request()->get('tahun'))
                            <small class="text-muted">(tahun <strong>{{ request()->get('tahun') }})</strong></small>
                        @endif
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas {{ count($luarans) ? 'fa-minus' : 'fa-plus' }}"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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
                                @forelse ($luarans as $luaran)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
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
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
