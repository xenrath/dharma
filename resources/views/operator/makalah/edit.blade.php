@extends('layouts.app')

@section('title', 'Edit Makalah Ilmiah')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('operator/makalah') }}" class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Edit Makalah Ilmiah</h1>
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
                <form action="{{ url('operator/makalah/' . $makalah->id) }}" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Form Makalah Ilmiah</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="user_id">
                                            Dosen
                                            <small class="text-muted">(ketua)</small>
                                        </label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('user_id') is-invalid @enderror"
                                            id="user_id" name="user_id" value="{{ $makalah->user->nama }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="tahun">Tahun Pelaksanaan</label>
                                        <input type="number"
                                            class="form-control rounded-0 @error('tahun') is-invalid @enderror"
                                            id="tahun" name="tahun" value="{{ old('tahun', $makalah->tahun) }}">
                                        @error('tahun')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="judul">Judul Makalah</label>
                                <textarea class="form-control rounded-0 @error('judul') is-invalid @enderror" name="judul" id="judul"
                                    cols="30" rows="4">{{ old('judul', $makalah->judul) }}</textarea>
                                @error('judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="forum">Nama Forum</label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('forum') is-invalid @enderror"
                                            id="forum" name="forum" value="{{ old('forum', $makalah->forum) }}">
                                        @error('forum')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="institusi">Institusi Penyelenggara</label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('institusi') is-invalid @enderror"
                                            id="institusi" name="institusi"
                                            value="{{ old('institusi', $makalah->institusi) }}">
                                        @error('institusi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="tempat">Tempat Pelaksanaan</label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('tempat') is-invalid @enderror"
                                            id="tempat" name="tempat" value="{{ old('tempat', $makalah->tempat) }}">
                                        @error('tempat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="tanggal_awal">Waktu Pelaksanaan</label>
                                        <div class="input-group">
                                            <input type="date"
                                                class="form-control rounded-0 @error('tanggal_awal') is-invalid @enderror"
                                                id="tanggal_awal" name="tanggal_awal"
                                                value="{{ old('tanggal_awal', $makalah->tanggal_awal) }}">
                                            <div class="input-group-append mx-2">
                                                <span class="input-group-text">s/d</span>
                                            </div>
                                            <input type="date"
                                                class="form-control rounded-0 @error('tanggal_akhir') is-invalid @enderror"
                                                id="tanggal_akhir" name="tanggal_akhir"
                                                value="{{ old('tanggal_akhir', $makalah->tanggal_akhir) }}">
                                        </div>
                                        @if ($errors->has('tanggal_awal') || $errors->has('tanggal_akhir'))
                                            <small class="text-danger">
                                                Waktu Pelaksanaan harus diisi!
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="tingkat">Tingkat Publikasi</label>
                                        <select class="custom-select rounded-0 @error('tingkat') is-invalid @enderror"
                                            name="tingkat" id="tingkat">
                                            <option value="">- Pilih -</option>
                                            <option value="regional"
                                                {{ old('tingkat', $makalah->tingkat) == 'regional' ? 'selected' : '' }}>
                                                Regional
                                            </option>
                                            <option value="nasional"
                                                {{ old('tingkat', $makalah->tingkat) == 'nasional' ? 'selected' : '' }}>
                                                Nasional
                                            </option>
                                            <option value="internasional"
                                                {{ old('tingkat', $makalah->tingkat) == 'internasional' ? 'selected' : '' }}>
                                                Internasional
                                            </option>
                                        </select>
                                        @error('tingkat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="status">Status Pemakalah</label>
                                        <select class="custom-select rounded-0 @error('status') is-invalid @enderror"
                                            name="status" id="status">
                                            <option value="">- Pilih -</option>
                                            <option value="biasa"
                                                {{ old('status', $makalah->status) == 'biasa' ? 'selected' : '' }}>
                                                Pemalakah Biasa
                                            </option>
                                            <option value="spesial"
                                                {{ old('status', $makalah->status) == 'spesial' ? 'selected' : '' }}>
                                                Invited / Keynote Speaker
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="file">
                                    File Makalah
                                    @if ($makalah->file)
                                        <small class="text-muted">(kosongkan jika tidak ingin diisi)</small>
                                    @endif
                                </label>
                                <input type="file" class="form-control rounded-0 @error('file') is-invalid @enderror"
                                    id="file" name="file" accept=".pdf">
                                @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @if ($makalah->file)
                                <a href="{{ asset('storage/uploads/' . $makalah->file) }}"
                                    class="btn btn-info btn-xs btn-flat float-right" target="_blank">
                                    Lihat File
                                </a>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Personel Dosen
                                <small>(opsional)</small>
                            </h3>
                            <button type="button" class="btn btn-secondary btn-sm btn-flat float-right"
                                data-toggle="modal" data-target="#modal-personel">
                                Pilih Anggota
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>Dosen</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-personel">
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <span class="text-muted">- Anggota belum ditambahkan -</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-right pb-4">
                        <button type="submit" class="btn btn-primary btn-sm btn-flat">Edit Makalah Ilmiah</button>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.card -->
    </div>
    <div class="modal fade show" id="modal-personel">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Pilih Anggota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-header mb-2">
                    <div class="input-group">
                        <input type="search" class="form-control rounded-0" id="keyword-personel"
                            name="keyword_personel" placeholder="cari nama / nidn dosen" autocomplete="off">
                        <div class="input-group-append rounded-0">
                            <button type="button" class="btn btn-default btn-flat" onclick="personel_search()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div id="modal-card-personel">
                        @forelse ($dosens as $dosen)
                            <div class="card rounded-0 mb-2">
                                <label for="personel-checkbox-{{ $dosen->id }}"
                                    class="card-body d-flex align-center justify-content-between align-items-center py-2 px-3 mb-0">
                                    <span class="font-weight-normal">
                                        {{ $dosen->nama }}
                                        <br>
                                        {{ $dosen->nidn }}
                                    </span>
                                    <div class="custom-control custom-checkbox ml-auto">
                                        <input class="custom-control-input" type="checkbox"
                                            id="personel-checkbox-{{ $dosen->id }}" value="{{ $dosen->id }}"
                                            onclick="personel_check({{ $dosen->id }})">
                                        <label for="personel-checkbox-{{ $dosen->id }}"
                                            class="custom-control-label"></label>
                                    </div>
                                </label>
                            </div>
                        @empty
                            <div class="card rounded-0 mb-2">
                                <div class="card-body text-center p-4">
                                    <span class="text-muted">- Data tidak ditemukan -</span>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div id="modal-loading-personel" class="text-center p-4" style="display: none">
                        <span>Loading...</span>
                    </div>
                    <div id="modal-kosong-personel" class="text-center p-4" style="display: none">
                        <span>- Data tidak ditemukan -</span>
                    </div>
                    <div class="text-center">
                        <small class="text-muted">Cari dengan <strong>kata kunci</strong> lebih detail</small>
                        <br>
                        <small class="text-muted">Menampilkan maksimal 10 data</small>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btn-sm btn-flat" id="btn-personel"
                        data-dismiss="modal" onclick="personel_get()">Selesai</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#keyword-personel').on('search', function() {
            personel_search();
        });
        // 
        var personel_item = [];
        // 
        function personel_search() {
            $('#modal-card-personel').empty();
            $('#modal-batas-personel').hide();
            $('#modal-loading-personel').show();
            $('#modal-kosong-personel').hide();
            $.ajax({
                url: "{{ url('personel-search') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "keyword": $('#keyword-personel').val(),
                },
                dataType: "json",
                success: function(data) {
                    $('#modal-loading-personel').hide();
                    if (data.length) {
                        $('#modal-card-personel').show();
                        $('#modal-kosong-personel').hide();
                        $.each(data, function(key, value) {
                            personel_modal(value, personel_item.includes(value.id));
                        });
                    } else {
                        $('#modal-kosong-personel').show();
                    }
                },
            });
        }
        // 
        function personel_modal(data, is_selected) {
            if (is_selected) {
                var checked = 'checked';
            } else {
                var checked = '';
            }
            var personel_card = '<div class="card rounded-0 mb-2">';
            personel_card += '<label for="personel-checkbox-' + data.id +
                '" class="card-body d-flex align-center justify-content-between align-items-center py-2 px-3 mb-0">';
            personel_card += '<span class="font-weight-normal">' + data.nama + '<br>' + data.nidn + '</span>';
            personel_card += '<div class="custom-control custom-checkbox ml-auto">';
            personel_card += '<input class="custom-control-input" type="checkbox" id="personel-checkbox-' + data.id +
                '" value="' +
                data.id + '" onclick="personel_check(' + data.id + ')" ' + checked + '>';
            personel_card += '<label for="personel-checkbox-' + data.id + '" class="custom-control-label"></label>';
            personel_card += '</div>';
            personel_card += '</label>';
            personel_card += '</div>';
            $('#modal-card-personel').append(personel_card);
        }
        // 
        function personel_check(id, is_old = false) {
            if (!is_old) {
                var check = $('#personel-checkbox-' + id).prop('checked');
                if (check) {
                    personel_item.push(id);
                } else {
                    personel_item = personel_item.filter(item => item !== id);
                }
            }
        }
        // 
        function personel_get(is_old = false) {
            $.ajax({
                url: "{{ url('personel-get') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "personel_item": personel_item,
                },
                dataType: "json",
                success: function(data) {
                    $('#tbody-personel').empty();
                    if (data.length) {
                        $.each(data, function(key, value) {
                            personel_set(key, value, is_old);
                        });
                    } else {
                        var tbody = '<tr>';
                        tbody += '<td class="text-center" colspan="2">';
                        tbody += '<span class="text-muted">- Anggota belum ditambahkan -</span>';
                        tbody += '</td>';
                        tbody += '</tr>';
                        $('#tbody-personel').append(tbody);
                    }
                },
            });
        }
        // 
        function personel_set(key, value, is_old = false) {
            if (is_old) {
                $('#personel-checkbox-' + value.id).prop('checked', true);
            }
            var no = key + 1;
            var tbody = '<tr>';
            tbody += '<td class="text-center">' + no + '</td>';
            tbody += '<td>' + value.nama + '<br>' + value.nidn;
            tbody += '<input type="hidden" class="form-control rounded-0" name="personels[]" value="' + value.id + '">';
            tbody += '</td>';
            tbody += '</tr>';
            $('#tbody-personel').append(tbody);
        }
        // 
        var personels = @json(old('personels', $makalah->makalah_personels->pluck('user_id')));
        if (personels !== null) {
            if (personels.length > 0) {
                $('#tbody-personel').empty();
                $.each(personels, function(key, value) {
                    personel_item.push(parseInt(value));
                    personel_check(value, true);
                });
                personel_get(true);
            }
        }
    </script>
@endsection
