<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Penelitian;
use App\Models\PenelitianRevisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenelitianListController extends Controller
{
    public function index()
    {
        $penelitians = Penelitian::where('status', 'menunggu')
            ->orWhere('status', 'revisi')
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'jenis_penelitian_id',
                'jenis_pendanaan_id',
                'dana_sumber',
                'dana_setuju',
                'file',
                'mahasiswas',
                'status',
            )
            ->with('user:id,nama')
            ->with('jenis_penelitian:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('personels', function ($query) {
                $query->select('penelitian_id', 'user_id');
                $query->with('user:id,nama');
            })
            ->paginate(10);
        // 
        return view('operator.penelitian.list.index', compact('penelitians'));
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
            alert()->error('Error', 'Gagal mengirim revisi Penelitian!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $penelitian_revisis = PenelitianRevisi::where('penelitian_id', $id)->get();
        if (count($penelitian_revisis)) {
            foreach ($penelitian_revisis as $penelitian_revisi) {
                PenelitianRevisi::where('id', $penelitian_revisi->id)->update([
                    'status' => false,
                ]);
            }
        }
        // 
        $revisi = PenelitianRevisi::create([
            'penelitian_id' => $id,
            'keterangan' => $request->keterangan,
        ]);
        // 
        if (!$revisi) {
            alert()->error('Error', 'Gagal mengirim revisi Penelitian!');
            return back();
        }
        // 
        $penelitian = Penelitian::where('id', $id)->update([
            'status' => 'revisi',
        ]);
        // 
        if (!$penelitian) {
            alert()->error('Error', 'Gagal mengirim revisi Penelitian!');
            return back();
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*Operator* memberikan revisi pada laporan penelitian Anda" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar penelitian" . PHP_EOL;
        $message .= url('dosen/penelitian');
        // 
        $this->kirim('085328481969', $message);
        // $user_id = Penelitian::where('id', $id)->value('user_id');
        // $telp = User::where('id', $user_id)->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil mengirim revisi Penelitian');
        return back();
    }

    public function setujui($id)
    {
        $revisi = PenelitianRevisi::where([
            ['penelitian_id', $id],
            ['status', true]
        ])->first();
        // 
        if ($revisi) {
            PenelitianRevisi::where('id', $revisi->id)->update([
                'status' => false,
            ]);
            $file = $revisi->file;
        } else {
            $file = Penelitian::where('id', $id)->value('file');
        }
        // 
        $penelitian = Penelitian::where('id', $id)->update([
            'file' => $file,
            'status' => 'selesai',
        ]);
        // 
        if (!$penelitian) {
            alert()->error('Error', 'Gagal mengonfirmasi Laporan Penelitian!');
            return back();
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*Operator* menyetujui laporan penelitian Anda" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar penelitian" . PHP_EOL;
        $message .= url('dosen/penelitian');
        // 
        $this->kirim('085328481969', $message);
        // $user_id = Penelitian::where('id', $id)->value('user_id');
        // $telp = User::where('id', $user_id)->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil mengonfirmasi Laporan Penelitian!');
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
