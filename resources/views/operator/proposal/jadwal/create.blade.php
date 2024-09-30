@extends('layouts.app')

@section('title', 'Buat Laporan Proposal')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <style>
        [class^='select2'] {
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('operator/proposal-jadwal') }}" class="btn btn-secondary btn-flat float-left mr-2">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1>Buat Laporan Proposal</h1>
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
                <form action="{{ url('operator/proposal-jadwal') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Form Laporan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <label for="nomor">Nomor Surat</label>
                                <input type="text" class="form-control rounded-0 @error('nomor') is-invalid @enderror"
                                    id="nomor" name="nomor" value="{{ old('nomor') }}">
                                @error('nomor')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="perihal">Perihal</label>
                                <textarea class="form-control rounded-0 @error('perihal') is-invalid @enderror" name="perihal" id="perihal"
                                    cols="30" rows="4">{{ old('perihal') }}</textarea>
                                @error('perihal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="kepadas">Fakultas yang dituju</label>
                                <div class="@error('kepadas') border border-danger @enderror">
                                    <select class="select2" id="kepadas" name="kepadas[]" multiple="multiple"
                                        data-placeholder="Pilih Fakultas" style="width: 100%;">
                                        @foreach ($fakultases as $fakultas)
                                            <option value="{{ $fakultas->id }}"
                                                {{ in_array($fakultas->id, old('kepadas') ?? []) ? 'selected' : '' }}>
                                                {{ $fakultas->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('kepadas')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Proposal</h3>
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary btn-sm btn-flat float-right mb-2"
                                    data-toggle="modal" data-target="#modal-proposal">
                                    Pilih Proposal
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px">No</th>
                                        <th>
                                            Dosen
                                            <small class="text-muted">(ketua)</small>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-proposal">
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <span class="text-muted">- Proposal belum ditambahkan -</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @error('proposal_ids')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right pb-4">
                        <button type="submit" class="btn btn-primary btn-flat">Buat Laporan</button>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.card -->
    </div>
    <div class="modal fade show" id="modal-proposal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title">Pilih Proposal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @forelse ($proposals as $proposal)
                        <div class="card rounded-0 mb-2">
                            <label for="proposal-checkbox-{{ $proposal->id }}"
                                class="card-body d-flex align-center justify-content-between align-items-center py-2 px-3 mb-0">
                                <span class="font-weight-normal">
                                    {{ $proposal->user->nama }}
                                    <br>
                                    {{ $proposal->judul }}
                                    <br>
                                    <small>
                                        {{ Carbon\Carbon::parse($proposal->tanggal)->translatedFormat('d F Y') }}
                                    </small>
                                </span>
                                <div class="custom-control custom-checkbox ml-auto">
                                    <input class="custom-control-input" type="checkbox"
                                        id="proposal-checkbox-{{ $proposal->id }}" value="{{ $proposal->id }}"
                                        onclick="proposal_check({{ $proposal->id }})">
                                    <label for="proposal-checkbox-{{ $proposal->id }}"
                                        class="custom-control-label"></label>
                                </div>
                            </label>
                        </div>
                    @empty
                        <div class="text-center p-4">
                            <span>- Data tidak ditemukan -</span>
                        </div>
                    @endforelse
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btn-sm btn-flat" data-dismiss="modal"
                        onclick="proposal_get()">Selesai</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2').select2();

        var proposal_item = [];

        function proposal_check(id) {
            var check = $('#proposal-checkbox-' + id).prop('checked');
            if (check) {
                proposal_item.push(id);
            } else {
                proposal_item = proposal_item.filter(item => item !== id);
            }
        }

        function proposal_get(is_old = false) {
            $.ajax({
                url: "{{ url('proposal-get') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "proposal_item": proposal_item,
                },
                dataType: "json",
                success: function(data) {
                    $('#tbody-proposal').empty();
                    if (data.length) {
                        $.each(data, function(key, value) {
                            proposal_set(key, value, is_old);
                        });
                    } else {
                        var tbody = '<tr>';
                        tbody += '<td class="text-center" colspan="3">';
                        tbody += '<span class="text-muted">- Proposal belum ditambahkan -</span>';
                        tbody += '</td>';
                        tbody += '</tr>';
                        $('#tbody-proposal').append(tbody);
                    }
                },
            });
        }

        function proposal_set(key, value, is_session = false) {
            if (is_session) {
                $('#proposal-checkbox-' + value.id).prop('checked', true);
            }
            var no = key + 1;
            var tbody = '<tr>';
            tbody += '<td class="text-center">' + no + '</td>';
            tbody += '<td>';
            tbody += value.user.nama + '<hr class="my-2">' + value.judul;
            tbody += '<input type="hidden" class="form-control rounded-0" name="proposal_ids[]" value="' + value.id + '">';
            tbody += '</td>';
            tbody += '</tr>';
            $('#tbody-proposal').append(tbody);
        }

        var proposal_ids = @json(old('proposal_ids'));
        if (proposal_ids !== null) {
            if (proposal_ids.length > 0) {
                $('#tbody-proposal').empty();
                $.each(proposal_ids, function(key, value) {
                    proposal_item.push(parseInt(value));
                    proposal_check(value);
                });
                proposal_get(true);
            }
        }
    </script>
@endsection
