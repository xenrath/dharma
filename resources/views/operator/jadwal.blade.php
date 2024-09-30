<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Undangan Presentasi Proposal LP2M - {{ Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}
    </title>
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
            padding: 8px;
            vertical-align: top;
        }

        .table .td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
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
    <img src="{{ public_path('storage/uploads/asset/logo-bhamada.png') }}" alt="Bhamada" class="logo">
    <div class="header">
        <span class="h1">UNIVERSITAS BHAMADA SLAWI</span>
        <span class="h2">LEMBAGA PENELITIAN DAN PENGABDIAN KEPADA MASYARAKAT (LPPM)</span>
        <span class="p">Alamat : Jl. Cut Nyak Dhien No. 16, Kalisapu, Kecamatan Slawi - Kabupaten Tegal</span>
        <span class="p">Telp. (0283)6197570, 6197571 Fax. (0283)6198450</span>
    </div>
    <hr class="hr">
    <span class="tanggal">Slawi, {{ Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</span>
    <br><br>
    <table>
        <tr>
            <td style="width: 80px;">Nomor</td>
            <td style="width: 15px;">:</td>
            <td>{{ $jadwal->nomor }}</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td>1 Bendel</td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td>{{ $jadwal->perihal }}</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Kepada Yth :</td>
        </tr>
        @foreach ($fakultases as $fakultas)
            <tr>
                <td></td>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $fakultas->nama }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">di</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Slawi</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Dengan hormat,</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">
                <p style="text-align: justify; text-justify: inter-word;">
                    Sehubungan dengan Plotting kegiatan Penelitian dan Pengabdian kepada Masyarakat (LPPM)
                    pada Tahun Akademik {{ $tahun_akademik }} bagi Dosen di lingkungan Universitas Bhamada Slawi, kami
                    sampaikan
                    kepada Bapak/Ibu Dosen bahwa pada akan dilaksanakan kegiatan presentasi proposal penelitian dan
                    pengabdian kepada masyarakat sesuai dengan jadwal terlampir. Dimohon kepada Bapak/Ibu Dosen untuk
                    mempersiapkan proposal dan perwakilan sebagai presentator dalam kegiatan tersebut.
                    <br>
                    Demikian agar menjadi periksa, atas perhatian dan kerjasama yang baik kami sampaikan terima kasih.
                </p>
            </td>
        </tr>
    </table>
    <br><br>
    <div style="text-align: right">
        <div style="display: inline-flex; text-align: left;">
            Kepala LPPM
            <br>
            Universitas Bhamada Slawi
            <br><br><br><br><br>
            <span style="text-decoration: underline;">{{ $ketua->nama }}</span>
            <br>
            NIPY: {{ $ketua->nipy }}
        </div>
    </div>
    <div style="position: absolute; bottom: 0px;">
        Tembusan kepada:
        <table>
            <tr>
                <td style="width: 20px;">1.</td>
                <td>Ka. BAUK</td>
            </tr>
            @foreach ($fakultases as $fakultas)
                <tr>
                    <td>{{ $loop->iteration + 1 }}.</td>
                    <td>Ka. Prodi di {{ $fakultas->nama }}</td>
                </tr>
            @endforeach
            <tr>
                <td>{{ count($fakultases) + 2 }}.</td>
                <td>Dosen yang bersangkutan</td>
            </tr>
            <tr>
                <td>{{ count($fakultases) + 3 }}.</td>
                <td>Arsip</td>
            </tr>
        </table>
    </div>

    @if (count($proposals->where('jenis', 'penelitian')))
        <!-- Page Break -->
        <div class="page-break"></div>
        <!-- Page Break -->

        <span style="top: -30px; position: fixed; opacity: 50%; font-size: 12px;">Lampiran Surat
            {{ $jadwal->nomor }}</span>
        <div style="text-align: center;">
            <span style="font-size: 16px; font-weight: bold; display: block; margin-bottom: 6px;">
                PRESENTATOR DAN REVIEWER
                <br>
                KEGIATAN PENELITIAN DOSEN
            </span>
        </div>
        <br>
        <table class="table" cellspacing="0" cellpadding="8">
            <tr>
                <th class="th" style="width: 20px; text-align: center;">NO</th>
                <th class="th" style="width: 140px; text-align: center;">JADWAL</th>
                <th class="th" style="width: 140px; text-align: center;">PROGRAM STUDI</th>
                <th class="th" style="width: 200px; text-align: center;">TIM</th>
                <th class="th" style="text-align: center;">REVIEWER</th>
            </tr>
            @foreach ($proposals->where('jenis', 'penelitian') as $penelitian)
                <tr>
                    <td class="td" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td class="td">
                        {{ Carbon\Carbon::parse($penelitian->tanggal)->translatedFormat('l, d F Y') }}
                        <br>
                        {{ $penelitian->jam }} WIB - Selesai
                    </td>
                    <td class="td">{{ $penelitian->user->prodi->nama }}</td>
                    <td class="td">
                        <strong>Ketua Peneliti:</strong>
                        <br>
                        {{ $penelitian->user->nama }}
                        <br>
                        <strong>Anggota:</strong>
                        @if (count($penelitian->personels))
                            <ol style="padding: 0px 18px; margin: 0px;">
                                @foreach ($penelitian->personels as $personel)
                                    <li>{{ $personel->user->nama }}</li>
                                @endforeach
                            </ol>
                        @else
                            -
                        @endif
                    </td>
                    <td class="td">{{ $penelitian->peninjau->nama }}</td>
                </tr>
            @endforeach
        </table>
        <br>
        <div style="position: absolute; bottom: 0px;">
            Tembusan kepada:
            <table>
                <tr>
                    <td style="width: 20px;">1.</td>
                    <td>Ka. BAUK</td>
                </tr>
                @foreach ($fakultases as $fakultas)
                    <tr>
                        <td>{{ $loop->iteration + 1 }}.</td>
                        <td>Ka. Prodi di {{ $fakultas->nama }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>{{ count($fakultases) + 2 }}.</td>
                    <td>Dosen yang bersangkutan</td>
                </tr>
                <tr>
                    <td>{{ count($fakultases) + 3 }}.</td>
                    <td>Arsip</td>
                </tr>
            </table>
        </div>
    @endif

    @if (count($proposals->where('jenis', 'pengabdian')))
        <!-- Page Break -->
        <div class="page-break"></div>
        <!-- Page Break -->

        <span style="top: -30px; position: fixed; opacity: 50%; font-size: 12px;">Lampiran Surat
            {{ $jadwal->nomor }}</span>
        <div style="text-align: center;">
            <span style="font-size: 16px; font-weight: bold; display: block; margin-bottom: 6px;">
                PRESENTATOR DAN REVIEWER
                <br>
                KEGIATAN PENGABDIAN KEPADA MASYARAKAT
            </span>
        </div>
        <br>
        <table class="table" cellspacing="0" cellpadding="8">
            <tr>
                <th class="th" style="width: 20px; text-align: center;">NO</th>
                <th class="th" style="width: 140px; text-align: center;">JADWAL</th>
                <th class="th" style="width: 140px; text-align: center;">PROGRAM STUDI</th>
                <th class="th" style="width: 200px; text-align: center;">TIM</th>
                <th class="th" style="text-align: center;">REVIEWER</th>
            </tr>
            @foreach ($proposals->where('jenis', 'pengabdian') as $pengabdian)
                <tr>
                    <td class="td" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td class="td">
                        {{ Carbon\Carbon::parse($pengabdian->tanggal)->translatedFormat('l, d F Y') }}
                        <br>
                        {{ $pengabdian->jam }} WIB - Selesai
                    </td>
                    <td class="td">{{ $pengabdian->user->prodi->nama }}</td>
                    <td class="td">
                        <strong>Ketua Peneliti:</strong>
                        <br>
                        {{ $pengabdian->user->nama }}
                        <br>
                        <strong>Anggota:</strong>
                        @if (count($pengabdian->personels))
                            <ol style="padding: 0px 18px; margin: 0px;">
                                @foreach ($pengabdian->personels as $personel)
                                    <li>{{ $personel->user->nama }}</li>
                                @endforeach
                            </ol>
                        @else
                            -
                        @endif
                    </td>
                    <td class="td">{{ $pengabdian->peninjau->nama }}</td>
                </tr>
            @endforeach
        </table>
        <br>
        <div style="position: absolute; bottom: 0px;">
            Tembusan kepada:
            <table>
                <tr>
                    <td style="width: 20px;">1.</td>
                    <td>Ka. BAUK</td>
                </tr>
                @foreach ($fakultases as $fakultas)
                    <tr>
                        <td>{{ $loop->iteration + 1 }}.</td>
                        <td>Ka. Prodi di {{ $fakultas->nama }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>{{ count($fakultases) + 2 }}.</td>
                    <td>Dosen yang bersangkutan</td>
                </tr>
                <tr>
                    <td>{{ count($fakultases) + 3 }}.</td>
                    <td>Arsip</td>
                </tr>
            </table>
        </div>
    @endif
    <br><br>
    <div style="text-align: right">
        <div style="display: inline-flex; text-align: left;">
            Kepala LPPM
            <br>
            Universitas Bhamada Slawi
            <br><br><br><br><br>
            <span style="text-decoration: underline;">{{ $ketua->nama }}</span>
            <br>
            NIPY: {{ $ketua->nipy }}
        </div>
    </div>
</body>

</html>
