<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\BukuPersonel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::where('user_id', auth()->user()->id)
            ->orWhereHas('buku_personels', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'isbn',
                'jumlah',
                'penerbit',
                'file',
            )
            ->with('user:id,nama')
            ->with('buku_personels', function ($query) {
                $query->select('buku_id', 'user_id');
                $query->with('user:id,nama');
            })
            ->paginate(10);
        // 
        return view('dosen.buku.index', compact('bukus'));
    }

    public function create()
    {
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dosen.buku.create', compact('dosens'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'isbn' => 'required',
            'jumlah' => 'required',
            'penerbit' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Penerbitan harus diisi!',
            'judul.required' => 'Judul Buku harus diisi!',
            'isbn.required' => 'ISBN harus diisi!',
            'jumlah.required' => 'Jumlah Halaman harus diisi!',
            'penerbit.required' => 'Penerbit harus diisi!',
            'file.required' => 'File Jurnal harus ditambahkan!',
            'file.mimes' => 'File Jurnal harus berformat .pdf!',
            'file.max' => 'File Jurnal yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Buku Ajar!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $random = rand(10, 99);
        $file = 'buku/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        $buku = Buku::create([
            'user_id' => auth()->user()->id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'isbn' => $request->isbn,
            'jumlah' => $request->jumlah,
            'penerbit' => $request->penerbit,
            'file' => $file,
        ]);
        // 
        if (!$buku) {
            alert()->error('Error', 'Gagal menambahkan Buku Ajar!');
            return back();
        }
        // 
        if ($request->personels) {
            foreach ($request->personels as $personel) {
                BukuPersonel::create([
                    'buku_id' => $buku->id,
                    'user_id' => $personel,
                ]);
            }
        }
        // 
        alert()->success('Success', 'Berhasil menambahkan Buku Ajar');
        return redirect('dosen/buku');
    }

    public function edit($id)
    {
        if (Buku::where('id', $id)->value('user_id') != auth()->user()->id) {
            return view('error.500');
        }
        // 
        $buku = Buku::where('id', $id)
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'isbn',
                'jumlah',
                'penerbit',
                'file',
            )
            ->with('user:id,nama')
            ->with('buku_personels:buku_id,user_id')
            ->first();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dosen.buku.edit', compact('buku', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'isbn' => 'required',
            'jumlah' => 'required',
            'penerbit' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Penerbitan harus diisi!',
            'judul.required' => 'Judul Buku harus diisi!',
            'isbn.required' => 'ISBN harus diisi!',
            'jumlah.required' => 'Jumlah Halaman harus diisi!',
            'penerbit.required' => 'Penerbit harus diisi!',
            'file.mimes' => 'File Jurnal harus berformat .pdf!',
            'file.max' => 'File Jurnal yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Buku Ajar!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        if ($request->file) {
            Storage::disk('local')->delete('public/uploads/' . Buku::where('id', $id)->value('file'));
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'buku/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = Buku::where('id', $id)->value('file');
        }
        // 
        $buku = Buku::where('id', $id)->update([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'isbn' => $request->isbn,
            'jumlah' => $request->jumlah,
            'penerbit' => $request->penerbit,
            'file' => $file,
        ]);
        // 
        if (!$buku) {
            alert()->error('Error', 'Gagal memperbarui Buku Ajar!');
            return back();
        }
        // 
        if ($request->personels) {
            $personel_deleted = array_diff(BukuPersonel::where('buku_id', $id)->pluck('user_id')->toArray(), $request->personels);
            // 
            if ($personel_deleted) {
                foreach ($personel_deleted as $personel) {
                    BukuPersonel::where([
                        ['buku_id', $id],
                        ['user_id', $personel],
                    ])->delete();
                }
            }
            // 
            foreach ($request->personels as $personel) {
                $cek = BukuPersonel::where([
                    ['buku_id', $id],
                    ['user_id', $personel],
                ])->exists();
                if (!$cek) {
                    BukuPersonel::create([
                        'buku_id' => $id,
                        'user_id' => $personel,
                    ]);
                }
            }
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui Buku Ajar');
        return redirect('dosen/buku');
    }

    public function destroy($id)
    {
        if (Buku::where('id', $id)->value('user_id') != auth()->user()->id) {
            return view('error.500');
        }
        // 
        BukuPersonel::where('buku_id', $id)->delete();
        Storage::disk('local')->delete('public/uploads/' . Buku::where('id', $id)->value('file'));
        Buku::where('id', $id)->delete();
        // 
        alert()->success('Success', 'Berhasil menghapus Buku Ajar');
        return redirect('dosen/buku');
    }
}
