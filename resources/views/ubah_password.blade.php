@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Ubah Password</h1>
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
                <div class="card rounded-0">
                    <div class="card-header">
                        <h3 class="card-title">Form Ubah Password</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ url('ubah-password') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password"
                                        class="form-control rounded-0 @error('password') is-invalid @enderror"
                                        value="{{ old('password') }}">
                                    <div class="input-group-append bg-light" style="cursor: pointer;"
                                        onclick="showPassword()">
                                        <div class="input-group-text rounded-0">
                                            <span class="fas fa-eye" id="icon-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="text-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control rounded-0 @error('password_confirmation') is-invalid @enderror"
                                        value="{{ old('password_confirmation') }}">
                                    <div class="input-group-append bg-light" style="cursor: pointer;"
                                        onclick="showPasswordConfirmation()">
                                        <div class="input-group-text rounded-0">
                                            <span class="fas fa-eye" id="icon-eye-confirmation"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('password_confirmation')
                                    <div class="text-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm btn-flat">Ubah Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
@endsection

@section('script')
    <script>
        function showPassword() {
            var password = document.getElementById('password');
            var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            var icon_eye = document.getElementById('icon-eye');
            var icon_change = icon_eye.className === 'fas fa-eye-slash' ? 'fas fa-eye' : 'fas fa-eye-slash';
            icon_eye.className = icon_change;
        }

        function showPasswordConfirmation() {
            var password = document.getElementById('password_confirmation');
            var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            var icon_eye = document.getElementById('icon-eye-confirmation');
            var icon_change = icon_eye.className === 'fas fa-eye-slash' ? 'fas fa-eye' : 'fas fa-eye-slash';
            icon_eye.className = icon_change;
        }
    </script>
@endsection
