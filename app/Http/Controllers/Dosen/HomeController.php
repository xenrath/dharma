<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $proposal_penelitian = Proposal::where('jenis', 'penelitian')
            ->where(function ($query) {
                $query->where('user_id', auth()->user()->id);
                $query->orWhereHas('personels', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })
            ->count();
        $proposal_pengabdian = Proposal::where('jenis', 'pengabdian')
            ->where(function ($query) {
                $query->where('user_id', auth()->user()->id);
                $query->orWhereHas('personels', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })
            ->count();

        return view('operator.index', compact(
            'proposal_penelitian',
            'proposal_pengabdian'
        ));
    }
}
