<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Proposal;

class ProposalRiwayatController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where('status', 'pendanaan')
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
                'berkas',
                'peninjau_id',
                'jadwal_id',
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
            ->with('proposal_revisis', function ($query) {
                $query->select('proposal_id', 'user_id', 'keterangan', 'file');
                $query->orderByDesc('id');
            })
            ->paginate(10);

        return view('operator.proposal.riwayat.index', compact('proposals'));
    }
}
