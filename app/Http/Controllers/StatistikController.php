<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Hki;
use App\Models\JenisHki;
use App\Models\JenisJurnal;
use App\Models\JenisLuaran;
use App\Models\JenisPendanaan;
use App\Models\JenisPenelitian;
use App\Models\JenisPengabdian;
use App\Models\Jurnal;
use App\Models\Luaran;
use App\Models\Makalah;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index()
    {
        $penelitian = Penelitian::where('status', 'selesai')->count();
        $pengabdian = Pengabdian::where('status', 'selesai')->count();
        $jurnal = Jurnal::count();
        $buku = Buku::count();
        $makalah = Makalah::count();
        $hki = Hki::count();
        $luaran = Luaran::count();
        // 
        $data_prodis = Prodi::select('id', 'nama')->get();
        $prodis = array();
        foreach ($data_prodis as $prodi) {
            $jumlah_penelitian = Penelitian::where('status', 'selesai')->whereHas('user', function ($query) use ($prodi) {
                $query->where('prodi_id', $prodi->id);
            })->count();
            $jumlah_pengabdian = Pengabdian::where('status', 'selesai')->whereHas('user', function ($query) use ($prodi) {
                $query->where('prodi_id', $prodi->id);
            })->count();
            $jumlah_jurnal = Jurnal::whereHas('user', function ($query) use ($prodi) {
                $query->where('prodi_id', $prodi->id);
            })->count();
            $jumlah_buku = Buku::whereHas('user', function ($query) use ($prodi) {
                $query->where('prodi_id', $prodi->id);
            })->count();
            $jumlah_makalah = Makalah::whereHas('user', function ($query) use ($prodi) {
                $query->where('prodi_id', $prodi->id);
            })->count();
            $jumlah_hki = Hki::whereHas('user', function ($query) use ($prodi) {
                $query->where('prodi_id', $prodi->id);
            })->count();
            $jumlah_luaran = Luaran::whereHas('user', function ($query) use ($prodi) {
                $query->where('prodi_id', $prodi->id);
            })->count();
            array_push($prodis, array(
                'id' => $prodi->id,
                'nama' => $prodi->nama,
                'penelitian' => $jumlah_penelitian,
                'pengabdian' => $jumlah_pengabdian,
                'publikasi' => $jumlah_jurnal + $jumlah_buku + $jumlah_makalah + $jumlah_hki + $jumlah_luaran,
            ));
        }
        // 
        return view('statistik.index', compact(
            'penelitian',
            'pengabdian',
            'jurnal',
            'buku',
            'makalah',
            'hki',
            'luaran',
            'prodis'
        ));
    }

    public function penelitian(Request $request)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $penelitians = Penelitian::where([
                ['status', 'selesai'],
                ['tahun', $tahun],
            ])
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'jenis_pendanaan_id',
                    'jenis_penelitian_id',
                    'dana_setuju',
                    'mahasiswas',
                )
                ->with('user:id,nama')
                ->with('jenis_pendanaan:id,nama')
                ->with('jenis_penelitian:id,nama')
                ->with('personels', function ($query) {
                    $query->select('penelitian_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $penelitians = Penelitian::where('status', 'selesai')
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'jenis_pendanaan_id',
                    'jenis_penelitian_id',
                    'dana_setuju',
                    'mahasiswas',
                )
                ->with('user:id,nama')
                ->with('jenis_pendanaan:id,nama')
                ->with('jenis_penelitian:id,nama')
                ->with('personels', function ($query) {
                    $query->select('penelitian_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Penelitian::where('status', 'selesai')->orderByDesc('tahun')->pluck('tahun')->toArray());
        // 
        $data_prodis = Prodi::select('id', 'nama')->get();
        $prodis = array();
        $prodi_label = array();
        $prodi_data = array();
        foreach ($data_prodis as $prodi) {
            if ($tahun) {
                $jumlah = Penelitian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                ])->whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            } else {
                $jumlah = Penelitian::where('status', 'selesai')->whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            }
            array_push($prodis, array('id' => $prodi->id, 'nama' => $prodi->nama, 'jumlah' => $jumlah));
            array_push($prodi_label, $prodi->nama == "D4 Keselamatan dan Kesehatan Kerja" ? "D4 K3" : $prodi->nama);
            array_push($prodi_data, $jumlah);
        }
        // 
        $data_jenis_penelitians = JenisPenelitian::get();
        $jenis_penelitian_label = array();
        $jenis_penelitian_data = array();
        foreach ($data_jenis_penelitians as $jenis_penelitian) {
            if ($tahun) {
                $jumlah = Penelitian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                    ['jenis_penelitian_id', $jenis_penelitian->id]
                ])->count();
            } else {
                $jumlah = Penelitian::where([
                    ['status', 'selesai'],
                    ['jenis_penelitian_id', $jenis_penelitian->id],
                ])->count();
            }
            array_push($jenis_penelitian_label, $jenis_penelitian->nama);
            array_push($jenis_penelitian_data, $jumlah);
        }
        // 
        $data_jenis_pendanaans = JenisPendanaan::get();
        $jenis_pendanaan_label = array();
        $jenis_pendanaan_data = array();
        foreach ($data_jenis_pendanaans as $jenis_pendanaan) {
            if ($tahun) {
                $jumlah = Penelitian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                    ['jenis_pendanaan_id', $jenis_pendanaan->id]
                ])->count();
            } else {
                $jumlah = Penelitian::where([
                    ['status', 'selesai'],
                    ['jenis_pendanaan_id', $jenis_pendanaan->id],
                ])->count();
            }
            array_push($jenis_pendanaan_label, $jenis_pendanaan->nama);
            array_push($jenis_pendanaan_data, $jumlah);
        }
        // 
        return view('statistik.penelitian', compact(
            'penelitians',
            'tahuns',
            'prodis',
            'jenis_penelitian_label',
            'jenis_penelitian_data',
            'jenis_pendanaan_label',
            'jenis_pendanaan_data',
            'prodi_label',
            'prodi_data',
        ));
    }

    public function pengabdian(Request $request)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $pengabdians = Pengabdian::where([
                ['status', 'selesai'],
                ['tahun', $tahun],
            ])
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $pengabdians = Pengabdian::where('status', 'selesai')
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Pengabdian::where('status', 'selesai')->orderByDesc('tahun')->pluck('tahun')->toArray());
        // 
        $data_prodis = Prodi::select('id', 'nama')->get();
        $prodis = array();
        $prodi_label = array();
        $prodi_data = array();
        foreach ($data_prodis as $prodi) {
            if ($tahun) {
                $jumlah = Pengabdian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                ])->whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            } else {
                $jumlah = Pengabdian::where('status', 'selesai')->whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            }
            array_push($prodis, array('id' => $prodi->id, 'nama' => $prodi->nama, 'jumlah' => $jumlah));
            array_push($prodi_label, $prodi->nama == "D4 Keselamatan dan Kesehatan Kerja" ? "D4 K3" : $prodi->nama);
            array_push($prodi_data, $jumlah);
        }
        // 
        $data_jenis_pengabdians = JenisPengabdian::get();
        $jenis_pengabdian_label = array();
        $jenis_pengabdian_data = array();
        foreach ($data_jenis_pengabdians as $jenis_pengabdian) {
            if ($tahun) {
                $jumlah = Pengabdian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                    ['jenis_pengabdian_id', $jenis_pengabdian->id]
                ])->count();
            } else {
                $jumlah = Pengabdian::where([
                    ['status', 'selesai'],
                    ['jenis_pengabdian_id', $jenis_pengabdian->id],
                ])->count();
            }
            array_push($jenis_pengabdian_label, $jenis_pengabdian->nama);
            array_push($jenis_pengabdian_data, $jumlah);
        }
        // 
        $data_jenis_pendanaans = JenisPendanaan::get();
        $jenis_pendanaan_label = array();
        $jenis_pendanaan_data = array();
        foreach ($data_jenis_pendanaans as $jenis_pendanaan) {
            if ($tahun) {
                $jumlah = Pengabdian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                    ['jenis_pendanaan_id', $jenis_pendanaan->id]
                ])->count();
            } else {
                $jumlah = Pengabdian::where([
                    ['status', 'selesai'],
                    ['jenis_pendanaan_id', $jenis_pendanaan->id],
                ])->count();
            }
            array_push($jenis_pendanaan_label, $jenis_pendanaan->nama);
            array_push($jenis_pendanaan_data, $jumlah);
        }
        // 
        return view('statistik.pengabdian', compact(
            'pengabdians',
            'tahuns',
            'prodis',
            'jenis_pengabdian_label',
            'jenis_pengabdian_data',
            'jenis_pendanaan_label',
            'jenis_pendanaan_data',
            'prodi_label',
            'prodi_data',
        ));
    }

    public function jurnal(Request $request)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $jurnals = Jurnal::where('tahun', $tahun)
                ->select(
                    'id',
                    'user_id',
                    'jenis_jurnal_id',
                    'tahun',
                    'nama',
                    'judul',
                    'issn',
                    'volume',
                    'nomor',
                    'halaman_awal',
                    'halaman_akhir',
                    'url',
                    'mahasiswas',
                )
                ->with('user:id,nama')
                ->with('jenis_jurnal:id,nama')
                ->with('jurnal_personels', function ($query) {
                    $query->select('jurnal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $jurnals = Jurnal::select(
                'id',
                'user_id',
                'jenis_jurnal_id',
                'tahun',
                'nama',
                'judul',
                'issn',
                'volume',
                'nomor',
                'halaman_awal',
                'halaman_akhir',
                'url',
                'mahasiswas',
            )
                ->with('user:id,nama')
                ->with('jenis_jurnal:id,nama')
                ->with('jurnal_personels', function ($query) {
                    $query->select('jurnal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Jurnal::orderByDesc('tahun')->pluck('tahun')->toArray());
        // 
        $data_prodis = Prodi::select('id', 'nama')->get();
        $prodis = array();
        $prodi_label = array();
        $prodi_data = array();
        foreach ($data_prodis as $prodi) {
            if ($tahun) {
                $jumlah = Jurnal::where('tahun', $tahun)->whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            } else {
                $jumlah = Jurnal::whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            }
            array_push($prodis, array('id' => $prodi->id, 'nama' => $prodi->nama, 'jumlah' => $jumlah));
            array_push($prodi_label, $prodi->nama == "D4 Keselamatan dan Kesehatan Kerja" ? "D4 K3" : $prodi->nama);
            array_push($prodi_data, $jumlah);
        }
        // 
        $data_jenis_jurnals = JenisJurnal::get();
        $jenis_jurnal_label = array();
        $jenis_jurnal_data = array();
        foreach ($data_jenis_jurnals as $jenis_jurnal) {
            if ($tahun) {
                $jumlah = Jurnal::where([
                    ['tahun', $tahun],
                    ['jenis_jurnal_id', $jenis_jurnal->id]
                ])->count();
            } else {
                $jumlah = Jurnal::where('jenis_jurnal_id', $jenis_jurnal->id)->count();
            }
            array_push($jenis_jurnal_label, $jenis_jurnal->nama);
            array_push($jenis_jurnal_data, $jumlah);
        }
        // 
        return view('statistik.jurnal', compact(
            'jurnals',
            'tahuns',
            'prodis',
            'jenis_jurnal_label',
            'jenis_jurnal_data',
            'prodi_label',
            'prodi_data',
        ));
    }

    public function buku(Request $request)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $bukus = Buku::where('tahun', $tahun)
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'isbn',
                    'jumlah',
                    'penerbit',
                )
                ->with('user:id,nama')
                ->with('buku_personels', function ($query) {
                    $query->select('buku_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $bukus = Buku::select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'isbn',
                'jumlah',
                'penerbit',
            )
                ->with('user:id,nama')
                ->with('buku_personels', function ($query) {
                    $query->select('buku_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Buku::orderByDesc('tahun')->pluck('tahun')->toArray());
        // 
        $data_prodis = Prodi::select('id', 'nama')->get();
        $prodis = array();
        $prodi_label = array();
        $prodi_data = array();
        foreach ($data_prodis as $prodi) {
            if ($tahun) {
                $jumlah = Buku::where('tahun', $tahun)->whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            } else {
                $jumlah = Buku::whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            }
            array_push($prodis, array('id' => $prodi->id, 'nama' => $prodi->nama, 'jumlah' => $jumlah));
            array_push($prodi_label, $prodi->nama == "D4 Keselamatan dan Kesehatan Kerja" ? "D4 K3" : $prodi->nama);
            array_push($prodi_data, $jumlah);
        }
        // 
        return view('statistik.buku', compact(
            'bukus',
            'tahuns',
            'prodis',
            'prodi_label',
            'prodi_data',
        ));
    }

    public function makalah(Request $request)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $makalahs = Makalah::where('tahun', $tahun)
                ->select(
                    'id',
                    'user_id',
                    'tingkat',
                    'tahun',
                    'judul',
                    'forum',
                    'institusi',
                    'tanggal_awal',
                    'tanggal_akhir',
                    'tempat',
                    'status',
                )
                ->with('user:id,nama')
                ->with('makalah_personels', function ($query) {
                    $query->select('makalah_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $makalahs = Makalah::select(
                'id',
                'user_id',
                'tingkat',
                'tahun',
                'judul',
                'forum',
                'institusi',
                'tanggal_awal',
                'tanggal_akhir',
                'tempat',
                'status',
            )
                ->with('user:id,nama')
                ->with('makalah_personels', function ($query) {
                    $query->select('makalah_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Makalah::orderByDesc('tahun')->pluck('tahun')->toArray());
        // 
        $data_prodis = Prodi::select('id', 'nama')->get();
        $prodis = array();
        $prodi_label = array();
        $prodi_data = array();
        foreach ($data_prodis as $prodi) {
            if ($tahun) {
                $jumlah = Makalah::where('tahun', $tahun)->whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            } else {
                $jumlah = Makalah::whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            }
            array_push($prodis, array('id' => $prodi->id, 'nama' => $prodi->nama, 'jumlah' => $jumlah));
            array_push($prodi_label, $prodi->nama == "D4 Keselamatan dan Kesehatan Kerja" ? "D4 K3" : $prodi->nama);
            array_push($prodi_data, $jumlah);
        }
        // 
        $data_tingkat_makalahs = array('regional', 'nasional', 'internasional');
        $tingkat_makalah_label = array();
        $tingkat_makalah_data = array();
        foreach ($data_tingkat_makalahs as $tingkat_makalah) {
            if ($tahun) {
                $jumlah = Makalah::where([
                    ['tahun', $tahun],
                    ['tingkat', $tingkat_makalah]
                ])->count();
            } else {
                $jumlah = Makalah::where('tingkat', $tingkat_makalah)->count();
            }
            array_push($tingkat_makalah_label, ucfirst($tingkat_makalah));
            array_push($tingkat_makalah_data, $jumlah);
        }
        // 
        $data_status_makalahs = array('biasa', 'spesial');
        $status_makalah_label = array();
        $status_makalah_data = array();
        foreach ($data_status_makalahs as $status_makalah) {
            if ($tahun) {
                $jumlah = Makalah::where([
                    ['tahun', $tahun],
                    ['status', $status_makalah]
                ])->count();
            } else {
                $jumlah = Makalah::where('status', $status_makalah)->count();
            }
            array_push($status_makalah_label, $status_makalah == 'biasa' ? 'Pemakalah Biasa' : 'Invited / Keynote Speaker');
            array_push($status_makalah_data, $jumlah);
        }
        // 
        return view('statistik.makalah', compact(
            'makalahs',
            'tahuns',
            'prodis',
            'prodi_label',
            'prodi_data',
            'tingkat_makalah_label',
            'tingkat_makalah_data',
            'status_makalah_label',
            'status_makalah_data',
        ));
    }

    public function hki(Request $request)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $hkis = Hki::where('tahun', $tahun)
                ->select(
                    'id',
                    'user_id',
                    'jenis_hki_id',
                    'tahun',
                    'judul',
                    'nomor',
                    'pendaftaran',
                    'status',
                )
                ->with('user:id,nama')
                ->with('jenis_hki:id,nama')
                ->with('hki_personels', function ($query) {
                    $query->select('hki_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $hkis = Hki::select(
                'id',
                'user_id',
                'jenis_hki_id',
                'tahun',
                'judul',
                'nomor',
                'pendaftaran',
                'status',
            )
                ->with('user:id,nama')
                ->with('jenis_hki:id,nama')
                ->with('hki_personels', function ($query) {
                    $query->select('hki_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Hki::orderByDesc('tahun')->pluck('tahun')->toArray());
        // 
        $data_prodis = Prodi::select('id', 'nama')->get();
        $prodis = array();
        $prodi_label = array();
        $prodi_data = array();
        foreach ($data_prodis as $prodi) {
            if ($tahun) {
                $jumlah = Hki::where('tahun', $tahun)->whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            } else {
                $jumlah = Hki::whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            }
            array_push($prodis, array('id' => $prodi->id, 'nama' => $prodi->nama, 'jumlah' => $jumlah));
            array_push($prodi_label, $prodi->nama == "D4 Keselamatan dan Kesehatan Kerja" ? "D4 K3" : $prodi->nama);
            array_push($prodi_data, $jumlah);
        }
        // 
        $data_jenis_hkis = JenisHki::select('id', 'nama')->get();
        $jenis_hki_label = array();
        $jenis_hki_data = array();
        foreach ($data_jenis_hkis as $jenis_hki) {
            if ($tahun) {
                $jumlah = Hki::where([
                    ['tahun', $tahun],
                    ['jenis_hki_id', $jenis_hki->id]
                ])->count();
            } else {
                $jumlah = Hki::where('jenis_hki_id', $jenis_hki->id)->count();
            }
            array_push($jenis_hki_label, $jenis_hki->nama);
            array_push($jenis_hki_data, $jumlah);
        }
        // 
        $data_status_hkis = array('terdaftar', 'granted');
        $status_hki_label = array();
        $status_hki_data = array();
        foreach ($data_status_hkis as $status_hki) {
            if ($tahun) {
                $jumlah = Hki::where([
                    ['tahun', $tahun],
                    ['status', $status_hki]
                ])->count();
            } else {
                $jumlah = Hki::where('status', $status_hki)->count();
            }
            array_push($status_hki_label, ucfirst($status_hki));
            array_push($status_hki_data, $jumlah);
        }
        // 
        return view('statistik.hki', compact(
            'hkis',
            'tahuns',
            'prodis',
            'prodi_label',
            'prodi_data',
            'jenis_hki_label',
            'jenis_hki_data',
            'status_hki_label',
            'status_hki_data',
        ));
    }

    public function luaran(Request $request)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $luarans = Luaran::where('tahun', $tahun)
                ->select(
                    'id',
                    'user_id',
                    'jenis_luaran_id',
                    'tahun',
                    'judul',
                    'deskripsi',
                    'url',
                )
                ->with('user:id,nama')
                ->with('jenis_luaran:id,nama')
                ->with('luaran_personels', function ($query) {
                    $query->select('luaran_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $luarans = Luaran::select(
                'id',
                'user_id',
                'jenis_luaran_id',
                'tahun',
                'judul',
                'deskripsi',
                'url',
            )
                ->with('user:id,nama')
                ->with('jenis_luaran:id,nama')
                ->with('luaran_personels', function ($query) {
                    $query->select('luaran_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Luaran::orderByDesc('tahun')->pluck('tahun')->toArray());
        // 
        $data_prodis = Prodi::select('id', 'nama')->get();
        $prodis = array();
        $prodi_label = array();
        $prodi_data = array();
        foreach ($data_prodis as $prodi) {
            if ($tahun) {
                $jumlah = Luaran::where('tahun', $tahun)->whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            } else {
                $jumlah = Luaran::whereHas('user', function ($query) use ($prodi) {
                    $query->where('prodi_id', $prodi->id);
                })->count();
            }
            array_push($prodis, array('id' => $prodi->id, 'nama' => $prodi->nama, 'jumlah' => $jumlah));
            array_push($prodi_label, $prodi->nama == "D4 Keselamatan dan Kesehatan Kerja" ? "D4 K3" : $prodi->nama);
            array_push($prodi_data, $jumlah);
        }
        // 
        $data_jenis_luarans = JenisLuaran::select('id', 'nama')->get();
        $jenis_luaran_label = array();
        $jenis_luaran_data = array();
        foreach ($data_jenis_luarans as $jenis_luaran) {
            if ($tahun) {
                $jumlah = Luaran::where([
                    ['tahun', $tahun],
                    ['jenis_luaran_id', $jenis_luaran->id]
                ])->count();
            } else {
                $jumlah = Luaran::where('jenis_luaran_id', $jenis_luaran->id)->count();
            }
            array_push($jenis_luaran_label, $jenis_luaran->nama);
            array_push($jenis_luaran_data, $jumlah);
        }
        // 
        return view('statistik.luaran', compact(
            'luarans',
            'tahuns',
            'prodis',
            'prodi_label',
            'prodi_data',
            'jenis_luaran_label',
            'jenis_luaran_data',
        ));
    }

    public function prodi(Request $request, $id)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $jumlah_penelitian = Penelitian::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            $jumlah_pengabdian = Pengabdian::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            $jumlah_jurnal = Jurnal::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('jurnal_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            $jumlah_buku = Buku::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('buku_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            $jumlah_makalah = Makalah::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('makalah_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            $jumlah_hki = Hki::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('hki_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            $jumlah_luaran = Luaran::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('luaran_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
        } else {
            $jumlah_penelitian = Penelitian::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })->count();
            $jumlah_pengabdian = Pengabdian::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })->count();
            $jumlah_jurnal = Jurnal::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('jurnal_personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })->count();
            $jumlah_buku = Buku::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('buku_personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })->count();
            $jumlah_makalah = Makalah::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('makalah_personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })->count();
            $jumlah_hki = Hki::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('hki_personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })->count();
            $jumlah_luaran = Luaran::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('luaran_personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })->count();
        }
        $prodi = Prodi::where('id', $id)->first();
        $tahun_penelitian = array_unique(Penelitian::orderByDesc('tahun')->pluck('tahun')->toArray());
        $tahun_pengabdian = array_unique(Pengabdian::orderByDesc('tahun')->pluck('tahun')->toArray());
        $tahun_jurnal = array_unique(Jurnal::orderByDesc('tahun')->pluck('tahun')->toArray());
        $tahun_buku = array_unique(Buku::orderByDesc('tahun')->pluck('tahun')->toArray());
        $tahun_makalah = array_unique(Makalah::orderByDesc('tahun')->pluck('tahun')->toArray());
        $tahun_hki = array_unique(Hki::orderByDesc('tahun')->pluck('tahun')->toArray());
        $tahun_luaran = array_unique(Luaran::orderByDesc('tahun')->pluck('tahun')->toArray());
        $tahun_merge = array_merge($tahun_penelitian, $tahun_pengabdian, $tahun_jurnal, $tahun_buku, $tahun_makalah, $tahun_hki, $tahun_luaran);
        rsort($tahun_merge);
        $tahuns = array_unique($tahun_merge);
        // 
        $data_dosens = User::where([
            ['role', 'dosen'],
            ['prodi_id', $id],
        ])->select('id', 'nama')->get();
        $dosens = array();
        foreach ($data_dosens as $dosen) {
            if ($tahun) {
                $penelitian = Penelitian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                ])
                    ->where(function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);;
                        $query->orWhereHas('personels', function ($query) use ($dosen) {
                            $query->where('user_id', $dosen->id);
                        });
                    })
                    ->count();
                $pengabdian = Pengabdian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                ])
                    ->where(function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);;
                        $query->orWhereHas('personels', function ($query) use ($dosen) {
                            $query->where('user_id', $dosen->id);
                        });
                    })
                    ->count();
                $jurnal = Jurnal::where('tahun', $tahun)
                    ->where(function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);;
                        $query->orWhereHas('jurnal_personels', function ($query) use ($dosen) {
                            $query->where('user_id', $dosen->id);
                        });
                    })
                    ->count();
                $buku = Buku::where('tahun', $tahun)
                    ->where(function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);;
                        $query->orWhereHas('buku_personels', function ($query) use ($dosen) {
                            $query->where('user_id', $dosen->id);
                        });
                    })
                    ->count();
                $makalah = Makalah::where('tahun', $tahun)->whereHas('user', function ($query) use ($dosen) {
                    $query->where('id', $dosen->id);
                })->count();
                $hki = Hki::where('tahun', $tahun)->whereHas('user', function ($query) use ($dosen) {
                    $query->where('id', $dosen->id);
                })->count();
                $luaran = Luaran::where('tahun', $tahun)->whereHas('user', function ($query) use ($dosen) {
                    $query->where('id', $dosen->id);
                })->count();
            } else {
                $penelitian = Penelitian::where('status', 'selesai')
                    ->where(function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);;
                        $query->orWhereHas('personels', function ($query) use ($dosen) {
                            $query->where('user_id', $dosen->id);
                        });
                    })
                    ->count();
                $pengabdian = Pengabdian::where('status', 'selesai')
                    ->where(function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);;
                        $query->orWhereHas('personels', function ($query) use ($dosen) {
                            $query->where('user_id', $dosen->id);
                        });
                    })
                    ->count();
                $jurnal = Jurnal::whereHas('user', function ($query) use ($dosen) {
                    $query->where('id', $dosen->id);
                })->count();
                $buku = Buku::whereHas('user', function ($query) use ($dosen) {
                    $query->where('id', $dosen->id);
                })->count();
                $makalah = Makalah::whereHas('user', function ($query) use ($dosen) {
                    $query->where('id', $dosen->id);
                })->count();
                $hki = Hki::whereHas('user', function ($query) use ($dosen) {
                    $query->where('id', $dosen->id);
                })->count();
                $luaran = Luaran::whereHas('user', function ($query) use ($dosen) {
                    $query->where('id', $dosen->id);
                })->count();
            }
            array_push($dosens, array(
                'id' => $dosen->id,
                'nama' => $dosen->nama,
                'penelitian' => $penelitian,
                'pengabdian' => $pengabdian,
                'publikasi' => $jurnal + $buku + $makalah + $hki + $luaran,
            ));
            // array_push($prodi_label, $prodi->nama == "D4 Keselamatan dan Kesehatan Kerja" ? "D4 K3" : $prodi->nama);
            // array_push($prodi_data, $jumlah);
        }
        // 
        return view('statistik.prodi', compact(
            'jumlah_penelitian',
            'jumlah_pengabdian',
            'jumlah_jurnal',
            'jumlah_buku',
            'jumlah_makalah',
            'jumlah_hki',
            'jumlah_luaran',
            'prodi',
            'tahuns',
            'dosens',
        ));
    }

    public function prodi_penelitian(Request $request, $id)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $penelitians = Penelitian::where([
                ['status', 'selesai'],
                ['tahun', $tahun],
            ])
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $penelitians = Penelitian::where('status', 'selesai')
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Penelitian::where('status', 'selesai')
            ->whereHas('user', function ($query) use ($id) {
                $query->where('prodi_id', $id);
            })
            ->orderByDesc('tahun')
            ->pluck('tahun')
            ->toArray());
        // 
        $data_dosens = User::where([
            ['role', 'dosen'],
            ['prodi_id', $id],
        ])->select('id', 'nama')->get();
        $dosens = array();
        foreach ($data_dosens as $dosen) {
            if ($tahun) {
                $jumlah = Penelitian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                ])->where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);;
                    $query->orWhereHas('personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            } else {
                $jumlah = Penelitian::where('status', 'selesai')->where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);;
                    $query->orWhereHas('personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            }
            array_push($dosens, array(
                'id' => $dosen->id,
                'nama' => $dosen->nama,
                'jumlah' => $jumlah,
            ));
        }
        // 
        $data_jenis_penelitians = JenisPenelitian::get();
        $jenis_penelitian_label = array();
        $jenis_penelitian_data = array();
        foreach ($data_jenis_penelitians as $jenis_penelitian) {
            if ($tahun) {
                $jumlah = Penelitian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                    ['jenis_penelitian_id', $jenis_penelitian->id]
                ])
                    ->where(function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                        $query->orWhereHas('personels', function ($query) use ($id) {
                            $query->whereHas('user', function ($query) use ($id) {
                                $query->where('prodi_id', $id);
                            });
                        });
                    })
                    ->count();
            } else {
                $jumlah = Penelitian::where([
                    ['status', 'selesai'],
                    ['jenis_penelitian_id', $jenis_penelitian->id],
                ])
                    ->where(function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                        $query->orWhereHas('personels', function ($query) use ($id) {
                            $query->whereHas('user', function ($query) use ($id) {
                                $query->where('prodi_id', $id);
                            });
                        });
                    })
                    ->count();
            }
            array_push($jenis_penelitian_label, $jenis_penelitian->nama);
            array_push($jenis_penelitian_data, $jumlah);
        }
        // 
        $data_jenis_pendanaans = JenisPendanaan::get();
        $jenis_pendanaan_label = array();
        $jenis_pendanaan_data = array();
        foreach ($data_jenis_pendanaans as $jenis_pendanaan) {
            if ($tahun) {
                $jumlah = Penelitian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                    ['jenis_pendanaan_id', $jenis_pendanaan->id]
                ])
                    ->where(function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                        $query->orWhereHas('personels', function ($query) use ($id) {
                            $query->whereHas('user', function ($query) use ($id) {
                                $query->where('prodi_id', $id);
                            });
                        });
                    })
                    ->count();
            } else {
                $jumlah = Penelitian::where([
                    ['status', 'selesai'],
                    ['jenis_pendanaan_id', $jenis_pendanaan->id],
                ])
                    ->where(function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                        $query->orWhereHas('personels', function ($query) use ($id) {
                            $query->whereHas('user', function ($query) use ($id) {
                                $query->where('prodi_id', $id);
                            });
                        });
                    })
                    ->count();
            }
            array_push($jenis_pendanaan_label, $jenis_pendanaan->nama);
            array_push($jenis_pendanaan_data, $jumlah);
        }
        // 
        $prodi = Prodi::where('id', $id)->select('id', 'nama')->first();
        return view('statistik.prodi_penelitian', compact(
            'penelitians',
            'tahuns',
            'prodi',
            'dosens',
            'jenis_penelitian_label',
            'jenis_penelitian_data',
            'jenis_pendanaan_label',
            'jenis_pendanaan_data',
        ));
    }

    public function prodi_pengabdian(Request $request, $id)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $pengabdians = Pengabdian::where([
                ['status', 'selesai'],
                ['tahun', $tahun],
            ])
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $pengabdians = Pengabdian::where('status', 'selesai')
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Pengabdian::where('status', 'selesai')
            ->whereHas('user', function ($query) use ($id) {
                $query->where('prodi_id', $id);
            })
            ->orderByDesc('tahun')
            ->pluck('tahun')
            ->toArray());
        // 
        $data_dosens = User::where([
            ['role', 'dosen'],
            ['prodi_id', $id],
        ])->select('id', 'nama')->get();
        $dosens = array();
        foreach ($data_dosens as $dosen) {
            if ($tahun) {
                $jumlah = Pengabdian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                ])->where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);;
                    $query->orWhereHas('personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            } else {
                $jumlah = Pengabdian::where('status', 'selesai')->where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);;
                    $query->orWhereHas('personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            }
            array_push($dosens, array(
                'id' => $dosen->id,
                'nama' => $dosen->nama,
                'jumlah' => $jumlah,
            ));
        }
        // 
        $data_jenis_pengabdians = JenisPengabdian::get();
        $jenis_pengabdian_label = array();
        $jenis_pengabdian_data = array();
        foreach ($data_jenis_pengabdians as $jenis_pengabdian) {
            if ($tahun) {
                $jumlah = Pengabdian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                    ['jenis_pengabdian_id', $jenis_pengabdian->id]
                ])
                    ->where(function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                        $query->orWhereHas('personels', function ($query) use ($id) {
                            $query->whereHas('user', function ($query) use ($id) {
                                $query->where('prodi_id', $id);
                            });
                        });
                    })
                    ->count();
            } else {
                $jumlah = Pengabdian::where([
                    ['status', 'selesai'],
                    ['jenis_pengabdian_id', $jenis_pengabdian->id],
                ])
                    ->where(function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                        $query->orWhereHas('personels', function ($query) use ($id) {
                            $query->whereHas('user', function ($query) use ($id) {
                                $query->where('prodi_id', $id);
                            });
                        });
                    })
                    ->count();
            }
            array_push($jenis_pengabdian_label, $jenis_pengabdian->nama);
            array_push($jenis_pengabdian_data, $jumlah);
        }
        // 
        $data_jenis_pendanaans = JenisPendanaan::get();
        $jenis_pendanaan_label = array();
        $jenis_pendanaan_data = array();
        foreach ($data_jenis_pendanaans as $jenis_pendanaan) {
            if ($tahun) {
                $jumlah = Pengabdian::where([
                    ['status', 'selesai'],
                    ['tahun', $tahun],
                    ['jenis_pendanaan_id', $jenis_pendanaan->id]
                ])
                    ->where(function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                        $query->orWhereHas('personels', function ($query) use ($id) {
                            $query->whereHas('user', function ($query) use ($id) {
                                $query->where('prodi_id', $id);
                            });
                        });
                    })
                    ->count();
            } else {
                $jumlah = Pengabdian::where([
                    ['status', 'selesai'],
                    ['jenis_pendanaan_id', $jenis_pendanaan->id],
                ])
                    ->where(function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                        $query->orWhereHas('personels', function ($query) use ($id) {
                            $query->whereHas('user', function ($query) use ($id) {
                                $query->where('prodi_id', $id);
                            });
                        });
                    })
                    ->count();
            }
            array_push($jenis_pendanaan_label, $jenis_pendanaan->nama);
            array_push($jenis_pendanaan_data, $jumlah);
        }
        // 
        $prodi = Prodi::where('id', $id)->select('id', 'nama')->first();
        return view('statistik.prodi_pengabdian', compact(
            'pengabdians',
            'tahuns',
            'prodi',
            'dosens',
            'jenis_pengabdian_label',
            'jenis_pengabdian_data',
            'jenis_pendanaan_label',
            'jenis_pendanaan_data',
        ));
    }

    public function prodi_jurnal(Request $request, $id)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $jurnals = Jurnal::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('jurnal_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'jenis_jurnal_id',
                    'tahun',
                    'nama',
                    'judul',
                    'issn',
                    'volume',
                    'nomor',
                    'halaman_awal',
                    'halaman_akhir',
                    'url',
                    'mahasiswas',
                )
                ->with('user:id,nama')
                ->with('jenis_jurnal:id,nama')
                ->with('jurnal_personels', function ($query) {
                    $query->select('jurnal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $jurnals = Jurnal::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('jurnal_personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })
                ->select(
                    'id',
                    'user_id',
                    'jenis_jurnal_id',
                    'tahun',
                    'nama',
                    'judul',
                    'issn',
                    'volume',
                    'nomor',
                    'halaman_awal',
                    'halaman_akhir',
                    'url',
                    'mahasiswas',
                )
                ->with('user:id,nama')
                ->with('jenis_jurnal:id,nama')
                ->with('jurnal_personels', function ($query) {
                    $query->select('jurnal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Jurnal::where(function ($query) use ($id) {
            $query->whereHas('user', function ($query) use ($id) {
                $query->where('prodi_id', $id);
            });
            $query->orWhereHas('jurnal_personels', function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
            });
        })->orderByDesc('tahun')->pluck('tahun')->toArray());
        //
        $data_jenis_jurnals = JenisJurnal::get();
        $jenis_jurnal_label = array();
        $jenis_jurnal_data = array();
        foreach ($data_jenis_jurnals as $jenis_jurnal) {
            if ($tahun) {
                $jumlah = Jurnal::where([
                    ['tahun', $tahun],
                    ['jenis_jurnal_id', $jenis_jurnal->id]
                ])->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('jurnal_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            } else {
                $jumlah = Jurnal::where('jenis_jurnal_id', $jenis_jurnal->id)->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('jurnal_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            }
            array_push($jenis_jurnal_label, $jenis_jurnal->nama);
            array_push($jenis_jurnal_data, $jumlah);
        }
        // 
        $data_dosens = User::where([
            ['role', 'dosen'],
            ['prodi_id', $id],
        ])->select('id', 'nama')->get();
        $dosens = array();
        foreach ($data_dosens as $dosen) {
            if ($tahun) {
                $jumlah = Jurnal::where('tahun', $tahun)->where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);
                    $query->orWhereHas('jurnal_personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            } else {
                $jumlah = Jurnal::where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);
                    $query->orWhereHas('jurnal_personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            }
            array_push($dosens, array(
                'id' => $dosen->id,
                'nama' => $dosen->nama,
                'jumlah' => $jumlah,
            ));
        }
        // 
        $prodi = Prodi::where('id', $id)->select('id', 'nama')->first();
        // 
        return view('statistik.prodi_jurnal', compact(
            'jurnals',
            'tahuns',
            'jenis_jurnal_label',
            'jenis_jurnal_data',
            'dosens',
            'prodi',
        ));
    }

    public function prodi_buku(Request $request, $id)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $bukus = Buku::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('buku_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'isbn',
                    'jumlah',
                    'penerbit',
                )
                ->with('user:id,nama')
                ->with('buku_personels', function ($query) {
                    $query->select('buku_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $bukus = Buku::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('buku_personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'isbn',
                    'jumlah',
                    'penerbit',
                )
                ->with('user:id,nama')
                ->with('buku_personels', function ($query) {
                    $query->select('buku_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Buku::where(function ($query) use ($id) {
            $query->whereHas('user', function ($query) use ($id) {
                $query->where('prodi_id', $id);
            });
            $query->orWhereHas('buku_personels', function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
            });
        })->orderByDesc('tahun')->pluck('tahun')->toArray());
        // 
        $data_dosens = User::where([
            ['role', 'dosen'],
            ['prodi_id', $id],
        ])->select('id', 'nama')->get();
        $dosens = array();
        foreach ($data_dosens as $dosen) {
            if ($tahun) {
                $jumlah = Buku::where('tahun', $tahun)->where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);
                    $query->orWhereHas('buku_personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            } else {
                $jumlah = Buku::where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);
                    $query->orWhereHas('buku_personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            }
            array_push($dosens, array(
                'id' => $dosen->id,
                'nama' => $dosen->nama,
                'jumlah' => $jumlah,
            ));
        }
        // 
        $prodi = Prodi::where('id', $id)->select('id', 'nama')->first();
        // 
        return view('statistik.prodi_buku', compact(
            'bukus',
            'tahuns',
            'dosens',
            'prodi',
        ));
    }

    public function prodi_makalah(Request $request, $id)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $makalahs = Makalah::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('makalah_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'tingkat',
                    'tahun',
                    'judul',
                    'forum',
                    'institusi',
                    'tanggal_awal',
                    'tanggal_akhir',
                    'tempat',
                    'status',
                )
                ->with('user:id,nama')
                ->with('makalah_personels', function ($query) {
                    $query->select('makalah_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $makalahs = Makalah::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('makalah_personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })
                ->select(
                    'id',
                    'user_id',
                    'tingkat',
                    'tahun',
                    'judul',
                    'forum',
                    'institusi',
                    'tanggal_awal',
                    'tanggal_akhir',
                    'tempat',
                    'status',
                )
                ->with('user:id,nama')
                ->with('makalah_personels', function ($query) {
                    $query->select('makalah_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Makalah::where(function ($query) use ($id) {
            $query->where('user_id', $id);
            $query->orWhereHas('makalah_personels', function ($query) use ($id) {
                $query->where('user_id', $id);
            });
        })->orderByDesc('tahun')->pluck('tahun')->toArray());
        // 
        $data_tingkat_makalahs = array('regional', 'nasional', 'internasional');
        $tingkat_makalah_label = array();
        $tingkat_makalah_data = array();
        foreach ($data_tingkat_makalahs as $tingkat_makalah) {
            if ($tahun) {
                $jumlah = Makalah::where([
                    ['tahun', $tahun],
                    ['tingkat', $tingkat_makalah]
                ])->where(function ($query) use ($id) {
                    $query->where('user_id', $id);
                    $query->orWhereHas('makalah_personels', function ($query) use ($id) {
                        $query->where('user_id', $id);
                    });
                })->count();
            } else {
                $jumlah = Makalah::where('tingkat', $tingkat_makalah)
                    ->where(function ($query) use ($id) {
                        $query->where('user_id', $id);
                        $query->orWhereHas('makalah_personels', function ($query) use ($id) {
                            $query->where('user_id', $id);
                        });
                    })->count();
            }
            array_push($tingkat_makalah_label, ucfirst($tingkat_makalah));
            array_push($tingkat_makalah_data, $jumlah);
        }
        // 
        $data_status_makalahs = array('biasa', 'spesial');
        $status_makalah_label = array();
        $status_makalah_data = array();
        foreach ($data_status_makalahs as $status_makalah) {
            if ($tahun) {
                $jumlah = Makalah::where([
                    ['tahun', $tahun],
                    ['status', $status_makalah]
                ])
                    ->where(function ($query) use ($id) {
                        $query->where('user_id', $id);
                        $query->orWhereHas('makalah_personels', function ($query) use ($id) {
                            $query->where('user_id', $id);
                        });
                    })->count();
            } else {
                $jumlah = Makalah::where('status', $status_makalah)
                    ->where(function ($query) use ($id) {
                        $query->where('user_id', $id);
                        $query->orWhereHas('makalah_personels', function ($query) use ($id) {
                            $query->where('user_id', $id);
                        });
                    })->count();
            }
            array_push($status_makalah_label, $status_makalah == 'biasa' ? 'Pemakalah Biasa' : 'Invited / Keynote Speaker');
            array_push($status_makalah_data, $jumlah);
        }
        // 
        $data_dosens = User::where([
            ['role', 'dosen'],
            ['prodi_id', $id],
        ])->select('id', 'nama')->get();
        $dosens = array();
        foreach ($data_dosens as $dosen) {
            if ($tahun) {
                $jumlah = Makalah::where('tahun', $tahun)->where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);
                    $query->orWhereHas('makalah_personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            } else {
                $jumlah = Makalah::where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);
                    $query->orWhereHas('makalah_personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            }
            array_push($dosens, array(
                'id' => $dosen->id,
                'nama' => $dosen->nama,
                'jumlah' => $jumlah,
            ));
        }
        // 
        $prodi = Prodi::where('id', $id)->select('id', 'nama')->first();
        // 
        return view('statistik.prodi_makalah', compact(
            'makalahs',
            'tahuns',
            'tingkat_makalah_label',
            'tingkat_makalah_data',
            'status_makalah_label',
            'status_makalah_data',
            'dosens',
            'prodi',
        ));
    }

    public function prodi_hki(Request $request, $id)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $hkis = Hki::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('hki_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'jenis_hki_id',
                    'tahun',
                    'judul',
                    'nomor',
                    'pendaftaran',
                    'status',
                )
                ->with('user:id,nama')
                ->with('jenis_hki:id,nama')
                ->with('hki_personels', function ($query) {
                    $query->select('hki_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        } else {
            $hkis = Hki::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('hki_personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })
                ->select(
                    'id',
                    'user_id',
                    'jenis_hki_id',
                    'tahun',
                    'judul',
                    'nomor',
                    'pendaftaran',
                    'status',
                )
                ->with('user:id,nama')
                ->with('jenis_hki:id,nama')
                ->with('hki_personels', function ($query) {
                    $query->select('hki_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        $tahuns = array_unique(Hki::where(function ($query) use ($id) {
            $query->whereHas('user', function ($query) use ($id) {
                $query->where('prodi_id', $id);
            });
            $query->orWhereHas('hki_personels', function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
            });
        })->orderByDesc('tahun')->pluck('tahun')->toArray());
        // 
        $data_jenis_hkis = JenisHki::select('id', 'nama')->get();
        $jenis_hki_label = array();
        $jenis_hki_data = array();
        foreach ($data_jenis_hkis as $jenis_hki) {
            if ($tahun) {
                $jumlah = Hki::where([
                    ['tahun', $tahun],
                    ['jenis_hki_id', $jenis_hki->id]
                ])->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('hki_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            } else {
                $jumlah = Hki::where('jenis_hki_id', $jenis_hki->id)
                    ->where(function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                        $query->orWhereHas('hki_personels', function ($query) use ($id) {
                            $query->whereHas('user', function ($query) use ($id) {
                                $query->where('prodi_id', $id);
                            });
                        });
                    })->count();
            }
            array_push($jenis_hki_label, $jenis_hki->nama);
            array_push($jenis_hki_data, $jumlah);
        }
        // 
        $data_status_hkis = array('terdaftar', 'granted');
        $status_hki_label = array();
        $status_hki_data = array();
        foreach ($data_status_hkis as $status_hki) {
            if ($tahun) {
                $jumlah = Hki::where([
                    ['tahun', $tahun],
                    ['status', $status_hki]
                ])->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('hki_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            } else {
                $jumlah = Hki::where('status', $status_hki)->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('hki_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            }
            array_push($status_hki_label, ucfirst($status_hki));
            array_push($status_hki_data, $jumlah);
        }
        // 
        $data_dosens = User::where([
            ['role', 'dosen'],
            ['prodi_id', $id],
        ])->select('id', 'nama')->get();
        $dosens = array();
        foreach ($data_dosens as $dosen) {
            if ($tahun) {
                $jumlah = Hki::where('tahun', $tahun)->where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);
                    $query->orWhereHas('hki_personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            } else {
                $jumlah = Hki::where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);
                    $query->orWhereHas('hki_personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            }
            array_push($dosens, array(
                'id' => $dosen->id,
                'nama' => $dosen->nama,
                'jumlah' => $jumlah,
            ));
        }
        // 
        $prodi = Prodi::where('id', $id)->first();
        // 
        return view('statistik.prodi_hki', compact(
            'hkis',
            'tahuns',
            'jenis_hki_label',
            'jenis_hki_data',
            'status_hki_label',
            'status_hki_data',
            'dosens',
            'prodi',
        ));
    }

    public function prodi_luaran(Request $request, $id)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $luarans = Luaran::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('luaran_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'jenis_luaran_id',
                    'tahun',
                    'judul',
                    'deskripsi',
                    'url',
                )->with('user:id,nama')->with('jenis_luaran:id,nama')->with('luaran_personels', function ($query) {
                    $query->select('luaran_id', 'user_id');
                    $query->with('user:id,nama');
                })->orderByDesc('tahun')->paginate(10);
        } else {
            $luarans = Luaran::where(function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
                $query->orWhereHas('luaran_personels', function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                });
            })->select(
                'id',
                'user_id',
                'jenis_luaran_id',
                'tahun',
                'judul',
                'deskripsi',
                'url',
            )->with('user:id,nama')->with('jenis_luaran:id,nama')->with('luaran_personels', function ($query) {
                $query->select('luaran_id', 'user_id');
                $query->with('user:id,nama');
            })->orderByDesc('tahun')->paginate(10);
        }
        // 
        $tahuns = array_unique(Luaran::where(function ($query) use ($id) {
            $query->whereHas('user', function ($query) use ($id) {
                $query->where('prodi_id', $id);
            });
            $query->orWhereHas('luaran_personels', function ($query) use ($id) {
                $query->whereHas('user', function ($query) use ($id) {
                    $query->where('prodi_id', $id);
                });
            });
        })->orderByDesc('tahun')->pluck('tahun')->toArray());
        // 
        $data_jenis_luarans = JenisLuaran::select('id', 'nama')->get();
        $jenis_luaran_label = array();
        $jenis_luaran_data = array();
        foreach ($data_jenis_luarans as $jenis_luaran) {
            if ($tahun) {
                $jumlah = Luaran::where([
                    ['tahun', $tahun],
                    ['jenis_luaran_id', $jenis_luaran->id]
                ])->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('luaran_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            } else {
                $jumlah = Luaran::where('jenis_luaran_id', $jenis_luaran->id)->where(function ($query) use ($id) {
                    $query->whereHas('user', function ($query) use ($id) {
                        $query->where('prodi_id', $id);
                    });
                    $query->orWhereHas('luaran_personels', function ($query) use ($id) {
                        $query->whereHas('user', function ($query) use ($id) {
                            $query->where('prodi_id', $id);
                        });
                    });
                })->count();
            }
            array_push($jenis_luaran_label, $jenis_luaran->nama);
            array_push($jenis_luaran_data, $jumlah);
        }
        // 
        $data_dosens = User::where([
            ['role', 'dosen'],
            ['prodi_id', $id],
        ])->select('id', 'nama')->get();
        $dosens = array();
        foreach ($data_dosens as $dosen) {
            if ($tahun) {
                $jumlah = Luaran::where('tahun', $tahun)->where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);
                    $query->orWhereHas('luaran_personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            } else {
                $jumlah = Luaran::where(function ($query) use ($dosen) {
                    $query->where('user_id', $dosen->id);
                    $query->orWhereHas('luaran_personels', function ($query) use ($dosen) {
                        $query->where('user_id', $dosen->id);
                    });
                })->count();
            }
            array_push($dosens, array(
                'id' => $dosen->id,
                'nama' => $dosen->nama,
                'jumlah' => $jumlah,
            ));
        }
        // 
        $prodi = Prodi::where('id', $id)->first();
        // 
        return view('statistik.prodi_luaran', compact(
            'luarans',
            'tahuns',
            'jenis_luaran_label',
            'jenis_luaran_data',
            'dosens',
            'prodi',
        ));
    }

    public function dosen(Request $request, $id)
    {
        $tahun = $request->tahun;
        if ($tahun) {
            $penelitians = Penelitian::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->where('user_id', $id);
                    $query->orWhereHas('personels', function ($query) use ($id) {
                        $query->where('user_id', $id);
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'jenis_pendanaan_id',
                    'jenis_penelitian_id',
                    'dana_setuju',
                    'mahasiswas',
                )
                ->with('user:id,nama')
                ->with('jenis_pendanaan:id,nama')
                ->with('jenis_penelitian:id,nama')
                ->with('personels', function ($query) {
                    $query->select('penelitian_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $pengabdians = Pengabdian::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->where('user_id', $id);
                    $query->orWhereHas('personels', function ($query) use ($id) {
                        $query->where('user_id', $id);
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'jenis_pendanaan_id',
                    'jenis_pengabdian_id',
                    'dana_setuju',
                    'mahasiswas',
                )
                ->with('user:id,nama')
                ->with('jenis_pendanaan:id,nama')
                ->with('jenis_pengabdian:id,nama')
                ->with('personels', function ($query) {
                    $query->select('pengabdian_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $jurnals = Jurnal::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->where('user_id', $id);
                    $query->orWhereHas('jurnal_personels', function ($query) use ($id) {
                        $query->where('user_id', $id);
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'jenis_jurnal_id',
                    'tahun',
                    'nama',
                    'issn',
                    'volume',
                    'nomor',
                    'halaman_awal',
                    'halaman_akhir',
                    'url',
                    'mahasiswas',
                )
                ->with('user:id,nama')
                ->with('jenis_jurnal:id,nama')
                ->with('jurnal_personels', function ($query) {
                    $query->select('jurnal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $bukus = Buku::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->where('user_id', $id);
                    $query->orWhereHas('buku_personels', function ($query) use ($id) {
                        $query->where('user_id', $id);
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'isbn',
                    'jumlah',
                    'penerbit',
                )
                ->with('user:id,nama')
                ->with('buku_personels', function ($query) {
                    $query->select('buku_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $makalahs = Makalah::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->where('user_id', $id);
                    $query->orWhereHas('makalah_personels', function ($query) use ($id) {
                        $query->where('user_id', $id);
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'tingkat',
                    'tahun',
                    'judul',
                    'forum',
                    'institusi',
                    'tanggal_awal',
                    'tanggal_akhir',
                    'tempat',
                    'status',
                )
                ->with('user:id,nama')
                ->with('makalah_personels', function ($query) {
                    $query->select('makalah_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $hkis = Hki::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->where('user_id', $id);
                    $query->orWhereHas('hki_personels', function ($query) use ($id) {
                        $query->where('user_id', $id);
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'jenis_hki_id',
                    'tahun',
                    'judul',
                    'nomor',
                    'pendaftaran',
                    'status',
                )
                ->with('user:id,nama')
                ->with('jenis_hki:id,nama')
                ->with('hki_personels', function ($query) {
                    $query->select('hki_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $luarans = Luaran::where('tahun', $tahun)
                ->where(function ($query) use ($id) {
                    $query->where('user_id', $id);
                    $query->orWhereHas('luaran_personels', function ($query) use ($id) {
                        $query->where('user_id', $id);
                    });
                })
                ->select(
                    'id',
                    'user_id',
                    'jenis_luaran_id',
                    'tahun',
                    'judul',
                    'deskripsi',
                    'url',
                )
                ->with('user:id,nama')
                ->with('jenis_luaran:id,nama')
                ->with('luaran_personels', function ($query) {
                    $query->select('luaran_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
        } else {
            $penelitians = Penelitian::where('user_id', $id)
                ->orWhereHas('personels', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'jenis_pendanaan_id',
                    'jenis_penelitian_id',
                    'dana_setuju',
                    'mahasiswas',
                )
                ->with('user:id,nama')
                ->with('jenis_pendanaan:id,nama')
                ->with('jenis_penelitian:id,nama')
                ->with('personels', function ($query) {
                    $query->select('penelitian_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $pengabdians = Pengabdian::where('user_id', $id)
                ->orWhereHas('personels', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'jenis_pendanaan_id',
                    'jenis_pengabdian_id',
                    'dana_setuju',
                    'mahasiswas',
                )
                ->with('user:id,nama')
                ->with('jenis_pendanaan:id,nama')
                ->with('jenis_pengabdian:id,nama')
                ->with('personels', function ($query) {
                    $query->select('pengabdian_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $jurnals = Jurnal::where('user_id', $id)
                ->orWhereHas('jurnal_personels', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })
                ->select(
                    'id',
                    'user_id',
                    'jenis_jurnal_id',
                    'tahun',
                    'nama',
                    'issn',
                    'volume',
                    'nomor',
                    'halaman_awal',
                    'halaman_akhir',
                    'url',
                    'mahasiswas',
                )
                ->with('user:id,nama')
                ->with('jenis_jurnal:id,nama')
                ->with('jurnal_personels', function ($query) {
                    $query->select('jurnal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $bukus = Buku::where('user_id', $id)
                ->orWhereHas('buku_personels', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'isbn',
                    'jumlah',
                    'penerbit',
                )
                ->with('user:id,nama')
                ->with('buku_personels', function ($query) {
                    $query->select('buku_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $makalahs = Makalah::where('user_id', $id)
                ->orWhereHas('makalah_personels', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })
                ->select(
                    'id',
                    'user_id',
                    'tingkat',
                    'tahun',
                    'judul',
                    'forum',
                    'institusi',
                    'tanggal_awal',
                    'tanggal_akhir',
                    'tempat',
                    'status',
                )
                ->with('user:id,nama')
                ->with('makalah_personels', function ($query) {
                    $query->select('makalah_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $hkis = Hki::where('user_id', $id)
                ->orWhereHas('hki_personels', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })
                ->select(
                    'id',
                    'user_id',
                    'jenis_hki_id',
                    'tahun',
                    'judul',
                    'nomor',
                    'pendaftaran',
                    'status',
                )
                ->with('user:id,nama')
                ->with('jenis_hki:id,nama')
                ->with('hki_personels', function ($query) {
                    $query->select('hki_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
            $luarans = Luaran::where('user_id', $id)
                ->orWhereHas('luaran_personels', function ($query) use ($id) {
                    $query->where('user_id', $id);
                })
                ->select(
                    'id',
                    'user_id',
                    'jenis_luaran_id',
                    'tahun',
                    'judul',
                    'deskripsi',
                    'url',
                )
                ->with('user:id,nama')
                ->with('jenis_luaran:id,nama')
                ->with('luaran_personels', function ($query) {
                    $query->select('luaran_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->orderByDesc('tahun')
                ->get();
        }
        // 
        $tahun_penelitian = array_unique($penelitians->pluck('tahun')->toArray());
        $tahun_pengabdian = array_unique($pengabdians->pluck('tahun')->toArray());
        $tahun_jurnal = array_unique($jurnals->pluck('tahun')->toArray());
        $tahun_buku = array_unique($bukus->pluck('tahun')->toArray());
        $tahun_makalah = array_unique($makalahs->pluck('tahun')->toArray());
        $tahun_hki = array_unique($hkis->pluck('tahun')->toArray());
        $tahun_luaran = array_unique($luarans->pluck('tahun')->toArray());
        $tahun_merge = array_merge($tahun_penelitian, $tahun_pengabdian, $tahun_jurnal, $tahun_buku, $tahun_makalah, $tahun_hki, $tahun_luaran);
        rsort($tahun_merge);
        $tahuns = array_unique($tahun_merge);
        // 
        $dosen = User::where('id', $id)->select(
            'nama',
            'nidn',
            'nipy',
            'gender',
            'prodi_id',
            'telp',
            'id_sinta',
            'id_scopus',
            'golongan',
            'jabatan',
        )
            ->with('prodi:id,nama')
            ->first();
        // 
        return view('statistik.dosen', compact(
            'penelitians',
            'pengabdians',
            'jurnals',
            'bukus',
            'makalahs',
            'hkis',
            'luarans',
            'tahuns',
            'dosen',
        ));
    }
}
