<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $user = User::where('id', auth()->user()->id)
            ->select(
                'nama',
                'nidn',
                'prodi_id',
                'telp',
                'role'
            )
            ->first();

        return view('profile', compact('user'));
    }

    public function profile_proses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nidn' => 'required|unique:users,nidn,' . auth()->user()->id . ',id',
            'telp' => 'required|unique:users,telp,' . auth()->user()->id . ',id',
        ], [
            'nama.required' => 'Nama Dosen tidak boleh kosong!',
            'nidn.required' => 'NIDN tidak boleh kosong!',
            'nidn.unique' => 'NIDN sudah digunakan!',
            'telp.required' => 'Nomor WhatsApp tidak boleh kosong!',
            'telp.unique' => 'Nomor WhatsApp sudah digunakan!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Profile!');
            return back()->withInput()->withErrors($validator);
        }

        $user = User::where('id', auth()->user()->id)->update([
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'telp' => $request->telp,
        ]);

        if (!$user) {
            alert()->error('Error', 'Gagal memperbarui Profile!');
            return back();
        }

        alert()->success('Success', 'Berhasil memperbarui Profile');
        return back();
    }

    public function ketua_search(Request $request)
    {
        $keyword = $request->keyword;

        $dosens = User::where('role', 'dosen')
            ->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%");
                $query->orWhere('nidn', 'like', "%$keyword%");
            })
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->get();

        return $dosens;
    }

    public function ketua_set($id)
    {
        $dosen = User::where([
            ['role', 'dosen'],
            ['id', $id],
        ])
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->first();

        return $dosen;
    }

    public function personel_search(Request $request)
    {
        $keyword = $request->keyword;

        $dosens = User::where([
            ['role', 'dosen'],
            ['id', '!=', auth()->user()->id],
        ])
            ->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%");
                $query->orWhere('nidn', 'like', "%$keyword%");
            })
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->get();

        return $dosens;
    }

    public function personel_get(Request $request)
    {
        $personel_item = $request->personel_item ?? array();

        if (count($personel_item)) {
            $dosens = User::where('role', 'dosen')
                ->whereIn('id', $personel_item)
                ->select('id', 'nidn', 'nama')
                ->orderBy('nama')
                ->get();

            return $dosens;
        } else {
            return array();
        }
    }

    public function hubungi($telp)
    {
        $agent = new Agent;
        $desktop = $agent->isDesktop();

        if ($desktop) {
            return redirect()->away('https://web.whatsapp.com/send?phone=+62' . $telp);
        } else {
            return redirect()->away('https://wa.me/+62' . $telp);
        }
    }
}
