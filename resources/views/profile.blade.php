@extends('layouts.app')

@section('title', 'Perbarui Profile')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Perbarui Profile</h1>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Profile</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ url('profile') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="nama">
                                    Nama Lengkap
                                    <small class="text-muted">(dengan gelar)</small>
                                </label>
                                <input type="text" class="form-control rounded-0 @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $user->nama) }}">
                                @error('nama')
                                    <div class="text-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                            @if (auth()->user()->isDosen() || auth()->user()->isKetua())
                                <div class="form-group mb-2">
                                    <label for="nidn">NIDN</label>
                                    <input type="text" class="form-control rounded-0 @error('nidn') is-invalid @enderror"
                                        id="nidn" name="nidn" value="{{ old('nidn', $user->nidn) }}">
                                    @error('nidn')
                                        <div class="text-danger">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                            @endif
                            <div class="form-group mb-2">
                                <label for="telp">
                                    Nomor WhatsApp
                                    <small class="text-muted">(08xxxxxxxxxx)</small>
                                </label>
                                <input type="tel" class="form-control rounded-0 @error('telp') is-invalid @enderror"
                                    id="telp" name="telp" value="{{ old('telp', $user->telp) }}">
                                @error('telp')
                                    <div class="text-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm btn-flat">Perbarui Profile</button>
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

        function getTtd() {
            var ttd = $('#ttd').prop('files');
            $('#ttd-test').prop('files', ttd);
        }

        function showTtd() {
            var nipy = $('#nipy').val();
            $('#nipy-test').val(nipy);
            $('#form-ttd').submit();
        }
    </script>
@endsection
