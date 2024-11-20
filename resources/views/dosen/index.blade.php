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
                <div class="row">
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
                <div class="callout callout-warning text-center rounded-0 mb-2">
                    <p>
                        Untuk keperluan Anda, lengkapi data diri terlebih dahulu
                    </p>
                    <a href="{{ url('profile') }}" class="btn btn-outline-info btn-flat" style="text-decoration: none;">
                        <i class="fas fa-user"></i>
                        Lengkapi Data
                    </a>
                </div>
                <div class="callout callout-info rounded-0 mb-2">
                    <h5>
                        <i class="fas fa-user"></i>
                        <strong>Profile Saya</strong>
                    </h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Nama Lengkap</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->nama }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Jenis Kelamin</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Program Studi</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->prodi->nama }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>No. Telepon</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->telp ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Alamat</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->alamat ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Role</strong>
                                </div>
                                <div class="col-md-8">
                                    <span class="badge badge-info rounded-0">Dosen</span>
                                    @if ($user->is_peninjau)
                                        <span class="badge badge-primary rounded-0">Reviewer</span>
                                    @endif
                                    @if ($user->is_ketua)
                                        <span class="badge badge-warning rounded-0">Ka. LPPM</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>NIDN</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->nidn }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>NIPY</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->nipy ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>ID Sinta</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->id_sinta ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>ID Scopus</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->id_scopus ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Jabatan</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->jabatan ?? '-' }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <strong>Pangkat / Golongan</strong>
                                </div>
                                <div class="col-md-8">
                                    {{ $user->golongan ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!$is_chrome)
                    <div class="callout callout-warning text-center rounded-0 mb-2">
                        <p>
                            Kami menyarankan Anda untuk membuka
                            <strong>SIDHARMA</strong>
                            dengan browser
                            <br>
                            <strong>
                                <i class="fab fa-chrome"></i>
                                Chrome
                            </strong>
                        </p>
                    </div>
                @endif
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
