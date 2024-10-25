<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Proposal;
use App\Models\ProposalJadwal;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function index()
    {
        $proposal = Proposal::where('user_id', auth()->user()->id)
            ->orWhereHas('personels', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->count();
        $penelitian = Penelitian::where('user_id', auth()->user()->id)
            ->orWhereHas('personels', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->count();
        $pengabdian = Pengabdian::where('user_id', auth()->user()->id)
            ->orWhereHas('personels', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->count();
        // 
        $ketua_proposal = null;
        $ketua_riwayat = null;
        if (auth()->user()->isKetua()) {
            $ketua_proposal = Proposal::where('status', 'pendanaan')->count();
            $ketua_riwayat = Proposal::where('status', 'selesai')->count();
        }
        // 
        $peninjau_review = null;
        $peninjau_revisi = null;
        $peninjau_riwayat = null;
        if (auth()->user()->isPeninjau()) {
            $peninjau_review = Proposal::where([
                ['status', 'proses'],
                ['peninjau_id', auth()->user()->id],
                ['jadwal_id', '!=', null],
            ])->count();
            $peninjau_revisi = Proposal::where([
                ['peninjau_id', auth()->user()->id],
                ['status', 'revisi1'],
            ])->count();
            $peninjau_riwayat = Proposal::where([
                ['peninjau_id', auth()->user()->id],
                ['status', 'setuju'],
            ])->count();
        }
        // 
        $agent = new Agent;
        $is_chrome = $agent->is('Chrome');
        $browser = $agent->browser();
        // 
        return view('dosen.index', compact(
            'proposal',
            'penelitian',
            'pengabdian',
            'ketua_proposal',
            'ketua_riwayat',
            'peninjau_review',
            'peninjau_revisi',
            'peninjau_riwayat',
            'is_chrome',
            'browser',
        ));
    }

    public function jadwal($id)
    {
        $jadwal = ProposalJadwal::where('id', $id)->select('tanggal', 'nomor', 'perihal', 'kepadas', 'proposal_ids')->first();
        $fakultases = Fakultas::whereIn('id', $jadwal->kepadas)->select('nama')->get();
        $proposals = Proposal::whereIn('id', $jadwal->proposal_ids)
            ->select(
                'id',
                'jenis',
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
            ->with('peninjau:id,nama')->get();
        $ketua = User::where('is_ketua', true)->select('nama', 'nipy')->first();
        if (Carbon::parse($jadwal->tanggal)->format('m') >= '09') {
            $tahun_akademik = Carbon::parse($jadwal->tanggal)->format('Y') . '/' . Carbon::parse($jadwal->tanggal)->addYear()->format('Y');
        } else {
            $tahun_akademik = Carbon::parse($jadwal->tanggal)->addYears(-1)->format('Y') . '/' . Carbon::parse($jadwal->tanggal)->format('Y');
        }

        $pdf = Pdf::loadview('dosen.jadwal', compact('jadwal', 'fakultases', 'proposals', 'ketua', 'tahun_akademik'));
        return $pdf->stream('Surat Undangan Presentasi Proposal P2M 2024');
    }
}
