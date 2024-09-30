<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::select('id', 'fakultas_id', 'nama')->with('fakultas')->paginate(10);
        $fakultases = Fakultas::select('id', 'nama')->get();

        return view('dev.prodi.index', compact('prodis', 'fakultases'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'fakultas_id' => 'required',
        ], [
            'nama.required' => 'Nama Prodi harus diisi!',
            'fakultas_id.required' => 'Fakultas harus dipilih!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Prodi!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $prodi = Prodi::create([
            'nama' => $request->nama,
            'fakultas_id' => $request->fakultas_id,
        ]);

        if (!$prodi) {
            alert()->error('Error', 'Gagal menambahkan Prodi!');
            return back();
        }

        alert()->success('Success', 'Berhasil menambahkan Prodi');

        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'fakultas_id' => 'required',
        ], [
            'nama.required' => 'Nama Prodi harus diisi!',
            'fakultas_id.required' => 'Fakultas harus dipilih!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Prodi!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }

        $prodi = Prodi::where('id', $id)->update([
            'nama' => $request->nama,
            'fakultas_id' => $request->fakultas_id,
        ]);

        if (!$prodi) {
            alert()->error('Error', 'Gagal memperbarui Prodi!');
            return back();
        }

        alert()->success('Success', 'Berhasil memperbarui Prodi');

        return back();
    }

    public function destroy($id)
    {
        $prodi = Prodi::where('id', $id)->delete();

        if (!$prodi) {
            alert()->error('Error', 'Gagal menghapus Prodi!');
            return back();
        }

        alert()->success('Success', 'Berhasil menghapus Prodi');

        return back();
    }
}
