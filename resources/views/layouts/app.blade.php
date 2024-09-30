<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('storage/uploads/asset/logo-lppm.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    @yield('css')

    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css?v=3.2.0') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    @include('sweetalert::alert')

    <div class="wrapper">

        @yield('loader')

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link btn btn-default btn-sm btn-flat" data-toggle="dropdown" href="#">
                        {{-- <i class="fas fa-user mr-2"></i> --}}
                        <strong class="mr-2">{{ substr(auth()->user()->nama, 0, 30) }}</strong>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-2 rounded-0">
                        <a href="{{ url('profile') }}"
                            class="dropdown-item {{ request()->is('profile*') ? 'active' : '' }}">
                            <i class="fas fa-sm fa-user-edit mr-2"></i>
                            <small class="text-bold">Perbarui Profil</small>
                        </a>
                        <div class="dropdown-divider my-2"></div>
                        <a href="{{ url('ubah-password') }}"
                            class="dropdown-item {{ request()->is('ubah-password*') ? 'active' : '' }}">
                            <i class="fas fa-sm fa-user-lock mr-2"></i>
                            <small class="text-bold">Ganti Password</small>
                        </a>
                        <div class="dropdown-divider my-2"></div>
                        <button type="button" class="btn btn-danger btn-sm btn-block btn-flat" data-toggle="modal"
                            data-target="#modal-logout">Keluar</button>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="{{ asset('storage/uploads/asset/logo-lppm.png') }}" alt="Admin SIT" class="brand-image"
                    style="border-radius: 50%">
                <span class="brand-text font-wight-bold" style="">SIDHARMA LPPM</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if (auth()->user()->isDev())
                            @include('layouts.menu.dev')
                        @endif
                        @if (auth()->user()->isOperator())
                            @include('layouts.menu.operator')
                        @endif
                        @if (auth()->user()->isDosen())
                            @include('layouts.menu.dosen')
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <footer class="main-footer">
            <strong>
                Copyright © 2023, Designed & Developed by
                <a href="https://it.bhamada.ac.id/">IT Bhamada</a>
            </strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Modal Logout -->
    <div class="modal fade" id="modal-logout">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Logout</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin keluar sistem <strong>SIDHARMA</strong>?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm btn-flat">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js?v=3.2.0') }}"></script>

    @yield('script')
</body>

</html>
