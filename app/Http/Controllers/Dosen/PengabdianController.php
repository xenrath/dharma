<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Pengabdian;
use App\Models\PengabdianRevisi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengabdianController extends Controller
{
    public function index()
    {
        $pengabdians = Pengabdian::where('user_id', auth()->user()->id)
            ->orWhereHas('personels', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'jenis_pengabdian_id',
                'jenis_pendanaan_id',
                'dana_sumber',
                'dana_setuju',
                'file',
                'mahasiswas',
                'status',
            )
            ->with('user:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('jenis_pengabdian:id,nama')
            ->with('personels', function ($query) {
                $query->select('pengabdian_id', 'user_id');
                $query->with('user', function ($query) {
                    $query->select('id', 'nama');
                    $query->withTrashed();
                });
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('dosen.pengabdian.index', compact('pengabdians'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'file.required' => 'File Laporan harus ditambahkan!',
            'file.mimes' => 'File Laporan harus berformat .pdf!',
            'file.max' => 'File Laporan yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengunggah File Laporan!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $file = 'pengabdian/' . $waktu . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        $pengabdian = Pengabdian::where('id', $id)->update([
            'file' => $file,
        ]);
        // 
        if (!$pengabdian) {
            alert()->error('Error', 'Gagal mengunggah File Laporan!');
            return back();
        }
        //
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* mengunggah file laporan pengabdian" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar pengabdian" . PHP_EOL;
        $message .= url('operator/pengabdian-list');
        // 
        $this->kirim('085328481969', $message);
        // $telp = User::where('role', 'operator')->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil mengunggah File Laporan');
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
        $file = 'pengabdian/revisi_' . $waktu . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        $revisi = PengabdianRevisi::where('id', $id)->update([
            'file' => $file,
        ]);
        // 
        if (!$revisi) {
            alert()->error('Error', 'Gagal mengunggah File Laporan!');
            return back();
        }
        //
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* mengunggah revisi laporan pengabdian" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar pengabdian" . PHP_EOL;
        $message .= url('operator/pengabdian-list');
        // 
        $this->kirim('085328481969', $message);
        // $telp = User::where('role', 'operator')->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
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
