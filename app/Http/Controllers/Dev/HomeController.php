<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $proposal_penelitian = Proposal::where('jenis', 'penelitian')->count();
        $proposal_pengabdian = Proposal::where('jenis', 'pengabdian')->count();

        return view('operator.index', compact(
            'proposal_penelitian',
            'proposal_pengabdian'
        ));
    }
}
