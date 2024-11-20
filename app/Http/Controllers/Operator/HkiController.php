<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Hki;
use App\Models\HkiPersonel;
use App\Models\JenisHki;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HkiController extends Controller
{
    public function index()
    {
        $hkis = Hki::select(
            'id',
            'user_id',
            'jenis_hki_id',
            'tahun',
            'judul',
            'nomor',
            'pendaftaran',
            'status',
            'file',
        )
            ->with('user:id,nama')
            ->with('jenis_hki:id,nama')
            ->with('hki_personels:hki_id,user_id')
            ->paginate(10);
        // 
        return view('operator.hki.index', compact('hkis'));
    }

    public function create()
    {
        $jenis_hkis = JenisHki::select('id', 'nama')->get();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('operator.hki.create', compact('jenis_hkis', 'dosens'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'tahun' => 'required',
            'judul' => 'required',
            'nomor' => 'required',
            'jenis_hki_id' => 'required',
            'pendaftaran' => 'required',
            'status' => 'required',
            // 'file' => 'required|mimes:pdf|max:2048',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'user_id.required' => 'Dosen harus dipilih!',
            'tahun.required' => 'Tahun Pelaksanaan harus diisi!',
            'judul.required' => 'Judul HKI harus diisi!',
            'nomor.required' => 'No. HKI harus diisi!',
            'jenis_hki_id.required' => 'Jenis HKI harus dipilih!',
            'pendaftaran.required' => 'No. Pendaftaran harus diisi!',
            'status.required' => 'Status harus dipilih!',
            // 'file.required' => 'File HKI harus ditambahkan!',
            'file.mimes' => 'File HKI harus berformat .pdf!',
            'file.max' => 'File HKI yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan HKI!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        if ($request->file) {
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'hki/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = null;
        }
        // 
        $hki = Hki::create([
            'user_id' => $request->user_id,
            'jenis_hki_id' => $request->jenis_hki_id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'nomor' => $request->nomor,
            'pendaftaran' => $request->pendaftaran,
            'status' => $request->status,
            'file' => $file,
        ]);
        // 
        if (!$hki) {
            alert()->error('Error', 'Gagal menambahkan HKI!');
            return back();
        }
        // 
        if ($request->personels) {
            foreach ($request->personels as $personel) {
                HkiPersonel::create([
                    'hki_id' => $hki->id,
                    'user_id' => $personel,
                ]);
            }
        }
        // 
        alert()->success('Success', 'Berhasil menambahkan HKI');
        return redirect('operator/hki');
    }

    public function edit($id)
    {
        $hki = Hki::where('id', $id)
            ->select(
                'id',
                'user_id',
                'jenis_hki_id',
                'tahun',
                'judul',
                'nomor',
                'pendaftaran',
                'status',
                'file',
            )
            ->with('user:id,nama')
            ->with('jenis_hki:id,nama')
            ->with('hki_personels:hki_id,user_id')
            ->first();
        $jenis_hkis = JenisHki::select('id', 'nama')->get();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('operator.hki.edit', compact('hki', 'jenis_hkis', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'nomor' => 'required',
            'jenis_hki_id' => 'required',
            'pendaftaran' => 'required',
            'status' => 'required',
            // 'file' => 'required|mimes:pdf|max:2048',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Pelaksanaan harus diisi!',
            'judul.required' => 'Judul HKI harus diisi!',
            'nomor.required' => 'No. HKI harus diisi!',
            'jenis_hki_id.required' => 'Jenis HKI harus dipilih!',
            'pendaftaran.required' => 'No. Pendaftaran harus diisi!',
            'status.required' => 'Status harus dipilih!',
            // 'file.required' => 'File HKI harus ditambahkan!',
            'file.mimes' => 'File HKI harus berformat .pdf!',
            'file.max' => 'File HKI yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui HKI!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        if ($request->file) {
            Storage::disk('local')->delete('public/uploads/' . Hki::where('id', $id)->value('file'));
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'hki/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = Hki::where('id', $id)->value('file');
        }
        // 
        $hki = Hki::where('id', $id)->update([
            'jenis_hki_id' => $request->jenis_hki_id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'nomor' => $request->nomor,
            'pendaftaran' => $request->pendaftaran,
            'status' => $request->status,
            'file' => $file,
        ]);
        // 
        if (!$hki) {
            alert()->error('Error', 'Gagal memperbarui HKI!');
            return back();
        }
        // 
        if ($request->personels) {
            $personel_deleted = array_diff(HkiPersonel::where('hki_id', $id)->pluck('user_id')->toArray(), $request->personels);
            // 
            if ($personel_deleted) {
                foreach ($personel_deleted as $personel) {
                    HkiPersonel::where([
                        ['hki_id', $id],
                        ['user_id', $personel],
                    ])->delete();
                }
            }
            // 
            foreach ($request->personels as $personel) {
                $cek = HkiPersonel::where([
                    ['hki_id', $id],
                    ['user_id', $personel],
                ])->exists();
                if (!$cek) {
                    HkiPersonel::create([
                        'hki_id' => $id,
                        'user_id' => $personel,
                    ]);
                }
            }
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui HKI');
        return redirect('operator/hki');
    }

    public function destroy($id)
    {
        HkiPersonel::where('hki_id', $id)->delete();
        Storage::disk('local')->delete('public/uploads/' . Hki::where('id', $id)->value('file'));
        Hki::where('id', $id)->delete();
        // 
        alert()->success('Success', 'Berhasil menghapus HKI');
        return back();
    }
}
