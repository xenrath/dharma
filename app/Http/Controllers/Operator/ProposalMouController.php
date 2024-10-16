<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\ProposalMou;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProposalMouController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where('status', 'mou')
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
            ->with('user:id,nama,nipy,telp')
            ->with('jenis_penelitian:id,nama')
            ->with('jenis_pengabdian:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('personels', function ($query) {
                $query->select('proposal_id', 'user_id');
                $query->with('user:id,nama');
            })
            ->with('peninjau:id,nama')
            ->with('proposal_revisis', function ($query) {
                $query->select('proposal_id', 'user_id', 'keterangan', 'file');
                $query->orderByDesc('id');
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('operator.proposal.mou.index', compact('proposals'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nomor' => 'required|unique:proposal_mous,nomor',
        ], [
            'nomor.required' => 'Nomor Surat harus diisi!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal membuat MOU Proposal!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $draft = $this->mou($id);
        $mou_proposal = ProposalMou::where()->exsits();
        if ($mou_proposal) {
            ProposalMou::where('proposal_id', $id)->update([
                'nomor' => $request->nomor,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'draft' =>  $draft,
            ]);
        } else {
            ProposalMou::create([
                'proposal_id' => $id,
                'nomor' => $request->nomor,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'draft' =>  $draft,
            ]);
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*Operator* telah membuat MOU proposal. Unduh dan lakukan persetujuan segera." . PHP_EOL;
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
        alert()->success('Success', 'Berhasil membuat MOU Proposal');
        return back();
    }

    public function perbaikan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'revisi' => 'required',
        ], [
            'revisi.required' => 'Keterangan Revisi harus diisi!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengirim revisi MOU Proposal!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $proposal_mou = ProposalMou::where('proposal_id', $id)->update([
            'revisi' => $request->revisi,
        ]);
        // 
        if (!$proposal_mou) {
            alert()->error('Error', 'Gagal mengirim revisi MOU Proposal!');
            return back();
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*Operator* memberikan revisi pada file persetujuan MOU Anda" . PHP_EOL;
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
        alert()->success('Success', 'Berhasil mengirim revisi MOU Proposal');
        return back();
    }

    public function setujui($id)
    {
        $proposal = Proposal::where('id', $id)->update([
            'status' => 'setuju2',
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal mengonfirmasi MOU Proposal!');
            return back();
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*Operator* menyetujui sebuah MOU proposal. Menunggu konfirmasi Anda untuk menyelesaikan." . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar proposal" . PHP_EOL;
        $message .= url('dosen/ketua/proposal-mou');
        // 
        // $telp = User::where('is_ketua', true)->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        $this->kirim('085328481969', $message);
        // 
        alert()->success('Success', 'Berhasil mengonfirmasi MOU Proposal!');
        return back();
    }

    public function mou($id)
    {
        $proposal = Proposal::where('id', $id)
            ->select(
                'judul',
                'user_id',
                'dana_setuju',
                'jenis',
            )
            ->first();
        $ketua = User::where('is_ketua', true)
            ->select(
                'nama',
                'nipy',
                'ttd'
            )->first();
        $dosen = User::where('id', $proposal->user_id)
            ->select(
                'nama',
                'nipy',
                'prodi_id'
            )
            ->with('prodi', function ($query) {
                $query->select('id', 'nama', 'fakultas_id');
                $query->with('fakultas:id,nama');
            })
            ->first();
        $dana_terbilang = $this->terbilang($proposal->dana_setuju) . 'rupiah';
        $tahap_pertama = $proposal->dana_setuju * 75 / 100;
        $tahap_pertama_terbilang = $this->terbilang($tahap_pertama) . 'rupiah';
        $tahap_kedua = $proposal->dana_setuju * 25 / 100;
        $tahap_kedua_terbilang = $this->terbilang($tahap_kedua) . 'rupiah';
        $hari = Carbon::now()->translatedFormat('l');
        $tanggal = substr_replace($this->terbilang((int)Carbon::now()->translatedFormat('d')), "", -1);
        $bulan = Carbon::now()->translatedFormat('F');
        $tahun = substr_replace($this->terbilang(Carbon::now()->translatedFormat('Y')), "", -1);
        if (Carbon::now()->format('m') >= '09') {
            $tahun_akademik = Carbon::now()->format('Y') . '/' . Carbon::now()->addYear()->format('Y');
        } else {
            $tahun_akademik = Carbon::now()->addYears(-1)->format('Y') . '/' . Carbon::now()->format('Y');
        }
        if ($proposal->jenis == 'penelitian') {
            $title = 'MOU Penelitian ' . $dosen->nama;
            $jenis = 'Penelitian';
        } else {
            $title = 'MOU Abdimas ' . $dosen->nama;
            $jenis = 'Pengabdian kepada Masyarakat';
        }

        $pdf = Pdf::loadview('mou', compact(
            'proposal',
            'ketua',
            'dosen',
            'dana_terbilang',
            'tahap_pertama',
            'tahap_pertama_terbilang',
            'tahap_kedua',
            'tahap_kedua_terbilang',
            'hari',
            'tanggal',
            'bulan',
            'tahun',
            'tahun_akademik',
            'title',
            'jenis',
        ));
        $waktu = Carbon::now()->format('ymdhis');
        $nama_file = 'proposal/draft_' . $waktu . '.pdf';
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/uploads/' . $nama_file, $content);
        return $nama_file;
    }

    public function terbilang($value)
    {
        $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
        $space = $value > 0 ? " " : null;

        if ($value < 12) {
            return $angka[$value] . $space;
        } elseif ($value < 20) {
            return $this->terbilang($value - 10) . "belas" . $space;
        } elseif ($value < 100) {
            return $this->terbilang($value / 10) . "puluh" . $space . $this->terbilang($value % 10);
        } elseif ($value < 200) {
            return "seratus" . $this->terbilang($value - 100);
        } elseif ($value < 1000) {
            return $this->terbilang($value / 100) . "ratus" . $space . $this->terbilang($value % 100);
        } elseif ($value < 2000) {
            return "seribu" . $this->terbilang($value - 1000);
        } elseif ($value < 1000000) {
            return $this->terbilang($value / 1000) . "ribu" . $space . $this->terbilang($value % 1000);
        } elseif ($value < 1000000000) {
            return $this->terbilang($value / 1000000) . "juta" . $space . $this->terbilang($value % 1000000);
        }
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
