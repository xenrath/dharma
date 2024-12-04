<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\JenisPendanaan;
use App\Models\JenisPenelitian;
use App\Models\Penelitian;
use App\Models\PenelitianPersonel;
use App\Models\PenelitianRevisi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PenelitianRiwayatController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $penelitians = Penelitian::where('status', 'selesai')
                ->where(function ($query) use ($keyword) {
                    $query->whereHas('user', function ($query) use ($keyword) {
                        $query->where('nama', 'LIKE', "%$keyword%");
                    });
                    $query->orWhereHas('personels', function ($query) use ($keyword) {
                        $query->whereHas('user', function ($query) use ($keyword) {
                            $query->where('nama', 'LIKE', "%$keyword%");
                        });
                    });
                    $query->orWhere('judul', 'LIKE', "%$keyword%");
                })
                ->select(
                    'id',
                    'user_id',
                    'tahun',
                    'judul',
                    'jenis_penelitian_id',
                    'jenis_pendanaan_id',
                    'dana_setuju',
                    'file',
                    'mahasiswas',
                    'status',
                )
                ->with('user:id,nama')
                ->with('jenis_penelitian:id,nama')
                ->with('jenis_pendanaan:id,nama')
                ->with('personels', function ($query) {
                    $query->select('penelitian_id', 'user_id');
                    $query->with('user', function ($query) {
                        $query->select('id', 'nama');
                        $query->withTrashed();
                    });
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
                    'jenis_penelitian_id',
                    'jenis_pendanaan_id',
                    'dana_setuju',
                    'file',
                    'mahasiswas',
                    'status',
                )
                ->with('user:id,nama')
                ->with('jenis_penelitian:id,nama')
                ->with('jenis_pendanaan:id,nama')
                ->with('personels', function ($query) {
                    $query->select('penelitian_id', 'user_id');
                    $query->with('user', function ($query) {
                        $query->select('id', 'nama');
                        $query->withTrashed();
                    });
                })
                ->orderByDesc('tahun')
                ->paginate(10);
        }
        // 
        return view('operator.penelitian.riwayat.index', compact('penelitians'));
    }

    public function create()
    {
        $jenis_penelitians = JenisPenelitian::select('id', 'nama')->get();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('operator.penelitian.riwayat.create', compact(
            'jenis_penelitians',
            'jenis_pendanaans',
            'dosens'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_penelitian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_setuju' => 'required',
            // 'file' => 'required|mimes:pdf|max:2048',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'user_id.required' => 'Dosen harus dipilih!',
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Penelitian harus diisi!',
            'jenis_penelitian_id.required' => 'Jenis Penelitian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Sumber Dana harus dipilih!',
            'dana_setuju.required' => 'Dana Usulan harus diisi!',
            // 'file.required' => 'Laporan Penelitian harus ditambahkan!',
            'file.mimes' => 'Laporan Penelitian harus berformat .pdf!',
            'file.max' => 'Laporan Penelitian yang ditambahkan terlalu besar!',
        ]);
        // 
        $mahasiswas = [];
        if ($request->mahasiswas) {
            foreach ($request->mahasiswas as $mahasiswa) {
                if ($mahasiswa['nama']) {
                    $mahasiswas[$mahasiswa['nama']] = $mahasiswa['prodi'];
                }
            }
        }
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal membuat Penelitian!');
            return back()->withInput()->withErrors($validator->errors())->with('old_mahasiswas', $mahasiswas);
        }
        // 
        if ($request->file) {
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'penelitian/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = null;
        }
        // 
        $penelitian = Penelitian::create([
            'user_id' => $request->user_id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_penelitian_id' => $request->jenis_penelitian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_setuju' => $request->dana_setuju,
            'file' => $file,
            'mahasiswas' => $mahasiswas,
            'status' => 'selesai',
        ]);
        // 
        if (!$penelitian) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back();
        }
        // 
        if ($request->personels) {
            foreach ($request->personels as $personel) {
                PenelitianPersonel::create([
                    'penelitian_id' => $penelitian->id,
                    'user_id' => $personel,
                ]);
            }
        }
        // 
        alert()->success('Success', 'Berhasil membuat Penelitian');
        return redirect('operator/penelitian-riwayat');
    }

    public function edit($id)
    {
        $penelitian = Penelitian::where('id', $id)
            ->select(
                'id',
                'tahun',
                'user_id',
                'judul',
                'jenis_penelitian_id',
                'jenis_pendanaan_id',
                'dana_setuju',
                'file',
                'mahasiswas',
            )
            ->with('user:id,nama')
            ->with('personels:penelitian_id,user_id')
            ->first();
        $jenis_penelitians = JenisPenelitian::select('id', 'nama')->get();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where([
            ['id', '!=', auth()->user()->id],
            ['role', 'dosen'],
        ])
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        $peninjaus = User::where([
            ['role', 'dosen'],
            ['is_peninjau', true],
        ])
            ->select('id', 'nama')
            ->orderBy('nama')
            ->get();

        return view('operator.penelitian.riwayat.edit', compact(
            'penelitian',
            'jenis_penelitians',
            'jenis_pendanaans',
            'dosens',
            'peninjaus'
        ));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_penelitian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_setuju' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Penelitian harus diisi!',
            'jenis_penelitian_id.required' => 'Jenis Penelitian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Sumber Dana harus dipilih!',
            'dana_setuju.required' => 'Dana Disetuju harus diisi!',
            'file.mimes' => 'Laporan Penelitian harus berformat .pdf!',
            'file.max' => 'Laporan Penelitian yang ditambahkan terlalu besar!',
        ]);
        // 
        $mahasiswas = [];
        if ($request->mahasiswas) {
            foreach ($request->mahasiswas as $mahasiswa) {
                if ($mahasiswa['nama']) {
                    $mahasiswas[$mahasiswa['nama']] = $mahasiswa['prodi'];
                }
            }
        }
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Penelitian!');
            return back()->withInput()->withErrors($validator->errors())->with('old_mahasiswas', $mahasiswas);
        }
        // 
        if ($request->file) {
            Storage::disk('local')->delete('public/uploads/' . Penelitian::where('id', $id)->value('file'));
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'penelitian/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = Penelitian::where('id', $id)->value('file');
        }
        // 
        $penelitian = Penelitian::where('id', $id)->update([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_penelitian_id' => $request->jenis_penelitian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_setuju' => $request->dana_setuju,
            'file' => $file,
            'mahasiswas' => $mahasiswas,
        ]);
        // 
        if (!$penelitian) {
            alert()->error('Error', 'Gagal memperbarui Penelitian!');
            return back();
        }
        // 
        if ($request->personels) {
            $personel_deleted = array_diff(PenelitianPersonel::where('penelitian_id', $id)->pluck('user_id')->toArray(), $request->personels);
            // 
            if ($personel_deleted) {
                foreach ($personel_deleted as $personel) {
                    PenelitianPersonel::where([
                        ['penelitian_id', $id],
                        ['user_id', $personel],
                    ])->delete();
                }
            }
            // 
            foreach ($request->personels as $personel) {
                $cek = PenelitianPersonel::where([
                    ['penelitian_id', $id],
                    ['user_id', $personel],
                ])->exists();
                if (!$cek) {
                    PenelitianPersonel::create([
                        'penelitian_id' => $id,
                        'user_id' => $personel,
                    ]);
                }
            }
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui Penelitian');
        return redirect('operator/penelitian-riwayat');
    }

    public function destroy($id)
    {
        PenelitianPersonel::where('penelitian_id', $id)->delete();
        // 
        $penelitian_revisis = PenelitianRevisi::where('penelitian_id', $id)->get();
        if (count($penelitian_revisis)) {
            foreach ($penelitian_revisis as $revisi) {
                Storage::disk('local')->delete('public/uploads/' . $revisi->file);
            }
            // 
            $penelitian_revisis->delete();
        }
        // 
        Storage::disk('local')->delete('public/uploads/' . Penelitian::where('id', $id)->value('file'));
        Penelitian::where('id', $id)->delete();
        // 
        alert()->success('Success', 'Berhasil menghapus Penelitian');
        return back();
    }
}
