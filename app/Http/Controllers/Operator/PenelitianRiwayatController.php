<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Penelitian;
use Illuminate\Http\Request;

class PenelitianRiwayatController extends Controller
{
    public function index()
    {
        $penelitians = Penelitian::where('status', 'selesai')
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'jenis_penelitian_id',
                'jenis_pendanaan_id',
                'dana_sumber',
                'dana_setuju',
                'file',
                'mahasiswas',
                'status',
            )
            ->with('user:id,nama')
            ->with('jenis_penelitian:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('penelitian_revisis', function ($query) {
                $query->select('penelitian_id', 'keterangan', 'file');
                $query->orderByDesc('id');
            })
            ->with('personels', function ($query) {
                $query->select('penelitian_id', 'user_id');
                $query->with('user', function ($query) {
                    $query->select('id', 'nama');
                    $query->withTrashed();
                });
            })
            ->paginate(10);
        // 
        return view('operator.penelitian.riwayat.index', compact('penelitians'));
    }
}
