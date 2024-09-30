<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\ProposalRevisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProposalPendanaanController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where(function ($query) {
            $query->where('status', 'setuju');
            $query->orWhere('status', 'revisi2');
        })
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
                'peninjau_id',
                'jadwal_id',
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
            ->paginate(10);

        return view('operator.proposal.pendanaan.index', compact('proposals'));
    }

    public function perbaikan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required',
        ], [
            'keterangan.required' => 'Keterangan harus diisi!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengirim revisi Proposal!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $proposal_revisis = ProposalRevisi::where('proposal_id', $id)->get();
        if (count($proposal_revisis)) {
            foreach ($proposal_revisis as $proposal_revisi) {
                ProposalRevisi::where('id', $proposal_revisi->id)->update([
                    'status' => false,
                ]);
            }
        }
        // 
        $revisi = ProposalRevisi::create([
            'user_id' => auth()->user()->id,
            'proposal_id' => $id,
            'keterangan' => $request->keterangan,
        ]);
        // 
        if (!$revisi) {
            alert()->error('Error', 'Gagal mengirim revisi Proposal!');
            return back();
        }
        // 
        $proposal = Proposal::where('id', $id)->update([
            'status' => 'revisi2',
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal mengirim revisi Proposal!');
            return back();
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*Operator* memberikan revisi pada laporan proposal Anda" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar proposal" . PHP_EOL;
        $message .= url('dosen/proposal');
        // 
        $this->kirim('085328481969', $message);
        // $user_id = Proposal::where('id', $id)->value('user_id');
        // $telp = User::where('id', $user_id)->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil mengirim revisi Proposal');
        return back();
    }

    public function setujui(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'dana_setuju' => 'required',
        ], [
            'dana_setuju.required' => 'Dana Disetujui harus diisi!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengonfirmasi Dana Proposal!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $revisi = ProposalRevisi::where([
            ['proposal_id', $id],
            ['status', true]
        ])->first();
        // 
        if ($revisi) {
            ProposalRevisi::where('id', $revisi->id)->update([
                'status' => false,
            ]);
            $file = $revisi->file;
        } else {
            $file = Proposal::where('id', $id)->value('berkas');
        }
        // 
        $proposal = Proposal::where('id', $id)->update([
            'dana_setuju' => $request->dana_setuju,
            'berkas' => $file,
            'status' => 'pendanaan',
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal mengonfirmasi Dana Proposal!');
            return back();
        }
        // 
        $message_dosen = "SIDHARMA LPPM"  . PHP_EOL;
        $message_dosen .= "----------------------------------"  . PHP_EOL;
        $message_dosen .= "*Operator* menyetujui laporan proposal Anda" . PHP_EOL;
        $message_dosen .= "----------------------------------"  . PHP_EOL;
        $message_dosen .= "Lihat daftar proposal" . PHP_EOL;
        $message_dosen .= url('dosen/proposal');
        // 
        // $user_id = Proposal::where('id', $id)->value('user_id');
        // $telp = User::where('id', $user_id)->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message_dosen);
        // }
        // 
        $this->kirim('085328481969', $message_dosen);
        // 
        $message_ketua = "SIDHARMA LPPM"  . PHP_EOL;
        $message_ketua .= "----------------------------------"  . PHP_EOL;
        $message_ketua .= "*Operator* menyetujui sebuah laporan proposal. Menunggu konfirmasi Anda untuk menyelesaikan." . PHP_EOL;
        $message_ketua .= "----------------------------------"  . PHP_EOL;
        $message_ketua .= "Lihat daftar proposal" . PHP_EOL;
        $message_ketua .= url('dosen/ketua/proposal');
        // 
        // $telp = User::where('is_ketua', true)->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message_ketua);
        // }
        // 
        $this->kirim('085328481969', $message_ketua);
        // 
        alert()->success('Success', 'Berhasil mengonfirmasi Dana Proposal!');
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