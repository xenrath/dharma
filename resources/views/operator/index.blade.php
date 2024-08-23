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
                <div class="row mb-2">
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    {{ $proposal_penelitian }}
                                    data
                                </h3>
                                <p>Proposal Penelitian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('operator/proposal-penelitian') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    {{ $proposal_pengabdian }}
                                    data
                                </h3>
                                <p>Proposal Pengabdian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('operator/proposal-pengabdian') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-success rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    {{ $proposal_penelitian }}
                                    data
                                </h3>
                                <p>Data Penelitian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('operator/proposal-penelitian') }}" class="small-box-footer">
                                Lihat Data
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-success rounded-0 mb-2">
                            <div class="inner">
                                <h3>
                                    {{ $proposal_pengabdian }}
                                    data
                                </h3>
                                <p>Data Pengabdian</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-document-text"></i>
                            </div>
                            <a href="{{ url('operator/proposal-pengabdian') }}" class="small-box-footer">
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
