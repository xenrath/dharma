@extends('layouts.app')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('loader')
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('storage/uploads/asset/logo-lppm.png') }}" alt="SIDHARMA" height="80"
            width="80" style="border-radius: 50%">
    </div>
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (!auth()->user()->telp || (auth()->user()->isKetua() && !auth()->user()->nipy))
                    <div class="callout callout-info rounded-0">
                        <h5>
                            <i class="fas fa-info"></i>
                            Perhatian
                        </h5>
                        <p>Untuk keperluan Anda, lengkapi data diri terlebih dahulu</p>
                        <a href="{{ url('profile') }}" class="btn btn-outline-info btn-flat" style="text-decoration: none;">
                            <i class="fas fa-user"></i>
                            Lengkapi Data
                        </a>
                    </div>
                @endif
                @if (auth()->user()->isKetua() || auth()->user()->isPeninjau())
                    <h5>Dosen</h5>
                @endif
                <div class="row mb-2">
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    {{ $proposal }}
                                    data
                                </h3>
                                <p>Data Proposal</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('dosen/proposal') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    {{ $penelitian }}
                                    data
                                </h3>
                                <p>Data Penelitian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('dosen/penelitian') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    {{ $pengabdian }}
                                    data
                                </h3>
                                <p>Data Pengabdian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('dosen/pengabdian') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->isKetua())
                    <h5>Ketua</h5>
                    <div class="row mb-2">
                        <div class="col-lg-4 col-12">
                            <div class="callout callout-info rounded-0">
                                <h6>Data Proposal</h6>
                                <h2 class="text-bold">
                                    @if ($ketua_proposal)
                                        {{ $ketua_proposal }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h2>
                                <div class="text-center">
                                    <a href="{{ url('dosen/ketua/proposal') }}" class="btn btn-outline-info btn-sm btn-flat"
                                        style="text-decoration: none;">
                                        Lihat Data
                                        <i class="fas fa-chevron-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="callout callout-info rounded-0">
                                <h6>Riwayat Proposal</h6>
                                <h2 class="text-bold">
                                    @if ($ketua_riwayat)
                                        {{ $ketua_riwayat }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h2>
                                <div class="text-center">
                                    <a href="{{ url('dosen/ketua/riwayat') }}" class="btn btn-outline-info btn-sm btn-flat"
                                        style="text-decoration: none;">
                                        Lihat Data
                                        <i class="fas fa-chevron-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (auth()->user()->isPeninjau())
                    <h5>Reviewer</h5>
                    <div class="row mb-2">
                        <div class="col-lg-4 col-12">
                            <div class="callout callout-info rounded-0">
                                <h6>Data Review</h6>
                                <h2 class="text-bold">
                                    @if ($peninjau_review)
                                        {{ $peninjau_review }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h2>
                                <div class="text-center">
                                    <a href="{{ url('dosen/peninjau/review') }}"
                                        class="btn btn-outline-info btn-sm btn-flat" style="text-decoration: none;">
                                        Lihat Data
                                        <i class="fas fa-chevron-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="callout callout-info rounded-0">
                                <h6>Data Revisi</h6>
                                <h2 class="text-bold">
                                    @if ($peninjau_revisi)
                                        {{ $peninjau_revisi }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h2>
                                <div class="text-center">
                                    <a href="{{ url('dosen/peninjau/revisi') }}"
                                        class="btn btn-outline-info btn-sm btn-flat" style="text-decoration: none;">
                                        Lihat Data
                                        <i class="fas fa-chevron-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="callout callout-info rounded-0">
                                <h6>Riwayat Review</h6>
                                <h2 class="text-bold">
                                    @if ($peninjau_riwayat)
                                        {{ $peninjau_riwayat }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h2>
                                <div class="text-center">
                                    <a href="{{ url('dosen/peninjau/riwayat') }}"
                                        class="btn btn-outline-info btn-sm btn-flat" style="text-decoration: none;">
                                        Lihat Data
                                        <i class="fas fa-chevron-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
