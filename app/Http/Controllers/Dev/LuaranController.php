<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\JenisLuaran;
use App\Models\Luaran;
use App\Models\LuaranPersonel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LuaranController extends Controller
{
    public function index()
    {
        $luarans = Luaran::paginate(10);
        // 
        return view('dev.luaran.index', compact('luarans'));
    }

    public function create()
    {
        $jenis_luarans = JenisLuaran::select('id', 'nama')->get();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dev.luaran.create', compact('jenis_luarans', 'dosens'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_luaran_id' => 'required',
            'deskripsi' => 'required',
            'url' => 'required',
            // 'file' => 'required|mimes:pdf|max:2048',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'user_id.required' => 'Dosen harus dipilih!',
            'tahun.required' => 'Tahun Pelaksanaan harus diisi!',
            'judul.required' => 'Judul Luaran harus diisi!',
            'jenis_luaran_id.required' => 'Jenis Luaran harus diisi!',
            'deskripsi.required' => 'Deskripsi harus diisi!',
            'url.required' => 'URL harus diisi!',
            // 'file.required' => 'File Luaran harus ditambahkan!',
            'file.mimes' => 'File Luaran harus berformat .pdf!',
            'file.max' => 'File Luaran yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Luaran!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        if ($request->file) {
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'luaran/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = null;
        }
        // 
        $luaran = Luaran::create([
            'user_id' => $request->user_id,
            'jenis_luaran_id' => $request->jenis_luaran_id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'url' => $request->url,
            'deskripsi' => $request->deskripsi,
            'file' => $file,
        ]);
        // 
        if (!$luaran) {
            alert()->error('Error', 'Gagal menambahkan Luaran!');
            return back();
        }
        // 
        if ($request->personels) {
            foreach ($request->personels as $personel) {
                LuaranPersonel::create([
                    'luaran_id' => $luaran->id,
                    'user_id' => $personel,
                ]);
            }
        }
        // 
        alert()->success('Success', 'Berhasil menambahkan Luaran');
        return redirect('dev/luaran');
    }

    public function edit($id)
    {
        $luaran = Luaran::where('id', $id)
            ->select(
                'id',
                'user_id',
                'jenis_luaran_id',
                'tahun',
                'judul',
                'deskripsi',
                'url',
                'file',
            )
            ->with('user:id,nama')
            ->with('jenis_luaran:id,nama')
            ->with('luaran_personels:luaran_id,user_id')
            ->first();
        $jenis_luarans = JenisLuaran::select('id', 'nama')->get();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dev.luaran.edit', compact('luaran', 'jenis_luarans', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_luaran_id' => 'required',
            'deskripsi' => 'required',
            'url' => 'required',
            // 'file' => 'required|mimes:pdf|max:2048',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Pelaksanaan harus diisi!',
            'judul.required' => 'Judul Luaran harus diisi!',
            'jenis_luaran_id.required' => 'Jenis Luaran harus diisi!',
            'deskripsi.required' => 'Deskripsi harus diisi!',
            'url.required' => 'URL harus diisi!',
            // 'file.required' => 'File Luaran harus ditambahkan!',
            'file.mimes' => 'File Luaran harus berformat .pdf!',
            'file.max' => 'File Luaran yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Luaran!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        if ($request->file) {
            Storage::disk('local')->delete('public/uploads/' . Luaran::where('id', $id)->value('file'));
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'luaran/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = Luaran::where('id', $id)->value('file');
        }
        // 
        $luaran = Luaran::where('id', $id)->update([
            'jenis_luaran_id' => $request->jenis_luaran_id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'url' => $request->url,
            'file' => $file,
        ]);
        // 
        if (!$luaran) {
            alert()->error('Error', 'Gagal memperbarui Luaran!');
            return back();
        }
        // 
        if ($request->personels) {
            $personel_deleted = array_diff(LuaranPersonel::where('luaran_id', $id)->pluck('user_id')->toArray(), $request->personels);
            // 
            if ($personel_deleted) {
                foreach ($personel_deleted as $personel) {
                    LuaranPersonel::where([
                        ['luaran_id', $id],
                        ['user_id', $personel],
                    ])->delete();
                }
            }
            // 
            foreach ($request->personels as $personel) {
                $cek = LuaranPersonel::where([
                    ['luaran_id', $id],
                    ['user_id', $personel],
                ])->exists();
                if (!$cek) {
                    LuaranPersonel::create([
                        'luaran_id' => $id,
                        'user_id' => $personel,
                    ]);
                }
            }
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui Luaran');
        return redirect('dev/luaran');
    }

    public function destroy($id)
    {
        LuaranPersonel::where('luaran_id', $id)->delete();
        Storage::disk('local')->delete('public/uploads/' . Luaran::where('id', $id)->value('file'));
        Luaran::where('id', $id)->delete();
        // 
        alert()->success('Success', 'Berhasil menghapus Luaran');
        return back();
    }
}
