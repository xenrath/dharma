<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalRiwayatController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where('status', 'selesai')
            ->where(function ($query) {
                $query->where('user_id', auth()->user()->id);
                $query->orWhereHas('personels', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })
            ->select(
                'id',
                'jenis',
                'user_id',
                'tahun',
                'judul',
                'jenis_pendanaan_id',
                'jenis_penelitian_id',
                'jenis_pengabdian_id',
                'dana_usulan',
                'dana_setuju',
                'file',
                'mahasiswas',
                'tanggal',
                'jam',
                'peninjau_id',
                'jadwal_id',
                'mou',
                'status',
            )
            ->with('user:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('jenis_penelitian:id,nama')
            ->with('jenis_pengabdian:id,nama')
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
        // 
        return view('dosen.proposal.riwayat.index', compact('proposals'));
    }
}
