<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProposalPenelitianController extends Controller
{
    public function index()
    {
        $penelitians = ProposalPenelitian::select(
            'id',
            'user_id',
            'tahun',
            'judul',
            'jenis_pendanaan_id',
            'dana_sumber',
            'dana_usulan',
            'berkas',
            'anggota_ids',
            'status',
        )
            ->with('user:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->paginate(10);

        return view('operator.proposal.penelitian.index', compact('penelitians'));
    }

    public function create()
    {
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();

        return view('operator.proposal.penelitian.create', compact('jenis_pendanaans', 'dosens'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_sumber' => 'required',
            'dana_usulan' => 'required',
            'berkas' => 'required|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_sumber.required' => 'Sumber Dana harus diisi!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'berkas.required' => 'Berkas harus ditambahkan!',
            'berkas.mimes' => 'Berkas harus berformat .pdf!',
            'berkas.max' => 'Berkas yang ditambahkan terlalu besar!',
        ]);

        $validator_personel = Validator::make($request->all(), [
            'ketua_id' => 'required',
        ], [
            'ketua_id.required' => 'Ketua harus dipilih!',
        ]);

        if ($validator->fails() || $validator_personel->fails()) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back()->withInput()->withErrors($validator->errors()->merge($validator_personel->errors()));
        }

        $waktu = Carbon::now()->format('ymdhis');
        $berkas = 'proposal/penelitian_' . $waktu . '.' . $request->berkas->getClientOriginalExtension();
        $request->berkas->storeAs('public/uploads/', $berkas);

        $proposal = ProposalPenelitian::create([
            'user_id' => $request->ketua_id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_sumber' => $request->dana_sumber,
            'dana_usulan' => $request->dana_usulan,
            'berkas' => $berkas,
            'anggota_ids' => $request->anggota_ids,
            'status' => 'menunggu',
        ]);

        if (!$proposal) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back();
        }

        alert()->success('Success', 'Berhasil membuat Proposal');

        return redirect('operator/proposal-penelitian');
    }

    public function edit($id)
    {
        if (ProposalPenelitian::where('id', $id)->value('status') != 'menunggu') {
            return view('error.500');
        }

        $penelitian = ProposalPenelitian::where('id', $id)
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'jenis_pendanaan_id',
                'dana_sumber',
                'dana_usulan',
                'dana_setuju',
                'berkas',
                'anggota_ids',
                'catatan',
                'status',
            )
            ->first();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where('role', 'dosen')
            ->orWhere('role', 'admin')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();

        return view('operator.proposal.penelitian.edit', compact('penelitian', 'jenis_pendanaans', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_sumber' => 'required',
            'dana_usulan' => 'required',
            'berkas' => 'nullable|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_sumber.required' => 'Sumber Dana harus diisi!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'berkas.mimes' => 'Berkas harus berformat .pdf!',
            'berkas.max' => 'Berkas yang ditambahkan terlalu besar!',
        ]);

        $error_personel = array();
        $validator_fails_personel = false;
        $validator_personel = Validator::make($request->all(), [
            'ketua_id' => 'required',
        ], [
            'ketua_id.required' => 'Ketua harus dipilih!',
        ]);
        $error_personel = $validator_personel->errors();
        $validator_fails_personel = $validator_personel->fails();

        if ($validator->fails() || $validator_fails_personel) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back()->withInput()->withErrors($validator->errors()->merge($error_personel));
        }

        if ($request->berkas) {
            Storage::disk('local')->delete('public/uploads/' . ProposalPenelitian::where('id', $id)->value('berkas'));
            $waktu = Carbon::now()->format('ymdhis');
            $berkas = 'proposal/penelitian_' . $waktu . '.' . $request->berkas->getClientOriginalExtension();
            $request->berkas->storeAs('public/uploads/', $berkas);
        } else {
            $berkas = ProposalPenelitian::where('id', $id)->value('berkas');
        }

        $proposal = ProposalPenelitian::where('id', $id)->update([
            'user_id' => $request->ketua_id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_sumber' => $request->dana_sumber,
            'dana_usulan' => $request->dana_usulan,
            'berkas' => $berkas,
            'anggota_ids' => $request->anggota_ids,
        ]);

        if (!$proposal) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back();
        }

        alert()->success('Success', 'Berhasil memperbarui Proposal');

        return redirect('operator/proposal-penelitian');
    }

    public function destroy($id)
    {
        $berkas = ProposalPenelitian::where('id', $id)->value('berkas');
        $proposal = ProposalPenelitian::where('id', $id)->delete();

        if (!$proposal) {
            alert()->error('Error', 'Gagal menghapus Proposal!');
            return back();
        }

        Storage::disk('local')->delete('public/uploads/' . $berkas);

        alert()->success('Success', 'Berhasil menghapus Proposal');

        return redirect('operator/proposal-penelitian');
    }
}
