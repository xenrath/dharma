@extends('layouts.app')

@section('title', 'Informasi Sistem')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Informasi Sistem</h1>
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
                <div class="row">
                    <div class="col-md-8">
                        <div class="card rounded-0">
                            <div class="card-header">
                                <h3 class="card-title">Penjelasan Sistem</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <p style="text-align: justify; text-justify: inter-word;">
                                    <strong>SIDHARMA LPPM</strong> (Sistem Informasi Pengelolaan Penelitian dan Pengabdian
                                    kepada
                                    Masyarakat) adalah sebuah aplikasi yang dirancang untuk mendukung pengelolaan kegiatan
                                    penelitian dan pengabdian kepada masyarakat di lembaga pendidikan tinggi, seperti
                                    universitas.
                                    Berikut adalah beberapa penjelasan terkait fungsionalitas dan fitur SIDHARMA LPPM:
                                </p>
                                <ol class="px-3">
                                    <li style="text-align: justify; text-justify: inter-word;">
                                        <strong>Pengelolaan Proposal</strong>: SIDHARMA LPPM memungkinkan dosen dan
                                        mahasiswa untuk
                                        mengajukan proposal penelitian dan pengabdian kepada masyarakat secara online.
                                        Sistem ini
                                        mempermudah proses pendaftaran dan evaluasi proposal.
                                    </li>
                                    <li style="text-align: justify; text-justify: inter-word;">
                                        <strong>Database Penelitian</strong>: SIDHARMA LPPM menyimpan informasi tentang
                                        semua
                                        kegiatan
                                        penelitian dan pengabdian yang dilakukan, termasuk publikasi, hasil, dan dampak yang
                                        dihasilkan.
                                    </li>
                                    <li style="text-align: justify; text-justify: inter-word;">
                                        <strong>Informasi dan Pembiayaan</strong>: Sistem ini juga mengelola informasi
                                        terkait
                                        pembiayaan proyek penelitian dan pengabdian, termasuk pengajuan dan pencairan dana
                                        hibah.
                                    </li>
                                    <li style="text-align: justify; text-justify: inter-word;">
                                        <strong>Peningkatan Transparansi</strong>: Dengan semua data yang tersimpan secara
                                        digital, SIDHARMA LPPM meningkatkan transparansi dan akuntabilitas dalam pengelolaan
                                        kegiatan penelitian dan pengabdian.
                                    </li>
                                </ol>
                                <p style="text-align: justify; text-justify: inter-word;">
                                    SIDHARMA LPPM membantu universitas dalam meningkatkan efektivitas dan efisiensi kegiatan
                                    penelitian serta pengabdian kepada masyarakat, sehingga dapat memberikan dampak yang
                                    lebih besar bagi masyarakat dan kemajuan ilmu pengetahuan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card rounded-0">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Terkait</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="{{ url('statistik') }}" class="btn btn-outline-primary btn-flat btn-block"
                                    target="_blank">
                                    <i class="fas fa-chart-pie"></i>
                                    Statistik SIDHARMA
                                </a>
                            </div>
                            <div class="card-body border-top">
                                <div class="mb-2">
                                    <strong>Reno Arkan Pratama (Operator)</strong>
                                    <br>
                                    <a href="{{ url('hubungi/' . $telp_operator) }}" class="btn btn-success btn-sm btn-flat"
                                        target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                        Hubungi
                                    </a>
                                </div>
                                <div class="mb-2">
                                    <strong>Saiful Labib Marzuqi (Developer)</strong>
                                    <br>
                                    <a href="{{ url('hubungi/' . $telp_dev) }}" class="btn btn-success btn-sm btn-flat"
                                        target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                        Hubungi
                                    </a>
                                </div>
                            </div>
                            @if (auth()->user()->isOperator())
                                <div class="card-body border-top">
                                    <a href="{{ asset('storage/uploads/asset/operator.pdf') }}"
                                        class="btn btn-outline-info btn-flat btn-block" target="_blank">
                                        <i class="fas fa-download"></i>
                                        Pedoman Operator
                                    </a>
                                </div>
                            @endif
                            @if (auth()->user()->isDosen())
                                <div class="card-body border-top">
                                    <a href="{{ asset('storage/uploads/asset/dosen.pdf') }}"
                                        class="btn btn-outline-info btn-flat btn-block" target="_blank">
                                        <i class="fas fa-download"></i>
                                        Pedoman Dosen
                                    </a>
                                </div>
                            @endif
                            @if (auth()->user()->isKetua())
                                <div class="card-body border-top">
                                    <a href="{{ asset('storage/uploads/asset/ketua.pdf') }}"
                                        class="btn btn-outline-info btn-flat btn-block" target="_blank">
                                        <i class="fas fa-download"></i>
                                        Pedoman Ketua
                                    </a>
                                </div>
                            @endif
                            @if (auth()->user()->isPeninjau())
                                <div class="card-body border-top">
                                    <a href="{{ asset('storage/uploads/asset/reviewer.pdf') }}"
                                        class="btn btn-outline-info btn-flat btn-block" target="_blank">
                                        <i class="fas fa-download"></i>
                                        Pedoman Reviewer
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
@endsection
