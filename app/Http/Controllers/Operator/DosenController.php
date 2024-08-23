<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $kategori = $request->kategori;

        if ($kategori == 'peninjau') {
            $dosens = User::where([
                ['role', 'dosen'],
                ['is_peninjau', true],
            ])->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%");
                $query->orWhere('nidn', 'like', "%$keyword%");
            })
                ->select('id', 'nama', 'nidn', 'prodi_id', 'telp', 'is_peninjau')
                ->with('prodi', function ($query) {
                    $query->select('id', 'nama', 'fakultas_id');
                    $query->with('fakultas:id,kode');
                })
                ->orderBy('nama')
                ->paginate(10);
        } else {
            $dosens = User::where('role', 'dosen')->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%");
                $query->orWhere('nidn', 'like', "%$keyword%");
            })
                ->select('id', 'nama', 'nidn', 'prodi_id', 'telp', 'is_peninjau')
                ->with('prodi', function ($query) {
                    $query->select('id', 'nama', 'fakultas_id');
                    $query->with('fakultas:id,kode');
                })
                ->orderBy('nama')
                ->paginate(10);
        }

        return view('operator.dosen.index', compact('dosens'));
    }

    public function create()
    {
        $prodis = Prodi::select('id', 'nama', 'fakultas_id')
            ->with('fakultas:id,kode')
            ->orderBy('fakultas_id')
            ->get();

        return view('operator.dosen.create', compact('prodis'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nidn' => 'required|unique:users,nidn',
            'telp' => 'nullable|unique:users,telp',
            'prodi_id' => 'required',
        ], [
            'nama.required' => 'Nama Dosen tidak boleh kosong!',
            'nidn.required' => 'NIDN tidak boleh kosong!',
            'nidn.unique' => 'NIDN sudah digunakan!',
            'telp.unique' => 'Nomor WhatsApp sudah digunakan!',
            'prodi_id.required' => 'Prodi harus dipilih!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Dosen!');
            return back()->withInput()->withErrors($validator);
        }

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->nidn,
            'password' => bcrypt('bhamada'),
            'nidn' => $request->nidn,
            'prodi_id' => $request->prodi_id,
            'telp' => $request->telp,
            'is_ketua' => false,
            'is_peninjau' => $request->is_peninjau,
            'role' => 'dosen',
        ]);

        if (!$user) {
            alert()->error('Error', 'Gagal menambahkan Dosen!');
            return back();
        }

        alert()->success('Success', 'Berhasil menambahkan Dosen');

        return redirect('operator/dosen');
    }

    public function edit($id)
    {
        $dosen = User::where([
            ['id', $id],
            ['role', 'dosen'],
        ])
            ->select('id', 'nama', 'nidn', 'prodi_id', 'telp', 'is_peninjau')
            ->first();

        $prodis = Prodi::select('id', 'nama', 'fakultas_id')
            ->with('fakultas:id,kode')
            ->orderBy('fakultas_id')
            ->get();

        return view('operator.dosen.edit', compact('dosen', 'prodis'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nidn' => 'required|unique:users,nidn,' . $id . ',id',
            'telp' => 'nullable|unique:users,telp,' . $id . ',id',
            'prodi_id' => 'required',
        ], [
            'nama.required' => 'Nama Dosen tidak boleh kosong!',
            'nidn.required' => 'NIDN tidak boleh kosong!',
            'nidn.unique' => 'NIDN sudah digunakan!',
            'telp.unique' => 'Nomor WhatsApp sudah digunakan!',
            'prodi_id.required' => 'Prodi harus dipilih!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Dosen!');
            return back()->withInput()->withErrors($validator);
        }

        $user = User::where('id', $id)->update([
            'nama' => $request->nama,
            'username' => $request->nidn,
            'nidn' => $request->nidn,
            'prodi_id' => $request->prodi_id,
            'telp' => $request->telp,
            'is_peninjau' => $request->is_peninjau,
        ]);

        if (!$user) {
            alert()->error('Error', 'Gagal memperbarui Dosen!');
            return back();
        }

        alert()->success('Success', 'Berhasil memperbarui Dosen');

        return redirect('operator/dosen');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();

        if (!$user) {
            alert()->error('Error', 'Gagal menghapus Dosen!');
            return back();
        }

        alert()->success('Success', 'Berhasil menghapus Dosen');

        return back();
    }

    public function reset($id)
    {
        $user = User::where([
            ['role', 'dosen'],
            ['id', $id],
        ])->update([
            'password' => bcrypt('bhamada'),
        ]);

        if (!$user) {
            alert()->error('Error', 'Gagal mereset password Dosen!');
            return back();
        }

        alert()->success('Success', 'Berhasil mereset password Dosen');

        return back();
    }
}
