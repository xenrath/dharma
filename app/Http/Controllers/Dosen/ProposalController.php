<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\JenisPendanaan;
use App\Models\JenisPenelitian;
use App\Models\JenisPengabdian;
use App\Models\Proposal;
use App\Models\ProposalPersonel;
use App\Models\ProposalRevisi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where('user_id', auth()->user()->id)
            ->orWhereHas('personels', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->select(
                'id',
                'jenis',
                'user_id',
                'tahun',
                'judul',
                'jenis_pendanaan_id',
                'jenis_penelitian_id',
                'jenis_pengabdian_id',
                'dana_sumber',
                'dana_usulan',
                'dana_setuju',
                'berkas',
                'tanggal',
                'jam',
                'peninjau_id',
                'jadwal_id',
                'status',
            )
            ->with('user:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('jenis_penelitian:id,nama')
            ->with('jenis_pengabdian:id,nama')
            ->with('peninjau:id,nama')
            ->with('personels', function ($query) {
                $query->select('proposal_id', 'user_id');
                $query->with('user', function ($query) {
                    $query->select('id', 'nama');
                    $query->withTrashed();
                });
            })
            ->with('proposal_revisis', function ($query) {
                $query->select('proposal_id', 'user_id', 'file', 'keterangan');
                $query->orderByDesc('id');
            })
            ->orderByDesc('id')
            ->paginate(10);
        // 
        return view('dosen.proposal.index', compact('proposals'));
    }

    public function store(Request $request)
    {
        if ($request->jenis == 'penelitian') {
            return redirect('dosen/proposal/penelitian');
        } elseif ($request->jenis == 'pengabdian') {
            return redirect('dosen/proposal/pengabdian');
        } else {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back()->withErrors(['jenis' => 'Jenis Proposal harus dipilih!']);
        }
    }

    public function create_penelitian()
    {
        $jenis_penelitians = JenisPenelitian::select('id', 'nama')->get();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where([
            ['id', '!=', auth()->user()->id],
            ['role', 'dosen'],
        ])
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dosen.proposal.create_penelitian', compact('jenis_penelitians', 'jenis_pendanaans', 'dosens'));
    }

    public function store_penelitian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_penelitian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_sumber' => 'required',
            'dana_usulan' => 'required',
            'berkas' => 'required|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_penelitian_id.required' => 'Jenis Penelitian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_sumber.required' => 'Sumber Dana harus diisi!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'berkas.required' => 'Berkas harus ditambahkan!',
            'berkas.mimes' => 'Berkas harus berformat .pdf!',
            'berkas.max' => 'Berkas yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $berkas = 'proposal/proposal_' . $waktu . '.' . $request->berkas->getClientOriginalExtension();
        $request->berkas->storeAs('public/uploads/', $berkas);
        // 
        $proposal = Proposal::create([
            'jenis' => 'penelitian',
            'user_id' => auth()->user()->id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_penelitian_id' => $request->jenis_penelitian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_sumber' => $request->dana_sumber,
            'dana_usulan' => $request->dana_usulan,
            'berkas' => $berkas,
            'status' => 'menunggu',
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
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* " . "mengajukan sebuah proposal" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar proposal" . PHP_EOL;
        $message .= url('operator/proposal-list');
        // 
        $this->kirim('085328481969', $message);
        // 
        // $telp = User::where('role', 'operator')->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil membuat Proposal');
        return redirect('dosen/proposal');
    }

    public function create_pengabdian()
    {
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

        return view('dosen.proposal.create_pengabdian', compact('jenis_pengabdians', 'jenis_pendanaans', 'dosens'));
    }

    public function store_pengabdian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_pengabdian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_sumber' => 'required',
            'dana_usulan' => 'required',
            'berkas' => 'required|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_pengabdian_id.required' => 'Jenis Pengabdian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_sumber.required' => 'Sumber Dana harus diisi!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'berkas.required' => 'Berkas harus ditambahkan!',
            'berkas.mimes' => 'Berkas harus berformat .pdf!',
            'berkas.max' => 'Berkas yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $berkas = 'proposal/proposal_' . $waktu . '.' . $request->berkas->getClientOriginalExtension();
        $request->berkas->storeAs('public/uploads/', $berkas);
        // 
        $proposal = Proposal::create([
            'jenis' => 'pengabdian',
            'user_id' => auth()->user()->id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_pengabdian_id' => $request->jenis_pengabdian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_sumber' => $request->dana_sumber,
            'dana_usulan' => $request->dana_usulan,
            'berkas' => $berkas,
            'status' => 'menunggu',
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
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* " . "mengajukan sebuah proposal" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar proposal" . PHP_EOL;
        $message .= url('operator/proposal-list');
        // 
        $this->kirim('085328481969', $message);
        // 
        // $telp = User::where('role', 'operator')->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil membuat Proposal');
        return redirect('dosen/proposal');
    }

    public function edit($id)
    {
        if (Proposal::where('id', $id)->value('status') != 'menunggu' || Proposal::where('id', $id)->value('user_id') != auth()->user()->id) {
            return view('error.500');
        }
        // 
        $jenis = Proposal::where('id', $id)->value('jenis');
        // 
        if ($jenis == 'penelitian') {
            return redirect('dosen/proposal/penelitian/' . $id);
        } elseif ($jenis == 'pengabdian') {
            return redirect('dosen/proposal/pengabdian/' . $id);
        } else {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back();
        }
    }

    public function edit_penelitian($id)
    {
        $proposal = Proposal::where('id', $id)
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'jenis_penelitian_id',
                'jenis_pendanaan_id',
                'dana_sumber',
                'dana_usulan',
                'dana_setuju',
                'berkas',
                'status',
            )
            ->with('user:id,nama')
            ->with('personels:proposal_id,user_id')
            ->first();
        $jenis_penelitians = JenisPenelitian::select('id', 'nama')->get();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where([
            ['id', '!=', auth()->user()->id],
            ['role', 'dosen'],
        ])
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();

        return view('dosen.proposal.edit_penelitian', compact('proposal', 'jenis_penelitians', 'jenis_pendanaans', 'dosens'));
    }

    public function update_penelitian(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_penelitian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_sumber' => 'required',
            'dana_usulan' => 'required',
            'berkas' => 'nullable|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_penelitian_id.required' => 'Jenis Penelitian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_sumber.required' => 'Sumber Dana harus diisi!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'berkas.mimes' => 'Berkas harus berformat .pdf!',
            'berkas.max' => 'Berkas yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        if ($request->berkas) {
            Storage::disk('local')->delete('public/uploads/' . Proposal::where('id', $id)->value('berkas'));
            $waktu = Carbon::now()->format('ymdhis');
            $berkas = 'proposal/proposal_' . $waktu . '.' . $request->berkas->getClientOriginalExtension();
            $request->berkas->storeAs('public/uploads/', $berkas);
        } else {
            $berkas = Proposal::where('id', $id)->value('berkas');
        }
        // 
        $proposal = Proposal::where('id', $id)->update([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_penelitian_id' => $request->jenis_penelitian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_sumber' => $request->dana_sumber,
            'dana_usulan' => $request->dana_usulan,
            'berkas' => $berkas,
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
        return redirect('dosen/proposal');
    }

    public function edit_pengabdian($id)
    {
        $proposal = Proposal::where('id', $id)
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'jenis_pengabdian_id',
                'jenis_pendanaan_id',
                'dana_sumber',
                'dana_usulan',
                'dana_setuju',
                'berkas',
                'status',
            )
            ->with('user:id,nama')
            ->with('personels:proposal_id,user_id')
            ->first();
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
        // 
        return view('dosen.proposal.edit_pengabdian', compact('proposal', 'jenis_pengabdians', 'jenis_pendanaans', 'dosens'));
    }

    public function update_pengabdian(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_pengabdian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_sumber' => 'required',
            'dana_usulan' => 'required',
            'berkas' => 'nullable|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_pengabdian_id.required' => 'Jenis Pengabdian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_sumber.required' => 'Sumber Dana harus diisi!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'berkas.mimes' => 'Berkas harus berformat .pdf!',
            'berkas.max' => 'Berkas yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        if ($request->berkas) {
            Storage::disk('local')->delete('public/uploads/' . Proposal::where('id', $id)->value('berkas'));
            $waktu = Carbon::now()->format('ymdhis');
            $berkas = 'proposal/proposal_' . $waktu . '.' . $request->berkas->getClientOriginalExtension();
            $request->berkas->storeAs('public/uploads/', $berkas);
        } else {
            $berkas = Proposal::where('id', $id)->value('berkas');
        }
        // 
        $proposal = Proposal::where('id', $id)->update([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_pengabdian_id' => $request->jenis_pengabdian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_sumber' => $request->dana_sumber,
            'dana_usulan' => $request->dana_usulan,
            'berkas' => $berkas,
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
        return redirect('dosen/proposal');
    }

    public function destroy($id)
    {
        $proposal = Proposal::where('id', $id)->with('personels')->first();

        if (!$proposal) {
            alert()->error('Error', 'Gagal menghapus Proposal!');
            return back();
        }

        $berkas = $proposal->berkas;
        $personels = $proposal->personels;

        if (count($personels)) {
            ProposalPersonel::where('proposal_id', $id)->delete();
        }

        $proposal->delete();

        Storage::disk('local')->delete('public/uploads/' . $berkas);

        alert()->success('Success', 'Berhasil menghapus Proposal');
        return back();
    }

    // ID = Proposal Revisi ID
    public function perbaikan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'file.required' => 'File harus ditambahkan!',
            'file.mimes' => 'File harus berformat .pdf!',
            'file.max' => 'File yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengunggah File Laporan!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $file = 'proposal/revisi_' . $waktu . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        $revisi = ProposalRevisi::where('id', $id)->update([
            'file' => $file,
        ]);
        // 
        if (!$revisi) {
            alert()->error('Error', 'Gagal mengunggah File Laporan!');
            return back();
        }
        //
        $proposal_id = ProposalRevisi::where('id', $id)->value('proposal_id');
        $proposal = Proposal::where('id', $proposal_id)->select('peninjau_id', 'status')->first();
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* mengunggah revisi laporan proposal" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar proposal" . PHP_EOL;
        if ($proposal->status == 'revisi1') {
            $message .= url('dosen/peninjau/revisi');
            // 
            // $telp = User::where('id', $proposal->peninjau_id)->value('telp');
            // if ($telp) {
            //     $this->kirim($telp, $message);
            // }
        } elseif ($proposal->status == 'revisi2') {
            $message .= url('operator/proposal-pendanaan');
            // 
            // $telp = User::where('role', 'operator')->value('telp');
            // if ($telp) {
            //     $this->kirim($telp, $message);
            // }
        }
        // 
        $this->kirim('085328481969', $message);
        // 
        alert()->success('Success', 'Berhasil mengunggah File Laporan');
        return back();
    }

    public function kirim($telp, $message)
    {
        $data = [
            'target' => $telp,
            'message' => $message
        ];

        $curl = curl_init();
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: BUbqFXgpVtdH3EoMj@u7",
            )
        );

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = json_decode(curl_exec($curl));

        return $result->status;
    }
}
