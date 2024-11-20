<?php

namespace App\Http\Controllers\Dosen;

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
        $makalahs = Makalah::where('user_id', auth()->user()->id)
            ->orWhereHas('makalah_personels', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
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
            ->with('makalah_personels', function ($query) {
                $query->select('makalah_id', 'user_id');
                $query->with('user:id,nama');
            })
            ->paginate(10);
        // 
        return view('dosen.makalah.index', compact('makalahs'));
    }

    public function create()
    {
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dosen.makalah.create', compact('dosens'));
    }

    public function store(Request $request)
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
            'file' => 'required|mimes:pdf|max:2048',
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
            'file.required' => 'File Makalah harus ditambahkan!',
            'file.mimes' => 'File Makalah harus berformat .pdf!',
            'file.max' => 'File Makalah yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Makalah Ilmiah!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $random = rand(10, 99);
        $file = 'makalah/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        $makalah = Makalah::create([
            'user_id' => auth()->user()->id,
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
        return redirect('dosen/makalah');
    }

    public function edit($id)
    {
        if (Makalah::where('id', $id)->value('user_id') != auth()->user()->id) {
            return view('error.500');
        }
        // 
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
        return view('dosen.makalah.edit', compact('makalah', 'dosens'));
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
        return redirect('dosen/makalah');
    }

    public function destroy($id)
    {
        if (Makalah::where('id', $id)->value('user_id') != auth()->user()->id) {
            return view('error.500');
        }
        // 
        MakalahPersonel::where('makalah_id', $id)->delete();
        Storage::disk('local')->delete('public/uploads/' . Makalah::where('id', $id)->value('file'));
        Makalah::where('id', $id)->delete();
        // 
        alert()->success('Success', 'Berhasil menghapus Makalah Ilmiah');
        return back();
    }
}
