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
                @if (!auth()->user()->telp)
                    <div class="callout callout-info">
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
                <h5>Proposal</h5>
                <div class="row mb-2">
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    @if ($proposal_list)
                                        {{ $proposal_list }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h3>
                                <p>Data Proposal</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('operator/proposal-list') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    @if ($proposal_pendanaan)
                                        {{ $proposal_pendanaan }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h3>
                                <p>Proposal Pendanaan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('operator/proposal-pendanaan') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    @if ($proposal_riwayat)
                                        {{ $proposal_riwayat }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h3>
                                <p>Riwayat Proposal</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('operator/proposal-riwayat') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <h5>Penelitian</h5>
                <div class="row mb-2">
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    @if ($penelitian_list)
                                        {{ $penelitian_list }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h3>
                                <p>Data Penelitian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('operator/proposal-list') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    @if ($penelitian_riwayat)
                                        {{ $penelitian_riwayat }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h3>
                                <p>Riwayat Penelitian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('operator/penelitian-riwayat') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <h5>Pengabdian</h5>
                <div class="row mb-2">
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    @if ($pengabdian_list)
                                        {{ $pengabdian_list }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h3>
                                <p>Data Pengabdian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('operator/pengabdian-list') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    @if ($pengabdian_riwayat)
                                        {{ $pengabdian_riwayat }}
                                        data
                                    @else
                                        -
                                    @endif
                                </h3>
                                <p>Riwayat Pengabdian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('operator/pengabdian-riwayat') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
