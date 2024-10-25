<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Undangan Presentasi Proposal LP2M</title>
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
    <span class="tanggal">Slawi, {{ Carbon\Carbon::today()->translatedFormat('d F Y') }}</span>
    <br><br>
    <table>
        <tr>
            <td style="width: 80px;">Nomor</td>
            <td style="width: 15px;">:</td>
            <td>120.A/Univ-Bhamada/LPPM/VII/{{ Carbon\Carbon::today()->format('Y') }}</td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td>1 Bendel</td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td>Undangan Presentasi Proposal Penelitian dan Pengabdian Kepada Masyarakat</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2">Kepada Yth :</td>
        </tr>
        <tr>
            <td></td>
            <td>1.</td>
            <td>Fakultas Ilmu Kesehatan</td>
        </tr>
        <tr>
            <td></td>
            <td>2.</td>
            <td>Fakultas Ilmu Komputer</td>
        </tr>
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
                    pada Tahun Akademik
                    {{ Carbon\Carbon::today()->format('Y') }}/{{ Carbon\Carbon::today()->addYear()->format('Y') }} bagi
                    Dosen di lingkungan Universitas
                    Bhamada Slawi, kami
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
            <br>
            @if ($user->ttd)
                <img src="{{ public_path('storage/uploads/' . $user->ttd) }}"
                    style="max-width: 120px; max-height: 120px;" alt="PIHAK PERTAMA">
            @else
                <br><br><br>
            @endif
            <br>
            <span style="text-decoration: underline;">{{ $user->nama }}</span>
            <br>
            NIPY: {{ $user->nipy }}
        </div>
    </div>
    <div style="position: absolute; bottom: 0px;">
        Tembusan kepada:
        <table>
            <tr>
                <td style="width: 20px;">1.</td>
                <td>Ka. BAUK</td>
            </tr>
            <tr>
                <td>1.</td>
                <td>Ka. Prodi di Fakultas Ilmu Kesehatan</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Ka. Prodi di Fakultas Ilmu Komputer</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Dosen yang bersangkutan</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Arsip</td>
            </tr>
        </table>
    </div>
</body>

</html>
