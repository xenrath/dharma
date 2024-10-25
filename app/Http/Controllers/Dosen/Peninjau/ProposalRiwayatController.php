<?php

namespace App\Http\Controllers\Dosen\Peninjau;

use App\Http\Controllers\Controller;
use App\Models\Proposal;

class ProposalRiwayatController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where([
            ['peninjau_id', auth()->user()->id],
            ['status', '!=', 'menunggu'],
            ['status', '!=', 'proses'],
            ['status', '!=', 'revisi1'],
        ])
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
                'file',
                'mahasiswas',
                'tanggal',
                'jam',
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
            ->orderByDesc('tanggal')
            ->orderByDesc('jam')
            ->paginate(10);

        return view('dosen.peninjau.riwayat.index', compact('proposals'));
    }
}
