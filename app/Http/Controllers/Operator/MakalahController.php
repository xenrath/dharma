<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Makalah;
use App\Models\MakalahPersonel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MakalahController extends Controller
{
    public function index()
    {
        $makalahs = Makalah::select(
            'id',
            'user_id',
            'tahun',
            'judul',
            'forum',
            'institusi',
            'tempat',
            'tanggal_awal',
            'tanggal_akhir',
            'tingkat',
            'status',
            'file',
        )
            ->with('user:id,nama')
            ->with('makalah_personels:makalah_id,user_id')
            ->paginate(10);
        // 
        return view('operator.makalah.index', compact('makalahs'));
    }

    public function create()
    {
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('operator.makalah.create', compact('dosens'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'tahun' => 'required',
            'judul' => 'required',
            'forum' => 'required',
            'institusi' => 'required',
            'tempat' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
            'tingkat' => 'required',
            'status' => 'required',
            // 'file' => 'required|mimes:pdf|max:2048',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'user_id.required' => 'Dosen harus dipilih!',
            'tahun.required' => 'Tahun Pelaksanaan harus diisi!',
            'judul.required' => 'Judul Makalah harus diisi!',
            'forum.required' => 'Nama Forum harus diisi!',
            'institusi.required' => 'Institusi Penyelenggara harus diisi!',
            'tempat.required' => 'Tempat Pelaksanaan harus diisi!',
            'tanggal_awal.required' => 'Waktu Pelaksanaan harus diisi!',
            'tanggal_akhir.required' => 'Waktu Pelaksanaan harus diisi!',
            'tingkat.required' => 'Tingkat Publikasi harus dipilih!',
            'status.required' => 'Status Pemakalah harus dipilih!',
            // 'file.required' => 'File Makalah harus ditambahkan!',
            'file.mimes' => 'File Makalah harus berformat .pdf!',
            'file.max' => 'File Makalah yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Makalah Ilmiah!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        if ($request->file) {
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'makalah/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = null;
        }
        // 
        $makalah = Makalah::create([
            'user_id' => $request->user_id,
            'tingkat' => $request->tingkat,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'forum' => $request->forum,
            'institusi' => $request->institusi,
            'tempat' => $request->tempat,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'status' => $request->status,
            'file' => $file,
        ]);
        // 
        if (!$makalah) {
            alert()->error('Error', 'Gagal menambahkan Makalah Ilmiah!');
            return back();
        }
        // 
        if ($request->personels) {
            foreach ($request->personels as $personel) {
                MakalahPersonel::create([
                    'makalah_id' => $makalah->id,
                    'user_id' => $personel,
                ]);
            }
        }
        // 
        alert()->success('Success', 'Berhasil menambahkan Makalah Ilmiah');
        return redirect('operator/makalah');
    }

    public function edit($id)
    {
        $makalah = Makalah::where('id', $id)
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'forum',
                'institusi',
                'tempat',
                'tanggal_awal',
                'tanggal_akhir',
                'tingkat',
                'status',
                'file',
            )
            ->with('user:id,nama')
            ->with('makalah_personels:makalah_id,user_id')
            ->first();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('operator.makalah.edit', compact('makalah', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'forum' => 'required',
            'institusi' => 'required',
            'tempat' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
            'tingkat' => 'required',
            'status' => 'required',
            // 'file' => 'required|mimes:pdf|max:2048',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Pelaksanaan harus diisi!',
            'judul.required' => 'Judul Makalah harus diisi!',
            'forum.required' => 'Nama Forum harus diisi!',
            'institusi.required' => 'Institusi Penyelenggara harus diisi!',
            'tempat.required' => 'Tempat Pelaksanaan harus diisi!',
            'tanggal_awal.required' => 'Waktu Pelaksanaan harus diisi!',
            'tanggal_akhir.required' => 'Waktu Pelaksanaan harus diisi!',
            'tingkat.required' => 'Tingkat Publikasi harus dipilih!',
            'status.required' => 'Status Pemakalah harus dipilih!',
            // 'file.required' => 'File Makalah harus ditambahkan!',
            'file.mimes' => 'File Makalah harus berformat .pdf!',
            'file.max' => 'File Makalah yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Makalah Ilmiah!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        if ($request->file) {
            Storage::disk('local')->delete('public/uploads/' . Makalah::where('id', $id)->value('file'));
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'makalah/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = Makalah::where('id', $id)->value('file');
        }
        // 
        $makalah = Makalah::where('id', $id)->update([
            'tingkat' => $request->tingkat,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'forum' => $request->forum,
            'institusi' => $request->institusi,
            'tempat' => $request->tempat,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'status' => $request->status,
            'file' => $file,
        ]);
        // 
        if (!$makalah) {
            alert()->error('Error', 'Gagal memperbarui Makalah Ilmiah!');
            return back();
        }
        // 
        if ($request->personels) {
            $personel_deleted = array_diff(MakalahPersonel::where('makalah_id', $id)->pluck('user_id')->toArray(), $request->personels);
            // 
            if ($personel_deleted) {
                foreach ($personel_deleted as $personel) {
                    MakalahPersonel::where([
                        ['makalah_id', $id],
                        ['user_id', $personel],
                    ])->delete();
                }
            }
            // 
            foreach ($request->personels as $personel) {
                $cek = MakalahPersonel::where([
                    ['makalah_id', $id],
                    ['user_id', $personel],
                ])->exists();
                if (!$cek) {
                    MakalahPersonel::create([
                        'makalah_id' => $id,
                        'user_id' => $personel,
                    ]);
                }
            }
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui Makalah Ilmiah');
        return redirect('operator/makalah');
    }

    public function destroy($id)
    {
        MakalahPersonel::where('makalah_id', $id)->delete();
        Storage::disk('local')->delete('public/uploads/' . Makalah::where('id', $id)->value('file'));
        Makalah::where('id', $id)->delete();
        // 
        alert()->success('Success', 'Berhasil menghapus Makalah Ilmiah');
        return back();
    }
}
