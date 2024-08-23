<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProposalPengabdianController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where([
            ['jenis', 'pengabdian'],
            ['status', 'menunggu'],
        ])
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'jenis_pendanaan_id',
                'dana_sumber',
                'dana_usulan',
                'berkas',
                'status',
            )
            ->with('user:id,nama')
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

        return view('operator.proposal.pengabdian.index', compact('proposals', 'peninjaus'));
    }

    // Konfirmasi
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'jam' => 'required',
            'peninjau_id' => 'required',
        ], [
            'tanggal.required' => 'Tanggal harus ditambahkan!',
            'jam.required' => 'Jam harus ditambahkan!',
            'peninjau_id.required' => 'Reviewer harus dipilih!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengonfirmasi Proposal!');
            return back()->withInput()->withErrors($validator)->with('id', $id);
        }

        $proposal = Proposal::where('id', $id)->update([
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'peninjau_id' => $request->peninjau_id,
            'status' => 'proses',
        ]);

        if (!$proposal) {
            alert()->error('Error', 'Gagal mengonfirmasi Proposal!');
            return back();
        }

        alert()->success('Success', 'Berhasil mengonfirmasi Proposal');

        return back();
    }
}
