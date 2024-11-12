<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use App\Models\JenisPendanaan;
use App\Models\JenisPenelitian;
use App\Models\JenisPengabdian;
use App\Models\Proposal;
use App\Models\ProposalPersonel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::select(
            'id',
            'jenis',
            'user_id',
            'tahun',
            'judul',
            'jenis_penelitian_id',
            'jenis_pengabdian_id',
            'jenis_pendanaan_id',
            'dana_usulan',
            'dana_setuju',
            'file',
            'mahasiswas',
            'peninjau_id',
            'jadwal_id',
            'mou',
            'status',
        )
            ->with('user:id,nama')
            ->with('jenis_penelitian:id,nama')
            ->with('jenis_pengabdian:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('personels', function ($query) {
                $query->select('proposal_id', 'user_id');
                $query->with('user:id,nama');
            })
            ->with('peninjau:id,nama')
            ->orderByDesc('id')
            ->paginate(10);

        return view('dev.proposal.index', compact('proposals'));
    }

    public function create()
    {
        $jenis_penelitians = JenisPenelitian::select('id', 'nama')->get();
        $jenis_pengabdians = JenisPengabdian::select('id', 'nama')->get();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where('role', 'dosen')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dev.proposal.create', compact(
            'jenis_penelitians',
            'jenis_pengabdians',
            'jenis_pendanaans',
            'dosens'
        ));
    }

    public function store(Request $request)
    {
        if ($request->jenis == 'penelitian') {
            $validator_jenis_penelitian = 'required';
            $validator_jenis_pengabdian = 'nullable';
        } elseif ($request->jenis == 'pengabdian') {
            $validator_jenis_penelitian = 'nullable';
            $validator_jenis_pengabdian = 'required';
        } else {
            $validator_jenis_penelitian = 'nullable';
            $validator_jenis_pengabdian = 'nullable';
        }
        // 
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'tahun' => 'required',
            'jenis' => 'required',
            'status' => 'required',
            'judul' => 'required',
            'jenis_penelitian_id' => $validator_jenis_penelitian,
            'jenis_pengabdian_id' => $validator_jenis_pengabdian,
            'jenis_pendanaan_id' => 'required',
            'dana_usulan' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'user_id.required' => 'Dosen harus dipilih!',
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'jenis.required' => 'Jenis Proposal harus dipilih!',
            'status.required' => 'Status harus dipilih!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_penelitian_id.required' => 'Jenis Penelitian harus dipilih!',
            'jenis_pengabdian_id.required' => 'Jenis Pengabdian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'file.required' => 'Laporan Proposal harus ditambahkan!',
            'file.mimes' => 'Laporan Proposal harus berformat .pdf!',
            'file.max' => 'Laporan Proposal yang ditambahkan terlalu besar!',
        ]);
        // 
        $mahasiswas = [];
        if ($request->mahasiswas) {
            foreach ($request->mahasiswas as $mahasiswa) {
                if ($mahasiswa['nama']) {
                    $mahasiswas[$mahasiswa['nama']] = $mahasiswa['prodi'];
                }
            }
        }
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back()->withInput()->withErrors($validator->errors())->with('old_mahasiswas', $mahasiswas);
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $random = rand(10, 99);
        $file = 'proposal/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        if ($request->jenis == 'penelitian') {
            $jenis_penelitian_id = $request->jenis_penelitian_id;
            $jenis_pengabdian_id = null;
        } else if ($request->jenis == 'pengabdian') {
            $jenis_penelitian_id = null;
            $jenis_pengabdian_id = $request->jenis_pengabdian_id;
        }
        // 
        $proposal = Proposal::create([
            'jenis' => $request->jenis,
            'user_id' => $request->user_id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_penelitian_id' => $jenis_penelitian_id,
            'jenis_pengabdian_id' => $jenis_pengabdian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_usulan' => $request->dana_usulan,
            'file' => $file,
            'mahasiswas' => $mahasiswas,
            'status' => $request->status,
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back();
        }
        // 
        if ($request->personels) {
            foreach ($request->personels as $personel) {
                ProposalPersonel::create([
                    'proposal_id' => $proposal->id,
                    'user_id' => $personel,
                ]);
            }
        }
        // 
        alert()->success('Success', 'Berhasil membuat Proposal');
        return redirect('dev/proposal');
    }

    public function edit($id)
    {
        $proposal = Proposal::where('id', $id)
            ->select(
                'id',
                'jenis',
                'tahun',
                'user_id',
                'judul',
                'jenis_penelitian_id',
                'jenis_pengabdian_id',
                'jenis_pendanaan_id',
                'dana_usulan',
                'dana_setuju',
                'file',
                'mahasiswas',
                'tanggal',
                'jam',
                'peninjau_id',
                'mou',
                'status',
            )
            ->with('user:id,nama')
            ->with('personels:proposal_id,user_id')
            ->first();
        $jenis_penelitians = JenisPenelitian::select('id', 'nama')->get();
        $jenis_pengabdians = JenisPengabdian::select('id', 'nama')->get();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where([
            ['id', '!=', auth()->user()->id],
            ['role', 'dosen'],
        ])
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        $peninjaus = User::where([
            ['role', 'dosen'],
            ['is_peninjau', true],
        ])
            ->select('id', 'nama')
            ->orderBy('nama')
            ->get();

        return view('dev.proposal.edit', compact(
            'proposal',
            'jenis_penelitians',
            'jenis_pengabdians',
            'jenis_pendanaans',
            'dosens',
            'peninjaus'
        ));
    }

    public function update(Request $request, $id)
    {
        if ($request->jenis == 'penelitian') {
            $validator_jenis_penelitian = 'required';
            $validator_jenis_pengabdian = 'nullable';
        } elseif ($request->jenis == 'pengabdian') {
            $validator_jenis_penelitian = 'nullable';
            $validator_jenis_pengabdian = 'required';
        } else {
            $validator_jenis_penelitian = 'nullable';
            $validator_jenis_pengabdian = 'nullable';
        }
        // 
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'jenis' => 'required',
            'status' => 'required',
            'judul' => 'required',
            'jenis_penelitian_id' => $validator_jenis_penelitian,
            'jenis_pengabdian_id' => $validator_jenis_pengabdian,
            'jenis_pendanaan_id' => 'required',
            'dana_usulan' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'jenis.required' => 'Jenis Proposal harus dipilih!',
            'status.required' => 'Status harus dipilih!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_penelitian_id.required' => 'Jenis Penelitian harus dipilih!',
            'jenis_pengabdian_id.required' => 'Jenis Pengabdian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'file.mimes' => 'Dokumen Proposal harus berformat .pdf!',
            'file.max' => 'Dokumen Proposal yang ditambahkan terlalu besar!',
        ]);
        // 
        $mahasiswas = [];
        if ($request->mahasiswas) {
            foreach ($request->mahasiswas as $mahasiswa) {
                if ($mahasiswa['nama']) {
                    $mahasiswas[$mahasiswa['nama']] = $mahasiswa['prodi'];
                }
            }
        }
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back()->withInput()->withErrors($validator->errors())->with('old_mahasiswas', $mahasiswas);
        }
        // 
        if ($request->file) {
            Storage::disk('local')->delete('public/uploads/' . Proposal::where('id', $id)->value('file'));
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'proposal/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = Proposal::where('id', $id)->value('file');
        }
        // 
        if ($request->mou) {
            Storage::disk('local')->delete('public/uploads/' . Proposal::where('id', $id)->value('mou'));
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $mou = 'proposal/' . $waktu . $random . '.' . $request->mou->getClientOriginalExtension();
            $request->mou->storeAs('public/uploads/', $mou);
        } else {
            $mou = Proposal::where('id', $id)->value('mou');
        }
        // 
        if ($request->jenis == 'penelitian') {
            $jenis_penelitian_id = $request->jenis_penelitian_id;
            $jenis_pengabdian_id = null;
        } else if ($request->jenis == 'pengabdian') {
            $jenis_penelitian_id = null;
            $jenis_pengabdian_id = $request->jenis_pengabdian_id;
        }
        // 
        $proposal = Proposal::where('id', $id)->update([
            'jenis' => $request->jenis,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_penelitian_id' => $jenis_penelitian_id,
            'jenis_pengabdian_id' => $jenis_pengabdian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_usulan' => $request->dana_usulan,
            'file' => $file,
            'mahasiswas' => $mahasiswas,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'peninjau_id' => $request->peninjau_id,
            'mou' => $mou,
            'status' => $request->status,
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back();
        }
        // 
        if ($request->personels) {
            $personel_deleted = array_diff(ProposalPersonel::where('proposal_id', $id)->pluck('user_id')->toArray(), $request->personels);
            // 
            if ($personel_deleted) {
                foreach ($personel_deleted as $personel) {
                    ProposalPersonel::where([
                        ['proposal_id', $id],
                        ['user_id', $personel],
                    ])->delete();
                }
            }
            // 
            foreach ($request->personels as $personel) {
                $cek = ProposalPersonel::where([
                    ['proposal_id', $id],
                    ['user_id', $personel],
                ])->exists();
                if (!$cek) {
                    ProposalPersonel::create([
                        'proposal_id' => $id,
                        'user_id' => $personel,
                    ]);
                }
            }
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui Proposal');
        // 
        return redirect('dev/proposal');
    }
}
