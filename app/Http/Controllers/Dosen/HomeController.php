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
}
