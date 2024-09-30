<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::select(
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
            'berkas',
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
            ->paginate(10);

        return view('dev.proposal.index', compact('proposals'));
    }
}
