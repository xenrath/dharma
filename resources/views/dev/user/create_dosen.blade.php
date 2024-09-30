@extends('layouts.app')

@section('title', 'Tambah Dosen')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('dev/user') }}" class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Tambah Dosen</h1>
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
                <form action="{{ url('dev/user/dosen') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="nama">
                                    Nama Lengkap
                                    <small class="text-muted">(dengan gelar)</small>
                                </label>
                                <input type="text" class="form-control rounded-0 @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="nidn">NIDN</label>
                                <input type="text" class="form-control rounded-0 @error('nidn') is-invalid @enderror"
                                    id="nidn" name="nidn" value="{{ old('nidn') }}">
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
                                            {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
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
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="is_peninjau">Jadikan Reviewer</label>
                                <select class="custom-select rounded-0" name="is_peninjau" id="is_peninjau">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <strong>Password</strong>
                                <br>
                                <span>Default password : <strong>bhamada</strong></span>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm btn-flat">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.card -->
    </div>
@endsection
