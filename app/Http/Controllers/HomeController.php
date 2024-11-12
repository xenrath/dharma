<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Prodi;
use App\Models\Proposal;
use App\Models\ProposalJadwal;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $user = User::where('id', auth()->user()->id)
            ->select(
                'nama',
                'nidn',
                'nipy',
                'id_sinta',
                'id_scopus',
                'golongan',
                'jabatan',
                'alamat',
                'telp',
            )
            ->first();

        return view('profile', compact('user'));
    }

    public function profile_proses(Request $request)
    {
        if (auth()->user()->isOperator() || auth()->user()->isDev()) {
            $validator_nidn = 'nullable';
            $validator_nipy = 'nullable';
        } else {
            $validator_nidn = 'required';
            $validator_nipy = 'required';
        }
        // 
        if (auth()->user()->isKetua()) {
            $validator_ttd = 'required';
        } else {
            $validator_ttd = 'nullable';
        }
        // 
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nidn' => $validator_nidn . '|unique:users,nidn,' . auth()->user()->id . ',id',
            'nipy' => $validator_nipy . '|unique:users,nipy,' . auth()->user()->id . ',id',
            'telp' => 'required|unique:users,telp,' . auth()->user()->id . ',id',
            'ttd' => $validator_ttd . '|mimes:png|max:1024',
        ], [
            'nama.required' => 'Nama Dosen tidak boleh kosong!',
            'nidn.required' => 'NIDN tidak boleh kosong!',
            'nidn.unique' => 'NIDN sudah digunakan!',
            'nipy.required' => 'NIPY tidak boleh kosong!',
            'nipy.unique' => 'NIPY sudah digunakan!',
            'telp.required' => 'Nomor WhatsApp tidak boleh kosong!',
            'telp.unique' => 'Nomor WhatsApp sudah digunakan!',
            'ttd.required' => 'Tanda Tangan harus ditambahkan!',
            'ttd.mimes' => 'Tanda Tangan harus berformat .png!',
            'ttd.max' => 'Tanda Tangan yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Profile!');
            return back()->withInput()->withErrors($validator);
        }
        // 
        if (auth()->user()->isOperator() || auth()->user()->isDev()) {
            $nidn = auth()->user()->nidn;
            $nipy = auth()->user()->nipy;
        } else {
            $nidn = $request->nidn;
            $nipy = $request->nipy;
        }
        // 
        if (auth()->user()->isKetua()) {
            Storage::disk('local')->delete('public/uploads/' . auth()->user()->ttd);
            $ttd = 'ttd/' . $nidn . '.' . $request->ttd->getClientOriginalExtension();
            $request->ttd->storeAs('public/uploads/', $ttd);
        } else {
            $ttd = auth()->user()->ttd;
        }
        // 
        $user = User::where('id', auth()->user()->id)->update([
            'nama' => $request->nama,
            'username' => $nidn,
            'nidn' => $nidn,
            'nipy' => $nipy,
            'telp' => $request->telp,
        ]);
        // 
        if (!$user) {
            alert()->error('Error', 'Gagal memperbarui Profile!');
            return back();
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui Profile');
        return back();
    }

    public function ttd(Request $request)
    {
        if (!auth()->user()->isKetua()) {
            return view('error.500');
        }
        // 
        if (auth()->user()->ttd) {
            $validator_ttd = 'nullable';
        } else {
            $validator_ttd = 'required';
        }
        // 
        $validator = Validator::make($request->all(), [
            'nipy_test' => 'required',
            'ttd_test' => $validator_ttd . '|image|mimes:png|max:1024',
        ], [
            'nipy_test.required' => 'NIPY belum diisi!',
            'ttd_test.required' => 'Tanda Tangan belum ditambahkan!',
            'ttd_test.image' => 'Tanda Tangan harus berformat jpeg, jpg, png!',
            'ttd_test.max' => 'Tanda Tangan maksimal ukuran 1 MB',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal melihat Hasil!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        if ($request->ttd_test) {
            Storage::disk('local')->delete('public/uploads/' . auth()->user()->ttd);
            $ttd_test = 'ttd/' . auth()->user()->nidn . '.' . $request->ttd_test->getClientOriginalExtension();
            $request->ttd_test->storeAs('public/uploads/', $ttd_test);
            // 
            User::where('id', auth()->user()->id)->update([
                'nipy' => $request->nipy_test,
                'ttd' => $ttd_test,
            ]);
        } else {
            $ttd_test = auth()->user()->ttd;
            User::where('id', auth()->user()->id)->update([
                'nipy' => $request->nipy_test,
                'ttd' => $ttd_test,
            ]);
        }
        // 
        $user = User::where('id', auth()->user()->id)
            ->select('nama', 'nipy', 'ttd')
            ->first();
        $pdf = Pdf::loadview('ttd', compact('user'));
        return $pdf->stream('Contoh Surat Undangan Presentasi Proposal LP2M');
    }

    public function ubah_password()
    {
        return view('ubah_password');
    }

    public function ubah_password_proses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ], [
            'password.required' => 'Password harus diisi!',
            'password.confirmed' => 'Konfirmasi Password tidak cocok!',
            'password_confirmation.required' => 'Konfirmasi Password harus diisi!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengganti Password!');
            return back()->withInput()->withErrors($validator->errors());
        }

        $user = User::where('id', auth()->user()->id)->update([
            'password' => bcrypt($request->password),
        ]);

        if (!$user) {
            alert()->error('Error', 'Gagal mengganti Password!');
            return back();
        }

        alert()->success('Success', 'Berhasil mengganti Password');
        return back();
    }

    public function ketua_search(Request $request)
    {
        $keyword = $request->keyword;

        $dosens = User::where('role', 'dosen')
            ->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%");
                $query->orWhere('nidn', 'like', "%$keyword%");
            })
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();

        return $dosens;
    }

    public function ketua_set($id)
    {
        $dosen = User::where([
            ['role', 'dosen'],
            ['id', $id],
        ])
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->first();

        return $dosen;
    }

    public function personel_search(Request $request)
    {
        $keyword = $request->keyword;

        $dosens = User::where([
            ['id', '!=', auth()->user()->id],
            ['role', 'dosen'],
        ])
            ->where(function ($query) use ($keyword) {
                $query->where('nama', 'like', "%$keyword%");
                $query->orWhere('nidn', 'like', "%$keyword%");
            })
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();

        return $dosens;
    }

    public function personel_get(Request $request)
    {
        $personel_item = $request->personel_item ?? array();

        if (count($personel_item)) {
            $dosens = User::where('role', 'dosen')
                ->whereIn('id', $personel_item)
                ->select('id', 'nidn', 'nama')
                ->orderBy('nama')
                ->get();

            return $dosens;
        } else {
            return array();
        }
    }

    public function info()
    {
        $telp_dev = User::where('role', 'dev')->value('telp');
        $telp_operator = User::where('role', 'operator')->value('telp');

        return view('info', compact('telp_dev', 'telp_operator'));
    }

    public function proposal_get(Request $request)
    {
        $proposal_item = $request->proposal_item ?? array();

        if (count($proposal_item)) {
            $proposals = Proposal::where('status', 'proses')
                ->whereIn('id', $proposal_item)
                ->select(
                    'id',
                    'user_id',
                    'judul',
                )
                ->with('user:id,nama')
                ->orderBy('tanggal')
                ->get();

            return $proposals;
        } else {
            return array();
        }
    }

    public function hubungi($telp)
    {
        $agent = new Agent;
        $desktop = $agent->isDesktop();

        if ($desktop) {
            return redirect()->away('https://web.whatsapp.com/send?phone=+62' . $telp);
        } else {
            return redirect()->away('https://wa.me/+62' . $telp);
        }
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
                'mahasiswas',
            )
            ->with('user', function ($query) {
                $query->select('id', 'nama', 'prodi_id')->with('prodi:id,nama');
            })
            ->with('personels', function ($query) {
                $query->select('proposal_id', 'user_id');
                $query->with('user', function ($query) {
                    $query->select('id', 'nama');
                    $query->withTrashed();
                });
            })
            ->with('peninjau:id,nama')->get();
        $ketua = User::where('is_ketua', true)->select('nama', 'nipy', 'ttd')->first();
        if (Carbon::parse($jadwal->tanggal)->format('m') >= '09') {
            $tahun_akademik = Carbon::parse($jadwal->tanggal)->format('Y') . '/' . Carbon::parse($jadwal->tanggal)->addYear()->format('Y');
        } else {
            $tahun_akademik = Carbon::parse($jadwal->tanggal)->addYears(-1)->format('Y') . '/' . Carbon::parse($jadwal->tanggal)->format('Y');
        }

        $pdf = Pdf::loadview('jadwal', compact('jadwal', 'fakultases', 'proposals', 'ketua', 'tahun_akademik'));
        return $pdf->stream('Surat Undangan Presentasi Proposal LP2M - ' . Carbon::parse($jadwal->tanggal)->format('d M Y') . '.pdf');
    }

    public function pengesahan($jenis, $id)
    {
        if ($jenis == 'penelitian') {
            $data = Penelitian::where('id', $id)->first();
        } else {
            $data = Pengabdian::where('id', $id)->first();
        }
        $ketua = User::where('id', $data->user_id)->first();
        $kepala = User::where('is_ketua', true)->first();

        $pdf = Pdf::loadview('pengesahan', compact('data', 'ketua', 'kepala'));
        return $pdf->stream('Lembar Pengesahan');
    }

    public function statistik()
    {
        $penelitians = Penelitian::where('status', 'selesai')->paginate(10);
        $prodis = Prodi::get();
        $pengabdians = Penelitian::where('status', 'selesai')->get();

        return view('statistik', compact('penelitians', 'prodis', 'pengabdians'));
    }
}
