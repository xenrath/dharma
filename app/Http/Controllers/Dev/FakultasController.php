<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FakultasController extends Controller
{
    public function index()
    {
        $fakultases = Fakultas::select('id', 'kode', 'nama')->paginate(10);

        return view('dev.fakultas.index', compact('fakultases'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kode' => 'required|unique:fakultas,kode',
        ], [
            'nama.required' => 'Nama Fakultas harus diisi!',
            'kode.required' => 'Singkatan harus diisi!',
            'kode.unique' => 'Singkatan sudah digunakan!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Fakultas!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $fakultas = Fakultas::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
        ]);

        if (!$fakultas) {
            alert()->error('Error', 'Gagal menambahkan Fakultas!');
            return back();
        }

        alert()->success('Success', 'Berhasil menambahkan Fakultas');

        return back();
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kode' => 'required|unique:fakultas,kode,' . $id . ',id',
        ], [
            'nama.required' => 'Nama Fakultas harus diisi!',
            'kode.required' => 'Singkatan harus diisi!',
            'kode.unique' => 'Singkatan sudah digunakan!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Fakultas!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }

        $fakultas = Fakultas::where('id', $id)->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
        ]);

        if (!$fakultas) {
            alert()->error('Error', 'Gagal memperbarui Fakultas!');
            return back();
        }

        alert()->success('Success', 'Berhasil memperbarui Fakultas');

        return back();
    }

    public function destroy($id)
    {
        $fakultas = Fakultas::where('id', $id)->delete();

        if (!$fakultas) {
            alert()->error('Error', 'Gagal menghapus Fakultas!');
            return back();
        }

        alert()->success('Success', 'Berhasil menghapus Fakultas');

        return back();
    }
}
