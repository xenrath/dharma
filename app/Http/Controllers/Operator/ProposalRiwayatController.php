<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Proposal;

class ProposalRiwayatController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where('status', 'setuju2')
            ->orWhere('status', 'selesai')
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
                'mou',
                'status',
            )
            ->with('user:id,nama')
            ->with('jenis_penelitian:id,nama')
            ->with('jenis_pengabdian:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('personels', function ($query) {
                $query->select('proposal_id', 'user_id');
                $query->with('user:id,nama');
            })
            ->with('peninjau:id,nama')
            ->orderByDesc('id')
            ->paginate(10);

        return view('operator.proposal.riwayat.index', compact('proposals'));
    }
}
