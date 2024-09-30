<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Proposal;
use App\Models\ProposalJadwal;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $proposal_list = Proposal::where('status', 'menunggu')->count();
        $proposal_pendanaan = Proposal::where(function ($query) {
            $query->where('status', 'setuju');
            $query->orWhere('status', 'revisi2');
        })->count();
        $proposal_riwayat = $proposals = Proposal::where(function ($query) {
            $query->where('status', 'setuju');
            $query->orWhere('status', 'revisi2');
        })->count();
        $penelitian_list = $penelitians = Penelitian::where('status', 'menunggu')->orWhere('status', 'revisi')->count();
        $penelitian_riwayat = Penelitian::where('status', 'selesai')->count();
        $pengabdian_list = Pengabdian::where('status', 'menunggu')->orWhere('status', 'revisi')->count();
        $pengabdian_riwayat = Pengabdian::where('status', 'selesai')->count();

        return view('operator.index', compact(
            'proposal_list',
            'proposal_pendanaan',
            'proposal_riwayat',
            'penelitian_list',
            'penelitian_riwayat',
            'pengabdian_list',
            'pengabdian_riwayat',
        ));
    }

    // ID = PROPOSAL ID
    public function berkas($id)
    {
        $berkas = Proposal::where('id', $id)->value('berkas');
        $judul = Proposal::where('id', $id)->value('judul');

        return response()->make(file_get_contents('public/storage/uploads/' . $berkas), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $judul . '.pdf"',
        ]);
    }

    // ID = PROPOSAL JADWAL ID
    public function jadwal($id)
    {
        $jadwal = ProposalJadwal::where('id', $id)->select('tanggal', 'nomor', 'perihal', 'kepadas', 'proposal_ids')->first();
        $fakultases = Fakultas::whereIn('id', $jadwal->kepadas)->select('nama')->get();
        $proposals = Proposal::whereIn('id', $jadwal->proposal_ids)
            ->select(
                'id',
                'jenis',
                'user_id',
                'judul',
                'tanggal',
                'jam',
                'peninjau_id',
            )
            ->with('user', function ($query) {
                $query->select('id', 'nama', 'prodi_id')->with('prodi:id,nama');
            })
            ->with('personels', function ($query) {
                $query->select('proposal_id', 'user_id');
                $query->with('user:id,nama');
            })
            ->with('peninjau:id,nama')->get();
        $ketua = User::where('is_ketua', true)->select('nama', 'nipy')->first();
        if (Carbon::parse($jadwal->tanggal)->format('m') >= '09') {
            $tahun_akademik = Carbon::parse($jadwal->tanggal)->format('Y') . '/' . Carbon::parse($jadwal->tanggal)->addYear()->format('Y');
        } else {
            $tahun_akademik = Carbon::parse($jadwal->tanggal)->addYears(-1)->format('Y') . '/' . Carbon::parse($jadwal->tanggal)->format('Y');
        }

        $pdf = Pdf::loadview('operator.jadwal', compact('jadwal', 'fakultases', 'proposals', 'ketua', 'tahun_akademik'));
        return $pdf->stream('Surat Undangan Presentasi Proposal LP2M - ' . Carbon::parse($jadwal->tanggal)->format('d M Y') . '.pdf');
    }
}
