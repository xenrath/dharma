<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\JenisPendanaan;
use App\Models\JenisPengabdian;
use App\Models\Pengabdian;
use App\Models\PengabdianPersonel;
use App\Models\PengabdianRevisi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PengabdianController extends Controller
{
    public function index()
    {
        $pengabdians = Pengabdian::select(
            'id',
            'user_id',
            'tahun',
            'judul',
            'jenis_pengabdian_id',
            'jenis_pendanaan_id',
            'dana_setuju',
            'file',
            'mahasiswas',
            'status',
        )
            ->with('user:id,nama')
            ->with('jenis_pengabdian:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('personels', function ($query) {
                $query->select('pengabdian_id', 'user_id');
                $query->with('user:id,nama');
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('dev.pengabdian.index', compact('pengabdians'));
    }

    public function create()
    {
        $jenis_pengabdians = JenisPengabdian::select('id', 'nama')->get();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dev.pengabdian.create', compact(
            'jenis_pengabdians',
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
            'jenis_pengabdian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_setuju' => 'required',
            // 'file' => 'required|mimes:pdf|max:2048',
            'file' => 'nullable|mimes:pdf|max:2048',
            'status' => 'required',
        ], [
            'user_id.required' => 'Dosen harus dipilih!',
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Pengabdian harus diisi!',
            'jenis_pengabdian_id.required' => 'Sumber Dana harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_setuju.required' => 'Dana Usulan harus diisi!',
            // 'file.required' => 'Laporan Pengabdian harus ditambahkan!',
            'file.mimes' => 'Laporan Pengabdian harus berformat .pdf!',
            'file.max' => 'Laporan Pengabdian yang ditambahkan terlalu besar!',
            'status.required' => 'Status harus dipilih!',
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
            alert()->error('Error', 'Gagal membuat Pengabdian!');
            return back()->withInput()->withErrors($validator->errors())->with('old_mahasiswas', $mahasiswas);
        }
        // 
        if ($request->file) {
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'pengabdian/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = null;
        }
        // 
        $pengabdian = Pengabdian::create([
            'user_id' => $request->user_id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_pengabdian_id' => $request->jenis_pengabdian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_setuju' => $request->dana_setuju,
            'file' => $file,
            'mahasiswas' => $mahasiswas,
            'status' => $request->status,
        ]);
        // 
        if (!$pengabdian) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back();
        }
        // 
        if ($request->personels) {
            foreach ($request->personels as $personel) {
                PengabdianPersonel::create([
                    'pengabdian_id' => $pengabdian->id,
                    'user_id' => $personel,
                ]);
            }
        }
        // 
        alert()->success('Success', 'Berhasil membuat Pengabdian');
        return redirect('dev/pengabdian');
    }

    public function edit($id)
    {
        $pengabdian = Pengabdian::where('id', $id)
            ->select(
                'id',
                'tahun',
                'user_id',
                'judul',
                'jenis_pengabdian_id',
                'jenis_pendanaan_id',
                'dana_setuju',
                'file',
                'mahasiswas',
                'status',
            )
            ->with('user:id,nama')
            ->with('personels:pengabdian_id,user_id')
            ->first();
        $jenis_pengabdians = JenisPengabdian::select('id', 'nama')->get();
        $jenis_pengabdians = JenisPengabdian::select('id', 'nama')->get();
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

        return view('dev.pengabdian.edit', compact(
            'pengabdian',
            'jenis_pengabdians',
            'jenis_pengabdians',
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
            'jenis_pengabdian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_setuju' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
            'status' => 'required',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Pengabdian harus diisi!',
            'jenis_pengabdian_id.required' => 'Sumber Dana harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_setuju.required' => 'Dana Disetuju harus diisi!',
            'file.mimes' => 'Laporan Pengabdian harus berformat .pdf!',
            'file.max' => 'Laporan Pengabdian yang ditambahkan terlalu besar!',
            'status.required' => 'Status harus dipilih!',
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
            alert()->error('Error', 'Gagal memperbarui Pengabdian!');
            return back()->withInput()->withErrors($validator->errors())->with('old_mahasiswas', $mahasiswas);
        }
        // 
        if ($request->file) {
            Storage::disk('local')->delete('public/uploads/' . Pengabdian::where('id', $id)->value('file'));
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'pengabdian/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = Pengabdian::where('id', $id)->value('file');
        }
        // 
        $pengabdian = Pengabdian::where('id', $id)->update([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_pengabdian_id' => $request->jenis_pengabdian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_setuju' => $request->dana_setuju,
            'file' => $file,
            'mahasiswas' => $mahasiswas,
            'status' => $request->status,
        ]);
        // 
        if (!$pengabdian) {
            alert()->error('Error', 'Gagal memperbarui Pengabdian!');
            return back();
        }
        // 
        if ($request->personels) {
            $personel_deleted = array_diff(PengabdianPersonel::where('pengabdian_id', $id)->pluck('user_id')->toArray(), $request->personels);
            // 
            if ($personel_deleted) {
                foreach ($personel_deleted as $personel) {
                    PengabdianPersonel::where([
                        ['pengabdian_id', $id],
                        ['user_id', $personel],
                    ])->delete();
                }
            }
            // 
            foreach ($request->personels as $personel) {
                $cek = PengabdianPersonel::where([
                    ['pengabdian_id', $id],
                    ['user_id', $personel],
                ])->exists();
                if (!$cek) {
                    PengabdianPersonel::create([
                        'pengabdian_id' => $id,
                        'user_id' => $personel,
                    ]);
                }
            }
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui Pengabdian');
        return redirect('dev/pengabdian');
    }

    public function destroy($id)
    {
        PengabdianPersonel::where('pengabdian_id', $id)->delete();
        // 
        $pengabdian_revisis = PengabdianRevisi::where('pengabdian_id', $id)->get();
        if (count($pengabdian_revisis)) {
            foreach ($pengabdian_revisis as $revisi) {
                Storage::disk('local')->delete('public/uploads/' . $revisi->file);
            }
            // 
            $pengabdian_revisis->delete();
        }
        // 
        Storage::disk('local')->delete('public/uploads/' . Pengabdian::where('id', $id)->value('file'));
        Pengabdian::where('id', $id)->delete();
        // 
        alert()->success('Success', 'Berhasil menghapus Pengabdian');
        return redirect('dev/pengabdian');
    }
}
