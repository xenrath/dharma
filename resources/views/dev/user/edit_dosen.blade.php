@extends('layouts.app')

@section('title', 'Edit Dosen')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('dev/user') }}" class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Edit Dosen</h1>
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
                <form action="{{ url('dev/user/dosen/' . $user->id) }}" method="POST" autocomplete="off">
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
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control rounded-0 @error('nidn') is-invalid @enderror"
                                    id="nidn" name="nidn" value="{{ old('nidn', $user->nidn) }}">
                                @error('nidn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="prodi_id">Prodi</label>
                                <select class="custom-select rounded-0 @error('prodi_id') is-invalid @enderror"
                                    name="prodi_id" id="prodi_id">
                                    <option value="">- Pilih -</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}"
                                            {{ old('prodi_id', $user->prodi_id) == $prodi->id ? 'selected' : '' }}>
                                            {{ $prodi->nama }}</option>
                                    @endforeach
                                </select>
                                @error('prodi_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="is_ketua">Jadikan Ketua</label>
                                <select class="custom-select rounded-0" name="is_ketua" id="is_ketua">
                                    <option value="0" {{ old('is_ketua', $user->is_ketua) ? '' : 'selected' }}>Tidak
                                    </option>
                                    <option value="1" {{ old('is_ketua', $user->is_ketua) ? 'selected' : '' }}>Ya
                                    </option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="is_peninjau">Jadikan Reviewer</label>
                                <select class="custom-select rounded-0" name="is_peninjau" id="is_peninjau">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
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
                            <button class="btn btn-primary btn-sm btn-flat">Perbarui</button>
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
