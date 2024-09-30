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
                <div class="card rounded-0">
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
                            @if (auth()->user()->isKetua())
                                <div class="form-group mb-2">
                                    <label for="nipy">NIPY</label>
                                    <input type="text" class="form-control rounded-0 @error('nipy') is-invalid @enderror"
                                        id="nipy" name="nipy" value="{{ old('nipy', $user->nipy) }}">
                                    @error('nipy')
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
                            @if (auth()->user()->isKetua())
                                <div class="form-group mb-2">
                                    <label for="telp">
                                        Tanda Tangan
                                        @if ($user->ttd)
                                            <small class="text-muted">(kosongkan jika tidak ingin diubah)</small>
                                        @endif
                                    </label>
                                    <input type="file"
                                        class="form-control rounded-0 @error('ttd_test') is-invalid @enderror"
                                        id="ttd" name="ttd" accept="image/png" onchange="getTtd()"
                                        value="{{ old('ttd', $user->ttd) }}">
                                    @error('ttd_test')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="button" class="btn btn-info btn-xs btn-flat" onclick="showTtd()">Lihat
                                    Hasil</button>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm btn-flat">Perbarui Profile</button>
                        </div>
                    </form>
                </div>
                @if (auth()->user()->isKetua())
                    <form action="{{ url('ttd') }}" method="post" id="form-ttd" enctype="multipart/form-data"
                        target="_blank">
                        @csrf
                        <input type="text" class="form-control rounded-0" id="nidn-test" name="nidn_test" hidden>
                        <input type="file" class="form-control rounded-0" id="ttd-test" name="ttd_test" hidden>
                    </form>
                @endif
            </div>
        </section>
        <!-- /.card -->
    </div>
@endsection

@section('script')
    <script>
        function getTtd() {
            var ttd = $('#ttd').prop('files');
            $('#ttd-test').prop('files', ttd);
        }

        function showTtd() {
            var nidn = $('#nidn').val();
            $('#nidn-test').val(nidn);
            $('#form-ttd').submit();
        }
    </script>
@endsection
