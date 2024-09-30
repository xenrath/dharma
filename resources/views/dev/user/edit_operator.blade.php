@extends('layouts.app')

@section('title', 'Edit Operator')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('dev/user') }}" class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Edit Operator</h1>
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
                <form action="{{ url('dev/user/operator/' . $user->id) }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="nama">
                                    Nama Lengkap
                                    <small class="text-muted">(dengan gelar)</small>
                                </label>
                                <input type="text" class="form-control rounded-0 @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $user->nama) }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="username">Username</label>
                                <input type="text" class="form-control rounded-0 @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username', $user->username) }}">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="username">Password</label>
                                <br>
                                <button type="button" class="btn btn-warning btn-sm btn-flat" data-toggle="modal"
                                    data-target="#modal-reset">Reset Password</button>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm btn-flat">Perbarui</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.card -->
    </div>
    <div class="modal fade" id="modal-reset">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Reset Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('dev/user/reset/' . $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        Yakin reset password dari <strong>{{ $user->nama }}</strong>?
                        <br>
                        <small>Password akan direset menjadi : <strong>bhamada</strong></small>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning btn-sm btn-flat">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
