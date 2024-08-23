<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProposalLaporanController extends Controller
{
    public function index(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai ?? Carbon::now()->format('Y-m-d');

        if ($dari) {
            $proposals = Proposal::where('status', 'proses')
                ->whereBetween('tanggal', array($dari, $sampai))
                ->select(
                    'id',
                    'jenis',
                    'user_id',
                    'tahun',
                    'judul',
                    'jenis_pendanaan_id',
                    'dana_sumber',
                    'dana_usulan',
                    'berkas',
                    'tanggal',
                    'jam',
                    'peninjau_id',
                    'status',
                )
                ->with('user:id,nama')
                ->with('jenis_pendanaan:id,nama')
                ->with('personels', function ($query) {
                    $query->select('proposal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->with('peninjau:id,nama')
                ->paginate(10);
        } else {
            $proposals = Proposal::where('status', 'proses')
                ->select(
                    'id',
                    'jenis',
                    'user_id',
                    'tahun',
                    'judul',
                    'jenis_pendanaan_id',
                    'dana_sumber',
                    'dana_usulan',
                    'berkas',
                    'tanggal',
                    'jam',
                    'peninjau_id',
                    'status',
                )
                ->with('user:id,nama')
                ->with('jenis_pendanaan:id,nama')
                ->with('personels', function ($query) {
                    $query->select('proposal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->with('peninjau:id,nama')
                ->paginate(10);
        }

        return view('operator.proposal.laporan.index', compact('proposals'));
    }

    public function print(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai ?? Carbon::now()->format('Y-m-d');

        if ($dari) {
            $proposal_penelitians = Proposal::where([
                ['jenis', 'penelitian'],
                ['status', 'proses'],
            ])
                ->whereBetween('tanggal', array($dari, $sampai))
                ->select(
                    'user_id',
                    'judul',
                    'tanggal',
                    'jam',
                    'peninjau_id',
                )
                ->with('user', function ($query) {
                    $query->select('id', 'nama', 'prodi_id')->with('prodi:id,nama');
                })
                ->with('personels', function ($query) {
                    $query->select('proposal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->with('peninjau:id,nama')
                ->get();
            $proposal_pengabdians = Proposal::where([
                ['jenis', 'pengabdian'],
                ['status', 'proses'],
            ])
                ->whereBetween('tanggal', array($dari, $sampai))
                ->select(
                    'user_id',
                    'judul',
                    'tanggal',
                    'jam',
                    'peninjau_id',
                )
                ->with('user', function ($query) {
                    $query->select('id', 'nama', 'prodi_id')->with('prodi:id,nama');
                })
                ->with('personels', function ($query) {
                    $query->select('proposal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->with('peninjau:id,nama')
                ->get();
        } else {
            $proposal_penelitians = Proposal::where([
                ['jenis', 'penelitian'],
                ['status', 'proses'],
            ])
                ->select(
                    'user_id',
                    'judul',
                    'tanggal',
                    'jam',
                    'peninjau_id',
                )
                ->with('user', function ($query) {
                    $query->select('id', 'nama', 'prodi_id')->with('prodi:id,nama');
                })
                ->with('personels', function ($query) {
                    $query->select('proposal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->with('peninjau:id,nama')
                ->get();
            $proposal_pengabdians = Proposal::where([
                ['jenis', 'pengabdian'],
                ['status', 'proses'],
            ])
                ->select(
                    'user_id',
                    'judul',
                    'tanggal',
                    'jam',
                    'peninjau_id',
                )
                ->with('user', function ($query) {
                    $query->select('id', 'nama', 'prodi_id')->with('prodi:id,nama');
                })
                ->with('personels', function ($query) {
                    $query->select('proposal_id', 'user_id');
                    $query->with('user:id,nama');
                })
                ->with('peninjau:id,nama')
                ->get();
        }

        $pdf = Pdf::loadview('operator.proposal.laporan.jadwal', compact('proposal_penelitians', 'proposal_pengabdians'));
        return $pdf->stream('Surat Undangan Presentasi Proposal P2M 2024');
    }
}
