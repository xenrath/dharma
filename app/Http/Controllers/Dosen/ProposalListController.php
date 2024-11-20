<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\JenisPendanaan;
use App\Models\JenisPenelitian;
use App\Models\JenisPengabdian;
use App\Models\Proposal;
use App\Models\ProposalMou;
use App\Models\ProposalPersonel;
use App\Models\ProposalRevisi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Webklex\PDFMerger\Facades\PDFMergerFacade;

class ProposalListController extends Controller
{
    public function index()
    {
        $proposals = Proposal::where('status', '!=', 'selesai')
            ->where(function ($query) {
                $query->where('user_id', auth()->user()->id);
                $query->orWhereHas('personels', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                });
            })
            ->select(
                'id',
                'jenis',
                'user_id',
                'tahun',
                'judul',
                'jenis_pendanaan_id',
                'jenis_penelitian_id',
                'jenis_pengabdian_id',
                'dana_usulan',
                'dana_setuju',
                'file',
                'mahasiswas',
                'tanggal',
                'jam',
                'peninjau_id',
                'jadwal_id',
                'mou',
                'status',
            )
            ->with('user:id,nama')
            ->with('jenis_pendanaan:id,nama')
            ->with('jenis_penelitian:id,nama')
            ->with('jenis_pengabdian:id,nama')
            ->with('peninjau:id,nama')
            ->with('jadwal:id,kode')
            ->with('personels', function ($query) {
                $query->select('proposal_id', 'user_id');
                $query->with('user', function ($query) {
                    $query->select('id', 'nama');
                    $query->withTrashed();
                });
            })
            ->with('proposal_revisis', function ($query) {
                $query->select('proposal_id', 'user_id', 'file', 'keterangan');
                $query->orderByDesc('id');
            })
            ->orderByDesc('id')
            ->get();
        // 
        return view('dosen.proposal.list.index', compact('proposals'));
    }

    public function store(Request $request)
    {
        if ($request->jenis == 'penelitian') {
            return redirect('dosen/proposal-list/penelitian');
        } elseif ($request->jenis == 'pengabdian') {
            return redirect('dosen/proposal-list/pengabdian');
        } else {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back()->withErrors(['jenis' => 'Jenis Proposal harus dipilih!']);
        }
    }

    public function create_penelitian()
    {
        $jenis_penelitians = JenisPenelitian::select('id', 'nama')->get();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where([
            ['id', '!=', auth()->user()->id],
            ['role', 'dosen'],
        ])
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dosen.proposal.list.create_penelitian', compact('jenis_penelitians', 'jenis_pendanaans', 'dosens'));
    }

    public function store_penelitian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_penelitian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_usulan' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_penelitian_id.required' => 'Jenis Penelitian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'file.required' => 'Laporan Proposal harus ditambahkan!',
            'file.mimes' => 'Laporan Proposal harus berformat .pdf!',
            'file.max' => 'Laporan Proposal yang ditambahkan terlalu besar!',
        ]);
        // 
        $mahasiswas = [];
        if ($request->mahasiswas) {
            foreach ($request->mahasiswas as $mahasiswa) {
                if ($mahasiswa['nama']) {
                    $mahasiswas[$mahasiswa['nama']] = $mahasiswa['prodi'];
                }
            }
        }
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back()->withInput()->withErrors($validator->errors())->with('old_mahasiswas', $mahasiswas);
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $random = rand(10, 99);
        $file = 'proposal/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        $proposal = Proposal::create([
            'jenis' => 'penelitian',
            'user_id' => auth()->user()->id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_penelitian_id' => $request->jenis_penelitian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_usulan' => $request->dana_usulan,
            'file' => $file,
            'mahasiswas' => $mahasiswas,
            'status' => 'menunggu',
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back();
        }
        // 
        if ($request->personels) {
            foreach ($request->personels as $personel) {
                ProposalPersonel::create([
                    'proposal_id' => $proposal->id,
                    'user_id' => $personel,
                ]);
            }
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* " . "mengajukan sebuah proposal" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar proposal" . PHP_EOL;
        $message .= url('operator/proposal-list');
        // 
        $this->kirim('085328481969', $message);
        // 
        // $telp = User::where('role', 'operator')->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil membuat Proposal');
        return redirect('dosen/proposal-list');
    }

    public function create_pengabdian()
    {
        $jenis_pengabdians = JenisPengabdian::select('id', 'nama')->get();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where([
            ['id', '!=', auth()->user()->id],
            ['role', 'dosen'],
        ])
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();

        return view('dosen.proposal.list.create_pengabdian', compact('jenis_pengabdians', 'jenis_pendanaans', 'dosens'));
    }

    public function store_pengabdian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_pengabdian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_sumber' => 'required',
            'dana_usulan' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_pengabdian_id.required' => 'Jenis Pengabdian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_sumber.required' => 'Sumber Dana harus diisi!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'file.required' => 'Berkas harus ditambahkan!',
            'file.mimes' => 'Berkas harus berformat .pdf!',
            'file.max' => 'Berkas yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        $waktu = Carbon::now()->format('ymdhis');
        $random = rand(10, 99);
        $file = 'proposal/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        $proposal = Proposal::create([
            'jenis' => 'pengabdian',
            'user_id' => auth()->user()->id,
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_pengabdian_id' => $request->jenis_pengabdian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_sumber' => $request->dana_sumber,
            'dana_usulan' => $request->dana_usulan,
            'file' => $file,
            'mahasiswas' => array_filter($request->mahasiswas),
            'status' => 'menunggu',
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal membuat Proposal!');
            return back();
        }
        // 
        if ($request->personels) {
            foreach ($request->personels as $personel) {
                ProposalPersonel::create([
                    'proposal_id' => $proposal->id,
                    'user_id' => $personel,
                ]);
            }
        }
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* " . "mengajukan sebuah proposal" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar proposal" . PHP_EOL;
        $message .= url('operator/proposal-list');
        // 
        $this->kirim('085328481969', $message);
        // 
        // $telp = User::where('role', 'operator')->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil membuat Proposal');
        return redirect('dosen/proposal-list');
    }

    public function edit($id)
    {
        if (Proposal::where('id', $id)->value('status') != 'menunggu' || Proposal::where('id', $id)->value('user_id') != auth()->user()->id) {
            return view('error.500');
        }
        // 
        $jenis = Proposal::where('id', $id)->value('jenis');
        // 
        if ($jenis == 'penelitian') {
            return redirect('dosen/proposal-list/penelitian/' . $id);
        } elseif ($jenis == 'pengabdian') {
            return redirect('dosen/proposal-list/pengabdian/' . $id);
        } else {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back();
        }
    }

    public function edit_penelitian($id)
    {
        if (Proposal::where('id', $id)->value('status') != 'menunggu' || Proposal::where('id', $id)->value('user_id') != auth()->user()->id) {
            return view('error.500');
        }
        // 
        $proposal = Proposal::where('id', $id)
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'jenis_penelitian_id',
                'jenis_pendanaan_id',
                'dana_usulan',
                'dana_setuju',
                'file',
                'mahasiswas',
                'status',
            )
            ->with('user:id,nama')
            ->with('personels:proposal_id,user_id')
            ->first();
        $jenis_penelitians = JenisPenelitian::select('id', 'nama')->get();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where([
            ['id', '!=', auth()->user()->id],
            ['role', 'dosen'],
        ])
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();

        return view('dosen.proposal.list.edit_penelitian', compact('proposal', 'jenis_penelitians', 'jenis_pendanaans', 'dosens'));
    }

    public function update_penelitian(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_penelitian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_usulan' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_penelitian_id.required' => 'Jenis Penelitian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'file.mimes' => 'Berkas harus berformat .pdf!',
            'file.max' => 'Berkas yang ditambahkan terlalu besar!',
        ]);
        // 
        $mahasiswas = [];
        if ($request->mahasiswas) {
            foreach ($request->mahasiswas as $mahasiswa) {
                if ($mahasiswa['nama']) {
                    $mahasiswas[$mahasiswa['nama']] = $mahasiswa['prodi'];
                }
            }
        }
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back()->withInput()->withErrors($validator->errors())->with('old_mahasiswas', $mahasiswas);
        }
        // 
        if ($request->file) {
            Storage::disk('local')->delete('public/uploads/' . Proposal::where('id', $id)->value('file'));
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'proposal/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = Proposal::where('id', $id)->value('file');
        }
        // 
        $proposal = Proposal::where('id', $id)->update([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_penelitian_id' => $request->jenis_penelitian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_usulan' => $request->dana_usulan,
            'file' => $file,
            'mahasiswas' => $mahasiswas,
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back();
        }
        // 
        if ($request->personels) {
            $personel_deleted = array_diff(ProposalPersonel::where('proposal_id', $id)->pluck('user_id')->toArray(), $request->personels);
            // 
            if ($personel_deleted) {
                foreach ($personel_deleted as $personel) {
                    ProposalPersonel::where([
                        ['proposal_id', $id],
                        ['user_id', $personel],
                    ])->delete();
                }
            }
            // 
            foreach ($request->personels as $personel) {
                $cek = ProposalPersonel::where([
                    ['proposal_id', $id],
                    ['user_id', $personel],
                ])->exists();
                if (!$cek) {
                    ProposalPersonel::create([
                        'proposal_id' => $id,
                        'user_id' => $personel,
                    ]);
                }
            }
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui Proposal');
        // 
        return redirect('dosen/proposal-list');
    }

    public function edit_pengabdian($id)
    {
        if (Proposal::where('id', $id)->value('status') != 'menunggu' || Proposal::where('id', $id)->value('user_id') != auth()->user()->id) {
            return view('error.500');
        }
        // 
        $proposal = Proposal::where('id', $id)
            ->select(
                'id',
                'user_id',
                'tahun',
                'judul',
                'jenis_pengabdian_id',
                'jenis_pendanaan_id',
                'dana_sumber',
                'dana_usulan',
                'dana_setuju',
                'file',
                'mahasiswas',
                'status',
            )
            ->with('user:id,nama')
            ->with('personels:proposal_id,user_id')
            ->first();
        $jenis_pengabdians = JenisPengabdian::select('id', 'nama')->get();
        $jenis_pendanaans = JenisPendanaan::select('id', 'nama')->get();
        $dosens = User::where([
            ['id', '!=', auth()->user()->id],
            ['role', 'dosen'],
        ])
            ->select('id', 'nidn', 'nama')
            ->orderBy('nama')
            ->take(10)
            ->get();
        // 
        return view('dosen.proposal.list.edit_pengabdian', compact('proposal', 'jenis_pengabdians', 'jenis_pendanaans', 'dosens'));
    }

    public function update_pengabdian(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'judul' => 'required',
            'jenis_pengabdian_id' => 'required',
            'jenis_pendanaan_id' => 'required',
            'dana_sumber' => 'required',
            'dana_usulan' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
        ], [
            'tahun.required' => 'Tahun Kegiatan harus diisi!',
            'judul.required' => 'Judul Proposal harus diisi!',
            'jenis_pengabdian_id.required' => 'Jenis Pengabdian harus dipilih!',
            'jenis_pendanaan_id.required' => 'Jenis Pendanaan harus dipilih!',
            'dana_sumber.required' => 'Sumber Dana harus diisi!',
            'dana_usulan.required' => 'Dana Usulan harus diisi!',
            'file.mimes' => 'Berkas harus berformat .pdf!',
            'file.max' => 'Berkas yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back()->withInput()->withErrors($validator->errors());
        }
        // 
        if ($request->file) {
            Storage::disk('local')->delete('public/uploads/' . Proposal::where('id', $id)->value('file'));
            $waktu = Carbon::now()->format('ymdhis');
            $random = rand(10, 99);
            $file = 'proposal/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
            $request->file->storeAs('public/uploads/', $file);
        } else {
            $file = Proposal::where('id', $id)->value('file');
        }
        // 
        $proposal = Proposal::where('id', $id)->update([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'jenis_pengabdian_id' => $request->jenis_pengabdian_id,
            'jenis_pendanaan_id' => $request->jenis_pendanaan_id,
            'dana_sumber' => $request->dana_sumber,
            'dana_usulan' => $request->dana_usulan,
            'file' => $file,
            'mahasiswas' => array_filter($request->mahasiswas),
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal memperbarui Proposal!');
            return back();
        }
        // 
        if ($request->personels) {
            $personel_deleted = array_diff(ProposalPersonel::where('proposal_id', $id)->pluck('user_id')->toArray(), $request->personels);
            // 
            if ($personel_deleted) {
                foreach ($personel_deleted as $personel) {
                    ProposalPersonel::where([
                        ['proposal_id', $id],
                        ['user_id', $personel],
                    ])->delete();
                }
            }
            // 
            foreach ($request->personels as $personel) {
                $cek = ProposalPersonel::where([
                    ['proposal_id', $id],
                    ['user_id', $personel],
                ])->exists();
                if (!$cek) {
                    ProposalPersonel::create([
                        'proposal_id' => $id,
                        'user_id' => $personel,
                    ]);
                }
            }
        }
        // 
        alert()->success('Success', 'Berhasil memperbarui Proposal');
        // 
        return redirect('dosen/proposal-list');
    }

    public function destroy($id)
    {
        $proposal = Proposal::where('id', $id)->with('personels')->first();

        if (!$proposal) {
            alert()->error('Error', 'Gagal menghapus Proposal!');
            return back();
        }

        $file = $proposal->file;
        $personels = $proposal->personels;

        if (count($personels)) {
            ProposalPersonel::where('proposal_id', $id)->delete();
        }

        $proposal->delete();

        Storage::disk('local')->delete('public/uploads/' . $file);

        alert()->success('Success', 'Berhasil menghapus Proposal');
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
        $random = rand(10, 99);
        $file = 'proposal/' . $waktu . $random . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        // 
        $revisi = ProposalRevisi::where('id', $id)->update([
            'file' => $file,
        ]);
        // 
        if (!$revisi) {
            alert()->error('Error', 'Gagal mengunggah File Laporan!');
            return back();
        }
        //
        $proposal_id = ProposalRevisi::where('id', $id)->value('proposal_id');
        $proposal = Proposal::where('id', $proposal_id)->select('peninjau_id', 'status')->first();
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* mengunggah revisi laporan proposal" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar proposal" . PHP_EOL;
        if ($proposal->status == 'revisi1') {
            $message .= url('dosen/peninjau/revisi');
            // 
            // $telp = User::where('id', $proposal->peninjau_id)->value('telp');
            // if ($telp) {
            //     $this->kirim($telp, $message);
            // }
        } elseif ($proposal->status == 'revisi2') {
            $message .= url('operator/proposal-pendanaan');
            // 
            // $telp = User::where('role', 'operator')->value('telp');
            // if ($telp) {
            //     $this->kirim($telp, $message);
            // }
        }
        // 
        $this->kirim('085328481969', $message);
        // 
        alert()->success('Success', 'Berhasil mengunggah File Laporan');
        return back();
    }

    public function mou(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf|max:2048',
        ], [
            'file.required' => 'File Persetujuan harus ditambahkan!',
            'file.mimes' => 'File Persetujuan harus berformat .pdf!',
            'file.max' => 'File Persetujuan yang ditambahkan terlalu besar!',
        ]);
        // 
        if ($validator->fails()) {
            alert()->error('Error', 'Gagal mengunggah File Persetujuan!');
            return back()->withInput()->withErrors($validator->errors())->with('id', $id);
        }
        // 
        $waktu1 = Carbon::now()->format('ymdhis');
        $random1 = rand(10, 99);
        $file = 'proposal/' . $waktu1 . $random1 . '.' . $request->file->getClientOriginalExtension();
        $request->file->storeAs('public/uploads/', $file);
        //
        $draft = ProposalMou::where('proposal_id', $id)->value('draft');
        // 
        $merge = PDFMergerFacade::init();
        $merge->addPDF(public_path('storage/uploads/' . $draft), [1, 2, 3]);
        $merge->addPDF(public_path('storage/uploads/' . $file), [1]);
        $merge->merge();
        $waktu2 = Carbon::now()->format('ymdhis');
        $random2 = rand(10, 99);
        $nama_file = 'proposal/' . $waktu2 . $random2 . '.pdf';
        $merge->setFileName($nama_file);
        $merge->save(public_path('storage/uploads/' . $nama_file));
        // 
        $proposal = Proposal::where('id', $id)->update([
            'mou' => $nama_file,
        ]);
        // 
        if (!$proposal) {
            alert()->error('Error', 'Gagal mengunggah File Persetujuan!');
            return back();
        }
        // 
        Storage::disk('local')->delete('public/uploads/' . $file);
        // 
        $message = "SIDHARMA LPPM"  . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "*" . auth()->user()->nama . "* mengunggah file persetujuan MOU" . PHP_EOL;
        $message .= "----------------------------------"  . PHP_EOL;
        $message .= "Lihat daftar MOU proposal" . PHP_EOL;
        $message .= url('operator/proposal-mou');
        // 
        $this->kirim('085328481969', $message);
        // $telp = User::where('role', 'operator')->value('telp');
        // if ($telp) {
        //     $this->kirim($telp, $message);
        // }
        // 
        alert()->success('Success', 'Berhasil mengunggah File Persetujuan!');
        return back();
    }

    // public function mou($id)
    // {
    //     $proposal = Proposal::where('id', $id)->first();
    //     // 
    //     // if ($proposal->status != 'selesai') {
    //     //     return view('error.500');
    //     // }
    //     // 
    //     $ketua = User::where('is_ketua', true)
    //         ->select(
    //             'nama',
    //             'nipy',
    //             'ttd'
    //         )->first();
    //     $dosen = User::where('id', $proposal->user_id)
    //         ->select(
    //             'nama',
    //             'nipy',
    //             'prodi_id'
    //         )
    //         ->with('prodi', function ($query) {
    //             $query->select('id', 'nama', 'fakultas_id');
    //             $query->with('fakultas:id,nama');
    //         })
    //         ->first();
    //     $dana_terbilang = $this->terbilang($proposal->dana_usulan) . 'rupiah';
    //     $tahap_pertama = $proposal->dana_usulan * 75 / 100;
    //     $tahap_pertama_terbilang = $this->terbilang($tahap_pertama) . 'rupiah';
    //     $tahap_kedua = $proposal->dana_usulan * 25 / 100;
    //     $tahap_kedua_terbilang = $this->terbilang($tahap_kedua) . 'rupiah';
    //     $hari = Carbon::now()->translatedFormat('l');
    //     $tanggal = substr_replace($this->terbilang((int)Carbon::now()->translatedFormat('d')), "", -1);
    //     $bulan = Carbon::now()->translatedFormat('F');
    //     $tahun = substr_replace($this->terbilang(Carbon::now()->translatedFormat('Y')), "", -1);
    //     if (Carbon::now()->format('m') >= '09') {
    //         $tahun_akademik = Carbon::now()->format('Y') . '/' . Carbon::now()->addYear()->format('Y');
    //     } else {
    //         $tahun_akademik = Carbon::now()->addYears(-1)->format('Y') . '/' . Carbon::now()->format('Y');
    //     }
    //     if ($proposal->jenis == 'penelitian') {
    //         $title = 'MOU Penelitian ' . $dosen->nama;
    //         $jenis = 'Penelitian';
    //     } else {
    //         $title = 'MOU Abdimas ' . $dosen->nama;
    //         $jenis = 'Pengabdian kepada Masyarakat';
    //     }

    //     $pdf = Pdf::loadview('dosen.mou', compact(
    //         'proposal',
    //         'ketua',
    //         'dosen',
    //         'dana_terbilang',
    //         'tahap_pertama',
    //         'tahap_pertama_terbilang',
    //         'tahap_kedua',
    //         'tahap_kedua_terbilang',
    //         'hari',
    //         'tanggal',
    //         'bulan',
    //         'tahun',
    //         'tahun_akademik',
    //         'title',
    //         'jenis',
    //     ));
    //     // return $pdf->stream($title . '.pdf');
    //     $mou = $pdf->download()->getOriginalContent();

    //     $oMerger = PDFMergerFacade::init();

    //     $oMerger->addPDF($mou, [1, 2, 3]);
    //     $oMerger->addPDF(public_path('storage/uploads/' . $proposal->file), 'all');

    //     $oMerger->merge();
    //     // $oMerger->save('merged_result.pdf');
    //     $oMerger->setFileName('example.pdf');
    //     return $oMerger->stream();
    // }

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
