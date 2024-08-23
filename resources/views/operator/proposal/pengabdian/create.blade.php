@extends('layouts.app')

@section('title', 'Buat Proposal Penelitian')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('operator/proposal-penelitian') }}"
                            class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Buat Proposal Penelitian</h1>
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
                <form action="{{ url('operator/proposal-penelitian') }}" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Form Proposal</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="jenis">Jenis Proposal</label>
                                        <input type="text" class="form-control rounded-0" id="jenis" name="jenis"
                                            value="Penelitian" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="tahun">Tahun Kegiatan</label>
                                        <input type="number"
                                            class="form-control rounded-0 @error('tahun') is-invalid @enderror"
                                            id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}">
                                        @error('tahun')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="judul">Judul Proposal</label>
                                <textarea class="form-control rounded-0 @error('judul') is-invalid @enderror" name="judul" id="judul"
                                    cols="30" rows="4">{{ old('judul') }}</textarea>
                                @error('judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="jenis_pendanaan_id">Jenis Pendanaan</label>
                                        <select
                                            class="custom-select rounded-0 @error('jenis_pendanaan_id') is-invalid @enderror"
                                            name="jenis_pendanaan_id" id="jenis_pendanaan_id">
                                            <option value="">- Pilih -</option>
                                            @foreach ($jenis_pendanaans as $jenis_pendanaan)
                                                <option value="{{ $jenis_pendanaan->id }}"
                                                    {{ old('jenis_pendanaan_id') == $jenis_pendanaan->id ? 'selected' : '' }}>
                                                    {{ $jenis_pendanaan->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jenis_pendanaan_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="dana_sumber">Sumber Dana</label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('dana_sumber') is-invalid @enderror"
                                            id="dana_sumber" name="dana_sumber" value="{{ old('dana_sumber') }}">
                                        @error('dana_sumber')
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
                                        <label for="dana_usulan">Dana Usulan</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text rounded-0">Rp</span>
                                            </div>
                                            <input type="number"
                                                class="form-control rounded-0 @error('dana_usulan') is-invalid @enderror"
                                                id="dana_usulan" name="dana_usulan" value="{{ old('dana_usulan') }}">
                                        </div>
                                        @error('dana_usulan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="berkas">Berkas</label>
                                        <input type="file"
                                            class="form-control rounded-0 @error('berkas') is-invalid @enderror"
                                            id="berkas" name="berkas" accept=".pdf">
                                        @error('berkas')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Personel Dosen</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="ketua_id">Ketua</label>
                                <div class="input-group">
                                    <select class="custom-select rounded-0 @error('ketua_id') is-invalid @enderror"
                                        name="ketua_id" id="ketua_id">
                                        <option value="">- Pilih -</option>
                                    </select>
                                    <div class="input-group-append ">
                                        <button type="button" class="btn btn-secondary btn-flat btn-sm" data-toggle="modal"
                                            data-target="#modal-ketua">Pilih Ketua</button>
                                    </div>
                                    @error('ketua_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="ketua">
                                    Anggota
                                    <small>(opsional)</small>
                                </label>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm btn-flat float-right mb-2"
                                data-toggle="modal" data-target="#modal-anggota">
                                Pilih Anggota
                            </button>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>Dosen</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-anggota">
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
                        <button type="submit" class="btn btn-primary btn-flat">Buat Proposal</button>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.card -->
    </div>
    <div class="modal fade show" id="modal-ketua">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Pilih Ketua</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-header">
                    <div class="input-group">
                        <input type="search" class="form-control rounded-0" id="keyword-ketua" name="keyword-ketua"
                            placeholder="cari nama / nidn dosen" autocomplete="off">
                        <div class="input-group-append rounded-0">
                            <button type="button" class="btn btn-default btn-flat" onclick="ketua_search()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <table id="table-ketua" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 20px">No</th>
                                <th>Dosen</th>
                                <th class="text-center" style="width: 40px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-ketua">
                            @foreach ($dosens as $dosen)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $dosen->nama }}
                                        <br>
                                        {{ $dosen->nidn }}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-outline-primary btn-sm btn-flat"
                                            data-dismiss="modal" onclick="ketua_set({{ $dosen->id }})">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="modal-loading-ketua" class="text-center p-4" style="display: none">
                        <span>Loading...</span>
                    </div>
                    <div id="modal-batas-ketua" class="text-center">
                        <small class="text-muted">Hanya menampilkan 10 data</small>
                        <br>
                        <small class="text-muted">Cari dengan <strong>kata kunci</strong> lebih detail</small>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade show" id="modal-anggota">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Pilih Anggota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-header d-block">
                    <div class="input-group mb-2">
                        <input type="search" class="form-control rounded-0" id="keyword-anggota" name="keyword_anggota"
                            placeholder="cari nama / nidn dosen" autocomplete="off">
                        <div class="input-group-append rounded-0">
                            <button type="button" class="btn btn-default btn-flat" onclick="anggota_search()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <small class="float-right">Jumlah Personil : <span id="personel">0</span>/5 Orang</small>
                </div>
                <div class="modal-body">
                    <div id="modal-card-anggota">
                        @foreach ($dosens as $dosen)
                            <div class="card rounded-0 mb-2">
                                <label for="anggota-checkbox-{{ $dosen->id }}"
                                    class="card-body d-flex align-center justify-content-between align-items-center py-2 px-3 mb-0">
                                    <span class="font-weight-normal">
                                        {{ $dosen->nama }}
                                        <br>
                                        {{ $dosen->nidn }}
                                    </span>
                                    <div class="custom-control custom-checkbox ml-auto">
                                        <input class="custom-control-input" type="checkbox"
                                            id="anggota-checkbox-{{ $dosen->id }}" value="{{ $dosen->id }}"
                                            onclick="anggota_check({{ $dosen->id }})">
                                        <label for="anggota-checkbox-{{ $dosen->id }}"
                                            class="custom-control-label"></label>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div id="modal-loading-anggota" class="text-center p-4" style="display: none">
                        <span>Loading...</span>
                    </div>
                    <div id="modal-kosong-anggota" class="text-center p-4" style="display: none">
                        <span>- Dosen tidak ditemukan -</span>
                    </div>
                    <div class="text-center">
                        <small class="text-muted">Hanya menampilkan 10 data</small>
                        <br>
                        <small class="text-muted">Cari dengan <strong>kata kunci</strong> lebih detail</small>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btn-sm btn-flat" id="btn-anggota" data-dismiss="modal"
                        onclick="anggota_get()">Selesai</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#keyword-ketua').on('search', function() {
            ketua_search();
        });

        $('#keyword-anggota').on('search', function() {
            anggota_search();
        });

        function ketua_search() {
            $('#table-ketua').hide();
            $('#tbody-ketua').empty();
            $('#modal-loading-ketua').show();
            $.ajax({
                url: "{{ url('ketua-search') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "keyword": $('#keyword-ketua').val(),
                },
                dataType: "json",
                success: function(data) {
                    $('#modal-loading-ketua').hide();
                    $('#table-ketua').show();
                    if (data.length) {
                        $.each(data, function(key, value) {
                            ketua_modal(key, value);
                        });
                    } else {
                        var tbody = '<tr>';
                        tbody += '<td class="text-center" colspan="3">';
                        tbody += '<span class="text-muted">- Data tidak ditemukan -</span>';
                        tbody += '</td>';
                        tbody += '</tr>';

                        $('#tbody-ketua').append(tbody);
                    }
                },
            });
        }

        function ketua_modal(key, value) {
            var no = key + 1;
            var tbody = '<tr>';
            tbody += '<td class="text-center">' + no + '</td>';
            tbody += '<td>' + value.nama + '<br>' + value.nidn + '</td>';
            tbody += '<td class="text-center">';
            tbody +=
                '<button type="button" class="btn btn-outline-primary btn-sm btn-flat" data-dismiss="modal" onclick="ketua_set(' +
                value.id + ')">';
            tbody += '<i class="fas fa-check"></i>';
            tbody += '</button>';
            tbody += '</td>';
            tbody += '</tr>';

            $('#tbody-ketua').append(tbody);
        }

        function ketua_set(id) {
            $.ajax({
                url: "{{ url('ketua-set') }}" + "/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#ketua_id').empty();
                        var option = '<option value="' + data.id + '">' + data.nama + '</option>';
                        $('#ketua_id').append(option);
                    } else {
                        console.log('Dosen tidak ditemukan!');
                    }
                },
            });
        }

        var ketua_id = "{{ old('ketua_id') }}";
        if (ketua_id) {
            ketua_set(ketua_id);
        }

        var anggota_item = [];

        function anggota_search() {
            $('#modal-card-anggota').empty();
            $('#modal-batas-anggota').hide();
            $('#modal-loading-anggota').show();
            $('#modal-kosong-anggota').hide();
            $.ajax({
                url: "{{ url('anggota-search') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "keyword": $('#keyword-anggota').val(),
                },
                dataType: "json",
                success: function(data) {
                    $('#modal-loading-anggota').hide();
                    if (data.length) {
                        $('#modal-card-anggota').show();
                        $('#modal-kosong-anggota').hide();
                        $.each(data, function(key, value) {
                            anggota_modal(value, anggota_item.includes(value.id));
                        });
                    } else {
                        $('#modal-kosong-anggota').show();
                    }
                },
            });
        }

        function anggota_modal(data, is_selected) {
            if (is_selected) {
                var checked = 'checked';
            } else {
                var checked = '';
            }

            var anggota_card = '<div class="card rounded-0 mb-2">';
            anggota_card += '<label for="anggota-checkbox-' + data.id +
                '" class="card-body d-flex align-center justify-content-between align-items-center py-2 px-3 mb-0">';
            anggota_card += '<span class="font-weight-normal">' + data.nama + '<br>' + data.nidn + '</span>';
            anggota_card += '<div class="custom-control custom-checkbox ml-auto">';
            anggota_card += '<input class="custom-control-input" type="checkbox" id="anggota-checkbox-' + data.id +
                '" value="' +
                data.id + '" onclick="anggota_check(' + data.id + ')" ' + checked + '>';
            anggota_card += '<label for="anggota-checkbox-' + data.id + '" class="custom-control-label"></label>';
            anggota_card += '</div>';
            anggota_card += '</label>';
            anggota_card += '</div>';

            $('#modal-card-anggota').append(anggota_card);
        }

        function anggota_check(id) {
            var check = $('#anggota-checkbox-' + id).prop('checked');
            if (check) {
                anggota_item.push(id);
            } else {
                anggota_item = anggota_item.filter(item => item !== id);
            }
            $('#personel').text(anggota_item.length);
            if (anggota_item.length > 5) {
                $('#btn-anggota').prop('disabled', true);
            } else {
                $('#btn-anggota').prop('disabled', false);
            }
        }

        function anggota_get(is_old = false) {
            $.ajax({
                url: "{{ url('anggota-get') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "anggota_item": anggota_item,
                },
                dataType: "json",
                success: function(data) {
                    $('#tbody-anggota').empty();
                    if (data.length) {
                        $.each(data, function(key, value) {
                            anggota_set(key, value, is_old);
                        });
                    } else {
                        var tbody = '<tr>';
                        tbody += '<td class="text-center" colspan="2">';
                        tbody += '<span class="text-muted">- Anggota belum ditambahkan -</span>';
                        tbody += '</td>';
                        tbody += '</tr>';
                        $('#tbody-anggota').append(tbody);
                    }
                },
            });
        }

        function anggota_set(key, value, is_session = false) {
            if (is_session) {
                $('#anggota-checkbox-' + value.id).prop('checked', true);
            }
            var no = key + 1;
            var tbody = '<tr>';
            tbody += '<td class="text-center">' + no + '</td>';
            tbody += '<td>' + value.nama + '<br>' + value.nidn;
            tbody += '<input type="hidden" class="form-control rounded-0" name="anggota_ids[]" value="' + value.id + '">';
            tbody += '</td>';
            tbody += '</tr>';
            $('#tbody-anggota').append(tbody);
        }

        var anggota_ids = @json(old('anggota_ids'));
        if (anggota_ids !== null) {
            if (anggota_ids.length > 0) {
                $('#tbody-anggota').empty();
                $.each(anggota_ids, function(key, value) {
                    anggota_item.push(parseInt(value));
                    anggota_check(value);
                });
                anggota_get(true);
            }
        }
    </script>
@endsection
