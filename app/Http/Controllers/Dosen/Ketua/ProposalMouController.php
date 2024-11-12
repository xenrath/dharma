<?php

namespace App\Http\Controllers\Dosen\Ketua;

use App\Http\Controllers\Controller;
use App\Models\Penelitian;
use App\Models\PenelitianPersonel;
use App\Models\Pengabdian;
use App\Models\PengabdianPersonel;
use App\Models\Proposal;
use App\Models\ProposalMou;
use App\Models\ProposalPersonel;
use Illuminate\Http\Request;

class ProposalMouController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where(function ($query) {
            $query->where('status', 'mou');
            $query->where('mou', null);
        })
            ->orWhere('status', 'setuju2')
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
                'mou',
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
            ->with('proposal_revisis', function ($query) {
                $query->select('proposal_id', 'user_id', 'file', 'keterangan')->orderByDesc('id');
                $query->with('user', function ($query) {
                    $query->select('id', 'nama');
                    $query->withTrashed();
                });
            })
            ->get();

        return view('dosen.ketua.mou.index', compact('proposals'));
    }

    public function update(Request $request, $id)
    {
        $proposal = Proposal::where('id', $id)->update([
            'status' => 'selesai',
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal mengonfirmasi MOU Proposal!');
            return back();
        }
        // 
        $proposal = Proposal::where('id', $id)->first();
        $proposal_personels = ProposalPersonel::where('proposal_id', $id)->get();
        // 
        if ($proposal->jenis == 'penelitian') {
            $penelitian = Penelitian::create([
                'user_id' => $proposal->user_id,
                'tahun' => $proposal->tahun,
                'judul' => $proposal->judul,
                'jenis_pendanaan_id' => $proposal->jenis_pendanaan_id,
                'jenis_penelitian_id' => $proposal->jenis_penelitian_id,
                'dana_sumber' => $proposal->dana_sumber,
                'dana_setuju' => $proposal->dana_setuju,
                'file' => null,
                'mahasiswas' => $proposal->mahasiswas,
                'status' => 'menunggu',
            ]);
            // 
            if ($penelitian) {
                foreach ($proposal_personels as $personel) {
                    PenelitianPersonel::create([
                        'penelitian_id' => $penelitian->id,
                        'user_id' => $personel->user_id,
                    ]);
                }
            }
        } else {
            $pengabdian = Pengabdian::create([
                'user_id' => $proposal->user_id,
                'tahun' => $proposal->tahun,
                'judul' => $proposal->judul,
                'jenis_pendanaan_id' => $proposal->jenis_pendanaan_id,
                'jenis_pengabdian_id' => $proposal->jenis_pengabdian_id,
                'dana_sumber' => $proposal->dana_sumber,
                'dana_setuju' => $proposal->dana_setuju,
                'file' => null,
                'mahasiswas' => $proposal->mahasiswas,
                'status' => 'menunggu',
            ]);
            // 
            if ($pengabdian) {
                foreach ($proposal_personels as $personel) {
                    PengabdianPersonel::create([
                        'pengabdian_id' => $pengabdian->id,
                        'user_id' => $personel->user_id,
                    ]);
                }
            }
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*Ka. LPPM* telah menyetujui laporan proposal Anda" . PHP_EOL;
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
        alert()->success('Success', 'Berhasil menyelesaikan Proposal!');
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
