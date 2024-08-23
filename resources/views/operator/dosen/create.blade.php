@extends('layouts.app')

@section('title', 'Tambah Dosen')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('operator/dosen') }}" class="btn btn-secondary btn-flat float-left mr-2">
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
                <div class="card rounded-0">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Dosen</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ url('operator/dosen') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="nama">
                                    Nama Dosen
                                    <small class="text-muted">(beserta gelar)</small>
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
                                            {{ $prodi->fakultas->kode }} - {{ $prodi->nama }}</option>
                                    @endforeach
                                </select>
                                @error('prodi_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="telp">
                                    Nomor WhatsApp
                                    <small class="text-muted">(08xxxxxxxxxx)</small>
                                </label>
                                <input type="tel" class="form-control rounded-0 @error('telp') is-invalid @enderror"
                                    id="telp" name="telp" value="{{ old('telp') }}">
                                @error('telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="is_peninjau">Jadikan Reviewer</label>
                                <select class="custom-select rounded-0" name="is_peninjau" id="is_peninjau">
                                    <option value="0" {{ old('is_peninjau') ? 'selected' : '' }}>
                                        Tidak</option>
                                    <option value="1" {{ old('is_peninjau') ? 'selected' : '' }}>
                                        Ya</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm btn-flat">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- /.card -->
    </div>
@endsection
