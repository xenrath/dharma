<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProposalListController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where('status', 'menunggu')
            ->select(
                'id',
                'jenis',
                'user_id',
                'tahun',
                'judul',
                'jenis_penelitian_id',
                'jenis_pengabdian_id',
                'jenis_pendanaan_id',
                'dana_usulan',
                'file',
                'mahasiswas',
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
        $peninjaus = User::where([
            ['role', 'dosen'],
            ['is_peninjau', true],
        ])
            ->select('id', 'nama')
            ->orderBy('nama')
            ->get();

        return view('operator.proposal.list.index', compact('proposals', 'peninjaus'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'jam' => 'required',
            'peninjau_id' => 'required',
        ], [
            'tanggal.required' => 'Tanggal harus dipilih!',
            'jam.required' => 'Jam harus dipilih!',
            'peninjau_id.required' => 'Reviewer harus dipilih!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengonfirmasi Proposal!');
            return back()->withInput()->withErrors($validator)->with('id', $id);
        }
        // 
        $proposal = Proposal::where('id', $id)->update([
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'peninjau_id' => $request->peninjau_id,
            'status' => 'proses',
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal mengonfirmasi Proposal!');
            return back();
        }
        // 
        alert()->success('Success', 'Berhasil mengonfirmasi Proposal');
        return back();
    }
}
