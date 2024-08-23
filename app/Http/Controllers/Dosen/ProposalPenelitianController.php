<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\JenisPendanaan;
use App\Models\Proposal;
use App\Models\ProposalPersonel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProposalPenelitianController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where('jenis', 'penelitian')
            ->where(function ($query) {
                $query->where('user_id', auth()->user()->id);
                $query->orWhereHas('personels', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })
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

        return view('dosen.proposal.penelitian.index', compact('proposals'));
    }

    public function create()
    {
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where([
            ['role', 'dosen'],
            ['id', '!=', auth()->user()->id]
        ])
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();

        return view('dosen.proposal.penelitian.create', compact('jenis_pendanaans', 'dosens'));
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

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $waktu = Carbon::now()->format('ymdhis');
        $berkas = 'proposal/penelitian_' . $waktu . '.' . $request->berkas->getClientOriginalExtension();
        $request->berkas->storeAs('public/uploads/', $berkas);

        $proposal = Proposal::create([
            'jenis' => 'penelitian',
            'user_id' => auth()->user()->id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_sumber' => $request->dana_sumber,
            'dana_usulan' => $request->dana_usulan,
            'berkas' => $berkas,
            'status' => 'menunggu',
        ]);

        if (!$proposal) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back();
        }

        if ($request->personels) {
            foreach ($request->personels as $personel) {
                ProposalPersonel::create([
                    'proposal_id' => $proposal->id,
                    'user_id' => $personel,
                ]);
            }
        }

        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* " . "mengajukan sebuah proposal penelitian" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar proposal penelitian" . PHP_EOL;
        $message .= url('operator/proposal-penelitian');

        $this->kirim('085328481969', $message);

        // $telp = User::where('role', 'operator')->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }

        alert()->success('Success', 'Berhasil membuat Proposal');

        return redirect('dosen/proposal-penelitian');
    }

    public function edit($id)
    {
        if (Proposal::where('id', $id)->value('status') != 'menunggu') {
            return view('error.500');
        }

        $proposal = Proposal::where('id', $id)
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
                'status',
            )
            ->with('personels:proposal_id,user_id')
            ->first();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where('role', 'dosen')
            ->orWhere('role', 'admin')
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();

        return view('dosen.proposal.penelitian.edit', compact('proposal', 'jenis_pendanaans', 'dosens'));
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

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back()->withInput()->withErrors($validator->errors());
        }

        if ($request->berkas) {
            Storage::disk('local')->delete('public/uploads/' . Proposal::where('id', $id)->value('berkas'));
            $waktu = Carbon::now()->format('ymdhis');
            $berkas = 'proposal/penelitian_' . $waktu . '.' . $request->berkas->getClientOriginalExtension();
            $request->berkas->storeAs('public/uploads/', $berkas);
        } else {
            $berkas = Proposal::where('id', $id)->value('berkas');
        }

        $proposal = Proposal::where('id', $id)->update([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_sumber' => $request->dana_sumber,
            'dana_usulan' => $request->dana_usulan,
            'berkas' => $berkas,
        ]);

        if (!$proposal) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back();
        }

        $personel_deleted = array_diff(ProposalPersonel::where('proposal_id', $id)->pluck('user_id')->toArray(), $request->personels);

        if ($personel_deleted) {
            foreach ($personel_deleted as $personel) {
                ProposalPersonel::where([
                    ['proposal_id', $id],
                    ['user_id', $personel],
                ])->delete();
            }
        }

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

        alert()->success('Success', 'Berhasil memperbarui Proposal');

        return redirect('dosen/proposal-penelitian');
    }

    public function destroy($id)
    {
        $proposal = Proposal::where('id', $id)->first();
        $berkas = $proposal->berkas;
        $personels = $proposal->personels();

        if ($personels) {
            $personels->delete();
        }

        $proposal->delete();

        Storage::disk('local')->delete('public/uploads/' . $berkas);

        alert()->success('Success', 'Berhasil menghapus Proposal');
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

        return $result;
    }
}
