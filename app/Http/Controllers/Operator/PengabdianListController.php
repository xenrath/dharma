<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Pengabdian;
use App\Models\PengabdianRevisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengabdianListController extends Controller
{
    public function index()
    {
        $pengabdians = Pengabdian::where('status', 'menunggu')
            ->orWhere('status', 'revisi')
            ->orderByDesc('id')
            ->paginate(10);

        return view('operator.pengabdian.list.index', compact('pengabdians'));
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
            alert()->error('Error', 'Gagal mengirim revisi Pengabdian!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $pengabdian_revisis = PengabdianRevisi::where('pengabdian_id', $id)->get();
        if (count($pengabdian_revisis)) {
            foreach ($pengabdian_revisis as $pengabdian_revisi) {
                PengabdianRevisi::where('id', $pengabdian_revisi->id)->update([
                    'status' => false,
                ]);
            }
        }
        // 
        $revisi = PengabdianRevisi::create([
            'pengabdian_id' => $id,
            'keterangan' => $request->keterangan,
        ]);
        // 
        if (!$revisi) {
            alert()->error('Error', 'Gagal mengirim revisi Pengabdian!');
            return back();
        }
        // 
        $pengabdian = Pengabdian::where('id', $id)->update([
            'status' => 'revisi',
        ]);
        // 
        if (!$pengabdian) {
            alert()->error('Error', 'Gagal mengirim revisi Pengabdian!');
            return back();
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*Operator* memberikan revisi pada laporan pengabdian Anda" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar pengabdian" . PHP_EOL;
        $message .= url('dosen/pengabdian');
        // 
        $this->kirim('085328481969', $message);
        // $user_id = Pengabdian::where('id', $id)->value('user_id');
        // $telp = User::where('id', $user_id)->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil mengirim revisi Pengabdian');
        return back();
    }

    public function setujui($id)
    {
        $revisi = PengabdianRevisi::where([
            ['pengabdian_id', $id],
            ['status', true]
        ])->first();
        // 
        if ($revisi) {
            PengabdianRevisi::where('id', $revisi->id)->update([
                'status' => false,
            ]);
            $file = $revisi->file;
        } else {
            $file = Pengabdian::where('id', $id)->value('file');
        }
        // 
        $pengabdian = Pengabdian::where('id', $id)->update([
            'file' => $file,
            'status' => 'selesai',
        ]);
        // 
        if (!$pengabdian) {
            alert()->error('Error', 'Gagal mengonfirmasi Laporan Pengabdian!');
            return back();
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*Operator* menyetujui laporan pengabdian Anda" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar pengabdian" . PHP_EOL;
        $message .= url('dosen/pengabdian');
        // 
        $this->kirim('085328481969', $message);
        // $user_id = Pengabdian::where('id', $id)->value('user_id');
        // $telp = User::where('id', $user_id)->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil mengonfirmasi Laporan Pengabdian!');
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
