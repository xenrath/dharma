<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Penelitian;
use App\Models\PenelitianRevisi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenelitianRiwayatController extends Controller
{
    public function index()
    {
        $penelitians = Penelitian::where('status', 'selesai')
            ->where('user_id', auth()->user()->id)
            ->orWhereHas('personels', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'jenis_penelitian_id',
                'jenis_pendanaan_id',
                'dana_setuju',
                'file',
                'mahasiswas',
                'status',
            )
            ->with('user:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('jenis_penelitian:id,nama')
            ->with('personels', function ($query) {
                $query->select('penelitian_id', 'user_id');
                $query->with('user:id,nama');
            })
            ->orderByDesc('tahun')
            ->paginate(10);

        return view('dosen.penelitian.riwayat.index', compact('penelitians'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'file.required' => 'Laporan Penelitian harus ditambahkan!',
            'file.mimes' => 'Laporan Penelitian harus berformat .pdf!',
            'file.max' => 'Laporan Penelitian yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengunggah Laporan Penelitian!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $random = rand(10, 99);
        $file = 'penelitian/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        $penelitian = Penelitian::where('id', $id)->update([
            'file' => $file,
        ]);
        // 
        if (!$penelitian) {
            alert()->error('Error', 'Gagal mengunggah Laporan Penelitian!');
            return back();
        }
        //
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* mengunggah file laporan penelitian" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar penelitian" . PHP_EOL;
        $message .= url('operator/penelitian-list');
        // 
        $this->kirim('085328481969', $message);
        // $telp = User::where('role', 'operator')->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil mengunggah Laporan Penelitian');
        return back();
    }

    // ID = Proposal Revisi ID
    public function perbaikan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'file.required' => 'File Revisi harus ditambahkan!',
            'file.mimes' => 'File Revisi harus berformat .pdf!',
            'file.max' => 'File Revisi yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengunggah File Revisi!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $random = rand(10, 99);
        $file = 'penelitian/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        $revisi = PenelitianRevisi::where('id', $id)->update([
            'file' => $file,
        ]);
        // 
        if (!$revisi) {
            alert()->error('Error', 'Gagal mengunggah File Revisi!');
            return back();
        }
        //
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* mengunggah revisi laporan penelitian" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar penelitian" . PHP_EOL;
        $message .= url('operator/penelitian-list');
        // 
        $this->kirim('085328481969', $message);
        // $telp = User::where('role', 'operator')->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil mengunggah File Revisi');
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
