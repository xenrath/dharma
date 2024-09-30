<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'dev')
            ->select('id', 'nama', 'role', 'telp', 'nidn', 'nipy', 'prodi_id', 'is_ketua', 'is_peninjau')
            ->with('prodi:id,nama')
            ->orderBy('role')
            ->orderBy('nama')
            ->paginate(10);

        return view('dev.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $role = $request->role;

        if ($role == 'operator') {
            return redirect('dev/user/operator');
        } elseif ($role == 'dosen') {
            return redirect('dev/user/dosen');
        } else {
            alert()->error('Gagal menambahkan User!');
            return back();
        }
    }

    public function create_operator()
    {
        return view('dev.user.create_operator');
    }

    public function create_dosen()
    {
        $prodis = Prodi::select('id', 'nama')->get();

        return view('dev.user.create_dosen', compact('prodis'));
    }

    public function store_operator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:users,username',
        ], [
            'nama.required' => 'Nama Lengkap harus diisi!',
            'username.required' => 'Username harus diisi!',
            'username.unique' => 'Username sudah digunakan!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Operator!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt('bhamada'),
            'role' => 'operator'
        ]);

        if (!$user) {
            alert()->error('Error', 'Gagal menambahkan Operator!');
            return back();
        }

        alert()->success('Success', 'Berhasil menambahkan Operator');
        return redirect('dev/user');
    }

    public function store_dosen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nidn' => 'required|unique:users,nidn',
            'prodi_id' => 'required',
        ], [
            'nama.required' => 'Nama Lengkap harus diisi!',
            'nidn.required' => 'NIDN harus diisi!',
            'nidn.unique' => 'NIDN sudah digunakan!',
            'prodi_id.required' => 'Prodi harus dipilih!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal menambahkan Dosen!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->nidn,
            'nidn' => $request->nidn,
            'prodi_id' => $request->prodi_id,
            'is_ketua' => $request->is_ketua ? true : false,
            'is_peninjau' => $request->is_peninjau ? true : false,
            'password' => bcrypt('bhamada'),
            'role' => 'dosen'
        ]);

        if (!$user) {
            alert()->error('Error', 'Gagal menambahkan Dosen!');
            return back();
        }

        alert()->success('Success', 'Berhasil menambahkan Dosen');
        return redirect('dev/user');
    }

    public function edit($id)
    {
        $role = User::where('id', $id)->value('role');

        if ($role == 'operator') {
            return redirect('dev/user/operator/' . $id);
        } elseif ($role == 'dosen') {
            return redirect('dev/user/dosen/' . $id);
        } else {
            alert()->error('Gagal mengedit User!');
            return back();
        }
    }

    public function edit_operator($id)
    {
        $user = User::where('id', $id)->select('id', 'nama', 'username')->first();

        return view('dev.user.edit_operator', compact('user'));
    }

    public function edit_dosen($id)
    {
        $user = User::where('id', $id)->select('id', 'nama', 'nidn', 'prodi_id', 'is_ketua', 'is_peninjau')->first();
        $prodis = Prodi::select('id', 'nama')->get();

        return view('dev.user.edit_dosen', compact('user', 'prodis'));
    }

    public function update_operator(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'username' => 'required|unique:users,username,' . $id . ',id',
        ], [
            'nama.required' => 'Nama Lengkap harus diisi!',
            'username.required' => 'Username harus diisi!',
            'username.unique' => 'Username sudah digunakan!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Operator!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $user = User::where('id', $id)->update([
            'nama' => $request->nama,
            'username' => $request->username,
        ]);

        if (!$user) {
            alert()->error('Error', 'Gagal memperbarui Operator!');
            return back();
        }

        alert()->success('Success', 'Berhasil memperbarui Operator');
        return redirect('dev/user');
    }

    public function update_dosen(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nidn' => 'required|unique:users,nidn,' . $id . ',id',
            'prodi_id' => 'required',
        ], [
            'nama.required' => 'Nama Lengkap harus diisi!',
            'nidn.required' => 'NIDN harus diisi!',
            'nidn.unique' => 'NIDN sudah digunakan!',
            'prodi_id.required' => 'Prodi harus dipilih!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Dosen!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $user = User::where('id', $id)->update([
            'nama' => $request->nama,
            'username' => $request->nidn,
            'nidn' => $request->nidn,
            'prodi_id' => $request->prodi_id,
            'is_ketua' => $request->is_ketua ? true : false,
            'is_peninjau' => $request->is_peninjau ? true : false,
        ]);

        if (!$user) {
            alert()->error('Error', 'Gagal memperbarui Dosen!');
            return back();
        }

        alert()->success('Success', 'Berhasil memperbarui Dosen');
        return redirect('dev/user');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();

        if (!$user) {
            alert()->error('Error', 'Gagal menghapus User!');
            return back();
        }

        alert()->success('Success', 'Berhasil menghapus User');
        return back();
    }

    public function reset($id)
    {
        $user = User::where('id', $id)->update([
            'password' => bcrypt('bhamada'),
        ]);

        if (!$user) {
            alert()->error('Error', 'Gagal melakukan Reset Password!');
            return back();
        }

        alert()->success('Success', 'Berhasil melakukan Reset Password');
        return back();
    }

    public function trash()
    {
        $users = User::where('role', '!=', 'dev')
            ->select('id', 'nama', 'role', 'telp', 'nidn', 'nipy', 'prodi_id', 'is_ketua', 'is_peninjau')
            ->onlyTrashed()
            ->with('prodi:id,nama')
            ->orderBy('role')
            ->orderBy('nama')
            ->paginate(10);

        return view('dev.user.trash', compact('users'));
    }

    public function restore($id = null)
    {
        if ($id) {
            $user = User::onlyTrashed()->where('id', $id)->restore();

            if (!$user) {
                alert()->error('Error', 'Gagal merestore User!');
                return back();
            }

            alert()->success('Success', 'Berhasil merestore User');
            return back();
        } else {
            $user = User::onlyTrashed()->restore();

            if (!$user) {
                alert()->error('Error', 'Gagal merestore semua User!');
                return back();
            }

            alert()->success('Success', 'Berhasil merestore semua User');
            return back();
        }
    }

    public function delete($id = null)
    {
        if ($id) {
            try {
                User::onlyTrashed()->where('id', $id)->forceDelete();
            } catch (Exception $exception) {
                alert()->error('Error', 'Gagal menghapus User!');
                return back();
            }

            alert()->success('Success', 'Berhasil menghapus User');
            return back();
        } else {
            $users = User::onlyTrashed()->get();

            $jumlah = 0;
            foreach ($users as $user) {
                try {
                    User::onlyTrashed()->where('id', $user->id)->forceDelete();
                } catch (Exception $exception) {
                    $jumlah += 1;
                }
            }

            if ($jumlah) {
                alert()->warning('Warning', $jumlah . ' user tidak dapat dihapus!');
            } else {
                alert()->success('Success', 'Berhasil menghapus User');
            }

            return back();
        }
    }
}
