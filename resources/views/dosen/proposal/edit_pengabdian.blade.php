@extends('layouts.app')

@section('title', 'Proposal Pengabdian')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('dosen/proposal') }}" class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Proposal Pengabdian</h1>
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
                <form action="{{ url('dosen/proposal/pengabdian/' . $proposal->id) }}" method="POST"
                    enctype="multipart/form-data" autocomplete="off">
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
                                        <label for="jenis">
                                            Dosen
                                            <small>(ketua)</small>
                                        </label>
                                        <input type="text" class="form-control rounded-0" id="jenis" name="jenis"
                                            value="{{ $proposal->user->nama }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="tahun">Tahun Kegiatan</label>
                                        <input type="number"
                                            class="form-control rounded-0 @error('tahun') is-invalid @enderror"
                                            id="tahun" name="tahun"
                                            value="{{ old('tahun', $proposal->tahun, $proposal->tahun) }}">
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
                                    cols="30" rows="4">{{ old('judul', $proposal->judul) }}</textarea>
                                @error('judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="jenis_pengabdian_id">Jenis Pengabdian</label>
                                        <select
                                            class="custom-select rounded-0 @error('jenis_pengabdian_id') is-invalid @enderror"
                                            name="jenis_pengabdian_id" id="jenis_pengabdian_id">
                                            <option value="">- Pilih -</option>
                                            @foreach ($jenis_pengabdians as $jenis_pengabdian)
                                                <option value="{{ $jenis_pengabdian->id }}"
                                                    {{ old('jenis_pengabdian_id', $proposal->jenis_pengabdian_id) == $jenis_pengabdian->id ? 'selected' : '' }}>
                                                    {{ $jenis_pengabdian->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jenis_pengabdian_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="jenis_pendanaan_id">Jenis Pendanaan</label>
                                        <select
                                            class="custom-select rounded-0 @error('jenis_pendanaan_id') is-invalid @enderror"
                                            name="jenis_pendanaan_id" id="jenis_pendanaan_id">
                                            <option value="">- Pilih -</option>
                                            @foreach ($jenis_pendanaans as $jenis_pendanaan)
                                                <option value="{{ $jenis_pendanaan->id }}"
                                                    {{ old('jenis_pendanaan_id', $proposal->jenis_pendanaan_id) == $jenis_pendanaan->id ? 'selected' : '' }}>
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
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="dana_sumber">Sumber Dana</label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('dana_sumber') is-invalid @enderror"
                                            id="dana_sumber" name="dana_sumber"
                                            value="{{ old('dana_sumber', $proposal->dana_sumber) }}">
                                        @error('dana_sumber')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="dana_usulan">Dana Usulan</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text rounded-0">Rp</span>
                                            </div>
                                            <input type="number"
                                                class="form-control rounded-0 @error('dana_usulan') is-invalid @enderror"
                                                id="dana_usulan" name="dana_usulan"
                                                value="{{ old('dana_usulan', $proposal->dana_usulan) }}">
                                        </div>
                                        @error('dana_usulan')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="berkas">
                                    Berkas Laporan
                                    <small>(kosongkan jika tidak ingin diganti)</small>
                                </label>
                                <input type="file" class="form-control rounded-0 @error('berkas') is-invalid @enderror"
                                    id="berkas" name="berkas" accept=".pdf">
                                @error('berkas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <a href="{{ asset('storage/uploads/' . $proposal->berkas) }}"
                                class="btn btn-info btn-xs btn-flat float-right" target="_blank">
                                Lihat Berkas
                            </a>
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
                        <button type="submit" class="btn btn-primary btn-flat">Perbarui Proposal</button>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.card -->
    </div>
    <div class="modal fade show" id="modal-personel">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pilih Anggota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-header d-block">
                    <div class="input-group mb-2">
                        <input type="search" class="form-control rounded-0" id="keyword-personel"
                            name="keyword_personel" placeholder="cari nama / nidn dosen" autocomplete="off">
                        <div class="input-group-append rounded-0">
                            <button type="button" class="btn btn-default btn-flat" onclick="personel_search()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <small class="float-right">Jumlah Personil : <span id="personel">0</span>/4 Orang</small>
                </div>
                <div class="modal-body">
                    <div id="modal-card-personel">
                        @foreach ($dosens as $dosen)
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
                        @endforeach
                    </div>
                    <div id="modal-loading-personel" class="text-center p-4" style="display: none">
                        <span>Loading...</span>
                    </div>
                    <div id="modal-kosong-personel" class="text-center p-4" style="display: none">
                        <span>- Dosen tidak ditemukan -</span>
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

        var personel_item = [];

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

        function personel_check(id, is_old = false) {
            if (!is_old) {
                var check = $('#personel-checkbox-' + id).prop('checked');
                if (check) {
                    personel_item.push(id);
                } else {
                    personel_item = personel_item.filter(item => item !== id);
                }
            }

            $('#personel').text(personel_item.length);
            if (personel_item.length > 4) {
                $('#btn-personel').prop('disabled', true);
            } else {
                $('#btn-personel').prop('disabled', false);
            }
        }

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

        var personels = @json(old('personels', $proposal->personels->pluck('user_id')));
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
