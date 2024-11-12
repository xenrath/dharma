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
                    <form action="{{ url('profile') }}" method="post" autocomplete="off">
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
                            @if (auth()->user()->isDosen())
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="nidn">
                                                NIDN
                                                <small class="text-muted">(untuk login)</small>
                                            </label>
                                            <input type="text"
                                                class="form-control rounded-0 @error('nidn') is-invalid @enderror"
                                                id="nidn" name="nidn" value="{{ old('nidn', $user->nidn) }}">
                                            @error('nidn')
                                                <div class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="nipy">NIPY</label>
                                            <input type="text"
                                                class="form-control rounded-0 @error('nipy') is-invalid @enderror"
                                                id="nipy" name="nipy" value="{{ old('nipy', $user->nipy) }}">
                                            @error('nipy')
                                                <div class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="id_sinta">ID Sinta</label>
                                            <input type="text"
                                                class="form-control rounded-0 @error('id_sinta') is-invalid @enderror"
                                                id="id_sinta" name="id_sinta"
                                                value="{{ old('id_sinta', $user->id_sinta) }}">
                                            @error('id_sinta')
                                                <div class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="id_scopus">ID Scopus</label>
                                            <input type="text"
                                                class="form-control rounded-0 @error('id_scopus') is-invalid @enderror"
                                                id="id_scopus" name="id_scopus"
                                                value="{{ old('id_scopus', $user->id_scopus) }}">
                                            @error('id_scopus')
                                                <div class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="golongan">Pangkat/Golongan</label>
                                            <input type="text"
                                                class="form-control rounded-0 @error('golongan') is-invalid @enderror"
                                                id="golongan" name="golongan"
                                                value="{{ old('golongan', $user->golongan) }}">
                                            @error('golongan')
                                                <div class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="jabatan">Jabatan</label>
                                            <input type="text"
                                                class="form-control rounded-0 @error('jabatan') is-invalid @enderror"
                                                id="jabatan" name="jabatan" value="{{ old('jabatan', $user->jabatan) }}">
                                            @error('jabatan')
                                                <div class="text-danger">
                                                    <small>{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control rounded-0 @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                                        cols="30" rows="4">{{ $user->alamat }}</textarea>
                                    @error('alamat')
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
                                    <label for="ttd">
                                        Tanda Tangan
                                        @if ($user->ttd)
                                            <small class="text-muted">(kosongkan jika tidak ingin diubah)</small>
                                        @endif
                                    </label>
                                    <input type="file"
                                        class="form-control rounded-0 @error('ttd') is-invalid @enderror" id="ttd"
                                        name="ttd" accept="image/png" onchange="getTtd()"
                                        value="{{ old('ttd', $user->ttd) }}">
                                    @error('ttd')
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
                        <input type="text" class="form-control rounded-0" id="nipy-test" name="nipy_test" hidden>
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
            var nipy = $('#nipy').val();
            $('#nipy-test').val(nipy);
            $('#form-ttd').submit();
        }
    </script>
@endsection
