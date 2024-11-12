<?php

namespace App\Http\Controllers\Dosen\Ketua;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProposalPendanaanController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where('status', 'pendanaan')
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
                'dana_setuju',
                'file',
                'mahasiswas',
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
                $query->with('user', function ($query) {
                    $query->select('id', 'nama');
                    $query->withTrashed();
                });
            })
            ->get();

        return view('dosen.ketua.pendanaan.index', compact('proposals'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'dana_setuju' => 'required',
        ], [
            'dana_setuju.required' => 'Dana Disetujui harus diisi!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengonfirmasi Pendanaan Proposal!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $update = Proposal::where('id', $id)->update([
            'dana_setuju' => $request->dana_setuju,
            'status' => 'mou',
        ]);
        // 
        if (!$update) {
            alert()->error('Error', 'Gagal mengonfirmasi Pendanaan Proposal!');
            return back();
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*Ka. LPPM* telah mengonfirmasi pendanaan suatu proposal. Lakukan pembuatan MOU untuk melanjutkan." . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar mou proposal" . PHP_EOL;
        $message .= url('operator/proposal-mou');
        // 
        $this->kirim('085328481969', $message);
        // $telp = User::where('role', 'operator')->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        //
        alert()->success('Success', 'Berhasil mengonfirmasi Proposal!');
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
