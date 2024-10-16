<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Pengabdian;
use Illuminate\Http\Request;

class PengabdianRiwayatController extends Controller
{
    public function index()
    {
        $pengabdians = Pengabdian::where('status', 'selesai')
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'jenis_pengabdian_id',
                'jenis_pendanaan_id',
                'dana_sumber',
                'dana_setuju',
                'file',
                'mahasiswas',
                'status',
            )
            ->with('user:id,nama')
            ->with('jenis_pengabdian:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('pengabdian_revisis', function ($query) {
                $query->select('pengabdian_id', 'keterangan', 'file');
                $query->orderByDesc('id');
            })
            ->with('personels', function ($query) {
                $query->select('pengabdian_id', 'user_id');
                $query->with('user', function ($query) {
                    $query->select('id', 'nama');
                    $query->withTrashed();
                });
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('operator.pengabdian.riwayat.index', compact('pengabdians'));
    }
}
