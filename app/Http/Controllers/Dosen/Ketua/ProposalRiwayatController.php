<?php

namespace App\Http\Controllers\Dosen\Ketua;

use App\Http\Controllers\Controller;
use App\Models\Proposal;

class ProposalRiwayatController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where('status', 'selesai')
            ->select(
                'id',
                'jenis',
                'user_id',
                'tahun',
                'judul',
                'jenis_penelitian_id',
                'jenis_pengabdian_id',
                'jenis_pendanaan_id',
                'dana_sumber',
                'dana_usulan',
                'dana_setuju',
                'file',
                'mahasiswas',
                'peninjau_id',
                'jadwal_id',
                'status',
            )
            ->with('user:id,nama')
            ->with('jenis_penelitian:id,nama')
            ->with('jenis_pengabdian:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('peninjau:id,nama')
            ->with('personels', function ($query) {
                $query->select('proposal_id', 'user_id');
                $query->with('user', function ($query) {
                    $query->select('id', 'nama');
                    $query->withTrashed();
                });
            })
            ->with('proposal_revisis', function ($query) {
                $query->select('proposal_id', 'user_id', 'file', 'keterangan');
                $query->orderByDesc('id');
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('dosen.ketua.riwayat.index', compact('proposals'));
    }
}
