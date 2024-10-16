<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Proposal;
use App\Models\ProposalJadwal;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $proposal_list = Proposal::where('status', 'menunggu')->count();
        $proposal_pendanaan = Proposal::where(function ($query) {
            $query->where('status', 'setuju');
            $query->orWhere('status', 'revisi2');
        })->count();
        $proposal_riwayat = $proposals = Proposal::where(function ($query) {
            $query->where('status', 'setuju');
            $query->orWhere('status', 'revisi2');
        })->count();
        $penelitian_list = $penelitians = Penelitian::where('status', 'menunggu')->orWhere('status', 'revisi')->count();
        $penelitian_riwayat = Penelitian::where('status', 'selesai')->count();
        $pengabdian_list = Pengabdian::where('status', 'menunggu')->orWhere('status', 'revisi')->count();
        $pengabdian_riwayat = Pengabdian::where('status', 'selesai')->count();

        return view('operator.index', compact(
            'proposal_list',
            'proposal_pendanaan',
            'proposal_riwayat',
            'penelitian_list',
            'penelitian_riwayat',
            'pengabdian_list',
            'pengabdian_riwayat',
        ));
    }
}
