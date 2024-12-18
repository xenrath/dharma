<?php

namespace App\Http\Controllers\Dosen\Peninjau;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\ProposalRevisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProposalRevisiController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where([
            ['peninjau_id', auth()->user()->id],
            ['status', 'revisi1'],
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
                'file',
                'mahasiswas',
                'tanggal',
                'jam',
                'peninjau_id',
                'jadwal_id',
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
            ->with('proposal_revisis')
            ->get();

        return view('dosen.peninjau.revisi.index', compact('proposals'));
    }

    // ID = PROPOSAL ID
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
        $proposal_revisis = ProposalRevisi::where([
            ['proposal_id', $id],
            ['status', 'revisi1'],
            ['is_aktif', true],
        ])->get();
        // 
        if (count($proposal_revisis)) {
            foreach ($proposal_revisis as $proposal_revisi) {
                ProposalRevisi::where('id', $proposal_revisi->id)->update([
                    'is_aktif' => false,
                ]);
            }
        }
        // 
        $revisi = ProposalRevisi::create([
            'user_id' => auth()->user()->id,
            'proposal_id' => $id,
            'keterangan' => $request->keterangan,
            'status' => 'revisi1',
        ]);
        // 
        if (!$revisi) {
            alert()->error('Error', 'Gagal mengirim revisi Proposal!');
            return back();
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*Reviewer* memberikan revisi pada proposal Anda" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar proposal" . PHP_EOL;
        $message .= url('dosen/proposal');
        // 
        $this->kirim('085328481969', $message);
        // 
        // $user_id = Proposal::where('id', $id)->value('user_id');
        // $telp = User::where('id', $user_id)->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil mengirim revisi Proposal');
        return back();
    }

    // ID = PROPOSAL ID
    public function setujui($id)
    {
        $proposal_file = Proposal::where('id', $id)->value('file');
        Storage::disk('local')->delete('public/uploads/' . $proposal_file);
        // 
        $revisi = ProposalRevisi::where([
            ['proposal_id', $id],
            ['status', 'revisi1'],
            ['is_aktif', true],
        ])->orderByDesc('id')->first();
        // 
        $proposal = Proposal::where('id', $id)->update([
            'file' => $revisi->file,
            'status' => 'setuju1',
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal menyetujui Laporan Proposal!');
            return back();
        }
        // 
        $proposal_revisis = ProposalRevisi::where([
            ['proposal_id', $id],
            ['status', 'revisi1'],
        ])->get();
        // 
        if (count($proposal_revisis)) {
            foreach ($proposal_revisis as $proposal_revisi) {
                $file = ProposalRevisi::where('id', $proposal_revisi->id)->value('file');
                if ($revisi->file != $file) {
                    Storage::disk('local')->delete('public/uploads/' . $file);
                }
                ProposalRevisi::where('id', $proposal_revisi->id)->delete();
            }
        }
        // 
        $message_dosen = "SIDHARMA LPPM"  . PHP_EOL;
        $message_dosen .= "----------------------------------"  . PHP_EOL;
        $message_dosen .= "*Reviewer* telah menyetujui laporan proposal Anda" . PHP_EOL;
        $message_dosen .= "----------------------------------"  . PHP_EOL;
        $message_dosen .= "Lihat daftar proposal" . PHP_EOL;
        $message_dosen .= url('dosen/proposal');
        // 
        $this->kirim('085328481969', $message_dosen);
        // 
        // $user_id = Proposal::where('id', $id)->value('user_id');
        // $telp_dosen = User::where('id', $user_id)->value('telp');
        // if ($telp_dosen) {
        //     $this->kirim($telp_dosen, $message_dosen);
        // }
        // 
        $message_operator = "SIDHARMA LPPM"  . PHP_EOL;
        $message_operator .= "----------------------------------"  . PHP_EOL;
        $message_operator .= "*Reviewer* telah menyetujui sebuah laporan proposal. Menunggu Anda mengonfirmasi pendanaan." . PHP_EOL;
        $message_operator .= "----------------------------------"  . PHP_EOL;
        $message_operator .= "Lihat daftar pendanaan proposal" . PHP_EOL;
        $message_operator .= url('operator/proposal-pendanaan');
        // 
        $this->kirim('085328481969', $message_operator);
        // 
        // $telp_operator = User::where('role', 'operator')->value('telp');
        // if ($telp_operator) {
        //     $this->kirim($telp_operator, $message_operator);
        // }
        // 
        alert()->success('Success', 'Berhasil menyetujui Laporan Proposal');
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
