<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lembar Pengesahan</title>
    <style>
        body {
            padding: 0px;
            font-size: 14px;
            line-height: 1.5;
        }

        .logo {
            width: 100px;
            position: absolute;
        }

        .header {
            margin-left: 100px;
            height: 100px;
            text-align: center;
        }

        .header .h1 {
            font-size: 24px;
            font-weight: bold;
            display: block;
        }

        .header .h2 {
            font-size: 16px;
            font-weight: bold;
            display: block;
        }

        .header .p {
            font-size: 14px;
            display: block;
        }

        .hr {
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .tanggal {
            display: flex;
            float: right;
        }

        .table {
            width: 100%;
        }

        .table .th {
            border: 1px solid black;
            text-align: left;
            padding: 6px;
            vertical-align: top;
        }

        .table .td {
            border: 1px solid black;
            text-align: left;
            padding: 6px;
            vertical-align: top;
        }

        * {
            font-family: 'Times New Roman', Times, serif;
            /* border: 1px solid black; */
        }

        .text-center {
            text-align: center
        }

        .text-header {
            font-size: 18px;
            font-weight: 500;
        }

        .layout-ttd {
            display: inline-flex;
            text-align: center;
        }

        .text-muted {
            font-size: 14px;
            opacity: 80%;
        }

        .page-break {
            page-break-after: always;
        }

        .border {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <table class="table" cellspacing="0" cellpadding="8">
        <tr>
            <th class="th" colspan="4" style="text-align: center;">LEMBAR PENGESAHAN</th>
        </tr>
        <tr>
            <td class="td" style="width: 15px; text-align: center;">1.</td>
            <td class="td" style="width: 160px;">Judul</td>
            <td class="td" style="width: 5px; text-align: center;">&nbsp;</td>
            <td class="td">
                {{ $data->judul }}
            </td>
        </tr>
        <tr>
            <td class="td" style="width: 15px; text-align: center;">2.</td>
            <td class="td">Bidang Penerapan IPTEKS</td>
            <td class="td" style="width: 5px; text-align: center;">&nbsp;</td>
            <td class="td">
                {{ $ketua->prodi->nama }}
            </td>
        </tr>
        <tr>
            <td class="td" style="width: 15px; text-align: center;">3.</td>
            <td class="td">
                <span>Ketua Pelaksana</span>
                <ol style="padding: 0px 18px; margin: 0px;" type="a">
                    <li>Nama</li>
                    <li>Jenis Kelamin</li>
                    <li>NIPY/NIDN</li>
                    <li>ID Sinta</li>
                    <li>ID Scopus</li>
                    <li>Pangkat/Golongan</li>
                    <li>Jabatan</li>
                    <li>Program Studi</li>
                    <li>Perguruan Tinggi</li>
                </ol>
            </td>
            <td class="td" style="width: 5px; text-align: center;">&nbsp;</td>
            <td class="td">
                <span>&nbsp;</span>
                <ul style="padding: 0px; margin: 0px; list-style-type: none;">
                    <li>{{ $ketua->nama }}</li>
                    <li>Laki-laki</li>
                    <li>{{ $ketua->nidn }}</li>
                    <li>-</li>
                    <li>-</li>
                    <li>-</li>
                    <li>Dosen Tetap</li>
                    <li>{{ $ketua->prodi->nama }}</li>
                    <li>Universitas Bhamada Slawi</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td class="td" style="width: 15px; text-align: center;">4.</td>
            <td class="td">
                <span>Alamat Ketua Pelaksana</span>
                <ol style="padding: 0px 18px; margin: 0px;" type="a">
                    <li>Alamat Kantor</li>
                    <li>No. Telp / Fax</li>
                    <li>Alamat Rumah</li>
                    <li>No. HP</li>
                </ol>
            </td>
            <td class="td" style="width: 5px; text-align: center;">&nbsp;</td>
            <td class="td">
                <span>&nbsp;</span>
                <ul style="padding: 0px; margin: 0px; list-style-type: none;">
                    <li>Jl. Cut Nyak Dhien No. 16, Desa Kalisapu, Kecamatan Slawi, Kabupaten Tegal</li>
                    <li>Telp. (0283)6197570 / Fax. (0283)6198450</li>
                    <li>-</li>
                    <li>{{ $ketua->telp }}</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td class="td" style="width: 15px; text-align: center;">5.</td>
            <td class="td">
                <span>Jumlah Anggota Pelaksana</span>
                <ol style="padding: 0px 18px; margin: 0px;" type="a">
                    @if (count($data->personels) || count($data->mahasiswas))
                        <li>Nama Anggota I</li>
                        <li>Nama Anggota II</li>
                        <li>Nama anggota lainnya</li>
                    @endif
                </ol>
            </td>
            <td class="td" style="width: 5px; text-align: center;">&nbsp;</td>
            <td class="td">
                <span>{{ count($data->personels) + count($data->mahasiswas) }} Orang</span>
                <ul style="padding: 0px; margin: 0px; list-style-type: none;">
                    @if (count($data->personels))
                        @foreach ($data->personels as $personel)
                            <li>{{ $personel->user->nama }}</li>
                        @endforeach
                    @endif
                    @if (count($data->mahasiswas))
                        @foreach ($data->mahasiswas as $nama => $prodi)
                            <li>{{ $nama }} ({{ $prodi }})</li>
                        @endforeach
                    @endif
                    @if (count($data->personels) + count($data->mahasiswas) == 1)
                        <li>-</li>
                        <li>-</li>
                    @endif
                    @if (count($data->personels) + count($data->mahasiswas) == 2)
                        <li>-</li>
                    @endif
                </ul>
            </td>
        </tr>
        <tr>
            <td class="td" style="width: 15px; text-align: center;">6.</td>
            <td class="td">Dana yang dibutuhkan</td>
            <td class="td" style="width: 5px; text-align: center;">&nbsp;</td>
            <td class="td">@rupiah($data->dana_setuju),-</td>
        </tr>
        <tr>
            <td class="td" style="width: 15px; text-align: center;">7.</td>
            <td class="td">Sumber Dana</td>
            <td class="td" style="width: 5px; text-align: center;">&nbsp;</td>
            <td class="td">{{ $data->jenis_pendanaan->nama }}</td>
        </tr>
    </table>
    <br>
    <table style="width: 100%;" cellspacing="0" cellpadding="8">
        <tr>
            <td style="width: 50%;">
                <div class="layout-ttd">
                    <span>&nbsp;</span>
                    <br>
                    <span>&nbsp;</span>
                    <br>
                    <span>Ketua Peneliti</span>
                    <br><br><br><br>
                    <span style="text-decoration: underline">{{ $ketua->nama }}</span>
                    <br>
                    <span>NIPY: {{ $ketua->nipy }}</span>
                </div>
            </td>
            <td style="width: 50%; padding: 0px; text-align: right;">
                <div class="layout-ttd">
                    <span>Slawi, {{ Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
                    <br>
                    <span>Menyetujui,</span>
                    <br>
                    <span>Ketua LPPM</span>
                    <br><br><br><br>
                    <span style="text-decoration: underline">{{ $kepala->nama }}</span>
                    <br>
                    <span>NIPY: {{ $kepala->nipy }}</span>
                </div>
            </td>
        </tr>
        <tr style="width: 100%;">
            <td colspan="2" style="text-align: center; padding: 0px;">
                <div class="layout-ttd">
                    <span>Wakil Rektor I Bidang Akademik</span>
                    <br><br><br><br>
                    <span style="text-decoration: underline">Dr. Risnanto, M.Kes</span>
                    <br>
                    <span>NIPY: 1972.06.10.97.007</span>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
