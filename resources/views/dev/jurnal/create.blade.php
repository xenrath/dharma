@extends('layouts.app')

@section('title', 'Tambah Publikasi Jurnal')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('dev/jurnal') }}" class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Tambah Publikasi Jurnal</h1>
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
                <form action="{{ url('dev/jurnal') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Form Publikasi Jurnal</h3>
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
                                        <div class="input-group">
                                            <select class="custom-select rounded-0 @error('user_id') is-invalid @enderror"
                                                name="user_id" id="user_id">
                                                <option value="">- Pilih -</option>
                                            </select>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-secondary btn-flat"
                                                    data-toggle="modal" data-target="#modal-ketua">
                                                    Pilih
                                                </button>
                                            </div>
                                        </div>
                                        @error('user_id')
                                            <div class="text-danger">
                                                <small>{{ $message }}</small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="tahun">Tahun Publikasi</label>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="nama">Nama Jurnal</label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="jenis_jurnal_id">Jenis Jurnal</label>
                                        <select
                                            class="custom-select rounded-0 @error('jenis_jurnal_id') is-invalid @enderror"
                                            name="jenis_jurnal_id" id="jenis_jurnal_id">
                                            <option value="">- Pilih -</option>
                                            @foreach ($jenis_jurnals as $jenis_jurnal)
                                                <option value="{{ $jenis_jurnal->id }}"
                                                    {{ old('jenis_jurnal_id') == $jenis_jurnal->id ? 'selected' : '' }}>
                                                    {{ $jenis_jurnal->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('jenis_jurnal_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="judul">Judul Jurnal</label>
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
                                        <label for="issn">ISSN</label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('issn') is-invalid @enderror"
                                            id="issn" name="issn" value="{{ old('issn') }}">
                                        @error('issn')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="volume">Volume</label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('volume') is-invalid @enderror"
                                            id="volume" name="volume" value="{{ old('volume') }}">
                                        @error('volume')
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
                                        <label for="nomor">Nomor</label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('nomor') is-invalid @enderror"
                                            id="nomor" name="nomor" value="{{ old('nomor') }}">
                                        @error('nomor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="halaman">Halaman</label>
                                        <div class="input-group">
                                            <input type="number"
                                                class="form-control rounded-0 @error('halaman_awal') is-invalid @enderror"
                                                id="halaman_awal" name="halaman_awal" value="{{ old('halaman_awal') }}">
                                            <div class="input-group-append mx-2">
                                                <span class="input-group-text">s/d</span>
                                            </div>
                                            <input type="text"
                                                class="form-control rounded-0 @error('halaman_akhir') is-invalid @enderror"
                                                id="halaman_akhir" name="halaman_akhir"
                                                value="{{ old('halaman_akhir') }}">
                                        </div>
                                        @if ($errors->has('halaman_awal') || $errors->has('halaman_akhir'))
                                            <small class="text-danger">
                                                Halaman harus diisi!
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="url">URL</label>
                                        <input type="text"
                                            class="form-control rounded-0 @error('url') is-invalid @enderror"
                                            id="url" name="url" value="{{ old('url') }}">
                                        @error('url')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <label for="file">File Jurnal</label>
                                        <input type="file"
                                            class="form-control rounded-0 @error('file') is-invalid @enderror"
                                            id="file" name="file" accept=".pdf">
                                        @error('file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="status">Status</label>
                                <select class="custom-select rounded-0 @error('status') is-invalid @enderror"
                                    name="status" id="status">
                                    <option value="">- Pilih -</option>
                                    <option value="menunggu" {{ old('status') == 'menunggu' ? 'selected' : '' }}>Menunggu
                                    </option>
                                    <option value="revisi" {{ old('status') == 'revisi' ? 'selected' : '' }}>Revisi
                                    </option>
                                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
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
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Personel Mahasiswa
                                <small>(opsional)</small>
                            </h3>
                            <button type="button" class="btn btn-secondary btn-sm btn-flat float-right"
                                onclick="tambahMahasiswa()">
                                Tambah
                            </button>
                        </div>
                        <div class="card-body" id="card-mahasiswa">
                            <div id="mahasiswa-kosong">
                                <div class="text-center p-4 border rounded-0">
                                    <span class="text-muted">- Tidak ada mahasiswa yang ditambahkan -</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right pb-4">
                        <button type="submit" class="btn btn-primary btn-sm btn-flat">Tambah Publikasi
                            Jurnal</button>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.card -->
    </div>
    <div class="modal fade show" id="modal-ketua">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Pilih Ketua</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-header mb-2">
                    <div class="input-group">
                        <input type="search" class="form-control rounded-0" id="keyword-ketua" name="keyword_ketua"
                            placeholder="cari nama / nidn dosen" autocomplete="off">
                        <div class="input-group-append rounded-0">
                            <button type="button" class="btn btn-default btn-flat" onclick="ketua_search()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <table id="table-ketua" class="table table-bordered table-striped mb-2">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 20px">No</th>
                                <th>Nama / NIDN</th>
                                <th class="text-center" style="width: 40px">Pilih</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-ketua">
                            @forelse ($dosens as $key => $dosen)
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
                            @empty
                                <tr>
                                    <td class="3">- Data tidak ditemukan -</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div id="modal-loading-ketua" class="text-center p-4" style="display: none">
                        <span>Loading...</span>
                    </div>
                    <div class="text-center">
                        <small class="text-muted">Cari dengan <strong>kata kunci</strong> lebih detail</small>
                        <br>
                        <small class="text-muted">Menampilkan maksimal 10 data</small>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
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
        $('#keyword-ketua').on('search', function() {
            ketua_search();
        });
        // 
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
        // 
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
        // 
        function ketua_set(id) {
            $.ajax({
                url: "{{ url('ketua-set') }}" + "/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('#user_id').empty();
                        var option = '<option value="' + data.id + '">' + data.nama + '</option>';
                        $('#user_id').append(option);
                    } else {
                        console.log('Dosen tidak ditemukan!');
                    }
                },
            });
        }
        // 
        var user_id = "{{ old('user_id') }}";
        if (user_id) {
            ketua_set(user_id);
        }
        // 
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
        function personel_check(id) {
            var check = $('#personel-checkbox-' + id).prop('checked');
            if (check) {
                personel_item.push(id);
            } else {
                personel_item = personel_item.filter(item => item !== id);
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
        var personels = @json(old('personels'));
        if (personels !== null) {
            if (personels.length > 0) {
                $('#tbody-personel').empty();
                $.each(personels, function(key, value) {
                    personel_item.push(parseInt(value));
                    personel_check(value);
                });
                personel_get(true);
            }
        }
        // 
        var old_mahasiswa = @json(session('old_mahasiswas'));
        var jumlah_mahasiswa = old_mahasiswa == null ? 0 : Object.keys(old_mahasiswa).length;
        if (old_mahasiswa) {
            Object.keys(old_mahasiswa).forEach((key, i) => {
                tambahMahasiswa(key, old_mahasiswa[key], i + 1, true);
            });
        }
        // 
        function tambahMahasiswa(param_nama, param_prodi, param_urutan, is_old) {
            var nama = "";
            var prodi = "";
            var urutan = jumlah_mahasiswa + 1;
            // 
            if (is_old) {
                nama = param_nama;
                prodi = param_prodi;
                urutan = param_urutan;
            } else {
                jumlah_mahasiswa += 1;
            }
            // 
            $('#mahasiswa-kosong').hide();
            // 
            var input_mahasiswa = '<div class="form-group mb-2" id="mahasiswa-' + urutan + '">';
            input_mahasiswa += '<div class="input-group">';
            input_mahasiswa += '<input type="text" class="form-control rounded-0 mr-2" name="mahasiswas[' + urutan +
                '][nama]" value="' +
                nama +
                '">';
            input_mahasiswa += '<select class="custom-select rounded-0 mr-2" name="mahasiswas[' + urutan +
                '][prodi]" id="mahasiswas-' + urutan + '">';
            input_mahasiswa += '<option value="">- Pilih -</option>';
            input_mahasiswa += '<option value="Profesi Ners">Profesi Ners</option>';
            input_mahasiswa += '<option value="S1 Ilmu Keperawatan">S1 Ilmu Keperawatan</option>';
            input_mahasiswa += '<option value="S1 Farmasi">S1 Farmasi</option>';
            input_mahasiswa +=
                '<option value="D4 Keselamatan dan Kesehatan Kerja">D4 Keselamatan dan Kesehatan Kerja</option>';
            input_mahasiswa += '<option value="D3 Kebidanan">D3 Kebidanan</option>';
            input_mahasiswa += '<option value="D3 Keperawatan">D3 Keperawatan</option>';
            input_mahasiswa += '<option value="S1 Bisnis Digital">S1 Bisnis Digital</option>';
            input_mahasiswa += '<option value="S1 Kewirausahaan">S1 Kewirausahaan</option>';
            input_mahasiswa += '<option value="S1 Informatika">S1 Informatika</option>';
            input_mahasiswa += '</select>';
            input_mahasiswa += '<div class="input-group-append">';
            input_mahasiswa += '<button type="button" class="btn btn-danger btn-flat" onclick="hapusMahasiswa(' +
                urutan + ')">';
            input_mahasiswa += '<i class="fas fa-trash"></i>';
            input_mahasiswa += '</button>';
            input_mahasiswa += '</div>';
            input_mahasiswa += '</div>';
            input_mahasiswa += '</div>';
            // 
            $('#card-mahasiswa').append(input_mahasiswa);
            // 
            if (is_old) {
                $('#mahasiswas-' + urutan).val(prodi);
            }
        }
        // 
        function hapusMahasiswa(id) {
            jumlah_mahasiswa -= 1;
            // 
            if (!jumlah_mahasiswa) {
                $('#mahasiswa-kosong').show();
            }
            // 
            $('#mahasiswa-' + id).remove();
            console.log(jumlah_mahasiswa);
        }
    </script>
@endsection
