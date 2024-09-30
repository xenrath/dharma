<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Proposal;
use App\Models\ProposalJadwal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProposalJadwalController extends Controller
{
    public function index(Request $request)
    {
        $jadwals = ProposalJadwal::select('id', 'tanggal', 'nomor')->orderByDesc('tanggal')->paginate(10);
        $proposal_menunggu = Proposal::where([
            ['status', 'proses'],
            ['jadwal_id', null],
        ])->count();

        return view('operator.proposal.jadwal.index', compact('jadwals', 'proposal_menunggu'));
    }

    public function create()
    {
        $proposals = Proposal::where([
            ['status', 'proses'],
            ['jadwal_id', null],
        ])
            ->select(
                'id',
                'user_id',
                'judul',
                'tanggal',
            )
            ->with('user:id,nama')
            ->orderBy('tanggal')
            ->get();
        $fakultases = Fakultas::select('id', 'nama')->get();

        return view('operator.proposal.jadwal.create', compact('proposals', 'fakultases'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor' => 'required',
            'perihal' => 'required',
            'kepadas' => 'required',
            'proposal_ids' => 'required',
        ], [
            'nomor.required' => 'Nomor Surat harus diisi!',
            'perihal.required' => 'Perihal harus diisi!',
            'kepadas.required' => 'Fakultas harus dipilih!',
            'proposal_ids.required' => 'Proposal harus ditambahkan!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $laporan = ProposalJadwal::create([
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'nomor' => $request->nomor,
            'perihal' => $request->perihal,
            'kepadas' => $request->kepadas,
            'proposal_ids' => $request->proposal_ids,
        ]);

        foreach ($request->proposal_ids as $proposal_id) {
            Proposal::where('id', $proposal_id)->update([
                'jadwal_id' => $laporan->id,
            ]);
        }

        alert()->success('Success', 'Berhasil membuat Laporan');

        return redirect('operator/proposal-jadwal');
    }

    public function edit($id)
    {
        $laporan = ProposalJadwal::where('id', $id)->first();
        $laporan_proposals = Proposal::whereIn('id', $laporan->proposal_ids)
            ->select(
                'id',
                'user_id',
                'judul',
                'tanggal',
            )
            ->with('user:id,nama')
            ->get();
        $proposals = Proposal::where([
            ['status', 'proses'],
            ['jadwal_id', null],
        ])
            ->orWhereIn('id', $laporan->proposal_ids)
            ->select(
                'id',
                'user_id',
                'judul',
                'tanggal',
            )
            ->with('user:id,nama')
            ->get();
        $fakultases = Fakultas::select('id', 'nama')->get();

        return view('operator.proposal.jadwal.edit', compact('laporan', 'laporan_proposals', 'proposals', 'fakultases'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nomor' => 'required|unique:proposal_laporans,nomor,' . $id . ',id',
            'perihal' => 'required',
            'kepadas' => 'required',
            'proposal_ids' => 'required',
        ], [
            'nomor.required' => 'Nomor Surat harus diisi!',
            'perihal.required' => 'Perihal harus diisi!',
            'kepadas.required' => 'Fakultas harus dipilih!',
            'proposal_ids.required' => 'Proposal harus ditambahkan!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $laporan = ProposalJadwal::where('id', $id)->update([
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'nomor' => $request->nomor,
            'perihal' => $request->perihal,
            'kepadas' => $request->kepadas,
            'proposal_ids' => $request->proposal_ids,
        ]);

        if ($laporan) {
            $proposal_delete = array_diff(ProposalJadwal::where('id', $id)->value('proposal_ids'), $request->proposal_ids);
            if ($proposal_delete) {
                foreach ($proposal_delete as $proposal) {
                    Proposal::where('id', $proposal)->update([
                        'jadwal_id' => null,
                    ]);
                }
            }
            foreach ($request->proposal_ids as $proposal_id) {
                $cek = Proposal::where([
                    ['id', $proposal_id],
                    ['jadwal_id', $id],
                ])->exists();
                if (!$cek) {
                    Proposal::where('id', $proposal_id)->update([
                        'jadwal_id' => $id,
                    ]);
                }
            }
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui Laporan');
        return redirect('operator/proposal-jadwal');
    }

    public function destroy($id)
    {
        $proposal_ids = ProposalJadwal::where('id', $id)->value('proposal_ids');

        foreach ($proposal_ids as $proposal_id) {
            Proposal::where('id', $proposal_id)->update([
                'jadwal_id' => null,
            ]);
        }

        $laporan = ProposalJadwal::where('id', $id)->delete();

        if (!$laporan) {
            alert()->error('Error', 'Gagal menghapus Laporan!');
            return back();
        }

        alert()->success('Success', 'Berhasil menghapus Laporan');
        return back();
    }

    public function menunggu()
    {
        $proposals = Proposal::where([
            ['status', 'proses'],
            ['jadwal_id', null],
        ])
            ->select(
                'id',
                'jenis',
                'user_id',
                'tahun',
                'judul',
                'jenis_penelitian_id',
                'jenis_pengabdian_id',
                'jenis_pendanaan_id',
                'dana_sumber',
                'dana_usulan',
                'berkas',
                'tanggal',
                'jam',
                'peninjau_id',
                'status',
            )
            ->with('user:id,nama')
            ->with('jenis_penelitian:id,nama')
            ->with('jenis_pengabdian:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('peninjau:id,nama')
            ->with('personels', function ($query) {
                $query->select('proposal_id', 'user_id');
                $query->with('user:id,nama');
            })
            ->get();

        return view('operator.proposal.jadwal.menunggu', compact('proposals'));
    }

    public function kembalikan($id)
    {
        $proposal = Proposal::where('id', $id)->update([
            'tanggal' => null,
            'jam' => null,
            'peninjau_id' => null,
            'status' => 'menunggu',
        ]);

        if (!$proposal) {
            alert()->error('Error', 'Gagal mengembalikan Proposal!');
            return back();
        }

        alert()->success('Success', 'Berhasil mengembalikan Proposal');

        return back();
    }

    public function notif($id)
    {
        $user_id = Proposal::where('jadwal_id', $id)->pluck('user_id');
        $users = User::whereIn('id', $user_id)->select('telp')->get();
        // 
        $message_dosen = "SIDHARMA LPPM"  . PHP_EOL;
        $message_dosen .= "----------------------------------"  . PHP_EOL;
        $message_dosen .= "*Operator* telah menetapkan jadwal untuk proposal Anda" . PHP_EOL;
        $message_dosen .= "----------------------------------"  . PHP_EOL;
        $message_dosen .= "Lihat jadwal proposal" . PHP_EOL;
        $message_dosen .= url('dosen/proposal');
        // 
        foreach ($users as $user) {
            $this->kirim('085328481969', $message_dosen);
            // if ($user->telp) {
            // $this->kirim($user->telp, $message_dosen);
            // }
        }
        // 
        $peninjau_id = Proposal::where('jadwal_id', $id)->pluck('peninjau_id');
        $peninjaus = User::whereIn('id', $peninjau_id)->select('nama', 'telp')->get();
        // 
        $message_peninjau = "SIDHARMA LPPM"  . PHP_EOL;
        $message_peninjau .= "----------------------------------"  . PHP_EOL;
        $message_peninjau .= "*Operator* menetapkan Anda sebagai reviewer proposal" . PHP_EOL;
        $message_peninjau .= "----------------------------------"  . PHP_EOL;
        $message_peninjau .= "Lihat jadwal proposal" . PHP_EOL;
        $message_peninjau .= url('dosen/peninjau/review');
        // 
        foreach ($peninjaus as $peninjau) {
            $this->kirim('085328481969', $message_peninjau);
            // if ($peninjau->telp) {
            // $this->kirim($peninjau->telp, $message_peninjau);
            // }
        }
        // 
        alert()->success('Success', 'Berhasil mengirim pemberitahuan Jadwal');
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
