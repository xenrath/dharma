<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
            text-align: justify;
            text-justify: inter-word;
        }

        body {
            padding: 0px;
            font-size: 14px;
            line-height: 1.2;
        }

        .logo {
            width: 100px;
            position: absolute;
        }

        .header {
            margin-left: 100px;
            height: 100px;
        }

        .header .h1 {
            font-size: 24px;
            font-weight: bold;
            display: block;
            text-align: center;
            text-justify: none;
        }

        .header .h2 {
            font-size: 16px;
            font-weight: bold;
            display: block;
            text-align: center;
            text-justify: none;
        }

        .header .p {
            font-size: 14px;
            display: block;
            text-align: center;
            text-justify: none;
        }

        .h1-title {
            font-size: 16px;
            font-weight: bold;
            display: block;
            text-align: center;
            text-justify: none;
        }

        .h1-num {
            font-size: 14px;
            display: block;
            text-align: center;
            text-justify: none;
        }

        .h1-sm {
            font-size: 14px;
            font-weight: bold;
            display: block;
            text-align: center;
            text-justify: none;
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

        .table .td-sm {
            border: 1px solid black;
            text-align: center;
            vertical-align: middle;
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

        .ttd-p {
            text-align: center;
            text-justify: none;
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
    <div style="text-align: center;">
        <div style="margin-bottom: 10px;">
            <u class="h1-title">SURAT PERJANJIAN KERJASAMA</u>
            <span class="h1-num">Nomor: 033/Univ-Bhamada/LPPM/MoU/II/2023</span>
        </div>
        <div style="margin-bottom: 10px;">
            <span class="h1-title">Tentang</span>
        </div>
        <div style="margin-bottom: 10px;">
            <span class="h1-title">KEGIATAN {{ strtoupper($jenis) }}</span>
        </div>
        <span class="h1-title">"{{ $proposal->judul }}"</span>
    </div>
    <br>
    <span style="display: block; margin-bottom: 10px;">
        Pada hari ini, <strong>{{ ucfirst($hari) }}</strong> tanggal <strong>{{ ucwords($tanggal) }}</strong> bulan
        <strong>{{ ucfirst($bulan) }}</strong> tahun
        <strong>{{ ucwords($tahun) }}</strong>, bertempat di Universitas Bhamada Slawi, yang bertanda tangan di bawah
        ini:
    </span>
    <table style="margin-bottom: 10px;">
        <tr>
            <td style="width: 20px;">I.</td>
            <td style="width: 48px; vertical-align: top;">Nama</td>
            <td style="width: 8px;">:</td>
            <td><strong>{{ $ketua->nama }}</strong></td>
        </tr>
        <tr>
            <td></td>
            <td style="vertical-align: top;">NIPY</td>
            <td>:</td>
            <td>{{ $ketua->nipy }}</td>
        </tr>
        <tr>
            <td></td>
            <td style="vertical-align: top;">Jabatan</td>
            <td>:</td>
            <td>Kepala Lembaga Penelitian dan Pengabdian (LPPM) Universitas Bhamada Slawi</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">Dalam hal ini bertindak untuk dan atas nama Lembaga Penelitian dan Pengabdian (LPPM)
                Universitas Bhamada Slawi, yang selanjutnya disebut sebagai <strong>PIHAK PERTAMA</strong></td>
        </tr>
    </table>
    <table style="margin-bottom: 10px;">
        <tr>
            <td style="width: 20px;">II.</td>
            <td style="width: 48px; vertical-align: top;">Nama</td>
            <td style="width: 8px;">:</td>
            <td><strong>{{ $dosen->nama }}</strong></td>
        </tr>
        <tr>
            <td></td>
            <td style="vertical-align: top;">NIPY</td>
            <td>:</td>
            <td>{{ $dosen->nipy }}</td>
        </tr>
        <tr>
            <td></td>
            <td style="vertical-align: top;">Jabatan</td>
            <td>:</td>
            <td>Ketua Pelaksana {{ $jenis }} Prodi {{ $dosen->prodi->nama }}
                {{ $dosen->prodi->fakultas->nama }} Universitas Bhamada Slawi</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">Dalam hal ini bertindak untuk dan atas nama Prodi {{ $dosen->prodi->nama }}
                {{ $dosen->prodi->fakultas->nama }} Universitas Bhamada Slawi, yang selanjutnya disebut sebagai
                <strong>PIHAK KEDUA</strong>
            </td>
        </tr>
    </table>
    <span style="display: block;">
        Dengan ini <strong>PIHAK PERTAMA</strong> dan <strong>PIHAK KEDUA</strong> telah sepakat mengadakan perjanjian
        kerjasama dalam rangka pelaksanaan kegiatan {{ $jenis }} bagi dosen Universitas Bhamada Slawi
        dengan berdasarkan pada:
    </span>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">1.</td>
            <td>Undang-undang Nomor 20 tahun 2003 tentang Sistem Pendidikan Nasional;</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">2.</td>
            <td>Undang-undang Nomor 12 tahun 2012 tentang Pendidikan Tinggi;</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">3.</td>
            <td>Undang-undang Nomor 14 tahun 2005 tentang Guru dan Dosen;</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">4.</td>
            <td>Permendikbud RI Nomor 49 tahun 2014 tentang Standar Nasional Perguruan Tinggi;</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">5.</td>
            <td>Permenpan RI Nomor 46 tahun 2013 tentang Jabatan Fungsional Dosen;</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">6.</td>
            <td>
                Surat Keputusan Menteri Pendidikan, Kebudayaan, Riset dan Teknologi Nomor 325/E/O/2021 tentang Izin
                Perubahan Bentuk Sekolah Tinggi Ilmu Kesehatan Bhakti Mandala Husada Slawi di Kabupaten Tegal menjadi
                Universitas Bhamada Slawi di Kabupaten Tegal Provinsi Jawa Tengah yang Diselenggarakan oleh Yayasan
                Pendidikan Tri Sanja Husada;
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">7.</td>
            <td>Statuta Universitas Bhamada Slawi;</td>
        </tr>
    </table>
    <span style="display: block;">
        Perjanjian ini ditetapkan dan dilaksanakan dengan ketentuan dan persyaratan
        sebagaimana diatur dan ditetapkan dalam pasal-pasal sebagai berikut:
    </span>
    <div class="hal-ttd">
        <div style="position: absolute; bottom: 0px; text-align: center; width: 100%">
            <span style="font-size: 12px;">Halaman <strong>1</strong> dari <strong>4</strong></span>
        </div>
        <div style="position: absolute; bottom: 0px; right: 0px;">
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="td-sm" style="width: 100px;">
                        <span style="font-size: 8px;">PIHAK PERTAMA</span>
                    </td>
                    <td class="td-sm" style="width: 100px;">
                        <span style="font-size: 8px;">PIHAK KEDUA</span>
                    </td>
                </tr>
                <tr>
                    <td class="td-sm">
                        <img src="{{ public_path('storage/uploads/asset/check-square-regular.svg') }}"
                            alt="PIHAK PERTAMA" style="height: 16px; padding: 10px;">
                    </td>
                    <td class="td-sm">
                        <img src="{{ public_path('storage/uploads/asset/check-square-regular.svg') }}"
                            alt="PIHAK KEDUA" style="height: 16px; padding: 10px;">
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Page Break -->
    <div class="page-break"></div>
    <!-- Page Break -->

    <!-- BAB I -->
    <div style="text-align: center;">
        <span class="h1-sm">BAB I</span>
        <span class="h1-sm">KETENTUAN UMUM</span>
    </div>
    <!-- Pasal 1 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 1</span>
    </div>
    <span style="display: block;">
        Dalam perjanjian ini yang dimaksud dengan:
    </span>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">1.</td>
            <td>
                Universitas Bhamada Slawi adalah lembaga pendidikan yang diselenggarakan oleh Yayasan Pendidikan Tri
                Sanja Husada (YPTSH) Slawi sebagai sarana untuk mencetak lulusan yang berakhlak mulia, berjiwa
                pancasila, berkemampuan ilmu pengetahuan, teknologi, dan atau seni, serta wirausaha.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">2.</td>
            <td>Rektor adalah pimpinan tertinggi di Universitas Bhamada sebagai penanggung jawab pelaksanaan pendidikan.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">3.</td>
            <td>Pendidikan adalah usaha sadar yang terencana untuk mewujudkan suasana belajar dan proses pembelajaran
                agar peserta didik secara aktif mengembangkan potensi dirinya.</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">4.</td>
            <td>Kepala LPPM adalah koordinator seluruh kegiatan penelitian dan pengabdian kepada masyarakat.</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">5.</td>
            <td>Dosen adalah tenaga pendidikan atau kependidikan pada perguruan tinggi yang khusus diangkat dengan tugas
                utama mengajar.</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">6.</td>
            <td>Ketua pelaksana adalah koordinator dalam melakukan kegiatan {{ $jenis }}.
            </td>
        </tr>
    </table>
    <br>
    <!-- BAB II -->
    <div style="text-align: center;">
        <span class="h1-sm">BAB II</span>
        <span class="h1-sm">DASAR DAN TUJUAN PERJANJIAN KERJASAMA</span>
    </div>
    <!-- Pasal 2 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 2</span>
    </div>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">1.</td>
            <td colspan="2">Dasar perjanjian kerjasama:</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;"></td>
            <td style="width: 20px; vertical-align: top;">a.</td>
            <td>
                Perjanjian kerjasama ini disusun atas dasar kesamaan tujuan, kepentingan, hak dan kewajiban dari
                masing-masing pihak sesuai dengan ketentuan yang ditetapkan dalam perjanjian kerjasama ini.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;"></td>
            <td style="width: 20px; vertical-align: top;">b.</td>
            <td>
                Perjanjian kerjasama ini disusun dengan semangat kerjasama dan saling menghormati.
            </td>
        </tr>
    </table>
    <!-- Pasal 3 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 3</span>
    </div>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">2.</td>
            <td colspan="2">Perjanjian Kerjasama ini bertujuan:</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;"></td>
            <td style="width: 20px; vertical-align: top;">a.</td>
            <td>
                Untuk mengikat kedua belah pihak dan mengatur segala aspek penggunaan biaya untuk kepentingan
                pelaksanaan {{ $jenis }}.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;"></td>
            <td style="width: 20px; vertical-align: top;">b.</td>
            <td>
                Meningkatkan pengetahuan dan ketrampilan <strong>PIHAK KEDUA</strong> melalui pelaksanaan
                {{ $jenis }}.
            </td>
        </tr>
    </table>
    <br>
    <!-- BAB III -->
    <div style="text-align: center;">
        <span class="h1-sm">BAB III</span>
        <span class="h1-sm">HAK DAN KEWAJIBAN</span>
    </div>
    <!-- Pasal 4 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 4</span>
    </div>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">1.</td>
            <td colspan="2"><strong>PIHAK PERTAMA</strong> berhak:</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;"></td>
            <td style="width: 20px; vertical-align: top;">a.</td>
            <td>
                Memonitoring, mengatur dan memberikan sanksi kepada <strong>PIHAK KEDUA</strong> apabila tidak memenuhi
                pernyataan dalam pasal-pasal perjanjian ini.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;"></td>
            <td style="width: 20px; vertical-align: top;">b.</td>
            <td>
                Menerima tugas dan mengkoordinir pelaksanaan {{ $jenis }}.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">2.</td>
            <td colspan="2"><strong>PIHAK KEDUA</strong> berhak:</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;"></td>
            <td style="width: 20px; vertical-align: top;">a.</td>
            <td>
                Mengusulkan kebutuhan dokumen untuk menyelesaikan kegiatan {{ $jenis }} kepada
                <strong>PIHAK PERTAMA</strong>.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;"></td>
            <td style="width: 20px; vertical-align: top;">b.</td>
            <td>
                Mendapat dokumen administrasi yang dibutuhkan dalam kegiatan {{ $jenis }} dari
                <strong>PIHAK PERTAMA</strong>.
            </td>
        </tr>
    </table>
    <!-- Pasal 5 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 5</span>
    </div>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">1.</td>
            <td>
                <strong>PIHAK PERTAMA</strong> wajib mengeluarkan dan memberikan biaya kegiatan {{ $jenis }},
                kepada
                <strong>PIHAK KEDUA</strong> sesuai dengan proposal yang telah disetujui oleh Wakil
                Rektor I Bidang Akademik.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">2.</td>
            <td>
                <strong>PIHAK KEDUA</strong> wajib bertangung jawab dalam kegiatan {{ $jenis }} yang
                diusulkan dan menyelesaikan seluruh administrasi yang dibutuhkan kepada <strong>PIHAK PERTAMA</strong>.
            </td>
        </tr>
    </table>

    <!-- Hal TTD -->
    <div class="hal-ttd">
        <div style="position: absolute; bottom: 0px; text-align: center; width: 100%">
            <span style="font-size: 12px;">Halaman <strong>2</strong> dari <strong>4</strong></span>
        </div>
        <div style="position: absolute; bottom: 0px; right: 0px;">
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="td-sm" style="width: 100px;">
                        <span style="font-size: 8px;">PIHAK PERTAMA</span>
                    </td>
                    <td class="td-sm" style="width: 100px;">
                        <span style="font-size: 8px;">PIHAK KEDUA</span>
                    </td>
                </tr>
                <tr>
                    <td class="td-sm">
                        <img src="{{ public_path('storage/uploads/asset/check-square-regular.svg') }}"
                            alt="PIHAK PERTAMA" style="height: 16px; padding: 10px;">
                    </td>
                    <td class="td-sm">
                        <img src="{{ public_path('storage/uploads/asset/check-square-regular.svg') }}"
                            alt="PIHAK KEDUA" style="height: 16px; padding: 10px;">
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Page Break -->
    <div class="page-break"></div>
    <!-- Page Break -->

    <!-- BAB IV -->
    <div style="text-align: center;">
        <span class="h1-sm">BAB IV</span>
        <span class="h1-sm">JANGKA WAKTU</span>
    </div>
    <!-- Pasal 6 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 6</span>
    </div>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">1.</td>
            <td>
                <strong>PIHAK KEDUA</strong> harus melaksanakan {{ $jenis }} sesuai dengan rencana waktu
                yang telah disetujui.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">2.</td>
            <td>
                <strong>PIHAK KEDUA</strong> harus menyelesaikan seluruh Pelaksanaan {{ $jenis }}
                selambat-lambatnya hingga tahun akademik berakhir, terhitung sejak perjanjian ini ditandatangani.
            </td>
        </tr>
    </table>
    <br>
    <!-- BAB V -->
    <div style="text-align: center;">
        <span class="h1-sm">BAB V</span>
        <span class="h1-sm">PENYERAHAN HASIL PEKERJAAN</span>
    </div>
    <!-- Pasal 7 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 7</span>
    </div>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">1.</td>
            <td colspan="2">
                <strong>PIHAK KEDUA</strong> harus menyerahkan laporan Kemajuan Pelaksanaan {{ $jenis }} sesuai
                dengan Panduan Penelitian dan Pengabdian kepada Mayarakat yang diterbitan oleh Direktorat Jenderal
                Pendidikan Tinggi, Riset dan Teknologi tahun 2021, selambat-lambatnya 1 (satu) bulan setelah pembayaran
                tahap I diterima.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">2.</td>
            <td colspan="2">
                <strong>PIHAK KEDUA</strong> harus menyerahkan Laporan Akhir hasil {{ $jenis }} kepada
                <strong>PIHAK PERTAMA</strong> sebanyak 2 (dua) eksemplar, disertai dengan ringkasan (abstrak) dalam
                bahasa Indonesia sebanyak 500 kata dan artikel publikasi ilmiah Pelaksanaan {{ $jenis }} yang
                terpisah dari laporan.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">3.</td>
            <td colspan="2">
                Laporan Akhir Hasil pelaksanaan {{ $jenis }} tersebut pada pasal 7 ayat
                1 dan 2 harus memenuhi ketentuan sebagai berikut:
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;"></td>
            <td style="width: 20px; vertical-align: top;">a.</td>
            <td>Bentuk/ukuran kuarto (A4)</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;"></td>
            <td style="width: 20px; vertical-align: top;">b.</td>
            <td>Warna sampul (cover) Hijau Muda</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;"></td>
            <td style="width: 20px; vertical-align: top;">c.</td>
            <td>Dijilid soft cover</td>
        </tr>
    </table>
    <br>
    <!-- BAB VI -->
    <div style="text-align: center;">
        <span class="h1-sm">BAB VI</span>
        <span class="h1-sm">BIAYA DAN CARA PEMBAYARAN</span>
    </div>
    <!-- Pasal 8 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 8</span>
    </div>
    <span style="display: block;">
        Biaya pelaksanaan kegiatan tersebut termasuk pajak dan pengeluaran–pengeluaran lain yang terkait dengan
        Pelaksanaan {{ $jenis }} seluruhnya sebesar @rupiah($proposal->dana_setuju),- ({{ $dana_terbilang }}) yang
        dibebankan pada
        <strong>PIHAK PERTAMA</strong> sesuai Anggaran LPPM Universitas Bhamada TA {{ $tahun_akademik }}.
    </span>
    <!-- Pasal 9 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 9</span>
    </div>
    <span style="display: block;">
        Pembayaran Biaya Pelaksanaan kegiatan tersebut dalam pasal 8 dilakukan oleh <strong>PIHAK PERTAMA</strong>
        kepada <strong>PIHAK KEDUA</strong> secara bertahap sebagai berikut:
    </span>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">1.</td>
            <td>Tahap I sebesar 75% dari @rupiah($proposal->dana_setuju),- ({{ $dana_terbilang }}) yaitu @rupiah($tahap_pertama),-
                ({{ $tahap_pertama_terbilang }}) diberikan setelah penandatanganan perjanjian kerjasama ini.</td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">2.</td>
            <td>
                Tahap II sebesar 25% dari @rupiah($proposal->dana_setuju),- ({{ $dana_terbilang }}) yaitu @rupiah($tahap_kedua),-
                ({{ $tahap_kedua_terbilang }}) diberikan setelah <strong>PIHAK KEDUA</strong> menyerahkan Laporan Akhir
                Pelaksanaan {{ $jenis }} kepada <strong>PIHAK PERTAMA</strong> dengan disertai Berita
                Acara Serah Terima.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">3.</td>
            <td>
                Cara pembayaran diterimakan langsung kepada <strong>PIHAK KEDUA</strong>.
            </td>
        </tr>
    </table>
    <br>
    <!-- BAB VII -->
    <div style="text-align: center;">
        <span class="h1-sm">BAB VII</span>
        <span class="h1-sm">PERUBAHAN-PERUBAHAN</span>
    </div>
    <!-- Pasal 10 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 10</span>
    </div>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">1.</td>
            <td>
                Apabila <strong>PIHAK KEDUA</strong> karena satu atau lain hal bermaksud mengubah pelaksanaan
                {{ $jenis }} yang telah disepakati dalam Surat Perjanjian Kerjasama ini, <strong>PIHAK
                    KEDUA</strong> harus mengajukan permohonan perubahan tersebut kepada <strong>PIHAK PERTAMA</strong>.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">2.</td>
            <td>
                Perubahan pelaksanaan/mitra kerja/lokasi/jangka waktu Pelaksanaan {{ $jenis }} dapat
                dibenarkan apabila telah mendapatkan persetujuan lebih dahulu dari <strong>PIHAK PERTAMA</strong>.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">3.</td>
            <td>
                Dalam hal <strong>PIHAK KEDUA</strong> berhenti atau berhalangan dalam melaksanakan fungsi pada
                jabatannya sebelum Pelaksanaan Perjanjian ini selesai seluruhnya, maka <strong>PIHAK KEDUA</strong>
                wajib menyerahterimakan tanggungjawab tersebut kepada pejabat baru yang ditunjuk menggantikan.
            </td>
        </tr>
    </table>

    <!-- Hal TTD -->
    <div class="hal-ttd">
        <div style="position: absolute; bottom: 0px; text-align: center; width: 100%">
            <span style="font-size: 12px;">Halaman <strong>3</strong> dari <strong>4</strong></span>
        </div>
        <div style="position: absolute; bottom: 0px; right: 0px;">
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="td-sm" style="width: 100px;">
                        <span style="font-size: 8px;">PIHAK PERTAMA</span>
                    </td>
                    <td class="td-sm" style="width: 100px;">
                        <span style="font-size: 8px;">PIHAK KEDUA</span>
                    </td>
                </tr>
                <tr>
                    <td class="td-sm">
                        <img src="{{ public_path('storage/uploads/asset/check-square-regular.svg') }}"
                            alt="PIHAK PERTAMA" style="height: 16px; padding: 10px;">
                    </td>
                    <td class="td-sm">
                        <img src="{{ public_path('storage/uploads/asset/check-square-regular.svg') }}"
                            alt="PIHAK KEDUA" style="height: 16px; padding: 10px;">
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Page Break -->
    <div class="page-break"></div>
    <!-- Page Break -->

    <!-- BAB VIII -->
    <div style="text-align: center;">
        <span class="h1-sm">BAB VIII</span>
        <span class="h1-sm">SANKSI</span>
    </div>
    <!-- Pasal 11 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 11</span>
    </div>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">1.</td>
            <td>
                Apabila sampai batas Pelaksanaan {{ $jenis }} ini <strong>PIHAK KEDUA</strong> belum
                juga menyerahkan hasil Pelaksanaan seluruhnya kepada <strong>PIHAK PERTAMA</strong>, maka <strong>PIHAK
                    KEDUA</strong> dikenakan denda sebesar 1% (satu persen) setiap hari keterlambatan terhitung dari
                tanggal jatuh tempo yang telah ditetapkan sampai setinggi–tingginya 5% (lima persen) dari nilai Surat
                Perjanjian Kerjasama {{ $jenis }}.
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">2.</td>
            <td>
                Apabila <strong>PIHAK KEDUA</strong> selaku penerima pembiayaan pelaksanaan {{ $jenis }}
                tidak mencairkan dana tersebut sampai batas waktu yang telah ditentukan serta melebihi tahun anggaran
                pada periode tersebut, maka seluruh biaya yang belum dicairkan dinyatakan hangus (tidak dapat dicairkan
                lagi).
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">3.</td>
            <td>
                Apabila <strong>PIHAK KEDUA</strong> terbukti tidak dapat melaksanakan pekerjaan sesuai Surat Perjanjian
                Kerjasama ini, maka <strong>PIHAK KEDUA</strong> wajib mengembalikan seluruh pembiayaan pelaksanaan
                {{ $jenis }} yang telah diterimakan kepada <strong>PIHAK PERTAMA</strong>
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">4.</td>
            <td>
                Apabila <strong>PIHAK KEDUA</strong> terbukti tidak dapat melaksanakan pekerjaan sesuai Surat Perjanjian
                Kerjasama ini, maka <strong>PIHAK KEDUA</strong> ditangguhkan untuk menjadi ketua pelaksana kegiatan
                penelitian dan pengabdian kepada masyarakat selama 3 tahun akademik berturut-turut
            </td>
        </tr>
    </table>
    <br>
    <!-- BAB IX -->
    <div style="text-align: center;">
        <span class="h1-sm">BAB IX</span>
        <span class="h1-sm">HAK CIPTA</span>
    </div>
    <!-- Pasal 12 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 12</span>
    </div>
    <span style="display: block;">
        Hak Cipta {{ $jenis }} tersebut berada pada <strong>PIHAK KEDUA</strong>, sedangkan untuk
        penggandaan/memperbanyak laporan hasil Pelaksanaan {{ $jenis }} atau laporan singkatnya adalah
        wewenang <strong>PIHAK PERTAMA</strong>.
    </span>
    <br>
    <!-- BAB X -->
    <div style="text-align: center;">
        <span class="h1-sm">BAB X</span>
        <span class="h1-sm">PENUTUP</span>
    </div>
    <!-- Pasal 13 -->
    <div style="text-align: center; margin: 8px 0px 4px 0px;">
        <span class="h1-sm">Pasal 13</span>
    </div>
    <table>
        <tr>
            <td style="width: 20px; vertical-align: top;">1.</td>
            <td>
                Segala sesuatu yang belum atau tidak termasuk dalam perjanjian ini akan ditentukan kemudian secara
                musyawarah
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">2.</td>
            <td>
                Tiap-tiap perubahan atau penambahanterhadap surat perjanjian ini dianggap sah/berlaku apabila dibuat dan
                ditandatangani oleh kedua belah pihak
            </td>
        </tr>
        <tr>
            <td style="width: 20px; vertical-align: top;">3.</td>
            <td>
                Surat perjanjian ini dibuat rangkap 2 (dua) dan bermaterai cukup, masing-masing pihak mendapatkan 1
                (satu) lembar dengan biaya materai dibebankan kepada <strong>PIHAK KEDUA</strong>.
            </td>
        </tr>
    </table>
    <br><br><br>
    <table style="width: 100%;" cellspacing="0" cellpadding="8">
        <tr>
            <td style="width: 50%;">
                <div class="layout-ttd">
                    <table>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                    <p class="ttd-p">
                        <strong>PIHAK KEDUA</strong>
                        <br>
                        <span>Ketua Pelaksana {{ ucwords($jenis) }},</span>
                    </p>
                    <br><br><br>
                    <p class="ttd-p">
                        <span style="text-decoration: underline">{{ $dosen->nama }}</span>
                        <br>
                        <span>NIPY: {{ $dosen->nipy }}</span>
                    </p>
                </div>
            </td>
            <td style="width: 50%; padding: 0px 16px; text-align: right;">
                <div class="layout-ttd">
                    <table cellspacing="1" cellpadding="1">
                        <tr>
                            <td style="width: 100px;">Ditetapkan di</td>
                            <td>:</td>
                            <td>Slawi</td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Pada tanggal</td>
                            <td>:</td>
                            <td>{{ Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
                        </tr>
                    </table>
                    <img src="{{ public_path('storage/uploads/asset/stempel.png') }}"
                        style="max-width: 140px; max-height: 140px; transform: rotate(-2deg); position: absolute; z-index: -1; right: 200px; margin-top: 20px; opacity: 0.7;"
                        alt="Stempel">
                    <p class="ttd-p">
                        <strong>PIHAK PERTAMA</strong>
                        <br>
                        <span>Kepala LPPM Universitas Bhamada Slawi,</span>
                    </p>
                    @if ($ketua->ttd)
                        <img src="{{ public_path('storage/uploads/' . $ketua->ttd) }}"
                            style="max-width: 120px; max-height: 120px;" alt="PIHAK PERTAMA">
                    @else
                        <br><br><br>
                    @endif
                    <p class="ttd-p">
                        <span style="text-decoration: underline">{{ $ketua->nama }}</span>
                        <br>
                        <span>NIPY: {{ $ketua->nipy }}</span>
                    </p>
                </div>
            </td>
        </tr>
    </table>
    <div class="hal-ttd">
        <div style="position: absolute; bottom: 0px; text-align: center; width: 100%">
            <span style="font-size: 12px;">Halaman <strong>4</strong> dari <strong>4</strong></span>
        </div>
        <div style="position: absolute; bottom: 0px; right: 0px;">
            <table class="table" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="td-sm" style="width: 100px;">
                        <span style="font-size: 8px;">PIHAK PERTAMA</span>
                    </td>
                    <td class="td-sm" style="width: 100px;">
                        <span style="font-size: 8px;">PIHAK KEDUA</span>
                    </td>
                </tr>
                <tr>
                    <td class="td-sm">
                        <img src="{{ public_path('storage/uploads/asset/check-square-regular.svg') }}"
                            alt="PIHAK PERTAMA" style="height: 16px; padding: 10px;">
                    </td>
                    <td class="td-sm">
                        <img src="{{ public_path('storage/uploads/asset/check-square-regular.svg') }}"
                            alt="PIHAK KEDUA" style="height: 16px; padding: 10px;">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
